<?php
ob_start();
include("../../../smss_connect.php");

$category=$_GET['category'];

$js = "removeOption();";
$js .= "
		var opt = new Option('เลือก', '');
		document.getElementById('pj_activity').options[0] = opt;
	";
$i=1;
$sql = "select  * from  budget_type  where  category_id='$category'  order by  type_id ";
$dbquery = mysql_db_query($dbname, $sql);
While ($result = mysql_fetch_array($dbquery))
 {
	$type_id = $result['type_id'];
	$type_name = $result['type_name'];
		
		$js .= "
		var opt = new Option('$type_name', '$type_id');
		document.getElementById('pj_activity').options[$i] = opt;
	";
	
$i++;		
}

header("Content-Type:text/javascript; charset=utf-8");
//header("Content-Type:text/plain; charset=tis-620");

echo $js;

?>