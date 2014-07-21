<script language='javascript'>
//<!–
document.title = "SMSS:สถิติการมาเรียนของนักเรียน";
function printContentDiv(content){
var printReady = document.getElementById(content);
//var txt= 'nn';
var txt= '';

if (document.getElementsByTagName != null){
var txtheadTags = document.getElementsByTagName('head');
if (txtheadTags.length > 0){
var str=txtheadTags[0].innerHTML;
txt += str; // str.replace(/funChkLoad();/ig, ” “);
}
}
//txt += 'nn';
if (printReady != null){
txt += printReady.innerHTML;
}
//txt +='nn';
var printWin = window.open();
printWin.document.open();
printWin.document.write(txt);
printWin.document.close();
printWin.print();
}
// –>
</script>

<div id="lblPrint">
<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
//sd page 
include "modules/$_REQUEST[option]/inc.php";?>
<?php
echo "<br />";
if(!(($index==1) or ($index==2) or ($index==5))){
echo "<table width='99%' border='0' align='center'>";
echo "<tr align='center'><td colspan=2><font color='#006666' size='3'><strong>สถิติการมาเรียนของนักเรียน</strong></font></td></tr>";
?>
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
	<font color='#006666' size='3'><strong>ประจำ<?php echo (@$_GET[datepicker])?thai_date(strtotime(@$_GET[datepicker])):thai_date(time());?></strong></font>
	</td>
	<td align=right  id=no_print>
<FORM name=frmSearchDate METHOD=GET ACTION="?option=student_check&task=main/report_today">
<INPUT TYPE="hidden" name=option value="student_check">
<INPUT TYPE="hidden" name=task value="main/report_today">
เลือกวันที่ <input type="text" id="datepicker" name=datepicker value=<?php echo (@$_GET[datepicker]!="")?@$_GET[datepicker]:date("d-m-Y");?>  readonly Size=10> <INPUT TYPE="image" src="./modules/<?php echo "$_GET[option]";?>/images/b_search.png">
</FORM>
	</td>
</tr>
<?php
echo "</table>";
}
//ส่วนแสดงผล List รายชื่อห้อง
if(!(($index==1) or ($index==2) or ($index==5))){
$sql="SELECT `student_main`.`class_now` FROM student_main where status='0' ";
$sql=$sql."GROUP BY `student_main`.`class_now`   ";
@$dbquery = mysql_query( $sql);
echo  "<table width=99% border=0 align=center>";
echo "<Tr bgcolor='#FFCCCC'>
			<Td  align='center' style='font-weight:bold' rowspan=2>ที่</Td>
				<Td  align='center' style='font-weight:bold' rowspan=2>ห้องเรียน</Td>
				<Td  align='center' style='font-weight:bold' rowspan=2 width='120'>จำนวนนักเรียน</Td>
				<Td  align='center' style='font-weight:bold' rowspan=2 width='7%'>มา</Td>
				<Td  align='center' style='font-weight:bold' rowspan=2 width='7%'>ลา</Td>
				<Td  align='center' style='font-weight:bold' rowspan=2 width='7%'>ป่วย</Td>
				<Td  align='center' style='font-weight:bold' rowspan=2 width='7%'>ขาด</Td>
				<Td  align='center' style='font-weight:bold' colspan=4 >ร้อยละ</Td>
				<Td  align='center' style='font-weight:bold' rowspan=2 width='100' id='no_print'>รายละเอียด</Td>
			</Tr>";
echo "<Tr bgcolor='#FFCCCC'>
				<Td  align='center' style='font-weight:bold' width='7%'>มา</Td>
				<Td  align='center' style='font-weight:bold' width='7%'>ลา</Td>
				<Td  align='center' style='font-weight:bold' width='7%'>ป่วย</Td>
				<Td  align='center' style='font-weight:bold' width='7%'>ขาด</Td>
			</Tr>";
$N=1;
$M=1;
$student_totals=0;
if(@mysql_num_rows($dbquery)>0){
While ($result = mysql_fetch_array($dbquery))
	{
		$class_now= $result['class_now'];
		$edu_name=$edu_level[$result['class_now']];
	$sub_sql="SELECT `student_main`.`class_now` , `student_main`.`room` FROM student_main ";
	$sub_sql=$sub_sql." Where  status='0' and `student_main`.`class_now`=$class_now ";
	$sub_sql=$sub_sql." GROUP BY `student_main`.`class_now` , `student_main`.`room` ";
	$sub_query = mysql_query( $sub_sql);
	$student_nums=0;
	While ($sub_result = mysql_fetch_array($sub_query))
			{
		$room_now=$sub_result['room'];
		$rn=($room_now=="" || $room_now==0)?"":"/".$room_now;
$check_date=(isset($_GET['datepicker'])=="")?date("d-m-Y"):$_GET['datepicker'];
$d=explode("-",$check_date);		$save_pic="";
$check_date=$d[2]."-".$d[1]."-".$d[0];
#task=main/report_room&index=2&class_now=10&room_now=1&datepicker=2011-07-21
		$report_pic="<a href=?option=student_check&task=main/report_room&index=2&class_now=$class_now&room_now=$room_now&datepicker=".$check_date."><img src=images/browse.png border='0' title='ดูรายงานข้อมูลการมาเรียนของห้องเรียนนี้' alt='ดูรายงานข้อมูลการมาเรียนของห้องเรียนนี้'></a>";
#เรียกจำนวนนักเรียน
$sql_count="SELECT COUNT(student_id) AS STD_NUMS FROM student_main WHERE status='0' and `student_main`.`class_now`=$class_now  and `student_main`.`room`=$room_now"; 
$result_conut = mysql_fetch_array(mysql_query( $sql_count));
				$color=(($M%2) == 0)?" class='even'":" class='odd'"; 
				echo "<Tr $color>
				<Td align='center' width='35'>$N</Td>
				<Td  align='center'>$edu_name$rn</Td>
				<Td  align='center'>$result_conut[STD_NUMS]</Td>";
#		$a_val=array("0" => "C", "1" => "W", "2" => "S", "3" => "L");
$check_date=(isset($_GET['datepicker'])=="")?date("d-m-Y"):$_GET['datepicker'];
$d=explode("-",$check_date);
$check_date=$d[2]."-".$d[1]."-".$d[0];
$per=array();
$per="";
for($q=0;$q<count($a_val);$q++){
	$sql_="Select * from student_check_main Where check_date='$check_date' and class_now=$class_now and room_now=$room_now and check_val='".$a_val[$q]."'";
	$nums=mysql_num_rows(mysql_query($sql_));
	$per[]=$nums;
	echo "<Td  align='right'> $nums  &nbsp;</Td>";
}
for($p=0;$p<count($per);$p++){
	echo "<Td  align='right'> ".number_format(round(($per[$p]/$result_conut['STD_NUMS'])*100,2),2)."&nbsp;</Td>";
}
				echo"<Td align='center' id='no_print'>			$save_pic 			$report_pic			</Td>
			</Tr>";
$student_nums=$student_nums+$result_conut['STD_NUMS'];
		$M++;
		$N++;  //
		}
#รวมแต่ละระดับชั้น
				echo "<Tr bgcolor=#CCFFFF>
				<Td  align='right' colspan=2><B>รวม $edu_name &nbsp;&nbsp;</B></Td>
				<Td  align='center'><B>$student_nums &nbsp;</B></Td>";
$per="";
for($q=0;$q<count($a_val);$q++){
	$sql_="Select * from student_check_main Where check_date='$check_date' and class_now=$class_now and check_val='".$a_val[$q]."'";
	$nums=mysql_num_rows(mysql_query($sql_));
	$per[]=$nums;
	echo "<Td  align='right' style='font-weight:bold'> $nums &nbsp;  </Td>";
}
for($p=0;$p<count($per);$p++){
	echo "<Td  align='right' style='font-weight:bold'> ".number_format(round(($per[$p]/$student_nums)*100,2),2)."&nbsp;</Td>";
}
				echo "<Td align='center' id='no_print'></Td>
			</Tr>";
$student_totals=$student_totals+$student_nums;
	}
				echo "<Tr $color>
				<Td  align='right' colspan=2><B>รวมทั้งหมด&nbsp;&nbsp;</B></Td>
				<Td  align='center'><B>".number_format($student_totals,0)." </B>&nbsp;</Td>";
$per="";
for(@$t=0;$t<count(@$a_val);$t++){
	$sql_="Select COUNT(student_id) as tnums from student_check_main Where check_date='$check_date' and check_val='".$a_val[$t]."'";
	$nums=mysql_fetch_assoc(mysql_query($sql_));
	$per[]=$nums['tnums'];
	echo "<Td  align='right' style='font-weight:bold'> $nums[tnums] &nbsp;</Td>";
}
for(@$p=0;$p<count($per);$p++){
	echo "<Td  align='right' style='font-weight:bold'> ".number_format(round(($per[$p]/$student_totals)*100,2),2)."&nbsp;</Td>";
}
				echo "<Td align='center' id='no_print'></Td>
			</Tr>";
echo "</Table>";
}else
	{
echo "
<tr>
	<td colspan=11 align=center><B><FONT SIZE=3 COLOR=RED>ไม่มีข้อมูลนักเรียน</FONT></B>
	</td>
</tr>
</Table>";
	}
}
?></div>
<a href="javascript:printContentDiv('lblPrint');"><img src="./modules/<?php echo @$_GET[option];?>/images/b_print.png" border=0> พิมพ์หน้านี้</a>