<?php
ob_start();
include("../../../smss_connect.php");

$type_id=$_GET['pj_activity'];

$js = "removeOption2();";
$js .= "
		var opt = new Option('เลือก', '');
		document.getElementById('item2').options[0] = opt;
	";

	
$i=1;
$sql = "select  * from  budget_list  where  type_id='$type_id'   ";
$dbquery = mysql_db_query($dbname, $sql);
While ($result = mysql_fetch_array($dbquery))
 {
	$list_id = $result['list_id'];
	$list_name = $result['list_name'];
		
		$js .= "
		var opt = new Option('$list_name', '$list_id');
		document.getElementById('item2').options[$i] = opt;
	";
	
$i++;		
}

header("Content-Type:text/javascript; charset=utf-8");
//header("Content-Type:text/plain; charset=tis-620");


echo $js;





?>