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

require_once "modules/work/time_inc.php";	

//แปลงรูปแบบ date
if(isset($_GET['datepicker'])){
$f1_date=explode("-", $_GET['datepicker']);
$f2_date=$f1_date[2]."-".$f1_date[1]."-".$f1_date[0];  //ปี เดือน วัน
}
else{
$f2_date=date("Y-m-d");
}

$thai_date=thai_date($f2_date);
echo "<br />";
echo "<table width='99%' border='0' align='center'>";
echo "<tr align='center'><td colspan=2><font color='#006666' size='3'><strong>การปฏิบัติราชการ $thai_date</strong></font></td></tr>";
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
<INPUT TYPE="hidden" name=task value="report_1">
เลือกวันที่ <input type="text" id="datepicker" name=datepicker value=<?php echo (isset($_GET['datepicker']))? $_GET['datepicker']:date("d-m-Y");?>  readonly Size=10>
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

$sql_work = "select work_main.person_id, work_main.work from work_main left join person_main on work_main.person_id=person_main.person_id where work_main.work_date='$f2_date' order by person_main.position_code, person_main.person_order";

$dbquery_work = mysql_query($sql_work);
$num_rows=mysql_num_rows($dbquery_work);

if($num_rows<1){
echo "<div align='center'><font color='#CC0000' size='3'>ไม่มีรายการ</font></div>";
echo exit();
}
echo  "<table width='98%' border='0' align='center'>";
echo "<Tr bgcolor='#FFCCCC' align='center'><Td width='50'>ที่</Td>";
echo "<Td>ชื่อ</Td><Td>ตำแหน่ง</Td><Td>มา</Td><Td>ไปราชการ</Td><Td>ลาป่วย</Td><Td>ลากิจ</Td><Td>ลาพักผ่อน</Td><Td>ลาคลอด</Td><Td>ลาอื่นๆ</Td><Td>มาสาย</Td><Td>ไม่มา</Td></Tr>";
$N=1;
$work_1_sum=0; $work_2_sum=0; $work_3_sum=0;	$work_4_sum=0;	$work_5_sum=0;	$work_6_sum=0;	$work_7_sum=0;	$work_8_sum=0;	$work_9_sum=0;		

While ($result_work = mysql_fetch_array($dbquery_work)){
		$person_id = $result_work['person_id'];
		
						if(($N%2) == 0)
						$color="#FFFFC";
						else  	$color="#FFFFFF";
						
$work_1=""; $work_2=""; $work_3="";	$work_4="";	$work_5="";	$work_6="";	$work_7="";	$work_8="";	$work_9="";		

if($result_work['work']==1){
$work_1="มา";
$work_1_sum=$work_1_sum+1;
}
else if($result_work['work']==2){
$work_2="ไปราชการ";
$work_2_sum=$work_2_sum+1;

}
else if($result_work['work']==3){
$work_3="ลาป่วย";
$work_3_sum=$work_3_sum+1;
}			
else if($result_work['work']==4){
$work_4="ลากิจ";
$work_4_sum=$work_4_sum+1;
}			
else if($result_work['work']==5){
$work_5="ลาพักผ่อน";
$work_5_sum=$work_5_sum+1;
}			
else if($result_work['work']==6){
$work_6="ลาคลอด";
$work_6_sum=$work_6_sum+1;
}			
else if($result_work['work']==7){
$work_7="ลาอื่นๆ";
$work_7_sum=$work_7_sum+1;
}			
else if($result_work['work']==8){
$work_8="มาสาย";
$work_8_sum=$work_8_sum+1;
}			
else if($result_work['work']==9){
$work_9="ไม่มา";
$work_9_sum=$work_9_sum+1;
}			
		
echo "<tr bgcolor='$color'>";
echo "<td align='center'>$N</td><td>";
if($full_name_ar[$person_id]!=""){
echo $full_name_ar[$person_id];
}
else{
echo "ไมมีรายชื่อ($person_id)";
}
echo"</td>";
echo "<td>";
echo $position_ar[$position_code_ar[$person_id]];
echo "</td>";
echo "<td align='center'>$work_1</td><td align='center'>$work_2</td><td align='center'>$work_3</td><td align='center'>$work_4</td><td align='center'>$work_5</td><td align='center'>$work_6</td><td align='center'>$work_7</td><td align='center'>$work_8</td><td align='center'>$work_9</td>";
echo "</tr>";
$N++;
}
echo "<tr bgcolor='#FFCCCC' align='center'>";
echo "<td colspan='3'>รวม</td><td>$work_1_sum</td><td>$work_2_sum</td><td>$work_3_sum</td><td>$work_4_sum</td><td>$work_5_sum</td><td>$work_6_sum</td><td>$work_7_sum</td><td>$work_8_sum</td><td>$work_9_sum</td>";
echo "</tr>";
$work_sum_total=$work_1_sum+$work_2_sum+$work_3_sum+$work_4_sum+$work_5_sum+$work_6_sum+$work_7_sum+$work_8_sum+$work_9_sum;
$percent_work_1=($work_1_sum/$work_sum_total)*100;
$percent_work_1=number_format($percent_work_1,2);
$percent_work_2=($work_2_sum/$work_sum_total)*100;
$percent_work_2=number_format($percent_work_2,2);
$percent_work_3=($work_3_sum/$work_sum_total)*100;
$percent_work_3=number_format($percent_work_3,2);
$percent_work_4=($work_4_sum/$work_sum_total)*100;
$percent_work_4=number_format($percent_work_4,2);
$percent_work_5=($work_5_sum/$work_sum_total)*100;
$percent_work_5=number_format($percent_work_5,2);
$percent_work_6=($work_6_sum/$work_sum_total)*100;
$percent_work_6=number_format($percent_work_6,2);
$percent_work_7=($work_7_sum/$work_sum_total)*100;
$percent_work_7=number_format($percent_work_7,2);
$percent_work_8=($work_8_sum/$work_sum_total)*100;
$percent_work_8=number_format($percent_work_8,2);
$percent_work_9=($work_9_sum/$work_sum_total)*100;
$percent_work_9=number_format($percent_work_9,2);



echo "<tr bgcolor='#FFCCCC' align='center'>";
echo "<td colspan='3'>%</td><td>$percent_work_1%</td><td>$percent_work_2%</td><td>$percent_work_3%</td><td>$percent_work_4%</td><td>$percent_work_5%</td><td>$percent_work_6%</td><td>$percent_work_7%</td><td>$percent_work_8%</td><td>$percent_work_9%</td>";
echo "</tr>";

echo "</table>";
?>

</div>

<a href="javascript:printContentDiv('lblPrint');"><img src="images/b_print.png" border=0> พิมพ์หน้านี้</a>