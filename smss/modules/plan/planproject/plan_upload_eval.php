<?php
session_start();
include("./budget_authenfg.php");  //$config[.....]
include("budget_calendar.php");
include("./budget_authen.php"); 
$mcode_proj = $vcode_proj;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><?=$config[title] ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
</head>
<body>
<p align="center"><B><font size="4" color="blue"><?=$config[headerdetail] ?></font></B></p>
<?php
echo "<p align='right'>";
echo "<A Href=\"budget_eval_detail.php\" target=\"_top\">กลับรายการหลัก<IMG SRC='images/back.png' WIDTH='20' HEIGHT='22' BORDER=0 ALT=''></A>&nbsp;&nbsp;&nbsp;";
echo "</p>";
require_once("dbconfig.inc.php");
$sql = "SELECT *  FROM  plan_proj where code_proj=$vcode_proj";
$dbquery =DBfieldQuery($sql);
While ($result = mysql_fetch_array($dbquery))
   {
		$code_clus =$result[code_clus];
		$code_tegy =$result[code_tegy];
		$code_proj =$result[code_proj];
		$name_proj = $result[name_proj];
		$budget_proj =$result[budget_proj];
		$owner_proj =$result[owner_proj];
		$eval_tegy =$result[eval_tegy];
		$eval_activity =$result[eval_activity];
		$eval_result =$result[eval_result];
		$eval_obstacle =$result[eval_obstacle];
		$eval_particular =$result[eval_particular];
	}
	$yearbudget=$Ybudget+543;
echo     "<form Enctype = multipart/form-data action = budget_eval_save.php  method = post>";
echo     "<div align=center><strong><font color=#CC0000 size=5>รายงานผลการดำเนินงาน ปีงบประมาณ&nbsp;&nbsp;$yearbudget</font></strong></div><BR>";
echo     "<div align=center><strong><font color=#990000 size=2>โครงการ $vname_proj</font></strong></div>";
echo     "<hr>";
echo     "<table  align = center  width=70% border=0>";
echo    "<tr>";
echo    "<td> <strong><font color=#003366 size=3>จุดเน้นตามกลยุทธ์</font></strong></td>";
echo    "<td><textarea name=eval_tegy cols=70 rows=4 >$eval_tegy</textarea></td>";
echo    "</tr>";
echo    "<tr>";
echo    "<td> <strong><font color=#003366 size=4>กิจกรรม</font></strong></td>";
echo    "<td><textarea name=eval_activity cols=70 rows=5 >$eval_activity</textarea></td>";
echo    "</tr>";
echo    "<tr>";
echo    "<td> <strong><font color=#003366 size=4>ผลที่ได้รับ</font></strong></td>";
echo    "<td><textarea name=eval_result cols=70 rows=5 >$eval_result</textarea></td>";
echo    "</tr>";
echo    "<td> <strong><font color=#003366 size=4>ข้อจำกัด</font></strong></td>";
echo    "<td><textarea name=eval_obstacle cols=70 rows=4 >$eval_obstacle</textarea></td>";
echo    "</tr>";
if  (($mpms_moderate == "1") and (empty($eval_particular)))
{
echo    "<tr>";
echo    "<td> <strong><font color=#003366 size=4>แฟ้มรายงาน</font></strong></td>";
echo    "<td> <input name = userfile  type = file></td>";
echo    "</tr>";
}
else
{
echo    "<tr>";
echo    "<td> <strong><font color=#003366 size=4>แฟ้มรายงาน</font></strong></td>";
echo    "<td> <strong><font color=#003366 size=3>$eval_particular</font></strong></td>";
echo    "<tr>";
}
echo    "<tr> ";
echo   "<td> <input type = hidden name = vcode_proj  value = $vcode_proj></td>";
echo   "<td>&nbsp;</td>";
echo   "</tr>";
echo    "<tr> ";
echo   "<td> <input type = hidden name = max_file_size  value = 2000000></td>";
echo   "<td>&nbsp;</td>";
echo   "</tr>";
echo  "<tr> ";
echo   "<td colspan=2 align = center><input type = submit value = ตกลง  name = send></td>";
echo   "</tr>";
echo   "</table>";
echo   "</form>";
echo "<br>";
?> 
</body>
</html>
