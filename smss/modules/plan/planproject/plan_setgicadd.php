<?php
$data2 = ( $_POST );
if(isset($_REQUEST["id"])){
$did=$_REQUEST["id"];
}
if(isset($_REQUEST["mcase"])){
$mcase=$_REQUEST["mcase"];
}
if(isset($_REQUEST["vstrategic"])){
$vstrategic=$_REQUEST["vstrategic"];
}
if(isset($_REQUEST["vid_tegic"])){
$vid_tegic=$_REQUEST["vid_tegic"];
}
if(isset($_REQUEST["vbudget_year"])){
$vbudget_year=$_REQUEST["vbudget_year"];
}

require_once("dbconfig.inc.php");
if ($mcase==2) {
$sql = "update plan_stregic  set  budget_year='$vbudget_year' ,strategic='$vstrategic' ,id_tegic='$vid_tegic'  where id='$did' ";
}
elseif ($mcase==1) {
$sql = "SELECT *  FROM  plan_stregic  where budget_year='$vbudget_year' and  id_tegic = '$vid_tegic' limit 1";
$result0 =DBfieldQuery($sql);
$fetyear = mysql_fetch_array($result0);
if ($fetyear['budget_year']==0){
$sql = "insert into plan_stregic (id_tegic,budget_year,strategic) values ('$vid_tegic','$vbudget_year','$vstrategic')";
}}
elseif ($mcase==3) {
$sql =  "delete FROM  plan_stregic  where id='$did' " ;
}
$dbquery  =  DBfieldQuery($sql);

?>
<Form id='user_form' name='frm1'>
</Form>
<script>
	callfrm("?option=plan&task=planproject/plan_setgic"); 
</script>