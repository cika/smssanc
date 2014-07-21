<?php
if (!defined('DBName'))
{
 require_once("dbconfig.inc.php");
}
$sql = "SELECT d.*  FROM  plan_acti d where  (code_proj='000') ORDER BY d.dayinput  DESC";
?>