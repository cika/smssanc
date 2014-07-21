<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="person'.date("Y-m-d H:i:s").'.xls"');# ชื่อไฟล์ 
?>
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

$sql = "select * from  person_position order by position_code";
$dbquery = mysql_query($sql);
while ($result = mysql_fetch_array($dbquery)){
$position_ar[$result['position_code']]=$result['position_name'];
}

$sql = "select * from person_main where status='0' order by position_code";
$dbquery = mysql_query($sql);
echo "<table><Tr><Td align='center'>ที่</Td><Td align='center'>ชื่อ</Td><Td align='center'>ตำแหน่ง</Td></Tr>";
$N=1;
while ($result = mysql_fetch_array($dbquery))
	{
		$id = $result['id'];
		$prename=$result['prename'];
		$name= $result['name'];
		$surname = $result['surname'];
		$position_code= $result['position_code'];
		
		echo "<Tr><Td align='center'>$N</Td><Td align='left'>$prename&nbsp;$name&nbsp;&nbsp;$surname</Td><Td align='left'>$position_ar[$position_code]</Td></Tr>";
$N++;
	}
echo "</Table>";
?>
</BODY>
</HTML>
