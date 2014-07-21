<?php
if (!defined('DBName'))
{
$path = "plan_setuser.php";
	if(file_exists($path)) 	include("../../../smss_connect.php"); else  include("smss_connect.php");
define("DBHost",$hostname);
define("DBUser",$user);
define("DBPasswd",$password);
define("DBName",$dbname);
}
function DBfieldQuery($QueryString){    //nikhom
		global $conn;
		if($conn=@mysql_connect(DBHost,DBUser,DBPasswd )){
			if(mysql_select_db(DBName,$conn)){
				mysql_query("set NAMES utf8");
				$Result = mysql_query($QueryString);
				return $Result;
				}else{
				die (mysql_error());
				return 0;
			}
		 }else{
			 die(mysql_error());
			 return 0;
		}
	}
?>