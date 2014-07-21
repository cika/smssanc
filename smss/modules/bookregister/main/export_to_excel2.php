<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="receive_2.xls"');# ชื่อไฟล์ 
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
require_once "../../../smss_connect.php";	
require_once "../time_inc.php";	

//ปีทะเบียน
$sql_start="select * from bookregister_year where year_active='1' ";
$query_start=mysql_query($sql_start);
$result_start=mysql_fetch_array($query_start);

$sql = "select * from  system_workgroup order by workgroup_order";
$dbquery = mysql_query($sql);
While ($result = mysql_fetch_array($dbquery)){
$department_ar[$result['workgroup']]=$result['workgroup_desc'];
}

$sql="select * from bookregister_receive where  year='$result_start[year]' order by ms_id ";
$dbquery = mysql_query($sql);
echo "<table border='1'>";
?>
				<tr bgcolor="#FFCCCC">
					<td align="center">
					<font size="2" face="Tahoma">ลำดับที่</font></td>
					<td align="center">
					<font size="2" face="Tahoma">เลขทะเบียนรับ</font></td>
					<td align="center">
					<font size="2" face="Tahoma">ปี</font></td>
					<td align="center">
					<font face="Tahoma" size="2">ที่</font></td>
					<td align="center">
					<font face="Tahoma" size="2">ลงวันที่</font></td>
					<td align="center">
					<font face="Tahoma" size="2">จาก</font></td>
					<td align="center">
					<font face="Tahoma" size="2">ถึง</font></td>
					<td align="center">
					<font face="Tahoma" size="2">เรื่อง</font></td>
					<td align="center">
					<font face="Tahoma" size="2">วันลงทะเบียน</font></td>
					<td align="center">
					<font face="Tahoma" size="2">หมายเหตุ</font></td>
					<td align="center">
					<font face="Tahoma" size="2">กลุ่มปฏิบัติ</font></td>
					<td align="center">
					<font face="Tahoma" size="2">ผู้ปฏิบัติ</font></td>
				</tr>
<?php				
$N=1;
While ($result = mysql_fetch_array($dbquery))
	{
		$id = $result['ms_id'];
		$register_number = $result['register_number'];
		$year = $result['year'];
		$book_no = $result['book_no'];
		$signdate = $result['signdate'];
		$book_from = $result['book_from'];
		$book_to = $result['book_to'];
		$subject = $result['subject'];
		$comment = $result['comment'];
		$group = $result['workgroup'];
		$operation = $result['operation'];
		$register_date = $result['register_date'];
		
$signdate=thai_date_3($signdate);
$register_date=thai_date_3($register_date);
		
		echo "<Tr><Td align='center'>$N</Td><Td align='center'>$register_number</Td><Td align='center'>$year</Td><Td align='left'>$book_no</Td><Td align='left'>$signdate</Td><Td align='left'>$book_from</Td><Td align='left'>$book_to</Td><Td align='left'>$subject</Td><Td align='left'>$register_date</Td><Td align='left'>$comment </Td>";
echo "<Td align='left'>";
if(isset($department_ar[$group])){
echo $department_ar[$group];
}
echo "</Td>";
echo "<td>$operation</td></Tr>";
$N++;
	}
echo "</Table>";
?>
</BODY>
</HTML>
