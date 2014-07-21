<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );

//ปีงบประมาณ
$sql = "select * from la_year where year_active='1' order by budget_year desc limit 1";
$dbquery = mysql_query($sql);
$year_active_result = mysql_fetch_array($dbquery);
if($year_active_result['budget_year']==""){
echo "<br />";
echo "<div align='center'>ยังไม่ได้กำหนดทำงานในปีงบประมาณใด ๆ  กรุณาไปที่เมนูตั้งค่าระบบ เพื่อกำหนดปีงบประมาณ</div>";
exit();
}

//กรณีเลือกปีงบประมาณ
if(!isset($_REQUEST['year_index'])){
$_REQUEST['year_index']="";
}

if($_REQUEST['year_index']!=""){
$year_active_result['budget_year']=$_REQUEST['year_index'];
}

$year=$year_active_result['budget_year'];
$start_year=$year-544;
$end_year=$year-543;
$start_date=$start_year."-10-01";
$end_date=$end_year."-09-30";

//อาเรย์วันลาสะสม
$sql = "select * from la_collect where year='$year_active_result[budget_year]' ";
$dbquery = mysql_query($sql);
While ($result = mysql_fetch_array($dbquery)){
$collect_day_ar[$result['person_id']]=$result['collect_day'];
$this_year_day_ar[$result['person_id']]=$result['this_year_day'];
}

//ส่วนหัว
echo "<br />";
echo "<table width='95%' border='0' align='center'>";
echo "<tr align='center'>
	<td align=center><font color='#006666' size='3'><strong>สถิติการลาพักผ่อน</strong></font>
<font color='#006666' size='3'><strong>ปีงบประมาณ $year_active_result[budget_year]</strong></font>
</td></tr>";
echo "</table>";
echo "<br />";

$sql = "select * from  person_position order by position_code";
$dbquery = mysql_query($sql);
While ($result = mysql_fetch_array($dbquery)){
$position_ar[$result['position_code']]=$result['position_name'];
}

//ส่วนแสดงหลัก
echo "<form id='frm1' name='frm1'>";
echo  "<table width='90%' border='0' align='center'>";

echo "<Tr align='left'><Td align='right' colspan='9'>เลือกปีงบประมาณ&nbsp;&nbsp;<Select  name='year_index'  size='1'>";

$sql = "select * from la_year order by budget_year desc";
$query = mysql_query($sql);
While ($result = mysql_fetch_array($query))
   {
		if($result['budget_year']==$year_active_result['budget_year']){
		echo  "<option value = $result[budget_year] selected>ปีงบประมาณ $result[budget_year]</option>";
		}
		else{
		echo  "<option value = $result[budget_year]>ปีงบประมาณ $result[budget_year]</option>";
		}
	}
echo "</select>";
echo "&nbsp;<INPUT TYPE='button' name='smb' value='เลือก' onclick='goto_url2(1)'>";
echo "</Td></Tr>";

$sql = "select * from person_main where status='0' order by position_code,person_order";
$dbquery = mysql_query($sql);

echo "<Tr bgcolor='#FFCCCC' align='center'><Td width='50' rowspan='2'>ที่</Td>";
echo "<Td rowspan='2'>ชื่อ</Td><Td rowspan='2'>ตำแหน่ง</Td><Td colspan='3'>วันลาพักผ่อนประจำปี</Td><Td colspan='2'>ลา</Td><td>เหลือ</td></Tr>";
echo "<Tr align='center' bgcolor='#CCFFFF'>";
echo "<Td>สะสม</Td><Td>ปีนี้</td><Td>รวม</td><Td>ครั้ง</Td><Td>วัน</Td><Td>เหลือ</Td></Tr>";

$N=1;
$M=1;
$sum_collect=0;
$rest=0;

While ($result = mysql_fetch_array($dbquery)){
	
$id = $result['id'];
$person_id = $result['person_id'];
$prename=$result['prename'];
$name= $result['name'];
$surname = $result['surname'];
$position_code= $result['position_code'];

if(!isset($this_year_day_ar[$person_id])){
$this_year_day_ar[$person_id]="";
}

if(!isset($this_year_day_ar[$person_id])){
$this_year_day_ar[$person_id]="";
}

if(!isset($collect_day_ar[$person_id])){
$collect_day_ar[$person_id]="";
}

$sum_collect=$collect_day_ar[$person_id]+$this_year_day_ar[$person_id];

	if(($M%2) == 0){
	$color="#FFFFC";
	}
	else {
	$color="#FFFFFF";
	}
	
	$la_num=0;
	$la_day=0;
	$la_cancel_day=0;
	
			$sql_la=	"select  la_type, la_total from la_main where person_id='$person_id' and (la_start>='$start_date') and (la_finish<='$end_date') and la_type='4' and commander_grant='1' " ;	
			$query_la= mysql_query($sql_la);
			While ($result_la= mysql_fetch_array($query_la)){ 
					$la_num=$la_num+1;
					$la_day=$la_day+$result_la['la_total'];
			}
			
			$sql_la=	"select  la_type, cancel_la_total from la_cancel where person_id='$person_id' and (cancel_la_start>='$start_date') and (cancel_la_finish<='$end_date') and la_type='4' and commander_grant='1' " ;	
			$query_la= mysql_query($sql_la);
			While ($result_la= mysql_fetch_array($query_la)){ 
					$la_cancel_day=$la_cancel_day+$result_la['cancel_la_total'];
			}
			$la_day=$la_day-$la_cancel_day;  //วันลาหักยกเลิกวันลา
			$rest=$sum_collect-$la_day;    //วันลาคงเหลือ
			
			echo "<Tr bgcolor='$color' align='center'><Td>$N</Td>";
			echo "<Td align='left'>$prename&nbsp;$name&nbsp;&nbsp;$surname</Td><Td align='left'>";
			if(isset($position_ar[$position_code])){
			echo $position_ar[$position_code];
			}
			echo "</Td>";
			echo "<Td>$collect_day_ar[$person_id]</Td><Td>$this_year_day_ar[$person_id]</Td><Td>$sum_collect</Td><Td>$la_num</Td><Td>$la_day</Td><td>$rest</td>";
			echo "</tr>";
			
$M++;
$N++;
	}
	
echo "</Table>";
echo "</form>";
?>

<script>
function goto_url2(val){
callfrm("?option=la&task=main/report_5"); 		
}
</script>

