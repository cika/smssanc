<?php
$module = $_GET['module'];
$filename = "../../../modules/$module/install/name_th.txt";

if (file_exists($filename)) {
	$handle = fopen($filename, "r");
	$contents = fread($handle, filesize($filename));
	fclose($handle);
echo "<input type='text' name='module_desc'  size='20' value='$contents'>";
} else {
echo "<input type='text' name='module_desc'  size='20' value=''>";
}

?>