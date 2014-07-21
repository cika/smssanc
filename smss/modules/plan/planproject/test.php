<?php
session_start();
//date_default_timezone_set('GMT+7'); 
date_default_timezone_set('Asia/Bangkok'); 

echo $_SESSION["sd_year"]."<BR>";
echo $_SESSION["budget_year"]."<BR>";
$hour = 0;   //ปรับให้ตรงตามต้องการ
	$min = 0;  //ปรับให้ตรงตามต้องการ
	$Year = date("Y")+543;
	$mdate = $Year.date(" เวลา H:i น.",mktime( date("H")+$hour, date("i")+$min ))."<BR>";

echo $mdate;

?>