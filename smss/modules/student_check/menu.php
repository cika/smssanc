<?php	
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
//sd page 

if(!isset($_SESSION['admin_student_check'])){
$_SESSION['admin_student_check']="";
}

echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>";
echo "<tr bgcolor='#FFCC00'><td>";
echo "<ul id='nav' class='dropdown dropdown-horizontal'>";
	echo "<li><a href='./'>รายการหลัก</a></li>";
if(@$_SESSION['admin_student_check']=="student_check"){
	echo "<li><a href='?option=student_check' class='dir'>ตั้งค่าระบบ</a>";
		echo "<ul>";
			echo "<li><a href='?option=student_check&task=set/year'>ปีการศึกษา</a></li>";
			echo "<li><a href='?option=student_check&task=set/permission'>ผู้รับผิดชอบ</a></li>";
		echo "</ul>";
	echo "</li>";
}	
if(@$_SESSION['login_status']<=4 ){#and $result_permission['p1']==1){	
	echo "<li><a href='?option=student_check' class='dir'>การมาเรียน</a>";
		echo "<ul>";
			echo "<li><a href='?option=student_check&task=main/check'>บันทึกการมาเรียนวันปัจจุบัน</a></li>";
			echo "<li><a href='?option=student_check&task=main/checkDays_ago'>บันทึกการมาเรียนย้อนหลัง</a></li>";
		echo "</ul>";
	echo "</li>";
} 
#if($_SESSION['login_status']<=4){	
	echo "<li><a href='?option=student_check' class='dir'>รายงาน</a>";
		echo "<ul>";
			echo "<li><a href='?option=student_check&task=main/report_today'>รายงานการมาเรียน (ประจำวัน)</a></li>";		
			echo "<li><a href='?option=student_check&task=main/report_room'>รายงานการมาเรียน (ห้องเรียน)</a></li>";		
			echo "<li><a href='?option=student_check&task=main/report_person'>รายงานการมาเรียน (บุคคล)</a></li>";		
		echo "</ul>";
	echo "</li>";
#}	

	echo "<li><a href='?option=student_check&task=manual/manual' class='dir'>คู่มือ</a>";
/*		echo "<ul>";
			echo "<li><a href='?option=student_check&task=manual/abouts'>แนะนำระบบ</a></li>";
if($_SESSION['admin_student_check']=="student_check"){			
			echo "<li><a href='?option=student_check&task=manual/setyear'>การตั้งค่าปีการศึกษา</a></li>";
			echo "<li><a href='?option=student_check&task=manual/setuser'>การกำหนดผู้รับผิดชอบ</a></li>";
}
			echo "<li><a href='?option=student_check&task=manual/save'>การบันทึกข้อมูล</a></li>";
			echo "<li><a href='?option=student_check&task=manual/report'>การเรียกดูรายงาน</a></li>";
		echo "</ul>";*/
	echo "</li>";
echo "</ul>";
?>
</td></tr>
</table>