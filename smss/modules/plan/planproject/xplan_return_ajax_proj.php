<?php
ob_start();
//include("../../../smss_connect.php");
require_once("dbconfig.inc.php");
$sql = "select * from  budget_year where year_active='1' order by budget_year desc limit 1";
//$dbquery = mysql_db_query($dbname, $sql);
$dbquery =DBfieldQuery($sql);
$year_active_result = mysql_fetch_array($dbquery);

$proj=$_GET['proj'];

$js = "removeOption();";
$js .= "
		var opt = new Option('เลือก', '');
		document.getElementById('pj_activity').options[0] = opt;
	";

$i=1;
$sql = "select  * from  plan_acti  where  code_proj='$proj' and budget_year='$year_active_result[budget_year]' order by code_acti ";
//$dbquery = mysql_db_query($dbname, $sql);
$dbquery =DBfieldQuery($sql);
While ($result = mysql_fetch_array($dbquery))
 {
	$code_acti = $result['code_acti'];
	$name_acti = $result['name_acti'];
		$js .= "
		var opt = new Option('$code_acti $name_acti', '$code_acti');
		document.getElementById('pj_activity').options[$i] = opt;
	";
	
$i++;		
}

header("Content-Type:text/javascript; charset=utf-8");
echo $js;
?>
