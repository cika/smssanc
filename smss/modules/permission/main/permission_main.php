<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
if(!($_SESSION['login_status']<=4)){
exit();
}

require_once "modules/permission/time_inc.php";	

$user=$_SESSION['login_user_id'];

//ฟังชั่นupload
function file_upload() {
		$uploaddir = 'modules/permission/upload_files/';      //ที่เก็บไไฟล์
		$uploadfile = $uploaddir.basename($_FILES['userfile']['name']);
		$basename = basename($_FILES['userfile']['name']);

		if (move_uploaded_file($_FILES['userfile']['tmp_name'],  $uploadfile))
			{
				$rand_num=rand();
				$time_mk=time();
				$txt ="doc_".$time_mk.$rand_num;
				$before_name  = $uploaddir . $basename;
				///////
				$array_lastname = explode("." ,$basename) ;
				 $c =count ($array_lastname) - 1 ;
				 $lastname = strtolower ($array_lastname[$c]) ;
				$changed_name = $uploaddir.$txt.".".$lastname;
				///////
				rename("$before_name" , "$changed_name");
				return  $changed_name;
			}
		else
			{
			return  $changed_name;
			}
}

if(!isset($_POST['no_comment'])){
$_POST['no_comment']="";
}


//ส่วนหัว
echo "<br />";
if(!(($index==1) or ($index==2) or ($index==5) or ($index==7) or ($index==8))){

$sql_name = "select * from person_main where person_id='$user'";
$dbquery_name = mysql_query($sql_name);
$result_name = mysql_fetch_array($dbquery_name);
		$person_id = $result_name['person_id'];
		$prename=$result_name['prename'];
		$name= $result_name['name'];
		$surname = $result_name['surname'];
		$position_code = $result_name['position_code'];
$full_name="$prename$name&nbsp;&nbsp;$surname";

echo "<table width='100%' border='0' align='center'>";
echo "<tr align='center'><td><font color='#006666' size='3'><strong>ทะเบียนขออนุญาตไปราชการ</strong></font></td></tr>";
echo "<tr align='center'><td><font color='#006666' size='2'><strong>$full_name</strong></font></td></tr>";
echo "</table>";
}

//ส่วนฟอร์มรับข้อมูล
if($index==1){
echo "<form Enctype = multipart/form-data id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>ขออนุญาตไปราชการ</Font>";
echo "</Cener>";
echo "<Br>";
echo "<Table width='90%'>";

echo "<Tr align='left'><Td align='right'>(เรื่อง)ไปราชการ&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='subject' id='subject' Size='60'></Td></Tr>";

echo "<Tr align='left'><Td align='right'>สถานที่ไปราชการ&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='place' id='place' Size='60'></Td></Tr>";

echo "<Tr align='left'><Td align='right'>วันไปราชการ&nbsp;&nbsp;</Td><Td>";

//  ------------- ส่วนที่ 1 -------------
$year=date('Y');
$month=date('m');
$month= intval($month);
$mkdate=mktime(0,0,0, $month, 1, $year);
$full_month=date('F',$mkdate);
$weekday=date('w',$mkdate); 
$last_days=date('t',$mkdate);
$day=1;
$thai_year=$year+543;

if($month==12){
$next_month=1;
$next_year=$year+1;
}
else{
$next_month=$month+1;
$next_year=$year;
}
$next_mkdate=mktime(0,0,0, $next_month, 1, $next_year);
$next_full_month=date('F',$next_mkdate);
$next_weekday=date('w',$next_mkdate); 
$next_last_days=date('t',$next_mkdate);
$next_thai_year=$next_year+543;

?>
<table border="1">
	<tr bgcolor="#BBBBBB">
		<td colspan="7">
        	<center><b><?php echo "$th_month[$month] $thai_year"; ?></b><center>
        	</td>
	</tr>
	<tr bgcolor="#BBBBBB" align="center">
		<td width="50">อาทิตย์</td>
		<td width="50">จันทร์</td>
		<td width="50">อังคาร</td>
		<td width="50">พุธ</td>
		<td width="50">พฤหัสบดี</td>
 		<td width="50">ศุกร์</td>
		<td width="50">เสาร์</td>
	</tr>
	<tr>
<?php
//  ------------- ส่วนที่ 2 -------------
$start= 1;
while ($start<= $weekday) {
	echo "<td>&nbsp;</td>";
	$start++;
}
//  ------------- ส่วนที่ 3 -------------
$weekday++;
while ($day<=$last_days) {
	if (date("d")==$day) {
		echo "<td bgcolor='#BBBBBB'>";
		echo"<input type='checkbox' name='chk$day' id='chk$day' value='$year-$month-$day'>$day</td>"; 
	} else {
		echo "<td><input type='checkbox' name='chk$day' id='chk$day' value='$year-$month-$day'>$day</td>";
	}
	if ($weekday==7 and $day<>$last_days) {
		echo '</tr><tr>';
		$weekday=0;
	}
	
	$day++; 
	$weekday++; 
}
//  ------------- ส่วนที่ 4 -------------
while ($weekday <= 7) {
	echo "<td> &nbsp; </td>";
	$weekday++;
}

echo "</tr>	</table>";

//เดือนที่สอง
?>
<table border="1">
	<tr bgcolor="#BBBBBB">
		<td colspan="7">
        	<center><b><?php echo "$th_month[$next_month] $next_thai_year"; ?></b><center>
        	</td>
	</tr>
	<tr bgcolor="#BBBBBB" align="center">
		<td width="50">อาทิตย์</td>
		<td width="50">จันทร์</td>
		<td width="50">อังคาร</td>
		<td width="50">พุธ</td>
		<td width="50">พฤหัสบดี</td>
 		<td width="50">ศุกร์</td>
		<td width="50">เสาร์</td>
	</tr>
	<tr>
<?php
//  ------------- ส่วนที่ 2 -------------
$start= 1;

while ($start<= $next_weekday) {
	echo "<td>&nbsp;</td>";
	$start++;
}


//  ------------- ส่วนที่ 3 -------------
$next_weekday++;
$day=1;
$dayplus=$last_days+$day;
$tatal_day=$last_days+$next_last_days;
while ($day<=$next_last_days) {
		echo "<td><input type='checkbox'  name='chk$dayplus' id='chk$dayplus' value='$next_year-$next_month-$day'>$day</td>";
		$dayplus++;
	if ($next_weekday==7 and $day<>$next_last_days) {
		echo '</tr><tr>';
		$next_weekday=0;
	}
	
	$day++; 
	$next_weekday++; 
}
//  ------------- ส่วนที่ 4 -------------
while ($next_weekday <= 7) {
	echo "<td> &nbsp; </td>";
	$next_weekday++;
}
echo "</tr>	</table>";

echo "</Td></Tr>";

echo "<Tr align='left'><Td align='right'>พาหนะ&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='vehicle' id='vehicle' Size='40'></Td></Tr>";

echo  "<tr align='left'>";
echo  "<td align='right'>เอกสาร(ถ้ามี)&nbsp;&nbsp;</td>";
echo  "<td align='left'><input name = 'userfile' type = 'file'></td>";
echo  "</tr>";
echo "<Tr align='left'><Td align='right'>ไม่ต้องผ่านผู้บังคับบัญชาขั้นต้น&nbsp;&nbsp;</Td><Td><input type='checkbox'  name='no_comment' id='no_comment' value='1'>&nbsp;&nbsp;(เลือกกรณีผู้บังคับบัญชาขั้นต้นไม่ได้ปฏิบัติราชการ)</Td></Tr>";
echo "<Tr align='left'><Td align='right'>เลือกผู้อนุมัติ (ปกติไม่ต้องเลือก)&nbsp;&nbsp;</Td><Td><Select  name='grant_person_selected'  size='1'>";
echo  "<option  value = ''>เลือก</option>" ;
$sql = "select * from person_main where status='0' and (position_code='1' or position_code='2') order by position_code,person_order";
$dbquery = mysql_query($sql);
While ($result = mysql_fetch_array($dbquery))
   {
		$person_id = $result['person_id'];
		$name = $result['name'];
		$surname = $result['surname'];
		echo  "<option value = $person_id>$name $surname</option>";
	}
echo "</select>";
echo "&nbsp;&nbsp;(ใช้กรณีผู้อนุมัติิปกติไม่อยู่) </Td></Tr>";
echo "<Br>";
echo "</Table>";
echo "<Br>";
echo "<input type='hidden' name='hdnLine' value='$tatal_day'>";
echo "<INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url(1)' class=entrybutton>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ย้อนกลับ' onclick='goto_url(0)' class=entrybutton'>";

echo "</form>";
}

//ส่วนยืนยันการลบข้อมูล
if($index==2) {
echo "<table width='500' border='0' align='center'>";
echo "<tr><td align='center'><font color='#990000' size='4'>โปรดยืนยันความต้องการลบข้อมูลอีกครั้ง</font><br></td></tr>";
echo "<tr><td align=center>";
echo "<INPUT TYPE='button' name='smb' value='ยืนยัน' onclick='location.href=\"?option=permission&task=main/permission_main&index=3&id=$_GET[id]&page=$_REQUEST[page]\"'>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ยกเลิก' onclick='location.href=\"?option=permission&task=main/permission_main&page=$_REQUEST[page]\"'";
echo "</td></tr></table>";
}

//ส่วนลบข้อมูล
if($index==3){
$sql="select ref_id from permission_main where id='$_GET[id]'";
$dbquery = mysql_query($sql);
$ref_result = mysql_fetch_array($dbquery);

$sql = "delete from permission_date where ref_id = '$ref_result[ref_id]'";
$dbquery = mysql_query($sql);

$sql = "delete from permission_main where id='$_GET[id]'";
$dbquery = mysql_query($sql);
}

//ส่วนบันทึกข้อมูล
if($index==4){

$basename = basename($_FILES['userfile']['name']);
if ($basename!="")
{
$changed_name = file_upload();
}
else{
$changed_name="";
}

$rec_date = date("Y-m-d");
$date_time_now = date("Y-m-d H:i:s");
$rand_num=rand();
$time_mk=time();

$ref_id = $time_mk.$rand_num;

$sql = "insert into permission_main (person_id, ref_id, subject, place, vehicle, document, no_comment, grant_person_selected, rec_date) values ('$user', '$ref_id','$_POST[subject]','$_POST[place]','$_POST[vehicle]','$changed_name', '$_POST[no_comment]', '$_POST[grant_person_selected]','$date_time_now')";

		if($dbquery = mysql_query($sql)){
				for($x=1;$x<=$_POST['hdnLine'];$x++){
						$chk="chk".$x;
						if(!isset($chk)){
						$chk="";
						}
						if(!isset($_POST[$chk])){
						$_POST[$chk]="";
						}
						if($_POST[$chk]!=""){
						$sql_2 = "insert into permission_date (person_id, ref_id, date, rec_date) values ('$user', '$ref_id', '$_POST[$chk]','$date_time_now')";
						$dbquery_2 = mysql_query($sql_2);
						}
				}
		}
}

//ส่วนฟอร์มแก้ไขข้อมูล
if ($index==5){
echo "<form Enctype = multipart/form-data id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>แก้ไขรายการ</B></Font>";
echo "</Cener>";
echo "<Br><Br>";
echo "<Table width='70%' Border='0'>";

$sql = "select * from permission_main where id='$_GET[id]'";
$dbquery = mysql_query($sql);
$ref_result = mysql_fetch_array($dbquery);
$id=$ref_result['id'];
$ref_id=$ref_result['ref_id'];
$grant_person_selected=$ref_result['grant_person_selected'];
$rec_date=$ref_result['rec_date'];

echo "<Tr align='left'><Td align='right'>เลขที่&nbsp;&nbsp;</Td><Td>$id</Td></Tr>";
echo "<Tr align='left'><Td align='right'>วันที่ขออนุญาต&nbsp;&nbsp;</Td><Td>";
echo thai_date_4($rec_date);
echo "</Td></Tr>";

echo "<Tr align='left'><Td align='right'>เรื่องไปราชการ&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='subject' id='subject' Size='60' value='$ref_result[subject]'></Td></Tr>";

echo "<Tr align='left'><Td align='right'>สถานที่&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='place' id='place' Size='60' value='$ref_result[place]'></Td></Tr>";

echo "<Tr align='left'><Td align='right'>วันไปราชการ&nbsp;&nbsp;</Td><Td>";


$month_number=date("n", make_time_2($rec_date));  // เดือนที่
$year_number=date("Y", make_time_2($rec_date));  // ปี
 // ------------- ส่วนที่ 1 -------------
$year=$year_number;
$month=$month_number;
$month= intval($month);
$mkdate=mktime(0,0,0, $month, 1, $year);
$full_month=date('F',$mkdate);
$weekday=date('w',$mkdate); 
$last_days=date('t',$mkdate);
$day=1;
$thai_year=$year+543;

if($month==12){
$next_month=1;
$next_year=$year+1;
}
else{
$next_month=$month+1;
$next_year=$year;
}
$next_mkdate=mktime(0,0,0, $next_month, 1, $next_year);
$next_full_month=date('F',$next_mkdate);
$next_weekday=date('w',$next_mkdate); 
$next_last_days=date('t',$next_mkdate);
$next_thai_year=$next_year+543;

?>
<table border="1">
	<tr bgcolor="#BBBBBB">
		<td colspan="7">
        	<center><b><?php echo "$th_month[$month] $thai_year"; ?></b><center>
        	</td>
	</tr>
	<tr bgcolor="#BBBBBB" align="center">
		<td width="50">อาทิตย์</td>
		<td width="50">จันทร์</td>
		<td width="50">อังคาร</td>
		<td width="50">พุธ</td>
		<td width="50">พฤหัสบดี</td>
 		<td width="50">ศุกร์</td>
		<td width="50">เสาร์</td>
	</tr>
	<tr>
<?php
//  ------------- ส่วนที่ 2 -------------
$start= 1;
while ($start<= $weekday) {
	echo "<td>&nbsp;</td>";
	$start++;
}
//  ------------- ส่วนที่ 3 -------------
$weekday++;
while ($day<=$last_days) {
		$date_index="$year-$month-$day";
		$sql_date="select * from permission_date where ref_id='$ref_id' and person_id='$user' and  date='$date_index' ";
		$dbquery_date = mysql_query($sql_date);
		if($result_date = mysql_fetch_array($dbquery_date)){
		echo "<td><input type='checkbox' name='chk$day' id='chk$day' value='$year-$month-$day' checked>$day</td>";
		}
		else{
		echo "<td><input type='checkbox' name='chk$day' id='chk$day' value='$year-$month-$day'>$day</td>";
		}
	if ($weekday==7 and $day<>$last_days) {
		echo '</tr><tr>';
		$weekday=0;
	}
	
	$day++; 
	$weekday++; 
}
//  ------------- ส่วนที่ 4 -------------
while ($weekday <= 7) {
	echo "<td> &nbsp; </td>";
	$weekday++;
}

echo "</tr>	</table>";

//เดือนที่สอง
?>
<table border="1">
	<tr bgcolor="#BBBBBB">
		<td colspan="7">
        	<center><b><?php echo "$th_month[$next_month] $next_thai_year"; ?></b><center>
        	</td>
	</tr>
	<tr bgcolor="#BBBBBB" align="center">
		<td width="50">อาทิตย์</td>
		<td width="50">จันทร์</td>
		<td width="50">อังคาร</td>
		<td width="50">พุธ</td>
		<td width="50">พฤหัสบดี</td>
 		<td width="50">ศุกร์</td>
		<td width="50">เสาร์</td>
	</tr>
	<tr>
<?php
//  ------------- ส่วนที่ 2 -------------
$start= 1;

while ($start<= $next_weekday) {
	echo "<td>&nbsp;</td>";
	$start++;
}


//  ------------- ส่วนที่ 3 -------------
$next_weekday++;
$day=1;
$dayplus=$last_days+$day;
$tatal_day=$last_days+$next_last_days;
while ($day<=$next_last_days) {
		$date_index="$next_year-$next_month-$day";
		$sql_date="select * from permission_date where ref_id='$ref_id' and person_id='$user' and  date='$date_index' ";
		$dbquery_date = mysql_query($sql_date);
		if($result_date = mysql_fetch_array($dbquery_date)){
		echo "<td><input type='checkbox'  name='chk$dayplus' id='chk$dayplus' value='$next_year-$next_month-$day' checked>$day</td>";
		}
		else{
		echo "<td><input type='checkbox' name='chk$dayplus' id='chk$dayplus' value='$next_year-$next_month-$day'>$day</td>";
		}
		$dayplus++;
	if ($next_weekday==7 and $day<>$next_last_days) {
		echo '</tr><tr>';
		$next_weekday=0;
	}
	
	$day++; 
	$next_weekday++; 
}
//  ------------- ส่วนที่ 4 -------------
while ($next_weekday <= 7) {
	echo "<td> &nbsp; </td>";
	$next_weekday++;
}
echo "</tr>	</table>";


echo "</Td></Tr>";

echo "<Tr align='left'><Td align='right'>พาหนะ&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='vehicle' id='vehicle' Size='60' value='$ref_result[vehicle]'></Td></Tr>";

echo  "<tr align='left'>";
echo  "<td align='right'>เอกสาร(ถ้ามี)&nbsp;&nbsp;</td>";
echo  "<td align='left'><input name = 'userfile' type = 'file'></td>";
echo  "</tr>";
if($ref_result['no_comment']==1){
$no_comment_select="checked";
}
else{
$no_comment_select="";
}
echo "<Tr align='left'><Td align='right'>ไม่ต้องผ่านผู้บังคับบัญชาขั้นต้น&nbsp;&nbsp;</Td><Td><input type='checkbox'  name='no_comment' id='no_comment' value='1' $no_comment_select>&nbsp;&nbsp;(เลือกกรณีผู้บังคับบัญชาขั้นต้นไม่ได้ปฏิบัติราชการ)</Td></Tr>";
echo "<Tr align='left'><Td align='right'>เลือกผู้อนุมัติท่านอื่น&nbsp;&nbsp;</Td><Td><Select  name='grant_person_selected'  size='1'>";
echo  "<option  value = ''>เลือก</option>" ;
$sql = "select * from person_main where status='0' and (position_code='1' or position_code='2') order by position_code,person_order";
$dbquery = mysql_query($sql);
While ($result = mysql_fetch_array($dbquery))
   {
		$person_id = $result['person_id'];
		$name = $result['name'];
		$surname = $result['surname'];
		if($person_id==$grant_person_selected){
		echo  "<option value = $person_id selected>$name $surname</option>";
		}
		else{
		echo  "<option value = $person_id>$name $surname</option>";
		}
	}
echo "</select>";
echo "&nbsp;&nbsp;(กรณีผู้อนุมัติปกติไม่สามารถปฏิบัติหน้าที่ได้) </Td></Tr>";

echo "</Table>";
echo "<Input Type=Hidden Name='id' Value='$_GET[id]'>";
echo "<Input Type=Hidden Name='page' Value='$_GET[page]'>";
echo "<input type='hidden' name='ref_id' value='$ref_id'>";
echo "<input type='hidden' name='hdnLine' value='$tatal_day'>";
echo "<Br>";
echo "<INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url_update(1)' class=entrybutton>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ย้อนกลับ' onclick='goto_url_update(0)' class=entrybutton'>";
echo "</form>";
}

//ส่วนปรับปรุงข้อมูล
if ($index==6){
$date_time_now = date("Y-m-d H:i:s");

		if($_FILES['userfile']['name']==""){
		$sql = "update permission_main set subject='$_POST[subject]', place='$_POST[place]', vehicle='$_POST[vehicle]', no_comment='$_POST[no_comment]', grant_person_selected='$_POST[grant_person_selected]' where id='$_POST[id]'";
		$dbquery = mysql_query($sql);
		}
		else{
		$changed_name = file_upload();
		$sql = "update permission_main set subject='$_POST[subject]', place='$_POST[place]', vehicle='$_POST[vehicle]' ,document='$changed_name', no_comment='$_POST[no_comment]', grant_person_selected='$_POST[grant_person_selected]' where id='$_POST[id]'";
		$dbquery = mysql_query($sql);
		}

		$ref_id = $_POST['ref_id'];
		$sql = "delete from permission_date where ref_id='$ref_id' and person_id='$user' ";
		$dbquery = mysql_query($sql);

				for($x=1;$x<=$_POST['hdnLine'];$x++){
						$chk="chk".$x;
						if(!isset($chk)){
						$chk="";
						}
						if(!isset($_POST[$chk])){
						$_POST[$chk]="";
						}
						
						if($_POST[$chk]!=""){
						$sql_2 = "insert into permission_date (person_id, ref_id, date, rec_date) values ('$user', '$ref_id', '$_POST[$chk]','$date_time_now')";
						$dbquery_2 = mysql_query($sql_2);
						}
				}
}

if ($index==7){
echo "<Center>";
echo "<Font color='#006666' Size=3><B>รายละเอียดการขออนุญาตไปราชการ</B></Font>";
echo "</Cener>";
echo "<Br>";

$sql_person = "select  * from  person_main ";
$dbquery_person = mysql_query($sql_person);
While ($result_person = mysql_fetch_array($dbquery_person)){
$fullname=$result_person['prename'].$result_person['name']." ".$result_person['surname'];
$person_ar[$result_person['person_id']]=$fullname;
}

$sql="select * from permission_main where id='$_GET[id]'";
$dbquery = mysql_query($sql);
$ref_result = mysql_fetch_array($dbquery);
$id=$ref_result['id'];
$ref_id=$ref_result['ref_id'];
$file=$ref_result['document'];
$grant_person_selected=$ref_result['grant_person_selected'];
$comment_person=$ref_result['comment_person'];
$grant_person=$ref_result['grant_person'];
$report=$ref_result['report'];
$rec_date=$ref_result['rec_date'];
echo "<Br>";
echo "<Table  align='center' width='80%' Border='0'>";
echo "<Tr ><Td colspan='2' align='right'><INPUT TYPE='button' name='smb' value='<<กลับหน้าก่อน' onclick='location.href=\"?option=permission&task=main/permission_main&page=$_GET[page]\"'></Td></Tr>";

echo "<Tr align='left'><Td align='right' width='50%'>เลขที่&nbsp;&nbsp;</Td><Td>$ref_result[id]</Td></Tr>";

echo "<Tr align='left'><Td align='right'>วันที่ขออนุญาต&nbsp;&nbsp;</Td><Td>";
echo thai_date_4($rec_date);
echo "</Td></Tr>";
echo "<Tr align='left'><Td align='right'>เรื่องไปราชการ&nbsp;&nbsp;</Td><Td>$ref_result[subject]</Td></Tr>";

echo "<Tr align='left'><Td align='right'>สถานที่&nbsp;&nbsp;</Td><Td>$ref_result[place]</Td></Tr>";

	$sql_date="select * from permission_date where ref_id='$ref_id' and person_id='$user' order by date";
	$dbquery_date = mysql_query($sql_date);
	$date_num=1;
	While ($result_date = mysql_fetch_array($dbquery_date)){
		$date = $result_date['date'];
		$full_date=thai_date($date);
		if($date_num==1){
		echo "<Tr align='left'><Td align='right'>วันไปราชการ&nbsp;&nbsp;</Td><Td>$full_date</Td></Tr>";
		}
		else{
		echo "<Tr align='left'><Td align='right'>&nbsp;&nbsp;</Td><Td>$full_date</Td></Tr>";
		}
		
		$date_num++;
	}

echo "<Tr align='left'><Td align='right'>พาหนะ&nbsp;&nbsp;</Td><Td>$ref_result[vehicle]</Td></Tr>";

if($ref_result['document']!=""){
echo "<Tr><Td align='right'>เอกสาร&nbsp;&nbsp;</Td><Td align='left'><a href=$file target=_blank><img src=./images/browse.png border='0' alt='File'></Td></Tr>";
}

if($ref_result['no_comment']==1){
$no_comment_select="checked";
}
else{
$no_comment_select="";
}
echo "<Tr align='left'><Td align='right'></Td><Td><input type='checkbox'  name='no_comment' id='no_comment' value='1' $no_comment_select>&nbsp;ไม่ต้องผ่านผู้บังคับบัญชาขั้นต้น</Td></Tr>";

if($grant_person_selected!=""){
echo "<Tr align='left'><Td align='right'>ผู้อนุมัติ&nbsp;&nbsp;</Td><Td>$person_ar[$grant_person_selected]</Td></Tr>";
}

echo "</Table>";

echo "<table width='500'><tr><td>";
echo "<fieldset>";
echo "<legend>&nbsp;<B>ส่วนความเห็นของผู้บังคับบัญชาขั้นต้น</B>: &nbsp;</legend>";
echo "<table>";
$thai_date_comment=thai_date_4($ref_result['comment_date']);
echo "<Tr align='left'><Td align='right' width='50%'>ความเห็นของผู้บังคับบัญชาขั้นต้น&nbsp;&nbsp;</Td><Td width='50%'>$ref_result[comment]</Td></Tr>";
echo "<Tr align='left'><Td align='right'>ลงชื่อ&nbsp;&nbsp;</Td><Td>";
if(isset($person_ar[$comment_person])){
echo $person_ar[$comment_person];
}
echo "</Td></Tr>";
echo "<Tr align='left'><Td align='right'>วันเวลา&nbsp;&nbsp;</Td><Td>$thai_date_comment</Td></Tr>";

echo "</table>";
echo "</fieldset></td></tr></table>";

echo "<table width='500'><tr><td>";
echo "<fieldset>";
echo "<legend>&nbsp;<B>ส่วนของการอนุมัติ/คำสั่ง</B>: &nbsp;</legend>";
echo "<table>";

echo "<Tr align='left'><Td align='right' width='50%'>การอนุมัติ&nbsp;&nbsp;</Td><Td>";
if($ref_result['grant_x']==1){
echo "อนุมัติ";
}
if($ref_result['grant_x']==2){
echo "<font color='#990000'><b>ไม่อนุมัติ</b></font>";
}
echo "</Td></Tr>";
echo "<Tr align='left'><Td align='right'>คำสั่ง&nbsp;&nbsp;</Td><Td>$ref_result[grant_comment]</Td></Tr>";
echo "<Tr align='left'><Td align='right' width='50%'>ลงชื่อ&nbsp;&nbsp;</Td><Td>";
if(isset($person_ar[$grant_person])){
echo $person_ar[$grant_person];
}
echo "</Td></Tr>";
$thai_date_grant=thai_date_4($ref_result['grant_date']);
echo "<Tr align='left'><Td align='right'>วันเวลา&nbsp;&nbsp;</Td><Td>$thai_date_grant</Td></Tr>";
echo "</table>";
echo "</fieldset></td></tr></table>";

if($report!=""){
echo "<table width='500'><tr><td>";
echo "<fieldset>";
echo "<legend>&nbsp;<B>ส่วนของรายงาน</B>: &nbsp;</legend>";
echo "<table width='500'>";
$thai_date_report=thai_date_4($ref_result['report_date']);
echo "<Tr align='left'><Td valign='top' align='left' colspan='2'>$report</Td></Tr>";
echo "<Tr align='left'><Td align='right' width='50%'>วันเวลารายงาน&nbsp;&nbsp;</Td><Td>$thai_date_report</Td></Tr>";
echo "</table>";
echo "</fieldset></td></tr></table>";
}
}

//ส่วนของการเขียนรายงาน
if($index==8){
echo "<Center>";
echo "<Font color='#006666' Size=3><B>รายงานการไปราชการ</B></Font>";
echo "</Cener>";
echo "<Br>";
echo "<form id='frm1' name='frm1'>";
$sql_person = "select  * from  person_main ";
$dbquery_person = mysql_query($sql_person);
While ($result_person = mysql_fetch_array($dbquery_person)){
$fullname=$result_person['prename'].$result_person['name']." ".$result_person['surname'];
$person_ar[$result_person['person_id']]=$fullname;
}

$sql="select * from permission_main where id='$_GET[id]'";
$dbquery = mysql_query($sql);
$ref_result = mysql_fetch_array($dbquery);
$id=$ref_result['id'];
$ref_id=$ref_result['ref_id'];
$file=$ref_result['document'];
$grant_person_selected=$ref_result['grant_person_selected'];
$comment_person=$ref_result['comment_person'];
$grant_person=$ref_result['grant_person'];
$report=$ref_result['report'];
$rec_date=$ref_result['rec_date'];
echo "<Br>";
echo "<Table  align='center' width='80%' Border='0'>";
echo "<Tr ><Td colspan='2' align='right'><INPUT TYPE='button' name='smb' value='<<กลับหน้าก่อน' onclick='location.href=\"?option=permission&task=main/permission_main&page=$_GET[page]\"'></Td></Tr>";

echo "<Tr align='left'><Td align='right' width='50%'>เลขที่&nbsp;&nbsp;</Td><Td>$ref_result[id]</Td></Tr>";

echo "<Tr align='left'><Td align='right'>วันที่ขออนุญาต&nbsp;&nbsp;</Td><Td>";
echo thai_date_4($rec_date);
echo "</Td></Tr>";
echo "<Tr align='left'><Td align='right'>เรื่องไปราชการ&nbsp;&nbsp;</Td><Td>$ref_result[subject]</Td></Tr>";

echo "<Tr align='left'><Td align='right'>สถานที่&nbsp;&nbsp;</Td><Td>$ref_result[place]</Td></Tr>";

	$sql_date="select * from permission_date where ref_id='$ref_id' and person_id='$user' order by date";
	$dbquery_date = mysql_query($sql_date);
	$date_num=1;
	While ($result_date = mysql_fetch_array($dbquery_date)){
		$date = $result_date['date'];
		$full_date=thai_date($date);
		if($date_num==1){
		echo "<Tr align='left'><Td align='right'>วันไปราชการ&nbsp;&nbsp;</Td><Td>$full_date</Td></Tr>";
		}
		else{
		echo "<Tr align='left'><Td align='right'>&nbsp;&nbsp;</Td><Td>$full_date</Td></Tr>";
		}
		
		$date_num++;
	}

echo "<Tr align='left'><Td align='right'>พาหนะ&nbsp;&nbsp;</Td><Td>$ref_result[vehicle]</Td></Tr>";

if($ref_result['document']!=""){
echo "<Tr><Td align='right'>เอกสาร&nbsp;&nbsp;</Td><Td align='left'><a href=$file target=_blank><img src=./images/browse.png border='0' alt='File'></Td></Tr>";
}

if($grant_person_selected!=""){
echo "<Tr align='left'><Td align='right'>ผู้อนุมัติ&nbsp;&nbsp;</Td><Td>$person_ar[$grant_person_selected]</Td></Tr>";
}

echo "<Tr><Td colspan='2' align='center'><font color='#339900'><b>เขียนรายงาน</b></font></Td></Tr>";
echo "<Tr><Td colspan='2' align='center'><TEXTAREA NAME='report' ROWS='8' COLS='60'>$report</TEXTAREA></Td></Tr>";
echo "</Table>";
echo "<Input Type=Hidden Name='id' Value='$_GET[id]'>";
echo "<Input Type=Hidden Name='page' Value='$_GET[page]'>";
echo "<br>";
echo "<INPUT TYPE='button' name='smb' value='ตกลง' onclick='p_report(1)'>";
echo "</form>";
}

if($index==9){
$report_date = date("Y-m-d H:i:s");
		$sql = "update permission_main set report='$_POST[report]',  report_date='$report_date' where id='$_POST[id]'";
		$dbquery = mysql_query($sql);
}

//ส่วนแสดงผล
if(!(($index==1) or ($index==2) or ($index==5) or ($index==7) or ($index==8))){

//ส่วนของการแยกหน้า
$sql="select id from permission_main where person_id='$user'";
$dbquery = mysql_query($sql);
$num_rows = mysql_num_rows($dbquery );

$pagelen=20;  // 1_กำหนดแถวต่อหน้า
$url_link="option=permission&task=main/permission_main";  // 2_กำหนดลิงค์ฺ
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

$sql="select * from permission_main where person_id='$user' order by id limit $start,$pagelen";
$dbquery = mysql_query($sql);

echo  "<table width=95% border=0 align=center>";
echo "<Tr><Td colspan='11' align='left'><INPUT TYPE='button' name='smb' value='เขียนขออนุญาตไปราชการ' onclick='location.href=\"?option=permission&task=main/permission_main&index=1\"'></Td></Tr>";

echo "<Tr bgcolor='#FFCCCC' align='center'><Td width='60'>เลขที่</Td><Td width='100'>วันขออนุญาต</Td><Td>เรื่องราชการ</Td><Td>สถานที่</Td><Td>วันไปราชการ</Td><Td>พาหนะ</Td><Td width='50'>เอกสาร</Td><Td>อนุมัติ/คำสั่ง</Td><Td width='40'>รายละเอียด</Td><Td width='40'>ลบ</Td><Td width='60'>แก้ไช/รายงาน</Td></Tr>";

$N=(($page-1)*$pagelen)+1; //*เกี่ยวข้องกับการแยกหน้า
$M=1;

While ($result = mysql_fetch_array($dbquery)){
		$id = $result['id'];
		$subject = $result['subject'];
		$place = $result['place'];
		$vehicle = $result['vehicle'];
		$ref_id = $result['ref_id'];
		$file = $result['document'];
		$comment_person = $result['comment_person'];
		$grant = $result['grant_x'];
		$grant_comment = $result['grant_comment'];
		$report = $result['report'];
		$rec_date = $result['rec_date'];
			if(($M%2) == 0)
			$color="#FFFFB";
			else  	$color="#FFFFFF";
echo "<Tr bgcolor='$color'><Td valign='top' align='center'>$id</Td><Td valign='top' align='left'>";
echo thai_date_3($rec_date);
echo "</Td><Td valign='top' align='left'>$subject</Td><Td valign='top' align='left' >$place</Td><Td valign='top' align='left'>";

	$sql_date="select * from permission_date where ref_id='$ref_id' and person_id='$user' order by date";
	$dbquery_date = mysql_query($sql_date);
	While ($result_date = mysql_fetch_array($dbquery_date)){
		$date = $result_date['date'];
		echo thai_date_3($date);
		echo "<br />";
	}
echo "</Td><Td valign='top' align='left'>$vehicle</Td>";
if($file!=""){
echo   "<Td valign='top' align='center'><a href='$file' target=_blank><IMG SRC='images/b_browse.png' width='16' height='16' border=0 alt='เอกสาร'></a></td>";
}
else{
echo "<Td valign='top' align='left'>&nbsp;</Td>";
}
echo "<Td valign='top' align='center'>";
if($grant==1){
echo "<img src=images/yes.png border='0'><br><font color='#339900'>$grant_comment</font>";
}
else if($grant==2){
echo "<img src=images/no.png border='0'><br><font color='#990000'>$grant_comment</font>";
}
else{
echo "รออนุมัติ";
}
echo "</Td>";
echo "<Td valign='top' align='center'><a href=?option=permission&task=main/permission_main&index=7&id=$id&page=$page><img src=images/browse.png border='0' alt='รายละเอียด'></Td>";
if(($comment_person=="") and ($grant<1)){
echo "<Td valign='top' align='center'><a href=?option=permission&task=main/permission_main&index=2&id=$id&page=$page><img src=images/drop.png border='0' alt='ลบ'></Td><Td valign='top'  align='center'><a href=?option=permission&task=main/permission_main&index=5&id=$id&page=$page><img src=images/edit.png border='0' alt='แก้ไข'></a></Td>";
}
else if($grant==1 && $report==""){
echo "<Td valign='top' align='center'></Td><Td valign='top' align='center'><a href=?option=permission&task=main/permission_main&index=8&id=$id&page=$page>[รายงาน]</a></Td>";
}
else if($grant==1 && $report!=""){
echo "<Td valign='top' align='center'></Td><Td valign='top' align='center'><a href=?option=permission&task=main/permission_main&index=8&id=$id&page=$page>รายงาน</a></Td>";
}
else{
echo "<td></td><td></td>";
}
echo "</Tr>";

$M++;
$N++;  //*เกี่ยวข้องกับการแยกหน้า
}	
echo "</Table>";
}

?>
<script>
function goto_url(val){
	if(val==0){
		callfrm("?option=permission&task=main/permission_main");   // page ย้อนกลับ 
	}else if(val==1){
		var chk_count=0;
		for(i=1;i<=document.frm1.hdnLine.value;i++) 
		{
			if(eval("document.frm1.chk"+i+".checked")==true){
			chk_count++;
			}
		}
		if(frm1.subject.value == ""){
			alert("กรุณากรอกเรื่องที่ไปราชการ");
		}else if(frm1.place.value == ""){
			alert("กรุณากรอกสถานที่ไปราชการ");
		}else if(chk_count<1){
			alert("กรุณาเลือกวันไปราชการอย่างน้อย 1 วัน");
		}else{
			callfrm("?option=permission&task=main/permission_main&index=4");   //page ประมวลผล
		}
	}
}

function p_report(val){
	if(val==1){
			callfrm("?option=permission&task=main/permission_main&index=9");   
	}
}


function goto_url_update(val){
	if(val==0){
		callfrm("?option=permission&task=main/permission_main");   // page ย้อนกลับ 
	}else if(val==1){
		var chk_count=0;
		for(i=1;i<=document.frm1.hdnLine.value;i++) 
		{
			if(eval("document.frm1.chk"+i+".checked")==true){
			chk_count++;
			}
		}
		if(frm1.subject.value == ""){
			alert("กรุณากรอกเรื่องที่ไปราชการ");
		}else if(frm1.place.value == ""){
			alert("กรุณากรอกสถานที่ไปราชการ");
		}else if(chk_count<1){
			alert("กรุณาเลือกวันไปราชการอย่างน้อย 1 วัน");
		}else{
			callfrm("?option=permission&task=main/permission_main&index=6");   //page ประมวลผล
		}
	}
}




</script>
