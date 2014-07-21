<?php
date_default_timezone_set('Asia/Bangkok'); 
//(1) ปรับเวลาให้ตรงกับเวลาเมืองไทย กรณีที่ server อยู่ที่เมืองนอก โดยความสำคัญอยู่ที่ตัวแปร $hour และ $min 
	$hour = 0;   //ปรับให้ตรงตามต้องการ
	$min = 0;  //ปรับให้ตรงตามต้องการ
	$Year = date("Y")+543;
	$thaiweekFull=array("วันอาทิตย์ ที่","วันจันทร์ ที่","วันอังคาร ที่","วันพุธ ที่","วันพฤหัสบดี ที่","วันศุกร์ ที่","วันเสาร์ ที่");
	$thaimonthFull=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม", "พฤศจิกายน","ธันวาคม");
	$thaimonth=array("ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.", "พ.ย.","ธ.ค.");

	//คุณสามารถเลือกใช้งานได้ 3 อย่างคือ.. $mdate หรือ $ThaiDate หรือ $ThaiDateFull

	// 3 ส.ค. 2544
	$mdate = date("j ",mktime( date("H")+$hour, date("i")+$min )). $thaimonth[date("m")-1]." ".$Year; 

	// 3 ส.ค. 2544 เวลา 12:36 น.
	$ThaiDate = date("j ").$thaimonth[date("m")-1]." ".$Year.date(" เวลา H:i น.",mktime( date("H")+$hour, date("i")+$min )); 
	
	// วันศุกร์ที่ 3 ส.ค. 2544 เวลา 12:36 น.
	$ThaiDateFull = $thaiweekFull[date("w")]. date(" j "). $thaimonthFull[date("m")-1]. " ". $Year . date(" เวลา H:i น.",mktime( date("H")+$hour, date("i")+$min )); 

	// ได้ค่าเป็น วินาที นับจากปี ค.ศ.1900
	$Logtime = date("U",mktime( date("H")+$hour, date("i")+$min ));

	// ส่งค่า 25540228
		$myday=date("j ");
		$mymonth=date("m");
		$myyear=date("Y")+543;
		$zero="0";
		$len_myday=strlen($myday);
		if ($len_myday==1)
			{ $myday=$zero."".$myday;
			}
			$len_mymonth=strlen($mymonth);
			if ($len_mymonth==1)
				{ $mymonth=$zero."".$mymonth;
				}
		$dayinput = $myyear."".$mymonth."".$myday;
?>