<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
//sd page 

if($_FILES){

		if($_FILES['userfile']['name']==""){
				?> <script>
				alert("กรุณาเลือกไฟล์ด้วย ค่ะ");
				document.location.href="?option=student_main&task=student_import";	
				</script> 
				<?php
		exit();		
		}

// ตรวจสอบว่าเป็น text file หรือไม่
$uploaddir ="modules/student_main/upload/";     //ที่เก็บไฟล์
$uploadfile = $uploaddir.basename($_FILES['userfile']['name']);
$basename = basename($_FILES['userfile']['name']);

		//ลบไฟล์เดิม
		if(file_exists($uploadfile)){
		unlink($uploadfile);
		}

$surname = explode(".", $_FILES['userfile']['name']);
		if($surname[1]!=txt){
			unlink($_FILES['userfile']['tmp_name']);
				?> <script>
				alert("ไม่ใช่ text file กรุณาอ่านคำอธิบายอีกครั้ง");
				</script> 
				<?php
			uploadfile();
			exit();	
		}
		if (move_uploaded_file($_FILES['userfile']['tmp_name'],$uploadfile)){

		//$txt=rand();
		$changed_name=$uploaddir.$basename; 	
		rename("$uploadfile" , "$changed_name");
		$data=file("$changed_name");  
		
				for($i=1;$i<count($data);$i++){ 
				list($student_id,$person_id,$student_number,$prename,$name,$surname,$sex,$class_now,$room) = explode("\t",$data[$i]);	
					if($student_id!=""){
					$sql = "insert into student_main (student_id,person_id,student_number,prename,name,surname,sex,class_now,room) values ('$student_id','$person_id','$student_number','$prename','$name','$surname','$sex','$class_now','$room')";
					$dbquery = mysql_query($sql);
					}
				}
		}
		else{
		echo  "<br><strong><font color=#990000 size=3>ไม่สามารถอัพโหลดได้</font></strong>";
		exit();
		}
	 	?> <script>
			document.location.href="?option=student_main&task=student";		
			</script> 
		<?php
}
else{
uploadfile();
}

//ส่วนของform	
function uploadfile () {
echo  "<form name ='frm1' Enctype = 'multipart/form-data'>";
echo  "<br>";
echo  "<table align='center' width='50%' border='0'>";
echo  "<tr>";
echo  "<td align='right'><strong><font color='#003366' size='2'>ไฟล์เอกสาร</font></strong></td>";
echo  "<td align='left'><input name = 'userfile'  type = 'file'><font color='#003366' size='2'></font></td>";
echo  "</tr>";
echo  "<tr><td></td><td></td></tr> ";
echo  "<tr> ";
echo  "<td></td><td align = 'left'><INPUT TYPE='button' name='smb' value='ตกลง' onclick='upload(1)' class='entrybutton'></td>";
echo   "</tr>";
echo   "</table>";
}


//คำอธิบาย
echo "<br /><br /><br />";
echo  "<table width=70% border=0 align=center>";
echo "<Tr><Td align='left'><strong>คำอธิบาย</strong></Td></Tr>";
echo "<Tr><Td align='left'>1. Download ตัวอย่างไฟล์ Excel ได้ที่เมนูคู่มือ </Td></Tr>";
echo "<Tr><Td align='left'>2. ข้อมูลเดิมอยู่ในรูปแบบไฟล์ Excel  ให้แถวแรกเป็นชื่อหัวสดมภ์ ประกอบด้วย 1. เลขประจำตัวนักเรียน 2. เลขประจำตัวประชาชน 3.เลขที่ 4.คำนำหน้าชื่อ 5.ชื่อ 6. นามสกุล 7. เพศ (ชาย=1 หญิง=2) 8. รหัสชั้น 9.ห้องที่ </Td></Tr>";
echo "<Tr><Td align='left'>3. ตั้งแต่แถวที่ 2 เป็นต้นไปเป็นข้อมูลนักเรียนแต่ละคน</Td></Tr>";
echo "<Tr><Td align='left'>4. เลขประจำตัวประชาชนสามารถเว้นว่างไว้ได้</Td></Tr>";
echo "<Tr><Td align='left'>5. กรณีชั้นเรียนเดียวมีห้องเดียว ไม่ต้องกรอกข้อมูลห้องที่</Td></Tr>";
echo "<Tr><Td align='left'>6. รหัสชั้นเรียนให้ดูที่รายการเมนูชั้นเรียน เมนูตั้งค่าระบบ</Td></Tr>";
echo "<Tr><Td align='left'>7. เมื่อข้อมูลในไฟล์ Excel เสร็จเรียบร้อยแล้วให้ Save As เป็นชนิด Text (Tab delimited)</Td></Tr>";
echo "<Tr><Td align='left'>8. หลังจากบันทึกเป็น Text ให้เปิดไฟล็ Text ด้วยโปรแกรม Notepad แล้ว Save As เลือก Encoding เป็น UTF-8 </Td></Tr>";
echo "<Tr><Td align='left'>9. upload ไฟล์จากข้อที่ 7</Td></Tr>";
echo "</Table>";

?>
<script>
function upload(val){
	if(val==1){
		callfrm("?option=student_main&task=student_import");  
		}
}
</script>

