<?php
ob_start();
 include("../../smss_connect.php");
			$level_TOP=$_GET['level_TOP'];
			list($level,$room)=explode("/",$level_TOP);
				$level;
				$room;
$js = "removeOption();";
$js .= "
		var opt = new Option(' < - - - - เลือกนักเรียน - - - - >', '');
		document.getElementById('student').options[0] = opt;
	";

$i=1;
$sql = "select  * from  student_main  where  class_now='$level' and room='$room' and status='0' order by student_number ASC";
$dbquery = mysql_query($sql);
while ($result = mysql_fetch_array($dbquery))
 {
	 $studentID = $result['student_id'];
	$prenameJ = $result['prename'];
	$nameJ = $result['name'];
	$surnameJ = $result['surname'];
		$js .= "
		var opt = new Option('$prenameJ$nameJ $surnameJ', '$studentID');
		document.getElementById('student').options[$i] = opt;
	";
	
	$i++;		
	}
	header("Content-Type:text/javascript; charset=utf-8");
	echo $js;
?>
