<?php	
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
//sd page 

$sql_permission = "select * from  bookregister_permission where person_id='$_SESSION[login_user_id]'";
$dbquery_permission = mysql_query($sql_permission);
$result_permission = mysql_fetch_array($dbquery_permission);

if(!isset($_SESSION['admin_bookregister'])){
$_SESSION['admin_bookregister']="";
}

echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>"; 
echo "<tr bgcolor='#FFCC00'><td>";
echo "<ul id='nav' class='dropdown dropdown-horizontal'>";
	echo "<li><a href='./'>รายการหลัก</a></li>";
	if($_SESSION['admin_bookregister']=="bookregister" or $result_permission['p1']==1){
	echo "<li><a href='?option=bookregister' class='dir'>ตั้งค่าระบบ</a>";
		echo "<ul>";
			echo "<li><a href='?option=bookregister&task=permission'>กำหนดเจ้าหน้าที่</a></li>";
			echo "<li><a href='?option=bookregister&task=year'>กำหนดปีปฏิทิน</a></li>";
			echo "<li><a href='?option=bookregister&task=main/office_no'>กำหนดเลขที่หนังสือ</a></li>";
			echo "<li><a href='?option=bookregister&task=main/cer_sign'>กำหนดผู้ลงนามเกียรติบัตร</a></li>";
			echo "<li><a href='?option=bookregister&task=cer_officer'>กำหนดผู้ตรวจสอบการลงทะเบียนเกียรติบัตร</a></li>";
		echo "</ul>";
	echo "</li>";
	}
	
if($_SESSION['login_status']<=4){
	echo "<li><a href='?option=bookregister&task=main/receive' class='dir'>ทะเบียนหนังสือรับ</a>";
		echo "<ul>";
			echo "<li><a href='?option=bookregister&task=main/receive'>ทะเบียนหนังสือรับ</a></li>";
		echo "</ul>";
	echo "</li>";

	echo "<li><a href='?option=bookregister&task=main/send' class='dir'>ทะเบียนหนังสือส่ง</a>";
		echo "<ul>";
			echo "<li><a href='?option=bookregister&task=main/send'>ทะเบียนหนังสือส่ง</a></li>";
		echo "</ul>";
	echo "</li>";
	echo "<li><a href='?option=bookregister&task=main/command' class='dir'>ทะเบียนคำสั่ง</a>";
		echo "<ul>";
			echo "<li><a href='?option=bookregister&task=main/command'>ทะเบียนคำสั่ง</a></li>";
		echo "</ul>";
	echo "</li>";
	echo "<li><a href='?option=bookregister&task=main/certificate' class='dir'>ทะเบียนเกียรติบัตร</a>";
		echo "<ul>";
			echo "<li><a href='?option=bookregister&task=main/certificate'>ทะเบียนเกียรติบัตร</a></li>";
			echo "<li><a href='?option=bookregister&task=main/certificate_officer'>เจ้าหน้าที่ทะเบียนเกียรติบัตร</a></li>";
		echo "</ul>";
	echo "</li>";
}	

	echo "<li><a href='?option=bookregister' class='dir'>คู่มือ</a>";
		echo "<ul>";
				echo "<li><a href='modules/bookregister/manual/bookregister.pdf' target='_blank'>คู่มือ</a></li>";
		echo "</ul>";
	echo "</li>";
echo "</ul>";
echo "</td></tr>";
echo "</table>";
?>
