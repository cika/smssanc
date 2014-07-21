<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );

if(!(($result_permission['p1']==1) or ($_SESSION['admin_work']=='work'))) {
exit();
}

require_once "modules/work/time_inc.php";	

$officer=$_SESSION['login_user_id'];
$today_date = date("Y-m-d");

//ส่วนหัว
echo "<br />";
echo "<table width='99%' border='0' align='center'>";

$today=date("Y-m-d");
echo "<tr align='center'>
	<td align=center><font color='#990000' size='3'><strong>บันทึกข้อมูลการปฏิบัติราชการ</strong></font>
<font color='#006666' size='3'><strong>".thai_date($today)."</strong></font>
</td></tr>";

echo "</table>";
echo "<br />";

$sql = "select * from  person_position order by position_code";
$dbquery = mysql_query($sql);
While ($result = mysql_fetch_array($dbquery)){
$position_ar[$result['position_code']]=$result['position_name'];
}

//ส่วนบันทึกข้อมูล
if($index==4){

	//echo 	print_r($_POST);	


$rec_date=date("Y-m-d H:i:s");
	$sql = "select * from person_main where status='0' order by position_code,person_order";
	$dbquery = mysql_query($sql);
	While ($result = mysql_fetch_array($dbquery))
	{
	$person_id = $result['person_id'];
	
			$sql_select = "select * from  work_main  where work_date='$today_date' and person_id='$person_id'";
			$dbquery_select = mysql_query($sql_select);
			$data_num=mysql_num_rows($dbquery_select);
		
if(!isset($_POST[$person_id])){
$_POST[$person_id]="";
}

$delete="delete_chk".$person_id;
if(!isset($_POST[$delete])){
$_POST[$delete]="";
}		

			if(($_POST[$person_id]>0) and ($_POST[$delete]!=1)){
					if($data_num>0){
					
					$sql_update = "update work_main set work='$_POST[$person_id]', rec_date='$rec_date', officer='$officer' where work_date='$today_date' and person_id='$person_id'";
					$dbquery_update = mysql_query($sql_update);
					}
					else {
					$sql_insert = "insert into work_main (work_date, person_id, work, rec_date, officer) values ('$today_date', '$person_id', '$_POST[$person_id]', '$rec_date', '$officer')";
					$dbquery_insert = mysql_query($sql_insert);
					}
			}	
			if(($_POST[$person_id]>0) and ($_POST[$delete]==1)){
			$sql_delete = "delete from work_main where work_date='$today_date' and person_id='$person_id'";
			$dbquery_delete = mysql_query($sql_delete);
			}
	}	
}

//ส่วนแสดงหลัก

$sql_person = "select * from person_main where status='0'"; 
$dbquery_person=mysql_query($sql_person);
While ($result_person = mysql_fetch_array($dbquery_person)){
$person_id = $result_person['person_id'];
		$sql_work = "select * from  work_main  where work_date='$today_date' and person_id='$person_id' ";
		$dbquery_work = mysql_query($sql_work);
		$result_work = mysql_fetch_array($dbquery_work);
$work_ar[$person_id]=$result_work['work'];		
}

echo "<form id='frm1' name='frm1'>";
$sql = "select * from person_main where status='0' order by position_code,person_order";
$dbquery = mysql_query($sql);
echo  "<table width='98%' border='0' align='center'>";
echo "<Tr bgcolor='#FFCCCC' align='center'><Td width='50'>ที่</Td>";
echo "<Td>ลบ</Td>";
echo "<Td>ชื่อ</Td><Td>ตำแหน่ง</Td><Td>มา</Td><Td>ไปราชการ</Td><Td>ลาป่วย</Td><Td>ลากิจ</Td><Td>ลาพักผ่อน</Td><Td>ลาคลอด</Td><Td>ลาอื่นๆ</Td><Td>มาสาย</Td><Td>ไม่มา</Td><Td></Td></Tr>";
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
			if(($M%2) == 0){
			$color="#FFFFC";
			$color2="#FFFFC";
			}
			else {
			$color="#FFFFFF";
			$color2="#FFFFFF";
			}
			
//check การลา
	$sql_la="select * from la_main where (la_start<='$today_date' and '$today_date'<=la_finish) and person_id='$person_id' ";
	$dbquery_la = mysql_query($sql_la);
		if($dbquery_la){
		$la_num=mysql_num_rows($dbquery_la);	
				if($la_num>=1){
						$result_la = mysql_fetch_array($dbquery_la);
						if($result_la['la_type']==1){
						$color="#FF3366";
						} 
						else if($result_la['la_type']==2){
						$color="#FFFF00";
						}
						else if($result_la['la_type']==3){
						$color="#FF00FF";
						}
						else if($result_la['la_type']==4){
						$color="#0099FF";
						}
				$sql_cancel="select * from la_cancel where (cancel_la_start<='$today_date' and '$today_date'<=cancel_la_finish) and person_id='$person_id' ";
				$dbquery_cancel = mysql_query($sql_cancel);
						if($dbquery_cancel){
						$la_num_cancel=mysql_num_rows($dbquery_cancel);	
								if($la_num_cancel>=1){
								$color=$color2;
								}
						}
						
				}
		}
			
//check การไปราชการ
	$sql_date="select * from permission_date where person_id='$person_id' and date='$today_date' ";
	$dbquery_date = mysql_query($sql_date);
		if($dbquery_date){
		$date_num=mysql_num_rows($dbquery_date);	
				if($date_num>=1){
				$color="#00FFFF";
				}
		}
		
echo "<Tr  bgcolor=$color align=center class=style1><Td>$N</Td>";
echo "<Td><input type='checkbox' name='delete_chk$person_id' value='1'>";
echo "</Td><Td align='left'>$prename&nbsp;$name&nbsp;&nbsp;$surname</Td><Td align='left'>";
if(isset($position_ar[$position_code])){
echo $position_ar[$position_code];
}
echo "</Td>";

$check_index1="";	
$check_index2="";	
$check_index3="";	
$check_index4="";	
$check_index5="";	
$check_index6="";	
$check_index7="";	
$check_index8="";	
$check_index9="";	

if(!isset($_GET['index'])){
$_GET['index']="";
}

if($_GET['index']==2){
$check_index1="checked";
}

if($work_ar[$person_id]==1){
$check_index1="checked";
}
else if($work_ar[$person_id]==2){
$check_index2="checked";
}
else if($work_ar[$person_id]==3){
$check_index3="checked";
}
else if($work_ar[$person_id]==4){
$check_index4="checked";
}
else if($work_ar[$person_id]==5){
$check_index5="checked";
}
else if($work_ar[$person_id]==6){
$check_index6="checked";
}
else if($work_ar[$person_id]==7){
$check_index7="checked";
}
else if($work_ar[$person_id]==8){
$check_index8="checked";
}
else if($work_ar[$person_id]==9){
$check_index9="checked";
}

echo "<Td><input type='radio' name='$person_id' id='$person_id' value='1' $check_index1>มา</Td>";
echo "<Td><input type='radio' name='$person_id' id='$person_id' value='2' $check_index2>ไปราชการ</Td>";
echo "<Td><input type='radio' name='$person_id' id='$person_id' value='3' $check_index3>ป</Td>";
echo "<Td><input type='radio' name='$person_id' id='$person_id' value='4' $check_index4>ก</Td>";
echo "<Td><input type='radio' name='$person_id' id='$person_id' value='5' $check_index5>พ</Td>";
echo "<Td><input type='radio' name='$person_id' id='$person_id' value='6' $check_index6>ค</Td>";
echo "<Td><input type='radio' name='$person_id' id='$person_id' value='7' $check_index7>อ</Td>";
echo "<Td><input type='radio' name='$person_id' id='$person_id' value='8' $check_index8>มาสาย</Td>";
echo "<Td><input type='radio' name='$person_id' id='$person_id' value='9' $check_index9>ไม่มา</Td>";

if($work_ar[$person_id]<1){
echo "<Td align='center'><img src=images/dangerous.png border='0' alt='ไม่มีข้อมูล'></Td>";
}
else{
echo "<Td align='center'>&nbsp;</td>";
}
echo "";
$M++;
$N++;
	}
	
$sql = "select * from work_main where work_date='$today_date'";
$dbquery = mysql_query($sql);
$record_num=mysql_num_rows($dbquery);
if(($record_num<=0) and ($index!=2)){
echo "<Tr bgcolor='#FFCCCC'>";
echo "<Td colspan='14' align='center'><input type='checkbox' name='allchk' id='allchk' onclick='CheckAll()'>เลือก/ไม่เลือก มาปฏิบัติราชการทั้งหมด</Td>";
}
echo "</Tr>";
echo "</Table>";
echo "<br>";
echo "<div align='center'><INPUT TYPE='button' name='smb' value='บันทึก' onclick='goto_url(1)' class=entrybutton></div>";
echo "</form>";
?>

<script>
function goto_url(val){
	if(val==0){
		callfrm("?option=work&task=check");   // page ย้อนกลับ 
	}else if(val==1){
	callfrm("?option=work&task=check&index=4");   //page ประมวลผล
	}
}

function CheckAll() {
	for (var i = 0; i < document.frm1.elements.length; i++)
	{
	var e = document.frm1.elements[i];
	if (e.name != "allchk")
		if(e.value==1 && e.type!="checkbox"){
		e.checked = document.frm1.allchk.checked;
		}
	}
}

</script>

<?php
echo "<b>&nbsp;&nbsp;หมายเหตุ</b><br>";
echo "&nbsp;&nbsp;&nbsp;&nbsp;1.<img src=images/dangerous.png border='0'> หมายถึง ยังไม่มีข้อมูล<br>";
echo "&nbsp;&nbsp;&nbsp;&nbsp;2.พื้นแถว<font color='#00FFFF'>สีเขียว</font> หมายถึง ขออนุญาตไปราชการ<br>";
echo "&nbsp;&nbsp;&nbsp;&nbsp;3.พื้นแถว<font color='#FF3366'>สีแดง</font> หมายถึง ลาป่วย<br>";
echo "&nbsp;&nbsp;&nbsp;&nbsp;4.พื้นแถว<font color='#FFFF00'>สีเหลือง</font> หมายถึง ลากิจ<br>";
echo "&nbsp;&nbsp;&nbsp;&nbsp;5.พื้นแถว<font color='#0099FF'>สีฟ้า</font> หมายถึง ลาพักผ่อน<br>";
echo "&nbsp;&nbsp;&nbsp;&nbsp;6.พื้นแถว<font color='#FF00FF'>สีชมพู</font> หมายถึง ลาคลอด<br>";

?>
