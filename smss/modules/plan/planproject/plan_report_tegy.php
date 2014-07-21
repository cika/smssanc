<?php
	session_start();
	//$data_REQUEST = ( $_POST );
	include("./budget_authenfg.php");  //$config[.....]
	$index=$_REQUEST["index"];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><?=$config[title] ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
</head>

<body>
<table width="90%" border="0" align="center">
  <tr>
    <td><div align="center">
        <p><B><font size="4" color="blue"><?=$config[headerdetail] ?></font></B><BR><font color="#006666" size="5"><strong><font size="4">รายงานการใช้จ่ายงบประมาณรายกลยุทธ์จำแนกตามโครงการ</font></strong></font></p>
      </div></td>
  </tr>
</table>
<?php
require_once("dbconfig.inc.php");
echo  "<table width=100% border=0>";
 echo "<tr><td><div align=center><font color=#000033>[<a href=budget_report_tegy.php?index=>ทั้งหมด</a>][<a href=budget_report_tegy.php?index=1>กลยุทธ์ที่ 1</a>][<a href=budget_report_tegy.php?index=2>กลยุทธ์ที่ 2</a>][<a href=budget_report_tegy.php?index=3>กลยุทธ์ที่ 3</a>][<a href=budget_report_tegy.php?index=4>กลยุทธ์ที่ 4</a>][<a href=budget_report_tegy.php?index=5>กลยุทธ์ที่ 5</a>][<a href=budget_report_tegy.php?index=6>กลยุทธ์ที่ 6</a>]</font></div></td></tr>";
//[<a href=budget_report_tegy.php?index=>อื่น ๆ </a>]
if($index==1)
$group="กลยุทธ์ที่ 1";
if($index==2)
$group="กลยุทธ์ที่ 2";
if($index==3)
$group="กลยุทธ์ที่ 3";
if($index==4)
$group="กลยุทธ์ที่ 4";
if($index==5)
$group="กลยุทธ์ที่ 5";
if($index==6)
$group="กลยุทธ์ที่ 6";
//if($index==7)
//$group="อื่น ๆ";

echo "<tr><td><div align=center><font color=#990000 size=4>$group</font></div></td></tr>";
echo "</table>";

 if($index!="")
$sql = "select  *  from  plan_proj  where code_tegy='$index' order by code_clus ";
else
$sql = "select  *  from  plan_proj  order by code_clus ";
					$dbquery =DBfieldQuery($sql);
					$rd=1;
					While ($result = mysql_fetch_array($dbquery))
						{
							$code_clus_plan= $result[code_clus];
							$code_proj_plan= $result[code_proj];
							$name_proj_plan= $result[name_proj];
							$budget_proj_plan= $result[budget_proj];
							
							$code_clus_plan_ar[$rd]=$code_clus_plan;
							$code_proj_plan_ar[$rd]=$code_proj_plan;
							$name_proj_plan_ar[$rd]=$name_proj_plan;
							$budget_proj_plan_ar[$rd]=$budget_proj_plan;
						$rd++;
	    				}
						
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
											$sql = "select   id,  pj_activity , money from  withdraw where  pj_activity=$code_acti_ar[$x]";
											$dbquery =DBfieldQuery($sql);
											While ($result = mysql_fetch_array($dbquery))
											{
											$id= $result[id];
											$money= $result[money];
											$acti_sum=$acti_sum+$money;
											}
											$acti_sum_ar[$x]=$acti_sum;
											$proj_sum=$proj_sum+$acti_sum;
										}
								}
						$proj_sum_ar[$i]=$proj_sum;
						$total_withdraw=$total_withdraw+$proj_sum_ar[$i];			
						}
						
						
$space="  ";
echo  "<table width=98% border=0 align=center>";
echo "<Tr bgcolor=#FFCCCC align=center><Td>ที่</Td><Td>รหัส</Td><Td>โครงการ</Td><Td>กิจกรรม</Td><Td>งบประมาณ</Td><Td>ใช้จ่าย</Td><Td>คงเหลือ</Td><Td>%จ่าย</Td><Td></Td></Tr>";

for($i=1;$i<$rd;$i++)
{		
		$sum_momey_proj=$sum_momey_proj+$budget_proj_plan_ar[$i];
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
		else
		$proj_percent="0.00";
		
		$proj_sum=number_format($proj_sum_ar[$i],2);
		$net_proj=$budget_proj_plan_ar[$i]-$proj_sum_ar[$i];
		$net_proj2=number_format($net_proj,2);
		$total_net=$total_net+$net_proj; //#FFFFC
		echo "<Tr bgcolor=#FFCCFF><Td align=center>$i</Td><Td>$code_proj_plan_ar[$i]</Td><Td   colspan=2>$name_proj_plan_ar[$i]$project_clus</Td><Td align=right>$budget_project</Td><Td align=right>$proj_sum</Td><Td align=right>$net_proj2</Td><Td align=right>$proj_percent</Td><Td></Td></Tr>";		
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
					
					if($budget_acti_ar[$x]>0)
					{
					$acti_percent=($acti_sum_ar[$x]/$budget_acti_ar[$x])*100;
					$acti_percent=number_format($acti_percent,2);
					}
					else
					$acti_percent="0.00";
					
					echo "<Tr ><Td ></Td><Td></Td><Td></Td><Td align=left>$code_acti_ar[$x]$space$name_acti_ar[$x]</Td><Td align=right>$budget_acti</Td><Td align=right>$acti_sum</Td><Td align=right>$net_acti2</Td><Td align=right>$acti_percent</Td>";
					if($acti_sum!=0)
						echo "<Td><div align=center><img SRC=images/b_browse.png></a></div></Td>";
					else  echo"<Td></Td>";
					//echo "<Td><div align=center><font size=3><a href=report_10_2.php?pj_activity=$code_acti_ar[$x] target=_blank><img SRC=images/b_browse.png></a></font></div></Td>";
					//else  echo"<Td></Td>";
					echo "</Tr>";
					}
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


echo "<Tr bgcolor=#FFCCCC align=center><Td></Td><Td></Td><Td></Td><Td>รวม</Td><Td>$sum_momey_proj</Td><Td>$total_withdraw</Td><Td>$total_net</Td><Td>$spt_percent</Td><Td></Td></Tr>";


echo "</Table>";
mysql_close();
?>
</body>
</html>
