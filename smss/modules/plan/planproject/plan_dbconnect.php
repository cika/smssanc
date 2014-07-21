<?php
if (!defined('DBName'))
{
 require_once("dbconfig.inc.php");
}
$sql = "SELECT d.*  FROM  plan_acti d where  (code_proj='$mcode_proj') and (code_clus='$mcode_clus') ORDER BY d.code_acti  DESC";
?>