<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
//sd page

//ส่วนหัว
echo "<br />";
if(!(($index==1) or ($index==2) or ($index==5))){
echo "<table width='50%' border='0' align='center'>";
echo "<tr align='center'><td><font color='#006666' size='3'><strong>กำหนดปีปฏิทิน</strong></font></td></tr>";
echo "</table>";
}

//ส่วนฟอร์มรับข้อมูล
if($index==1){
echo "<form id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>เพิ่มปีปฏิทิน</Font>";
echo "</Cener>";
echo "<Br><Br>";
echo "<Table width='300' Border='0' Bgcolor='#Fcf9d8'>";

echo "<Tr><Td align='right'>ปีปฏิทิน&nbsp;&nbsp;&nbsp;&nbsp;</Td><Td align='left'><Input Type='Text' Name='year' id='year' Size='4' maxlength='4' onkeydown='integerOnly()'></Td></Tr>";
echo "<Tr><Td align='right'>เลขทะเบียนหนังสือรับเริ่มต้น&nbsp;&nbsp;&nbsp;&nbsp;</Td><Td align='left'><Input Type='Text' Name='start_receive_num' id='start_receive_num' Size='5' maxlength='5' onkeydown='integerOnly()' value=1></Td></Tr>";
echo "<Tr><Td align='right'>เลขทะเบียนหนังสือส่งเริ่มต้น&nbsp;&nbsp;&nbsp;&nbsp;</Td><Td align='left'><Input Type='Text' Name='start_send_num' id='start_send_num' Size='5' maxlength='5' onkeydown='integerOnly()' value=1></Td></Tr>";
echo "<Tr><Td align='right'>เลขทะเบียนคำสั่งเริ่มต้น&nbsp;&nbsp;&nbsp;&nbsp;</Td><Td align='left'><Input Type='Text' Name='start_command_num' id='start_command_num' Size='5' maxlength='5' onkeydown='integerOnly()' value=1></Td></Tr>";
echo "<Tr><Td align='right'>เลขทะเบียนเกียติบัตรเริ่มต้น&nbsp;&nbsp;&nbsp;&nbsp;</Td><Td align='left'><Input Type='Text' Name='start_cer_num' id='start_cer_num' Size='5' maxlength='5' onkeydown='integerOnly()' value=1></Td></Tr>";

echo "<Tr><Td align='right'>ปีทะเบียนปัจจุบัน&nbsp;&nbsp;&nbsp;&nbsp;</Td>";
echo "<td><div align='left'><Select  name='year_active' id='year_active' size='1'>";
echo  "<option  value = ''>เลือก</option>" ;
echo  "<option value = '1'>ใช่</option>";
echo  "<option value = '0'>ไม่ใช่</option>";
echo "</select>";
echo "</div></td></tr>";

echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
echo "<tr><td align='right'><INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url(1)'>
	&nbsp;&nbsp;&nbsp;</td>";
echo "<td align='left'><INPUT TYPE='button' name='back' value='ย้อนกลับ' onclick='goto_url(0)'></td></tr>";
echo "</Table>";
echo "</form>";
}

//ส่วนยืนยันการลบข้อมูล
if($index==2) {
echo "<table width='500' border='0' align='center'>";
echo "<tr><td align='center'><font color='#990000' size='4'>โปรดยืนยันความต้องการลบข้อมูลอีกครั้ง</font><br></td></tr>";
echo "<tr><td align=center>";
echo "<INPUT TYPE='button' name='smb' value='ยืนยัน' onclick='location.href=\"?option=bookregister&task=year&index=3&id=$_GET[id]\"'>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ยกเลิก' onclick='location.href=\"?option=bookregister&task=year\"'";
echo "</td></tr></table>";
}

//ส่วนลบข้อมูล
if($index==3){
$sql = "delete from bookregister_year where id=$_GET[id]";
$dbquery = mysql_query($sql);
}

//ส่วนบันทึกข้อมูล
if($index==4){
	if($_POST['year_active']=='1'){
	$sql = "update bookregister_year set  year_active='0' where school_code is null";
	$dbquery = mysql_query($sql);
	}
$rec_date = date("Y-m-d");
$sql = "insert into bookregister_year (year, year_active, start_receive_num, start_send_num, start_command_num, start_cer_num) values ('$_POST[year]', '$_POST[year_active]', '$_POST[start_receive_num]', '$_POST[start_send_num]', '$_POST[start_command_num]', '$_POST[start_cer_num]')";
$dbquery = mysql_query($sql);
}

//ส่วนฟอร์มแก้ไขข้อมูล
if ($index==5){
echo "<form id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>แก้ไขปีปฏิทิน</B></Font>";
echo "</Cener>";
echo "<Br><Br>";

echo "<Table width='300' Border= '0' Bgcolor='#Fcf9d8'>";

$sql = "select * from bookregister_year where id='$_GET[id]'";
$dbquery = mysql_query($sql);
$ref_result = mysql_fetch_array($dbquery);

echo "<Tr><Td align='right'>ปีปฏิทิน&nbsp;&nbsp;&nbsp;&nbsp;</Td><Td align='left'><Input Type='Text' Name='year' id='year' Size='4' maxlength='4' value='$ref_result[year]' onkeydown='integerOnly()'></Td></Tr>";
echo "<Tr><Td align='right'>เลขทะเบียนหนังสือรับเริ่มต้น&nbsp;&nbsp;&nbsp;&nbsp;</Td><Td align='left'><Input Type='Text' Name='start_receive_num' id='start_receive_num' Size='5' maxlength='5' onkeydown='integerOnly()' value='$ref_result[start_receive_num]'></Td></Tr>";
echo "<Tr><Td align='right'>เลขทะเบียนหนังสือส่งเริ่มต้น&nbsp;&nbsp;&nbsp;&nbsp;</Td><Td align='left'><Input Type='Text' Name='start_send_num' id='start_send_num' Size='5' maxlength='5' onkeydown='integerOnly()' value='$ref_result[start_send_num]'></Td></Tr>";
echo "<Tr><Td align='right'>เลขทะเบียนคำสั่งเริ่มต้น&nbsp;&nbsp;&nbsp;&nbsp;</Td><Td align='left'><Input Type='Text' Name='start_command_num' id='start_command_num' Size='5' maxlength='5' onkeydown='integerOnly()' value='$ref_result[start_command_num]'></Td></Tr>";
echo "<Tr><Td align='right'>เลขทะเบียนเกียรติบัตรเริ่มต้น&nbsp;&nbsp;&nbsp;&nbsp;</Td><Td align='left'><Input Type='Text' Name='start_cer_num' id='start_cer_num' Size='5' maxlength='5' onkeydown='integerOnly()' value='$ref_result[start_cer_num]'></Td></Tr>";

echo "<Tr><Td align='right'>ปีทะเบียนปัจจุบัน&nbsp;&nbsp;&nbsp;&nbsp;</Td>";
echo "<td><div align='left'><Select  name='year_active' id='year_active' size='1'>";
echo  "<option  value = ''>เลือก</option>" ;
	if($ref_result['year_active']==1){
	$select1="selected";
	$select2="";
	}
	else{
	$select1="";
	$select2="selected";
	}
echo  "<option value = '1' $select1>ใช่</option>";
echo  "<option value = '0' $select2>ไม่ใช่</option>";
echo "</select>";
echo "</div></td></tr>";
echo "<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>";
echo "<tr><td align='right'><INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url_update(1)'>&nbsp;&nbsp;&nbsp;&nbsp;</td>";
echo "<td align='left'><INPUT TYPE='button' name='back' value='ย้อนกลับ' onclick='goto_url_update(0)'></td></tr>";
echo "</Table>";
echo "<Br>";
echo "<Input Type=Hidden Name='id' Value='$_GET[id]'>";
echo "</form>";
}

//ส่วนปรับปรุงข้อมูล
if ($index==6){
	if($_POST['year_active']=='1'){
	$sql = "update bookregister_year set  year_active='0' where school_code is null";
	$dbquery = mysql_query($sql);
	}
$sql = "update bookregister_year set  year='$_POST[year]', year_active='$_POST[year_active]', 
start_receive_num='$_POST[start_receive_num]' ,
start_send_num='$_POST[start_send_num]' ,
start_command_num='$_POST[start_command_num]' ,
start_cer_num='$_POST[start_cer_num]' 
where id='$_POST[id]'";
$dbquery = mysql_query($sql);
}

//ส่วนปรับปรุงปีทำงานปัจจุบัน
if ($index==7){
	if($_GET['year_active']==1){
	$year_active=0;
	}
	else{
	$year_active=1;
	$sql = "update bookregister_year set  year_active='0' where school_code is null ";
	$dbquery = mysql_query($sql);
	}
$sql = "update bookregister_year set  year_active='$year_active' where id='$_GET[id]'";
$dbquery = mysql_query($sql);
}

//ส่วนแสดงผล
if(!(($index==1) or ($index==2) or ($index==5))){

$sql = "select * from  bookregister_year where school_code is null order by year ";
$dbquery = mysql_query($sql);
echo  "<table width='70%' border='0' align='center'>";
echo "<Tr><Td colspan='5' align='left'><INPUT TYPE='button' name='smb' value='เพิ่มปีปฏิทิน' onclick='location.href=\"?option=bookregister&task=year&index=1\"'</Td></Tr>";

echo "<Tr bgcolor='#FFCCCC'><Td  align='center'>ที่</Td><Td  align='center'>ปีปฏิทิน</Td><Td  align='center'>ปีทะเบียนปัจจุบัน</Td><Td  align='center' width='150'>เลขหนังสือรับเริ่มต้น</Td><Td  align='center' width='150'>เลขหนังสือส่งเริ่มต้น</Td><Td  align='center' width='150'>เลขคำสั่งเริ่มต้น</Td><Td  align='center' width='150'>เลขเกียรติบัตรเริ่มต้น</Td><Td align='center' width='50'>ลบ</Td><Td align='center' width='50'>แก้ไข</Td></Tr>";
$N=1;  //*เกี่ยวข้องกับการแยกหน้า
$M=1;
While ($result = mysql_fetch_array($dbquery))
	{
		$id = $result['id'];
		$year= $result['year'];
		$year_active = $result['year_active'];
		$start_receive_num = $result['start_receive_num'];
		$start_send_num = $result['start_send_num'];
		$start_command_num = $result['start_command_num'];
		$start_cer_num = $result['start_cer_num'];

		if($year_active==1){
		$active_pic="<img src=images/yes.png border='0' alt='ปีทำงานปัจจุบัน'>";
		}
		else{
		$active_pic="<img src=images/no.png border='0' alt='ไม่ใช่ปีทำงานปัจจุบัน'>";
		}
		
			if(($M%2) == 0)
			$color="#FFFFC";
			else  	$color="#FFFFFF";

		echo "<Tr bgcolor=$color><Td align='center' width='50'>$N</Td><Td  align='center'>$year</Td><Td align='center'><a href=?option=bookregister&task=year&index=7&id=$id&year_active=$year_active>$active_pic</a></Td><td align='center'>$start_receive_num</td><td align='center'>$start_send_num</td><td align='center'>$start_command_num</td><td align='center'>$start_cer_num</td>
		<Td align='center'><a href=?option=bookregister&task=year&index=2&id=$id><img src=images/drop.png border='0' alt='ลบ'></a></a></Td>
		<Td align='center'><a href=?option=bookregister&task=year&index=5&id=$id><img src=images/edit.png border='0' alt='แก้ไข'></a></Td>
	</Tr>";
$M++;
$N++;  //*เกี่ยวข้องกับการแยกหน้า
	}
echo "<tr><Td align='left' colspan='9'>&nbsp;</Td></tr>";
echo "<tr><Td align='left' colspan='9'>&nbsp;<b>กรณี</b>&nbsp;ต้องการปิดการใช้งานทะเบียนใด ให้กำหนดค่าเริ่มต้นทะเบียนนั้นเป็นศูนย์ (0)</Td></tr>";
echo "</Table>";
}

?>
<script>
function goto_url(val){
	if(val==0){
		callfrm("?option=bookregister&task=year");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.year.value == ""){
			alert("กรุณากรอกปี");
		}else if(frm1.year_active.value==""){
			alert("กรุณาเลือกทะเบียนปัจจุบัน");
		}else{
			callfrm("?option=bookregister&task=year&index=4");   //page ประมวลผล
		}
	}
}

function goto_url_update(val){
	if(val==0){
		callfrm("?option=bookregister&task=year");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.year.value == ""){
			alert("กรุณากรอกปี");
		}else if(frm1.year_active.value==""){
			alert("กรุณาเลือกทะเบียนปัจจุบัน");
		}else{
			callfrm("?option=bookregister&task=year&index=6");   //page ประมวลผล
		}
	}
}
</script>


