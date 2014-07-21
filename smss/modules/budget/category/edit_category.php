<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
//sd page 
?>

<br />
<table width="100%" border="0" align="center">
  <tr>
    <td><div align="center">
        <p><font color="#006666" size="3"><strong>ประเภท(หลัก)ของเงินที่สถานศึกษาได้รับ</strong></font></p>
      </div></td>
  </tr>
</table>
<br />

<?php
$sql = "select  * from  budget_category  order by  category_id";
$dbquery = mysql_query($sql);
echo  "<table width=50% border=0 align=center>";
$M=1;
echo "<Tr bgcolor=#FFCCCC align=center class=style2><Td>รหัส</Td><Td>ประเภท(หลัก)</Td></Tr>";
While ($result = mysql_fetch_array($dbquery))
	{
		$id = $result['id'];
		$category_id= $result['category_id'];
		$category_name = $result['category_name'];
			if(($M%2) == 0)
			$color="#FFFFFF";
			else  	$color="#FFFFC";

		echo "<Tr  bgcolor=$color align=center class=style1><Td>$category_id</Td><Td align=left>$category_name</Td>
	</Tr>";
$M++;
}

echo "<Tr><Td colspan='2' align='left'>*เพจนี้ ไม่สามารถปรับแก้ได้  เจตนาแสดงเพื่อทำความเข้าใจในเบื้องต้นถึงประเภทของเงิน</Td></Tr>";
echo "</Table>";
?>
