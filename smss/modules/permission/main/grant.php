<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
if(!($_SESSION['login_status']<=4)){
exit();
}

require_once "modules/permission/time_inc.php";	

//ส่วนหัว
echo "<br />";
if(!(($index==1) or ($index==2) or ($index==5) or ($index==7))){

echo "<table width='100%' border='0' align='center'>";
echo "<tr align='center'><td><font color='#006666' size='3'><strong>อนุมัติ/คำสั่ง ของผู้บังคับบัญชา</strong></font></td></tr>";
echo "<tr align='center'><td><font color='#006666' size='2'><strong>ทะเบียนขออนุญาตไปราชการ</strong></font></td></tr>";
echo "</table>";
}

//ส่วนบันทึกข้อมูล
if($index==4){
if(!isset($_POST['allchk'])){
$_POST['allchk']="";
}
$date_time_now = date("Y-m-d H:i:s");
	foreach($_POST as $key => $value){
		if($key!=$_POST['allchk']){
		$sql = "update permission_main set grant_x='$value', grant_person='$_SESSION[login_user_id]', grant_date='$date_time_now' where id='$key'";
		$dbquery = mysql_query($sql);
		}
	}
}

//ส่วนฟอร์มแก้ไขข้อมูล
if ($index==5){
echo "<form Enctype = multipart/form-data id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>อนุมัติ/คำสั่ง ของผู้บังคับบัญชา</B></Font>";
echo "</Cener>";
echo "<Br><Br>";

echo "<Table width='80%' Border='0'>";
$sql = "select * from permission_main where id='$_GET[id]'";
$dbquery = mysql_query($sql);
$ref_result = mysql_fetch_array($dbquery);
$id=$ref_result['id'];
$ref_id=$ref_result['ref_id'];
$comment=$ref_result['comment'];
$comment_person=$ref_result['comment_person'];
$grant_comment=$ref_result['grant_comment'];
$grant=$ref_result['grant_x'];
$rec_date=$ref_result['rec_date'];

$sql_person = "select * from  person_main where person_id='$ref_result[person_id]' ";
$dbquery_person = mysql_query($sql_person);
$result_person = mysql_fetch_array($dbquery_person);
$fullname=$result_person['prename'].$result_person['name']." ".$result_person['surname'];

echo "<Tr align='left'><Td align='right' width='50%'>เลขที่&nbsp;&nbsp;</Td><Td>$id</Td></Tr>";

echo "<Tr align='left'><Td align='right'>ชื่อผู้ขออนุญาต&nbsp;&nbsp;</Td><Td>$fullname</Td></Tr>";

echo "<Tr align='left'><Td align='right'>วันที่ขออนุญาต&nbsp;&nbsp;</Td><Td>";
echo thai_date_4($rec_date);
echo "</Td></Tr>";

echo "<Tr align='left'><Td align='right'>เรื่องไปราชการ&nbsp;&nbsp;</Td><Td>$ref_result[subject]</Td></Tr>";

echo "<Tr align='left'><Td align='right'>สถานที่&nbsp;&nbsp;</Td><Td>$ref_result[place]</Td></Tr>";

	$sql_date="select * from permission_date where ref_id='$ref_id' order by date";
	$dbquery_date = mysql_query($sql_date);
	$date_num=1;
	While ($result_date = mysql_fetch_array($dbquery_date)){
		$date = $result_date['date'];
		$full_date=thai_date($date);
		if($date_num==1){
		echo "<Tr align='left'><Td align='right'>วันไปราชการ&nbsp;&nbsp;</Td><Td>$full_date</Td></Tr>";
		}
		else{
		echo "<Tr align='left'><Td align='right'>&nbsp;&nbsp;</Td><Td>$full_date</Td></Tr>";
		}
		
		$date_num++;
	}

echo "<Tr align='left'><Td align='right'>พาหนะ&nbsp;&nbsp;</Td><Td>$ref_result[vehicle]</Td></Tr>";

if($ref_result['no_comment']==1){
$no_comment_select="checked";
}
else{
$no_comment_select="";
}
echo "<Tr align='left'><Td align='right'></Td><Td><input type='checkbox'  name='no_comment' id='no_comment' value='1' $no_comment_select>&nbsp;ไม่ต้องผ่านผู้บังคับบัญชาขั้นต้น</Td></Tr>";
echo "</Table>";

echo "<table width='500'><tr><td>";
echo "<fieldset>";
echo "<legend>&nbsp;<B>ส่วนความเห็นของผู้บังคับบัญชาขั้นต้น</B>: &nbsp;</legend>";
echo "<table>";
echo "<Tr align='left'><Td align='right' width='50%'>ความเห็นของผู้บังคับบัญชาขั้นต้น&nbsp;&nbsp;</Td><Td>$comment</Td></Tr>";
echo "<Tr align='left'><Td align='right' width='50%'>ลงชื่อ&nbsp;&nbsp;</Td><Td>";
if(isset($person_ar[$comment_person])){
echo $person_ar[$comment_person];
}
echo "</Td></Tr>";
$thai_date_comment=thai_date_4($ref_result['comment_date']);
		echo "<Tr align='left'><Td align='right'>วันเวลา&nbsp;&nbsp;</Td><Td>$thai_date_comment</Td></Tr>";
echo "</Table>";
echo "</fieldset></td></tr></table>";

echo "<table width='500'><tr><td>";
echo "<fieldset>";
echo "<legend>&nbsp;<B>ส่วนการอนุมัติ/คำสั่ง</B>: &nbsp;</legend>";
echo "<table>";
if($grant==1){
$grant_1_checked="checked";
}
else{
$grant_1_checked="";
}
if($grant==2){
$grant_2_checked="checked";
}
else{
$grant_2_checked="";
}

echo "<Tr align='left'><Td align='right'>การอนุมิัติ&nbsp;&nbsp;</Td><Td><Input Type='radio' Name='grant' id='grant' value='1' $grant_1_checked>อนุมัติ</Td></Tr>";
echo "<Tr align='left'><Td align='right'>&nbsp;&nbsp;</Td><Td><Input Type='radio' Name='grant' id='grant' value='2' $grant_2_checked>ไม่อนุมัติ</Td></Tr>";

echo "<Tr align='left'><Td align='right'>คำสั่ง(ถ้ามี)&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='grant_comment' id='grant_comment' Size='40' value='$grant_comment'></Td></Tr>";
echo "</Table>";
echo "</fieldset></td></tr></table>";

echo "<Input Type=Hidden Name='id' Value='$_GET[id]'>";
echo "<Input Type=Hidden Name='page' Value='$_GET[page]'>";
echo "<Br>";
echo "<INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url_update(1)' class=entrybutton>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ย้อนกลับ' onclick='goto_url_update(0)' class=entrybutton'>";
echo "</form>";
}

//ส่วนปรับปรุงข้อมูล
if ($index==6){
		$date_time_now = date("Y-m-d H:i:s");
		$sql = "update permission_main set grant_x='$_POST[grant]', grant_person='$_SESSION[login_user_id]', grant_comment='$_POST[grant_comment]', grant_date='$date_time_now' where id='$_POST[id]'";
		$dbquery = mysql_query($sql);
}

if ($index==7){
echo "<Center>";
echo "<Font color='#006666' Size=3><B>รายละเอียดการขออนุญาตไปราชการ</B></Font>";
echo "</Cener>";
echo "<Br>";

$sql_person = "select  * from  person_main ";
$dbquery_person = mysql_query($sql_person);
While ($result_person = mysql_fetch_array($dbquery_person)){
$fullname=$result_person['prename'].$result_person['name']." ".$result_person['surname'];
$person_ar[$result_person['person_id']]=$fullname;
}

$sql="select * from permission_main where id='$_GET[id]'";
$dbquery = mysql_query($sql);
$ref_result = mysql_fetch_array($dbquery);
$id=$ref_result['id'];
$person_id=$ref_result['person_id'];
$ref_id=$ref_result['ref_id'];
$file=$ref_result['document'];
$grant_person_selected=$ref_result['grant_person_selected'];
$comment_person=$ref_result['comment_person'];
$grant_person=$ref_result['grant_person'];
$rec_date=$ref_result['rec_date'];
echo "<Br>";
echo "<Table  align='center' width='80%' Border='0'>";
echo "<Tr ><Td colspan='2' align='right'><INPUT TYPE='button' name='smb' value='<<กลับหน้าก่อน' onclick='location.href=\"?option=permission&task=main/grant&page=$_GET[page]\"'></Td></Tr>";

echo "<Tr align='left'><Td align='right' width='50%'>เลขที่&nbsp;&nbsp;</Td><Td>$ref_result[id]</Td></Tr>";

echo "<Tr align='left'><Td align='right' width='50%'>ผู้ขออนุญาต&nbsp;&nbsp;</Td><Td>$person_ar[$person_id]</Td></Tr>";

echo "<Tr align='left'><Td align='right'>วันที่ขออนุญาต&nbsp;&nbsp;</Td><Td>";
echo thai_date_4($rec_date);
echo "</Td></Tr>";
echo "<Tr align='left'><Td align='right'>เรื่องไปราชการ&nbsp;&nbsp;</Td><Td>$ref_result[subject]</Td></Tr>";

echo "<Tr align='left'><Td align='right'>สถานที่&nbsp;&nbsp;</Td><Td>$ref_result[place]</Td></Tr>";

	$sql_date="select * from permission_date where ref_id='$ref_id' order by date";
	$dbquery_date = mysql_query($sql_date);
	$date_num=1;
	While ($result_date = mysql_fetch_array($dbquery_date)){
		$date = $result_date['date'];
		$full_date=thai_date($date);
		if($date_num==1){
		echo "<Tr align='left'><Td align='right'>วันไปราชการ&nbsp;&nbsp;</Td><Td>$full_date</Td></Tr>";
		}
		else{
		echo "<Tr align='left'><Td align='right'>&nbsp;&nbsp;</Td><Td>$full_date</Td></Tr>";
		}
		
		$date_num++;
	}

echo "<Tr align='left'><Td align='right'>พาหนะ&nbsp;&nbsp;</Td><Td>$ref_result[vehicle]</Td></Tr>";

if($ref_result['document']!=""){
echo "<Tr><Td align='right'>เอกสาร&nbsp;&nbsp;</Td><Td align='left'><a href=$file target=_blank><img src=./images/browse.png border='0' alt='File'></Td></Tr>";
}

if($ref_result['no_comment']==1){
$no_comment_select="checked";
}
else{
$no_comment_select="";
}
echo "<Tr align='left'><Td align='right'></Td><Td><input type='checkbox'  name='no_comment' id='no_comment' value='1' $no_comment_select>&nbsp;ไม่ต้องผ่านผู้บังคับบัญชาขั้นต้น</Td></Tr>";

if($grant_person_selected!=""){
echo "<Tr align='left'><Td align='right'>ผู้อนุมัติ&nbsp;&nbsp;</Td><Td>$person_ar[$grant_person_selected]</Td></Tr>";
}

echo "</Table>";

echo "<table width='500'><tr><td>";
echo "<fieldset>";
echo "<legend>&nbsp;<B>ส่วนความเห็นของผู้บังคับบัญชาขั้นต้น</B>: &nbsp;</legend>";
echo "<table>";
$thai_date_comment=thai_date_4($ref_result['comment_date']);
echo "<Tr align='left'><Td align='right' width='50%'>ความเห็นของผู้บังคับบัญชาขั้นต้น&nbsp;&nbsp;</Td><Td>$ref_result[comment]</Td></Tr>";
echo "<Tr align='left'><Td align='right' width='50%'>ลงชื่อ&nbsp;&nbsp;</Td><Td>";
if(isset($person_ar[$comment_person])){
echo $person_ar[$comment_person];
}
echo "</Td></Tr>";
echo "<Tr align='left'><Td align='right'>วันเวลา&nbsp;&nbsp;</Td><Td>$thai_date_comment</Td></Tr>";

echo "</table>";
echo "</fieldset></td></tr></table>";

echo "<table width='500'><tr><td>";
echo "<fieldset>";
echo "<legend>&nbsp;<B>ส่วนของการอนุมัติ/คำสั่ง</B>: &nbsp;</legend>";
echo "<table>";

echo "<Tr align='left'><Td align='right' width='50%'>การอนุมัติ&nbsp;&nbsp;</Td><Td>";
if($ref_result['grant_x']==1){
echo "อนุมัติ";
}
if($ref_result['grant_x']==2){
echo "ไม่อนุมัติ";
}
echo "</Td></Tr>";
echo "<Tr align='left'><Td align='right'>คำสั่ง&nbsp;&nbsp;</Td><Td>$ref_result[grant_comment]</Td></Tr>";
echo "<Tr align='left'><Td align='right' width='50%'>ลงชื่อ&nbsp;&nbsp;</Td><Td>";
if(isset($person_ar[$grant_person])){
echo $person_ar[$grant_person];
}
echo "</Td></Tr>";
$thai_date_grant=thai_date_4($ref_result['grant_date']);
echo "<Tr align='left'><Td align='right'>วันเวลา&nbsp;&nbsp;</Td><Td>$thai_date_grant</Td></Tr>";
echo "</table>";
echo "</fieldset></td></tr></table>";
}

//ส่วนแสดงผล
if(!(($index==1) or ($index==2) or ($index==5) or ($index==7))){

$now=time();
$time_onedayago=$now-86400;
$onedayago=date("Y-m-d H:i:s",$time_onedayago);

//ส่วนของการแยกหน้า
$sql = "select permission_main.id, permission_main.person_id, permission_main.subject, permission_main.place, permission_main.vehicle, permission_main.ref_id, permission_main.document, permission_main.comment, permission_main.grant_x, permission_main.grant_comment,permission_main.grant_date, permission_main.grant_person_selected, permission_main.rec_date from permission_main left join permission_person_set on  permission_main.person_id=permission_person_set.person_id where (permission_main.grant_person_selected ='$_SESSION[login_user_id]' or permission_person_set.grant_person ='$_SESSION[login_user_id]') and (permission_main.rec_date<'$onedayago' or permission_person_set.comment_person is null or permission_person_set.comment_person='' or permission_main.no_comment='1' or permission_main.comment_person is not null) ";
$dbquery = mysql_query($sql);
$num_rows = mysql_num_rows($dbquery );

$pagelen=20;  // 1_กำหนดแถวต่อหน้า
$url_link="option=permission&task=main/grant";  // 2_กำหนดลิงค์ฺ
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

$sql = "select permission_main.id, permission_main.person_id, permission_main.subject, permission_main.place, permission_main.vehicle, permission_main.ref_id, permission_main.document, permission_main.comment, permission_main.grant_x, permission_main.grant_comment,permission_main.grant_date, permission_main.grant_person_selected, permission_main.rec_date from permission_main left join permission_person_set on  permission_main.person_id=permission_person_set.person_id where (permission_main.grant_person_selected ='$_SESSION[login_user_id]' or permission_person_set.grant_person ='$_SESSION[login_user_id]') and (permission_main.rec_date<'$onedayago' or permission_person_set.comment_person is null or permission_person_set.comment_person='' or permission_main.no_comment='1' or permission_main.comment_person is not null) order by permission_main.id limit $start,$pagelen";

$dbquery = mysql_query($sql);

echo "<form id='frm1' name='frm1'>";
echo  "<table width='98%' border='0' align='center'>";
echo "<Tr><Td colspan='11' align='right'><INPUT TYPE='checkbox' name='allchk'  id='allckk' onclick='CheckAll()'>เลือก/ไม่เลือกทั้งหมด</Td></Tr>";
echo "<Tr bgcolor='#FFCCCC' align='center'><Td width='60'>เลขที่</Td><Td width='120'>ผู้ขออนุญาต</Td><Td width='90'>วันขออนุญาต</Td><Td>เรื่องราชการ</Td><Td>สถานที่</Td><Td width='100'>วันไปราชการ</Td><Td width='100'>พาหนะ</Td><Td width='50'>เอกสาร</Td><Td width='50'>รายละเอียด</Td><Td width='120'><INPUT TYPE='button' name='smb' value='อนุมัติไปราชการ' onclick='goto_url(1)'></Td><Td width='40'>บันทึก</Td></Tr>";

$N=(($page-1)*$pagelen)+1; //*เกี่ยวข้องกับการแยกหน้า
$M=1;

While ($result = mysql_fetch_array($dbquery)){
		$id = $result['id'];
		$person_id = $result['person_id'];		
		$subject = $result['subject'];
		$place = $result['place'];
		$vehicle = $result['vehicle'];
		$ref_id = $result['ref_id'];
		$file = $result['document'];
		$grant_person_selected = $result['grant_person_selected'];
		$comment = $result['comment'];
		$grant = $result['grant_x'];
		$grant_comment = $result['grant_comment'];
		$grant_date = $result['grant_date'];
		$rec_date = $result['rec_date'];
			if(($M%2) == 0)
			$color="#FFFFB";
			else  	$color="#FFFFFF";
			
if(($grant_person_selected!="") && ($grant_person_selected!=$_SESSION['login_user_id'])){
continue;
}

echo "<Tr bgcolor='$color'><Td valign='top' align='center'>$id</Td>";
$sql_person = "select * from  person_main where person_id='$person_id' ";
$dbquery_person = mysql_query($sql_person);
$result_person = mysql_fetch_array($dbquery_person);
$fullname=$result_person['prename'].$result_person['name']." ".$result_person['surname'];

echo "</Td><Td valign='top' align='left'>$fullname</Td>";
echo "<Td valign='top' align='left'>";
echo thai_date_3($rec_date);
echo "</Td><Td valign='top' align='left'>$subject</Td>";
echo "<Td valign='top' align='left'>$place</Td><Td valign='top' align='left'>";

	$sql_date="select * from permission_date where ref_id='$ref_id' order by date";
	$dbquery_date = mysql_query($sql_date);
	While ($result_date = mysql_fetch_array($dbquery_date)){
		$date = $result_date['date'];
		echo thai_date_3($date);
		echo "<br />";
	}
echo "</Td><Td valign='top' align='left'>$vehicle</Td>";
if($file!=""){
echo   "<Td valign='top' align='center'><a href='$file' target=_blank><IMG SRC='images/b_browse.png' width='16' height='16' border=0 alt='เอกสาร'></a></td>";
}
else{
echo "<Td valign='top' align='left'></Td>";
}
echo "<Td valign='top' align='center'><a href=?option=permission&task=main/grant&index=7&id=$id&page=$page><img src=images/browse.png border='0' alt='รายละเอียด'></Td>";
echo "<Td valign='top' align='center'>";
if($grant==1){
echo "<img src=images/yes.png border='0'><br>$grant_comment";
}
else if($grant==2){
echo "<img src=images/no.png border='0'><br>$grant_comment";
}
else{
echo "<input type='checkbox' name='$id' id='$id' value='1'>";
}
echo "</Td>";
$now=time();
$timestamp=make_time_2($grant_date);
if($grant_date==""){
$timestamp_2=$now+1800;
}
else{
$timestamp=make_time_2($grant_date);
$timestamp_2=$timestamp+1800;
}
if($now<$timestamp_2){
echo "<Td valign='top' align='center'><a href=?option=permission&task=main/grant&index=5&id=$id&page=$page><img src=images/edit.png border='0' alt='บันทึก'></a></Td>";
}
else{
echo "<td></td>";
}
echo "</Tr>";

$M++;
$N++;  //*เกี่ยวข้องกับการแยกหน้า
}	
echo "</Table>";
echo "</form>";

echo "<br />
&nbsp;&nbsp;<b>หมายเหตุ</b>&nbsp;เรื่องมาถึงผู้อนุมัติกรณี <br />&nbsp;&nbsp;1. ผู้ขออนุญาตเลือกไม่ต้องผ่านผู้บังคับบัญชาขั้นต้น หรือ <br />&nbsp;&nbsp;2. ผู้บังคับบัญชาขั้นต้นลงนามแล้ว หรือ<br />&nbsp;&nbsp;3. ผู้บังคับบัญชาขั้นต้นไม่ลงนามเกินระยะเวลา 1 วัน นับตั้งแต่ผู้ขออนุญาตเสนอเรื่อง&nbsp;&nbsp;";
}

?>
<script>
function goto_url(val){
	if(val==0){
		callfrm("?option=permission&task=main/grant");   // page ย้อนกลับ 
	}else if(val==1){
		callfrm("?option=permission&task=main/grant&index=4");   //page ประมวลผล
	}
}

function goto_url_update(val){
	if(val==0){
		callfrm("?option=permission&task=main/grant");   // page ย้อนกลับ 
	}else if(val==1){
		if((frm1.grant[0].checked!=true) && (frm1.grant[1].checked!=true)){
			alert("กรุณาเลือกการอนุมัติ");
		}else{
			callfrm("?option=permission&task=main/grant&index=6");   //page ประมวลผล
		}
	}
}

function CheckAll() {
	for (var i = 0; i < document.frm1.elements.length; i++)
	{
	var e = document.frm1.elements[i];
	if (e.name != "allchk")
		e.checked = document.frm1.allchk.checked;
	}
}
</script>
