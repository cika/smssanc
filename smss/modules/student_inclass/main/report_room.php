<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
//sd page 

include "modules/$_REQUEST[option]/inc.php";
#
#ส่วนหัว
echo "<br />";
if(!(($index==1) or ($index==2) or ($index==5))){
echo "<table width='50%' border='0' align='center'>";
echo "<tr align='center'><td><font color='#006666' size='3'><strong>สถิติการมาเรียนของนักเรียน  ปีการศึกษา $txtyear_active</strong></font></td></tr>";
echo "</table>";
}

//แสดงรายวัน ของห้องที่เลือก
if($index==1){
$class_now=$_GET[class_now];
$room_now=$_GET[room_now];
$room=($room_now=="" || $room_now==0)?"":"/".$room_now;

$sql="SELECT `check_date`,`class_now`, `room_now` FROM `student_check_main` WHERE `class_now` =$class_now AND `room_now` =$room_now AND student_check_year='$year_active' GROUP BY `check_date`,`class_now`, `room_now` ";

$pagelen=50;  // 1_กำหนดแถวต่อหน้า
$url_link="option=student_check&task=main/report_room&index=1&class_now=$class_now&room_now=$room_now";  // 2_กำหนดลิงค์
$dbquery = mysql_db_query($dbname, $sql);
$num_rows = mysql_num_rows($dbquery );  
$totalpages=ceil($num_rows/$pagelen);
if($_REQUEST['page']==""){
$page=1;//$totalpages;
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

$start=(!$page)?0:($page-1)*$pagelen;

			$changePages="เลือก  <select onchange=\"location.href=this.options[this.selectedIndex].value;\" size=\"1\" name=\"select\">";
			$changePages==$changePages."<option  value=\"\">หน้า</option>";
				for($p=1;$p<=$totalpages;$p++){
					$seled=($p!=$page)?"":"selected";
					$changePages=$changePages."<option  value=\"?$url_link&page=$p\" $seled> หน้า $p </option>";
				}
			$changePages=$changePages."</select>";
$changePages=($totalpages==0)?"":$changePages;
echo "<table width='65%' border='0' align='center'>";
echo "<tr align='center'><td><font color='#006666' size='3'><strong>สถิติการมาเรียนของนักเรียน ".$edu_level[$class_now].$room."  ปีการศึกษา $txtyear_active</strong></font></td></tr>";
echo "</table>";

echo  "<table width=85% border=0 align=center>";
echo "<Tr>
				<td colspan=5><a href='./?option=student_check&task=main/report_room'><img src=images/arrow_left.gif border=0> กลับหน้ารายงานหลัก</a></td>
				<td colspan=3 align=right>$changePages</td>
			</tr>";
echo "<Tr bgcolor='#FFCCCC'>
				<Td  align='center' style='font-weight:bold;width:35px'>ที่</Td>
				<Td  align='center' style='font-weight:bold;'>วันที่</Td>
				<Td  align='center' style='font-weight:bold;width:100px'>จำนวนนักเรียน</Td>
				<Td  align='center' style='font-weight:bold;width:55px'>มาเรียน</Td>
				<Td  align='center' style='font-weight:bold;width:55px'>ลา</Td>
				<Td  align='center' style='font-weight:bold;width:55px'>ป่วย</Td>
				<Td  align='center' style='font-weight:bold;width:55px'>ขาด</Td>
				<Td  align='center' style='font-weight:bold;width:100px'>รายละเอียด</Td>
			</Tr>";
		$M=1;
		$N=(($page-1)*$pagelen)+1;  //
		$r=0;  //
$sql=$sql." ORDER BY check_date DESC LIMIT $start,$pagelen";
$query=mysql_db_query($dbname, $sql);
while($result = mysql_fetch_array($query))
{
		$color=(($M%2) == 0)?" class='even'":" class='odd'";
#		$a_val=array("0" => "C", "1" => "W", "2" => "S", "3" => "L");
		$nv=array();
		$nv="";
			for($q=0;$q<count($a_val);$q++)
			{
						$l="Select * From student_check_main Where check_date='".$result[check_date]."' AND class_now =$class_now AND room_now =$room_now AND check_val='".$a_val[$q]."' AND student_check_year='$year_active' ";
						$nv[$q]=	mysql_num_rows(mysql_db_query($dbname,$l));
			}
			$sv="";
			$all=0;
			for($i=0;$i<count($a_val);$i++) { $sv=$sv."<Td align='center'>".number_format($nv[$i],0)."</Td>"; $all=$all+$nv[$i];}

				echo "<Tr $color>
				<Td align='center'>$N</Td>
				<Td  align='left'>&nbsp;".thai_date(strtotime($result[check_date]))."</Td>
				<Td  align='center'>$all</Td>
					$sv
				<Td  align='center'><a href='?option=student_check&task=main/report_room&index=2&class_now=$class_now&room_now=$room_now&datepicker=$result[check_date]'><img src='images/browse.png' border=0></a></Td>";
			echo "</Tr>";
		$M++;
		$N++;  //
		$r++;  //
}
echo  "</table>";
if($r==0){
		echo '<BR><center><FONT SIZE="4" COLOR="#FF0000"><B>ยังไม่มีรายการบันทึกข้อมูล</B></FONT></center>';
}
}
//ส่วนฟอร์มรายชื่อนักเรียน เตรียมบันทึกข้อมูล
if($index==2) {
	$class_now=$_GET[class_now];
	$room_now=$_GET[room_now];
	$edu_type=$_GET[edu_type];
	$datepicker=$_GET[datepicker];
	$room_now=($room_now=="" || $room_now==0)?"":"/".$room_now;
echo "<table width='90%' border='0' align='center'>\n";
echo "<tr><td align='center'><font color='#990000' size='4'>รายละเอียดการมาเรียนของนักเรียน ชั้น$edu_level[$class_now]$room_now   ปีการศึกษา $txtyear_active</font><br> <font color='#006666' size='4'>ประจำวันที่ 
".thai_date(strtotime($datepicker))."</font></td></tr>\n";
echo "<tr><td align=center>\n";
echo "</td></tr></table>";
$room_now=$_GET[room_now];

#แสดงรายชื่อของห้องที่เลือกมาครับ
	$sql="SELECT `student_check_main`.`check_date` , `student_check_main`.`student_id` , `student_check_main`.`class_now` , `student_check_main`.`room_now` , `student_check_main`.`check_val` , `student_main`.`prename` , `student_main`.`name` , `student_main`.`surname`,`student_main`.`status`,`student_main`.`student_number`
FROM student_check_main, student_main 
WHERE `student_check_main`.`student_id` = `student_main`.`student_id` 
AND `student_main`.`status` = '0' 
AND `student_check_main`.`check_date` = '$datepicker' 
AND `student_check_main`.`class_now` =$class_now 
AND `student_check_main`.`room_now` =$room_now 
AND student_check_main.student_check_year='$year_active' ORDER BY student_number";
$dbquery = mysql_db_query($dbname, $sql);
?>
<TABLE width='650' align=center>
<TR  bgcolor='#FFCCCC'>
	<TD width=25 align=center><B>ที่</B></TD>
	<TD width=140 align=center><B>รหัสประจำตัวนักเรียน</B></TD>
	<TD width=40 align=center><B>เลขที่</B></TD>
	<TD width=280 align=center><B>ชื่อ - สกุล</B></TD>
	<TD align=center><B>การมาเรียน</B></TD>
</TR>
<?php
$ss=0;
$M=1;
While ($result = mysql_fetch_array($dbquery))
	{
$ss++;
$color=(($M%2) == 0)?" class='even'":" class='odd'";
$chk="";
$chked="";
		echo "
<TR $color>
	<TD align=right>$M</TD>
	<TD align=center>$result[student_id]<INPUT TYPE=hidden name=student_id[] value=$result[student_id]></TD>
	<TD align=center>$result[student_number]</TD>
	<TD>$result[prename] $result[name]  $result[surname]</TD>";
	for($i=0;$i<count($a_val);$i++)
				{
				if($result[check_val]==$a_val[$i]){
					$chk=$a_val_txt[$i];
					$fc="class=".$a_val[$i];
				}
			}
			echo "<TD align=center $fc><B>$chk</B></TD>";
echo"</TR>";
$M++;
	}
$BT_BACK=($_POST[bt_save])?"<INPUT TYPE=\"button\" onclick='location.href=\"?option=student_check&task=main/check\"' value=กลับไปหน้ารายการ>":"<INPUT TYPE=\"button\" onclick='location.href=\"$refer\"' value=กลับไปหน้าที่แล้ว>";
$BT_Save="";
if(count($r_list)!=0){
	$sql=$sql." where ";
	for($r=0;$r<count($r_list);$r++){
	$rr=explode(",",$r_list[$r]);
	if($rr[0]==$class_now && $rr[1]==$room_now)
		{
			$BT_Save="<INPUT TYPE=\"submit\" name=bt_save value=' [ บันทึกข้อมูล ] ' >&nbsp;&nbsp;<INPUT TYPE=\"reset\" value=' [ รีเซ็ต ] '>";
		}
	}
}
if($ss==0)
{
echo '<TR><TD COLSPAN=4><BR><center><FONT SIZE="4" COLOR="#FF0000"><B>ยังไม่มีรายการบันทึกข้อมูล</B></FONT></center></TD></TR>';
$BT_Save="";}
echo "</TABLE>";
}
//ส่วนแสดงผล List รายชื่อห้อง
if(!(($index==1) or ($index==2) or ($index==5))){

$sql="SELECT `student_main`.`class_now` FROM student_main where status='0' ";
$sql=$sql."GROUP BY `student_main`.`class_now`   ";
$dbquery = mysql_db_query($dbname, $sql);#echo $sql;echo $page;
echo  "<table width=65% border=0 align=center>";
echo "<Tr bgcolor='#FFCCCC'>
				<Td  align='center' style='font-weight:bold'>ที่</Td>
				<Td  align='center' style='font-weight:bold'>ห้องเรียน</Td>
				<Td  align='center' style='font-weight:bold'>จำนวนนักเรียน</Td>
				<Td  align='center' style='font-weight:bold'>รายละเอียด</Td>
			</Tr>";
$N=1;
$M=1;
$student_totals=0;
While ($result = mysql_fetch_array($dbquery))
	{
		$class_now= $result['class_now'];
		$edu_name=$edu_level[$result['class_now']];

	$sub_sql="SELECT `student_main`.`class_now` , `student_main`.`room` FROM student_main ";
	$sub_sql=$sub_sql." where status='0' AND `student_main`.`class_now`=$class_now ";
	$sub_sql=$sub_sql." GROUP BY `student_main`.`class_now` , `student_main`.`room` ";
	$sub_query = mysql_db_query($dbname, $sub_sql);
	$student_nums=0;
	While ($sub_result = mysql_fetch_array($sub_query))
			{
		$room_now=$sub_result['room'];
		$rn=($room_now=="" || $room_now==0)?"":"/".$room_now;
		$save_pic="";
		$report_pic="<a href=?option=student_check&task=main/report_room&index=1&class_now=$class_now&room_now=$room_now><img src=images/browse.png border='0' title='ดูรายงานข้อมูลการมาเรียนของห้องเรียนนี้' alt='ดูรายงานข้อมูลการมาเรียนของห้องเรียนนี้'></a>";
			for($r=0;$r<count($r_list);$r++)
				{
					$rr=explode(",",$r_list[$r]);
					if($rr[0]==$class_now &&$rr[1]==$room_now )
						{
							#$save_pic="<a href=?option=student_check&task=main/check&index=2&id=$id&page=$page&class_now=$class_now&room_now=$room_now&datepicker=".$_GET[datepicker]."&edu_type=".$result['edu_type']."&t=$edu_name><img src=images/save16x16.png border='0' alt='บันทึกข้อมูลการมาเรียนของห้องเรียนนี้' title='บันทึกข้อมูลการมาเรียนของห้องเรียนนี้'></a>";
						}
			}//for
#เรียกจำนวนนักเรียน
$sql_count="SELECT COUNT(student_id) AS STD_NUMS FROM student_main where status='0' AND `student_main`.`class_now`=$class_now  and `student_main`.`room`=$room_now"; 
$result_conut = mysql_fetch_array(mysql_db_query($dbname, $sql_count));
				$color=(($M%2) == 0)?" class='even'":" class='odd'";
				echo "<Tr $color>
				<Td align='center' width='50'>$N</Td>
				<Td  align='center'>$edu_name$rn</Td>
				<Td  align='center'>$result_conut[STD_NUMS]</Td>
				<Td align='center'>			$save_pic 			$report_pic			</Td>
			</Tr>";
$student_nums=$student_nums+$result_conut[STD_NUMS];
		$M++;
		$N++;  //
		}
#รวมแต่ละระดับชั้น
echo "<Tr bgcolor=#CCFFFF>
				<Td  align='right' colspan=2><B>รวม $edu_name &nbsp;&nbsp;</B></Td>
				<Td  align='center'><B>$student_nums </B></Td>
				<Td align='center'></Td>
			</Tr>";
$student_totals=$student_totals+$student_nums;
	}
echo "<Tr $color>
				<Td  align='right' colspan=2><B>รวมทั้งหมด&nbsp;&nbsp;</B></Td>
				<Td  align='center'><B>".number_format($student_totals,0)."</B></Td>
				<Td align='center'></Td>
			</Tr>";
echo "</Table>";
}
?>