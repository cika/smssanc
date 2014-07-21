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
if(!(($index==1) or ($index==5) or ($index==7))){

echo "<table width='100%' border='0' align='center'>";
echo "<tr align='center'><td><font color='#006666' size='3'><strong>รับมอบงาน</strong></font></td></tr>";
echo "</table>";
echo "<br />";
}

//อาเรย์ตำแหน่ง
$sql = "select * from  person_position order by position_code";
$dbquery = mysql_query($sql);
While ($result = mysql_fetch_array($dbquery)){
$position_ar[$result['position_code']]=$result['position_name'];
}

//ส่วนฟอร์มแก้ไขข้อมูล
if ($index==5){
echo "<form Enctype = multipart/form-data id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>รับมอบงาน</B></Font>";
echo "</Cener>";
echo "<Br><Br>";
echo "<Table width='95%' Border='0'>";

$sql = "select * from la_main left join person_main on la_main.person_id=person_main.person_id where la_main.id='$_GET[id]'";
$dbquery = mysql_query($sql);
$ref_result = mysql_fetch_array($dbquery);
$id=$ref_result['id'];
$la_type=$ref_result['la_type'];
$grant_p_selected=$ref_result['grant_p_selected'];
$position=$ref_result['position_code'];
		if($la_type==4){
		echo "<Tr align='left'><Td align='right'>เขียนที่&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='write_at' Size='30' value='$ref_result[write_at]'></Td></Tr>";
		
		echo "<Tr align='left'><Td align='right'>เรื่อง&nbsp;&nbsp;</Td><Td>ลาพักผ่อน</Td></Tr>";
		
		echo "<Tr align='left'><Td align='right'>เรียน&nbsp;&nbsp;</Td><Td>ผู้อำนวยการ$_SESSION[school_name]</Td></Tr>";
		
		echo "<Tr align='left'><Td align='right'>ข้าพเจ้า&nbsp;&nbsp;</Td><Td>$ref_result[prename]$ref_result[name]&nbsp;&nbsp;$ref_result[surname]&nbsp;&nbsp;ตำแหน่ง&nbsp;&nbsp;$position_ar[$position]</Td></Tr>";
		
		echo "<Tr align='left'><Td align='right'>&nbsp;</Td>";
		
		echo "<Td>มีวันลาพักผ่อนสะสม&nbsp;&nbsp;<Input Type='Text' Name='relax_collect' Size='5' value='$ref_result[relax_collect]'>&nbsp;&nbsp;วันทำการ และประจำปีอีก 10 วันทำการ รวมเป็น&nbsp;&nbsp;<Input Type='Text' Name='relax_this_year' Size='5' value='$ref_result[relax_this_year]'>&nbsp;&nbsp;วันทำการ";
		
		echo "<Tr align='left'><Td align='right'>ขอลาตั้งแต่วันที่&nbsp;&nbsp;</Td>";
		echo "<Td align='left'>";
		$la_start=explode("-", $ref_result['la_start']);
		?>
		<script>
										var Y_date=<?php echo $la_start[0]?>  
										var m_date=<?php echo $la_start[1]?>  
										var d_date=<?php echo $la_start[2]?>  
										Y_date= Y_date+'/'+m_date+'/'+d_date
										DateInput('la_start', true, 'YYYY-MM-DD', Y_date)</script> 
		<?php
		echo "</Td></Tr>";
		
		echo "<Tr align='left'><Td align='right'>ถึงวันที่&nbsp;&nbsp;</Td>";
		echo "<Td align='left'>";
		$la_finish=explode("-", $ref_result['la_finish']);
		?>
		<script>
										var Y_date=<?php echo $la_finish[0]?>  
										var m_date=<?php echo $la_finish[1]?>  
										var d_date=<?php echo $la_finish[2]?>  
										Y_date= Y_date+'/'+m_date+'/'+d_date
										DateInput('la_finish', true, 'YYYY-MM-DD', Y_date)</script> 
		<?php
		echo "</Td></Tr>";
		
		echo "<Tr align='left'><Td align='right'>&nbsp;</Td>";
		echo "<Td>มีกำหนด&nbsp;&nbsp;<Input Type='Text' Name='la_total' id='la_total' Size='5' value='$ref_result[la_total]'>&nbsp;&nbsp;วัน";
		
		echo "<Tr align='left'><Td align='right'>ระหว่างลาติดต่อได้ที่&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='contact'  Size='60' value='$ref_result[contact]'>&nbsp;&nbsp;เบอร์โทรศัำพท์&nbsp;&nbsp;<Input Type='Text' Name='contact_tel' Size='10' value='$ref_result[contact_tel]'></Td></Tr>";
		
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
		echo "&nbsp;&nbsp;(ใช้กรณีผู้อนุมัติิปกติไม่อยู่  เช่น รองผอ.สพท. ซึ่งเป็นผู้อนุมัติกลุ่มนี้ไม่อยู่ เป็นต้น) </Td></Tr>";
		
		echo "<Tr align='left'><Td align='right'>&nbsp;</Td><Td>";
		
		echo "<table><tr><td>";
		echo "<fieldset>";
		echo "<legend>&nbsp;<B>สถิติการลาในปีงบประมาณนี้</B>: &nbsp;</legend>";
		echo "<table border='1'>";
		echo "<tr align='center'><td>ลามาแล้ว<br>(วันทำการ)</td><td>ลาครั้งนี้<br>(วันทำการ)</td><td>รวมเป็น<br>(วันทำการ)</td></tr>";
		
		echo "<tr align='center'><td><Input Type='Text' Name='relax_ago'  Size='5'  value='$ref_result[relax_ago]'></td><td><Input Type='Text' Name='relax_this' Size='5' value='$ref_result[relax_this]'></td><td><Input Type='Text' Name='relax_total' Size='5' value='$ref_result[relax_total]'></td></tr>";
		
		echo "</table>";
		echo "</fieldset></td></tr></table>";
		echo "</Td></tr>";
		echo "<Input Type=Hidden Name='la_type' Value='4'>";
		}
echo "</Table>";

echo "<table width='70%'><tr><td>";
echo "<fieldset>";
echo "<legend>&nbsp;<B>ส่วนของการรับมอบงาน</B>: &nbsp;</legend>";
echo "<table>";
echo "<Tr align='left'><Td align='right'>ผู้รับมอบ&nbsp;&nbsp;</Td><Td><Select  name='job_person'  size='1'>";
echo  "<option  value = ''>เลือก</option>" ;
$sql = "select * from person_main where status='0' and position_code>'1' order by position_code,person_order";
$dbquery = mysql_query($sql);
While ($result = mysql_fetch_array($dbquery))
   {
		$person_id = $result['person_id'];
		$name = $result['name'];
		$surname = $result['surname'];
		if($person_id==$ref_result['job_person']){
		echo  "<option value = $person_id selected>$name $surname</option>";
		}
		else{
		echo  "<option value = $person_id>$name $surname</option>";
		}
	}
echo "</select>";
echo "</Td></Tr>";
echo "</fieldset></td></tr></table>";

echo "<Input Type=Hidden Name='id' Value='$_GET[id]'>";
echo "<Input Type=Hidden Name='page' Value='$_GET[page]'>";
echo "<Br>";
echo "<INPUT TYPE='button' name='smb' value='ตกลงรับมอบงาน' onclick='goto_url_update(1)' class=entrybutton>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ย้อนกลับ' onclick='goto_url_update(0)' class=entrybutton'>";
echo "</form>";
}

//ส่วนปรับปรุงข้อมูล
if ($index==6){
$date_time_now = date("Y-m-d H:i:s");
		if($index==6){
		$sql = "update la_main set job_person_sign='1'
		where id='$_POST[id]'";
		$dbquery = mysql_query($sql);
		}
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
echo "<Font color='#006666' Size=3><B>รายละเอียดการขออนุญาตลา</B></Font>";
echo "</Cener>";
echo "<Br>";
echo "<Br>";
echo "<Table  align='center' width='80%' Border='0'>";
echo "<Tr ><Td colspan='2' align='right'><INPUT TYPE='button' name='smb' value='<<กลับหน้าก่อน' onclick='location.href=\"?option=la&task=main/job_person&page=$_GET[page]\"'></Td></Tr>";
$sql = "select * from la_main where id='$_GET[id]'";
$dbquery = mysql_query($sql);
$ref_result = mysql_fetch_array($dbquery);
$id=$ref_result['id'];
$la_type=$ref_result['la_type'];
$grant_p_selected=$ref_result['grant_p_selected'];
$rec_date=$ref_result['rec_date'];
		if($la_type<4){
		echo "<Tr align='left'><Td align='right'>วันเดือนปี&nbsp;&nbsp;</Td><Td>";
echo thai_date_4($rec_date);
echo "</Td></Tr>";
		echo "<Tr align='left'><Td align='right'>เขียนที่&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='write_at' Size='60' value='$ref_result[write_at]'></Td></Tr>";
		$check1=""; $check2=""; $check3="";
		if($ref_result['la_type']==1){
		$check1="checked";
		}
		else if($ref_result['la_type']==2){
		$check2="checked";
		}
		else if($ref_result['la_type']==3){
		$check3="checked";
		}
		echo "<Tr align='left'><Td align='right'>เรื่อง&nbsp;&nbsp;</Td><Td><Input Type='radio' Name='la_type' value='1' $check1>ลาป่วย&nbsp;&nbsp;<Input Type='radio' Name='la_type' value='2' $check2>ลากิจ&nbsp;&nbsp;<Input Type='radio' Name='la_type' value='3' $check3>ลาคลอด</Td></Tr>";
		
		echo "<Tr align='left'><Td align='right'>เรียน&nbsp;&nbsp;</Td><Td>ผู้อำนวยการ$_SESSION[school_name]</Td></Tr>";
		
		echo "<Tr align='left'><Td align='right'>ข้าพเจ้า&nbsp;&nbsp;</Td><Td>$_SESSION[login_prename]$_SESSION[login_name]&nbsp;&nbsp;$_SESSION[login_surname]&nbsp;&nbsp;ตำแหน่ง$_SESSION[login_userposition]</Td></Tr>";
		
		echo "<Tr align='left'><Td align='right'>เนื่องจาก&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='because' Size='60' value='$ref_result[because]'></Td></Tr>";
		
		echo "<Tr align='left'><Td align='right'>ขอลาตั้งแต่วันที่&nbsp;&nbsp;</Td>";
		
		echo "<Td align='left'>";
		$la_start=explode("-", $ref_result['la_start']);
		?>
		<script>
										var Y_date=<?php echo $la_start[0]?>  
										var m_date=<?php echo $la_start[1]?>  
										var d_date=<?php echo $la_start[2]?>  
										Y_date= Y_date+'/'+m_date+'/'+d_date
										DateInput('la_start', true, 'YYYY-MM-DD', Y_date)</script> 
		<?php
										
		echo "</Td></Tr>";
		
		echo "<Tr align='left'><Td align='right'>ถึงวันที่&nbsp;&nbsp;</Td>";
		
		echo "<Td align='left'>";
		$la_finish=explode("-", $ref_result['la_finish']);
		?>
		<script>
										var Y_date=<?php echo $la_finish[0]?>  
										var m_date=<?php echo $la_finish[1]?>  
										var d_date=<?php echo $la_finish[2]?>  
										Y_date= Y_date+'/'+m_date+'/'+d_date
										DateInput('la_finish', true, 'YYYY-MM-DD', Y_date)</script> 
		<?php
		echo "</Td></Tr>";
		
		echo "<Tr align='left'><Td align='right'>&nbsp;</Td>";
		
		echo "<Td>มีกำหนด&nbsp;&nbsp;<Input Type='Text' Name='la_total' Size='5' value='$ref_result[la_total]'>&nbsp;&nbsp;วัน";
		
		echo "<Tr align='left'><Td align='right'>ลาครั้งสุดท้ายตั้งแต่วันที่&nbsp;&nbsp;</Td>";
		echo "<Td align='left'>";
		$last_la_start=explode("-", $ref_result['last_la_start']);
		?>
		<script>
										var Y_date=<?php echo $last_la_start[0]?>  
										var m_date=<?php echo $last_la_start[1]?>  
										var d_date=<?php echo $last_la_start[2]?>  
										Y_date= Y_date+'/'+m_date+'/'+d_date
										DateInput('last_la_start', true, 'YYYY-MM-DD', Y_date)</script> 
		<?php
		echo "</Td></Tr>";
		
		echo "<Tr align='left'><Td align='right'>ถึงวันที่&nbsp;&nbsp;</Td>";
		echo "<Td align='left'>";
		$last_la_finish=explode("-", $ref_result['last_la_finish']);
		?>
		<script>
										var Y_date=<?php echo $last_la_finish[0]?>  
										var m_date=<?php echo $last_la_finish[1]?>  
										var d_date=<?php echo $last_la_finish[2]?>  
										Y_date= Y_date+'/'+m_date+'/'+d_date
										DateInput('last_la_finish', true, 'YYYY-MM-DD', Y_date)</script> 
		<?php
		echo "<Tr align='left'><Td align='right'>&nbsp;</Td>";
		echo "<Td>มีกำหนด&nbsp;&nbsp;<Input Type='Text' Name='last_la_total' Size='5' value='$ref_result[last_la_total]'>&nbsp;&nbsp;วัน";
		
		
		echo "<Tr align='left'><Td align='right'>ระหว่างลาติดต่อได้ที่&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='contact' Size='60' value='$ref_result[contact]'>&nbsp;&nbsp;เบอร์โทรศัำพท์&nbsp;&nbsp;<Input Type='Text' Name='contact_tel'  Size='10' value='$ref_result[contact_tel]'></Td></Tr>";
		
		echo  "<tr align='left'>";
		echo  "<td align='right'>เอกสาร(ถ้ามี)&nbsp;&nbsp;</td>";
		echo  "<td align='left'><input name = 'userfile' type = 'file'></td>";
		echo  "</tr>";
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
		echo "&nbsp;&nbsp;(ใช้กรณีผู้อนุมัติิปกติไม่อยู่  เช่น รองผอ.สพท. ซึ่งเป็นผู้อนุมัติกลุ่มนี้ไม่อยู่ เป็นต้น) </Td></Tr>";
		
		echo "<Tr align='left'><Td align='right'>&nbsp;</Td><Td>";
		
		echo "<table><tr><td>";
		echo "<fieldset>";
		echo "<legend>&nbsp;<B>สถิติการลาในปีงบประมาณนี้</B>: &nbsp;</legend>";
		echo "<table border='1'>";
		echo "<tr align='center'><td>ประเภทการลา</td><td>ลามาแล้ว<br>(วันทำการ)</td><td>ลาครั้งนี้<br>(วันทำการ)</td><td>รวมเป็น<br>(วันทำการ)</td></tr>";
		
		echo "<tr align='center'><td>ป่วย</td><td><Input Type='Text' Name='sick_ago' Size='5'  value='$ref_result[sick_ago]'></td><td><Input Type='Text' Name='sick_this' Size='5'  value='$ref_result[sick_this]'></td><td><Input Type='Text' Name='sick_total' Size='5' value='$ref_result[sick_total]'></td></tr>";
		
		echo "<tr align='center'><td>กิจส่วนตัว</td><td><Input Type='Text' Name='privacy_ago' Size='5' value='$ref_result[privacy_ago]'></td><td><Input Type='Text' Name='privacy_this' Size='5' value='$ref_result[privacy_this]'></td><td><Input Type='Text' Name='privacy_total' Size='5' value='$ref_result[privacy_total]'></td></tr>";
		
		echo "<tr align='center'><td>คลอดบุตร</td><td><Input Type='Text' Name='birth_ago' Size='5' value='$ref_result[birth_ago]'></td><td><Input Type='Text' Name='birth_this' Size='5' value='$ref_result[birth_this]'></td><td><Input Type='Text' Name='birth_total' Size='5' value='$ref_result[birth_total]'></td></tr>";
		echo "</table>";
		echo "</fieldset></td></tr></table>";
		echo "</Td></tr>";
		}
		if($la_type==4){
		echo "<Tr align='left'><Td align='right'>วันเดือนปี&nbsp;&nbsp;</Td><Td>";
echo thai_date_4($rec_date);
echo "</Td></Tr>";
		echo "<Tr align='left'><Td align='right'>เขียนที่&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='write_at' Size='60' value='$ref_result[write_at]'></Td></Tr>";
		echo "<Tr align='left'><Td align='right'>เรื่อง&nbsp;&nbsp;</Td><Td>ลาพักผ่อน</Td></Tr>";
		
		echo "<Tr align='left'><Td align='right'>เรียน&nbsp;&nbsp;</Td><Td>ผู้อำนวยการ$_SESSION[school_name]</Td></Tr>";
		
		echo "<Tr align='left'><Td align='right'>ข้าพเจ้า&nbsp;&nbsp;</Td><Td>$_SESSION[login_prename]$_SESSION[login_name]&nbsp;&nbsp;$_SESSION[login_surname]&nbsp;&nbsp;ตำแหน่ง$_SESSION[login_userposition]</Td></Tr>";
		
		echo "<Tr align='left'><Td align='right'>&nbsp;</Td>";
		
		echo "<Td>มีวันลาพักผ่อนสะสม&nbsp;&nbsp;<Input Type='Text' Name='relax_collect' Size='5' value='$ref_result[relax_collect]'>&nbsp;&nbsp;วันทำการ และประจำปีอีก 10 วันทำการ รวมเป็น&nbsp;&nbsp;<Input Type='Text' Name='relax_this_year' Size='5' value='$ref_result[relax_this_year]'>&nbsp;&nbsp;วันทำการ";
		
		echo "<Tr align='left'><Td align='right'>ขอลาตั้งแต่วันที่&nbsp;&nbsp;</Td>";
		echo "<Td align='left'>";
		$la_start=explode("-", $ref_result['la_start']);
		?>
		<script>
										var Y_date=<?php echo $la_start[0]?>  
										var m_date=<?php echo $la_start[1]?>  
										var d_date=<?php echo $la_start[2]?>  
										Y_date= Y_date+'/'+m_date+'/'+d_date
										DateInput('la_start', true, 'YYYY-MM-DD', Y_date)</script> 
		<?php
		echo "</Td></Tr>";
		
		echo "<Tr align='left'><Td align='right'>ถึงวันที่&nbsp;&nbsp;</Td>";
		echo "<Td align='left'>";
		$la_finish=explode("-", $ref_result['la_finish']);
		?>
		<script>
										var Y_date=<?php echo $la_finish[0]?>  
										var m_date=<?php echo $la_finish[1]?>  
										var d_date=<?php echo $la_finish[2]?>  
										Y_date= Y_date+'/'+m_date+'/'+d_date
										DateInput('la_finish', true, 'YYYY-MM-DD', Y_date)</script> 
		<?php
		echo "</Td></Tr>";
		
		echo "<Tr align='left'><Td align='right'>&nbsp;</Td>";
		echo "<Td>มีกำหนด&nbsp;&nbsp;<Input Type='Text' Name='la_total' id='la_total' Size='5' value='$ref_result[la_total]'>&nbsp;&nbsp;วัน";
		
		echo "<Tr align='left'><Td align='right'>ระหว่างลาติดต่อได้ที่&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='contact'  Size='60' value='$ref_result[contact]'>&nbsp;&nbsp;เบอร์โทรศัำพท์&nbsp;&nbsp;<Input Type='Text' Name='contact_tel' Size='10' value='$ref_result[contact_tel]'></Td></Tr>";
		
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
		echo "&nbsp;&nbsp;(ใช้กรณีผู้อนุมัติิปกติไม่อยู่  เช่น รองผอ.สพท. ซึ่งเป็นผู้อนุมัติกลุ่มนี้ไม่อยู่ เป็นต้น) </Td></Tr>";
		
		echo "<Tr align='left'><Td align='right'>&nbsp;</Td><Td>";
		
		echo "<table><tr><td>";
		echo "<fieldset>";
		echo "<legend>&nbsp;<B>สถิติการลาในปีงบประมาณนี้</B>: &nbsp;</legend>";
		echo "<table border='1'>";
		echo "<tr align='center'><td>ลามาแล้ว<br>(วันทำการ)</td><td>ลาครั้งนี้<br>(วันทำการ)</td><td>รวมเป็น<br>(วันทำการ)</td></tr>";
		
		echo "<tr align='center'><td><Input Type='Text' Name='relax_ago'  Size='5'  value='$ref_result[relax_ago]'></td><td><Input Type='Text' Name='relax_this' Size='5' value='$ref_result[relax_this]'></td><td><Input Type='Text' Name='relax_total' Size='5' value='$ref_result[relax_total]'></td></tr>";
		
		echo "</table>";
		echo "</fieldset></td></tr></table>";
		echo "</Td></tr>";
		}
echo "</table>";

echo "<table width='70%'><tr><td>";
echo "<fieldset>";
echo "<legend>&nbsp;<B>ส่วนการรับมอบงาน</B>: &nbsp;</legend>";
echo "<table>";
echo "<Tr align='left'><Td align='right'>ผู้รับมอบ&nbsp;&nbsp;</Td><Td><Select  name='job_person'  size='1'>";
echo  "<option  value = ''>เลือก</option>" ;
$sql = "select * from person_main where status='0' and position_code>'1' order by  position_code,person_order";
$dbquery = mysql_query($sql);
While ($result = mysql_fetch_array($dbquery))
   {
		$person_id = $result['person_id'];
		$name = $result['name'];
		$surname = $result['surname'];
		if($person_id==$ref_result['job_person']){
		echo  "<option value = $person_id selected>$name $surname</option>";
		}
		else{
		echo  "<option value = $person_id>$name $surname</option>";
		}
	}
echo "</select>";
echo "</Td>";

if($ref_result['job_person_sign']==1){
echo "<td><input type='checkbox' checked>รับมอบงาน</td>";
}
else{
echo "<td><input type='checkbox'>รับมอบงาน</td>";
}
echo "</Tr>";
echo "</table>";
echo "</fieldset></td></tr></table>";


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
if(!(($index==1) or ($index==5) or ($index==7))){

//ส่วนของการแยกหน้า
$sql = "select la_main.id, la_main.person_id, la_main.rec_date, la_main.la_type, la_main.la_start, la_main.la_finish, la_main.la_total, la_main.job_person, la_main.group_sign, la_main.commander_sign from la_main left join la_person_set on la_main.person_id=la_person_set.person_id where la_main.job_person ='$_SESSION[login_user_id]' order by la_main.id";
$dbquery = mysql_query($sql);
$num_rows = mysql_num_rows($dbquery );

$pagelen=20;  // 1_กำหนดแถวต่อหน้า
$url_link="option=la&task=main/job_person";  // 2_กำหนดลิงค์ฺ
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

$sql = "select la_main.id, la_main.person_id,la_main.document, la_main.rec_date, la_main.la_type, la_main.la_start, la_main.la_finish, la_main.la_total, la_main.job_person, la_main.job_person_sign, la_main.group_sign, la_main.commander_sign from la_main left join la_person_set on la_main.person_id=la_person_set.person_id where la_main.job_person ='$_SESSION[login_user_id]' order by la_main.id limit $start,$pagelen";

$dbquery = mysql_query($sql);

echo  "<table width='98%' border='0' align='center'>";

echo "<Tr bgcolor='#FFCCCC' align='center'><Td width='60'>เลขที่</Td><Td width='120'>ผู้ขออนุญาต</Td><Td width='100'>วันขออนุญาต</Td><Td>ประเภทการลา</Td><Td>ตั้งแต่วันที่</Td><Td>ถึงวันที่</Td><Td>มีกำหนด</Td><Td width='50'>รายละเอียด</Td><Td>สถานะ<br>รับมอบงาน</Td><Td width='40'>ลงนาม</Td></Tr>";

$N=(($page-1)*$pagelen)+1; //*เกี่ยวข้องกับการแยกหน้า
$M=1;

While ($result = mysql_fetch_array($dbquery)){
		$id = $result['id'];
		$person_id = $result['person_id'];		
		$file = $result['document'];
		$rec_date = $result['rec_date'];
			if(($M%2) == 0)
			$color="#FFFFB";
			else  	$color="#FFFFFF";
			
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
		$la_start = $result['la_start'];
		$la_finish = $result['la_finish'];
		$la_total = $result['la_total'];
			

echo "<Tr bgcolor='$color'><Td valign='top' align='center'>$id</Td>";

$sql_person = "select * from  person_main where person_id='$person_id' ";
$dbquery_person = mysql_query($sql_person);
$result_person = mysql_fetch_array($dbquery_person);
$fullname=$result_person['prename'].$result_person['name']." ".$result_person['surname'];
echo "</Td><Td valign='top' align='left'>$fullname</Td>";
echo "<Td valign='top' align='left'>";
echo thai_date_3($rec_date);
echo "</Td><Td valign='top' align='left'>$la_type_name</Td>";
echo "<Td valign='top' align='left' >";
echo thai_date_3($la_start);
echo "</Td>";
echo "<Td valign='top' align='left' >";
echo thai_date_3($la_finish);
echo "</Td>";
echo "<Td valign='top' align='center' >$la_total&nbsp;วัน</Td>";

echo "<Td align='center'><a href=?option=la&task=main/job_person&index=7&id=$id&page=$page><img src=images/browse.png border='0' alt='รายละเอียด'></Td>";

if($result['job_person_sign']==1){
echo "<Td align='center'><img src=images/yes.png border='0'></td>";
}
else{
echo "<Td></td>";
}
if($result['group_sign']=="" and $result['commander_sign']=="" and $result['job_person_sign']==0 ){
echo "<Td valign='top' align='center'><a href=?option=la&task=main/job_person&index=5&id=$id&page=$page><img src=images/edit.png border='0' alt='บันทึก'></a></Td>";
}
else{
echo "<Td></td>";
}
echo "</Tr>";

$M++;
$N++;  //*เกี่ยวข้องกับการแยกหน้า
}	
echo "</Table>";
}

?>
<script>

function goto_url_update(val){
	if(val==0){
		callfrm("?option=la&task=main/job_person");   // page ย้อนกลับ 
	}else if(val==1){
			callfrm("?option=la&task=main/job_person&index=6");   //page ประมวลผล
	}
}

</script>
