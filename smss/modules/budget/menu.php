<?php	
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
//sd page 

$sql_permission = "select * from budget_permission where person_id='$_SESSION[login_user_id]'";
$dbquery_permission = mysql_query($sql_permission);
$result_permission = mysql_fetch_array($dbquery_permission);

if(!isset($_SESSION['admin_budget'])){
$_SESSION['admin_budget']="";
}
	
echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>";
echo "<tr bgcolor='#FFCC00'><td>";
echo "<ul id='nav' class='dropdown dropdown-horizontal'>";
	echo "<li><a href='./'>รายการหลัก</a></li>";
if($_SESSION['admin_budget']=="budget"){
	echo "<li><a href='?option=budget' class='dir'>ตั้งค่าระบบ</a>";
		echo "<ul>";
			echo "<li><a href='?option=budget&task=main/budget_year'>ปีงบประมาณ</a></li>";
			echo "<li><a href='?option=budget&task=category/edit_category'>ประเภท(หลัก)ของเงิน</a></li>";
			echo "<li><a href='?option=budget&task=category/edit_type'>ประเภท(ย่อย)ของเงิน</a></li>";
			echo "<li><a href='?option=budget&task=category/pay_type'>รายการจ่าย</a></li>";
			echo "<li><a href='?option=budget&task=main/permission'>เจ้าหน้าที่การเงินฯ</a></li>";
		echo "</ul>";
	echo "</li>";
}	
if($_SESSION['login_status']<=4 and $result_permission['p1']==1){	
	echo "<li><a href='?option=budget' class='dir'>ทะเบียนรับเงิน</a>";
		echo "<ul>";
			echo "<li><a href='?option=budget&task=main/receive_ex_bud'>เงินนอกงบประมาณ</a></li>";
			echo "<li><a href='?option=budget&task=main/receive_income_bud'>เงินรายได้แผ่นดิน</a></li>";
			echo "<li><a href='?option=budget&task=main/receive_bud'>รับแจ้งการจัดสรรงบประมาณ</a></li>";
		echo "</ul>";
	echo "</li>";
} 
if($_SESSION['login_status']<=4 and $result_permission['p2']==1){	
	echo "<li><a href='?option=budget' class='dir'>ขอเบิก/ขอยืมเงิน</a>";
		echo "<ul>";
			echo "<li><a href='?option=budget&task=main/withdraw'>ทะเบียนขอเบิก/ขอยืมเงิน</a></li>";
			echo "<li><a href='?option=budget&task=main/return_withdraw'>คืนเงินโครงการ</a></li>";
		echo "</ul>";
	echo "</li>";
}	
if($_SESSION['login_status']<=4 and $result_permission['p3']==1){	
	echo "<li><a href='?option=budget' class='dir'>ทะเบียนจ่ายเงิน</a>";
		echo "<ul>";
			echo "<li><a href='?option=budget&task=main/pay_ex_bud'>เงินนอกงบประมาณ</a></li>";
			echo "<li><a href='?option=budget&task=main/pay_income_bud'>เงินรายได้แผ่นดิน</a></li>";
			echo "<li><a href='?option=budget&task=main/pay_bud'>เงินงบประมาณที่ได้รับจัดสรร</a></li>";
		echo "</ul>";
	echo "</li>";
}
if($_SESSION['login_status']<=4 and $result_permission['p4']==1){	
	echo "<li><a href='?option=budget' class='dir'>เปลี่ยนแปลงสถานะ</a>";
		echo "<ul>";
			echo "<li><a href='?option=budget&task=main/change_ex_bud'>เงินนอกงบประมาณ</a></li>";
			echo "<li><a href='?option=budget&task=main/change_income_bud'>เงินรายได้แผ่นดิน</a></li>";
		echo "</ul>";
	echo "</li>";
}
if($_SESSION['login_status']<=4){	
	echo "<li><a href='?option=budget' class='dir'>รายงาน</a>";
		echo "<ul>";
			echo "<li><a href='?option=budget&task=main/report_1'>รายงานการใช้จ่ายจำแนกตามโครงการ</a></li>";
			if($_SESSION['login_status']<=3 or $result_permission['p1']==1 or $result_permission['p2']==1 or $result_permission['p3']==1 or $result_permission['p4']==1 ){
			echo "<li><a href='?option=budget&task=main/today_report'>รายงานเงินคงเหลือประจำวัน</a></li>";	
			echo "<li><a href='?option=budget&task=main/today_bud_report'>รายงานเงินคงเหลือประจำวัน เงินงบประมาณที่ได้รับจัดสรร</a></li>";		
			echo "<li><a href='?option=budget&task=main/cash_book'>สมุดเงินสด</a></li>";
			echo "<li><a href='?option=budget&task=main/ex_bud_book'>รายงานเงินนอกงบประมาณ</a></li>";
			echo "<li><a href='?option=budget&task=main/income_bud_book'>รายงานเงินรายได้แผ่นดิน</a></li>";
			echo "<li><a href='?option=budget&task=main/bud_book'>รายงานเงินงบประมาณที่ได้รับจัดสรร</a></li>";
			echo "<li><a href='?option=budget&task=main/report_5'>รายงานการใช้จ่ายจำแนกตามประเภทรายการจ่าย</a></li>";
			}
		echo "</ul>";
	echo "</li>";
}	

	echo "<li><a href='?option=budget' class='dir'>คู่มือ</a>";
		echo "<ul>";
			echo "<li><a href='?option=budget&task=manual/manual_list'>คู่มือการเงินและบัญชี</a></li>";
		echo "</ul>";
	echo "</li>";
echo "</ul>";
?>
</td></tr>
</table>