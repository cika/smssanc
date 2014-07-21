<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
//sd page 
$user=$_SESSION['login_user_id'];
if(!isset($_REQUEST['name_search'])){
$_REQUEST['name_search']="";
}

echo "<br />";

echo "<table width='50%' border='0' align='center'>";
echo "<tr align='center'><td><font color='#006666' size='3'><strong>ค้นหาเอกสาร</strong></font></td></tr>";
echo "</table>";

//ส่วนของการแยกหน้า
$pagelen=20;  // 1_กำหนดแถวต่อหน้า
$url_link="option=cabinet&task=main/search_document&name_search=$_REQUEST[name_search]";  // 2_กำหนดลิงค์ฺ
$sql = "select * from  cabinet_main  where  doc_subject  like '%$_REQUEST[name_search]%' or doc_type  like '%$_REQUEST[name_search]%' "; // 3_กำหนด sql

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
$sql_cabinet = "select * from  cabinet_cabinet";
$dbquery_cabinet = mysql_query($sql_cabinet);
While ($result_cabinet  = mysql_fetch_array($dbquery_cabinet)){
$cabinet_ar[$result_cabinet['cabinet_id']]=$result_cabinet['cabinet_name'];
}

////////////////////
echo "<form id='frm1' name='frm1'>";
echo "<table width='95%' align='center'><tr><td align='right'>";
echo "ค้นหาด้วยชื่อเอกสารหรือประเภทเอกสาร&nbsp;";
echo "<Input Type='Text' Name='name_search' value='$_REQUEST[name_search]' >";
echo "&nbsp;<INPUT TYPE='button' name='smb'  value='ค้น' onclick='goto_display(1)'>";
echo "</td></tr></table>";
echo "</form>";
//////////////////////////////////////////

$sql = "select cabinet_main.id, cabinet_main.cabinet_id, cabinet_main.doc_subject, cabinet_main.doc_type, cabinet_main.doc_size,  cabinet_main.doc_name,  cabinet_main.status, cabinet_main.person_id, cabinet_main.rec_date, person_main.name, person_main.surname  from cabinet_main left join person_main on cabinet_main.person_id=person_main.person_id  where  cabinet_main.doc_subject  like '%$_REQUEST[name_search]%' or cabinet_main.doc_type like '%$_REQUEST[name_search]%' order by cabinet_main.doc_subject limit $start,$pagelen";
$dbquery = mysql_query($sql);

echo  "<table width='95%' border='0' align='center'>";
echo "<Tr bgcolor='#FFCCCC' align='center' ><Td width='70'>ที่</Td><Td>ชื่อเอกสาร</Td><Td width='80'>ประเภท</Td><Td width='100'>ขนาด (KB)</Td><Td>ตู้</Td><Td width='140'>ผู้เก็บเอกสาร</Td><Td width='140'>วดป</Td></Tr>";
$N=(($page-1)*$pagelen)+1;  //*เกี่ยวข้องกับการแยกหน้า
$M=1;
While ($result = mysql_fetch_array($dbquery)){
$doc_size=ceil($result['doc_size']/1024);
			if(($M%2) == 0)
			$color="#FFFFC";
			else  	$color="#FFFFFF";
			
			if($result['status']==1){
			$no_publish="&nbsp;&nbsp;&nbsp;(<img src=images/publish_x.png border='0'>เอกสารไม่เผยแพร่)";			
			}
			else{
			$no_publish="";			
			}
			
echo "<Tr bgcolor=$color><Td align='center'>$N</Td>";
			if(($result['status']==1) and ($result['person_id']==$user)){
			echo "<Td><a href=modules/cabinet/upload_files/$result[doc_name] target='_blank'>$result[doc_subject]</a>$no_publish</Td>";
			}
			else if(($result['status']==1) and ($result['person_id']!=$user)){
			echo "<Td>$result[doc_subject]$no_publish</Td>";
			}
			else{
			echo "<Td><a href=modules/cabinet/upload_files/$result[doc_name] target='_blank'>$result[doc_subject]</a></Td>";
			}
echo "<Td  align='center'>$result[doc_type]</Td><Td align='center'>$doc_size</Td><Td>";
echo $cabinet_ar[$result['cabinet_id']];
echo "</Td><Td>$result[name]&nbsp;$result[surname]</Td><Td align='center'>$result[rec_date]</Td>";
echo "</Tr>";

$M++;
$N++;  //*เกี่ยวข้องกับการแยกหน้า
}
echo "</Table>";


?>
<script>
function goto_display(val){
	if(val==1){
		callfrm("?option=cabinet&task=main/search_document"); 
		}
}
</script>
