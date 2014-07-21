<?php
$did_person=$_REQUEST["id_person"];
require_once("dbconfig.inc.php");
$sql =  "delete FROM  plan_permission where id_person='$did_person' " ;
$dbquery = DBfieldQuery($sql);
?>
<Form id='user_form' name='frm1'>
</Form>
<script>
			callfrm("?option=plan&task=planproject/plan_setuser"); 
</script>