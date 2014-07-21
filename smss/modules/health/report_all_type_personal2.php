<?php 
 include "./modules/health/tab.php";

			 if(isset($_REQUEST['student_id'])){
			$student_id=$_REQUEST['student_id'];
			 }else{
				 $student_id="";
				 }
				 if(isset($_REQUEST['room'])){
				$room=$_REQUEST['room'];		
			 }else{
				 $room="";
				 }
			  if(isset($_REQUEST['class_code'])){
				$class_code=$_REQUEST['class_code'];
			  }else{
				  $class_code="";
				  }
			   if(isset($_REQUEST['year_in'])){
				$year_bs=$_REQUEST['year_in'];
			   }else{
				  	$year_bs=""; 
				   }
			   if(isset($_REQUEST['ck'])){
				$ck=$_REQUEST['ck'];
	 		  }else{
				  $ck="";
				  }
	   		  if(isset($_REQUEST['tm'])){
				$tm=$_REQUEST['tm'];
				 }else{
					 $tm="";
					 }
			
				
				$sqlCK="SELECT* FROM student_main WHERE student_id='$student_id'  AND status='0'";
		  		$resultCK=mysql_query($sqlCK); 
				$recordCK=mysql_fetch_array($resultCK);
				
				$sqlCKC="SELECT* FROM student_main_class WHERE class_code='$recordCK[class_now]'";
				$resultCKC=mysql_query($sqlCKC); 
				$recordCKC=mysql_fetch_array($resultCKC);
		
		?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel='stylesheet' href='modules/health/config_color.css'>
<title>ตรวจสุขภาพนักเรียน</title>
<style>
.menu{background-color:; }
.menu-over{background-color:#22F942;}
</style>
</head>

<body topmargin="0" bgcolor="#F4FFF4">
<br>

<table width="1200" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#99CCFF" bgcolor="#FFFFFF">
<tr>
<td width="1999" height="30" bgcolor="#0066FF"><?php echo $t2;?><font color="#FFFFFF">รายงาน :: ตรววจสุขภาพนักเรียนรายบุคคล</font></td>
</tr>
  <tr>
    <td>
    <table width="1198" border="0">
      <tr>
        <td width="149" rowspan="4" align="center" valign="middle"><img src='modules/health/iconH/logospt.jpg' alt='แก้ไข' width='80' height='80' border='0'></td>
        <td colspan="3" align="center"><strong>รายงาน แบบ แยกตามเพศ</strong><br>
          การตรวจสุขภาพนักเรียนรายบุคคล<br>
          <br></td>
        <td width="149" align="center" valign="middle"><?php  if($recordCK['pic']!=""){?><img src="<?php echo $recordCK['pic'];?>" width="75" height="80" border="1"><?php  } ?></td>
        </tr>
          <form name="form1" action="?option=health&&task=report_all_type_personal2" method="post" enctype="multipart/form-data">
      <tr>
        <td colspan="3" align="center">ปีการศึกษา :  <?php
         	$year="SELECT DISTINCT study_year FROM health_base order by base_id desc";
		   		$resultyear=mysql_query($year); 
		?>
        <select name="year_in" class="colortext">
        <?php
			  if($year_bs !=""){ 
				  echo"<option value='$year_bs'>$year_bs</option>";
				  }
				  $numb=1; 
				  while($rowsyear=mysql_fetch_array($resultyear)){		  
		?>
        <option value="<?php echo $rowsyear['study_year'];?>"><?php echo $rowsyear['study_year'];?></option>
        <?php 
		$numb++;
				  }
		?>
        </select>
        
        &nbsp;&nbsp;         <input type="hidden" name="tm" value="<?php echo $tm;?>">
          <input type="hidden" name="ck" value="<?php echo $ck;?>">
          <input type="hidden" name="class_code" value="<?php echo $class_code;?>">
          <input type="hidden" name="student_id" value="<?php echo $student_id;?>">
          <input type="hidden" name="room" value="<?php echo $room;?>">
          <input type="submit" name="submitS"  value="แสดงรายงาน"   /></td>
        <td align="center" rowspan="3"> <a href='?option=health&task=report_all_type_room2&class_code=<?php echo $class_code;?>&room=<?php echo $room;?>&year_in=<?php echo $year_bs;?>&ck=<?php echo $ck;?>&tm=<?php echo $tm;?>'><img src='modules/health/iconH/bk.gif' border="0" title="ย้อนกลับ"></a></td>
      </tr>
      </form>
      <tr>
        <td align="left">ปีการศึกษา :
          <?php echo $year_bs;?></td>
        <td width="281" align="left">ระดับชั้น :  <?php echo $recordCKC['class_name'];?><?php   if($recordCK['room']!=0){ ?>/<?php echo $recordCK['room'];?><?php  } ?></td>
        <td align="left">&nbsp;</td>
      </tr>
      <tr>
        <td width="226" align="left">รหัสนักเรียน :  <?php echo $student_id;?></td>
        <td align="left">ชื่อ-สกุล :&nbsp;
          <?php echo $recordCK['prename'].$recordCK['name'];?>
  &nbsp;&nbsp;
  <?php echo $recordCK['surname'];?></td>
        <td width="362" align="left">เลขที่ :
          <?php echo $recordCK['student_number'];?></td>
        </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td  valign="top"  height="260"><table width="1200" border="1" cellspacing="0" cellpadding="0">
      <tr bgcolor="#76CEEB">
        <td width="3%" rowspan="2" align="center" valign="middle">ลำดับ</td>
        <td width="6%" rowspan="2" align="center" valign="middle">ปีการศึกษา</td>
        <td width="5%" rowspan="2" align="center" valign="middle">ภาคเรียน</td>
        <td width="6%" rowspan="2" align="center" valign="middle">ครั้งที่ตรวจ</td>
        <td colspan="13" align="center" valign="middle">ผลการตรวจสุขภาพนักเรียนรายบุคคล</td>
        </tr>
      <tr>
        <td width="4%" align="center" valign="middle" bgcolor="#76CEEB">น้ำหนัก<br>
          (ก.ก.)</td>
        <td width="4%" align="center" valign="middle" bgcolor="#76CEEB">ส่วนสูง<br>
          (ซม.)</td>
        <td width="9%" align="center" valign="middle" bgcolor="#76CEEB">เทียบเกณฑ์<br>
          มาตรฐาน</td>
        <td width="6%" align="center" valign="middle" bgcolor="#76CEEB">เหงือก</td>
        <td width="4%" align="center" valign="middle" bgcolor="#76CEEB">ฟัน</td>
        <td width="6%" align="center" valign="middle" bgcolor="#76CEEB">ไอโอดีน</td>
        <td width="6%" align="center" valign="middle" bgcolor="#76CEEB">ชีพจร<br>
          ขณะพัก<br>
          (ครั้ง/นาที)</td>
        <td width="5%" align="center" valign="middle" bgcolor="#76CEEB">ดันพื้น<br>
          30 วินาที<br>
          (ครั้ง)</td>
        <td width="6%" align="center" valign="middle" bgcolor="#76CEEB">ลุกนั่ง<br>
          1 นาที<br>
          (ครั้ง/นาที)</td>
        <td width="6%" align="center" valign="middle" bgcolor="#76CEEB">นั่งงอตัว<br>
          ไปข้างหน้า<br>
          (ซม.)</td>
        <td width="4%" align="center" valign="middle" bgcolor="#76CEEB">วิ่ง 1200<br>
          เมตร<br>
          (นาที)</td>
        <td width="7%" align="center" valign="middle" bgcolor="#76CEEB">วันเวลา<br>
          ที่ตรวจ</td>
        <td width="13%" align="center" valign="middle" bgcolor="#76CEEB">หมายเหตุ</td>
      </tr>
      <?php 
	 			$bg = "";
				$c1="#E9FEF0";
			 	$c2="#FDFEE2";				
				$cx="#F3FB9B";
				//..............................................................................
				if($bg==$c1){
				$bg=$c2;
				}else{
				$bg=$c1;
				}
	  ?>
      <!--- start check 1 term 1-->
        <?php
				$sqlshow="SELECT* FROM health_checking WHERE student_id='$student_id'&&year_std='$year_bs'&&term_std='1'&&number_check='1'";
		  		$resultshow=mysql_query($sqlshow); 
				$checkshow=mysql_num_rows($resultshow);
				$recordshow=mysql_fetch_array($resultshow);
		
				$weight=$recordshow['weight']; /*น้ำหนัก*/
				$tall=$recordshow['tall']; /*ส่วนสูง*/
				
						$sqlsex="SELECT  * FROM student_main  WHERE student_id='$recordshow[student_id]'  AND status='0'";
						$resultsex=mysql_query($sqlsex); 
						$recordsex=mysql_fetch_array($resultsex); 				
								
				$sum_sex1=0; $sum_sex2=0; $sum_sex_low1=0; $sum_sex_over1=0;  $valsum1="";/* คืนค่าเป็น 0*/
				/* คำนวณหาน้ำหนักตามเกณฑ์มาตรฐาน*/
				if($recordsex['sex']==1){
					$sum_sex1 = $tall - 100; 
							$sum_sex_low1 = $sum_sex1 - 5;
							$sum_sex_over1 = $sum_sex1 + 5;
								if($weight < $sum_sex_low1){
									$action_show="ผอม";
									$valsum1 = $sum_sex_low1;
									}else if($weight > $sum_sex_over1){
										$action_show="อ้วน";
										$valsum1 = $sum_sex_over1;
										}else{
											$action_show="ปกติ";
											$valsum1 = $sum_sex1;
											}
					}else if($recordsex['sex']==2){
						$sum_sex2=$tall - 110; 
							$sum_sex_low2 = $sum_sex2 - 5;
							$sum_sex_over2 = $sum_sex2 + 5;
									if($weight < $sum_sex_low2){
										$action_show="ผอม";
										$valsum1 = $sum_sex_low2;
										}else if($weight > $sum_sex_over2){
											$action_show="อ้วน";
											$valsum1 = $sum_sex_over2;
											}else{
												 $action_show="ปกติ";
												 $valsum1 = $sum_sex2;
												}
						}else{
							 $action_show="ไม่ทราบผล";
							  $valsum1 = "<font color='#FF9900'>* ไม่ได้ระบุเพศ</font>";
							}
						
			  ?>
      <tr valign="middle"   onmouseover="this.className='menu-over'" onMouseOut="this.className='menu'" class="menu" bgcolor="<?php  if($tm==1&&$ck==1){ echo"$cx";}else{ echo"$c1";} ?>" >
        <td  align="center">1</td>
        <td align="center"><?php echo $year_bs;?></td>
        <td align="center">1</td>
        <td align="center">1</td>
        <td align="center"><?php  if($recordshow['weight']==""){echo"-";}else{ echo $recordshow['weight']; }?></td>
        <td align="center"><?php  if($recordshow['tall']==""){echo"-";}else{ echo $recordshow['tall']; }?></td>
        <td align="center"><?php  if($recordshow['weight']=="" || $recordshow['tall']==""){echo"-";}else{ echo"$valsum1<br>$action_show"; }?></td>
        <td align="center"><?php  if($recordshow['gum']==""){echo"-";}else{ echo $recordshow['gum']; }?></td>
        <td align="center"><?php  if($recordshow['tooth']==""){echo"-";}else{ echo $recordshow['tooth']; }?></td>
        <td align="center"><?php  if($recordshow['iodine']==""){echo"-";}else{ echo $recordshow['iodine']; }?></td>
        <td align="center"><?php  if($recordshow['life']==""){echo"-";}else{ echo $recordshow['life']; }?></td>
        <td align="center"><?php  if($recordshow['push']==""){echo"-";}else{ echo $recordshow['push']; }?></td>
        <td align="center"><?php  if($recordshow['sit']==""){echo"-";}else{ echo $recordshow['sit']; }?></td>
        <td align="center"><?php  if($recordshow['roll']==""){echo"-";}else{ echo $recordshow['roll']; }?></td>
        <td align="center"><?php  if($recordshow['run']==""){echo"-";}else{ echo $recordshow['run']; }?></td>
        <td align="center"><?php  if($recordshow['day']==""){echo"-";}else{ echo $recordshow['day']; }?></td>
        <td align="center"><?php  if($recordshow['comment']==""){ if($recordshow['weight']=="" && $recordshow['tall']==""){echo"ยังไม่ตรวจ";}else{echo"-";}}else{ echo $recordshow['comment']; }?></td>
      </tr>
<!-- end check 1 term 1 -->

   <!--- start check 2 term 1-->
        <?php
				$sqlshow2="SELECT* FROM health_checking WHERE student_id='$student_id'&&year_std='$year_bs'&&term_std='1'&&number_check='2'";
		  		$resultshow2=mysql_query($sqlshow2); 
				$checkshow2=mysql_num_rows($resultshow2);
				$recordshow2=mysql_fetch_array($resultshow2);
			
				$weight2=$recordshow2['weight']; /*น้ำหนัก*/
				$tall2=$recordshow2['tall']; /*ส่วนสูง*/
								
						$sqlsex2="SELECT  * FROM student_main  WHERE student_id='$recordshow2[student_id]'  AND status='0'";
						$resultsex2=mysql_query($sqlsex2); 
						$recordsex2=mysql_fetch_array($resultsex2); 				
								
				$sum_sex1_k2=0; $sum_sex2_k2=0; $sum_sex_low1_k2=0; $sum_sex_over1_k2=0; $valsum2 ="";  /* คืนค่าเป็น 0*/
				/* คำนวณหาน้ำหนักตามเกณฑ์มาตรฐาน*/
				if($recordsex2['sex']==1){
					$sum_sex1_k2 = $tall2 - 100; 
							$sum_sex_low1_k2 = $sum_sex1_k2 - 5;
							$sum_sex_over1_k2 = $sum_sex1_k2 + 5;
								if($weight2 < $sum_sex_low1_k2){
									$action_show2="ผอม";
									$valsum2 = $sum_sex_low1_k2;
									}else if($weight2 > $sum_sex_over1_k2){
										$action_show2="อ้วน";
										$valsum2 = $sum_sex_over1_k2;
										}else{
											$action_show2="ปกติ";
											$valsum2 = $sum_sex1_k2;
											}
					}else if($recordsex2['sex']==2){
						$sum_sex2_k2=$tall2 - 110; 
							$sum_sex_low2_k2 = $sum_sex2_k2 - 5;
							$sum_sex_over2_k2 = $sum_sex2_k2 + 5;
									if($weight2 < $sum_sex_low2_k2){
										$action_show2="ผอม";
										$valsum2 = $sum_sex_low2_k2;
										}else if($weight2 > $sum_sex_over2_k2){
											$action_show2="อ้วน";
											$valsum2 = $sum_sex_over2_k2;
											}else{
												 $action_show2="ปกติ";
												 $valsum2 = $sum_sex2_k2;
												}
						}else{
							 $action_show2="ไม่ทราบผล";
							   $valsum2 = "<font color='#FF9900'>* ไม่ได้ระบุเพศ</font>";
							}

			  ?>
      <tr valign="middle" bgcolor="<?php  if($tm==1&&$ck==2){ echo"$cx";}else{ echo"$c2";} ?>"  onmouseover="this.className='menu-over'" onMouseOut="this.className='menu'" class="menu">
        <td  align="center">2</td>
        <td align="center"><?php echo $year_bs;?></td>
        <td align="center">1</td>
        <td align="center">2</td>
        <td align="center"><?php  if($recordshow2['weight']==""){echo"-";}else{ echo $recordshow2['weight']; }?></td>
        <td align="center"><?php  if($recordshow2['tall']==""){echo"-";}else{ echo $recordshow2['tall']; }?></td>
        <td align="center"><?php  if($recordshow2['weight']=="" || $recordshow2['tall']==""){echo"-";}else{ echo"$valsum2<br>$action_show2"; }?></td>
        <td align="center"><?php  if($recordshow2['gum']==""){echo"-";}else{ echo $recordshow2['gum']; }?></td>
        <td align="center"><?php  if($recordshow2['tooth']==""){echo"-";}else{ echo $recordshow2['tooth']; }?></td>
        <td align="center"><?php  if($recordshow2['iodine']==""){echo"-";}else{ echo $recordshow2['iodine']; }?></td>
        <td align="center"><?php  if($recordshow2['life']==""){echo"-";}else{ echo $recordshow2['life']; }?></td>
        <td align="center"><?php  if($recordshow2['push']==""){echo"-";}else{ echo $recordshow2['push']; }?></td>
        <td align="center"><?php  if($recordshow2['sit']==""){echo"-";}else{ echo $recordshow2['sit']; }?></td>
        <td align="center"><?php  if($recordshow2['roll']==""){echo"-";}else{ echo $recordshow2['roll']; }?></td>
        <td align="center"><?php  if($recordshow2['run']==""){echo"-";}else{ echo $recordshow2['run']; }?></td>
        <td align="center"><?php  if($recordshow2['day']==""){echo"-";}else{ echo $recordshow2['day']; }?></td>
        <td align="center"><?php  if($recordshow2['comment']==""){ if($recordshow2['weight']=="" && $recordshow2['tall']==""){echo"ยังไม่ตรวจ";}else{echo"-";}}else{ echo $recordshow2['comment']; }?></td>
      </tr>
<!-- end check 2 term 1 -->
  <!--- start check 1 term 2-->
        <?php
				$sqlshow3="SELECT* FROM health_checking WHERE student_id='$student_id'&&year_std='$year_bs'&&term_std='2'&&number_check='1'";
		  		$resultshow3=mysql_query($sqlshow3); 
				$checkshow3=mysql_num_rows($resultshow3);
				$recordshow3=mysql_fetch_array($resultshow3);
				$weight3=$recordshow3['weight']; /*น้ำหนัก*/
				$tall3=$recordshow3['tall']; /*ส่วนสูง*/
						
						$sqlsex3="SELECT  * FROM student_main  WHERE student_id='$recordshow3[student_id]'  AND status='0'";
						$resultsex3=mysql_query($sqlsex3); 
						$recordsex3=mysql_fetch_array($resultsex3); 				
								
				$sum_sex1_k3=0; $sum_sex2_k3=0; $sum_sex_low1_k3=0; $sum_sex_over1_k3=0; $valsum3 ="";  /* คืนค่าเป็น 0*/
				/* คำนวณหาน้ำหนักตามเกณฑ์มาตรฐาน*/
				if($recordsex3['sex']==1){
					$sum_sex1_k3 = $tall3 - 100; 
							$sum_sex_low1_k3 = $sum_sex1_k3 - 5;
							$sum_sex_over1_k3 = $sum_sex1_k3 + 5;
								if($weight3 < $sum_sex_low1_k3){
									$action_show3="ผอม";
										 $valsum3 = $sum_sex_low1_k3;
									}else if($weight3 > $sum_sex_over1_k3){
										$action_show3="อ้วน";
										 $valsum3 = $sum_sex_over1_k3;
										}else{
											$action_show3="ปกติ";
											 $valsum3 = $sum_sex1_k3;
											}
					}else if($recordsex3['sex']==2){
						$sum_sex2_k3=$tall3 - 110; 
							$sum_sex_low2_k3 = $sum_sex2_k3 - 5;
							$sum_sex_over2_k3 = $sum_sex2_k3 + 5;
									if($weight3 < $sum_sex_low2_k3){
										$action_show3="ผอม";
										 $valsum3 = $sum_sex_low2_k3;
										}else if($weight3 > $sum_sex_over2_k3){
											$action_show3="อ้วน";
											 $valsum3 = $sum_sex_over2_k3;
											}else{
												 $action_show3="ปกติ";
												  $valsum3 = $sum_sex2_k3;
												}
						}else{
							 $action_show3="ไม่ทราบผล";
							   $valsum3 = "<font color='#FF9900'>* ไม่ได้ระบุเพศ</font>";
							}	

			  ?>
      <tr valign="middle" bgcolor="<?php  if($tm==2&&$ck==1){ echo"$cx";}else{ echo"$c1";} ?>"  onmouseover="this.className='menu-over'" onMouseOut="this.className='menu'" class="menu">
        <td  align="center">3</td>
        <td align="center"><?php echo $year_bs;?></td>
        <td align="center">2</td>
        <td align="center">1</td>
        <td align="center"><?php  if($recordshow3['weight']==""){echo"-";}else{ echo $recordshow3['weight']; }?></td>
        <td align="center"><?php  if($recordshow3['tall']==""){echo"-";}else{ echo $recordshow3['tall']; }?></td>
        <td align="center"><?php  if($recordshow3['weight']=="" || $recordshow3['tall']==""){echo"-";}else{ echo"$valsum3<br>$action_show3"; }?></td>
        <td align="center"><?php  if($recordshow3['gum']==""){echo"-";}else{ echo $recordshow3['gum']; }?></td>
        <td align="center"><?php  if($recordshow3['tooth']==""){echo"-";}else{ echo $recordshow3['tooth']; }?></td>
        <td align="center"><?php  if($recordshow3['iodine']==""){echo"-";}else{ echo $recordshow3['iodine']; }?></td>
        <td align="center"><?php  if($recordshow3['life']==""){echo"-";}else{ echo $recordshow3['life']; }?></td>
        <td align="center"><?php  if($recordshow3['push']==""){echo"-";}else{ echo $recordshow3['push']; }?></td>
        <td align="center"><?php  if($recordshow3['sit']==""){echo"-";}else{ echo $recordshow3['sit']; }?></td>
        <td align="center"><?php  if($recordshow3['roll']==""){echo"-";}else{ echo $recordshow3['roll']; }?></td>
        <td align="center"><?php  if($recordshow3['run']==""){echo"-";}else{ echo $recordshow3['run']; }?></td>
        <td align="center"><?php  if($recordshow3['day']==""){echo"-";}else{ echo $recordshow3['day']; }?></td>
        <td align="center"><?php  if($recordshow3['comment']==""){ if($recordshow3['weight']=="" && $recordshow3['tall']==""){echo"ยังไม่ตรวจ";}else{echo"-";}}else{ echo $recordshow3['comment']; }?></td>
      </tr>
<!-- end check 1 term 2 -->
      <!--- start check 2 term 2-->
        <?php
				$sqlshow4="SELECT* FROM health_checking WHERE student_id='$student_id'&&year_std='$year_bs'&&term_std='2'&&number_check='2'";
		  		$resultshow4=mysql_query($sqlshow4); 
				$checkshow4=mysql_num_rows($resultshow4);
				$recordshow4=mysql_fetch_array($resultshow4);
				
				$weight4=$recordshow4['weight']; /*น้ำหนัก*/
				$tall4=$recordshow4['tall']; /*ส่วนสูง*/
				
						$sqlsex4="SELECT  * FROM student_main  WHERE student_id='$recordshow4[student_id]'  AND status='0'";
						$resultsex4=mysql_query($sqlsex4); 
						$recordsex4=mysql_fetch_array($resultsex4); 				
								
				$sum_sex1_k4=0; $sum_sex2_k4=0; $sum_sex_low1_k4=0; $sum_sex_over1_k4=0; $valsum4 =""; /* คืนค่าเป็น 0*/
				/* คำนวณหาน้ำหนักตามเกณฑ์มาตรฐาน*/
				if($recordsex4['sex']==1){
					$sum_sex1_k4 = $tall4 - 100; 
							$sum_sex_low1_k4 = $sum_sex1_k4 - 5;
							$sum_sex_over1_k4 = $sum_sex1_k4 + 5;
								if($weight4 < $sum_sex_low1_k4){
									$action_show4="ผอม";
									  $valsum4 = $sum_sex_low1_k4;
									}else if($weight4 > $sum_sex_over1_k4){
										$action_show4="อ้วน";
										$valsum4 = $sum_sex_over1_k4;
										}else{
											$action_show4="ปกติ";
											$valsum4 = $sum_sex1_k4;
											}
					}else if($recordsex4['sex']==2){
						$sum_sex2_k4=$tall4 - 110; 
							$sum_sex_low2_k4 = $sum_sex2_k4 - 5;
							$sum_sex_over2_k4 = $sum_sex2_k4 + 5;
									if($weight4 < $sum_sex_low2_k4){
										$action_show4="ผอม";
										$valsum4 = $sum_sex_low2_k4;
										}else if($weight4 > $sum_sex_over2_k4){
											$action_show4="อ้วน";
											$valsum4 = $sum_sex_over2_k4;
											}else{
												 $action_show4="ปกติ";
												 $valsum4 = $sum_sex2_k4;
												}
						}else{
							 $action_show4="ไม่ทราบผล";
							   $valsum4 = "<font color='#FF9900'>* ไม่ได้ระบุเพศ</font>";
							}

			  ?>
      <tr valign="middle" bgcolor="<?php  if($tm==2&&$ck==2){ echo"$cx";}else{ echo"$c2";} ?>"  onmouseover="this.className='menu-over'" onMouseOut="this.className='menu'" class="menu">
        <td  align="center">4</td>
        <td align="center"><?php echo $year_bs;?></td>
        <td align="center">2</td>
        <td align="center">2</td>
        <td align="center"><?php  if($recordshow4['weight']==""){echo"-";}else{ echo $recordshow4['weight']; }?></td>
        <td align="center"><?php  if($recordshow4['tall']==""){echo"-";}else{ echo $recordshow4['tall']; }?></td>
        <td align="center"><?php  if($recordshow4['weight']=="" || $recordshow4['tall']==""){echo"-";}else{ echo"$valsum4<br>$action_show4"; }?></td>
        <td align="center"><?php  if($recordshow4['gum']==""){echo"-";}else{ echo $recordshow4['gum']; }?></td>
        <td align="center"><?php  if($recordshow4['tooth']==""){echo"-";}else{ echo $recordshow4['tooth']; }?></td>
        <td align="center"><?php  if($recordshow4['iodine']==""){echo"-";}else{ echo $recordshow4['iodine']; }?></td>
        <td align="center"><?php  if($recordshow4['life']==""){echo"-";}else{ echo $recordshow4['life']; }?></td>
        <td align="center"><?php  if($recordshow4['push']==""){echo"-";}else{ echo $recordshow4['push']; }?></td>
        <td align="center"><?php  if($recordshow4['sit']==""){echo"-";}else{ echo $recordshow4['sit']; }?></td>
        <td align="center"><?php  if($recordshow4['roll']==""){echo"-";}else{ echo $recordshow4['roll']; }?></td>
        <td align="center"><?php  if($recordshow4['run']==""){echo"-";}else{ echo $recordshow4['run']; }?></td>
        <td align="center"><?php  if($recordshow4['day']==""){echo"-";}else{ echo $recordshow4['day']; }?></td>
        <td align="center"><?php  if($recordshow4['comment']==""){ if($recordshow4['weight']=="" && $recordshow4['tall']==""){echo"ยังไม่ตรวจ";}else{echo"-";}}else{ echo $recordshow4['comment']; }?></td>
      </tr>
<!-- end check 2 term 2 -->
    </table>
</td>
						</tr>
	  </table>
    

    </td>
  </tr>
</table>
</body>

</html>
