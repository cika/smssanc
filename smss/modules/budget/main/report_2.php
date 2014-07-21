<?php
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
$sql = "select * from plan_acti where  budget_year='$year_active_result[budget_year]' and  code_acti='$_GET[pj_activity]'";
$dbquery = mysql_query($sql);
$result_acti = mysql_fetch_array($dbquery);

$sql = "select  * from  plan_proj where budget_year='$year_active_result[budget_year]' and  code_proj='$result_acti[code_proj]'";
$dbquery = mysql_query($sql);
$result_proj = mysql_fetch_array($dbquery);

echo "<br>";
echo "<table width='100%' border='0' align='center'>";
echo "<tr align='center'><td><font color='#006666' size='3'><strong>รายการขอเบิก/ขอยืมเงินโครงการ</strong></font></td></tr>";
echo "<tr align='center'><td><font color='#006666' size='2'><strong>โครงการ  $result_proj[name_proj]</strong></font></td></tr>";
echo "<tr align='center'><td><font color='#006666' size='2'><strong>กิจกรรม $result_acti[name_acti]</strong></font></td></tr>";
echo "</table>";
echo "<br>";

$sql = "select  * from budget_withdraw where budget_year='$year_active_result[budget_year]' and  pj_activity='$_GET[pj_activity]'";
$dbquery = mysql_query($sql);
echo  "<table width=75% border=0 align=center>";
echo "<Tr><Td colspan='5' align='right'><INPUT TYPE='button' name='smb' value='<<กลับหน้า่ก่อน' onclick='location.href=\"?option=budget&task=main/report_1&year_index=$year_active_result[budget_year]\"'</Td></Tr>";
echo "<Tr bgcolor='#FFCCCC' align='center'><Td width='40'>ที่</Td><Td width='100'>ว/ด/ป</Td><Td>รายการ</Td><Td width='150'>จำนวนเงิน</Td><Td width='50'></Td></Tr>";
$pay_sum=0;
$M=1;
While ($result = mysql_fetch_array($dbquery))
	{
		$id = $result['id'];
		$item= $result['item'];
		$money= $result['money'];
		$money=number_format($money,2);
		$rec_date= $result['rec_date'];
		list($rec_year,$rec_month,$rec_day) = explode("-",$rec_date);	
$t_year=($rec_year+543)-2500;		

	    	if(($M%2) == 0)
			$color="#FFFFC";
			else  	$color="#FFFFFF";
		$pay_sum=$pay_sum+$result['money'];;
		echo "<Tr bgcolor=$color  align='center'><Td>$M</Td><Td>$rec_day $t_month[$rec_month] $t_year</Td><Td align='left'>$item</Td><Td align='right'>$money</Td>
		<Td><div align='cente'r><a href=?option=budget&task=main/report_3&id=$id&pj_activity=$_GET[pj_activity]&year_index=$year_active_result[budget_year]><img src=images/browse.png border='0'></a></div></Td>
	</Tr>";
$M++;
}
		$pay_sum=number_format($pay_sum,2);
		echo "<Tr align='center' bgcolor='#FFCCCC'><Td></Td><Td></Td><Td align='center'>รวม</Td><Td align='right'>$pay_sum</Td>
		<Td></Td>
	</Tr>";
echo "</Table>";

//ส่วนของรายการคืนเงิน
$sql = "select  * from  budget_money_return where budget_year='$year_active_result[budget_year]' and  pj_activity='$_GET[pj_activity]'";
$dbquery = mysql_query($sql);
$return_rows = mysql_num_rows($dbquery);
if($return_rows >= 1){
		echo "<div align='center'><p><font color='#006666' size='3'><strong>รายการคืนเงินโครงการ</strong></font></p></div>";
		echo  "<table width=75% border=0 align=center>";
		echo "<Tr bgcolor=#FFCCCC align=center class=style2><Td width='40'>ที่</Td><Td width='100'>ว/ด/ป</Td><Td>รายการ</Td><Td width='150'>จำนวนเงิน</Td><Td width='50'></Td></Tr>";
		$N=1;
$return_sum=0;
$return_sum=0;
		While ($result = mysql_fetch_array($dbquery)){
		$id = $result['id'];
		$item= $result['item'];
		$money= $result['money'];
		$money=number_format($money,2);
		$rec_date= $result['rec_date'];
		list($rec_year,$rec_month,$rec_day) = explode("-",$rec_date);	
$t_year=($rec_year+543)-2500;		
		$return_sum=$return_sum+$result['money'];
		echo "<Tr bgcolor=#FFFFF  align=center class=style1><Td >$N</Td><Td>$rec_day $t_month[$rec_month] $t_year</Td><Td align=left>$item</Td></Td>
				<Td align='right'>$money</Td>
				<Td><div align=center><font size=3><a href=?option=budget&task=main/report_4&id=$id&pj_activity=$_GET[pj_activity]&year_index=$year_active_result[budget_year]><img src=images/browse.png border='0'></a></font></div></Td>";				
		echo "</Tr>";
		$N++;
		}
		$return_sum=number_format($return_sum,2);
		echo "<Tr align='center' bgcolor='#FFCCCC'><Td></Td><Td></Td><Td align='center'>รวม</Td><Td align='center'>$return_sum</Td>
		<Td></Td>
	</Tr>";
		 echo "</Table>";
}  
?>
