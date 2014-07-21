<?php
if (!defined('DBName'))
{
require_once "dbconfig.inc.php";
}

if(!isset($vcode_acti)){
$vcode_acti="";
}

if(!isset($vcode_clus)){
$vcode_clus="";
}

$sql = "SELECT d.*  FROM  plan_acti d where  (code_acti='$vcode_acti') and (code_clus='$vcode_clus')";
	$dbquery =DBfieldQuery($sql);
	$result = mysql_fetch_array($dbquery);
	$mybeginday=$result['begin_date'];
	$myfinishday=$result['finish_date'];
	if ($mybeginday=="0000-00-00")
	{$mybeginday="2010-10-01";
	$myfinishday="2011-09-30";}
	$eYnum=substr($mybeginday,0,4);
	$emnum=substr($mybeginday,5,2);
	$ednum=substr($mybeginday,8,2);
	$eYbudget=substr($myfinishday,0,4);
	$embudget=substr($myfinishday,5,2);
	$edbudget=substr($myfinishday,8,2);
?>