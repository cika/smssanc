<?php	
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );

$sql_permission = "select * from  meeting_permission where person_id='$_SESSION[login_user_id]'";
$dbquery_permission = mysql_query( $sql_permission);
$result_permission = mysql_fetch_array($dbquery_permission);

if(!isset($_SESSION['admin_meeting'])){
$_SESSION['admin_meeting']="";
}

echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>"; 
echo "<tr bgcolor='#FFCC00'><td>";
echo "<ul id='nav' class='dropdown dropdown-horizontal'>";
	echo "<li><a href='./'>รายการหลัก</a></li>";
	if($_SESSION['admin_meeting']=="meeting"){
	echo "<li><a href='?option=meeting' class='dir'>ตั้งค่าระบบ</a>";
		echo "<ul>";
			echo "<li><a href='?option=meeting&task=main/permission'>กำหนดเจ้าหน้าที่</a></li>";
			echo "<li><a href='?option=meeting&task=main/set_room'>กำหนดห้องประชุม</a></li>";
		echo "</ul>";
	echo "</li>";
	}
	if($_SESSION['login_status']<=4){	
	echo "<li><a href='?option=meeting' class='dir'>จองห้องประชุม</a>";
		echo "<ul>";
			echo "<li><a href='?option=meeting&task=main/meeting'>จองห้องประชุม</a></li>";
			if(($result_permission['p1']==1) or ($_SESSION['admin_meeting']=="meeting")){
			echo "<li><a href='?option=meeting&task=main/officer'>อนุญาตให้ใช้ห้องประชุม</a></li>";
			}
	echo "</ul>";
	echo "</li>";
	}	
	echo "<li><a href='?option=meeting' class='dir'>คู่มือ</a>";
		echo "<ul>";
				echo "<li><a href='modules/meeting/manual/meeting.pdf' target='_blank'>คู่มือจองห้องประชุม</a></li>";
		echo "</ul>";
	echo "</li>";
echo "</ul>";
echo "</td></tr>";
echo "</table>";
?>
