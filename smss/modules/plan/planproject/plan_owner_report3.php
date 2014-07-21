<?php
require_once("dbconfig.inc.php");
$sql = "SELECT * FROM  plan_proj  where id='$_GET[plan_proj_id]' ";
$dbquery =DBfieldQuery($sql);
$result = mysql_fetch_array($dbquery);
	$id =$result['id'];
	$workgroup =$result['code_clus'];
	$budget_year =$result['budget_year'];
	$w_code_proj =$result['code_proj'];
	$w_name_proj = $result['name_proj'];
	$w_eval_activity =$result['eval_activity'];
	$w_eval_result =$result['eval_result'];
	$w_eval_obstacle =$result['eval_obstacle'];
?>
<link rel="stylesheet"  href="./css/js/style.css" type="text/css"/>
<script type="text/javascript" src="./css/js/calendarDateInput.js"></script> 
<p align="center"><font color="#FFCC00"></font><Center><b>
<Font face="Tahoma" Size=4 color='#000099'><BR>::: รายงานโครงการ : <?php echo $w_name_proj?> ปีงบประมาณ <?php echo $budget_year?> :::</Font></b>
<Br><BR><BR>
<form Enctype = 'multipart/form-data'  name='frm1'>
<TABLE width="100%"  border="0" align="center" cellpadding="2" cellspacing="2" height="50">
<TR><TD  width="10%" valign="top"></TD><td width="90%" > 
<TABLE width="100%" border="0" borderColor=#FF0033 cellpadding="0" cellspacing="0">
<tr><td align="right"><b><font size="3" face="MS Sans Serif" color="#009900">วิธีการดำเนินงาน&nbsp;&nbsp;</font></b></td>
<td align='left' > <textarea name='eval_activity' rows = '6' cols='60' readonly="readonly"><?php echo $w_eval_activity?></textarea>
</td></tr>
<tr><td align="right"><b><font size="3" face="MS Sans Serif" color="#009900">ผลการดำเนินงาน&nbsp;&nbsp;</font></b></td>
<td align='left' > <textarea name='eval_result' rows = '6' cols='60' readonly="readonly"><?php echo $w_eval_result?></textarea>
</td></tr>
 <tr><td align="right"><b><font size="3" face="MS Sans Serif" color="#009900">ข้อค้นพบหรือข้อเสนอแนะ&nbsp;&nbsp;</font></b></td>
<td align='left' > <textarea name='eval_obstacle' rows = '6' cols='60' readonly="readonly"><?php echo $w_eval_obstacle?></textarea>
</td></tr>
</table>
</TD></TR></table>

 <?php
echo "<p align='center'>";
echo "<INPUT TYPE='button' name='smb' value='ย้อนกลับ' onclick='goto_url(0)' class='button'>";
echo "</p>";
?>
<!-- Part2 -->
<BR>
</Center>
</form>
<script>
function goto_url(val){
	callfrm("?option=plan&task=planproject/plan_owner_report&year_index=<?php echo $budget_year?>&workgroup=<?php echo $workgroup?>");   
}
</script>
