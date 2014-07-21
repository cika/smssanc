<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
require_once "modules/la/time_inc.php";	

//แปลงรูปแบบ date
//แปลงรูปแบบ date
if(isset($_GET['datepicker'])){
$f1_date=explode("-", $_GET['datepicker']);
$f2_date=$f1_date[2]."-".$f1_date[1]."-".$f1_date[0];  //ปี เดือน วัน
}
else{
$f2_date=date("Y-m-d");
}

//กรณีกลับหน้าก่อน
if(isset($_GET['datepicker_2'])){
$f2_date=$_GET['datepicker_2'];
}

$thai_date=thai_date($f2_date);

//ส่วนหัว
echo "<br />";

echo "<table width='100%' border='0' align='center'>";
echo "<tr align='center'><td><font color='#006666' size='3'><strong>รายการลาวันนี้</strong></font></td></tr>";
echo "<tr align='center'><td><font color='#006666' size='2'><strong>$thai_date</strong></font></td></tr>";
echo "</table>";


//ส่วนแสดงผล
echo "<table width='95%' border='0' align='center'>";
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
<INPUT TYPE="hidden" name=option value="la">
<INPUT TYPE="hidden" name=task value="main/report_1">
เลือกวันที่ <input type="text" id="datepicker" name=datepicker value=<?php echo (isset($_GET['datepicker']))? $_GET['datepicker']:date("d-m-Y");?>  readonly Size=10>
</FORM>
	</td>
</tr>
</table>
<?php

$sql = "select la_main.id, la_main.person_id, la_main.rec_date, la_main.la_type, la_main.la_start, la_main.la_finish, la_main.la_total, la_main.document, la_main.group_sign,la_main.commander_grant,la_main.commander_comment,la_main.commander_sign,la_main.grant_date from la_main left join la_person_set on  la_main.person_id=la_person_set.person_id where (la_main.la_start<='$f2_date') and ('$f2_date'<=la_main.la_finish) order by la_main.la_type ";
$dbquery = mysql_query($sql);

echo  "<table width='95%' border='0' align='center'>";

echo "<Tr bgcolor='#FFCCCC' align='center'><Td width='60'>ที่</Td><Td>เลขที่</Td><Td width='120'>ผู้ขออนุญาต</Td><Td width='100'>วันขออนุญาต</Td><Td>ประเภทการลา</Td><Td>ตั้งแต่วันที่</Td><Td>ถึงวันที่</Td><Td>มีกำหนด</Td><Td width='50'>อนุมัติ</Td></Tr>";

$N=1; 
$M=1;

While ($result = mysql_fetch_array($dbquery)){
		$id = $result['id'];
		$person_id = $result['person_id'];		
		$file = $result['document'];
		$rec_date = $result['rec_date'];
			
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

						//ส่วนยกเลิกวันลา
						$sql_cancel="select * from la_cancel where (cancel_la_start<='$f2_date' and '$f2_date'<=cancel_la_finish) and la_type='$result[la_type]' and person_id='$person_id' ";
						$dbquery_cancel = mysql_query($sql_cancel);
						if($dbquery_cancel){
						$la_num_cancel=mysql_num_rows($dbquery_cancel);	
								if($la_num_cancel>=1){
								continue;
								}
						}
			
			if(($M%2) == 0)
			$color="#FFFFB";
			else  	$color="#FFFFFF";

echo "<Tr bgcolor='$color'><Td valign='top' align='center'>$M</Td><td align='center'>$id</td>";

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

echo "<Td valign='top' align='center'>";
if($result['commander_grant']==1){
echo "<img src=images/yes.png border='0'>";
}
else if($result['commander_grant']==2){
echo "<img src=images/no.png border='0'>";
}
else{
echo "รออนุมัติ";
}
echo "</Td>";
echo "</Tr>";

$M++;
$N++;  //*เกี่ยวข้องกับการแยกหน้า
}	
echo "</Table>";

?>
