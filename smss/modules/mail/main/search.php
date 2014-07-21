<?php 
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
if(!($_SESSION['login_status']<=4)){
exit();
}
require_once "modules/mail/time_inc.php";	
$user=$_SESSION['login_user_id'];

//ส่วนหัว
echo "<br />";
if(!($index==4)){

echo "<table width='100%' border='0' align='center'>";
echo "<tr align='center'><td><font color='#006666' size='3'><strong>ทะเบียนรับจดหมาย</strong></font></td></tr>";
echo "</table>";
}

//ส่วนแสดงรายละเอียด
if($index==4){
$day_now=date("Y-m-d H:i:s");

$query_receive =mysql_query("select * from mail_sendto_answer where ref_id='$_GET[id]' and send_to='$user' and answer='0' ");
$receive_num=mysql_num_rows($query_receive);
		
		if($receive_num>=1){
		$sql = "update mail_sendto_answer set answer='1', 
		answer_time='$day_now'
		where ref_id='$_GET[id]' and send_to='$user' ";
		mysql_query($sql);
		}

echo "<Br>";
echo "<Table  align='center' width='700' Border='0'>";
				if(($_REQUEST[name_search]=="") and ($_REQUEST[person_id]=="")){
				$return_index="";
				}
				else{
				$return_index=8;
				}
echo "<Tr ><Td align='right'><INPUT TYPE='button' name='smb' value='<<กลับหน้าก่อน' onclick='location.href=\"?option=mail&task=main/search&page=$_GET[page]&name_search=$_REQUEST[name_search]&person_id=$_REQUEST[person_id]&return_index=$return_index\"'></Td></Tr>";
echo "</table>";

$sql = "select * from  mail_main left join person_main on mail_main.sender=person_main.person_id where ref_id='$_GET[id]' ";
$dbquery = mysql_query($sql);
$result = mysql_fetch_array($dbquery);
$ref_id=$result['ref_id'];
$detail=$result['detail'];
$send_date=$result['send_date'];
		$prename=$result['prename'];
		$name= $result['name'];
		$surname = $result['surname'];
		$full_name="$prename$name&nbsp;&nbsp;$surname";

echo "<table border='1' width='700' id='table1' style='border-collapse: collapse' bordercolor='#C0C0C0' align='center'>";
echo "<tr bgcolor='#9900CC'>";
echo "<td colspan='2' height='23' align='left'><font size='2' color='#FFFFFF'>&nbsp;รายละเอียดของจดหมาย</font></td>";
echo "</tr>";
echo "<tr>";
echo "<td width='94' align='right'><font size='2' color='#0000FF'>จาก&nbsp;</font></span></td>";
echo "<td align='left'>$full_name</td></tr>";

echo "<tr>";
echo "<td width='94' align='right'><span lang='th'><font size='2' color='#0000FF'>เรื่อง&nbsp;</font></span></td>";
echo "<td align='left'>&nbsp;<input type='text' name='subject' size='76'   style='background-color: #E7D8EB' value='$result[subject]' readonly> </td>";
echo "</tr>";

echo "<tr>";
echo "<td width='94' align='right' height='47'><span lang='th'><font size='2' color='#0000FF'>ข้อความ&nbsp;</font></span></td>";
echo "<td height='47' align='left'>&nbsp;<textarea rows='10' name='detail' cols='55'  style='background-color: #E6EFE4' readonly>$result[detail]</textarea></td>";
echo "</tr>";

echo "<tr>";
echo "<td width='94' align='right'><font size='2' color='#0000FF'>ไฟล์&nbsp;</font></span></td>";
echo "<td align='left'>";
		$query_file=mysql_query ("SELECT * FROM  mail_filebook WHERE ref_id='$ref_id' ") ;
		$M=1;
		While ($result_file = mysql_fetch_array($query_file)){
		echo  "&nbsp;&nbsp;<a href=modules/mail/upload_files/$result_file[file_name] target='_blank'>$M.$result_file[file_des]</a><br>";
		$M++;
		}
echo "</td></tr>";

echo "</Table>";
} //endindex7

//ส่วนแสดงผล
if(!($index==4)){
			if($_REQUEST[return_index]==8){
			$index=8;
			}
			if ($_REQUEST[switch_index]==1){
			$_REQUEST[person_id]="";
			}
			if($_REQUEST[switch_index]==2){
			$_REQUEST[name_search]="";
			}
//ส่วนของการแยกหน้า
if($index==8 and ($_REQUEST[name_search]!="")){
$sql="select * from mail_main left join mail_sendto_answer on mail_main.ref_id=mail_sendto_answer.ref_id where mail_sendto_answer.send_to='$user'  and mail_main.subject like '%$_REQUEST[name_search]%' ";
}
else if($index==8 and ($_REQUEST[person_id]!="")){
$sql="select * from mail_main left join mail_sendto_answer on mail_main.ref_id=mail_sendto_answer.ref_id where mail_sendto_answer.send_to='$user'  and  mail_main.sender='$_REQUEST[person_id]' ";
}
else{
$sql="select mail_main.ms_id from mail_main left join mail_sendto_answer on mail_main.ref_id=mail_sendto_answer.ref_id where mail_sendto_answer.send_to='$user' ";
}
$dbquery = mysql_query($sql);
$num_rows = mysql_num_rows($dbquery );

$pagelen=20;  // 1_กำหนดแถวต่อหน้า
$url_link="option=mail&task=main/search&index=$index&name_search=$_REQUEST[name_search]&person_id=$_REQUEST[person_id]";  // 2_กำหนดลิงค์ฺ
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

////////////////////ค้นหาบุคคล
echo "<form id='frm1' name='frm1'>";
echo "<table width='95%' align='center'><tr><td align='right'>";
echo "ค้นหาด้วยชื่อเรื่อง&nbsp;";
		if($index==8){
		echo "<Input Type='Text' Name='name_search' value='$_REQUEST[name_search]' >";
		}
		else{
		echo "<Input Type='Text' Name='name_search' Size='30'>";
		}
echo "&nbsp;<INPUT TYPE='button' name='smb'  value='ค้น' onclick='goto_display(1)'>";
echo "&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;";

echo "ค้นหาด้วยชื่อผู้ส่ง&nbsp";
echo "<Select  name='person_id' size='1'>";
echo  '<option value ="" >เลือก</option>' ;
$sql = "select  * from person_main where status='0' order by name";
$dbquery = mysql_query($sql);
While ($result = mysql_fetch_array($dbquery)){
			if($_REQUEST[person_id]==""){
			echo "<option value=$result[person_id]>$result[name]&nbsp;$result[surname]</option>"; 
			}
			else{
					if($_REQUEST[person_id]==$result[person_id]){
					echo "<option value=$result[person_id] selected>$result[name]&nbsp;$result[surname]</option>"; 
					}
					else{
					echo "<option value=$result[person_id]>$result[name]&nbsp;$result[surname]</option>"; 
					}
			}		
}
	echo "</select>";
	echo "&nbsp;<INPUT TYPE='button' name='smb' value='เลือก' onclick='goto_display(2)' class='entrybutton'>";
echo "</td></tr></table>";
echo "</form>";
//////////////////////////////////////////

if($index==8 and ($_REQUEST[name_search]!="")){
$sql="select * from mail_main left join mail_sendto_answer on mail_main.ref_id=mail_sendto_answer.ref_id where mail_sendto_answer.send_to='$user'  and  mail_main.subject like '%$_REQUEST[name_search]%' order by mail_main.ms_id limit $start,$pagelen";
}
else if($index==8 and ($_REQUEST[person_id]!="")){
$sql="select * from mail_main left join mail_sendto_answer on mail_main.ref_id=mail_sendto_answer.ref_id where mail_sendto_answer.send_to='$user'  and  mail_main.sender='$_REQUEST[person_id]' order by mail_main.ms_id limit $start,$pagelen";
}
else{
$sql="select * from mail_main left join mail_sendto_answer on mail_main.ref_id=mail_sendto_answer.ref_id where mail_sendto_answer.send_to='$user' order by mail_main.ms_id limit $start,$pagelen";
}
$dbquery = mysql_query($sql);
echo  "<table width=90% border=0 align=center>";

echo "<Tr bgcolor='#FFCCCC' align='center'><Td width='60'>เลขที่</Td><Td width='150'>จดหมายจาก</Td><Td width='20%'>วันที่ส่ง</Td><Td>เรื่อง</Td><Td width='40'>รับ</Td><Td width='20%'>วันที่รับ</Td></Tr>";

$N=(($page-1)*$pagelen)+1; //*เกี่ยวข้องกับการแยกหน้า
$M=1;

While ($result = mysql_fetch_array($dbquery)){
		$id = $result['ms_id'];
		$subject = $result['subject'];
		$sender = $result['sender'];
		$ref_id = $result['ref_id'];
		$rec_date = $result['send_date'];
		$answer_time=$result['answer_time'];
			if(($M%2) == 0)
			$color="#FFFFB";
			else  	$color="#FFFFFF";
			
		$query_person=mysql_query ("SELECT * FROM  person_main WHERE person_id='$sender' ") ;
		$result_person=mysql_fetch_array($query_person);
		$prename=$result_person['prename'];
		$name= $result_person['name'];
		$surname = $result_person['surname'];
		$full_name="$prename$name&nbsp;&nbsp;$surname";
			
echo "<Tr bgcolor='$color'><Td align='center'>$id</Td><Td align='left'>$full_name</Td><Td align='left'>";
echo thai_date_4($rec_date);
echo "</Td><Td align='left'><a href=?option=mail&task=main/search&index=4&id=$ref_id&page=$page&name_search=$_REQUEST[name_search]&person_id=$_REQUEST[person_id]>$subject</a></Td>";
			if($result['answer']==1){
			echo "<td align='center'><img src=images/yes.png border='0' alt='รับแล้ว'></td>";
			}
			else{
			echo "<td align='center'><img src=images/no.png border='0' alt='ยังไม่ได้รับ'></td>";
			}

echo "<td align='left'>";
if($answer_time>0){
echo thai_date_4($answer_time);
}
echo "</td>";
echo "</Tr>";

$M++;
$N++;  //*เกี่ยวข้องกับการแยกหน้า
}	
echo "</Table>";
}

?>

<script>
function goto_display(val){
	if(val==1){
		callfrm("?option=mail&task=main/search&index=8&switch_index=1"); 
		}
	else if(val==2){
		callfrm("?option=mail&task=main/search&index=8&switch_index=2"); 
		}
}
</script>

