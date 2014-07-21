<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="student-'.date("Y-m-d H:i:s").'.xls"');# ชื่อไฟล์ 
?>'.date("Y-m-d H:i:s").'.xls
<html xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40">
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</HEAD>

<BODY>
<?php
require_once "../../smss_connect.php";	

$sql = "select * from  student_main_class order by class_code";
$dbquery = mysql_query($sql);
While ($result = mysql_fetch_array($dbquery)){
$class_ar[$result['class_code']]=$result['class_name'];
}

$sql = "select * from student_main where status='0' order by class_now,room,student_number,student_id";
$dbquery = mysql_query($sql);
echo  "<table width=90% border=0 align=center>";
echo "<Tr><Td align='center'>ที่</Td><Td align='center'>เลขประจำตัวนักเรียน</Td><Td align='center'>เลขประจำตัวประชาชน</Td><Td align='center'>เลขที่</Td><Td align='center'>ชื่อ</Td><Td align='center'>ชั้น</Td><Td align='center'>ห้อง</Td></Tr>";
$N=1; 
While ($result = mysql_fetch_array($dbquery))
	{
		$id = $result['id'];
		$student_id = $result['student_id'];	
		$person_id = $result['person_id'];	
		$student_number=$result['student_number'];		
		$prename=$result['prename'];
		$name= $result['name'];
		$surname = $result['surname'];
		$class_now= $result['class_now'];
		$room= $result['room'];
echo "<Tr><Td align='center'>$N</Td><Td align='center'>$student_id</Td><Td align='center'>$person_id</Td><td align='center'>";
		if($student_number>0){
		echo $student_number;
		}
		else{
		echo "";
		}
echo "</td><Td align='left'>$prename&nbsp;$name&nbsp;&nbsp;$surname</Td><Td align='left'>$class_ar[$class_now]</Td>";
if($room>0){	
echo "<Td align='center'>$room</Td>";
}
else{
echo "<Td align='center'>&nbsp;</Td>";
}
echo "</Tr>";
$N++; 
	}
echo "</Table>";
?>
</BODY>
</HTML>
