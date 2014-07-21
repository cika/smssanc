<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<?php
require_once "../../smss_connect.php";	

$sql_name = "select * from person_main where person_id='$_GET[person_id]'";
$dbquery_name = mysql_query($sql_name);
$result_name = mysql_fetch_array($dbquery_name);
		$prename=$result_name['prename'];
		$name= $result_name['name'];
		$surname = $result_name['surname'];
		$pic = $result_name['pic'];
$full_name="$prename$name&nbsp;&nbsp;$surname";

echo "<div align='center'><img src='../../$pic' border='0' width='400'></div>";
echo "<br>";
echo "<div align='center'>";
echo $full_name;
echo "</div>";
?>
</body>
</html>

