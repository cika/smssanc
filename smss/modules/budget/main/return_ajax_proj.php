<?php
header("Content-type: application/xhtml+xml; charset=utf-8"); 
header("Cache-Control: no-cache, must-revalidate"); 

require_once("../../../smss_connect.php");

$sql = "select * from  budget_year where year_active='1' order by budget_year desc limit 1";
$dbquery = mysql_query($sql);
$year_active_result = mysql_fetch_array($dbquery);

$sql = "select * from plan_acti where code_proj='".$_GET['proj']."' and budget_year='$year_active_result[budget_year]' order by code_acti ";
$query = mysql_query($sql);
echo "<option value=''>เลือกกิจกรรม</option>";
while($result = mysql_fetch_array($query)){
	$code_acti = $result['code_acti'];
	$name_acti = $result['name_acti'];
echo "<option value='$code_acti'>$code_acti $name_acti</option>";
}

?>
