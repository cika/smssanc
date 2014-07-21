<script type="text/javascript" src="../jquery/jquery-1.5.1.js"></script> 
<script type="text/javascript">

$(function(){
	$("select#module").change(function(){
		var datalist2 = $.ajax({	// รับค่าจาก ajax เก็บไว้ที่ตัวแปร datalist2
			  url: "section/default/show_name_th.php", // ไฟล์สำหรับการกำหนดเงื่อนไข
			  data:"module="+$(this).val(), // ส่งตัวแปร GET ชื่อ moduleให้มีค่าเท่ากับ ค่าของ module
			  async: false
		}).responseText;		
		$("div#displayAJAX").html(datalist2); // นำค่า datalist2 มาแสดงใน listbox ที่ 2 ที่ชื่อ displayAJAX
		// ชื่อตัวแปร และ element ต่างๆ สามารถเปลี่ยนไปตามการกำหนด
	});
});
</script>

<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );

if(!isset($_POST['url'])){
$_POST['url']="";
}

//ส่วนหัว
echo "<br />";
if(!(($index==1) or ($index==1.1) or ($index==1.2) or ($index==2) or ($index==5))){
echo "<table width='50%' border='0' align='center'>";
echo "<tr align='center'><td><font color='#006666' size='3'><strong>ระบบงานย่อย (Module)</strong></font></td></tr>";
echo "</table>";
}

//ส่วนฟอร์มรับข้อมูล
if($index==1){
echo "<form id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>เพิ่ม ระบบงานย่อย (Module)</Font>";
echo "</Cener>";
echo "<Br><Br><Br>";
echo "<Table width='50%' Border='0' Bgcolor='#Fcf9d8'>";
echo "<Tr><Td align='right' width='50%' >ชื่อระบบงานย่อย(อังกฤษ)&nbsp;&nbsp;&nbsp;&nbsp;</Td>
<Td align='left' width='50%' >";
echo"<select name='module' id='module'>";
echo"<option value=''><-------------เลือก------------></option>";
$dir = "../modules";
if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
		header("Content-Type:text/javascript; charset=utf-8");
                if (($file == '.')||($file == '..')||($file == 'defualt'))
                {
                }
               else  
                {
					echo"<option value='".$file."'>".$file."</option>";
			     }
        }
        closedir($dh);
    }
}
echo"</select>
</Td></Tr>";
echo "<Tr><Td align='right'>ชื่อระบบงานย่อย(ไทย)&nbsp;&nbsp;&nbsp;&nbsp;</Td><Td align='left'><div id=displayAJAX></div></Td></Tr>";
echo "<Tr><Td align='right'>กลุ่ม(งาน)&nbsp;&nbsp;&nbsp;&nbsp;</Td><Td align='left'><Select name='workgroup' size='1'>";
echo  "<option  value = ''>เลือก</option>" ;
$sql = "select  * from system_workgroup";
$dbquery = mysql_query($sql);
While ($result = mysql_fetch_array($dbquery))
   {
		$workgroup = $result['workgroup'];
		$workgroup_desc = $result['workgroup_desc'];
		echo  "<option value = $workgroup>$workgroup_desc</option>" ;
	}
echo "</select>";
echo "</Td></Tr>";
echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
echo "<tr><td align='right'><INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url(1)' class=entrybutton>
	&nbsp;&nbsp;&nbsp;</td>";
echo "<td align='left'><INPUT TYPE='button' name='back' value='ย้อนกลับ' onclick='goto_url(0)' class=entrybutton'></td></tr>";
echo "</Table>";
echo "<Input Type=Hidden Name='web_link' Value='0'>";
echo "</form>";
echo "<br>";
echo "<div align='center'>*กรณีเลือกชื่อระบบงานย่อย(อังกฤษ) ไม่ได้ <a href=?file=module&index=1.2>คลิก</a></div>";
}

if($index==1.1){
echo "<form id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>เพิ่ม ระบบงานย่อยจากภายนอก (Weblink)</Font>";
echo "</Cener>";
echo "<Br><Br><Br>";
echo "<Table width='80%' Border='0' Bgcolor='#Fcf9d8'>";
echo "<Tr><Td align='right' width='50%' >ชื่อระบบงานย่อย(อังกฤษ)&nbsp;&nbsp;&nbsp;&nbsp;</Td>
<Td align='left'><Input Type='Text' Name='module' Size='30'></Td></Tr>";
echo "<Tr><Td align='right'>ชื่อระบบงานย่อย(ไทย)&nbsp;&nbsp;&nbsp;&nbsp;</Td><Td align='left'><Input Type='Text' Name='module_desc' Size='30'></Td></Tr>";
echo "<Tr><Td align='right'>URL&nbsp;&nbsp;&nbsp;&nbsp;</Td><Td align='left'><Input Type='Text' Name='url' Size='30'></Td></Tr>";
echo "<Tr><Td align='right'>กลุ่ม(งาน)&nbsp;&nbsp;&nbsp;&nbsp;</Td><Td align='left'><Select name='workgroup' size='1'>";
echo  "<option  value = ''>เลือก</option>" ;
$sql = "select  * from system_workgroup";
$dbquery = mysql_query($sql);
While ($result = mysql_fetch_array($dbquery))
   {
		$workgroup = $result['workgroup'];
		$workgroup_desc = $result['workgroup_desc'];
		echo  "<option value = $workgroup>$workgroup_desc</option>" ;
	}
echo "</select>";
echo "</Td></Tr>";

echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
echo "<tr><td align='right'><INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url2(1)' class=entrybutton>
	&nbsp;&nbsp;&nbsp;</td>";
echo "<td align='left'><INPUT TYPE='button' name='back' value='ย้อนกลับ' onclick='goto_url(0)' class=entrybutton'></td></tr>";
echo "</Table>";
echo "<Input Type=Hidden Name='web_link' Value='1'>";
echo "</form>";
}

if($index==1.2){
echo "<form id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>เพิ่ม ระบบงานย่อย (Module)</Font>";
echo "</Cener>";
echo "<Br><Br>";
echo "<Table width='50%' Border='0' Bgcolor='#Fcf9d8'>";
echo "<Tr><Td align='right' width='50%' >ชื่อระบบงานย่อย(อังกฤษ)&nbsp;&nbsp;&nbsp;&nbsp;</Td><Td align='left' width='50%' ><Input Type='Text' Name='module' Size='20' ></Td></Tr>";
echo "<Tr><Td align='right'>ชื่อระบบงานย่อย(ไทย)&nbsp;&nbsp;&nbsp;&nbsp;</Td><Td align='left'><Input Type='Text' Name='module_desc' Size='20'></Td></Tr>";
echo "<Tr><Td align='right'>กลุ่ม(งาน)&nbsp;&nbsp;&nbsp;&nbsp;</Td><Td align='left'><Select name='workgroup' size='1'>";
echo  "<option  value = ''>เลือก</option>" ;
$sql = "select  * from system_workgroup";
$dbquery = mysql_query($sql);
While ($result = mysql_fetch_array($dbquery))
   {
		$workgroup = $result['workgroup'];
		$workgroup_desc = $result['workgroup_desc'];
		echo  "<option value = $workgroup>$workgroup_desc</option>" ;
	}
echo "</select>";
echo "</Td></Tr>";
echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
echo "<tr><td align='right'><INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url(1)' class=entrybutton>
	&nbsp;&nbsp;&nbsp;</td>";
echo "<td align='left'><INPUT TYPE='button' name='back' value='ย้อนกลับ' onclick='goto_url(0)' class=entrybutton'></td></tr>";
echo "</Table>";
echo "<Input Type=Hidden Name='web_link' Value='0'>";
echo "</form>";
}

//ส่วนยืนยันการลบข้อมูล
if($index==2) {
echo "<table width='500' border='0' align='center'>";
echo "<tr><td align='center'><font color='#990000' size='4'>โปรดยืนยันความต้องการลบข้อมูลอีกครั้ง</font><br></td></tr>";
echo "<tr><td align=center>";
echo "<INPUT TYPE='button' name='smb' value='ยืนยัน' onclick='location.href=\"?file=module&index=3&id=$_GET[id]&page=$_REQUEST[page]\"'>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ยกเลิก' onclick='location.href=\"?file=module&page=$_REQUEST[page]\"'";
echo "</td></tr></table>";
}

//ส่วนลบข้อมูล
if($index==3){
$sql = "delete from system_module where id=$_GET[id]";
$dbquery = mysql_query($sql);
}

//ส่วนบันทึกข้อมูล
if($index==4){
$sql = "select * from system_module where module='$_POST[module]'";
$dbquery_module = mysql_query($sql);
$module_num=mysql_num_rows($dbquery_module);
	if($module_num>=1){
	echo "<div align='center'>Module นี้ได้ติดตั้งไว้แล้ว ยกเลิกการดำเนินการ</div>";
	exit();
	}
	else{
			$table_create_file = "../modules/$_POST[module]/install/create_table.php";
			if(file_exists($table_create_file)) {
			require_once("$table_create_file");
			}

	//ตรวจสอบว่ามีโฟลเดอร์หรือไม่
if($_POST['web_link']==0){	
		if(!(file_exists("../modules/$_POST[module]"))){
		echo "<div align='center'>ไม่มีระบบงานย่อยชื่อ $_POST[module] อยู่ในระบบ ตรวจสอบความถูกต้องอีกครั้ง</div>";
		exit();
		}
}

if(isset($_POST['module'])){
	$sql = "insert into system_module (module, module_desc, workgroup, module_active, web_link, url) values ('$_POST[module]', '$_POST[module_desc]','$_POST[workgroup]','1','$_POST[web_link]','$_POST[url]')";
	$dbquery = mysql_query($sql);
}
	}
}

//ส่วนฟอร์มแก้ไขข้อมูล
if ($index==5){
echo "<form id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>แก้ไข ระบบงานย่อย</B></Font>";
echo "</Cener>";
echo "<Br><Br>";
echo "<Table width='50%' Border= '0' Bgcolor='#Fcf9d8'>";

$sql = "select * from system_module where id='$_GET[id]'";
$dbquery = mysql_query($sql);
$ref_result = mysql_fetch_array($dbquery);

echo "<Tr><Td align='right'>ชื่อระบบงานย่อย(อังกฤษ)&nbsp;&nbsp;&nbsp;&nbsp;</Td><Td align='left'><Input Type='Text' Name='module' Size='20' value='$ref_result[module]' disabled='disabled'></Td></Tr>";

echo "<Tr><Td align='right'>ชื่อระบบงานย่อย(ไทย)&nbsp;&nbsp;&nbsp;&nbsp;</Td><Td align='left'><Input Type='Text' Name='module_desc' Size='20' value='$ref_result[module_desc]' ></Td></Tr>";

echo "<Tr><Td align='right'>กลุ่ม(งาน)&nbsp;&nbsp;&nbsp;&nbsp;</Td><Td align='left'><Select name='workgroup' size='1'>";
echo  "<option  value = ''>เลือก</option>" ;
$sql = "select  * from system_workgroup";
$dbquery = mysql_query($sql);
While ($result = mysql_fetch_array($dbquery))
   {
		$workgroup = $result['workgroup'];
		$workgroup_desc = $result['workgroup_desc'];
			if($workgroup==$ref_result['workgroup']){
			echo  "<option value = $workgroup selected>$workgroup_desc</option>" ;
			}
			else{
			echo  "<option value = $workgroup>$workgroup_desc</option>" ;
			}
	}
echo "</select>";
echo "</Td></Tr>";

echo "<Tr><Td align='right'>ประเภทระบบงาน&nbsp;&nbsp;&nbsp;&nbsp;</Td><Td align='left'><Select name='web_link' size='1'>";
			if($ref_result['web_link']==1){
			echo  "<option value=0>ระบบงานย่อยภายในAMSS++</option>" ;
			echo  "<option value=1 selected>เชื่อมโยงไปโปรแกรมภายนอก</option>" ;
			}
			else{
			echo  "<option value=0 selected>ระบบงานย่อยภายในAMSS++</option>" ;
			echo  "<option value=1>เชื่อมโยงไปโปรแกรมภายนอก</option>" ;
			}
echo "</select>";
echo "</Td></Tr>";

echo "<Tr><Td align='right'>*กรณี Weblink ระบุ URL&nbsp;&nbsp;&nbsp;&nbsp;</Td><Td align='left'><Input Type='Text' Name='url' Size='30' value='$ref_result[url]' ></Td></Tr>";

echo "<Tr><Td align='right'>สถานะการทำงาน&nbsp;&nbsp;&nbsp;&nbsp;</Td>";
echo "<td><div align='left'><Select  name='module_active' size='1'>";
echo  "<option  value = ''>เลือก</option>" ;
	if($ref_result['module_active']==1){
	$select1="selected";
	$select2="";
	}
	else{
	$select1="";
	$select2="selected";
	}
echo  "<option value = '1' $select1>เปิดการใช้งาน</option>";
echo  "<option value = '0' $select2>ปิดการใช้งาน</option>";
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
$sql = "update system_module set  module_desc='$_POST[module_desc]', workgroup='$_POST[workgroup]', module_active='$_POST[module_active]', web_link='$_POST[web_link]', url='$_POST[url]' where id='$_POST[id]'";
$dbquery = mysql_query($sql);
}
if ($index==6.5){
$sql = "select * from system_module order by module_order";
$dbquery = mysql_query($sql);
$order_number=1;
While ($result = mysql_fetch_array($dbquery)){
	if($_GET['module_order']==1 and $result['id']==$_GET['id']){
	$module_order=($order_number*2)-3;
	}
	else if($_GET['module_order']==-1 and $result['id']==$_GET['id']){
	$module_order=($order_number*2)+3;
	}
	else{
	$module_order=($order_number*2)	;
	}
	$sql_order="update system_module set  module_order='$module_order' where id='$result[id]'";
	$dbquery_order = mysql_query($sql_order);
$order_number++;
	}
}

//ส่วนปรับปรุงสถานะmodule
if ($index==7){
	if($_GET['module_active']==1){
	$module_active=0;
	}
	else{
	$module_active=1;
	}
$sql = "update system_module set module_active='$module_active' where id='$_GET[id]'";
$dbquery = mysql_query($sql);
}

//ส่วนแสดงผล
if(!(($index==1) or ($index==1.1) or ($index==1.2) or ($index==2) or ($index==5))){

	//ส่วนของการแยกหน้า
$pagelen=20;  // 1_กำหนดแถวต่อหน้า
$url_link="file=module";  // 2_กำหนดลิงค์
$sql = "select * from system_module"; // 3_กำหนด sql

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

$sql = "select system_module.id,system_module.module,system_module.module_desc,system_module.web_link,system_module.module_active,system_workgroup.workgroup_desc from system_module left join system_workgroup on system_module.workgroup=system_workgroup.workgroup order by system_module.module_order limit $start,$pagelen";

$dbquery = mysql_query($sql);
$num_effect = mysql_num_rows($dbquery );  // จำนวนข้อมูลในหน้านี้
echo  "<table width=85% border=0 align=center>";
echo "<Tr><Td colspan='7' align='left'><INPUT TYPE='button' name='smb' value='เพิ่มระบบงานย่อยภายใน (Module)' onclick='location.href=\"?file=module&index=1\"'><INPUT TYPE='button' name='smb' value='เพิ่มระบบงานย่อยจากภายนอก (Weblink)' onclick='location.href=\"?file=module&index=1.1\"'></Td></Tr>";

echo "<Tr bgcolor='#FFCCCC'><Td  align='center' width='50'>ที่</Td><Td  align='center' width='170'>ชื่อระบบงานย่อย(อังกฤษ)</Td><Td  align='center'>ชื่อระบบงานย่อย(ไทย)</Td><Td  align='center'>ประเภท</Td><Td  align='center'>กลุ่ม</Td><Td align='center'  width='50'>ลำดับ</Td><Td align='center'  width='90'>สถานะใช้งาน</Td><Td align='center'  width='50'>ลบ</Td><Td align='center' width='50'>แก้ไข</Td></Tr>";

$N=(($page-1)*$pagelen)+1;  //*เกี่ยวข้องกับการแยกหน้า
$M=1;

While ($result = mysql_fetch_array($dbquery))
	{
		$id = $result['id'];
		$module= $result['module'];
		$module_desc = $result['module_desc'];
		$module_active = $result['module_active'];
		$menugroup_desc = $result['workgroup_desc'];	
		$web_link = $result['web_link'];		
		if($web_link==1){
		$type_text="weblink ภายนอก";
		}
		else{
		$type_text="module ภายใน";
		}
			
		if(($M%2) == 0)
			$color="#FFFFC";
			else  	$color="#FFFFFF";
			if($module_active==1){
			$module_active_index="<img src=../images/yes.png border='0' alt='ปัจจุบัน:เปิดการใช้งาน'>";
			}	
			else{
			$module_active_index="<img src=../images/publish_x.png border='0' alt='ปัจจุบัน:ปิดการใช้งาน'>";
			}
		echo "<Tr bgcolor=$color><Td align='center'>$N</Td><Td  align='left'>$module</Td><Td align='left'>$module_desc</Td><Td align='center'>$type_text</Td><Td align='left'>$menugroup_desc</Td>";
		
		echo "<Td align='center'>";
		if(!($M==1 and $page==1)){
		echo "<a href=?file=module&index=6.5&id=$id&module_order=1&page=$page><img src=../images/uparrow.png border='0' alt='ขึ้นด้านบน'></a>";
		}
		if(!($M==$num_effect and $page==$totalpages)){
		echo "<a href=?file=module&index=6.5&id=$id&module_order=-1&page=$page><img src=../images/downarrow.png border='0' alt='ลงด้านล่าง'></a>";
		}
		echo "</Td>";
		
		echo "<Td align='center'><a href=?file=module&index=7&id=$id&module_active=$module_active&page=$page>$module_active_index</a></Td>
		<Td align='center'><a href=?file=module&index=2&id=$id&page=$page><img src=../images/drop.png border='0' alt='ลบ'></a></Td>
		<Td align='center'><a href=?file=module&index=5&id=$id&page=$page><img src=../images/edit.png border='0' alt='แก้ไข'></a></Td>
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
		callfrm("?file=module");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.module.value == ""){
			alert("กรุณากรอกชื่อระบบงานย่อย(อังกฤษ)");
		}else if(frm1.module_desc.value==""){
			alert("กรุณากรอกชื่อระบบงานย่อย(ไทย)");
		}else if(frm1.workgroup.value==""){
			alert("กรุณาเลือกกลุ่ม");
		}else{
			callfrm("?file=module&index=4");   //page ประมวลผล
		}
	}
}

function goto_url2(val){
	if(val==0){
		callfrm("?file=module");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.module.value == ""){
			alert("กรุณากรอกชื่อระบบงานย่อย(อังกฤษ)");
		}else if(frm1.module_desc.value==""){
			alert("กรุณากรอกชื่อระบบงานย่อย(ไทย)");
		}else if(frm1.workgroup.value==""){
			alert("กรุณาเลือกกลุ่ม");
		}else{
			callfrm("?file=module&index=4");   //page ประมวลผล
		}
	}
}

function goto_url_update(val){
	if(val==0){
		callfrm("?file=module");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.module.value == ""){
			alert("กรุณากรอกชื่อระบบงานย่อย(อังกฤษ)");
		}else if(frm1.module_desc.value==""){
			alert("กรุณากรอกชื่อระบบงานย่อย(ไทย)");
		}else if(frm1.workgroup.value==""){
			alert("กรุณาเลือกกลุ่ม");
		}else{
			callfrm("?file=module&index=6");   //page ประมวลผล
		}
	}
}
</script>
