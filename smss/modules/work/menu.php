<?php	
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
//sd page 

$sql_permission = "select * from work_permission where person_id='$_SESSION[login_user_id]'";
$dbquery_permission = mysql_query($sql_permission);
$result_permission = mysql_fetch_array($dbquery_permission);

if(!isset($_SESSION['admin_work'])){
$_SESSION['admin_work']="";
}


echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>"; 
echo "<tr bgcolor='#FFCC00'><td>";
echo "<ul id='nav' class='dropdown dropdown-horizontal'>";
	echo "<li><a href='./'>รายการหลัก</a></li>";
	if($_SESSION['admin_work']=="work"){
	echo "<li><a href='?option=work' class='dir'>ตั้งค่าระบบ</a>";
		echo "<ul>";
			echo "<li><a href='?option=work&task=permission'>กำหนดเจ้าหน้าที่</a></li>";
		echo "</ul>";
	echo "</li>";
	}
	if(($_SESSION['admin_work']=="work") or ($_SESSION['login_status']<=4 and $result_permission['p1']==1)){	
	echo "<li><a href='?option=work' class='dir'>บันทึกข้อมูล</a>";
		echo "<ul>";
			echo "<li><a href='?option=work&task=check'>บันทึกข้อมูลการปฏิบัติราชการวันนี้</a></li>";
			echo "<li><a href='?option=work&task=check_2'>บันทึกข้อมูลการปฏิบัติราชการย้อนหลัง</a></li>";
	echo "</ul>";
	echo "</li>";
	}	
	if($_SESSION['login_status']<=5){	
	echo "<li><a href='?option=work' class='dir'>รายงาน</a>";
		echo "<ul>";
			echo "<li><a href='?option=work&task=report_1'>สรุปการปฏิบัติราชการรายวัน</a></li>";
			echo "<li><a href='?option=work&task=report_2'>สรุปการปฏิบัติราชการรอบเดือน</a></li>";
		echo "</ul>";
	echo "</li>";
	}
	echo "</li>";
	echo "<li><a href='?option=work' class='dir'>คู่มือ</a>";
		echo "<ul>";
				echo "<li><a href='modules/work/manual/work.pdf' target='_blank'>คู่มือการปฏิบัติราชการ</a></li>";
		echo "</ul>";
	echo "</li>";
echo "</ul>";
echo "</td></tr>";
echo "</table>";
?>
