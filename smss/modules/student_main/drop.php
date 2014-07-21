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

if(isset($_REQUEST['year_index'])){
	$year_index=$_REQUEST['year_index'];
}else{
	$year_index="";
}

if(isset($_REQUEST['room_index'])){
	$room_index=$_REQUEST['room_index'];
}else{
	$room_index="";
}

if(isset($_REQUEST['page'])){
	$page=$_REQUEST['page'];
}else{
	$page="";
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
if(!(($index==1) or ($index==5) or ($index==9))){
echo "<table width='50%' border='0' align='center'>";
echo "<tr align='center'><td><font color='#006666' size='3'><strong>นักเรียนออกกลางคัน</strong></font></td></tr>";
echo "</table>";
}

//ส่วนฟอร์มแก้ไขข้อมูล
if ($index==5){
echo "<form id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>แก้ไขข้อมูลนักเรียนออกกลางคัน</B></Font>";
echo "</Cener>";
echo "<Br><Br>";
$sql = "select * from  student_main where id='$_GET[id]'";
$dbquery = mysql_query($sql);
$result = mysql_fetch_array($dbquery);
echo "<Table width='70%' Border='0' Bgcolor=#Fcf9d8>";
echo "<Tr align='left'><Td align='right'>เลขประจำตัวนักเรียน&nbsp;&nbsp;</Td><Td>$result[student_id]</Td></Tr>";
echo "<Tr align='left'><Td align='right'>เลขประจำตัวประชาชน&nbsp;&nbsp;</Td><Td>$result[person_id]</Td></Tr>";
echo "<Tr align='left'><Td align='right'>เลขที่&nbsp;&nbsp;</Td><Td>$result[student_number]</Td></Tr>";
echo "<Tr align='left'><Td align='right'>คำนำหน้า&nbsp;&nbsp;</Td><Td>$result[prename]</Td></Tr>";
echo "<Tr align='left'><Td align='right'>ชื่อ&nbsp;&nbsp;</Td><Td>$result[name]</Td></Tr>";
echo "<Tr align='left'><Td align='right'>นามสกุล&nbsp;&nbsp;</Td><Td>$result[surname]</Td></Tr>";
$class_name=$class_ar[$result['class_now']];
echo "<Tr align='left'><Td align='right'>ชั้นปัจจุบัน&nbsp;&nbsp;</Td><Td>$class_name</Td></Tr>";
echo "<Tr align='left'><Td align='right'>ห้อง&nbsp;&nbsp;</Td><Td>$result[room]</Td></Tr>";
echo "<Tr align='left'><Td align='right'>การออกกลางคัน&nbsp;&nbsp;</Td><Td>";
echo "<Select  name='status' size='1'>";
	if($result['status']==3){
	$select="selected";
	}
	else{
	$select="";
	}
echo  "<option  value = '0'>ไม่ออกกลางค้น</option>" ;
echo  "<option  value = '3' $select>ออกกลางคัน</option>" ;
echo "</select>";
echo "</Td></Tr>";
echo "<tr align='left'><Td align='right'><INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url_update(1)' class=entrybutton>
		&nbsp;&nbsp;</Td><Td align='left'><INPUT TYPE='button' name='back' value='ย้อนกลับ' onclick='goto_url_update(0)' class=entrybutton'></Td></tr>";
echo "</Table>";
echo "<Input Type=Hidden Name='id' Value='$_GET[id]'>";
echo "<Input Type=Hidden Name='page' Value='$_GET[page]'>";
echo "<Input Type=Hidden Name='class_index' Value='$class_index'>";
echo "<Input Type=Hidden Name='room_index' Value='$room_index'>";
echo "</form>";
}
//ส่วนปรับปรุงข้อมูล
if ($index==6){
	if($_POST['status']==0){
	$sql = "update student_main set status='$_POST[status]', out_edyear='0' where id='$_POST[id]'";
	}
	$dbquery = mysql_query($sql);
}

//ส่วนของการเพิ่มนักเรียนออกกลางคัน
if($index==9){
echo "<table width='50%' border='0' align='center'>";
echo "<tr align='center'><td><font color='#006666' size='3'><strong>เพิ่มนักเรียนออกกลางคัน</strong></font></td></tr>";
echo "</table>";
	//ส่วนของการแยกหน้า
$pagelen=45;  // 1_กำหนดแถวต่อหน้า
$url_link="option=student_main&task=drop&index=9";  // 2_กำหนดลิงค์ฺ
if($class_index!=""){
		if($room_index>=1){
		$sql = "select * from student_main where class_now='$class_index' and room='$room_index' and status='0' ";
		}
		else{
		$sql = "select * from student_main where class_now='$class_index' and status='0' ";
		}
}
else{
$sql = "select * from student_main where status='0' ";
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

		//link เพิ่มข้อมูล
		echo  "<table width=95% border=0 align=center>";
		echo "<Tr><td align='right'>";
		echo "<form id='frm1' name='frm1'>";
		
//เลือกปีการศึกษา		
		echo "เลือกปีการศึกษา(ที่ย้าย)&nbsp;";		
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
		
//เลือกชั้น		
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
		$sql_room = "select distinct room from student_main where class_now='$class_index' and room >= '1' and status='0' order by room";
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
		
		echo "&nbsp;<INPUT TYPE='button' name='smb' value='เลือก' onclick='goto_index(2)' class=entrybutton>";
		echo "</td></Tr></Table>";
		//จบส่วนเลือกประเภท

if($class_index!=""){
		if($room_index>=1){
		$sql = "select * from student_main where class_now='$class_index' and room='$room_index' and status='0' order by class_now,room,student_number,student_id limit $start,$pagelen";
		}
		else{
		$sql = "select * from student_main where class_now='$class_index' and status='0' order by class_now,room,student_number,student_id limit $start,$pagelen";
		}
}
else{
$sql = "select * from student_main where status='0' order by class_now,room,student_number,student_id limit $start,$pagelen";
}
$dbquery = mysql_query($sql);
echo  "<table width='95%' border='0' align='center'>";
echo "<Tr bgcolor=#FFCCCC align=center class=style2><td>เลือก</td><Td width='50'>ที่</Td><Td width='150'>เลขประจำตัวนักเรียน</Td><Td width='150'>เลขประจำตัวประชาชน</Td><Td width='50'>เลขที่</Td><Td>ชื่อ</Td><Td>เพศ</Td><Td width='120'>ชั้น</Td><Td width='40'>ห้อง</Td></Tr>";
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
echo "</Tr>";
	
$M++;
$N++;  //*เกี่ยวข้องกับการแยกหน้า
	}
echo "<Tr bgcolor='#FFCCCC'><Td colspan='11'><input type='checkbox' name='allchk' id='allchk' onclick='CheckAll()'>เลือก/ไม่เลือกทั้งหมด &nbsp;&nbsp;&nbsp;&nbsp;<INPUT TYPE='button' name='smb' value='นักเรียน(ที่เลือก)ออกกลางคัน' onclick='goto_finish_all()'></Td></Tr>";
	
echo "</Table>";
echo "</form>";
}

//ส่วนการจบการศึกษา
if($index==10){
	if($year_index==""){
	$year_index=$year_active_result['ed_year'];
	}
	else{
	$year_index=$year_index;
	}

	foreach ($_POST as $student_id =>$student_value){
	$sql = "update student_main set status='3', out_edyear='$year_index' where student_id='$student_id'";
	$dbquery = mysql_query($sql);
	}
}

//ส่วนการแสดงผล
if(!(($index==1) or ($index==5) or ($index==9))){

if($year_index==""){
$year_index=$year_active_result['ed_year'];
}
else{
$year_index=$year_index;
}

//ส่วนของการแยกหน้า
$pagelen=45;  // 1_กำหนดแถวต่อหน้า
$url_link="option=student_main&task=drop";  // 2_กำหนดลิงค์ฺ
if($class_index!=""){
		if($room_index>=1){
		$sql = "select * from student_main where out_edyear='$year_index' and class_now='$class_index' and room='$room_index' and status='3'  ";
		}
		else{
		$sql = "select * from student_main where out_edyear='$year_index' and class_now='$class_index' and status='3' ";
		}
}
else{
$sql = "select * from student_main where out_edyear='$year_index' and status='3'";
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

		//link เพิ่มข้อมูล
		echo  "<table width=95% border=0 align=center>";
		echo "<Tr><td align='left'>";
		echo "<INPUT TYPE='button' name='smb' value='เพิ่มข้อมูลนักเรียนออกกลางคัน' onclick='location.href=\"?option=student_main&task=drop&index=9\"'>";
		echo "</td>";
		
		echo "<td align='right'>";
		echo "<form id='frm1' name='frm1'>";
		
//เลือกปีการศึกษา		
		echo "เลือกปีการศึกษา(ที่ออก)&nbsp;";		
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
		
//เลือกชั้น		
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
		$sql_room = "select distinct room from student_main where  out_edyear='$year_index' and class_now='$class_index' and room >= '1' and status='3' order by room";
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
		echo "</td></Tr></Table>";
		//จบส่วนเลือกประเภท

if($class_index!=""){
		if($room_index>=1){
		$sql = "select * from student_main where out_edyear='$year_index' and class_now='$class_index' and room='$room_index' and status='3' order by class_now,room,student_number,student_id limit $start,$pagelen";
		}
		else{
		$sql = "select * from student_main where out_edyear='$year_index' and class_now='$class_index' and status='3' order by class_now,room,student_number,student_id limit $start,$pagelen";
		}
}
else{
$sql = "select * from student_main where out_edyear='$year_index' and status='3' order by class_now,room,student_number,student_id limit $start,$pagelen";
}
$dbquery = mysql_query($sql);
echo  "<table width='95%' border='0' align='center'>";
echo "<Tr bgcolor='#FFCCCC' align='center'><Td width='50'>ที่</Td><Td width='150'>เลขประจำตัวนักเรียน</Td><Td width='150'>เลขประจำตัวประชาชน</Td><Td width='50'>เลขที่</Td><Td>ชื่อ</Td><Td>เพศ</Td><Td width='120'>ชั้น</Td><Td width='40'>ห้อง</Td><Td width='40'>แก้ไข</Td></Tr>";
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

echo "<Tr bgcolor='$color' align='center'><Td>$N</Td><Td>$student_id</Td><Td>$person_id</Td><Td>";
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
echo "<td><a href=?option=student_main&task=drop&index=5&id=$id&page=$page&class_index=$class_index&room_index=$room_index><img src=images/edit.png border='0' alt='แก้ไข'></a></td>";
echo "</Tr>";
	
$M++;
$N++;  //*เกี่ยวข้องกับการแยกหน้า
	}
echo "</Table>";
echo "</form>";
}


?>
<script>

function goto_url_update(val){
	if(val==0){
		callfrm("?option=student_main&task=drop");   // page ย้อนกลับ 
	}else if(val==1){
	callfrm("?option=student_main&task=drop&index=6");   //page ประมวลผล
	}
}

function goto_index(val){
	if(val==1){
		callfrm("?option=student_main&task=drop");   // page ย้อนกลับ 
		}
	else if(val==2){
		callfrm("?option=student_main&task=drop&index=9");   // page ย้อนกลับ 
		}
}

function goto_finish_all(){
			callfrm("?option=student_main&task=drop&index=10"); 
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
