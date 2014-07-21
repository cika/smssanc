<?php

/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
//sd page 
include "modules/$_REQUEST[option]/inc.php";

if(!isset($_GET['class_now'])){
$_GET['class_now']="";
}

if(!isset($_GET['kw'])){
$_GET['kw']="";
}

if(!isset($_GET['room_now'])){
$_GET['room_now']="";
}

#ส่วนหัว
echo "<br /><table width='95%' border='0' align='center'>";
echo "<tr align='center'><td><font color='#006666' size='3'><strong>สถิติการมาเรียนของนักเรียน  ปีการศึกษา $txtyear_active</strong></font></td></tr>";
echo "</table>";
$sql="SELECT `student_main`.`class_now` ,`student_main`.`room`  FROM student_main where status='0' ";
$sql=$sql."GROUP BY `student_main`.`class_now`,`student_main`.`room` ";
$dbquery = mysql_query($sql);
$changeRoom="<B>เลือกห้องเรียน</B>  <select onchange=\"location.href=this.options[this.selectedIndex].value;\" size=\"1\" name=\"select\">";
$changeRoom=$changeRoom."<option  value=\"?option=student_check&task=main/report_person\"> เลือกห้องเรียน </option>";
While ($result = mysql_fetch_array($dbquery))
	{
$room=($result['room']=="" || $result['room']==0)?"":"/".$result['room'];
$seled=($_GET['class_now']==$result['class_now'] && $_GET['room_now']==$result['room'])?"selected":"";
$changeRoom=$changeRoom."<option  value=\"?option=student_check&task=main/report_person&class_now=".$result['class_now']."&room_now=".$result['room']."\" $seled> ".$edu_level[$result['class_now']].$room." </option>";
}
$changeRoom=$changeRoom."</select>";

$class_now=(isset($_GET['class_now']))?$_GET['class_now']:"";
$room_now=(isset($_GET['room_now']))?$_GET['room_now']:"";

echo'<table width=95% border=0 align=center>
<TR>
	<TD width=50% valign=top>
	<fieldset>
    <legend>&nbsp; <B>เลือกห้องเรียน</B>: &nbsp;</legend>
 '.$changeRoom.'</fieldset>
	</TD>
	<TD width=50% valign=top>
	<form><fieldset>
    <legend>&nbsp; <B>ค้นหา</B>: &nbsp;</legend>
<INPUT TYPE="hidden" name=option value=student_check>
<INPUT TYPE="hidden" name=task value=main/report_person>
<B>คำค้น : </B><INPUT TYPE="text" NAME="kw" value='.$_GET['kw'].'>
<INPUT TYPE="submit" value=ค้นหา...>
  </fieldset>
	</form></TD>
</TR>
</TABLE>';
$kw=str_replace("%"," ",$_GET['kw']);
$kw=str_replace(" ","",$kw);
if($_GET['class_now']!="" OR ($_GET['kw']!="" && $_GET['kw']!='%')){

	if($_GET['class_now']!=""){
	$class_now=$_GET['class_now'];
	$room_now=($_GET['room_now']=="")?0:$_GET['room_now'];
	$sql="SELECT *  FROM `student_main` WHERE  status='0' and `class_now` = $class_now AND `room` = $room_now  ";
	$url_link="option=student_check&task=main/report_person&class_now=$class_now&room_now=$room_now";  // 2_กำหนดลิงค์
	}
#Order by id
	if($kw!="" && $kw!='%'){
	$sql="SELECT *  FROM `student_main` WHERE status='0' and name like'$kw%' or surname like'$kw%' ";
	$url_link="option=student_check&task=main/report_person&kw=$kw";  // 2_กำหนดลิงค์
	}

$pagelen=50;  // 1_กำหนดแถวต่อหน้า

$dbquery = mysql_query($sql);
$num_rows = mysql_num_rows($dbquery );  
$totalpages=ceil($num_rows/$pagelen);

if(!isset($_REQUEST['page'])){
$_REQUEST['page']="";
}

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

			$changePages="<B>เลือก  </B><select onchange=\"location.href=this.options[this.selectedIndex].value;\" size=\"1\" name=\"select\">";
			$changePages==$changePages."<option  value=\"\">หน้า</option>";
				for($p=1;$p<=$totalpages;$p++){
					$seled=($p!=$page)?"":"selected";
					$changePages=$changePages."<option  value=\"?$url_link&page=$p\" $seled> หน้า $p </option>\n";
				}
			$changePages=$changePages."</select>";
$changePages=($totalpages<=1)?"":"$changePages";
?>
<TABLE width='95%' align=center>
<TR>
	<TD COLSPAN=3 align=left><B><font color='#006666' size='2'><?php $room=($_GET['room_now']=="" || $_GET['room_now']==0)?"":"/".$_GET['room_now']; echo ($_GET['class_now']!="")?"ชั้น ". $edu_level[$_GET['class_now']].$room."&nbsp;&nbsp;".$changePages:"";?></font></B></TD>
	<TD COLSPAN=5 align=right><?php echo ($_GET['kw']!="")?"<B><font color='#006666' size='2'>ผลการค้นหา '$_GET[kw]' </font></b>&nbsp;&nbsp;".$changePages:"";?></TD>
</TR>
<TR  bgcolor='#FFCCCC'>
	<TD width=40 align=center><B>ที่</B></TD>
	<TD width=100 align=center><B>รหัสประจำตัว</B></TD>
	<TD width=40 align=center><B>เลขที่</B></TD>
	<TD align=center><B>ชื่อ - สกุล</B></TD>
	<TD align=center width=50 ><B>มา</B></TD>
	<TD align=center width=50 ><B>ลา</B></TD>
	<TD align=center width=50 ><B>ป่วย</B></TD>
	<TD align=center width=50 ><B>ขาด</B></TD>
	<TD align=center width=60 ><B>รายการ</B></TD>
</TR>
<?php
		$M=1;
		$N=(($page-1)*$pagelen)+1;  //
	$sql=$sql."  Order By class_now,room,student_number ASC LIMIT $start,$pagelen";
	$dbquery = mysql_query($sql);
		While ($result = mysql_fetch_array($dbquery))
		{
			$color=(($M%2) == 0)?" class='even'":" class='odd'";
			#$color=($result[status]==0)?"  class='out'":$color;
			$room=($result['room']=="" || $result['room']==0)?"":"/".$result['room'];
			echo"<TR $color>
				<TD align=right>$N</TD>
				<TD align=center>$result[student_id]<INPUT TYPE=hidden name=student_id[] value=$result[student_id]></TD>
				<TD align=center>$result[student_number]</TD>
				<TD><B>$result[prename] $result[name]  $result[surname]</B> &nbsp;&nbsp;(".$edu_level[$result['class_now']]."$room)</TD>";
			#$a_val=array("0" => "C", "1" => "W", "2" => "S", "3" => "L");
			#$a_val_txt=array("0" => "มา", "1" => "ลา", "2" => "ป่วย", "3" => "ขาด");
			$e="";
						#$sql_val="Select COUNT(student_id) AS STD_NUMS from student_check_main Where check_val='$a_val[$i]' and student_id='$result[student_id]' AND student_check_year='$year_active'";
						$sql_val="Select * from student_check_main Where student_id='$result[student_id]' AND student_check_year='$year_active'";
						$query_val=mysql_query($sql_val);
						
			for($i=0;$i<count($a_val);$i++)
					{
						$$a_val[$i]=0;
					}
						$rNums=mysql_num_rows($query_val);
						while($rsNums=$rNums=mysql_fetch_array($query_val))
								{
								for($i=0;$i<count($a_val);$i++)
										{
											$$a_val[$i]=($a_val[$i]==$rsNums['check_val'])?$$a_val[$i]+1:$$a_val[$i]+0;
										}
								}
			for($i=0;$i<count($a_val);$i++)
					{
						$e=$e. "<TD align='center'>".$$a_val[$i]."</TD>";
					}
					echo $e;
			$img_detail="<a href='?option=student_check&task=main/report_person&index=detail&student_id=$result[student_id]'><img src=./images/browse.png title=รายละเอียด... border=0></a>";

			echo"	<TD align=center>$img_detail</TD>
			</TR>";
			$M++;
			$N++;
		}#while
}
if($index=="detail")
{
$student_id=$_GET['student_id'];
$sql="Select * From student_main where status='0' and student_id='$student_id'";
$query=mysql_query($sql);
if(mysql_num_rows($query)!=0)
	{
	$data=mysql_fetch_assoc($query);
	$room=($data['room']=="" || $data['room']==0)?"":"/".$data['room'];
?>
<table width=85% border=0 align=center>
<TR>
	<TD width=40% valign=top>
	<fieldset>
    <legend>&nbsp; <B>ข้อมูลนักเรียน: </B> &nbsp;</legend>
	<B>รหัสประจำตัวนักเรียน : <FONT COLOR="#003399"><?php echo $student_id."";?></FONT></B> <BR>
	<B>ชื่อ - สกุล : <FONT COLOR="#003399"><?php echo $data['prename'].$data['name']."  ".$data['surname'];?></FONT></B> <BR>
	<B>ห้องเรียน : <FONT COLOR="#003399"><?php echo $edu_level[$data['class_now']].$room;?></FONT> 
	เลขที่ : <FONT COLOR="#003399"><?php echo $data['student_number'];?></FONT></B> 
<BR>
<BR>
		<TABLE width=95% align=center>
		<TR bgcolor='#FFCCCC'>
			<TD align=center><B>สถานะการมาเรียน</B></TD>
			<TD align=center><B>จำนวน (ครั้ง)</B></TD>
			<TD align=center><B>ร้อยละ</B></TD>
		</TR>
<?php
$sql_d="Select * From student_check_main where student_id='$student_id' and student_check_year='$year_active'";
$query_d=mysql_query($sql_d);
if(mysql_num_rows($query_d)==0)
		{
			echo"<TR bgcolor='#F3F3F3'>
			<TD Colspan=3 align=center><B><FONT COLOR='#FF0000'>ยังไม่มีข้อมูล</FONT></B> &nbsp;&nbsp;</TD></TR>";
		}else
		{
$r_val=array();
$all_rows=0;
			while($result_d=mysql_fetch_assoc($query_d)){
			for($i=0;$i<count($a_val);$i++)
					{
					//add
					if(!isset($r_val[$i])){
					$r_val[$i]="";
					}
					
						if($a_val[$i]==$result_d['check_val']){$r_val[$i]=$r_val[$i]+1;}
					}
					$all_rows++;
			}#print_r($r_val);
			for($i=0;$i<count($a_val);$i++)
					{
						$color=(($i%2) == 0)?" class='even'":" class='odd'";
						$val=(isset($r_val[$i]))?$r_val[$i]:0;
						
						echo "<TR $color>
							<TD align=right><B>$a_val_txt[$i]</B> &nbsp;&nbsp;</TD>
							<TD align=center>";
							if($val>0){
							$x=number_format($val);
							echo $x;
							}
							echo "</TD>
							<TD align=right>".number_format(round(($val/$all_rows)*100,2),2)."&nbsp;&nbsp;&nbsp;</TD>
						</TR>";
					}
?>
		<TR bgcolor='#FFCCCC'>
			<TD align=right><B>รวม</B> &nbsp;&nbsp;</TD>
			<TD align=center><?php echo $all_rows;?></TD>
			<TD align=right><?php echo number_format(round(($all_rows/$all_rows)*100,2),2);?>&nbsp;&nbsp;&nbsp;</TD>
		</TR>
<?php
			}
?>
		</TABLE>
	</fieldset>
	</TD>
	<TD width=60% valign=top>
	<fieldset>
    <legend>&nbsp; <B>รายละเอียดการมาเรียน:</B> &nbsp;</legend>
		<TABLE width=95% align=center>
<?php
$pagelen=50;  // 1_กำหนดแถวต่อหน้า
$sql_d="Select * From student_check_main where student_id='$student_id' and student_check_year='$year_active' ";

$url_link="option=student_check&task=main/report_person&index=detail&student_id=$student_id";  // 2_กำหนดลิงค์
$dbquery = mysql_query($sql_d);
$num_rows = mysql_num_rows($dbquery );  
$totalpages=ceil($num_rows/$pagelen);

if(!isset($_REQUEST['page'])){
$_REQUEST['page']="";
}

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

			$changePages="<B>เลือก  </B><select onchange=\"location.href=this.options[this.selectedIndex].value;\" size=\"1\" name=\"select\">";
			$changePages==$changePages."<option  value=\"\">หน้า</option>";
				for($p=1;$p<=$totalpages;$p++){
					$seled=($p!=$page)?"":"selected";
					$changePages=$changePages."<option  value=\"?$url_link&page=$p\" $seled> หน้า $p </option>";
				}
			$changePages=$changePages."</select>";
$changePages=($totalpages<=1)?"":"<TR><TD align=right colspan=3 >$changePages</TD></TR>";
echo $changePages;
?>
		<TR bgcolor='#FFCCCC'>
			<TD align=center width=60><B>ลำดับที่</B></TD>
			<TD align=center><B>วันที่</B></TD>
			<TD align=center><B>สถานะ</B></TD>
		</TR>
<?php
		$M=1;
		$N=(($page-1)*$pagelen)+1;  //
		$r=0;  //
$sql_d=$sql_d."  Order By check_date Desc LIMIT $start,$pagelen";

$query_d=mysql_query($sql_d);
if(mysql_num_rows($query_d)==0)
		{
			echo"<TR bgcolor='#F3F3F3'>
			<TD Colspan=3 align=center><B><FONT COLOR='#FF0000'>ยังไม่มีข้อมูล</FONT></B> &nbsp;&nbsp;</TD></TR>";
		}else
		{
			while($result_d=mysql_fetch_assoc($query_d)){
				$color=(($M%2) == 0)?" class='even'":" class='odd'";
				for($i=0;$i<count($a_val);$i++)
							{
							if($result_d['check_val']==$a_val[$i]){
								echo "<TR $color>
									<TD align=center>$N</TD>
									<TD align=left>&nbsp;&nbsp;".thai_date(strtotime($result_d['check_date']))."</TD>
									<TD align=center class=$a_val[$i]><B>$a_val_txt[$i]</B> &nbsp;&nbsp;</TD>
								</TR>";
							}
						}
				$M++;
				$N++;
				}
		}
?>
		</TABLE>
	</fieldset>
	</TD>
</TR>
</TABLE>
<?php
	}#if !=0
}
?>