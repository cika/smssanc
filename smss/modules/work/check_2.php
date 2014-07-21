<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
if(!(($result_permission['p1']==1) or ($_SESSION['admin_work']=='work'))) {
exit();
}

require_once "modules/work/time_inc.php";	

$officer=$_SESSION['login_user_id'];

if(isset($_POST['send_date'])){
		if($_POST['send_date']!=""){
		$_GET['datepicker']=$_POST['send_date'];
		}
}

//แปลงรูปแบบ date
if(isset($_GET['datepicker'])){
$f1_date=explode("-", $_GET['datepicker']);
$f2_date=$f1_date[2]."-".$f1_date[1]."-".$f1_date[0];  //ปี เดือน วัน
}
else{
$f2_date=date("Y-m-d");
}

//$thai_date=thai_date(make_time($f2_date));
$thai_date=thai_date($f2_date);


echo "<br />";
echo "<table width='99%' border='0' align='center'>";
echo "<tr align='center'><td colspan=2><font color='#006666' size='3'><strong>การปฏิบัติราชการ $thai_date</strong></font></td></tr>";
?>
	<link rel="stylesheet" type="text/css" media="all" href="./modules/work/css.css">
	<link rel="stylesheet" href="./jquery/themes/ui-lightness/jquery.ui.all.css">
	<script src="./jquery/jquery-1.5.1.js"></script>
	<script src="./jquery/ui/jquery.ui.core.js"></script>
	<script src="./jquery/ui/jquery.ui.widget.js"></script>
	<script src="./jquery/ui/jquery.ui.datepicker.js"></script>
	<script>
	$(function() {
		$( "#datepicker" ).datepicker({
			showButtonPanel: true,
			dateFormat: 'dd-mm-yy',
			changeMonth: true,
			changeYear: true,
			monthNamesShort: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'],
			dayNamesMin: ['อา','จ','อ','พ','พฤ','ศ','ส'],
			onSelect:function(dateText){  document.frmSearchDate.submit();}
		});
	});
	</script>
<tr align='center'>
	<td  align=left>
	</td>
	<td align=right  id=no_print>
<FORM name=frmSearchDate METHOD=GET>
<INPUT TYPE="hidden" name=option value="work">
<INPUT TYPE="hidden" name=task value="check_2">
เลือกวันที่ <input type="text" id="datepicker" name=datepicker value=<?php echo (isset($_GET['datepicker']))? $_GET['datepicker']:date("d-m-Y");?>  readonly Size=10>
</FORM>
	</td>
</tr>

<?php
echo "</table>";
$sql = "select * from  person_position order by position_code";
$dbquery = mysql_query($sql);
While ($result = mysql_fetch_array($dbquery)){
$position_ar[$result['position_code']]=$result['position_name'];
}

//ส่วนบันทึกข้อมูล
if($index==4){
$rec_date=date("Y-m-d H:i:s");
	$sql = "select * from person_main where status='0' order by position_code,person_order";
	$dbquery = mysql_query($sql);
	While ($result = mysql_fetch_array($dbquery))
	{
	$person_id = $result['person_id'];
			$sql_select = "select * from  work_main  where work_date='$f2_date' and person_id='$person_id'";
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
					$sql_update = "update work_main set work='$_POST[$person_id]', rec_date='$rec_date', officer='$officer' where work_date='$f2_date' and person_id='$person_id'";
					$dbquery_update = mysql_query($sql_update);
					}
					else {
					$sql_insert = "insert into work_main (work_date, person_id, work, rec_date, officer) values ('$f2_date', '$person_id', '$_POST[$person_id]', '$rec_date', '$officer')";
					$dbquery_insert = mysql_query($sql_insert);
					}
			}	
			if(($_POST[$person_id]>0) and ($_POST[$delete]==1)){
			$sql_delete = "delete from work_main where work_date='$f2_date' and person_id='$person_id'";
			$dbquery_delete = mysql_query($sql_delete);
			}
	}	
}

//ส่วนแสดงหลัก
$sql_person = "select * from person_main where status='0'"; 
$dbquery_person=mysql_query($sql_person);
While ($result_person = mysql_fetch_array($dbquery_person)){
$person_id = $result_person['person_id'];
		$sql_work = "select * from  work_main  where work_date='$f2_date' and person_id='$person_id' ";
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
			if(($M%2) == 0)
			$color="#FFFFC";
			else  	$color="#FFFFFF";
echo "<Tr  bgcolor=$color align=center class=style1><Td>$N</Td>";
echo "<Td><input type='checkbox' name='delete_chk$person_id' value='1'>";
echo "</Td><Td align='left'>$prename&nbsp;$name&nbsp;&nbsp;$surname</Td><Td align='left'>$position_ar[$position_code]</Td>";

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
echo "<Td align='center'><img src=images/dangerous.png border='0' alt='ไม่มีข้อมูล'</Td>";
}
else{
echo "<Td align='center'>&nbsp;</Td>";
}
echo "</Tr>";
$M++;
$N++;
	}
	
echo "</Table>";
echo "<br>";
if(isset($_GET['datepicker'])){
echo "<INPUT TYPE='hidden' name='send_date' value='$_GET[datepicker]'>";
}
else{
$today=date("d-m-Y");
echo "<INPUT TYPE='hidden' name='send_date' value='$today'>";
}
echo "<div align='center'><INPUT TYPE='button' name='smb' value='บันทึก' onclick='goto_url(1)' class=entrybutton></div>";
echo "</form>";
?>

<script>
function goto_url(val){
	if(val==0){
		callfrm("?option=work&task=check_2");   // page ย้อนกลับ 
	}else if(val==1){
	callfrm("?option=work&task=check_2&index=4");   //page ประมวลผล
	}
}
</script>
