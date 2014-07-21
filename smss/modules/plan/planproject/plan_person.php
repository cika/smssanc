<?php
$chkmidcode=$_SESSION["login_user_id"];
if(!isset($_SESSION['admin_plan'])){
$_SESSION['admin_plan']='';}
$sname_perm='';
require_once("dbconfig.inc.php");
$sql = "SELECT *  FROM   plan_permission  WHERE (id_person='$chkmidcode') "; 
$dbquery =DBfieldQuery($sql);
$result = mysql_fetch_array($dbquery);
		if(isset($result['id_person'])){
		$_SESSION["mid_person"]= $result['id_person'];
		}
		if(isset($result['id_defalt'])){
		$_SESSION["midentify"] = $result['id_defalt'];
		}
		if(isset($result['name_perm'])){
		$_SESSION["name_perm"] = $result['name_perm'];
		}
		if(isset($result['password_new'])){
		$_SESSION["password_new"] = $result['password_new'];
		}
		if(isset($result['password_old'])){
		$_SESSION["password_old"] = $result['password_old'];
		}
		if(isset($result['perm_add'])){
		$_SESSION["mpms_add"] = $result['perm_add'];
		}
		if(isset($result['perm_edit'])){
		$_SESSION["mpms_edit"] = $result['perm_edit'];
		}
		if(isset($result['perm_dele'])){
		$_SESSION["mpms_dele"] = $result['perm_dele'];
				}
		if(isset($_SESSION['name_perm'])){
		$sname_perm=$_SESSION['name_perm'];
		}
if(isset($sname_perm)){
		if (empty($sname_perm))
		{
		$_SESSION["mpms_add"] = "0";
		$_SESSION["mpms_edit"] = "0";
		$_SESSION["mpms_dele"] = "0";
		}
}
?>