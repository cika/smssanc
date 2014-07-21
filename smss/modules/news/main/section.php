<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
//sd page 

$sql = "select * from  news_mainitem where item_active='1' order by code desc limit 1";
$dbquery = mysql_query($sql);
$item_active_result = mysql_fetch_array($dbquery);
if($item_active_result['mainitem']==""){
echo "<br />";
echo "<div align='center'>ยังไม่ได้กำหนดชื่อเรื่องเพื่อทำงานปัจจุบัน กรุณาไปที่เมนูตั้งค่าระบบ</div>";
exit();
}

echo "<br />";

if(!(($index==1) or ($index==2) or ($index==5))){
echo "<table width='50%' border='0' align='center'>";
echo "<tr align='center'><td><font color='#006666' size='3'><strong>$item_active_result[mainitem]</strong></font></td></tr>";
echo "</table>";
}
//ส่วนเพิ่มข้อมูล
if($index==1){
echo "<form id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>เพิ่มข้อมูล</B></Font>";
echo "</Cener>";
echo "<Br><Br>";
echo "<Table width='500' Border='0'>";

echo "<Tr align='left'><Td align='right'>รหัส&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='code' Size='5'></Td></Tr>";
echo "<Tr align='left'><Td align='right'>ประเภท&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='name'  Size='60'></Td></Tr>";

echo "<tr><td align='right'><INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url(1)' class=entrybutton>
	&nbsp;&nbsp;</td>";
echo "<td align='left'><INPUT TYPE='button' name='back' value='ย้อนกลับ' onclick='goto_url(0)' class=entrybutton'></td></tr>";
echo "</Table>";

echo "</form>";
}
//ส่วนยืนยันการลบข้อมูล
if($index==2) {
echo "<table width='500' border='0' align='center'>";
echo "<tr><td align='center'><font color='#990000' size='4'>โปรดยืนยันความต้องการลบข้อมูลอีกครั้ง</font><br></td></tr>";
echo "<tr><td align=center>";
echo "<INPUT TYPE='button' name='smb' value='ยืนยัน' onclick='location.href=\"?option=news&task=main/section&index=3&id=$_GET[id]&page=$_REQUEST[page]\"'>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ยกเลิก' onclick='location.href=\"?option=news&task=main/section&page=$_REQUEST[page]\"'";
echo "</td></tr></table>";
}
//ส่วนลบข้อมูล
if($index==3){
$sql = "delete from news_section where id=$_GET[id]";
$dbquery = mysql_query($sql);
}

//ส่วนเพิ่มข้อมูล
if($index==4){

$sql = "select * from news_section where mainitem_code='$item_active_result[code]' and code='$_POST[code]' ";
$dbquery = mysql_query($sql);
if(mysql_num_rows($dbquery)>=1){
echo "<br /><div align='center'>มีรหัสซ้ำกับรายการที่มีอยู่แล้ว ตรวจสอบอีกครั้ง</div>";
exit();  
}
$sql = "insert into news_section (mainitem_code,code,name) values ( '$item_active_result[code]','$_POST[code]','$_POST[name]')";
$dbquery = mysql_query($sql);
}
//ส่วนฟอร์มแก้ไขข้อมูล
if ($index==5){
echo "<form id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>แก้ไขประเภท</B></Font>";
echo "</Cener>";
echo "<Br><Br>";
$sql = "select * from  news_section where id='$_GET[id]'";
$dbquery = mysql_query($sql);
$result = mysql_fetch_array($dbquery);

echo "<Table width='500' Border='0'>";
echo "<Tr><Td align='right'>รหัส&nbsp;&nbsp;</Td><Td align='left'><Input Type='Text' Name='code' Size='5' value='$result[code]'></Td></Tr>";

echo "<Tr><Td align='right'>ประเภท&nbsp;&nbsp;</Td><Td align='left'><Input Type='Text' Name='name' Size='60' value='$result[name]'></Td></Tr>";

echo "<tr><td align='right'><INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url_update(1)' class=entrybutton>
		&nbsp;&nbsp;</td><td align='left'><INPUT TYPE='button' name='back' value='ย้อนกลับ' onclick='goto_url_update(0)' class=entrybutton'></td></tr>";

echo "</Table>";
echo "<Br />";
echo "<Input Type=Hidden Name='id' Value='$_GET[id]'>";
echo "<Input Type=Hidden Name='page' Value='$_GET[page]'>";
echo "</form>";
}
//ส่วนปรับปรุงข้อมูล
if ($index==6){
$sql = "select * from news_section where mainitem_code='$item_active_result[code]' and code='$_POST[code]' and id!='$_POST[id]' ";
$dbquery = mysql_query($sql);
	if(mysql_num_rows($dbquery)>=1){
	echo "<br /><div align='center'>มีรหัสซ้ำกับรายการที่มีอยู่แล้ว ตรวจสอบอีกครั้ง</div>";
	exit();  
	}
$sql = "update news_section set code='$_POST[code]', name='$_POST[name]' where id='$_POST[id]'";
$dbquery = mysql_query($sql);
}

//ส่วนการแสดงผล
if(!(($index==1) or ($index==2) or ($index==5))){

//ส่วนของการแยกหน้า
$pagelen=20;  // 1_กำหนดแถวต่อหน้า
$url_link="option=news&task=main/section";  // 2_กำหนดลิงค์ฺ
$sql = "select * from news_section where mainitem_code='$item_active_result[code]'"; // 3_กำหนด sql

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

$sql = "select * from news_section where mainitem_code='$item_active_result[code]' order by code limit $start,$pagelen";
$dbquery = mysql_query($sql);
echo  "<table width=70% border=0 align=center>";
echo "<Tr><Td colspan='6' align='left'><INPUT TYPE='button' name='smb' value='เพิ่มข้อมูล' onclick='location.href=\"?option=news&task=main/section&index=1\"'>";
echo "</Td></Tr>";
echo "<Tr bgcolor=#FFCCCC align='center' class=style2><Td width='50'>ที่</Td><Td width='50'>รหัส</Td><Td>ประเภท</Td><Td width='50'>ลบ</Td><Td width='50'>แก้ไข</Td></Tr>";
$N=(($page-1)*$pagelen)+1;  //*เกี่ยวข้องกับการแยกหน้า
$M=1;
While ($result = mysql_fetch_array($dbquery))
	{
		$id = $result['id'];
		$code= $result['code'];
		$name = $result['name'];
			if(($M%2) == 0)
			$color="#FFFFC";
			else  	$color="#FFFFFF";

		echo "<Tr bgcolor='$color' align='center'><Td>$N</Td><Td align='center'>$code</Td><Td align='left'>$name</Td><Td><div align='center'><a href=?option=news&task=main/section&index=2&id=$id&page=$page><img src=images/drop.png border='0' alt='ลบ'></a></div></Td>
		<Td><a href=?option=news&task=main/section&index=5&id=$id&page=$page><img src=images/edit.png border='0' alt='แก้ไข'></a></div></Td>
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
		callfrm("?option=news&task=main/section");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.code.value == ""){
			alert("กรุณากรอกรหัส");
		}else if(frm1.name.value==""){
			alert("กรุณากรอกชื่อแผนงาน");
		}else{
			callfrm("?option=news&task=main/section&index=4");   //page ประมวลผล
		}
	}
}

function goto_url_update(val){
	if(val==0){
		callfrm("?option=news&task=main/section");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.code.value == ""){
			alert("กรุณากรอกรหัส");
		}else if(frm1.name.value==""){
			alert("กรุณากรอกชื่อแผนงาน");
		}else{
			callfrm("?option=news&task=main/section&index=6");   //page ประมวลผล
		}
	}
}
</script>
