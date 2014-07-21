<?php
require_once("plan_authen.php");  //session_

if (!defined('DBName'))
{
require_once "dbconfig.inc.php";
}
	
//อาเรย์บุคลากร
$sql = "SELECT *  FROM  person_main order by position_code,name";
$dbquery=DBfieldQuery($sql);
while ($result = mysql_fetch_array($dbquery)){
$person_ar[$result['person_id']]=$result['prename'].$result['name']." ".$result['surname'];
}
	
?>
<link rel="stylesheet" href="css/style.css" type="text/css"/>
<Center><p align="center">
	<Font Size=4 color='#000099'>:::  แนบเอกสารโครงการ ปีงบประมาณ <?php echo $_SESSION['budget_year']?>  :::</Font></p>
<!-- Part2	## -->
<Table width="90%" Border="1" borderColor=#990000  Bgcolor="#F8E874" Face="Ms Sans Serif" text="#FFFFFF"  align="center">
<?php
echo   "<Td  width='7%'  bgcolor='#FBD562'  valign='center'  align='center' >รหัสโครงการ</td>";
echo   "<Td bgcolor='#FBD562'  valign='center'  align='center' >ชื่อโครงการ</td>";
echo   "<Td  width='15%'  bgcolor='#FBD562'  valign='center'  align='center' >จำนวนเงิน</td>";
echo   "<Td  width='20%'  bgcolor='#FBD562'  valign='center'  align='center'>หัวหน้าโครงการ</td>";
echo   "<Td align='center' width='50'><IMG SRC='images/b_bookmark.png' WIDTH='16' HEIGHT='16' BORDER=0 ALT=''></td>";
echo   "<Td align='center' width='50'><IMG SRC='images/b_drop.png' WIDTH='16' HEIGHT='16' BORDER=0 ALT=''></td></tr>";
$sql = "SELECT *  FROM  plan_proj  where budget_year='$_SESSION[budget_year]' ORDER BY code_proj ";
$dbquery =DBfieldQuery($sql);
$num_rows = mysql_num_rows($dbquery);
$i=0;
while ($result = mysql_fetch_array($dbquery))
	{
	$code_clus =$result['code_clus'];
	$code_tegy =$result['code_tegy'];
	$code_proj =$result['code_proj'];
	$name_proj = $result['name_proj'];
	$budget_proj =$result['budget_proj'];
	$owner_proj =$result['owner_proj'];
	$file_detail =$result['file_detail'];
	$len=strlen($owner_proj);
	$point=strpos($owner_proj,' ');
	$long=$len-$point;
	$fname=substr($owner_proj,0,$point);
	$sname=substr($owner_proj,-$long,$long);
	$cname=trim($sname);
	//$towner_proj=eregi_replace(' ','เธ',$owner_proj);
	$Fcredit1=number_format($budget_proj,2);
if($i%2==0){
$color_row="#FFFFFF";
}
else {
$color_row="#FFFF99";
}
	
	echo   "<Tr Bgcolor='$color_row'>";
	echo   "<Td align='center' class='row10'>$code_proj</td>";
	echo   "<Td align='left' class='row10'>&nbsp;$name_proj</td>";
	echo   "<Td  align='right' class='row10'>$Fcredit1&nbsp;&nbsp;&nbsp;</td>";
	echo   "<Td align='left' class='row10'>$person_ar[$owner_proj]</td>";

if (empty($file_detail))
{
	echo   "<Td class='row10' align='center'><A Href=\"?option=plan&task=planproject/plan_upload_form&vcode_proj=$code_proj&vcode_clus=$code_clus&vcode_tegy=$code_tegy&vname_proj=$name_proj&vbudget_proj=$budget_proj&fname=$fname&cname=$cname\"  target=  _top><IMG SRC='images/b_search.png' WIDTH='16' HEIGHT='16' BORDER=0 ALT='ยังไม่มีเอกสารโครงการ'></A></td>";
	echo   "<Td align='center'>&nbsp;</td></Tr>";}
else
{
	if ($file_detail !="")
	{
	echo   "<Td class='row10' align='center'><A  Href='$file_detail'  target=_blank><IMG SRC='images/b_browse.png' WIDTH='16' HEIGHT='16' BORDER=0 ALT='เอกสารโครงการ'></A></td>";
	echo   "<Td class='row10' align='center'><A Href=\"?option=plan&task=planproject/plan_cancel_form&vcode_proj=$code_proj\"  target=  _top><IMG SRC='images/b_drop.png' WIDTH='16' HEIGHT='16' BORDER=0 ALT='ลบเอกสารโครงการ'></A></td></Tr>";
	}
}
	$i++;
	}
?>
</Table>
</Center>
