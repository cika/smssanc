<?php
session_start();
$data2 = ( $_POST );
include("plan_authen.php");
require_once("dbconfig.inc.php");

//ตรวจการซ้ำของรหัสโครงการ
$sql = "SELECT *  FROM  plan_proj  where budget_year='$_SESSION[budget_year]' and  code_proj = '$vcode_proj' and id!='$_POST[plan_proj_id]' ";
$result0 =DBfieldQuery($sql);
$fetyear = mysql_fetch_array($result0);
$num=mysql_num_rows($result0);

if ($num==0){
$sql =  "update plan_proj  set  code_clus='$vcode_clus',code_tegy='$vcode_tegy', code_proj='$vcode_proj', budget_proj= '$vbudget_proj_2',name_proj = '$vname_proj' ,owner_proj ='$vowner_proj' ,begin_date='$mybeginday',finish_date='$myfinishday' where id='$_POST[plan_proj_id]' " ;
$dbquery  =  DBfieldQuery($sql);
}
else {
echo "<br>";
echo "<div align='center'>";
echo "รหัสโครงการซ่ำ โปรดตรวจสอบค่ะ";
echo "</div>";
exit();
}
?>
<script>
		document.location.href="?option=plan&task=planproject/plan_in_proj"; // page ย้อนกลับ 
</script>