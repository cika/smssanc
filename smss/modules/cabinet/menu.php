<?php	
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );

$sql_permission = "select * from  cabinet_permission where person_id='$_SESSION[login_user_id]'";
$dbquery_permission = mysql_query($sql_permission);
$result_permission = mysql_fetch_array($dbquery_permission);

if(!isset($_SESSION['admin_cabinet'])){
$_SESSION['admin_cabinet']="";
}

echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>"; 
echo "<tr bgcolor='#FFCC00'><td>";
echo "<ul id='nav' class='dropdown dropdown-horizontal'>";
	echo "<li><a href='./'>รายการหลัก</a></li>";
	if(($_SESSION['admin_cabinet']=="cabinet")  or ($result_permission['p1']==1)){
	echo "<li><a href='?option=cabinet' class='dir'>ตั้งค่าระบบ</a>";
		echo "<ul>";
			echo "<li><a href='?option=cabinet&task=main/permission'>กำหนดเจ้าหน้าที่</a></li>";
			if($result_permission['p1']==1){
			echo "<li><a href='?option=cabinet&task=main/cabinet_set'>กำหนดตู้เอกสาร</a></li>";
			}
		echo "</ul>";
	echo "</li>";
	}
	
	if($_SESSION['login_status']<=4){	
	echo "<li><a href='?option=cabinet' class='dir'>ลิ้นชักและแฟ้ม</a>";
		echo "<ul>";
			echo "<li><a href='?option=cabinet&task=main/ctr_tray_set'>ตู้เอกสารกลาง</a></li>";
			echo "<li><a href='?option=cabinet&task=main/private_tray_set'>ตู้เอกสารส่วนบุคคล</a></li>";
	echo "</ul>";
	echo "</li>";
	}	
	
	if($_SESSION['login_status']<=4){	
	echo "<li><a href='?option=cabinet' class='dir'>เอกสาร</a>";
		echo "<ul>";
			echo "<li><a href='?option=cabinet&task=main/ctr_document'>เอกสารตู้กลาง</a></li>";
			echo "<li><a href='?option=cabinet&task=main/private_document'>เอกสารตู้ส่วนบุคคล</a></li>";
			echo "<li><a href='?option=cabinet&task=main/search_document'>ค้นหาเอกสาร</a></li>";
	echo "</ul>";
	echo "</li>";
	}	
	
	echo "<li><a href='?option=cabinet' class='dir'>คู่มือ</a>";
		echo "<ul>";
			echo "<li><a href='modules/cabinet/manual/cabinet.pdf' target='_blank'>เอกสารคู่มือ</a></li>";
		echo "</ul>";
	echo "</li>";
echo "</ul>";
echo "</td></tr>";
echo "</table>";
?>
