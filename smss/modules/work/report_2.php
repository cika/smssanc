<script language='javascript'>
//<!–
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
if(!($_SESSION['login_status']<=5)){
exit();
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

//แปลงรูปแบบ date
if(isset($_GET['datepicker'])){
$f1_date=explode("-", $_GET['datepicker']);
$start_date=$f1_date[2]."-".$f1_date[1]."-"."01";
$end_date=$f1_date[2]."-".$f1_date[1]."-"."31";
$thai_month=$thai_month_arr[$f1_date[1]];
$thai_year=$f1_date[2]+543;
$date_input_tag="$thai_month.$thai_year";
}
else{
$f1_date=date("Y-m-d");
$f1_date=explode("-", $f1_date);
$start_date=$f1_date[0]."-".$f1_date[1]."-"."01";
$end_date=$f1_date[0]."-".$f1_date[1]."-"."31";
$thai_month=$thai_month_arr[$f1_date[1]];
$thai_year=$f1_date[0]+543;
$date_input_tag="$thai_month.$thai_year";
}

echo "<br />";
echo "<table width='99%' border='0' align='center'>";
echo "<tr align='center'><td colspan=2><font color='#006666' size='3'><strong>การปฏิบัติราชการเดือน$thai_month พ.ศ.$thai_year</strong></font></td></tr>";
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
<INPUT TYPE="hidden" name=option value="work">
<INPUT TYPE="hidden" name=task value="report_2">
เลือกเดือนปี <input type="text" id="datepicker" name=datepicker value=<?php echo $date_input_tag ?>  readonly Size=10>
</FORM>
	</td>
</tr>

<?php
echo "</table>";

//ส่วนรายละเอียด

$sql_post = "select * from  person_position";
$dbquery_post = mysql_query($sql_post);
While ($result_post = mysql_fetch_array($dbquery_post)){
$position_ar[$result_post['position_code']]=$result_post['position_name'];
}

$sql_name = "select * from person_main order by position_code,person_order";
$dbquery_name = mysql_query($sql_name);
While ($result_name = mysql_fetch_array($dbquery_name)){
		$person_id = $result_name['person_id'];
		$prename=$result_name['prename'];
		$name= $result_name['name'];
		$surname = $result_name['surname'];
		$position_code = $result_name['position_code'];
$full_name_ar[$person_id]="$prename$name&nbsp;&nbsp;$surname";
$position_code_ar[$person_id]=$position_code;
}

$sql_work = "select distinct work_main.person_id from work_main left join person_main on work_main.person_id=person_main.person_id where work_main.work_date between '$start_date' and '$end_date' order by  person_main.position_code, person_main.person_order";

$dbquery_work = mysql_query($sql_work);
$num_rows=mysql_num_rows($dbquery_work);

if($num_rows<1){
echo "<div align='center'><font color='#CC0000' size='3'>ไม่มีรายการ</font></div>";
echo exit();
}
echo  "<table width='98%' border='0' align='center'>";
echo "<Tr bgcolor='#FFCCCC' align='center'><Td width='50'>ที่</Td>";
echo "<Td>ชื่อ</Td><Td>ตำแหน่ง</Td><Td width='40' bgcolor='#CCFFFF'>มา</Td><Td width='40'>ไปราชการ</Td><Td width='40' bgcolor='#CCFFFF'>ลาป่วย</Td><Td width='40'>ลากิจ</Td><Td width='40' bgcolor='#CCFFFF'>ลาพักผ่อน</Td><Td width='40'>ลาคลอด</Td><Td width='40' bgcolor='#CCFFFF'>ลาอื่นๆ</Td><Td width='40'>มาสาย</Td><Td width='40' bgcolor='#CCFFFF'>ไม่มา</Td></Tr>";

$N=1;
While ($result_work = mysql_fetch_array($dbquery_work)){
		$person_id = $result_work['person_id'];
		
						if(($N%2) == 0)
						$color="#FFFFC";
						else  	$color="#FFFFFF";
						
$work_1_sum=0; $work_2_sum=0; $work_3_sum=0;	$work_4_sum=0;	$work_5_sum=0;	$work_6_sum=0;	$work_7_sum=0;	$work_8_sum=0;	$work_9_sum=0;		
	
			$sql = "select  work from work_main where person_id='$person_id' and work_date between '$start_date' and '$end_date' ";
			$dbquery= mysql_query($sql);
			While ($result = mysql_fetch_array($dbquery)){
			if($result['work']==1){
			$work_1_sum=$work_1_sum+1;
			}
			else if($result['work']==2){
			$work_2_sum=$work_2_sum+1;
			
			}
			else if($result['work']==3){
			$work_3_sum=$work_3_sum+1;
			}			
			else if($result['work']==4){
			$work_4_sum=$work_4_sum+1;
			}			
			else if($result['work']==5){
			$work_5_sum=$work_5_sum+1;
			}			
			else if($result['work']==6){
			$work_6_sum=$work_6_sum+1;
			}			
			else if($result['work']==7){
			$work_7_sum=$work_7_sum+1;
			}			
			else if($result['work']==8){
			$work_8_sum=$work_8_sum+1;
			}			
			else if($result['work']==9){
			$work_9_sum=$work_9_sum+1;
			}			
			}			

echo "<tr bgcolor='$color'>";
echo "<td align='center'>$N</td><td>";
if($full_name_ar[$person_id]!=""){
echo "<a href='modules/work/report_3.php?person_id=$person_id&start_date=$start_date&end_date=$end_date' target='_blank'>$full_name_ar[$person_id]</a>";
}
else{
echo "<a href='modules/work/report_3.php?person_id=$person_id&start_date=$start_date&end_date=$end_date' target='_blank'>ไมมีรายชื่อ($person_id)</a>";
}
echo"</td>";
echo "<td>";
echo $position_ar[$position_code_ar[$person_id]];
echo "</td>";
if($work_1_sum==0){
$work_1_sum="";
}
if($work_2_sum==0){
$work_2_sum="";
}
if($work_3_sum==0){
$work_3_sum="";
}
if($work_4_sum==0){
$work_4_sum="";
}
if($work_5_sum==0){
$work_5_sum="";
}
if($work_6_sum==0){
$work_6_sum="";
}
if($work_7_sum==0){
$work_7_sum="";
}
if($work_8_sum==0){
$work_8_sum="";
}
if($work_9_sum==0){
$work_9_sum="";
}

echo "<td align='center' bgcolor='#CCFFFF'>$work_1_sum</td><td align='center'>$work_2_sum</td><td align='center' bgcolor='#CCFFFF'>$work_3_sum</td><td align='center'>$work_4_sum</td><td align='center' bgcolor='#CCFFFF'>$work_5_sum</td><td align='center'>$work_6_sum</td><td align='center' bgcolor='#CCFFFF'>$work_7_sum</td><td align='center'>$work_8_sum</td><td align='center' bgcolor='#CCFFFF'>$work_9_sum</td>";
echo "</tr>";
$N++;
}
echo "</table>";
?>

</div>
<br />
<a href="javascript:printContentDiv('lblPrint');"><img src="images/b_print.png" border=0> พิมพ์หน้านี้</a>