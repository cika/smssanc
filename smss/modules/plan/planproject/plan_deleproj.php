<?php
$proj_year=$_SESSION["budget_year"];
$vcode_proj=$_REQUEST["vcode_proj"];

require_once("dbconfig.inc.php");
$sql =  "delete FROM  plan_acti  where  budget_year='$proj_year' and  code_proj='$vcode_proj' " ;
$dbquery = DBfieldQuery($sql);
$sql =  "delete FROM  plan_proj  where  budget_year='$proj_year' and  code_proj='$vcode_proj' " ;
$dbquery = DBfieldQuery($sql);
?>
<script>
		document.location.href="?option=plan&task=planproject/plan_in_proj"; // page ย้อนกลับ 
</script>
