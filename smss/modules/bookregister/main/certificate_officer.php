<script type="text/javascript" src="./css/js/calendarDateInput2.js"></script> 

<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );

require_once "modules/bookregister/time_inc.php";	
$user2=$user;
$user=$_SESSION['login_user_id'];

$sql_officer = "select * from  bookregister_cer_officer where person_id='$_SESSION[login_user_id]'";
$dbquery_officer = mysql_query($sql_officer);
$result_officer = mysql_fetch_array($dbquery_officer);
if(!$result_officer){
echo "<br>";
echo "<div align='center'>";
echo "เฉพาะเจ้าหน้าที่เท่านั้น";
echo "</div>";
exit();
}

//ส่วนหัว
echo "<br />";
if(!(($index==1) or ($index==2) or ($index==5))){

echo "<table width='100%' border='0' align='center'>";
echo "<tr align='center'><td><font color='#006666' size='3'><strong>ตรวจสอบการลงทะเบียนเกียรติบัตร</strong></font></td></tr>";
echo "</table>";
}


//ส่วนบันทึกข้อมูล
if($index==4){

//ส่วนการบันทึก
$date_time_now = date("Y-m-d");
	foreach($_POST as $key => $value){
		if($key!="allchk"){
		$sql = "update bookregister_certificate set quarantee='$value', quarantee_person='$_SESSION[login_user_id]', quarantee_date='$date_time_now' where ms_id='$key'";
		$dbquery = mysql_query($sql);
		}
	}
} //end index4

if($index==5){
echo "<form Enctype = multipart/form-data id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>ตรวจสอบการลงทะเบียนเกียรติบัตร</B></Font>";
echo "</Cener>";
echo "<Br><Br>";
$sql = "select * from  bookregister_certificate where ms_id='$_GET[id]'";
$dbquery = mysql_query($sql);
$result_ref = mysql_fetch_array($dbquery);

echo "<table border='1' width='700' id='table1' style='border-collapse: collapse' bordercolor='#C0C0C0'>";
echo "<tr bgcolor='#9900CC'>";
echo "<td colspan='4' height='23' align='left'><font size='2' color='#FFFFFF'>&nbsp;รายละเอียด</font></td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right'><span lang='th'><font size='2' color='#0000FF'>ชื่อ&nbsp;</font></span></td>";
echo "<td colspan='3' align='left'>$result_ref[name_cer]</td>";
echo "</tr>";


echo "<tr>";
echo "<td align='right'><span lang='th'><font size='2' color='#0000FF'>เรื่องบรรทัดที่1&nbsp;</font></span></td>";
echo "<td colspan='3' align='left'>$result_ref[subject]</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right'><span lang='th'><font size='2' color='#0000FF'>บรรทัดที่2&nbsp;</font></span></td>";
echo "<td colspan='3' align='left'>$result_ref[subject2]</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right'><span lang='th'><font size='2' color='#0000FF'>วันที่ออก&nbsp;</font></span></td>";
echo "<td colspan='3' align='left'>";
$signdate=thai_date_3($result_ref['signdate']);
echo $signdate;
echo "</td>";
echo "</tr>";

echo "</tr>";
echo "<Tr><Td align='right'><font size='2' color='#0000FF'>ผู้ลงนาม</font>&nbsp;&nbsp;&nbsp;&nbsp;</Td>";
echo "<td align='left'>";
$sql = "select  * from bookregister_cer_sign where code='$result_ref[sign_person]' ";
$dbquery = mysql_query($sql);
$result = mysql_fetch_array($dbquery);
echo $result['name'];
echo "</td></tr>";

if($result_ref ['khet_print']==0){
$print="ไม่พิมพ์";
}
else if($result_ref ['khet_print']==1){
$print="พิมพ์";
}

echo "<tr>";
echo "<td align='right'><span lang='th'><font size='2' color='#0000FF'>การพิมพ์โดยระบบ&nbsp;</font></span></td>";
echo "<td colspan='3' align='left'>$print</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right'><span lang='th'><font size='2' color='#0000FF'>หมายเหตุ&nbsp;</font></span></td>";
echo "<td colspan='3' align='left'>&nbsp;$result_ref[comment]</td>";
echo "</tr>";

echo "<tr>";
echo "<td align='right'><span lang='th'><font size='2' color='#0000FF'>เจ้าหน้าที่ตรวจสอบข้อมูล&nbsp;</font></span></td>";
echo "<td colspan='3' align='left'>&nbsp;<input type='radio' name='quarantee' value='1' checked>รับรอง&nbsp;<input type='radio' name='quarantee'  value='2'>ไม่รับรอง</td>";
echo "</tr>";

echo "<Input Type=Hidden Name='id' Value='$_GET[id]'>";
echo "<Input Type=Hidden Name='page' Value='$_GET[page]'>";
echo "<tr>";
echo "<td align='center' colspan='4'><BR><INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url2(1)' class=entrybutton>&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ย้อนกลับ' onclick='goto_url2(0)'</td>";
echo "</tr>";
echo "</Table>";
echo "</form>";
}

if($index==6){
$date_time_now = date("Y-m-d");
		if(isset($_POST['quarantee'])){
		$sql = "update bookregister_certificate set quarantee='$_POST[quarantee]', quarantee_person='$_SESSION[login_user_id]', quarantee_date='$date_time_now' where ms_id='$_POST[id]' ";
		$dbquery = mysql_query($sql);
		}
} 

//ส่วนแสดงผล
if(!(($index==1) or ($index==2) or ($index==5))){

//ส่วนของการแยกหน้า
$sql="select * from bookregister_certificate"; 
$dbquery = mysql_query($sql);
$num_rows = mysql_num_rows($dbquery );

$pagelen=20;  // 1_กำหนดแถวต่อหน้า
$url_link="option=bookregister&task=main/certificate_officer";  // 2_กำหนดลิงค์ฺ
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
echo "<form id='frm1' name='frm1'>";

if(!isset($_REQUEST['page'])){
$_REQUEST['page']="";
}
echo "<Input Type=Hidden Name='page' Value='$_REQUEST[page]'>";

echo "<table border='0' width='99%' id='table1' style='border-collapse: collapse' cellspacing='2' cellpadding='2' align='center'>
";
echo "<tr>";

echo "<Td colspan='11' align='right'><INPUT TYPE='checkbox' name='allchk'  id='allchk' onclick='CheckAll()'>เลือก/ไม่เลือกทั้งหมด</Td>";
echo "</tr></table>";

?>
<table border="1" width="99%" id="table2" style="border-collapse: collapse" align="center">
				<tr bgcolor="#CCCCCC">
					<td align="center" width="50">
					<font size="2" face="Tahoma">เลขทะเบียน</font></td>
					<td align="center" width="50">
					<font size="2" face="Tahoma">ปี</font></td>
					<td align="center" width="70">
					<font face="Tahoma" size="2">ที่เกียรติบัตร</font></td>
					<td align="center" width="140">
					<font face="Tahoma" size="2">ชื่อ</font></td>
					<td align="center">
					<font face="Tahoma" size="2">เรื่อง/รายการ</font></td>
					<td align="center" width="80">
					<font face="Tahoma" size="2">วันที่ออก</font></td>
					<td align="center" width="140">
					<font face="Tahoma" size="2">ผู้ลงนาม</font></td>
					<td align="center" width="10">
					<font face="Tahoma" size="2">การพิมพ์</font></td>
					<td align="center" width="60">
					<font face="Tahoma" size="2">หมายเหตุ</font></td>
					<td align="center" width="120">
					<font face="Tahoma" size="2">ผู้ลงทะเบียน</font></td>
					<td align="center" width="80">
					<font face="Tahoma" size="2">วันลงทะเบียน</font></td>
					<td align="center" width="50">
					<font face="Tahoma" size="2">เอกสาร</font></td>
					<td align="center" width="40">
					<font face="Tahoma" size="2">พิมพ์</font></td>
					<td align="center" width="50">
					<font face="Tahoma" size="2"><?php echo "<INPUT TYPE='button' name='smb' value='รับรอง' onclick='goto_url(1)'>"; ?> </font></td>
					<td align="center" width="40">
					<font face="Tahoma" size="2">แก้ไข</font></td>
				</tr>
</form>

<?php
$sql="select * from bookregister_certificate left join person_main on bookregister_certificate.officer=person_main.person_id order by year,register_number limit $start,$pagelen "; 
$dbquery = mysql_query($sql);

$sql_sign = "select  * from bookregister_cer_sign order by id";
$dbquery_sign = mysql_query($sql_sign );
While ($result_sign = mysql_fetch_array($dbquery_sign))
   {
		$code = $result_sign['code'];
		$name = $result_sign['name'];
		$sign_person_ar[$code]=$name;
	}
	$sign_person_ar[""]="";

$N=(($page-1)*$pagelen)+1; //*เกี่ยวข้องกับการแยกหน้า
$M=1;

While ($result = mysql_fetch_array($dbquery)){
		$id = $result['ms_id'];
		$register_number = $result['register_number'];
		$year = $result['year'];
		$book_no = $result['book_no'];
		$signdate = $result['signdate'];
		$subject = $result['subject'];
		$subject2 = $result['subject2'];
		$comment = $result['comment'];
		$register_date = $result['register_date'];
		$sign_person=$result['sign_person'];
		$khet_print=$result['khet_print'];
			if(($M%2) == 0)
			$color="#ffffff";
			else $color="#FFFFC";
$signdate=thai_date_3($signdate);
$register_date=thai_date_3($register_date);

?>
			<tr bgcolor="<?php echo $color;?>">
					<td align="center"><?php echo $register_number;?></td>
					<td align="center"><?php echo $year;?></td>
					<td align="left">&nbsp;<?php echo $book_no;?></td>
					<td align="left">&nbsp;<?php echo $result['name_cer'];?></td>
					<td align="center"><?php echo $subject;?><br /><?php echo $subject2;?></td>
					<td align="center">&nbsp;<?php echo $signdate;?></td>
					<td align="left">&nbsp;<?php echo $sign_person_ar[$sign_person];?></td>
					<td align="center"><?php echo $khet_print;?></td>
					<td align="left"><?php echo $comment;?></td>
					<td align='left'><?php echo $result['prename'].$result['name']." ".$result['surname'];?></td>
					<td align='center'><?php echo $register_date;?></td>
<?php			
					if($result['file_name']!=""){	
					echo "<td align='center'><A HREF='modules/bookregister/upload_files4/$result[file_name]' title='คลิกเพื่อเปิดไฟล์แนบ' target='_BLANK'>เอกสาร</A></td>";
					}
					else{
					echo "<td></td>";
					}
					
if($sign_person!="" and $khet_print>=1 and $result['quarantee']!=2){
echo "<form id='frm2' name='frm2' action='modules/bookregister/pdf/display.php' method='post' target='_blank'>";
echo "<input type='hidden' name='ms_id' value=$id>";
echo "<input type='hidden' name='cer_host' value=$hostname>";
echo "<input type='hidden' name='cer_user' value=$user2>";
echo "<input type='hidden' name='cer_pass' value=$password>";
echo "<input type='hidden' name='cer_db' value=$dbname>";
echo "<td><INPUT TYPE='submit' value='พิมพ์'></td>";
echo "</form>";
}
else{
echo "<td></td>";
}
					
//ตั้งค่าเวลาให้ลบได้					
$now=time();
$timestamp_recdate=make_time_2($result['register_date']);
$timestamp_recdate_2=$timestamp_recdate+(86400*30);  //เพิ่มเวลา 30 วัน
if($now<=$timestamp_recdate_2){
$delete=1;		//yes			
}
else {
$delete=2;    //no
}					

if($result['quarantee']==1){
echo "<td align='center'><img src=images/yes.png border='0' alt='รับรอง'></td>";
}
else if($result['quarantee']==2){
echo "<td align='center'><img src=images/no.png border='0' alt='ไม่รับรอง'></td>";
}
else{
echo "<td align='center'><input type='checkbox' name='$id' id='$id' value='1'></td>";
}

if($delete==1){
echo "<Td align='center'><a href=?option=bookregister&task=main/certificate_officer&index=5&id=$id&page=$_REQUEST[page]><img src=images/edit.png border='0' alt='แก้ไข'></a></Td>";
}
else{
echo "<td></td>";
}
echo "</tr>";

	$M++;
	$N++;  //*เกี่ยวข้องกับการแยกหน้า
	}  // end while	
	
echo "<tr><td colspan='15'><b>การพิมพ์</b> 0=ไม่พิมพ์ 1=พิมพ์</td></tr>";	
echo "</table>";
echo "</form>";
}  //end index

?>
<script>
function goto_url(val){
	if(val==0){
		callfrm("?option=bookregister&task=main/certificate_officer");   // page ย้อนกลับ 
	}else if(val==1){
		callfrm("?option=bookregister&task=main/certificate_officer&index=4");   //page ประมวลผล
	}
}

function goto_url2(val){
	if(val==0){
		callfrm("?option=bookregister&task=main/certificate_officer"); 
	}else if(val==1){
		callfrm("?option=bookregister&task=main/certificate_officer&index=6");   //page ประมวลผล
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
