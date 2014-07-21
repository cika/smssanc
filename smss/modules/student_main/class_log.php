<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
//sd page 
$officer=$_SESSION['login_user_id'];

if(isset($_REQUEST['year_index'])){
$year_index=$_REQUEST['year_index'];
}else{
$year_index="";
}
if(isset($class_index)){
$class_index=$class_index;
}else{
$class_index="";
}
if(isset($_REQUEST['room_index'])){
$room_index=$_REQUEST['room_index'];
}else{
$room_index="";
}


//ปีการศึกษา
$sql = "select * from  student_main_edyear where year_active='1' order by ed_year desc limit 1";
$dbquery = mysql_query($sql);
$year_active_result = mysql_fetch_array($dbquery);
if($year_active_result['ed_year']==""){
echo "<br />";
echo "<div align='center'>ยังไม่ได้กำหนดทำงานในปีการศึกษาใด ๆ  กรุณาไปที่เมนูตั้งค่าระบบ เพื่อกำหนดปีทำงานปัจจุบัน</div>";
exit();
}

$sql = "select * from  student_main_class order by class_code";
$dbquery = mysql_query($sql);
While ($result = mysql_fetch_array($dbquery)){
$class_ar[$result['class_code']]=$result['class_name'];
}

echo "<br />";
if(!(($index==1) or ($index==2) or ($index==2.1) or ($index==5))){
echo "<table width='50%' border='0' align='center'>";
echo "<tr align='center'><td><font color='#006666' size='3'><strong>ประวัติชั้นเรียน ห้องเรียน ของนักเรียน จำแนกตามปีการศึกษา</strong></font></td></tr>";
echo "</table>";
}

//ส่วนยืนยันการลบข้อมูล
if($index==2) {
echo "<table width='500' border='0' align='center'>";
echo "<tr><td align='center'><font color='#990000' size='4'>โปรดยืนยันความต้องการลบข้อมูลอีกครั้ง</font><br></td></tr>";
echo "<tr><td align=center>";
echo "<INPUT TYPE='button' name='smb' value='ยืนยัน' onclick='location.href=\"?option=student_main&task=class_log&index=3&id=$_GET[id]&page=$_REQUEST[page]&class_index=$class_index&room_index=$room_index&year_index=$year_index\"'>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ยกเลิก' onclick='location.href=\"?option=student_main&task=class_log&page=$_REQUEST[page]&class_index=$class_index&room_index=$room_index&year_index=$year_index\"'";
echo "</td></tr></table>";
}

//ส่วนลบข้อมูล
if($index==3){
$sql = "delete from student_main_classlog where id=$_GET[id]";
$dbquery = mysql_query($sql);
}

//ส่วนฟอร์มแก้ไขข้อมูล
if ($index==5){
echo "<form id='frm1' name='frm1' Enctype = 'multipart/form-data'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>แก้ไขข้อมูลพื้นฐานนักเรียน</B></Font>";
echo "</Cener>";
echo "<Br><Br>";

$sql = "select student_main_classlog.id, student_main.student_id, student_main.person_id, student_main_classlog.student_number, student_main.prename, student_main.name, student_main.surname, student_main_classlog.ed_year, student_main_classlog.class_code, student_main_classlog.room from student_main_classlog left join student_main on student_main_classlog.student_id=student_main.student_id where student_main_classlog.id='$_GET[id]'";

$dbquery = mysql_query($sql);
$result = mysql_fetch_array($dbquery);
echo "<Table   width=70% Border=0 Bgcolor=#Fcf9d8>";
echo "<Tr align='left'><Td width=30></Td><Td align='right'>ปีการศึกษา&nbsp;&nbsp;</Td><Td>$result[ed_year]</Td></Tr>";
echo "<Tr align='left'><Td width=30></Td><Td align='right'>เลขประจำตัวนักเรียน&nbsp;&nbsp;</Td><Td>$result[student_id]</Td></Tr>";
echo "<Tr align='left'><Td width=30></Td><Td align='right'>เลขประจำตัวประชาชน&nbsp;&nbsp;</Td><Td>$result[person_id]</Td></Tr>";
echo "<Tr align='left'><Td width=30></Td><Td align='right'>คำนำหน้า&nbsp;&nbsp;</Td><Td>$result[prename]</Td></Tr>";
echo "<Tr align='left'><Td ></Td><Td align='right'>ชื่อ&nbsp;&nbsp;</Td><Td>$result[name]</Td></Tr>";
echo "<Tr align='left'><Td ></Td><Td align='right'>นามสกุล&nbsp;&nbsp;</Td><Td>$result[surname]</Td></Tr>";
echo "<Tr align='left'><Td width=30></Td><Td align='right'>เลขที่&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='student_number' Size='3' maxlenght='3' onkeydown='integerOnly()' value='$result[student_number]'></Td></Tr>";
echo "<Tr align='left'><Td ></Td><Td align='right'>ชั้น&nbsp;&nbsp;</Td><Td>";
echo "<Select  name='class_code' size='1'>";
echo  "<option  value = ''>เลือก</option>" ;

$sql = "select * from  student_main_class order by class_code";
$dbquery = mysql_query($sql);
While ($class_result = mysql_fetch_array($dbquery)){
	if($class_result['class_code']==$result['class_code']){
	echo  "<option  value ='$class_result[class_code]' selected>$class_result[class_name]</option>" ;
	}
	else{
	echo  "<option  value ='$class_result[class_code]'>$class_result[class_name]</option>" ;
	}
}	
echo "</select>";
echo "</Td></Tr>";
echo "<Tr align='left'><Td ></Td><Td align='right'>ห้อง(ถ้ามี)&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='room' Size='4' value='$result[room]'></Td></Tr>";
echo "</Table>";
echo "<Br />";
echo "<Input Type=Hidden Name='id' Value='$_GET[id]'>";
echo "<Input Type=Hidden Name='page' Value='$_GET[page]'>";
echo "<Input Type=Hidden Name='class_index' Value='$class_index'>";
echo "<Input Type=Hidden Name='room_index' Value='$room_index'>";

echo "<INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url_update(1)' class=entrybutton>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ย้อนกลับ' onclick='goto_url_update(0)' class=entrybutton'>";
echo "</form>";
}

//ส่วนปรับปรุงข้อมูล
if ($index==6){
$sql = "update student_main_classlog  set  student_number='$_POST[student_number]', class_code='$_POST[class_code]', room='$_POST[room]',officer='$officer' where id='$_POST[id]'";
$dbquery = mysql_query($sql);
}

//ส่วนเก็บ log ชั้นเรียน
if($index==9){
$rec_date = date("Y-m-d");
$sql = "select * from student_main where status='0' order by class_now,room,student_number,student_id";
$dbquery = mysql_query($sql);
While ($result = mysql_fetch_array($dbquery)){
			$sql_log = "select id from student_main_classlog where ed_year='$year_active_result[ed_year]' and  student_id='$result[student_id]' ";
			$dbquery_log = mysql_query($sql_log);
			$rows=mysql_num_rows($dbquery_log);
			if($rows>=1){
			$sql_update = "update student_main_classlog set student_number='$result[student_number]', class_code='$result[class_now]', room='$result[room]',officer='$officer',rec_date='$rec_date' where ed_year='$year_active_result[ed_year]' and  student_id='$result[student_id]' ";
			$dbquery_update = mysql_query($sql_update);
			}
			else{
			$sql_insert = "insert into student_main_classlog (ed_year, student_id,student_number,class_code,room,officer,rec_date) values ('$year_active_result[ed_year]','$result[student_id]','$result[student_number]','$result[class_now]','$result[room]','$officer','$rec_date')";
			$dbquery_insert = mysql_query($sql_insert);
			}
		}
}

//ส่วนการแสดงผล
if(!(($index==1) or ($index==2) or ($index==2.1) or ($index==5))){

//ส่วนของการแยกหน้า
$pagelen=45;  // 1_กำหนดแถวต่อหน้า
$url_link="option=student_main&task=class_log&year_index=$year_index";  // 2_กำหนดลิงค์

if($year_index==""){
$year_index=$year_active_result['ed_year'];
}
else{
$year_index=$year_index;
}

if($class_index!=""){
		if($room_index>=1){
		$sql = "select * from student_main_classlog where ed_year='$year_index' and class_code='$class_index' and room='$room_index' ";
		}
		else{
		$sql = "select * from student_main_classlog where ed_year='$year_index' and class_code='$class_index' ";
		}
}
else{
$sql = "select * from student_main_classlog where ed_year='$year_index'";
}
$dbquery = mysql_query($sql);
$num_rows=mysql_num_rows($dbquery);
$totalpages=ceil($num_rows/$pagelen);


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

		//เก็บ log ชั้นเรียน
		echo  "<table width=95% border=0 align=center>";
		echo "<Tr><td>";
		echo "<INPUT TYPE='button' name='smb' value='เก็บประวัติชั้นเรียนของนักเรียนปีการศึกษา $year_active_result[ed_year]' onclick='location.href=\"?option=student_main&task=class_log&index=9\"'>";
		echo "</td>";
		echo "<td align='right'>";
		
		//เลือกปีการศึกษา
		echo "<form id='frm1' name='frm1'>";
		echo "เลือกปีการศึกษา&nbsp;";		
		echo "<Select  name='year_index' size='1'>";
		echo  "<option  value = ''>เลือก</option>" ;
		$sql = "select * from  student_main_edyear order by ed_year desc";
		$dbquery = mysql_query($sql);
		While ($result = mysql_fetch_array($dbquery))
		   {
				if($_REQUEST['year_index']!=""){
				$year_active_result['ed_year']=$_REQUEST['year_index'];
				}
				if($result['ed_year']==$year_active_result['ed_year']){
				$yearselect="selected";
				}
				else{
				$yearselect="";
				}
		echo  "<option value = $result[ed_year] $yearselect>ปีการศึกษา $result[ed_year]</option>";
			}
		echo "</select>";
		
//เลือกชั้นเรียน
		echo "&nbsp;&nbsp;เลือกชั้นเรียน&nbsp;";		
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
		$sql_room = "select distinct room from student_main_classlog where class_code='$class_index' and room >= '1' order by room";
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
		
		echo "&nbsp;<INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_index(1)' class=entrybutton>";
		echo "</td></Tr></Table>";
		//จบส่วนเลือก
		
/////////////////////////////		

if($class_index!=""){
		if($room_index>=1){
$sql = "select student_main_classlog.id, student_main.student_id, student_main.person_id, student_main_classlog.student_number, student_main.prename, student_main.name, student_main.surname, student_main_classlog.ed_year, student_main_classlog.class_code, student_main_classlog.room from student_main_classlog left join student_main on student_main_classlog.student_id=student_main.student_id where student_main_classlog.ed_year='$year_index' and student_main_classlog.class_code= '$class_index' and student_main_classlog.room='$room_index' order by student_main_classlog.class_code,student_main_classlog.room,student_main_classlog.student_number,student_main_classlog.student_id limit $start,$pagelen";
		}
		else{
$sql = "select student_main_classlog.id, student_main.student_id, student_main.person_id, student_main_classlog.student_number, student_main.prename, student_main.name, student_main.surname, student_main_classlog.ed_year, student_main_classlog.class_code, student_main_classlog.room from student_main_classlog left join student_main on student_main_classlog.student_id=student_main.student_id where student_main_classlog.ed_year='$year_index' and student_main_classlog.class_code= '$class_index' order by student_main_classlog.class_code,student_main_classlog.room,student_main_classlog.student_number,student_main_classlog.student_id limit $start,$pagelen";
		}
}
else{
$sql = "select student_main_classlog.id, student_main.student_id, student_main.person_id, student_main_classlog.student_number, student_main.prename, student_main.name, student_main.surname, student_main_classlog.ed_year, student_main_classlog.class_code, student_main_classlog.room from student_main_classlog left join student_main on student_main_classlog.student_id=student_main.student_id where student_main_classlog.ed_year='$year_index' order by student_main_classlog.class_code,student_main_classlog.room,student_main_classlog.student_number,student_main_classlog.student_id limit $start,$pagelen";
}
$dbquery = mysql_query($sql);
echo  "<table width='95%' border='0' align='center'>";
echo "<Tr bgcolor=#FFCCCC align=center class=style2><Td width='50'>ที่</Td><Td width='150'>เลขประจำตัวนักเรียน</Td><Td width='150'>เลขประจำตัวประชาชน</Td><Td>ชื่อ</Td><Td>ปีการศึกษา</Td><Td width='120'>ชั้น</Td><Td width='40'>ห้อง</Td><Td width='50'>เลขที่</Td><Td width='40'>ลบ</Td><Td width='40'>แก้ไข</Td></Tr>";
$N=(($page-1)*$pagelen)+1;  //*เกี่ยวข้องกับการแยกหน้า
$M=1;
while ($result = mysql_fetch_array($dbquery))
	{
		$id = $result['id'];
		$student_id = $result['student_id'];	
		$person_id = $result['person_id'];	
		$student_number=$result['student_number'];		
		$prename=$result['prename'];
		$name= $result['name'];
		$surname = $result['surname'];
		$ed_year = $result['ed_year'];
		$class_now= $result['class_code'];
		$room= $result['room'];
			if(($M%2) == 0)
			$color="#FFFFC";
			else  	$color="#FFFFFF";

		$class_n=(!isset($class_ar[$class_now]))?"":$class_ar[$class_now];

echo "<Tr bgcolor='$color' align='center'><Td>$N</Td><Td>$student_id</Td><Td>$person_id</Td>";
//echo "<Td align='left'>$prename&nbsp;$name&nbsp;&nbsp;$surname</Td><Td align='center'>$ed_year</Td><Td align='left'>$class_ar[$class_now]</Td>";
echo "<Td align='left'>$prename&nbsp;$name&nbsp;&nbsp;$surname</Td><Td align='center'>$ed_year</Td><Td align='left'>$class_n</Td>";
if($room>0){	
echo "<Td align='center'>$room</Td>";
}
else{
echo "<Td align='center'>&nbsp;</Td>";
}

if($student_number>0){
echo "<Td align='center'>$student_number</Td>";
}
else{
echo "<Td align='center'>&nbsp;</Td>";
}

echo "<Td><div align='center'><a href=?option=student_main&task=class_log&index=2&id=$id&page=$page&class_index=$class_index&room_index=$room_index&year_index=$year_index><img src=images/drop.png border='0' alt='ลบ'></a></div></Td>
		<Td><a href=?option=student_main&task=class_log&index=5&id=$id&page=$page&class_index=$class_index&room_index=$room_index><img src=images/edit.png border='0' alt='แก้ไข'></a></div></Td>";
echo "</Tr>";
	
$M++;
$N++;  //*เกี่ยวข้องกับการแยกหน้า
	}
echo "</Table>";
echo "</form>";
}

?>
<script>

function goto_index(val){
	if(val==1){
		callfrm("?option=student_main&task=class_log");   // page ย้อนกลับ 
		}
}

function goto_url_update(val){
	if(val==0){
		callfrm("?option=student_main&task=class_log");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.class_code.value==""){
			alert("กรุณาเลือกชั้นเรียน");
		}else{
			callfrm("?option=student_main&task=class_log&index=6");   //page ประมวลผล
		}
	}
}

</script>

<?php
if($index==""){
echo "<br />";
echo "&nbsp;&nbsp;&nbsp;&nbsp;<b>หมายเหตุ</b>&nbsp;ประวัติชั้นเรียนเป็นบันทึกที่สำคัญ จะทำให้ย้อนดูว่าแต่ละปีการศึกษานักเรียนแต่ละคนอยู่ชั้นใด ห้องใด ผู้ดูแลระบบจำเป็นต้องทำการบันทึกไว้ทุกปีการศึกษา";
}
?>
