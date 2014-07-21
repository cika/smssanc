<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
if(!isset($_REQUEST['name_search'])){
$_REQUEST['name_search']="";
}

//ส่วนหัว
echo "<br />";
if(!(($index==1) or ($index==2) or ($index==5))){
echo "<table width='50%' border='0' align='center'>";
echo "<tr align='center'><td><font color='#006666' size='3'><strong>เพิ่ม แก้ไข ผู้ใช้ (User) ระดับ สพท.</strong></font></td></tr>";
echo "</table>";
}

//ส่วนฟอร์มรับข้อมูล
if($index==1){
echo "<form id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>เพิ่มผู้ใช้ (User) ระดับ สพท.</Font>";
echo "</Cener>";
echo "<Br><Br>";
echo "<Table width='50%' Border='0' Bgcolor='#Fcf9d8'>";
echo "<Tr><Td align='right' width='50%' >เลขประจำตัวประชาชน&nbsp;&nbsp;&nbsp;&nbsp;</Td><Td align='left' width='50%' ><Input Type='Text' Name='person_id' Size='20'></Td></Tr>";
echo "<Tr><Td align='right'>User Name(อังกฤษ)&nbsp;&nbsp;&nbsp;&nbsp;</Td><Td align='left'><Input Type='Text' Name='username' Size='20'></Td></Tr>";
echo "<Tr><Td align='right'>Password&nbsp;&nbsp;&nbsp;&nbsp;</Td><Td align='left'><Input Type='Text' Name='userpass' Size='20'></Td></Tr>";
echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
echo "<tr><td align='right'><INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url(1)' class=entrybutton>
	&nbsp;&nbsp;&nbsp;</td>";
echo "<td align='left'><INPUT TYPE='button' name='back' value='ย้อนกลับ' onclick='goto_url(0)' class=entrybutton'></td></tr>";
echo "</Table>";
echo "</form>";
}

//ส่วนยืนยันการลบข้อมูล
if($index==2) {
echo "<table width='500' border='0' align='center'>";
echo "<tr><td align='center'><font color='#990000' size='4'>โปรดยืนยันความต้องการลบข้อมูลอีกครั้ง</font><br></td></tr>";
echo "<tr><td align=center>";
echo "<INPUT TYPE='button' name='smb' value='ยืนยัน' onclick='location.href=\"?file=add_user&index=3&id=$_GET[id]&page=$_REQUEST[page]&name_search=$_REQUEST[name_search]\"'>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ยกเลิก' onclick='location.href=\"?file=add_user&page=$_REQUEST[page]&name_search=$_REQUEST[name_search]\"'";
echo "</td></tr></table>";
}

//ส่วนลบข้อมูล
if($index==3){
$sql = "delete from system_user where id='$_GET[id]'";
$dbquery = mysql_query($sql);
}

//ส่วนบันทึกข้อมูล
if($index==4){
$rec_date = date("Y-m-d");
$md5_pass=md5($_POST['userpass']);
$sql = "insert into system_user (person_id, username, userpass, smss_admin, status,officer, rec_date) values ('$_POST[person_id]', '$_POST[username]','$md5_pass','0','1','$_SESSION[login_user_id]','$rec_date')";
$dbquery = mysql_query($sql);
}

//ส่วนฟอร์มแก้ไขข้อมูล
if ($index==5){
echo "<form id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>แก้ไขผู้ใช้ (User) ระดับ สพท.</B></Font>";
echo "</Cener>";
echo "<Br><Br>";
echo "<Table width='50%' Border= '0' Bgcolor='#Fcf9d8'>";

$sql = "select * from system_user where id='$_GET[id]'";
$dbquery = mysql_query($sql);
$ref_result = mysql_fetch_array($dbquery);

echo "<Tr><Td align='right' width='50%' >เลขประจำตัวประชาชน&nbsp;&nbsp;&nbsp;&nbsp;</Td><Td align='left' width='50%' ><Input Type='Text' Name='person_id' Size='20' value='$ref_result[person_id]'></Td></Tr>";
echo "<Tr><Td align='right'>User Name(อังกฤษ)&nbsp;&nbsp;&nbsp;&nbsp;</Td><Td align='left'><Input Type='Text' Name='username' Size='20' value='$ref_result[username]'></Td></Tr>";

echo "<Tr><Td align='right'>สถานะผู้ดูแลระบบ&nbsp;&nbsp;&nbsp;&nbsp;</Td><Td align='left'><Select name='smss_admin' size='1'>";
echo  "<option  value = ''>เลือก</option>" ;
if($ref_result['smss_admin']==1){
echo  "<option value ='1' selected>ใช่ (YES)</option>" ;
echo  "<option value ='0' >ไม่ใช่ (NO)</option>" ;
}
else{
echo  "<option value ='1'>ผู้ดูแลระบบ (Amin)</option>" ;
echo  "<option value ='0' selected>ผู้ใช้ (User)</option>" ;
}
echo "</select>";
echo "</Td></Tr>";

echo "<Tr><Td align='right'>สถานะใช้งาน้&nbsp;&nbsp;&nbsp;&nbsp;</Td><Td align='left'><Select name='status' size='1'>";
echo  "<option  value = ''>เลือก</option>" ;
if($ref_result['status']==1){
echo  "<option value ='1' selected>อนุญาตให้ใช้งาน</option>" ;
echo  "<option value ='0' >ไม่อนุญาตให้ใช้งาน</option>" ;
}
else{
echo  "<option value ='1'>อนุญาตให้ใช้งาน</option>" ;
echo  "<option value ='0' selected>ไม่อนุญาตให้ใช้งาน</option>" ;
}
echo "</select>";
echo "</Td></Tr>";

echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
echo "<tr><td align='right'><INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url_update(1)' class=entrybutton>&nbsp;&nbsp;&nbsp;&nbsp;</td>";
echo "<td align='left'><INPUT TYPE='button' name='back' value='ย้อนกลับ' onclick='goto_url_update(0)' class=entrybutton'></td></tr>";
echo "</Table>";
echo "<Br>";
echo "<Input Type=Hidden Name='id' Value='$_GET[id]'>";
echo "<Input Type=Hidden Name='page' Value='$_GET[page]'>";
echo "<Input Type=Hidden Name='name_search' Value='$_GET[name_search]'>";
echo "</form>";
}

//ส่วนปรับปรุงข้อมูล
if ($index==6){
$rec_date = date("Y-m-d");
$sql = "update system_user set  person_id='$_POST[person_id]', username='$_POST[username]', smss_admin='$_POST[smss_admin]', status='$_POST[status]'where id='$_POST[id]'";
$dbquery = mysql_query($sql);
}

//ส่วนปรับปรุงสถานะการใช้งาน
if ($index==7){
	if($_GET['status']==1){
	$status=0;
	}
	else{
	$status=1;
	}
$sql = "update system_user set status='$status' where id='$_GET[id]'";
$dbquery = mysql_query($sql);
}

//ส่วนปรับปรุงสถานะAdmin
if ($index==8){
	if($_GET['status']==1){
	$status=0;
	}
	else{
	$status=1;
	}
$sql = "update system_user set smss_admin='$status' where id='$_GET[id]'";
$dbquery = mysql_query($sql);
}

//ส่วนแสดงผล
if(!(($index==1) or ($index==2) or ($index==5))){

	//ส่วนของการแยกหน้า
$pagelen=20;  // 1_กำหนดแถวต่อหน้า
$url_link="file=add_user&name_search=$_REQUEST[name_search]";  // 2_กำหนดลิงค์ฺ

if($_REQUEST['name_search']!=""){
$sql = "select system_user.id, system_user.username, system_user.userpass, system_user.smss_admin, system_user.status, person_main.name, person_main.surname, person_main.person_id from system_user left join person_main on system_user.person_id=person_main.person_id where system_user.school_user = '0' and (person_main.name like '%$_REQUEST[name_search]%' or system_user.username like '%$_REQUEST[name_search]%') ";
}
else{
$sql = "select * from system_user where school_user = '0' "; // 3_กำหนด sql
}

$dbquery = mysql_query($sql);
$num_rows = mysql_num_rows($dbquery );  
$totalpages=ceil($num_rows/$pagelen);
//เพิ่มเติม
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
		if($totalpages<$_REQUEST['page']){
		$page=$totalpages;
					if($page<1){
					$page=1;
					}
		}
		else{
		$page=$_REQUEST['page'];
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
					echo "<a href=$PHP_SELF?$url_link&page=$i>[$i]</a>";
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
			echo "<<a href=$PHP_SELF?$url_link&page=1>หน้าแรก </a>";
			echo "<<<a href=$PHP_SELF?$url_link&page=$f_page1>หน้าก่อน </a>";
			}
			else {
			echo "หน้า	";
			}					
			for($i=$s_page; $i<=$e_page; $i++){
					if($i==$page){
					echo "[<b><font size=+1 color=#990000>$i</font></b>]";
					}
					else {
					echo "<a href=$PHP_SELF?$url_link&page=$i>[$i]</a>";
					}
			}
			if($page<$totalpages)	{
			$f_page2=$page+1;
			echo "<a href=$PHP_SELF?$url_link&page=$f_page2> หน้าถัดไป</a>>>";
			echo "<a href=$PHP_SELF?$url_link&page=$totalpages> หน้าสุดท้าย</a>>";
			}
			echo " <select onchange=\"location.href=this.options[this.selectedIndex].value;\" size=\"1\" name=\"select\">";
			echo "<option  value=\"\">หน้า</option>";
				for($p=1;$p<=$totalpages;$p++){
				echo "<option  value=\"?$url_link&page=$p\">$p</option>";
				}
			echo "</select>";
echo "</div>";  
}					
//จบแยกหน้า

////////////////////
echo "<form id='frm1' name='frm1'>";
echo "<table width='75%' align='center'><tr><td align='right'>";
echo "ค้นหาด้วยชื่อหรือUsername&nbsp;";
echo "<Input Type='Text' Name='name_search' value='$_REQUEST[name_search]' >";
echo "&nbsp;<INPUT TYPE='button' name='smb'  value='ค้น' onclick='goto_display(1)'>";
echo "</td></tr></table>";
echo "</form>";
//////////////////////////////////////////
if($_REQUEST['name_search']!=""){
$sql = "select system_user.id, system_user.username, system_user.userpass, system_user.smss_admin, system_user.status, person_main.name, person_main.surname, person_main.person_id from system_user left join person_main on system_user.person_id=person_main.person_id where system_user.school_user = '0' and (person_main.name like '%$_REQUEST[name_search]%' or system_user.username like '%$_REQUEST[name_search]%') order by person_main.name limit $start,$pagelen";
}
else{
$sql = "select system_user.id, system_user.username, system_user.userpass, system_user.smss_admin, system_user.status, person_main.name, person_main.surname, person_main.person_id from system_user left join person_main on system_user.person_id=person_main.person_id where system_user.school_user = '0' order by person_main.name limit $start,$pagelen";
}

$dbquery = mysql_query($sql);
echo  "<table width=75% border=0 align=center>";
echo "<Tr><Td colspan='7' align='left'><INPUT TYPE='button' name='smb' value='เพิ่มผู้ใช้ (User)' onclick='location.href=\"?file=add_user&index=1\"'</Td></Tr>";
echo "<Tr bgcolor='#FFCCCC'><Td  align='center' width='50'>ที่</Td><Td  align='center'>ชื่อ-สกุล</Td><Td align='center'>Username</Td><Td align='center' width='170'>สถานะผู้ดูแลระบบ(Admin)</Td><Td align='center' width='100'>สถานะใช้งาน</Td><Td align='center' width='50'>ลบ</Td><Td align='center' width='50'>แก้ไข</Td></Tr>";
$N=(($page-1)*$pagelen)+1;  //*เกี่ยวข้องกับการแยกหน้า
$M=1;
While ($result = mysql_fetch_array($dbquery))
	{
		$id = $result['id'];
		$username = $result['username'];
		$userpass = $result['userpass'];
		$smss_admin= $result['smss_admin'];		
		$status = $result['status'];
		$person_id = $result['person_id'];	
		$name = $result['name'];
		$surname = $result['surname'];
		
		if($smss_admin==1){
		$admin_status="<img src=../images/yes.png border='0' alt='สถานะAdmin'>";
		}
		else {
		$admin_status="<img src=../images/no.png border='0' alt='สถานะUser'>";
		}
		
		if($status==1){
		$active_status="<img src=../images/yes.png border='0' alt='สถานะทำงาน'>";
		}
		else {
		$active_status="<img src=../images/no.png border='0' alt='สถานะ พักการทำงาน'>";
		}
			if(($M%2) == 0)
			$color="#FFFFC";
			else  	$color="#FFFFFF";
			
		echo "<Tr bgcolor=$color><Td align='center'>$N</Td>
		<Td  align='left'>$name $surname</Td><Td align='left'>$username</Td>
		<Td align='center'><a href=?file=add_user&index=8&id=$id&page=$page&status=$smss_admin&name_search=$_REQUEST[name_search]>$admin_status</a></Td>
		<Td align='center'><a href=?file=add_user&index=7&id=$id&page=$page&status=$status&name_search=$_REQUEST[name_search]>$active_status</a></Td>
		<Td align='center'><a href=?file=add_user&index=2&id=$id&page=$page&name_search=$_REQUEST[name_search]><img src=../images/drop.png border='0' alt='ลบ'></a></Td>
		<Td align='center'><a href=?file=add_user&index=5&id=$id&page=$page&name_search=$_REQUEST[name_search]><img src=../images/edit.png border='0' alt='แก้ไข'></a></Td>
	</Tr>";
$M++;
$N++;  //*เกี่ยวข้องกับการแยกหน้า
	}
echo "</Table>";
}

?>
<script>
function goto_url(val){
	if(val==0){
		callfrm("?file=add_user");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.person_id.value == ""){
			alert("กรุณากรอกเลขประจำตัวประชาชน");
		}else if(frm1.username.value==""){
			alert("กรุณากรอก Username");
		}else if(frm1.userpass.value==""){
			alert("กรุณากรอกรหัสผ่าน");
		}else{
			callfrm("?file=add_user&index=4");   //page ประมวลผล
		}
	}
}

function goto_url_update(val){
	if(val==0){
		callfrm("?file=add_user");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.person_id.value == ""){
			alert("กรุณากรอกเลขประจำตัวประชาชน");
		}else if(frm1.username.value==""){
			alert("กรุณากรอก Username");
		}else{
			callfrm("?file=add_user&index=6");   //page ประมวลผล
		}
	}
}

function goto_display(val){
	if(val==1){
		callfrm("?file=add_user"); 
		}
}
</script>
