<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
//sd page 

$officer=$_SESSION['login_user_id'];

$sql = "select * from  news_mainitem where item_active='1' order by code desc limit 1";
$dbquery = mysql_query($sql);
$item_active_result = mysql_fetch_array($dbquery);
if($item_active_result['code']==""){
echo "<br />";
echo "<div align='center'>ยังไม่ได้กำหนดชื่อเรื่องเพื่อทำงานปัจจุบัน กรุณาไปที่เมนูตั้งค่าระบบ</div>";
exit();
}

//อาเรย์ประเภท
$sql = "select * from news_section where mainitem_code='$item_active_result[code]' order by code";
$dbquery = mysql_query($sql);
While ($result = mysql_fetch_array($dbquery)) {
	$code= $result['code'];
	$section_ar[$code]=$result['name'];
}

//ฟังชั่นupload
function file_upload() {
		$uploaddir = 'modules/news/upload_files/';      //ที่เก็บไไฟล์
		$uploadfile = $uploaddir.basename($_FILES['userfile']['name']);
		$basename = basename($_FILES['userfile']['name']);
		if (move_uploaded_file($_FILES['userfile']['tmp_name'],  $uploadfile))
			{
				$rand_num=rand();
				$time_mk=time();
				$txt ="news_".$time_mk.$rand_num;
				$before_name  = $uploaddir . $basename;
				
				///////
				$array_lastname = explode("." ,$basename) ;
				 $c =count ($array_lastname) - 1 ;
				 $lastname = strtolower ($array_lastname[$c]) ;
				$changed_name = $uploaddir.$txt.".".$lastname;
				///////

				rename("$before_name" , "$changed_name");
				return  $changed_name;
			}
		else
			{
			return  $changed_name;
			}
			sleep(3);
}

echo "<br />";
if(!(($index==1) or ($index==2) or ($index==5))){
echo "<table width='50%' border='0' align='center'>";
echo "<tr align='center'><td><font color='#006666' size='3'><strong>$item_active_result[mainitem]</strong></font></td></tr>";
echo "</table>";
}
//ส่วนเพิ่มข้อมูล
if($index==1){
echo "<form Enctype = multipart/form-data id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>เพิ่มข้อมูล</B></Font>";
echo "</Cener>";
echo "<Br><Br>";
echo "<Table width='60%' Border='0'>";

echo "<Tr align='left'><Td align='right'>ประเภท&nbsp;&nbsp;</Td>";
echo   "<td align='left'><Select name='section' size='1'>"; 
echo  "<option  value = ''>เลือก</option>" ;
$sql = "select * from  news_section where mainitem_code='$item_active_result[code]' order by code";
$dbquery = mysql_query($sql);
While ($result = mysql_fetch_array($dbquery))
   {
		$code = $result['code'];
		$name = $result['name'];
		echo  "<option value = $code>$name</option>" ;
	}
echo "</select>";
echo "</td></tr>";

echo "<Tr align='left'><Td align='right'>ข้อความ&nbsp;&nbsp;</Td><Td><textarea Name='news' cols='40' rows='5'></textarea></Td></Tr>";

echo "<tr>";
echo "<td align='right'>ไฟล์เอกสาร&nbsp;&nbsp;</td>";
echo "<td align='left'><input type = 'file' name = 'userfile' id= 'file'></td>";
echo "</tr>";

echo "</Table>";
echo "<Br>";
echo "<INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url(1)' class=entrybutton>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ย้อนกลับ' onclick='goto_url(0)' class=entrybutton'>";

echo "</form>";
}
//ส่วนยืนยันการลบข้อมูล
if($index==2) {
echo "<table width='500' border='0' align='center'>";
echo "<tr><td align='center'><font color='#990000' size='4'>โปรดยืนยันความต้องการลบข้อมูลอีกครั้ง</font><br></td></tr>";
echo "<tr><td align=center>";
echo "<INPUT TYPE='button' name='smb' value='ยืนยัน' onclick='location.href=\"?option=news&task=main/news&index=3&id=$_GET[id]&page=$_REQUEST[page]\"'>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ยกเลิก' onclick='location.href=\"?option=news&task=main/news&page=$_REQUEST[page]\"'";
echo "</td></tr></table>";
}
//ส่วนลบข้อมูล
if($index==3){
$sql = "delete from news_news where id=$_GET[id]";
$dbquery = mysql_query($sql);
}

//ส่วนเพิ่มข้อมูล
if($index==4){

$basename = basename($_FILES['userfile']['name']);
if ($basename!="")
{
$changed_name = file_upload();
}

$report_date=date("Y-m-d H:i:s");
$sql = "insert into news_news (report_date,news,file,section,mainitem_code,officer) values ('$report_date','$_POST[news]','$changed_name','$_POST[section]', '$item_active_result[code]','$officer')";
$dbquery = mysql_query($sql);
}
//ส่วนฟอร์มแก้ไขข้อมูล

if ($index==5){
echo "<form Enctype = multipart/form-data id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>แก้ไข</B></Font>";
echo "</Cener>";
echo "<Br><Br>";
$sql = "select * from  news_news where id='$_GET[id]'";
$dbquery = mysql_query($sql);
$result_ref = mysql_fetch_array($dbquery);

echo "<Table   width=70% Border=0 Bgcolor=#Fcf9d8>";
echo "<Tr align='left'><Td align='right'>ประเภท&nbsp;&nbsp;</Td>";
echo   "<td align='left'><Select name='section' size='1'>"; 
echo  "<option  value = ''>เลือก</option>" ;
$sql = "select * from  news_section where mainitem_code='$item_active_result[code]' order by code";
$dbquery = mysql_query($sql);
While ($result = mysql_fetch_array($dbquery))
   {
		$code = $result['code'];
		$name = $result['name'];
		if($code==$result_ref[section]){
		echo  "<option value=$code selected>$name</option>" ;
		}
		else{
		echo  "<option value=$code>$name</option>" ;
		}
	}
echo "</select>";
echo "</td></tr>";

echo "<Tr align='left'><Td align='right'>ข้อความ&nbsp;&nbsp;</Td><Td><textarea Name='news' cols='40' rows='5'>$result_ref[news]</textarea></Td></Tr>";

echo "<tr>";
echo "<td align='right'>ไฟล์เอกสาร&nbsp;&nbsp;</td>";
echo "<td align='left'><input type = 'file' name = 'userfile' id= 'file'></td>";
echo "</tr>";
echo "</Table>";
echo "<Br />";
echo "<Input Type=Hidden Name='id' Value='$_GET[id]'>";
echo "<Input Type=Hidden Name='page' Value='$_GET[page]'>";
echo "<INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url_update(1)' class=entrybutton>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ย้อนกลับ' onclick='goto_url_update(0)' class=entrybutton'>";

echo "</form>";
}
//ส่วนปรับปรุงข้อมูล
if ($index==6){
$report_date=date("Y-m-d H:i:s");
		if($_FILES['userfile']['name']==""){
		$sql = "update news_news set report_date='$report_date', section='$_POST[section]', news='$_POST[news]' where id='$_POST[id]'";
		$dbquery = mysql_query($sql);
		}
		else{
		// ป้องกันไฟล์นามสกุล 4 ตัว
		$basename = basename($_FILES['userfile']['name']);
		$surname = explode(".", $basename);
		$surname_len=strlen($surname[1]);
		$changed_name = file_upload();
		$sql = "update news_news set report_date='$report_date', section='$_POST[section]', news='$_POST[news]',file='$changed_name' where id='$_POST[id]'";
		$dbquery = mysql_query($sql);
		}
}


//ส่วนการแสดงผล
if(!(($index==1) or ($index==2) or ($index==5))){

//ส่วนของการแยกหน้า
$pagelen=15;  // 1_กำหนดแถวต่อหน้า
$url_link="option=news&task=main/news";  // 2_กำหนดลิงค์ฺ
$sql = "select * from news_news where mainitem_code='$item_active_result[code]'"; // 3_กำหนด sql

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

$sql = "select * from news_news where mainitem_code='$item_active_result[code]' order by id  limit $start,$pagelen";
$dbquery = mysql_query($sql);
echo  "<table width=95% border=0 align=center>";
echo "<Tr><Td colspan='6' align='left'><INPUT TYPE='button' name='smb' value='เพิ่มข้อมูล' onclick='location.href=\"?option=news&task=main/news&index=1\"'>";
echo "</Td></Tr>";
echo "<Tr bgcolor=#FFCCCC align='center'><Td width='50'>ที่</Td><Td width='150'>วดป</Td><Td width='170'>ประเภท</Td><Td>ข่าว</Td><Td width='50'>File</Td><Td width='50'>ลบ</Td><Td width='50'>แก้ไข</Td></Tr>";
$N=(($page-1)*$pagelen)+1;  //*เกี่ยวข้องกับการแยกหน้า
$M=1;
While ($result = mysql_fetch_array($dbquery))
	{
		$id = $result['id'];
		$report_date=$result['report_date'];
		$section= $result['section'];
		$news = $result['news'];
		$file = $result['file'];
			if(($M%2) == 0)
			$color="#FFFFC";
			else  	$color="#FFFFFF";

		echo "<Tr bgcolor='$color' align='center'><Td>$N</Td><td>$report_date</td><Td align='left'>$section_ar[$section]</Td><Td align='left'>$news</Td>";
if($file!=""){
echo   "<Td><a href='$file' target=_blank><IMG SRC='images/b_browse.png' width='16' height='16' border=0 alt='เอกสาร'></a></td>";
}
else{
echo "<Td align='left'>&nbsp;</Td>";
}
if($officer==$result['officer']){
echo "<Td><div align='center'><a href=?option=news&task=main/news&index=2&id=$id&page=$page><img src=images/drop.png border='0' alt='ลบ'></a></div></Td>
		<Td><a href=?option=news&task=main/news&index=5&id=$id&page=$page><img src=images/edit.png border='0' alt='แก้ไข'></a></div></Td>";
}
else{
echo "<Td align='left'>&nbsp;</Td><Td align='left'>&nbsp;</Td>";
}		
echo "</Tr>";
$M++;
$N++;  //*เกี่ยวข้องกับการแยกหน้า
	}
echo "</Table>";
}

?>
<script>
function goto_url(val){
	if(val==0){
		callfrm("?option=news&task=main/news");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.section.value == ""){
			alert("กรุณาเลือกประเภท");
		}else if(frm1.news.value==""){
			alert("กรุณาพิมพ์ข้อความ");
		}else{
			callfrm("?option=news&task=main/news&index=4");   //page ประมวลผล
		}
	}
}

function goto_url_update(val){
	if(val==0){
		callfrm("?option=news&task=main/news");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.section.value == ""){
			alert("กรุณาเลือกประเภท");
		}else if(frm1.news.value==""){
			alert("กรุณพิมพ์ข้อความ");
		}else{
			callfrm("?option=news&task=main/news&index=6");   //page ประมวลผล
		}
	}
}
</script>
