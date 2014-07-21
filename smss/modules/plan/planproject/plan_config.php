<?php
session_start();
?>
<META http-equiv=Content-Type content="text/html; charset=utf-8">
<?
if($_SESSION['mpms_admin']=='1')
 	{ 
	$mydata = "<?".chr(13);
	$mydata = $mydata.'session_start();'.chr(10);
	$mydata = $mydata.'$_SESSION["sd_year"]=2554;'.chr(10);
	$mydata = $mydata.'$_SESSION["budget_year"]=2554;'.chr(10);
	$mydata = $mydata."?>".chr(10);

	$index_fwrite = fopen("modules/plan/planproject/plan_default.php","w");
	fwrite($index_fwrite, utf8_encode($mydata));
	fclose($index_fwrite); 
	 } 
?>
<Form id='user_form' name='frm1'>
</Form>
<script>
	callfrm("?option=plan&task=default"); 
</script>