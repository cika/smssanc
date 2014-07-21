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

$th_month[1]="มกราคม";
$th_month[2]="กุมภาพันธ์";
$th_month[3]="มีนาคม";
$th_month[4]="เมษายน";
$th_month[5]="พฤษภาคม";
$th_month[6]="มิถุนายน";
$th_month[7]="กรกฎาคม";
$th_month[8]="สิงหาคม";
$th_month[9]="กันยายน";
$th_month[10]="ตุลาคม";
$th_month[11]="พฤศจิกายน";
$th_month[12]="ธันวาคม";

function thai_date($date){
		if(!isset($date)){
		return;
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
	$f_date=explode("-", $date);
	$time=mktime(0, 0, 0, $f_date[1], $f_date[2], $f_date[0]);

	$thai_date_return="วัน".$thai_day_arr[date("w",$time)];
	$thai_date_return.=	"ที่ ".date("j",$time);
	$thai_date_return.=" เดือน".$thai_month_arr[date("n",$time)];
	$thai_date_return.=	" พ.ศ.".(date("Y",$time)+543);
	if($date!=""){
	return $thai_date_return;
	}
	else{
	$thai_date_return="";
	return $thai_date_return;
	}
}

//date(yy/mm/dd)
function make_time($date){
		if(!isset($date)){
		return;
		}
	$f_date=explode("-", $date);
	$time=mktime(0, 0, 0, $f_date[1], $f_date[2], $f_date[0]);
	return $time;
}

//date(yy/mm/dd H:i:s)  
function make_time_2($date){
		if(!isset($date)){
		return;
		}
	$f_date_2=explode(" ", $date); 
	$f_date=explode("-", $f_date_2[0]);
	$f_date[0]=intval($f_date[0]);
	$f_date[1]=intval($f_date[1]);
	$f_date[2]=intval($f_date[2]);
	if(isset($f_date_2[1])){
	$f_time=explode(":", $f_date_2[1]);
	$f_time[0]=intval($f_time[0]);
	$f_time[1]=intval($f_time[1]);
	$f_time[2]=intval($f_time[2]);
	}
	else{
	$f_time[0]=0;
	$f_time[1]=0;
	$f_time[2]=0;
	}
	$time=mktime($f_time[0], $f_time[1], $f_time[2], $f_date[1], $f_date[2], $f_date[0]);
	return $time;
}

//date(yy/mm/dd)
function thai_date_2($date){
		if(!isset($date)){
		return;
		}
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
	$f_date=explode("-", $date);
	$f_date[2]=intval($f_date[2]);
	$thai_date_return.=	"วันที่ ".$f_date[2];
	$thai_date_return.=" เดือน".$thai_month_arr[$f_date[1]];
	$thai_date_return.=	" พ.ศ.".($f_date[0]+543);
	if($date!=""){
	return $thai_date_return;
	}
	else{
	$thai_date_return="";
	return $thai_date_return;
	}
}

//date(yy/mm/dd)
function thai_date_3($date){
		if(!isset($date)){
		return;
		}
$thai_month_arr=array(
	"01"=>"มค",
	"02"=>"กพ",
	"03"=>"มีค",
	"04"=>"เมย",
	"05"=>"พค",
	"06"=>"มิย",	
	"07"=>"กค",
	"08"=>"สค",
	"09"=>"กย",
	"10"=>"ตค",
	"11"=>"พย",
	"12"=>"ธค"					
);
	$f_date_2=explode(" ", $date);
	$f_date=explode("-", $f_date_2[0]);
	$f_date[2]=intval($f_date[2]);
	$thai_date_return="";
	$thai_date_return.=	$f_date[2];
	$thai_date_return.= " ".$thai_month_arr[$f_date[1]]." ";
	$thai_date_return.=	$f_date[0]+543;
	if($date!=""){
	return $thai_date_return;
	}
	else{
	$thai_date_return="";
	return $thai_date_return;
	}
}

//date(yy/mm/dd)
function thai_date_4($date){
		if(!isset($date)){
		return;
		}
$thai_month_arr=array(
	"01"=>"มค",
	"02"=>"กพ",
	"03"=>"มีค",
	"04"=>"เมย",
	"05"=>"พค",
	"06"=>"มิย",	
	"07"=>"กค",
	"08"=>"สค",
	"09"=>"กย",
	"10"=>"ตค",
	"11"=>"พย",
	"12"=>"ธค"					
);
	$f_date_2=explode(" ", $date);
	$f_date=explode("-", $f_date_2[0]);
	$f_date[2]=intval($f_date[2]);
	$thai_date_return="";
	$thai_date_return.=	$f_date[2];
	$thai_date_return.= " ".$thai_month_arr[$f_date[1]]." ";
	$thai_date_return.=	$f_date[0]+543;
	$thai_date_return.=	" ".$f_date_2[1]." น.";
	if($date!=""){
	return $thai_date_return;
	}
	else{
	$thai_date_return="";
	return $thai_date_return;
	}
}
?>
