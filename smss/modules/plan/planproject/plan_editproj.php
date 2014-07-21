<?php
	if($_SESSION["mpms_edit"]!=1){
?>
<script>
			alert("คุณไม่มีสิทธิ์");
			document.location.href="?option=plan&task=planproject/plan_in_proj";
		</script>
<?php
}
	include("plan_authenfg.php");
	//include("plan_projcalendar.php");
	include("plan_calendar.php");
	require_once("dbconfig.inc.php");
	
$proj_year=$_SESSION["budget_year"];
$sql = "SELECT *  FROM  plan_proj  where budget_year='$proj_year' and id='$_GET[plan_proj_id]' ";
$dbquery =DBfieldQuery($sql);
$result = mysql_fetch_array($dbquery);
	$id =$result['id'];
	$budget_year =$result['budget_year'];
	$w_code_clus =$result['code_clus'];
	$w_code_tegy =$result['code_tegy'];
	$w_code_proj =$result['code_proj'];
	$w_name_proj = $result['name_proj'];
	$w_budget_proj =$result['budget_proj'];
	$w_owner_proj =$result['owner_proj'];
	$begin_date =$result['begin_date'];	
list($begin_year,$begin_month,$begin_day) = explode("-",$begin_date);	
	$finish_date =$result['finish_date'];	
list($finish_year,$finish_month,$finish_day) = explode("-",$finish_date);	
	
?>
<link rel="stylesheet"  href="./css/js/style.css" type="text/css"/>
<script type="text/javascript" src="./css/js/calendarDateInput.js"></script> 
<p align="center"><font color="#FFCC00"></font><Center><b>
<Font face="Tahoma" Size=4 color='#000099'><BR>::: แก้ไขโครงการ ปีงบประมาณ <?php echo $_SESSION['budget_year']?> :::</Font></b>
<Br><BR><BR>
<form id='frm1' name='frm1'>
<TABLE width="100%"  border="0" align="center" cellpadding="2" cellspacing="2" height="50">
<TR>
<TD  width="50%"  valign="top"> 
<TABLE width="100%" border="0" borderColor=#FF0033 cellpadding="0" cellspacing="0">
	<tr> 
            <td align="right"  width="50%"><b><font size="3" face="MS Sans Serif" color="#009900">กลุ่ม(งาน) :</font></b></td>
                    <td align='left' >
                 <?php   
					require_once("dbconfig.inc.php");
					$sql = "SELECT *  FROM   system_workgroup";
					$dbquery =DBfieldQuery($sql);
					$num_rows = mysql_num_rows($dbquery);
					echo "<Select name='vcode_clus' size='1'>";
					echo "<Option value=''>--- เลือกกลุ่ม(งาน) ---</option>";
					$i=0;
					while ($i < $num_rows)
					{
					$result = mysql_fetch_array($dbquery);
					$code_clus = $result['workgroup'];
					$name_clus = $result['workgroup_desc'];
					$txtshows = $code_clus." ".$name_clus;
					if ($code_clus==$w_code_clus){
					echo "<Option value='$code_clus' selected>$code_clus $name_clus$space</option>";
					}else{echo "<Option value='$code_clus'>$code_clus $name_clus$space</option>";
					}
					$i++;
					}
					echo "</Select>";
					?>
					</td></tr>
			<tr> 
            <td align="right"  width="50%"><b><font size="3" face="MS Sans Serif" color="#009900">กลยุทธ์ :</font></b></td>
                    <td align='left' >
					<?php
					$sql = "SELECT *  FROM  plan_stregic where budget_year='$_SESSION[budget_year]' order by id_tegic";
					$dbquery=DBfieldQuery($sql);
					echo "<Select name='vcode_tegy' size='1'> ";
					echo "<Option value=''>--- เลือกกลยุทธ์  ---&nbsp;&nbsp;&nbsp;&nbsp; </option>";
					while ($result = mysql_fetch_array($dbquery))
					{
					$id_tegic = $result['id_tegic'];
					$strategic = $result['strategic'];
					if($id_tegic==$w_code_tegy){
					echo "<Option value='$id_tegic' selected>$id_tegic $strategic$space</option>";
					}
					else{
					echo "<Option value='$id_tegic'>$id_tegic $strategic$space</option>";
					}
					}
					echo "</Select>";
					?>
                    </td></tr>
				 <tr>
                    <td align="right"><b><font size="3" face="MS Sans Serif" color="#009900">รหัสโครงการ :</font></b></td>
                    <td align='left' > <input  size="4" type=text readonly  name="vcode_proj" maxlength=3 value=<?php echo $w_code_proj?>> 
                    </td></tr>
				<tr> 
                    <td align="right"><b><font size="3" face="MS Sans Serif" color="#009900">ปีงบประมาณ :</font></b></td>
                    <td align='left'> <input  type=text readonly name="vbudget_year" size="4" maxlength="4"  value=<?php echo $proj_year?> 
					</td></tr>	
					<tr> 
                    <td align="right"><b><font size="3" face="MS Sans Serif" color="#009900">ชื่อโครงการ :</font></b></td>
                    <td align='left' > <textarea name='vname_proj' rows = '3' cols='50'><?php echo $w_name_proj?></textarea>
                    </td></tr>
				<tr> 
                    <td align="right"><b><font size="3" face="MS Sans Serif" color="#009900">วันเริ่มต้นโครงการ :</font></b></td>
                    <td align='left' > <script>
								var Y_date=<?php echo $begin_year?>  
								var m_date=<?php echo $begin_month?>  
								var d_date=<?php echo $begin_day?>  
								Y_date= Y_date+'/'+m_date+'/'+d_date
								DateInput('mybeginday', true, 'YYYY-MM-DD', Y_date)</script> 
                    </td></tr>
				<tr> 
                    <td align="right"><b><font size="3" face="MS Sans Serif" color="#009900">วันสิ้นสุดโครงการ :</font></b></td>
                    <td align='left' > <script>
								var Y_date=<?php echo $finish_year?>  
								var m_date=<?php echo $finish_month?>  
								var d_date=<?php echo $finish_day?>  
								Y_date= Y_date+'/'+m_date+'/'+d_date
								DateInput('myfinishday', true, 'YYYY-MM-DD', Y_date)</script> 
                    </td></tr>
				<tr> 
                    <td align="right"><b><font size="3" face="MS Sans Serif" color="#009900">จำนวนเงินที่จัดสรร :</font></b></td>
                    <td align='left' > <input  size="9" type=text  name="vbudget_proj"  value=<?php echo $w_budget_proj?> maxlength="9"> 
					</td></tr>	
				<tr> 
                    <td align="right"><b><font size="3" face="MS Sans Serif" color="#009900">หัวหน้าโครงการ :</font></b></td><td align="left">
					<?php
					$sql = "SELECT *  FROM  person_main order by position_code,name";
					$dbquery=DBfieldQuery($sql);
					echo "<Select name='vowner_proj' size='1'>";
					echo "<Option value=''>--- เลือกบุคลากร  ---&nbsp;&nbsp;&nbsp;&nbsp; </option>";
					while ($result = mysql_fetch_array($dbquery))
					{
						if($w_owner_proj==$result['person_id']){
						echo "<Option value=$result[person_id] selected>$result[name]&nbsp;$result[surname]</option>";
						}
						else{
						echo "<Option value=$result[person_id]>$result[name]&nbsp;$result[surname]</option>";
						}
					}
					echo "</Select>";
					?>					
                    </td></tr>
               </table>
		</TD>
</table>

 <?php
echo "<INPUT TYPE='hidden' name='plan_proj_id' value='$id'>";
echo "<p align='center'>";
echo "<INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url_update(1)' class='button'>&nbsp;<INPUT TYPE='button' name='smb' value='ย้อนกลับ' onclick='goto_url_update(0)' class='button'>";
echo "</p>";
?>

<!-- Part2 -->
<BR>
</Center>
</form>
<script>
function goto_url_update(val){
	if(val==0){
		callfrm("?option=plan&task=planproject/plan_in_proj");   
	}else if(val==1){
								var v1 = document.frm1.vcode_clus.value;
								var v2 = document.frm1.vcode_proj.value;
								var v3 = document.frm1.vname_proj.value;
								var v4 = document.frm1.vbudget_proj.value;
								var v5 = document.frm1.vowner_proj.value;
								 if (v1.length=="0")
									{
										alert("กรุณาเลือกกลุ่มงาน");
										document.frm1.vcode_clus.focus();           
										return false;
									 }
									else if (v2.length==0) 
									{
										alert("กรุณาใส่รหัสโครงการ");
										document.frm1.vcode_proj.focus();           
										return false;
									}
									else if (v3.length==0) 
									{
										alert("กรุณาใส่ชื่อโครงการ");
										document.frm1.vname_proj.focus();           
										return false;
									 }
									else if (v4.length==0)
									{
										alert("กรุณาใส่งบประมาณที่ได้รับจัดสรร") ;
										document.frm1.vbudget_proj.focus();           
										return false;
									}
									else if (v5.length==0) 
									{
										alert("กรุณาใส่ชื่อหัวหน้าโครงการ");
										document.frm1.vowner_proj.focus();           
										return false;
									}
									else{
										callfrm("?option=plan&task=planproject/plan_updproj"); }  
									}
					} // if(val==1)
</script>
