<?php
//$index=$_GET['index'];
include("./modules/person/menu.php");
//ผนวกไฟล์
if(isset($_GET['task'])!=""){
$task=$_GET['task'].".php";
include("$task");
}
else {
include("default.php");
}
?>

