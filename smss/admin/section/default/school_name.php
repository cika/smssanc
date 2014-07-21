<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
//sd page 

//ส่วนหัว
echo "<br />";
if(!(($index==1) or ($index==2) or ($index==5))){
echo "<table width='50%' border='0' align='center'>";
echo "<tr align='center'><td><font color='#006666' size='3'><strong>ชื่อสถานศึกษา</strong></font></td></tr>";
echo "</table>";
}

//ส่วนฟอร์มรับข้อมูล
if($index==5){

echo "<form id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>ชื่อหน่วยงาน</Font>";
echo "</Cener>";
echo "<Br><Br>";
echo "<Table width='50%' Border='0' Bgcolor='#Fcf9d8'>";

echo "<Tr><Td align='right'>ชื่อหน่วยงาน&nbsp;&nbsp;&nbsp;&nbsp;</Td><Td align='left'><Input Type='Text' Name='school_name' Size='50' maxlength='50' value='$_SESSION[school_name]'></Td></Tr>";
echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
echo "<tr><td>&nbsp;</td>";
echo "<td align='left'><INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url(1)' class=entrybutton>&nbsp;<INPUT TYPE='button' name='back' value='ย้อนกลับ' onclick='goto_url(0)' class=entrybutton'></td></tr>";
echo "</Table>";
echo "</form>";
}

//ส่วนปรับปรุงข้อมูล
if ($index==6){
	if(isset($_POST['school_name'])){
		$school_name=$_POST['school_name'];
		$sql = "update system_school_name set school_name='$school_name'";
		$dbquery = mysql_query($sql);
			
			$sql_school_name = "select * from system_school_name";
			$dbquery_school_name = mysql_query($sql_school_name);
			$result_school_name = mysql_fetch_array($dbquery_school_name);
			$_SESSION['school_name'] =$result_school_name['school_name'];		
	}
}

//ส่วนแสดงผล
if(!($index==5)){
echo "<br />";
echo  "<table width=40% border=0 align=center>";
echo "<Tr bgcolor='#FFCCCC'><Td align='center'>ชื่อ</Td><Td align='center' width='50'>แก้ไข</Td></Tr>";
echo "<Tr><Td align='center'>$_SESSION[school_name]</Td>
		<Td align='center'><a href=?file=school_name&index=5><img src=../images/edit.png border='0' alt='แก้ไข'></a></Td>
	</Tr>";
echo "</Table>";
}

?>
<script>
function goto_url(val){
	if(val==0){
		callfrm("?file=school_name");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.school_name.value == ""){
			alert("กรุณากรอกชื่อหน่วยงาน");
		}else{
			callfrm("?file=school_name&index=6");   //page ประมวลผล
		}
	}
}

function goto_url_update(val){
	if(val==0){
		callfrm("?file=ed_year");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.ed_year.value == ""){
			alert("กรุณากรอกปีการศึกษา");
		}else if(frm1.active_ed_year.value==""){
			alert("กรุณาเลือกปีทำงานปัจจุบัน");
		}else{
			callfrm("?file=ed_year&index=6");   //page ประมวลผล
		}
	}
}
</script>
