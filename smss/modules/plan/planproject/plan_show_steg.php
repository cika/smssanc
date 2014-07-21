<?
session_start();
include("./budget_authenfg.php");  //$config[.....]
include("./budget_authen.php");  //session_
?>
<html>
<meta name="generator" content="Namo WebEditor">
<title><?=$config[title] ?></title>
<meta http-equiv="content-type" content="text/html; charset=windows-874">
<meta name="author" content="SY-Soft">
<body bgcolor="#FFFFFF" text="#000000" link="blue" vlink="purple" alink="red">
<p align="center"><font color="#FFCC00"></font><Center>
	<B><font size="3" color="blue"><?=$config[headerdetail] ?></font></B><Font Size=3 color='#000099'><BR>:::  รายละเอียดแยกตาม งาน/โครงการและรายงานผล  :::</Font></p>
<p align='right'>
<A Href="./budget_list.php"  target="_top"><Font Size=2>กลับรายการหลัก<IMG SRC='images/back.png' WIDTH='20' HEIGHT='22' BORDER=0 ALT=''></A>
</p>
<!-- Part2	## -->
<?php
echo  "<table width=100%  cellpadding=0 cellspacing=2 border=0>";
echo "<tr><td><div align=center><font color=#000033 size=2>[<a href=budget_show_steg.php?index=>ทั้งหมด</a>][<a href=budget_show_steg.php?index=01>กลุ่มอำนวยการ</a>][<a href=budget_show_steg.php?index=02>กลุ่มนโยบายและแผน</a>][<a href=budget_show_steg.php?index=03>กลุ่มบริหารงานบุคคล</a>][<a href=budget_show_steg.php?index=04>กลุ่มส่งเสริมการจัดการศึกษา</a>][<a href=budget_show_steg.php?index=05>กลุ่มนิเทศ_ติดตามฯ</a>][<a href=budget_show_steg.php?index=06>หน่วยตรวจสอบภายใน</a>][<a href=budget_show_steg.php?index=07>กลุ่มส่งเสริมฯ_เอกชน</a>]</font></div></td></tr>";
//[<a href=budget_show_steg.php?index=>อื่น ๆ</a>]
if($index==01)
$group="กลุ่มอำนวยการ";
if($index==02)
$group="กลุ่มนโยบายและแผน";
if($index==03)
$group="กลุ่มบริหารงานบุคคล";
if($index==04)
$group="กลุ่มส่งเสริมการจัดการศึกษา";
if($index==05)
$group="กลุ่มนิเทศ_ติดตามและประเมินผลฯ";
if($index==06)
$group="หน่วยตรวจสอบภายใน";
if($index==07)
$group="กลุ่มส่งเสริมสถานศึกษาเอกชน";
//echo "<tr><td><div align=center><font color=#990000 size=2>$group</font></div></td></tr>";
echo "</table><BR>";
$code_tegy="x";
 if($index!=""){
	$sql = "select  *  from  plan_proj  where code_clus='$index' order  by code_proj";
 }else{
	$sql = "select  *  from  plan_proj  order by code_clus ";}
require_once("dbconfig.inc.php");
$dbquery =DBfieldQuery($sql);
$rd=1;
while($row = mysql_fetch_array($dbquery)){
					$code_clus_plan= $row[code_clus];
					$code_proj_plan= $row[code_proj];
					$name_proj_plan= $row[name_proj];
							$budget_proj_plan= $row[budget_proj];
							$owner_proj_plan =$row[owner_proj];
							$code_tegy_plan =$row[code_tegy];
							$file_detail_plan =$row[file_detail]; 
							$eval_activity_plan =$row[eval_activity];
							$allow_edit_plan =$row[allow_edit];
							$owner_proj_plan=trim($owner_proj_plan);
							$point=strpos($owner_proj_plan,chr('38'));
							$len=strlen($owner_proj_plan);
							if  (($point>0) and ($point<5))
								{	$owner_proj_plan=substr($owner_proj_plan,$point,$len);
									$point=strpos($owner_proj_plan,chr('38'));
									$len=strlen($owner_proj_plan);
								}
							$long=$len-$point;
							$fname=substr($owner_proj_plan,0,$point);
							$sname=substr($owner_proj_plan,-$long,$long);
							$cname=trim($sname);
							$Fcredit1=number_format($budget_proj);
//::: valiable array ::://
							$code_clus_plan_ar[$rd]=$code_clus_plan;
							$code_proj_plan_ar[$rd]=$code_proj_plan;
							$name_proj_plan_ar[$rd]=$name_proj_plan;
							$budget_proj_plan_ar[$rd]=$budget_proj_plan;
							$file_detail_plan_ar[$rd]=$file_detail_plan; 
							$eval_activity_plan_ar[$rd]=$eval_activity_plan;
							$allow_edit_plan_ar[$rd]=$allow_edit_plan;
							$owner_proj_plan_ar[$rd]=$fname.'&nbsp;'.$cname;
							$fname_plan_ar[$rd]=$fname;
							$cname_plan_ar[$rd]=$cname;
							if  (empty($code_tegy_plan))
								{   $code_tegy_plan="?";   }
							$code_tegy_plan_ar[$rd] =$code_tegy_plan;
							$code_tegy_planc_ar[$rd] =$code_tegy_plan.'-'.$code_proj_plan;
						$rd++;
	   		}  //while($row
//::: End valiable array ::://	
					$sql = "select  *  from  plan_acti";
					$dbquery =DBfieldQuery($sql);
					$re=1;
					While ($result = mysql_fetch_array($dbquery))
						{
							$code_proj_acti= $result[code_proj];
							$code_acti= $result[code_acti];
							$name_acti= $result[name_acti];
							$budget_acti= $result[budget_acti];
							$budget_approve= $result[$budget_approve];
							$code_proj_acti_ar[$re]=$code_proj_acti;
							$code_acti_ar[$re]=$code_acti;
							$name_acti_ar[$re]=$name_acti;
							$budget_acti_ar[$re]=$budget_acti;
							$budget_approve_ar[$re]=$budget_approve;
						$re++;
	    				}
						for($i=1;$i<$rd;$i++)
						{
						$proj_sum=0;
						for($x=1;$x<$re;$x++)
								{
										if($code_proj_plan_ar[$i]==$code_proj_acti_ar[$x])
										{
											$acti_sum=0;
											$sql = "select   id,  pj_activity , money  from  withdraw where  pj_activity=$code_acti_ar[$x]";
											$dbquery =DBfieldQuery($sql);
											While ($result = mysql_fetch_array($dbquery))
											{
											$id= $result[id];
											$money= $result[money];
											$acti_sum=$acti_sum+$money;
											}
											$acti_sum_ar[$x]=$acti_sum;
											$proj_sum=$proj_sum+$acti_sum;
										}  //  if($code_proj_plan_ar[$i]==$code_proj_acti_ar[$x])
								}  //  for($x=1;$x<$re;$x++) 
						$proj_sum_ar[$i]=$proj_sum;
						}  //  for($i=1;$i<$rd;$i++)
echo  "<table width=95% border=1  borderColor=#FF0033  align=center >";
echo   "<Tr><Td  width='3%'  bgcolor='#FBD562'  valign='center'  align='center' ><font  size='2'>รหัสกลุ่ม</font></td>";
echo   "<Td  width='3%'  bgcolor='#FBD562'  valign='center'  align='center' ><font  size='2'>รหัสโครงการ</font></td>";
echo   "<Td  width='64%'  bgcolor='#FBD562'  valign='center'  align='center' ><font  size='2'>ชื่อโครงการ</font></td>";
echo   "<Td  width='10%'  bgcolor='#FBD562'  valign='center'  align='center' ><font  size='2'>งบประมาณ</font></td>";
echo   "<Td  width='20%'  bgcolor='#FBD562'  valign='center'  align='center' ><font  size='2'>หัวหน้าโครงการ</font></td>";
echo   "<Td><IMG SRC='images/b_bookmark.png' WIDTH='16' HEIGHT='16' BORDER=0 ALT=''></td>";
echo   "<Td><IMG SRC='images/wzedit.gif' WIDTH='16' HEIGHT='17' BORDER=0 ALT=''></td></tr>";
$sum_momey_proj=0;
$total_withdraw=0;
for($i=1;$i<$rd;$i++)
{		
		$sum_momey_proj=$sum_momey_proj+$budget_proj_plan_ar[$i];
		$total_withdraw=$total_withdraw+$proj_sum_ar[$i];
		$budget_project=number_format($budget_proj_plan_ar[$i],2);
		if($code_clus_plan_ar[$i]=='01')
		$project_clus="  (กลุ่มอำนวยการ)";
		if($code_clus_plan_ar[$i]=='02')
		$project_clus="  (กลุ่มนโยบายและแผน)";
		if($code_clus_plan_ar[$i]=='03')
		$project_clus="  (กลุ่มบริหารงานบุคคล)";
		if($code_clus_plan_ar[$i]=='04')
		$project_clus="  (กลุ่มส่งเสริมการจัดการศึกษา)";
		if($code_clus_plan_ar[$i]=='05')
		$project_clus="  (กลุ่มนิเทศฯ)";
		if($code_clus_plan_ar[$i]=='06')
		$project_clus="  (หน่วยตรวจสอบภายใน)";
		if($code_clus_plan_ar[$i]=='07')
		$project_clus="  (กลุ่มเอกชน)";
		
		if($budget_proj_plan_ar[$i]>0)
			{
			$proj_percent=($proj_sum_ar[$i]/$budget_proj_plan_ar[$i])*100;
			$proj_percent=number_format($proj_percent,2);
			}
		else{
			$proj_percent="0.00";}

			$budget_proj=number_format($budget_proj_plan_ar[$i]);
			$proj_sum=number_format($proj_sum_ar[$i],2);
			$net_proj=$budget_proj_plan_ar[$i]-$proj_sum_ar[$i];
			$net_proj2=number_format($net_proj,2);
			$total_net=$total_net+$net_proj; 
			echo "<Tr bgcolor=#FFFFCC><Td align=center><font  size='2'>$code_clus_plan_ar[$i]</font></Td><Td align=center><font  size='2'> $code_tegy_planc_ar[$i]</font></Td><Td><font  size='2'>$name_proj_plan_ar[$i]</font></Td><Td align=right><font  size='2'>$budget_proj</font></Td><Td align=left><font  size='2'>$owner_proj_plan_ar[$i]</font></Td>";
			if  (empty($file_detail_plan_ar[$i]))
				{
				if  ( $code_tegy_plan_ar[$i]=="?")
					{echo   "<Td align='center'><IMG SRC='images/dot_yellow.png' WIDTH='10' HEIGHT='10' BORDER=0 ALT=''  title='ไม่ระบุกลยุทธ์'></td>";}
				else
					{echo   "<Td align='center'><IMG SRC='images/dot_red.png' WIDTH='10' HEIGHT='10' BORDER=0 ALT=''  title='ไม่มีโครงการ'></td>";}
				}
			else
				{ 
				if  (!empty($file_detail_plan_ar[$i]))
					{
					echo   "<Td> <a href='$file_detail_plan_ar[$i]'  target='_blank' title='อ่านโครงการ'><img src=\"images/b_browse.png\" width='16' height='16' border='0' name=\"image4\"> </a></td>"; }
			}  //if  (empty($file_detail_plan_ar[$i]))
//ส่วนรายงานผลการดำเนินงาน //
			if  (($mpms_moderate == "1") and ($file_detail_plan_ar[$i] !=""))
				{
				if  ( (empty($eval_activity_plan_ar[$i])) and ($mpms_view == "1"))
					{echo   "<Td><A Href=\"budget_edit_eval.php?vcode_proj=$code_proj_plan_ar[$i]&vcode_clus=$code_clus_plan_ar[$i]&vcode_tegy=$code_tegy_plan_ar[$i]&vname_proj=$name_proj_plan_ar[$i]&vbudget_proj=$budget_proj_plan_ar[$i]&fname=$fname_plan_ar[$i]&cname=$cname_plan_ar[$i]\"  target= _top><IMG SRC='images/b_browse.png' WIDTH='16' HEIGHT='16' BORDER=0 ALT=''  title='รอการรายงาน'></A></td></Tr>"; }
				else {
						if (empty($allow_edit_plan_ar[$i]) or $allow_edit_plan_ar[$i]=="x")
							{echo   "<Td><A Href=\"budget_edit_eval.php?vcode_proj=$code_proj_plan_ar[$i]&vcode_clus=$code_clus_plan_ar[$i]&vcode_tegy=$code_tegy_plan_ar[$i]&vname_proj=$name_proj_plan_ar[$i]&vbudget_proj=$budget_proj_plan_ar[$i]&fname=$fname_plan_ar[$i]&cname=$cname_plan_ar[$i]\"  target=  _top><IMG SRC='images/b_edit.png' WIDTH='16' HEIGHT='16' BORDER=0 ALT=''  title='ปรับปรุง แก้ไข'></A></td></Tr>"; }
						else
							{echo   "<Td><A Href=\"budget_end_eval.php?vcode_proj=$code_proj_plan_ar[$i]&vcode_clus=$code_clus_plan_ar[$i]&vcode_tegy=$code_tegy_plan_ar[$i]&vname_proj=$name_proj_plan_ar[$i]&vbudget_proj=$budget_proj_plan_ar[$i]&fname=$fname_plan_ar[$i]&cname=$cname_plan_ar[$i]\"  target=  _top><IMG SRC='images/s_okay.png' WIDTH='16' HEIGHT='16' BORDER=0 ALT=''  title='จบการรายงาน'></A></td></Tr>";}
				}
			}
else
	{
	if  ( (empty($file_detail_plan_ar[$i])) and ($mpms_view == "1"))
		{
			if  (  $code_tegy_plan_ar[$i]=="?")
				{echo   "<Td align='center'><IMG SRC='images/frm_linevrlt.png' WIDTH='10' HEIGHT='10' BORDER=0 ALT=''  title='ติดต่อเจ้าหน้าที่'></td></Tr>";}
			else
				{echo   "<Td align='center'><IMG SRC='images/dot_red.png' WIDTH='10' HEIGHT='10' BORDER=0 ALT=''  title='ไม่ส่งโครงการ'></td></Tr>";}
		}
	  }
	} 
		$acti_num=0;
		for($x=1;$x<$re;$x++)
		{
				if($code_proj_plan_ar[$i]==$code_proj_acti_ar[$x])
					{
					$acti_num=$acti_num+1;
					$budget_acti=number_format($budget_acti_ar[$x],2);
					$acti_sum=number_format($acti_sum_ar[$x],2);
					$net_acti=$budget_acti_ar[$x]-$acti_sum_ar[$x];
					$net_acti2=number_format($net_acti,2);
				}
		}
		if($sum_momey_proj>0)
		{
		$spt_percent=($total_withdraw/$sum_momey_proj)*100;
		$spt_percent=number_format($spt_percent,2);
		}
		else
		$spt_percent="0.00";
$sum_momey_proj=number_format($sum_momey_proj,2);
$total_withdraw=number_format($total_withdraw,2);
$total_net=number_format($total_net,2);
echo  "<table width=95% border=1  borderColor=#FF0033  align=center >";
echo "<Tr bgcolor=#FFCCCC align=center>";
echo "<Td width='30%'>รวม  : $sum_momey_proj&nbsp;</Td><Td  width='30%'>&nbsp;เบิกจ่าย :  $total_withdraw&nbsp;</Td><Td width='30%'>&nbsp;คงเหลือ : $total_net&nbsp;</Td><Td>$spt_percent&nbsp;%</Td></Tr></Table>";
echo "</Table>";
mysql_close();
?>