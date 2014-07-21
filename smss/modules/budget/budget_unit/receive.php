<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
//sd page 
$officer=$_SESSION['login_user_id'];
?>

<br />
<table width="90%" border="0" align="center">
  <tr>
    <td><div align="center">
        <p><font color="#006666" size="5"><strong><font size="4">ทะเบียนโอนการเปลี่ยนแปลงการจัดสรรงบประมาณ</font></strong></font></p>
      </div></td>
  </tr>
</table>

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

//ปีงบประมาณ
$sql = "select * from  budget_year where year_active='1' order by budget_year desc limit 1";
$dbquery = mysql_db_query($dbname, $sql);
$year_active_result = mysql_fetch_array($dbquery);
if($year_active_result[budget_year]==""){
echo "<br />";
echo "<div align='center'>ยังไม่ได้กำหนดทำงานในปีงบประมาณใด ๆ  กรุณาไปที่เมนูตั้งค่าระบบ เพื่อกำหนดปีงบประมาณ</div>";
exit();
}

//ส่วนการเพิ่มข้อมูล
if($index==1){
$rec_date = date("Y-m-d");
$sql = "insert  into  budget_receive (num, budget_year, book_number, out_date, book_ref,project, activity, activity2, m_source,  account, m_pay, item, detail, money, rec_date,officer)
 values ('$_POST[num]', '$year_active_result[budget_year]', '$_POST[book_number]', '$_POST[out_date]', '$_POST[book_ref]','$_POST[project]', '$_POST[activity]',  '$_POST[activity2]', '$_POST[budget_m_source]', '$_POST[account]', '$_POST[m_pay]', '$_POST[item]', '$_POST[detail]', '$_POST[money]', '$rec_date', '$officer')";
$dbquery = mysql_db_query($dbname, $sql);
}

//ส่วนยืนยันการลบข้อมูล
if($index==2) {
$page=$_REQUEST['page'];
echo "<table width='500' border='0' align='center'>";
echo "<tr><td align='center'><font color='#990000' size='4'>โปรดยืนยันความต้องการลบข้อมูลอีกครั้ง</font><br></td></tr>";
echo "<tr><td align=center>";
echo "<INPUT TYPE='button' name='smb' value='ยืนยัน' onclick='location.href=\"?option=budget&task=budget_unit/receive&index=3&id=$_GET[id]&page=$page\"'>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ยกเลิก' onclick='location.href=\"?option=budget&task=budget_unit/receive&page=$page\"'";
echo "</td></tr></table>";
}

//ส่วนการลบข้อมูล 
if($index==3)
{
$sql = "delete  from budget_receive  where  id='$_GET[id]'";
$dbquery  =  mysql_db_query($dbname, $sql);
}

//ส่วนการปรับปรุงข้อมูล
if ($index==3)
{
$sql = "update budget_receive  set  id = '$_POST[id]' , 
book_number = '$_POST[book_number]' , 
out_date = '$_POST[out_date]' , 
book_ref = '$_POST[book_ref]' , 
project = '$_POST[project]' , 
activity = '$_POST[activity]' , 
activity2 = '$_POST[activity2]' , 
m_source = '$_POST[budget_m_source]' , 
account = '$_POST[account]' , 
m_pay = '$_POST[m_pay]' , 
item = '$_POST[item]' , 
detail = '$_POST[detail]' , 
money = '$_POST[money]',
rec_date = '$_POST[rec_date]'
where id='$_POST[id]'";
$dbquery = mysql_db_query($dbname, $sql);
}

//ส่วนแสดงผล
if(!($index==2)){

//ส่วนของการคำนวณ
$receive_total=0; //iวมรับ
$sql="select * from budget_receive where budget_year='$year_active_result[budget_year]' order by num";
$dbquery = mysql_db_query($dbname, $sql);
$num_rows = mysql_num_rows($dbquery );  //นำไปแยกหน้า
While ($result = mysql_fetch_array($dbquery)) {
$receive_total=$receive_total+$result['money'];
$receive_total_ar[$result['id']]=$receive_total;   //รวมรับ รายรายการ
}

	//ส่วนของการแยกหน้า
$pagelen=20; // 1.กำหนดแถวต่อหน้า
$url_link="option=budget&task=budget_unit/receive";  //2.กำหนด url เพจ 
$totalpages=ceil($num_rows/$pagelen);

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

$sql = "select * from budget_receive where budget_year='$year_active_result[budget_year]' order by num limit $start,$pagelen ";
$dbquery = mysql_db_query($dbname, $sql);
$num_effect = mysql_num_rows($dbquery );  // จำนวนข้อมูลในหน้านี้
echo  "<table width=85% border=0 align=center>";
echo "<Tr><Td colspan='5' align='left'><INPUT TYPE='button' name='smb' value='เพิ่มรายการ' onclick='location.href=\"?option=budget&task=budget_unit/receive_form&index=1\"'</Td></Tr>";

echo "<Tr bgcolor=#FFCCCC align=center class=style2><Td width='50'>เลขที่</Td><Td width='70'>วดป</Td><Td>รายการ</Td><Td width='100'>จำนวนเงิน</Td><Td width='50' align=center>รายละเอียด</td><td width='40' align=center>ลบ</td><td width='40' align=center>แก้ไข</Td><Td width='40'>รวม</Td></Tr>";
$N=(($page-1)*$pagelen)+1;  //*เกี่ยวข้องกับการแยกหน้า
$M=1;
While ($result = mysql_fetch_array($dbquery))
	{
		$id = $result['id'];
		$num= $result['num'];
		$item= $result['item'];
		$money= $result['money'];
		$money=number_format($money,2);
		$rec_date=$result['rec_date'];

		if(($M%2) == 0)
		$color="#FFFFC";
		else  	$color="#FFFFFF";
		list($rec_year,$rec_month,$rec_day) = explode("-",$rec_date);	
		$t_year=($rec_year+543)-2500;		
		
		echo "<Tr  bgcolor=$color  align=center><Td align>$num</Td><Td align='left'>$rec_day $t_month[$rec_month] $t_year</Td><Td align=left>";
		if($officer==$result['officer']){
		echo $item;		
		}
		else {
		echo $item." <img src=./images/dangerous.png border='0' alt='รายการนี้เป็นของเจ้าหน้าที่คนอื่น'>";
		}
		echo "</Td><Td align=right>$money</Td>
		<Td><div align=center><a href=?option=budget&task=budget_unit/receive_detail&id=$id&page=$page><img src=./images/browse.png border='0' alt='รายละเอียด'></a></td>";
		if($officer==$result['officer']){
		echo "<Td><div align=center><a href=?option=budget&task=budget_unit/receive&id=$id&index=2&page=$page><img src=./images/drop.png border='0' alt='ลบ'></a></td>
		<Td><div align=center><a href=?option=budget&task=budget_unit/edit_receive_form&id=$id&page=$page><img src=./images/edit.png border='0' alt='แก้ไข'></a></Td>";
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
		if($_GET['cal_id']==$id){
		echo "<Td align='center'><a href=?option=budget&task=budget_unit/receive&page=$page>$tungnee</a></Td>";
		echo "</Tr>";
		break;  //ออกจากloop
		}
		else {
		echo "<Td align='center'><a href=?option=budget&task=budget_unit/receive&cal_id=$id&page=$page>ถึงนี้</a></Td>";
		echo "</Tr>";
		}		
$M++;
$N++; //*เกี่ยวข้องกับการแยกหน้า
	}
//สรุป
if(isset($id)){
$receive_item_total=number_format($receive_total_ar[$id],2);	
}
else{
$receive_item_total="";
}
echo "<Tr bgcolor='#FFCCCC'><Td colspan='2'></Td><Td align='center'>รวม</Td><Td align='center'>$receive_item_total</Td><Td colspan='4'></Td></Tr>";
echo "</Table>";
}
//จบส่วนแสดงผล

?>
