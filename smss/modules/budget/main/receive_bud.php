<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
//sd page 
$officer=$_SESSION['login_user_id'];

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
echo "<table width='100%' border='0' align='center'>";
echo "<tr align='center'><td><font color='#006666' size='3'><strong>ทะเบียนการรับแจ้งการจัดสรรเงินงบประมาณ ปีงบประมาณ$year_active_result[budget_year]</strong></font></td></tr>";
echo "</table>";
}

//ส่วนฟอร์มรับข้อมูล
if($index==1){
echo "<form id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>เพิ่มรายการรับแจ้งการจัดสรรเงินงบประมาณ ปีงบประมาณ$year_active_result[budget_year]</Font>";
echo "</Cener>";
echo "<Br><Br>";
echo "<Table width=70% Border=0 Bgcolor=#Fcf9d8>";

echo "<Tr align='left'><Td align='right'>ที่เอกสาร&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='doc' id='doc' Size='20'></Td></Tr>";

echo "<Tr align='left'><Td align='right'>ชื่อรายการ&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='item' id='item' Size='60'></Td></Tr>";

echo "<Tr align='left'><Td align='right'>จำนวนเงิน&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='receive_amount' id='receive_amount' Size='15' onkeydown='digitOnly()'></Td></Tr>";

echo "<Tr align='left'><Td align='right'>รายการจ่าย&nbsp;&nbsp;</Td>";
echo "<td><div align='left'><Select  name='pay_group' id='group' size='1'>";
echo  "<option  value = ''>เลือก</option>" ;
$sql = "select  * from  budget_pay_type order by id";
$dbquery = mysql_query($sql);
While ($result = mysql_fetch_array($dbquery)) {
	echo  "<option value = $result[pay_type_id]>$result[pay_type_name]</option>";
	}
echo "</select>";
echo "</div></td></tr>";

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
echo "<INPUT TYPE='button' name='smb' value='ยืนยัน' onclick='location.href=\"?option=budget&task=main/receive_bud&index=3&id=$_GET[id]&page=$_REQUEST[page]\"'>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ยกเลิก' onclick='location.href=\"?option=budget&task=main/receive_bud&page=$_REQUEST[page]\"'";
echo "</td></tr></table>";
}

//ส่วนลบข้อมูล
if($index==3){
$sql = "delete from budget_bud where id=$_GET[id]";
$dbquery = mysql_query($sql);
}

//ส่วนบันทึกข้อมูล
if($index==4){
$rec_date = date("Y-m-d");
$sql = "insert into budget_bud (budget_year, doc,status, item, receive_amount,pay_group, rec_date, officer) values ('$year_active_result[budget_year]', '$_POST[doc]','1', '$_POST[item]','$_POST[receive_amount]', '$_POST[pay_group]','$rec_date','$officer')";
$dbquery = mysql_query($sql);
}

//ส่วนฟอร์มแก้ไขข้อมูล
if ($index==5){
echo "<form id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>แก้ไขรายการรับแจ้งการจัดสรรเงินงบประมาณ ปีงบประมาร$year_active_result[budget_year]</B></Font>";
echo "</Cener>";
echo "<Br><Br>";
echo "<Table   width=70% Border=0 Bgcolor=#Fcf9d8>";

$sql = "select * from budget_bud where id='$_GET[id]'";
$dbquery = mysql_query($sql);
$ref_result = mysql_fetch_array($dbquery);
list($rec_year,$rec_month,$rec_day) = explode("-",$ref_result['rec_date']);	

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

echo "<Tr align='left'><Td align='right'>ที่เอกสาร&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='doc' id='doc' Size='20' value='$ref_result[doc]'></Td></Tr>";

echo "<Tr align='left'><Td align='right'>ชื่อรายการ&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='item' id='item' Size='60' value='$ref_result[item]'></Td></Tr>";

echo "<Tr align='left'><Td align='right'>จำนวนเงิน&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='receive_amount' id='receive_amount' Size='15'  value='$ref_result[receive_amount]' onkeydown='digitOnly()'></Td></Tr>";

echo "<Tr align='left'><Td align='right'>รายการจ่าย&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='item' id='item' Size='60' value='$ref_result[item]'></Td></Tr>";

echo "<Tr align='left'><Td align='right'>รายการจ่าย&nbsp;&nbsp;</Td>";
echo "<td><div align='left'><Select  name='pay_group' id='group' size='1'>";
echo  "<option  value = ''>เลือก</option>" ;
$sql = "select  * from  budget_pay_type order by id";
$dbquery = mysql_query($sql);
While ($result = mysql_fetch_array($dbquery)) {
		if($result['pay_type_id']==$ref_result['pay_group']){
		$pay_type_select="selected";
		}
		else{
		$pay_type_select="";
		}
	echo  "<option value = $result[pay_type_id] $pay_type_select>$result[pay_type_name]</option>";
	}
echo "</select>";
echo "</div></td></tr>";

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
$rec_date=($_POST['update_year']-543)."-".$_POST['update_month']."-".$_POST['update_date'];
$sql = "update budget_bud set doc='$_POST[doc]',item='$_POST[item]', receive_amount='$_POST[receive_amount]',pay_group='$_POST[pay_group]',officer='$officer' , rec_date='$rec_date' where id='$_POST[id]'";
$dbquery = mysql_query($sql);
}

if ($index==7){
echo "<Center>";
echo "<Font color='#006666' Size=3><B>รายละเอียดการรับแจ้งการจัดสรรเงินงบประมาณ ปีงบประมาณ$year_active_result[budget_year]</B></Font>";
echo "</Cener>";
echo "<Br>";
$sql = "select * from budget_bud where id='$_GET[id]'";
$dbquery = mysql_query($sql);
$ref_result = mysql_fetch_array($dbquery);
list($rec_year,$rec_month,$rec_day) = explode("-",$ref_result['rec_date']);	
echo "<Br>";
echo "<Table  align='center' width='60%' Border='0' Bgcolor='#Fcf9d8'>";
echo "<Tr ><Td colspan='7' align='right'><INPUT TYPE='button' name='smb' value='<<กลับหน้าก่อน' onclick='location.href=\"?option=budget&task=main/receive_bud&page=$_GET[page]\"'></Td></Tr>";

echo "<Tr align='left'><Td align='right'>วันที่&nbsp;&nbsp;</Td><Td><Select  name='update_date' id='update_date' size='1'>";
for($x=1;$x<=31;$x++){
	if($rec_day==$x){
	echo  "<option  value =$x>$x</option>" ;
	}
}
echo "</select>";
echo "</Td></Tr>";

echo "<Tr align='left'><Td align='right'>เดือน&nbsp;&nbsp;</Td><Td><Select  name='update_month' id='update_month' size='1'>";
for($x=1;$x<=12;$x++){
	if($rec_month==$x){
	echo  "<option value =$x $month_select[$x]>$th_month[$x]</option>" ;
	}
}
echo "</select>";
echo "</Td></Tr>";

$update_year=$rec_year+543;
echo "<Tr align='left'><Td align='right'>ปี&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='update_year' id='update_year' Size='4' maxlength='4' value='$update_year' readonly></Td></Tr>";

echo "<Tr align='left'><Td align='right'>ที่เอกสาร&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='doc' id='doc' Size='20' value='$ref_result[doc]' readonly></Td></Tr>";

echo "<Tr align='left'><Td align='right'>ชื่อรายการ&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='item' id='item' Size='60' value='$ref_result[item]' readonly></Td></Tr>";

echo "<Tr align='left'><Td align='right'>จำนวนเงิน&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='receive_amount' id='receive_amount' Size='15'  value='$ref_result[receive_amount]' readonly></Td></Tr>";

echo "<Tr align='left'><Td align='right'>รายการจ่าย&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='item' id='item' Size='60' value='$ref_result[item]'></Td></Tr>";

echo "<Tr align='left'><Td align='right'>รายการจ่าย&nbsp;&nbsp;</Td>";
echo "<td><div align='left'><Select  name='pay_group' id='group' size='1'>";
$sql = "select  * from  budget_pay_type order by id";
$dbquery = mysql_query($sql);
While ($result = mysql_fetch_array($dbquery)) {
		if($result['pay_type_id']==$ref_result['pay_group']){
		echo  "<option value = $result[pay_type_id] $pay_type_select>$result[pay_type_name]</option>";
		}
	}
echo "</select>";
echo "</div></td></tr>";

$sql = "select  * from  person_main where person_id='$ref_result[officer]' ";
$dbquery = mysql_query($sql);
$result = mysql_fetch_array($dbquery);
$fullname=$result['prename'].$result['name']." ".$result['surname'];
echo "<Tr align='left'><Td align='right'>เจ้าหน้าที่&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='' Size='30' value='$fullname' readonly></Td></Tr>";
echo "</Table>";

}

//ส่วนแสดงผล
if(!(($index==1) or ($index==2) or ($index==5) or ($index==7))){

//ส่วนของการคำนวณ
$receive_total=0; //iวมรับ
$sql="select * from budget_bud where status='1' and budget_year='$year_active_result[budget_year]' order by rec_date, id";
$dbquery = mysql_query($sql);
$num_rows = mysql_num_rows($dbquery ); //นำไปแยกหน้า
While ($result = mysql_fetch_array($dbquery)) {
$receive_total=$receive_total+$result['receive_amount'];
$receive_total_ar[$result['id']]=$receive_total;   //รวมรับ รายรายการ
}

//ส่วนของการแยกหน้า
$pagelen=20;  // 1_กำหนดแถวต่อหน้า
$url_link="option=budget&task=main/receive_bud";  // 2_กำหนดลิงค์ฺ
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

$sql="select * from budget_bud where status='1' and budget_year='$year_active_result[budget_year]' order by rec_date, id limit $start,$pagelen";

$dbquery = mysql_query($sql);
$num_effect = mysql_num_rows($dbquery );  // จำนวนข้อมูลในหน้านี้

echo  "<table width=85% border=0 align=center>";
echo "<Tr><Td colspan='8' align='left'><INPUT TYPE='button' name='smb' value='เพิ่มรายการรับ' onclick='location.href=\"?option=budget&task=main/receive_bud&index=1\"'></Td></Tr>";

echo "<Tr bgcolor='#FFCCCC' align='center'><Td width='30'>ที่</Td><Td width='70'>วดป</Td><Td width='150'>ที่เอกสาร</Td><Td>ชื่อรายการ</Td><Td width='100'>จำนวนเงิน</Td><Td>รายละเอียด</Td><Td width='40'>ลบ</Td><Td width='40'>แก้ไข</Td><Td width='60' align='center'>รวม</Td></Tr>";
$N=(($page-1)*$pagelen)+1; //*เกี่ยวข้องกับการแยกหน้า
$M=1;
While ($result = mysql_fetch_array($dbquery))
	{
		$id = $result['id'];
		$doc= $result['doc'];
		$item = $result['item'];
		$receive_amount = $result['receive_amount'];
		$receive_amount=number_format($receive_amount,2);
		$rec_date = $result['rec_date'];
		
list($rec_year,$rec_month,$rec_day) = explode("-",$rec_date);	
$t_year=($rec_year+543)-2500;		
			if(($M%2) == 0)
			$color="#FFFFC";
			else  	$color="#FFFFFF";

		echo "<Tr bgcolor=$color><Td align='center'>$N</Td> <Td>$rec_day $t_month[$rec_month] $t_year</Td><Td align=left>$doc</Td><Td align='left'>";
		echo $item;		
		echo "</Td><Td align='right'>$receive_amount</Td>";
		echo "<Td width=90><div align=center><a href=?option=budget&task=main/receive_bud&id=$id&index=7&page=$page><img src=./images/browse.png border='0' alt='รายละเอียด'></a></td>";			
		if($officer==$result['officer']){
		echo "<Td align=center><a href=?option=budget&task=main/receive_bud&index=2&id=$id&page=$page><img src=images/drop.png border='0' alt='ลบ'></a></Td>
		<Td align=center><a href=?option=budget&task=main/receive_bud&index=5&id=$id&page=$page><img src=images/edit.png border='0' alt='แก้ไข'></a></Td>";
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
		echo "<Td align='center'><a href=?option=budget&task=main/receive_bud&page=$page>$tungnee</a></Td>";
		echo "</Tr>";
		break;  //ออกจากloop
		}
		else {
		echo "<Td align='center'><a href=?option=budget&task=main/receive_bud&cal_id=$id&page=$page>ถึงนี้</a></Td>";
		echo "</Tr>";
		}		
	
$M++;
$N++; //*เกี่ยวข้องกับการแยกหน้า
	}
	
//สรุป
if(isset($id)){
	if(isset($receive_total_ar[$id])){
	$receive_item_total=number_format($receive_total_ar[$id],2);	
	}
}
else{
$receive_item_total="";
}
echo "<Tr bgcolor='#FFCCCC'><Td></Td><Td></Td><Td></Td><Td align='center'>รวม</Td><Td align='center'>$receive_item_total</Td><Td></Td><Td></Td><Td></Td><Td></Td></Tr>";
echo "</Table>";
}

?>
<script>
function goto_url(val){
	if(val==0){
		callfrm("?option=budget&task=main/receive_bud");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.doc.value == ""){
			alert("กรุณากรอกที่เอกสาร");
		}else if(frm1.item.value == ""){
			alert("กรุณากรอกชื่อรายการ");
		}else if(frm1.receive_amount.value == ""){
			alert("กรุณากรอกจำนวนเงิน");
		}else if(frm1.pay_group.value == ""){
			alert("กรุณาเลือกรายการจ่าย");
		}else{
			callfrm("?option=budget&task=main/receive_bud&index=4");   //page ประมวลผล
		}
	}
}

function goto_url_update(val){
	if(val==0){
		callfrm("?option=budget&task=main/receive_bud");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.doc.value == ""){
			alert("กรุณากรอกที่เอกสาร");
		}else if(frm1.item.value == ""){
			alert("กรุณากรอกชื่อรายการ");
		}else if(frm1.receive_amount.value == ""){
			alert("กรุณากรอกจำนวนเงิน");
		}else if(frm1.pay_group.value == ""){
			alert("กรุณาเลือกรายการจ่าย");
		}else{
			callfrm("?option=budget&task=main/receive_bud&index=6");   //page ประมวลผล
		}
	}
}
</script>
