<?php
session_start(); 
require_once("dbconfig.inc.php");

$data3 = ( $_POST );
$proj_year=$_SESSION["budget_year"];
$vcode_clus=$_REQUEST["vcode_clus"];
?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet"  href="./css/js/style.css" type="text/css"/>
<style >
body {  margin: 0px  0px; padding: 0px  0px}
a:link { color: #214263; text-decoration: none}
a:visited { color: #214263; text-decoration: none}
a:active { color: #0099FF; text-decoration: none}
A:hover {	COLOR: #FFFFFF; BACKGROUND-COLOR: #FF0000; TEXT-DECORATION: none}
.style2 {font-size: 15px}
</style>
<body>
<?php
$sql = "SELECT *  FROM   plan_proj  where  code_clus='$vcode_clus' and  budget_year='$proj_year' order by code_proj  ASC";
$dbquery =DBfieldQuery($sql);
while ($result = mysql_fetch_array($dbquery))
	{
		$code_clus = $result['code_clus'];
		$code_tegy=  $result['code_tegy'];
		$code_proj = $result['code_proj'];
		$budget_proj = $result['budget_proj'];
		$name_proj = $result['name_proj'];
		$owner_proj= $result['owner_proj'];
		$budget_proj=(int)$budget_proj;
		$txtshows = $code_proj." ".$name_proj;

	if ($code_proj==$_SESSION["mcode_proj"])
		{
	echo "<font  class='actifrm'><a  href=\"../../../?option=plan&task=planproject/plan_in_acti&vcode_proj=$code_proj&optioncase=1\" target=\"_top\"><font color='#FF00CC' class='style2'>&nbsp; $txtshows</font></a></span></font><br>";
	}else {echo "<font face=\"CordiaPC,MS Sans Serif,P5,JS Toomtamas\" color=\"#FF0000\"><span style=\"font-size:13pt;\"><a  href=\"../../../?option=plan&task=planproject/plan_in_acti&vcode_proj=$code_proj&optioncase=1\" target=\"_top\"><font class='style2'>&nbsp; $txtshows</font></a></span></font><br>";}
}
?>
</body>
</html>