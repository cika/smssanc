<?php
session_start();
include("./budget_authenfg.php");  //$config[.....]
include("./budget_authen.php");  //session_
?>
<html>
<meta name="generator" content="Namo WebEditor">
<title><?=$config[title] ?></title>
<meta http-equiv="content-type" content="text/html; charset=windows-874">
<meta name="author" content="SY-Soft">
<link rel="stylesheet" href="css/style.css" type="text/css"/>
<body bgcolor="#E1E1E1" text="#000000" link="blue" vlink="purple" alink="red">
<p align="center"><font color="#FFCC00"></font><Center>
	<B><font size="4" color="blue"><?=$config[headerdetail] ?></font></B><Font Size=4 color='#000099'><BR>:::  รายงานผลการดำเนินงาน งาน/โครงการ  :::</Font></p>
<p align='right'>
<A Href="./budget_list.php"  target="_top"><Font Size=2>กลับรายการหลัก<IMG SRC='images/back.png' WIDTH='20' HEIGHT='22' BORDER=0 ALT=''></A>&nbsp;&nbsp;&nbsp;
</p>
<!-- Part2	## -->
<Table width="90%" Border="0" borderColor="#005CB9"  Bgcolor="#FFFFFF" align="center">
<TR width="70%"  > <TD  valign="top" align="center"> 
<Table Border="1" borderColor=#990000  Bgcolor="#F8E874" Face="Ms Sans Serif" text="#FFFFFF"  align="center">
<?php
echo   "<Tr><Td  width='3%'    class='row1'  valign='center'  align='center' >รหัสกลุ่ม</td>";
echo   "<Td  width='3%'    class='row1'  valign='center'  align='center' >รหัสโครงการ</td>";
echo   "<Td  width='69%'    class='row1'  valign='center'  align='center' >ชื่อโครงการ</td>";
echo   "<Td  width='10%'    class='row1'  valign='center'  align='center' >งบประมาณ</td>";
echo   "<Td  width='15%'    class='row1'  valign='center'  align='center' >หัวหน้าโครงการ</td>";
echo   "<Td   class='row10'><IMG SRC='images/b_bookmark.png' WIDTH='16' HEIGHT='16' BORDER=0 ALT=''></td></tr>";
require_once("dbconfig.inc.php");
$sql = "SELECT *  FROM  plan_proj ORDER BY code_proj  DESC";
$dbquery =DBfieldQuery($sql);
$num_rows = mysql_num_rows($dbquery);
$i=0;
while ($i < $num_rows)
	{
	$result = mysql_fetch_array($dbquery);
	$code_clus =$result[code_clus];
	$code_tegy =$result[code_tegy];
	$code_proj =$result[code_proj];
	$name_proj = $result[name_proj];
	$budget_proj =$result[budget_proj];
	$owner_proj =$result[owner_proj];
	$file_detail =$result[file_detail];
	$eval_activity =$result[eval_activity];
	if  (empty($code_tegy))
	{   $code_tegy="?";   }
	$mcode_tegy =$code_tegy.'-'.$code_proj;
	$len=strlen($owner_proj);
	$point=strpos($owner_proj,' ');
	$long=$len-$point;
	$fname=substr($owner_proj,0,$point);
	$sname=substr($owner_proj,-$long,$long);
	$cname=trim($sname);
	//$towner_proj=eregi_replace(' ','พ',$owner_proj);
	$Fcredit1=number_format($budget_proj);
if  ($mpms_view == "1")
{
	echo   "<Tr><Td align='center'  class='row10'>$code_clus</td>";
	echo   "<Td align='center' class='row10'>$mcode_tegy</td>";
	echo   "<Td class='row10'>$name_proj</td>";
	echo   "<Td valign='center'  align='right' class='row10'>$Fcredit1&nbsp;&nbsp;&nbsp;</td>";
	echo   "<Td align='center' class='row10'>$owner_proj</td>";
}
if  (($mpms_moderate == "1") and ($file_detail !="")) 
{
	if  ( (empty($eval_activity)) and ($mpms_view == "1"))
		{echo   "<Td class='row10'><A Href=\"budget_upload_eval.php?vcode_proj=$code_proj&vcode_clus=$code_clus&vcode_tegy=$code_tegy&vname_proj=$name_proj&vbudget_proj=$budget_proj&fname=$fname&cname=$cname\"  target=  _top><IMG SRC='images/b_browse.png' WIDTH='16' HEIGHT='16' BORDER=0 ALT=''></A></td></Tr>";}
	else
		{echo   "<Td class='row10'><A Href=\"budget_upload_eval.php?vcode_proj=$code_proj&vcode_clus=$code_clus&vcode_tegy=$code_tegy&vname_proj=$name_proj&vbudget_proj=$budget_proj&fname=$fname&cname=$cname\"  target=  _top><IMG SRC='images/b_edit.png' WIDTH='16' HEIGHT='16' BORDER=0 ALT=''></A></td></Tr>"; }
}
else
{
	if  ( (empty($file_detail)) and ($mpms_view == "1"))
	{
		if  ( $code_tegy=="?")
		{echo   "<Td align='center' class='row10'><IMG SRC='images/frm_linevrlt.png' WIDTH='10' HEIGHT='10' BORDER=0 ALT=''></td></Tr>";}
		else
		{echo   "<Td align='center' class='row10'><IMG SRC='images/dot_red.png' WIDTH='10' HEIGHT='10' BORDER=0 ALT=''></td></Tr>";}
	}}
$i++;
}
 mysql_close();
?>
</Table></TD></TR>
</Center>
</body>
</html>