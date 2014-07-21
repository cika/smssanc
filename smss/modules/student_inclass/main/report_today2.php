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
	<font color='#006666' size='3'><strong>ประจำ<?php echo ($_GET[datepicker])?thai_date(strtotime($_GET[datepicker])):thai_date(time());?></strong></font>
	</td>
	<td align=right  id=no_print>
<FORM name=frmSearchDate METHOD=GET ACTION="?option=<?php echo $_GET[option];?>&task=main/report_today">
<INPUT TYPE="hidden" name=option value="<?php echo $_GET[option];?>">
<INPUT TYPE="hidden" name=task value="main/report_today">
เลือกวันที่ <input type="text" id="datepicker" name=datepicker value=<?php echo ($_GET[datepicker]!="")?$_GET[datepicker]:date("d-m-Y");?>  readonly Size=10> <INPUT TYPE="image" src="./modules/<?php echo "$_GET[option]";?>/images/b_search.png">
</FORM>
	</td>
</tr>
<?php
echo "</table>";
}
//ส่วนแสดงผล List รายชื่อห้อง
if(!(($index==1) or ($index==2) or ($index==5))){
$sql="SELECT `student_main`.`class_now` FROM student_main ";
$sql=$sql."GROUP BY `student_main`.`class_now`   ";
$dbquery = mysql_db_query($dbname, $sql);
echo  "<table width=100% border=0 align=center margin=0 padding=0>";
echo "<Tr bgcolor='#FFCCCC'>
			<Td  align='center' style='font-weight:bold' rowspan=2 width='25'>ที่</Td>
				<Td  align='center' style='font-weight:bold' rowspan=2 width='120'>ห้องเรียน</Td>
				<Td  align='center' style='font-weight:bold' rowspan=2 width='50'>จำนวน<BR>นักเรียน</Td>
				<Td  align='center' style='font-weight:bold' colspan=$num_period>คาบที่</Td>
				<!--Td  align='center' style='font-weight:bold' colspan=$num_period>ร้อยละ</Td-->
				<Td  align='center' style='font-weight:bold' rowspan=2 width='45' id='no_print'>รายละเอียด</Td>
			</Tr>";
?>
<TR bgcolor='#FFCCCC'>
<?php	for($t=0;$t<$num_period;$t++)
		{
			echo "<TD align=center ><B>".($t+1)."<BR><font size=1>เข้า:<font color=red>ไม่เข้า</font></font></B></TD>\n";
		}
		?>
<?php	for($t=0;$t<$num_period;$t++)
		{
			echo "<!--TD align=center width='50'><B>".($t+1)."<BR><font size=1>เข้า:<font color=red>ไม่เข้า</font></font></B></TD-->\n";
		}
		?>
</TR>
<?php

$N=1;
$M=1;
$student_totals=0;
if(@mysql_num_rows($dbquery)>0){
While ($result = mysql_fetch_array($dbquery))
	{
		$class_now= $result['class_now'];
		$edu_name=$edu_level[$result['class_now']];

	for($t=0;$t<$num_period;$t++)
		{
			$Cnums_class[$class_now][$t]=0;
			$Lnums_class[$class_now][$t]=0;
		}

	$sub_sql="SELECT `student_main`.`class_now` , `student_main`.`room` FROM student_main ";
	$sub_sql=$sub_sql." Where   `student_main`.`class_now`=$class_now ";
	$sub_sql=$sub_sql." GROUP BY `student_main`.`class_now` , `student_main`.`room` ";
	$sub_query = mysql_db_query($dbname, $sub_sql);
	$student_nums=0;
	While ($sub_result = mysql_fetch_array($sub_query))
			{
		$room_now=$sub_result['room'];
		$rn=($room_now=="" || $room_now==0)?"":"/".$room_now;
$check_date=($_GET[datepicker]=="")?date("d-m-Y"):$_GET[datepicker];
$d=explode("-",$check_date);		$save_pic="";
$check_date=$d[2]."-".$d[1]."-".$d[0];
#task=main/report_room&index=2&class_now=10&room_now=1&datepicker=2011-07-21
		#$report_pic="<a href=?option=student_check&task=main/report_room&index=2&class_now=$class_now&room_now=$room_now&datepicker=".$check_date."><img src=images/browse.png border='0' title='ดูรายงานข้อมูลการมาเรียนของห้องเรียนนี้' alt='ดูรายงานข้อมูลการมาเรียนของห้องเรียนนี้'></a>";
#เรียกจำนวนนักเรียน
$sql_count="SELECT COUNT(student_id) AS STD_NUMS FROM student_main WHERE `student_main`.`class_now`=$class_now  and `student_main`.`room`=$room_now"; 
$result_conut = mysql_fetch_array(mysql_db_query($dbname, $sql_count));
				$color=(($M%2) == 0)?" class='even'":" class='odd'";
				echo "<Tr $color>
				<Td align='center' width='35'>$N</Td>
				<Td  align='center'>$edu_name$rn</Td>
				<Td  align='center'>$result_conut[STD_NUMS]</Td>";
#		$a_val=array("0" => "C", "1" => "W", "2" => "S", "3" => "L");
$check_date=($_GET[datepicker]=="")?date("d-m-Y"):$_GET[datepicker];
$d=explode("-",$check_date);
$check_date=$d[2]."-".$d[1]."-".$d[0];
$per=array();
$per="";

$sql_val="Select * from student_inclass_main Where check_date='$check_date' and class_now=$class_now and room_now=$room_now AND student_check_year='$year_active'";
$query_val=mysql_db_query($dbname,$sql_val);
	for($t=0;$t<$num_period;$t++)
		{
			$Cnums[$t]=0;
			$Lnums[$t]=0;
		}

				while($rsNums =mysql_fetch_array($query_val))
						{
						$tmp="";
						$tmp=explode(",",$rsNums[check_val]);
						for($countTmp=0;$countTmp<count($tmp);$countTmp++)
							{
								$tmpC=explode(":",$tmp[$countTmp]);
								$Cnums[$countTmp]=($tmpC[1]=="C")?$Cnums[$countTmp]+1:$Cnums[$countTmp]+0;
								$Lnums[$countTmp]=($tmpC[1]!="C" && $tmpC[1]!="T")?$Lnums[$countTmp]+1:$Lnums[$countTmp]+0;
						$Cnums_class[$class_now][$t]=($tmpC[1]=="C")?$Cnums[$countTmp]+1:$Cnums[$countTmp]+0;
						$Lnums_class[$class_now][$t]=($tmpC[1]!="C" && $tmpC[1]!="T")?$Lnums[$countTmp]+1:$Lnums[$countTmp]+0;
							}
						}

	for($t=0;$t<$num_period;$t++)
		{
			echo "<TD><CENTER><B><FONT COLOR=DARKGREEN>$Cnums[$t] (00.0%)</FONT>:<FONT COLOR=red>$Lnums[$t] (00.0%)</FONT></B></CENTER></TD>\n";
			$Cnums_class[$class_now][$t]+=$Cnums[$t];
			$Lnums_class[$class_now][$t]+=$Lnums[$t];
		}

	for($t=0;$t<$num_period;$t++)
		{
			echo "<!--TD></TD-->\n";
		}

				echo"<Td align='center' id='no_print'>			$save_pic 			$report_pic			</Td>
			</Tr>";
$student_nums=$student_nums+$result_conut[STD_NUMS];
		$M++;
		$N++;  //
		}
#รวมแต่ละระดับชั้น
				echo "<Tr bgcolor=#CCFFFF>
				<Td  align='right' colspan=2><B>รวม $edu_name &nbsp;&nbsp;</B></Td>
				<Td  align='center'><B>$student_nums &nbsp;</B></Td>";
	for($t=0;$t<$num_period;$t++)
		{
			echo "<TD><B><CENTER>".$Cnums_class[$class_now][$t]."  : ".$Lnums_class[$class_now][$t]." <BR>(00.0%) : (00.0%)</CENTER></B></TD>\n";
			$aCnums_class[$t]+=			$Cnums_class[$class_now][$t];
			$aLnums_class[$t]+=			$Lnums_class[$class_now][$t];
		}

	for($t=0;$t<$num_period;$t++)
		{
			echo "<!--TD></TD-->\n";
		}

				echo "<Td align='center' id='no_print'></Td>
			</Tr>";
$student_totals=$student_totals+$student_nums;
	}
				echo "<Tr  bgcolor=#6666FF>
				<Td  align='right' colspan=2><B>รวมทั้งหมด&nbsp;&nbsp;</B></Td>
				<Td  align='center'><B>".number_format($student_totals,0)." </B>&nbsp;</Td>";
	for($t=0;$t<$num_period;$t++)
		{
			echo "<TD><B><CENTER>".$aCnums_class[$t]." : ".$aLnums_class[$t]." <BR>(00.0%) : (00.0%)</CENTER></B></TD>\n";
		}

	for($t=0;$t<$num_period;$t++)
		{
			echo "<!--TD></TD-->\n";
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
?>
<FONT SIZE="2" COLOR="#FF0000">ไม่มา หมายถึง </FONT>
</div>
<a href="javascript:printContentDiv('lblPrint');"><img src="./modules/<?=$_GET[option];?>/images/b_print.png" border=0> พิมพ์หน้านี้</a>