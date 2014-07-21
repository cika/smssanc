<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>AMSS++</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/mm_training.css" type="text/css" />
<style type="text/css">
<!--
.style1 {font-size: 14px}
-->
</style>

<?php
require_once "../../smss_connect.php";	
require_once("../../mainfile.php");
require_once "time_inc.php";	

$thai_month_arr=array(
	"01"=>"มกราคม",
	"02"=>"กุมภาพันธ์",
	"03"=>"มีนาคม",
	"04"=>"เมษายน",
	"05"=>"พฤษภาคม",
	"06"=>"มิถุนายน",	
	"07"=>"กรกฎาคม",
	"08"=>"สิงหาคม",
	"09"=>"กันยายน",
	"10"=>"ตุลาคม",
	"11"=>"พฤศจิกายน",
	"12"=>"ธันวาคม"					
);

//แปลงรูปแบบ date
$f1_date=explode("-", $_GET['start_date']);
$thai_month=$thai_month_arr[$f1_date[1]];
$thai_year=$f1_date[0]+543;

//ส่วนรายละเอียด


$sql_name = "select * from person_main where person_id='$_GET[person_id]' ";
$dbquery_name = mysql_query($sql_name);
$result_name = mysql_fetch_array($dbquery_name);
		$person_id = $result_name['person_id'];
		$prename=$result_name['prename'];
		$name= $result_name['name'];
		$surname = $result_name['surname'];
		$position_code = $result_name['position_code'];
$full_name="$prename$name&nbsp;&nbsp;$surname";

$sql_post = "select * from  person_position where position_code='$position_code'";
$dbquery_post = mysql_query($sql_post);
$result_post = mysql_fetch_array($dbquery_post);
$position_name=$result_post['position_name'];


echo "<br />";
echo "<table width='99%' border='0' align='center'>";
echo "<tr align='center'><td colspan=2><font color='#006666' size='3'><strong>การปฏิบัติราชการเดือน$thai_month พ.ศ.$thai_year</strong></font></td></tr>";
echo "<tr align='center'><td colspan=2><font color='#006666' size='3'><strong>";
if($name!=""){
echo $full_name;
}
else{
echo $_GET['person_id'];
}
echo " $position_name</strong></font></td></tr>";
echo "</table>";
echo "<br />";

$sql_work = "select work_date, work from work_main where person_id='$_GET[person_id]' and work_date between '$_GET[start_date]' and '$_GET[end_date]' order by work_date";

$dbquery_work = mysql_query($sql_work);
$num_rows=mysql_num_rows($dbquery_work);

if($num_rows<1){
echo "<div align='center'><font color='#CC0000' size='3'>ไม่มีรายการ</font></div>";
echo exit();
}
echo  "<table width='95%' border='0' align='center'>";
echo "<Tr bgcolor='#FFCCCC' align='center' class='style1'><Td width='50'>ที่</Td>";
echo "<Td>วัน เดือน ปี</Td><Td>มา</Td><Td>ไปราชการ</Td><Td>ลาป่วย</Td><Td>ลากิจ</Td><Td>ลาพักผ่อน</Td><Td>ลาคลอด</Td><Td>ลาอื่นๆ</Td><Td>มาสาย</Td><Td>ไม่มา</Td></Tr>";
$N=1;
$work_1_sum=0; $work_2_sum=0; $work_3_sum=0;	$work_4_sum=0;	$work_5_sum=0;	$work_6_sum=0;	$work_7_sum=0;	$work_8_sum=0;	$work_9_sum=0;		

While ($result_work = mysql_fetch_array($dbquery_work)){
		//$person_id = $result_work['person_id'];
		
						if(($N%2) == 0)
						$color="#FFFFC";
						else  	$color="#FFFFFF";
						
$work_1=""; $work_2=""; $work_3="";	$work_4="";	$work_5="";	$work_6="";	$work_7="";	$work_8="";	$work_9="";		

if($result_work['work']==1){
$work_1="มา";
$work_1_sum=$work_1_sum+1;
}
else if($result_work['work']==2){
$work_2="ไปราชการ";
$work_2_sum=$work_2_sum+1;

}
else if($result_work['work']==3){
$work_3="ลาป่วย";
$work_3_sum=$work_3_sum+1;
}			
else if($result_work['work']==4){
$work_4="ลากิจ";
$work_4_sum=$work_4_sum+1;
}			
else if($result_work['work']==5){
$work_5="ลาพักผ่อน";
$work_5_sum=$work_5_sum+1;
}			
else if($result_work['work']==6){
$work_6="ลาคลอด";
$work_6_sum=$work_6_sum+1;
}			
else if($result_work['work']==7){
$work_7="ลาอื่นๆ";
$work_7_sum=$work_7_sum+1;
}			
else if($result_work['work']==8){
$work_8="มาสาย";
$work_8_sum=$work_8_sum+1;
}			
else if($result_work['work']==9){
$work_9="ไม่มา";
$work_9_sum=$work_9_sum+1;
}			
		
echo "<tr bgcolor='$color' class='style1'>";
echo "<td align='center'>$N</td><td>";

$date=thai_date_2($result_work['work_date']);
echo $date;
echo"</td>";
echo "<td align='center'>$work_1</td><td align='center'>$work_2</td><td align='center'>$work_3</td><td align='center'>$work_4</td><td align='center'>$work_5</td><td align='center'>$work_6</td><td align='center'>$work_7</td><td align='center'>$work_8</td><td align='center'>$work_9</td>";
echo "</tr>";
$N++;
}
echo "<tr bgcolor='#FFCCCC' align='center' class='style1'>";
echo "<td colspan='2'>รวม</td><td>$work_1_sum</td><td>$work_2_sum</td><td>$work_3_sum</td><td>$work_4_sum</td><td>$work_5_sum</td><td>$work_6_sum</td><td>$work_7_sum</td><td>$work_8_sum</td><td>$work_9_sum</td>";
echo "</tr>";
$work_sum_total=$work_1_sum+$work_2_sum+$work_3_sum+$work_4_sum+$work_5_sum+$work_6_sum+$work_7_sum+$work_8_sum+$work_9_sum;
$percent_work_1=($work_1_sum/$work_sum_total)*100;
$percent_work_1=number_format($percent_work_1,2);
$percent_work_2=($work_2_sum/$work_sum_total)*100;
$percent_work_2=number_format($percent_work_2,2);
$percent_work_3=($work_3_sum/$work_sum_total)*100;
$percent_work_3=number_format($percent_work_3,2);
$percent_work_4=($work_4_sum/$work_sum_total)*100;
$percent_work_4=number_format($percent_work_4,2);
$percent_work_5=($work_5_sum/$work_sum_total)*100;
$percent_work_5=number_format($percent_work_5,2);
$percent_work_6=($work_6_sum/$work_sum_total)*100;
$percent_work_6=number_format($percent_work_6,2);
$percent_work_7=($work_7_sum/$work_sum_total)*100;
$percent_work_7=number_format($percent_work_7,2);
$percent_work_8=($work_8_sum/$work_sum_total)*100;
$percent_work_8=number_format($percent_work_8,2);
$percent_work_9=($work_9_sum/$work_sum_total)*100;
$percent_work_9=number_format($percent_work_9,2);

echo "<tr bgcolor='#FFCCCC' align='center' class='style1'>";
echo "<td colspan='2'>%</td><td>$percent_work_1%</td><td>$percent_work_2%</td><td>$percent_work_3%</td><td>$percent_work_4%</td><td>$percent_work_5%</td><td>$percent_work_6%</td><td>$percent_work_7%</td><td>$percent_work_8%</td><td>$percent_work_9%</td>";
echo "</tr>";

echo "</table>";
?>


