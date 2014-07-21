<script type="text/javascript" src="./css/js/calendarDateInput2.js"></script> 

<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );

require_once "modules/bookregister/time_inc.php";	
$user=$_SESSION['login_user_id'];

if(!isset($_REQUEST['search_index'])){
$_REQUEST['search_index']="";
}

if(!isset($_REQUEST['search'])){
$_REQUEST['search']="";
}

if(!isset($_REQUEST['field'])){
$_REQUEST['field']='subject';
}

if(!isset($_REQUEST['workgroup'])){
$_REQUEST['workgroup']="";
}

if($_REQUEST['workgroup']!=""){
$_REQUEST['search_index']=1;
}


//ส่วนหัว
echo "<br />";
if(!(($index==1) or ($index==2) or ($index==5))){

echo "<table width='100%' border='0' align='center'>";
echo "<tr align='center'><td><font color='#006666' size='3'><strong>ทะเบียนหนังสือรับ</strong></font></td></tr>";
echo "</table>";
}

//ส่วนฟอร์มรับข้อมูล
if($index==1){

//เช็คการเปิดใช้งานทะเบียน
$sql_start="select * from bookregister_year where year_active='1' and school_code is null ";
$query_start=mysql_query($sql_start);
$result_start=mysql_fetch_array($query_start);
		if(!($result_start)){
		echo "<div align='center'>ยังไม่ได้กำหนดปีปฏิทินการทำงาน กรุณาแจ้งเจ้าหน้าที่ทะเบียน</div>";
		exit();
		}
		
		if($result_start['start_receive_num']==0){
		echo "<div align='center'>ทะเบียนหนังสือรับไม่เปิดใช้งาน</div>";
		exit();
		}

echo "<form Enctype = multipart/form-data id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>ลงทะเบียนหนังสือรับ</Font>";
echo "</Cener>";
echo "<Br>";
echo "<table border='1' width='700' id='table1' style='border-collapse: collapse' bordercolor='#C0C0C0'>";
echo "<tr bgcolor='#9900CC'>";
echo "<td colspan='4' height='23' align='left'><font size='2' color='#FFFFFF'>&nbsp;กรุณาระบุรายละเอียด</font></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right'><span lang='th'><font size='2' color='#0000FF'>เลขที่หนังสือ&nbsp;</font></span></td><td align='left'>&nbsp;<FONT SIZE='2' COLOR=''></FONT><input type='text' name='book_no' size='35' style='background-color: #E7D8EB'>&nbsp;&nbsp;ลงวันที่</td>";
echo "<td colspan='2' align='left'>";
?>
<script>DateInput('signdate', true, 'YYYY-MM-DD')</script>
<?php
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right'><span lang='th'><font size='2' color='#0000FF'>จาก&nbsp;</font></span></td>";
echo "<td colspan='3' align='left'>&nbsp;<input type='text' name='book_from' size='80'  style='background-color: #E7D8EB'></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right'><span lang='th'><font size='2' color='#0000FF'>ถึง&nbsp;</font></span></td>";
echo "<td colspan='3' align='left'>&nbsp;<input type='text' name='book_to' size='80'  style='background-color: #E7D8EB' value='ผู้อำนวยการโรงเรียน'></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right'><span lang='th'><font size='2' color='#0000FF'>เรื่อง&nbsp;</font></span></td>";
echo "<td colspan='3' align='left'>&nbsp;<input type='text' name='subject' size='80'  style='background-color: #E7D8EB'></td>";
echo "</tr>";

echo "<Tr><Td align='right'><span id='group'><font size='2' color='#0000FF'>กลุ่มปฏิบัติ&nbsp;</font></div>&nbsp;&nbsp;</Td>";
echo "<td align='left'>";
echo "<div id='workgroup' align='left'><Select  name='workgroup'  id='workgroup'  size='1' style='background-color: #FFDDFF'>";
echo  "<option  value = ''>เลือก</option>" ;
$sql_workgroup = "select  * from system_workgroup  order by workgroup_order";
$dbquery_workgroup = mysql_query($sql_workgroup);
While ($result_workgroup = mysql_fetch_array($dbquery_workgroup))
   {
		$workgroup = $result_workgroup['workgroup'];
		$workgroup_desc = $result_workgroup['workgroup_desc'];
		echo  "<option value = $workgroup>$workgroup_desc</option>" ;
	}
echo "</select>";
echo "</div>";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right'><span lang='th'><font size='2' color='#0000FF'>บุคคลปฏิบัติ&nbsp;</font></span></td>";
echo "<td colspan='3' align='left'>&nbsp;<input type='text' name='operation' size='50'  style='background-color: #FFDDFF'></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right'><span lang='th'><font size='2' color='#0000FF'>หมายเหตุ&nbsp;</font></span></td>";
echo "<td colspan='3' align='left'>&nbsp;<input type='text' name='comment' size='50'  style='background-color: #FFDDFF'></td>";
echo "</tr>";

echo "<tr>";
echo "<td width='371' align='right' colspan='2'><p align='center'><font size='2' color='#800000'>แนบไฟล์(ถ้ามี)</font></td>";
echo "<td width='238' align='center' colspan='1'><p align='center'><font size='2' color='#800000'>คำอธิบายไฟล์</font></td>";
echo "</tr>";

echo "<tr>";
echo "<td width='94' align='right'><font size='2' color='#0000FF'>ไฟล์แนบ 1&nbsp;</font></td>";
echo "<td width='274'  align='left'>&nbsp;<input type='file' name='myfile1' size='26' style='background-color: #FFDDFF'></td>";
echo "<td width='238'  align='center' colspan='2'><input type='text' name='dfile1' size='31' style='background-color: #BBD1FF'></td>";
echo "</tr>";

echo "<tr>";
echo "<td width='94' align='right'><font size='2' color='#0000FF'>ไฟล์แนบ 2&nbsp;</font></td>";
echo "<td width='274'  align='left'>&nbsp;<input type='file' name='myfile2' size='26' style='background-color: #FFDDFF'> </td>";
echo "<td width='238'  align='center' colspan='2'><input type='text' name='dfile2' size='31' style='background-color: #BBD1FF'></td>";
echo "</tr>";

echo "<tr>";
echo "<td width='94' align='right'><font size='2' color='#0000FF'>ไฟล์แนบ 3&nbsp;</font></td>";
echo "<td width='274'  align='left'>&nbsp;<input type='file' name='myfile3' size='26' style='background-color: #FFDDFF'> </td>";
echo "<td width='238'  align='center' colspan='2'><input type='text' name='dfile3' size='31' style='background-color: #BBD1FF'></td>";
echo "</tr>";

echo "<tr>";
echo "<td width='94' align='right'><font size='2' color='#0000FF'>ไฟล์แนบ 4&nbsp;</font></td>";
echo "<td width='274'  align='left'>&nbsp;<input type='file' name='myfile4' size='26' style='background-color: #FFDDFF'> </td>";
echo "<td width='238' align='center' colspan='2'><input type='text' name='dfile4' size='31' style='background-color: #BBD1FF'></td>";
echo "</tr>";

echo "<tr>";
echo "<td width='94' align='right'><font size='2' color='#0000FF'>ไฟล์แนบ 5&nbsp;</font></td>";
echo "<td width='274'  align='left'>&nbsp;<input type='file' name='myfile5' size='26' style='background-color: #FFDDFF'> </td>";
echo "<td width='238' align='center' colspan='2'><input type='text' name='dfile5' size='31' style='background-color: #BBD1FF'></td>";
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
echo "<INPUT TYPE='button' name='smb' value='ยืนยัน' onclick='location.href=\"?option=bookregister&task=main/receive&index=3&id=$_GET[id]&page=$_REQUEST[page]\"'>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ยกเลิก' onclick='location.href=\"?option=bookregister&task=main/receive&page=$_REQUEST[page]\"'";
echo "</td></tr></table>";
}

//ส่วนลบข้อมูล
if($index==3){
	$sql="select * from bookregister_receive  where ms_id='$_GET[id]'";
	$dbquery = mysql_query($sql);
	$ref_result = mysql_fetch_array($dbquery);
	$ref_id=$ref_result['ref_id'];

$sql = "delete from bookregister_receive_filebook where ref_id='$ref_id'";
$dbquery = mysql_query($sql);

$sql = "delete from bookregister_receive where ms_id='$_GET[id]'";
$dbquery = mysql_query($sql);
}

//ส่วนบันทึกข้อมูล
if($index==4){
$sizelimit = 20000*1024 ;  //ขนาดไฟล์

$upfile1=""; $upfile2=""; $upfile3=""; $upfile4=""; $upfile5=""; 
$sizelimit1=""; $sizelimit2=""; $sizelimit3=""; $sizelimit4=""; $sizelimit5=""; 

$detail="";
$dfile1 = "";
$dfile2 = "";
$dfile3 = "";
$dfile4 = "";
$dfile5 = "";

if(isset($_POST ['detail'])){
$detail = $_POST ['detail'] ;
}
if(isset($_POST ['dfile1'])){
$dfile1 = $_POST ['dfile1'] ;
}
if(isset($_POST ['dfile2'])){
$dfile2 = $_POST ['dfile2'] ;
}
if(isset($_POST ['dfile3'])){
$dfile3 = $_POST ['dfile3'] ;
}
if(isset($_POST ['dfile4'])){
$dfile4 = $_POST ['dfile4'] ;
}
if(isset($_POST ['dfile5'])){
$dfile5 = $_POST ['dfile5'] ;
}

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

$myfile2 = $_FILES ['myfile2'] ['tmp_name'] ;
$myfile2_name = $_FILES ['myfile2'] ['name'] ;
$myfile2_size = $_FILES ['myfile2'] ['size'] ;
$myfile2_type = $_FILES ['myfile2'] ['type'] ;

$array_last2 = explode("." ,$myfile2_name) ;
 $c2 =count ($array_last2) - 1 ;
 $lastname2 = strtolower ($array_last2 [$c2] ) ;

  if  ($myfile2<>"") {
 if ($lastname2 =="doc" or $lastname2 =="docx" or $lastname2 =="rar" or $lastname2 =="pdf" or $lastname2 =="xls" or $lastname2 =="xlsx" or $lastname2 =="zip" or $lastname2 =="jpg" or $lastname2 =="gif") { 
	 $upfile2 = "" ; 
  }else {
	 $upfile2 = "-ไม่อนุญาตให้ทำการแนบไฟล์ $myfile2_name<BR> " ;
  } 

  If ($myfile2_size>$sizelimit) {
	  $sizelimit2 = "-ไฟล์ $myfile2_name มีขนาดใหญ่กว่าที่กำหนด<BR>" ;
  }else {
		$sizelimit2 = "" ;
  }
  }
  ####
$myfile3 = $_FILES ['myfile3'] ['tmp_name'] ;
$myfile3_name = $_FILES ['myfile3'] ['name'] ;
$myfile3_size = $_FILES ['myfile3'] ['size'] ;
$myfile3_type = $_FILES ['myfile3'] ['type'] ;
$array_last3 = explode("." ,$myfile3_name) ;
 $c3 =count ($array_last3) - 1 ;
 $lastname3 = strtolower ($array_last3 [$c3] ) ;

  if  ($myfile3<>"") {
 if ($lastname3 =="doc" or $lastname3 =="docx" or $lastname3 =="rar" or $lastname3 =="pdf" or $lastname3 =="xls" or $lastname3 =="xlsx" or $lastname3 =="zip" or $lastname3 =="jpg" or $lastname3 =="gif") { 
	 $upfile3 = "" ; 
  }else {
	 $upfile3 = "-ไม่อนุญาตให้ทำการแนบไฟล์ $myfile3_name <BR>" ;
  } 

  If ($myfile3_size>$sizelimit) {
	  $sizelimit3 = "-ไฟล์ $myfile3_name มีขนาดใหญ่กว่าที่กำหนด<BR>" ;
  }else {
		$sizelimit3 = "" ;
  }
  }
  ####
$myfile4 = $_FILES ['myfile4'] ['tmp_name'] ;
$myfile4_name = $_FILES ['myfile4'] ['name'] ;
$myfile4_size = $_FILES ['myfile4'] ['size'] ;
$myfile4_type = $_FILES ['myfile4'] ['type'] ;
$array_last4 = explode("." ,$myfile4_name) ;
 $c4 =count ($array_last4) - 1 ;
 $lastname4 = strtolower ($array_last4 [$c4] ) ;

  if  ($myfile4<>"") {
 if ($lastname4 =="doc" or $lastname4 =="docx" or $lastname4 =="rar" or $lastname4 =="pdf" or $lastname4 =="xls" or $lastname4 =="xlsx" or $lastname4 =="zip" or $lastname4 =="jpg" or $lastname4 =="gif") { 
	 $upfile4 = "" ; 
  }else {
	 $upfile4 = "-ไม่อนุญาตให้ทำการแนบไฟล์ $myfile4_name<BR> " ;
  } 

  If ($myfile4_size>$sizelimit) {
	  $sizelimit4 = "-ไฟล์ $myfile4_name มีขนาดใหญ่กว่าที่กำหนด<BR>" ;
  }else {
		$sizelimit4 = "" ;
  }
  }
  ####
$myfile5 = $_FILES ['myfile5'] ['tmp_name'] ;
$myfile5_name = $_FILES ['myfile5'] ['name'] ;
$myfile5_size = $_FILES ['myfile5'] ['size'] ;
$myfile5_type = $_FILES ['myfile5'] ['type'] ;
$array_last5 = explode("." ,$myfile5_name) ;
 $c5 =count ($array_last5) - 1 ;
 $lastname5 = strtolower ($array_last5 [$c5] ) ;

  if  ($myfile5<>"") {
 if ($lastname5 =="doc" or $lastname5 =="docx" or $lastname5 =="rar" or $lastname5 =="pdf" or $lastname5 =="xls" or $lastname5 =="xlsx" or $lastname5 =="zip" or $lastname5 =="jpg" or $lastname5 =="gif") { 
	 $upfile5 = "" ; 
  }else {
	 $upfile5 = "-ไม่อนุญาตให้ทำการแนบไฟล์ $myfile5_name<BR> " ;
  } 

  If ($myfile5_size>$sizelimit) {
	  $sizelimit5 = "-ไฟล์ $myfile5_name มีขนาดใหญ่กว่าที่กำหนด<BR>" ;
  }else {
		$sizelimit5 = "" ;
  }
  }
  ####
////

if($_POST['book_no']=="" || $_POST['signdate']=="" ||$_POST['book_from'] =="" ||$_POST['book_to'] =="" ||$_POST['subject'] ==""){
	echo "<CENTER><font size=\"2\" color=\"#008000\">กรุณากรอกข้อมูลให้ครบ<br><br>";
	echo "<input type=\"button\" value=\"แก้ไขข้อมูล\" onClick=\"javascript:history.go(-1)\" ></CENTER>" ;
	exit(); 
} #จบ


// check file size  file name
if ($upfile1<> "" || $sizelimit1<> "" ||  $upfile2<> "" || $sizelimit2<> "" || $upfile3<> "" || $sizelimit3<> "" || $upfile4<> "" || $sizelimit4<> "" || $upfile5<> "" || $sizelimit5<> "") {

echo "<B><FONT SIZE=2 COLOR=#990000>มีข้อผิดพลาดเกี่ยวกับไฟล์ของคุณ ดังรายละเอียด</FONT></B><BR>" ;
echo "<FONT SIZE=2 COLOR=#990099>" ;
 echo  $upfile1 ;
 echo  $sizelimit1 ;
 echo  $upfile2 ;
 echo  $sizelimit2 ;
 echo  $upfile3 ;
 echo  $sizelimit3 ;
 echo  $upfile4 ;
 echo  $sizelimit4 ;
 echo  $upfile5 ;
 echo  $sizelimit5 ;
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

$sql_number="select  max(register_number) as number_max from bookregister_receive where year='$result_start[year]' ";
$query_number=mysql_query($sql_number);
$result_number=mysql_fetch_array($query_number);

if($result_number['number_max']<$result_start['start_receive_num']){
$register_number=$result_start['start_receive_num'];
}
else{
$register_number=$result_number['number_max']+1;
}

$sql = "insert into bookregister_receive(year, register_number, book_no, signdate, book_from, book_to, subject, workgroup, record_type, operation, comment, register_date, ref_id, officer) values ('$result_start[year]', '$register_number', '$_POST[book_no]', '$_POST[signdate]', '$_POST[book_from]', '$_POST[book_to]', '$_POST[subject]', '$_POST[workgroup]', '1','$_POST[operation]', '$_POST[comment]', '$day_now', '$ref_id', '$user')";
$dbquery = mysql_query($sql);

if ($myfile1<>"" ) {
$myfile1name=$ref_id."_1.".$lastname1 ; 
copy ($myfile1, "modules/bookregister/upload_files1/".$myfile1name)  ; 

$sql = "insert into bookregister_receive_filebook(ref_id, file_name, file_des) values ('$ref_id','$myfile1name','$dfile1')";
$dbquery = mysql_query($sql);

unlink ($myfile1) ;
}

if ($myfile2<>"") {
$myfile2name=$ref_id."_2.".$lastname2 ; 
copy ($myfile2, "modules/bookregister/upload_files1/".$myfile2name)  ; 
$sql = "insert into bookregister_receive_filebook(ref_id, file_name, file_des) values ('$ref_id','$myfile2name','$dfile2')";
$dbquery = mysql_query($sql);
unlink ($myfile2) ;
}

if ($myfile3<>"") {
$myfile3name=$ref_id."_3.".$lastname3 ; 
copy ($myfile3, "modules/bookregister/upload_files1/".$myfile3name)  ; 
$sql = "insert into bookregister_receive_filebook(ref_id, file_name, file_des) values ('$ref_id','$myfile3name','$dfile3')";
$dbquery = mysql_query($sql);
unlink ($myfile3) ;
}

if ($myfile4<>"") {
$myfile4name=$ref_id."_4.".$lastname4 ; 
copy ($myfile4, "modules/bookregister/upload_files1/".$myfile4name)  ; 
$sql = "insert into bookregister_receive_filebook(ref_id, file_name, file_des) values ('$ref_id','$myfile4name','$dfile4')";
$dbquery = mysql_query($sql);
unlink ($myfile4) ;
}

if ($myfile5<>"") {
$myfile5name=$ref_id."_5.".$lastname5 ; 
copy ($myfile5, "modules/bookregister/upload_files1/".$myfile5name)  ; 
$sql = "insert into bookregister_receive_filebook(ref_id, file_name, file_des) values ('$ref_id','$myfile5name','$dfile5')";
$dbquery = mysql_query($sql);
unlink ($myfile5) ;
}
	
} //end index4

if($index==5){
echo "<form Enctype = multipart/form-data id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>แก้ไขข้อมูล</B></Font>";
echo "</Cener>";
echo "<Br><Br>";
$sql = "select * from  bookregister_receive where ms_id='$_GET[id]'";
$dbquery = mysql_query($sql);
$result_ref = mysql_fetch_array($dbquery);

$file_number[1]="";
$file_number[2]="";
$file_number[3]="";
$file_number[4]="";
$file_number[5]="";

$sql = "select * from  bookregister_receive_filebook where  ref_id='$result_ref[ref_id]' order by id";
$dbquery = mysql_query($sql);
while($result_file = mysql_fetch_array($dbquery)){
$file=$result_file['file_name'];
$file1=explode("_", $file);
$file2=explode(".", $file1[1]);
$file3=$file2[0];
		if($file3==1){
		$file_number[1]=$result_file['file_des'];
		}
		else if($file3==2){
		$file_number[2]=$result_file['file_des'];
		}
		else if($file3==3){
		$file_number[3]=$result_file['file_des'];
		}
		else if($file3==4){
		$file_number[4]=$result_file['file_des'];
		}
		else if($file3==5){
		$file_number[5]=$result_file['file_des'];
		}
}

echo "<table border='1' width='700' id='table1' style='border-collapse: collapse' bordercolor='#C0C0C0'>";
echo "<tr bgcolor='#9900CC'>";
echo "<td colspan='4' height='23' align='left'><font size='2' color='#FFFFFF'>&nbsp;รายละเอียด</font></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right'><span lang='th'><font size='2' color='#0000FF'>เลขทะเบียน&nbsp;</font></span></td>";
echo "<td colspan='3' align='left'>&nbsp;$result_ref[register_number]</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right'><span lang='th'><font size='2' color='#0000FF'>เลขที่หนังสือ&nbsp;</font></span></td><td align='left'>&nbsp;<FONT SIZE='2' COLOR=''></FONT><input type='text' name='book_no' size='35' value='$result_ref[book_no]'  style='background-color: #E7D8EB'>&nbsp;&nbsp;ลงวันที่</td>";
echo "<td colspan='2' align='left'>";

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

echo "<tr>";
echo "<td align='right'><span lang='th'><font size='2' color='#0000FF'>จาก&nbsp;</font></span></td>";
echo "<td colspan='3' align='left'>&nbsp;<input type='text' name='book_from' size='80'  style='background-color: #E7D8EB'  value='$result_ref[book_from]'></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right'><span lang='th'><font size='2' color='#0000FF'>ถึง&nbsp;</font></span></td>";
echo "<td colspan='3' align='left'>&nbsp;<input type='text' name='book_to' size='80'  style='background-color: #E7D8EB' value='$result_ref[book_to]'></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right'><span lang='th'><font size='2' color='#0000FF'>เรื่อง&nbsp;</font></span></td>";
echo "<td colspan='3' align='left'>&nbsp;<input type='text' name='subject' size='80'  style='background-color: #E7D8EB' value='$result_ref[subject]'></td>";
echo "</tr>";

echo "<Tr><Td align='right'><span id='group'><font size='2' color='#0000FF'>กลุ่มปฏิบัติ&nbsp;</font></div>&nbsp;&nbsp;</Td>";
echo "<td align='left'>";
echo "<div id='workgroup' align='left'><Select  name='group'  id='group'  size='1' style='background-color: #FFDDFF'>";
echo  "<option  value = ''>เลือก</option>" ;
$sql_workgroup = "select  * from system_workgroup  order by workgroup_order";
$dbquery_workgroup = mysql_query($sql_workgroup);
While ($result_workgroup = mysql_fetch_array($dbquery_workgroup))
   {
		$workgroup = $result_workgroup['workgroup'];
		$workgroup_desc = $result_workgroup['workgroup_desc'];
		if($result_ref['workgroup']==$workgroup){ 
		echo  "<option value = $workgroup selected>$workgroup_desc</option>" ;
		}
		else{
		echo  "<option value = $workgroup>$workgroup_desc</option>" ;
		}
	}
echo "</select>";
echo "</div>";
echo "</td></tr>";

echo "<tr>";
echo "<td align='right'><span lang='th'><font size='2' color='#0000FF'>บุคคลปฏิบัติ&nbsp;</font></span></td>";
echo "<td colspan='3' align='left'>&nbsp;<input type='text' name='operation' size='50'  style='background-color: #FFDDFF' value='$result_ref[operation]'></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right'><span lang='th'><font size='2' color='#0000FF'>หมายเหตุ&nbsp;</font></span></td>";
echo "<td colspan='3' align='left'>&nbsp;<input type='text' name='comment' size='50'  style='background-color: #FFDDFF' value='$result_ref[comment]'></td>";
echo "</tr>";

echo "<tr>";
echo "<td width='371' align='right' colspan='2'><p align='center'><font size='2' color='#800000'>แนบไฟล์(ถ้ามี)</font></td>";
echo "<td width='238' align='center' colspan='1'><p align='center'><font size='2' color='#800000'>คำอธิบายไฟล์</font></td>";
echo "</tr>";

if($result_ref['book_link']==1 or $result_ref['book_link']==2){
$dis_able="disabled";
}
else{
$dis_able="";
}

echo "<tr>";
echo "<td width='94' align='right'><font size='2' color='#0000FF'>ไฟล์แนบ 1&nbsp;</font></td>";
echo "<td width='274'  align='left'>&nbsp;<input type='file' name='myfile1' size='26' style='background-color: #FFDDFF' $dis_able></td>";
echo "<td width='238' align='center' colspan='2'><input type='text' name='dfile1' size='31' style='background-color: #BBD1FF' value='$file_number[1]' $dis_able></td>";
echo "</tr>";

echo "<tr>";
echo "<td width='94' align='right'><font size='2' color='#0000FF'>ไฟล์แนบ 2&nbsp;</font></td>";
echo "<td width='274' align='left'>&nbsp;<input type='file' name='myfile2' size='26' style='background-color: #FFDDFF' $dis_able> </td>";
echo "<td width='238' align='center' colspan='2'><input type='text' name='dfile2' size='31' style='background-color: #BBD1FF' value='$file_number[2]' $dis_able></td>";
echo "</tr>";

echo "<tr>";
echo "<td width='94' align='right'><font size='2' color='#0000FF'>ไฟล์แนบ 3&nbsp;</font></td>";
echo "<td width='274' align='left'>&nbsp;<input type='file' name='myfile3' size='26' style='background-color: #FFDDFF' $dis_able> </td>";
echo "<td width='238' align='center' colspan='2'><input type='text' name='dfile3' size='31' style='background-color: #BBD1FF' value='$file_number[3]' $dis_able></td>";
echo "</tr>";

echo "<tr>";
echo "<td width='94' align='right'><font size='2' color='#0000FF'>ไฟล์แนบ 4&nbsp;</font></td>";
echo "<td width='274' align='left'>&nbsp;<input type='file' name='myfile4' size='26' style='background-color: #FFDDFF' $dis_able> </td>";
echo "<td width='238' align='center' colspan='2'><input type='text' name='dfile4' size='31' style='background-color: #BBD1FF' value='$file_number[4]' $dis_able></td>";
echo "</tr>";

echo "<tr>";
echo "<td width='94' align='right'><font size='2' color='#0000FF'>ไฟล์แนบ 5&nbsp;</font></td>";
echo "<td width='274' align='left'>&nbsp;<input type='file' name='myfile5' size='26' style='background-color: #FFDDFF' $dis_able> </td>";
echo "<td width='238' align='center' colspan='2'><input type='text' name='dfile5' size='31' style='background-color: #BBD1FF' value='$file_number[5]' $dis_able></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='center' colspan='4'><FONT SIZE='2' COLOR='#CC9900'>เฉพาะไฟล์ doc, docx, pdf, xls, xlsx, gif, jpg, zip, rar เท่านั้น</FONT></td>";
echo "</tr>";
echo "<Input Type=Hidden Name='ref_id' Value='$result_ref[ref_id]'>";
echo "<Input Type=Hidden Name='id' Value='$_GET[id]'>";
echo "<Input Type=Hidden Name='page' Value='$_GET[page]'>";
echo "<Input Type=Hidden Name='workgroup' Value='$_REQUEST[workgroup]'>";
echo "<tr>";
echo "<td align='center' colspan='4'><BR><INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url2(1)' class=entrybutton>&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ย้อนกลับ' onclick='goto_url2(0)'</td>";
echo "</tr>";
echo "</Table>";
echo "</form>";
}

if($index==6){

$detail="";
$dfile1 = "";
$dfile2 = "";
$dfile3 = "";
$dfile4 = "";
$dfile5 = "";

$upfile1=""; $upfile2=""; $upfile3=""; $upfile4=""; $upfile5=""; 
$sizelimit1=""; $sizelimit2=""; $sizelimit3=""; $sizelimit4=""; $sizelimit5=""; 

$sql = "update bookregister_receive set book_no='$_POST[book_no]', signdate='$_POST[signdate]', book_from='$_POST[book_from]', book_to='$_POST[book_to]', subject='$_POST[subject]', workgroup='$_POST[group]', operation='$_POST[operation]', comment='$_POST[comment]' where ms_id='$_POST[id]' ";
$dbquery = mysql_query($sql);

$sizelimit = 20000*1024 ;  //ขนาดไฟล์

if(isset($_POST ['detail'])){
$detail = $_POST ['detail'] ;
}
if(isset($_POST ['dfile1'])){
$dfile1 = $_POST ['dfile1'] ;
}
if(isset($_POST ['dfile2'])){
$dfile2 = $_POST ['dfile2'] ;
}
if(isset($_POST ['dfile3'])){
$dfile3 = $_POST ['dfile3'] ;
}
if(isset($_POST ['dfile4'])){
$dfile4 = $_POST ['dfile4'] ;
}
if(isset($_POST ['dfile5'])){
$dfile5 = $_POST ['dfile5'] ;
}

$myfile1=""; $myfile2=""; $myfile3=""; $myfile4=""; $myfile5=""; 
/// file
//isset
if(isset($_FILES ['myfile1'])){
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
 }  //isset
  ####
//isset
if(isset($_FILES ['myfile2'])){
$myfile2 = $_FILES ['myfile2'] ['tmp_name'] ;
$myfile2_name = $_FILES ['myfile2'] ['name'] ;
$myfile2_size = $_FILES ['myfile2'] ['size'] ;
$myfile2_type = $_FILES ['myfile2'] ['type'] ;

$array_last2 = explode("." ,$myfile2_name) ;
 $c2 =count ($array_last2) - 1 ;
 $lastname2 = strtolower ($array_last2 [$c2] ) ;

  if  ($myfile2<>"") {
 if ($lastname2 =="doc" or $lastname2 =="docx" or $lastname2 =="rar" or $lastname2 =="pdf" or $lastname2 =="xls" or $lastname2 =="xlsx" or $lastname2 =="zip" or $lastname2 =="jpg" or $lastname2 =="gif") { 
	 $upfile2 = "" ; 
  }else {
	 $upfile2 = "-ไม่อนุญาตให้ทำการแนบไฟล์ $myfile2_name<BR> " ;
  } 

  If ($myfile2_size>$sizelimit) {
	  $sizelimit2 = "-ไฟล์ $myfile2_name มีขนาดใหญ่กว่าที่กำหนด<BR>" ;
  }else {
		$sizelimit2 = "" ;
  }
  }
 }  //isset
  ####
//isset
if(isset($_FILES ['myfile3'])){
$myfile3 = $_FILES ['myfile3'] ['tmp_name'] ;
$myfile3_name = $_FILES ['myfile3'] ['name'] ;
$myfile3_size = $_FILES ['myfile3'] ['size'] ;
$myfile3_type = $_FILES ['myfile3'] ['type'] ;
$array_last3 = explode("." ,$myfile3_name) ;
 $c3 =count ($array_last3) - 1 ;
 $lastname3 = strtolower ($array_last3 [$c3] ) ;

  if  ($myfile3<>"") {
 if ($lastname3 =="doc" or $lastname3 =="docx" or $lastname3 =="rar" or $lastname3 =="pdf" or $lastname3 =="xls" or $lastname3 =="xlsx" or $lastname3 =="zip" or $lastname3 =="jpg" or $lastname3 =="gif") { 
	 $upfile3 = "" ; 
  }else {
	 $upfile3 = "-ไม่อนุญาตให้ทำการแนบไฟล์ $myfile3_name <BR>" ;
  } 

  If ($myfile3_size>$sizelimit) {
	  $sizelimit3 = "-ไฟล์ $myfile3_name มีขนาดใหญ่กว่าที่กำหนด<BR>" ;
  }else {
		$sizelimit3 = "" ;
  }
  }
 }  //isset
  ####
//isset
if(isset($_FILES ['myfile4'])){
$myfile4 = $_FILES ['myfile4'] ['tmp_name'] ;
$myfile4_name = $_FILES ['myfile4'] ['name'] ;
$myfile4_size = $_FILES ['myfile4'] ['size'] ;
$myfile4_type = $_FILES ['myfile4'] ['type'] ;
$array_last4 = explode("." ,$myfile4_name) ;
 $c4 =count ($array_last4) - 1 ;
 $lastname4 = strtolower ($array_last4 [$c4] ) ;

  if  ($myfile4<>"") {
 if ($lastname4 =="doc" or $lastname4 =="docx" or $lastname4 =="rar" or $lastname4 =="pdf" or $lastname4 =="xls" or $lastname4 =="xlsx" or $lastname4 =="zip" or $lastname4 =="jpg" or $lastname4 =="gif") { 
	 $upfile4 = "" ; 
  }else {
	 $upfile4 = "-ไม่อนุญาตให้ทำการแนบไฟล์ $myfile4_name<BR> " ;
  } 

  If ($myfile4_size>$sizelimit) {
	  $sizelimit4 = "-ไฟล์ $myfile4_name มีขนาดใหญ่กว่าที่กำหนด<BR>" ;
  }else {
		$sizelimit4 = "" ;
  }
  }
 }  //isset
  ####
//isset
if(isset($_FILES ['myfile4'])){
$myfile5 = $_FILES ['myfile5'] ['tmp_name'] ;
$myfile5_name = $_FILES ['myfile5'] ['name'] ;
$myfile5_size = $_FILES ['myfile5'] ['size'] ;
$myfile5_type = $_FILES ['myfile5'] ['type'] ;
$array_last5 = explode("." ,$myfile5_name) ;
 $c5 =count ($array_last5) - 1 ;
 $lastname5 = strtolower ($array_last5 [$c5] ) ;

  if  ($myfile5<>"") {
 if ($lastname5 =="doc" or $lastname5 =="docx" or $lastname5 =="rar" or $lastname5 =="pdf" or $lastname5 =="xls" or $lastname5 =="xlsx" or $lastname5 =="zip" or $lastname5 =="jpg" or $lastname5 =="gif") { 
	 $upfile5 = "" ; 
  }else {
	 $upfile5 = "-ไม่อนุญาตให้ทำการแนบไฟล์ $myfile5_name<BR> " ;
  } 

  If ($myfile5_size>$sizelimit) {
	  $sizelimit5 = "-ไฟล์ $myfile5_name มีขนาดใหญ่กว่าที่กำหนด<BR>" ;
  }else {
		$sizelimit5 = "" ;
  }
  }
 }  //isset
  ####
////

if($_POST['book_no']=="" || $_POST['signdate']=="" ||$_POST['book_from'] =="" ||$_POST['book_to'] =="" ||$_POST['subject'] ==""){
	echo "<CENTER><font size=\"2\" color=\"#008000\">กรุณากรอกข้อมูลให้ครบ<br><br>";
	echo "<input type=\"button\" value=\"แก้ไขข้อมูล\" onClick=\"javascript:history.go(-1)\" ></CENTER>" ;
	exit(); 
} #จบ


// check file size  file name
if ($upfile1<> "" || $sizelimit1<> "" ||  $upfile2<> "" || $sizelimit2<> "" || $upfile3<> "" || $sizelimit3<> "" || $upfile4<> "" || $sizelimit4<> "" || $upfile5<> "" || $sizelimit5<> "") {

echo "<B><FONT SIZE=2 COLOR=#990000>มีข้อผิดพลาดเกี่ยวกับไฟล์ของคุณ ดังรายละเอียด</FONT></B><BR>" ;
echo "<FONT SIZE=2 COLOR=#990099>" ;
 echo  $upfile1 ;
 echo  $sizelimit1 ;
 echo  $upfile2 ;
 echo  $sizelimit2 ;
 echo  $upfile3 ;
 echo  $sizelimit3 ;
 echo  $upfile4 ;
 echo  $sizelimit4 ;
 echo  $upfile5 ;
 echo  $sizelimit5 ;
 echo "</FONT>" ;
 echo "&nbsp;&nbsp;&nbsp;<input type=\"button\" value=\"&nbsp;&nbsp;แก้ไข&nbsp;&nbsp;\" onClick=\"javascript:history.go(-1)\" ></CENTER>" ;
exit () ;
}

//ส่วนการปรับปรุงตารางไฟล์

$file_exit[1]="" ;  $file_exit[2]="" ;  $file_exit[3]="" ;  $file_exit[4]="" ;  $file_exit[5]="" ; 

$sql = "select * from  bookregister_receive_filebook where  ref_id='$_POST[ref_id]' order by id";
$dbquery = mysql_query($sql);
while($result_file = mysql_fetch_array($dbquery)){
$file=$result_file['file_name'];
$file1=explode("_", $file);
$file2=explode(".", $file1[1]);
$file3=$file2[0];
		if($file3==1){
		$file_exit[1]=1;
		$file_id[1]=$file=$result_file['id'];
		}
		else if($file3==2){
		$file_exit[2]=1;
		$file_id[2]=$file=$result_file['id'];
		}
		else if($file3==3){
		$file_exit[3]=1;
		$file_id[3]=$file=$result_file['id'];
		}
		else if($file3==4){
		$file_exit[4]=1;
		$file_id[4]=$file=$result_file['id'];
		}
		else if($file3==5){
		$file_exit[5]=1;
		$file_id[5]=$file=$result_file['id'];
		}
}

if ($myfile1<>"" ) {
$myfile1name=$_POST['ref_id']."_1.".$lastname1 ; 
$path_file="modules/bookregister/upload_files1/".$myfile1name;
	if(file_exists($path_file)){
	unlink($path_file);	
	}
		if($file_exit[1]==1){
		copy ($myfile1, "modules/bookregister/upload_files1/".$myfile1name) ; 
		$sql = "update bookregister_receive_filebook set file_name='$myfile1name', file_des='$dfile1' where id='$file_id[1]' "; 
		}
		else{
		copy ($myfile1, "modules/bookregister/upload_files1/".$myfile1name) ; 
		$sql = "insert into bookregister_receive_filebook(ref_id, file_name, file_des) values ('$_POST[ref_id]','$myfile1name','$dfile1')";
		}
$dbquery = mysql_query($sql);
unlink ($myfile1) ;
}

if ($myfile2<>"") {
$myfile2name=$_POST['ref_id']."_2.".$lastname2 ; 
$path_file="modules/bookregister/upload_files1/".$myfile2name;
	if(file_exists($path_file)){
	unlink($path_file);	
	}
		if($file_exit[2]==1){
		copy ($myfile2, "modules/bookregister/upload_files1/".$myfile2name) ; 
		$sql = "update bookregister_receive_filebook set file_name='$myfile2name', file_des='$dfile2' where id='$file_id[2]' "; 
		}
		else{
		copy ($myfile2, "modules/bookregister/upload_files1/".$myfile2name) ; 
		$sql = "insert into bookregister_receive_filebook(ref_id, file_name, file_des) values ('$_POST[ref_id]','$myfile2name','$dfile2')";
		}
$dbquery = mysql_query($sql);
unlink ($myfile2) ;
}

if ($myfile3<>"") {
$myfile3name=$_POST['ref_id']."_3.".$lastname3 ; 
$path_file="modules/bookregister/upload_files1/".$myfile3name;
	if(file_exists($path_file)){
	unlink($path_file);	
	}
		if($file_exit[3]==1){
		copy ($myfile3, "modules/bookregister/upload_files1/".$myfile3name) ; 
		$sql = "update bookregister_receive_filebook set file_name='$myfile3name', file_des='$dfile3' where id='$file_id[3]' "; 
		}
		else{
		copy ($myfile3, "modules/bookregister/upload_files1/".$myfile3name) ; 
		$sql = "insert into bookregister_receive_filebook(ref_id, file_name, file_des) values ('$_POST[ref_id]','$myfile3name','$dfile3')";
		}
$dbquery = mysql_query($sql);
unlink ($myfile3) ;
}

if ($myfile4<>"") {
$myfile4name=$_POST['ref_id']."_4.".$lastname4 ; 
$path_file="modules/bookregister/upload_files1/".$myfile4name;
	if(file_exists($path_file)){
	unlink($path_file);	
	}
		if($file_exit[4]==1){
		copy ($myfile4, "modules/bookregister/upload_files1/".$myfile4name) ; 
		$sql = "update bookregister_receive_filebook set file_name='$myfile4name', file_des='$dfile4' where id='$file_id[4]' "; 
		}
		else{
		copy ($myfile4, "modules/bookregister/upload_files1/".$myfile4name) ; 
		$sql = "insert into bookregister_receive_filebook(ref_id, file_name, file_des) values ('$_POST[ref_id]','$myfile4name','$dfile4')";
		}
$dbquery = mysql_query($sql);
unlink ($myfile4) ;
}

if ($myfile5<>"") {
$myfile5name=$_POST['ref_id']."_5.".$lastname5 ; 
$path_file="modules/bookregister/upload_files1/".$myfile5name;
	if(file_exists($path_file)){
	unlink($path_file);	
	}
		if($file_exit[5]==1){
		copy ($myfile5, "modules/bookregister/upload_files1/".$myfile5name) ; 
		$sql = "update bookregister_receive_filebook set file_name='$myfile5name', file_des='$dfile5' where id='$file_id[5]' "; 
		}
		else{
		copy ($myfile5, "modules/bookregister/upload_files1/".$myfile5name) ; 
		$sql = "insert into bookregister_receive_filebook(ref_id, file_name, file_des) values ('$_POST[ref_id]','$myfile5name','$dfile5')";
		}
$dbquery = mysql_query($sql);
unlink ($myfile5) ;
}
} //end if

//ส่วนแสดงผล
if(!(($index==1) or ($index==2) or ($index==5))){

//อาเรย์กลุ่ม
$sql_workgroup = "select  * from system_workgroup  order by workgroup_order";
$dbquery_workgroup = mysql_query($sql_workgroup);
While ($result_workgroup = mysql_fetch_array($dbquery_workgroup))
   {
		$workgroup = $result_workgroup['workgroup'];
		$workgroup_desc = $result_workgroup['workgroup_desc'];
		$workgroup_ar[$workgroup]=$workgroup_desc;
	}

//ส่วนของการแยกหน้า
if($_REQUEST['search_index']==1){
		if($_REQUEST['workgroup']!=""){
		$sql="select * from bookregister_receive where $_REQUEST[field] like '%$_REQUEST[search]%' and workgroup='$_REQUEST[workgroup]' ";
		}
		else{
		$sql="select * from bookregister_receive where $_REQUEST[field] like '%$_REQUEST[search]%' ";
		}
}
else{
$sql="select * from bookregister_receive"; 
}
$dbquery = mysql_query($sql);
$num_rows = mysql_num_rows($dbquery );

$pagelen=15;  // 1_กำหนดแถวต่อหน้า
$url_link="option=bookregister&task=main/receive&search_index=$_REQUEST[search_index]&field=$_REQUEST[field]&search=$_REQUEST[search]&workgroup=$_REQUEST[workgroup]";  // 2_กำหนดลิงค์ฺ
$totalpages=ceil($num_rows/$pagelen);
//
if(!isset($_REQUEST['page'])){
$_REQUEST['page']="";
}
//

if(!(isset($_REQUEST['page']))){
$_REQUEST['page']=="";
}

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
echo "<INPUT TYPE='button' name='smb' value='ลงทะเบียนหนังสือ' onclick='location.href=\"?option=bookregister&task=main/receive&index=1\"'>";
echo "</td>";

?>
	<form name="frm1" method="POST" action="?option=bookregister&task=main/receive">
<td align="center">
				<font size="2">ค้นหาหนังสือ จาก 
				</font><select size="1" name="field">
				<?php
				if($_REQUEST['field']=='subject'){
				echo "<option value='subject' selected>เรื่อง</option>";
				}
				else{
				echo "<option value='subject'>เรื่อง</option>";
				}
				if($_REQUEST['field']=='book_no'){
				echo "<option value='book_no' selected>เลขหนังสือ</option>";
				}
				else{
				echo "<option value='book_no'>เลขหนังสือ</option>";
				}
				echo "</select>";
				
				echo "<font size='2'> ด้วยคำว่า </font>";
				echo "<input type='text' name='search' size='20' value='$_REQUEST[search]'>"; 
				echo "<input type='hidden' name='search_index' value='1'>";
				echo " <input type='submit' value='ค้นหา'>";
echo "</td>";				
/////////////////////
echo "<td align='right'>";
	echo "<Select  name='workgroup' size='1'>";
	echo  '<option value ="" >ทุกกลุ่ม(งาน)</option>' ;
						$sql = "SELECT *  FROM  system_workgroup";
						$dbquery =mysql_query($sql);
						While ($result = mysql_fetch_array($dbquery))
							{ 
								if($_REQUEST['workgroup']==$result['workgroup']){
								echo "<option value='$result[workgroup]' selected>$result[workgroup_desc]</option>"; 
								}
								else{
								echo "<option value='$result[workgroup]'>$result[workgroup_desc]</option>"; 
								}
							}
	echo "</select>";
	echo " <input type='submit' value='เลือก'>";
echo "</td>";					
/////////////////				
				
				
				?>
			</form>
		</tr>
</table>


<table border="1" width="99%" id="table2" style="border-collapse: collapse" align="center">
				<tr bgcolor="#FFCCCC">
					<td align="center" width="50">
					<font size="2" face="Tahoma">เลขทะเบียนรับ</font></td>
					<td align="center" width="50">
					<font size="2" face="Tahoma">ปี</font></td>
					<td align="center" width="120">
					<font face="Tahoma" size="2">ที่</font></td>
					<td align="center" width="80">
					<font face="Tahoma" size="2">ลงวันที่</font></td>
					<td align="center" width="100">
					<font face="Tahoma" size="2">จาก</font></td>
					<td align="center" width="120">
					<font face="Tahoma" size="2">ถึง</font></td>
					<td align="center">
					<font face="Tahoma" size="2">เรื่อง</font></td>
					<td align="center" width="100">
					<font face="Tahoma" size="2">กลุ่มปฏิบัติ</font></td>
					<td align="center" width="100">
					<font face="Tahoma" size="2">บุคคลปฏิบัติ</font></td>
					<td align="center" width="60">
					<font face="Tahoma" size="2">หมายเหตุ</font></td>
					<td align="center" width="80">
					<font face="Tahoma" size="2">วันลงทะเบียน</font></td>
					<td align="center" width="50">
					<font face="Tahoma" size="2">ราย<br />ละเอียด</font></td>
					<td align="center" width="50">
					<font face="Tahoma" size="2">ลบ</font></td>
					<td align="center" width="50">
					<font face="Tahoma" size="2">แก้ไข</font></td>
				</tr>
<?php
if($_REQUEST['search_index']==1){
		if($_REQUEST['workgroup']!=""){
		$sql="select * from bookregister_receive where $_REQUEST[field] like '%$_REQUEST[search]%' and workgroup='$_REQUEST[workgroup]' order by year,register_number  limit $start,$pagelen "; 
		}
		else{
		$sql="select * from bookregister_receive where $_REQUEST[field] like '%$_REQUEST[search]%' order by year,register_number  limit $start,$pagelen "; 
		}
}
else{
$sql="select * from bookregister_receive order by year,register_number limit $start,$pagelen "; 
}
$dbquery = mysql_query($sql);

$N=(($page-1)*$pagelen)+1; //*เกี่ยวข้องกับการแยกหน้า
$M=1;

While ($result = mysql_fetch_array($dbquery)){
		$id = $result['ms_id'];
		$register_number = $result['register_number'];
		$year = $result['year'];
		$book_no = $result['book_no'];
		$signdate = $result['signdate'];
		$book_from = $result['book_from'];
		$book_to = $result['book_to'];
		$subject = $result['subject'];
		$group = $result['workgroup'];
		$operation = $result['operation'];
		$comment = $result['comment'];
		$register_date = $result['register_date'];
		$ref_id = $result['ref_id'];
			if(($M%2) == 0)
			$color="#ffffff";
			else $color="#FFFFC";
$signdate=thai_date_3($signdate);
$register_date=thai_date_3($register_date);

// ตรวจสอบไฟล์แนบ
if($result['book_link']==0){
$file = mysql_query ("SELECT id  FROM  bookregister_receive_filebook WHERE ref_id='$ref_id' ") ;
}
else if($result['book_link']==1){
$file = mysql_query ("SELECT * FROM  book_filebook WHERE ref_id='$ref_id' ") ;
}
else if($result['book_link']==2){
$file = mysql_query ("SELECT * FROM  bookregister_send_filebook_sch WHERE ref_id='$ref_id' ") ;
}
			$file_num = mysql_num_rows($file) ;
			if ($file_num==0) {
				$file_img = "" ;
			}else{
				$file_img = "<IMG SRC=\"modules/bookregister/images/file1.gif\" WIDTH=\"13\" HEIGHT=\"10\" BORDER=\"0\" ALT=\"มีไฟล์แนบ\">" ;
			}
			
if($result['secret']==1){
$secret_txt="<font color='#FF0000'>[ลับ]</font>";
}
else{
$secret_txt="";
}

?>
			<tr bgcolor="<?php echo $color;?>">
					<td align="center"><?php echo $register_number;?></td>
					<td align="center"><?php echo $year;?></td>
					<td align="left">&nbsp;<?php echo $book_no;?></td>
					<td align="center">&nbsp;<?php echo $signdate;?></td>
					<td align="left"><?php echo $book_from;?></td>
					<td align="left"><?php echo $book_to;?></td>
					<td align="left"><?php echo $subject;?>&nbsp;<?php echo $file_img;?>&nbsp;<?php echo $secret_txt;?></td>
					<td align="left"><?php 
					if(isset($workgroup_ar[$group])){
					echo $workgroup_ar[$group];
					}
					?></td>
					<td align="left"><?php echo $operation;?></td>
					<td align="left"><?php echo $comment;?></td>
					<td align='center'><?php echo $register_date;?></td>
					<td align="center"><A HREF="javascript:void(0)"
onclick="window.open('modules/bookregister/main/bookdetail_receive.php?id=<?php echo $result['ms_id'];?>', 'bookdetail','width=500,height=500,scrollbars')" title="คลิกเพื่อดูรายละเอียด"><span style="text-decoration: none">คลิก</span></A></td>
<?php
//ตั้งค่าเวลาให้ลบได้					
$now=time();
$timestamp_recdate=make_time_2($result['register_date']);
$timestamp_recdate_2=$timestamp_recdate+(86400*3);  //เพิ่มเวลา 3 วัน
if($now<=$timestamp_recdate_2){
$delete=1;		//yes			
}
else {
$delete=2;    //no
}					

if(($result['officer']==$user) and ($delete==1)){
echo "<Td align='center'><a href=?option=bookregister&task=main/receive&index=2&id=$id&page=$_REQUEST[page]><img src=images/drop.png border='0' alt='ลบ'></a></Td>";
}
else{
echo "<td></td>";
}
if(($result['officer']==$user) and ($delete==1)){
echo "<Td align='center'><a href=?option=bookregister&task=main/receive&index=5&id=$id&page=$_REQUEST[page]&workgroup=$_REQUEST[workgroup]><img src=images/edit.png border='0' alt='แก้ไข'></a></Td>";
}
else{
echo "<td></td>";
}
echo "</tr>";
		
	$M++;
	$N++;  //*เกี่ยวข้องกับการแยกหน้า
	}  // end while	
echo "<tr><td colspan='14'>&nbsp;&nbsp;<FONT COLOR='#009933'><IMG SRC='modules/bookregister/images/file1.gif' WIDTH='16' HEIGHT='16' BORDER='0'>มีไฟล์เอกสาร</FONT>";

echo "&nbsp;&nbsp;&nbsp;ส่งออก[Excel]<a href='modules/bookregister/main/export_to_excel2.php?workgroup=$_REQUEST[workgroup]' target='_blank'>[คลิก]</a>";

echo "</td></tr>";
echo "</table>";
}  //end index

?>
<script>
function goto_url(val){
	if(val==0){
		callfrm("?option=bookregister&task=main/receive"); 
	}else if(val==1){
	var file1 = document.frm1.myfile1.value;
	var file2 = document.frm1.myfile2.value;
	var file3 = document.frm1.myfile3.value;
	var file4 = document.frm1.myfile4.value;
	var file5 = document.frm1.myfile5.value;
		
	var vdfile1 = document.frm1.dfile1.value;
	var vdfile2 = document.frm1.dfile2.value;
	var vdfile3 = document.frm1.dfile3.value;
	var vdfile4 = document.frm1.dfile4.value;
	var vdfile5 = document.frm1.dfile5.value;
	
		   if (document.frm1.book_no.value=="")
           {
          alert("กรุณากรอกเลขที่หนังสือ");
          document.frm1.book_no.focus();    
           }	   
		   else if (document.frm1.book_from.value=="")
           {
          alert("กรุณากรอกหนังสือจากหน่วยงานไหน");
          document.frm1.book_from.focus();    
           }	   
		   else if (document.frm1.book_to.value=="")
           {
          alert("กรุณากรอกหนังสือส่งถึงใคร");
         	document.frm1.book_to.focus();    
           }	   
		   else if (document.frm1.subject.value=="")
           {
          alert("กรุณากรอกเรื่องหนังสือ");
         	document.frm1.subject.focus();    
           }	 
		   else if (document.frm1.workgroup.value=="")
           {
          alert("กรุณากรอกเลือกกลุ่ม");
           }	   
		   else if ((file1 !="") && (vdfile1=="")) 
           {
          alert("กรุณากรอก คำอธิบายไฟล์");
      		 document.frm1.dfile1.focus();    
           }

		   else if ((file2 !="") && (vdfile2=="")) 
           {
          alert("กรุณากรอก คำอธิบายไฟล์");
      		 document.frm1.dfile2.focus();    
           }
		   
		   else if ((file3!="") && (vdfile3=="")) 
           {
          alert("กรุณากรอก คำอธิบายไฟล์");
       	   document.frm1.dfile3.focus();    
           }
		   
		   else if ((file4 !="") && (vdfile4=="")) 
           {
          alert("กรุณากรอก คำอธิบายไฟล์");
           document.frm1.dfile4.focus();    
           }
		   
		   else if ((file5!="") && (vdfile5=="")) 
           {
          alert("กรุณากรอก คำอธิบายไฟล์");
           document.frm1.dfile5.focus();    
           }

        else{
		callfrm("?option=bookregister&task=main/receive&index=4");   //page ประมวลผล
		}
	}
}

function goto_url2(val){
	if(val==0){
		callfrm("?option=bookregister&task=main/receive"); 
	}else if(val==1){
	var file1 = document.frm1.myfile1.value;
	var file2 = document.frm1.myfile2.value;
	var file3 = document.frm1.myfile3.value;
	var file4 = document.frm1.myfile4.value;
	var file5 = document.frm1.myfile5.value;
		
	var vdfile1 = document.frm1.dfile1.value;
	var vdfile2 = document.frm1.dfile2.value;
	var vdfile3 = document.frm1.dfile3.value;
	var vdfile4 = document.frm1.dfile4.value;
	var vdfile5 = document.frm1.dfile5.value;
	
		   if (document.frm1.book_no.value=="")
           {
          alert("กรุณากรอกเลขที่หนังสือ");
          document.frm1.book_no.focus();    
           }	   
		   else if (document.frm1.book_from.value=="")
           {
          alert("กรุณากรอกหนังสือจากหน่วยงานไหน");
          document.frm1.book_from.focus();    
           }	   
		   else if (document.frm1.book_to.value=="")
           {
          alert("กรุณากรอกหนังสือส่งถึงใคร");
         	document.frm1.book_to.focus();    
           }	   
		   else if (document.frm1.subject.value=="")
           {
          alert("กรุณากรอกเรื่องหนังสือ");
         	document.frm1.subject.focus();    
           }	   
		   else if (document.frm1.group.value=="")
           {
          alert("กรุณากรอกเลือกกลุ่ม");
           }	   
		   else if ((file1 !="") && (vdfile1=="")) 
           {
          alert("กรุณากรอก คำอธิบายไฟล์");
      		 document.frm1.dfile1.focus();    
           }

		   else if ((file2 !="") && (vdfile2=="")) 
           {
          alert("กรุณากรอก คำอธิบายไฟล์");
      		 document.frm1.dfile2.focus();    
           }
		   
		   else if ((file3!="") && (vdfile3=="")) 
           {
          alert("กรุณากรอก คำอธิบายไฟล์");
       	   document.frm1.dfile3.focus();    
           }
		   
		   else if ((file4 !="") && (vdfile4=="")) 
           {
          alert("กรุณากรอก คำอธิบายไฟล์");
           document.frm1.dfile4.focus();    
           }
		   
		   else if ((file5!="") && (vdfile5=="")) 
           {
          alert("กรุณากรอก คำอธิบายไฟล์");
           document.frm1.dfile5.focus();    
           }

        else{
		callfrm("?option=bookregister&task=main/receive&index=6");   //page ประมวลผล
		}
	}
}

</script>
