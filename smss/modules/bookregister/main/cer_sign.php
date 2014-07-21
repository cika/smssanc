<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );

//ส่วนหัว
echo "<br />";
if(!(($index==1) or ($index==2) or ($index==5))){
echo "<table width='50%' border='0' align='center'>";
echo "<tr align='center'><td><font color='#006666' size='3'><strong>ผู้ลงนามเกียรติบัตร</strong></font></td></tr>";
echo "</table>";
}

//ส่วนฟอร์มรับข้อมูล
if($index==1){
echo "<form Enctype = multipart/form-data id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>ผู้ลงนามเกียรติบัตร</Font>";
echo "</Cener>";
echo "<Br><Br>";
echo "<Table width='50%' Border='0' Bgcolor='#Fcf9d8'>";

echo "<Tr><Td align='right'>รหัส&nbsp;&nbsp;</Td>";
echo "<td align='left'><input type='text' name='code' size='2' >";
echo "</td></tr>";

echo "<Tr><Td align='right'>ชื่อ&nbsp;&nbsp;</Td>";
echo "<td align='left'><input type='text' name='name' size='40'>";
echo "</td></tr>";
echo "<Tr><Td align='right'>ตำแหน่งบรรทัดที่ 1&nbsp;&nbsp;</Td>";
echo "<td align='left'><input type='text' name='position1' size='80'>";
echo "</td></tr>";
echo "<Tr><Td align='right'>ตำแหน่งบรรทัดที่ 2 (ถ้ามี)&nbsp;&nbsp;</Td>";
echo "<td align='left'><input type='text' name='position2' size='80'>";
echo "</td></tr>";
echo "<Tr><Td align='right'>ลายมือชื่อ&nbsp;&nbsp;</Td>";
echo "<td align='left'><input type='file'  name='myfile1' size='50'>";
echo "</td></tr>";


echo   "<tr><td align='right'>เป็นผู้ลงนามปัจจุบัน&nbsp;&nbsp;</td>";
echo   "<td align='left'>ใช่<input  type=radio name='sign_now' value='1' checked>&nbsp;&nbsp;ไม่ใช่<input  type=radio name='sign_now' value='0'></td></tr>";

echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
echo "<tr><td align='right'><INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url(1)'>
	&nbsp;&nbsp;</td>";
echo "<td align='left'><INPUT TYPE='button' name='back' value='ย้อนกลับ' onclick='goto_url(0)'></td></tr>";
echo "</Table>";
echo "</form>";
}

//ส่วนยืนยันการลบข้อมูล
if($index==2) {
echo "<table width='500' border='0' align='center'>";
echo "<tr><td align='center'><font color='#990000' size='4'>โปรดยืนยันความต้องการลบข้อมูลอีกครั้ง</font><br></td></tr>";
echo "<tr><td align=center>";
echo "<INPUT TYPE='button' name='smb' value='ยืนยัน' onclick='location.href=\"?option=bookregister&task=main/cer_sign&index=3&id=$_GET[id]\"'>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ยกเลิก' onclick='location.href=\"?option=bookregister&task=main/cer_sign\"'";
echo "</td></tr></table>";
}

//ส่วนลบข้อมูล
if($index==3){
$sql = "delete from bookregister_cer_sign where id=$_GET[id]";
$dbquery = mysql_query($sql);
echo "<script>document.location.href='?option=bookregister&task=main/cer_sign'; </script>\n";
}

//ส่วนบันทึกข้อมูล
if($index==4){

$sizelimit = 20000*1024 ;  //ขนาดไฟล์

$upfile1=""; 
$sizelimit1="";

/// file
$myfile1 = $_FILES ['myfile1'] ['tmp_name'] ;
$myfile1_name = $_FILES ['myfile1'] ['name'] ;
$myfile1_size = $_FILES ['myfile1'] ['size'] ;
$myfile1_type = $_FILES ['myfile1'] ['type'] ;

 $array_last1 = explode("." ,$myfile1_name) ;
 $c1 =count ($array_last1) - 1 ;
 $lastname1 = strtolower ($array_last1 [$c1] ) ;

 if  ($myfile1<>"") {
 if ($lastname1 =="jpg" or $lastname1 =="gif" or $lastname1 =="png") { 
	 $upfile1 = "" ; 
  }else {
	 $upfile1 = "-ไม่อนุญาตให้ทำการแนบไฟล์ $myfile1_name<BR> " ;
  } 

  If ($myfile1_size>$sizelimit) {
	  $sizelimit1 = "-ไฟล์ $myfile1_name มีขนาดใหญ่กว่าที่กำหนด<BR>" ;
  }else {
		$sizelimit1 = "" ;
  }
 }
  ####

////

// check file size  file name
if ($upfile1<> "" || $sizelimit1<> "") {

echo "<B><FONT SIZE=2 COLOR=#990000>มีข้อผิดพลาดเกี่ยวกับไฟล์ของคุณ ดังรายละเอียด</FONT></B><BR>" ;
echo "<FONT SIZE=2 COLOR=#990099>" ;
 echo  $upfile1 ;
 echo  $sizelimit1 ;
 echo "</FONT>" ;
 echo "&nbsp;&nbsp;&nbsp;<input type=\"button\" value=\"&nbsp;&nbsp;แก้ไข&nbsp;&nbsp;\" onClick=\"javascript:history.go(-1)\" ></CENTER>" ;
exit () ;
}

$day_now=date("Y-m-d");
$timestamp = mktime(date("H"), date("i"),date("s"), date("m") ,date("d"), date("Y"))  ;	
//timestamp เวลาปัจจุบัน 

$rand_number=rand();
$ref_id = $timestamp."x".$rand_number;

$myfile1name="";
if ($myfile1<>"" ) {
$myfile1name=$ref_id.".".$lastname1 ; 
copy ($myfile1, "modules/bookregister/sign_picture/".$myfile1name)  ; 

unlink ($myfile1) ;
}

if($_POST['sign_now']==1){
	$sql = "update bookregister_cer_sign set  sign_now='0' ";
	$dbquery = mysql_query($sql);
}

$rec_date = date("Y-m-d");
$sql = "insert into bookregister_cer_sign (code, name, position1, position2, sign_pic, sign_now, officer, rec_date) values ('$_POST[code]', '$_POST[name]', '$_POST[position1]', '$_POST[position2]', '$myfile1name', '$_POST[sign_now]', '$_SESSION[login_user_id]', '$rec_date')";
$dbquery = mysql_query($sql);

}

//ส่วนฟอร์มแก้ไขข้อมูล
if ($index==5){
echo "<form Enctype = multipart/form-data id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>แก้ไข</B></Font>";
echo "</Cener>";
echo "<Br><Br>";
$sql = "select * from  bookregister_cer_sign where id='$_GET[id]'";
$dbquery = mysql_query($sql);
$result_ref = mysql_fetch_array($dbquery);

echo "<Table width='50%' Border='0' Bgcolor='#Fcf9d8'>";

echo "<Tr><Td align='right'>รหัส&nbsp;&nbsp;</Td>";
echo "<td align='left'><input type='text' name='code' size='2' value='$result_ref[code]'>";
echo "</td></tr>";

echo "<Tr><Td align='right'>ชื่อ&nbsp;&nbsp;</Td>";
echo "<td align='left'><input type='text' name='name' size='40' value='$result_ref[name]'>";
echo "</td></tr>";
echo "<Tr><Td align='right'>ตำแหน่งบรรทัดที่ 1&nbsp;&nbsp;</Td>";
echo "<td align='left'><input type='text' name='position1' size='80' value='$result_ref[position1]'>";
echo "</td></tr>";
echo "<Tr><Td align='right'>ตำแหน่งบรรทัดที่ 2 (ถ้ามี)&nbsp;&nbsp;</Td>";
echo "<td align='left'><input type='text' name='position2' size='80' value='$result_ref[position2]'>";
echo "</td></tr>";
echo "<Tr><Td align='right'>ลายมือชื่อ&nbsp;&nbsp;</Td>";
echo "<td align='left'><input type='file'  name='myfile1' size='50'>";
echo "</td></tr>";

if($result_ref['sign_now']==1){
echo   "<tr><td align='right'>เป็นผู้ลงนามปัจจุบัน&nbsp;&nbsp;</td>";
echo   "<td align='left'>ใช่<input  type=radio name='sign_now' value='1' checked>&nbsp;&nbsp;ไม่ใช่<input  type=radio name='sign_now' value='0'></td></tr>";
}
else{
echo   "<tr><td align='right'>เป็นผู้ลงนามปัจจุบัน&nbsp;&nbsp;</td>";
echo   "<td align='left'>ใช่<input  type=radio name='sign_now' value='1'>&nbsp;&nbsp;ไม่ใช่<input  type=radio name='sign_now' value='0' checked></td></tr>";

}

echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
echo "<tr><td align='right'><INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url_update(1)'>&nbsp;&nbsp;</td>";
echo "<td align='left'><INPUT TYPE='button' name='back' value='ย้อนกลับ' onclick='goto_url_update(0)'></td></tr>";
echo "</Table>";
echo "<Br>";
echo "<Input Type=Hidden Name='id' Value='$_GET[id]'>";
echo "</form>";
}

//ส่วนปรับปรุงข้อมูล
if ($index==6){

$sql = "select * from  bookregister_cer_sign where id='$_POST[id]'";
$dbquery = mysql_query($sql);
$result_ref = mysql_fetch_array($dbquery);
$old_sign_pic=$result_ref['sign_pic'];
if($old_sign_pic==""){
$old_sign_pic="x.jpg";
}

$sizelimit = 20000*1024 ;  //ขนาดไฟล์

$upfile1=""; 
$sizelimit1="";

/// file
$myfile1 = $_FILES ['myfile1'] ['tmp_name'] ;
$myfile1_name = $_FILES ['myfile1'] ['name'] ;
$myfile1_size = $_FILES ['myfile1'] ['size'] ;
$myfile1_type = $_FILES ['myfile1'] ['type'] ;


//ลบไฟล์เดิม
if($myfile1!="" ){
		if(file_exists("modules/bookregister/sign_picture/".$old_sign_pic)) {
		unlink ("modules/bookregister/sign_picture/".$old_sign_pic) ;
		}
}

 $array_last1 = explode("." ,$myfile1_name) ;
 $c1 =count ($array_last1) - 1 ;
 $lastname1 = strtolower ($array_last1 [$c1] ) ;

 if  ($myfile1<>"") {
 if ($lastname1 =="jpg" or $lastname1 =="gif" or $lastname1 =="png") { 
	 $upfile1 = "" ; 
  }else {
	 $upfile1 = "-ไม่อนุญาตให้ทำการแนบไฟล์ $myfile1_name<BR> " ;
  } 

  If ($myfile1_size>$sizelimit) {
	  $sizelimit1 = "-ไฟล์ $myfile1_name มีขนาดใหญ่กว่าที่กำหนด<BR>" ;
  }else {
		$sizelimit1 = "" ;
  }
 }
  ####

////

// check file size  file name
if ($upfile1<> "" || $sizelimit1<> "") {

echo "<B><FONT SIZE=2 COLOR=#990000>มีข้อผิดพลาดเกี่ยวกับไฟล์ของคุณ ดังรายละเอียด</FONT></B><BR>" ;
echo "<FONT SIZE=2 COLOR=#990099>" ;
 echo  $upfile1 ;
 echo  $sizelimit1 ;
 echo "</FONT>" ;
 echo "&nbsp;&nbsp;&nbsp;<input type=\"button\" value=\"&nbsp;&nbsp;แก้ไข&nbsp;&nbsp;\" onClick=\"javascript:history.go(-1)\" ></CENTER>" ;
exit () ;
}

$day_now=date("Y-m-d");
$timestamp = mktime(date("H"), date("i"),date("s"), date("m") ,date("d"), date("Y"))  ;	
//timestamp เวลาปัจจุบัน 

$rand_number=rand();
$ref_id = $timestamp."x".$rand_number;

$myfile1name="";
if ($myfile1<>"" ) {
$myfile1name=$ref_id.".".$lastname1 ; 
copy ($myfile1, "modules/bookregister/sign_picture/".$myfile1name)  ; 

unlink ($myfile1) ;
}

$rec_date = date("Y-m-d");

if($_POST['sign_now']==1){
	$sql = "update bookregister_cer_sign set  sign_now='0' ";
	$dbquery = mysql_query($sql);
}

		if($myfile1!=""){
		$sql = "update bookregister_cer_sign set code='$_POST[code]', name='$_POST[name]', position1='$_POST[position1]', position2='$_POST[position2]', sign_now='$_POST[sign_now]', sign_pic='$myfile1name', officer='$_SESSION[login_user_id]', rec_date='$rec_date' where id='$_POST[id]'";
		$dbquery = mysql_query($sql);
		}
		else{
		$sql = "update bookregister_cer_sign set code='$_POST[code]', name='$_POST[name]', position1='$_POST[position1]', position2='$_POST[position2]', sign_now='$_POST[sign_now]', officer='$_SESSION[login_user_id]', rec_date='$rec_date' where id='$_POST[id]'";
		$dbquery = mysql_query($sql);
		}
}

//ส่วนปรับปรุงปีทำงานปัจจุบัน
if ($index==7){
	if($_GET['sign_now']==1){
	$sign_now=0;
	}
	else{
	$sign_now=1;
	$sql = "update bookregister_cer_sign set  sign_now='0' ";
	$dbquery = mysql_query($sql);
	}
	
$sql = "update bookregister_cer_sign set  sign_now='$sign_now' where id='$_GET[id]'";
$dbquery = mysql_query($sql);
}

//ส่วนแสดงผล
if(!(($index==1) or ($index==2) or ($index==5))){

$sql = "select * from bookregister_cer_sign order by id";
$dbquery = mysql_query($sql);
echo  "<table width='90%' border='0' align='center'>";
echo "<Tr><Td colspan='5' align='left'><INPUT TYPE='button' name='smb' value='เพิ่มผู้ลงนาม' onclick='location.href=\"?option=bookregister&task=main/cer_sign&index=1\"'></Td></Tr>";

echo "<Tr bgcolor='#FFCCCC'><Td  align='center' width='80'>รหัส</Td><Td  align='center' width='200'>ชื่อผู้ลงนาม</Td><Td align='center'>ตำแหน่งบรรทัดที่1</Td><Td  align='center'>ตำแหน่งบรรทัดที่2 (ถ้ามี)</Td><Td  align='center'>ลายมือชื่อ</Td><td  align='center'>ผู้ลงนามปัจจุบัน</td><Td align='center' width='50'>ลบ</Td><Td align='center' width='50'>แก้ไข</Td></Tr>";
$M=1;
While ($result = mysql_fetch_array($dbquery))
	{
		$id = $result['id'];
		$code= $result['code'];
		$name = $result['name'];
		$position1 = $result['position1'];
		$position2 = $result['position2'];
		$sign_now= $result['sign_now'];
		$sign_pic = $result['sign_pic'];

			if(($M%2) == 0)
			$color="#FFFFC";
			else  	$color="#FFFFFF";
			
		if($sign_now==1){
		$active_pic="<img src=images/yes.png border='0'>";
		}
		else{
		$active_pic="<img src=images/no.png border='0'>";
		}
			
		echo "<Tr bgcolor=$color><Td align='center'>$code</Td><Td  align='left'>$name</Td><td valign='top'>$position1</td><td valign='top'>$position2</td>";
		
		if($sign_pic!=""){
		echo "<Td align='center'><a href=?option=bookregister&task=main/pic_show&sign_pic=$sign_pic target='_blank'><img src=images/b_browse.png border='0'></a></Td>";
		}
		else{
		echo "<td align='center'>ไม่มี</td>";
		}
		
		echo "<Td align='center'><a href=?option=bookregister&task=main/cer_sign&index=7&id=$id&sign_now=$sign_now>$active_pic</a></Td>
		<Td align='center'><a href=?option=bookregister&task=main/cer_sign&index=2&id=$id><img src=images/drop.png border='0' alt='ลบ'></a></Td>
		<Td align='center'><a href=?option=bookregister&task=main/cer_sign&index=5&id=$id><img src=images/edit.png border='0' alt='แก้ไข'></a></Td>
	</Tr>";
$M++;
	}
echo "</Table>";
}

?>
<script>
function goto_url(val){
	if(val==0){
		callfrm("?option=bookregister&task=main/cer_sign");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.code.value == ""){
			alert("กรุณาระบุรหัส");
		}else if(frm1.name.value == ""){
			alert("กรุณากรอกชื่อ");
		}else if(frm1.position1.value == ""){
			alert("กรุณากรอกตำแหน่ง");
		}else{
			callfrm("?option=bookregister&task=main/cer_sign&index=4");   //page ประมวลผล
		}
	}
}

function goto_url_update(val){
	if(val==0){
		callfrm("?option=bookregister&task=main/cer_sign");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.code.value == ""){
			alert("กรุณาระบุรหัส");
		}else if(frm1.name.value == ""){
			alert("กรุณากรอกชื่อ");
		}else if(frm1.position1.value == ""){
			alert("กรุณากรอกตำแหน่ง");
		}else{
			callfrm("?option=bookregister&task=main/cer_sign&index=6");   //page ประมวลผล
		}
	}
}
</script>
