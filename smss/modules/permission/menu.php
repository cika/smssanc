<?php	
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
//sd page 

$sql_permission = "select * from permission_permission where person_id='$_SESSION[login_user_id]'";
$dbquery_permission = mysql_query($sql_permission);
$result_permission = mysql_fetch_array($dbquery_permission);

if(!isset($_SESSION['admin_permission'])){
$_SESSION['admin_permission']="";
}

echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>"; 
echo "<tr bgcolor='#FFCC00'><td>";
echo "<ul id='nav' class='dropdown dropdown-horizontal'>";
	echo "<li><a href='./'>รายการหลัก</a></li>";
	if(($_SESSION['admin_permission']=="permission") or ($_SESSION['login_status']<=4 and $result_permission['p1']==1)){	
	echo "<li><a href='?option=permission' class='dir'>ตั้งค่าระบบ</a>";
		echo "<ul>";
			if($_SESSION['admin_permission']=="permission"){
			echo "<li><a href='?option=permission&task=permission'>กำหนดเจ้าหน้าที่</a></li>";
			}
			echo "<li><a href='?option=permission&task=set_grant_person'>กำหนดผู้อนุมัติ</a></li>";
			
		echo "</ul>";
	echo "</li>";
	}
	
	if($_SESSION['login_status']<=4){	
	echo "<li><a href='?option=permission' class='dir'>ขออนุญาตไปราชการ</a>";
		echo "<ul>";
			echo "<li><a href='?option=permission&task=main/permission_main'>บันทึกขออนุญาตไปราชการ</a></li>";
			echo "<li><a href='?option=permission&task=main/basic_comment'>ผู้บังคับบัญชาขั้นต้น</a></li>";
			echo "<li><a href='?option=permission&task=main/grant'>ผู้บังคับบัญชา (ผู้อนุมัติ)</a></li>";
	echo "</ul>";
	echo "</li>";
	}	
	
	if($_SESSION['login_status']<=5){	
	echo "<li><a href='?option=permission' class='dir'>รายงาน</a>";
		echo "<ul>";
			echo "<li><a href='?option=permission&&task=main/report_1'>ขออนุญาตฯวันนี้</a></li>";
			echo "<li><a href='?option=permission&&task=main/report_2'>ขออนุญาตฯทั้งหมด</a></li>";
			echo "<li><a href='?option=permission&&task=main/print_report'>พิมพ์การขออนุญาตฯ</a></li>";
		echo "</ul>";
	echo "</li>";
	}
	echo "</li>";
	echo "<li><a href='?option=permission' class='dir'>คู่มือ</a>";
		echo "<ul>";
			echo "<li><a href='modules/permission/manual/permission.pdf' target='_blank'>เอกสารคู่มือ</a></li>";
		echo "</ul>";
	echo "</li>";
echo "</ul>";
echo "</td></tr>";
echo "</table>";
?>
