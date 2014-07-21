<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );

if(!(($result_permission['p1']==1) or ($_SESSION['admin_la']=='la'))) {
exit();
}

require_once "modules/la/time_inc.php";	

$officer=$_SESSION['login_user_id'];
$today_date = date("Y-m-d");

//ปีงบประมาณ
$sql = "select * from la_year where year_active='1' order by budget_year desc limit 1";
$dbquery = mysql_query($sql);
$year_active_result = mysql_fetch_array($dbquery);
if($year_active_result['budget_year']==""){
echo "<br />";
echo "<div align='center'>ยังไม่ได้กำหนดทำงานในปีงบประมาณใด ๆ  กรุณาไปที่เมนูตั้งค่าระบบ เพื่อกำหนดปีงบประมาณ</div>";
exit();
}

//ส่วนหัว
echo "<br />";
echo "<table width='99%' border='0' align='center'>";
echo "<tr align='center'>
	<td align=center><font color='#006666' size='3'><strong>ทะเบียนวันลาพักผ่อนสะสม</strong></font>
<font color='#006666' size='3'><strong>ปีงบประมาณ $year_active_result[budget_year]</strong></font>
</td></tr>";
echo "</table>";
echo "<br />";

$sql = "select * from  person_position order by position_code";
$dbquery = mysql_query($sql);
While ($result = mysql_fetch_array($dbquery)){
$position_ar[$result['position_code']]=$result['position_name'];
}

//ส่วนบันทึกข้อมูล
if($index==4){
$rec_date=date("Y-m-d H:i:s");
		$sql = "select * from person_main where status='0' order by position_code,person_order";
		$dbquery = mysql_query($sql);
		While ($result = mysql_fetch_array($dbquery))
		{
		$person_id = $result['person_id'];
			$sql_select = "select * from la_collect where  year='$year_active_result[budget_year]' and person_id='$person_id'";
			$dbquery_select = mysql_query($sql_select);
			$data_num=mysql_num_rows($dbquery_select);
			
					$collect_day_name="collect_day".$person_id;
					$this_year_day_name="this_year_day".$person_id;
					if($data_num>0){
					$sql_update = "update la_collect set  collect_day='$_POST[$collect_day_name]', this_year_day='$_POST[$this_year_day_name]', rec_date='$rec_date', officer='$officer' where year='$year_active_result[budget_year]' and person_id='$person_id' ";
					$dbquery_update = mysql_query($sql_update);
					}
					else {
							if($_POST[$collect_day_name] >0 or $_POST[$this_year_day_name]>0){
							$sql_insert = "insert into la_collect (year, person_id, collect_day, this_year_day, rec_date, officer) values ('$year_active_result[budget_year]' , '$person_id', '$_POST[$collect_day_name]','$_POST[$this_year_day_name]' , '$rec_date', '$officer')";
							$dbquery_insert = mysql_query($sql_insert);
							}
					}
		}	
}

//ส่วนแสดงหลัก
$sql_collect = "select * from  la_collect  where year='$year_active_result[budget_year]' ";
$query_collect = mysql_query($sql_collect);
While ($result_collect = mysql_fetch_array($query_collect )){
$person_id = $result_collect ['person_id'];
$collect_day_ar[$person_id]=$result_collect ['collect_day'];
$this_year_day_ar[$person_id]=$result_collect ['this_year_day'];
}
echo "<form id='frm1' name='frm1'>";
$sql = "select * from person_main where status='0' order by position_code,person_order";
$dbquery = mysql_query($sql);
echo  "<table width='90%' border='0' align='center'>";
echo "<Tr bgcolor='#FFCCCC' align='center'><Td width='50'>ที่</Td>";
echo "<Td>ชื่อ</Td><Td>ตำแหน่ง</Td><Td>วันลาพักผ่อนสะสม</Td><Td>วันลาพักผ่อนประจำปี</Td></Tr>";
$N=1;
$M=1;
While ($result = mysql_fetch_array($dbquery))
	{
		$id = $result['id'];
		$person_id = $result['person_id'];
		$prename=$result['prename'];
		$name= $result['name'];
		$surname = $result['surname'];
		$position_code= $result['position_code'];
			if(($M%2) == 0){
			$color="#FFFFC";
			}
			else {
			$color="#FFFFFF";
			}
	
if(!isset($position_ar[$position_code])){
$position_ar[$position_code]="";
}			

if(!isset($collect_day_ar[$person_id])){
$collect_day_ar[$person_id]="";
}
		
if(!isset($this_year_day_ar[$person_id])){
$this_year_day_ar[$person_id]="";
}		

echo "<Tr bgcolor='$color' align='center'><Td>$N</Td>";
echo "<Td align='left'>$prename&nbsp;$name&nbsp;&nbsp;$surname</Td><Td align='left'>$position_ar[$position_code]</Td>";
echo "<td><input type='text' name='collect_day$person_id' value='$collect_day_ar[$person_id]' size='6'></td>";
echo "<td><input type='text' name='this_year_day$person_id' value='$this_year_day_ar[$person_id]' size='6'></td>";
echo "</tr>";
$M++;
$N++;
	}
	
echo "</Table>";
echo "<br>";
echo "<div align='center'><INPUT TYPE='button' name='smb' value='บันทึก' onclick='goto_url(1)' class=entrybutton></div>";
echo "</form>";
?>

<script>
function goto_url(val){
	if(val==0){
		callfrm("?option=la&task=main/collection");   // page ย้อนกลับ 
	}else if(val==1){
	callfrm("?option=la&task=main/collection&index=4");   //page ประมวลผล
	}
}

</script>

