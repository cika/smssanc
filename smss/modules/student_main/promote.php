<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
//sd page 
$officer=$_SESSION['login_user_id'];

if(isset($_REQUEST['class_index'])){
	$class_index=$_REQUEST['class_index'];
}else{
	$class_index="";
}

if(isset($_REQUEST['room_index'])){
	$room_index=$_REQUEST['room_index'];
}else{
	$room_index="";
}


$sql = "select * from  student_main_class order by class_code";
$dbquery = mysql_query($sql);
While ($result = mysql_fetch_array($dbquery)){
$class_ar[$result['class_code']]=$result['class_name'];
}

echo "<br />";
if(!(($index==1) or ($index==2) or ($index==2.1) or ($index==5))){
echo "<table width='50%' border='0' align='center'>";
echo "<tr align='center'><td><font color='#006666' size='3'><strong>เลื่อนชั้นนักเรียน</strong></font></td></tr>";
echo "</table>";
}

//ส่วนการเลื่อนชั้น
if($index==3.1){

	$sql = "select  max(class_code) as class_max from  student_main_class";
	$dbquery = mysql_query($sql);
	$result_class = mysql_fetch_array($dbquery);
	$sd_not_pm="";
	foreach ($_POST as $student_id =>$student_value){
		$sql_student = "select class_now from student_main where student_id='$student_id'";
		$dbquery_student = mysql_query($sql_student);	
		$result_student= mysql_fetch_array($dbquery_student); 
			//ตรวจการบันทึกประวัติชั้นเรียน
			if(!(($student_id=="allchk") or ($student_id=="class_index") or ($student_id=="room_index"))){
			$sql_log= "select id from student_main_classlog where class_code='$result_student[class_now]' and student_id='$student_id'";
			$dbquery_log= mysql_query($sql_log);	
			$log_num=mysql_num_rows($dbquery_log);
			if($log_num<1){
			$sd_not_pm=$sd_not_pm+1;
			}
			else{
					if($result_student['class_now']<$result_class['class_max']){
					$promote_class=$result_student['class_now']+1;
					$sql = "update student_main set  class_now='$promote_class' where student_id='$student_id'";
					$dbquery = mysql_query($sql);
					}
			}
			}			
	}
}

if(isset($sd_not_pm)>0){
echo "<script>alert('มีนักเรียนบางคนระบบไม่เลื่อนชั้นให้ เนื่องจากยังไม่ไดบันทึกประวัติชั้นเรียน กรุณาตรวจสอบ แล้วดำเนินการบันทึกประวัติช้นเรียนก่อน'); </script>\n";
}

//ส่วนการแสดงผล
if(!(($index==1) or ($index==2) or ($index==2.1) or ($index==5))){

//ส่วนของการแยกหน้า
$pagelen=45;  // 1_กำหนดแถวต่อหน้า
$url_link="option=student_main&task=promote";  // 2_กำหนดลิงค์
if($class_index!=""){
		if($room_index>=1){
		$sql = "select * from student_main where status='0' and  class_now='$class_index' and room='$room_index' ";
		}
		else{
		$sql = "select * from student_main where status='0' and  class_now='$class_index' ";
		}
}
else{
$sql = "select * from student_main where status='0' ";
}
$dbquery = mysql_query($sql);
$num_rows=mysql_num_rows($dbquery);
$totalpages=ceil($num_rows/$pagelen);
//
if(!isset($_REQUEST['page'])){
$_REQUEST['page']="";
}
//
if($page==""){
$page=$totalpages;
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

$start=($page-1)*$pagelen;

if(($totalpages>1) and ($totalpages<16)){
echo "<div align=center>";
echo "หน้า	";
			for($i=1; $i<=$totalpages; $i++)	{
					if($i==$page){
					echo "[<b><font size=+1 color=#990000>$i</font></b>]";
					}
					else {
					echo "<a href=$PHP_SELF?$url_link&page=$i&class_index=$class_index&room_index=$room_index>[$i]</a>";
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
			echo "<<a href=$PHP_SELF?$url_link&page=1&class_index=$class_index&room_index=$room_index>หน้าแรก </a>";
			echo "<<<a href=$PHP_SELF?$url_link&page=$f_page1&class_index=$class_index&room_index=$room_index>หน้าก่อน </a>";
			}
			else {
			echo "หน้า	";
			}					
			for($i=$s_page; $i<=$e_page; $i++){
					if($i==$page){
					echo "[<b><font size=+1 color=#990000>$i</font></b>]";
					}
					else {
					echo "<a href=$PHP_SELF?$url_link&page=$i&class_index=$class_index&room_index=$room_index>[$i]</a>";
					}
			}
			if($page<$totalpages)	{
			$f_page2=$page+1;
			echo "<a href=$PHP_SELF?$url_link&page=$f_page2&class_index=$class_index&room_index=$room_index> หน้าถัดไป</a>>>";
			echo "<a href=$PHP_SELF?$url_link&page=$totalpages&class_index=$class_index&room_index=$room_index> หน้าสุดท้าย</a>>";
			}
			echo " <select onchange=\"location.href=this.options[this.selectedIndex].value;\" size=\"1\" name=\"select\">";
			echo "<option  value=\"\">หน้า</option>";
				for($p=1;$p<=$totalpages;$p++){
				echo "<option  value=\"?$url_link&page=$p&class_index=$class_index&room_index=$room_index\">$p</option>";
				}
			echo "</select>";
echo "</div>";  
}					
//จบแยกหน้า

		//link เพิ่มข้อมูล
		echo  "<table width=95% border=0 align=center>";
		echo "<Tr><td>";
		
		//เลืิอกชั้น
		echo "<form id='frm1' name='frm1'>";
		echo "<div align='right'>";
		echo "<Select  name='class_index' size='1'>";
		echo  "<option  value = ''>ทุกชั้น</option>" ;
		$sql = "select * from  student_main_class order by class_code";
		$dbquery = mysql_query($sql);
		While ($result = mysql_fetch_array($dbquery))
		   {
		$class_name = $result['class_name'];
				if($result['class_code']==$class_index){
				$select="selected";
				}
				else{
				$select="";
				}
		echo  "<option value = $result[class_code] $select>$class_name</option>";
			}
		echo "</select>";
		
//เลือกห้อง		
if($class_index!=""){
		$sql_room = "select distinct room from student_main where status='0' and  class_now='$class_index' and room >= '1' order by room";
		$dbquery_room = mysql_query($sql_room);
		$room_num= mysql_num_rows($dbquery_room);
		if($room_num>=1){
		echo " <Select  name='room_index' size='1'>";
		echo  "<option  value = ''>ทุกห้อง</option>" ;
		While ($result_room = mysql_fetch_array($dbquery_room)){
		echo $class_index;
				if($result_room['room']==$room_index){
				echo  "<option  value = $result_room[room] selected>ห้องที่ $result_room[room]</option>" ;	
				}
				else{
				echo  "<option  value = '$result_room[room]'>ห้องที่ $result_room[room]</option>" ;	
				}
		}
		}
		echo "</select>";
}		
		
		echo "&nbsp;<INPUT TYPE='button' name='smb' value='เลือก' onclick='goto_index(1)' class=entrybutton>";
		echo "</div>";
		echo "</td></Tr></Table>";
		//จบส่วนเลือกประเภท

if($class_index!=""){
		if($room_index>=1){
		$sql = "select * from student_main where status='0' and  class_now='$class_index' and room='$room_index' order by class_now,room,student_number,student_id limit $start,$pagelen";
		}
		else{
		$sql = "select * from student_main where status='0' and  class_now='$class_index' order by class_now,room,student_number,student_id limit $start,$pagelen";
		}
}
else{
$sql = "select * from student_main where status='0' order by class_now,room,student_number,student_id limit $start,$pagelen";
}
$dbquery = mysql_query($sql);
echo  "<table width='95%' border='0' align='center'>";
echo "<Tr bgcolor=#FFCCCC align=center class=style2><td>เลือก</td><Td width='50'>ที่</Td><Td width='150'>เลขประจำตัวนักเรียน</Td><Td width='150'>เลขประจำตัวประชาชน</Td><Td width='50'>เลขที่</Td><Td>ชื่อ</Td><Td>เพศ</Td><Td width='120'>ชั้น</Td><Td width='40'>ห้อง</Td><Td width='50'>รูปภาพ</Td></Tr>";
$N=(($page-1)*$pagelen)+1;  //*เกี่ยวข้องกับการแยกหน้า
$M=1;
While ($result = mysql_fetch_array($dbquery))
	{
		$id = $result['id'];
		$student_id = $result['student_id'];	
		$person_id = $result['person_id'];	
		$student_number=$result['student_number'];		
		$prename=$result['prename'];
		$name= $result['name'];
		$surname = $result['surname'];
		$sex = $result['sex'];
			if($sex==1){
			$sex="ชาย";
			}
			else if($sex==2){
			$sex="หญิง";
			}
			else{
			$sex="";
			}
		$class_now= $result['class_now'];
		$room= $result['room'];
			if(($M%2) == 0)
			$color="#FFFFC";
			else  	$color="#FFFFFF";

echo "<Tr bgcolor='$color' align='center'><td><input type='checkbox' name='$student_id' value='1'></td><Td>$N</Td><Td>$student_id</Td><Td>$person_id</Td><Td>";
		if($student_number>0){
		echo $student_number;
		}
		else{
		echo "";
		}
echo "</Td><Td align='left'>$prename&nbsp;$name&nbsp;&nbsp;$surname</Td><Td align='center'>$sex</Td><Td align='left'>$class_ar[$class_now]</Td>";
if($room>0){	
echo "<Td align='center'>$room</Td>";
}
else{
echo "<Td align='center'>&nbsp;</Td>";
}
if($result['pic']!=""){
echo "<Td align='center'><a href='modules/student_main/pic_show.php?student_id=$student_id' target='_blank'><img src=images/admin/user.gif border='0' alt='รูปภาพ'></a></Td>";
}
else{
echo "<Td align='center'>&nbsp;</Td>";
}
echo "</Tr>";
	
$M++;
$N++;  //*เกี่ยวข้องกับการแยกหน้า
	}
echo "<Tr bgcolor='#FFCCCC'><Td colspan='10'><input type='checkbox' name='allchk' id='allchk' onclick='CheckAll()'>เลือก/ไม่เลือกทั้งหมด &nbsp;&nbsp;&nbsp;&nbsp;<INPUT TYPE='button' name='smb' value='เลื่อนชั้นทั้งหมดที่เลือก' onclick='goto_delete_all()'></Td></Tr>";
	
echo "</Table>";
echo "</form>";
}

?>
<script>

function goto_index(val){
	if(val==1){
		callfrm("?option=student_main&task=promote");   // page ย้อนกลับ 
		}
}

function goto_delete_all(){
			callfrm("?option=student_main&task=promote&index=3.1"); 
}

function CheckAll() {
	for (var i = 0; i < document.frm1.elements.length; i++)
	{
	var e = document.frm1.elements[i];
	if (e.name != "allchk")
		if(e.value==1 && e.type=="checkbox"){
		e.checked = document.frm1.allchk.checked;
		}
	}
}

</script>
