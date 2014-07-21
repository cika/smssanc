<?php
	//session_start();
	//$_SESSION['mpms_edit']=1;
	if($_SESSION['mpms_edit']!=1){
	?><script>
			alert("คุณไม่มีสิทธ ิ์\n บันทึกรายการมาตรฐาน");
		</script><?php 
		}
$_SESSION["mcode_acti"]=$_REQUEST["gcode_acti"];
$_SESSION["mcode_clus"]=$_REQUEST["vcode_clus"];
$_SESSION["mcode_proj"]=$_REQUEST["vcode_proj"];
$mvcode_proj=$_REQUEST["vcode_proj"];
$fetyear=$_SESSION["sd_year"];
$budget_year=$_SESSION["budget_year"];
$code_acti =$_REQUEST["gcode_acti"];
$sd_level = 2;
/* $sd_year
$id_indicator
$sd_id */

require("javachkbox.html");   /* Conf(this) */
error_reporting(E_ALL ^ E_NOTICE);
?>
<HTML>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<META http-equiv=Content-Type content="text/html; charset=windows-874">
<meta name="generator" content="Namo WebEditor">
<link rel="stylesheet"  href="./css/js/style.css" type="text/css"/>
<BODY leftMargin=0 topMargin=0>
<Form id='mylist' name='mylist'>
<p><b><font size="2" color="blue">&nbsp;&nbsp;<?php echo $nameacti?></p>
<CENTER>
<table width="70%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td bordercolor="#FFCC33">
    <table width="100%" border="1" cellspacing="0"  bgcolor="#FFFFbb"  bordercolordark="white">
  <tr>
    <td  colspan="5"  bgcolor="#FFCC33"  height="38"><b>&nbsp;<font color='#000000' size='2' face='MS Sans Serif'> :: เลือกมาตรฐานการศึกษาปฐมวัย ::</b></td></tr>
     <tr><td><input  type="checkbox" name="allchk"   onClick="CheckAll()"</td>
     <th>#</th><th width='10%'><font color='#006633' size='2' face='MS Sans Serif'>มาตรฐานที่</th><th  align="center"><font color='#006633' size='2' face='MS Sans Serif'>รายละเอียด</th><th width='10%' align="center"><font color='#006633' size='2' face='MS Sans Serif'>ปี พ.ศ.</th></tr>
<?php
require_once("dbconfig.inc.php");
$sql = "SELECT *  FROM  standard_elementary_sd  where sd_year=$fetyear  ORDER BY sd_id  ASC ";
$result1 = DBfieldQuery($sql);
$num_rows = mysql_num_rows($result1);
$rd=0;
$rx=0;
while ($rd < $num_rows)
	{
	$fetcharr = mysql_fetch_array($result1);
	//$sdid[$rd] = $fetcharr['id'];
	$fielda = $fetcharr['sd_year'];
	$fieldb[$rd] = $fetcharr['sd_id'];
	$fieldc = $fetcharr['sd_name'];
	$field1 = $fieldb[$rd];
	$field2 = $fieldb."&nbsp;--&nbsp;".$fieldc;
     echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td  align='left' ><b><font color='#000000' size='3' face='MS Sans Serif'>&nbsp;$field1</b></td>"; 
echo "<td align='left'>$fieldc</td>";
echo "<td align='center'>$fielda</td></tr>";
//===============
$sql = "SELECT *  FROM  standard_elementary_indicator where (sd_id=$fieldb[$rd] and sd_year=$fetyear) ORDER BY id_indicator  ASC ";
$result2 = DBfieldQuery($sql);
While($fetcharr = mysql_fetch_array($result2) ) { 
	$zid[$rx] = $fetcharr['id'];
	$fielda2 = $fetcharr['sd_id'];
	$fieldb[$rx] = $fetcharr['id_indicator'];
	$fieldc2 = $fetcharr['indicator_name'];
	$fieldb2 =  $fetcharr['id_indicator'];
	$field22 = $fieldb2."&nbsp;--&nbsp;".$fieldc2;
    echo "<tr><td>&nbsp;</td><td>";
	echo "	<Input Type=Hidden Name=sd_id[$rx] Value=$field1>";
	echo "	<Input Type=Hidden Name=sd_year[$rx] Value=$fielda>";
	echo "	<Input Type=Hidden Name=sd_level[$rx] Value=$sd_level >";

	$sql = "SELECT *  FROM  plan_standard  where (code_acti=$code_acti  and budget_year='$budget_year' and sd_year=$fetyear  and sd_level=$sd_level  and id_indicator=$fetcharr[id_indicator] and sd_id=$fetcharr[sd_id])  limit 1";
	$result_standard = DBfieldQuery($sql);
	$result_std = mysql_fetch_array($result_standard);

if ($fieldb2==$result_std[id_indicator]) { 
           echo "<input  type=checkbox  name=zid[$rx]  id=zid[$rx] checked='checked'  onClick=CCA(this)></td>";
		   echo "<td  align='center' ><IMG src='./images/yes.png' WIDTH='16' HEIGHT='16' BORDER='0' ALT=''></td>"; 
			echo "<Input Type=Hidden  name=id_indicator[$rx] value='$fieldb2'>";
	  } else { 
		  echo "<input  type=checkbox  name=zid[$rx]   onClick=CCA(this)></td>";
		  echo "<td>&nbsp;</td>"; 
		  echo "<Input Type=Hidden  name=id_indicator[$rx] value='$fieldb2'>";
	}
echo "<td align='left'>$fieldc2</td><td>&nbsp;</td></tr>";
$rx++;
}
$rd++;
}
if($_SESSION['mpms_edit']=='1'){
	echo "	<Input Type=Hidden Name=vcode_proj Value=$mvcode_proj";
 ?>
  <tr>
  <td  colspan="4"  align=center ><br>บันทึก... คลิกที่รูปนี้ >><input type ="image" src="./images/b_save.png"  onClick="return  Conf(this)"><br><br></td>
</tr><?php }?></Form>
</table></td></tr></TABLE>

<SCRIPT  language=javascript>
	 var frm = document.mylist;
</SCRIPT>
</BODY></HTML>