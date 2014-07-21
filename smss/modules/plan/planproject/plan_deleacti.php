<?php
require_once("dbconfig.inc.php");
$mvcode_proj=$_REQUEST["vcode_proj"];
$sql =  "delete FROM  plan_acti  where id='$_GET[delete_id]' " ;
$dbquery = DBfieldQuery($sql);
?>
<script>
		location.replace("?option=plan&task=planproject/plan_in_acti&vcode_proj=<?php echo $mvcode_proj;?>&optioncase=1");  // page ย้อนกลับ 
</script>
