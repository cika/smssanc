<?php
// ตรวจสอบปีงบประมาณ
if($_SESSION["budget_year"]==""){
echo "<br>";
echo "<div align='center'>";
echo "ตรวจสอบการกำหนดปีงบประมาณให้ถูกต้องก่อนค่ะ";
echo "</div>";
exit();
}

if(!isset($code_proj)){
$code_proj="";
}

require_once("plan_calendar.php");
$space="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
$proj_year=$_SESSION["budget_year"];
?>
<link rel="stylesheet"  href="./css/js/style.css" type="text/css"/>
<script type="text/javascript" src="./css/js/calendarDateInput.js"></script> 
<Center>
<b>
<Font  class="headfrm"><BR>:::  บันทึกข้อมูล งาน/โครงการ ปีงบประมาณ <?php echo $_SESSION['budget_year']?> :::</Font></b>
<Br><BR><BR>
<form id='frm1' name='frm1'>
<TABLE width="100%"  border="0" align="center" cellpadding="2" cellspacing="2" height="50">
<TR>
<TD  width="50%"  valign="top"> 
<TABLE width="100%" border="0" borderColor=#FF0033 cellpadding="0" cellspacing="0">
	<tr> 
            <td align="right"  width="50%"><b><font  class="textfrm">กลุ่ม(งาน) :</font></b></td>
                    <td align='left' >
                 <?php   
					require_once("dbconfig.inc.php");
					$sql = "SELECT *  FROM   system_workgroup order by workgroup";
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
					echo "<Option value='$code_clus'>$code_clus $name_clus$space</option>";
					$i++;
					}
					echo "</Select>";
					?>
					</td></tr>
			<tr> 
            <td align="right"  width="50%"><b><font class="textfrm">กลยุทธ์ :</font></b></td>
                    <td align='left' >
					<?php
						$sql = "SELECT *  FROM  plan_stregic where budget_year='$_SESSION[budget_year]' order by id_tegic";
						$dbquery=DBfieldQuery($sql);
					echo "<Select name='vcode_tegy' size='1'>";
					echo "<Option value=''>--- เลือกกลยุทธ์  ---&nbsp;&nbsp;&nbsp;&nbsp; </option>";
					while ($result = mysql_fetch_array($dbquery))
					{
					$id_tegic = $result['id_tegic'];
					$strategic = $result['strategic'];
					echo "<Option value='$id_tegic'>$id_tegic $strategic$space</option>";
					}
					echo "</Select>";
					?>
                    </td></tr>
				 <tr>
                    <td align="right"><b><font  class="textfrm">รหัสโครงการ :</font></b></td>
                    <td align='left' ><input  size="4" type=text name="vcode_proj" maxlength="3" value=<?php echo $code_proj?>> 
                    </td></tr>
				<tr> 
                    <td align="right"><b><font  class="textfrm">ปีงบประมาณ :</font></b></td>
                    <td align='left' > <input  type="text"  readonly="readonly" name="vbudget_year" size=4 maxlength=4  value=<?php echo $proj_year?>> 
					</td></tr>	
					<tr> 
                    <td align="right"><b><font  class="textfrm">ชื่อโครงการ :</font></b></td>
                    <td align='left' > <textarea name='vname_proj' rows = '3' cols='50'></textarea>
                    </td></tr>
				<tr> 
                    <td align="right"><b><font  class="textfrm">วันเริ่มต้นโครงการ :</font></b></td>
                    <td align='left' > <script>
								var Y_date=<?php echo $Ynum?>  
								var m_date=<?php echo $mnum?>  
								var d_date=<?php echo $dnum?>  
								Y_date= Y_date+'/'+m_date+'/'+d_date
								DateInput('mybeginday', true, 'YYYY-MM-DD', Y_date)</script> 
                    </td></tr>
				<tr> 
                    <td align="right"><b><font  class="textfrm">วันสิ้นสุดโครงการ :</font></b></td>
                    <td align='left' > <script>
								var Y_date=<?php echo $Ybudget?>  
								var m_date=<?php echo $mbudget?>  
								var d_date=<?php echo $dbudget?>  
								Y_date= Y_date+'/'+m_date+'/'+d_date
								DateInput('myfinishday', true, 'YYYY-MM-DD', Y_date)</script> 
                    </td></tr>
				<tr> 
                    <td align="right"><b><font  class="textfrm">จำนวนเงินที่จัดสรร :</font></b></td>
                    <td align='left' > <input  size="9" type="text"  name="vbudget_proj" maxlength=9> 
					</td></tr>	
				<tr> 
                    <td align="right"><b><font  class="textfrm">หัวหน้าโครงการ :</font></b></td>
                    <td align='left' >
					<?php
					$sql = "SELECT *  FROM  person_main where status='0' order by position_code,name";
					$dbquery=DBfieldQuery($sql);
					echo "<Select name='vowner_proj' size='1'>";
					echo "<Option value=''>--- เลือกบุคลากร  ---&nbsp;&nbsp;&nbsp;&nbsp; </option>";
					while ($result = mysql_fetch_array($dbquery))
					{
					echo "<Option value=$result[person_id]>$result[name]&nbsp;$result[surname]</option>";
					$person_ar[$result['person_id']]=$result['prename'].$result['name']." ".$result['surname'];
					}
					echo "</Select>";
					?>

                    </td></tr>
               </table>
		</TD>
</table>

 <?php
echo "<p align='center'>";

if($_SESSION["mpms_add"]=='1')
{
echo "	<INPUT TYPE='button' name='smb' value='บันทึก' onclick='goto_url_update(1)' class='button'>";
}
else{
echo "<div align='center'><font size='3' color='#FF0033'>คุณไม่ไ้ด้รับสิทธิ์บันทึกข้อมูล</font></div>";
}
?>
<!-- Part2 -->
<BR><BR>
<Table width="90%" Border="1"  align="center" class="frmnik">
<?php
echo   "<Tr>";
echo   "<Th  width='7%'>รหัสโครงการ</th>";
echo   "<Th>ชื่อโครงการ</th>";
echo   "<Th  width='15%'>งบประมาณ</th>";
echo   "<Th  width='18%'>หัวหน้าโครงการ</th>";
echo   "<Th  width='4%'>รายละเอียด</th>";
if($_SESSION["mpms_edit"]=='1'){
echo   "<Th  width='4%'>แก้ไข</th>";}
if($_SESSION["mpms_dele"]=='1'){
echo   "<Th width='4%'>ลบ</th></tr>";}
require_once("dbconfig.inc.php");
$sql = "SELECT *  FROM  plan_proj  where budget_year='$proj_year' ORDER BY code_proj  DESC";
$dbquery =DBfieldQuery($sql);
//$num_rows = mysql_num_rows($dbquery);
$i=0;
while ($result = mysql_fetch_array($dbquery))
	{
	$id =$result['id'];
	$budget_year =$result['budget_year'];
	$code_clus =$result['code_clus'];
	$code_tegy =$result['code_tegy'];
	$code_proj =$result['code_proj'];
	$name_proj = $result['name_proj'];
	$budget_proj =$result['budget_proj'];
	$owner_proj =$result['owner_proj'];
	if  (empty($code_tegy)) 
	{   $code_tegy= chr(149);   }
	$mcode_tegy =$code_tegy.'-'.$code_proj;
	$len=strlen($owner_proj);
	$point=strpos($owner_proj,' ');
	$long=$len-$point;
	$fname=substr($owner_proj,0,$point);
	$sname=substr($owner_proj,-$long,$long);
	$cname=trim($sname);
	$Fcredit1=number_format($budget_proj,2);
	echo   "<Tr>";
	echo   "<Td align='center'>$code_proj</td>";
	echo   "<Td align='left'>&nbsp;$name_proj</td>";
	echo   "<Td align='right'>$Fcredit1&nbsp;&nbsp;&nbsp;</td>";
	echo   "<Td align='left'>$person_ar[$owner_proj]</td>";
	echo   "<Td><div align=center><a href=?option=plan&task=planproject/plan_detailproj&plan_proj_id=$id><img src=\"./images/b_browse.png\" WIDTH='16' HEIGHT='16' BORDER=0 ALT='รายละเอียดโครงการ'></a></div></Td>";

if($_SESSION["mpms_edit"]=='1')
{
	echo   "<Td><div align=center><a href=?option=plan&task=planproject/plan_editproj&plan_proj_id=$id><img src=\"./images/b_edit.png\" WIDTH='16' HEIGHT='16' BORDER=0 ALT='แก้ไขโครงการ'></a></div></Td>";

}
if($_SESSION["mpms_dele"]=='1')
{
	echo   "<Td><div align=center><a href=?option=plan&task=planproject/plan_deleproj&vcode_proj=$code_proj><img src=\"./images/b_drop.png\" WIDTH='16' HEIGHT='16' BORDER=0 ALT='ลบโครงการ'></a></div></Td>";
}
	$i++;
	}
?>

</Table>
</Center>
</form>
<script>
function goto_url_update(val){
	if(val==0){
		callfrm("?option=plan");   // page ย้อนกลับ vcode_clus
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
									else if (v2.length!=3) 
									{
										alert("กรุณาใส่รหัสโครงการ 3 หลัก เช่น 001 , 002 เป็นต้น");
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
										callfrm("?option=plan&task=planproject/plan_writeproj"); }  //page ประมวลผล
									}
					} // if(val==1)
</script>
