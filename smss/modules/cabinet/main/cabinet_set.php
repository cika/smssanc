<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
//sd page 
$user=$_SESSION['login_user_id'];
if($result_permission['p1']!=1){
exit();
}
echo "<br />";

if(!(($index==1) or ($index==2) or ($index==5))){
echo "<table width='50%' border='0' align='center'>";
echo "<tr align='center'><td><font color='#006666' size='3'><strong>ตู้เอกสาร</strong></font></td></tr>";
echo "</table>";
}
//ส่วนเพิ่มข้อมูล
if($index==1){
echo "<form id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>เพิ่มตู้เอกสาร</B></Font>";
echo "</Cener>";
echo "<Br><Br>";
echo "<Table  width='50%' >";
echo "<Tr align='left'><Td align='right'>เลขที่ตู้เอกสาร&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='cabinet_id'  Size='5'></Td></Tr>";
echo "<Tr><Td align='right'>ประเภทตู้เอกสาร&nbsp;&nbsp;</Td>";
echo "<td><div align='left'><Select  name='cabinet_type'  id='cabinet_type' size='1' onchange='e_show()'>";
echo  "<option  value = ''>เลือก</option>" ;
echo  "<option value=1>ตู้เอกสารกลาง</option>" ;
echo  "<option value=2>ตู้เอกสารส่วนบุคคล</option>" ;
echo "</select>";
echo "</div></td></tr>";
echo "<Tr align='left'><Td align='right'>ชื่อตู้เอกสาร&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='cabinet_name'  id='cabinet_name'  Size='60'></Td></Tr>";
echo "<Tr align='left'><Td align='right'>ขนาดตู้&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='cabinet_size'  Size='5'>&nbsp;(MB)</Td></Tr>";
echo "<Tr align='left'><Td align='right'>ขนาดลิ้นชัก&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='tray_size'  id='tray_size' Size='5'>&nbsp;(MB)</Td></Tr>";
echo "<Tr><Td align='right'>ผู้จัดการตู้&nbsp;&nbsp;</Td>";
echo "<td><div align='left'><Select  name='cabinet_person'  id='cabinet_person'  size='1'>";
echo  "<option  value = ''>เลือก</option>" ;
$sql = "select  * from person_main where status='0' order by name";
$dbquery = mysql_query($sql);
While ($result = mysql_fetch_array($dbquery))
   {
		$person_id = $result['person_id'];
		$name = $result['name'];
		$surname = $result['surname'];
		echo  "<option value = $person_id>$name $surname</option>" ;
	}
echo "</select>";
echo "</div></td></tr>";
echo "<Br>";
echo "</Table>";
echo "<Br>";
echo "<INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url(1)' class=entrybutton>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ย้อนกลับ' onclick='goto_url(0)' class=entrybutton'>";
echo "</form>";
echo "<br /><br /><br />";
echo "<div align='left'>";
echo "&nbsp;&nbsp;&nbsp;<b>หมายเหตุ</b><br />";
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1. ตู้เอกสารส่วนบุคคลหน่วยงานหนึ่งมีได้เพียงตู้เดียว  โดยจะกำหนดให้คนละ 1 ลิ้นชักในภายหลัง  การตั้งชื่อให้สื่อความหมาย  เช่น  ส่วนบุคคล  เป็นต้น<br />";
echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2. ตู้เอกสารกลางควรกำหนดให้กลุ่มละ 1 ตู้  การตั้งชื่อให้สื่อความหมาย  เช่น  อำนวยการ นโยบายและแผน เป็นต้น <br />";
echo "</div>";
}

//ส่วนยืนยันการลบข้อมูล
if($index==2) {
echo "<table width='500' border='0' align='center'>";
echo "<tr><td align='center'><font color='#990000' size='4'>โปรดยืนยันความต้องการลบข้อมูลอีกครั้ง</font><br></td></tr>";
echo "<tr><td align=center>";
echo "<INPUT TYPE='button' name='smb' value='ยืนยัน' onclick='location.href=\"?option=cabinet&task=main/cabinet_set&index=3&id=$_GET[id]&page=$_REQUEST[page]\"'>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ยกเลิก' onclick='location.href=\"?option=cabinet&task=main/cabinet_set&page=$_REQUEST[page]\"'";
echo "</td></tr></table>";
}

//ส่วนลบข้อมูล
if($index==3){
$sql = "delete from cabinet_cabinet where  id=$_GET[id]";
$dbquery = mysql_query($sql);
}

//ส่วนเพิ่มข้อมูล
if($index==4){
$sql = "select * from cabinet_cabinet where  cabinet_id='$_POST[cabinet_id]' ";
$dbquery = mysql_query($sql);
if(mysql_num_rows($dbquery)>=1){
echo "<br /><div align='center'>เลขที่ตู้เอกสารซ้ำกับที่มีอยู่แล้ว ตรวจสอบอีกครั้ง</div>";
exit();  
}
		if($_POST['cabinet_type']==2){
					$_POST['cabinet_person']=$user;
					$sql = "select * from cabinet_cabinet  where  cabinet_type='$_POST[cabinet_type]' ";
					$dbquery = mysql_query($sql);
					if(mysql_num_rows($dbquery)>=1){
					echo "<br /><div align='center'>มีประเภทตู้ส่วนบุคคลอยู่แล้ว  ไม่อนุญาตให้มีตู้ที่ 2</div>";
					exit();  
					}
		}
$sql = "insert into cabinet_cabinet (cabinet_id, cabinet_type, cabinet_name, cabinet_size, tray_size, cabinet_person) values ( '$_POST[cabinet_id]', '$_POST[cabinet_type]', '$_POST[cabinet_name]', '$_POST[cabinet_size]',  '$_POST[tray_size]',  '$_POST[cabinet_person]')";
$dbquery = mysql_query($sql);
}

//ส่วนฟอร์มแก้ไขข้อมูล
if ($index==5){
echo "<form id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>แก้ไข</B></Font>";
echo "</Cener>";
echo "<Br><Br>";
$sql = "select * from  cabinet_cabinet where  id='$_GET[id]'";
$dbquery = mysql_query($sql);
$ref_result = mysql_fetch_array($dbquery);

echo "<Table  width='50%'>";
echo "<Tr align='left'><Td align='right'>เลขที่ตู้เอกสาร&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='cabinet_id'  Size='5' value='$ref_result[cabinet_id]'></Td></Tr>";
echo "<Tr><Td align='right'>ประเภทตู้เอกสาร&nbsp;&nbsp;</Td>";
echo "<td><div align='left'><Select  name='cabinet_type'  size='1'>";
echo  "<option  value = ''>เลือก</option>" ;
if($ref_result ['cabinet_type']==1){
echo  "<option value=1 selected>ตู้เอกสารกลาง</option>" ;
echo  "<option value=2>ตู้เอกสารส่วนบุคคล</option>" ;
}
else if($ref_result ['cabinet_type']==2){
echo  "<option value=1>ตู้เอกสารกลาง</option>" ;
echo  "<option value=2 selected>ตู้เอกสารส่วนบุคคล</option>" ;
}
echo "</select>";
echo "</div></td></tr>";
echo "<Tr align='left'><Td align='right'>ชื่อตู้เอกสาร&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='cabinet_name'  Size='60' value='$ref_result[cabinet_name]'></Td></Tr>";
echo "<Tr align='left'><Td align='right'>ขนาดตู้&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='cabinet_size'  Size='5' value='$ref_result[cabinet_size]'>&nbsp;(MB)</Td></Tr>";
echo "<Tr align='left'><Td align='right'>ขนาดลิ้นชัก&nbsp;&nbsp;</Td><Td><Input Type='Text' Name='tray_size'  Size='5' value='$ref_result[tray_size]'>&nbsp;(MB)</Td></Tr>";
echo "<Tr><Td align='right'>ผู้จัดการตู้&nbsp;&nbsp;</Td>";
echo "<td><div align='left'><Select  name='cabinet_person'  size='1'>";
echo  "<option  value = ''>เลือก</option>" ;
$sql = "select  * from person_main where status='0' order by name";
$dbquery = mysql_query($sql);
While ($result = mysql_fetch_array($dbquery))
   {
		$person_id = $result['person_id'];
		$name = $result['name'];
		$surname = $result['surname'];
				if($ref_result['cabinet_person']==$person_id){
				echo  "<option value = $person_id selected>$name $surname</option>" ;
				}
				else{
				echo  "<option value = $person_id>$name $surname</option>" ;
				}
	}
echo "</select>";
echo "</div></td></tr>";
echo "</Table>";
echo "<Br />";
echo "<Input Type=Hidden Name='id' Value='$_GET[id]'>";
echo "<Input Type=Hidden Name='page' Value='$_GET[page]'>";
echo "<INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url_update(1)' class=entrybutton>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ย้อนกลับ' onclick='goto_url_update(0)' class=entrybutton'>";

echo "</form>";
}
//ส่วนปรับปรุงข้อมูล
if ($index==6){
$sql = "select * from cabinet_cabinet  where  cabinet_id='$_POST[cabinet_id]'  and id!='$_POST[id]' ";
$dbquery = mysql_query($sql);
if(mysql_num_rows($dbquery)>=1){
echo "<br /><div align='center'>มีเลขที่ตู้เอกสารซ้ำกับที่มีอยู่แล้ว ตรวจสอบอีกครั้ง</div>";
exit();  
}
		if($_POST['cabinet_type']==2){
					$_POST['cabinet_person']=$user;
					$sql = "select * from cabinet_cabinet  where  cabinet_type='$_POST[cabinet_type]'  and id!='$_POST[id]' ";
					$dbquery = mysql_query($sql);
					if(mysql_num_rows($dbquery)>=1){
					echo "<br /><div align='center'>มีประเภทตู้ส่วนบุคคลอยู่แล้ว  ไม่อนุญาตให้มีตู้ที่ 2</div>";
					exit();  
					}
		}

$sql = "update cabinet_cabinet set cabinet_id='$_POST[cabinet_id]', 
cabinet_type='$_POST[cabinet_type]' ,
cabinet_name='$_POST[cabinet_name]' ,
cabinet_size='$_POST[cabinet_size]' ,
tray_size='$_POST[tray_size]' ,
cabinet_person='$_POST[cabinet_person]' 
where id='$_POST[id]'";
$dbquery = mysql_query($sql);
}

//ส่วนการแสดงผล
if(!(($index==1) or ($index==2) or ($index==5))){

//ส่วนของการแยกหน้า
$pagelen=20;  // 1_กำหนดแถวต่อหน้า
$url_link="option=cabinet&task=main/cabinet_set";  // 2_กำหนดลิงค์ฺ
$sql = "select * from  cabinet_cabinet"; // 3_กำหนด sql

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

$sql = "select cabinet_cabinet.id, cabinet_cabinet.cabinet_id, cabinet_cabinet.cabinet_type, cabinet_cabinet.cabinet_name, cabinet_cabinet.cabinet_size, cabinet_cabinet.tray_size, person_main.prename, person_main.name, person_main.surname  from cabinet_cabinet  left join person_main on cabinet_cabinet.cabinet_person=person_main.person_id order by cabinet_id  limit $start,$pagelen";
$dbquery = mysql_query($sql);
echo  "<table width='85%' border='0' align='center'>";
echo "<Tr><Td colspan='7' align='left'><INPUT TYPE='button' name='smb' value='เพิ่มตู้เอกสาร' onclick='location.href=\"?option=cabinet&task=main/cabinet_set&index=1\"'>";
echo "</Td></Tr>";
echo "<Tr bgcolor=#FFCCCC align='center' ><Td width='100'>เลขที่ตู้</Td><Td>ชื่อตู้เอกสาร</Td><Td width='150'>ประเภทตู้เอกสาร</Td><Td width='100'>ขนาดตู้(MB)</Td><Td width='100'>ขนาดลิ้นชัก(MB)</Td><Td width='200'>ผู้จัดการ</Td><Td width='50'>ลบ</Td><Td width='50'>แก้ไข</Td></Tr>";
$N=(($page-1)*$pagelen)+1;  //*เกี่ยวข้องกับการแยกหน้า
$M=1;
While ($result = mysql_fetch_array($dbquery))
	{
		$id = $result['id'];
			if(($M%2) == 0)
			$color="#FFFFC";
			else  	$color="#FFFFFF";
if($result ['cabinet_type']==1){
$cabinet_type="ตู้เอกสารกลาง";
}
else if($result ['cabinet_type']==2){
$cabinet_type="ตู้เอกส่วนบุคคล";
}
		echo "<Tr  bgcolor=$color align='center'><Td>$result[cabinet_id]</Td><td align='left'>$result[cabinet_name]</td><td align='left'>$cabinet_type</td><Td align='center'>$result[cabinet_size]</Td><Td align='center'>$result[tray_size]</Td> <Td align='left'>$result[prename]$result[name]&nbsp;$result[surname]</Td><Td><div align='center'><a href=?option=cabinet&task=main/cabinet_set&index=2&id=$id&page=$page><img src=images/drop.png border='0' alt='ลบ'></a></div></Td>
		<Td><a href=?option=cabinet&task=main/cabinet_set&index=5&id=$id&page=$page><img src=images/edit.png border='0' alt='แก้ไข'></a></div></Td>
	</Tr>";
$M++;
$N++;  //*เกี่ยวข้องกับการแยกหน้า
	}
echo "</Table>";
}

?>
<script>
function e_show(){
		if(document.getElementById("cabinet_type").value=="2"){
		document.getElementById("cabinet_name").value="ส่วนบุคคล";
		document.getElementById("cabinet_person").value="<?php echo $user;?>";
		}
		else if(document.getElementById("cabinet_type").value=="1"){
		document.getElementById("cabinet_name").value="";
		}
}

function goto_url(val){
	if(val==0){
		callfrm("?option=cabinet&task=main/cabinet_set");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.cabinet_id.value == ""){
			alert("กรุณากรอกเลขที่ตู้เอกสาร");
		}else if(frm1.cabinet_name.value==""){
			alert("กรุณากรอกชื่อตู้เอกสาร");
		}else if(frm1.cabinet_size.value==""){
			alert("กรุณากรอกขนาดตู้เอกสาร");
		}else if(frm1.tray_size.value==""){
			alert("กรุณากรอกขนาดลิ้นชักเอกสาร");
		}else if(frm1.cabinet_person.value==""){
			alert("กรุณากำหนดผู้จัดการตู้เอกสาร");
		}else{
			callfrm("?option=cabinet&task=main/cabinet_set&index=4");   //page ประมวลผล
		}
	}
}

function goto_url_update(val){
	if(val==0){
		callfrm("?option=cabinet&task=main/cabinet_set");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.cabinet_id.value == ""){
			alert("กรุณากรอกเลขที่ตู้เอกสาร");
		}else if(frm1.cabinet_name.value==""){
			alert("กรุณากรอกชื่อตู้เอกสาร");
		}else if(frm1.cabinet_size.value==""){
			alert("กรุณากรอกขนาดตู้เอกสาร");
		}else if(frm1.tray_size.value==""){
			alert("กรุณากรอกขนาดลิ้นชักเอกสาร");
		}else if(frm1.cabinet_person.value==""){
			alert("กรุณากำหนดผู้จัดการตู้เอกสาร");
		}else{
			callfrm("?option=cabinet&task=main/cabinet_set&index=6");   //page ประมวลผล
		}
	}
}
</script>
