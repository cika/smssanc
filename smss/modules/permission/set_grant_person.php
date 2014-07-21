<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
if(!($_SESSION['admin_permission']=='permission' or $result_permission['p1']==1)){
exit();
}

//ส่วนหัว
echo "<br />";
if(!(($index==1) or ($index==2) or ($index==5))){
echo "<table width='50%' border='0' align='center'>";
echo "<tr align='center'><td><font color='#006666' size='3'><strong>กำหนดผู้ให้ความเห็นชอบ และผู้อนุมัติ การขออนุญาตไปราชการ</strong></font></td></tr>";
echo "</table>";
}
echo "<br>";

if(!isset($_POST['comment_person'])){
$_POST['comment_person']="";
}

if(!isset($_POST['grant_person'])){
$_POST['grant_person']="";
}

//ส่วนบันทึกข้อมูล
if($index==4){
$rec_date = date("Y-m-d");
$officer=$_SESSION['login_user_id'];

$sql_1 = "select * from person_main where status='0' ";
$dbquery_1 = mysql_query($sql_1);
While ($result = mysql_fetch_array($dbquery_1))
	{
	$person_id=$result['person_id'];
	$chk1="chk1$person_id";
	$chk2="chk2$person_id";
	$rec_index=0;
	$comment_index=0;
	$grant_index=0;
	
	if(!isset($_POST[$chk1])){
	$_POST[$chk1]="";
	}
	
	if(($_POST['comment_person']!="") and ($_POST[$chk1]==1)){
	$comment_person=$_POST['comment_person'];
	$rec_index=$rec_index+1;
	$comment_index=1;
	}
	else{
	$comment_person="";
	}
	
	if(!isset($_POST[$chk2])){
	$_POST[$chk2]="";
	}
	
	if(($_POST['grant_person']!="") and ($_POST[$chk2]==1)){
	$grant_person=$_POST['grant_person'];
	$rec_index=$rec_index+1;
	$grant_index=1;
	}
	else{
	$grant_person="";
	}
	
	
		$sql_2 = "select * from permission_person_set where person_id='$person_id'";
		$dbquery_2 = mysql_query($sql_2);
		$num=mysql_num_rows($dbquery_2);
			if($num<1 and $rec_index>0){
			$sql_3 = "insert into permission_person_set(person_id,comment_person,grant_person,officer,rec_date) values ('$person_id','$comment_person','$grant_person','$officer','$rec_date')";
			$dbquery_3 = mysql_query($sql_3);
			}
			else{
					if($comment_index==1){
					$sql_3 = "update permission_person_set set comment_person='$comment_person', officer='$officer', rec_date='$rec_date' where person_id='$person_id'";
					$dbquery_3 = mysql_query($sql_3);
					}
					if($grant_index==1){
					$sql_4 = "update permission_person_set set grant_person='$grant_person', officer='$officer', rec_date='$rec_date' where person_id='$person_id'";
					$dbquery_4 = mysql_query($sql_4);
					}
			}

	}
}

//ส่วนฟอร์มแก้ไขข้อมูล
if ($index==5){
echo "<form id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>แก้ไขการกำหนดผู้ให้ความเห็นชอบ และผู้อนุมัติ การขออนุญาตไปราชการ</B></Font>";
echo "</Cener>";
echo "<Br><Br>";
echo "<Table width='50%' Border= '0' Bgcolor='#Fcf9d8'>";
$sql = "select * from  permission_person_set where id='$_GET[id]'";
$dbquery = mysql_query($sql);
$ref_result = mysql_fetch_array($dbquery);

echo "<Tr><Td align='right'>ผู้บังคับบัญชาขั้นต้น(ให้ความเห็นชอบ)&nbsp;&nbsp;</Td>";
echo "<td><div align='left'><Select  name='comment_person'  size='1'>";
echo  "<option  value = ''>เลือก</option>" ;
$sql = "select  * from person_main where status='0' order by name";
$dbquery = mysql_query($sql);
While ($result = mysql_fetch_array($dbquery))
   {
		$person_id = $result['person_id'];
		$name = $result['name'];
		$surname = $result['surname'];
		if($person_id==$ref_result['comment_person']){
		echo  "<option value = $person_id selected>$name $surname</option>";
		}
		else{
		echo  "<option value = $person_id>$name $surname</option>";
		}
	}
echo "</select>";
echo "</div></td></tr>";

echo "<Tr><Td align='right'>ผู้บังคับบัญชา(อนุมัติ)&nbsp;&nbsp;</Td>";
echo "<td><div align='left'><Select  name='grant_person'  size='1'>";
echo  "<option  value = ''>เลือก</option>" ;
$sql = "select * from person_main where status='0' and (position_code='1' or position_code='2') order by position_code,person_order";
$dbquery = mysql_query($sql);
While ($result = mysql_fetch_array($dbquery))
   {
		$person_id = $result['person_id'];
		$name = $result['name'];
		$surname = $result['surname'];
		if($person_id==$ref_result['grant_person']){
		echo  "<option value = $person_id selected>$name $surname</option>";
		}
		else{
		echo  "<option value = $person_id>$name $surname</option>";
		}
	}
echo "</select>";
echo "</div></td></tr>";

echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
echo "<tr><td align='right'><INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url_update(1)' class=entrybutton>&nbsp;&nbsp;</td>";
echo "<td align='left'><INPUT TYPE='button' name='back' value='ย้อนกลับ' onclick='goto_url_update(0)' class=entrybutton'></td></tr>";
echo "</Table>";
echo "<Br>";
echo "<Input Type=Hidden Name='id' Value='$_GET[id]'>";
echo "<Input Type=Hidden Name='person_id' Value='$_GET[person_id]'>";
echo "</form>";
}

//ส่วนปรับปรุงข้อมูล
if ($index==6){
$rec_date = date("Y-m-d");
$officer=$_SESSION['login_user_id'];

$sql_num = "select  * from permission_person_set where id='$_POST[id]'";
$dbquery_num = mysql_query($sql_num);
$num_rows=mysql_num_rows($dbquery_num);
		if($num_rows>0){
		$sql = "update permission_person_set set comment_person='$_POST[comment_person]', grant_person='$_POST[grant_person]', officer='$officer', rec_date='$rec_date' where id='$_POST[id]'";
		$dbquery = mysql_query($sql);
		}
		else{
		$sql_3 = "insert into permission_person_set(person_id,comment_person,grant_person,officer,rec_date) values ('$_POST[person_id]','$_POST[comment_person]','$_POST[grant_person]','$officer','$rec_date')";
		$dbquery_3 = mysql_query($sql_3);
		}	
}

//ส่วนแสดงผล
if(!(($index==1) or ($index==2) or ($index==5))){
echo "<form id='frm1' name='frm1'>";
echo  "<table width='80%' border='0' align='center'>";
echo "<Tr align='center'><Td colspan='3'></Td><Td><font color='#006666' size='2'>ผู้ให้ความเห็นชอบ</font></Td><Td><font color='#006666' size='2'>ผู้อนุมัติ</font></Td></Tr>";

echo "<Tr bgcolor='#FFCCCC' align='center'><Td width='80'>ที่</Td><Td width='300'>ชื่อ</Td><Td>ตำแหน่ง</Td><Td width='150'>";

echo "<Select  name='comment_person'  size='1'>";
echo  "<option  value = ''>เลือก</option>" ;
$sql = "select  * from person_main where status='0' order by name";
$dbquery = mysql_query($sql);
While ($result = mysql_fetch_array($dbquery))
   {
		$person_id = $result['person_id'];
		$prename = $result['prename'];
		$name = $result['name'];
		$surname = $result['surname'];
		$fullname_ar[$person_id]="$prename$name $surname";
		echo  "<option value = $person_id>$name $surname</option>" ;
	}
echo "</select>";

echo "</Td><Td width='150'>";

echo "<Select  name='grant_person'  size='1'>";
echo  "<option  value = ''>เลือก</option>" ;
$sql = "select * from person_main where status='0' and (position_code='1' or position_code='2') order by position_code,person_order";
$dbquery = mysql_query($sql);
While ($result = mysql_fetch_array($dbquery))
   {
		$person_id = $result['person_id'];
		$name = $result['name'];
		$surname = $result['surname'];
		echo  "<option value = $person_id>$name $surname</option>" ;
	}
echo "</select>";
echo "</Td>";
echo "<td width='40'>แก้ไข</td>";
echo "</Tr>";

$sql = "select * from  person_position order by position_code";
$dbquery = mysql_query($sql);
While ($result = mysql_fetch_array($dbquery)){
$position_ar[$result['position_code']]=$result['position_name'];
}

$sql = "select permission_person_set.id, person_main.person_id, person_main.prename, person_main.name, person_main.surname, person_main.position_code, permission_person_set.comment_person, permission_person_set.grant_person from person_main left join permission_person_set on person_main.person_id=permission_person_set.person_id where person_main.status='0' order by person_main.position_code,person_main.person_order";
$dbquery = mysql_query($sql);

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
		$comment_person= $result['comment_person'];
		$grant_person= $result['grant_person'];
			if(($M%2) == 0)
			$color="#FFFFC";
			else  	$color="#FFFFFF";

		echo "<Tr  bgcolor=$color align=center class=style1><Td>$N</Td><Td align='left'>$prename&nbsp;$name&nbsp;&nbsp;$surname</Td><Td align='left'>$position_ar[$position_code]</Td>";
echo "<td>";
if($comment_person!=""){
		if(isset($fullname_ar[$comment_person])){
		echo $fullname_ar[$comment_person];
		}
}
else{
echo "<input type='checkbox' name='chk1$person_id' id='chk1$person_id' value='1'>";
}
echo "</td>";
echo "<td>";
if($grant_person!=""){
		if(isset($fullname_ar[$grant_person])){
		echo $fullname_ar[$grant_person];
		}
}
else{
echo "<input type='checkbox' name='chk2$person_id' id='chk2$person_id' value='1'>";
}
echo "</td>";
echo "<Td valign='top' align='center'><a href=?option=permission&task=set_grant_person&index=5&id=$id&person_id=$person_id><img src=images/edit.png border='0' alt='แก้ไข'></a></Td>";
echo "</Tr>";
$M++;
$N++;
	}
echo "<tr bgcolor='#FFCCCC'><td align='center' colspan='7'><INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url(1)' class=entrybutton></td></tr>";
echo "</Table>";
echo "</form>";
}

?>
<script>
function goto_url(val){
	if(val==0){
		callfrm("?option=permission&task=set_grant_person");   // page ย้อนกลับ 
	}else if(val==1){
			callfrm("?option=permission&task=set_grant_person&index=4");   //page ประมวลผล
	}
}

function goto_url_update(val){
	if(val==0){
		callfrm("?option=permission&task=set_grant_person");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.grant_person.value == ""){
			alert("กรุณาเลือกผู้อนุมิัติ");
		}else{
			callfrm("?option=permission&task=set_grant_person&index=6");   //page ประมวลผล
		}
	}
}
</script>
