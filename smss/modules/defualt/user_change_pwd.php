<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );

if(isset($_POST['newpasswd'])){
$newpasswd = trim($_POST['newpasswd']);
$newpasswd = md5($newpasswd);
$sql = "update system_user set userpass = '$newpasswd' where person_id = '$_SESSION[login_user_id]' ";
$dbquery = mysql_query($sql);
$sql=$sql = "select * from system_user where userpass = '$newpasswd' and person_id='$_SESSION[login_user_id]' ";
$dbquery = mysql_query($sql);
$result = mysql_fetch_array($dbquery);
		if($result){
		echo "<script>alert('เปลี่ยนรหัสผ่านเรียบร้อยแล้ว'); document.location.href='index.php';</script>";
		exit();
		}
		else {
		echo "<script>alert('เกิดปัญหาบางอย่าง ไม่สามารถเปลี่ยนรหัสผ่านใหม่ได้'); document.location.href='index.php';</script>";
		exit();
		}
}
?>
<br><br>
<form id="frm1" name="frm1">
<table cellpadding='5' cellspacing='5' width='350' align='center' class='row2'>
	<tr><td colspan='3' height=10></td></tr>
	<tr><td colspan='3' align=center><font size='4'><b>เปลี่ยน Password</td></tr>
	<tr><td>&nbsp;</td>
		<td align='right'><b>รหัสผ่านใหม่&nbsp;&nbsp;</td><td  align='left'><input type="password" name="newpasswd"/></td>
	</tr>
	<tr>
	<td>&nbsp;</td>
		<td align='right'><b>รหัสผ่านใหม่(อีกครั้ง)&nbsp;&nbsp;</td><td align='left'><input type="password" name="renewpasswd"/></td>
	</tr>
	<tr align="center"><td colspan="2"  align="right"><input type="button" value="ตกลง" onclick="goto_url(1)"&nbsp;&nbsp;></td><td align="left"><INPUT TYPE="button" name="back" value="ย้อนกลับ" onclick="goto_url(0)" ></td></tr>
	<tr><td colspan=3 height=10></td></tr>
</table>
</form>	

<script>
function goto_url(val){
	if(val==0){
		callfrm("./");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.newpasswd.value==''){
			alert('กรุณากรอกรหัสผ่านใหม่ที่ต้องการ');
		}else if(frm1.renewpasswd.value==''){
			alert('กรุณากรอกยืนยันรหัสผ่านใหม่');
		}else if(frm1.newpasswd.value!=frm1.renewpasswd.value){
			alert("รหัสผ่านสองครั้งไม่ตรงกัน");
		}else{
			callfrm("?file=user_change_pwd");   //page ประมวลผล
		}
	}
}

</script>