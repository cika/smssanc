<?php
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
	//กรณีเลือกปี
	if(isset($_REQUEST['year_index'])){
	$year_index=$_REQUEST['year_index'];
	}
	else{
	$year_index="";
	}
	if($year_index!=""){
	$year_active_result['budget_year']=$year_index;
	}

//ส่วนหัว
echo "<br>";
echo "<table width='100%' border='0' align='center'>";
echo "<tr align='center'><td><font color='#006666' size='3'><strong>รายงานการใช้จ่ายงบประมาณจำแนกตามโครงการ</strong></font></td></tr>";
echo "<tr align='center'><td><font  color='#006666' size='3'>$_SESSION[school_name]</font></td></tr>";
echo "<tr align='center'><td><font  color='#006666' size='3'>$today</font></td></tr>";
echo "</table>";

$sql = "select * from  plan_proj where budget_year='$year_active_result[budget_year]' order by code_proj ";
$dbquery = mysql_query($sql);
$rd=1;
While ($result = mysql_fetch_array($dbquery)){
$code_proj_plan= $result['code_proj'];
$name_proj_plan= $result['name_proj'];
$budget_proj_plan= $result['budget_proj'];
							
$code_proj_plan_ar[$rd]=$code_proj_plan;
$name_proj_plan_ar[$rd]=$name_proj_plan;
$budget_proj_plan_ar[$rd]=$budget_proj_plan;
$rd++;
}
						
$sql = "select * from  plan_acti where budget_year='$year_active_result[budget_year]'";
$dbquery = mysql_query($sql);
$re=1;
While ($result = mysql_fetch_array($dbquery)){
$code_proj_acti= $result['code_proj'];
$code_acti= $result['code_acti'];
$name_acti= $result['name_acti'];
$budget_acti= $result['budget_acti'];
							
$code_proj_acti_ar[$re]=$code_proj_acti;
$code_acti_ar[$re]=$code_acti;
$name_acti_ar[$re]=$name_acti;
$budget_acti_ar[$re]=$budget_acti;
$re++;
}

$sql = "select  distinct  pj_activity  from  budget_money_return where budget_year='$year_active_result[budget_year]'";
$dbquery = mysql_query($sql);
$rf=1;
While ($result = mysql_fetch_array($dbquery)){
$return_pj_activity= $result['pj_activity'];
$return_pj_activity_ar[$rf]=$return_pj_activity;
$rf++;
}
$total_withdraw=0;
$sum_momey_proj=0;
$total_net=0;

				// loop โครงการ			
				for($i=1;$i<$rd;$i++){
				$proj_sum=0;  
				$return_proj_sum=0;
							//loop กิจกรรม
							for($x=1;$x<$re;$x++){
							$acti_sum=0;  // ตัวแปรเิงินเบิกกิจกรรม
							$return_sum=0; // ตัวแปรเงินคืนกิจกรรม
							
									if($code_proj_plan_ar[$i]==$code_proj_acti_ar[$x]){
							// รายจ่ายในกิจกรรม			
									$sql_acti = "select sum(money) as money from  budget_withdraw where budget_year='$year_active_result[budget_year]' and pj_activity='$code_acti_ar[$x]' ";
									$dbquery_acti = mysql_query($sql_acti);
									$result_acti = mysql_fetch_array($dbquery_acti);
									$acti_sum_ar[$x]=$result_acti['money']; //รายจ่ายในกิจกรรม
									$proj_sum=$proj_sum+ $acti_sum_ar[$x]; // รวมจ่ายในโครงการ   
											for($z=1;$z<$rf;$z++){
													if($code_acti_ar[$x]==$return_pj_activity_ar[$z]){
													// คืนเงินกิจกรรม
													$sql_return = "select  sum(money) as money from  budget_money_return where budget_year='$year_active_result[budget_year]' and pj_activity='$code_acti_ar[$x]'";  
													$dbquery_return = mysql_query($sql_return);
													$result_return = mysql_fetch_array($dbquery_return);
													$return_sum_ar[$x]=$result_return['money'];  //เง้นคืนกิจกรรม
													$return_proj_sum=$return_proj_sum+$return_sum_ar[$x];  //เงินคืนในโครงการ
													}
											}		
									}
							//จ่ายในแต่ละกิจกรรมเมื่อรวมเงินคืนโครงการแล้ว
							//*ประกาศตัวแปร
							if(!isset($acti_sum_ar[$x])){
							$acti_sum_ar[$x]=0;
							}
							if(!isset($return_sum_ar[$x])){
							$return_sum_ar[$x]=0;
							}
							//*
							$acti_pay_ar[$x]=$acti_sum_ar[$x]-$return_sum_ar[$x];   
							}
				$proj_sum_ar[$i]=$proj_sum;   //เงินจ่ายโครงการ
				$return_proj_sum_ar[$i]=$return_proj_sum;   //เงินคืนโครงการ
				$true_withdraw[$i]=$proj_sum_ar[$i]-$return_proj_sum_ar[$i]; //รายจ่ายสุทธิโครงการ
				$total_withdraw=$total_withdraw+$true_withdraw[$i];			
				}
					
$space="  ";

//////////////////	เลือกปีงบประมาณ
echo "<form  name='frm1'>";
	echo "<table width='95%' align='center'><tr><td align='right'>";
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
echo "</select>";
echo "&nbsp;<INPUT TYPE='button' name='smb' value='เลือก' onclick='goto_url(1)' class=entrybutton>";
echo "</td></tr></table>";
echo "</form>";	
/////////////////////
echo  "<table width=98% border=0 align=center>";
echo "<Tr bgcolor=#FFCCCC align=center class=style2><Td>ที่</Td><Td>รหัส</Td><Td>โครงการ</Td><Td>กิจกรรม</Td><Td>งบประมาณ</Td><Td>ใช้จ่าย</Td><Td>คงเหลือ</Td><Td>%จ่าย</Td><Td></Td></Tr>";

for($i=1;$i<$rd;$i++)
{		
		$sum_momey_proj=$sum_momey_proj+$budget_proj_plan_ar[$i];  //รวมยอดเงินทุกโครงการ
		$budget_project=number_format($budget_proj_plan_ar[$i],2);       //เงินแต่ละโครงการ
		
		if($budget_proj_plan_ar[$i]>0)
		{
		$proj_percent=($true_withdraw[$i]/$budget_proj_plan_ar[$i])*100;
		$proj_percent=number_format($proj_percent,2);
		}
		else
		$proj_percent="0.00";
		
		$proj_sum=number_format($true_withdraw[$i],2);
		$net_proj=$budget_proj_plan_ar[$i]-$true_withdraw[$i];
		$net_proj2=number_format($net_proj,2);
		$total_net=$total_net+$net_proj;  //เิงินเหลือทั้งหมดทุกโครงการ
		
		echo "<Tr bgcolor=#FFFFC class=style1><Td align=center>$i</Td><Td><font color=#00FFFF>$code_proj_plan_ar[$i]</font></Td><Td   colspan=2>$name_proj_plan_ar[$i]</Td><Td align=right><font color='#00FF00'>$budget_project</font></Td><Td align=right>$proj_sum</Td><Td align=right>$net_proj2</Td><Td align=right>$proj_percent</Td><Td></Td></Tr>";		
		$acti_num=0;
		for($x=1;$x<$re;$x++)
		{
				if($code_proj_plan_ar[$i]==$code_proj_acti_ar[$x])
					{
					$acti_num=$acti_num+1;
					$budget_acti=number_format($budget_acti_ar[$x],2);
					$acti_sum=number_format($acti_pay_ar[$x],2);
					$net_acti=$budget_acti_ar[$x]-$acti_pay_ar[$x];
					$net_acti2=number_format($net_acti,2);
				
					if($budget_acti_ar[$x]>0)
					{
					$acti_percent=($acti_pay_ar[$x]/$budget_acti_ar[$x])*100;
					$acti_percent=number_format($acti_percent,2);
					}
					else{
					$acti_percent="0.00";
					}
						echo "<Tr  class=style1><Td ></Td><Td></Td><Td></Td><Td align=left><font color=#00FFFF>$code_acti_ar[$x]</font>";
						echo "$space$name_acti_ar[$x]</Td><Td align=right>$budget_acti</Td><Td align=right>$acti_sum</Td><Td align=right>$net_acti2</Td><Td align=right>$acti_percent</Td>";
						if($acti_sum!=0){
						echo "<Td><div align=center><a href=?option=budget&task=main/report_2&pj_activity=$code_acti_ar[$x]&year_index=$year_active_result[budget_year]><img src=images/browse.png border='0'></a></div></Td>";
						}
						else {
						 echo"<Td></Td>";
						 }
						echo "</Tr>";
					}
		}
}
		
		if($sum_momey_proj>0)
		{
		$spt_percent=($total_withdraw/$sum_momey_proj)*100;
		$spt_percent=number_format($spt_percent,2);
		}
		else
		$spt_percent="0.00";

$sum_momey_proj=number_format($sum_momey_proj,2);
$total_withdraw=number_format($total_withdraw,2);
$total_net=number_format($total_net,2);

echo "<Tr bgcolor=#FFCCCC align=center class=style1><Td></Td><Td></Td><Td></Td><Td>รวม</Td><Td>$sum_momey_proj</Td><Td>$total_withdraw</Td><Td>$total_net</Td><Td>$spt_percent</Td><Td></Td></Tr>";
echo "</Table>";
?>

<script>
function goto_url(val){
callfrm("?option=budget&task=main/report_1"); 		
}
</script>
