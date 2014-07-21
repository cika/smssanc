<?php	
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
//sd page 
$sql_permission = "select * from standard_permission where person_id='$_SESSION[login_user_id]'";
$dbquery_permission = mysql_query($sql_permission);
$result_permission = mysql_fetch_array($dbquery_permission);

echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>";
echo "<tr bgcolor='#FFCC00'><td>";
echo "<ul id='nav' class='dropdown dropdown-horizontal'>";
	echo "<li><a href='./'>รายการหลัก</a></li>";
		if(isset($_SESSION['admin_standard'])=="standard"){
	echo "<li><a href='?option=standard' class='dir'>ตั้งค่าระบบ</a>";
		echo "<ul>";
			echo "<li><a href='?option=standard&task=permission'>เจ้าหน้าที่มาตรฐานการศึกษา</a></li>";
		echo "</ul>";
	echo "</li>";
	}
	
	if((isset($_SESSION['admin_standard'])=="standard") or ($_SESSION['login_status']<=4 and $result_permission['p1']==1)){	
	echo "<li><a href='?option=standard' class='dir'>มาตรฐานการศึกษาปฐมวัย</a>";
		echo "<ul>";
			echo "<li><a href='?option=standard&task=elementary_sd'>มาตรฐานการศึกษา</a></li>";
			echo "<li><a href='?option=standard&task=elementary_indicator'>ตัวบ่งชี้</a></li>";
		echo "</ul>";
	echo "</li>";
	echo "<li><a href='?option=standard' class='dir'>มาตรฐานการศึกษาขั้นพื้นฐาน</a>";
		echo "<ul>";
			echo "<li><a href='?option=standard&task=basic_sd'>มาตรฐานการศึกษา</a></li>";
			echo "<li><a href='?option=standard&task=basic_indicator'>ตัวบ่งชี้</a></li>";
		echo "</ul>";
	echo "</li>";
	}
	echo "<li><a href='?option=standard' class='dir'>รายงาน</a>";
		echo "<ul>";
			echo "<li><a href='?option=standard&task=elementary_report'>มาตรฐานการศึกษาปฐมวัย</a></li>";
			echo "<li><a href='?option=standard&task=basic_report'>มาตรฐานการศึกษาขั้นพื้นฐาน</a></li>";
			if($_SESSION['login_status']<=4){	
			echo "<li><a href='?option=standard&task=elementary_report2'>กิจกรรมสนับสนุนมาตรฐานการศึกษาปฐมวัย</a></li>";
			echo "<li><a href='?option=standard&task=basic_report2'>กิจกรรมสนับสนุนมาตรฐานการศึกษาขั้นพื้นฐาน</a></li>";
			}
		echo "</ul>";
	echo "</li>";
	echo "<li><a href='?option=standard' class='dir'>คู่มือ</a>";
		echo "<ul>";
			echo "<li><a href='modules/standard/manual/standard.pdf' target='_blank'>เอกสารคู่มือ</a></li>";
		echo "</ul>";
	echo "</li>";
echo "</ul>";
echo "</td></tr>";
echo "</table>";
?>