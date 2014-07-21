<?php

$message = $_REQUEST['message'];
$vcode_proj = $_REQUEST['vcode_proj'];
$today_date =date ("Y/m/d, h:i:s A");
$Year = date("Y")+543;
$Year=substr($Year,-2,2);
$mcode_proj =$_SESSION['budget_year']."_".$vcode_proj;

$basename = basename($_FILES['userfile']['name']);
if (isset($_FILES['userfile']))
{
$changed_name = file_upload($mcode_proj);
}
require_once("dbconfig.inc.php");
$sql =  "update plan_proj  set  file_detail='$changed_name' ,dayrec = '$today_date' where code_proj='$vcode_proj' " ;
	if ($dbquery  = DBfieldQuery($sql) and $changed_name!="")
	{
	echo "<div align=left><B><font color=#0066CC Size=3>บันทึกเรียบร้อยแล้ว</font></B></div>";
	}
	else
	{
	echo "<div align=left><B><font color=#00669C Size=3>เกิดปัญหาบางอย่าง ไม่สามารถบันทึกได้ค่ะ</font></B></div>";
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
		$unlink_dir=$uploaddir."plansch".$mcode_proj.".".$lastname;
		if(file_exists($unlink_dir)) {
		unlink($unlink_dir);
		}
		
		if (move_uploaded_file($_FILES['userfile']['tmp_name'],  $uploadfile))
			{
			echo  "<br><strong><font color=#003366  size=4>อัพโหลดไฟล์เรียบร้อยแล้ว</font></strong>";
				$txt ="plansch".$mcode_proj;
				$before_name  = $uploaddir . $basename;
				///////
			//	$array_lastname = explode("." ,$basename) ;
			//	 $c =count ($array_lastname) - 1 ;
			//	 $lastname = strtolower ($array_lastname[$c]) ;
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
<Form id='frm1' name='frm1'>
</Form>
<script>
	callfrm("?option=plan&task=planproject/plan_upload_detail"); 
</script>