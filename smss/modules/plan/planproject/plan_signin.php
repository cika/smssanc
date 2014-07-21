<?php
session_start();
include("plan_authenfg.php");   //$config[.....]
$sname_perm=$_SESSION["name_perm"];
  if (empty($sname_perm))
	{
		 require_once("plan_authen.php");
		 require_once("plan_person.php");
	}
$sname_perm=$_SESSION["name_perm"];
	echo"<BR><BR><CENTER>ผู้ใช้งาน : $sname_perm</CENTER>";
?>