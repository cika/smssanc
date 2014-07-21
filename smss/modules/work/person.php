<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
//sd page 
$officer=$_SESSION['login_user_id'];

$sql = "select * from  person_position order by position_code";
$dbquery = mysql_db_query($dbname, $sql);
While ($result = mysql_fetch_array($dbquery)){
$position_ar[$result[position_code]]=$result['position_name'];
}

$sql = "select * from  system_workgroup order by workgroup_order";
$dbquery = mysql_db_query($dbname, $sql);
While ($result = mysql_fetch_array($dbquery)){
$department_ar[$result[workgroup]]=$result['workgroup_desc'];
}

echo "<br />";
if(!(($index==1) or ($index==2) or ($index==2.1) or ($index==5))){
echo "<table width='50%' border='0' align='center'>";
echo "<tr align='center'><td><font color='#006666' size='3'><strong>ข้อมูลบุคลากรปัจจุบัน</strong></font></td></tr>";
echo "</table>";
}

//ฟังชั่นupload
function file_upload() {
		$uploaddir = 'modules/person/picture/';      //ที่เก็บไไฟล์
		$uploadfile = $uploaddir.basename($_FILES['userfile']['name']);
		$basename = basename($_FILES['userfile']['name']);
		
		$pic_code=$_POST[person_id];
		//ลบไฟล์เดิม
		$exists_file=$uploaddir.$pic_code.substr($basename,-4);
		if(file_exists($exists_file)){
		unlink($exists_file);
		}
			
		if (move_uploaded_file($_FILES['userfile']['tmp_name'],  $uploadfile))
			{
				$before_name  = $uploaddir.$basename;
				$changed_name = $uploaddir.$pic_code.substr($basename,-4) ;
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
echo "<Font color='#006666' Size=3><B>เพิ่มข้อมูลบุคลากร</B></Font>";
echo "</Cener>";
echo "<Br><Br>";
echo "<Table   width=60% Border=0 Bgcolor=#Fcf9d8>";
echo "<Tr align='left'><Td width=30></Td><Td align='right'>เลขประจำตัวประชาชน&nbsp;&nbsp;&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='person_id' Size='13' maxlenght='13' onkeydown='integerOnly()'></Td></Tr>";
echo "<Tr align='left'><Td width=30></Td><Td align='right'>คำนำหน้าชื่อ&nbsp;&nbsp;&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='prename' Size='15'></Td></Tr>";
echo "<Tr align='left'><Td ></Td><Td align='right'>ชื่อ&nbsp;&nbsp;&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='name'  Size='40'></Td></Tr>";
echo "<Tr align='left'><Td ></Td><Td align='right'>นามสกุล&nbsp;&nbsp;&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='surname'  Size='40'></Td></Tr>";
echo "<Tr align='left'><Td ></Td><Td align='right'>ตำแหน่ง&nbsp;&nbsp;&nbsp;&nbsp;</Td><Td>";
echo "<Select  name='position_code' size='1'>";
echo  "<option  value = ''>เลือก</option>" ;

$sql = "select * from  person_position order by position_code";
$dbquery = mysql_db_query($dbname, $sql);
While ($person_result = mysql_fetch_array($dbquery)){
echo  "<option  value ='$person_result[position_code]'>$person_result[position_code] $person_result[position_name]</option>" ;
}	
echo "</select>";
echo "</Td></Tr>";

echo "<Tr align='left'><Td ></Td><Td align='right'>ลำดับบุคคลในตำแหน่ง&nbsp;&nbsp;&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='person_order'  Size='4'></Td></Tr>";

echo "<Tr align='left'><Td ></Td><Td align='right'>กลุ่ม&nbsp;&nbsp;&nbsp;&nbsp;</Td><Td>";
echo "<Select  name='department' size='1'>";
echo  "<option  value = ''>เลือก</option>" ;
$sql = "select * from  system_workgroup order by workgroup_order";
$dbquery = mysql_db_query($dbname, $sql);
While ($work_group_result = mysql_fetch_array($dbquery)){
echo  "<option  value ='$work_group_result[workgroup]'>$work_group_result[workgroup_desc]</option>" ;
}	
echo "</select>";
echo "</Td></Tr>";

echo  "<tr align='left'>";
echo  "<Td ></Td><td align='right'>ไฟล์รูปภาพ&nbsp;&nbsp;</td>";
echo  "<td align='left'><input name = 'userfile' type = 'file'></td>";
echo  "</tr>";

echo "<Br>";
echo "</Table>";
echo "<Br>";
echo "<INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url(1)' class=entrybutton>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ย้อนกลับ' onclick='goto_url(0)' class=entrybutton'>";

echo "</form>";
}
//ส่วนยืนยันการลบข้อมูล
if($index==2) {
echo "<table width='500' border='0' align='center'>";
echo "<tr><td align='center'><font color='#990000' size='4'>โปรดยืนยันความต้องการลบข้อมูลอีกครั้ง</font><br></td></tr>";
echo "<tr><td align=center>";
echo "<INPUT TYPE='button' name='smb' value='ยืนยัน' onclick='location.href=\"?option=person&task=person&index=3&id=$_GET[id]\"'>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ยกเลิก' onclick='location.href=\"?option=person&task=person\"'";
echo "</td></tr></table>";
}
if($index==2.1) {
echo "<table width='500' border='0' align='center'>";
echo "<tr><td align='center'><font color='#990000' size='4'>! หากกดปุ่มยืนยัน ข้อมูลบุคลากรทั้งหมดจะถูกลบ</font></td></tr>";
echo "<tr><td align='center'><font color='#990000' size='4'>โปรดยืนยันความต้องการลบข้อมูลอีกครั้ง</font><br></td></tr>";
echo "<tr><td align=center>";
echo "<INPUT TYPE='button' name='smb' value='ยืนยัน' onclick='location.href=\"?option=person&task=person&index=3.1&id=$_GET[id]\"'>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ยกเลิก' onclick='location.href=\"?option=person&task=person\"'";
echo "</td></tr></table>";
}


//ส่วนลบข้อมูล
if($index==3){
$sql = "delete from person_main where id=$_GET[id]";
$dbquery = mysql_db_query($dbname, $sql);
}
if($index==3.1){
$sql = "delete from person_main where status='0' ";
$dbquery = mysql_db_query($dbname, $sql);
}

//ส่วนเพิ่มข้อมูล
if($index==4){
$rec_date = date("Y-m-d");

$sql = "select * from person_main where  person_id='$_POST[person_id]' ";
$dbquery = mysql_db_query($dbname, $sql);
if(mysql_num_rows($dbquery)>=1){
echo "<br /><div align='center'>มีเลขประจำตัวประชาชนซ้ำกับรายการที่มีอยู่แล้ว ตรวจสอบอีกครั้ง</div>";
exit();  
}

$basename = basename($_FILES['userfile']['name']);
if ($basename!="")
{
$changed_name = file_upload();
}

$sql = "insert into person_main (person_id,prename,name,surname,position_code,pic,department,status,person_order,officer,rec_date) values ( '$_POST[person_id]','$_POST[prename]','$_POST[name]','$_POST[surname]','$_POST[position_code]','$changed_name','$_POST[department]','0','$_POST[person_order]','$officer','$rec_date')";
$dbquery = mysql_db_query($dbname, $sql);
}
//ส่วนฟอร์มแก้ไขข้อมูล
if ($index==5){
echo "<form Enctype = multipart/form-data id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>แก้ไขข้อมูลบุคลากร</B></Font>";
echo "</Cener>";
echo "<Br><Br>";
$sql = "select * from  person_main where id='$_GET[id]'";
$dbquery = mysql_db_query($dbname, $sql);
$result = mysql_fetch_array($dbquery);
echo "<Table   width=70% Border=0 Bgcolor=#Fcf9d8>";
echo "<Tr align='left'><Td width=30></Td><Td align='right'>เลขประจำตัวประชาชน&nbsp;&nbsp;&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='person_id' Size='13' maxlenght='13' onkeydown='integerOnly()' value='$result[person_id]'></Td></Tr>";
echo "<Tr align='left'><Td width=30></Td><Td align='right'>คำนำหน้าชื่อ&nbsp;&nbsp;&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='prename' Size='15' value='$result[prename]'></Td></Tr>";
echo "<Tr align='left'><Td ></Td><Td align='right'>ชื่อ&nbsp;&nbsp;&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='name'  Size='40' value='$result[name]'></Td></Tr>";
echo "<Tr align='left'><Td ></Td><Td align='right'>นามสกุล&nbsp;&nbsp;&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='surname'  Size='40' value='$result[surname]'></Td></Tr>";
echo "<Tr align='left'><Td ></Td><Td align='right'>ตำแหน่ง&nbsp;&nbsp;&nbsp;&nbsp;</Td><Td>";
echo "<Select  name='position_code' size='1'>";
echo  "<option  value = ''>เลือก</option>" ;
$sql = "select * from  person_position order by position_code";
$dbquery = mysql_db_query($dbname, $sql);
While ($person_result = mysql_fetch_array($dbquery)){
	if($person_result[position_code]==$result[position_code]){
	echo  "<option  value ='$person_result[position_code]' selected>$person_result[position_name]</option>" ;
	}	
	else {
	echo  "<option  value ='$person_result[position_code]'>$person_result[position_name]</option>" ;
	}
}	
echo "</select>";
echo "</Td></Tr>";

echo "<Tr align='left'><Td ></Td><Td align='right'>ลำดับบุคคลในตำแหน่ง&nbsp;&nbsp;&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='person_order'  Size='4' value='$result[person_order]'></Td></Tr>";

echo "<Tr align='left'><Td ></Td><Td align='right'>กลุ่ม&nbsp;&nbsp;&nbsp;&nbsp;</Td><Td>";
echo "<Select  name='department' size='1'>";
echo  "<option  value = ''>เลือก</option>" ;
$sql = "select * from  system_workgroup order by workgroup_order";
$dbquery = mysql_db_query($dbname, $sql);
While ($work_group_result = mysql_fetch_array($dbquery)){
		if($work_group_result[workgroup]==$result[department]){
		echo  "<option  value ='$work_group_result[workgroup]' selected>$work_group_result[workgroup_desc]</option>" ;
		}
		else{
		echo  "<option value ='$work_group_result[workgroup]'>$work_group_result[workgroup_desc]</option>" ;
		}
}	
echo "</select>";
echo "</Td></Tr>";

echo  "<tr align='left'>";
echo  "<Td ></Td><td align='right'>ไฟล์รูปภาพ&nbsp;&nbsp;</td>";
echo  "<td align='left'><input name = 'userfile' type = 'file'></td>";
echo  "</tr>";

echo "</Table>";
echo "<Br />";
echo "<Input Type=Hidden Name='id' Value='$_GET[id]'>";
echo "<INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url_update(1)' class=entrybutton>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ย้อนกลับ' onclick='goto_url_update(0)' class=entrybutton'>";
echo "</form>";
}
//ส่วนปรับปรุงข้อมูล
if ($index==6){
$sql = "select * from person_main where person_id='$_POST[person_id]' and id!='$_POST[id]' ";
$dbquery = mysql_db_query($dbname, $sql);
if(mysql_num_rows($dbquery)>=1){
echo "<br /><div align='center'>มีเลขประจำตัวประชาชนซ้ำกับรายการที่มีอยู่แล้ว ตรวจสอบอีกครั้ง</div>";
exit();  
}

		$basename = basename($_FILES['userfile']['name']);
		if ($basename!=""){
		$changed_name = file_upload();
		$sql = "update person_main set person_id='$_POST[person_id]', prename='$_POST[prename]', name='$_POST[name]', surname='$_POST[surname]', pic='$changed_name', position_code='$_POST[position_code]', person_order='$_POST[person_order]',department='$_POST[department]',officer='$officer' where id='$_POST[id]'";
		}
		else{
		$sql = "update person_main set person_id='$_POST[person_id]', prename='$_POST[prename]', name='$_POST[name]', surname='$_POST[surname]', position_code='$_POST[position_code]', person_order='$_POST[person_order]',department='$_POST[department]',officer='$officer' where id='$_POST[id]'";
		}
$dbquery = mysql_db_query($dbname, $sql);
}

//ส่วนการแสดงผล
if(!(($index==1) or ($index==2) or ($index==2.1) or ($index==5))){
$sql = "select * from person_main where status='0' order by department, position_code,person_order";
$dbquery = mysql_db_query($dbname, $sql);
echo  "<table width='90%' border='0' align='center'>";
echo "<Tr><Td colspan='4' align='left'><INPUT TYPE='button' name='smb' value='เพิ่มข้อมูล' onclick='location.href=\"?option=person&task=person&index=1\"'></Td>";
echo "<Td colspan='5' align='right'><INPUT TYPE='button' name='smb2' value='ลบข้อมูลทั้งหมด' onclick='location.href=\"?option=person&task=person&index=2.1\"'></Td>";
echo "</Tr>";

echo "<Tr bgcolor='#FFCCCC' align='center'><Td width='50'>ที่</Td><Td width='100'>เลขประชาชน</Td><Td width='150'>ชื่อ</Td><Td>ตำแหน่ง</Td><Td width='50'>ลำดับ</Td><Td>กลุ่ม</Td><Td width='50'>รูปภาพ</Td><Td  width='60'>ลบ</Td><Td  width='60'>แก้ไข</Td></Tr>";
$N=1;
$M=1;
While ($result = mysql_fetch_array($dbquery))
	{
		$id = $result['id'];
		$person_id = $result['person_id'];
		$prename=$result['prename'];
		$name= $result['name'];
		$surname = $result['surname'];
		$position_code= $result['position_code'];
		$person_order= $result['person_order'];
		$department= $result['department'];
			if(($M%2) == 0)
			$color="#FFFFC";
			else  	$color="#FFFFFF";

		echo "<Tr  bgcolor=$color align=center class=style1><Td>$N</Td><Td align='left'>$person_id</Td><Td align='left'>$prename&nbsp;$name&nbsp;&nbsp;$surname</Td><Td align='left'>$position_ar[$position_code]</Td>";
if($person_order!=0){		
echo "<Td align='center'>$person_order</Td>";
}
else{
echo "<Td align='center'></Td>";
}
echo "<Td align='left'>$department_ar[$department]</Td>";
if($result['pic']!=""){
echo "<Td align='center'><a href='modules/person/pic_show.php?pic=$result[pic]&prename=$prename&name=$name&surname=$surname' target='_blank'><img src=images/admin/user.gif border='0' alt='รูปภาพ'></a></Td>";
}
else{
echo "<Td align='center'>&nbsp;</Td>";
}
echo "<Td><div align='center'><a href=?option=person&task=person&index=2&id=$id><img src=images/drop.png border='0' alt='ลบ'></a></div></Td>
		<Td><a href=?option=person&task=person&index=5&id=$id><img src=images/edit.png border='0' alt='แก้ไข'></a></div></Td>
	</Tr>";
$M++;
$N++;
	}
echo "</Table>";
}

?>
<script>
function goto_url(val){
	if(val==0){
		callfrm("?option=person&task=person");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.person_id.value == ""){
			alert("กรุณากรอกเลขประจำตัวประชาชน");
		}else if(frm1.prename.value==""){
			alert("กรุณากรอกคำนำหน้าชื่อ");
		}else if(frm1.name.value==""){
			alert("กรุณากรอกชื่อ");
		}else if(frm1.surname.value==""){
			alert("กรุณากรอกนามสกุล");
		}else if(frm1.position_code.value==""){
			alert("กรุณาเลือกตำแหน่ง");
		}else{
			callfrm("?option=person&task=person&index=4");   //page ประมวลผล
		}
	}
}

function goto_url_update(val){
	if(val==0){
		callfrm("?option=person&task=person");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.person_id.value == ""){
			alert("กรุณากรอกเลขประจำตัวประชาชน");
		}else if(frm1.prename.value==""){
			alert("กรุณากรอกคำนำหน้าชื่อ");
		}else if(frm1.name.value==""){
			alert("กรุณากรอกชื่อ");
		}else if(frm1.surname.value==""){
			alert("กรุณากรอกนามสกุล");
		}else{
			callfrm("?option=person&task=person&index=6");   //page ประมวลผล
		}
	}
}
</script>
