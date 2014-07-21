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
echo "<tr align='center'><td><font color='#006666' size='3'><strong>ข้อมูลนักเรียน ปีการศึกษา $year_active_result[ed_year]</strong></font></td></tr>";
echo "</table>";
}

//ฟังชั่นupload
function file_upload() {
		$uploaddir = 'modules/student_main/picture/';      //ที่เก็บไไฟล์
		$uploadfile = $uploaddir.basename($_FILES['userfile']['name']);
		$basename = basename($_FILES['userfile']['name']);
		//ลบไฟล์เดิม
		$exists_file=$uploaddir."pic_".$_POST['student_id'].substr($basename,-4);
		if(file_exists($exists_file)){
		unlink($exists_file);
		}
			
		if (move_uploaded_file($_FILES['userfile']['tmp_name'],  $uploadfile))
			{
				$txt ="pic_".$_POST['student_id'];
				$before_name  = $uploaddir.$basename;
				$changed_name = $uploaddir.$txt.substr($basename,-4) ;
				rename("$before_name" , "$changed_name");
				
		//ลดขนาดภาพ
				if(substr($basename,-3)=="jpg"){		
				$ori_file=$changed_name;
				$ori_size=getimagesize($ori_file);
				$ori_w=$ori_size[0];
				$ori_h=$ori_size[1];
					if($ori_w>500){
					$new_w=500;
					$new_h=round(($new_w/$ori_w)*$ori_h);
					$ori_img=imagecreatefromjpeg($ori_file);
					$new_img=imagecreatetruecolor($new_w, $new_h);
					imagecopyresized($new_img, $ori_img,0,0, 0,0, $new_w, $new_h, $ori_w, $ori_h);
					$new_file=$ori_file;
					imagejpeg($new_img, $new_file);
					imagedestroy($ori_img);
					imagedestroy($new_img);
					}	
				}						

									
			return  $changed_name;
			}
}

//ส่วนเพิ่มข้อมูล
if($index==1){
echo "<form Enctype = multipart/form-data id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>เพิ่มข้อมูลนักเรียน</B></Font>";
echo "</Cener>";
echo "<Br>";
echo "<Table   width=60% Border=0 Bgcolor=#Fcf9d8>";
echo "<Tr align='left'><Td width=30></Td><Td align='right'>เลขประจำตัวนักเรียน&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='student_id' Size='13' maxlenght='13' onkeydown='integerOnly()'></Td></Tr>";
echo "<Tr align='left'><Td width=30></Td><Td align='right'>เลขประจำตัวประชาชน&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='person_id' Size='13' maxlenght='13' onkeydown='integerOnly()'></Td></Tr>";
echo "<Tr align='left'><Td width=30></Td><Td align='right'>เลขที่&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='student_number' Size='3' maxlenght='3' onkeydown='integerOnly()'></Td></Tr>";
echo "<Tr align='left'><Td width=30></Td><Td align='right'>คำนำหน้า&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='prename' Size='15'></Td></Tr>";
echo "<Tr align='left'><Td ></Td><Td align='right'>ชื่อ&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='name'  Size='40'></Td></Tr>";
echo "<Tr align='left'><Td ></Td><Td align='right'>นามสกุล&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='surname'  Size='40'></Td></Tr>";
echo "<Tr align='left'><Td ></Td><Td align='right'>เพศ&nbsp;&nbsp;</Td><Td>";
echo "<Select  name='sex' size='1'>";
echo  "<option  value = '0'>เลือก</option>" ;
echo  "<option  value = '1'>ชาย</option>" ;
echo  "<option  value = '2'>หญิง</option>" ;
echo "</select>";
echo "</Td></Tr>";

echo "<Tr align='left'><Td ></Td><Td align='right'>ชั้นปัจจุบัน&nbsp;&nbsp;</Td><Td>";
echo "<Select  name='class_now' size='1'>";
echo  "<option  value = ''>เลือก</option>" ;

$sql = "select * from  student_main_class order by class_code";
$dbquery = mysql_query($sql);
While ($class_result = mysql_fetch_array($dbquery)){
echo  "<option  value ='$class_result[class_code]'>$class_result[class_name]</option>" ;
}	
echo "</select>";
echo "</Td></Tr>";
echo "<Tr align='left'><Td ></Td><Td align='right'>ห้อง(ถ้ามี)&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='room'  Size='4'>&nbsp;(กรณีมีห้องเรียนเดียวไม่ต้องกรอก)</Td></Tr>";

echo  "<tr align='left'>";
echo  "<Td ></Td><td align='right'>ไฟล์รูปภาพ&nbsp;&nbsp;</td>";
echo  "<td align='left'><input name = 'userfile' type = 'file'></td>";
echo  "</tr>";

echo "<Br>";
echo "</Table>";
echo "<Br>";
echo "<Input Type=Hidden Name='class_index' Value='$class_index'>";
echo "<Input Type=Hidden Name='room_index' Value='$room_index'>";
echo "<INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url(1)' class=entrybutton>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ย้อนกลับ' onclick='goto_url(0)' class=entrybutton'>";

echo "</form>";
}
//ส่วนยืนยันการลบข้อมูล
if($index==2) {
echo "<table width='500' border='0' align='center'>";
echo "<tr><td align='center'><font color='#990000' size='4'>โปรดยืนยันความต้องการลบข้อมูลอีกครั้ง</font><br></td></tr>";
echo "<tr><td align=center>";
echo "<INPUT TYPE='button' name='smb' value='ยืนยัน' onclick='location.href=\"?option=student_main&task=student&index=3&id=$_GET[id]&page=$_REQUEST[page]&class_index=$class_index&room_index=$room_index\"'>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ยกเลิก' onclick='location.href=\"?option=student_main&task=student&page=$_REQUEST[page]&class_index=$class_index&room_index=$room_index\"'";
echo "</td></tr></table>";
}

//ส่วนลบข้อมูล
if($index==3){
	$sql = "select pic from  student_main where id=$_GET[id]";
	$dbquery = mysql_query($sql);
	$select_result = mysql_fetch_array($dbquery);

	if($select_result['pic']!=""){
		unlink($select_result['pic']);
	}
	$sql = "delete from student_main where id=$_GET[id]";
	$dbquery = mysql_query($sql);
}

if($index==3.1){
	$fff="";
	foreach ($_POST as $student_id =>$student_value){
//$sql = "delete from student_main where student_id='$student_id'";
$fff=$student_id.",".$fff;
//$sql = "delete from student_main where student_id in(".$_POST['student_value'].")";
//$dbquery = mysql_query($sql);
//echo $student_id."<br>";
	}
	$ss=str_replace(",class_index,name_search,","",$fff);
	$ss=str_replace("allchk,","",$ss);
	//echo $ss;

	$sql = "select pic from  student_main where  student_id in($ss)";
	$dbquery = mysql_query($sql);
	while($select_result = mysql_fetch_array($dbquery)){
		if($select_result['pic']!=""){
			if(is_file($select_result['pic'])){
				unlink($select_result['pic']);
			}
		}
	}

	$sql = "delete from student_main where student_id in($ss)";
	$dbquery = mysql_query($sql);
}



//ส่วนเพิ่มข้อมูล
if($index==4){
$rec_date = date("Y-m-d");

if($_POST['person_id']!=""){
$sql = "select * from student_main where  person_id='$_POST[person_id]' ";
$dbquery = mysql_query($sql);
	if(mysql_num_rows($dbquery)>=1){
	echo "<br /><div align='center'>มีเลขประจำตัวประชาชนซ้ำกับรายการที่มีอยู่แล้ว ตรวจสอบอีกครั้ง</div>";
	exit();  
	}
}

$sql = "select * from student_main where student_id='$_POST[student_id]' ";
$dbquery = mysql_query($sql);
if(mysql_num_rows($dbquery)>=1){
echo "<br /><div align='center'>มีเลขประจำตัวนักเรียนซ้ำกับรายการที่มีอยู่แล้ว ตรวจสอบอีกครั้ง</div>";
exit();  
}

$basename = basename($_FILES['userfile']['name']);
if ($basename!="")
{
$changed_name = file_upload();
}else{
$changed_name="";
}

$sql = "insert into student_main (student_id,person_id,student_number,prename,name,surname,sex,pic,class_now,room,officer,rec_date) values ('$_POST[student_id]','$_POST[person_id]','$_POST[student_number]','$_POST[prename]','$_POST[name]','$_POST[surname]','$_POST[sex]','$changed_name','$_POST[class_now]','$_POST[room]','$officer','$rec_date')";
$dbquery = mysql_query($sql);
}

//ส่วนฟอร์มแก้ไขข้อมูล
if ($index==5){
echo "<form id='frm1' name='frm1' Enctype = 'multipart/form-data'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>แก้ไขข้อมูลพื้นฐานนักเรียน</B></Font>";
echo "</Cener>";
echo "<Br><Br>";
$sql = "select * from  student_main where id='$_GET[id]'";
$dbquery = mysql_query($sql);
$result = mysql_fetch_array($dbquery);
echo "<Table width='70%' Border='0' Bgcolor='#Fcf9d8'>";
echo "<Tr align='left'><Td width=30></Td><Td align='right'>เลขประจำตัวนักเรียน&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='student_id' Size='13' maxlenght='13' onkeydown='integerOnly()' value='$result[student_id]'></Td></Tr>";
echo "<Tr align='left'><Td width=30></Td><Td align='right'>เลขประจำตัวประชาชน&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='person_id' Size='13' maxlenght='13' onkeydown='integerOnly()' value='$result[person_id]'></Td></Tr>";
echo "<Tr align='left'><Td width=30></Td><Td align='right'>เลขที่&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='student_number' Size='3' maxlenght='3' onkeydown='integerOnly()' value='$result[student_number]'></Td></Tr>";
echo "<Tr align='left'><Td width=30></Td><Td align='right'>คำนำหน้า&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='prename' Size='15' value='$result[prename]'></Td></Tr>";
echo "<Tr align='left'><Td ></Td><Td align='right'>ชื่อ&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='name'  Size='40' value='$result[name]'></Td></Tr>";
echo "<Tr align='left'><Td ></Td><Td align='right'>นามสกุล&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='surname'  Size='40' value='$result[surname]'></Td></Tr>";

echo "<Tr align='left'><Td ></Td><Td align='right'>เพศ&nbsp;&nbsp;</Td><Td>";
echo "<Select  name='sex' size='1'>";
	if($result['sex']==1){
	$select_1="selected";
	$select_2="";
	}
	else if($result['sex']==2){
	$select_1="";
	$select_2="selected";
	}
	else{
	$select_1="";
	$select_2="";
	}
echo  "<option  value = '0'>เลือก</option>" ;
echo  "<option  value = '1' $select_1>ชาย</option>" ;
echo  "<option  value = '2' $select_2>หญิง</option>" ;
echo "</select>";
echo "</Td></Tr>";

echo "<Tr align='left'><Td ></Td><Td align='right'>ชั้นปัจจุบัน&nbsp;&nbsp;</Td><Td>";
echo "<Select  name='class_now' size='1'>";
echo  "<option  value = ''>เลือก</option>" ;

$sql = "select * from  student_main_class order by class_code";
$dbquery = mysql_query($sql);
While ($class_result = mysql_fetch_array($dbquery)){
	if($class_result['class_code']==$result['class_now']){
	echo  "<option  value ='$class_result[class_code]' selected>$class_result[class_name]</option>" ;
	}
	else{
	echo  "<option  value ='$class_result[class_code]'>$class_result[class_name]</option>" ;
	}
}	
echo "</select>";
echo "</Td></Tr>";
echo "<Tr align='left'><Td ></Td><Td align='right'>ห้อง(ถ้ามี)&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='room' Size='4' value='$result[room]'></Td></Tr>";

echo  "<tr align='left'>";
echo  "<Td ></Td><td align='right'>ไฟล์รูปภาพ&nbsp;&nbsp;</td>";
echo  "<td align='left'><input name = 'userfile' type = 'file'></td>";
echo  "</tr>";

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

		if($_POST['person_id']!=""){
		$sql = "select * from student_main where  person_id='$_POST[person_id]' and id!='$_POST[id]'";
		$dbquery = mysql_query($sql);
			if(mysql_num_rows($dbquery)>=1){
			echo "<br /><div align='center'>มีเลขประจำตัวประชาชนซ้ำกับรายการที่มีอยู่แล้ว ตรวจสอบอีกครั้ง</div>";
			exit();  
			}
		}
		
		$sql = "select * from student_main where student_id='$_POST[student_id]' and id!='$_POST[id]'";
		$dbquery = mysql_query($sql);
		if(mysql_num_rows($dbquery)>=1){
		echo "<br /><div align='center'>มีเลขประจำตัวนักเรียนซ้ำกับรายการที่มีอยู่แล้ว ตรวจสอบอีกครั้ง</div>";
		exit();  
		}

		$basename = basename($_FILES['userfile']['name']);
		if ($basename!=""){
		$changed_name = file_upload();
		$sql = "update student_main set student_id='$_POST[student_id]', person_id='$_POST[person_id]', student_number='$_POST[student_number]', prename='$_POST[prename]', name='$_POST[name]', surname='$_POST[surname]', sex='$_POST[sex]', pic='$changed_name', class_now='$_POST[class_now]', room='$_POST[room]',officer='$officer' where id='$_POST[id]'";
		}
		else{
		$sql = "update student_main set student_id='$_POST[student_id]', person_id='$_POST[person_id]', student_number='$_POST[student_number]', prename='$_POST[prename]', name='$_POST[name]', surname='$_POST[surname]', sex='$_POST[sex]', class_now='$_POST[class_now]', room='$_POST[room]',officer='$officer' where id='$_POST[id]'";
		}
$dbquery = mysql_query($sql);
}

//ส่วนการแสดงผล
if(!(($index==1) or ($index==2) or ($index==2.1) or ($index==5))){

//ส่วนของการแยกหน้า
$pagelen=45;  // 1_กำหนดแถวต่อหน้า
$url_link="option=student_main&task=student";  // 2_กำหนดลิงค์

if($index==8 and ($_POST['name_search']!="")){
$sql = "select * from student_main where status='0' and name like '%$_POST[name_search]%' ";
}
else if($class_index!=""){
		if($room_index>=1){
		$sql = "select * from student_main where status='0' and class_now='$class_index' and room='$room_index' ";
		}
		else{
		$sql = "select * from student_main where status='0' and class_now='$class_index' ";
		}
}
else{
$sql = "select * from student_main where status='0'";
}
$dbquery = mysql_query($sql);
$num_rows=mysql_num_rows($dbquery);
$totalpages=ceil($num_rows/$pagelen);
//
if(!isset($_REQUEST['page'])){
$_REQUEST['page']="";
}
//
if($_REQUEST['page']==""){
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
		echo "<Tr><Td align='left'><INPUT TYPE='button' name='smb' value='เพิ่มข้อมูล' onclick='location.href=\"?option=student_main&task=student&index=1&class_index=$class_index&room_index=$room_index\"'></Td>";
		echo "<td>";
		echo "<form id='frm1' name='frm1'>";
		echo "<div align='right'>";
	
		//ค้นหานักเรียน
		echo "ค้นหานักเรียนด้วยชื่อ(กรอกเฉพาะชื่อเท่านั้น)&nbsp;<Input Type='Text' Name='name_search'>";
		echo "&nbsp;<INPUT TYPE='button' name='smb' value='ค้น' onclick='goto_index(2)'>";
		echo "&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;";
		
		//เลือกชั้น
		echo "<Select  name='class_index' size='1'>";
		echo  "<option  value = ''>ทุกชั้น</option>" ;
		$sql = "select * from  student_main_class order by class_code";
		$dbquery = mysql_query($sql);
		While ($result = mysql_fetch_array($dbquery))
		   {
		$class_name = $result['class_name'];
				if($result['class_code']==$_REQUEST['class_index']){
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
		echo $_REQUEST['class_index'];
				if($result_room['room']==$_REQUEST['room_index']){
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
		
if($index==8 and ($_POST['name_search']!="")){
$sql = "select * from student_main where status='0' and name like '%$_POST[name_search]%' order by class_now,room,student_number,student_id";
}		
else if($class_index!=""){
		if($room_index>=1){
		$sql = "select * from student_main where status='0' and class_now='$class_index' and room='$room_index' order by class_now,room,student_number,student_id limit $start,$pagelen";
		}
		else{
		$sql = "select * from student_main where status='0' and class_now='$class_index' order by class_now,room,student_number,student_id limit $start,$pagelen";
		}
}
else{
$sql = "select * from student_main where status='0' order by class_now,room,student_number,student_id limit $start,$pagelen";
}

$dbquery = mysql_query($sql);
echo  "<table width=95% border=0 align=center>";
echo "<Tr bgcolor=#FFCCCC align=center class=style2><Td width='50'>ที่</Td><Td width='150'>เลขประจำตัวนักเรียน</Td><Td width='150'>เลขประจำตัวประชาชน</Td><Td width='50'>เลขที่</Td><Td>ชื่อ</Td><Td>เพศ</Td><Td width='120'>ชั้น</Td><Td width='40'>ห้อง</Td><Td width='50'>รูปภาพ</Td><Td  width=40>ลบ</Td><Td  width=40>แก้ไข</Td></Tr>";
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

echo "<Tr  bgcolor=$color align=center class=style1><Td><input type='checkbox' name='$student_id' value='1'>$N</Td><Td>$student_id</Td><Td>$person_id</Td><Td>";
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
echo "<Td><div align='center'><a href=?option=student_main&task=student&index=2&id=$id&page=$page&class_index=$class_index&room_index=$room_index><img src=images/drop.png border='0' alt='ลบ'></a></div></Td>
		<Td><a href=?option=student_main&task=student&index=5&id=$id&page=$page&class_index=$class_index&room_index=$room_index><img src=images/edit.png border='0' alt='แก้ไข'></a></div></Td>
	</Tr>";
	
$M++;
$N++;  //*เกี่ยวข้องกับการแยกหน้า
	}
echo "<Tr bgcolor='#FFCCCC'><Td colspan='11'><input type='checkbox' name='allchk' id='allchk' onclick='CheckAll()'>เลือก/ไม่เลือกทั้งหมด &nbsp;&nbsp;&nbsp;&nbsp;<INPUT TYPE='button' name='smb' value='ลบทั้งหมดที่เลือก' onclick='goto_delete_all()'></Td></Tr>";
	
echo "</Table>";
echo "</form>";
}

?>
<script>
function goto_url(val){
	if(val==0){
		callfrm("?option=student_main&task=student");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.student_id.value == ""){
			alert("กรุณากรอกเลขประจำตัวนักเรียน");
		}else if(frm1.prename.value==""){
			alert("กรุณากรอกคำนำหน้าชื่อ");
		}else if(frm1.name.value==""){
			alert("กรุณากรอกชื่อ");
		}else if(frm1.surname.value==""){
			alert("กรุณากรอกนามสกุล");
		}else if(frm1.sex.value==""){
			alert("กรุณาเลือกเพศ");
		}else if(frm1.class_now.value==""){
			alert("กรุณาเลือกชั้นเรียนปัจจุบัน");
		}else{
			callfrm("?option=student_main&task=student&index=4");   //page ประมวลผล
		}
	}
}

function goto_url_update(val){
	if(val==0){
		callfrm("?option=student_main&task=student");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.student_id.value == ""){
			alert("กรุณากรอกเลขประจำตัวนักเรียน");
		}else if(frm1.prename.value==""){
			alert("กรุณากรอกคำนำหน้าชื่อ");
		}else if(frm1.name.value==""){
			alert("กรุณากรอกชื่อ");
		}else if(frm1.surname.value==""){
			alert("กรุณากรอกนามสกุล");
		}else if(frm1.class_now.value==""){
			alert("กรุณาเลือกชั้นเรียนปัจจุบัน");
		}else{
			callfrm("?option=student_main&task=student&index=6");   //page ประมวลผล
		}
	}
}

function goto_index(val){
	if(val==1){
		callfrm("?option=student_main&task=student"); 
		}
	if(val==2){
		callfrm("?option=student_main&task=student&index=8"); 
		}
}

function goto_delete_all(){
			callfrm("?option=student_main&task=student&index=3.1"); 
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