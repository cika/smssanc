<?php
	session_start();
$_SESSION['mpms_moderate']=1;

	if($_SESSION['mpms_moderate']!=1){
	?><script>
			alert("คุณไม่มีสิทธ ิ์\n บันทึกการจัดสรร");
		</script><?
}
$acti=$_REQUEST["myacti"];
$nameacti=$_REQUEST["nameacti"];
$_SESSION["vcode_allo"]=$acti;
$_SESSION["vname_allo"]= $nameacti; 
require("./javachkbox.html");   /* Conf(this) */
error_reporting(E_ALL ^ E_NOTICE);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<META http-equiv=Content-Type content="text/html; charset=windows-874">
<meta name="generator" content="Namo WebEditor">
<link rel="stylesheet"  href="./css/js/style.css" type="text/css"/>
<BODY leftMargin=0 topMargin=0>

<Form action="addrecords.php" method=post  name=mylist onSubmit="javascript:window.open('','_self');window.close()">

<BR><p><b><font size="2" color="blue">&nbsp;&nbsp;<?=$nameacti?></p>
<CENTER><br>
<table width="70%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td bordercolor="#FFCC33">
    <table width="100%" border="1" cellspacing="0"  bgcolor="#FFFFbb"  bordercolordark="white">
  <tr>
    <td  colspan="5"  bgcolor="#FFCC33"  height="38"><b>&nbsp;<font color='#000000' size='2' face='MS Sans Serif'> :: เลือกมาตรฐานการศึกษาขั้นพื้นฐาน </b></td></tr>
     <tr><td><input  type="checkbox" name="allchk"   onClick="CheckAll()"</td>
     <th>#</th><th width='10%'><font color='#006633' size='2' face='MS Sans Serif'>มาตรฐานที่</th><th  align="center"><font color='#006633' size='2' face='MS Sans Serif'>รายละเอียด</th><th width='10%' align="center"><font color='#006633' size='2' face='MS Sans Serif'>ปี พ.ศ.</th></tr>
<?
require_once("dbconfig.inc.php");
$sql = "SELECT *  FROM  standard_basic_sd ORDER BY sd_id  ASC ";
$result1 = DBfieldQuery($sql);
$num_rows = mysql_num_rows($result1);
$rd=0;
while ($rd < $num_rows)
	{
	$fetcharr = mysql_fetch_array($result1);
	$id[$rd] = $fetcharr['id'];
	$fielda = $fetcharr['sd_year'];
	$fieldb[$rd] = $fetcharr['sd_id'];
	$fieldc = $fetcharr['sd_name'];
	$field1 = $fieldb[$rd];
	$field2 = $fieldb."&nbsp;--&nbsp;".$fieldc;
     echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td  align='left' ><b><font color='#000000' size='3' face='MS Sans Serif'>&nbsp;$field1</b></td>"; 
echo "<td align='left'>$fieldc</td>";
echo "<td align='center'>$fielda</td></tr>";
//===============
$sql = "SELECT *  FROM  standard_basic_indicator where sd_id=$fieldb[$rd]  ORDER BY id_indicator  ASC ";
$result2 = DBfieldQuery($sql);
$rx=0;
While($fetcharr = mysql_fetch_array($result2) ) { 
	$id[$rx] = $fetcharr['id'];
	$fielda2 = $fetcharr['sd_id'];
	$fieldb2 = $fetcharr['id_indicator'];
	$fieldc2 = $fetcharr['indicator_name'];
	$field12 = $fieldb2;
	$field22 = $fieldb2."&nbsp;--&nbsp;".$fieldc2;
     echo "<tr><td>&nbsp;</td><td><input  type=checkbox  name=$id[$rx]   onClick=CCA(this) ></td><td  align='center' ><font color='#000000' size='2' face='MS Sans Serif'>$field12</td>"; 
echo "<td align='left'>$fieldc2</td>";
echo "<td align='center'>&nbsp;</td></tr>";
$rx++;
}
$rd++;
}
if($_SESSION['mpms_moderate']=='1'){
 ?>
  <tr>
  <td  colspan="4"  align=center ><br>บันทึก... คลิกที่รูปนี้ >>
<input type ="image" src="../images/b_save.png"  onClick="return  Conf(this)"><br><br></td>
</tr><?}?></Form>
</table></td></tr></TABLE>

<SCRIPT  language=javascript>
	 var frm = document.mylist;
</SCRIPT>
<!-- <a href=index.php>Main Page</a> -->
</BODY></HTML>