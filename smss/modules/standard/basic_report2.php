<?php
if(isset($_REQUEST['sd_year_index2'])){
$sd_year_index2=$_REQUEST['sd_year_index2'];
}
if(isset($_REQUEST['budget_year_index2'])){
$budget_year_index2=$_REQUEST['budget_year_index2'];
}

if(isset($sd_year_index2)){
$_REQUEST['sdyear_index']=$sd_year_index2;
}
if(isset($budget_year_index2)){
$_REQUEST['budget_year_index']=$budget_year_index2;
}

//ตรวจปีมาตรฐาน
$sql = "select distinct sd_year from standard_basic_sd order by sd_year desc";
$dbquery = mysql_query($sql);
$result_sdyear = mysql_fetch_array($dbquery);

//ตรวจปีงบประมาณ
$sql = "select * from plan_year order by budget_year desc";
$dbquery = mysql_query($sql);
$result_budget_year = mysql_fetch_array($dbquery);

///////////////////////////////////////////////////////////////////////
if($index==1){
//อาเรย์ชื่อโครงการ
		$sql = "select code_proj, name_proj from plan_proj where budget_year='$_REQUEST[budget_year]' ";
		$dbquery = mysql_query($sql);
		While ($result = mysql_fetch_array($dbquery)){
		$proj_code=$result['code_proj'];
		$proj_name=$result['name_proj'];
		$proj_name_ar[$proj_code]=$proj_name;
		}

//แสดงกิจกรรมตามตัวบ่งชี้
$sql = "select indicator_name from standard_basic_indicator where sd_id='$_REQUEST[sd_id]'  and  id_indicator='$_REQUEST[id_indicator]' and sd_year='$_REQUEST[sd_year]'";
$dbquery = mysql_query($sql);
$result = mysql_fetch_array($dbquery);

echo "<br />";
echo "<table width='100%' border='0' align='center'>";
echo "<tr align='center'><td><font color='#006666' size='3'><strong>";
echo "กิจกรรม โครงการ ปีงบประมาณ $_REQUEST[budget_year]";  
echo "</strong></font></td></tr>";
echo "<tr align='center'><td><font color='#006666' size='2'><strong>";
echo "สนับสนุนตัวบ่งชี้ $result[indicator_name]";  
echo "</strong></font></td></tr>";
echo "</table>";

echo  "<table width=75% border=0 align=center>";
echo "<Tr><Td colspan='3' align='right'><INPUT TYPE='button' name='smb' value='ย้อนกลับ' onclick='location.href=\"?option=standard&task=basic_report2&sd_year_index2=$_REQUEST[sd_year]&budget_year_index2=$_REQUEST[budget_year]\"'</Td></Tr>";
echo "<Tr bgcolor=#FFCCCC><Td width='70' align='center'>ที่</Td><Td align='center'>ชื่อกิจกรรม</Td><Td align='center'>ชื่อโครงการ</Td></Tr>";

		$sql = "select plan_acti.code_acti, plan_acti.code_proj, plan_acti.name_acti from plan_acti, plan_standard where plan_acti.code_acti=plan_standard.code_acti and plan_standard.sd_level='1'  and plan_standard.sd_id='$_GET[sd_id]' and plan_standard.id_indicator='$_REQUEST[id_indicator]' and plan_standard.sd_year='$_REQUEST[sd_year]' and plan_standard.budget_year='$_REQUEST[budget_year]'";
		$N=1;
		$dbquery = mysql_query($sql);
		While ($result = mysql_fetch_array($dbquery)){
		$acti_name=$result['name_acti'];
		$proj_name=$proj_name_ar[$result['code_proj']];
					if(($N%2) == 0)
					$color="#FFFFC";
					else  	$color="#FFFFFF";
		echo "<Tr bgcolor='$color'><Td align='center'>$N</Td> <Td align='left'>$acti_name</Td><Td align='left'>$proj_name</Td></Tr>";
		$N++;
		}
		echo "</table>";
		exit;
}

/////////////////////////////////////////////////////////////
echo "<br />";
echo "<table width='50%' border='0' align='center'>";
echo "<tr align='center'><td><font color='#006666' size='3'><strong>ตรวจสอบ การมีกิจกรรมสนับสนุนมาตรฐานการศึกษาขั้นพื้นฐาน</strong></font></td></tr>";
echo "</table>";

//เลือกปีมาตรฐาน
		echo "<form id='frm1' name='frm1'>";
		echo  "<table width=95% border=0 align=center>";
		echo "<Tr>";
		
	echo "<Td align='right'>";
		echo "<Select  name='sdyear_index' size='1'>";
		$sql_sdyear_index ="select distinct sd_year from standard_basic_sd order by sd_year desc";
		$dbquery_sdyear_index = mysql_query($sql_sdyear_index);
		While ($result_sdyear_index = mysql_fetch_array($dbquery_sdyear_index))
		   {
		$sd_year = $result_sdyear_index['sd_year']; 
				if($sd_year ==$_REQUEST['sdyear_index']){
				$sd_year_select="selected";
				}
				else {
				$sd_year_select="";
				}
		echo  "<option value = $sd_year $sd_year_select>มาตรฐานปี $sd_year</option>";
			}
		echo "</select>&nbsp;";
//เลือกปีงบประมาณ		
		echo "<Select  name='budget_year_index' size='1'>";
		$sql_budgetyear = "select distinct  budget_year from plan_acti order by budget_year desc";
		$dbquery_budgetyear = mysql_query($sql_budgetyear);
		While ($result_budgetyear = mysql_fetch_array($dbquery_budgetyear))
		   {
		$budget_year = $result_budgetyear['budget_year'];
				if($budget_year ==$_REQUEST['budget_year_index']){
				echo  "<option value = '$budget_year' selected>ปีงบประมาณ $budget_year</option>";
				}
				else{
				echo  "<option value = '$budget_year'>ปีงบประมาณ $budget_year</option>";
				}
			}
		echo "</select> <INPUT TYPE='button' name='smb' value='เลือก' onclick='goto_type(1)' class=entrybutton>";
		echo "</td></Tr></Table>";
		echo "</form>";

		//จบส่วนเลือกปี

if(($_POST) or (isset($sd_year_index2))){
$sql = "select * from standard_basic_sd where sd_year='$_REQUEST[sdyear_index]' order by sd_id ";
}
else{
$sql = "select * from standard_basic_sd where sd_year='$result_sdyear[sd_year]' order by sd_id";
}

$dbquery = mysql_query($sql);
echo  "<table width=95% border=0 align=center>";
echo "<Tr bgcolor=#FFCCCC align=center class=style2><Td width='70'>มาตรฐานที่</Td> <Td width='80'>มาตรฐานปี</Td><Td>ชื่อมาตรฐาน</Td><Td  width='80'>มี /ไม่มี</Td><Td width='80'>จำนวนกิจกรรม</Td><Td width='80'>รายละเอียด</Td></Tr>";
While ($result = mysql_fetch_array($dbquery))
	{
		$id = $result['id'];
		$sd_year= $result['sd_year'];
		$sd_id = $result['sd_id'];
		$sd_name = $result['sd_name'];

		echo "<Tr  bgcolor='#FFFFC' align=center class=style1><Td>$sd_id</Td> <Td>$sd_year</Td><Td align='left'>$sd_name</Td><Td></Td><Td></Td><Td></Td></Tr>";
	
		$sql_indicator = "select * from standard_basic_indicator where sd_id= '$sd_id' and sd_year='$sd_year' order by id_indicator";
		$dbquery_indicator = mysql_query($sql_indicator);
		
		While ($result_indicator = mysql_fetch_array($dbquery_indicator))
		{
		$id_indicator= $result_indicator['id_indicator'];
		$indicator_name = $result_indicator['indicator_name'];
		
				// ส่วนหาจำนวนกิจกรรม
				if(($_POST) or (isset($sd_year_index2))){
				$sql_acti= "select count(id) as acti_num from plan_standard where sd_level='1' and  sd_id= '$sd_id' and id_indicator= '$id_indicator' and sd_year='$_REQUEST[sdyear_index]' and budget_year='$_REQUEST[budget_year_index]'";	
				}
				else{
				$sql_acti= "select count(id) as acti_num from plan_standard where sd_level='1' and  sd_id= '$sd_id' and id_indicator= '$id_indicator' and sd_year='$result_sdyear[sd_year]' and budget_year='$result_budget_year[budget_year]'";	
				}
				$dbquery_acti = mysql_query($sql_acti);
				$result_acti = mysql_fetch_array($dbquery_acti);
				//จบส่วนหาจำนวนกิจกรรม
				
				
echo "<Tr align='center'><Td></Td><Td></Td><Td align='left'>$indicator_name</Td>";
if($result_acti['acti_num']>0){
echo "<Td><img src=images/yes.png border='0' alt='มีกิจกรรมสนับสนุน'></Td><Td align='center'>";
}
else{
echo "<Td><img src=images/no.png border='0' alt='ไม่มีกิจกรรมสนับสนุน'></Td><Td align='center'>";
}
if($result_acti['acti_num']>0){
echo $result_acti['acti_num'];
}
echo "</Td>";
if($result_acti['acti_num']>0){
		if(($_POST) or (isset($sd_year_index2))){
		$sd_year=$_REQUEST['sdyear_index'];
		$budget_year=$_REQUEST['budget_year_index'];
		}
		else{
		$sd_year=$result_sdyear['sd_year'];
		$budget_year=$result_budget_year['budget_year'];
		}
echo "<Td><a href='?option=standard&task=basic_report2&index=1&sd_id=$sd_id&id_indicator=$id_indicator&sd_year=$sd_year&budget_year=$budget_year'><img src=images/browse.png border='0' alt='รายละเอียด'></a></Td>";
}
else{
echo "<Td></Td>";
}
echo "</Tr>";
		}
	}
echo "</Table>";

?>
<script>
function goto_type(val){
	if(val==1){
		callfrm("?option=standard&task=basic_report2");   // page ย้อนกลับ 
		}
}
</script>
