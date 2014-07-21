<?php	
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
//sd page 

$sql_permission = "select * from achievement_permission where person_id='$_SESSION[login_user_id]'";
$dbquery_permission = mysql_query($sql_permission);
$result_permission = mysql_fetch_array($dbquery_permission);

echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>"; 
echo "<tr bgcolor='#FFCC00'><td>";
echo "<ul id='nav' class='dropdown dropdown-horizontal'>";
	echo "<li><a href='./'>รายการหลัก</a></li>";
	if(isset($_SESSION['admin_achievement'])=="achievement"){
	echo "<li><a href='?option=achievement' class='dir'>ตั้งค่าระบบ</a>";
		echo "<ul>";
			echo "<li><a href='?option=achievement&task=main/permission'>กำหนดเจ้าหน้าที่</a></li>";
		echo "</ul>";
	echo "</li>";
	}
	if($_SESSION['login_status']<=4 and ($result_permission['p1']==1 or $result_permission['p2']==1 or $result_permission['p3']==1)){	
	echo "<li><a href='?option=achievement' class='dir'>บันทึกคะแนน</a>";
		echo "<ul>";
			if($result_permission['p1']==1){
			echo "<li><a href='?option=achievement&task=main/add_score_1'>บันทึกคะแนน O-NET</a></li>";
			}
			if($result_permission['p2']==1){
			echo "<li><a href='?option=achievement&task=main/add_score_2'>บันทึกคะแนน NT</a></li>";
			}
			if($result_permission['p3']==1){
			echo "<li><a href='?option=achievement&task=main/add_score_3'>บันทึกคะแนน LAST</a></li>";
			}
	echo "</ul>";
	echo "</li>";
	}	
	echo "<li><a href='?option=achievement' class='dir'>รายงาน(กราฟ)</a>";
		echo "<ul>";
			echo "<li><a href='?option=achievement&task=main/report1'>O-NET ป.6 แบบ 1</a></li>";
			echo "<li><a href='?option=achievement&task=main/report11'>O-NET ป.6 แบบ 2</a></li>";
			echo "<li><a href='?option=achievement&task=main/report2'>O-NET ม.3 แบบที่ 1</a></li>";
			echo "<li><a href='?option=achievement&task=main/report21'>O-NET ม.3 แบบ 2</a></li>";
			echo "<li><a href='?option=achievement&task=main/report3'>O-NET ม.6 แบบที่ 1</a></li>";
			echo "<li><a href='?option=achievement&task=main/report31'>O-NET ม.6 แบบที่ 2</a></li>";
			echo "<li><a href='?option=achievement&task=main/report4'>NT ป.3 แบบที่ 1</a></li>";
			echo "<li><a href='?option=achievement&task=main/report41'>NT ป.3 แบบที่ 2</a></li>";
			echo "<li><a href='?option=achievement&task=main/report5'>NT ม.2 แบบที่ 1</a></li>";
			echo "<li><a href='?option=achievement&task=main/report51'>NT ม.2 แบบที่ 2</a></li>";
			echo "<li><a href='?option=achievement&task=main/report6'>LAST ป.2 แบบที่ 1</a></li>";
			echo "<li><a href='?option=achievement&task=main/report61'>LAST ป.2 แบบที่ 2</a></li>";
			echo "<li><a href='?option=achievement&task=main/report7'>LAST ป.5 แบบที่ 1</a></li>";
			echo "<li><a href='?option=achievement&task=main/report71'>LAST ป.5 แบบที่ 2</a></li>";
		echo "</ul>";
	echo "</li>";
	echo "<li><a href='?option=achievement' class='dir'>รายงาน(ข้อมูล)</a>";
		echo "<ul>";
			echo "<li><a href='?option=achievement&task=main/report1_2'>O-NET ป.6</a></li>";
			echo "<li><a href='?option=achievement&task=main/report2_2'>O-NET ม.3</a></li>";
			echo "<li><a href='?option=achievement&task=main/report3_2'>O-NET ม.6 </a></li>";
			echo "<li><a href='?option=achievement&task=main/report4_2'>NT ป.3</a></li>";
			echo "<li><a href='?option=achievement&task=main/report5_2'>NT ม.2</a></li>";
			echo "<li><a href='?option=achievement&task=main/report6_2'>LAST ป.2</a></li>";
			echo "<li><a href='?option=achievement&task=main/report7_2'>LAST ป.5</a></li>";
		echo "</ul>";
	echo "</li>";
	echo "<li><a href='?option=achievement' class='dir'>คู่มือ</a>";
		echo "<ul>";
			echo "<li><a href='modules/achievement/manual/achievement.pdf' target='_blank'>เอกสารคู่มือ</a></li>";
		echo "</ul>";
	echo "</li>";
echo "</ul>";
echo "</td></tr>";
echo "</table>";
?>
