<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
//sd page 
$officer=$_SESSION['login_user_id'];

$budget_status['1']="รับเงินสด";
$budget_status['2']="รับเช็ค/เงินฝากธนาคาร";
$budget_status['3']="จ่ายรับเงินสด";
$budget_status['4']="จ่ายเช็ค/เงินฝากธนาคาร";
$budget_status['5']="นำเงินสดฝากธนาคาร";
$budget_status['6']="นำเงินสดฝากส่วนราชการผู้เบิก";
$budget_status['7']="ถอนเงินฝากธนาคารเป็นเงินสด";
$budget_status['8']="ถอนเงินฝากธนาคารไปฝากส่วนราชการผู้เบิก";
$budget_status['9']="รับคืนเงินฝากส่วนราชการผู้เบิกมาเป็นเงินสด";
$budget_status['10']="รับคืนเงินฝากส่วนราชการมาเป็นเงินฝากธนาคาร";

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

if(!isset($_REQUEST['type_id_index'])){
$_REQUEST['type_id_index']="";
}

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
if(!(($index==1) or ($index==2) or ($index==5 or ($index==7)))){
echo "<table width='100%' border='0' align='center'>";
echo "<tr align='center'><td><font color='#006666' size='3'><strong>ทะเบียนการเปลี่ยนแปลงสถานะเงินนอกงบประมาณ ปีงบประมาณ$year_active_result[budget_year]</strong></font></td></tr>";
echo "</table>";
}

//ส่วนฟอร์มรับข้อมูล
if($index==1){
echo "<form id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>เปลี่ยนแปลงสถานะเงินนอกงบประมาณ ปีงบประมาณ$year_active_result[budget_year]</Font>";
echo "</Cener>";
echo "<Br><Br>";
echo "<Table width='70%' Border='0' Bgcolor='#Fcf9d8'>";

echo "<Tr align='left'><Td ></Td><Td align='right'>ที่เอกสาร</Td><Td><Input Type='Text' Name='doc' id='doc' Size='20'></Td></Tr>";

echo "<Tr align='left'><Td ></Td><Td align='right'>ประเภทของเงิน&nbsp;&nbsp;</Td>";
echo "<td><div align='left'><Select  name='type_id' id='type_id' size='1'>";
echo  "<option  value = ''>เลือก</option>" ;

$sql = "select  * from  budget_type where category_id='1' order by type_id";
$dbquery = mysql_query($sql);
While ($result = mysql_fetch_array($dbquery))
   {
$type_id = $result['type_id']; 
$type_name = $result['type_name'];
echo  "<option value = $type_id>$type_id $type_name</option>";
	}
echo "</select>";
echo "</div></td></tr>";

echo "<Tr align='left'><Td ></Td><Td align='right'>รายการ&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='item' id='item' Size='60'></Td></Tr>";
echo "<Tr align='left'><Td ></Td><Td align='right'>ลักษณะรายการ&nbsp;&nbsp;</Td>";
echo "<td><div align='left'><Select  name='status' id='status' size='1'>";
echo  "<option  value = ''>เลือก</option>" ;
echo  "<option value = '5'>$budget_status[5]</option>";
echo  "<option value = '6'>$budget_status[6]</option>";
echo  "<option value = '7'>$budget_status[7]</option>";
echo  "<option value = '8'>$budget_status[8]</option>";
echo  "<option value = '9'>$budget_status[9]</option>";
echo  "<option value = '10'>$budget_status[10]</option>";
echo "</select>";
echo "</div></td></tr>";

echo "<Tr align='left'><Td width=20></Td><Td align='right'>จำนวนเงิน&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='change_amount' id='change_amount' Size='15' onkeydown='digitOnly()'></Td></Tr>";

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
echo "<INPUT TYPE='button' name='smb' value='ยืนยัน' onclick='location.href=\"?option=budget&task=main/change_ex_bud&index=3&id=$_GET[id]&page=$_REQUEST[page]\"'>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ยกเลิก' onclick='location.href=\"?option=budget&task=main/change_ex_bud&page=$_REQUEST[page]\"'";
echo "</td></tr></table>";
}

//ส่วนลบข้อมูล
if($index==3){
$sql = "delete from budget_main where id=$_GET[id]";
$dbquery = mysql_query($sql);
}

//ส่วนบันทึกข้อมูล
if($index==4){
$rec_date = date("Y-m-d");
$sql = "insert into budget_main (budget_year, doc, type_id, item, change_amount, status,  rec_date, officer) values ('$year_active_result[budget_year]', '$_POST[doc]', '$_POST[type_id]', '$_POST[item]','$_POST[change_amount]', '$_POST[status]', '$rec_date','$officer')";
$dbquery = mysql_query($sql);
}

//ส่วนฟอร์มแก้ไขข้อมูล
if ($index==5){
echo "<form id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>แก้ไขการเปลี่ยนแปลงสถานะเงินนอกงบประมาณ ปีงบประมาณ$year_active_result[budget_year]</B></Font>";
echo "</Cener>";
echo "<Br><Br>";

echo "<Table   width=70% Border=0 Bgcolor=#Fcf9d8>";

$sql = "select * from budget_main where id='$_GET[id]'";
$dbquery = mysql_query($sql);
$ref_result = mysql_fetch_array($dbquery);
list($rec_year,$rec_month,$rec_day) = explode("-",$ref_result['rec_date']);	

echo "<Tr align='left'><Td ></Td><Td align='right'>วันที่&nbsp;&nbsp;</Td><Td><Select  name='update_date' id='update_date' size='1'>";
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

echo "<Tr align='left'><Td ></Td><Td align='right'>เดือน&nbsp;&nbsp;</Td><Td><Select  name='update_month' id='update_month' size='1'>";
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
echo "<Tr align='left'><Td ></Td><Td align='right'>ปี&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='update_year' id='update_year' Size='4' maxlength='4' value='$update_year' onkeydown='integerOnly()'></Td></Tr>";

echo "<Tr align='left'><Td ></Td><Td align='right'>ที่เอกสาร&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='doc' id='doc' Size='20' value='$ref_result[doc]'></Td></Tr>";

echo "<Tr align='left'><Td ></Td><Td align='right'>ประเภทของเงิน&nbsp;&nbsp;</Td>";
echo "<td><div align='left'><Select  name='type_id' id='type_id' size='1'>";
echo  "<option  value = ''>เลือก</option>" ;

$sql = "select  * from  budget_type where category_id='1' order by type_id";
$dbquery = mysql_query($sql);
While ($result = mysql_fetch_array($dbquery))
   {
$type_id = $result['type_id']; 
$type_name = $result['type_name'];
	if($type_id==$ref_result['type_id']){
	$select="selected";
	}
	else{
	$select="";
	}
echo  "<option value = $type_id $select>$type_id $type_name</option>";
	}
echo "</select>";
echo "</div></td></tr>";

echo "<Tr align='left'><Td ></Td><Td align='right'>รายการ&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='item' id='item' Size='60' value='$ref_result[item]'></Td></Tr>";

echo "<Tr align='left'><Td ></Td><Td align='right'>ลักษณะรายการ&nbsp;&nbsp;</Td>";
echo "<td><div align='left'><Select  name='status' id='status' size='1'>";
echo  "<option  value = ''>เลือก</option>" ;
for($x=5;$x<=10;$x++){
	if($ref_result['status']==$x){
	echo  "<option value=$x selected>$budget_status[$x]</option>";
	}
	else {
	echo  "<option value=$x>$budget_status[$x]</option>";
	}
}
echo "</select>";
echo "</div></td></tr>";

echo "<Tr align='left'><Td width=20></Td><Td align='right'>จำนวนเงิน&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='change_amount' id='change_amount' Size='15'  value='$ref_result[change_amount]' onkeydown='digitOnly()'></Td></Tr>";
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
$sql = "update budget_main set doc='$_POST[doc]',type_id='$_POST[type_id]',item='$_POST[item]', change_amount='$_POST[change_amount]', status='$_POST[status]', officer='$officer' , rec_date='$rec_date' where id='$_POST[id]'";
$dbquery = mysql_query($sql);
}

//ส่วนแสดงรายละเอียด
if ($index==7){
echo "<Center>";
echo "<Font color='#006666' Size=3><B>รายละเอียดการเปลี่ยนแปลงสถานะเงินนอกงบประมาณ ปีงบประมาณ$year_active_result[budget_year]</B></Font>";
echo "</Cener>";
echo "<Br><Br>";
echo "<Table   width=60% Border=0 Bgcolor=#Fcf9d8>";
echo "<Tr ><Td colspan='11' align='right'><INPUT TYPE='button' name='smb' value='<<กลับหน้าก่อน' onclick='location.href=\"?option=budget&task=main/change_ex_bud&page=$_GET[page]&type_id_index=$_REQUEST[type_id_index]\"'></Td></Tr>";
$sql = "select * from budget_main where id='$_GET[id]'";
$dbquery = mysql_query($sql);
$ref_result = mysql_fetch_array($dbquery);
list($rec_year,$rec_month,$rec_day) = explode("-",$ref_result['rec_date']);	
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

echo "<Tr align='left'><Td align='right'>ที่เอกสาร</Td><Td><Input Type='Text' Name='doc' id='doc' Size='20' value='$ref_result[doc]' readonly></Td></Tr>";

echo "<Tr align='left'><Td align='right'>ประเภทของเงิน&nbsp;&nbsp;</Td>";
echo "<td><div align='left'><Select  name='type_id' id='type_id' size='1'>";
$sql = "select  * from  budget_type where category_id='1' order by type_id";
$dbquery = mysql_query($sql);
While ($result = mysql_fetch_array($dbquery))
   {
$type_id = $result['type_id']; 
$type_name = $result['type_name'];
		if($type_id==$ref_result['type_id']){
		echo  "<option value = $type_id>$type_id $type_name</option>";
		}
	}
echo "</select>";
echo "</div></td></tr>";

echo "<Tr align='left'><Td align='right'>รายการ&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='item' id='item' Size='60' value='$ref_result[item]'></Td></Tr>";

echo "<Tr align='left'><Td align='right'>ลักษณะรายการ&nbsp;&nbsp;</Td>";
echo "<td><div align='left'><Select  name='status' id='status' size='1'>";
for($x=5;$x<=10;$x++){
	if($ref_result['status']==$x){
	echo  "<option value=$x selected>$budget_status[$x]</option>";
	}
}
echo "</select>";
echo "</div></td></tr>";

echo "<Tr align='left'><Td align='right'>จำนวนเงิน&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='change_amount' id='change_amount' Size='15'  value='$ref_result[change_amount]' readonly></Td></Tr>";

$sql = "select  * from  person_main where person_id='$ref_result[officer]' ";
$dbquery = mysql_query($sql);
$result = mysql_fetch_array($dbquery);
$fullname=$result['prename'].$result['name']." ".$result['surname'];
echo "<Tr align='left'><Td align='right'>เจ้าหน้าที่&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='' Size='30' value='$fullname' readonly></Td></Tr>";
echo "</Table>";
}

//ส่วนแสดงผล
if(!(($index==1) or ($index==2) or ($index==5) or ($index==7))){

//ส่วนของการแยกหน้า
$pagelen=20;  //จำนวนข้อมูลต่อหน้า
$url_link="option=budget&task=main/change_ex_bud";  // 2_กำหนดลิงค์ฺ

$sql = "select  id  from budget_main where budget_year='$year_active_result[budget_year]' and type_id<'200' and status between '5' and '10'";
$dbquery = mysql_query($sql);
$num_rows = mysql_num_rows($dbquery );
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

$sql = "select budget_main.id, budget_main.doc, budget_type.type_name, budget_main.item, budget_main.change_amount, budget_main.status, budget_main.officer, budget_main.rec_date from  budget_main left join  budget_type on budget_main.type_id=budget_type.type_id  where budget_main.budget_year='$year_active_result[budget_year]' and budget_main.type_id<'200' and budget_main.status between '5' and '10' order by budget_main.rec_date, budget_main.id limit $start,$pagelen";

$dbquery = mysql_query($sql);
echo  "<table width=95% border=0 align=center>";
echo "<Tr><Td colspan='9' align='left'><INPUT TYPE='button' name='smb' value='เพิ่มรายการ' onclick='location.href=\"?option=budget&task=main/change_ex_bud&index=1\"'></Td></Tr>";

echo "<Tr bgcolor=#FFCCCC align='center'><Td width='30'>ที่</Td><Td width='70'>วดป</Td><Td width='70'>ที่เอกสาร</Td><Td>ประเภท</Td><Td>รายการ</Td><Td>ลักษณะรายการ</Td><Td width='90'>จำนวนเงิน</Td><Td width='40'>รายละเอียด</Td><Td width='40'>ลบ</Td><Td width='40'>แก้ไข</Td></Tr>";

$N=(($page-1)*$pagelen)+1;  //*เกี่ยวข้องกับการแยกหน้า
$M=1;
While ($result = mysql_fetch_array($dbquery))
	{
		$id = $result['id'];
		$doc= $result['doc'];
		$type_name = $result['type_name'];
		$item = $result['item'];
		$change_amount = $result['change_amount'];
		$status = $result['status'];
		$change_amount=number_format($change_amount,2);
		$rec_date = $result['rec_date'];
		
list($rec_year,$rec_month,$rec_day) = explode("-",$rec_date);	
$t_year=($rec_year+543)-2500;		
			if(($M%2) == 0)
			$color="#FFFFC";
			else  	$color="#FFFFFF";

		echo "<Tr bgcolor=$color><Td align='center'>$N</Td> <Td>$rec_day $t_month[$rec_month] $t_year</Td><Td align=left>$doc</Td><Td>$type_name</Td><Td align=left>$item</Td><Td>$budget_status[$status]</Td><Td align='right'>$change_amount</Td><Td align='center'><a href=?option=budget&task=main/change_ex_bud&index=7&id=$id&page=$page&type_id_index=$_REQUEST[type_id_index]><img src=./images/browse.png border='0' alt='รายละเอียด'></a></Td>";
		if($officer==$result['officer']){		
		echo "<Td><div align='center'><a href=?option=budget&task=main/change_ex_bud&index=2&id=$id&page=$page><img src=images/drop.png border='0' alt='ลบ'></a></div></Td>
		<Td align='center'><a href=?option=budget&task=main/change_ex_bud&index=5&id=$id&page=$page><img src=images/edit.png border='0' alt='แก้ไข'></a></div></Td>
	</Tr>";
		}
		else{
		echo "<td>&nbsp;</td><td>&nbsp;</td></Tr>";
		}
$M++;
$N++;  //*เกี่ยวข้องกับการแยกหน้า
	}
echo "</Table>";
}

?>
<script>
function goto_url(val){
	if(val==0){
		callfrm("?option=budget&task=main/change_ex_bud");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.doc.value == ""){
			alert("กรุณากรอกที่เอกสาร");
		}else if(frm1.type_id.value==""){
			alert("กรุณาเลือกประเภทของเงิน");
		}else if(frm1.item.value == ""){
			alert("กรุณากรอกรายการรับเงิน");
		}else if(frm1.status.value == ""){
			alert("กรุณาเลือกลักษณะรายการ");
		}else if(frm1.change_amount.value == ""){
			alert("กรุณากรอกจำนวนเงิน");
		}else{
			callfrm("?option=budget&task=main/change_ex_bud&index=4");   //page ประมวลผล
		}
	}
}

function goto_url_update(val){
	if(val==0){
		callfrm("?option=budget&task=main/change_ex_bud");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.update_date.value == ""){
			alert("กรุณาเลือกวันที่");
		}else if(frm1.update_month.value==""){
			alert("กรุณาเลือกเดือน");
		}else if(frm1.update_year.value==""){
			alert("กรุณากรอกปี");
		}else if(frm1.doc.value==""){
			alert("กรุณากรอกที่เอกสาร");
		}else if(frm1.type_id.value==""){
			alert("กรุณาเลือกประเภทของเงิน");
		}else if(frm1.item.value == ""){
			alert("กรุณากรอกรายการรับเงิน");
		}else if(frm1.status.value == ""){
			alert("กรุณาเลือกลักษณะรายการ");
		}else if(frm1.change_amount.value == ""){
			alert("กรุณากรอกจำนวนเงิน");
		}else{
			callfrm("?option=budget&task=main/change_ex_bud&index=6");   //page ประมวลผล
		}
	}
}
</script>
