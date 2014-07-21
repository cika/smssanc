<?php
if($result_version['smss_version']<1.0){
	require_once('update/file_update/v_1_0.php');
}

if($result_version['smss_version']<2.3){
require_once('update/file_update/v_2_3.php');
}

if($result_version['smss_version']<2.4){
require_once('update/file_update/v_2_4.php');
}

if($result_version['smss_version']<2.5){
require_once('update/file_update/v_2_5.php');
}

//ส่วนบันทึกเวอร์ชั่นปัจจุบัน
$sql_update="update system_version set  smss_version='$code_version'";
$dbquery = mysql_query($sql_update);
?>
