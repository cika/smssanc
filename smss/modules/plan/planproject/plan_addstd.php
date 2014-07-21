<?php
//session_start();
error_reporting(E_ALL ^ E_NOTICE);
$code_acti=$_SESSION["mcode_acti"];
$code_clus=$_SESSION["mcode_clus"];
$budget_year=$_SESSION["budget_year"];
/*#################################*/
$arrupd=array();  /*        1           */
require_once("dbconfig.inc.php");
$data = ( $_POST );
 unset($data['allchk']);
$data1=$_REQUEST['zid'];  // array2 ชุดที่1
$data2=$_REQUEST['id_indicator'];  // array2 ชุดที่2
$data3=$_REQUEST['sd_id'];  // array2 ชุดที่3
$data4=$_REQUEST['sd_year'];  // array2 ชุดที่5
$data5=$_REQUEST['sd_level'];  // array2 ชุดที่6
$vcode_proj=$_REQUEST['vcode_proj'];
Foreach ($data2 as $k  => $v) {
	$id =$data1[$k];
	$id_indicator =$data2[$k];
	$sd_id =$data3[$k];
	$sd_year =$data4[$k];
	$sd_level =$data5[$k];
	if ($id == 'on') {
		$sql = "SELECT *  FROM  plan_standard  where (code_acti=$code_acti and sd_year=$sd_year  and sd_level=$sd_level  and id_indicator=$id_indicator and sd_id=$sd_id)  limit 1";
		$result0 = DBfieldQuery($sql);
		$fetyear = mysql_fetch_array($result0);
		if ($fetyear[sd_year]==0){
			$sql = "insert into plan_standard (budget_year,sd_year,code_clus,code_proj,code_acti,sd_level,sd_id,id_indicator) values ('$budget_year','$sd_year','$code_clus','$code_proj','$code_acti','$sd_level','$sd_id','$id_indicator')";
		 //echo  "$k  => $v  \n <br>";
		$result = DBfieldQuery($sql);
		}
		} else { //  if ($v == 'on')
		$sql = "DELETE  FROM  plan_standard  where (code_acti=$code_acti and sd_year=$sd_year  and sd_level=$sd_level  and id_indicator=$id_indicator and sd_id=$sd_id)";
		$result0 = DBfieldQuery($sql);
		}
} //Foreach ($data as $k  => $v)

?>
<Form id='user_form' name='frm1'>
</Form>
<script>
	callfrm("?option=plan&task=planproject/plan_in_acti&vcode_proj=<?php echo $vcode_proj;?>&optioncase=1"); 
</script>