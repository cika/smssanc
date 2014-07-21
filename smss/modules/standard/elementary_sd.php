<?php
if(isset($_REQUEST['page'])){
$page=$_REQUEST['page'];
}else{
$page="";
}
echo "<br />";

if(!(($index==1) or ($index==2) or ($index==5))){
echo "<table width='50%' border='0' align='center'>";
echo "<tr align='center'><td><font color='#006666' size='3'><strong>เพิ่ม แก้ไขข้อมูล มาตรฐานการศึกษาปฐมวัย</strong></font></td></tr>";
echo "</table>";
}
//ส่วนเพิ่มข้อมูล
if($index==1){
echo "<form id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>เพิ่ม มาตรฐานการศึกษาปฐมวัย</B></Font>";
echo "</Cener>";
echo "<Br><Br>";
echo "<Table   width=70% Border=0 Bgcolor=#Fcf9d8>";

echo "<Tr align='left'><Td width=20></Td><Td align='right'>มาตรฐานปี&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='sd_year' id='sd_year' Size='5' onkeydown='integerOnly()'></Td></Tr>";

echo "<Tr align='left'><Td width=20></Td><Td align='right'>มาตรฐานที่&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='sd_id' id='sd_id' Size='5' onkeydown='integerOnly()'></Td></Tr>";

echo "<Tr align='left'><Td ></Td><Td align='right'>ชื่อมาตรฐาน&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='sd_name' id='sd_name' Size='80'></Td></Tr>";
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
echo "<INPUT TYPE='button' name='smb' value='ยืนยัน' onclick='location.href=\"?option=standard&task=elementary_sd&index=3&id=$_GET[id]&page=$page\"'>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ยกเลิก' onclick='location.href=\"?option=standard&task=elementary_sd&page=$page\"'";
echo "</td></tr></table>";
}
//ส่วนลบข้อมูล
if($index==3){
$sql = "delete from standard_elementary_sd where id=$_GET[id]";
$dbquery = mysql_query($sql);
}

//ส่วนเพิ่มข้อมูล
if($index==4){
$sql = "insert into standard_elementary_sd (sd_year, sd_id, sd_name) values ( '$_POST[sd_year]','$_POST[sd_id]','$_POST[sd_name]')";
$dbquery = mysql_query($sql);
}
//ส่วนฟอร์มแก้ไขข้อมูล
if ($index==5){
echo "<form id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>แก้ไข มาตรฐานการศึกษาปฐมวัย</B></Font>";
echo "</Cener>";
echo "<Br><Br>";
echo "<Table   width=70% Border=0 Bgcolor=#Fcf9d8>";

$sql = "select * from  standard_elementary_sd where id='$_GET[id]'";
$dbquery = mysql_query($sql);
$ref_result = mysql_fetch_array($dbquery);

echo "<Tr align='left'><Td width=20></Td><Td align='right'>มาตรฐานปี&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='sd_year' id='sd_year' Size='5' value='$ref_result[sd_year]' onkeydown='integerOnly()'></Td></Tr>";

echo "<Tr align='left'><Td width=20></Td><Td align='right'>มาตรฐานที่&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='sd_id' id='sd_id' Size='5' value='$ref_result[sd_id]' onkeydown='integerOnly()'></Td></Tr>";

echo "<Tr align='left'><Td ></Td><Td align='right'>ชื่อมาตรฐาน&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='sd_name' id='sd_name' Size='80' value='$ref_result[sd_name]'></Td></Tr>";
echo "</Table>";
echo "<Br>";
echo "<Input Type=Hidden Name='id' Value='$_GET[id]'>";
echo "<Input Type=Hidden Name='page' Value='$_GET[page]'>";
echo "<INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url_update(1)' class=entrybutton>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ย้อนกลับ' onclick='goto_url_update(0)' class=entrybutton'>";

echo "</form>";
}
//ส่วนปรับปรุงข้อมูล
if ($index==6){
$sql = "update standard_elementary_sd set sd_year='$_POST[sd_year]',sd_id='$_POST[sd_id]',sd_name='$_POST[sd_name]' where id='$_POST[id]'";
$dbquery = mysql_query($sql);
}

if(!(($index==1) or ($index==2) or ($index==5))){

	//ส่วนของการแยกหน้า
$sql = "select * from standard_elementary_sd order by sd_id desc";
$dbquery = mysql_query($sql);
$num_rows = mysql_num_rows($dbquery );
$pagelen=20;
$url_link="option=standard&task=elementary_sd";  //กำหนดลิงค์
$totalpages=ceil($num_rows/$pagelen);
if($page==""){
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

$sql = "select * from standard_elementary_sd order by sd_year,sd_id limit $start,$pagelen";
$dbquery = mysql_query($sql);
echo  "<table width=85% border=0 align=center>";
echo "<Tr><Td colspan='6' align='right'><INPUT TYPE='button' name='smb' value='เพิ่มข้อมูล' onclick='location.href=\"?option=standard&task=elementary_sd&index=1\"'</Td></Tr>";

echo "<Tr bgcolor=#FFCCCC align=center class=style2><Td width='40'>ที่</Td> <Td width='100'>มาตรฐานปี</Td><Td width='100'>มาตรฐานที่</Td><Td>ชื่อมาตรฐาน</Td><Td  width='40'>ลบ</Td><Td width='40'>แก้ไข</Td></Tr>";
$N=(($page-1)*$pagelen)+1;  //*เกี่ยวข้องกับการแยกหน้า
$M=1;
While ($result = mysql_fetch_array($dbquery))
	{
		$id = $result['id'];
		$sd_year= $result['sd_year'];
		$sd_id = $result['sd_id'];
		$sd_name = $result['sd_name'];
			if(($M%2) == 0)
			$color="#FFFFC";
			else  	$color="#FFFFFF";

		echo "<Tr  bgcolor=$color align=center class=style1><Td>$N</Td> <Td>$sd_year</Td> <Td align='center'>$sd_id</Td><Td align='left'>$sd_name</Td>
		<Td><div align=center><a href=?option=standard&task=elementary_sd&index=2&id=$id&page=$page><img src=images/drop.png border='0' alt='ลบ'></a></div></Td>
		<Td><a href=?option=standard&task=elementary_sd&index=5&id=$id&page=$page><img src=images/edit.png border='0' alt='แก้ไข'></a></div></Td>
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
		callfrm("?option=standard&task=elementary_sd");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.sd_year.value == ""){
			alert("กรุณากรอกมาตรฐานปี");
		}else if(frm1.sd_id.value==""){
			alert("กรุณากรอกมาตรฐานที่");
		}else if(frm1.sd_name.value == ""){
			alert("กรุณากรอกชื่อมาตรฐาน");
		}else{
			callfrm("?option=standard&task=elementary_sd&index=4");   //page ประมวลผล
		}
	}
}

function goto_url_update(val){
	if(val==0){
		callfrm("?option=standard&task=elementary_sd");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.sd_year.value == ""){
			alert("กรุณากรอกมาตรฐานปี");
		}else if(frm1.sd_id.value==""){
			alert("กรุณากรอกมาตรฐานที่");
		}else if(frm1.sd_name.value == ""){
			alert("กรุณากรอกชื่อมาตรฐาน");
		}else{
			callfrm("?option=standard&task=elementary_sd&index=6");   //page ประมวลผล
		}
	}
}
</script>
