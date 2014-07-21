<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
include("FusionCharts/FusionCharts.php");
include("FusionCharts/Fc_Colors.php");

if(isset($_REQUEST['ed_year'])){
$ed_year=$_REQUEST['ed_year'];
}else{
$ed_year="";
}

?>
	<SCRIPT LANGUAGE="Javascript" SRC="FusionCharts/FusionCharts.js"></SCRIPT>
	<style type="text/css">
	<!--
	body {
		font-family: Arial, Helvetica, sans-serif;
		font-size: 12px;
	}
	.text{
		font-family: Arial, Helvetica, sans-serif;
		font-size: 12px;
	}
	-->
	</style>

<CENTER>
<h2>คะแนนสอบ O-NET</h2>
<h3>ชั้นมัธยมศึกษาปีที่ 6</h3>
<?php
echo "<form id='frm1' name='frm1'>";
echo "<table width='95%' align='center'><tr><td align='right'>";
echo "<Select  name='ed_year' size='1'>";
$sql = "select distinct ed_year from achievement_main  where  achievement_main.test_type='1' and achievement_main.test_class='12' order by ed_year desc limit 4";
$dbquery = mysql_query($sql);
$year_num=1;
	While ($result = mysql_fetch_array($dbquery)){
			if($ed_year==""){
			echo "<option value=$result[ed_year]>ปีการศึกษา$result[ed_year]</option>"; 
			}
			else{
						if($ed_year==$result[ed_year]){
						echo "<option value=$result[ed_year] selected>ปีการศึกษา$result[ed_year]</option>"; 
						}
						else{
						echo "<option value=$result[ed_year]>ปีการศึกษา$result[ed_year]</option>"; 
						}
			}		
$ed_year_ar[$year_num]=$result['ed_year'];
$year_num++;
}
	echo "</select>";
	echo "&nbsp;<INPUT TYPE='button' name='smb' value='เลือก' onclick='goto_display(1)' class='entrybutton'>";
echo "</td></tr></table>";
echo "</form>";

   //ตั้งค่าสีกราฟ
   $color[1]='B3AA00';
   $color[2]='008ED6';
   $color[3]='9D080D';
   $color[4]='A186BE';
   
   //ค่าระดับการสอบ
   $test_level_ar[1]="ระดับโรงเรียน";
   $test_level_ar[2]="ระดับสพท.";
   $test_level_ar[3]="ระดับประเทศ";
   
$strXML = "<graph xaxisname='กลุ่มสาระ' yaxisname='Score' hovercapbg='DEDEBE' hovercapborder='889E6D' rotateNames='0' yAxisMaxValue='100' numdivlines='9' divLineColor='CCCCCC' divLineAlpha='80' decimalPrecision='0' showAlternateHGridColor='1' AlternateHGridAlpha='30' AlternateHGridColor='CCCCCC' caption='' subcaption='' >";
   $strXML .= "<categories font='Arial' fontSize='11' fontColor='000000'>";
      $strXML .= "<category name='ภาษาไทย' />";
      $strXML .= "<category name='คณิตศาสตร์' />";
      $strXML .= "<category name='วิทยาศาสตร์' />";
      $strXML .= "<category name='สังคมศึกษา' />";
      $strXML .= "<category name='ภาษาอังกฤษ' />";
      $strXML .= "<category name='สุขศึกษา' />";
	  $strXML .= "<category name='ศิลปะ' />";
      $strXML .= "<category name='การงาน' />";
      $strXML .= "<category name='เฉลี่ย' />";
   $strXML .= "</categories>";
   
  for($x=3;$x>0;$x--){
  			if($ed_year==""){
				if(isset($ed_year_ar[1])){
					$ed_year_ar[1]=$ed_year_ar[1];
				}else{
					$ed_year_ar[1]="";
				}

  			$strQuery = "select  thai, math, science, social,  english, health, art, vocation, score_avg from achievement_main where  test_type='1' and test_class='12' and  ed_year='$ed_year_ar[1]'  and level='$x' ";
			}
  			else {
  			$strQuery = "select  thai, math, science, social,  english, health, art, vocation, score_avg from achievement_main where  test_type='1' and test_class='12' and  ed_year='$ed_year'  and  level='$x' ";
			}
			$result = mysql_query($strQuery);
			$ors = mysql_fetch_array($result);  
		   	$strXML .= "<dataset seriesname='ระดับ$test_level_ar[$x]' color='$color[$x]'>";
			$strXML .= "<set value='$ors[thai]' />";
			$strXML .= "<set value='$ors[math]' />";
			$strXML .= "<set value='$ors[science]' />";
			$strXML .= "<set value='$ors[social]' />";
			$strXML .= "<set value='$ors[english]' />";
			$strXML .= "<set value='$ors[health]' />";
			$strXML .= "<set value='$ors[art]' />";
			$strXML .= "<set value='$ors[vocation]' />";
			$strXML .= "<set value='$ors[score_avg]' />";
		   	$strXML .= "</dataset>";
  }
$strXML .= "</graph>";
	echo renderChart("FusionCharts/FCF_MSColumn3D.swf", "", $strXML, "Fc", 1000, 450);
			  
?>
</CENTER>

<script>
function goto_display(val){
	if(val==1){
		callfrm("?option=achievement&task=main/report31"); 
		}
}
</script>