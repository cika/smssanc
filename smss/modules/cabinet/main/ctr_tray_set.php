<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
//sd page 
$user=$_SESSION['login_user_id'];
echo "<br />";

if(!(($index==1) or ($index==1.1) or ($index==2) or ($index==2.1) or ($index==5) or ($index==5.1))){
echo "<table width='50%' border='0' align='center'>";
echo "<tr align='center'><td><font color='#006666' size='3'><strong>ตู้เอกสารกลาง</strong></font></td></tr>";
echo "</table>";
}
//ส่วนเพิ่มข้อมูล
if($index==1){
$sql = "select * from  cabinet_cabinet where  id='$_GET[id]'";
$dbquery = mysql_query($sql);
$ref_result = mysql_fetch_array($dbquery);

echo "<form id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size='3'><B>เพิ่มลิ้นชัก</B></Font><br />";
echo "<Font color='#006666' Size='3'><B>ตู้เอกสาร$ref_result[cabinet_name]</B></Font>";
echo "</Cener>";
echo "<Br><Br>";
echo "<Table  width='50%' >";
echo "<Tr align='left'><Td align='right'>เลขที่ลิ้นชัก&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='tray_id'  Size='5'></Td></Tr>";
echo "<Tr align='left'><Td align='right'>ชื่อลิ้นชัก&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='tray_name'  Size='60'></Td></Tr>";
echo "<Input Type=Hidden Name='cabinet_id' Value='$ref_result[cabinet_id]'>";
echo "<Input Type=Hidden Name='page' Value='$_GET[page]'>";
echo "<Br>";
echo "</Table>";
echo "<Br>";
echo "<INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url(1)' class=entrybutton>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ย้อนกลับ' onclick='goto_url(0)' class=entrybutton'>";
echo "</form>";
}

if($index==1.1){
$sql_cabinet = "select * from  cabinet_cabinet where  cabinet_id='$_GET[cabinet_id]'";
$dbquery_cabinet = mysql_query($sql_cabinet);
$result_cabinet = mysql_fetch_array($dbquery_cabinet);
$sql_tray= "select * from  cabinet_tray where  cabinet_id='$_GET[cabinet_id]' and tray_id='$_GET[tray_id]' ";
$dbquery_tray = mysql_query($sql_tray);
$result_tray = mysql_fetch_array($dbquery_tray);
echo "<form id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size='3'><B>เพิ่มแฟ้ม</B></Font><br />";
echo "<Font color='#006666' Size='3'><B>ตู้เอกสาร$result_cabinet[cabinet_name]&nbsp;ลิ้นชัก$result_tray[tray_name]</B></Font><br />";
echo "</Cener>";
echo "<Br><Br>";
echo "<Table  width='50%' >";
echo "<Tr align='left'><Td align='right'>เลขที่แฟ้ม&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='file_id'  Size='5'></Td></Tr>";
echo "<Tr align='left'><Td align='right'>ชื่อแฟ้ม&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='file_name'  Size='60'></Td></Tr>";
echo "<Input Type=Hidden Name='cabinet_id' Value='$_GET[cabinet_id]'>";
echo "<Input Type=Hidden Name='tray_id' Value='$_GET[tray_id]'>";
echo "<Input Type=Hidden Name='page' Value='$_GET[page]'>";
echo "<Br>";
echo "</Table>";
echo "<Br>";
echo "<INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url_2(1)' class=entrybutton>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ย้อนกลับ' onclick='goto_url_2(0)' class=entrybutton'>";
echo "</form>";
}

//ส่วนยืนยันการลบข้อมูล
if($index==2) {
echo "<table width='800' border='0' align='center'>";
echo "<tr><td align='center'><font color='#990000' size='3'>จะทำการลบเพียงรายการลิ้นชักเท่านั้น  ยังคงข้อมูลรายการแฟ้มและเอกสารไว้ในระบบ</font><br></td></tr>";
echo "<tr><td align='center'><font color='#990000' size='4'>โปรดยืนยันความต้องการลบข้อมูลอีกครั้ง</font><br></td></tr>";
echo "<tr><td align=center>";
echo "<INPUT TYPE='button' name='smb' value='ยืนยัน' onclick='location.href=\"?option=cabinet&task=main/ctr_tray_set&index=3&id=$_GET[id]&page=$_REQUEST[page]\"'>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ยกเลิก' onclick='location.href=\"?option=cabinet&task=main/ctr_tray_set&page=$_REQUEST[page]\"'";
echo "</td></tr></table>";
}

if($index==2.1) {
echo "<table width='800' border='0' align='center'>";
echo "<tr><td align='center'><font color='#990000' size='3'>จะทำการลบเพียงรายการแฟ้มเท่านั้น  ยังคงข้อมูลรายการเอกสารไว้ในระบบ</font><br></td></tr>";
echo "<tr><td align='center'><font color='#990000' size='4'>โปรดยืนยันความต้องการลบข้อมูลอีกครั้ง</font><br></td></tr>";
echo "<tr><td align=center>";
echo "<INPUT TYPE='button' name='smb' value='ยืนยัน' onclick='location.href=\"?option=cabinet&task=main/ctr_tray_set&index=3.1&id=$_GET[id]&page=$_REQUEST[page]\"'>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ยกเลิก' onclick='location.href=\"?option=cabinet&task=main/ctr_tray_set&page=$_REQUEST[page]\"'";
echo "</td></tr></table>";
}

//ส่วนลบข้อมูล
if($index==3){
$sql = "delete from cabinet_tray where  id='$_GET[id]' ";
$dbquery = mysql_query($sql);
}

if($index==3.1){
$sql = "delete from cabinet_file where  id='$_GET[id]' ";
$dbquery = mysql_query($sql);
}

//ส่วนเพิ่มข้อมูล
if($index==4){
$sql = "select * from cabinet_tray where  tray_id='$_POST[tray_id]' and cabinet_id='$_POST[cabinet_id]' ";
$dbquery = mysql_query($sql);
if(mysql_num_rows($dbquery)>=1){
echo "<br /><div align='center'>เลขที่ลิ้นชักซ้ำกับที่มีอยู่แล้ว ตรวจสอบอีกครั้ง</div>";
exit();  
}

//หาขนาดตู้
$sql_cabinet = "select cabinet_size, tray_size  from cabinet_cabinet where  cabinet_id='$_POST[cabinet_id]' ";
$dbquery_cabinet = mysql_query($sql_cabinet);
$result_cabinet = mysql_fetch_array($dbquery_cabinet);
//หาพื้นที่ลิ้นชักที่กำหนดแล้ว

$sql_tray ="select  count(id)  as  tray_num  from cabinet_tray where  cabinet_id='$_POST[cabinet_id]' ";
$dbquery_tray = mysql_query($sql_tray);
$result_tray = mysql_fetch_array($dbquery_tray);
			$cabinet_size=$result_cabinet['cabinet_size'];
			$tray_size=$result_cabinet['tray_size'];
			$tray_num=$result_tray['tray_num']+1;
			$total_tray_size=$tray_size*$tray_num;
			if($cabinet_size>=$total_tray_size){
			$sql = "insert into cabinet_tray (tray_id, cabinet_id, tray_name) values ( '$_POST[tray_id]', '$_POST[cabinet_id]', '$_POST[tray_name]')";
			$dbquery = mysql_query($sql);
			}
			else{
			echo "<div align='center'>ขนาดรวมของลิ้นชักเกินขนาดตู้  ติดต่อผู้จัดการตู้เอกสาร</div>";
			exit () ;
			}
}

if($index==4.1){
$sql = "select * from cabinet_file where  file_id='$_POST[file_id]'  and  tray_id='$_POST[tray_id]' and cabinet_id='$_POST[cabinet_id]' ";
$dbquery = mysql_query($sql);
if(mysql_num_rows($dbquery)>=1){
echo "<br /><div align='center'>เลขที่แฟ้มซ้ำกับที่มีอยู่แล้ว ตรวจสอบอีกครั้ง</div>";
exit();  
}
$sql = "insert into cabinet_file (file_id, tray_id, cabinet_id, file_name) values ( '$_POST[file_id]', '$_POST[tray_id]', '$_POST[cabinet_id]', '$_POST[file_name]')";
$dbquery = mysql_query($sql);
}

//ส่วนฟอร์มแก้ไขข้อมูล
if ($index==5){
echo "<form id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>แก้ไข</B></Font>";
echo "</Cener>";
echo "<Br><Br>";
$sql = "select * from  cabinet_tray where  id='$_GET[id]'";
$dbquery = mysql_query($sql);
$ref_result = mysql_fetch_array($dbquery);
echo "<Table  width='50%'>";
echo "<Tr align='left'><Td align='right'>เลขที่ลิ้นชัก&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='tray_id'  Size='5' value='$ref_result[tray_id]'></Td></Tr>";
echo "<Tr align='left'><Td align='right'>ชื่อลิ้นชัก&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='tray_name'  Size='60' value='$ref_result[tray_name]'></Td></Tr>";
echo "</Table>";
echo "<Br />";
echo "<Input Type=Hidden Name='id' Value='$_GET[id]'>";
echo "<Input Type=Hidden Name='cabinet_id' Value='$ref_result[cabinet_id]'>";
echo "<Input Type=Hidden Name='page' Value='$_GET[page]'>";
echo "<INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url_update(1)' class=entrybutton>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ย้อนกลับ' onclick='goto_url_update(0)' class=entrybutton'>";
echo "</form>";
}

if ($index==5.1){
echo "<form id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>แก้ไข</B></Font>";
echo "</Cener>";
echo "<Br><Br>";
$sql = "select * from  cabinet_file where  id='$_GET[id]'";
$dbquery = mysql_query($sql);
$ref_result = mysql_fetch_array($dbquery);
echo "<Table  width='50%'>";
echo "<Tr align='left'><Td align='right'>เลขที่แฟ้ม&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='file_id'  Size='5' value='$ref_result[file_id]'></Td></Tr>";
echo "<Tr align='left'><Td align='right'>ชื่อแฟ้ม&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='file_name'  Size='60' value='$ref_result[file_name]'></Td></Tr>";
echo "</Table>";
echo "<Br />";
echo "<Input Type=Hidden Name='id' Value='$_GET[id]'>";
echo "<Input Type=Hidden Name='cabinet_id' Value='$ref_result[cabinet_id]'>";
echo "<Input Type=Hidden Name='tray_id' Value='$ref_result[tray_id]'>";
echo "<Input Type=Hidden Name='page' Value='$_GET[page]'>";
echo "<INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url_update_2(1)' class=entrybutton>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ย้อนกลับ' onclick='goto_url_update_2(0)' class=entrybutton'>";
echo "</form>";
}

//ส่วนปรับปรุงข้อมูล
if ($index==6){
$sql = "select * from cabinet_tray  where  tray_id='$_POST[tray_id]'  and  cabinet_id='$_POST[cabinet_id]'  and  id!='$_POST[id]' ";
$dbquery = mysql_query($sql);
			if(mysql_num_rows($dbquery)>=1){
			echo "<br /><div align='center'>มีเลขที่ลิ้นชักซ้ำที่มีอยู่แล้ว ตรวจสอบอีกครั้ง</div>";
			exit();  
			}
$sql = "update  cabinet_tray set  tray_id='$_POST[tray_id]', 
tray_name='$_POST[tray_name]' 
where id='$_POST[id]'";
$dbquery = mysql_query($sql);
}

if ($index==6.1){
$sql = "select * from cabinet_file  where  file_id='$_POST[file_id]' and  tray_id='$_POST[tray_id]'  and  cabinet_id='$_POST[cabinet_id]'  and  id!='$_POST[id]' ";
$dbquery = mysql_query($sql);
			if(mysql_num_rows($dbquery)>=1){
			echo "<br /><div align='center'>มีเลขที่แฟ้มซ้ำที่มีอยู่แล้ว ตรวจสอบอีกครั้ง</div>";
			exit();  
			}
$sql = "update  cabinet_file  set  file_id='$_POST[file_id]', 
file_name='$_POST[file_name]' 
where id='$_POST[id]'";
$dbquery = mysql_query($sql);
}

//ส่วนการแสดงผล
if(!(($index==1) or ($index==1.1) or ($index==2) or ($index==2.1) or ($index==5) or ($index==5.1))){

//ส่วนของการแยกหน้า
$pagelen=1;  // 1_กำหนดแถวต่อหน้า
$url_link="option=cabinet&task=main/ctr_tray_set";  // 2_กำหนดลิงค์ฺ
$sql = "select * from  cabinet_cabinet where  cabinet_type='1'"; // 3_กำหนด sql

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

$sql = "select cabinet_cabinet.id, cabinet_cabinet.cabinet_id, cabinet_cabinet.cabinet_name, cabinet_cabinet.cabinet_size, cabinet_cabinet.tray_size, cabinet_cabinet.cabinet_person, person_main.prename, person_main.name, person_main.surname  from cabinet_cabinet  left join person_main on cabinet_cabinet.cabinet_person=person_main.person_id  where  cabinet_cabinet.cabinet_type='1' order by cabinet_id  limit $start,$pagelen";
$dbquery = mysql_query($sql);
echo  "<table width='95%' border='0' align='center'>";
echo "<Tr bgcolor='#FFCCCC' align='center' ><Td rowspan='2' width='70'>เลขที่ตู้</Td><Td rowspan='2' >ตู้เอกสาร</Td><Td rowspan='2' >ลิ้นชัก</Td><Td rowspan='2' >แฟ้ม</Td><Td  rowspan='2' width='100'>ขนาด(MB)</Td><Td  rowspan='2'  width='200'>ผู้จัดการ</Td><Td  colspan='2'>ลิ้นชัก</Td><Td colspan='2'>แฟ้ม</Td></Tr>";
echo "<Tr bgcolor=#FFCCCC align='center' ><Td width='50'>เพิ่ม</Td><Td width='60'>แก้ไข/ลบ</Td><Td width='50'>เพิ่ม</Td><Td width='60'>แก้ไข/ลบ</Td></Tr>";
$N=(($page-1)*$pagelen)+1;  //*เกี่ยวข้องกับการแยกหน้า
$M=1;
While ($result = mysql_fetch_array($dbquery))
	{
		$id = $result['id'];
echo "<Tr  bgcolor='#CCCCCC' align='center'><Td>$result[cabinet_id]</Td><td colspan='3' align='left'>$result[cabinet_name]</td><Td align='center'>$result[cabinet_size]</Td> <Td align='left'>$result[prename]$result[name]&nbsp;$result[surname]</Td>";
			if(	$result['cabinet_person']==$user){		
			echo "<Td><a href=?option=cabinet&task=main/ctr_tray_set&index=1&id=$id&page=$page><img src=images/edit.png border='0' alt='เพิ่ม'></a></Td>";
			}
			else{
			echo "<Td></Td>";
			}
echo "<Td></Td><Td></Td><Td></Td></Tr>";
			//ส่วนลิ้นชัก
			$sql_tray = "select  * from cabinet_tray  where  cabinet_id='$result[cabinet_id]' order by tray_id";
			$dbquery_tray= mysql_query($sql_tray);
			While ($result_tray = mysql_fetch_array($dbquery_tray)){
			echo "<Tr  bgcolor='#99FFFF' align='center'><Td></Td><td></td><td colspan='2' align='left'>ลิ้นชักเลขที่&nbsp;$result_tray[tray_id]&nbsp;$result_tray[tray_name]</td><Td align='center'>$result[tray_size]</Td><Td></Td><Td></Td>";
			if(	$result['cabinet_person']==$user){		
			echo "<Td><a href=?option=cabinet&task=main/ctr_tray_set&index=5&id=$result_tray[id]&page=$page><img src=images/edit.png border='0' alt='แก้ไข'></a>&nbsp;<a href=?option=cabinet&task=main/ctr_tray_set&index=2&id=$result_tray[id]&page=$page><img src=images/drop.png border='0' alt='ลบ'></a></Td>";
			echo "<Td><a href=?option=cabinet&task=main/ctr_tray_set&index=1.1&cabinet_id=$result_tray[cabinet_id]&tray_id=$result_tray[tray_id]&page=$page><img src=images/edit.png border='0' alt='เพิ่ม'></Td>";			}
			else{
			echo "<Td></Td><Td></Td>";
			}
			echo "<Td></Td></Tr>";
			//จบส่วนลิ้นชัก
							//ส่วนแฟ้ม
							$sql_file = "select  * from cabinet_file  where  cabinet_id='$result[cabinet_id]' and  tray_id='$result_tray[tray_id]' order by file_id";
							$dbquery_file= mysql_query($sql_file);
							$F=1;
							While ($result_file = mysql_fetch_array($dbquery_file)){
							if(($F%2) == 0)
							$Fcolor="#FFFFFF";
							else  $Fcolor="#FFFFC";
							echo "<Tr  bgcolor='$Fcolor' align='center'><Td></Td><td></td><td></td><td colspan='3' align='left'>แฟ้มเลขที่&nbsp;$result_file[file_id]&nbsp;$result_file[file_name]</td><Td></Td><Td></Td><Td></Td>";
										if(	$result['cabinet_person']==$user){		
										echo "<Td><a href=?option=cabinet&task=main/ctr_tray_set&index=5.1&id=$result_file[id]&page=$page><img src=images/edit.png border='0' alt='แก้ไข'></a>&nbsp;<a href=?option=cabinet&task=main/ctr_tray_set&index=2.1&id=$result_file[id]&page=$page><img src=images/drop.png border='0' alt='ลบ'></a></Td>";
										}
										else{
										echo "<Td></Td>";
										}
							echo "</Tr>";
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
		callfrm("?option=cabinet&task=main/ctr_tray_set");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.tray_id.value == ""){
			alert("กรุณากรอกเลขที่ลิ้นชัก");
		}else if(frm1.tray_name.value==""){
			alert("กรุณากรอกชื่อลิ้นชัก");
		}else{
			callfrm("?option=cabinet&task=main/ctr_tray_set&index=4");   //page ประมวลผล
		}
	}
}

function goto_url_2(val){
	if(val==0){
		callfrm("?option=cabinet&task=main/ctr_tray_set");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.file_id.value == ""){
			alert("กรุณากรอกเลขที่แฟ้ม");
		}else if(frm1.file_name.value==""){
			alert("กรุณากรอกชื่อแฟ้ม");
		}else{
			callfrm("?option=cabinet&task=main/ctr_tray_set&index=4.1");   //page ประมวลผล
		}
	}
}

function goto_url_update(val){
	if(val==0){
		callfrm("?option=cabinet&task=main/ctr_tray_set");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.tray_id.value == ""){
			alert("กรุณากรอกเลขที่ลิ้นชัก");
		}else if(frm1.tray_name.value==""){
			alert("กรุณากรอกชื่อลิ้นชัก");
		}else{
			callfrm("?option=cabinet&task=main/ctr_tray_set&index=6");   //page ประมวลผล
		}
	}
}

function goto_url_update_2(val){
	if(val==0){
		callfrm("?option=cabinet&task=main/ctr_tray_set");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.file_id.value == ""){
			alert("กรุณากรอกเลขที่แฟ้ม");
		}else if(frm1.file_name.value==""){
			alert("กรุณากรอกชื่อแฟ้ม");
		}else{
			callfrm("?option=cabinet&task=main/ctr_tray_set&index=6.1");   //page ประมวลผล
		}
	}
}
</script>
