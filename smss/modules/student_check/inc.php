<?php

function get_vals($check_date,$id,$chkyear){
	include"smss_connect.php";
	$sql="Select * From student_check_main where student_id='$id' and check_date='$check_date' and student_check_year='$chkyear'";
	$query=mysql_query($sql);
	$return_vals=mysql_fetch_assoc($query);
	return $return_vals['check_val'];
}

$thai_day_arr=array("อาทิตย์","จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์","เสาร์");
$thai_month_arr=array(
	"0"=>"",
	"1"=>"มกราคม",
	"2"=>"กุมภาพันธ์",
	"3"=>"มีนาคม",
	"4"=>"เมษายน",
	"5"=>"พฤษภาคม",
	"6"=>"มิถุนายน",	
	"7"=>"กรกฎาคม",
	"8"=>"สิงหาคม",
	"9"=>"กันยายน",
	"10"=>"ตุลาคม",
	"11"=>"พฤศจิกายน",
	"12"=>"ธันวาคม"					
);
function thai_date($time){
	global $thai_day_arr,$thai_month_arr;
	$thai_date_return="วัน".$thai_day_arr[date("w",$time)];
	$thai_date_return.=	"ที่ ".date("j",$time);
	$thai_date_return.=" เดือน".$thai_month_arr[date("n",$time)];
	$thai_date_return.=	" พ.ศ.".(date("Y",$time)+543);
	#$thai_date_return.=	"  ".date("H:i",$time)." น.";
	return $thai_date_return;
}
//$index=$_GET['index'];
#ระดับการศึกษา
$sql_edu_level="Select * from student_main_class";
$query_edu_level=mysql_query($sql_edu_level);
$edu_level=array();
while($e=mysql_fetch_assoc($query_edu_level))
{
	$edu_level[$e['class_code']]=$e['class_name'];
}

$a_val=array("0" => "C", "1" => "W", "2" => "S", "3" => "L");
$a_val_txt=array("0" => "มา", "1" => "ลา", "2" => "ป่วย", "3" => "ขาด");
$refer=$_SERVER['HTTP_REFERER'];
$check_person_id=$_SESSION['login_user_id'];

#เรียกปีการศึกษาปัจจบัน
$sql_y="select * from student_check_year where year_active=1";
$ry=mysql_query($sql_y);
$yactive=mysql_fetch_assoc($ry);
$year_active=$yactive['student_check_year'];
$txtyear_active=($year_active=="")?"<a href=?option=student_check&task=set/year><FONT SIZE=3 COLOR=red>คุณยังไม่ได้ตั้งค่าปีการศึกษาปัจจุบัน</FONT></a>":$year_active;

#####เช็คว่ามีสิทธิ์บันทึกห้องใดได้บ้าง
$year_active=($year_active=="")?0:$year_active;
if($_SESSION['admin_student_check']=="student_check"){
	$sql_chk="SELECT `student_main`.`class_now` , `student_main`.`room` as room_now FROM student_main GROUP BY `student_main`.`class_now` , `student_main`.`room`  ";
}else{
	$sql_chk="Select * from student_check_permission where person_id='$check_person_id'";
}
	$sql_chk="Select * from student_check_permission where person_id='$check_person_id' and student_check_year=$year_active";
$r_chk=mysql_query($sql_chk);
$r_list=array();#echo $sql_chk;
if(mysql_num_rows($r_chk)<1){}else{
while($rs_chk=mysql_fetch_assoc($r_chk)){
	$r_list[]=$rs_chk['class_now'].",".$rs_chk['room_now'];
	}
}

/**
* Simple function to replicate PHP 5 behaviour
*/
function microtime_float()
{
list($usec, $sec) = explode(" ", microtime());
return ((float)$usec + (float)$sec);
}

$time_start = microtime_float();

// Sleep for a while
for($i=0;$i<10000;$i++)
{
}
// usleep(100);
?>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo "./modules/$_GET[option]/css.css";?>" />