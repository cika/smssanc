<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );

if(isset($_REQUEST['ed_year'])){
$ed_year=$_REQUEST['ed_year'];
}else{
$ed_year="";
}

if(isset($_REQUEST['test_class'])){
	$test_class=$_REQUEST['test_class'];
}else{
	$test_class="";
}

if(!($result_permission['p3']==1)) {
exit();
}

$officer=$_SESSION['login_user_id'];
$class_ar[2]="ชั้นประถมศึกษาปีที่ 2";
$class_ar[5]="ชั้นประถมศึกษาปีที่ 5";

echo "<br>";
//ส่วนฟอร์มกำหนดปีการศึกษา
if($ed_year==""){
echo "<br />";
echo "<form id='frm1' name='frm1'>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>กำหนดปีการศึกษา และชั้นสอบ LAST</Font>";
echo "</Cener>";
echo "<Br><Br>";
echo "<Table width='300' Border='0' Bgcolor='#Fcf9d8'>";
echo "<Tr><Td align='right'>ปีการศึกษา&nbsp;&nbsp;&nbsp;&nbsp;</Td><Td align='left'><Input Type='Text' Name='ed_year'  id='ed_year' Size='4' maxlength='4' onkeydown='integerOnly()'></Td></Tr>";
echo "<Tr><Td align='right'>ชั้น&nbsp;&nbsp;&nbsp;&nbsp;</Td>";
echo "<td><div align='left'><Select  name='test_class'  id='test_class' size='1'>";
echo  "<option  value = ''>เลือก</option>" ;
echo  "<option value = '2'>ประถมศึกษาปีที่ 2</option>";
echo  "<option value = '5'>ประถมศึกษาปีที่ 5</option>";
echo "</select>";
echo "</div></td></tr>";

echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
echo "<tr><td align='center' colspan='2'><INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url2(1)'  ></td></tr>";
echo "</Table>";
echo "</form>";
}

//ส่วนบันทึกข้อมูล
if($index==4){
$rec_date=date("Y-m-d");
		for($M=1;$M<4;$M++){
		$thai=$_POST[$M][1];
		$math=$_POST[$M][2];
		$science=$_POST[$M][3];
		$social=$_POST[$M][4];
		$english=$_POST[$M][5];
		$health=$_POST[$M][6];
		$art=$_POST[$M][7];
		$vocation=$_POST[$M][8];
		$score_avg=$_POST[$M][9];			
		$test_level=$_POST[$M][11];			
				
						$sql_select = "select * from  achievement_main  where  level='$M' and ed_year='$ed_year' and test_class='$test_class' and test_type='3' ";
						$dbquery_select = mysql_query($sql_select);
						$data_num=mysql_num_rows($dbquery_select);
									if($data_num>0){
									$sql_update = "update  achievement_main set thai='$thai',
									math='$math',
									science='$science',
									social='$social',
									english='$english',
									health='$health',
									art='$art',
									vocation='$vocation',
									score_avg='$score_avg',									
									officer='$officer',
									rec_date='$rec_date' 
									where  test_type='3' and test_class='$test_class' and ed_year='$ed_year' and level='$test_level' ";
									$dbquery_update = mysql_query($sql_update);
									}
									else {
													if($score_avg>0){
													$sql_insert = "insert into achievement_main (test_type, test_class, ed_year, level, thai, math, science, social, english, health, art,vocation, score_avg, officer, rec_date) values ('3', '$test_class', '$ed_year', '$test_level', '$thai', '$math', '$science', '$social', '$english', '$health', '$art', '$vocation', '$score_avg', '$officer', '$rec_date')";
													$dbquery_insert = mysql_query($sql_insert);
													}
									}
		}	
}
//ส่วนแสดงหลัก
if($index==1 or $index==4 or $index==5 ){
$test_calss=$test_class;
echo "<br />";
echo "<table width='99%' border='0' align='center'>";
echo "<tr align='center'>
	<td align=center><font color='#990000' size='3'><strong>บันทึกคะแนน LAST $class_ar[$test_calss]  ปีการศึกษา $ed_year </strong></font>
<font color='#006666' size='3'><strong></strong></font>
</td></tr>";
echo "</table>";
echo "<br />";

echo "<form id='frm1' name='frm1'>";
echo  "<table width='98%' border='0' align='center'>";
echo "<Tr bgcolor='#FFCCCC' align='center'><Td width='50'>ที่</Td>";
echo "<Td>ระดับ</Td><Td>ภาษาไทย</Td><Td>คณิต</Td><Td>วิทย์</Td><Td>สังคม</Td><Td>อังกฤษ</Td><Td>สุขศึกษา</Td><Td>ศิลปะ</Td><Td>การงาน</Td><Td>เฉลี่ย</Td></Tr>";
for($M=1;$M<4;$M++){
			if(($M%2) == 0){
			$color="#FFFFC";
			}
			else {
			$color="#FFFFFF";
			}
						$sql_select = "select * from  achievement_main  where  level='$M' and ed_year='$ed_year' and test_class='$test_class' and test_type='3' ";
						$dbquery_select = mysql_query($sql_select);
						$result_select  = mysql_fetch_array($dbquery_select);

echo "<Tr  bgcolor='$color' align='center'><Td>$M</Td>";
echo "</Td><Td align='left'>";
				if($M==1){
				echo "คะแนนเฉลี่ยโรงเรียน";
				}
				else if($M==2){
				echo "คะแนนเฉลี่ย สพท.";
				}
				else if($M==3){
				echo "คะแนนเฉลี่ยประเทศ";
				}
echo "</Td>";
$M_['M']=$M;
echo "<Td><input type='text' name='$M_[M][1]'  id='$M_[M][1]'  size= 6 value='$result_select[thai]' ></Td>";
echo "<Td><input type='text' name='$M_[M][2]' id='$M_[M][2]'  size= 6 value='$result_select[math]'></Td>";
echo "<Td><input type='text' name='$M_[M][3]' id='$M_[M][3]'  size= 6 value='$result_select[science]' ></Td>";
echo "<Td><input type='text' name='$M_[M][4]' id='$M_[M][4]'  size= 6 value='$result_select[social]'></Td>";
echo "<Td><input type='text' name='$M_[M][5]' id='$M_[M][5]'  size= 6 value='$result_select[english]'></Td>";
echo "<Td><input type='text' name='$M_[M][6]' id='$M_[M][6]'  size= 6 value='$result_select[health]'></Td>";
echo "<Td><input type='text' name='$M_[M][7]' id='$M_[M][7]'  size= 6 value='$result_select[art]'></Td>";
echo "<Td><input type='text' name='$M_[M][8]' id='$M_[M][8]'  size= 6 value='$result_select[vocation]'></Td>";
echo "<Td><input type='text' name='$M_[M][9]' id='$M_[M][9]'  size= 6 value='$result_select[score_avg]'></Td>";
echo "<input type='hidden' name='$M_[M][11]'  id='$M_[M][11]'  value='$M'>";   //ระดับการสอบ รร สพท ประเทศ
}
echo  "<input type='hidden' name='ed_year'  id='ed_year'    value='$ed_year'>";
echo  "<input type='hidden' name='test_class'  id='test_class'    value='$test_class'>";
echo "</Table>";
echo "<Br>";
echo "<div align='center'><INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url(1)' class=entrybutton></div>";
echo "</form>";
}
?>

<script>
function goto_url2(val){
	 if(val==1){
			if(frm1.ed_year.value == ""){
			alert("กรุณากรอกปีการศึกษา");
			}else if(frm1.test_class.value == ""){
			alert("กรุณาเลือกชั้น");
			}else{
			callfrm("?option=achievement&task=main/add_score_3&index=1");   
			}
	}
}

function goto_url(val){
	if(val==1){
			if(frm1.ed_year.value == ""){
			alert("ปีการศึกษาไม่ได้ระบุ โประบุปีการศึกษา");
			}else{
			callfrm("?option=achievement&task=main/add_score_3&index=4");  
			} 
	}
}

</script>

