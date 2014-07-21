<?php
$dvcode_proj=$_REQUEST["vcode_proj"];

require_once("dbconfig.inc.php");

$sql = "SELECT file_detail  FROM  plan_proj  where code_proj='$dvcode_proj' and budget_year='$_SESSION[budget_year]' " ;

$dbquery =DBfieldQuery($sql);
$result = mysql_fetch_array($dbquery);
$file_detail =$result['file_detail'];

		//Åºä¿Åìà´ÔÁ
		if(file_exists($file_detail)){
		unlink($file_detail);
		}

$sql =  "update  plan_proj  set  file_detail=''  where code_proj='$dvcode_proj' and budget_year='$_SESSION[budget_year]' " ;
$dbquery  =  DBfieldQuery($sql);

?>
<Form id='frm1' name='frm1'>
</Form>
<script>
	callfrm("?option=plan&task=planproject/plan_upload_detail"); 
</script>