<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
if(!($_SESSION['login_status']<=4)){
exit();
}

require_once "modules/meeting/time_inc.php";	
?>
<script type="text/javascript" src="./css/js/calendarDateInput.js"></script> 
<?php

$user=$_SESSION['login_user_id'];


//กรณีเลือกแสดงเฉพาะห้องประชุม
if(isset($_REQUEST['room_index'])){
$room_index=$_REQUEST['room_index'];
}else{
	$room_index = "";
	}
//ส่วนหัว
echo "<br />";
if(!(($index==1) or ($index==2))){

echo "<table width='100%' border='0' align='center'>";
echo "<tr align='center'><td><font color='#006666' size='3'><strong>ทะเบียนจองห้องประชุม</strong></font></td></tr>";
echo "</table>";
}

//ส่วนฟอร์มรับข้อมูล
if($index==1){
echo "<form id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>จองห้องประชุม</Font>";
echo "</Cener>";
echo "<Br><Br>";
echo "<Table width='70%'>";
echo "<Tr align='left'><Td align='right'>เลือกห้องประชุม&nbsp;&nbsp;</Td><Td><Select  name='room'  size='1'>";
echo  "<option  value = ''>เลือก</option>" ;
$sql = "select * from meeting_room where active='1' order by id";
$dbquery = mysql_query($sql);
while ($result = mysql_fetch_array($dbquery))
   {
		$room_code = $result['room_code'];
		$room_name = $result['room_name'];
		if($room_index==$room_code){
		echo  "<option value = $room_code selected>$room_name</option>";
		}
		else{
		echo  "<option value = $room_code>$room_name</option>";
		}
	}
echo "</select>";
echo "</Td></Tr>";

echo "<Tr align='left'><Td align='right'>วันทีใช้ห้อง&nbsp;&nbsp;</Td>";

echo "<Td align='left'>";
?>
<script>
								var Y_date=<?php echo date("Y");?>  
								var m_date=<?php echo date("m");?>  
								var d_date=<?php echo date("d");?>  
								Y_date= Y_date+'/'+m_date+'/'+d_date
								DateInput('book_date', true, 'YYYY-MM-DD', Y_date)</script> 
<?php
								
echo "</Td></Tr>";

echo "<Tr align='left'><Td align='right'>ตั้งแต่เวลา&nbsp;&nbsp;</Td><Td><Select  name='start_time'  size='1'>";
echo  "<option  value = ''>เลือก</option>" ;
echo  "<option value = 1>01.00 น.</option>";
echo  "<option value = 2>02.00 น.</option>";
echo  "<option value = 3>03.00 น.</option>";
echo  "<option value = 4>04.00 น.</option>";
echo  "<option value = 5>05.00 น.</option>";
echo  "<option value = 6>06.00 น.</option>";
echo  "<option value = 7>07.00 น.</option>";
echo  "<option value = 8 selected>08.00 น.</option>";
echo  "<option value = 9>09.00 น.</option>";
echo  "<option value = 10>10.00 น.</option>";
echo  "<option value = 11>11.00 น.</option>";
echo  "<option value = 12>12.00 น.</option>";
echo  "<option value = 13>13.00 น.</option>";
echo  "<option value = 14>14.00 น.</option>";
echo  "<option value = 15>15.00 น.</option>";
echo  "<option value = 16>16.00 น.</option>";
echo  "<option value = 17>17.00 น.</option>";
echo  "<option value = 18>18.00 น.</option>";
echo  "<option value = 19>19.00 น.</option>";
echo  "<option value = 20>20.00 น.</option>";
echo  "<option value = 21>21.00 น.</option>";
echo  "<option value = 22>22.00 น.</option>";
echo  "<option value = 23>23.00 น.</option>";
echo  "<option value = 24>24.00 น.</option>";
echo "</select>";
echo "</Td></Tr>";

echo "<Tr align='left'><Td align='right'>ถึงเวลา&nbsp;&nbsp;</Td><Td><Select  name='finish_time'  size='1'>";
echo  "<option  value = ''>เลือก</option>" ;
echo  "<option value = 1>01.00 น.</option>";
echo  "<option value = 2>02.00 น.</option>";
echo  "<option value = 3>03.00 น.</option>";
echo  "<option value = 4>04.00 น.</option>";
echo  "<option value = 5>05.00 น.</option>";
echo  "<option value = 6>06.00 น.</option>";
echo  "<option value = 7>07.00 น.</option>";
echo  "<option value = 8>08.00 น.</option>";
echo  "<option value = 9>09.00 น.</option>";
echo  "<option value = 10>10.00 น.</option>";
echo  "<option value = 11>11.00 น.</option>";
echo  "<option value = 12  selected>12.00 น.</option>";
echo  "<option value = 13>13.00 น.</option>";
echo  "<option value = 14>14.00 น.</option>";
echo  "<option value = 15>15.00 น.</option>";
echo  "<option value = 16>16.00 น.</option>";
echo  "<option value = 17>17.00 น.</option>";
echo  "<option value = 18>18.00 น.</option>";
echo  "<option value = 19>19.00 น.</option>";
echo  "<option value = 20>20.00 น.</option>";
echo  "<option value = 21>21.00 น.</option>";
echo  "<option value = 22>22.00 น.</option>";
echo  "<option value = 23>23.00 น.</option>";
echo  "<option value = 24>24.00 น.</option>";
echo "</select>";
echo "</Td></Tr>";
echo "<Tr align='left'><Td align='right'>วัตถุประสงค์&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='objective' Size='60'></Td></Tr>";
echo "<Tr align='left'><Td align='right'>จำนวนผู้เข้าประชุม&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='person_num' Size='4'>&nbsp;คน</Td></Tr>";
echo "<Tr align='left'><Td align='right'>อื่น ๆ (ถ้ามี)&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='other' Size='100'></Td></Tr>";
echo "</Table>";
echo "<Br>";
echo "<INPUT TYPE='hidden' name='room_index' value=$room_index>";
echo "<INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url(1)' class=entrybutton>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ย้อนกลับ' onclick='goto_url(0)' class=entrybutton'>";

echo "</form>";
}

//ส่วนยืนยันการลบข้อมูล
if($index==2) {
echo "<table width='500' border='0' align='center'>";
echo "<tr><td align='center'><font color='#990000' size='4'>โปรดยืนยันความต้องการลบข้อมูลอีกครั้ง</font><br></td></tr>";
echo "<tr><td align=center>";
echo "<INPUT TYPE='button' name='smb' value='ยืนยัน' onclick='location.href=\"?option=meeting&task=main/meeting&index=3&id=$_GET[id]&page=$_REQUEST[page]&room_index=$_REQUEST[room_index]\"'>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ยกเลิก' onclick='location.href=\"?option=meeting&task=main/meeting&page=$_REQUEST[page]&room_index=$_REQUEST[room_index]\"'";
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
/* $sql = "insert into meeting_main (room, book_date, start_time, finish_time, objective, person_num, other, book_person, rec_date) values ('$_POST[room]', '$_POST[book_date]','$_POST[start_time]','$_POST[finish_time]','$_POST[objective]','$_POST[person_num]','$_POST[other]','$user','$date_time_now')"; */

$sql = "insert into meeting_main (room, book_date, start_time, finish_time, objective, person_num, other, book_person, rec_date) values ('$_POST[room]', '$_POST[book_date]','$_POST[start_time]','$_POST[finish_time]','$_POST[objective]','$_POST[person_num]','$_POST[other]','$user','$date_time_now')";
$dbquery = mysql_query($sql);
}

//ส่วนแสดงผล
if(!(($index==1) or ($index==2))){

//ส่วนของการแยกหน้า
if($room_index>=1){
$sql="select id from meeting_main where room='$room_index' ";
}
else{
$sql="select id from meeting_main";
}

$dbquery = mysql_query($sql);
$num_rows = mysql_num_rows($dbquery);

$pagelen=20;  // 1_กำหนดแถวต่อหน้า
$url_link="option=meeting&task=main/meeting&room_index=$room_index";  // 2_กำหนดลิงค์ฺ
$totalpages=ceil($num_rows/$pagelen);

	if(!isset($_REQUEST['page'])){
//   if($_REQUEST['page']==""){ 
$page=$totalpages;
		if($page<2){
		$page=1;
		}
}else{
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
while ($result_room = mysql_fetch_array($dbquery_room))
{
$room_ar[$result_room['room_code']]=$result_room['room_name'];
}

if($room_index>=1){
$sql="select meeting_main.id, meeting_main.room, meeting_main.book_date, meeting_main.start_time, meeting_main.finish_time, meeting_main.objective, meeting_main.person_num, meeting_main.other, meeting_main.book_person, meeting_main.rec_date, meeting_main.approve, meeting_main.reason, person_main.name ,person_main.surname from meeting_main left join person_main on meeting_main.book_person = person_main.person_id where meeting_main.room='$room_index' order by meeting_main.book_date,meeting_main.room,meeting_main.start_time limit $start,$pagelen";
}
else{
$sql="select meeting_main.id, meeting_main.room, meeting_main.book_date, meeting_main.start_time, meeting_main.finish_time, meeting_main.objective, meeting_main.person_num,  meeting_main.other, meeting_main.book_person, meeting_main.rec_date, meeting_main.approve, meeting_main.reason, person_main.name ,person_main.surname from meeting_main left join person_main on meeting_main.book_person = person_main.person_id order by meeting_main.book_date,meeting_main.room,meeting_main.start_time limit $start,$pagelen";
}

$dbquery = mysql_query($sql);

echo  "<table width=95% border=0 align=center>";
echo "<Tr><Td colspan='7' align='left'><INPUT TYPE='button' name='smb' value='จองห้องประชุม' onclick='location.href=\"?option=meeting&task=main/meeting&index=1&room_index=$room_index\"'></Td>";

echo "<Td colspan='5' align='right'>";

echo "<form  name='frm1'>";
echo "&nbsp;<Select  name='room_index' size='1'>";
echo  '<option value ="" >ทุกห้องประชุม</option>' ;
		$sql_room = "SELECT *  FROM meeting_room where active='1' order by room_code";
		$dbquery_room = mysql_query($sql_room);
				while ($result_room = mysql_fetch_array($dbquery_room ))
				{ 
						if ($room_index==$result_room ['room_code']){
						echo "<option value=$result_room[room_code]  selected>$result_room[room_name]</option>"; 
						} 
						else{
						echo "<option value=$result_room[room_code]>$result_room[room_name]</option>"; 
						}
				}
					echo "</select>";
echo "&nbsp;<INPUT TYPE='button' name='smb' value='เลือก' onclick='goto_url2(1)'>";
echo "</form>";

echo "</Td>";
echo "</Tr>";

echo "<Tr bgcolor='#FFCCCC' align='center'><Td width='80'>วันที่</Td><Td width='100'>ห้องประชุม</Td><Td  width='60'>ตั้งแต่เวลา</Td><Td width='60'>ถึงเวลา</Td><Td>วัตถุประสงค์</Td><Td width='100'>จำนวนผู้ประชุม</Td><Td width='200'>อื่น ๆ</Td><Td width='100'>ผู้จอง</Td><Td>วันเวลาจอง</Td><Td width='40'>ลบ</Td><Td width='40'>อนุมัติ</Td><Td>หมายเหตุ</Td></Tr>";
	//	if(isset($dbquery)){
$N=(($page-1)*$pagelen)+1; //*เกี่ยวข้องกับการแยกหน้า
$M=1;

while ($result = mysql_fetch_array($dbquery)){
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

if($result['book_person']==$user){
echo "<Td align='center'><a href=?option=meeting&task=main/meeting&index=2&id=$id&page=$page&room_index=$room_index><img src=images/drop.png border='0' alt='ลบ'></Td>";
}
else{
echo "<td></td>";
}

if($result['approve']==1){
echo "<Td align='center'><img src=images/yes.png border='0' alt='อนุมัติ'></Td>";
}
else if($result['approve']==2){
echo "<Td align='center'><img src=images/no.png border='0' alt='ไม่อนุมัติ'></Td>";
}
else {
echo "<td></td>";
} 

if($result['reason']!=""){
echo "<Td align='left'>$result[reason]</Td>";
}
else{
echo "<td></td>";
}

echo "</Tr>";

$M++;
$N++;  //*เกี่ยวข้องกับการแยกหน้า
}
	//	}	/// if(isset($dbquery)){
echo "</Table>";
}

if(!(($index==1) or ($index==2) or ($index==3))) {
echo "<br>";
echo "&nbsp;&nbsp;<img src=images/yes.png border='0'> หมายถึง อนุมัติให้ใช้ห้องประชุม&nbsp;&nbsp;<img src=images/no.png border='0'> หมายถึง ไม่อนุมัติให้ใช้ห้องประชุม";
}
?>

<script>
function goto_url(val){
	if(val==0){
		callfrm("?option=meeting&task=main/meeting");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.room.value == ""){
			alert("กรุณาเลือกห้องประชุม");
		}else if(frm1.objective == ""){
			alert("กรุณาระบุวัตถุประสงค์ของการใช้");
		}else{
			callfrm("?option=meeting&task=main/meeting&index=4");   //page ประมวลผล
		}
	}
}

function goto_url2(val){
callfrm("?option=meeting&task=main/meeting"); 		
}

</script>
