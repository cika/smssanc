<?php
session_start();
$_SESSION['mpms_admin']='1';
if($_SESSION['mpms_admin']=='1')
 	{ 
	$mydata = "<?".chr(10);
	$mydata = $mydata.'session_start();'.chr(10);
	$mydata = $mydata.'$_SESSION["sd_year"]=2554;'.chr(10);
	$mydata = $mydata.'$_SESSION["budget_year"]=2554;'.chr(10);
	$mydata = $mydata.'/*sd_year : ปีมาตรฐาน   budget_year : ปีงบประมาณ */'.chr(10);
	$mydata = $mydata."?>".chr(10);

	$index_fwrite = fopen("plan_default.php","w");
	fwrite($index_fwrite, utf8_encode ($mydata));
	fclose($index_fwrite); 
	 }  