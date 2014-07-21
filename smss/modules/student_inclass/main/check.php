<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
include "modules/$_REQUEST[option]/inc.php";
//ส่วนหัว
echo "<br />";
if(!(($index==1) or ($index==2) or ($index==5))){
echo "<table width='99%' border='0' align='center'>";
echo "<tr align='center'>
	<td align=center><font color='#990000' size='3'><strong>บันทึกข้อมูลการมาเรียนของนักเรียน ปีการศึกษา $txtyear_active</strong></font>
<BR><font color='#006666' size='3'><strong>".thai_date(time())."</strong></font>
</td></tr>";
echo "</table>";
}
//ส่วนฟอร์มรับข้อมูล
if($index==1){
	$class_now=$_GET[class_now];
	$room_now=$_GET[room_now];
	$room=($room_now=="" || $room_now==0)?"":"/".$room_now;
echo '<BR><center><FONT SIZE="4" COLOR="#FF0000"><B>คุณไม่ได้รับสิทธิ์ในการบันทึกข้อมูลของ '.$edu_level[$class_now].$room.'</B></FONT></center>';
}
//ส่วนฟอร์มรายชื่อนักเรียน เตรียมบันทึกข้อมูล
if($index==2) {
	$t=$_GET[t];
	$class_now=$_GET[class_now];
	$room_now=$_GET[room_now];
	$edu_type=$_GET[edu_type];
	$room_now=($room_now=="" || $room_now==0 )?"":"/".$room_now;
echo "<table width='99%' border='0' align='center'>\n";
echo "";
echo "<tr>
	<td align='left'><font color='#990000' size='4'>บันทึกข้อมูลการมาเรียนของนักเรียน ชั้น$edu_level[$class_now]$room_now ปีการศึกษา $txtyear_active</font></td>
	<td align='right'><B><font color='darkgreen' size='3'>".thai_date(time())."</font></B></td>
	</tr>\n";
echo "</table>";
	$room_now=$_GET[room_now];
if($_POST[bt_save])
	{
		$student_id=$_POST[student_id];
		$d=explode("-",$_POST[datepicker]);
		$datepicker=$d[2]."-".$d[1]."-".$d[0];

		$class_now=$_POST[class_now];
		$room_now=$_POST[room_now];
		$Period=$_POST[Period];
		$save_date=date("Y-m-d h:m:s");
			for($l=0;$l<count($student_id);$l++)
			{
				$chk_val=$_POST[chk_val][$student_id[$l]];
				$dosqlchk=mysql_num_rows(mysql_db_query($dbname,"select * from student_inclass_main where check_date='$datepicker' and student_id='$student_id[$l]' and student_check_year='$year_active'"));
				$ival="";
				for($iv=0;$iv<count($Period[$l]);$iv++){
					$ival.=$iv.":".$Period[$l][$iv].",";
				}
				if($dosqlchk>0)
					{
							$sql="Update student_inclass_main Set check_val='$ival' , check_person_id='$check_person_id' , save_date='$save_date' Where check_date='$datepicker' AND student_id='$student_id[$l]'  and student_check_year='$year_active'";
							$dbquery = mysql_db_query($dbname, $sql);
							$msg="update";
					}
					else
						{
							$sql="insert into student_inclass_main VALUES('$datepicker','$student_id[$l]','$class_now','$room_now','$year_active','$ival','$check_person_id','$save_date')";
							$dbquery = mysql_db_query($dbname, $sql);
							$msg="yes";
						}
						#echo $sql."  ".$ival. "<br>";
			}#for $l
						if($msg=="yes"){
								echo "<center>
								<font color=darkgreen size=3><b>บันทึกข้อมูลเรียบร้อย</b><br>
								</center>";
						}else{
								echo "<center>
								<font color=darkgreen size=3><b>ปรับปรุงการบันทึกข้อมูลเรียบร้อย</b><br>
								</center>";
							}

	#print_r ($_POST[student_id]);
	$p=0;
	#while$s=$_POST[student_id]){
/*foreach ($_POST[student_id] as $s){
	echo "student_id : ".$s." : \n";
		foreach ($_POST[Period][$s] as $key => $s1){
			echo "\t".($key+1).":".$s1."@ \n";
			}
			echo "<br />\n";
$p++;
	}

	echo "<hr>";
	*/
	#print_r ($_POST[Period]);
	}

#แสดงรายชื่อของห้องที่เลือกมาครับ
$sql="SELECT *  FROM `student_main` WHERE  status='0' and `class_now` = $class_now AND `room` = $room_now ORDER BY student_number";
$dbquery = mysql_db_query($dbname, $sql);
?>
<form name=frmSave id=frmSave method=post  style="margin:0px;">
<input type="hidden" id="datepicker" name=datepicker value="<?php echo date("d-m-Y");?>"  >
<TABLE width='99%' align=center>
<TR bgcolor='#FFCCCC'>
	<TD width=25 align=center rowspan=2><B>ที่</B></TD>
	<TD width=80 align=center rowspan=2><B>รหัสประจำตัว<BR>นักเรียน</B></TD>
	<TD width=35 align=center rowspan=2><B>เลขที่</B></TD>
	<TD width=200 align=center rowspan=2><B>ชื่อ - สกุล</B></TD>
	<TD align=center colspan=<?php echo $num_period;?>><B>การเข้าชั้นเรียน</B></TD>
	<TD width=100 align=center rowspan=2><B>หมายเหตุ</B></TD>
</TR>
<TR bgcolor='#FFCCCC'>
<?php	for($t=0;$t<$num_period;$t++)
		{$Hchk="";
		for($i=0;$i<count($a_val_txt);$i++)
				{	
					$Hchk=$Hchk."<option value='".$a_val[$i]."' $chked class='".$a_val[$i]."'>".$a_val_txt[$i]."</option>\n";
				}
			echo "<TD align=center><B>คาบ ".($t+1)."</B></TD>\n";
		}
		?>
</TR>
<?php
$pms=0;
for($a=0;$a<count($r_list);$a++)
	{
		$e=explode(",",$r_list[$a]);
		if($e[0]==$class_now && $e[1]==$room_now){$pms++;}
	}
if($pms==0 OR $_SESSION['login_status']>4){echo "<script>document.location='?option=student_inclass&task=main/check&index=1&class_now=$class_now&room_now=$room_now';</script>";}
$M=1;
$pArr=array();
While ($result = mysql_fetch_array($dbquery))
	{
$color=(($M%2) == 0)?" class='even'":" class='odd'";
$chk="";
echo "<TR $color>
	<TD align=right>$M</TD>
	<TD align=center>$result[student_id]<INPUT TYPE=hidden name=student_id[] value=$result[student_id]></TD>
	<TD align=center>$result[student_number]</TD>
	<TD>$result[prename] $result[name]  $result[surname]</TD>";

for($t=0;$t<$num_period;$t++)
		{
		echo"<TD width=53>";
		if($t==$lunch_period){echo "พักกลางวัน <INPUT TYPE='hidden' name='Period[".($M-1)."][$t]' value='T'></TD>\n";}else{
			$pArr[$t]=$pArr[$t].$result[student_id]."_".$t.",";
			#$chk=$chk."<select name='Period[".($M-1)."][$t]' id='".$result[student_id]."_".$t."'>";
			#$chk=$chk."<option>-</option>";
			?>
<select name='Period[<?php echo ($M-1);?>][<?php echo $t;?>]' id='<?php echo $result[student_id]."_".$t;?>'>
<option>-</option>
<?php
		for($i=0;$i<count($a_val_txt);$i++)
				{	
#					$chked=($a_val[$i]==(get_vals(date("Y-m-d"),$result[student_id],$year_active)))?" selected ":"";
					$chked=($a_val[$i]==(get_vals(date("Y-m-d"),$result[student_id],$t,$year_active)))?" selected ":"";
					echo "<option value='".$a_val[$i]."' $chked class='".$a_val[$i]."'>".$a_val_txt[$i]."</option>\n";
		#<INPUT TYPE=\"radio\" NAME=\"chk_val[".$result[student_id]."]\" value=\"".$a_val[$i]."\" id=".$a_val[$i]."".$result[student_id]." $chked $retired><label for=\"".$a_val[$i]."".$result[student_id]."\">".$a_val_txt[$i]."&nbsp;&nbsp;</label>&nbsp;&nbsp;&nbsp;&nbsp;</TD>\n";
				}
		echo "</select>";
		echo "</TD>";
		}

		}#for t
		$comments=(get_vals(date("Y-m-d"),$result[student_id],999,$year_active)!="")?"":"<img src=./modules/$_GET[option]/images/s_warn.png > <FONT COLOR=red>ไม่มีข้อมูล</FONT>";
		$comments=(get_vals(date("Y-m-d"),$result[student_id],999,$year_active)=="N")?"<img src=./modules/$_GET[option]/images/s_warn.png > <FONT COLOR=red>ข้อมูลไม่สมบูรณ์</FONT>":$comments;


	#$chk
echo"	<TD align=left>$comments</TD>
</TR>";
$M++;
	}
$BT_BACK=($_POST[bt_save])?"<INPUT TYPE=\"button\" onclick='location.href=\"?option=student_inclass&task=main/check\"' value=กลับไปหน้ารายการ>":"<INPUT TYPE=\"button\" onclick='location.href=\"$refer\"' value=กลับไปหน้าที่แล้ว>";
echo "<TR $color>
	<TD COLSPAN=4 align=right><B>เครื่องมือช่วยเลือกทั้งหมด =></B></TD>";
for($t=0;$t<$num_period;$t++)
		{$Hchk="";
	if($t==$lunch_period){
		echo "<TD align=right></td>";
	}else{
			for($i=0;$i<count($a_val_txt);$i++)
					{	
						$Hchk=$Hchk."<option value='".$a_val[$i]."' $chked class='".$a_val[$i]."'>".$a_val_txt[$i]."</option>\n";
					}
				echo "<TD align=center>
				<select onchange='javascript:SetSelect($t,this.selectedIndex);' name=a$t>
					<option>เลือก</option>
					$Hchk
				</select>
				</TD>";
			}
		}
echo "<TD align=right></TD>";
echo "</TR>";
echo "<TR bgcolor='#FFCCCC' >
	<TD colspan=".($num_period+5)." align=right><INPUT TYPE=\"submit\" name=bt_save value=' [ บันทึกข้อมูล ] ' >&nbsp;&nbsp;<INPUT TYPE=\"reset\" value=' [ รีเซ็ต ] '>&nbsp;&nbsp;$BT_BACK
		<INPUT TYPE=hidden name=link_refer value=$refer>
		<INPUT TYPE=hidden name=class_now value=$class_now>
		<INPUT TYPE=hidden name=room_now value=$room_now>
</TD>
</TR>
</TABLE>
</form>
";
	#print_r($pArr);
?>
<script  type="text/javascript">
function SetSelect(pr,val){
	p = new Array(
<?php
	for($y=0;$y<$num_period;$y++){
		$commar=($num_period-$y==1)?"":",";
		echo "\"".substr($pArr[$y],0,(strlen($pArr[$y])-1))."\"".$commar."\n";
	}
?> );
var selectElements = p[pr].split(',');
	 for(var z=0; z<selectElements.length;z++){
	  //theItem = document.getElementById(selectElements[z]);
		var selObj = document.getElementById(selectElements[z]);
		selObj.selectedIndex = val;
	 }
 }
</script>

<script type="text/javascript">
function smo_selectRadioValues(value,theElements) {
	//Programmed by Shawn Olson
	//Copyright (c) 2007
	//Permission to use this function provided that it always includes this credit text
	//  http://www.shawnolson.net
	//Find more JavaScripts at http://www.shawnolson.net/topics/Javascript/
	//This script was modified from the function checkUncheckSome() also
	//created by Shawn Olson
	//theElements is an array of objects designated as a comma separated list of their IDs
    //All Radio inputs with a value matching value will be selected inside theElements

     var formElements = theElements.split(',');
	 for(var z=0; z<formElements.length;z++){
	  theItem = document.getElementById(formElements[z]);
	  if(theItem){
	  theInputs = theItem.getElementsByTagName('input');
	  for(var y=0; y<theInputs.length; y++){
	   if(theInputs[y].type == 'radio'){
         theName = theInputs[y].name;
         if(theInputs[y].value==value){
		   theInputs[y].checked='checked';
		 }
	    }
	  }
	  }
     }
    }

</script>
<?php
}#==2
//ส่วนแสดงผล List รายชื่อห้อง
if(!(($index==1) or ($index==2) or ($index==5))){
	//ส่วนของการแยกหน้า
$pagelen=50;  // 1_กำหนดแถวต่อหน้า
$url_link="option=student_inclass&task=main/check";  // 2_กำหนดลิงค์

$sql="SELECT `student_main`.`class_now` , `student_main`.`room` FROM student_main";
if(count($r_list)!=0){
	$sql=$sql." where ";
	for($r=0;$r<count($r_list);$r++){
	$rr=explode(",",$r_list[$r]);
	if($r>0){	$sql=$sql." OR ";}
	$sql=$sql." (`student_main`.`class_now` =".$rr[0]." AND `student_main`.`room` =".$rr[1]." ) ";
	}
$sql=$sql."GROUP BY `student_main`.`class_now` , `student_main`.`room`  ";
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
$sql=$sql."LIMIT $start,$pagelen";
$dbquery = mysql_db_query($dbname, $sql);
echo  "<table width=450 border=0 align=center>";
echo "<Tr bgcolor='#FFCCCC'><Td  align='center' style='font-weight:bold'>ที่</Td><Td  align='center' style='font-weight:bold'>ระดับชั้น</Td><Td  align='center' style='font-weight:bold' width=120>บันทึกการมาเรียน</Td><!--Td  align='center' style='font-weight:bold' width=120>รายละเอียด</Td--></Tr>";
$N=(($page-1)*$pagelen)+1;  //*เกี่ยวข้องกับการแยกหน้า
$M=1;
While ($result = mysql_fetch_array($dbquery))
	{
		$id = $result['id'];
		$class_now= $result['class_now'];
		$room_now= $result['room'];
		$edu_name=$edu_level[$result['class_now']];
		$save_pic="<a href=?option=".$_GET[option]."&task=main/check&index=2&id=$id&page=$page&class_now=$class_now&room_now=$room_now&edu_type=".$result['edu_type']."&t=$edu_name><img src=images/save16x16.png border='0' alt='บันทึกข้อมูลการมาเรียนของห้องเรียนนี้' title='บันทึกข้อมูลการมาเรียนของห้องเรียนนี้' $Sat_Sun></a>";
		$report_pic="<a href=?option=".$_GET[option]."&task=main/report_room&index=1&class_now=$class_now&room_now=$room_now><img src=images/browse.png border='0' title='ดูรายงานข้อมูลการมาเรียนของห้องเรียนนี้' alt='ดูรายงานข้อมูลการมาเรียนของห้องเรียนนี้'></a>";
		$color=(($M%2) == 0)?" class='even'":" class='odd'";
		$room_now=($result['room']=="" || $result['room']==0)?"":"/".$result['room'];
		echo "<Tr $color><Td align='center' width='50'>$N</Td>
		<Td  align='center'>$edu_name$room_now</Td>
			<Td align='center'>
			$save_pic 
			</Td>
			<!--Td align='center'>
			$report_pic
			</Td-->
	</Tr>";
$M++;
$N++;  //*เกี่ยวข้องกับการแยกหน้า
	}
echo "</Table>";
}else
	{
		echo '<BR><center><FONT SIZE="4" COLOR="#FF0000"><B>คุณไม่ได้รับสิทธิ์ในการบันทึกข้อมูล</B></FONT></center>';
	}
}
?>