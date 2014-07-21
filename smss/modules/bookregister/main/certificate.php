<script type="text/javascript" src="./css/js/calendarDateInput2.js"></script> 

<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );

require_once "modules/bookregister/time_inc.php";	
$user2=$user;
$user=$_SESSION['login_user_id'];

if(!isset($_REQUEST['search_index'])){
$_REQUEST['search_index']="";
}

if(!isset($_REQUEST['search'])){
$_REQUEST['search']="";
}

if(!isset($_REQUEST['field'])){
$_REQUEST['field']="";
}

//ส่วนหัว
echo "<br />";
if(!(($index==1) or ($index==2) or ($index==5))){

echo "<table width='100%' border='0' align='center'>";
echo "<tr align='center'><td><font color='#006666' size='3'><strong>ทะเบียนเกียรติบัตร</strong></font></td></tr>";
echo "</table>";
}

//ส่วนฟอร์มรับข้อมูล
if($index==1){

//เช็คการเปิดใช้งานทะเบียน
$sql_start="select * from bookregister_year where year_active='1' and school_code is null";
$query_start=mysql_query($sql_start);
$result_start=mysql_fetch_array($query_start);


		if(!($result_start)){
		echo "<div align='center'>ยังไม่ได้กำหนดปีปฏิทินการทำงาน กรุณาแจ้งเจ้าหน้าที่ทะเบียน</div>";
		exit();
		}
		
		if($result_start['start_cer_num']==0){
		echo "<div align='center'>ทะเบียนเกียรติบัตรไม่ได้เปิดใช้งาน</div>";
		exit();
		}
		//ตั้งค่าเวลาลงทะเบียนไม่ให้เกินปี		
		$this_year=$result_start['year']-543;
		$now=time();
		$timestamp_end_year=mktime(23,59,59,12,31,$this_year);
		if($now>=$timestamp_end_year){
		echo "<div align='center'>ทะเบียนปีเก่าปิดโดยอัตโนมัติหลังสิ้นปี  เจ้าหน้าที่กรุณาตั้งปีใหม่เพื่อลงทะเบียน</div>";
		exit();
		}

//นำข้อมูลล่าสุดมาไว้ในฟอร์ม		
$sql = "select * from  bookregister_certificate where officer='$_SESSION[login_user_id]' order by ms_id desc limit 0,1";
$dbquery = mysql_query($sql);
$result_ref = mysql_fetch_array($dbquery);
		
		
		
echo "<form Enctype = multipart/form-data id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>ลงทะเบียนเกียรติบัตร</Font>";
echo "</Cener>";
echo "<Br>";
echo "<table border='1' width='700' id='table1' style='border-collapse: collapse' bordercolor='#C0C0C0'>";
echo "<tr bgcolor='#9900CC'>";
echo "<td colspan='4' height='23' align='left'><font size='2' color='#FFFFFF'>&nbsp;กรุณาระบุรายละเอียด</font></td>";
echo "</tr>";
echo "<tr>";
echo "<td align='right'><span lang='th'><font size='2' color='#0000FF'>ชื่อ&nbsp;</font></span></td>";
echo "<td colspan='3' align='left'>&nbsp;<input type='text' name='name_cer' size='80'  style='background-color: #E7D8EB'></td>";
echo "</tr>";
echo "<tr>";
echo "<td align='right'><span lang='th'><font size='2' color='#0000FF'>เรื่อง บรรทัดที่1&nbsp;</font></span></td>";
echo "<td colspan='3' align='left'>&nbsp;<input type='text' name='subject' size='80' value='$result_ref[subject]' style='background-color: #E7D8EB'></td>";
echo "</tr>";
echo "<tr>";
echo "<td align='right'><span lang='th'><font size='2' color='#0000FF'>บรรทัดที่2&nbsp;</font></span></td>";
echo "<td colspan='3' align='left'>&nbsp;<input type='text' name='subject2' size='80' value='$result_ref[subject2]' style='background-color: #E7D8EB'></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right'><span lang='th'><font size='2' color='#0000FF'>วันที่ออก&nbsp;</font></span></td>";
echo "<td colspan='3' align='left'>";

if($result_ref['signdate']!=""){
$f_date=explode("-", $result_ref['signdate']);
$y_year=$f_date[0];
$m_year=$f_date[1];
$d_year=$f_date[2];
?>
<script>
var Y_date 
var y_year=<?php echo $y_year;?> 
var m_year=<?php echo $m_year;?> 
var d_year=<?php echo $d_year;?> 
Y_date= y_year+'/'+m_year+'/'+d_year
DateInput('signdate', true, 'YYYY-MM-DD' ,Y_date)
</script>
<?php
}
else{
?>
<script>DateInput('signdate', true, 'YYYY-MM-DD')</script>
<?php
}

echo "</td>";
echo "</tr>";
echo "<Tr><Td align='right'><font size='2' color='#0000FF'>ผู้ลงนาม</font>&nbsp;&nbsp;&nbsp;&nbsp;</Td>";
echo "<td><div align='left'><Select  name='sign_person'  size='1'>";
echo  "<option  value = ''>เลือก</option>" ;
$sql = "select  * from bookregister_cer_sign order by id";
$dbquery = mysql_query($sql);
While ($result = mysql_fetch_array($dbquery))
   {
		$code = $result['code'];
		$name = $result['name'];
		if($result_ref ['sign_person']==$code){
		echo  "<option value = $code selected>$name</option>" ;
		}
		else{
		echo  "<option value=$code>$name</option>" ;
		}
	}
echo "</select>";
echo "</div></td></tr>";

$print_check_0=""; $print_check_1=""; $print_check_2=""; 
if($result_ref ['khet_print']==0){
$print_check_0="checked";
}
else if($result_ref ['khet_print']==1){
$print_check_1="checked";
}

echo "<tr>";
echo "<td align='right'><span lang='th'><font size='2' color='#0000FF'>การพิมพ์โดยระบบ&nbsp;</font></span></td>";
echo "<td colspan='3' align='left'>&nbsp;<input type='radio' name='khet_print' id='khet_print'  value='0' $print_check_0>ไม่พิมพ์&nbsp;<input type='radio' name='khet_print'  id='khet_print'  value='1' $print_check_1>พิมพ์</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right'><span lang='th'><font size='2' color='#0000FF'>หมายเหตุ&nbsp;</font></span></td>";
echo "<td colspan='3' align='left'>&nbsp;<input type='text' name='comment' size='50'  style='background-color: #FFDDFF' value='$result_ref[comment]'></td>";
echo "</tr>";

echo "<tr>";
echo "<td width='371' align='right' colspan='3'><p align='center'><font size='2' color='#800000'>แนบไฟล์(ถ้ามี)</font></td>";
echo "</tr>";

echo "<tr>";
echo "<td width='94' align='right'><font size='2' color='#0000FF'>ไฟล์แนบ&nbsp;</font></td>";
echo "<td width='274' colspan='3' align='left'>&nbsp;<input type='file' name='myfile1' size='50' style='background-color: #FFDDFF'></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='center' colspan='4'><FONT SIZE='2' COLOR='#CC9900'>เฉพาะไฟล์ doc, docx, pdf, xls, xlsx, gif, jpg, zip, rar เท่านั้น</FONT></td>";
echo "</tr>";
echo "<tr>";
echo "<td align='center' colspan='4'><BR><INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url(1)' class=entrybutton>&nbsp;&nbsp;<input type='reset' value='Reset' name='reset'></td>";
echo "</tr>";
echo "</Table>";
echo "</form>";
}

//ส่วนยืนยันการลบข้อมูล
if($index==2) {
echo "<table width='500' border='0' align='center'>";
echo "<tr><td align='center'><font color='#990000' size='4'>โปรดยืนยันความต้องการลบข้อมูลอีกครั้ง</font><br></td></tr>";
echo "<tr><td align=center>";
echo "<INPUT TYPE='button' name='smb' value='ยืนยัน' onclick='location.href=\"?option=bookregister&task=main/certificate&index=3&id=$_GET[id]&page=$_REQUEST[page]\"'>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ยกเลิก' onclick='location.href=\"?option=bookregister&task=main/certificate&page=$_REQUEST[page]\"'";
echo "</td></tr></table>";
}

//ส่วนลบข้อมูล
if($index==3){
$sql = "delete from bookregister_certificate where ms_id='$_GET[id]' ";
$dbquery = mysql_query($sql);
}

//ส่วนบันทึกข้อมูล
if($index==4){
$sizelimit = 20000*1024 ;  //ขนาดไฟล์

$upfile1=""; 
$sizelimit1="";

if(isset($_POST ['dfile1'])){
$dfile1 = $_POST ['dfile1'] ;
}

$subject = $_POST ['subject'] ;

/// file
$myfile1 = $_FILES ['myfile1'] ['tmp_name'] ;
$myfile1_name = $_FILES ['myfile1'] ['name'] ;
$myfile1_size = $_FILES ['myfile1'] ['size'] ;
$myfile1_type = $_FILES ['myfile1'] ['type'] ;

 $array_last1 = explode("." ,$myfile1_name) ;
 $c1 =count ($array_last1) - 1 ;
 $lastname1 = strtolower ($array_last1 [$c1] ) ;

 if  ($myfile1<>"") {
 if ($lastname1 =="doc" or $lastname1 =="docx" or $lastname1 =="rar" or $lastname1 =="pdf" or $lastname1 =="xls" or $lastname1 =="xlsx" or $lastname1 =="zip" or $lastname1 =="jpg" or $lastname1 =="gif" ) { 
	 $upfile1 = "" ; 
  }else {
	 $upfile1 = "-ไม่อนุญาตให้ทำการแนบไฟล์ $myfile1_name<BR> " ;
  } 

  If ($myfile1_size>$sizelimit) {
	  $sizelimit1 = "-ไฟล์ $myfile1_name มีขนาดใหญ่กว่าที่กำหนด<BR>" ;
  }else {
		$sizelimit1 = "" ;
  }
 }
  ####

////

if($_POST['signdate']==""||$_POST['subject'] ==""){
	echo "<CENTER><font size=\"2\" color=\"#008000\">กรุณากรอกข้อมูลให้ครบ<br><br>";
	echo "<input type=\"button\" value=\"แก้ไขข้อมูล\" onClick=\"javascript:history.go(-1)\" ></CENTER>" ;
	exit(); 
} #จบ


// check file size  file name
if ($upfile1<> "" || $sizelimit1<> "") {

echo "<B><FONT SIZE=2 COLOR=#990000>มีข้อผิดพลาดเกี่ยวกับไฟล์ของคุณ ดังรายละเอียด</FONT></B><BR>" ;
echo "<FONT SIZE=2 COLOR=#990099>" ;
 echo  $upfile1 ;
 echo  $sizelimit1 ;
 echo "</FONT>" ;
 echo "&nbsp;&nbsp;&nbsp;<input type=\"button\" value=\"&nbsp;&nbsp;แก้ไข&nbsp;&nbsp;\" onClick=\"javascript:history.go(-1)\" ></CENTER>" ;
exit () ;
}

//ส่วนการบันทึก
$day_now=date("Y-m-d");

$timestamp = mktime(date("H"), date("i"),date("s"), date("m") ,date("d"), date("Y"))  ;	
//timestamp เวลาปัจจุบัน 
$rand_number=rand();
$ref_id = $timestamp."x".$rand_number;

//เลขทะเบียน
$sql_start="select * from bookregister_year where year_active='1' ";
$query_start=mysql_query($sql_start);
$result_start=mysql_fetch_array($query_start);

$sql_number="select  max(register_number) as number_max from bookregister_certificate where year='$result_start[year]' ";
$query_number=mysql_query($sql_number);
$result_number=mysql_fetch_array($query_number);

if($result_number['number_max']<$result_start['start_cer_num']){
$register_number=$result_start['start_cer_num'];
}
else{
$register_number=$result_number['number_max']+1;
}

$book_number=$register_number."/".$result_start['year'];

$myfile1name="";
if ($myfile1<>"" ) {
$myfile1name=$ref_id.".".$lastname1 ; 
copy ($myfile1, "modules/bookregister/upload_files4/".$myfile1name)  ; 

unlink ($myfile1) ;
}

if(!isset($_POST['khet_print'])){
$_POST['khet_print']=0;
}

$sql = "insert into bookregister_certificate(year, register_number, book_no, signdate, name_cer, subject, subject2, comment, sign_person, register_date, officer,file_name, khet_print) values ('$result_start[year]', '$register_number', '$book_number', '$_POST[signdate]', '$_POST[name_cer]', '$_POST[subject]', '$_POST[subject2]', '$_POST[comment]', '$_POST[sign_person]',  '$day_now', '$user', '$myfile1name', '$_POST[khet_print]')";
$dbquery = mysql_query($sql);

} //end index4

if($index==5){
echo "<form Enctype = multipart/form-data id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>แก้ไขข้อมูล</B></Font>";
echo "</Cener>";
echo "<Br><Br>";
$sql = "select * from  bookregister_certificate where ms_id='$_GET[id]'";
$dbquery = mysql_query($sql);
$result_ref = mysql_fetch_array($dbquery);

echo "<table border='1' width='700' id='table1' style='border-collapse: collapse' bordercolor='#C0C0C0'>";
echo "<tr bgcolor='#9900CC'>";
echo "<td colspan='4' height='23' align='left'><font size='2' color='#FFFFFF'>&nbsp;รายละเอียด</font></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right'><span lang='th'><font size='2' color='#0000FF'>ชื่อ&nbsp;</font></span></td>";
echo "<td colspan='3' align='left'>&nbsp;<input type='text' name='name_cer' size='80'  style='background-color: #E7D8EB' value='$result_ref[name_cer]'></td>";
echo "</tr>";


echo "<tr>";
echo "<td align='right'><span lang='th'><font size='2' color='#0000FF'>เรื่องบรรทัดที่1&nbsp;</font></span></td>";
echo "<td colspan='3' align='left'>&nbsp;<input type='text' name='subject' size='80'  style='background-color: #E7D8EB' value='$result_ref[subject]'></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right'><span lang='th'><font size='2' color='#0000FF'>บรรทัดที่2&nbsp;</font></span></td>";
echo "<td colspan='3' align='left'>&nbsp;<input type='text' name='subject2' size='80' value='$result_ref[subject2]' style='background-color: #E7D8EB'></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right'><span lang='th'><font size='2' color='#0000FF'>วันที่ออก&nbsp;</font></span></td>";
echo "<td colspan='3' align='left'>";

$f_date=explode("-", $result_ref['signdate']);
$y_year=$f_date[0];
$m_year=$f_date[1];
$d_year=$f_date[2];
?>
<script>
var Y_date 
var y_year=<?php echo $y_year;?> 
var m_year=<?php echo $m_year;?> 
var d_year=<?php echo $d_year;?> 
Y_date= y_year+'/'+m_year+'/'+d_year
DateInput('signdate', true, 'YYYY-MM-DD' ,Y_date)
</script>
<?php
echo "</td>";
echo "</tr>";

echo "</tr>";
echo "<Tr><Td align='right'><font size='2' color='#0000FF'>ผู้ลงนาม</font>&nbsp;&nbsp;&nbsp;&nbsp;</Td>";
echo "<td><div align='left'><Select  name='sign_person'  size='1'>";
echo  "<option  value = ''>เลือก</option>" ;
$sql = "select  * from bookregister_cer_sign order by id";
$dbquery = mysql_query($sql);
While ($result = mysql_fetch_array($dbquery))
   {
		$code = $result['code'];
		$name = $result['name'];
		if($result_ref ['sign_person']==$code){
		echo  "<option value = $code selected>$name</option>" ;
		}
		else{
		echo  "<option value=$code>$name</option>" ;
		}
	}
echo "</select>";
echo "</div></td></tr>";

$print_check_0=""; $print_check_1=""; $print_check_2=""; 
if($result_ref ['khet_print']==0){
$print_check_0="checked";
}
else if($result_ref ['khet_print']==1){
$print_check_1="checked";
}

echo "<tr>";
echo "<td align='right'><span lang='th'><font size='2' color='#0000FF'>การพิมพ์โดยระบบ&nbsp;</font></span></td>";
echo "<td colspan='3' align='left'>&nbsp;<input type='radio' name='khet_print' id='khet_print'  value='0' $print_check_0>ไม่พิมพ์&nbsp;<input type='radio' name='khet_print'  id='khet_print'  value='1' $print_check_1>พิมพ์</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right'><span lang='th'><font size='2' color='#0000FF'>หมายเหตุ&nbsp;</font></span></td>";
echo "<td colspan='3' align='left'>&nbsp;<input type='text' name='comment' size='50'  style='background-color: #FFDDFF' value='$result_ref[comment]'></td>";
echo "</tr>";

echo "<tr>";
echo "<td width='371' align='right' colspan='3'><p align='center'><font size='2' color='#800000'>แนบไฟล์(ถ้ามี)</font></td>";
echo "</tr>";

echo "<tr>";
echo "<td width='94' align='right'><font size='2' color='#0000FF'>ไฟล์แนบ 1&nbsp;</font></td>";
echo "<td width='274' colspan='2' align='left'>&nbsp;<input type='file' name='myfile1' size='26' style='background-color: #FFDDFF'></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='center' colspan='4'><FONT SIZE='2' COLOR='#CC9900'>เฉพาะไฟล์ doc, docx, pdf, xls, xlsx, gif, jpg, zip, rar เท่านั้น</FONT></td>";
echo "</tr>";
echo "<Input Type=Hidden Name='id' Value='$_GET[id]'>";
echo "<Input Type=Hidden Name='page' Value='$_GET[page]'>";
echo "<tr>";
echo "<td align='center' colspan='4'><BR><INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url2(1)' class=entrybutton>&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ย้อนกลับ' onclick='goto_url2(0)'</td>";
echo "</tr>";
echo "</Table>";
echo "</form>";
}

if($index==6){

$sql = "select file_name from  bookregister_certificate where ms_id='$_POST[id]'";
$dbquery = mysql_query($sql);
$result_ref = mysql_fetch_array($dbquery);
$old_file_name=$result_ref['file_name'];
if($old_file_name==""){
$old_file_name="x.doc";
}

if($_POST['signdate']=="" ||$_POST['subject'] ==""){
	echo "<CENTER><font size=\"2\" color=\"#008000\">กรุณากรอกข้อมูลให้ครบ<br><br>";
	echo "<input type=\"button\" value=\"แก้ไขข้อมูล\" onClick=\"javascript:history.go(-1)\" ></CENTER>" ;
	exit(); 
} #จบ

$sql = "update bookregister_certificate set  name_cer='$_POST[name_cer]', signdate='$_POST[signdate]', subject='$_POST[subject]', comment='$_POST[comment]' , sign_person='$_POST[sign_person]', subject2='$_POST[subject2]', khet_print='$_POST[khet_print]' where ms_id='$_POST[id]' ";
$dbquery = mysql_query($sql);

$sizelimit = 20000*1024 ;  //ขนาดไฟล์
$upfile1=""; 
$sizelimit1="";

if(isset($_POST ['dfile1'])){
$dfile1 = $_POST ['dfile1'] ;
}
$upfile1="";
$sizelimit1="";

/// file
$myfile1 = $_FILES ['myfile1'] ['tmp_name'] ;
$myfile1_name = $_FILES ['myfile1'] ['name'] ;
$myfile1_size = $_FILES ['myfile1'] ['size'] ;
$myfile1_type = $_FILES ['myfile1'] ['type'] ;

//ลบไฟล์เดิม
if($myfile1!="" ){
		if(file_exists("modules/bookregister/upload_files4/".$old_file_name)) {
		unlink ("modules/bookregister/upload_files4/".$old_file_name) ;
		}
}

 $array_last1 = explode("." ,$myfile1_name) ;
 $c1 =count ($array_last1) - 1 ;
 $lastname1 = strtolower ($array_last1 [$c1] ) ;

 if  ($myfile1<>"") {
 if ($lastname1 =="doc" or $lastname1 =="docx" or $lastname1 =="rar" or $lastname1 =="pdf" or $lastname1 =="xls" or $lastname1 =="xlsx" or $lastname1 =="zip" or $lastname1 =="jpg" or $lastname1 =="gif" ) { 
	 $upfile1 = "" ; 
  }else {
	 $upfile1 = "-ไม่อนุญาตให้ทำการแนบไฟล์ $myfile1_name<BR> " ;
  } 

  If ($myfile1_size>$sizelimit) {
	  $sizelimit1 = "-ไฟล์ $myfile1_name มีขนาดใหญ่กว่าที่กำหนด<BR>" ;
  }else {
		$sizelimit1 = "" ;
  }
 }
  ####
////

// check file size  file name
if ($upfile1<> "" || $sizelimit1<> "") {

echo "<B><FONT SIZE=2 COLOR=#990000>มีข้อผิดพลาดเกี่ยวกับไฟล์ของคุณ ดังรายละเอียด</FONT></B><BR>" ;
echo "<FONT SIZE=2 COLOR=#990099>" ;
 echo  $upfile1 ;
 echo  $sizelimit1 ;
 echo "</FONT>" ;
 echo "&nbsp;&nbsp;&nbsp;<input type=\"button\" value=\"&nbsp;&nbsp;แก้ไข&nbsp;&nbsp;\" onClick=\"javascript:history.go(-1)\" ></CENTER>" ;
exit () ;
}

//ส่วนการปรับปรุงตารางไฟล์
$day_now=date("Y-m-d");
$timestamp = mktime(date("H"), date("i"),date("s"), date("m") ,date("d"), date("Y"))  ;	
//timestamp เวลาปัจจุบัน 
$rand_number=rand();
$ref_id = $timestamp."x".$rand_number;

if ($myfile1<>"" ) {
$myfile1name=$ref_id.".".$lastname1 ; 
copy ($myfile1, "modules/bookregister/upload_files4/".$myfile1name)  ; 
$sql = "update bookregister_certificate set file_name='$myfile1name' where ms_id='$_POST[id]' "; 
$dbquery = mysql_query($sql);
unlink ($myfile1) ;}
} //end if

//ส่วนแสดงผล
if(!(($index==1) or ($index==2) or ($index==5))){

//ส่วนของการแยกหน้า
if($_REQUEST['search_index']==1){
$sql="select * from bookregister_certificate where $_REQUEST[field] like '%$_REQUEST[search]%' ";
}
else{
$sql="select * from bookregister_certificate"; 
}
$dbquery = mysql_query($sql);
$num_rows = mysql_num_rows($dbquery );

$pagelen=20;  // 1_กำหนดแถวต่อหน้า
$url_link="option=bookregister&task=main/certificate&search_index=$_REQUEST[search_index]&field=$_REQUEST[field]&search=$_REQUEST[search]";  // 2_กำหนดลิงค์ฺ
$totalpages=ceil($num_rows/$pagelen);

//
if(!isset($_REQUEST['page'])){
$_REQUEST['page']="";
}
//

if($_REQUEST['page']==""){
$page=$totalpages;
		if($page<2){
		$page=1;
		}
}
else{
		if($totalpages<$_REQUEST['page']){
		$page=$totalpages;
					if($page<1){
					$page=1;
					}
		}
		else{
		$page=$_REQUEST['page'];
		}
}

$start=($page-1)*$pagelen;

if(($totalpages>1) and ($totalpages<16)){
echo "<div align=center>";
echo "หน้า	";
			for($i=1; $i<=$totalpages; $i++)	{
					if($i==$page){
					echo "[<b><font size=+1 color=#990000>$i</font></b>]";
					}
					else {
					echo "<a href=$PHP_SELF?$url_link&page=$i>[$i]</a>";
					}
			}
echo "</div>";
}			
if($totalpages>15){
			if($page <=8){
			$e_page=15;
			$s_page=1;
			}
			if($page>8){
					if($totalpages-$page>=7){
					$e_page=$page+7;
					$s_page=$page-7;
					}
					else{
					$e_page=$totalpages;
					$s_page=$totalpages-15;
					}
			}
			echo "<div align=center>";
			if($page!=1){
			$f_page1=$page-1;
			echo "<<a href=$PHP_SELF?$url_link&page=1>หน้าแรก </a>";
			echo "<<<a href=$PHP_SELF?$url_link&page=$f_page1>หน้าก่อน </a>";
			}
			else {
			echo "หน้า	";
			}					
			for($i=$s_page; $i<=$e_page; $i++){
					if($i==$page){
					echo "[<b><font size=+1 color=#990000>$i</font></b>]";
					}
					else {
					echo "<a href=$PHP_SELF?$url_link&page=$i>[$i]</a>";
					}
			}
			if($page<$totalpages)	{
			$f_page2=$page+1;
			echo "<a href=$PHP_SELF?$url_link&page=$f_page2> หน้าถัดไป</a>>>";
			echo "<a href=$PHP_SELF?$url_link&page=$totalpages> หน้าสุดท้าย</a>>";
			}
			echo " <select onchange=\"location.href=this.options[this.selectedIndex].value;\" size=\"1\" name=\"select\">";
			echo "<option  value=\"\">หน้า</option>";
				for($p=1;$p<=$totalpages;$p++){
				echo "<option  value=\"?$url_link&page=$p\">$p</option>";
				}
			echo "</select>";
echo "</div>";  
}					
//จบแยกหน้า

echo "<table border='0' width='99%' id='table1' style='border-collapse: collapse' cellspacing='2' cellpadding='2' align='center'>
";
echo "<tr><td align='left'>";
echo "<INPUT TYPE='button' name='smb' value='ลงทะเบียนเกียรติบัตร' onclick='location.href=\"?option=bookregister&task=main/certificate&index=1\"'>";
echo "</td>";

?>
	<form method="POST" action="?option=bookregister&task=main/certificate">
<td align="right">
				<p align="right"><font size="2">ค้นหาจาก 
				</font><select size="1" name="field">
				<?php
				if($_REQUEST['field']=='name_cer'){
				echo "<option value='name_cer' selected>ชื่อ</option>";
				}
				else{
				echo "<option value='name_cer'>ชื่อ</option>";
				}
				if($_REQUEST['field']=='subject'){
				echo "<option value='subject' selected>เรื่อง</option>";
				}
				else{
				echo "<option value='subject'>เรื่อง</option>";
				}
				if($_REQUEST['field']=='book_no'){
				echo "<option value='book_no' selected>ที่</option>";
				}
				else{
				echo "<option value='book_no'>ที่</option>";
				}
				echo "</select>";
				
				echo "<font size='2'> ด้วยคำว่า </font>";
				echo "<input type='text' name='search' size='20' value='$_REQUEST[search]'>"; 
				echo "<input type='hidden' name='search_index' value='1'>";
				echo " <input type='submit' value='ค้นหา'>";
				?>
				</p>
			</td></form>
		</tr>
</table>


<table border="1" width="99%" id="table2" style="border-collapse: collapse" align="center">
				<tr bgcolor="#CCCCCC">
					<td align="center" width="50">
					<font size="2" face="Tahoma">เลขทะเบียน</font></td>
					<td align="center" width="50">
					<font size="2" face="Tahoma">ปี</font></td>
					<td align="center" width="70">
					<font face="Tahoma" size="2">ที่เกียรติบัตร</font></td>
					<td align="center" width="140">
					<font face="Tahoma" size="2">ชื่อ</font></td>
					<td align="center">
					<font face="Tahoma" size="2">เรื่อง/รายการ</font></td>
					<td align="center" width="80">
					<font face="Tahoma" size="2">วันที่ออก</font></td>
					<td align="center" width="140">
					<font face="Tahoma" size="2">ผู้ลงนาม</font></td>
					<td align="center" width="10">
					<font face="Tahoma" size="2">การพิมพ์</font></td>
					<td align="center" width="60">
					<font face="Tahoma" size="2">หมายเหตุ</font></td>
					<td align="center" width="120">
					<font face="Tahoma" size="2">ผู้ลงทะเบียน</font></td>
					<td align="center" width="80">
					<font face="Tahoma" size="2">วันลงทะเบียน</font></td>
					<td align="center" width="50">
					<font face="Tahoma" size="2">เอกสาร</font></td>
					<td align="center" width="50">
					<font face="Tahoma" size="2">ตรวจสอบ</font></td>
					<td align="center" width="40">
					<font face="Tahoma" size="2">ลบ</font></td>
					<td align="center" width="40">
					<font face="Tahoma" size="2">แก้ไข</font></td>
					<td align="center" width="40">
					<font face="Tahoma" size="2"><img src="images/b_print.png" border="0"></font></td>
				</tr>

<?php
if($_REQUEST['search_index']==1){
$sql="select *,bookregister_certificate.officer from bookregister_certificate left join person_main on bookregister_certificate.officer=person_main.person_id where  $_REQUEST[field] like '%$_REQUEST[search]%' order by year,register_number  limit $start,$pagelen "; 
}
else{
$sql="select *,bookregister_certificate.officer from bookregister_certificate left join person_main on bookregister_certificate.officer=person_main.person_id order by year,register_number limit $start,$pagelen "; 
}
$dbquery = mysql_query($sql);

$sql_sign = "select  * from bookregister_cer_sign order by id";
$dbquery_sign = mysql_query($sql_sign );
While ($result_sign = mysql_fetch_array($dbquery_sign))
   {
		$code = $result_sign['code'];
		$name = $result_sign['name'];
		$sign_person_ar[$code]=$name;
	}
	$sign_person_ar[""]="";

$N=(($page-1)*$pagelen)+1; //*เกี่ยวข้องกับการแยกหน้า
$M=1;

While ($result = mysql_fetch_array($dbquery)){
		$id = $result['ms_id'];
		$register_number = $result['register_number'];
		$year = $result['year'];
		$book_no = $result['book_no'];
		$signdate = $result['signdate'];
		$subject = $result['subject'];
		$subject2 = $result['subject2'];
		$comment = $result['comment'];
		$register_date = $result['register_date'];
		$sign_person=$result['sign_person'];
		$khet_print=$result['khet_print'];
			if(($M%2) == 0)
			$color="#ffffff";
			else $color="#FFFFC";
$signdate=thai_date_3($signdate);
$register_date=thai_date_3($register_date);

?>
			<tr bgcolor="<?php echo $color;?>">
					<td align="center"><?php echo $register_number;?></td>
					<td align="center"><?php echo $year;?></td>
					<td align="left">&nbsp;<?php echo $book_no;?></td>
					<td align="left">&nbsp;<?php echo $result['name_cer'];?></td>
					<td align="center"><?php echo $subject;?><br /><?php echo $subject2;?></td>
					<td align="center">&nbsp;<?php echo $signdate;?></td>
					<td align="left">&nbsp;<?php echo $sign_person_ar[$sign_person];?></td>
					<td align="center"><?php echo $khet_print;?></td>
					<td align="left"><?php echo $comment;?></td>
					<td align='left'><?php echo $result['prename'].$result['name']." ".$result['surname'];?></td>
					<td align='center'><?php echo $register_date;?></td>
<?php			
					if($result['file_name']!=""){	
					echo "<td align='center'><A HREF='modules/bookregister/upload_files4/$result[file_name]' title='คลิกเพื่อเปิดไฟล์แนบ' target='_BLANK'>เอกสาร</A></td>";
					}
					else{
					echo "<td></td>";
					}
//ตั้งค่าเวลาให้ลบได้					
$now=time();
$timestamp_recdate=make_time_2($result['register_date']);
$timestamp_recdate_2=$timestamp_recdate+(86400*30);  //เพิ่มเวลา 30 วัน
if($now<=$timestamp_recdate_2){
$delete=1;		//yes			
}
else {
$delete=2;    //no
}					

if($result['quarantee']==1){
echo "<td align='center'><img src=images/yes.png border='0' alt='รับรอง'></td>";
}
else if($result['quarantee']==2){
echo "<td align='center'><img src=images/no.png border='0' alt='ไม่รับรอง'></td>";
}
else{
echo "<td align='center'></td>";
}


if(($result['officer'])==$user and ($delete==1)){
echo "<Td align='center'><a href=?option=bookregister&task=main/certificate&index=2&id=$id&page=$_REQUEST[page]><img src=images/drop.png border='0' alt='ลบ'></a></Td>";
}
else{
echo "<td></td>";
}
if(($result['officer'])==$user and ($delete==1)){
echo "<Td align='center'><a href=?option=bookregister&task=main/certificate&index=5&id=$id&page=$_REQUEST[page]><img src=images/edit.png border='0' alt='แก้ไข'></a></Td>";
}
else{
echo "<td></td>";
}
echo "<form id='frm1' name='frm1' action='modules/bookregister/pdf/display.php' method='post' target='_blank'>";
if($sign_person!="" and $khet_print>=1 and $result['quarantee']!=2){
echo "<input type='hidden' name='ms_id' value=$id>";
echo "<input type='hidden' name='cer_host' value=$hostname>";
echo "<input type='hidden' name='cer_user' value=$user2>";
echo "<input type='hidden' name='cer_pass' value=$password>";
echo "<input type='hidden' name='cer_db' value=$dbname>";
echo "<td><INPUT TYPE='submit' value='พิมพ์'></td>";
echo "</form>";
}
else{
echo "<td></td>";
}
echo "</tr>";

	$M++;
	$N++;  //*เกี่ยวข้องกับการแยกหน้า
	}  // end while	
	
echo "<tr><td colspan='15'><b>การพิมพ์</b> 0=ไม่พิมพ์ 1=พิมพ์<td></tr>";	
echo "</table>";
}  //end index

?>
<script>
function goto_url(val){
	if(val==0){
		callfrm("?option=bookregister&task=main/certificate"); 
	}else if(val==1){
	var file1 = document.frm1.myfile1.value;
	
		   if (document.frm1.name_cer.value=="")
           {
          alert("กรุณากรอกชื่อ");
         	document.frm1.subject.focus();    
           }	
		  else if (document.frm1.subject.value=="")
           {
          alert("กรุณากรอกเรื่อง");
         	document.frm1.subject.focus();    
           }	   
        else{
		callfrm("?option=bookregister&task=main/certificate&index=4");   //page ประมวลผล
		}
	}
}

function goto_url2(val){
	if(val==0){
		callfrm("?option=bookregister&task=main/certificate"); 
	}else if(val==1){
	var file1 = document.frm1.myfile1.value;
		   if (document.frm1.name_cer.value=="")
           {
          alert("กรุณากรอกชื่อ");
         	document.frm1.subject.focus();    
           }	
		  else if (document.frm1.subject.value=="")
           {
          alert("กรุณากรอกเรื่อง");
         	document.frm1.subject.focus();    
           }	   
        else{
		callfrm("?option=bookregister&task=main/certificate&index=6");   //page ประมวลผล
		}
	}
}

function goto_display(){
callfrm("href='modules/bookregister/pdf/display.php' target='_blank' ");   //page ประมวลผล
}


</script>
