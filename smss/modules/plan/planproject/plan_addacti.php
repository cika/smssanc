<?php
require_once("plan_function.php");
require_once("plan_authen.php");
$vid_defalt="";
$acti_year=$_SESSION['mplan_year'];
$mvcode_proj=$_REQUEST["vcode_proj"];
$chk_clus=(int)$vcode_clus;
if($chk_clus<=0){
	?><script>
			alert("ไม่พบรหัสกลุ่ม  กรุณาเลือกคลิกเลือกกลุ่ม");
			document.location.href="?option=plan&task=planproject/plan_in_acti";
		</script><?php
}
$chk_proj=(int)$vcode_proj;
if($chk_proj<=0){
	?><script>
			alert("ไม่พบรหัสโครงการ  กรุณาเลือกคลิกเลือกโครงการ");
			document.location.href="?option=plan&task=planproject/plan_in_acti";
		</script><?php
}
$dayseri =date ("Y/m/d, h:i:s A");
$zero="0";
$len_myday=strlen($myday);
if ($len_myday==1)
	{ $myday=$zero."".$myday;
	}
$len_mymonth=strlen($mymonth);
if ($len_mymonth==1)
	{ $mymonth=$zero."".$mymonth;
	}
$dayinput = $myyear."".$mymonth."".$myday; // plan_authen.php
$code_acti=substr('000'."".$vcode_acti,-3,3);
$vcode_acti=$vcode_proj."".$code_acti;
 require_once("dbconfig.inc.php");
$sql = "SELECT *  FROM  plan_acti  where budget_year='$acti_year' and  code_acti = '$vcode_acti' limit 1";
$result0 =DBfieldQuery($sql);
$fetyear = mysql_fetch_array($result0);
if ($fetyear['budget_year']==0){
$sql = "insert into plan_acti (code_clus,code_proj,code_acti,code_approve,daythai,dayinput,budget_year,budget_acti,name_acti,dayseri,id_defalt,begin_date,finish_date) values ('$vcode_clus','$vcode_proj','$vcode_acti','$vcode_approve','$mdate','$dayinput','$acti_year','$vbudget_acti','$vname_acti','$dayseri','$vid_defalt','$mybeginday','$myfinishday')";
$dbquery  =  DBfieldQuery($sql);
}else{
?>
	<META http-equiv=Content-Type content="text/html; charset=utf-8">
	<script>
			alert(" <?php echo $vcode_acti?>  คุณใส่รหัสกิจกรรมซ้ำ\nกรุณาบันทึกใหม่");
	</script><?php
}
?>
<Form id='user_form' name='frm1'>
</Form>
<script>
	callfrm("?option=plan&task=planproject/plan_in_acti&vcode_proj='<?php echo $mvcode_proj;?>'&optioncase=1");  //page ย้อนกลับ 
</script>