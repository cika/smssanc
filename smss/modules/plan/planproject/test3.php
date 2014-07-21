<?php
session_start(); 
unset($btnSubmit);
error_reporting(E_ALL ^ E_NOTICE);
?>
<META http-equiv=Content-Type content="text/html; charset=utf-8">
<?php
if(isset($_REQUEST['btnSubmit'])) 
	{ 
	$index_fwrite = fopen("modules/plan/planproject/plan_default.php","w");
	$datatxt =  $_REQUEST["mytextarea"];
	fwrite($index_fwrite, utf8_encode ($datatxt));
	 }  
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
	copy("plan_temp.php", "plan_default.php");
	//$contents=file_get_contents ( "plan_defaul.php" );
	//$index_fwrite = fopen("plan_default.php","w");
	//fwrite($index_fwrite, $contents);
	//fclose($index_fwrite); 
 ?>
<Form id='user_form' name='frm1'>
<?
$contents=file_get_contents ( "modules/plan/planproject/plan_default.php" );?>
<textarea name="mytextarea" rows = "3" cols="100"><?php echo $contents;?></textarea>

 <?
echo "<p align='center'>";
echo "<input type=\"submit\" name=\"submit\" id=\"submit\" onclick='goto_url_update(1)'  class=\"button\" value=\"บันทึก\">";

?>
</form>
<script language="JavaScript">
function goto_url_update(val){
	if(val==0){
		callfrm("?option=plan");   // page ย้อนกลับ vcode_clus
	}else if(val==1){
				callfrm("?option=plan&task=planproject/plan_addyear"); }  //page ประมวลผล
						}
</script>
