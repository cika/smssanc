<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );

//ปีงบประมาณ
$sql = "select * from  budget_year where year_active='1' order by budget_year desc limit 1";
$dbquery = mysql_db_query($dbname, $sql);
$year_active_result = mysql_fetch_array($dbquery);
if($year_active_result[budget_year]==""){
echo "<br />";
echo "<div align='center'>ยังไม่ได้กำหนดทำงานในปีงบประมาณใด ๆ  กรุณาไปที่เมนูตั้งค่าระบบ เพื่อกำหนดปีงบประมาณ</div>";
exit();
}

$sql = "select  * from  budget_receive order by  num desc ";
$dbquery = mysql_db_query($dbname, $sql);
$result = mysql_fetch_array($dbquery);
$num= $result[num];
$num = $num+1;
echo "<br />";
echo "<form id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font Size=4><B>เพิ่มข้อมูลการโอนเปลียนแปลงการจัดสรรงบประมาณรายจ่าย</B></Font>";
echo "</Cener>";
echo "<Br><Br>";
echo "<Table width='85%' Border='0' Bgcolor='#Fcf9d8'>";
echo "<Tr><Td align='right'>เลขที่ใบงวด&nbsp;&nbsp;</Td><Td align='left'><Input Type='Text' Name='num' id='num' Size=3 maxlength=3 value=$num onkeydown='digitOnly()'></Td></Tr>";
echo "<Tr><Td align='right'>หนังสือเลขที่&nbsp;&nbsp;</Td><Td align='left'><Input Type='Text' Name='book_number' Size=20></Td></Tr>";
echo "<Tr><Td align='right'>ลงวันที่&nbsp;&nbsp;</Td><Td align='left'><Input Type='Text' Name='out_date' Size='20'></Td></Tr>";
echo "<Tr><Td align='right'>อ้างถึงหนังสือจัดสรร&nbsp;&nbsp;</Td><Td align='left'><Input Type='Text'  Name='book_ref' Size='20'></Td></Tr>";
echo   "<tr><td align='right'>ผลผลิต/โครงการ&nbsp;&nbsp;</td>";
echo   "<td align='left'><Select name='project' size=1>"; 
echo  "<option  value = ''>เลือก</option>" ;
$sql = "select  * from  budget_project where budget_year='$year_active_result[budget_year]' order by code";
$dbquery = mysql_db_query($dbname, $sql);
While ($result = mysql_fetch_array($dbquery))
   {
		$code = $result['code'];
		$name = $result['name'];
		$name=substr($name,0,180);
		echo  "<option value = $code>$code $name</option>" ;
	}
echo "</select>";
echo "</td></tr>";

echo   "<tr><td align='right'>กิจกรรมหลัก&nbsp;&nbsp;</td>";
echo   "<td><div align='left'><Select name='activity' size='1'>"; 
echo  "<option  value = ''>เลือก</option>" ;
$sql = "select  * from  budget_key_activity where budget_year='$year_active_result[budget_year]' order by code";
$dbquery = mysql_db_query($dbname, $sql);
While ($result = mysql_fetch_array($dbquery))
   {
		$code = $result['code'];
		$name = $result['name'];
		$name=substr($name,0,180);
		echo  "<option value = $code>$code $name</option>" ;
	}
echo "</select>";
echo "</div></td></tr>";

echo   "<tr><td  align='right'>กิจกรรมหลักเพิ่มเติม&nbsp;&nbsp;</td>";
echo   "<td><div align=left><textarea  name='activity2' cols='40' rows='2'></textarea></div></td></tr>";

echo   "<tr><td align='right'>แหล่งของเงิน&nbsp;&nbsp;</td>";
echo   "<td><div align='left'><Select name='budget_m_source' size='1'>"; 
echo  "<option  value = ''>เลือก</option>" ;
$sql = "select  * from  budget_money_source where budget_year='$year_active_result[budget_year]' order by code";
$dbquery = mysql_db_query($dbname, $sql);
While ($result = mysql_fetch_array($dbquery))
   {
		$code = $result['code'];
		$name = $result['name'];
		$name=substr($name,0,150);
		echo  "<option value = $code>$code $name</option>" ;
	}
echo "</select>";
echo "</div></td></tr>";

echo "<Tr><Td align='right'>รหัสทางบัญชี&nbsp;&nbsp;</Td><Td align='left'><Input Type='Text' Name='account' Size='20'></Td></Tr>";

echo   "<tr><td align='right'>งบรายจ่าย&nbsp;&nbsp;</td>";
echo   "<td><div align=left><Select name='m_pay' size='1'>"; 
echo  "<option  value = ''>เลือก</option>" ;
$sql = "select  * from  budget_pay_group order by code";
$dbquery = mysql_db_query($dbname, $sql);
While ($result = mysql_fetch_array($dbquery))
   {
		$code = $result['code'];
		$name = $result['name'];
		echo  "<option value = $code>$code $name</option>" ;
	}
echo "</select>";
echo "</div></td></tr>";

echo "<Tr><Td align='right'>รายการ&nbsp;&nbsp;</Td><Td align='left'><Input Type='Tex't Name='item' Size='40'></Td></Tr>";
echo   "<tr><td align='right'>รายละเอียด&nbsp;&nbsp;</td>";
echo   "<td><div align=left><textarea  name='detail' cols='40' rows='4'></textarea></div></td></tr>";
echo "<Tr><Td align='right'>จำนวนเงิน&nbsp;&nbsp;</Td><Td align='left'><Input Type='Text' Name='money' Size='10' onkeydown='digitOnly()'></Td></Tr>";
echo "</Table>";
echo "<Br>";
echo "<INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url(1)' class=entrybutton>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ย้อนกลับ' onclick='goto_url(0)' class=entrybutton'>";
echo "</Form>";
?>
<script>
function goto_url(val){
	if(val==0){
	callfrm("?option=budget&task=budget_unit/receive");   // page ย้อนกลับ 
	}else if(val==1){
	if(frm1.num.value == ""){
		alert("กรุณากรอกเลขที่ใบงวด");
		}else if(frm1.project.value==""){
			alert("กรุณาเลือกผลผลิต/โครงการ");
		}else if(frm1.activity.value==""){
			alert("กรุณาเลือกกิจกรรมหลัก");
		}else if(frm1.budget_m_source.value==""){
			alert("กรุณาเลือกแหล่งของเงิน");
		}else if(frm1.account.value== ""){
			alert("กรุณากรอกรหัสทางบัญชี");
		}else if(frm1.m_pay.value== ""){
			alert("กรุณาเลือกงบรายจ่าย");
		}else if(frm1.item.value== ""){
			alert("กรุณากรอกรายการ");			
		}else if(frm1.money.value== ""){
			alert("กรุณากรอกจำนวนเงิน");
	}else{
			callfrm("?option=budget&task=budget_unit/receive&index=1");   //page ประมวลผล
		}
	}
}
</script>