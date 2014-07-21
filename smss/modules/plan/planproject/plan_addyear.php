<?php
session_start(); 
?>
<META http-equiv=Content-Type content="text/html; charset=utf-8">
<?php
	$index_fwrite = fopen("modules/plan/planproject/plan_default.php","w");
	$sd_year =  $_REQUEST["sd_year"];
	$budget_year =  $_REQUEST["budget_year"];
	$mydata = "<?".chr(13);
	$mydata = $mydata.'session_start();'.chr(10);
	$mydata = $mydata.'$_SESSION["sd_year"]='.$sd_year.';'.chr(10);
	$mydata = $mydata.'$_SESSION["budget_year"]='.$budget_year.';'.chr(10);
	$mydata = $mydata."?>".chr(10);
	fwrite($index_fwrite, utf8_encode ($mydata));
$index_fwrite = fopen("modules/plan/planproject/plan_default.php","r");
$index_open = fopen("modules/plan/planproject/plan_temp.php","w");
$texter1="";
while (!feof($index_fwrite))
	{
		$texter = fgetc($index_fwrite);
		if($texter==chr(42)) $texter1=chr(42);

		if($texter==chr(92) or  $texter==chr(13) or  $texter==chr(10) or $texter==chr(9)) {
			echo  ""; }
		elseif ($texter==chr(59) or ($texter1==chr(42) and $texter==chr(47)))
			{
		$mytext=$mytext.$texter.chr(10);} elseif($texter!=chr(92)) {$mytext=$mytext.$texter;}
	}
    fwrite($index_open, utf8_encode ($mytext));
	fclose($index_open); 
	copy("modules/plan/planproject/plan_temp.php", "modules/plan/planproject/plan_default.php");
 ?>
<Form id='user_form' name='frm1'>
</Form>
<script>
	callfrm("?option=plan&task=default"); 
</script>