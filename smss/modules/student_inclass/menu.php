<?php	
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
//sd page 

echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>";
echo "<tr bgcolor='#FFCC00'><td>";
echo "<ul id='nav' class='dropdown dropdown-horizontal'>";
	echo "<li><a href='./'>รายการหลัก</a></li>";
	$ses='admin_'.$_GET[option];
if($_SESSION[$ses]==$_GET[option]){
	echo "<li><a href='?option=".$_GET[option]."' class='dir'>ตั้งค่าระบบ</a>";
		echo "<ul>";
			#echo "<li><a href='?option=".$_GET[option]."'>ปีการศึกษา</a></li>";
			echo "<li><a href='?option=".$_GET[option]."&task=set/period'>ปีการศึกษา/จำนวนคาบ</a></li>";
			echo "<li><a href='?option=".$_GET[option]."&task=set/permission'>ผู้รับผิดชอบ</a></li>";
		echo "</ul>";
	echo "</li>";
}	
if($_SESSION['login_status']<=4 ){#and $result_permission['p1']==1){	
	echo "<li><a href='?option=".$_GET[option]."' class='dir'>การเข้าชั้นเรียน</a>";
		echo "<ul>";
			echo "<li><a href='?option=".$_GET[option]."&task=main/check'>บันทึกการเข้าชั้นเรียน</a></li>";
			echo "<li><a href='?option=".$_GET[option]."&task=main/checkDays_ago'>บันทึกการเข้าเรียนย้อนหลัง</a></li>";
		echo "</ul>";
	echo "</li>";
} 
#if($_SESSION['login_status']<=4){	
	echo "<li><a href='?option=".$_GET[option]."' class='dir'>รายงาน</a>";
		echo "<ul>";
			echo "<li><a href='?option=".$_GET[option]."&task=main/report_today'>การเข้าเรียน (ประจำวัน)</a></li>";		
			#echo "<li><a href='?option=".$_GET[option]."&task=main/report_today2'>การเข้าเรียน2 (ประจำวัน)</a></li>";		
			//echo "<li><a href='?option=".$_GET[option]."&task=main/report_room'>การเข้าเรียน (ห้องเรียน)</a></li>";		
			echo "<li><a href='?option=".$_GET[option]."&task=main/report_person'>การเข้าเรียน (บุคคล/ห้องเรียน)</a></li>";		
		echo "</ul>";
	echo "</li>";
#}	

	#echo "<li><a href='?option=".$_GET[option]."&task=manual/manual' class='dir'>คู่มือ</a>";
	echo "<li><a href='?option=".$_GET[option]."' class='dir'>คู่มือ</a>";
/*		echo "<ul>";
			echo "<li><a href='?option=student_check&task=manual/abouts'>แนะนำระบบ</a></li>";
		echo "</ul>";*/
	echo "</li>";
echo "</ul>";
?>
</td></tr>
</table>