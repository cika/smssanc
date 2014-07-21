<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
//sd page 

$th_month['01']="มกราคม";
$th_month['02']="กุมภาพันธ์";
$th_month['03']="มีนาคม";
$th_month['04']="เมษายน";
$th_month['05']="พฤษภาคม";
$th_month['06']="มิถุนายน";
$th_month['07']="กรกฎาคม";
$th_month['08']="สิงหาคม";
$th_month['09']="กันยายน";
$th_month['10']="ตุลาคม";
$th_month['11']="พฤศจิกายน";
$th_month['12']="ธันวาคม";

list($now_year,$now_month,$now_day) = explode("-",date("Y-m-d"));	
$now_year=$now_year+543;
$today="วันที่ $now_day เดือน$th_month[$now_month] พ.ศ.$now_year";

//ปีงบประมาณ
$sql = "select * from  budget_year where year_active='1' order by budget_year desc limit 1";
$dbquery = mysql_query($sql);
$year_active_result = mysql_fetch_array($dbquery);
if($year_active_result['budget_year']==""){
echo "<br />";
echo "<div align='center'>ยังไม่ได้กำหนดทำงานในปีงบประมาณใด ๆ  กรุณาไปที่เมนูตั้งค่าระบบ เพื่อกำหนดปีงบประมาณ</div>";
exit();
}

if(isset($_REQUEST['year_index'])){
$year_index=$_REQUEST['year_index'];
}
else{
$year_index="";
}
//กรณีเลือกปี
if($year_index!=""){
$year_active_result['budget_year']=$year_index;
}

echo "<br />";
echo "<table width='80%' border='0' align='center'>";
echo "<tr align='center'><td><font color='#006666' size='3'><strong>รายงานการใช้จ่าย จำแนกตามประเภทรายการจ่าย</strong></font></td></tr>";
echo "<tr align='center'><td><font  color='#006666' size='3'>$_SESSION[school_name]</font></td></tr>";
echo "<tr align='center'><td><font  color='#006666' size='3'>$today</font></td></tr>";
echo "</table>";

//ส่วนการแสดงผล
	//หารายจ่ายทั้งหมด
	$sql = "select sum(pay_amount) as total_pay_money from budget_main where  budget_year='$year_active_result[budget_year]' and pay_group>'100' ";
	$dbquery = mysql_query($sql);
	$result = mysql_fetch_array($dbquery);
	$total_pay_money = $result['total_pay_money'];
	
	$sql  = "select sum(pay_amount) as sum_bud_money from budget_bud where budget_year='$year_active_result[budget_year]' and pay_group>'100'";
	$dbquery = mysql_query($sql);
	$result = mysql_fetch_array($dbquery);
	$total_pay_money=$total_pay_money+$result['sum_bud_money'];

	//เลืิอกปีและประเภท
	echo  "<table width='70%' border='0' align='center'>";
	echo "<form id='frm1' name='frm1'>";
	echo "<tr><td align='right'>";
		
	echo "ปีงบประมาณ&nbsp";
	echo "<Select  name='year_index' size='1'>";
	echo  '<option value ="" >เลือก</option>' ;
	$sql_year = "SELECT *  FROM  budget_year order by budget_year";
	$dbquery_year = mysql_query($sql_year);
	While ($result_year = mysql_fetch_array($dbquery_year)){
			 if($year_index==""){
					if($result_year['year_active']==1){
					echo "<option value=$result_year[budget_year]  selected>$result_year[budget_year]</option>"; 
					}
					else{
					echo "<option value=$result_year[budget_year]>$result_year[budget_year]</option>"; 
					}
			 }
			 else{
					if($year_index==$result_year['budget_year']){
					echo "<option value=$result_year[budget_year]  selected>$result_year[budget_year]</option>"; 
					}
					else{
					echo "<option value=$result_year[budget_year]>$result_year[budget_year]</option>"; 
					}
			}	
	}
		echo "</select>&nbsp;";		
		echo "<INPUT TYPE='button' name='smb' value='เลือก' onclick='goto_url(1)' class=entrybutton>";
		echo "</form>";
		echo "</td></Tr></Table>";
//จบส่วนเลือกประเภท

$sql = "select * from budget_pay_type order by pay_type_id";
$dbquery = mysql_query($sql);
echo  "<table width=70% border=0 align=center>";
echo "<Tr bgcolor='#FFCCCC' align='center' class=style2><Td width='50'>ที่</Td> <Td>รหัส</Td><Td>ประเภทรายการจ่าย</Td><Td>จำนวนเงิน</Td><Td>ร้อยละ</Td></Tr>";
$M=1;
$total_sum_money=0;
$total_percent=0;
$percent=0;
While ($result = mysql_fetch_array($dbquery))
	{
		$id = $result['id'];
		$pay_type_id= $result['pay_type_id'];
		$pay_group_id= $result['pay_group_id'];
		$pay_type_name = $result['pay_type_name'];
//เิงินที่มีรายการจ่ายในตารางหลัก			
				$sql_sum = "select sum(pay_amount) as sum_money from budget_main where pay_group='$pay_type_id' and budget_year='$year_active_result[budget_year]'";
				$dbquery_sum = mysql_query($sql_sum);
				$result_sum = mysql_fetch_array($dbquery_sum);

//เงินงบประมาณที่ได้รับจัดสรร				
				$sql_bud_sum = "select sum(pay_amount) as sum_bud_money from budget_bud where pay_group='$pay_type_id' and budget_year='$year_active_result[budget_year]'";
				$dbquery_bud_sum = mysql_query($sql_bud_sum);
				$result_bud_sum = mysql_fetch_array($dbquery_bud_sum);

//รวมเงินนอกงบประมาณกับเงินงบประมาณที่ได้รับการจัดสรร แต่ละรายการจ่าย
$sum_money=	$result_sum['sum_money']+$result_bud_sum['sum_bud_money'];  
						
////รวมเงินนอกงบประมาณกับเงินงบประมาณที่ได้รับการจัดสรร ทุกรายการจ่าย						
$total_sum_money=$total_sum_money+$result_sum['sum_money']+$result_bud_sum['sum_bud_money'];

						if($total_pay_money!=0){
						$percent=($sum_money/$total_pay_money)*100;
						$total_percent=$total_percent+$percent;
						$percent=number_format($percent,2);
						}
		
			if(($M%2) == 0)
			$color="#FFFFC";
			else  	$color="#FFFFFF";
$sum_money=number_format($sum_money,2);
		echo "<Tr  bgcolor=$color align=center class=style1><Td>$M</Td> <Td>$pay_type_id</Td> <Td align=left>$pay_type_name</Td><Td align='right'>$sum_money</Td><Td>";
		if($percent!=0){
		echo $percent;
		}
echo "</Td></Tr>";
$M++;
	}
$total_sum_money=	number_format($total_sum_money,2);
$total_percent=	number_format($total_percent,2);
		echo "<Tr bgcolor='#FFCCCC' align='center'><Td></Td><Td></Td> <Td>รวม</Td><Td>$total_sum_money</Td><Td>$total_percent</Td></Tr>";
echo "</Table>";

?>
<script>
function goto_url(val){
	if(val==0){
		callfrm("?option=budget&task=main/report_5");   // page ย้อนกลับ 
	}else if(val==1){
			callfrm("?option=budget&task=main/report_5");   //page ประมวลผล
		}
}
</script>
