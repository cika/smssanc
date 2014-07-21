<?php  
       /* foreach($_POST as $key=>$value){  
            $$key=$value;  
        }  
        foreach($_GET as $key=>$value){  
            $$key=$value;  
        }  */
?>  
<?php
$index=(isset($_GET['index']))?$_GET['index']:"";
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
if(isset($_GET['task'])!=""){
			$task=$_GET['task'];
			$module_file_path="modules/$_REQUEST[option]/".$task.".php";
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