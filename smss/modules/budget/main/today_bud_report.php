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
$receive_total=0;  //รวมรับทั้งหมด
$pay_total=0;  //รวมจ่ายทั้งหมด
$balance_total=0;  //รวมคงเหลือทั้งหมด

$sql_bud= "select  * from  budget_bud where status='1' and budget_year='$year_active_result[budget_year]' order by item";
$dbquery_bud = mysql_query($sql_bud);
While ($result_bud = mysql_fetch_array($dbquery_bud))
{
$index=$result_bud['id'];
$receive=0;  //รายรับ
$pay=0;  //รายจ่าย
$balance=0;	 //คงเหลือ 	
if(!$_POST){
$sql = "select * from budget_bud where budget_year='$year_active_result[budget_year]' and (id='$result_bud[id]' or bud_type_id='$result_bud[id]') order by rec_date, id";

}
else{
$select_year=$_POST['select_year']-543;
$date_index=$select_year."-".$_POST['select_month']."-".$_POST['select_date'];

$sql = "select  * from budget_bud where  budget_year='$year_active_result[budget_year]' and (id='$result_bud[id]' or bud_type_id='$result_bud[id]') and rec_date<='$date_index' order by rec_date, id";
}
			$dbquery = mysql_query($sql);
			While ($result = mysql_fetch_array($dbquery))
				{
				$id = $result['id'];
				$receive_amount = $result['receive_amount'];
				$pay_amount = $result['pay_amount'];
				$status = $result['status'];
				$rec_date = $result['rec_date'];
		
						if($status==1){
						$receive=$receive+$receive_amount;
						$receive_total=$receive_total+$receive_amount;
						}	
						else if($status==2){
						$pay=$pay+$pay_amount;
						$pay_total=$pay_total+$pay_amount;
						}
				}
$balance_ar[$index]=$receive-$pay;				
$receive_ar[$index]=$receive;
$pay_ar[$index]=$pay;
}	

//ส่วนหัว
echo "<br />";
echo "<div align='center'>";
echo "<font color='#006666' size='3'><strong>รายงานเงินคงเหลือประจำวัน เงินงบประมาณที่ได้รับแจ้งการจัดสรร</strong></font><br />";
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
echo  "<table width='90%' border='0' align='center'>";
 echo "<tr bgcolor='#FFCCCC' align='center'>
    <td rowspan='2'>รายการ</td>
    <td colspan='2'>รับจ่าย</td>
    <td rowspan='2' width='120'>คงเหลือ</td>
  </tr>
  <tr bgcolor='#CC9900' align='center'>
    <td width='120'>รับ</td>
    <td width='120'>จ่าย</td>
  </tr>";
 echo "<tr>
    <td  bgcolor='#FFCCCC'>เงินงบประมาณที่ได้รับแจ้งการจัดสรร</td>
    <td></td>
    <td></td>
	<td></td>	
  </tr>";
$sql= "select  * from  budget_bud where status='1' and budget_year='$year_active_result[budget_year]' order by item";
$dbquery = mysql_query($sql);
$M=1;
While ($result1 = mysql_fetch_array($dbquery))
	{
	$id1=$result1['id'];
			if(($M%2) == 0)
			$color="#FFFFB";
			else  	$color="#FFFFFF";
$receive_ar[$id1]=number_format($receive_ar[$id1],2);			
$pay_ar[$id1]=number_format($pay_ar[$id1],2);					
$balance_ar[$id1]=number_format($balance_ar[$id1],2);		
		echo "<Tr bgcolor=$color><Td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$result1[item]</Td><td align='right'>$receive_ar[$id1]</td><td align='right'>$pay_ar[$id1]</td><td align='right'>$balance_ar[$id1]</td></Tr>";
$M++;
	}
	
//สรุป
$balance_total=$receive_total-$pay_total;
$balance_total=number_format($balance_total,2);
$receive_total=number_format($receive_total,2);
$pay_total=number_format($pay_total,2);
echo "<Tr bgcolor='#FFCCCC'><Td align='center'>รวม</Td><td align='center'>$receive_total</td><td align='center'>$pay_total</td><td align='center'>$balance_total</td></Tr>";
echo "</Table>";
?>

<script>
function goto_url(val){
	if(val==0){
		callfrm("?option=budget&task=main/today_bud_report");   // page ย้อนกลับ 
	}else if(val==1){
			callfrm("?option=budget&task=main/today_bud_report");   //page ประมวลผล
		}
}

</script>
