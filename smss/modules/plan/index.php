<?php
if(isset($_GET['index'])){
$index=$_GET['index'];
}
else{
$index="";
}

include("./modules/plan/menu.php");
//ผนวกไฟล์
if($task!=""){
include("$task");
}
else {
include("default.php");
}
?>