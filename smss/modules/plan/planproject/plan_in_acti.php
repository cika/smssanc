<?php
// ตรวจสอบปีงบประมาณ
if($_SESSION["budget_year"]==""){
echo "<br>";
echo "<div align='center'>";
echo "ตรวจสอบการกำหนดปีงบประมาณให้ถูกต้องก่อนค่ะ";
echo "</div>";
exit();
}

if($_SESSION["sd_year"]==""){
echo "<br>";
echo "<div align='center'>";
echo "ตรวจสอบการกำหนดปีมาตรฐานการศึกษาก่อนค่ะ";
echo "</div>";
exit();
}
require_once("plan_function.php");
require_once("plan_editcalendar.php");
require_once("plan_calendar.php");
require("plan_authen.php");  //session_

?>

<link rel="stylesheet"  href="./css/js/style.css" type="text/css"/>
<script type="text/javascript" src="./css/js/calendarDateInput.js"></script> 
<p align="center"><Center>
<Br><Font Size=3 color='#000099'><B>กำหนดกิจกรรมของโครงการ ปีงบประมาณ <?php echo $_SESSION['budget_year']?></B></Font></p>
<form id='frm1' name='frm1'>
<Table width="99%"  border="1" borderColor="#FFCCFF" align="center" cellpadding="0" cellspacing="0">
<tr><td align="center"><b>เลือกกลุ่ม(งาน)</b></td></td><td align="center"><b>เลือกโครงการ</b></td><td align="center"><b>กำหนดกิจกรรม</b></td></tr>
<tr>
<td width="19%" align="center" valign="top"> 
      <Table width="100%" border="0" cellpadding="0" cellspacing="2">
        <tr> 
          <td align="left" valign="top">
<?php
		include("plan_grouplistadd.php");
?>
	   </td>
	 </tr>
	 </table>	
</td>
<td width="30%" align="center" valign="top" > 
      <table width="100%" border="0" cellpadding="0" cellspacing="2">
        <tr>
          <td align="left" valign="top">
<?php
			echo "<div id=\"iframe\">";
			echo "<IFRAME src=\"modules/plan/planproject/plan_projlistadd.php?vcode_clus=$mcode_clus\"  frameborder=\"0\"  width=\"100%\" height= \"355\" scorlling=\"auto\" > </IFRAME>";
?>
	   </td>
	 </tr>
	 </table>	
</td>
<!-- Part2	###################   -->
<TD  width="50%"  valign="top" > 
<TABLE width="100%" border="0" borderColor=#FF0033 cellpadding="0" cellspacing="0" >
    <tr> 
      <TD>
            <TABLE width="100%"  border=0 borderColor=#99CC33 cellpadding="3" cellspacing="0">
			<tr><td align="right"><b><font color="#003333" size="2" face="MS Sans Serif">วัน- เดือน-ปี : </font></b></td>
                    <td width="80%" align="left"><font color="#003333" size="2" face="MS Sans Serif">
					<?php
					$N=date("d"); 
					echo "<Select name='myday'  STYLE='font-family : monospace; 
     font-size : 11pt'>";
					While ($N<=31)
						{
							$mn = Chop($N);
							$mn=substr('00'."".$mn,-2,2);
						echo "<Option value='$mn'>$mn</option>";
						$N++;
						}
						echo "</Select>";
						$N=date("m");
					echo "<Select name='mymonth'   STYLE='font-family : monospace; 
     font-size : 11pt'>";
					While ($N<=12)
						{
							$mmonth=$thaimonthFull[$N-1];
							$mn = Chop($N);
						echo "<Option value='$mn'>$mmonth</option>";
						$N++;
						}
						echo "</Select>";
						$pointyear=$Ynum+543;
						$N=date("Y")+543;
						echo "<Select name='myyear'   STYLE='font-family : monospace; 
     font-size : 11pt'>";
					While ($N<=$pointyear)
						{
						echo "<Option value='$N'>$N</option>";
						$N++;
						}
						echo "</Select>";
					?></font>
					</Select> 
					</td></tr>
					 <tr> 
                    <td align="right"><b><font color="#003333" size="2" face="MS Sans Serif">รหัสกิจกรรม :</font></b></td>
                    <td align="left"> <input size=4 type=text name="vcode_acti" maxlength=3 value=''> 
                    </td></tr>
				<tr> 
                    <td align="right"><b><font color="#003333" size="2" face="MS Sans Serif">กิจกรรม :</font></b></td>
                    <td align="left"> <textarea name='vname_acti' rows = '3' cols='40' ></textarea>
                    </td></tr>
<tr> 
                    <td align="right"><b><font color="#003333" size="2" face="MS Sans Serif">วันเริ่มต้นกิจกรรม :</font></b></td>
                    <td align="left"> <script>
								var Y_date=<?php echo $Ynum?>  
								var m_date=<?php echo $mnum?>  
								var d_date=<?php echo $dnum?>  
								Y_date= Y_date+'/'+m_date+'/'+d_date
								DateInput('mybeginday', true, 'YYYY-MM-DD', Y_date)</script> 
                    </td></tr>
				<tr> 
                    <td align="right"><b><font color="#003333" size="2" face="MS Sans Serif">วันสิ้นสุดกิจกรรม :</font></b></td>
                    <td align="left"> <script>
								var Y_date=<?php echo $Ybudget?>  
								var m_date=<?php echo $mbudget?>  
								var d_date=<?php echo $dbudget?>  
								Y_date= Y_date+'/'+m_date+'/'+d_date
								DateInput('myfinishday', true, 'YYYY-MM-DD', Y_date)</script> 
                    </td></tr>
				<tr> 
                    <td align="right"><b><font color="#003333" size="2" face="MS Sans Serif">จำนวนเงิน :</font></b></td>
                    <td align="left"> <input  size=9 type=text  name="vbudget_acti" maxlength=9 > 
					</td></tr>	
					
                 <tr> 
                    <td align="right"><b><font color="#003333" size="2" face="MS Sans Serif">แหล่งเงิน :</font></b></td>
                    <td align="left">
					<?php
echo "<br />";

		echo "<Select  name='vcode_approve' size='1'>";
		echo  "<option  value = ''>เลือก</option>" ;
		$sql_type = "select  distinct  budget_main.type_id, budget_type.type_name  from budget_main left join budget_type on budget_main.type_id=budget_type.type_id where (budget_main.status='1' or budget_main.status='2') and budget_main.budget_year='$_SESSION[budget_year]' and budget_main.type_id<'200' order by budget_main.type_id";
		$dbquery_type =DBfieldQuery($sql_type);
		While ($result_type = mysql_fetch_array($dbquery_type))
		   {
		$type_id = $result_type['type_id']; 
		$type_name = $result_type['type_name']; 
		echo  "<option value = $type_id>$type_id $type_name</option>";
			}
			
		$sql = "select  id, item from  budget_bud where status='1' and budget_year='$_SESSION[budget_year]' order by id";
$dbquery =DBfieldQuery($sql);
		While ($result = mysql_fetch_array($dbquery))
		   {
		$id = $result['id']+400;
		$item_name = $result['item'];
		echo  "<option value = $id>$id $item_name</option>";
			}
		echo "</select>";	
					
				?>	
                    </td></tr>
					
              </table>
		</TD>
	 </table>
<?php
 //คำนวณเงิน 
 require_once("dbconfig.inc.php");

$sql_proj = "SELECT sum(budget_proj) as budget_proj_sum FROM  plan_proj  where  code_proj=$_SESSION[mcode_proj] and budget_year=$_SESSION[mplan_year] ";
$dbquery =DBfieldQuery($sql_proj);
$print_r=print_r($dbquery,true); //กรณีไม่มีข้อมูล
$budget_proj_sum=0;
if(!empty($print_r)){
$result = mysql_fetch_array($dbquery);
$budget_proj_sum=$result['budget_proj_sum'];
}
$sql_acti="select sum(budget_acti) as budget_acti_sum from  plan_acti  where code_proj=$_SESSION[mcode_proj] and budget_year=$_SESSION[mplan_year] ";
$dbquery =DBfieldQuery($sql_acti);
$print_r=print_r($dbquery,true); //กรณีไม่มีข้อมูล
$budget_acti_sum=0;
if(!empty($print_r)){
$result = mysql_fetch_array($dbquery);
$budget_acti_sum=$result['budget_acti_sum'];
}
//**************************************************
$mbalance=$budget_proj_sum-$budget_acti_sum;
$mbalance=number_format($mbalance,2);
$budget_proj_sum=number_format($budget_proj_sum,2);
$budget_acti_sum=number_format($budget_acti_sum,2);
echo "<BR><CENTER><FONT size='1' face='MS Sans Serif' color='#000099'>ยอดจัดสรร(โครงการ)&nbsp;$budget_proj_sum&nbsp;&nbsp;บาท&nbsp;&nbsp;รวมทุกกิจกรรม&nbsp;$budget_acti_sum&nbsp;&nbsp;บาท&nbsp;&nbsp;</font><FONT size='2' face='MS Sans Serif' color='#CC0000'>คงเหลือ&nbsp;$mbalance&nbsp;บาท</font>";
echo "<p align='center'><Br>";
echo "	<Input Type=Hidden Name=vcode_clus Value=$mcode_clus>";
echo "	<Input Type=Hidden Name=vcode_proj Value=$mcode_proj>";
echo "	<Input Type=Hidden Name=vname_proj Value=$mname_proj>";
echo "	<Input Type=Hidden Name=vbudget_proj Value=$mbudget_proj>";
//echo "	<Input Type=Hidden Name=vid_defalt  Value=$midentify>";
if($_SESSION["mpms_add"]=='1')
{
echo " <Input Type='button' name='smb' value='เพิ่มข้อมูล' onclick='goto_url_update(1)' class='button'>";
}
else{
echo "<div align='center'><font size='3' color='#FF0033'>คุณไม่ไ้ด้รับสิทธิ์บันทึกข้อมูล</font></div>";
}
echo "</p>";
echo "</CENTER><BR>";
 //====== end menu ====
?>
 </table>
<!-- Part3	## -->

<Table width="99%" Border="1" borderColor=#990000  Bgcolor="#FFFFFF" Face="Ms Sans Serif" align="center">
<?php
echo   "<Tr>";
echo   "<Td  width='7%'  bgcolor='#E8B066'  valign='center'  align='center' >รหัสกิจกรรม</td>";
echo   "<Td  bgcolor='#E8B066'  valign='center'  align='center' >กิจกรรม</td>";
echo   "<Td  width='13%'  bgcolor='#E8B066'  valign='center'  align='center' >จำนวนเงิน</td>";
echo   "<Td  width='7%'  bgcolor='#E8B066'  valign='center'  align='center' >รหัสแหล่งเงิน</td>";
echo   "<Td  width='5%'  bgcolor='#E8B066'  valign='center'  align='center' >รายละเอียด</td>";
if($_SESSION["mpms_edit"]=='1')
{
echo   "<Td  width='5%'  bgcolor='#E8B066'  valign='center'  align='center' >แก้ไข</td>";
}
if($_SESSION["mpms_dele"]=='1')
{
echo   "<Td  width='5%'  bgcolor='#E8B066'  valign='center'  align='center' >ลบ</td>";
}
echo   "<Td  width='15%'  bgcolor='#E8B066'  valign='center'  align='center' >มาตรฐานการศึกษา</td></tr>";
$mcode_proj=$_SESSION['mcode_proj'];
$mplan_year=$_SESSION['mplan_year'];
$sql_acti="select * from  plan_acti  where code_proj=$mcode_proj and budget_year=$mplan_year order by code_acti";
$dbquery =DBfieldQuery($sql_acti);
$print_r=print_r($dbquery,true); //กรณีไม่มีข้อมูล
if(!empty($print_r)){
while ($result = mysql_fetch_array($dbquery))
	{
	$id =  $result['id'];
	$daythai =  $result['daythai'];
	$code_acti =$result['code_acti'];
	$code_approve =$result['code_approve'];
	$name_acti = $result['name_acti'];
	$tbudget_acti =$result['budget_acti'];
	$budget_approve =$result['budget_approve'];
	$owner_acti =$result['owner_acti'];
	$id_defalt = $result['id_defalt'];
	$mybeginday=$result['begin_date'];
	$myfinishday=$result['finish_date'];
	$id_defalt = substr($id_defalt,0,9);
    $actiname= substr($name_acti,0,60);
	$Fcredit1=number_format($tbudget_acti,2);
	$len=strlen($owner_acti);
	$point=strpos($owner_acti,' ');
	$long=$len-$point;
	$fname=substr($owner_acti,0,$point);
	$sname=substr($owner_acti,-$long,$long);
	$cname=trim($sname);
	echo   "<Tr>";
	echo   "<Td align='center' ><FONT size='2' face='MS Sans Serif' color='#330000'>$code_acti</td>";
	echo   "<Td align='left' ><FONT size='2' face='MS Sans Serif' color='#330000'>&nbsp;$name_acti</td>";
	echo   "<Td valign='center'  align='right' ><FONT size='2' face='MS Sans Serif' color='#330000'>$Fcredit1&nbsp;&nbsp;&nbsp;</td>";
	echo   "<Td valign='center'  align='center' ><FONT size='2' face='MS Sans Serif' color='#330000'>$code_approve&nbsp;&nbsp;&nbsp;</td>";
	echo   "<Td><div align=center><a href=?option=plan&task=planproject/plan_detailacti&plan_acti_id=$id><img src=\"./images/b_browse.png\" WIDTH='16' HEIGHT='16' BORDER=0 ALT='รายละเอียด'></a></div></Td>";
if($_SESSION["mpms_edit"]=='1'){
	echo   "<Td><div align=center><a href=?option=plan&task=planproject/plan_editacti&plan_acti_id=$id><img src=\"./images/b_edit.png\" WIDTH='16' HEIGHT='16' BORDER=0 ALT='แก้ไขกิจกรรม'></a></div></Td>";
}
if($_SESSION["mpms_dele"]=='1'){
	echo   "<Td><div align=center><a href=?option=plan&task=planproject/plan_deleacti&delete_id=$id&vcode_proj=$mcode_proj><img src=\"./images/b_drop.png\" WIDTH='16' HEIGHT='16' BORDER=0 ALT='ลบกิจกรรม'></a></div></Td>";
}	
echo   "<Td align=center><a href=?option=plan&task=planproject/plan_estandard&gcode_acti=$code_acti&vcode_clus=$mcode_clus&vcode_proj=$mcode_proj><img src=\"./images/estandard.jpg\"  WIDTH='42' HEIGHT='16' BORDER=0 ALT='มฐ.ปฐมวัย'></a>&nbsp; <a href=?option=plan&task=planproject/plan_bstandard&gcode_acti=$code_acti&vcode_clus=$mcode_clus&vcode_proj=$mcode_proj><img src=\"./images/bstandard.jpg\"  WIDTH='42' HEIGHT='16' BORDER=0 ALT='มฐ.ขั้นพื้นฐาน'></a></Td>";

}}
			$mclus_code=$_SESSION['vclus_code'];
			$mproj_code=$_SESSION['vproj_code'];
			$mproj_name=$_SESSION['vproj_name'];
			$mbudget_proj=$_SESSION['vbudget_proj'];
?>  
       </Td>
	 </Tr>
</Table>
        </Tr>
<!-- loop  ok-->
    </Table>
	<BR>
	<BR>
</Center>
 </form>
<script>
function goto_url_update(val){
	var v1 = document.frm1.vcode_acti.value;
	if(val==0){
		callfrm("?option=plan");   // page ย้อนกลับ vcode_clus 	
	}
	else if(val==1)
	{ 
			if(frm1.vcode_proj.value == "")
				 {
				alert("กรุณาเลือกโครงการ");
				document.frm1.vcode_acti.focus();
				return false;
				}
				else if (v1.length!=3) 
						{
						alert("กรุณาป้อน	รหัสกิจกรรม \n 001,002,...");
						document.frm1.vcode_acti.focus();
						return false;
						}
				else if(frm1.vname_acti.value == "")
						{
						alert("กรุณาป้อน กิจกรรม");
						document.frm1.vname_acti.focus();
						return false;
						}
				else if(frm1.vbudget_acti.value == "")
						{
						 alert("กรุณาป้อน จำนวนเงิน");
						document.frm1.vbudget_acti.focus();
						return false;
						}
				else
						{ 
					if (confirm("ยืนยันต้องการบันทึก? \nDo you want to save?") == true){
		callfrm("?option=plan&task=planproject/plan_addacti"); }return false;} //page ประมวลผล
			} // if(val==1)
} //goto_url_update(val)
</script>
