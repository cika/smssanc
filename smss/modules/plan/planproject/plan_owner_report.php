<?php
	require_once("plan_authen.php");  //session_
	if(isset($_REQUEST['workgroup'])){
	$workgroup=$_REQUEST['workgroup'];
	}
	if(isset($_REQUEST['year_index'])){
	$year_index=$_REQUEST['year_index'];
	}
	if(isset($_SESSION["budget_year"])){
	$proj_year=$_SESSION["budget_year"];
	}
	
	if(isset($year_index)){
	$proj_year=$year_index;
	}
	
if($proj_year==""){
	echo "<br><div align='center'>ยังไม่ได้กำหนดปีงบประมาณ</div>";
	exit();
}
	
?>
<p align="center" STYLE="font-family: 'sans-serif', fantasy; font-size: 13pt; color:blue;font-weight: bold;">รายงานผลการดำเนินงานโครงการ</Font></p>
<!-- Part2	## -->
<FORM  name="frm1" >
<?php
//เลือกปี และกลุ่ม
require_once("dbconfig.inc.php");

	echo "<table width='95%' align='center'><tr><td align='right'>";
//////////////////	
	echo "ปีงบประมาณ&nbsp";
	echo "<Select  name='year_index' size='1'>";
	echo  '<option value ="" >เลือก</option>' ;
	$sql_year = "SELECT *  FROM  plan_year order by budget_year";
	$dbquery_year =DBfieldQuery($sql_year);
	While ($result_year = mysql_fetch_array($dbquery_year)){
			 if($year_index==""){
					if($result_year['year_active']==1){
					echo "<option value=$result_year[budget_year]  selected>$result_year[budget_year]</option>"; 
					}
					else{
					echo "<option value=$result_year[budget_year]>$result_year[budget_year]</option>"; 
					}
			}
			else{
					if($year_index==$result_year['budget_year']){
					echo "<option value=$result_year[budget_year]  selected>$result_year[budget_year]</option>"; 
					}
					else{
					echo "<option value=$result_year[budget_year]>$result_year[budget_year]</option>"; 
					}
			}		
	}
	echo "</select>&nbsp;";
/////////////////////
	echo "<Select  name='workgroup' size='1'>";
	echo  '<option value ="" >ทุกกลุ่ม(งาน)</option>' ;
						$sql = "SELECT *  FROM   system_workgroup";
						$dbquery =DBfieldQuery($sql);
						While ($result = mysql_fetch_array($dbquery))
							{ 
								if ($workgroup==$result[workgroup]){
								echo "<option value=$result[workgroup]  selected>$result[workgroup_desc]</option>"; 
								} 
								else{
								echo "<option value=$result[workgroup]>$result[workgroup_desc]</option>"; 
								}
							}
					echo "</select>";
					echo "&nbsp;<INPUT TYPE='button' name='smb' value='เลือก' onclick='goto_url(1)' class=entrybutton>";
echo "</td></tr></table>";
?>     
</FORM>

<?php
if(!isset($workgroup)){
$workgroup="";
}
ShowProj($workgroup,$proj_year);#######################################
function ShowProj($workgroup,$proj_year){
//อาเรย์บุคลากร
$sql = "SELECT *  FROM  person_main order by position_code,name";
$dbquery=DBfieldQuery($sql);
while ($result = mysql_fetch_array($dbquery)){
$person_ar[$result['person_id']]=$result['prename'].$result['name']." ".$result['surname'];
}

 if($workgroup!="")
$sql = "select * from  plan_proj  where (code_clus='$workgroup')  and  (budget_year='$proj_year') order by code_proj ";
else
$sql = "select * from  plan_proj  where (budget_year='$proj_year') order by code_proj ";
$dbquery =DBfieldQuery($sql);
$rd=1;
$budget_proj_sum=0; //ตัวแปรรวมเงินโครงการ
While ($result = mysql_fetch_array($dbquery)) {
$code_clus_plan= $result['code_clus'];
$code_proj_plan= $result['code_proj'];
$name_proj_plan= $result['name_proj'];
$budget_proj_plan= $result['budget_proj'];
	$budget_proj_sum=$budget_proj_sum+$budget_proj_plan;  //รวมเงินโครงการ
$owner_proj_plan =$result['owner_proj'];
$code_tegy_plan =$result['code_tegy'];
$file_detail_plan =$result['file_detail']; 
$eval_activity_plan =$result['eval_activity'];

$id_ar[$rd] =$result['id']; //อาเรย์id
$eval_result_ar[$rd] =$result['eval_result']; //อาเรย์ผลการดำเนินงาน
$eval_particular_ar[$rd] =$result['eval_particular'];  //อาเรย์ไฟล์รายงานโครงการ


$allow_edit_plan =$result['allow_edit'];
$owner_proj_plan=trim($owner_proj_plan);
$point=strpos($owner_proj_plan,chr('38'));
$len=strlen($owner_proj_plan);
		if(($point>0) and ($point<5))
		{	$owner_proj_plan=substr($owner_proj_plan,$point,$len);
		$point=strpos($owner_proj_plan,chr('38'));
		$len=strlen($owner_proj_plan);
		}
$long=$len-$point;
$fname=substr($owner_proj_plan,0,$point);
$sname=substr($owner_proj_plan,-$long,$long);
$cname=trim($sname);
if(isset($budget_proj)){
$Fcredit1=number_format($budget_proj);
}
//::: valiable array ::://
$code_clus_plan_ar[$rd]=$code_clus_plan;
$code_proj_plan_ar[$rd]=$code_proj_plan;
$name_proj_plan_ar[$rd]=$name_proj_plan;
$budget_proj_plan_ar[$rd]=$budget_proj_plan;
$file_detail_plan_ar[$rd]=$file_detail_plan; 
$eval_activity_plan_ar[$rd]=$eval_activity_plan;
$allow_edit_plan_ar[$rd]=$allow_edit_plan;
$owner_proj_plan_ar[$rd]=$owner_proj_plan;
$fname_plan_ar[$rd]=$fname;
$cname_plan_ar[$rd]=$cname;
		if(empty($code_tegy_plan))
		{   $code_tegy_plan="?";   }
		$code_tegy_plan_ar[$rd] =$code_tegy_plan;
$rd++;
}
//::: End valiable array ::://		

					$sql_acti = "select * from  plan_acti where budget_year='$proj_year' order by code_acti";
					$dbquery_acti =DBfieldQuery($sql_acti);
					$re=1;
					While ($result_acti = mysql_fetch_array($dbquery_acti))
						{
							$code_proj_acti= $result_acti['code_proj'];
							$code_acti= $result_acti['code_acti'];
							$name_acti= $result_acti['name_acti'];
							$budget_acti= $result_acti['budget_acti'];
							
							$code_proj_acti_ar[$re]=$code_proj_acti;
							$code_acti_ar[$re]=$code_acti;
							$name_acti_ar[$re]=$name_acti;
							$budget_acti_ar[$re]=$budget_acti;
						$re++;
	    				}

$space="  ";
echo  "<table width='95%' border='1'  borderColor='#FF0033'  align='center' >";
echo   "<Tr bgcolor='#FBD562'><Td  width='5%' valign='center'  align='center' ><font  size='2'>ที่</font></td>";
echo   "<Td  width='5%'  valign='center'  align='center' ><font  size='2'>รหัสโครงการ</font></td>";
echo   "<Td valign='center'  align='center' ><font  size='2'>ชื่อโครงการ/ชื่อกิจกรรม</font></td>";
echo   "<Td  width='12%' valign='center'  align='center' ><font  size='2'>งบประมาณ</font></td>";
echo   "<Td  width='18%'  valign='center'  align='center' ><font  size='2'>หัวหน้าโครงการ</font></td>";
echo   "<Td width='5%' align='center'>รายงาน</td>";
echo   "<Td width='5%' align='center'>ไฟล์</td>";
echo   "<Td width='5%' align='center'>เขียนรายงาน</td>";
echo   "</tr>";

for($i=1;$i<$rd;$i++)
{		

		$budget_proj=number_format($budget_proj_plan_ar[$i],2);
		echo "<Tr bgcolor='#CCFFFF'><Td align=center><font  size='2'>$i</font></Td><Td align=center><font  size='2'>$code_proj_plan_ar[$i]</font></Td><Td><font  size='2'>$name_proj_plan_ar[$i]</font></Td><Td align=right><font  size='2'>$budget_proj</font></Td><Td align=left><font  size='2'>";
echo $person_ar[$owner_proj_plan_ar[$i]];
echo "</font></Td>";	

//รายงานโครงการ
		if($eval_result_ar[$i] !=""){
		echo "<Td align='center'> <a href='?option=plan&task=planproject/plan_owner_report3&plan_proj_id=$id_ar[$i]'><img src='images/b_browse.png' width='16' height='16' border='0' alt='คลิก อ่านรายงานโครงการ''> </a></td>";	
		
		}
		else{
		echo "<Td align='center'><img src='images/no.png' width='16' height='16' border='0' alt='ยังไม่ได้รายงาน'></td>";	
		}

		if($eval_particular_ar[$i] !=""){
		echo "<Td align='center'> <a href='$eval_particular_ar[$i]' target='_blank' title='อ่านเอกสารรายงานโครงการ'><img src='images/b_browse.png' width='16' height='16' border='0'></a></td>";	
		 }
		 else{
		 echo "<Td>&nbsp;</td>";
		}

// เขียนรายงาน		
		if($_SESSION['login_user_id']==$owner_proj_plan_ar[$i]){
		echo "<Td align='center'><a href='?option=plan&task=planproject/plan_owner_report2&plan_proj_id=$id_ar[$i]'><img src='images/edit.png' width='16' height='16' border='0' alt='คลิก เขียนรายงานโครงการ'> </a></td>";	
		}
		 else{
		 echo "<Td>&nbsp;</td>";
		}
		
echo "</tr>";

		for($x=1;$x<$re;$x++)
		{
				if($code_proj_acti_ar[$x]==$code_proj_plan_ar[$i]){
				echo "<Tr><Td>&nbsp;</td>";
				echo "<Td>&nbsp;</td>";
				echo "<Td>$code_acti_ar[$x]&nbsp;$name_acti_ar[$x]</td>";
				$budget_acti_ar[$x]=number_format($budget_acti_ar[$x],2);
				echo "<Td align='right'>$budget_acti_ar[$x]</td>";
				echo "<Td>&nbsp;</td>";
				echo "<Td>&nbsp;</td>";
				echo "<Td>&nbsp;</td>";
				echo "<Td>&nbsp;</td>";
				echo "</tr>";
				}
		}
} //loop rd		
$budget_proj_sum=number_format($budget_proj_sum,2);
echo "<Tr bgcolor='#FBD562' align='center'>";
echo "<Td colspan='3' align='center'>รวม</Td><td>$budget_proj_sum</td><Td colspan='6'>&nbsp;</Td></Tr></Table>";

return 0;
} //function
?>

<script>
function goto_url(val){
callfrm("?option=plan&task=planproject/plan_owner_report"); 		
}

</script>
