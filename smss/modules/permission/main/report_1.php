<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
if(!($_SESSION['login_status']<=5)){
exit();
}

require_once "modules/permission/time_inc.php";	

//แปลงรูปแบบ date
if(isset($_GET['datepicker'])){
$f1_date=explode("-", $_GET['datepicker']);
$f2_date=$f1_date[2]."-".$f1_date[1]."-".$f1_date[0];  //ปี เดือน วัน
}
else{
$f2_date=date("Y-m-d");
}

//กรณีกลับหน้าก่อน
if(isset($_GET['datepicker_2'])){
$f2_date=$_GET['datepicker_2'];
}

$thai_date=thai_date($f2_date);

//ส่วนหัว
echo "<br />";
if(!($index==7)){

echo "<table width='100%' border='0' align='center'>";
echo "<tr align='center'><td><font color='#006666' size='3'><strong>รายการขออนุญาตไปราชการ</strong></font></td></tr>";
echo "<tr align='center'><td><font color='#006666' size='2'><strong>$thai_date</strong></font></td></tr>";
echo "</table>";
}

if ($index==7){
echo "<Center>";
echo "<Font color='#006666' Size=3><B>รายละเอียดการขออนุญาตไปราชการ</B></Font>";
echo "</Cener>";
echo "<Br>";

$sql_person = "select  * from  person_main where  status='0' ";
$dbquery_person = mysql_query($sql_person);
While ($result_person = mysql_fetch_array($dbquery_person)){
$fullname=$result_person['prename'].$result_person['name']." ".$result_person['surname'];
$person_ar[$result_person['person_id']]=$fullname;
}

$sql="select * from permission_main where id='$_GET[id]'";
$dbquery = mysql_query($sql);
$ref_result = mysql_fetch_array($dbquery);
$id=$ref_result['id'];
$person_id=$ref_result['person_id'];
$ref_id=$ref_result['ref_id'];
$file=$ref_result['document'];
$grant_person_selected=$ref_result['grant_person_selected'];
$comment_person=$ref_result['comment_person'];
$grant_person=$ref_result['grant_person'];
$report=$ref_result['report'];
$rec_date=$ref_result['rec_date'];
echo "<Br>";
echo "<Table  align='center' width='80%' Border='0'>";
echo "<Tr ><Td colspan='2' align='right'><INPUT TYPE='button' name='smb' value='<<กลับหน้าก่อน' onclick='location.href=\"?option=permission&task=main/report_1&datepicker_2=$_GET[datepicker_2]\"'></Td></Tr>";

echo "<Tr align='left'><Td align='right' width='50%'>เลขที่&nbsp;&nbsp;</Td><Td>$ref_result[id]</Td></Tr>";
echo "<Tr align='left'><Td align='right' width='50%'>ผู้ขออนุญาต&nbsp;&nbsp;</Td><Td>$person_ar[$person_id]</Td></Tr>";
echo "<Tr align='left'><Td align='right'>วันที่ขออนุญาต&nbsp;&nbsp;</Td><Td>";
echo thai_date_4($rec_date);
echo "</Td></Tr>";
echo "<Tr align='left'><Td align='right'>เรื่องไปราชการ&nbsp;&nbsp;</Td><Td>$ref_result[subject]</Td></Tr>";

echo "<Tr align='left'><Td align='right'>สถานที่&nbsp;&nbsp;</Td><Td>$ref_result[place]</Td></Tr>";

	$sql_date="select * from permission_date where ref_id='$ref_id' order by date";
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

echo "</Table>";

echo "<table width='500'><tr><td>";
echo "<fieldset>";
echo "<legend>&nbsp;<B>ส่วนความเห็นของผู้บังคับบัญชาขั้นต้น</B>: &nbsp;</legend>";
echo "<table>";
$thai_date_comment=thai_date_4($ref_result['comment_date']);
echo "<Tr align='left'><Td align='right' width='50%'>ความเห็นของผู้บังคับบัญชาขั้นต้น&nbsp;&nbsp;</Td><Td>$ref_result[comment]</Td></Tr>";
echo "<Tr align='left'><Td align='right' width='50%'>ลงชื่อ&nbsp;&nbsp;</Td><Td>";
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
echo "ไม่อนุมัติ";
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

//ส่วนแสดงผล
if(!($index==7)){

echo "<table width='99%' border='0' align='center'>";
?>
	<link rel="stylesheet" type="text/css" media="all" href="./modules/work/css.css">
	<link rel="stylesheet" href="./jquery/themes/ui-lightness/jquery.ui.all.css">
	<script src="./jquery/jquery-1.5.1.js"></script>
	<script src="./jquery/ui/jquery.ui.core.js"></script>
	<script src="./jquery/ui/jquery.ui.widget.js"></script>
	<script src="./jquery/ui/jquery.ui.datepicker.js"></script>
	<script>
	$(function() {
		$( "#datepicker" ).datepicker({
			showButtonPanel: true,
			dateFormat: 'dd-mm-yy',
			changeMonth: true,
			changeYear: true,
			monthNamesShort: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'],
			dayNamesMin: ['อา','จ','อ','พ','พฤ','ศ','ส'],
			onSelect:function(dateText){  document.frmSearchDate.submit();}
		});
	});
	</script>
<tr align='center'>
	<td  align=left>
	</td>
	<td align=right  id=no_print>
<FORM name=frmSearchDate METHOD=GET>
<INPUT TYPE="hidden" name=option value="permission">
<INPUT TYPE="hidden" name=task value="main/report_1">
เลือกวันที่ <input type="text" id="datepicker" name=datepicker value=<?php echo (isset($_GET['datepicker']))? $_GET['datepicker']:date("d-m-Y");?>  readonly Size=10>
</FORM>
	</td>
</tr>
</table>
<?php

$sql = "select permission_main.id, permission_main.person_id, permission_main.subject, permission_main.place, permission_main.vehicle, permission_main.ref_id, permission_main.document, permission_main.comment, permission_main.grant_x, permission_main.report,permission_main.rec_date,permission_date.date,permission_main.grant_comment from permission_date left join permission_main on permission_date.ref_id=permission_main.ref_id where permission_date.date='$f2_date' order by permission_main.id ";
$dbquery = mysql_query($sql);

echo  "<table width='98%' border='0' align='center'>";

echo "<Tr bgcolor='#FFCCCC' align='center'><Td width='60'>ที่</Td><Td>เลขที่</Td><Td width='120'>ผู้ขออนุญาต</Td><Td width='100'>วันขออนุญาต</Td><Td>เรื่องราชการ</Td><Td>สถานที่</Td><Td width='100'>วันไปราชการ</Td><Td width='100'>พาหนะ</Td><Td width='50'>เอกสาร</Td><Td width='50'>อนุมัติ</Td><Td width='50'>รายงาน</Td><Td width='50'>รายละเอียด</Td></Tr>";

$N=1; 
$M=1;

While ($result = mysql_fetch_array($dbquery)){
		$id = $result['id'];
		$person_id = $result['person_id'];		
		$subject = $result['subject'];
		$place = $result['place'];
		$vehicle = $result['vehicle'];
		$ref_id = $result['ref_id'];
		$file = $result['document'];
		$comment = $result['comment'];
		$grant = $result['grant_x'];
		$report = $result['report'];
		$rec_date = $result['rec_date'];
			if(($M%2) == 0)
			$color="#FFFFB";
			else  	$color="#FFFFFF";

echo "<Tr bgcolor='$color'><Td valign='top' align='center'>$M</Td><td align='center'>$id</td>";

$sql_person = "select * from  person_main where person_id='$person_id' ";
$dbquery_person = mysql_query($sql_person);
$result_person = mysql_fetch_array($dbquery_person);
$fullname=$result_person['prename'].$result_person['name']." ".$result_person['surname'];
echo "</Td><Td valign='top' align='left'>$fullname</Td>";
echo "<Td valign='top' align='left'>";
echo thai_date_3($rec_date);
echo "</Td><Td valign='top' align='left'>$subject</Td><Td valign='top' align='left'>$place</Td>";

$date = $result['date'];
$date=thai_date_3($date);
echo "<Td valign='top' align='left'>$date</Td>";

echo "<Td valign='top' align='left'>$vehicle</Td>";
if($file!=""){
echo   "<Td valign='top' align='center'><a href='$file' target=_blank><IMG SRC='images/b_browse.png' width='16' height='16' border=0 alt='เอกสาร'></a></td>";
}
else{
echo "<Td valign='top' align='left'></Td>";
}
echo "<Td valign='top' align='center'>";
if($grant==1){
echo "<img src=images/yes.png border='0'><br>$result[grant_comment]";
}
else if($grant==2){
echo "<img src=images/no.png border='0'><br>$result[grant_comment]";
}
else{
echo "รออนุมัติ";
}
echo "</Td>";
echo "<Td valign='top' align='center'>";
if($report!=""){
echo "<img src=images/yes.png border='0'>";
}
else{
echo "<img src=images/no.png border='0'>";
}
echo "</Td>";


echo "<Td valign='top' align='center'><a href=?option=permission&task=main/report_1&index=7&id=$id&datepicker_2=$f2_date><img src=images/browse.png border='0' alt='รายละเอียด'></Td>";
echo "</Tr>";

$M++;
$N++;  
}	
echo "</Table>";
}

?>
