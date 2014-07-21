<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
$officer=$_SESSION['login_user_id'];
?>
<script type="text/javascript" src="jquery/jquery-1.5.1.js"></script> 
<script type="text/javascript">

$(function(){
	$("select#proj").change(function(){
		var datalist2 = $.ajax({	// รับค่าจาก ajax เก็บไว้ที่ตัวแปร datalist2
			  url: "modules/budget/main/return_ajax_proj.php", // ไฟล์สำหรับการกำหนดเงื่อนไข
			  data:"proj="+$(this).val(), // ส่งตัวแปร GET ชื่อ proj ให้มีค่าเท่ากับ ค่าของ proj
			  async: false
		}).responseText;		
		$("select#pj_activity").html(datalist2); // นำค่า datalist2 มาแสดงใน listbox ที่ 2 ที่ชื่อ pj_activity
		// ชื่อตัวแปร และ element ต่างๆ สามารถเปลี่ยนไปตามการกำหนด
	});
});
</script>

<?php
$t_month['01']="มค";
$t_month['02']="กพ";
$t_month['03']="มีค";
$t_month['04']="เมย";
$t_month['05']="พค";
$t_month['06']="มิย";
$t_month['07']="กค";
$t_month['08']="สค";
$t_month['09']="กย";
$t_month['10']="ตค";
$t_month['11']="พย";
$t_month['12']="ธค";

$th_month['1']="มกราคม";
$th_month['2']="กุมภาพันธ์";
$th_month['3']="มีนาคม";
$th_month['4']="เมษายน";
$th_month['5']="พฤษภาคม";
$th_month['6']="มิถุนายน";
$th_month['7']="กรกฎาคม";
$th_month['8']="สิงหาคม";
$th_month['9']="กันยายน";
$th_month['10']="ตุลาคม";
$th_month['11']="พฤศจิกายน";
$th_month['12']="ธันวาคม";

//ปีงบประมาณ
$sql = "select * from  budget_year where year_active='1' order by budget_year desc limit 1";
$dbquery = mysql_query($sql);
$year_active_result = mysql_fetch_array($dbquery);
if($year_active_result['budget_year']==""){
echo "<br />";
echo "<div align='center'>ยังไม่ได้กำหนดทำงานในปีงบประมาณใด ๆ  กรุณาไปที่เมนูตั้งค่าระบบ เพื่อกำหนดปีงบประมาณ</div>";
exit();
}

//ส่วนหัว
echo "<br />";
if(!(($index==1) or ($index==2) or ($index==5) or ($index==7))){
echo "<table width='50%' border='0' align='center'>";
echo "<tr align='center'><td><font color='#006666' size='3'><strong>ทะเบียนคืนเงินโครงการ ปีงบประมาณ$year_active_result[budget_year]</strong></font></td></tr>";
echo "</table>";
}

//ส่วนฟอร์มรับข้อมูล
if($index==1){
echo "<form id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>ลงทะเบียน คืนเงินโครงการ ปีประมาณ$year_active_result[budget_year]</Font>";
echo "</Cener>";
echo "<Br><Br>";
echo "<Table width=70% Border=0 Bgcolor=#Fcf9d8>";

echo "<Tr align='left'><Td ></Td><Td align='right'>ที่เอกสาร&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='doc' id='doc' Size='20'></Td></Tr>";

echo "<Tr align='left'><Td width='20'></Td><Td align='right'>รายการ&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='item' Size='50'></Td></Tr>";


echo "<Tr align='left'><Td ></Td><Td align='right'>โครงการ&nbsp;&nbsp;</Td>";
echo "<td><div align='left'><Select  name='proj' id='proj' size='1'>";
echo  "<option  value = ''>เลือก</option>" ;

$sql = "select  * from  plan_proj  where budget_year='$year_active_result[budget_year]' order by code_proj";
$dbquery = mysql_query($sql);
While ($result = mysql_fetch_array($dbquery))
   {
$code_proj = $result['code_proj']; 
$name_proj = $result['name_proj'];
$name_proj = substr($name_proj,0,100)."...";  
echo  "<option value = $code_proj >$code_proj $name_proj</option>" ;
	}
echo "</select>";
echo "</div></td></tr>";

echo "<Tr align='left'><Td></Td><Td align='right'>กิจกรรม&nbsp;&nbsp;</Td><td align='left'>";
echo "<Select  name='pj_activity' id='pj_activity' size='1' >";
echo  "<option  value = ''>เลือก</option>" ;
echo "</select>";
echo "</td></tr>";


echo "<Tr align='left'><Td width='20'></Td><Td align='right'>จำนวนเงิน&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='amount' Size='15' onkeydown='digitOnly()'>บาท</Td></Tr>";

echo   "<tr><Td ></Td><td align='right'>ประเภทรายการจ่าย(ที่ยืมไป)&nbsp;&nbsp;</td>";
echo   "<td><div align=left><Select name='pay_type' size='1'>"; 
echo  "<option  value = ''>เลือก</option>" ;
$sql = "select  * from  budget_pay_type  order by pay_type_id";
$dbquery = mysql_query($sql);
While ($result = mysql_fetch_array($dbquery))
   {
		$pay_type_id = $result['pay_type_id'];
		$pay_type_name = $result['pay_type_name'];
		echo  "<option value = $pay_type_id>$pay_type_name</option>" ;
	}
echo "</select>";
echo "</div></td></tr>";

echo "<Tr align='left'><Td width='30'></Td><Td align='right'>ผู้ขอยืมเงิน&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='p_request' Size='30'></Td></Tr>";

echo "<Br>";
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
echo "<INPUT TYPE='button' name='smb' value='ยืนยัน' onclick='location.href=\"?option=budget&task=main/return_withdraw&index=3&id=$_GET[id]&page=$_REQUEST[page]\"'>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ยกเลิก' onclick='location.href=\"?option=budget&task=main/return_withdraw&page=$_REQUEST[page]\"'";
echo "</td></tr></table>";
}

//ส่วนลบข้อมูล
if($index==3){
$sql = "delete from budget_money_return where id=$_GET[id]";
$dbquery = mysql_query($sql);
}

//ส่วนบันทึกข้อมูล
if($index==4){
$rec_date = date("Y-m-d");
$sql = "insert into budget_money_return(budget_year, document, item, pj_activity, money, pay_type, p_request, officer, rec_date) values ('$year_active_result[budget_year]','$_POST[doc]','$_POST[item]', '$_POST[pj_activity]','$_POST[amount]', '$_POST[pay_type]', '$_POST[p_request]','$officer','$rec_date')";
$dbquery = mysql_query($sql);
}

//ส่วนฟอร์มแก้ไขข้อมูล
if ($index==5){
$sql = "select * from  budget_money_return where id='$_GET[id]' ";
$dbquery = mysql_query($sql);
$ref_result = mysql_fetch_array($dbquery);
		$id = $ref_result['id'];
		$document= $ref_result['document'];
		$item= $ref_result['item'];
		$pj_activity= $ref_result['pj_activity'];
		$money= $ref_result['money'];
		$pay_type= $ref_result['pay_type'];
		$p_request= $ref_result['p_request'];
		$officer= $ref_result['officer'];
		$rec_date= $ref_result['rec_date'];
	list($rec_year,$rec_month,$rec_day) = explode("-",$ref_result['rec_date']);	

echo "<form id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>แก้ไข ทะเบียนคืนเงินโครงการ ปีประมาณ$year_active_result[budget_year]</Font>";
echo "</Cener>";
echo "<Br><Br>";
echo "<Table width=70% Border=0 Bgcolor=#Fcf9d8>";

echo "<Tr align='left'><Td align='right'>วันที่&nbsp;&nbsp;</Td><Td><Select  name='update_date' id='update_date' size='1'>";
echo  "<option  value = ''>เลือก</option>" ;

for($x=1;$x<=31;$x++){
	if($rec_day==$x){
	$date_select[$x]="selected";
	}
	else{
	$date_select[$x]="";
	}
echo  "<option  value =$x $date_select[$x]>$x</option>" ;
}
echo "</select>";
echo "</Td></Tr>";

echo "<Tr align='left'><Td align='right'>เดือน&nbsp;&nbsp;</Td><Td><Select  name='update_month' id='update_month' size='1'>";
echo  "<option  value = ''>เลือก</option>" ;
for($x=1;$x<=12;$x++){
	if($rec_month==$x){
	$month_select[$x]="selected";
	}
	else{
	$date_select[$x]="";
	}
echo  "<option value =$x $month_select[$x]>$th_month[$x]</option>" ;
}
echo "</select>";
echo "</Td></Tr>";

$update_year=$rec_year+543;
echo "<Tr align='left'><Td align='right'>ปี&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='update_year' id='update_year' Size='4' maxlength='4' value='$update_year' onkeydown='integerOnly()'></Td></Tr>";

echo "<Tr align='left'><Td align='right'>ที่เอกสาร&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='doc' id='doc' Size='20' value='$document'></Td></Tr>";

echo "<Tr align='left'><Td align='right'>รายการ&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='item' Size='50' value='$item'></Td></Tr>";

$sql = "select * from plan_acti where code_acti='$pj_activity' "; //หารหัสโครงการ
$dbquery = mysql_query($sql);
$acti_result = mysql_fetch_array($dbquery);

echo "<Tr align='left'><Td align='right'>โครงการ&nbsp;&nbsp;</Td>";
echo "<td><div align='left'><Select  name='proj' id='proj' size='1'>";
echo  "<option  value = ''>เลือก</option>" ;

$sql = "select  * from  plan_proj where budget_year='$year_active_result[budget_year]' order by  code_proj";
$dbquery = mysql_query($sql);
While ($result = mysql_fetch_array($dbquery))
   {
$code_proj = $result['code_proj']; 
$name_proj = $result['name_proj'];
$name_proj = substr($name_proj,0,120)."...";  

		if($code_proj==$acti_result[code_proj]){
		echo  "<option value = $code_proj selected>$code_proj $name_proj</option>" ;
		}
		else{
		echo  "<option value = $code_proj >$code_proj $name_proj</option>" ;
		}
	}
echo "</select>";
echo "</div></td></tr>";

echo "<Tr align='left'><Td align='right'>กิจกรรม&nbsp;&nbsp;</Td><td align='left'>";
echo "<Select  name='pj_activity' id='pj_activity' size='1' >";
echo  "<option  value = ''>เลือก</option>" ;

$sql = "select * from  plan_acti  where code_proj='$acti_result[code_proj]' and  budget_year='$year_active_result[budget_year]'";
$dbquery = mysql_query($sql);
While ($acti_of_plan_result = mysql_fetch_array($dbquery)){
	if($acti_of_plan_result[code_acti]==$pj_activity){
	echo  "<option  value=$acti_of_plan_result[code_acti] selected>$acti_of_plan_result[code_acti] $acti_of_plan_result[name_acti]</option>" ;
	}
	else{
	echo  "<option  value=$acti_of_plan_result[code_acti]>$acti_of_plan_result[code_acti] $acti_of_plan_result[name_acti]</option>" ;
	}	
}
echo "</select>";
echo "</td></tr>";

echo "<Tr align='left'><Td align='right'>จำนวนเงิน&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='amount' Size='15' onkeydown='digitOnly()' value='$money'>บาท</Td></Tr>";

echo   "<tr><td align='right'>ประเภทรายการจ่าย&nbsp;&nbsp;</td>";
echo   "<td><div align=left><Select name='pay_type' size='1'>"; 
echo  "<option  value = ''>เลือก</option>" ;
$sql = "select  * from  budget_pay_type  order by pay_type_id";
$dbquery = mysql_query($sql);

While ($result = mysql_fetch_array($dbquery))
   {
		$pay_type_id = $result['pay_type_id'];
		$pay_type_name = $result['pay_type_name'];
		if($pay_type_id==$pay_type){
		echo  "<option value = $pay_type_id selected>$pay_type_name</option>" ;
		}
		else{
		echo  "<option value = $pay_type_id>$pay_type_name</option>" ;
		}
	}
echo "</select>";
echo "</div></td></tr>";

echo "<Tr align='left'><Td align='right'>ผู้คืนเงินโครงการ&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='p_request' Size='30' value='$p_request'></Td></Tr>";

echo "<Br>";
echo "</Table>";
echo "<Br>";
echo "<INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url_update(1)' class=entrybutton>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ย้อนกลับ' onclick='goto_url_update(0)' class=entrybutton'>";
echo "<INPUT TYPE='hidden' name='id' value='$_GET[id]'>";
echo "<Input Type=Hidden Name='page' Value='$_GET[page]'>";
echo "</form>";
}

//ส่วนปรับปรุงข้อมูล
if ($index==6){
$rec_date=($_POST['update_year']-543)."-".$_POST['update_month']."-".$_POST['update_date'];
$sql = "update budget_money_return set document='$_POST[doc]',item='$_POST[item]', pj_activity='$_POST[pj_activity]', money='$_POST[amount]', pay_type='$_POST[pay_type]', p_request='$_POST[p_request]',rec_date='$rec_date',officer='$officer' where id='$_POST[id]'";
$dbquery = mysql_query($sql);
}

//ส่วนแสดงรายละเอียด
if ($index==7){
$sql = "select * from  budget_money_return where id='$_GET[id]' ";
$dbquery = mysql_query($sql);
While ($result = mysql_fetch_array($dbquery))
	{
		$id = $result['id'];
		$document= $result['document'];
		$item= $result['item'];
		$pj_activity= $result['pj_activity'];
		$money= $result['money'];
		$money=number_format($money,2);
		$pay_type= $result['pay_type'];
		$p_request= $result['p_request'];
		$officer= $result['officer'];
		$rec_date= $result['rec_date'];
	}
list($rec_year,$rec_month,$rec_day) = explode("-",$rec_date);	
$t_year=($rec_year+543);		
$to_date=$rec_day.$t_month[$rec_month].$t_year;
echo "<Br>";
echo "<Table align='center' width='70%' Border='0' Bgcolor='#Fcf9d8'>";
echo "<Tr ><Td colspan='3' align='right'><INPUT TYPE='button' name='smb' value='<<กลับหน้าก่อน' onclick='location.href=\"?option=budget&task=main/return_withdraw&id=$_GET[id]&page=$_GET[page]\"'></Td></Tr>";
echo "<Tr align='left'><Td width='20'></Td><Td align='right'>วดป ลงทะเบียน&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='' Size='10'  value='$to_date' readonly></Td></Tr>";

echo "<Tr align='left'><Td ></Td><Td align='right'>ที่เอกสาร&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='doc' id='doc' Size='20' value='$document' readonly></Td></Tr>";

echo "<Tr align='left'><Td width='20'></Td><Td align='right'>รายการ&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='item' Size='50' value='$item' readonly></Td></Tr>";

$sql = "select * from plan_acti where code_acti='$pj_activity' "; //หารหัสโครงการ
$dbquery = mysql_query($sql);
$acti_result = mysql_fetch_array($dbquery);

echo "<Tr align='left'><Td ></Td><Td align='right'>โครงการ&nbsp;&nbsp;</Td>";
echo "<td><div align='left'><Select  name='proj' size='1'>";
echo  "<option  value = ''>เลือก</option>" ;

$sql = "select  * from  plan_proj where budget_year='$year_active_result[budget_year]' order by  code_proj";
$dbquery = mysql_query($sql);
While ($result = mysql_fetch_array($dbquery))
   {
$code_proj = $result['code_proj']; 
$name_proj = $result['name_proj'];
$name_proj = substr($name_proj,0,120)."...";  

		if($code_proj==$acti_result[code_proj]){
		echo  "<option value = $code_proj selected>$code_proj $name_proj</option>" ;
		}
	}
echo "</select>";
echo "</div></td></tr>";

echo "<Tr align='left'><Td></Td><Td align='right'>กิจกรรม&nbsp;&nbsp;</Td><td align='left'>";
echo "<Select  name='pj_activity' id='pj_activity' size='1' >";
echo  "<option  value = ''>เลือก</option>" ;

$sql = "select * from  plan_acti  where code_proj='$acti_result[code_proj]' and  budget_year='$year_active_result[budget_year]'";
$dbquery = mysql_query($sql);
While ($acti_of_plan_result = mysql_fetch_array($dbquery)){
	if($acti_of_plan_result[code_acti]==$pj_activity){
	echo  "<option  value=$acti_of_plan_result[code_acti] selected>$acti_of_plan_result[code_acti] $acti_of_plan_result[name_acti]</option>" ;
	}
}
echo "</select>";
echo "</td></tr>";

echo "<Tr align='left'><Td width='20'></Td><Td align='right'>จำนวนเงิน&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='amount' Size='15' value='$money' readonly>บาท</Td></Tr>";

echo   "<tr><Td ></Td><td align='right'>ประเภทรายการจ่าย&nbsp;&nbsp;</td>";
echo   "<td><div align=left><Select name='pay_type' size='1'>"; 
$sql = "select  * from  budget_pay_type  order by pay_type_id";
$dbquery = mysql_query($sql);
While ($result = mysql_fetch_array($dbquery))
   {
		$pay_type_id = $result['pay_type_id'];
		$pay_type_name = $result['pay_type_name'];
		if($pay_type_id==$pay_type){
		echo  "<option value = $pay_type_id  selected>$pay_type_name</option>" ;
		}
	}
echo "</select>";
echo "</div></td></tr>";

echo "<Tr align='left'><Td width='30'></Td><Td align='right'>ผู้คืนเงินโครงการ&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='p_request' Size='30' value='$p_request' readonly></Td></Tr>";


$sql = "select  * from  person_main where person_id='$officer' ";
$dbquery = mysql_query($sql);
$result = mysql_fetch_array($dbquery);
$fullname=$result['prename'].$result['name']." ".$result['surname'];
echo "<Tr align='left'><Td width='20'></Td><Td align='right'>เจ้าหน้าที่&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='' Size='30' value='$fullname' readonly></Td></Tr>";

echo "<Br>";
echo "</Table>";
}

//ส่วนแสดงผล
if(!(($index==1) or ($index==2) or ($index==5) or ($index==7))){

//ส่วนของการคำนวณ
$money_total=0; //รวมรับ
$sql = "select * from  budget_money_return where budget_year='$year_active_result[budget_year]' order by rec_date, id";
$dbquery = mysql_query($sql);
$num_rows=mysql_num_rows($dbquery); //นำไปแบ่งหน้า
While ($result = mysql_fetch_array($dbquery)) {
$money_total=$money_total+$result['money'];
$money_total_ar[$result['id']]=$money_total;   //รวมรับ รายรายการ
}

//ส่วนของการแยกหน้า
$pagelen=20 ; // กำหนดแถวต่อหน้า
$url_link="option=budget&task=main/return_withdraw";  //กำหนด url เพจ 
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

echo  "<table width=95% border=0 align=center>";
$sql = "select * from  budget_money_return where budget_year='$year_active_result[budget_year]' order by rec_date, id limit $start,$pagelen ";
$dbquery = mysql_query($sql);
$num_effect = mysql_num_rows($dbquery );  // จำนวนข้อมูลในหน้านี้
echo "<Tr><Td colspan='5' align='left'><INPUT TYPE='button' name='smb' value='ลงทะเบียน' onclick='location.href=\"?option=budget&task=main/return_withdraw&index=1\"'></Td></Tr>";
echo "<Tr bgcolor=#FFCCCC align=center class=style2><Td width='60'>ที่</Td><Td width='80'>วดป</Td><Td width='150'>ที่เอกสาร</Td><Td>รายการ</Td><Td>จำนวนเงิน</Td><td align='center'>รายละเอียด</td><td width='50' align='center'>ลบ</td><Td width='50' align='center'>แก้ไข</Td><Td width='55' align='center'>รวม</Td></Tr>";

$N=(($page-1)*$pagelen)+1;  //*เกี่ยวข้องกับการแยกหน้า
$M=1;
While ($result = mysql_fetch_array($dbquery))
	{
		$id = $result['id'];
		$document= $result['document'];
		$item= $result['item'];
		$money= $result['money'];
		$money=number_format($money,2);
		$rec_date=$result['rec_date'];
list($rec_year,$rec_month,$rec_day) = explode("-",$rec_date);	
$t_year=($rec_year+543)-2500;		

		if(($M%2) == 0)
		$color="#FFFFC";
		else  	$color="#FFFFFF";
		
		echo "<Tr bgcolor=$color align=center class=style1><Td >$id</Td><Td width='100' align='left'>$rec_day $t_month[$rec_month] $t_year</Td><Td align='left'>$document</Td><Td align=left>";
		if($officer==$result['officer']){
		echo $item;		
		}
		else {
		echo $item." <img src=./images/dangerous.png border='0' alt='รายการนี้เป็นของเจ้าหน้าที่คนอื่น'>";
		}
		echo "</Td>";
		echo "<Td width='120' align=right>$money</Td>";
		echo "<Td width='50'><div align=center><a href=?option=budget&task=main/return_withdraw&id=$id&index=7&page=$page><img src=./images/browse.png border='0' alt='รายละเอียด'></a></td>";
		if($officer==$result['officer']){
		echo "<Td width='50' align='center'><a href=?option=budget&task=main/return_withdraw&id=$id&index=2&page=$page><img src=./images/drop.png border='0' alt='ลบ'></a>";
		echo "<td width='50' align='center'>
		<a href=?option=budget&task=main/return_withdraw&id=$id&index=5&page=$page><img src=./images/edit.png border='0' alt='แก้ไข'></a></div></Td</Tr>";
		}
		else{
		echo "<td>&nbsp;</td><td>&nbsp;</td>";
		}
		//กำหนดสัญญาลักษ์ ถึงนี้ 
		if($M==$num_effect){
		$tungnee="ถึงนี้";
		}
		else {
		$tungnee="ถึงนี้>>";
		}
		
		if(!isset($_GET['cal_id'])){
		$_GET['cal_id']="";
		}	
		if($_GET['cal_id']==$id){
		echo "<Td align='center'><a href=?option=budget&task=main/return_withdraw&page=$page>$tungnee</a></Td>";
		echo "</Tr>";
		break;  //ออกจากloop
		}
		else {
		echo "<Td align='center'><a href=?option=budget&task=main/return_withdraw&cal_id=$id&page=$page>ถึงนี้</a></Td>";
		echo "</Tr>";
		}		
$M++;
$N++;  //*เกี่ยวข้องกับการแยกหน้า
	}
//สรุป
if(isset($id)){
$money_item_total=number_format($money_total_ar[$id],2);	
}
else{
$money_item_total="";
}
echo "<Tr bgcolor='#FFCCCC'><Td colspan='3'></Td><Td align='center'>รวม</Td><Td align='center'>$money_item_total</Td><Td colspan='5'></td></Tr>";
echo "</Table>";
}
?>

<script>
function goto_url(val){
	if(val==0){
		callfrm("?option=budget&task=main/return_withdraw");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.doc.value == ""){
			alert("กรุณากรอกที่เอกสาร");
		}else if(frm1.item.value==""){
			alert("กรุณากรอกรายการ");
		}else if(frm1.proj.value==""){
			alert("กรุณาเลือกโครงการ");
		}else if(frm1.pj_activity.value==""){
			alert("กรุณาเลือกกิจกรรม");
		}else if(frm1.amount.value == ""){
			alert("กรุณากรอกจำนวนเงิน");
		}else if(frm1.pay_type.value == ""){
			alert("กรุณาเลือกประเภทรายการจ่าย");
		}else if(frm1.p_request.value == ""){
			alert("กรุณาเลือกผู้ขอเบิก/ขอยืมเงิน");
		}else{
			callfrm("?option=budget&task=main/return_withdraw&index=4");   //page ประมวลผล
		}
	}
}

function goto_url_update(val){
	if(val==0){
		callfrm("?option=budget&task=main/return_withdraw");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.doc.value == ""){
			alert("กรุณากรอกที่เอกสาร");
		}else if(frm1.item.value==""){
			alert("กรุณากรอกรายการ");
		}else if(frm1.proj.value==""){
			alert("กรุณาเลือกโครงการ");
		}else if(frm1.pj_activity.value==""){
			alert("กรุณาเลือกกิจกรรม");
		}else if(frm1.amount.value == ""){
			alert("กรุณากรอกจำนวนเงิน");
		}else if(frm1.pay_type.value == ""){
			alert("กรุณาเลือกประเภทรายการจ่าย");
		}else if(frm1.p_request.value == ""){
			alert("กรุณาเลือกผู้ขอเบิก/ขอยืมเงิน");
		}else{
			callfrm("?option=budget&task=main/return_withdraw&index=6");   //page ประมวลผล
		}
	}
}

</script>
