<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );

$t_month['01']="มค";
$t_month['02']="กพ";
$t_month['03']="มีค";
$t_month['04']="เมย";
$t_month['05']="พค";
$t_month['06']="มิย";
$t_month['07']="กค";
$t_month['08']="สค";
$t_month['09']="กย";
$t_month['10']="ตค";
$t_month['11']="พย";
$t_month['12']="ธค";

//ปีงบประมาณ
$year_index=$_REQUEST['year_index'];
if($year_index!=""){
$year_active_result['budget_year']=$year_index;
}
else{
$sql = "select * from  budget_year where year_active='1' order by budget_year desc limit 1";
$dbquery = mysql_query($sql);
$year_active_result = mysql_fetch_array($dbquery);
			if($year_active_result[budget_year]==""){
			echo "<br />";
			echo "<div align='center'>ยังไม่ได้กำหนดทำงานในปีงบประมาณใด ๆ  กรุณาไปที่เมนูตั้งค่าระบบ เพื่อกำหนดปีงบประมาณ</div>";
			exit();
			}
}

//ส่วนหัว
echo "<br />";
echo "<table width='50%' border='0' align='center'>";
echo "<tr align='center'><td><font color='#006666' size='3'><strong>ทะเบียน คุมหลักฐานขอเบิก/ขอยืมเงิน ปีงบประมาณ$year_active_result[budget_year]</strong></font></td></tr>";
echo "</table>";

//ส่วนแสดงรายละเอียด
$sql = "select * from  budget_withdraw where id='$_GET[id]' ";
$dbquery = mysql_query($sql);
While ($result = mysql_fetch_array($dbquery))
	{
		$id = $result['id'];
		$document= $result['document'];
		$item= $result['item'];
		$pj_activity= $result['pj_activity'];
		$money= $result['money'];
		$money=number_format($money,2);
		$pay_type= $result['pay_type'];
		$p_request= $result['p_request'];
		$status= $result['status'];
		$officer= $result['officer'];
		$rec_date= $result['rec_date'];
		$borrowed_rec_date= $result['borrowed_rec_date'];
		$withdraw_rec_date= $result['withdraw_rec_date'];
	}
list($rec_year,$rec_month,$rec_day) = explode("-",$rec_date);	
$t_year=($rec_year+543);		
$to_date=$rec_day.$t_month[$rec_month].$t_year;
	
echo "<Br>";
echo "<Table align='center' width='70%' Border='0' Bgcolor='#Fcf9d8'>";
echo "<Tr ><Td colspan='7' align='right'><INPUT TYPE='button' name='smb' value='<<กลับหน้าก่อน' onclick='location.href=\"?option=budget&task=main/report_2&pj_activity=$_GET[pj_activity]&year_index=$year_active_result[budget_year]\"'></Td></Tr>";

echo "<Tr align='left'><Td width='20'></Td><Td align='right'>วดป ลงทะเบียน&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='' Size='10'  value='$to_date' readonly></Td></Tr>";

echo "<Tr align='left'><Td ></Td><Td align='right'>ที่เอกสาร&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='doc' id='doc' Size='20' value='$document' readonly></Td></Tr>";

	if($status==1){
		$check0="";
		$check1="checked";
		}
		else{
		$check0="checked";
		$check1="";
		}		
		
echo   "<tr><Td ></Td><td align='right'>ขอยืมเงิน&nbsp;&nbsp;</td>";
echo   "<td align='left'><input  type=radio name='status' value='0' $check0>";

if($borrowed_rec_date>0){
echo "  ปี(คศ)เดือนวัน <Input Type='Text' Name='' Size='10'  value='$borrowed_rec_date' readonly>";
}

echo "</td></tr>";
echo   "<tr><Td></Td><td align='right'>ขอเบิก&nbsp;&nbsp;</td>";
echo   "<td align='left'><input  type=radio name='status' value='1' $check1>";

if($withdraw_rec_date>0){
echo "  ปี(คศ)เดือนวัน <Input Type='Text' Name='' Size='10'  value='$withdraw_rec_date' readonly>";
}
echo "</td></tr>";

echo "<Tr align='left'><Td width='20'></Td><Td align='right'>รายการ&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='item' Size='50' value='$item' readonly></Td></Tr>";

$sql = "select * from plan_acti where code_acti='$pj_activity' "; //หารหัสโครงการ
$dbquery = mysql_query($sql);
$acti_result = mysql_fetch_array($dbquery);

echo "<Tr align='left'><Td ></Td><Td align='right'>โครงการ&nbsp;&nbsp;</Td>";
echo "<td><div align='left'><Select  name='proj' size='1'>";
echo  "<option  value = ''>เลือก</option>" ;

$sql = "select  * from  plan_proj where budget_year='$year_active_result[budget_year]' order by  code_proj";
$dbquery = mysql_query($sql);
While ($result = mysql_fetch_array($dbquery))
   {
$code_proj = $result['code_proj']; 
$name_proj = $result['name_proj'];
$name_proj = substr($name_proj,0,120)."...";  

		if($code_proj==$acti_result[code_proj]){
		echo  "<option value = $code_proj selected>$code_proj $name_proj</option>" ;
		}
	}
echo "</select>";
echo "</div></td></tr>";

echo "<Tr align='left'><Td></Td><Td align='right'>กิจกรรม&nbsp;&nbsp;</Td><td align='left'>";
echo "<Select  name='pj_activity' id='pj_activity' size='1' >";
echo  "<option  value = ''>เลือก</option>" ;

$sql = "select * from  plan_acti  where code_proj='$acti_result[code_proj]' and  budget_year='$year_active_result[budget_year]'";
$dbquery = mysql_query($sql);
While ($acti_of_plan_result = mysql_fetch_array($dbquery)){
	if($acti_of_plan_result[code_acti]==$pj_activity){
	echo  "<option  value=$acti_of_plan_result[code_acti] selected>$acti_of_plan_result[code_acti] $acti_of_plan_result[name_acti]</option>" ;
	}
}
echo "</select>";
echo "</td></tr>";

echo "<Tr align='left'><Td width='20'></Td><Td align='right'>จำนวนเงิน&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='amount' Size='15' value='$money' readonly>บาท</Td></Tr>";
echo   "<tr><Td ></Td><td align='right'>ประเภทรายการจ่าย&nbsp;&nbsp;</td>";
echo   "<td><div align=left><Select name='pay_type' size='1'>"; 
$sql = "select  * from  budget_pay_type  order by pay_type_id";
$dbquery = mysql_query($sql);
While ($result = mysql_fetch_array($dbquery))
   {
		$pay_type_id = $result['pay_type_id'];
		$pay_type_name = $result['pay_type_name'];
		if($pay_type_id==$pay_type){
		echo  "<option value = $pay_type_id  selected>$pay_type_name</option>" ;
		}
	}
echo "</select>";
echo "</div></td></tr>";

echo "<Tr align='left'><Td width='30'></Td><Td align='right'>ผู้ขอเบิก/ขอยืมเงิน&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='p_request' Size='30' value='$p_request' readonly></Td></Tr>";

$sql = "select  * from  person_main where person_id='$officer' ";
$dbquery = mysql_query($sql);
$result = mysql_fetch_array($dbquery);
$fullname=$result['prename'].$result['name']." ".$result['surname'];
echo "<Tr align='left'><Td width='20'></Td><Td align='right'>เจ้าหน้าที่&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='' Size='30' value='$fullname' readonly></Td></Tr>";
echo "<Br>";
echo "</Table>";
echo "<Br>";
?>

