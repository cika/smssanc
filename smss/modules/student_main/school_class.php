<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
//sd page 

echo "<br />";
if(!(($index==1) or ($index==2) or ($index==5))){
echo "<table width='50%' border='0' align='center'>";
echo "<tr align='center'><td><font color='#006666' size='3'><strong>ชั้นเรียน</strong></font></td></tr>";
echo "</table>";
}
//ส่วนเพิ่มข้อมูล
if($index==1){
echo "<form id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>เพิ่มชั้นเรียน</B></Font>";
echo "</Cener>";
echo "<Br>";
echo "<Table   width=60% Border=0 Bgcolor=#Fcf9d8>";
echo "<Tr align='left'><Td width=20></Td><Td>รหัสชั้นเรียน</Td><Td><Input Type='Text' Name='class_code' Size='5' onkeydown='integerOnly()'></Td></Tr>";

echo "<Tr align='left'><Td ></Td><Td>ชื่อชั้นเรียน</Td><Td><Input Type='Text' Name='class_name' Size='40'></Td></Tr>";
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
echo "<INPUT TYPE='button' name='smb' value='ยืนยัน' onclick='location.href=\"?option=student_main&task=school_class&index=3&id=$_GET[id]\"'>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ยกเลิก' onclick='location.href=\"?option=student_main&task=school_class\"'";
echo "</td></tr></table>";
}
//ส่วนลบข้อมูล
if($index==3){
$sql = "delete from student_main_class where id=$_GET[id]";
$dbquery = mysql_query($sql);
}

//ส่วนเพิ่มข้อมูล
if($index==4){
$sql = "insert into student_main_class (class_code, class_name) values ( '$_POST[class_code]','$_POST[class_name]')";
$dbquery = mysql_query($sql);
}
//ส่วนฟอร์มแก้ไขข้อมูล
if ($index==5){
echo "<form id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>แก้ไขชั้นเรียน</B></Font>";
echo "</Cener>";
echo "<Br>";
$sql = "select * from  student_main_class where id='$_GET[id]'";
$dbquery = mysql_query($sql);
$ref_result = mysql_fetch_array($dbquery);

echo "<Table   width=70% Border=0 Bgcolor=#Fcf9d8>";
echo "<Tr align='left'><Td width=20></Td><Td>รหัสชั้นเรียน</Td><Td><Input Type='Text' Name='class_code' Size='5' value='$ref_result[class_code]' onkeydown='integerOnly()'></Td></Tr>";

echo "<Tr align='left'><Td ></Td><Td>ชื่อชั้นเรียน</Td><Td><Input Type='Text' Name='class_name' Size='60' value='$ref_result[class_name]'></Td></Tr>";
echo "<Br>";
echo "</Table>";
echo "<Br>";
echo "<Input Type=Hidden Name='id' Value='$_GET[id]'>";
echo "<INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url_update(1)' class=entrybutton>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ย้อนกลับ' onclick='goto_url_update(0)' class=entrybutton'>";

echo "</form>";
}
//ส่วนปรับปรุงข้อมูล
if ($index==6){
$sql = "update student_main_class set class_code='$_POST[class_code]',class_name='$_POST[class_name]' where id='$_POST[id]'";
$dbquery = mysql_query($sql);
}

//ส่วนการแสดงผล
if(!(($index==1) or ($index==2) or ($index==5))){

$sql = "select * from student_main_class order by class_code";
$dbquery = mysql_query($sql);

echo  "<table width=50% border=0 align=center>";
echo "<Tr><Td colspan='6' align='left'><INPUT TYPE='button' name='smb' value='เพิ่มข้อมูล' onclick='location.href=\"?option=student_main&task=school_class&index=1\"'></Td></Tr>";

echo "<Tr bgcolor=#FFCCCC align='center' class=style2><Td width='50'>ที่</Td> <Td>รหัส</Td><Td>ชั้นเรียน</Td><Td   width='50'>ลบ</Td><Td width='50'>แก้ไข</Td></Tr>";
//$N=(($page-1)*$pagelen)+1;  //*เกี่ยวข้องกับการแยกหน้า
$M=1;
While ($result = mysql_fetch_array($dbquery))
	{
		$id = $result['id'];
		$class_code= $result['class_code'];
		$class_name= $result['class_name'];
			if(($M%2) == 0)
			$color="#FFFFC";
			else  	$color="#FFFFFF";

		echo "<Tr  bgcolor=$color align=center class=style1><Td>$M</Td> <Td>$class_code</Td> <Td align=left>$class_name</Td><Td><div align=center><a href=?option=student_main&task=school_class&index=2&id=$id><img src=images/drop.png border='0' alt='ลบ'></a></div></Td><Td><a href=?option=student_main&task=school_class&index=5&id=$id><img src=images/edit.png border='0' alt='แก้ไข'></a></div></Td>
	</Tr>";
$M++;
//$N++;  //*เกี่ยวข้องกับการแยกหน้า
	}
echo "</Table>";
}

?>
<script>
function goto_url(val){
	if(val==0){
		callfrm("?option=student_main&task=school_class");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.class_code.value == ""){
			alert("กรุณากรอกรหัสชั้นเรียน");
		}else if(frm1.class_name.value==""){
			alert("กรุณากรอกชื่อชั้นเรียน");
		}else{
			callfrm("?option=student_main&task=school_class&index=4");   //page ประมวลผล
		}
	}
}

function goto_url_update(val){
	if(val==0){
		callfrm("?option=student_main&task=school_class");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.class_code.value == ""){
			alert("กรุณากรอกรหัสชั้นเรียน");
		}else if(frm1.class_name.value==""){
			alert("กรุณากรอกชื่อชั้นเรียน");
		}else{
			callfrm("?option=student_main&task=school_class&index=6");   //page ประมวลผล
		}
	}
}
</script>
