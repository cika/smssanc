<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
//sd page 
$user=$_SESSION['login_user_id'];
echo "<br />";
if(!(($index==1) or ($index==1.1) or ($index==2) or ($index==2.1) or ($index==5) or ($index==5.1))){
echo "<table width='50%' border='0' align='center'>";
echo "<tr align='center'><td><font color='#006666' size='3'><strong>ตู้เอกสารส่วนบุคคล</strong></font></td></tr>";
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
echo "<Tr align='left'><Td align='right'>ชื่อลิ้นชัก&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='tray_name'  Size='60' value='$_SESSION[login_name]_$_SESSION[login_surname]' readonly></Td></Tr>";
echo "<Input Type=Hidden Name='cabinet_id' Value='$ref_result[cabinet_id]'>";
echo "<Br>";
echo "</Table>";
echo "<Br>";
echo "<INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url(1)' class=entrybutton>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ย้อนกลับ' onclick='goto_url(0)' class=entrybutton'>";
echo "</form>";
echo "<br /><br /><br />";
echo "<div align='left'>";
echo "&nbsp;&nbsp;&nbsp;<b>หมายเหตุ</b>";
echo "&nbsp;&nbsp;&nbsp;บุคลากรในหน่วยงาน สามารถมีลิ้นชักของตนเองได้คนละ 1 ลิ้นชัก<br />";
echo "</div>";
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
echo "<INPUT TYPE='button' name='smb' value='ยืนยัน' onclick='location.href=\"?option=cabinet&task=main/private_tray_set&index=3&id=$_GET[id]\"'>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ยกเลิก' onclick='location.href=\"?option=cabinet&task=main/private_tray_set\"'";
echo "</td></tr></table>";
}

if($index==2.1) {
echo "<table width='800' border='0' align='center'>";
echo "<tr><td align='center'><font color='#990000' size='3'>จะทำการลบเพียงรายการแฟ้มเท่านั้น  ยังคงข้อมูลรายการเอกสารไว้ในระบบ</font><br></td></tr>";
echo "<tr><td align='center'><font color='#990000' size='4'>โปรดยืนยันความต้องการลบข้อมูลอีกครั้ง</font><br></td></tr>";
echo "<tr><td align=center>";
echo "<INPUT TYPE='button' name='smb' value='ยืนยัน' onclick='location.href=\"?option=cabinet&task=main/private_tray_set&index=3.1&id=$_GET[id]\"'>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ยกเลิก' onclick='location.href=\"?option=cabinet&task=main/private_tray_set\"'";
echo "</td></tr></table>";
}

//ส่วนลบข้อมูล
if($index==3){
$sql = "delete from cabinet_tray where  id='$_GET[id]'";
$dbquery = mysql_query($sql);
}

if($index==3.1){
$sql = "delete from cabinet_file where  id='$_GET[id]'";
$dbquery = mysql_query($sql);
}

//ส่วนเพิ่มข้อมูล
if($index==4){
$sql = "select * from cabinet_tray where  tray_id='$user' and cabinet_id='$_POST[cabinet_id]' ";
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
			$sql = "insert into cabinet_tray (tray_id, cabinet_id, tray_name) values ( '$user', '$_POST[cabinet_id]', '$_POST[tray_name]')";
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
echo "<INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url_update_2(1)' class=entrybutton>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ย้อนกลับ' onclick='goto_url_update_2(0)' class=entrybutton'>";
echo "</form>";
}

//ส่วนปรับปรุงข้อมูล
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

$sql = "select cabinet_cabinet.id, cabinet_cabinet.cabinet_id, cabinet_cabinet.cabinet_name, cabinet_cabinet.cabinet_size, cabinet_cabinet.tray_size, cabinet_cabinet.cabinet_person, person_main.prename, person_main.name, person_main.surname  from cabinet_cabinet  left join person_main on cabinet_cabinet.cabinet_person=person_main.person_id  where  cabinet_cabinet.cabinet_type='2' order by cabinet_id  limit 1";
$dbquery = mysql_query($sql);
echo  "<table width='95%' border='0' align='center'>";
echo "<Tr bgcolor='#FFCCCC' align='center' ><Td rowspan='2' width='70'>เลขที่ตู้</Td><Td rowspan='2' >ตู้เอกสาร</Td><Td rowspan='2' >ลิ้นชัก</Td><Td rowspan='2' >แฟ้ม</Td><Td  rowspan='2' width='100'>ขนาด(MB)</Td><Td  rowspan='2'  width='200'>ผู้จัดการตู้</Td><Td  colspan='2'>ลิ้นชัก</Td><Td colspan='2'>แฟ้ม</Td></Tr>";
echo "<Tr bgcolor=#FFCCCC align='center' ><Td width='50'>เพิ่ม</Td><Td width='60'>แก้ไข/ลบ</Td><Td width='50'>เพิ่ม</Td><Td width='60'>แก้ไข/ลบ</Td></Tr>";
		While ($result = mysql_fetch_array($dbquery)){
		$id = $result['id'];
echo "<Tr  bgcolor='#CCCCCC' align='center'><Td>$result[cabinet_id]</Td><td colspan='3' align='left'>$result[cabinet_name]</td><Td align='center'>$result[cabinet_size]</Td> <Td align='left'>$result[prename]$result[name]&nbsp;$result[surname]</Td>";
								///////////////////////////////////////แทรกส่วนลิ้นชัก
								$sql_tray = "select  * from cabinet_tray  where  cabinet_id='$result[cabinet_id]'  and  tray_id='$user' order by id ";
								$dbquery_tray= mysql_query($sql_tray);
								$tray_num=mysql_num_rows($dbquery_tray);
								//////////////////////////////////////////
			if(	$tray_num<1){		
			echo "<Td><a href=?option=cabinet&task=main/private_tray_set&index=1&id=$id><img src=images/edit.png border='0' alt='เพิ่ม'></a></Td>";
			}
			else{
			echo "<Td></Td>";
			}
echo "<Td></Td><Td></Td><Td></Td></Tr>";
///จบส่วนตู้
			
			//ส่วนลิ้นชัก
			While ($result_tray = mysql_fetch_array($dbquery_tray)){
			echo "<Tr  bgcolor='#99FFFF' align='center'><Td></Td><td></td><td colspan='2' align='left'>$result_tray[tray_name]</td><Td align='center'>$result[tray_size]</Td><Td></Td><Td></Td>";
			if(	$tray_num==1){		
			echo "<Td><a href=?option=cabinet&task=main/private_tray_set&index=2&id=$result_tray[id]><img src=images/drop.png border='0' alt='ลบ'></a></Td>";
			}
			else {
			echo "<Td></Td>";
			}
									/////////////////////////แทรกส่วนแฟ้ม
								$sql_file = "select  * from cabinet_file  where  cabinet_id='$result[cabinet_id]' and  tray_id='$user' order by file_id";
								$dbquery_file= mysql_query($sql_file);
								$file_num=mysql_num_rows($dbquery_file);
									/////////////////////////////////////////////////
				if(	$file_num<15){						
				echo "<Td><a href=?option=cabinet&task=main/private_tray_set&index=1.1&cabinet_id=$result_tray[cabinet_id]&tray_id=$result_tray[tray_id]><img src=images/edit.png border='0' alt='เพิ่ม'></Td>";		
				}
				else{
				echo "<Td></Td>";
				}
			echo "<Td></Td></Tr>";
			//จบส่วนลิ้นชัก
			
							//ส่วนแฟ้ม
							$F=1;
							While ($result_file = mysql_fetch_array($dbquery_file)){
							if(($F%2) == 0)
							$Fcolor="#FFFFFF";
							else  $Fcolor="#FFFFC";
							echo "<Tr  bgcolor='$Fcolor' align='center'><Td></Td><td></td><td></td><td colspan='3' align='left'>แฟ้มเลขที่&nbsp;$result_file[file_id]&nbsp;$result_file[file_name]</td><Td></Td><Td></Td><Td></Td>";
							echo "<Td><a href=?option=cabinet&task=main/private_tray_set&index=5.1&id=$result_file[id]><img src=images/edit.png border='0' alt='แก้ไข'></a>&nbsp;<a href=?option=cabinet&task=main/private_tray_set&index=2.1&id=$result_file[id]><img src=images/drop.png border='0' alt='ลบ'></a></Td>";
							echo "</Tr>";
							$F++;
							}	//จบส่วนแฟ้ม
					} //จบส่วนลิ้นชัก		
		} //จบส่วนตู้					
echo "</Table>";
}//ส่วน index

?>
<script>
function goto_url(val){
	if(val==0){
		callfrm("?option=cabinet&task=main/private_tray_set");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.tray_name.value==""){
			alert("กรุณากรอกชื่อลิ้นชัก");
		}else{
			callfrm("?option=cabinet&task=main/private_tray_set&index=4");   //page ประมวลผล
		}
	}
}

function goto_url_2(val){
	if(val==0){
		callfrm("?option=cabinet&task=main/private_tray_set");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.file_id.value == ""){
			alert("กรุณากรอกเลขที่แฟ้ม");
		} else if(frm1.file_name.value==""){
			alert("กรุณากรอกชื่อแฟ้ม");
		}else{
			callfrm("?option=cabinet&task=main/private_tray_set&index=4.1");   //page ประมวลผล
		}
	}
}

function goto_url_update_2(val){
	if(val==0){
		callfrm("?option=cabinet&task=main/private_tray_set");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.file_id.value == ""){
			alert("กรุณากรอกเลขที่แฟ้ม");
		}else if(frm1.file_name.value==""){
			alert("กรุณากรอกชื่อแฟ้ม");
		}else{
			callfrm("?option=cabinet&task=main/private_tray_set&index=6.1");   //page ประมวลผล
		}
	}
}
</script>
