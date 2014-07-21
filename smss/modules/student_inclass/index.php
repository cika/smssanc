<?php  
#error_reporting(0);
	   /* foreach($_POST as $key=>$value){  
            $$key=$value;  
        }  
        foreach($_GET as $key=>$value){  
            $$key=$value;  
        }  */
?>  
<?
$index=$_GET['index'];

#เช็คสิทธิ์ภายในโมดูล

//ผนวกเมนู
$module_menu_path="./modules/$_REQUEST[option]/menu.php";
if(file_exists($module_menu_path)){
require_once("$module_menu_path");
}
else{
die ("No MenuPage");
}

//ผนวกไฟล์
if($task!=""){
			$module_file_path="modules/$_REQUEST[option]/".$task;
			if(file_exists($module_file_path)){
			require_once("$module_file_path");
			}else{
			die ("No Page");
			}
}
else {
			$module_file_path="modules/$_REQUEST[option]/"."default.php";
			if(file_exists($module_file_path)){
			require_once("$module_file_path");
			}else{
			die ("No DefaultPage");
			}
}
?>