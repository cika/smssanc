<?php
//ตรวจสอบว่ามีโมดูลหรือไม่ (โมดูล User)
function GETMODULE($option,$file){
	global $MODPATH, $MODPATHFILE ;
	if(!$option){$option = "defualt";}
	if(!$file){$file = "index";}
$modpathfile="modules/".$option."/".$file.".php";
if (file_exists($modpathfile)) {
	$MODPATHFILE = $modpathfile;
	$MODPATH = "modules/".$option."/";
	}else{
	die ("No Page");
	}
}

// รับตัวแปรผนวกไฟล์ในโมดูล
if(isset($_REQUEST['task'])){
$task=$_REQUEST['task'];
$task="$task.php";
}
else {
$task="";
}
?>
