<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
//sd page 
$officer=$_SESSION['login_user_id'];

$budget_status['1']="รับเงินสด";
$budget_status['2']="รับเช็ค/เงินฝากธนาคาร";
$budget_status['3']="จ่ายเงินสด";
$budget_status['4']="จ่ายเช็ค/เงินฝากธนาคาร";
$budget_status['5']="นำเงินสดฝากธนาคาร";
$budget_status['6']="นำเงินสดฝากส่วนราชการผู้เบิก";
$budget_status['7']="ถอนเงินฝากธนาคารเป็นเงินสด";
$budget_status['8']="ถอนเงินฝากธนาคารไปฝากส่วนราชการผู้เบิก";
$budget_status['9']="รับคืนเงินฝากส่วนราชการผู้เบิกมาเป็นเงินสด";
$budget_status['10']="รับคืนเงินฝากส่วนราชการมาเป็นเงินฝากธนาคาร";

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

$th_month['1']="มกราคม";
$th_month['2']="กุมภาพันธ์";
$th_month['3']="มีนาคม";
$th_month['4']="เมษายน";
$th_month['5']="พฤษภาคม";
$th_month['6']="มิถุนายน";
$th_month['7']="กรกฎาคม";
$th_month['8']="สิงหาคม";
$th_month['9']="กันยายน";
$th_month['10']="ตุลาคม";
$th_month['11']="พฤศจิกายน";
$th_month['12']="ธันวาคม";

//ปีงบประมาณ
$sql = "select * from  budget_year where year_active='1' order by budget_year desc limit 1";
$dbquery = mysql_query($sql);
$year_active_result = mysql_fetch_array($dbquery);
if($year_active_result['budget_year']==""){
echo "<br />";
echo "<div align='center'>ยังไม่ได้กำหนดทำงานในปีงบประมาณใด ๆ  กรุณาไปที่เมนูตั้งค่าระบบ เพื่อกำหนดปีงบประมาณ</div>";
exit();
}

if(isset($_POST['year_index'])){
$year_index=$_POST['year_index'];
}
else{
$year_index="";
}
	//กรณีเลือกปี
if($year_index!=""){
$year_active_result['budget_year']=$year_index;
}

//ส่วนของการคำนวณ
$total_cash=0;  //รวมเงินสดทุกรายการ
$total_bank=0;  //รวมเงินฝากธนาคารทุกรายการ
$total_office=0;  //รวมเงินฝากส่วนราชการทุกรายการ
$total=0; //รวมทั้งหมด
$receive_total=0;   //ตรวจสอบอีกครั้ง
$pay_total=0;  //ตรวจสอบอีกครั้ง

$sql_ex_bud = "select  * from  budget_type order by category_id,type_id";
$dbquery_ex_bud = mysql_query($sql_ex_bud);
While ($result_ex_bud = mysql_fetch_array($dbquery_ex_bud))
{
$type_index=$result_ex_bud['type_id'];
$cash_tank=0;  //เงินสด
$bank_tank=0;  //เงินฝากธนาคาร
$office_tank=0;	 //เงินฝากส่วนราชการ 	
if(!$_POST){
$sql = "select  * from budget_main where budget_year='$year_active_result[budget_year]' and type_id='$result_ex_bud[type_id]' order by rec_date, id";
}
else{
$select_year=$_POST['select_year']-543;
$date_index=$select_year."-".$_POST['select_month']."-".$_POST['select_date'];

$sql = "select  * from budget_main where budget_year='$year_active_result[budget_year]' and type_id='$result_ex_bud[type_id]' and rec_date<='$date_index' order by rec_date, id";
}
			$dbquery = mysql_query($sql);
			While ($result = mysql_fetch_array($dbquery))
				{
				$id = $result['id'];
				$receive_amount = $result['receive_amount'];
				$pay_amount = $result['pay_amount'];
				$change_amount = $result['change_amount'];
				$status = $result['status'];
				$rec_date = $result['rec_date'];
		
						if($status==1){
						$cash_tank=$cash_tank+$receive_amount;
						$receive_total=$receive_total+$receive_amount;
						}	
						else if($status==2){
						$bank_tank=$bank_tank+$receive_amount;
						$receive_total=$receive_total+$receive_amount;
						}
						else if($status==3){
						$cash_tank=$cash_tank-$pay_amount;
						$pay_total=$pay_total+$pay_amount;
						}
						else if($status==4){
						$bank_tank=$bank_tank-$pay_amount;
						$pay_total=$pay_total+$pay_amount;
						}
						else if($status==5){
						$cash_tank=$cash_tank-$change_amount;
						$bank_tank=$bank_tank+$change_amount;
						}
						else if($status==6){
						$cash_tank=$cash_tank-$change_amount;
						$office_tank=$office_tank+$change_amount;
						}
						else if($status==7){
						$bank_tank=$bank_tank-$change_amount;
						$cash_tank=$cash_tank+$change_amount;
						}
						else if($status==8){
						$bank_tank=$bank_tank-$change_amount;
						$office_tank=$office_tank+$change_amount;
						}
						else if($status==9){
						$office_tank=$office_tank-$change_amount;
						$cash_tank=$cash_tank+$change_amount;
						}
						else if($status==10){
						$office_tank=$office_tank-$change_amount;
						$bank_tank=$bank_tank+$change_amount;
						}
				}
$cash_ar[$type_index]=$cash_tank;
$bank_ar[$type_index]=$bank_tank;
$office_ar[$type_index]=$office_tank;
$sum_type[$type_index]=$cash_ar[$type_index]+$bank_ar[$type_index]+$office_ar[$type_index]; //รวมเงินในแต่ละรายการ
$total_cash=$total_cash+$cash_ar[$type_index];
$total_bank=$total_bank+$bank_ar[$type_index];
$total_office=$total_office+$office_ar[$type_index];
}	
$total=$total+$total_cash+$total_bank+$total_office;

//ส่วนหัว
echo "<br />";
echo "<div align='center'>";
echo "<font color='#006666' size='3'><strong>รายงานเงินคงเหลือประจำวัน</strong></font><br />";
echo "<font  color='#006666' size='3'>$_SESSION[school_name]</font>";
echo "</div>";

echo "<form id='frm1' name='frm1'>";
echo "<Table align='center' width='70%' Border='0'>";
$today_date=date("d/m/Y");
list($today_day,$today_month,$today_year) = explode("/",$today_date);
$last_year=$today_year+542;
$today_year=$today_year+543;
$next_year=$today_year+1;	
echo "<Tr><Td align='center'>วันที่&nbsp;&nbsp;<Select  name='select_date'  size='1'>";
echo  "<option  value = ''>เลือก</option>" ;

for($x=1;$x<=31;$x++){
	if($_POST['select_date']==""){
			if($today_day==$x){
			echo  "<option value =$x selected>$x</option>" ;
			}
			else{
			echo  "<option value =$x>$x</option>" ;
			}
	}
	else{
			if($_POST['select_date']==$x){
			echo  "<option value =$x selected>$x</option>" ;
			}
			else{
			echo  "<option value =$x>$x</option>" ;
			}
	}	
}
echo "</select>";

echo "&nbsp;&nbsp;เดือน&nbsp;&nbsp;<Select  name='select_month' size='1'>";
echo  "<option  value = ''>เลือก</option>" ;
for($x=1;$x<=12;$x++){
	if($_POST['select_month']==""){
			if($today_month==$x){
			echo  "<option value =$x selected>$th_month[$x]</option>" ;
			}
			else{
			echo  "<option value =$x>$th_month[$x]</option>" ;
			}
	}
	else{
			if($_POST['select_month']==$x){
			echo  "<option value =$x selected>$th_month[$x]</option>" ;
			}
			else{
			echo  "<option value =$x>$th_month[$x]</option>" ;
			}
	}	
}
echo "</select>";

echo "&nbsp;&nbsp;ปี&nbsp;&nbsp;<Select  name='select_year' size='1'>";
echo  "<option  value = ''>เลือก</option>" ;
if($_POST['select_year']==""){
echo  "<option value =$last_year>$last_year</option>" ;
echo  "<option value =$today_year selected>$today_year</option>" ;
echo  "<option value =$next_year>$next_year</option>" ;
}
else{
		if($_POST['select_year']==$last_year){
		echo  "<option value =$last_year selected>$last_year</option>" ;
		echo  "<option value =$today_year>$today_year</option>" ;
		echo  "<option value =$next_year>$next_year</option>" ;
		}
		else if($_POST['select_year']==$next_year){
		echo  "<option value =$last_year>$last_year</option>" ;
		echo  "<option value =$today_year>$today_year</option>" ;
		echo  "<option value =$next_year selected>$next_year</option>" ;
		}
		else{
		echo  "<option value =$last_year>$last_year</option>" ;
		echo  "<option value =$today_year selected>$today_year</option>" ;
		echo  "<option value =$next_year>$next_year</option>" ;
		}
}
echo "</select>";
echo "</Td>";
echo "<td>";

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
echo "&nbsp;&nbsp;<INPUT TYPE='button' name='smb' value='เลือก' onclick='goto_url(1)' class=entrybutton>";
echo "</Td>";
echo"</Tr>";
echo "</table>";
echo "</form>";

//ส่วนแสดงผล
echo  "<table width='95%' border='0' align='center'>";
 echo "<tr bgcolor='#FFCCCC' align='center'>
    <td rowspan='2'>รายการ</td>
    <td colspan='3'>คงเหลือ</td>
    <td rowspan='2' width='120'>รวม</td>
  </tr>
  <tr bgcolor='#CC9900' align='center'>
    <td width='120'>เงินสด</td>
    <td width='120'>เงินฝากธนาคาร</td>
    <td width='120'>เงินฝากส่วนราชการ</td>
  </tr>";
 echo "<tr>
    <td  bgcolor='#FFCCCC'>เงินนอกงบประมาณ</td>
    <td></td>
    <td></td>
    <td></td>
	<td></td>	
  </tr>";
$sql= "select  * from  budget_type where category_id='1' order by type_id";
$dbquery = mysql_query($sql);
$M=1;
While ($result1 = mysql_fetch_array($dbquery))
	{
	$type_id1=$result1['type_id'];
			if(($M%2) == 0)
			$color="#FFFFB";
			else  	$color="#FFFFFF";
$cash_ar[$type_id1]=number_format($cash_ar[$type_id1],2);			
$bank_ar[$type_id1]=number_format($bank_ar[$type_id1],2);					
$office_ar[$type_id1]=number_format($office_ar[$type_id1],2);		
$sum_type[$type_id1]=number_format($sum_type[$type_id1],2);					
		echo "<Tr bgcolor=$color><Td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$result1[type_name]</Td><td align='right'>$cash_ar[$type_id1]</td><td align='right'>$bank_ar[$type_id1]</td><td align='right'>$office_ar[$type_id1]</td><td align='right'>$sum_type[$type_id1]</td></Tr>";
$M++;
	}
	
	 echo "<tr>
    <td  bgcolor='#FFCCCC'>เงินรายได้แผ่นดิน</td>
    <td></td>
    <td></td>
    <td></td>
	<td></td>	
  </tr>";

$sql= "select  * from  budget_type where category_id='3' order by type_id";
$dbquery = mysql_query($sql);
While ($result2 = mysql_fetch_array($dbquery))
	{
	$type_id2=$result2['type_id'];
			if(($M%2) == 0)
			$color="#FFFFB";
			else  	$color="#FFFFFF";
$cash_ar[$type_id2]=number_format($cash_ar[$type_id2],2);			
$bank_ar[$type_id2]=number_format($bank_ar[$type_id2],2);					
$office_ar[$type_id2]=number_format($office_ar[$type_id2],2);		
$sum_type[$type_id2]=number_format($sum_type[$type_id2],2);					
		echo "<Tr bgcolor=$color><Td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$result2[type_name]</Td><td align='right'>$cash_ar[$type_id2]</td><td align='right'>$bank_ar[$type_id2]</td><td align='right'>$office_ar[$type_id2]</td><td align='right'>$sum_type[$type_id2]</td></Tr>";
$M++;
	}
//สรุป
$total_cash=number_format($total_cash,2);
$total_bank=number_format($total_bank,2);
$total_office=number_format($total_office,2);
$total=number_format($total,2);
echo "<Tr bgcolor='#FFCCCC'><Td align='center'>รวม</Td><td align='center'>$total_cash</td><td align='center'>$total_bank</td><td align='center'>$total_office</td><td align='center'>$total</td></Tr>";
echo "</Table>";
?>

<script>
function goto_url(val){
	if(val==0){
		callfrm("?option=budget&task=main/today_report");   // page ย้อนกลับ 
	}else if(val==1){
			callfrm("?option=budget&task=main/today_report");   //page ประมวลผล
		}
}

</script>
