<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
//sd page 

echo "<br />";
if(!(($index==1) or ($index==2) or ($index==5))){
echo "<table width='50%' border='0' align='center'>";
echo "<tr align='center'><td><font color='#006666' size='3'><strong>ประเภท(ย่อย)ของเงินที่สถานศึกษาได้รับ</strong></font></td></tr>";
echo "</table>";
}

//ส่วนเพิ่มข้อมูล
if($index==1){
echo "<form id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>เพิ่มประเภท(ย่อย)ของเงินที่สถานศึกษาได้รับ</B></Font>";
echo "</Cener>";
echo "<Br><Br>";
echo "<Table   width=70% Border=0 Bgcolor=#Fcf9d8>";
echo "<Tr align='left'><Td ></Td><Td align='right'>ประเภท(หลัก)ของเงิน&nbsp;&nbsp;</Td>";
echo "<td><div align='left'><Select  name='category' id='category' size='1'>";
echo  "<option  value = ''>เลือก</option>" ;
echo  "<option value =1>เงินนอกงบประมาณ</option>";
echo  "<option value =3>เงินรายได้แผ่นดิน</option>";
echo "</select>";
echo "</div></td></tr>";

echo "<Tr align='left'><Td width=20></Td><Td align='right'>รหัสประเภท(ย่อย)ของเงิน&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='m_type' id='m_type' Size='3'  maxlength='3' onkeydown='integerOnly()'></Td></Tr>";

echo "<Tr align='left'><Td ></Td><Td align='right'>ชื่อประเภท(ย่อย)ของเงิน&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='m_type_name' id='m_type_name' Size='60'></Td></Tr>";
echo "<Br>";
echo "</Table>";
echo "<Br>";
echo "<INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url(1)'>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ย้อนกลับ' onclick='goto_url(0)'>";

echo "</form>";
}

//ส่วนยืนยันการลบข้อมูล
if($index==2) {
echo "<table width='500' border='0' align='center'>";
echo "<tr><td align='center'><font color='#990000' size='4'>โปรดยืนยันความต้องการลบข้อมูลอีกครั้ง</font><br></td></tr>";
echo "<tr><td align=center>";
echo "<INPUT TYPE='button' name='smb' value='ยืนยัน' onclick='location.href=\"?option=budget&task=category/edit_type&index=3&id=$_GET[id]&page=$_REQUEST[page]\"'>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ยกเลิก' onclick='location.href=\"?option=budget&task=category/edit_type&page=$_REQUEST[page]\"'";
echo "</td></tr></table>";
}

//ส่วนลบข้อมูล
if($index==3){
$sql = "delete from budget_type where id=$_GET[id]";
$dbquery = mysql_query($sql);
}

//ส่วนเพิ่มข้อมูล
if($index==4){
$sql = "select  * from  budget_type where type_id='$_POST[m_type]'  ";
$dbquery = mysql_query($sql);
$num_rows=mysql_num_rows($dbquery);
		if($num_rows>=1){
					?>
					<script>
					alert("รหัสประเภทย่อยของเงินมีอยู่แล้ว  ยกเลิกการบันทึกข้อมูล");
					</script>
					<?php
		}
		else {
		$sql = "insert into budget_type (type_id, category_id, type_name) values ( '$_POST[m_type]','$_POST[category]','$_POST[m_type_name]')";
		$dbquery = mysql_query($sql);
		}
}

//ส่วนฟอร์มแก้ไขข้อมูล
if ($index==5){
echo "<form id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>แก้ไขประเภท(ย่อย)ของเงินที่สถานศึกษาได้รับ</B></Font>";
echo "</Cener>";
echo "<Br><Br>";
echo "<Table   width=70% Border=0 Bgcolor=#Fcf9d8>";
echo "<Tr ><Td ></Td><Td align='right'>ประเภท(หลัก)ของเงิน&nbsp;&nbsp;</Td>";
echo "<td><div align='left'><Select  name='category' id='category' size='1'>";
echo  "<option  value = ''>เลือก</option>" ;

$sql = "select * from  budget_type where id='$_GET[id]'";
$dbquery = mysql_query($sql);
$ref_result = mysql_fetch_array($dbquery);

$sql = "select  * from  budget_category  where category_id=1 or category_id=3 order by  category_id";
$dbquery = mysql_query($sql);
While ($result = mysql_fetch_array($dbquery))
   {
$category_id = $result['category_id']; 
$category_name = $result['category_name'];

	if($category_id==$ref_result['category_id']){
	$select="selected";
	}
	else{
	$select="";
	}
	
echo  "<option value = $category_id $select>$category_name</option>";
	}
echo "</select>";
echo "</div></td></tr>";

echo "<Tr align='left'><Td width=20></Td><Td align='right'>รหัสประเภท(ย่อย)ของเงิน&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='m_type' id='m_type' Size='3' value='$ref_result[type_id]'  maxlength='3' onkeydown='integerOnly()'></Td></Tr>";

echo "<Tr align='left'><Td ></Td><Td align='right'>ชื่อประเภท(ย่อย)ของเงิน&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='m_type_name' id='m_type_name' Size='60' value='$ref_result[type_name]'></Td></Tr>";
echo "<Br>";
echo "</Table>";
echo "<Input Type=Hidden Name='id' Value='$_GET[id]'>";
echo "<Input Type=Hidden Name='page' Value='$_GET[page]'>";
echo "<INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url_update(1)' class=entrybutton>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ย้อนกลับ' onclick='goto_url_update(0)' class=entrybutton'>";

echo "</form>";
}

//ส่วนปรับปรุงข้อมูล
if ($index==6){
$sql = "update budget_type set type_id='$_POST[m_type]',category_id='$_POST[category]',type_name='$_POST[m_type_name]' where id='$_POST[id]'";
$dbquery = mysql_query($sql);
}

//ส่วนแสดง
if(!(($index==1) or ($index==2) or ($index==5))){
	//ส่วนของการแยกหน้า
$pagelen=20;  // 1_กำหนดแถวต่อหน้า
$url_link="option=budget&task=category/edit_type";  // 2_กำหนดลิงค์ฺ
$sql = "select * from budget_type"; // 3_กำหนด sql

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

$sql = "select budget_type.id, budget_type.type_id, budget_category.category_id, budget_type.category_id, budget_type.type_name, budget_category.category_name from  budget_type left join  budget_category on budget_category.category_id=budget_type.category_id   order by  budget_type.type_id limit $start,$pagelen";

$dbquery = mysql_query($sql);
echo  "<table width=70% border=0 align=center>";
echo "<Tr><Td colspan='6' align='left'><INPUT TYPE='button' name='smb' value='เพิ่มข้อมูล' onclick='location.href=\"?option=budget&task=category/edit_type&index=1\"'></Td></Tr>";

echo "<Tr bgcolor=#FFCCCC align=center class=style2><Td width='50'>ที่</Td> <Td>รหัส</Td><Td>ประเภท(ย่อย)</Td><Td>ประเภท(หลัก)</Td><Td align='center' width='50'>ลบ</Td><Td align='center' width='50'>แก้ไข</Td></Tr>";
$N=(($page-1)*$pagelen)+1;  //*เกี่ยวข้องกับการแยกหน้า
$M=1;
While ($result = mysql_fetch_array($dbquery))
	{
		$id = $result['id'];
		$type_id= $result['type_id'];
		$type_name = $result['type_name'];
		$category_name = $result['category_name'];
			if(($M%2) == 0)
			$color="#FFFFC";
			else  	$color="#FFFFFF";

		echo "<Tr  bgcolor=$color align=center class=style1><Td>$N</Td> <Td>$type_id</Td> <Td align=left>$type_name</Td><Td align=left>$category_name</Td>
		<Td><div align=center><a href=?option=budget&task=category/edit_type&index=2&id=$id&page=$page><img src=images/drop.png border='0' alt='ลบ'></a></div></Td>
		<Td><a href=?option=budget&task=category/edit_type&index=5&id=$id&page=$page><img src=images/edit.png border='0' alt='แก้ไข'></a></div></Td>
	</Tr>";
$M++;
$N++;  //*เกี่ยวข้องกับการแยกหน้า
	}
echo "</Table>";
}

?>
<script>
function goto_url(val){
var str=frm1.m_type.value;
var str2=str.length;
	if(val==0){
		callfrm("?option=budget&task=category/edit_type");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.category.value == ""){
			alert("กรุณาเลือกประเภท(หลัก)ของเงิน");
		}else if(frm1.m_type.value==""){
			alert("กรุณากรอกรหัสประเภท(ย่อย)ของเงิน");
		}else if(str2!=3){
			alert("กรุณากรอกรหัสประเภท(ย่อย)ของเงินให้ครบ 3 หลัก");
		}else if(str.substring(0,1)!=frm1.category.value){
			alert("เลขหลักแรกต้องตรงกับรหัสประเภทหลัก  กรุณาแก้ไขใหม่");
		}else if(frm1.m_type_name.value == ""){
			alert("กรุณากรอกชื่อประเภท(ย่อย)ของเงิน");
		}else{
			callfrm("?option=budget&task=category/edit_type&index=4");   //page ประมวลผล
		}
	}
}

function goto_url_update(val){
var str=frm1.m_type.value;
var str2=str.length;
	if(val==0){
		callfrm("?option=budget&task=category/edit_type");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.category.value == ""){
			alert("กรุณาเลือกประเภท(หลัก)ของเงิน");
		}else if(frm1.m_type.value==""){
			alert("กรุณากรอกรหัสประเภท(ย่อย)ของเงิน");
		}else if(str2!=3){
			alert("กรุณากรอกรหัสประเภท(ย่อย)ของเงินให้ครบ 3 หลัก");
		}else if(str.substring(0,1)!=frm1.category.value){
			alert("เลขหลักแรกต้องตรงกับรหัสประเภทหลัก  กรุณาแก้ไขใหม่");
		}else if(frm1.m_type_name.value == ""){
			alert("กรุณากรอกชื่อประเภท(ย่อย)ของเงิน");
		}else{
			callfrm("?option=budget&task=category/edit_type&index=6");   //page ประมวลผล
		}
	}
}
</script>
