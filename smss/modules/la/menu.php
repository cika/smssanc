<?php	
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
//sd page 

$sql_permission = "select * from la_permission where person_id='$_SESSION[login_user_id]'";
$dbquery_permission = mysql_query($sql_permission);
$result_permission = mysql_fetch_array($dbquery_permission);

if(!isset($_SESSION['admin_la'])){
$_SESSION['admin_la']="";
}

echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>"; 
echo "<tr bgcolor='#FFCC00'><td>";
echo "<ul id='nav' class='dropdown dropdown-horizontal'>";
	echo "<li><a href='./'>รายการหลัก</a></li>";
	if(($_SESSION['admin_la']=="la") or ($_SESSION['login_status']<=4 and $result_permission['p1']==1)){	
	echo "<li><a href='?option=la' class='dir'>ตั้งค่าระบบ</a>";
		echo "<ul>";
			echo "<li><a href='?option=la&task=budget_year'>กำหนดปีงบประมาณ</a></li>";
			echo "<li><a href='?option=la&task=permission'>กำหนดเจ้าหน้าที่</a></li>";
			echo "<li><a href='?option=la&task=set_grant_person'>กำหนดผู้อนุมัติ</a></li>";
			echo "<li><a href='?option=la&task=main/collection'>วันลาสะสม</a></li>";
		echo "</ul>";
	echo "</li>";
	}
	if($_SESSION['login_status']<=4){	
	echo "<li><a href='?option=la' class='dir'>ขออนุญาตลา</a>";
		echo "<ul>";
			echo "<li><a href='?option=la&task=main/la_main'>บันทึกขออนุญาตลา</a></li>";
			echo "<li><a href='?option=la&task=main/job_person'>รับมอบงาน</a></li>";
			if(($_SESSION['login_status']<=4 and $result_permission['p1']==1)){	
			echo "<li><a href='?option=la&task=main/la_officer_comment'>เจ้าหน้าที่การลา</a></li>";
			}
			echo "<li><a href='?option=la&task=main/basic_comment'>ผู้บังคับบัญชาขั้นต้น</a></li>";
			echo "<li><a href='?option=la&task=main/grant'>ผู้บังคับบัญชา (ผู้อนุมัติ)</a></li>";
	echo "</ul>";
	echo "</li>";
	}	
	if($_SESSION['login_status']<=4){	
	echo "<li><a href='?option=la' class='dir'>ขอยกเลิกวันลา</a>";
		echo "<ul>";
			echo "<li><a href='?option=la&task=main/la_cancel'>ขอยกเลิกวันลา</a></li>";
			if(($_SESSION['login_status']<=4 and $result_permission['p1']==1)){	
			echo "<li><a href='?option=la&task=main/cancel_la_officer_comment'>เจ้าหน้าที่การลา</a></li>";
			}
			echo "<li><a href='?option=la&task=main/cancel_basic_comment'>ผู้บังคับบัญชาขั้นต้น</a></li>";
			echo "<li><a href='?option=la&task=main/cancel_grant'>ผู้บังคับบัญชา (ผู้อนุมัติ)</a></li>";
	echo "</ul>";
	echo "</li>";
	}	
	echo "<li><a href='?option=la' class='dir'>รายงาน</a>";
		echo "<ul>";
			echo "<li><a href='?option=la&&task=main/report_1'>ขออนุญาตลาวันนี้</a></li>";
			echo "<li><a href='?option=la&&task=main/report_2'>ขออนุญาตลาทั้งหมด</a></li>";
			echo "<li><a href='?option=la&&task=main/report_3'>ขอยกเลิกวันลาทั้งหมด</a></li>";
			echo "<li><a href='?option=la&&task=main/report_4'>สถิติการลาป่วย กิจ คลอด</a></li>";
			echo "<li><a href='?option=la&&task=main/report_5'>สถิติการลาพักผ่่อน</a></li>";
		echo "</ul>";
	echo "</li>";
	echo "</li>";
	echo "<li><a href='?option=la' class='dir'>คู่มือ</a>";
		echo "<ul>";
				echo "<li><a href='modules/la/manual/la.pdf' target='_blank'>คู่มือการลา</a></li>";
		echo "</ul>";
	echo "</li>";
echo "</ul>";
echo "</td></tr>";
echo "</table>";
?>
