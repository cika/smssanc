<?php
ob_start(); 
unset($btnSubmit);
error_reporting(E_ALL ^ E_NOTICE);
clearstatcache ();
echo ord("*	");
echo chr(47)."xx<BR>";
?>
<META http-equiv=Content-Type content="text/html; charset=utf-8">
<?php
//$data2 = ( $_POST );
// print_r ( $data2);

if(isset($_REQUEST['btnSubmit'])) 
	{ 
	$index_fwrite = fopen("plan_default.php","w");
	$datatxt =  $_REQUEST["mytextarea"];
	fwrite($index_fwrite, utf8_encode ($datatxt));
	 }  
$index_fwrite = fopen("plan_default.php","r");
$index_open = fopen("plan_temp.php","w");
$texter1="";
while (!feof($index_fwrite))
	{
		$texter = fgetc($index_fwrite);
		if($texter==chr(42)) $texter1=chr(42);

		if($texter==chr(92) or  $texter==chr(10) or $texter==chr(9)) {
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

<form method="post" action="<?=$_SERVER['PHP_SELF']?>">
<?
$contents=file_get_contents ( "plan_default.php" );?>
<textarea name="mytextarea" rows = "3" cols="100"><?php echo $contents;?></textarea>
<input name="btnSubmit" type="submit" value="Submit"> 
</form>