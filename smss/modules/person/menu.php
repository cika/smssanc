<?php	
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
//sd page 

$sql_permission = "select * from person_permission where person_id='$_SESSION[login_user_id]'";
$dbquery_permission = mysql_query($sql_permission);
$result_permission = mysql_fetch_array($dbquery_permission);

if(isset($_SESSION['admin_person'])){
	$admin_person=$_SESSION['admin_person'];
}else{
	$admin_person=null;
	}

echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>"; 
echo "<tr bgcolor='#FFCC00'><td>";
echo "<ul id='nav' class='dropdown dropdown-horizontal'>";
	echo "<li><a href='./'>รายการหลัก</a></li>";
	if(($admin_person=="person") or ($_SESSION['login_status']==99) or ($_SESSION['login_status']<=4 and $result_permission['p1']==1)){	
	echo "<li><a href='?option=person' class='dir'>ตั้งค่าระบบ</a>";
		echo "<ul>";
			echo "<li><a href='?option=person&task=permission'>เจ้าหน้าที่ครูและบุคลากร</a></li>";
			echo "<li><a href='?option=person&task=position'>กำหนดตำแหน่งครูและบุคลากร</a></li>";
			echo "<li><a href='?option=person&task=person_import'>นำเข้าข้อมูลครูและบุคลากรจาก Text File</a></li>";
		echo "</ul>";
	echo "</li>";
	}
	
	if(($admin_person=="person") or ($_SESSION['login_status']==99) or ($_SESSION['login_status']<=4 and $result_permission['p1']==1)){	
	echo "<li><a href='?option=person' class='dir'>ครูและบุคลากรปัจจุบัน</a>";
		echo "<ul>";
			echo "<li><a href='?option=person&task=person'>ข้อมูลครูและบุคลากรปัจจุบัน</a></li>";
	echo "</ul>";
	echo "</li>";
	}	
	
	if(($admin_person=="person") or ($_SESSION['login_status']<=4 and $result_permission['p1']==1)){	
	echo "<li><a href='?option=person' class='dir'>ครูและบุคลากรในอดีต</a>";
		echo "<ul>";
			echo "<li><a href='?option=person&task=change_status_person'>ข้อมูลครูและบุคลากรในอดีต</a></li>";
	echo "</ul>";
	echo "</li>";
	}	
	
	echo "<li><a href='?option=person' class='dir'>รายงาน</a>";
		echo "<ul>";
			echo "<li><a href='?option=person&task=person_report1'>ข้อมูลครูและบุคลากร</a></li>";
		   if($_SESSION['login_status']<=4){	
			echo "<li><a href='modules/person/export_to_excel.php' target='_blank'>ส่งออกข้อมูลเป็นไฟล์ Excel</a></li>";
		   }
		echo "</ul>";
	echo "</li>";
	echo "<li><a href='?option=person' class='dir'>คู่มือ</a>";
		echo "<ul>";
			echo "<li><a href='modules/person/manual/person.pdf' target='_blank'>เอกสารคู่มือ</a></li>";
			if(($admin_person=="person") or ($_SESSION['login_status']==99) or ($_SESSION['login_status']<=4 and $result_permission['p1']==1)){	
			echo "<li><a href='modules/person/manual/person.xls' target='_blank'>ตัวอย่างไฟล์ Excel</a></li>";
			}
		echo "</ul>";
	echo "</li>";
echo "</ul>";
echo "</td></tr>";
echo "</table>";
?>
