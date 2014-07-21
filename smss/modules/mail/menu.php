<?php 	
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
//sd page 

$sql_permission = "select * from  mail_permission where person_id='$_SESSION[login_user_id]'";
$dbquery_permission = mysql_query($sql_permission);
$result_permission = mysql_fetch_array($dbquery_permission);

if(!isset($_SESSION['admin_mail'])){
$_SESSION['admin_mail']="";
}

echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>"; 
echo "<tr bgcolor='#FFCC00'><td>";
echo "<ul id='nav' class='dropdown dropdown-horizontal'>";
	echo "<li><a href='./'>รายการหลัก</a></li>";
	if($_SESSION['admin_mail']=="mail"){
	echo "<li><a href='?option=mail' class='dir'>ตั้งค่าระบบ</a>";
		echo "<ul>";
			echo "<li><a href='?option=mail&task=main/permission'>กำหนดเจ้าหน้าที่</a></li>";
			echo "<li><a href='?option=mail&task=main/group'>กำหนดกลุ่มบุคลากร</a></li>";
			echo "<li><a href='?option=mail&task=main/group_member'>กำหนดสมาชิกกลุ่มบุคลากร</a></li>";
			echo "<li><a href='?option=mail&task=main/group_member_report'>รายงานกลุ่มและสมาชิก</a></li>";
		echo "</ul>";
	echo "</li>";
	}
	if($_SESSION['login_status']<=4){	
	echo "<li><a href='?option=mail&task=main/receive' class='dir'>ทะเบียนรับ</a>";
		echo "<ul>";
			echo "<li><a href='?option=mail&task=main/receive'>ทะเบียนจดหมายรับมา</a></li>";
	echo "</ul>";
	echo "</li>";

	echo "<li><a href='?option=mail&task=main/send' class='dir'>ทะเบียนส่ง</a>";
		echo "<ul>";
			echo "<li><a href='?option=mail&task=main/send'>ทะเบียนจดหมายส่งไป</a></li>";
		echo "</ul>";
	echo "</li>";
	echo "<li><a href='?option=mail&task=main/send&index=1' class='dir'>เขียนจดหมาย</a>";
	echo "</li>";
	}
	
	echo "<li><a href='?option=mail' class='dir'>คู่มือ</a>";
		echo "<ul>";
				echo "<li><a href='modules/mail/manual/mail.pdf' target='_blank'>คู่มือไปรษณีย์</a></li>";
		echo "</ul>";
	echo "</li>";
echo "</ul>";
echo "</td></tr>";
echo "</table>";
?>
