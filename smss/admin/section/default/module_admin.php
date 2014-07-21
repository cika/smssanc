<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
//sd page 

//อาเรย์ชื่อ module
$sql = "select  * from system_module";
$dbquery = mysql_query($sql);
while ($result = mysql_fetch_array($dbquery)){
$thai_module_name[$result['module']]=$result['module_desc'];
}

//ส่วนหัว
echo "<br />";
if(!(($index==1) or ($index==2) or ($index==5))){
echo "<table width='50%' border='0' align='center'>";
echo "<tr align='center'><td><font color='#006666' size='3'><strong>ผู้ดูแล(Aministrator)ระบบงานย่อย(Module)</strong></font></td></tr>";
echo "</table>";
}

//ส่วนฟอร์มรับข้อมูล
if($index==1){
echo "<form id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>เพิ่ม ผู้ดูแล(Admin)ระบบงานย่อย(Module)</Font>";
echo "</Cener>";
echo "<Br><Br>";
echo "<Table width='50%' Border='0' Bgcolor='#Fcf9d8'>";
echo "<Tr><Td align='right'>ระบบงานย่อย&nbsp;&nbsp;&nbsp;&nbsp;</Td><Td align='left'><Select name='module' size='1'>";
echo  "<option  value = ''>เลือก</option>" ;
$sql = "select  * from system_module where module_active='1' order by module";
$dbquery = mysql_query($sql);
while ($result = mysql_fetch_array($dbquery))
   {
		$module = $result['module'];
		$module_desc = $result['module_desc'];
		echo  "<option value = $module>$module ($module_desc)</option>" ;
	}
echo "</select>";
echo "</Td></Tr>";
echo "<Tr><Td align='right'>ผู้ดูแล(Admin)&nbsp;&nbsp;&nbsp;&nbsp;</Td>";
echo "<td><div align='left'><Select  name='person_id'  size='1'>";
echo  "<option  value = ''>เลือก</option>" ;
$sql = "select  * from person_main order by position_code";
$dbquery = mysql_query($sql);
while ($result = mysql_fetch_array($dbquery))
   {
		$person_id = $result['person_id'];
		$name = $result['name'];
		$surname = $result['surname'];
		echo  "<option value = $person_id>$name $surname</option>" ;
	}
echo "</select>";
echo "</div></td></tr>";
echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
echo "<tr><td align='right'><INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url(1)' class=entrybutton>
	&nbsp;&nbsp;&nbsp;</td>";
echo "<td align='left'><INPUT TYPE='button' name='back' value='ย้อนกลับ' onclick='goto_url(0)' class=entrybutton'></td></tr>";
echo "</Table>";
echo "</form>";
}

//ส่วนยืนยันการลบข้อมูล
if($index==2) {
echo "<table width='500' border='0' align='center'>";
echo "<tr><td align='center'><font color='#990000' size='4'>โปรดยืนยันความต้องการลบข้อมูลอีกครั้ง</font><br></td></tr>";
echo "<tr><td align=center>";
echo "<INPUT TYPE='button' name='smb' value='ยืนยัน' onclick='location.href=\"?file=module_admin&index=3&id=$_GET[id]&page=$_REQUEST[page]\"'>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ยกเลิก' onclick='location.href=\"?file=module_admin&page=$_REQUEST[page]\"'";
echo "</td></tr></table>";
}

//ส่วนลบข้อมูล
if($index==3){
$sql = "delete from system_module_admin where id=$_GET[id]";
$dbquery = mysql_query($sql);
}

//ส่วนบันทึกข้อมูล
if($index==4){
$rec_date = date("Y-m-d");
$sql = "insert into system_module_admin (person_id, module,officer,rec_date) values ('$_POST[person_id]', '$_POST[module]','$_SESSION[login_user_id]','$rec_date')";
$dbquery = mysql_query($sql);
}

//ส่วนฟอร์มแก้ไขข้อมูล
if ($index==5){
echo "<form id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>แก้ไข ผู้ดูแล(Admin)ระบบงานย่อย</B></Font>";
echo "</Cener>";
echo "<Br><Br>";
echo "<Table width='50%' Border= '0' Bgcolor='#Fcf9d8'>";
$sql = "select * from system_module_admin where id='$_GET[id]'";
$dbquery = mysql_query($sql);
$ref_result = mysql_fetch_array($dbquery);
echo "<Tr><Td align='right'>ระบบงานย่อย&nbsp;&nbsp;&nbsp;&nbsp;</Td><Td align='left'><Select name='module' size='1'>";
echo  "<option  value = ''>เลือก</option>" ;
$sql = "select  * from system_module order by module";
$dbquery = mysql_query($sql);
while ($result = mysql_fetch_array($dbquery))
   {
		$module = $result['module'];
		$module_desc = $result['module_desc'];
		if($module==$ref_result ['module']){
		echo  "<option value = $module selected>$module ($module_desc)</option>" ;
		}
		else{
		echo  "<option value = $module>$module ($module_desc)</option>" ;
		}
	}
echo "</select>";
echo "</Td></Tr>";
echo "<Tr><Td align='right'>ผู้ดูแล(Admin)&nbsp;&nbsp;&nbsp;&nbsp;</Td>";
echo "<td><div align='left'><Select  name='person_id'  size='1'>";
echo  "<option  value = ''>เลือก</option>" ;
$sql = "select  * from person_main order by position_code";
$dbquery = mysql_query($sql);
while ($result = mysql_fetch_array($dbquery))
   {
		$person_id = $result['person_id'];
		$name = $result['name'];
		$surname = $result['surname'];
		if($person_id==$ref_result ['person_id']){
		echo  "<option value = $person_id selected>$name $surname</option>" ;
		}
		else{
		echo  "<option value = $person_id>$name $surname</option>" ;
		}
	}
echo "</select>";
echo "</div></td></tr>";
echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
echo "<tr><td align='right'><INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url_update(1)' class=entrybutton>&nbsp;&nbsp;&nbsp;&nbsp;</td>";
echo "<td align='left'><INPUT TYPE='button' name='back' value='ย้อนกลับ' onclick='goto_url_update(0)' class=entrybutton'></td></tr>";
echo "</Table>";
echo "<Br>";
echo "<Input Type=Hidden Name='id' Value='$_GET[id]'>";
echo "<Input Type=Hidden Name='page' Value='$_GET[page]'>";
echo "</form>";
}

//ส่วนปรับปรุงข้อมูล
if ($index==6){
$rec_date = date("Y-m-d");
$sql = "update system_module_admin set  person_id='$_POST[person_id]', module='$_POST[module]', officer='$_SESSION[login_user_id]', rec_date='$rec_date' where id='$_POST[id]'";
$dbquery = mysql_query($sql);
}

//ส่วนแสดงผล
if(!(($index==1) or ($index==2) or ($index==5))){
	//ส่วนของการแยกหน้า
$pagelen=20;  // 1_กำหนดแถวต่อหน้า
$url_link="file=module_admin";  // 2_กำหนดลิงค์
$sql = "select * from system_module_admin"; // 3_กำหนด sql

$dbquery = mysql_query($sql);
$num_rows = mysql_num_rows($dbquery );  
$totalpages=ceil($num_rows/$pagelen);
if(isset($_REQUEST['page']))
	{
		$page=$_REQUEST['page'];
	}else{$page="";}

	if($page==""){
//if($_REQUEST['page']==""){
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
		
		//อาเรย์ Username
$sql2 = "select * from system_user where status='1'";	
$dbquery2 = mysql_query($sql2);
while ($result2 = mysql_fetch_array($dbquery2))
   {
	$username_ar[$result2['person_id']]=$result2['username'];
   }

$sql = "select system_module_admin.id, system_module_admin.module,system_module_admin.person_id,person_main.name,person_main.surname from system_module_admin left join person_main on system_module_admin.person_id=person_main.person_id order by system_module_admin.module limit $start,$pagelen";
$dbquery = mysql_query($sql);
echo  "<table width=80% border=0 align=center>";
echo "<Tr><Td colspan='6' align='left'><INPUT TYPE='button' name='smb' value='เพิ่มผู้ดูแล(Admin)ระบบงานย่อย' onclick='location.href=\"?file=module_admin&index=1\"'</Td></Tr>";

echo "<Tr bgcolor='#FFCCCC'><Td  align='center'>ที่</Td><Td align='center'>ระบบงานย่อย(อังกฤษ)</Td><Td align='center'>ระบบงานย่อย(ไทย)</Td><Td  align='center'>ผู้ดูแลระบบ</Td><Td align='center'>ลบ</Td><Td align='center'>แก้ไข</Td></Tr>";
$N=(($page-1)*$pagelen)+1;  //*เกี่ยวข้องกับการแยกหน้า
$M=1;
while ($result = mysql_fetch_array($dbquery))
	{
		$id = $result['id'];
		$module= $result['module'];
		$person_id= $result['person_id'];
		$name = $result['name'];
		$surname = $result['surname'];
			if(($M%2) == 0)
			$color="#FFFFC";
			else  	$color="#FFFFFF";
		echo "<Tr bgcolor=$color><Td align='center' width='50'>$N</Td><Td  align='left'>$module</Td><Td  align='left'>";
		if(isset($thai_module_name[$module])){
		echo $thai_module_name[$module];
		}
		echo "</Td>";
		if($name!=""){
		echo "<Td align='left'>$name $surname</Td>";
		}
		else{
		echo "<Td align='left'>$username_ar[$person_id]</Td>";
		}
		echo "<Td align='center' width='50' ><a href=?file=module_admin&index=2&id=$id&page=$page><img src=../images/drop.png border='0' alt='ลบ'></a></Td>
		<Td align='center' width='50'><a href=?file=module_admin&index=5&id=$id&page=$page><img src=../images/edit.png border='0' alt='แก้ไข'></a></Td>
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
		callfrm("?file=module_admin");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.module.value == ""){
			alert("กรุณาเลือกระบบงานย่อย");
		}else if(frm1.person_id.value==""){
			alert("กรุณาเลือกเจ้าหน้าที่ผู้รับผิดชอบ");
		}else{
			callfrm("?file=module_admin&index=4");   //page ประมวลผล
		}
	}
}

function goto_url_update(val){
	if(val==0){
		callfrm("?file=module_admin");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.module.value == ""){
			alert("กรุณาเลือกระบบงานย่อย");
		}else if(frm1.person_id.value==""){
			alert("กรุณาเลือกเจ้าหน้าที่ผู้รับผิดชอบ");
		}else{
			callfrm("?file=module_admin&index=6");   //page ประมวลผล
		}
	}
}
</script>
