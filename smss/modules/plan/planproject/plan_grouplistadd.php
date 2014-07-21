<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet"  href="./css/js/style.css" type="text/css"/>
<style >
body {  margin: 0px  0px; padding: 0px  0px}
a:link { color: #214263; text-decoration: none}
a:visited { color: #CC6600; text-decoration: none}
a:active { color: #0099FF; text-decoration: none}
A:hover {	COLOR: #FFFFFF; BACKGROUND-COLOR: #FF0000; TEXT-DECORATION: none}
</style>
<body class='row0'>
<?php
require_once("dbconfig.inc.php");
$sql = "SELECT * FROM  system_workgroup order by workgroup ";
$dbquery =DBfieldQuery($sql);
while ($result = mysql_fetch_array($dbquery)) {
		$code_clus = $result['workgroup'];
		$name_clus = $result['workgroup_desc'];
		$txtshows = $code_clus." ".$name_clus;

if(!isset($code_clus)){
$code_clus="";
}

if(!isset($_SESSION["mcode_clus"])){
$_SESSION["mcode_clus"]="";
}

	if ($code_clus==$_SESSION["mcode_clus"])
		{
		echo "<font  class='actifrm'><a href=\"./?option=plan&task=planproject/plan_in_acti&vcode_clus=$code_clus&optioncase=2\"><font color='#FF00CC'>&nbsp; <b>$txtshows</b></font></a></span></font><br>";

		}else {echo "<font face=\"CordiaUPC,MS Sans Serif,P5,JS Toomtamas\"><span style=\"font-size:13pt; \"><a href=\"./?option=plan&task=planproject/plan_in_acti&vcode_clus=$code_clus&optioncase=2\">&nbsp; $txtshows</a></span></font><br>";}
}
?>
