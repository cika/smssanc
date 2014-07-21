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

if(isset($_REQUEST['year_index'])){
$year_index=$_REQUEST['year_index'];
}
else{
$year_index="";
}
//กรณีเลือกปี
if($year_index!=""){
$year_active_result['budget_year']=$year_index;
}

//ส่วนหัว
echo "<br />";
echo "<div align='center'>";
echo "<font color='#006666' size='3'><strong>รายงานเงินงบประมาณที่ได้รับจัดสรร </strong></font><br />";
echo "<font  color='#006666' size='3'>$_SESSION[school_name]</font>";
echo "</div>";

//ส่วนแสดงผล

	//ส่วนของการคำนวณ
$balance_tank=0;  //เงินคงเหลือ
$receive_total=0; //iวมรับ
$pay_total=0; //รวมจ่าย
 
if($_REQUEST['type_id_index']!=""){
$sql= "select * from  budget_bud where  budget_year='$year_active_result[budget_year]' and (id='$_REQUEST[type_id_index]' or bud_type_id='$_REQUEST[type_id_index]') order by rec_date, id";
}
else {
$sql = "select  * from budget_bud where budget_year='$year_active_result[budget_year]' order by rec_date, id";
}
$dbquery = mysql_query($sql);
$num_rows = mysql_num_rows($dbquery );  // นำตัวแปรไปใช้ในส่วนของการแยกหน้า
While ($result = mysql_fetch_array($dbquery)) {
				if($result['status']==1){
				$balance_tank=$balance_tank+$result['receive_amount'];
				$receive_total=$receive_total+$result['receive_amount'];
				}	
				else if($result['status']==2){
				$balance_tank=$balance_tank-$result['pay_amount'];
				$pay_total=$pay_total+$result['pay_amount'];
				}
		$balance_tank_ar[$result['id']]=$balance_tank;  //คงเหลือ  รายรายการ
		$receive_total_ar[$result['id']]=$receive_total;  //รวมรับ  รายรายการ
		$pay_total_ar[$result['id']]=$pay_total;   //รวมจ่าย  รายรายการ
}

	//ส่วนของการแยกหน้า
$pagelen=20;  // 1_กำหนดแถวต่อหน้า
$url_link="option=budget&task=main/bud_book";  // 2_กำหนดลิงค์ฺ
$dbquery = mysql_query($sql);
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
					echo "<a href=$PHP_SELF?$url_link&page=$i&type_id_index=$_REQUEST[type_id_index]&year_index=$_REQUEST[year_index]>[$i]</a>";
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
			echo "<<a href=$PHP_SELF?$url_link&page=1&type_id_index=$_REQUEST[type_id_index]&year_index=$_REQUEST[year_index]>หน้าแรก </a>";
			echo "<<<a href=$PHP_SELF?$url_link&page=$f_page1&type_id_index=$_REQUEST[type_id_index]&year_index=$_REQUEST[year_index]>หน้าก่อน </a>";
			}
			else {
			echo "หน้า	";
			}					
			for($i=$s_page; $i<=$e_page; $i++){
					if($i==$page){
					echo "[<b><font size=+1 color=#990000>$i</font></b>]";
					}
					else {
					echo "<a href=$PHP_SELF?$url_link&page=$i&type_id_index=$_REQUEST[type_id_index]&year_index=$_REQUEST[year_index]>[$i]</a>";
					}
			}
			if($page<$totalpages)	{
			$f_page2=$page+1;
			echo "<a href=$PHP_SELF?$url_link&page=$f_page2&type_id_index=$_REQUEST[type_id_index]&year_index=$_REQUEST[year_index]> หน้าถัดไป</a>>>";
			echo "<a href=$PHP_SELF?$url_link&page=$totalpages&type_id_index=$_REQUEST[type_id_index]&year_index=$_REQUEST[year_index]> หน้าสุดท้าย</a>>";
			}
			echo " <select onchange=\"location.href=this.options[this.selectedIndex].value;\" size=\"1\" name=\"select\">";
			echo "<option  value=\"\">หน้า</option>";
				for($p=1;$p<=$totalpages;$p++){
				echo "<option  value=\"?$url_link&page=$p&type_id_index=$_REQUEST[type_id_index]&year_index=$_REQUEST[year_index]\">$p</option>";
				}
			echo "</select>";
echo "</div>";  
}					
//จบแยกหน้า

	//เลืิอกประเภท
	echo  "<table width='90%' border='0' align='center'>";
	echo "<tr><td align='right'>";
	echo "<form id='frm1' name='frm1'>";
	echo "ปีงบประมาณ&nbsp";
	echo "<Select  name='year_index' size='1'>";
	echo  '<option value ="" >เลือก</option>' ;
	$sql_year = "SELECT *  FROM  budget_year order by budget_year";
	$dbquery_year = mysql_query($sql_year);
	While ($result_year = mysql_fetch_array($dbquery_year)){
			 if($year_index==""){
					if($result_year['year_active']==1){
					echo "<option value=$result_year[budget_year]  selected>$result_year[budget_year]</option>"; 
					}
					else{
					echo "<option value=$result_year[budget_year]>$result_year[budget_year]</option>"; 
					}
			 }
			 else{
					if($year_index==$result_year['budget_year']){
					echo "<option value=$result_year[budget_year]  selected>$result_year[budget_year]</option>"; 
					}
					else{
					echo "<option value=$result_year[budget_year]>$result_year[budget_year]</option>"; 
					}
			}	
	}
echo "</select>&nbsp;";		
		
		echo "<Select  name='type_id_index' size='1'>";
		echo  "<option  value = ''>ทุกรายการจัดสรร</option>" ;
		$sql = "select  id, item from  budget_bud where status='1' and budget_year='$year_active_result[budget_year]' order by item ";
		$dbquery = mysql_query($sql);
		While ($result = mysql_fetch_array($dbquery))
		   {
		$item_name = $result['item'];
				if($result['id']==$_REQUEST['type_id_index']){
				$select="selected";
				}
				else{
				$select="";
				}
		echo  "<option value = $result[id] $select>$item_name</option>";
			}
		echo "</select>";
			
		echo "&nbsp;<INPUT TYPE='button' name='smb' value='เลือก' onclick='goto_url(1)' class=entrybutton>";
		echo "</form>";
		echo "</td></Tr></Table>";
		//จบส่วนเลือกประเภท


if($_REQUEST['type_id_index']!=""){
$sql= "select * from  budget_bud where  budget_year='$year_active_result[budget_year]' and (id='$_REQUEST[type_id_index]' or bud_type_id='$_REQUEST[type_id_index]') order by rec_date, id  limit $start,$pagelen";
}
else{
$sql= "select * from  budget_bud where  budget_year='$year_active_result[budget_year]' order by rec_date, id  limit $start,$pagelen";
}
$dbquery = mysql_query($sql);
$num_effect = mysql_num_rows($dbquery );  // จำนวนข้อมูลในหน้านี้
echo  "<table width='90%' border=0 align=center>";
echo "<tr bgcolor='#FFCCCC' align='center'>
    <td width='50'>ที่</td>
    <td width='80'>วดป</td>
    <td width='120'>ที่เอกสาร</td>
    <td>รายการ</td>
    <td width='120'>รับแจ้งจัดสรร</td>
    <td width='120'>ขอเบิก</td>
    <td width='120'>คงเหลือ</td>
	<td width='35'>รวม</td>
  </tr>";

$N=(($page-1)*$pagelen)+1;  //*เกี่ยวข้องกับการแยกหน้า
$M=1;

While ($result = mysql_fetch_array($dbquery))
	{
		$id_num = $result['id'];
		$doc= $result['doc'];
		$item = $result['item'];
		$receive_amount = $result['receive_amount'];
				if($receive_amount>0){
				$receive_amount=number_format($receive_amount,2);
				}
		$pay_amount = $result['pay_amount'];
				if($pay_amount>0){
				$pay_amount=number_format($pay_amount,2);		
				}
		$status = $result['status'];
		$rec_date = $result['rec_date'];
		
list($rec_year,$rec_month,$rec_day) = explode("-",$rec_date);	
$t_year=($rec_year+543)-2500;		
			if(($M%2) == 0)
			$color="#FFFFB";
			else  	$color="#FFFFFF";
			
$balance_tank_ar_display=number_format($balance_tank_ar[$id_num],2);		

echo "<Tr bgcolor=$color><Td align='center'>$N</Td> <Td>$rec_day $t_month[$rec_month] $t_year</Td><Td align=left>$doc</Td><Td align=left>$item</Td><td align='right'>$receive_amount</td><td align='right'>$pay_amount</td><td align='right'>$balance_tank_ar_display</td>";
		
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
		if($_GET['cal_id']==$id_num){
		echo "<Td align=center><a href=?option=budget&task=main/bud_book&page=$page&type_id_index=$_REQUEST[type_id_index]&year_index=$year_active_result[budget_year]>$tungnee</a></Td>	</Tr>";
		break; //ออกจากloop
		}
		else {
		echo "<Td align=center><a href=?option=budget&task=main/bud_book&cal_id=$id_num&page=$page&type_id_index=$_REQUEST[type_id_index]&year_index=$year_active_result[budget_year]>ถึงนี้</a></Td>	</Tr>";
		}
//ออกจากloop
if(isset($_GET['id'])){
	if($_GET['id']==$id_num){
	break;
	}
}	

$M++;
$N++;  //*เกี่ยวข้องกับการแยกหน้า
	}
	
//สรุป
if(!isset($_GET['id'])){
$_GET['id']="";
}

if($_GET['id']!=""){
$cal_index=$_GET['id'];
}
else if(isset($id_num)){
$cal_index=$id_num;
}
if(isset($id_num)){
$receive_item_total=number_format($receive_total_ar[$cal_index],2);	
$pay_item_total=number_format($pay_total_ar[$cal_index],2);	
$balance_item_total=number_format($balance_tank_ar[$cal_index],2);	
echo "<Tr bgcolor='#FFCCCC'><td></td><td></td><td></td><Td align='center'>รวม</Td><td align='center'>$receive_item_total</td><td align='center'>$pay_item_total</td><td align='center'>$balance_item_total</td><td></td></Tr>";
}
echo "</Table>";

?>
<script>
function goto_url(val){
	if(val==0){
		callfrm("?option=budget&task=main/bud_book");   // page ย้อนกลับ 
	}else if(val==1){
			callfrm("?option=budget&task=main/bud_book");   //page ประมวลผล
		}
}

</script>
