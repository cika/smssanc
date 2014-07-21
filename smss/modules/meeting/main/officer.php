<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
if(!(($result_permission['p1']==1) or ($_SESSION['admin_meeting']=="meeting"))){
exit();
}

require_once "modules/meeting/time_inc.php";	
$user=$_SESSION['login_user_id'];

$sql = "select * from person_main where status='0' and (position_code='1' or position_code='2') order by position_code,person_order";
$dbquery_person = mysql_query($sql);
While ($result_person = mysql_fetch_array($dbquery_person))
{
$person_id = $result_person['person_id'];
$name = $result_person['name'];
$surname = $result_person['surname'];
$person_ar[$result_person['person_id']]=$name.' '. $surname;
}

//ส่วนหัว
echo "<br />";
if(!(($index==1) or ($index==2) or ($index==5))){

echo "<table width='100%' border='0' align='center'>";
echo "<tr align='center'><td><font color='#006666' size='3'><strong>ส่วนของเจ้าหน้าที่</strong></font></td></tr>";
echo "</table>";
}

//ส่วนยืนยันการลบข้อมูล
if($index==2) {
echo "<table width='500' border='0' align='center'>";
echo "<tr><td align='center'><font color='#990000' size='4'>โปรดยืนยันความต้องการลบข้อมูลอีกครั้ง</font><br></td></tr>";
echo "<tr><td align=center>";
echo "<INPUT TYPE='button' name='smb' value='ยืนยัน' onclick='location.href=\"?option=meeting&task=main/officer&index=3&id=$_GET[id]&page=$_REQUEST[page]\"'>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ยกเลิก' onclick='location.href=\"?option=meeting&task=main/officer&page=$_REQUEST[page]\"'";
echo "</td></tr></table>";
}

//ส่วนลบข้อมูล
if($index==3){
$sql = "delete from meeting_main where id='$_GET[id]'";
$dbquery = mysql_query($sql);
}

//ส่วนบันทึกข้อมูล
if($index==4){
$date_time_now = date("Y-m-d H:i:s");
if(!isset($_POST['allchk'])){
$_POST['allchk']="";
}

	foreach($_POST as $key => $value){
		if($key!=$_POST['allchk']){
		$sql = "update meeting_main set approve='$value', officer='$_SESSION[login_user_id]', officer_date='$date_time_now' where id='$key'";
		$dbquery = mysql_query($sql);
		}
	}
}

if ($index==5){
echo "<form id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>ส่วนของการอนุญาต</Font>";
echo "</Cener>";
echo "<Br><Br>";

$sql_room = "select * from meeting_room where active='1' order by id";
$dbquery_room = mysql_query($sql_room);
While ($result_room = mysql_fetch_array($dbquery_room))
{
$room_ar[$result_room['room_code']]=$result_room['room_name'];
}

$sql="select meeting_main.id, meeting_main.room, meeting_main.book_date, meeting_main.start_time, meeting_main.finish_time, meeting_main.objective, meeting_main.person_num,  meeting_main.other, meeting_main.book_person, meeting_main.rec_date, meeting_main.approve, meeting_main.reason, person_main.name ,person_main.surname from meeting_main left join person_main on meeting_main.book_person = person_main.person_id where meeting_main.id='$_GET[id]' ";
$dbquery = mysql_query($sql);
$result = mysql_fetch_array($dbquery);
		$id= $result['id'];
		$room= $result['room'];
		$start_time=$result['start_time'];
		$start_time=number_format($start_time,2);
		$finish_time=$result['finish_time'];
		$finish_time=number_format($finish_time,2);
		$book_date = $result['book_date'];
		$rec_date = $result['rec_date'];
		$name= $result['name'];
		$surname = $result['surname'];

echo "<Table width='60%'><tr><td>";
echo "<fieldset>";
echo "<legend>&nbsp;<B>ข้อมูลผู้ขอใช้</B>: &nbsp;</legend>";
echo "<table>";
echo "<Tr align='left'><Td align='right'>ห้องประชุม&nbsp;&nbsp;</Td><Td>$room_ar[$room]</Td></Tr>";

echo "<Tr align='left'><Td align='right'>วันทีใช้หห้อง&nbsp;&nbsp;</Td>";
echo "<Td align='left'>";
echo thai_date_3($book_date);
echo "</Td></Tr>";

echo "<Tr align='left'><Td align='right'>ตั้งแต่เวลา&nbsp;&nbsp;</Td>";
echo "<Td align='left'>$start_time น.</Td></Tr>";

echo "<Tr align='left'><Td align='right'>ถึงเวลา&nbsp;&nbsp;</Td>";
echo "<Td align='left'>$finish_time น.</Td></Tr>";

echo "<Tr align='left'><Td align='right'>วัตถุประสงค์&nbsp;&nbsp;</Td><Td>$result[objective]</Td></Tr>";
echo "<Tr align='left'><Td align='right'>จำนวนผู้เข้าประชุม&nbsp;&nbsp;</Td><Td>$result[person_num]&nbsp;คน</Td></Tr>";
echo "<Tr align='left'><Td align='right'>อื่น ๆ&nbsp;&nbsp;</Td><Td>$result[other]</Td></Tr>";

echo "<Tr align='left'><Td align='right'>ผู้จองฺ&nbsp;&nbsp;</Td><Td>$name&nbsp;&nbsp;$surname</Td></Tr>";

echo "<Tr align='left'><Td align='right'>วันเวลาจอง&nbsp;&nbsp;</Td><Td>";
echo thai_date_4($rec_date);
echo "</td></tr>";
echo "</table></fieldset>";

echo "<fieldset>";
echo "<legend>&nbsp;<B>ส่วนเจ้าหน้าที่</B>: &nbsp;</legend>";
echo "<table>";
$approve_check1="";  $approve_check2="";	
		if($result['approve']==1){
		$approve_check1="checked";
		}
		else if($result['approve']==2){
		$approve_check2="checked";
		}
echo "<Tr align='left'><Td align='right'>อนุญาต/ไม่อนุญาตการใช้ห้องประชุม&nbsp;&nbsp;</Td><Td><Input Type='radio' Name='approve' value='1' $approve_check1>อนุญาต&nbsp;&nbsp;<Input Type='radio' Name='approve' value='2' $approve_check2>ไม่อนุญาต&nbsp;&nbsp;</Td></Tr>";
echo "<Tr align='left'><Td align='right'>หมายเหตุ(ถ้ามี)&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='reason' Size='50' value='$result[reason]'></Td></Tr>";

echo "</table></fieldset>";

echo "</td></tr></Table>";
echo "<Input Type=Hidden Name='id' Value='$_GET[id]'>";
echo "<Input Type=Hidden Name='page' Value='$_GET[page]'>";
echo "<Br />";
echo "<Input Type=Hidden Name='id' Value='$_GET[id]'>";
echo "<INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url_update(1)' class=entrybutton>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ย้อนกลับ' onclick='goto_url_update(0)' class=entrybutton'>";
echo "</form>";
}

if ($index==6){
$date_time_now = date("Y-m-d H:i:s");
		$sql = "update meeting_main set approve='$_POST[approve]', 
		reason='$_POST[reason]', 
		officer='$_SESSION[login_user_id]', 
		officer_date='$date_time_now'
		where id='$_POST[id]'";
		$dbquery = mysql_query($sql);
}

//ส่วนแสดงผล
if(!(($index==1) or ($index==2) or ($index==5))){

//ส่วนของการแยกหน้า
$sql="select id from meeting_main";
$dbquery = mysql_query($sql);
$num_rows = mysql_num_rows($dbquery);

$pagelen=20;  // 1_กำหนดแถวต่อหน้า
$url_link="option=meeting&task=main/officer";  // 2_กำหนดลิงค์ฺ
$totalpages=ceil($num_rows/$pagelen);

if(!isset($_REQUEST['page'])){
$_REQUEST['page']="";
}

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

$sql_room = "select * from meeting_room where active='1' order by id";
$dbquery_room = mysql_query($sql_room);
While ($result_room = mysql_fetch_array($dbquery_room))
{
$room_ar[$result_room['room_code']]=$result_room['room_name'];
}

$sql="select meeting_main.id, meeting_main.room, meeting_main.book_date, meeting_main.start_time, meeting_main.finish_time, meeting_main.objective,  meeting_main.person_num,  meeting_main.other, meeting_main.book_person, meeting_main.rec_date, meeting_main.approve, meeting_main.reason, person_main.name ,person_main.surname, meeting_main.officer from meeting_main left join person_main on meeting_main.book_person = person_main.person_id order by meeting_main.book_date,meeting_main.room,meeting_main.start_time,meeting_main.id limit $start,$pagelen";
$dbquery = mysql_query($sql);

echo "<form id='frm1' name='frm1'>";
echo  "<table width='95%' border='0' align='center'>";
echo "<Tr><td colspan='11'></td><Td colspan='4' align='left'><INPUT TYPE='checkbox' name='allchk'  id='allckk' onclick='CheckAll()'>เลือก/ไม่เลือกทั้งหมด</Td></Tr>";
echo "<Tr bgcolor='#FFCCCC' align='center'><Td width='80'>วันที่</Td><Td>ห้องประชุม</Td><Td>ตั้งแต่เวลา</Td><Td>ถึงเวลา</Td><Td>วัตถุประสงค์</Td><Td width='100'>จำนวนผู้ประชุม</Td><Td width='200'>อื่น ๆ</Td><Td>ผู้จอง</Td><Td>วันเวลาจอง</Td><Td width='40'><INPUT TYPE='button' name='smb' value='อนุญาต' onclick='goto_url_update2(1)'></Td><Td>ผู้อนุญาต</Td><Td width='90'>หมายเหตุ</Td><Td width='40'>เจ้าหน้าที่</Td></Tr>";

$N=(($page-1)*$pagelen)+1; //*เกี่ยวข้องกับการแยกหน้า
$M=1;

While ($result = mysql_fetch_array($dbquery)){
		$id= $result['id'];
		$room= $result['room'];
		$start_time=$result['start_time'];
		$start_time=number_format($start_time,2);
		$finish_time=$result['finish_time'];
		$officer=$result['officer'];		
		$finish_time=number_format($finish_time,2);
		$book_date = $result['book_date'];
		$rec_date = $result['rec_date'];
		$name= $result['name'];
		$surname = $result['surname'];
		
			if(($M%2) == 0)
			$color="#FFFFB";
			else  	$color="#FFFFFF";
echo "<Tr bgcolor='$color'>";
echo "<Td align='left'>";
echo thai_date_3($book_date);
echo "</Td>";
echo "<Td align='left'>$room_ar[$room]</Td>";
echo "<Td align='center'>$start_time น.</Td><Td align='center' >$finish_time น.</Td>";
echo "<td>$result[objective]</td>";
if($result['person_num']>0){
echo "<td align='center'>$result[person_num]&nbsp;คน</td>";
}
else{
echo "<td align='center'>&nbsp;</td>";
}
echo "<td>$result[other]</td>";
echo "<Td>$name&nbsp;&nbsp;$surname</Td>";
echo "<Td>";
echo thai_date_4($rec_date);
echo "</Td>";

if($result['approve']==1){
echo "<Td align='center'><img src=images/yes.png border='0' alt='อนุมัติ'></Td>";
}
else if($result['approve']==2){
echo "<Td align='center'><img src=images/no.png border='0' alt='ไม่อนุมัติ'></Td>";
}
else{
echo "<Td align='center'><input type='checkbox' name='$id' id='$id' value='1'></Td>";
}

if($result['approve']>=1){
		if(isset($person_ar[$officer])){
		echo "<td>$person_ar[$officer]</td>";
		}
		else{
		echo "<td></td>";
		}
}
else{
echo "<td></td>";
}

if($result['reason']!=""){
echo "<Td align='left'>$result[reason]</Td>";
}
else{
echo "<td></td>";
}

echo "<Td align='center'><a href=?option=meeting&task=main/officer&index=5&id=$id&page=$page><img src=images/b_edit.png border='0' alt='เจ้าหน้าที่'></Td>";

echo "</Tr>";

$M++;
$N++;  //*เกี่ยวข้องกับการแยกหน้า
}	
echo "</Table>";
echo "</form>";
}

if(!(($index==1) or ($index==5))){
echo "<br>";
echo "&nbsp;&nbsp;<img src=images/yes.png border='0'> หมายถึง อนุมัติให้ใช้ห้องประชุม&nbsp;&nbsp;<img src=images/no.png border='0'> หมายถึง ไม่อนุมัติให้ใช้ห้องประชุม";
}
?>

<script>
function goto_url(val){
	if(val==0){
		callfrm("?option=meeting&task=main/officer");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.room.value == ""){
			alert("กรุณาเลือกห้องประชุม");
		}else if(frm1.objective == ""){
			alert("กรุณาระบุวัตถุประสงค์ของการใช้");
		}else{
			callfrm("?option=meeting&task=main/officer&index=4");   //page ประมวลผล
		}
	}
}

function goto_url_update(val){
	if(val==0){
		callfrm("?option=meeting&task=main/officer");   // page ย้อนกลับ 
	}else if(val==1){
		if(!(frm1.approve[0].checked || frm1.approve[1].checked)){
			alert("กรุณาเลือกการอนุญาต");
		}else{
			callfrm("?option=meeting&task=main/officer&index=6");   //page ประมวลผล
		}
	}
}

function goto_url_update2(val){
	if(val==0){
		callfrm("?option=meeting&task=main/officer");   // page ย้อนกลับ 
	}else if(val==1){
		callfrm("?option=meeting&task=main/officer&index=4");   //page ประมวลผล
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
