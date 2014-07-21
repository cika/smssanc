<?php
$hostname="localhost";
$user="root";
$password="12345678";
$dbname="smss";
$system_office_code="1037750121";     //รหัสสถานศึกษา

mysql_connect($hostname, $user, $password) or die("ติดต่อฐานข้อมูลไม่ได้");
mysql_select_db($dbname)  or die("เลือกฐานข้อมูลไม่ได้");
mysql_query("SET NAMES utf8");
?> 