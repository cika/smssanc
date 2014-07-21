<?php

$data2 = ( $_POST );
$dayseri =date ("Y/m/d, h:i:s A");
$proj_year=$_SESSION["budget_year"];

require_once("dbconfig.inc.php");
$sql = "SELECT *  FROM  plan_proj  where budget_year='$proj_year' and  code_proj = '$vcode_proj' ";
$result0 =DBfieldQuery($sql);
$fetyear = mysql_fetch_array($result0);
$num=mysql_num_rows($result0);
if ($num==0){
$sql = "insert into plan_proj (code_clus,code_tegy,code_proj,budget_year,budget_proj,name_proj,owner_proj,begin_date,finish_date,dayrec) values ('$vcode_clus','$vcode_tegy','$vcode_proj','$vbudget_year','$vbudget_proj_2','$vname_proj','$vowner_proj','$mybeginday','$myfinishday','$dayseri')";
$result0  =  DBfieldQuery($sql);
}else{
?>
	<script>
			alert(" <?php echo $vcode_proj?>  คุณใส่รหัสโครงการซ้ำ\nกรุณาบันทึกใหม่");
	</script>
<?php
}
?>
<Form id='user_form' name='frm1'>
</Form>
<script>
	callfrm("?option=plan&task=planproject/plan_in_proj"); 
</script>

