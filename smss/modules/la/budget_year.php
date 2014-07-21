<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
//sd page 

//ส่วนหัว
echo "<br />";
if(!(($index==1) or ($index==2) or ($index==5))){
echo "<table width='50%' border='0' align='center'>";
echo "<tr align='center'><td><font color='#006666' size='3'><strong>กำหนดปีงบประมาณ</strong></font></td></tr>";
echo "</table>";
}

//ส่วนฟอร์มรับข้อมูล
if($index==1){
echo "<form id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>เพิ่มข้อมูลปีงบประมาณ</Font>";
echo "</Cener>";
echo "<Br><Br>";
echo "<Table width='300' Border='0' Bgcolor='#Fcf9d8'>";

echo "<Tr><Td align='right'>ปีงบประมาณ&nbsp;&nbsp;&nbsp;&nbsp;</Td><Td align='left'><Input Type='Text' Name='budget_year' id='budget_year' Size='4' maxlength='4' onkeydown='integerOnly()'></Td></Tr>";
echo "<Tr><Td align='right'>ปีทำงานปัจจุบัน&nbsp;&nbsp;&nbsp;&nbsp;</Td>";
echo "<td><div align='left'><Select  name='year_active' id='year_active' size='1'>";
echo  "<option  value = ''>เลือก</option>" ;
echo  "<option value = '1'>ใช่</option>";
echo  "<option value = '0'>ไม่ใช่</option>";
echo "</select>";
echo "</div></td></tr>";
echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
echo "<tr><td align='right'><INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url(1)' class=entrybutton>
	&nbsp;&nbsp;&nbsp;</td>";
echo "<td align='left'><INPUT TYPE='button' name='back' value='ย้อนกลับ' onclick='goto_url(0)' class=entrybutton'></td></tr>";
echo "</Table>";
echo "</form>";
}

//ส่วนยืนยันการลบข้อมูล
if($index==2) {
echo "<table width='500' border='0' align='center'>";
echo "<tr><td align='center'><font color='#990000' size='4'>โปรดยืนยันความต้องการลบข้อมูลอีกครั้ง</font><br></td></tr>";
echo "<tr><td align=center>";
echo "<INPUT TYPE='button' name='smb' value='ยืนยัน' onclick='location.href=\"?option=la&task=budget_year&index=3&id=$_GET[id]&page=$_REQUEST[page]\"'>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ยกเลิก' onclick='location.href=\"?option=la&task=budget_year&page=$_REQUEST[page]\"'";
echo "</td></tr></table>";
}

//ส่วนลบข้อมูล
if($index==3){
$sql = "delete from la_year where id=$_GET[id]";
$dbquery = mysql_query($sql);
}

//ส่วนบันทึกข้อมูล
if($index==4){
	if($_POST['year_active']=='1'){
	$sql = "update la_year set  year_active='0' ";
	$dbquery = mysql_query($sql);
	}
$rec_date = date("Y-m-d");
$sql = "insert into la_year (budget_year, year_active) values ('$_POST[budget_year]', '$_POST[year_active]')";
$dbquery = mysql_query($sql);
}

//ส่วนฟอร์มแก้ไขข้อมูล
if ($index==5){
echo "<form id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>แก้ไขปีงบประมาณ</B></Font>";
echo "</Cener>";
echo "<Br><Br>";

echo "<Table width='300' Border= '0' Bgcolor='#Fcf9d8'>";

$sql = "select * from la_year where id='$_GET[id]'";
$dbquery = mysql_query($sql);
$ref_result = mysql_fetch_array($dbquery);

echo "<Tr><Td align='right'>ปีงบประมาณ&nbsp;&nbsp;&nbsp;&nbsp;</Td><Td align='left'><Input Type='Text' Name='budget_year' id='budget_year' Size='4' maxlength='4' value='$ref_result[budget_year]' onkeydown='integerOnly()'></Td></Tr>";
echo "<Tr><Td align='right'>ปีทำงานปัจจุบัน&nbsp;&nbsp;&nbsp;&nbsp;</Td>";
echo "<td><div align='left'><Select  name='year_active' id='year_active' size='1'>";
echo  "<option  value = ''>เลือก</option>" ;
	if($ref_result['year_active']==1){
	$select1="selected";
	$select2="";
	}
	else{
	$select1="";
	$select2="selected";
	}
echo  "<option value = '1' $select1>ใช่</option>";
echo  "<option value = '0' $select2>ไม่ใช่</option>";
echo "</select>";
echo "</div></td></tr>";
echo "<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>";
echo "<tr><td align='right'><INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url_update(1)' class=entrybutton>&nbsp;&nbsp;&nbsp;&nbsp;</td>";
echo "<td align='left'><INPUT TYPE='button' name='back' value='ย้อนกลับ' onclick='goto_url_update(0)' class=entrybutton'></td></tr>";
echo "</Table>";
echo "<Br>";
echo "<Input Type=Hidden Name='id' Value='$_GET[id]'>";
echo "<Input Type=Hidden Name='page' Value='$_GET[page]'>";
echo "</form>";
}

//ส่วนปรับปรุงข้อมูล
if ($index==6){
	if($_POST['year_active']=='1'){
	$sql = "update la_year set  year_active='0' ";
	$dbquery = mysql_query($sql);
	}
$sql = "update la_year set  budget_year='$_POST[budget_year]', year_active='$_POST[year_active]' where id='$_POST[id]'";
$dbquery = mysql_query($sql);
}

//ส่วนปรับปรุงปีทำงานปัจจุบัน
if ($index==7){
	if($_GET['year_active']==1){
	$year_active=0;
	}
	else{
	$year_active=1;
	$sql = "update la_year set  year_active='0' ";
	$dbquery = mysql_query($sql);
	}
$sql = "update la_year set  year_active='$year_active' where id='$_GET[id]'";
$dbquery = mysql_query($sql);
}

//ส่วนแสดงผล
if(!(($index==1) or ($index==2) or ($index==5))){
	//ส่วนของการแยกหน้า
$pagelen=20;  // 1_กำหนดแถวต่อหน้า
$url_link="option=la&task=budget_year";  // 2_กำหนดลิงค์ฺ
$sql = "select * from la_year"; // 3_กำหนด sql

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

$sql = "select * from  la_year order by budget_year desc limit $start,$pagelen";
$dbquery = mysql_query($sql);
echo  "<table width=50% border=0 align=center>";
echo "<Tr><Td colspan='5' align='left'><INPUT TYPE='button' name='smb' value='เพิ่มปีงบประมาณ' onclick='location.href=\"?option=la&task=budget_year&index=1\"'</Td></Tr>";

echo "<Tr bgcolor='#FFCCCC'><Td  align='center'>ที่</Td><Td  align='center'>ปีงบประมาณ</Td><Td  align='center'>ปีัทำงานปัจจุบัน</Td><Td  align='center' width='50'>ลบ</Td><Td align='center' width='50'>แก้ไข</Td></Tr>";
$N=(($page-1)*$pagelen)+1;  //*เกี่ยวข้องกับการแยกหน้า
$M=1;
While ($result = mysql_fetch_array($dbquery))
	{
		$id = $result['id'];
		$budget_year= $result['budget_year'];
		$year_active = $result['year_active'];
		if($year_active==1){
		$active_pic="<img src=images/yes.png border='0' alt='ปีทำงานปัจจุบัน'>";
		}
		else{
		$active_pic="<img src=images/no.png border='0' alt='ไม่ใช่ปีทำงานปัจจุบัน'>";
		}
		
			if(($M%2) == 0)
			$color="#FFFFC";
			else  	$color="#FFFFFF";

		echo "<Tr bgcolor=$color><Td align='center' width='50'>$N</Td><Td  align='center'>$budget_year</Td><Td align='center'><a href=?option=la&task=budget_year&index=7&id=$id&year_active=$year_active&page=$page>$active_pic</a></Td>
		<Td align='center'><a href=?option=la&task=budget_year&index=2&id=$id&page=$page><img src=images/drop.png border='0' alt='ลบ'></a></a></Td>
		<Td align='center'><a href=?option=la&task=budget_year&index=5&id=$id&page=$page><img src=images/edit.png border='0' alt='แก้ไข'></a></Td>
	</Tr>";
$M++;
$N++;  //*เกี่ยวข้องกับการแยกหน้า
	}
echo "</Table>";
}

?>
<script>
function goto_url(val){
	if(val==0){
		callfrm("?option=la&task=budget_year");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.budget_year.value == ""){
			alert("กรุณากรอกปีงบประมาณ");
		}else if(frm1.year_active.value==""){
			alert("กรุณาเลือกปีทำงานปัจจุบัน");
		}else{
			callfrm("?option=la&task=budget_year&index=4");   //page ประมวลผล
		}
	}
}

function goto_url_update(val){
	if(val==0){
		callfrm("?option=la&task=budget_year");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.budget_year.value == ""){
			alert("กรุณากรอกปีงบประมาณ");
		}else if(frm1.year_active.value==""){
			alert("กรุณาเลือกปีทำงานปัจจุบัน");
		}else{
			callfrm("?option=la&task=budget_year&index=6");   //page ประมวลผล
		}
	}
}
</script>
