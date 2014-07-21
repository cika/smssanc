<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
//sd page 
$user=$_SESSION['login_user_id'];
if(!isset($_GET['add_index'])){
$_GET['add_index']="";
}

echo "<br />";

if(!(($index==1) or ($index==2) or ($index==5))){
echo "<table width='50%' border='0' align='center'>";
echo "<tr align='center'><td><font color='#006666' size='3'><strong>ตู้เอกสารกลาง</strong></font></td></tr>";
echo "</table>";
}
//ส่วนเพิ่มข้อมูล
if($index==1){
$sql = "select * from  cabinet_file where  cabinet_id='$_REQUEST[cabinet_id]' and tray_id='$_REQUEST[tray_id]' and file_id='$_REQUEST[file_id]' ";
$dbquery = mysql_query($sql);
$ref_result = mysql_fetch_array($dbquery);

echo "<form Enctype = multipart/form-data id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size='3'><B>เพิ่มเอกสาร</B></Font><br />";
echo "<Font color='#006666' Size='2'><B>แฟ้ม$ref_result[file_name]</B></Font>";
echo "</Cener>";
echo "<Br><Br>";
echo "<Table  width='50%' >";
echo "<Tr align='left'><Td align='right'>ชื่อเรื่อง&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='doc_subject'  Size='70'></Td></Tr>";
echo "<Tr align='left'><Td align='right'>เอกสาร&nbsp;&nbsp;</Td><Td><input type='file' name='myfile1' size='26'></Td></Tr>";
echo "<Input Type=Hidden Name='cabinet_id' Value='$_REQUEST[cabinet_id]'>";
echo "<Input Type=Hidden Name='tray_id' Value='$_REQUEST[tray_id]'>";
echo "<Input Type=Hidden Name='file_id' Value='$_REQUEST[file_id]'>";
echo "<Input Type=Hidden Name='page' Value='$_REQUEST[page]'>";
echo "<Input Type=Hidden Name='main_page' Value='$_REQUEST[main_page]'>";
echo "<Br>";
echo "</Table>";
echo "<Br>";
echo "<INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url(1)' class=entrybutton>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ย้อนกลับ' onclick='goto_url(0)' class=entrybutton'>";
echo "</form>";
}

//ส่วนยืนยันการลบข้อมูล
if($index==2) {
echo "<table width='800' border='0' align='center'>";
echo "<tr><td align='center'><font color='#990000' size='4'>โปรดยืนยันความต้องการลบข้อมูลอีกครั้ง</font><br></td></tr>";
echo "<tr><td align=center>";
echo "<INPUT TYPE='button' name='smb' value='ยืนยัน' onclick='location.href=\"?option=cabinet&task=main/ctr_document&index=3&id=$_REQUEST[id]&page=$_REQUEST[page]&main_page=$_REQUEST[main_page]&cabinet_id=$_REQUEST[cabinet_id]&tray_id=$_REQUEST[tray_id]&file_id=$_REQUEST[file_id]\"'>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ยกเลิก' onclick='location.href=\"?option=cabinet&task=main/ctr_document&index=7&page=$_REQUEST[page]&main_page=$_REQUEST[main_page]&cabinet_id=$_REQUEST[cabinet_id]&tray_id=$_REQUEST[tray_id]&file_id=$_REQUEST[file_id]\"'";
echo "</td></tr></table>";
}

//ส่วนลบข้อมูล
if($index==3){
$sql_unlink = "select * from  cabinet_main where  id='$_REQUEST[id]'";
$dbquery_unlink = mysql_query($sql_unlink);
$result_unlink  = mysql_fetch_array($dbquery_unlink );
			//ป้องกันการลบที่ไม่ใช่เจ้าของ
			if($result_unlink['person_id']==$user){
			$sql = "delete from cabinet_main where  id=$_REQUEST[id]";
			$dbquery = mysql_query($sql);
			unlink("modules/cabinet/upload_files/$result_unlink[doc_name]");
			}
$index=7;
}

//ส่วนเพิ่มข้อมูล
if($index==4){
$sizelimit = 20000*1024 ;  //ขนาดไฟล์ที่ให้แนบ 20 Mb.
/// file
$myfile1 = $_FILES ['myfile1'] ['tmp_name'] ;
$myfile1_name = $_FILES ['myfile1'] ['name'] ;
$myfile1_size = $_FILES ['myfile1'] ['size'] ;
$myfile1_type = $_FILES ['myfile1'] ['type'] ;
 $array_last1 = explode("." ,$myfile1_name) ;
 $c1 =count ($array_last1) - 1 ;
 $lastname1 = strtolower ($array_last1 [$c1] ) ;
 if  ($myfile1<>"") {
			 if ($lastname1 =="doc" or $lastname1 =="docx" or $lastname1 =="rar" or $lastname1 =="pdf" or $lastname1 =="xls" or $lastname1 =="xlsx" or $lastname1 =="zip" or $lastname1 =="jpg" or $lastname1 =="gif" or $lastname1 =="ppt" or $lastname1 =="pptx") { 
				 $upfile1 = "" ; 
			  }else {
				 $upfile1 = "-ไม่อนุญาตให้ทำการแนบไฟล์ $myfile1_name<BR> " ;
			  } 

		  If ($myfile1_size>$sizelimit) {
			  $sizelimit1 = "-ไฟล์ $myfile1_name มีขนาดใหญ่กว่าที่กำหนด<BR>" ;
		  }else {
				$sizelimit1 = "" ;
		  }
 }

// check file size  file name
if ($upfile1<> "" || $sizelimit1<> "") {
echo "<div align='center'>";
echo "<B><FONT SIZE=2 COLOR=#990000>มีข้อผิดพลาดเกี่ยวกับไฟล์ของคุณ ดังรายละเอียด</FONT></B><BR>" ;
echo "<FONT SIZE=2 COLOR=#990099>" ;
 echo  $upfile1 ;
 echo  $sizelimit1 ;
 echo "</FONT>" ;
 echo "&nbsp;&nbsp;&nbsp;<input type=\"button\" value=\"&nbsp;&nbsp;แก้ไข&nbsp;&nbsp;\" onClick=\"javascript:history.go(-1)\" ></CENTER>" ;
 echo "</div>";
exit () ;
}
					if ($myfile1<>"" ) {
					$timestamp = mktime(date("H"), date("i"),date("s"), date("m") ,date("d"), date("Y"))  ;	
					//timestamp เวลาปัจจุบัน 
					$ref_id = $user.$timestamp ;
					$myfile1name=$ref_id.".".$lastname1 ; 
								if(copy ($myfile1, "modules/cabinet/upload_files/".$myfile1name)){
								$rec_date=date("Y-m-d H:i:s");
								$sql = "insert into cabinet_main (file_id, tray_id, cabinet_id, cabinet_type, doc_subject, doc_size, doc_name, doc_type, person_id, rec_date) values ( '$_POST[file_id]', '$_POST[tray_id]', '$_POST[cabinet_id]', '1' , '$_POST[doc_subject]', '$myfile1_size', '$myfile1name', '$lastname1', '$user', '$rec_date')";
								$dbquery = mysql_query($sql);
								}
					unlink ($myfile1) ;
					}
echo "<script>document.location.href='?option=cabinet&task=main/ctr_document&index=7&main_page=$_REQUEST[main_page]&cabinet_id=$_REQUEST[cabinet_id]&tray_id=$_REQUEST[tray_id]&file_id=$_REQUEST[file_id]'; </script>\n";
}

//ส่วนฟอร์มแก้ไขข้อมูล
if ($index==5){
echo "<form id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>แก้ไข</B></Font>";
echo "</Cener>";
echo "<Br><Br>";
$sql = "select * from  cabinet_main where  id='$_REQUEST[id]'";
$dbquery = mysql_query($sql);
$ref_result = mysql_fetch_array($dbquery);
echo "<Table  width='50%'>";
echo "<Tr align='left'><Td align='right'>ชื่อเรื่อง&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='doc_subject'  Size='70' value='$ref_result[doc_subject]'></Td></Tr>";
echo "<Tr><Td align='right'>แฟ้มเอกสาร&nbsp;&nbsp;</Td>";
echo "<td><div align='left'><Select  name='file_id'  size='1'>";
				$sql_file = "select  * from cabinet_file  where  cabinet_id='$_REQUEST[cabinet_id]' and tray_id='$_REQUEST[tray_id]' order by file_id";
				$dbquery_file= mysql_query($sql_file);
				echo  "<option  value = ''>เลือก</option>" ;
				While ($result_file = mysql_fetch_array($dbquery_file)){
						if($result_file[file_id]==$_REQUEST[file_id]){
						echo  "<option value=$result_file[file_id] selected>$result_file[file_name]</option>" ;
						}
						else{
						echo  "<option value=$result_file[file_id]>$result_file[file_name]</option>" ;
						}
				}
echo "</select>";
echo "</div></td></tr>";
echo "</Table>";
echo "<Br />";
echo "<Input Type=Hidden Name='id' Value='$_REQUEST[id]'>";
echo "<Input Type=Hidden Name='cabinet_id' Value='$_REQUEST[cabinet_id]'>";
echo "<Input Type=Hidden Name='tray_id' Value='$_REQUEST[tray_id]'>";
echo "<Input Type=Hidden Name='page' Value='$_REQUEST[page]'>";
echo "<Input Type=Hidden Name='main_page' Value='$_REQUEST[main_page]'>";
echo "<INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url_update(1)' class=entrybutton>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ย้อนกลับ' onclick='location.href=\"?option=cabinet&task=main/ctr_document&index=7&page=$_REQUEST[page]&main_page=$_REQUEST[main_page]&cabinet_id=$_REQUEST[cabinet_id]&tray_id=$_REQUEST[tray_id]&file_id=$_REQUEST[file_id]\"'";
echo "</form>";
}

//ส่วนปรับปรุงข้อมูล
if ($index==6){
$sql_unlink = "select * from  cabinet_main where  id='$_REQUEST[id]'";
$dbquery_unlink = mysql_query($sql_unlink);
$result_unlink  = mysql_fetch_array($dbquery_unlink );
			//ป้องกันการแก้ไขที่ไม่ใช่เจ้าของ
			if($result_unlink['person_id']==$user){
			$sql = "update  cabinet_main set  doc_subject='$_POST[doc_subject]' , file_id='$_POST[file_id]'  where  id='$_POST[id]'";
			echo $_POST['file_id'];
			$dbquery = mysql_query($sql);
			}
$index=7;
}

//ส่วนการดูเอกสาร
if ($index==7){
//ส่วนของการแยกหน้า
$pagelen=20;  // 1_กำหนดแถวต่อหน้า
$url_link="option=cabinet&task=main/ctr_document&index=7&main_page=$_REQUEST[main_page]&cabinet_id=$_REQUEST[cabinet_id]&tray_id=$_REQUEST[tray_id]&file_id=$_REQUEST[file_id]";  // 2_กำหนดลิงค์ฺ
$sql = "select * from  cabinet_main where  cabinet_type='1' and  cabinet_id='$_REQUEST[cabinet_id]'  and tray_id='$_REQUEST[tray_id]'  and  file_id='$_REQUEST[file_id]'"; // 3_กำหนด sql

$dbquery = mysql_query($sql);
$num_rows = mysql_num_rows($dbquery );  
$totalpages=ceil($num_rows/$pagelen);
//
if(!isset($_REQUEST['page'])){
$_REQUEST['page']="";
}
//
if($_REQUEST['page']==""){
$page=$totalpages;
		if($page<2){
		$page=1;
		}
}
else{
		if($totalpages<$_REQUEST['page']){
		$page=$totalpages;
					if($page<1){
					$page=1;
					}
		}
		else{
		$page=$_REQUEST['page'];
		}
}

$start=($page-1)*$pagelen;

if(($totalpages>1) and ($totalpages<16)){
echo "<div align=center>";
echo "หน้า	";
			for($i=1; $i<=$totalpages; $i++)	{
					if($i==$page){
					echo "[<b><font size=+1 color=#990000>$i</font></b>]";
					}
					else {
					echo "<a href=$PHP_SELF?$url_link&page=$i>[$i]</a>";
					}
			}
echo "</div>";
}			
if($totalpages>15){
			if($page <=8){
			$e_page=15;
			$s_page=1;
			}
			if($page>8){
					if($totalpages-$page>=7){
					$e_page=$page+7;
					$s_page=$page-7;
					}
					else{
					$e_page=$totalpages;
					$s_page=$totalpages-15;
					}
			}
			echo "<div align=center>";
			if($page!=1){
			$f_page1=$page-1;
			echo "<<a href=$PHP_SELF?$url_link&page=1>หน้าแรก </a>";
			echo "<<<a href=$PHP_SELF?$url_link&page=$f_page1>หน้าก่อน </a>";
			}
			else {
			echo "หน้า	";
			}					
			for($i=$s_page; $i<=$e_page; $i++){
					if($i==$page){
					echo "[<b><font size=+1 color=#990000>$i</font></b>]";
					}
					else {
					echo "<a href=$PHP_SELF?$url_link&page=$i>[$i]</a>";
					}
			}
			if($page<$totalpages)	{
			$f_page2=$page+1;
			echo "<a href=$PHP_SELF?$url_link&page=$f_page2> หน้าถัดไป</a>>>";
			echo "<a href=$PHP_SELF?$url_link&page=$totalpages> หน้าสุดท้าย</a>>";
			}
			echo " <select onchange=\"location.href=this.options[this.selectedIndex].value;\" size=\"1\" name=\"select\">";
			echo "<option  value=\"\">หน้า</option>";
				for($p=1;$p<=$totalpages;$p++){
				echo "<option  value=\"?$url_link&page=$p\">$p</option>";
				}
			echo "</select>";
echo "</div>";  
}					
//จบแยกหน้า
$sql_file = "select * from  cabinet_file where  cabinet_id='$_REQUEST[cabinet_id]'  and tray_id='$_REQUEST[tray_id]'  and  file_id='$_REQUEST[file_id]'";
$dbquery_file = mysql_query($sql_file);
$result_file = mysql_fetch_array($dbquery_file);

$sql = "select cabinet_main.id, cabinet_main.doc_subject, cabinet_main.doc_type, cabinet_main.doc_size,  cabinet_main.doc_name, cabinet_main.person_id, cabinet_main.rec_date, person_main.name, person_main.surname  from cabinet_main left join person_main on cabinet_main.person_id=person_main.person_id  where  cabinet_main.cabinet_type='1' and  cabinet_main.cabinet_id='$_REQUEST[cabinet_id]'  and cabinet_main.tray_id='$_REQUEST[tray_id]'  and cabinet_main.file_id='$_REQUEST[file_id]' order by id limit $start,$pagelen";
$dbquery = mysql_query($sql);
echo  "<table width='95%' border='0' align='center'>";

echo "<Tr ><Td colspan='4' align='left'><INPUT TYPE='button' name='smb' value='เพิ่มเอกสารในแฟ้ม$result_file[file_name]' onclick='location.href=\"?option=cabinet&task=main/ctr_document&cabinet_id=$_REQUEST[cabinet_id]&tray_id=$_REQUEST[tray_id]&file_id=$_REQUEST[file_id]&add_index=1&page=$_REQUEST[main_page]\"'><Td colspan='5' align='right'><INPUT TYPE='button' name='smb' value='<<กลับไปตู้เอกสาร' onclick='location.href=\"?option=cabinet&task=main/ctr_document&page=$_REQUEST[main_page]\"'></Td></Tr>";

echo "<Tr bgcolor='#FFCCCC' align='center' ><Td width='70'>ที่</Td><Td>แฟ้ม</Td><Td>ชื่อเอกสาร</Td><Td width='80'>ประเภท</Td><Td width='100'>ขนาด (KB)</Td><Td width='140'>ผู้เก็บเอกสาร</Td><Td width='140'>วดป</Td><Td width='50'>ลบ</Td><Td width='50'>แก้ไข</Td></Tr>";
$N=(($page-1)*$pagelen)+1;  //*เกี่ยวข้องกับการแยกหน้า
$M=1;
While ($result = mysql_fetch_array($dbquery)){
$doc_size=ceil($result['doc_size']/1024);
			if(($M%2) == 0)
			$color="#FFFFC";
			else  	$color="#FFFFFF";
echo "<Tr bgcolor=$color><Td align='center'>$N</Td><Td>$result_file[file_name]</Td><Td><a href=modules/cabinet/upload_files/$result[doc_name] target='_blank'>$result[doc_subject]</a></Td><Td  align='center'>$result[doc_type]</Td><Td align='center'>$doc_size</Td><Td>$result[name]&nbsp;$result[surname]</Td><Td align='center'>$result[rec_date]</Td>";
if($result['person_id']==$user){
echo "<Td align='center'><a href=?option=cabinet&task=main/ctr_document&index=2&id=$result[id]&page=$page&main_page=$_REQUEST[main_page]&cabinet_id=$_REQUEST[cabinet_id]&tray_id=$_REQUEST[tray_id]&file_id=$_REQUEST[file_id]><img src=images/drop.png border='0' alt='ลบ'></a></Td><Td align='center'><a href=?option=cabinet&task=main/ctr_document&index=5&id=$result[id]&page=$page&main_page=$_REQUEST[main_page]&cabinet_id=$_REQUEST[cabinet_id]&tray_id=$_REQUEST[tray_id]&file_id=$_REQUEST[file_id]><img src=images/edit.png border='0' alt='แก้ไข'></a></Td>";
}
else {
echo "<td></td><td></td>";
}
echo "</Tr>";

$M++;
$N++;  //*เกี่ยวข้องกับการแยกหน้า
}
echo "</Table>";
}

//ส่วนการแสดงผล
if(!(($index==1) or ($index==2)  or ($index==5) or ($index==7))){

//ส่วนของการแยกหน้า
$pagelen=1;  // 1_กำหนดแถวต่อหน้า
$url_link="option=cabinet&task=main/ctr_document";  // 2_กำหนดลิงค์ฺ
$sql = "select * from  cabinet_cabinet where  cabinet_type='1'"; // 3_กำหนด sql
//
if(!isset($_REQUEST['page'])){
$_REQUEST['page']="";
}
//
$dbquery = mysql_query($sql);
$num_rows = mysql_num_rows($dbquery );  
$totalpages=ceil($num_rows/$pagelen);
if($_REQUEST['page']==""){
$page=$totalpages;
		if($page<2){
		$page=1;
		}
}
else{
		if($totalpages<$_REQUEST['page']){
		$page=$totalpages;
					if($page<1){
					$page=1;
					}
		}
		else{
		$page=$_REQUEST['page'];
		}
}

$start=($page-1)*$pagelen;

if(($totalpages>1) and ($totalpages<16)){
echo "<div align=center>";
echo "หน้า	";
			for($i=1; $i<=$totalpages; $i++)	{
					if($i==$page){
					echo "[<b><font size=+1 color=#990000>$i</font></b>]";
					}
					else {
					echo "<a href=$PHP_SELF?$url_link&page=$i>[$i]</a>";
					}
			}
echo "</div>";
}			
if($totalpages>15){
			if($page <=8){
			$e_page=15;
			$s_page=1;
			}
			if($page>8){
					if($totalpages-$page>=7){
					$e_page=$page+7;
					$s_page=$page-7;
					}
					else{
					$e_page=$totalpages;
					$s_page=$totalpages-15;
					}
			}
			echo "<div align=center>";
			if($page!=1){
			$f_page1=$page-1;
			echo "<<a href=$PHP_SELF?$url_link&page=1>หน้าแรก </a>";
			echo "<<<a href=$PHP_SELF?$url_link&page=$f_page1>หน้าก่อน </a>";
			}
			else {
			echo "หน้า	";
			}					
			for($i=$s_page; $i<=$e_page; $i++){
					if($i==$page){
					echo "[<b><font size=+1 color=#990000>$i</font></b>]";
					}
					else {
					echo "<a href=$PHP_SELF?$url_link&page=$i>[$i]</a>";
					}
			}
			if($page<$totalpages)	{
			$f_page2=$page+1;
			echo "<a href=$PHP_SELF?$url_link&page=$f_page2> หน้าถัดไป</a>>>";
			echo "<a href=$PHP_SELF?$url_link&page=$totalpages> หน้าสุดท้าย</a>>";
			}
			echo " <select onchange=\"location.href=this.options[this.selectedIndex].value;\" size=\"1\" name=\"select\">";
			echo "<option  value=\"\">หน้า</option>";
				for($p=1;$p<=$totalpages;$p++){
				echo "<option  value=\"?$url_link&page=$p\">$p</option>";
				}
			echo "</select>";
echo "</div>";  
}					
//จบแยกหน้า

$sql = "select cabinet_cabinet.id, cabinet_cabinet.cabinet_id, cabinet_cabinet.cabinet_name, cabinet_cabinet.cabinet_size, cabinet_cabinet.tray_size, cabinet_cabinet.cabinet_person, person_main.prename, person_main.name, person_main.surname  from cabinet_cabinet  left join person_main on cabinet_cabinet.cabinet_person=person_main.person_id  where  cabinet_cabinet.cabinet_type='1' order by cabinet_id  limit $start,$pagelen";
$dbquery = mysql_query($sql);
echo  "<table width='95%' border='0' align='center'>";
echo "<Tr bgcolor='#FFCCCC' align='center' ><Td width='70'>เลขที่ตู้</Td><Td >ตู้เอกสาร</Td><Td >ลิ้นชัก</Td><Td>แฟ้ม</Td><Td width='100'>ขนาด(MB)</Td><Td width='100'>%การใช้</Td><Td width='70'>จำนวน<br />เอกสาร</Td><Td width='70'>เปิดแฟ้ม<br />เอกสาร</Td><Td width='70'>เพิ่มเอกสาร</Td></Tr>";
$N=(($page-1)*$pagelen)+1;  //*เกี่ยวข้องกับการแยกหน้า
$M=1;
While ($result = mysql_fetch_array($dbquery))
	{
		$id = $result['id'];
echo "<Tr  bgcolor='#CCCCCC' align='center'><Td>$result[cabinet_id]</Td><td colspan='3' align='left'>$result[cabinet_name]</td><Td align='center'>$result[cabinet_size]</Td> <Td align='left'></Td>";
echo "<Td></Td><Td></Td><Td></Td></Tr>";
			//ส่วนลิ้นชัก
			$sql_tray = "select  * from cabinet_tray  where  cabinet_id='$result[cabinet_id]' order by tray_id";
			$dbquery_tray= mysql_query($sql_tray);
			While ($result_tray = mysql_fetch_array($dbquery_tray)){
							//หาการใช้พื้นที่ในลิ้นชัก
							$sql_tray_sum ="select  sum(doc_size) as  size_sum from cabinet_main where cabinet_type='1' and  cabinet_id='$result[cabinet_id]' and  tray_id='$result_tray[tray_id]' ";
							$dbquery_tray_sum= mysql_query($sql_tray_sum);
							$result_tray_sum  = mysql_fetch_array($dbquery_tray_sum);
							$size_sum=($result_tray_sum['size_sum']/($result['tray_size']*1024000))*100;
							$size_sum=number_format($size_sum,3);
							
							//ส่วนของการแยกไปเพิ่มเอกสาร
							if(($_GET['add_index']==1) and ($result['cabinet_id']==$_REQUEST['cabinet_id'])  and  ($result_tray['tray_id']==$_REQUEST['tray_id'])){
									if($size_sum<100){
									echo "<script>document.location.href='?option=cabinet&task=main/ctr_document&cabinet_id=$_REQUEST[cabinet_id]&tray_id=$_REQUEST[tray_id]&file_id=$_REQUEST[file_id]&index=1&page=$page&main_page=$page';</script>\n";
									}
									else{
									echo "<script>alert('ลิ้นชักเต็ม ติดต่อผู้จัดการตู้เอกสาร');</script>";
									echo "<script>document.location.href='?option=cabinet&task=main/ctr_document&page=$page';</script>";
									}
							}
							//จบส่วนแยก
							
			echo "<Tr  bgcolor='#99FFFF' align='center'><Td></Td><td></td><td colspan='2' align='left'>ลิ้นชักเลขที่&nbsp;$result_tray[tray_id]&nbsp;$result_tray[tray_name]</td><Td align='center'>$result[tray_size]</Td><Td align='right'>$size_sum%</Td><Td></Td>";
			echo "<Td></Td><Td></Td>";
			echo "</Tr>";
			//จบส่วนลิ้นชัก
							//ส่วนแฟ้ม
							$sql_file = "select  * from cabinet_file  where  cabinet_id='$result[cabinet_id]' and  tray_id='$result_tray[tray_id]' order by file_id";
							$dbquery_file= mysql_query($sql_file);
							$F=1;
							While ($result_file = mysql_fetch_array($dbquery_file)){
											//นับเอกสารในแฟ้ม
											$sql_file_num="select  count(id) as file_num from cabinet_main where cabinet_type='1' and  cabinet_id='$result[cabinet_id]' and  tray_id='$result_tray[tray_id]' and file_id=$result_file[file_id]";
											$dbquery_file_num= mysql_query($sql_file_num);
											$result_file_num = mysql_fetch_array($dbquery_file_num);
							if(($F%2) == 0)
							$Fcolor="#FFFFFF";
							else  $Fcolor="#FFFFC";
							echo "<Tr  bgcolor='$Fcolor' align='center'><Td></Td><td></td><td></td><td colspan='3' align='left'>แฟ้มเลขที่&nbsp;$result_file[file_id]&nbsp;$result_file[file_name]</td><Td>$result_file_num[file_num]</Td><Td><a href=?option=cabinet&task=main/ctr_document&index=7&cabinet_id=$result[cabinet_id]&tray_id=$result_tray[tray_id]&file_id=$result_file[file_id]&main_page=$page><img src=images/b_browse.png border='0' alt='ดู'></Td>";
							if($size_sum<100){
							echo "<Td><a href=?option=cabinet&task=main/ctr_document&index=1&cabinet_id=$result[cabinet_id]&tray_id=$result_tray[tray_id]&file_id=$result_file[file_id]&page=$page&main_page=$page><img src=images/edit.png border='0' alt='เพิ่ม'></a></Td></Tr>";
							}
							else{
							echo "<Td></td></tr>";
							}
							$F++;
							}
							//จบส่วนแฟ้ม
			}
$M++;
$N++;  //*เกี่ยวข้องกับการแยกหน้า
	}
echo "</Table>";
}

?>
<script>
function goto_url(val){
	if(val==0){
		callfrm("?option=cabinet&task=main/ctr_document");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.doc_subject.value == ""){
			alert("กรุณากรอกชื่อเรื่อง");
		}else if(frm1.myfile1.value==""){
			alert("กรุณาเลือกเอกสาร");
		}else{
			callfrm("?option=cabinet&task=main/ctr_document&index=4");   //page ประมวลผล
		}
	}
}

function goto_url_update(val){
	if(val==0){
		callfrm("?option=cabinet&task=main/ctr_document");   // page ย้อนกลับ 
	}else if(val==1){
			if(frm1.doc_subject.value == ""){
			alert("กรุณากรอกชื่อเรื่อง");
		}else{
			callfrm("?option=cabinet&task=main/ctr_document&index=6");   //page ประมวลผล
		}
	}
}
</script>
