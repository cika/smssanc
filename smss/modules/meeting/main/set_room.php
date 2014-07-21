<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
if($_SESSION['admin_meeting']!="meeting"){
exit();
}
//ส่วนหัว
echo "<br />";
if(!(($index==1) or ($index==2) or ($index==5))){
echo "<table width='50%' border='0' align='center'>";
echo "<tr align='center'><td><font color='#006666' size='3'><strong>กำหนดห้องประชุม</strong></font></td></tr>";
echo "</table>";
echo "<br>";
}

//ส่วนฟอร์มแก้ไขข้อมูล
if ($index==5){
echo "<form id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>แก้ไข การกำหนดห้องประชุม</B></Font>";
echo "</Cener>";
echo "<Br><Br>";
echo "<Table width='50%' Border= '0' Bgcolor='#Fcf9d8'>";
$sql = "select * from meeting_room where id='$_GET[id]'";
$dbquery = mysql_query($sql);
$ref_result = mysql_fetch_array($dbquery);
			if($ref_result['active']==1){
			$active_check1="checked";
			$active_check2="";
			}
			else{
			$active_check1="";
			$active_check2="checked";
			}
echo "<Tr align='left'><Td align='right'>ชื่อห้องประชุม&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='room_name' Size='30' value='$ref_result[room_name]'></Td></Tr>";
echo   "<tr><td align='right'>เปิด/ปิด การใช้ห้องประชุม&nbsp;&nbsp;</td>";
echo   "<td align='left'><input  type=radio name='active' value='1' $active_check1>เปิดใช้งาน&nbsp;&nbsp;<input  type=radio name='active' value='0' $active_check2>ปิดใช้งาน</td></tr>";

echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
echo "<tr><td align='right'><INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url_update(1)' class=entrybutton>&nbsp;&nbsp;</td>";
echo "<td align='left'><INPUT TYPE='button' name='back' value='ย้อนกลับ' onclick='goto_url_update(0)' class=entrybutton'></td></tr>";
echo "</Table>";
echo "<Br>";
echo "<Input Type=Hidden Name='id' Value='$_GET[id]'>";
echo "</form>";
}

//ส่วนปรับปรุงข้อมูล
if ($index==6){
$sql = "update meeting_room  set  room_name='$_POST[room_name]', active='$_POST[active]' where id='$_POST[id]'";
$dbquery = mysql_query($sql);
}

//ส่วนแสดงผล
if(!(($index==1) or ($index==2) or ($index==5))){

$sql= "select * from meeting_room order by id";
$dbquery = mysql_query( $sql);
echo  "<table width=50% border=0 align=center>";
echo "<Tr bgcolor='#FFCCCC'><Td  align='center'>ที่</Td><Td  align='center' >ชื่อห้องประชุม</Td><td align='center'>สถานะ</td><Td align='center' width='50'>แก้ไข</Td></Tr>";
$M=1;
While ($result = mysql_fetch_array($dbquery))
	{
		$id = $result['id'];
		$room_code = $result['room_code'];
		$room_name = $result['room_name'];
		$active = $result['active'];
			if($active==1){
			$active_text="<font color='#0033FF'>เปิดใช้งาน</font>";
			}
			else{
			$active_text="<font color='#FF0033'>ปิดใช้งาน</font>";
			}
		
			if(($M%2) == 0)
			$color="#FFFFC";
			else $color="#FFFFFF";
		echo "<Tr bgcolor=$color><Td align='center' width='50'>$M</Td><Td  align='left'>$room_name </Td><Td align='center'>$active_text</Td>
		
		<Td align='center' width='50'><a href=?option=meeting&task=main/set_room&index=5&id=$id><img src=images/edit.png border='0' alt='แก้ไข'></a></Td>
	</Tr>";
$M++;
	}
echo "</Table>";
}
?>
<script>
function goto_url_update(val){
	if(val==0){
		callfrm("?option=meeting&task=main/set_room");   // page ย้อนกลับ 
	}else if(val==1){
		callfrm("?option=meeting&task=main/set_room&index=6");   //page ประมวลผล
	}
}
</script>
