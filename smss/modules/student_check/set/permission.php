<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
//sd page 
$page=(isset($_REQUEST['page']))?$_REQUEST['page']:"";
$class_now=(isset($_REQUEST['class_now']))?$_REQUEST['class_now']:"";
$room_now=(isset($_REQUEST['room_now']))?$_REQUEST['room_now']:"";
$edu_type=(isset($_REQUEST['edu_type']))?$_REQUEST['edu_type']:"";
$person_id=(isset($_REQUEST['person_id']))?$_REQUEST['person_id']:"";

if($_SESSION['admin_student_check']!="student_check"){
	echo '<BR><center><FONT SIZE="4" COLOR="#FF0000"><B>คุณไม่ได้รับสิทธิ์การใช้งานส่วนนี้</B></FONT></center>';
}else{
function getFullnameUser($x){
	include"smss_connect.php";
	$sql="Select * From person_main where person_id='".$x."'";
	$query=mysql_query($sql);
	$FullnameUser=mysql_fetch_assoc($query);
	return $FullnameUser['prename']."".$FullnameUser['name']."  ".$FullnameUser['surname'];
}
include "modules/$_REQUEST[option]/inc.php";
//ส่วนหัว
echo "<br />";
if(!(($index==1) or ($index==2) or ($index==5))){
echo "<table width='50%' border='0' align='center'>";
echo "<tr align='center'><td><font color='#006666' size='3'><strong>กำหนดผู้รับผิดชอบการบันทึกการมาเรียน <BR>ปีการศึกษา $txtyear_active</strong></font></td></tr>";
echo "</table>";
}

//ส่วนบันทึกข้อมูล
if($index==1){
echo "<table width='50%' border='0' align='center'>";
echo "<tr align='center'><td><font color='#006666' size='3'><strong>กำหนดผู้รับผิดชอบการบันทึกการมาเรียน</strong></font></td></tr>";
echo "</table>";
	if($person_id==""){
		echo"<br><center>
		<font color=red size=3><b>เกิดข้อผิดพลาด !! คุณยังไม่ได้เลือกผู้ที่จะรับผิดชอบ</b><br>
			<a href='$refer'>คลิกที่นี่</a> เพื่อกลับไปทำรายการใหม่
		</center";
	}else{

		if(mysql_num_rows(mysql_query("Select * from student_check_permission where class_now=$class_now and room_now=$room_now and person_id='$person_id' and student_check_year='$year_active'"))>0){
		echo"<br><center>
		<font color=red size=3><b>เกิดข้อผิดพลาด !! คุณเลือกบุคคลที่มีอยู่แล้ว</b><br>
			<a href='$refer'>คลิกที่นี่</a> เพื่อกลับไปทำรายการใหม่
		</center";
		}else{
		$sql="INsert INto student_check_permission VAlues($class_now,$room_now,'$person_id','$year_active')";//echo $sql;
		$query=mysql_query($sql);
?>
<script>
	alert('เพิ่มข้อมูลผู้รับผิดชอบสำเร็จ\n กด ตกลง (OK) เพิ่อกลับไปหน้าที่แล้ว');
	window.location="<?php echo $refer;?>";
</script>
<?php
	}
}//if checkk
}

//ส่วนฟอร์มรายชื่อนักเรียน เตรียมบันทึกข้อมูล
if($index==2) {

}

//ส่วนลบข้อมูล
if($index==3){
	if($person_id==""){
		echo"<br><center>
		<font color=red size=3><b>เกิดข้อผิดพลาด !! ไม่สามารถลบข้อมูลได้</b><br>
			<a href='$refer'>คลิกที่นี่</a> เพื่อกลับไปทำรายการใหม่
		</center";
	}else{

$sql = "delete from student_check_permission where class_now=$class_now and room_now=$room_now and person_id='$person_id'";
$dbquery = mysql_query( $sql);
echo "<script>
	alert('ลบข้อมูลผู้รับผิดชอบสำเร็จ\\n กด ตกลง (OK) เพิ่อกลับไปหน้าที่แล้ว');
	window.location='$refer';
</script>";
	}
	echo $refer;
}

//ส่วนบันทึกข้อมูล
if($index==4){

}//if$index==4

//ส่วนฟอร์มแก้ไขข้อมูล
if ($index==5){
	$t=$_GET['t'];
	$room_now=($room_now=="" || $room_now==0)?"":"/".$room_now;
echo "<Center>";
echo "<Font color='#006666' Size=3><B>กำหนดผู้รับผิดชอบการบันทึกการมาเรียน  $edu_level[$class_now]$room_now";
echo "<Br>ประจำปีการศึกษา $txtyear_active</B></Font></Cener>";
echo "<Br><Br>";
echo  "<table width=60% border=0 align=center>";

echo "<Tr bgcolor='#FFCCCC'><Td  align='center' style='font-weight:bold'>ที่</Td><Td  align='center' style='font-weight:bold'>รหัสประจำตัว</Td><Td  align='center' style='font-weight:bold'>ผู้รับผิดชอบ</Td><Td  align='center' style='font-weight:bold'>การทำรายการ</Td></Tr>";

			$pms_list="";
			$room_now=$_GET['room_now'];

			$sql_pms="SELECT *  FROM `student_check_permission` WHERE `class_now` = $class_now AND `room_now` = $room_now  and student_check_year='$year_active' ";
			$pmsquery = mysql_query( $sql_pms); 
			if(mysql_num_rows($pmsquery)>0){
				$p=1;
				while($pms=mysql_fetch_assoc($pmsquery)){
					$x=$pms['person_id'];
					$color=(($p%2) == 0)?" class='even'":" class='odd'";
					$drop_pic="<a href='?option=student_check&task=set/permission&index=3&edu_type=$edu_type&class_now=$class_now&room_now=$room_now&person_id=$x'><img src='images/drop.png' alt='ลบผู้รับผิดชอบจากห้องเรียนนี้' title='ลบผู้รับผิดชอบจากห้องเรียนนี้' border=0></a>";

	$sql="Select * From person_main where person_id='".$x."'";
	$query=mysql_query($sql);
	$FullnameUser=mysql_fetch_array($query);
	$fullname=$FullnameUser['prename']."".$FullnameUser['name']."  ".$FullnameUser['surname'];
?>
<TR <?php echo $color?>>
	<Td align='right' width='35'><?php echo $p." "?></Td>
	<Td  align='center'  width=200><?php echo $x?></Td>
	<Td  align='left'>&nbsp;&nbsp;<?php echo $fullname?></Td>
	<Td align='center' width=110><?php echo $drop_pic?><?php //echo $drop_pic."  ".$report_pic?></Td>
</TR>
<?php
	$p++;
				}
			}else{
				echo "<tr class=odd><td colspan=4 align=center><FONT SIZE=2 COLOR=red><B>ยังไม่มีผู้รับผิดชอบ !!</B></FONT></td>";
			}
#echo $pms_list;
echo "<tr  bgcolor='#FFCCCC'><td colspan=2 align=left valign=middle ><a href='?option=student_check&task=set/permission' alt='กลับไปที่หน้ารายการ' title='กลับไปที่หน้ารายการ' ><img src='images/arrow_left.gif' border=0> <FONT COLOR='#000'>กลับไปที่หน้ารายการ</FONT></a></td>";
echo "<td colspan=2 align=right valign=middle ><a id=opener href='#' alt='เพิ่มผู้รับผิดชอบให้ห้องเรียนนี้' title='เพิ่มผู้รับผิดชอบให้ห้องเรียนนี้' ><img src='images/add.png' border=0> <FONT COLOR='#000'>เพิ่มผู้รับผิดชอบ</FONT></a></td>";
echo "</Table>";

?>

	<link rel="stylesheet" href="./jquery/themes/ui-lightness/jquery.ui.all.css">
	<script src="./jquery/jquery-1.5.1.js"></script>
	<script src="./jquery/external/jquery.bgiframe-2.1.2.js"></script>
	<script src="./jquery/ui/jquery.ui.core.js"></script>
	<script src="./jquery/ui/jquery.ui.widget.js"></script>
	<script src="./jquery/ui/jquery.ui.mouse.js"></script>
	<script src="./jquery/ui/jquery.ui.draggable.js"></script>
	<script src="./jquery/ui/jquery.ui.position.js"></script>
	<script src="./jquery/ui/jquery.ui.resizable.js"></script>
	<script src="./jquery/ui/jquery.ui.dialog.js"></script>

	<script>
	// increase the default animation speed to exaggerate the effect
	$.fx.speeds._default = 500;
	$(function() {
		$( "#dialog" ).dialog({
			height: 250,
			width: 350,
			minHeight: 250,
			minWidth: 350,
			autoOpen: false,
			show: "blind",
			hide: "explode",
				modal: true,
				resizable: false
		});

		$( "#opener" ).click(function() {
			$( "#dialog" ).dialog( "open" );
			return false;
		});
	});

	</script>
<div id="dialog" title="เลือกผู้รับผิดชอบที่ต้องการ">
	<p>
	<form name=add_pms action="?option=student_check&task=set/permission&index=1" method=post>
<INPUT TYPE="hidden" name="class_now" value="<?php echo $class_now;?>">
<INPUT TYPE="hidden" name="room_now" value="<?php echo $room_now;?>">
<INPUT TYPE="hidden" name="edu_type" value="<?php echo $edu_type;?>">
	<select name="person_id">
	<option value=''>เลือกผู้ใช้จากรายการ</option>
		<?php
				$sqlPersonMain="Select * from person_main";
				$query_PM=mysql_query($sqlPersonMain);
				if(mysql_num_rows($query_PM)>0){
					while($r_PM=mysql_fetch_assoc($query_PM))
					{
						echo"<option value='".$r_PM['person_id']."'>".$r_PM['prename']."".$r_PM['name']."  ".$r_PM['surname']."</option>\n";
					}
				}else{
						echo"<option value=''>ยังไม่มีข้อมูล</option>\n";
				}
		?>
	</select>
	<INPUT TYPE="submit" value="บันทึกข้อมูล">
	</form>
	</p>
</div>
<?php
}

//ส่วนปรับปรุงข้อมูล
if ($index==6){

}

//ส่วนปรับปรุงปีการศึกษาทำงานปัจจุบัน
if ($index==7){

}

//ส่วนแสดงผล
//if(!(($index==1) or ($index==2) or ($index==5))){
if(!(($index==1) or ($index==3) or ($index==5))){
	//ส่วนของการแยกหน้า
$pagelen=50;  // 1_กำหนดแถวต่อหน้า
$url_link="option=student_check&task=set/permission";  // 2_กำหนดลิงค์
//$sql = "select * from student_check_year"; // 3_กำหนด sql  
$sql = "SELECT `student_main`.`class_now` , `student_main`.`room` FROM student_main GROUP BY `student_main`.`class_now` , `student_main`.`room` "; // 3_กำหนด sql  SELECT `student_main`.`class_now` , `student_main`.`room` FROM student_main GROUP BY `student_main`.`class_now` , `student_main`.`room` LIMIT 0 , 100 

$dbquery = mysql_query( $sql);
$num_rows = mysql_num_rows($dbquery);  
$totalpages=ceil($num_rows/$pagelen);
if($page==""){
$page=1;//$totalpages;
		if($page<2){
		$page=1;
		}
}
else{
		if($totalpages<$page){
		$page=$totalpages;
					if($page<1){
					$page=1;
					}
		}
		else{
		$page=$page;
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

//$sql = "select * from  student_check_year order by student_check_year desc limit $start,$pagelen";
$sql="SELECT `student_main`.`class_now` , `student_main`.`room`   FROM student_main GROUP BY `student_main`.`class_now` , `student_main`.`room`  LIMIT $start,$pagelen";
$dbquery = mysql_query( $sql);
echo  "<table width=70% border=0 align=center>";
echo "<Tr><Td colspan='5' align='left'><!--INPUT TYPE='button' name='smb' value='เพิ่มปีการศึกษา' onclick='location.href=\"?option=student_check&task=set/year&index=1\"'--></Td></Tr>";

echo "<Tr bgcolor='#FFCCCC'><Td  align='center' style='font-weight:bold'>ที่</Td><Td  align='center' style='font-weight:bold'>ห้องเรียน</Td><Td  align='center' style='font-weight:bold'>ผู้รับผิดชอบ</Td><Td  align='center' style='font-weight:bold'>การทำรายการ</Td></Tr>";
$N=(($page-1)*$pagelen)+1;  //*เกี่ยวข้องกับการแยกหน้า
$M=1;
While ($result = mysql_fetch_array($dbquery))
	{
		//$id = $result['id'];
		$class_now= $result['class_now'];
		$room_now= $result['room'];
		$edu_name=$edu_level[$result['class_now']];
		//$year_active = $result['year_active'];
			$pms_list="";
			$edu_type=$result['class_now'];
			//$person_id=$_SESSION[person_id];
			$sql_pms="SELECT *  FROM `student_check_permission` WHERE `class_now` = $class_now AND `room_now` = $room_now  and student_check_year='$year_active' ";
			$pmsquery = mysql_query( $sql_pms);
			if(mysql_num_rows($pmsquery)>0){
				$p=1;
				while($pms=mysql_fetch_assoc($pmsquery)){
					$x=$pms['person_id'];
					$sql="Select * From person_main where person_id='".$x."'";
					$query=mysql_query($sql);
					$FullnameUser=mysql_fetch_array($query);
					$fullname=$FullnameUser['prename']."".$FullnameUser['name']."  ".$FullnameUser['surname'];
							$pms_list=$pms_list."&nbsp;&nbsp;$p. ".$fullname."&nbsp;&nbsp;&nbsp;<br>\n";
								$p++;
				}
			}else{
				$pms_list=" ";
			}

		//$edit_pic="<a href=?option=student_check&task=set/permission&index=5&id=$id&page=$page&class_now=$class_now&room_now=$room_now&edu_type=".$result['edu_type']."&t=$edu_name><img src=images/edit.png border='0' title='แก้ไขผู้รับผิดชอบการบันทึกการมาเรียนของห้องเรียนนี้' alt='แก้ไขผู้รับผิดชอบการบันทึกการมาเรียนของห้องเรียนนี้'></a>";
		$edit_pic="<a href=?option=student_check&task=set/permission&index=5&page=$page&class_now=$class_now&room_now=$room_now&t=$edu_name><img src=images/edit.png border='0' title='แก้ไขผู้รับผิดชอบการบันทึกการมาเรียนของห้องเรียนนี้' alt='แก้ไขผู้รับผิดชอบการบันทึกการมาเรียนของห้องเรียนนี้'></a>";
		$save_pic="";
		$edit_pic=($year_active=="")?"<img src=images/edit.png border='0' title='แก้ไขผู้รับผิดชอบการบันทึกการมาเรียนของห้องเรียนนี้' alt='แก้ไขผู้รับผิดชอบการบันทึกการมาเรียนของห้องเรียนนี้'>":$edit_pic;
		$color=(($M%2) == 0)?" class='even'":" class='odd'";
		$room_now=($result['room']==0 || $result['room']=="")?"":"/".$result['room'];
		echo "<Tr $color><Td align='center' width='50'>$N</Td>
		<Td  align='center'  width=200 valign=top>$edu_name$room_now</Td>
		<Td  align='left'>$pms_list</Td>
			<Td align='center' width=110>
			$edit_pic
			</Td>
	</Tr>";
$M++;
$N++;  //*เกี่ยวข้องกับการแยกหน้า
	}
echo "</Table>";
}

}#CHECK PERMISSION
?>