<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
if(!($_SESSION['login_status']<=4)){
exit();
}

?>
<script language='javascript'>
//<!–
function printContentDiv(content){
var printReady = document.getElementById(content);
//var txt= 'nn';
var txt= '';

if (document.getElementsByTagName != null){
var txtheadTags = document.getElementsByTagName('head');
if (txtheadTags.length > 0){
var str=txtheadTags[0].innerHTML;
txt += str; // str.replace(/funChkLoad();/ig, ” “);
}
}
//txt += 'nn';
if (printReady != null){
txt += printReady.innerHTML;
}
//txt +='nn';
var printWin = window.open();
printWin.document.open();
printWin.document.write(txt);
printWin.document.close();
printWin.print();
}
// –>
</script>

<div id="lblPrint">
<?php

require_once "modules/permission/time_inc.php";	

$user=$_SESSION['login_user_id'];

//อาเรย์บุคลากร
$sql_person = "select  * from  person_main where  status='0' ";
$dbquery_person = mysql_query($sql_person);
While ($result_person = mysql_fetch_array($dbquery_person)){
$fullname=$result_person['prename'].$result_person['name']." ".$result_person['surname'];
$person_ar[$result_person['person_id']]=$fullname;
}


//ส่วนหัว
echo "<br />";

$sql_name = "select * from person_main where person_id='$user'";
$dbquery_name = mysql_query($sql_name);
$result_name = mysql_fetch_array($dbquery_name);
		$person_id = $result_name['person_id'];
		$prename=$result_name['prename'];
		$name= $result_name['name'];
		$surname = $result_name['surname'];
		$position_code = $result_name['position_code'];
$full_name="$prename$name&nbsp;&nbsp;$surname";

echo "<table width='100%' border='0' align='center'>";
echo "<tr align='center'><td><font color='#006666' size='3'><strong>ทะเบียนขออนุญาตไปราชการ</strong></font></td></tr>";
echo "<tr align='center'><td><font color='#006666' size='2'><strong>$full_name</strong></font></td></tr>";
echo "</table>";


//ส่วนของการแยกหน้า
$sql="select id from permission_main where person_id='$user'";
$dbquery = mysql_query($sql);
$num_rows = mysql_num_rows($dbquery );

$pagelen=10;  // 1_กำหนดแถวต่อหน้า
$url_link="option=permission&task=main/print_report";  // 2_กำหนดลิงค์ฺ
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

$sql="select * from permission_main where person_id='$user' order by id limit $start,$pagelen";
$dbquery = mysql_query($sql);

echo  "<table width=95% border='1' cellpadding='1' cellspacing='0' bordercolor='#333333' align='center'>";
echo "<Tr><Td colspan='9' align='left'>";
?>
<a href="javascript:printContentDiv('lblPrint');"><img src="images/b_print.png" border="0"> พิมพ์หน้านี้</a>
<?php
echo "</Td></Tr>";
echo "<Tr bgcolor='#FFCCCC' align='center'><Td width='60'>เลขที่</Td><Td width='100'>วันขออนุญาต</Td><Td>เรื่องราชการ</Td><Td>สถานที่</Td><Td>วันไปราชการ</Td><Td>พาหนะ</Td><Td>ความเห็นผู้บังคับบัญชา<br>ขั้นต้น</Td><Td>อนุมัติ/คำสั่ง</Td><Td width='60'>หมายเหตุ</Td></Tr>";

$N=(($page-1)*$pagelen)+1; //*เกี่ยวข้องกับการแยกหน้า
$M=1;

While ($result = mysql_fetch_array($dbquery)){
		$id = $result['id'];
		$subject = $result['subject'];
		$place = $result['place'];
		$vehicle = $result['vehicle'];
		$ref_id = $result['ref_id'];
		$file = $result['document'];
		$comment = $result['comment'];
		$comment_person = $result['comment_person'];
		$grant = $result['grant_x'];
		$grant_comment = $result['grant_comment'];
		$grant_person = $result['grant_person'];
		$report = $result['report'];
		$rec_date = $result['rec_date'];
			if(($M%2) == 0)
			$color="#FFFFB";
			else  	$color="#FFFFFF";
echo "<Tr bgcolor='$color'><Td valign='top' align='center'>$id</Td><Td valign='top' align='left'>";
echo thai_date_3($rec_date);
echo "</Td><Td valign='top' align='left'>$subject</Td><Td valign='top' align='left' >$place</Td><Td valign='top' align='left'>";

	$sql_date="select * from permission_date where ref_id='$ref_id' and person_id='$user' order by date";
	$dbquery_date = mysql_query($sql_date);
	While ($result_date = mysql_fetch_array($dbquery_date)){
		$date = $result_date['date'];
		echo thai_date_3($date);
		echo "<br />";
	}
echo "</Td><Td valign='top' align='left'>$vehicle</Td>";

echo "<Td valign='top' align='center'>";
if($comment_person != ""){
echo "<font color='#339900'>$comment</font><br>";
		if(isset($person_ar[$comment_person])){
		echo $person_ar[$comment_person];
		}
}
else{
echo "";
}
echo "</td>";

echo "<Td valign='top' align='center'>";
if($grant==1){
echo "<img src=images/yes.png border='0'> อนุมัติ<br><font color='#339900'>$grant_comment</font><br>";
		if(isset($person_ar[$grant_person])){
		echo $person_ar[$grant_person];
		}
}
else if($grant==2){
echo "<img src=images/no.png border='0'> ไม่อนุมัติ<br><font color='#990000'>$grant_comment</font><br>";
		if(isset($person_ar[$grant_person])){
		echo $person_ar[$grant_person];
		}
}
else{
echo "รออนุมัติ";
}
echo "</Td><td></td>";
echo "</Tr>";

$M++;
$N++;  //*เกี่ยวข้องกับการแยกหน้า
}	
echo "</Table>";

?>

</div>
