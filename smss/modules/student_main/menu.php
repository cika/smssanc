<?php	
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
//sd page 

$sql_permission = "select * from student_main_permission where person_id='$_SESSION[login_user_id]'";
$dbquery_permission = mysql_query($sql_permission);
$result_permission = mysql_fetch_array($dbquery_permission);

echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>";
echo "<tr bgcolor='#FFCC00'><td>";
echo "<ul id='nav' class='dropdown dropdown-horizontal'>";
	echo "<li><a href='./'>รายการหลัก</a></li>";
	if(isset($_SESSION['admin_student_main'])=="student_main"){
	echo "<li><a href='?option=student_main' class='dir'>ตั้งค่าระบบ</a>";
		echo "<ul>";
			echo "<li><a href='?option=student_main&task=ed_year'>ปีการศึกษา</a></li>";
			echo "<li><a href='?option=student_main&task=school_class'>ชั้นเรียน</a></li>";
			echo "<li><a href='?option=student_main&task=permission'>กำหนดเจ้าหน้าที่</a></li>";
			echo "<li><a href='?option=student_main&task=student_import'>นำเข้าข้อมูลนักเรียนจาก Text File</a></li>";
		echo "</ul>";
	echo "</li>";
	}
	if(((isset($_SESSION['admin_student_main'])=="student_main") or ($_SESSION['login_status']<=4) and $result_permission['p1']==1)){	
	echo "<li><a href='?option=student_main' class='dir'>ข้อมูลนักเรียน</a>";
		echo "<ul>";
			echo "<li><a href='?option=student_main&task=student'>ข้อมูลพื้นฐานนักเรียน</a></li>";
			echo "<li><a href='?option=student_main&task=class_log'>ประวัติชั้นเรียนของนักเรียน</a></li>";
	echo "</ul>";
	echo "</li>";
	}
	
	if(((isset($_SESSION['admin_student_main'])=="student_main") or ($_SESSION['login_status']<=4) and $result_permission['p1']==1)){	
	echo "<li><a href='?option=student_main' class='dir'>เปลี่ยนแปลงสถานะ</a>";
		echo "<ul>";
			echo "<li><a href='?option=student_main&task=finish'>นักเรียนจบการศึกษา</a></li>";
			echo "<li><a href='?option=student_main&task=promote'>เลื่อนชั้นเรียน</a></li>";
			echo "<li><a href='?option=student_main&task=tranfer'>นักเรียนย้ายโรงเรียน</a></li>";
			echo "<li><a href='?option=student_main&task=drop'>นักเรียนออกกลางคัน</a></li>";
	echo "</ul>";
	echo "</li>";
	}
	
	if($_SESSION['login_status']<=4){	
	echo "<li><a href='?option=student_main' class='dir'>รายงาน</a>";
		echo "<ul>";
			echo "<li><a href='?option=student_main&task=student_report1'>ข้อมูลพื้นฐานนักเรียน</a></li>";
			echo "<li><a href='modules/student_main/export_to_excel.php' target='_blank'>ส่งออกข้อมูลเป็นไฟล์ Excel</a></li>";
		echo "</ul>";
	echo "</li>";
	}
	echo "<li><a href='?option=student_main' class='dir'>คู่มือ</a>";
		echo "<ul>";
			echo "<li><a href='modules/student_main/manual/student_main.pdf' target='_blank'>เอกสารคู่มือ</a></li>";
			echo "<li><a href='modules/student_main/manual/student.xls' target='_blank'>ตัวอย่างไฟล์ Excel</a></li>";
		echo "</ul>";
	echo "</li>";
echo "</ul>";
echo "</td></tr>";
echo "</table>";
?>