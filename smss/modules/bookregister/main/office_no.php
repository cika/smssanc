<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
//sd page 

//ส่วนหัว
echo "<br />";
if(!(($index==1) or ($index==2) or ($index==5))){
echo "<table width='50%' border='0' align='center'>";
echo "<tr align='center'><td><font color='#006666' size='3'><strong>เลขที่หนังสือของหน่วยงาน</strong></font></td></tr>";
echo "</table>";
}

//ส่วนฟอร์มรับข้อมูล
if($index==5){
$sql= "select * from bookregister_office_no where id='$_GET[id]' ";
$query= mysql_query($sql);
$result= mysql_fetch_array($query);

echo "<form id='frm1' name='frm1'>";
echo "<Br><Br>";
echo "<Table width='40%' Border='0' align='center'>";
echo "<Tr><Td align='right'>เลขที่หนังสือของหน่วยงาน&nbsp;&nbsp;</Td><Td align='left'><Input Type='Text' Name='office_no' Size='50' maxlength='70' value='$result[office_no]'></Td></Tr>";
echo "<Input Type=Hidden Name='id' Value='$_GET[id]'>";
echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
echo "<tr><td>&nbsp;</td>";
echo "<td align='left'><INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url(1)'>&nbsp;<INPUT TYPE='button' name='back' value='ย้อนกลับ' onclick='goto_url(0)'></td></tr>";
echo "</Table>";
echo "</form>";
}

//ส่วนปรับปรุงข้อมูล
if ($index==6){
$sql = "update bookregister_office_no set office_no='$_POST[office_no]' where id= '$_POST[id]' ";
$dbquery = mysql_query($sql);
}

//ส่วนแสดงผล
if(!($index==5)){
$rec_date=date("Y-m-d");
$sql= "select * from bookregister_office_no where school_code is null";
$query= mysql_query($sql);
$result= mysql_fetch_array($query);
	if(!($result)){
	mysql_query("insert into bookregister_office_no (office_no, officer, rec_date) values ('ที่ ศธ xxx/','$_SESSION[login_user_id]', '$rec_date')");
	
	$sql= "select * from bookregister_office_no where school_code is null";
	$query= mysql_query($sql);
	$result= mysql_fetch_array($query);
	}

echo "<br />";
echo  "<table width='30%' border='0' align='center'>";
echo "<Tr bgcolor='#FFCCCC'><Td align='center'>เลขที่หนังสือ</Td><Td align='center' width='70'>แก้ไข</Td></Tr>";
echo "<Tr><Td align='center'>$result[office_no]</Td>
		<Td align='center'><a href=?option=bookregister&task=main/office_no&index=5&id=$result[id]><img src=images/edit.png border='0' alt='แก้ไข'></a></Td>
	</Tr>";
echo "</Table>";
}

?>
<script>
function goto_url(val){
	if(val==0){
		callfrm("?option=bookregister&task=main/office_no");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.office_no.value == ""){
			alert("กรุณากรอกเลขที่หนังสือของหน่วยงาน");
		}else{
			callfrm("?option=bookregister&task=main/office_no&index=6");   //page ประมวลผล
		}
	}
}

</script>
