<?php
require("fpdf.php");
$connect=mysql_connect($_POST['cer_host'],$_POST['cer_user'],$_POST['cer_pass']) or die("ติดต่อฐานข้อมูลไม่ได้");
mysql_select_db($_POST['cer_db'])  or die("เลือกฐานข้อมูลไม่ได้");
mysql_query("SET character_set_results=tis620");
mysql_query("SET character_set_client=tis620");
mysql_query("SET character_set_connection=tis620");
function thainumDigit($num){  
    return str_replace(array( '0' , '1' , '2' , '3' , '4' , '5' , '6' ,'7' , '8' , '9' ),  
    array( "๐" , "๑" , "๒" , "๓" , "๔" , "๕" , "๖" , "๗" , "๘" , "๙" ),  
    $num);  
}  

function thainumDigit2($num){  
    return str_replace(array( '01' , '02' , '03' , '04' , '05' , '06' ,'07' , '08' , '09' ),  
    array( "1" , "2" , "3" , "4" , "5" , "6" , "7" , "8" , "9" ),  
    $num);  
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

$sql = "SELECT * FROM system_school_name";
$result = mysql_query($sql);
$oj_re = mysql_fetch_array($result);

$sql = "SELECT * FROM bookregister_certificate where ms_id='$_POST[ms_id]'";
$result = mysql_query($sql);
$row= mysql_fetch_array($result);

if($row['khet_print']==0){
exit();
}

if($row['quarantee']==2){
echo "ไม่ผ่านการตรวจสอบทะเบียนโดยเจ้าหน้าที่";
exit();
}

$register_year=$row['year'];
$register_number=$row['register_number'];
$number_text="เลขที่ ".$register_number."/".$register_year;
$number_text=thainumDigit($number_text);

$cer_name=$row['name_cer'];
$subject=$row['subject'];
$subject2=$row['subject2'];
$subject2=thainumDigit($subject2);
$out_date=$row['signdate'];
$out_date=explode("-", $out_date);


$date=$out_date[2];
$date=thainumDigit2($date);
$month=$out_date[1];
$month=$thai_month_arr[$month];
$year=$out_date[0]+543;
$date_text="ให้ไว้ ณ วันที่  ".$date."  เดือน".$month."  พุทธศักราช  ".$year;
$date_text=thainumDigit($date_text);

$office=$oj_re['school_name'];
$office=thainumDigit($office);

$sql_sign = "SELECT * FROM bookregister_cer_sign where code='$row[sign_person]'";
$result_sign = mysql_query($sql_sign);
$row_sign= mysql_fetch_array($result_sign);
$name=$row_sign['name'];
$position1=$row_sign['position1'];
$position1=thainumDigit($position1);
$position2=$row_sign['position2'];
$position2=thainumDigit($position2);
$sign_pic=$row_sign['sign_pic'];

if($sign_pic!=""){
$sign_pic="../sign_picture/".$sign_pic;
}
else{
$sign_pic="image/chinpat.jpg";
}

///////////////////////////////////////

$pdf=new FPDF( 'L' , 'mm' , 'A4' );

$pdf->AddPage();
$pdf->AddFont("AngsanaNew","","angsa.php");
$pdf->AddFont("AngsanaNew","B","angsab.php");
$pdf->AddFont("AngsanaNew","I","angsai.php");

$pdf->Image('image/bg.jpg',0,0,297,210);

$pdf->Image('image/obec.jpg',133,10,30,0);
$pdf->Ln(7);
$pdf->SetFont("AngsanaNew","",20); 
$pdf->Cell(0,7,"$number_text" ,0,0,0,0 );

$pdf->Ln(28);
$pdf->SetFont("AngsanaNew","B",35); 
$pdf->Cell(0,30,"{$office}"  , 0 , 1 , 'C');
$pdf->Ln(1);
$pdf->SetFont("AngsanaNew","B",30); 
$pdf->Cell(0,5,"เกียรติบัตรฉบับนี้ให้ไว้เพื่อแสดงว่า" , 0 , 1 , 'C');
$pdf->Ln(8);
$pdf->SetFont("AngsanaNew","B",30); 
$pdf->Cell(0,8,"{$cer_name}" , 0 , 1 , 'C');
$pdf->Ln(8);
$pdf->SetFont("AngsanaNew","B",26); 
$pdf->Cell(0,5,"{$subject}"  , 0 , 1 , 'C');

if($subject2!=""){
$pdf->Ln(6);
$pdf->SetFont("AngsanaNew","B",26); 
$pdf->Cell(0,5,"{$subject2}"  , 0 , 1 , 'C');
}

$pdf->Ln(8);
$pdf->SetFont("AngsanaNew","B",26); 
$pdf->Cell(0,5,"ขอให้มีความสุข  สวัสดิ์  เจริญด้วยจตุรพิธพรชัยทุกประการ"  , 0 , 1 , 'C');

$pdf->Ln(8);
$pdf->SetFont("AngsanaNew","B",26); 

$pdf->Cell(0,5,"{$date_text}" , 0 , 1 , 'C');
$pdf->Ln(18);

if($subject2==""){
		if($row['quarantee']==1){
		$pdf->Image("$sign_pic",128,140,40,0);
		}
}
else{
		if($row['quarantee']==1){
		$pdf->Image("$sign_pic",128,150,40,0);
		}
}

$pdf->Ln(3);
$pdf->SetFont("AngsanaNew","B",18); 
$pdf->Cell(0,5,"({$name})"  , 0 , 1 , 'C');

$pdf->Ln(4);
$pdf->SetFont("AngsanaNew","B",18); 
$pdf->Cell(0,5,"{$position1}"  , 0 , 1 , 'C');
$pdf->Cell(0,7,"{$position2}"  , 0 , 1 , 'C');

$pdf->Output();

?>