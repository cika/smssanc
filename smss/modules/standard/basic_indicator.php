<?php
if(isset($_REQUEST['page'])){
$page=$_REQUEST['page'];
}else{
$page="";
}
echo "<br />";

if(!(($index==1) or ($index==2) or ($index==5))){
echo "<table width='50%' border='0' align='center'>";
echo "<tr align='center'><td><font color='#006666' size='3'><strong>เพิ่ม แก้ไข ตัวบ่งชี้มาตรฐานการศึกษาขั้นพื้นฐาน</strong></font></td></tr>";
echo "</table>";
}
//ส่วนเพิ่มข้อมูล
if($index==1){
//ตรวจปีมาตรฐาน
$sql = "select distinct sd_year from standard_basic_sd order by sd_year desc";
$dbquery = mysql_query($sql);
$result_sdyear = mysql_fetch_array($dbquery);

echo "<form id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>เพิ่มข้อมูล ตัวบ่งชี้การศึกษาขั้นพื้นฐาน</B></Font>";
echo "</Cener>";
echo "<Br><Br>";
echo "<Table   width=70% Border=0 Bgcolor=#Fcf9d8>";

//ตรวจปีมาตรฐาน
$sql = "select distinct sd_year from standard_basic_sd order by sd_year desc";
$dbquery = mysql_query($sql);
$result_sdyear = mysql_fetch_array($dbquery);

echo "<Tr><Td width=20></Td><Td align='right'>มาตรฐานปี&nbsp;&nbsp;</Td><Td align='left'><Input Type='Text' Name='sd_year' Size='4' value='$result_sdyear[sd_year]'></Td></Tr>";

echo "<Tr align='left'><Td ></Td><Td align='right'>มาตรฐาน&nbsp;&nbsp;</Td>";
echo "<td><div align='left'><Select  name='sd_id' id='sd_id' size='1'>";
echo  "<option  value = ''>เลือก</option>" ;

$sql = "select distinct sd_id from  standard_basic_sd  order by  sd_id";
$dbquery = mysql_query($sql);
While ($result = mysql_fetch_array($dbquery))
   {
$sd_id = $result['sd_id']; 
//$sd_name = $result['sd_name'];
echo  "<option value = $sd_id>$sd_id</option>";
	}
echo "</select>";
echo "</div></td></tr>";

echo "<Tr><Td width=20></Td><Td align='right'>รหัสตัวบ่งชี้&nbsp;&nbsp;</Td><Td align='left' ><Input Type='Text' Name='id_indicator' id='id_indicator' Size='5' onkeydown='integerOnly()'></Td></Tr>";

echo "<Tr align='left'><Td ></Td><Td align='right'>ชื่อตัวบ่งชี้&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='indicator_name' id='indicator_name' Size='80'></Td></Tr>";
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
echo "<INPUT TYPE='button' name='smb' value='ยืนยัน' onclick='location.href=\"?option=standard&task=basic_indicator&index=3&id=$_GET[id]&page=$page\"'>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ยกเลิก' onclick='location.href=\"?option=standard&task=basic_indicator&page=$page\"'";
echo "</td></tr></table>";
}
//ส่วนลบข้อมูล
if($index==3){
$sql = "delete from standard_basic_indicator where id=$_GET[id]";
$dbquery = mysql_query($sql);
}

//ส่วนเพิ่มข้อมูล
if($index==4){
$sql = "insert into standard_basic_indicator (sd_year,id_indicator, sd_id, indicator_name) values ( '$_POST[sd_year]','$_POST[id_indicator]','$_POST[sd_id]','$_POST[indicator_name]')";
$dbquery = mysql_query($sql);
}
//ส่วนฟอร์มแก้ไขข้อมูล
if ($index==5){
echo "<form id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>แก้ไขข้อมูล ตัวบ่งชี้การศึกษาขั้นพื้นฐาน</B></Font>";
echo "</Cener>";
echo "<Br><Br>";
echo "<table width='70%' border='0' align='center' Bgcolor='#Fcf9d8'>";
$sql = "select * from  standard_basic_indicator where id='$_GET[id]'";
$dbquery = mysql_query($sql);
$ref_result = mysql_fetch_array($dbquery);

echo "<Tr><Td width=20></Td><Td align='right'>มาตรฐานปี&nbsp;&nbsp;</Td><Td align='left'><Input Type='Text' Name='sd_year' Size='4' value='$ref_result[sd_year]'></Td></Tr>";

echo "<Tr align='left'><Td ></Td><Td align='right'>มาตรฐาน&nbsp;&nbsp;</Td>";
echo "<td><div align='left'><Select  name='sd_id' id='sd_id' size='1'>";
echo  "<option  value = ''>เลือก</option>" ;

$sql = "select  distinct sd_id from standard_basic_sd  order by sd_id";
$dbquery = mysql_query($sql);
While ($result = mysql_fetch_array($dbquery))
   {
$sd_id = $result['sd_id']; 
$sd_name = $result['sd_name'];
	if($sd_id==$ref_result['sd_id']){
	$select="selected";
	}
	else{
	$select="";
	}
	
echo  "<option value = $sd_id $select>$sd_id</option>";
	}
echo "</select>";
echo "</div></td></tr>";

echo "<Tr align='left'><Td></Td><Td align='right'>รหัสตัวบ่งชี้&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='id_indicator' id='id_indicator' Size='5' value='$ref_result[id_indicator]' onkeydown='integerOnly()'></Td></Tr>";
echo "<Tr align='left'><Td ></Td><Td align='right'>ชื่อตัวบ่งชี้&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='indicator_name' id='indicator_name' Size='80' value='$ref_result[indicator_name]'></Td></Tr>";
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
$sql = "update standard_basic_indicator set sd_year='$_POST[sd_year]', id_indicator='$_POST[id_indicator]',sd_id='$_POST[sd_id]',indicator_name='$_POST[indicator_name]' where id='$_POST[id]'";
$dbquery = mysql_query($sql);
}

if(!(($index==1) or ($index==2) or ($index==5))){
	//ส่วนของการแยกหน้า
$sql = "select * from standard_basic_indicator order by sd_id desc";
$dbquery = mysql_query($sql);
$num_rows = mysql_num_rows($dbquery );
$pagelen=30;
$url_link="option=standard&task=basic_indicator";  //กำหนดลิงค์
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

$sql = "select * from standard_basic_indicator order by sd_year,sd_id,id_indicator limit $start,$pagelen";
$dbquery = mysql_query($sql);
echo  "<table width=85% border=0 align=center>";
echo "<Tr><Td colspan='7' align='right'><INPUT TYPE='button' name='smb' value='เพิ่มข้อมูล' onclick='location.href=\"?option=standard&task=basic_indicator&index=1\"'</Td></Tr>";

echo "<Tr bgcolor=#FFCCCC align=center class=style2><Td width='40'>ที่</Td> <Td width='100'>มาตรฐานปี</Td><Td width='100'>ตัวบ่งชี้</Td><Td width='100'>มาตรฐานที่</Td><Td>ชื่อตัวบ่งชี้</Td><Td  width='40'>ลบ</Td><Td width='40'>แก้ไข</Td></Tr>";
$N=(($page-1)*$pagelen)+1;  //*เกี่ยวข้องกับการแยกหน้า
$M=1;
While ($result = mysql_fetch_array($dbquery))
	{
		$id = $result['id'];
		$sd_year = $result['sd_year'];
		$id_indicator= $result['id_indicator'];
		$sd_id = $result['sd_id'];
		$indicator_name = $result['indicator_name'];
			if(($M%2) == 0)
			$color="#FFFFC";
			else  	$color="#FFFFFF";

		echo "<Tr  bgcolor=$color align=center class=style1><Td>$N</Td><Td>$sd_year</Td><Td>$id_indicator</Td> <Td align='center'>$sd_id</Td><Td align='left'>$indicator_name</Td>
		<Td><div align=center><a href=?option=standard&task=basic_indicator&index=2&id=$id&page=$page><img src=images/drop.png border='0' alt='ลบ'></a></div></Td>
		<Td><a href=?option=standard&task=basic_indicator&index=5&id=$id&page=$page><img src=images/edit.png border='0' alt='แก้ไข'></a></div></Td>
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
		callfrm("?option=standard&task=basic_indicator");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.sd_id.value == ""){
			alert("กรุณาเลือกมาตรฐาน");
		}else if(frm1.id_indicator.value==""){
			alert("กรุณากรอกรหัสตัวบ่งชี้");
		}else if(frm1.indicator_name.value == ""){
			alert("กรุณากรอกชื่อตัวบ่งชี้");
		}else{
			callfrm("?option=standard&task=basic_indicator&index=4");   //page ประมวลผล
		}
	}
}

function goto_url_update(val){
	if(val==0){
		callfrm("?option=standard&task=basic_indicator");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.sd_id.value == ""){
			alert("กรุณาเลือกมาตรฐาน");
		}else if(frm1.id_indicator.value==""){
			alert("กรุณากรอกรหัสตัวบ่งชี้");
		}else if(frm1.indicator_name.value == ""){
			alert("กรุณากรอกชื่อตัวบ่งชี้");
		}else{
			callfrm("?option=standard&task=basic_indicator&index=6");   //page ประมวลผล
		}
	}
}
</script>
