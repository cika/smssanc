<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
require_once "modules/la/time_inc.php";	

?>
<script type="text/javascript" src="./css/js/calendarDateInput.js"></script> 
<?php

$user=$_SESSION['login_user_id'];
if(!isset($_POST['no_comment'])){
$_POST['no_comment']="";
}

//ส่วนหัว
echo "<br />";
if(!(($index==1) or ($index==2) or ($index==5) or ($index==7))){

$sql_name = "select * from person_main where person_id='$user'";
$dbquery_name = mysql_query($sql_name);
$result_name = mysql_fetch_array($dbquery_name);
		$person_id = $result_name['person_id'];
		$prename=$result_name['prename'];
		$name= $result_name['name'];
		$surname = $result_name['surname'];
		$position_code = $result_name['position_code'];
$full_name="$prename$name&nbsp;&nbsp;$surname";

echo "<table width='100%' border='0' align='center'>";
echo "<tr align='center'><td><font color='#006666' size='3'><strong>ทะเบียนการยกเลิกวันลา</strong></font></td></tr>";
echo "<tr align='center'><td><font color='#006666' size='2'><strong>$full_name</strong></font></td></tr>";
echo "</table>";
}

//ส่วนฟอร์มรับข้อมูล
if($index==1){
echo "<form Enctype = multipart/form-data id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>บันทึกขอยกเลิกวันลา</Font>";
echo "</Cener>";
echo "<Br><Br>";
echo "<Table width='90%'>";

echo "<Tr align='left'><Td align='right'>เขียนที่&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='write_at' Size='60'></Td></Tr>";

echo "<Tr align='left'><Td align='right'>เรื่อง&nbsp;&nbsp;</Td><Td>ขอยกเลิกวันลา  <Input Type='radio' Name='la_type' value='1'>ลาป่วย&nbsp;&nbsp;<Input Type='radio' Name='la_type' value='2'>ลากิจ&nbsp;&nbsp;<Input Type='radio' Name='la_type' value='3'>ลาคลอด&nbsp;&nbsp;<Input Type='radio' Name='la_type' value='4'>ลาพักผ่อน</Td></Tr>";

echo "<Tr align='left'><Td align='right'>เรียน&nbsp;&nbsp;</Td><Td>ผู้อำนวยการ$_SESSION[school_name]</Td></Tr>";

echo "<Tr align='left'><Td align='right'>ข้าพเจ้า&nbsp;&nbsp;</Td><Td>$_SESSION[login_prename]$_SESSION[login_name]&nbsp;&nbsp;$_SESSION[login_surname]&nbsp;&nbsp;ตำแหน่ง$_SESSION[login_userposition]</Td></Tr>";

echo "<Tr align='left'><Td align='right'>ได้รับอนุญาตลาตั้งแต่วันที่&nbsp;&nbsp;</Td>";

echo "<Td align='left'>";
?>
<script>
								var Y_date=<?php echo date("Y")?>  
								var m_date=<?php echo date("m")?>  
								var d_date=<?php echo date("d")?>  
								Y_date= Y_date+'/'+m_date+'/'+d_date
								DateInput('permission_start', true, 'YYYY-MM-DD', Y_date)</script> 
<?php
								
echo "</Td></Tr>";

echo "<Tr align='left'><Td align='right'>ถึงวันที่&nbsp;&nbsp;</Td>";

echo "<Td align='left'>";
?>
<script>
								var Y_date=<?php echo date("Y")?>  
								var m_date=<?php echo date("m")?>  
								var d_date=<?php echo date("d")?>  
								Y_date= Y_date+'/'+m_date+'/'+d_date
								DateInput('permission_finish', true, 'YYYY-MM-DD', Y_date)</script> 
<?php
echo "</Td></Tr>";

echo "<Tr align='left'><Td align='right'>&nbsp;</Td>";

echo "<Td>รวม&nbsp;&nbsp;<Input Type='Text' Name='permission_total' Size='5'>&nbsp;&nbsp;วัน นั้น";

echo "<Tr align='left'><Td align='right'>เนื่องด้วย&nbsp;&nbsp;</Td>";

echo "<Td><Input Type='Text' Name='because' Size='60'>";


echo "<Tr align='left'><Td align='right'>จึงขอยกเลิกวันลาตั้งแต่วันที่&nbsp;&nbsp;</Td>";
echo "<Td align='left'>";
?>
<script>
								var Y_date=<?php echo date("Y")?>  
								var m_date=<?php echo date("m")?>  
								var d_date=<?php echo date("d")?>  
								Y_date= Y_date+'/'+m_date+'/'+d_date
								DateInput('cancel_la_start', true, 'YYYY-MM-DD', Y_date)</script> 
<?php
echo "</Td></Tr>";

echo "<Tr align='left'><Td align='right'>ถึงวันที่&nbsp;&nbsp;</Td>";
echo "<Td align='left'>";
?>
<script>
								var Y_date=<?php echo date("Y")?>  
								var m_date=<?php echo date("m")?>  
								var d_date=<?php echo date("d")?>  
								Y_date= Y_date+'/'+m_date+'/'+d_date
								DateInput('cancel_la_finish', true, 'YYYY-MM-DD', Y_date)</script> 
<?php
echo "<Tr align='left'><Td align='right'>&nbsp;</Td>";
echo "<Td>จำนวน&nbsp;&nbsp;<Input Type='Text' Name='cancel_la_total' Size='5'>&nbsp;&nbsp;วัน";

echo "<Tr align='left'><Td align='right'>ไม่ต้องผ่านผู้บังคับบัญชาขั้นต้น&nbsp;&nbsp;</Td><Td><input type='checkbox'  name='no_comment' id='no_comment' value='1'>&nbsp;&nbsp;(เลือกกรณีผู้บังคับบัญชาขั้นต้นไม่ได้ปฏิบัติราชการ)</Td></Tr>";

echo "<Tr align='left'><Td align='right'>เลือกผู้อนุมัติ (ปกติไม่ต้องเลือก)&nbsp;&nbsp;</Td><Td><Select  name='grant_p_selected'  size='1'>";
echo  "<option  value = ''>เลือก</option>" ;
$sql = "select * from person_main where status='0' and (position_code='1' or position_code='2') order by position_code,person_order";
$dbquery = mysql_query($sql);
While ($result = mysql_fetch_array($dbquery))
   {
		$person_id = $result['person_id'];
		$name = $result['name'];
		$surname = $result['surname'];
		echo  "<option value = $person_id>$name $surname</option>";
	}
echo "</select>";
echo "&nbsp;&nbsp;(ใช้กรณีผู้อนุมัติิปกติไม่อยู่  เช่น รองผอ.สพท. ซึ่งเป็นผู้อนุมัติกลุ่มนี้ไม่อยู่ เป็นต้น) </Td></Tr>";

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
echo "<INPUT TYPE='button' name='smb' value='ยืนยัน' onclick='location.href=\"?option=la&task=main/la_cancel&index=3&id=$_GET[id]&page=$_REQUEST[page]\"'>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ยกเลิก' onclick='location.href=\"?option=la&task=main/la_cancel&page=$_REQUEST[page]\"'";
echo "</td></tr></table>";
}

//ส่วนลบข้อมูล
if($index==3){
$sql = "delete from la_cancel where id='$_GET[id]'";
$dbquery = mysql_query($sql);
}

//ส่วนบันทึกข้อมูล
if($index==4){

$rec_date = date("Y-m-d");
$date_time_now = date("Y-m-d H:i:s");
$rand_num=rand();
$time_mk=time();
$ref_id = $time_mk.$rand_num;

$sql = "insert into la_cancel (person_id, la_type, write_at, permission_start, permission_finish, permission_total, because, cancel_la_start, cancel_la_finish, cancel_la_total, no_comment, grant_p_selected, rec_date) 
values ('$user','$_POST[la_type]','$_POST[write_at]','$_POST[permission_start]','$_POST[permission_finish]','$_POST[permission_total]', '$_POST[because]','$_POST[cancel_la_start]','$_POST[cancel_la_finish]','$_POST[cancel_la_total]', '$_POST[no_comment]', '$_POST[grant_p_selected]','$date_time_now')";
$dbquery = mysql_query($sql);
}


//ส่วนฟอร์มแก้ไขข้อมูล
if ($index==5){
echo "<form Enctype = multipart/form-data id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>แก้ไขรายการ</B></Font>";
echo "</Cener>";
echo "<Br><Br>";
echo "<Table width='90%' Border='0'>";

$sql = "select * from la_cancel where id='$_GET[id]'";
$dbquery = mysql_query($sql);
$ref_result = mysql_fetch_array($dbquery);
$id=$ref_result['id'];
$la_type=$ref_result['la_type'];
$grant_p_selected=$ref_result['grant_p_selected'];
$rec_date=$ref_result['rec_date'];
		echo "<Tr align='left'><Td align='right'>เขียนที่&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='write_at' Size='60' value='$ref_result[write_at]'></Td></Tr>";
		$check1=""; $check2=""; $check3=""; $check4="";
		if($ref_result['la_type']==1){
		$check1="checked";
		}
		else if($ref_result['la_type']==2){
		$check2="checked";
		}
		else if($ref_result['la_type']==3){
		$check3="checked";
		}
		else if($ref_result['la_type']==4){
		$check4="checked";
		}
		echo "<Tr align='left'><Td align='right'>เรื่อง&nbsp;&nbsp;</Td><Td>ขอยกเลิกวันลา&nbsp;<Input Type='radio' Name='la_type' value='1' $check1>ลาป่วย&nbsp;&nbsp;<Input Type='radio' Name='la_type' value='2' $check2>ลากิจ&nbsp;&nbsp;<Input Type='radio' Name='la_type' value='3' $check3>ลาคลอด&nbsp;&nbsp;<Input Type='radio' Name='la_type' value='4' $check4>ลาพักผ่อน</Td></Tr>";
		
		echo "<Tr align='left'><Td align='right'>เรียน&nbsp;&nbsp;</Td><Td>ผู้อำนวยการ$_SESSION[school_name]</Td></Tr>";
		
		echo "<Tr align='left'><Td align='right'>ข้าพเจ้า&nbsp;&nbsp;</Td><Td>$_SESSION[login_prename]$_SESSION[login_name]&nbsp;&nbsp;$_SESSION[login_surname]&nbsp;&nbsp;ตำแหน่ง$_SESSION[login_userposition]</Td></Tr>";
		
		echo "<Tr align='left'><Td align='right'>ได้รับอนุญาตให้ลาตั้งแต่วันที่&nbsp;&nbsp;</Td>";
		
		echo "<Td align='left'>";
		$permission_start=explode("-", $ref_result['permission_start']);
		?>
		<script>
										var Y_date=<?php echo $permission_start[0]?>  
										var m_date=<?php echo $permission_start[1]?>  
										var d_date=<?php echo $permission_start[2]?>  
										Y_date= Y_date+'/'+m_date+'/'+d_date
										DateInput('permission_start', true, 'YYYY-MM-DD', Y_date)</script> 
		<?php
										
		echo "</Td></Tr>";
		
		echo "<Tr align='left'><Td align='right'>ถึงวันที่&nbsp;&nbsp;</Td>";
		
		echo "<Td align='left'>";
		$permission_finish=explode("-", $ref_result['permission_finish']);
		?>
		<script>
										var Y_date=<?php echo $permission_finish[0]?>  
										var m_date=<?php echo $permission_finish[1]?>  
										var d_date=<?php echo $permission_finish[2]?>  
										Y_date= Y_date+'/'+m_date+'/'+d_date
										DateInput('permission_finish', true, 'YYYY-MM-DD', Y_date)</script> 
		<?php
		echo "</Td></Tr>";
		
		echo "<Tr align='left'><Td align='right'>&nbsp;</Td>";
		
		echo "<Td>รวม&nbsp;&nbsp;<Input Type='Text' Name='permission_total' Size='5' value='$ref_result[permission_total]'>&nbsp;&nbsp;วัน";
		
echo "<Tr align='left'><Td align='right'>เนื่องด้วย&nbsp;&nbsp;</Td>";

echo "<Td><Input Type='Text' Name='because' Size='60' value='$ref_result[because]'>";
		
		echo "<Tr align='left'><Td align='right'>จึงขอยกเลิกวันลาแต่วันที่&nbsp;&nbsp;</Td>";
		echo "<Td align='left'>";
		$cancel_la_start=explode("-", $ref_result['cancel_la_start']);
		?>
		<script>
										var Y_date=<?php echo $cancel_la_start[0]?>  
										var m_date=<?php echo $cancel_la_start[1]?>  
										var d_date=<?php echo $cancel_la_start[2]?>  
										Y_date= Y_date+'/'+m_date+'/'+d_date
										DateInput('cancel_la_start', true, 'YYYY-MM-DD', Y_date)</script> 
		<?php
		echo "</Td></Tr>";
		
		echo "<Tr align='left'><Td align='right'>ถึงวันที่&nbsp;&nbsp;</Td>";
		echo "<Td align='left'>";
		$cancel_la_finish=explode("-", $ref_result['cancel_la_finish']);
		?>
		<script>
										var Y_date=<?php echo $cancel_la_finish[0]?>  
										var m_date=<?php echo $cancel_la_finish[1]?>  
										var d_date=<?php echo $cancel_la_finish[2]?>  
										Y_date= Y_date+'/'+m_date+'/'+d_date
										DateInput('cancel_la_finish', true, 'YYYY-MM-DD', Y_date)</script> 
		<?php
		echo "<Tr align='left'><Td align='right'>&nbsp;</Td>";
		echo "<Td>จำนวน&nbsp;&nbsp;<Input Type='Text' Name='cancel_la_total' Size='5' value='$ref_result[cancel_la_total]'>&nbsp;&nbsp;วัน";
		
if($ref_result['no_comment']==1){
$no_comment_select="checked";
}
else{
$no_comment_select="";
}
echo "<Tr align='left'><Td align='right'>ไม่ต้องผ่านผู้บังคับบัญชาขั้นต้น&nbsp;&nbsp;</Td><Td><input type='checkbox'  name='no_comment' id='no_comment' value='1' $no_comment_select>&nbsp;&nbsp;(เลือกกรณีผู้บังคับบัญชาขั้นต้นไม่ได้ปฏิบัติราชการ)</Td></Tr>";
		
		echo "<Tr align='left'><Td align='right'>เลือกผู้อนุมัติ (ปกติไม่ต้องเลือก)&nbsp;&nbsp;</Td><Td><Select  name='grant_p_selected'  size='1'>";
		echo  "<option  value = ''>เลือก</option>" ;
		$sql = "select * from person_main where status='0' and (position_code='1' or position_code='2') order by position_code,person_order";
		$dbquery = mysql_query($sql);
		While ($result = mysql_fetch_array($dbquery))
		   {
				$person_id = $result['person_id'];
				$name = $result['name'];
				$surname = $result['surname'];
				if($person_id==$ref_result['grant_p_selected']){
				echo  "<option value = $person_id selected>$name $surname</option>";
				}
				else{
				echo  "<option value = $person_id>$name $surname</option>";
				}
			}
		echo "</select>";
		echo "&nbsp;&nbsp;(ใช้กรณีผู้อนุมัติิปกติไม่อยู่) </Td></Tr>";
		
echo "</Table>";
echo "<Input Type=Hidden Name='id' Value='$_GET[id]'>";
echo "<Input Type=Hidden Name='page' Value='$_GET[page]'>";
echo "<Br>";
echo "<INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url_update(1)' class=entrybutton>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ย้อนกลับ' onclick='goto_url_update(0)' class=entrybutton'>";
echo "</form>";
}

//ส่วนปรับปรุงข้อมูล
if ($index==6){
		$sql = "update la_cancel set la_type='$_POST[la_type]', 
		write_at='$_POST[write_at]', 
		permission_start='$_POST[permission_start]', 
		permission_finish='$_POST[permission_finish]', 
		permission_total='$_POST[permission_total]', 
		cancel_la_start='$_POST[cancel_la_start]', 
		cancel_la_finish='$_POST[cancel_la_finish]', 
		cancel_la_total='$_POST[cancel_la_total]', 
		no_comment='$_POST[no_comment]',		
		grant_p_selected='$_POST[grant_p_selected]'
		where id='$_POST[id]'";
		$dbquery = mysql_query($sql);
}

if ($index==7){
$sql_name = "select * from person_main";
$dbquery_name = mysql_query($sql_name);
While ($result_name = mysql_fetch_array($dbquery_name)){
		$person_id = $result_name['person_id'];
		$prename=$result_name['prename'];
		$name= $result_name['name'];
		$surname = $result_name['surname'];
		$position_code = $result_name['position_code'];
$full_name_ar[$person_id]="$prename$name&nbsp;&nbsp;$surname";
}

echo "<Center>";
echo "<Font color='#006666' Size=3><B>รายละเอียดการขอยกเลิกการลา</B></Font>";
echo "</Cener>";
echo "<Br>";
echo "<Br>";
echo "<Table  align='center' width='80%' Border='0'>";
echo "<Tr ><Td colspan='2' align='right'><INPUT TYPE='button' name='smb' value='<<กลับหน้าก่อน' onclick='location.href=\"?option=la&task=main/la_cancel&page=$_GET[page]\"'></Td></Tr>";

$sql="select * from la_cancel where id='$_GET[id]'";
$dbquery = mysql_query($sql);
$result = mysql_fetch_array($dbquery);
$rec_date=$result['rec_date'];  //วดป วันขออนุญาต

$sql = "select * from la_cancel left join person_main on la_cancel.person_id=person_main.person_id where la_cancel.id='$_GET[id]'";
$dbquery = mysql_query($sql);
$ref_result = mysql_fetch_array($dbquery);
$id=$ref_result['id'];
$la_type=$ref_result['la_type'];
$grant_p_selected=$ref_result['grant_p_selected'];
//$rec_date=$ref_result[rec_date]; วดป ของข้อมูลบุคลากร
$position=$ref_result['position_code'];
		echo "<Tr align='left'><Td align='right'>วันเดือนปี&nbsp;&nbsp;</Td><Td>";
echo thai_date_4($rec_date);
echo "</Td></Tr>";
		echo "<Tr align='left'><Td align='right'>เขียนที่&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='write_at' Size='60' value='$ref_result[write_at]'></Td></Tr>";
		$check1=""; $check2=""; $check3=""; $check4="";
		if($ref_result['la_type']==1){
		$check1="checked";
		}
		else if($ref_result['la_type']==2){
		$check2="checked";
		}
		else if($ref_result['la_type']==3){
		$check3="checked";
		}
		else if($ref_result['la_type']==4){
		$check4="checked";
		}
		echo "<Tr align='left'><Td align='right'>เรื่อง&nbsp;&nbsp;</Td><Td>ขอยกเลิกวันลา<Input Type='radio' Name='la_type' value='1' $check1>ลาป่วย&nbsp;&nbsp;<Input Type='radio' Name='la_type' value='2' $check2>ลากิจ&nbsp;&nbsp;<Input Type='radio' Name='la_type' value='3' $check3>ลาคลอด&nbsp;&nbsp;<Input Type='radio' Name='la_type' value='4' $check4>ลาพักผ่อน</Td></Tr>";
		
		echo "<Tr align='left'><Td align='right'>เรียน&nbsp;&nbsp;</Td><Td>ผู้อำนวยการ$_SESSION[school_name]</Td></Tr>";
		
		echo "<Tr align='left'><Td align='right'>ข้าพเจ้า&nbsp;&nbsp;</Td><Td>$_SESSION[login_prename]$_SESSION[login_name]&nbsp;&nbsp;$_SESSION[login_surname]&nbsp;&nbsp;ตำแหน่ง$_SESSION[login_userposition]</Td></Tr>";
		
		echo "<Tr align='left'><Td align='right'>ได้รับอนุญาตให้ลาตั้งแต่วันที่&nbsp;&nbsp;</Td>";
		
		echo "<Td align='left'>";
		$permission_start=explode("-", $ref_result['permission_start']);
		?>
		<script>
										var Y_date=<?php echo $permission_start[0]?>  
										var m_date=<?php echo $permission_start[1]?>  
										var d_date=<?php echo $permission_start[2]?>  
										Y_date= Y_date+'/'+m_date+'/'+d_date
										DateInput('permission_start', true, 'YYYY-MM-DD', Y_date)</script> 
		<?php
										
		echo "</Td></Tr>";
		
		echo "<Tr align='left'><Td align='right'>ถึงวันที่&nbsp;&nbsp;</Td>";
		
		echo "<Td align='left'>";
		$permission_finish=explode("-", $ref_result['permission_finish']);
		?>
		<script>
										var Y_date=<?php echo $permission_finish[0]?>  
										var m_date=<?php echo $permission_finish[1]?>  
										var d_date=<?php echo $permission_finish[2]?>  
										Y_date= Y_date+'/'+m_date+'/'+d_date
										DateInput('permission_finish', true, 'YYYY-MM-DD', Y_date)</script> 
		<?php
		echo "</Td></Tr>";
		
		echo "<Tr align='left'><Td align='right'>&nbsp;</Td>";
		
		echo "<Td>รวม&nbsp;&nbsp;<Input Type='Text' Name='permission_total' Size='5' value='$ref_result[permission_total]'>&nbsp;&nbsp;วัน";
		
echo "<Tr align='left'><Td align='right'>เนื่องด้วย&nbsp;&nbsp;</Td>";

echo "<Td><Input Type='Text' Name='because' Size='60' value='$ref_result[because]'>";
		
		echo "<Tr align='left'><Td align='right'>จึงขอยกเลิกวันลาแต่วันที่&nbsp;&nbsp;</Td>";
		echo "<Td align='left'>";
		$cancel_la_start=explode("-", $ref_result['cancel_la_start']);
		?>
		<script>
										var Y_date=<?php echo $cancel_la_start[0]?>  
										var m_date=<?php echo $cancel_la_start[1]?>  
										var d_date=<?php echo $cancel_la_start[2]?>  
										Y_date= Y_date+'/'+m_date+'/'+d_date
										DateInput('cancel_la_start', true, 'YYYY-MM-DD', Y_date)</script> 
		<?php
		echo "</Td></Tr>";
		
		echo "<Tr align='left'><Td align='right'>ถึงวันที่&nbsp;&nbsp;</Td>";
		echo "<Td align='left'>";
		$cancel_la_finish=explode("-", $ref_result['cancel_la_finish']);
		?>
		<script>
										var Y_date=<?php echo $cancel_la_finish[0]?>  
										var m_date=<?php echo $cancel_la_finish[1]?>  
										var d_date=<?php echo $cancel_la_finish[2]?>  
										Y_date= Y_date+'/'+m_date+'/'+d_date
										DateInput('cancel_la_finish', true, 'YYYY-MM-DD', Y_date)</script> 
		<?php
		echo "<Tr align='left'><Td align='right'>&nbsp;</Td>";
		echo "<Td>จำนวน&nbsp;&nbsp;<Input Type='Text' Name='cancel_la_total' Size='5' value='$ref_result[cancel_la_total]'>&nbsp;&nbsp;วัน";
		
if($ref_result['no_comment']==1){
$no_comment_select="checked";
}
else{
$no_comment_select="";
}
		echo "<Tr align='left'><Td align='right'></Td><Td><input type='checkbox'  name='no_comment' id='no_comment' value='1' $no_comment_select>&nbsp;ไม่ต้องผ่านผู้บังคับบัญชาขั้นต้น</Td></Tr>";
		
		echo "<Tr align='left'><Td align='right'>เลือกผู้อนุมัติ (ปกติไม่ต้องเลือก)&nbsp;&nbsp;</Td><Td><Select  name='grant_p_selected'  size='1'>";
		echo  "<option  value = ''>เลือก</option>" ;
		$sql = "select * from person_main where status='0' and (position_code='1' or position_code='2') order by position_code,person_order";
		$dbquery = mysql_query($sql);
		While ($result = mysql_fetch_array($dbquery))
		   {
				$person_id = $result['person_id'];
				$name = $result['name'];
				$surname = $result['surname'];
				if($person_id==$ref_result['grant_p_selected']){
				echo  "<option value = $person_id selected>$name $surname</option>";
				}
				else{
				echo  "<option value = $person_id>$name $surname</option>";
				}
			}
		echo "</select>";
		echo "&nbsp;&nbsp;(ใช้กรณีผู้อนุมัติิปกติไม่อยู่) </Td></Tr>";
		
echo "</table>";

echo "<table width='70%'><tr><td>";
echo "<fieldset>";
echo "<legend>&nbsp;<B>ส่วนการตรวจสอบ</B>: &nbsp;</legend>";
echo "<table>";
echo "<Tr align='left'><Td align='right' width='180'>บันทึกการตรวจสอบ(ถ้ามี)&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='officer_comment' Size='60' value='$ref_result[officer_comment]'></Td></Tr>";
$officer_sign=$ref_result['officer_sign'];

if(!isset($full_name_ar[$officer_sign])){
$full_name_ar[$officer_sign]="";
}

echo "<Tr align='left'><Td align='right'>ลงชื่อ&nbsp;&nbsp;</Td><Td><Input Type='Text' Size='40' value='$full_name_ar[$officer_sign]'></Td></Tr>";
$officer_date= thai_date_4($ref_result['officer_date']);
echo "<Tr align='left'><Td align='right'>วดป&nbsp;&nbsp;</Td><Td><Input Type='Text' Size='30' value='$officer_date'></Td></Tr>";
echo "</table>";
echo "</fieldset></td></tr></table>";

echo "<table width='70%'><tr><td>";
echo "<fieldset>";
echo "<legend>&nbsp;<B>ส่วนความเห็นของผู้บังคับบัญชาขั้นต้น</B>: &nbsp;</legend>";
echo "<table>";
echo "<Tr align='left'><Td align='right' width='180'>บันทึกความเห็น(ถ้ามี)&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='group_comment' Size='60' value='$ref_result[group_comment]'></Td></Tr>";
$group_sign=$ref_result['group_sign'];

if(!isset($full_name_ar[$group_sign])){
$full_name_ar[$group_sign]="";
}

echo "<Tr align='left'><Td align='right'>ลงชื่อ&nbsp;&nbsp;</Td><Td><Input Type='Text' Size='40' value='$full_name_ar[$group_sign]'></Td></Tr>";
$group_date= thai_date_4($ref_result['group_date']);
echo "<Tr align='left'><Td align='right'>วดป&nbsp;&nbsp;</Td><Td><Input Type='Text' Size='30' value='$group_date'></Td></Tr>";
echo "</table>";
echo "</fieldset></td></tr></table>";

echo "<table width='70%'><tr><td>";
echo "<fieldset>";
echo "<legend>&nbsp;<B>ส่วนการอนุมัติ</B>: &nbsp;</legend>";
echo "<table>";
echo "<Tr align='left'><Td align='right' width='180'>คำสั่ง(ถ้ามี)&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='commander_comment' Size='60' value='$ref_result[commander_comment]'></Td></Tr>";
		$commander_grant_check1=""; $commander_grant_check2="";
		if($ref_result['commander_grant']==1){
		$commander_grant_check1="checked";
		}
		else if($ref_result['commander_grant']==2){
		$commander_grant_check2="checked";
		}
echo "<Tr align='left'><Td align='right'>อนุมัติ/ไม่อนุมัติ&nbsp;&nbsp;</Td><Td><Input Type='radio' Name='commander_grant' value='1' $commander_grant_check1>อนุมัติ&nbsp;&nbsp;<Input Type='radio' Name='commander_grant' value='2' $commander_grant_check2>ไม่อนุมัติ&nbsp;&nbsp;</Td></Tr>";
$commander_sign=$ref_result['commander_sign'];

if(!isset($full_name_ar[$commander_sign])){
$full_name_ar[$commander_sign]="";
}

echo "<Tr align='left'><Td align='right'>ลงชื่อ&nbsp;&nbsp;</Td><Td><Input Type='Text' Size='40' value='$full_name_ar[$commander_sign]'></Td></Tr>";
$grant_date= thai_date_4($ref_result['grant_date']);
echo "<Tr align='left'><Td align='right'>วดป&nbsp;&nbsp;</Td><Td><Input Type='Text' Size='30' value='$grant_date'></Td></Tr>";
echo "</table>";
echo "</fieldset></td></tr></table>";
}

//ส่วนแสดงผล
if(!(($index==1) or ($index==2) or ($index==5) or ($index==7))){

//ส่วนของการแยกหน้า
$sql="select id from la_cancel where person_id='$user'";
$dbquery = mysql_query($sql);
$num_rows = mysql_num_rows($dbquery);

$pagelen=20;  // 1_กำหนดแถวต่อหน้า
$url_link="option=la&task=main/la_cancel";  // 2_กำหนดลิงค์ฺ
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

$sql="select * from la_cancel where person_id='$user' order by id limit $start,$pagelen";
$dbquery = mysql_query($sql);

echo  "<table width=95% border=0 align=center>";
echo "<Tr><Td colspan='11' align='left'><INPUT TYPE='button' name='smb' value='ขอยกเลิกวันลา' onclick='location.href=\"?option=la&task=main/la_cancel&index=1\"'></Td></Tr>";

echo "<Tr bgcolor='#FFCCCC' align='center'><Td width='60'>เลขที่</Td><Td width='100'>วันขออนุญาต</Td><Td width='100'>ประเภทการลา</Td><Td>ตั้งแต่วันที่ี</Td><Td>ถึงวันที่</Td><Td width='80'>มีกำหนด</Td><Td>อนุมัติ/คำสั่ง</Td><Td width='60'>รายละเอียด</Td><Td width='40'>ลบ</Td><Td width='40'>แก้ไข</Td></Tr>";

$N=(($page-1)*$pagelen)+1; //*เกี่ยวข้องกับการแยกหน้า
$M=1;

While ($result = mysql_fetch_array($dbquery)){
		$id = $result['id'];
		$la_type = $result['la_type'];
			$la_type_name="";
			if($la_type==1){
			$la_type_name="ลาป่วย";
			}
			else if($la_type==2){
			$la_type_name="ลากิจ";
			}
			else if($la_type==3){
			$la_type_name="ลาคลอด";
			}
			else if($la_type==4){
			$la_type_name="ลาพักผ่อน";
			}
		$cancel_la_start = $result['cancel_la_start'];
		$cancel_la_finish = $result['cancel_la_finish'];
		$cancel_la_total = $result['cancel_la_total'];
		
		$officer_sign = $result['officer_sign'];		
		$group_sign = $result['group_sign'];	
		$grant = $result['commander_grant'];
		$commander_sign = $result['commander_sign'];
		$rec_date = $result['rec_date'];
			if(($M%2) == 0)
			$color="#FFFFB";
			else  	$color="#FFFFFF";
echo "<Tr bgcolor='$color'><Td valign='top' align='center'>$id</Td><Td valign='top' align='left'>";
echo thai_date_3($rec_date);
echo "</Td><Td valign='top' align='left'>$la_type_name</Td>";
echo "<Td valign='top' align='left' >";
echo thai_date_3($cancel_la_start);
echo "</Td>";
echo "<Td valign='top' align='left' >";
echo thai_date_3($cancel_la_finish);
echo "</Td>";
echo "<Td valign='top' align='center' >$cancel_la_total&nbsp;วัน</Td>";

echo "<Td valign='top' align='center'>";
if($grant==1){
echo "<img src=images/yes.png border='0'><br><font color='#339900'>$result[commander_comment]</font>";
}
else if($grant==2){
echo "<img src=images/no.png border='0'><br><font color='#990000'>$result[commander_comment]</font>";
}
else{
echo "รออนุมัติ";
}
echo "</Td>";
echo "<Td valign='top' align='center'><a href=?option=la&task=main/la_cancel&index=7&id=$id&page=$page><img src=images/browse.png border='0' alt='รายละเอียด'></Td>";
if(($officer_sign=="") and ($group_sign=="") and ($commander_sign=="")){
echo "<Td valign='top' align='center'><a href=?option=la&task=main/la_cancel&index=2&id=$id&page=$page><img src=images/drop.png border='0' alt='ลบ'></Td><Td valign='top'  align='center'><a href=?option=la&task=main/la_cancel&index=5&id=$id&page=$page><img src=images/edit.png border='0' alt='แก้ไข'></a></Td>";
}
else{
echo "<td></td><td></td>";
}
echo "</Tr>";

$M++;
$N++;  //*เกี่ยวข้องกับการแยกหน้า
}	
echo "</Table>";
}

?>
<script>
function goto_url(val){
	if(val==0){
		callfrm("?option=la&task=main/la_cancel");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.write_at.value == ""){
			alert("กรุณากรอกสถานที่เขียน");
		}else if(!(frm1.la_type[0].checked || frm1.la_type[1].checked || frm1.la_type[2].checked || frm1.la_type[3].checked)){
			alert("กรุณาเลือกประเภทการลา");
		}else if(frm1.because.value == ""){
			alert("กรุณาระบุเหตุผลการขอยกเลิกการลา");
		}else if(frm1.cancel_la_total.value == ""){
			alert("กรุณากรอกจำนวนวันที่ต้องการยกเลิกการลา");
		}else{
			callfrm("?option=la&task=main/la_cancel&index=4");   //page ประมวลผล
		}
	}
}

function goto_url_update(val){
	if(val==0){
		callfrm("?option=la&task=main/la_cancel");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.write_at.value == ""){
			alert("กรุณากรอกสถานที่เขียน");
		}else if(!(frm1.la_type[0].checked || frm1.la_type[1].checked || frm1.la_type[2].checked || frm1.la_type[3].checked)){
			alert("กรุณาเลือกประเภทการลา");
		}else if(frm1.because.value == ""){
			alert("กรุณาระบุเหตุผลการขอยกเลิกการลา");
		}else if(frm1.cancel_la_total.value == ""){
			alert("กรุณากรอกจำนวนวันที่ต้องการยกเลิกการลา");
		}else{
			callfrm("?option=la&task=main/la_cancel&index=6");   //page ประมวลผล
		}
	}
}

</script>
