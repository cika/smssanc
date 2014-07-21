<?php	
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
//sd page 

$sql_permission = "select * from news_permission where person_id='$_SESSION[login_user_id]'";
$dbquery_permission = mysql_query($sql_permission);
$result_permission = mysql_fetch_array($dbquery_permission);

if(!isset($_SESSION['admin_news'])){
$_SESSION['admin_news']="";
}

echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>"; 
echo "<tr bgcolor='#FFCC00'><td>";
echo "<ul id='nav' class='dropdown dropdown-horizontal'>";
	echo "<li><a href='./'>รายการหลัก</a></li>";
	if($_SESSION['admin_news']=="news"){
	echo "<li><a href='?option=news' class='dir'>ตั้งค่าระบบ</a>";
		echo "<ul>";
			echo "<li><a href='?option=news&task=main/permission'>กำหนดเจ้าหน้าที่</a></li>";
			echo "<li><a href='?option=news&task=main/mainitem'>กำหนดชื่อเรื่อง</a></li>";
			echo "<li><a href='?option=news&task=main/section'>กำหนดประเภท</a></li>";
		echo "</ul>";
	echo "</li>";
	}
	if(($_SESSION['admin_news']=="news") or ($_SESSION['login_status']<=4 and $result_permission['p1']==1)){	
	echo "<li><a href='?option=news' class='dir'>บันทึกข่าว</a>";
		echo "<ul>";
			echo "<li><a href='?option=news&task=main/news'>บันทึกข่าวเรื่องปัจจุบัน</a></li>";
	echo "</ul>";
	echo "</li>";
	}	
	echo "<li><a href='?option=news' class='dir'>รายงาน</a>";
		echo "<ul>";
			echo "<li><a href='?option=news&task=main/report1'>รายงานข่าวเรื่องปัจจุบัน</a></li>";
			echo "<li><a href='modules/news/main/report2.php' target='_blank'>รายงานเรียกได้จากภายนอก SMSS</a></li>";
		echo "</ul>";
	echo "</li>";
	echo "<li><a href='?option=news' class='dir'>คู่มือ</a>";
		echo "<ul>";
				echo "<li><a href='modules/news/manual/news.pdf' target='_blank'>คู่มือการรายงานข่าว</a></li>";
		echo "</ul>";
	echo "</li>";
echo "</ul>";
echo "</td></tr>";
echo "</table>";
?>
