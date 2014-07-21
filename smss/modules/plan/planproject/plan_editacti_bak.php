<?
session_start();
if($_SESSION['mpms_edit']!=1){
	?><script>
			alert("คุณไม่มีสิทธิ์");
			document.location.href="?option=plan&task=planproject/plan_in_acti";
		</script><?
}
require_once("plan_function.php");
require_once("plan_editcalendar.php");
require_once("plan_calendar.php");
require_once("plan_authen.php");  //session_
$vidperson=$_SESSION["m9idperson"];
?>
<script type="text/javascript" src="./css/js/calendarDateInput.js"></script>
<form id='acti_form' name='frm1'>
<p align="center"><Center>
<Br><Font Size=3 color='#000099'><B> เธเธฅเธธเนเธก / เธเธฅเธธเนเธกเธเธฒเธ / เนเธเธฃเธเธเธฒเธฃ เธ—เธตเนเธ•เนเธญเธเธเธฒเธฃเนเธเนเนเธเธฃเธฒเธขเธเธฒเธฃเธขเนเธญเธข</B></Font></p>
<Table width="100%"  border="0" align="center" cellpadding="2" cellspacing="2" height="34">
<tr> 
  <td height="30" align="left" ><font size="2" face="MS Sans Serif"><b>&nbsp;&nbsp;เธฃเธฒเธขเธเธทเนเธญเธเธฒเธ&nbsp;&nbsp;&nbsp; -----------------------------&gt; &nbsp;&nbsp;&nbsp;&nbsp; เธเธฒเธ/เนเธเธฃเธเธเธฒเธฃ...</b></font></td>
</tr>
</table>
<Table width="99%"  border="1" borderColor=#FFCCFF  align="center" cellpadding="0" cellspacing="0">
<tr>
<td width="19%" align="center" valign="top"> 
      <Table width="100%" border="0" cellpadding="0" cellspacing="2">
        <tr height="333" > 
          <td  height="333"  bgcolor='#FFCCE6' valign = "top"><BR><font size="2" face="MS Sans Serif">
<?=$mcode_clus.'. '.$mname_clus?></font>
	   </td>
	 </tr>
	 </table>	
</td>
<td width="30%" align="center" valign="top" > 
      <table width="100%" border="0" cellpadding="0" cellspacing="2">
        <tr height="333">
          <td  height="333"  bgcolor='#FFD7EB' valign = "top"><BR><font size="2" face="MS Sans Serif">
<?=$mcode_proj.'. '.$mname_proj?></font>
	   </td>
	 </tr>
	 </table>	
</td>
<!-- Part2	################### -->
<TD  width="50%"  valign="top" > 
<TABLE width="100%" border="0" borderColor=#FF0033 cellpadding="0" cellspacing="0" >
    <TR>
        <td><div align="center"><font color="#CC0000" size="2" face="MS Sans Serif"><strong><?=$mname_proj?> </strong></font><br> </div></td>
    </TR>
    <tr> 
      <TD>
            <TABLE width="100%"  border=0 borderColor=#99CC33 cellpadding="3" cellspacing="0">
		    <tr><td align="left" colspan='2'><font color="#003333" size="2" face="MS Sans Serif"><?=$ThaiDateFull?></font></td></tr>
			<tr><td align="right"><b><font color="#003333" size="2" face="MS Sans Serif">เธงเธฑเธ- เน€เธ”เธทเธญเธ-เธเธต : </font></b></td>
                    <td width="80%"  align="left"><font color="#003333" size="2" face="MS Sans Serif">
					<?
					$N=date("d");
					echo "<Select name='myday' size='1'>";
					While ($N<=31)
						{
							$mn = Chop($N);
							$mn=substr('00'."".$mn,-2,2);
						echo "<Option value='$mn'>$mn</option>";
						$N++;
						}
						echo "</Select>";
						$N=date("m");
					echo "<Select name='mymonth' size='1'>";
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
						echo "<Select name='myyear' size='1'>";
					While ($N<=$pointyear)   /*########  year  #########*/
						{
						echo "<Option value='$N'>$N</option>";
						$N++;
						}
						echo "</Select>";
					?></font>
					</Select> 
					</td></tr>
					 <tr> 
                    <td align="right" ><b><font color="#003333" size="2" face="MS Sans Serif">เธฃเธซเธฑเธชเธเธดเธเธเธฃเธฃเธก :</font></b></td>
                    <td align="left"> <input size=6 type readonly=text name="vcode_acti" value=<?=$vcode_acti?>> 
                    </td></tr>
                 <tr> 
                    <td align="right"><b><font color="#003333" size="2" face="MS Sans Serif">เธฃเธซเธฑเธชเน€เธเธดเธ :</font></b></td>
                    <td align="left">
					<?
					$sql = "select * from  budget_year where year_active='1' order by budget_year desc limit 1";
					$dbquery =DBfieldQuery($sql);
$year_active_result = mysql_fetch_array($dbquery);
if($year_active_result[budget_year]==""){
echo "<br />";
echo "<div align='center'>เธขเธฑเธเนเธกเนเนเธ”เนเธเธณเธซเธเธ”เธ—เธณเธเธฒเธเนเธเธเธตเธเธเธเธฃเธฐเธกเธฒเธ“เนเธ” เน</div>";
}

echo "<br />";

		echo "<Select  name='vcode_approve' size='1'>";
		echo  "<option  value = ''>เน€เธฅเธทเธญเธ</option>" ;
		$sql_type = "select  distinct  budget_main.type_id, budget_type.type_name  from budget_main left join budget_type on budget_main.type_id=budget_type.type_id where (budget_main.status='1' or budget_main.status='2') and budget_main.budget_year='$year_active_result[budget_year]' and budget_main.type_id<'200' order by budget_main.type_id";
		$dbquery_type =DBfieldQuery($sql_type);
		While ($result_type = mysql_fetch_array($dbquery_type))
		   {
		$type_id = $result_type['type_id']; 
		$type_name = $result_type['type_name']; 
		if ($vcode_approve==$type_id){
					echo "<Option value=$type_id selected>$type_id $type_name</option>";
					}else{echo "<option value = $type_id>$type_id $type_name</option>";
					}
			}
		$sql = "select  id, item from  budget_bud where status='1' and budget_year='$year_active_result[budget_year]' order by id";
		$dbquery =DBfieldQuery($sql);
		While ($result = mysql_fetch_array($dbquery))
		   {
		$id = $result['id']+400;
		$item_name = $result['item'];
		if ($vcode_approve==$id){
					echo "<Option value=$id selected>$id $item_name</option>";
					}else{echo "<option value =$id>$id $item_name</option>";
					}
			}
		echo "</select>";	
				?>	
                    </td></tr>
				<tr> 
                    <td align="right"><b><font color="#003333" size="2" face="MS Sans Serif">เธฃเธฒเธขเธเธฒเธฃ :</font></b></td>
                    <td align="left"> <textarea name='vname_acti' rows = '3' cols='50' ><?=$vname_acti?></textarea>
                    </td></tr>
				<tr> 
                    <td align="right"><b><font color="#003333" size="2" face="MS Sans Serif">เธงเธฑเธเน€เธฃเธดเนเธกเธ•เนเธเนเธเธฃเธเธเธฒเธฃ :</font></b></td>
                    <td align="left"> <script>
								var Y_date=<?=$eYnum?>  
								var m_date=<?=$emnum?>  
								var d_date=<?=$ednum?>  
								Y_date= Y_date+'/'+m_date+'/'+d_date
								DateInput('mybeginday', true, 'YYYY-MM-DD', Y_date)</script> 
                    </td></tr>
				<tr> 
                    <td align="right"><b><font color="#003333" size="2" face="MS Sans Serif">เธงเธฑเธเธชเธดเนเธเธชเธธเธ”เนเธเธฃเธเธเธฒเธฃ :</font></b></td>
                    <td align="left"> <script>
								var Y_date=<?=$eYbudget?>  
								var m_date=<?=$embudget?>  
								var d_date=<?=$edbudget?>  
								Y_date= Y_date+'/'+m_date+'/'+d_date
								DateInput('myfinishday', true, 'YYYY-MM-DD', Y_date)</script> 
                    </td></tr>
				<tr> 
                    <td align="right"><b><font color="#003333" size="2" face="MS Sans Serif">เธเธณเธเธงเธเน€เธเธดเธเธเธฑเธ”เธชเธฃเธฃ :</font></b></td>
                    <td align="left"> <input  size=9 type=text  name="vbudget_acti" maxlength=9 value=<?=$vbudget_acti?>> 
					</td></tr>	
				<tr> 
                    <td align="right"><b><font color="#003333" size="2" face="MS Sans Serif">เธเธณเธเธงเธเน€เธเธดเธเธญเธเธธเธกเธฑเธ•เธด :</font></b></td>
                    <td align="left"> <input  size=9 type=text  name="vbudget_approve" maxlength=9 value=<?=$vbudget_approve?>> 
					</td></tr>	
              </table>
		</TD>
	 </table>
<?
 //===== menu ======== int เนเธฅเธฐ float 
$lenproj_name = strlen($mname_proj); 
if  ($lenproj_name >0)
{include("plan_dbconnect.php");
}
else
{include("plan_dbconnon.php");
}
$m_credit = 0;
$dbquery =DBfieldQuery($sql);
$num_rows = mysql_num_rows($dbquery);
$i=0;
while ($i < $num_rows)
	{
		$result = mysql_fetch_array($dbquery);
		$tcode_acti = $result[code_acti];
		$tbudget_acti = $result[budget_acti];
		$m_credit =$m_credit + $tbudget_acti;
	$i++;
	}
//**************************************************
$mbalance=$mbudget_proj -$m_credit;
$Fmbalance=number_format($mbalance);
$Fmbudget51=number_format($mbudget_proj);
$Fm_credit=number_format($m_credit);
echo "<BR><CENTER><FONT size='1' face='MS Sans Serif' color='#000099'>เธขเธญเธ”เธเธฑเธ”เธชเธฃเธฃ&nbsp;$Fmbudget51&nbsp;&nbsp;เธเธฒเธ—&nbsp;&nbsp;เธฃเธงเธกเธ—เธธเธเธเธดเธเธเธฃเธฃเธก&nbsp;$Fm_credit&nbsp;&nbsp;เธเธฒเธ—&nbsp;&nbsp;</font><FONT size='2' face='MS Sans Serif' color='#CC0000'>เธเธเน€เธซเธฅเธทเธญ&nbsp;$Fmbalance&nbsp;เธเธฒเธ—</font>";
if ($chkmidcode ==$mid_person)
{
echo "<BR><BR><FONT size='1' face='MS Sans Serif' color='#1F76A1'>เธขเธดเธเธ”เธตเธ•เนเธญเธเธฃเธฑเธเธเธธเธ“$sname_perm&nbsp;&nbsp;$mname2</FONT>";
}
echo "<p align='center'>";
echo "<Br><A Href=\"#\" OnClick=\"goto_url_update(0);\" title=\"เธเธฅเธฑเธเธฃเธฒเธขเธเธฒเธฃเธขเนเธญเธขเธเธฒเธเนเธเธ\"><img src=\"./images/back.png\" width=\"20\" height=\"22\" border=\"0\" ALT=''></A>&nbsp;&nbsp;&nbsp;";
$mmm=strlen("$vcode_acti");
if  ($mmm == "6" ) 
{
echo "	<Input Type=Hidden Name=vidperson Value='$vidperson'>";
echo "	<Input Type=Hidden Name=Action Value=\"add\">";
echo " <Input Type='button' name='smb' value='เธเธฑเธเธ—เธถเธเธเธฒเธฃเนเธเนเนเธเธเนเธญเธกเธนเธฅ' onclick='goto_url_update(1)' class='button'>";
}
echo "</p>";
echo "</CENTER><BR>";
 //====== end menu ====
?>
 </table>
<!-- Part3	## -->

<Table width="99%" Border="1" borderColor=#990000  Bgcolor="#FFFFFF" Face="Ms Sans Serif" align="center">
<?php
echo   "<Tr><Td  width='10%' bgcolor='#E8B066'  valign='center'  align='center' >เธงเธฑเธ เน€เธ”เธทเธญเธ เธเธต</td>";
echo   "<Td  width='7%'  bgcolor='#E8B066'  valign='center'  align='center' >เธฃเธซเธฑเธชเธเธดเธเธเธฃเธฃเธก</td>";
echo   "<Td  width='5%'  bgcolor='#E8B066'  valign='center'  align='center' >เธฃเธซเธฑเธชเน€เธเธดเธ</td>";
echo   "<Td  width='42%'  bgcolor='#E8B066'  valign='center'  align='center' >เธฃเธฒเธขเธเธฒเธฃ</td>";
echo   "<Td  width='8%'  bgcolor='#E8B066'  valign='center'  align='center' >เธเธฑเธ”เธชเธฃเธฃ</td>";
echo   "<Td  width='8%'  bgcolor='#E8B066'  valign='center'  align='center' >เธญเธเธธเธกเธฑเธ•เธด</td>";
echo   "<Td  width='3%'  bgcolor='#E8B066'  valign='center'  align='center' >เนเธเนเนเธ</td>";
echo   "<Td  width='3%'  bgcolor='#E8B066'  valign='center'  align='center' >เธฅเธ</td>";
echo   "<Td  width='9%'  bgcolor='#E8B066'  valign='center'  align='center' >เธเธนเนเธเธฑเธเธ—เธถเธ</td></tr>";
$dbquery =DBfieldQuery($sql);
$num_rows = mysql_num_rows($dbquery);
$i=0;
while ($i < $num_rows)
	{
	$result = mysql_fetch_array($dbquery);
	$daythai =  $result[daythai];
	$tcode_acti =$result[code_acti];
	$code_approve =$result[code_approve];
	$tname_acti = $result[name_acti];
	$tbudget_acti =$result[budget_acti];
	$budget_approve =$result[budget_approve];
	$owner_acti =$result[owner_acti];
	$id_defalt = $result[id_defalt];
	$id_defalt = substr($id_defalt,0,9);
    $actiname= substr($acti_name,0,60);
	$Fcredit1=number_format($tbudget_acti);
	$Fcredit2=number_format($budget_approve);
	$len=strlen($owner_acti);
	$point=strpos($owner_acti,' ');
	$long=$len-$point;
	$fname=substr($owner_acti,0,$point);
	$sname=substr($owner_acti,-$long,$long);
	$cname=trim($sname);
	if  ($mpms_view == "1")
		{
		echo   "<Tr><Td valign='center'  align='left' ><FONT size='2' face='MS Sans Serif' color='#330000'>&nbsp;&nbsp;&nbsp;&nbsp;$daythai</td>";
		echo   "<Td align='center' ><FONT size='2' face='MS Sans Serif' color='#330000'>$tcode_acti</td>";
		echo   "<Td align='center' ><FONT size='2' face='MS Sans Serif' color='#330000'>$code_approve</td>";
		echo   "<Td align='left' ><FONT size='2' face='MS Sans Serif' color='#330000'>&nbsp;$tname_acti</td>";
		echo   "<Td valign='center'  align='right' ><FONT size='2' face='MS Sans Serif' color='#330000'>$Fcredit1&nbsp;&nbsp;&nbsp;</td>";
		echo   "<Td valign='center'  align='right' ><FONT size='2' face='MS Sans Serif' color='#330000'>$Fcredit2&nbsp;&nbsp;&nbsp;</td>";
		}
	if  ($mpms_edit == "1")
		{
		echo   "<Td align='center' ><IMG SRC='images/dot_red.png' WIDTH='5' HEIGHT='5' BORDER=0 ALT=''></A></td>";
		}
	if  ($mpms_dele == "1")
		{
		echo   "<Td align='center' ><IMG SRC='images/dot_red.png' WIDTH='5' HEIGHT='5' BORDER=0 ALT=''></A></td>";
		}
	if  ($mpms_view == "1")
		{
		echo   "<Td align='center' ><FONT size='1' face='MS Sans Serif' color='#330000'>$id_defalt</td></Tr>";
		}
	$i++;
	}
	//		$mclus_code=$vclus_code;
	//		$mproj_code=$vproj_code;
	//		$mproj_name=$vproj_name;
	//		$mbudget_proj=$vbudget_proj;
?>  
       </Td>
	 </Tr>
</Table>
        </Tr>
<!-- loop  ok-->
    </Table>
	<BR>
	<BR>
<?php
// เธเธฅเนเธญเธขเนเธซเนเธฃเธตเธเธญเธฃเนเธชเน€เธเนเธเธญเธดเธชเธฃเธฐเธเธฒเธเธเธฒเธฃเธ•เธดเธ”เธ•เนเธญ เนเธฅเธฐเธเธดเธ”เธเธฒเธฃเธ•เธดเธ”เธ•เนเธญ
?>
</Center>
</Font>
</form>
<script>
function goto_url_update(val){
	if(val==0){	callfrm("?option=plan&task=planproject/plan_in_acti&vcode_clus=$mcode_clus&vcode_proj=$mcode_proj&vname_proj=$mname_proj&vbudget_proj=$mbudget_proj");   // page เธขเนเธญเธเธเธฅเธฑเธ
	}
	else if(val==1)
	{ 
			if(acti_form.vname_acti.value == "")
				 {
				alert("เธเธฃเธธเธ“เธฒเธเนเธญเธ เธฃเธฒเธขเธเธฒเธฃ");
				document.login_form.name_acti.focus();           
				return false;
				}
				else if(acti_form.vbudget_acti.value == "")
						{
					   alert("เธเธฃเธธเธ“เธฒเธเนเธญเธ เธเธณเธเธงเธเน€เธเธดเธ") ;
					   document.login_form.vbudget_acti.focus();           
					   return false;
						}
				else
						{ callfrm("?option=plan&task=planproject/plan_updacti"); }  //page เธเธฃเธฐเธกเธงเธฅเธเธฅ
			} // if(val==1)
} //goto_url_update(val)
</script>
