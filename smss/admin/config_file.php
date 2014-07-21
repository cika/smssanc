<?php
//หากมีการเรียกไฟล์นี้โดยตรง
//if (eregi("config_file.php",$PHP_SELF)) {
//if (eregi("config_file.php",$_SERVER['PHP_SELF'])) {
if (preg_match("/config_file.php/i",$_SERVER['PHP_SELF'])) {
    Header("Location: index.php");
    die();
}
//ตรวจสอบว่ามีโมดูลหรือไม่ (โมดูล User)
function GETMODULE($option,$file){
	global $MODPATH, $MODPATHFILE ;
	if(!$option){$option = "default";}
	if(!$file){$file = "index";}
$modpathfile="section/".$option."/".$file.".php";
if (file_exists($modpathfile)) {
	$MODPATHFILE = $modpathfile;
	$MODPATH = "section/".$option."/";
	}else{
	die ("No Page");
	}
}

// รับตัวแปรผนวกไฟล์ในโมดูล
$task=isset($_REQUEST['task']);
if($task!=""){
$task="$task.php";
}

?>
