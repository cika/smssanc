<?php
$data2 = ( $_POST );
$mvcode_proj=$_REQUEST['vcode_proj'];
include("plan_function.php");
include("plan_authen.php");
require_once("dbconfig.inc.php");

//ตรวจสอบรหัสกิจกรรมซ้ำ 
//$sql = "SELECT code_acti  FROM  plan_acti  where budget_year='$_SESSION[mplan_year]' and  code_acti = '$vcode_acti' and id !='$_POST[plan_acti_id]' limit 1";

$sql = "SELECT code_acti  FROM  plan_acti  where budget_year='$_SESSION[mplan_year]' and  code_acti = '$vcode_acti'  limit 1";

$result0 =DBfieldQuery($sql);
$num_record=mysql_num_rows($result0);

if($num_record==1){
$sql =  "update  plan_acti  set code_acti='$vcode_acti',  code_approve='$vcode_approve',daythai='$mdate',dayinput='$dayinput',budget_acti='$vbudget_acti',budget_approve='$vbudget_approve',name_acti='$vname_acti',dayseri='$dayseri',id_defalt='$vidperson',begin_date='$mybeginday',finish_date='$myfinishday' where id='$_POST[plan_acti_id]' " ;
$dbquery  =  DBfieldQuery($sql);


}
else{
echo "<br>";
echo "<div align='center'>";
echo "รหัสกิจกรรมซ้ำ โปรดตรวจสอบค่ะ";
echo "</div>";
exit();
}
?>
<script>
 location.replace("?option=plan&task=planproject/plan_in_acti&vcode_proj=<?php echo $mvcode_proj;?>&optioncase=1");  // page ย้อนกลับ 

//document.location.href="?option=plan&task=planproject/plan_in_acti&vcode_proj='<?php echo $mvcode_proj;?>'&optioncase=1");
</script>