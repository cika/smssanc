<?php

$plan_proj_id = $_REQUEST['plan_proj_id'];
$year_index = $_REQUEST['year_index'];
$workgroup = $_REQUEST['workgroup'];

$eval_activity = $_REQUEST['eval_activity'];
$eval_result = $_REQUEST['eval_result'];
$eval_obstacle = $_REQUEST['eval_obstacle'];

$mcode_proj =$year_index."_".$plan_proj_id;
require_once("dbconfig.inc.php");


if ($_FILES['userfile']['name']!=""){
$changed_name = file_upload($mcode_proj);
$sql =  "update plan_proj  set eval_activity='$eval_activity', eval_result='$eval_result', eval_obstacle='$eval_obstacle', eval_particular='$changed_name' where id='$plan_proj_id ' " ;
$dbquery  = DBfieldQuery($sql); 
}
else{
$sql =  "update plan_proj  set eval_activity='$eval_activity', eval_result='$eval_result', eval_obstacle='$eval_obstacle' where id='$plan_proj_id ' " ;
$dbquery  = DBfieldQuery($sql); 
}
/*--------------------------*/
function  file_upload($mcode_proj)
	{
		$uploaddir = 'modules/plan/planproject/detail/';      //ที่เก็บไไฟล์
		$uploadfile = $uploaddir.basename($_FILES['userfile']['name']);
		$basename = basename($_FILES['userfile']['name']);
		
		//ลบไฟล์เดิมออก
		$array_lastname = explode("." ,$basename) ;
		$c =count ($array_lastname) - 1 ;
		$lastname = strtolower ($array_lastname[$c]) ;
		$x=".";
		$unlink_dir=$uploaddir."report".$mcode_proj.".".$lastname;
		if(file_exists($unlink_dir)) {
		unlink($unlink_dir);
		}

		if (move_uploaded_file($_FILES['userfile']['tmp_name'],  $uploadfile))
			{
			echo  "<br><strong><font color=#003366  size=4>อัพโหลดไฟล์เรียบร้อยแล้ว</font></strong>";
				$txt ="report".$mcode_proj;
				$before_name  = $uploaddir . $basename;
				///////
				//$array_lastname = explode("." ,$basename) ;
				// $c =count ($array_lastname) - 1 ;
				// $lastname = strtolower ($array_lastname[$c]) ;
				$changed_name = $uploaddir.$txt.".".$lastname;
				///////
				rename("$before_name" , "$changed_name");
				return  $changed_name;
			}
		else
			{
			echo  "<br><strong><font color=#990000 size=4>ไม่สามารถอัพโหลดได้</font></strong>";
			$changed_name="";
			return  $changed_name;
			}
			sleep(3);
		}
?>
<Form id='user_form' name='frm1'>
</Form>
<script>
	callfrm("?option=plan&task=planproject/plan_owner_report&year_index=<?=$year_index?>&workgroup=<?=$workgroup?>"); 
</script>