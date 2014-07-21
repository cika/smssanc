<?php 
session_start();
$ref_id= $_SESSION ['ref_id'] ;

if(isset($_REQUEST['index'])){
	$index=$_REQUEST['index'];
}else{
	$index="";
}
if(isset($_REQUEST['sd_index'])){
	$sd_index=$_REQUEST['sd_index'];
}else{
	$sd_index="";
}
?>

<html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SMSS ระบบสนับสนุนการบริหารจัดการสถานศึกษา [เลือกผู้รับจดหมาย]</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/mm_training.css" type="text/css" />

</head>

<body topmargin="0" leftmargin="0" >

<div align="center">
<table border="0" width="100%" style="border-collapse: collapse">
		<tr>
			<td bgcolor="#800000"><font face="Tahoma"><font size="2">&nbsp;</font><span lang="th"><font size="2" color="#FFFFFF"><B>กรุณาคลิกเลือกผู้รับ</B></font></span></font> </td>
		</tr>
		</table>

  <form method="POST" action="select_send.php" name="form1" onSubmit="return checkform();">
  <TABLE border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" width=95% bordercolor="#808000" bgcolor="#FFFBEA">
     <TR >   
	 <td colspan=4>&nbsp;<input name="allbox" onClick="selectall();" type="checkbox"><FONT SIZE="2" COLOR="#990033">เลือก/ไม่เลือกทั้งหมด</FONT><HR></td>
	 </tr>
	 <tr>

	   
<?php 
//require_once "../../../amssplus_connect.php";	
require_once "../../../smss_connect.php";	
require_once("../../../mainfile.php");


if($index==1){
$s_id=$_POST['s_id'];
	for ($i=1;$i<=$_POST['boxchecked'];$i++){
			if (isset($_POST['s_id'][$i])!="") // Check Select Topic
				{ 
					mysql_query("INSERT INTO mail_sendto_answer (send_to,ref_id) Values('$s_id[$i]','$ref_id') ") ;
				}
		}
}

if($index==2){
mysql_query("DELETE FROM mail_sendto_answer WHERE send_to='$_GET[sendtoname]' and ref_id='$ref_id' ") ;
}

//$sd_index=isset($_REQUEST['sd_index'])?$_REQUEST['sd_index']:"";

if($sd_index=='some'){
$result1=mysql_query ("SELECT * FROM  person_main WHERE status='0' order by  position_code, person_order ") ;
}
else{
$result1=mysql_query ("SELECT * FROM  mail_group_member left join person_main on mail_group_member.person_id=person_main.person_id WHERE  mail_group_member.grp_id= '$sd_index' and person_main.status='0' order by person_main.position_code, person_main.person_order ") ;
}
$num1 = mysql_num_rows ($result1) ;

$list1=1;
while ($r1=mysql_fetch_array($result1)) {
	$e_name = $r1['person_id'] ;
	$prename = $r1['prename'] ;
	$name = $r1['name'] ;
	$surname = $r1['surname'] ;
	$fullname=$prename.$name." ".$surname;
	
$result_select=mysql_query ("SELECT * FROM mail_sendto_answer WHERE send_to='$e_name' and ref_id='$ref_id'") ;
$num_select = mysql_num_rows ($result_select) ;
	if ($num_select==0) {
	   ?>
		  <TD  width="25%">&nbsp;&nbsp;&nbsp;<input type="checkbox" name="s_id[<?php  echo $list1?>]" value="<?php  echo $e_name?>"><FONT SIZE="2" COLOR="#660099"><?php  echo $fullname?></FONT></TD>
	
	<?php 
	}
		if($list1%2==0){
		echo "</tr><tr>";}
$list1 ++ ;
} 
?>
 </TR>
  	 </table>
<BR><input name="boxchecked" type="hidden" id="boxchecked" value="<?php  echo $list1?>"> <input name="sd_index" type="hidden"  value="<?php  echo $sd_index?>"><input name="index" type="hidden"  value="1">
	 <CENTER><input type="submit" value="  เลือก  " name="submit">
<HR>	</form>
<!--Userที่เลือกแล้ว -->
<?php 

$result2=mysql_query ("SELECT * FROM mail_sendto_answer left join person_main on mail_sendto_answer.send_to=person_main.person_id WHERE mail_sendto_answer.ref_id='$ref_id' ") ;
$num2 = mysql_num_rows ($result2) ;

?>
  <div align="center">
	<table border="0" width="400"  style="border-collapse: collapse" bgcolor="#EAFFF0">
		<form method="POST" action="" name="form2" >
			<tr>
				<td>&nbsp;<b><font size="2" color="#800080">รายชื่อผู้รับสารที่เลือกไว้ 
				จำนวน <FONT SIZE="2" COLOR="#FF0066"><?php  echo $num2 ?></FONT> คน</font></b></td>
			</tr>
			<tr>
				<td>
<?php 
$list2=1;
while ($r2=mysql_fetch_array($result2)) {
	$sendtoname  = $r2['send_to'] ;
	$e_name = $r2['person_id'] ;
	$prename = $r2['prename'] ;
	$name = $r2['name'] ;
	$surname = $r2['surname'] ;
	$fullname=$prename.$name." ".$surname;
?>&nbsp;<FONT SIZE="2" COLOR=""><A HREF="select_send.php?sendtoname=<?php  echo $sendtoname?>&index=2&sd_index=<?php  echo $sd_index?>"><IMG SRC="../../../images/b_drop.png" WIDTH="16" HEIGHT="16" BORDER="0" ALT="ลบออก"></A>&nbsp; <?php  echo $list2?>. <?php  echo $fullname?></FONT><BR>
				
<?php 
$list2 ++ ;
} 
?>			
				</td>
			</tr>
			<tr>
				<td>
				<p align="center">
				<input type="submit" value="  เสร็จ  " name="submit1" onClick="javascript:window.close()">
				</td>
			</tr>
		</form>
	</table>
</div><HR>
</body>
<script language="JavaScript">
<!--
function selectall(){
	for (var i=0;i<document.form1.elements.length;i++)
	{
		var e = document.form1.elements[i];
		if (e.name != 'allbox')
			e.checked = document.form1.allbox.checked;
	}
}

function checkform() {
var checkvar = document.all;
var check = "";
  for (i = 0; i < checkvar.length; i++) {
    if (checkvar[i].checked){
      check = "Y";
      break;
    }
  }
  if (check==""){
    alert("กรุณาเลือก CheckBox อย่างน้อย 1 รายการค่ะ");
    return false;
  }else{
	 return confirm ("คุณต้องการส่งสารตามรายชื่อที่ได้เลือกไว้ ?");
    return true;
  }
}
</script>

</html>