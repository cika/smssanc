<?php 
 include "./modules/health/tab.php";
 
 						 $check_room_sdT = 0;
						 $check_room_sd = 0; /*จำนวน นร.*/
						 $checkslwT = 0;
						  $checkslw = 0;  /*ตรวจแล้ว*/
						 $total_nocheckT = 0;
						  $total_nocheck = 0;  /*ยังไม่ได้ตรวจ*/
			 			$sum_lowT = 0;
						$sum_low = 0;   /* ต่ำ */
						$sum_norT = 0;
						$sum_nor = 0; /* ปกติ */
						$sum_overT = 0;
						$sum_over = 0; /* สูง */
						$sum_gum_goodT = 0;
						$sum_gum_good = 0;  /* เหงือกดี */
						$sum_gum_noT = 0;
						$sum_gum_no = 0;  /* เหงือกไม่ดี */
						$sum_tooth_goodT = 0;
						$sum_tooth_good = 0; /* ฟันดี */
						$sum_tooth_noT = 0;
						$sum_tooth_no = 0;   /* ฟันไม่ดี */
						$sum_iodine_goodT = 0;
						$sum_iodine_good = 0;   /* ไอโอดีนดี */
						$sum_iodine_noT = 0;
						$sum_iodine_no = 0;  /* ไอโอดีนไม่ดี */
						$sum_percen_goodT = 0;
						 $sum_percen_good = 0;   /* % ดี */
						$sum_percen_noT = 0; 
						$sum_percen_no = 0;   /* %ไม่ ดี */
						$tosT = 0;
						$tos = 0;  /*ผลรวมของ %ดี และ%ไม่ดี*/
						$gum_good = 0 ;
						
						$sum_default = 0;
						$total_sum_gum_no = 0;
						$sum_gum_no = 0;
						$total_sum_gum_good = 0;$sum_gum_good = 0;
						$total_sum_tooth_good = 0;$sum_tooth_good = 0;
						$total_sum_tooth_no = 0;$sum_tooth_no = 0;
						$total_sum_iodine_good = 0;$sum_iodine_good = 0;
						$total_sum_iodine_no = 0;$sum_iodine_no = 0;
						$total_sum_low = 0;
						$verygood  = 0;
						$notverygood  = 0;
			 /*******************************/
			 			$sum_low = 0;    /* ต่ำ */
						$sum_nor = 0;  /* ปกติ */
						$sum_over = 0;  /* สูง */
						$sum_gum_good = 0;  /* เหงือกดี */
						$sum_gum_no = 0;   /* เหงือกไม่ดี */
						$sum_tooth_good = 0;  /* ฟันดี */
						$sum_tooth_no = 0;   /* ฟันไม่ดี */
						$sum_iodine_good = 0;   /* ไอโอดีนดี */
						$sum_iodine_no = 0;  /* ไอโอดีนไม่ดี */
						$sumtotal = 0;   /* % ดี */
						$sumtotal_no =0 ;    /* %ไม่ ดี */
						
						$t_low = 0;
						$t_over = 0;
						$t_gum = 0;
						$t_tooth = 0;
						$t_iodine = 0;
						$tno_nor = 0;
						$tno_gum = 0;
						$tno_tooth = 0;
						$tno_iodine = 0;
				
				$sqlbs="SELECT* FROM health_base   WHERE status='1'";
				$resultbs=mysql_query($sqlbs); 
				$rowbs=mysql_fetch_array($resultbs);		
				$term_bs=$rowbs['term']; //term
			
		if(isset($_REQUEST['year_in'])){
					$year_in=$_REQUEST['year_in'];
					$year_bs = $year_in;
					$ck="";
					$tm="";
				}else{
					$year_bs=$rowbs['study_year']; //ปีการศึกษา
					$ck="";
					$tm="";
					}
				
		if(isset($_REQUEST['ck']) && isset($_REQUEST['tm'])){
			$ck=$_REQUEST['ck'];
			$tm=$_REQUEST['tm'];
		}else{
				$ck="1";
				$tm="1";	
		}

				$dy= date('d');  //สำหรับแสดงที่หน้า page
				$my= date('m');  //สำหรับแสดงที่หน้า page
				$tt= date('Y');  //สำหรับแสดงที่หน้า page
				$yr=$tt+543; //สำหรับแสดงที่หน้า page
				
	 //สำหรับแสดงที่หน้า page		 
    if($my=="01"){
		$date_show="มกราคม";
		}else if($my=="02"){
			$date_show="กุมภาพันธ์";
			}else if($my=="03"){
			$date_show="มีนาคม";
			}else if($my=="04"){
			$date_show="เมษายน";
			}else if($my=="05"){
			$date_show="พฤษภาคม";
			}else if($my=="06"){
			$date_show="มิถุนายน";
			}else if($my=="07"){
			$date_show="กรกฎาคม";
			}else if($my=="08"){
			$date_show="สิงหาคม";
			}else if($my=="09"){
			$date_show="กันยายน";
			}else if($my=="10"){
			$date_show="ตุลาคม";
			}else if($my=="11"){
			$date_show="พฤศจิกายน";
			}else if($my=="12"){
				$date_show="ธันวาคม";
			}else{}
	?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel='stylesheet' href='modules/health/config_color.css'>
<title>สุขภาพนักเรียน</title>
<style>
.menu{background-color:; }
.menu-over{background-color:#22F942;}
</style>
</head>

<body topmargin="0" bgcolor="#F4FFF4">
<br>
<table width="1000" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#99CCFF" bgcolor="#FFFFFF">
<tr>
<td width="880" height="30" bgcolor="#0066FF"><font color="#FFFFFF"><?php echo $t2;?>
  รายงาน : สุขภาพนักเรียนทั้งโรงเรียน</font></td>
</tr>
 
  <tr>
    <td>
	
	<table width="1000" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="118" rowspan="3" align="center" valign="middle"><img src='modules/health/iconH/logospt.jpg' width='80' height='80' border='0'></td>
        <td colspan="2" align="center"><strong>รายงาน แบบ แยกตามเพศ</strong><br>
        สุขภาพนักเรียนทั้งโรงเรียน ปีการศึกษา 
          <?php echo $year_bs;?></td>
        </tr>
         <form name="form1" action="?option=health&&task=report_all2" method="post" enctype="multipart/form-data">
      <tr>
        <td align="right">ปีการศึกษา : 
        <?php
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
        &nbsp;&nbsp;</td>
        <td align="left"><input type="submit" name="submitS"  value="แสดงรายงาน"   /></td>
      </tr>
      </form>
      <tr>
        <td width="438" align="right" valign="top">ภาคเรียนที่ 1 <?php if($ck==1 && $tm==1){ echo"<img src='modules/health/iconH/yes.png' width='15' height='15' border='0'>";}?>[<a href="?option=health&task=report_all2&ck=1&tm=1&year_in=<?php echo $year_bs;?>">ครั้งที่ 1</a>]  <?php if($ck==2 && $tm==1){ echo"<img src='modules/health/iconH/yes.png' width='15' height='15' border='0'>";}?>[<a href="?option=health&task=report_all2&ck=2&tm=1&year_in=<?php echo $year_bs;?>">ครั้งที่ 2</a>]&nbsp;&nbsp;</td>
        <td width="444" align="left" valign="top">&nbsp;&nbsp;ภาคเรียนที่ 2 <?php if($ck==1 && $tm==2){ echo"<img src='modules/health/iconH/yes.png' width='15' height='15' border='0'>";}?>[<a href="?option=health&task=report_all2&ck=1&tm=2&year_in=<?php echo $year_bs;?>">ครั้งที่ 1</a>]  <?php if($ck==2 && $tm==2){ echo"<img src='modules/health/iconH/yes.png' width='15' height='15' border='0'>";}?>[<a href="?option=health&task=report_all2&ck=2&tm=2&year_in=<?php echo $year_bs;?>">ครั้งที่ 2</a>]</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="260"  valign="top">
	<table width="1000" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td rowspan="2" align="center" valign="middle" bgcolor="#76CEEB">ระดับชั้น</td>
        <td width="56" rowspan="2" align="center" valign="middle" bgcolor="#76CEEB">จำนวน<br> 
          นักเรียน         </td>
        <td width="64" rowspan="2" align="center" valign="middle" bgcolor="#76CEEB">ตรวจแล้ว</td>
        <td width="70" rowspan="2" align="center" valign="middle" bgcolor="#76CEEB">ยังไม่ตรวจ</td>
        <td colspan="3" align="center" valign="middle" bgcolor="#76CEEB">เทียบเกณฑ์มาตรฐาน<br>
          น้ำหนักกับส่วนสูง</td>
        <td colspan="2" align="center" valign="middle" bgcolor="#76CEEB">สุขภาพฟัน</td>
        <td colspan="2" align="center" valign="middle" bgcolor="#76CEEB">สุขภาพเหงือก</td>
        <td colspan="2" align="center" valign="middle" bgcolor="#76CEEB">ไอโอดีน</td>
        <td colspan="2" align="center" valign="middle" bgcolor="#76CEEB">โดยเฉลี่ยร้อยละ</td>
        <td width="86" rowspan="2" align="center" valign="middle" bgcolor="#76CEEB">รายละเอียด</td>
      </tr>
      <tr>
        <td width="52" align="center" valign="middle" bgcolor="#76CEEB">ผอม</td>
        <td width="52" align="center" valign="middle" bgcolor="#76CEEB">ปกติ</td>
        <td width="51" align="center" valign="middle" bgcolor="#76CEEB">อ้วน</td>
        <td width="38" align="center" valign="middle" bgcolor="#76CEEB">ผุ</td>
        <td width="38" align="center" valign="middle" bgcolor="#76CEEB">ไม่ผุ</td>
        <td width="44" align="center" valign="middle" bgcolor="#76CEEB">ดี</td>
        <td width="44" align="center" valign="middle" bgcolor="#76CEEB">ไม่ดี</td>
        <td width="50" align="center" valign="middle" bgcolor="#76CEEB">ปกติ</td>
        <td width="50" align="center" valign="middle" bgcolor="#76CEEB">ผิดปกติ</td>
        <td width="62" align="center" valign="middle" bgcolor="#76CEEB">สุขภาพดี</td>
        <td width="76" align="center" valign="middle" bgcolor="#76CEEB">สุขภาพไม่ดี</td>
      </tr>
      <?php 
						$sqlCK="SELECT* FROM student_main_class";
						$resultCK=mysql_query($sqlCK); 
						$check_room=mysql_num_rows($resultCK);
					  $num=1;
					  $bg="";
				while($recordCK=mysql_fetch_array($resultCK))
					{	
				$class_code=$recordCK['class_code'];
				$class_name=$recordCK['class_name'];
	
				//............................................................................
				$c1="#DDF4F9";
			 	$c2="#EEFCCF";
				//..............................................................................
				if($bg==$c1){
				$bg=$c2;
				}else{
				$bg=$c1;
				}      
				?>
				<?php
      			 	$sqlSM="SELECT DISTINCT room FROM student_main  WHERE class_now='$class_code'";
						$resultSM=mysql_query($sqlSM); 
						$check_room_SM=mysql_num_rows($resultSM);
					
						if($check_room_SM!=0 && $check_room_SM!=1){
						$lp=0;			
						while($recordSM=mysql_fetch_array($resultSM))
					{	
					$room=$recordSM['room'];
					
					 	$sqlsd="SELECT  * FROM student_main  WHERE class_now='$class_code'AND room='$room'  AND status='0'";
						$resultsd=mysql_query($sqlsd); 
						$check_room_sd=mysql_num_rows($resultsd);
                         ?>
                           <?php
        $sqlslw="SELECT* FROM health_checking WHERE room='$recordSM[room]'&&class_now='$class_code'&&year_std='$year_bs'&&number_check='$ck'&&term_std='$tm'";
		$resultslw=mysql_query($sqlslw); 
		$checkslw=mysql_num_rows($resultslw);
					
						$sum_low=0;
						$sum_nor=0;
						$sum_over=0;
						$sum_gum_good=0;
						$sum_gum_no=0;
						$sum_tooth_good=0;
						$sum_tooth_no=0;
						$sum_iodine_good=0;
						$sum_iodine_no=0;
					
				 $slw=1;		 						
					while($recordslw=mysql_fetch_array($resultslw))
	{	
			 			$sqlsex="SELECT  * FROM student_main  WHERE student_id='$recordslw[student_id]'";
						$resultsex=mysql_query($sqlsex); 
						$recordsex=mysql_fetch_array($resultsex);
						
				$weight=$recordslw['weight']; /*น้ำหนัก*/
				$tall=$recordslw['tall']; /*ส่วนสูง*/
		
				$sum_sex1=0; $sum_sex2=0; $sum_sex_low1=0; $sum_sex_over1=0;  /* คืนค่าเป็น 0*/
				/* คำนวณหาน้ำหนักตามเกณฑ์มาตรฐาน*/
				if($recordsex['sex']==1){
					$sum_sex1 = $tall - 100; 
							$sum_sex_low1 = $sum_sex1 - 5;
							$sum_sex_over1 = $sum_sex1 + 5;
								if($weight < $sum_sex_low1){
									$sum_low = $sum_low + 1;
									$total_sum_low=$total_sum_low+$sum_low;
									}else if($weight > $sum_sex_over1){
										$sum_over=$sum_over+1;
										$total_sum_over=$total_sum_over+$sum_over;
										}else{
											 $sum_nor=$sum_nor+1;
											 $total_sum_nor=$total_sum_nor+$sum_nor;
											}
					}else if($recordsex['sex']==2){
						$sum_sex2=$tall - 110; 
							$sum_sex_low2 = $sum_sex2 - 5;
							$sum_sex_over2 = $sum_sex2 + 5;
									if($weight < $sum_sex_low2){
										$sum_low = $sum_low + 1;
										$total_sum_low=$total_sum_low+$sum_low;
										}else if($weight > $sum_sex_over2){
											$sum_over=$sum_over+1;
											$total_sum_over=$total_sum_over+$sum_over;
											}else{
											 $sum_nor=$sum_nor+1;
											 $total_sum_nor=$total_sum_nor+$sum_nor;
												}
						}else{
							$sum_default = $sum_default + 1; /*ไม่ทราบผล*/
							}
			
				/* เหงือก*/
					if($recordslw['gum']!=""){
						if($recordslw['gum']=="ไม่มี"){
					$sum_gum_good=$sum_gum_good+1;	
					$total_sum_gum_good=$total_sum_gum_good+$sum_gum_good;
					}else{
					$sum_gum_no=$sum_gum_no+1;	
					$total_sum_gum_no=$total_sum_gum_no+$sum_gum_no;
							}
					}
					/*ฟัน*/
						if($recordslw['tooth']!=""){
						if($recordslw['tooth']=="ไม่ผุ"){
					$sum_tooth_good=$sum_tooth_good+1;	
					$total_sum_tooth_good=$total_sum_tooth_good+$sum_tooth_good;
					}else{
					$sum_tooth_no=$sum_tooth_no+1;	
					$total_sum_tooth_no=$total_sum_tooth_no+$sum_tooth_no;
							}
					}
					/*ไอโอดีน*/
						if($recordslw['iodine']!=""){
						if($recordslw['iodine']=="ปกติ"){
					$sum_iodine_good=$sum_iodine_good+1;	
					$total_sum_iodine_good=$total_sum_iodine_good+$sum_iodine_good;
					}else{
					$sum_iodine_no=$sum_iodine_no+1;	
					$total_sum_iodine_no=$total_sum_iodine_no+$sum_iodine_no;
							}
					}
						$slw++;
						$t_low=(($sum_low*100)/$checkslw);
						$t_over=(($sum_over*100)/$checkslw);
						$t_gum=(($sum_gum_no*100)/$checkslw);
						$t_tooth=(($sum_tooth_no*100)/$checkslw);
						$t_iodine=(($sum_iodine_no*100)/$checkslw);
						
						
						$tno_nor=(($sum_nor*100)/$checkslw);
						$tno_gum=(($gum_good*100)/$checkslw);
						$tno_tooth=(($sum_tooth_good*100)/$checkslw);
						$tno_iodine=(($sum_iodine_good*100)/$checkslw);
						
						$sum_percen_no=(($t_low+$t_over+$t_gum+$t_tooth+$t_iodine)*$checkslw*4)/100;
						$sum_percen_good=(($tno_nor+$tno_gum+$tno_tooth+$tno_iodine)*$checkslw*4)/100;
						
						$tos=$sum_percen_no+$sum_percen_good;
						
						$sumtotal=($sum_percen_good*100)/$tos;
						$sumtotal_no=($sum_percen_no*100)/$tos;
						

			}

		?>
      <tr bgcolor="<?php echo $bg;?>" onMouseOver="this.className='menu-over'" onMouseOut="this.className='menu'" class="menu">
        <td  align="left" valign="middle">
        <?php if($recordSM['room']==0 || $recordSM['room']=="") {?>
        <?php echo"$t1$class_name"; /*มีหลายห้อง แต่ ยังไม่ได้ตรวจสุขภาพ*/ }else{?>  
          <?php echo"$t1$class_name/".$recordSM['room']; /*มีหลายห้อง*/ }?>        </td>
        <td align="center" valign="middle"><?php echo $check_room_sd;?></td>
        <td align="center" valign="middle"><?php echo $checkslw;?></td> 
        <td align="center" valign="middle"><?php $total_nocheck=$check_room_sd-$checkslw; echo"$total_nocheck";?></td>
        <td align="center" valign="middle"><?php echo $sum_low;?></td>
        <td align="center" valign="middle"><?php echo $sum_nor;?></td>
        <td align="center" valign="middle"><?php echo $sum_over;?></td>
        <td align="center" valign="middle"><?php echo $sum_tooth_no;?></td>
        <td align="center" valign="middle"><?php echo $sum_tooth_good;?></td>
        <td align="center" valign="middle"><?php echo $sum_gum_good;?></td>
        <td align="center" valign="middle"><?php echo $sum_gum_no;?></td>
        <td align="center" valign="middle"><?php echo $sum_iodine_good;?></td>
        <td align="center" valign="middle"><?php echo $sum_iodine_no;?></td>
        <td align="center" valign="middle"><?php echo number_format($sumtotal,2,'.',',');?> %</td>
        <td align="center" valign="middle"><?php echo number_format($sumtotal_no,2,'.',',');?> %</td>
        <td align="center" valign="middle">[<a href="?option=health&task=report_all_type_room2&class_code=<?php echo $class_code;?>&room=<?php echo $room;?>&year_in=<?php echo $year_bs;?>&ck=<?php echo $ck;?>&tm=<?php echo $tm;?>">รายละเอียด</a>]</td>
		</tr>
             <?php
			 /*******************************/
			 			 $check_room_sdT = $check_room_sdT + $check_room_sd;  /*จำนวน นร.*/
						 $checkslwT = $checkslwT + $checkslw;  /*ตรวจแล้ว*/
						 $total_nocheckT = $total_nocheckT + $total_nocheck;  /*ยังไม่ได้ตรวจ*/
			 			$sum_lowT = $sum_lowT + $sum_low;    /* ต่ำ */
						$sum_norT = $sum_norT + $sum_nor;  /* ปกติ */
						$sum_overT = $sum_overT + $sum_over;  /* สูง */
						$sum_gum_goodT = $sum_gum_goodT + $sum_gum_good;  /* เหงือกดี */
						$sum_gum_noT = $sum_gum_noT + $sum_gum_no;   /* เหงือกไม่ดี */
						$sum_tooth_goodT = $sum_tooth_goodT + $sum_tooth_good;  /* ฟันดี */
						$sum_tooth_noT = $sum_tooth_noT + $sum_tooth_no;   /* ฟันไม่ดี */
						$sum_iodine_goodT = $sum_iodine_goodT + $sum_iodine_good;   /* ไอโอดีนดี */
						$sum_iodine_noT = $sum_iodine_noT + $sum_iodine_no;  /* ไอโอดีนไม่ดี */
						$sum_percen_goodT = $sum_percen_goodT + $sum_percen_good;   /* % ดี */
						$sum_percen_noT = $sum_percen_noT + $sum_percen_no;    /* %ไม่ ดี */
						$tosT = $tosT + $tos;   /*ผลรวมของ %ดี และ%ไม่ดี*/
			 /*******************************/
			 			$sum_low=0;    /* ต่ำ */
						$sum_nor=0;  /* ปกติ */
						$sum_over=0;  /* สูง */
						$sum_gum_good=0;  /* เหงือกดี */
						$sum_gum_no=0;   /* เหงือกไม่ดี */
						$sum_tooth_good=0;  /* ฟันดี */
						$sum_tooth_no=0;   /* ฟันไม่ดี */
						$sum_iodine_good=0;   /* ไอโอดีนดี */
						$sum_iodine_no=0;  /* ไอโอดีนไม่ดี */
						$sumtotal=0;   /* % ดี */
						$sumtotal_no=0;    /* %ไม่ ดี */
						
						$t_low=0;
						$t_over=0;
						$t_gum=0;
						$t_tooth=0;
						$t_iodine=0;
						$tno_nor=0;
						$tno_gum=0;
						$tno_tooth=0;
						$tno_iodine=0;
				
			 	$lp++;
			 }
						
						}else{ // เช็คเงื่อนไขหาจำนวนนักเรียน
								
						$lp2=0;			
						while($recordSM=mysql_fetch_array($resultSM))
					{	
					//$room=$recordSM['room'];
					 	$sqlsd2="SELECT  * FROM student_main  WHERE class_now='$class_code'  AND status='0'";
						$resultsd2=mysql_query($sqlsd2); 
						$check_room_sd2=mysql_num_rows($resultsd2);
                         ?>
                           <?php
      			$sqlslw2="SELECT* FROM health_checking WHERE class_now='$class_code'&&year_std='$year_bs'&&number_check='$ck'&&term_std='$tm'";  
		  		$resultslw2=mysql_query($sqlslw2); 
				$checkslw2=mysql_num_rows($resultslw2);
						/*	if($checkslw2==0 || $checkslw2=="" || $checkslw2==1)
								{		*/	
						$sum_low=0;
						$sum_nor=0;
						$sum_over=0;
						$sum_gum_good=0;
						$sum_gum_no=0;
						$sum_tooth_good=0;
						$sum_tooth_no=0;
						$sum_iodine_good=0;
						$sum_iodine_no=0;  
							/*}*/
				 $slw2=1;		 						
					while($recordslw2=mysql_fetch_array($resultslw2))
	{	
					 			$sqlsex2="SELECT  * FROM student_main  WHERE student_id='$recordslw2[student_id]'";
								$resultsex2=mysql_query($sqlsex2); 
								$recordsex2=mysql_fetch_array($resultsex2);
								
				$weight=$recordslw2['weight']; /*น้ำหนัก*/
				$tall=$recordslw2['tall']; /*ส่วนสูง*/
				
								$sum_sex1=0; $sum_sex2=0; $sum_sex_low1=0; $sum_sex_over1=0;  /* คืนค่าเป็น 0*/
				/* คำนวณหาน้ำหนักตามเกณฑ์มาตรฐาน*/
				if($recordsex2['sex']==1){
					$sum_sex1 = $tall - 100; 
							$sum_sex_low1 = $sum_sex1 - 5;
							$sum_sex_over1 = $sum_sex1 + 5;
								if($weight < $sum_sex_low1){
									$sum_low = $sum_low + 1;
									$total_sum_low=$total_sum_low+$sum_low;
									}else if($weight > $sum_sex_over1){
										$sum_over=$sum_over+1;
										$total_sum_over=$total_sum_over+$sum_over;
										}else{											
											$sum_nor=$sum_nor+1;
											$total_sum_nor=$total_sum_nor+$sum_nor;											
											}
					}else if($recordsex2['sex']==2){
						$sum_sex2=$tall - 110; 
							$sum_sex_low2 = $sum_sex2 - 5;
							$sum_sex_over2 = $sum_sex2 + 5;
									if($weight < $sum_sex_low2){
										$sum_low = $sum_low + 1;
										$total_sum_low=$total_sum_low+$sum_low;
										}else if($weight > $sum_sex_over2){
											$sum_over=$sum_over+1;
											$total_sum_over=$total_sum_over+$sum_over;
											}else{
											$sum_nor=$sum_nor+1;
											$total_sum_nor=$total_sum_nor+$sum_nor;		
												}
						}else{
							$sum_default = $sum_default + 1; /*ไม่ทราบผล*/
							}
			
				/* เหงือก*/
					if($recordslw2['gum']!=""){
						if($recordslw2['gum']=="ไม่มี"){
					$sum_gum_good=$sum_gum_good+1;	
					$total_sum_gum_good=$total_sum_gum_good+$sum_gum_good;
					}else{
					$sum_gum_no=$sum_gum_no+1;	
					$total_sum_gum_no=$total_sum_gum_no+$sum_gum_no;
							}
					}
					/*ฟัน*/
						if($recordslw2['tooth']!=""){
						if($recordslw2['tooth']=="ไม่ผุ"){
					$sum_tooth_good=$sum_tooth_good+1;	
					$total_sum_tooth_good=$total_sum_tooth_good+$sum_tooth_good;
					}else{
					$sum_tooth_no=$sum_tooth_no+1;	
					$total_sum_tooth_no=$total_sum_tooth_no+$sum_tooth_no;
							}
					}
					/*ไอโอดีน*/
						if($recordslw2['iodine']!=""){
						if($recordslw2['iodine']=="ปกติ"){
					$sum_iodine_good=$sum_iodine_good+1;	
					$total_sum_iodine_good=$total_sum_iodine_good+$sum_iodine_good;
					}else{
					$sum_iodine_no=$sum_iodine_no+1;	
					$total_sum_iodine_no=$total_sum_iodine_no+$sum_iodine_no;
							}
					}
						$slw2++;
						$t_low=(($sum_low*100)/$checkslw2);
						$t_over=(($sum_over*100)/$checkslw2);
						$t_gum=(($sum_gum_no*100)/$checkslw2);
						$t_tooth=(($sum_tooth_no*100)/$checkslw2);
						$t_iodine=(($sum_iodine_no*100)/$checkslw2);
						
						
						$tno_nor=(($sum_nor*100)/$checkslw2);
						$tno_gum=(($gum_good*100)/$checkslw2);
						$tno_tooth=(($sum_tooth_good*100)/$checkslw2);
						$tno_iodine=(($sum_iodine_good*100)/$checkslw2);
						
						$sum_percen_no=(($t_low+$t_over+$t_gum+$t_tooth+$t_iodine)*$checkslw2*4)/100;
						$sum_percen_good=(($tno_nor+$tno_gum+$tno_tooth+$tno_iodine)*$checkslw2*4)/100;
						
						$tos=$sum_percen_no+$sum_percen_good;
						
						$sumtotal=($sum_percen_good*100)/$tos;
						$sumtotal_no=($sum_percen_no*100)/$tos;
	
			}

		?>
      <tr bgcolor="<?php echo $bg;?>"  onmouseover="this.className='menu-over'" onMouseOut="this.className='menu'" class="menu">
        <td  align="left" valign="middle">
          <?php echo"$t1$class_name"; /*มีห้องเดียว*/ ?>        </td>
        <td align="center" valign="middle"><?php echo $check_room_sd2;?></td>
        <td align="center" valign="middle"><?php echo $checkslw2;?></td> 
        <td align="center" valign="middle"><?php $total_nocheck=$check_room_sd2-$checkslw2; echo"$total_nocheck";?></td>
        <td align="center" valign="middle"><?php echo $sum_low;?></td>
        <td align="center" valign="middle"><?php echo $sum_nor;?></td>
        <td align="center" valign="middle"><?php echo $sum_over;?></td>
        <td align="center" valign="middle"><?php echo $sum_tooth_no;?></td>
        <td align="center" valign="middle"><?php echo $sum_tooth_good;?></td>
        <td align="center" valign="middle"><?php echo $sum_gum_good;?></td>
        <td align="center" valign="middle"><?php echo $sum_gum_no;?></td>
        <td align="center" valign="middle"><?php echo $sum_iodine_good;?></td>
        <td align="center" valign="middle"><?php echo $sum_iodine_no;?></td>
        <td align="center" valign="middle"><?php echo number_format($sumtotal,2,'.',',');?> %</td>
        <td align="center" valign="middle"><?php echo number_format($sumtotal_no,2,'.',',');?> %</td>
        <td align="center" valign="middle">[<a href="?option=health&task=report_all_type_room2&class_code=<?php echo $class_code;?>&year_in=<?php echo $year_bs;?>&ck=<?php echo $ck;?>&tm=<?php echo $tm;?>">รายละเอียด</a>]</td>
		</tr>
             <?php
			 			 /*******************************/
						 $check_room_sdT = $check_room_sdT + $check_room_sd2;  /*จำนวน นร.*/
						 $checkslwT = $checkslwT + $checkslw2;  /*ตรวจแล้ว*/
						 $total_nocheckT = $total_nocheckT + $total_nocheck;  /*ยังไม่ได้ตรวจ*/
			 			$sum_lowT = $sum_lowT + $sum_low;    /* ต่ำ */
						$sum_norT = $sum_norT + $sum_nor;  /* ปกติ */
						$sum_overT = $sum_overT + $sum_over;  /* สูง */
						$sum_gum_goodT = $sum_gum_goodT + $sum_gum_good;  /* เหงือกดี */
						$sum_gum_noT = $sum_gum_noT + $sum_gum_no;   /* เหงือกไม่ดี */
						$sum_tooth_goodT = $sum_tooth_goodT + $sum_tooth_good;  /* ฟันดี */
						$sum_tooth_noT = $sum_tooth_noT + $sum_tooth_no;   /* ฟันไม่ดี */
						$sum_iodine_goodT = $sum_iodine_goodT + $sum_iodine_good;   /* ไอโอดีนดี */
						$sum_iodine_noT = $sum_iodine_noT + $sum_iodine_no;  /* ไอโอดีนไม่ดี */
						$sum_percen_goodT = $sum_percen_goodT + $sum_percen_good;   /* % ดี */
						$sum_percen_noT = $sum_percen_noT + $sum_percen_no;    /* %ไม่ ดี */
						$tosT = $tosT + $tos;   /*ผลรวมของ %ดี และ%ไม่ดี*/
					 /*******************************/
			 			$sum_low=0;
						$sum_nor=0;
						$sum_over=0;
						$sum_gum_good=0;
						$sum_gum_no=0;
						$sum_tooth_good=0;
						$sum_tooth_no=0;
						$sum_iodine_good=0;
						$sum_iodine_no=0;
						$sumtotal=0;
						$sumtotal_no=0;
						
						$t_low=0;
						$t_over=0;
						$t_gum=0;
						$t_tooth=0;
						$t_iodine=0;
						$tno_nor=0;
						$tno_gum=0;
						$tno_tooth=0;
						$tno_iodine=0;

			 	$lp2++;
			 }
								}//else  Distinc
			
			$num++;
					}// end num
		 				?>

      <tr height="30">
        <td  align="center" valign="middle"><b>รวม</b></td>
        <td  align="center" valign="middle"><b><?php echo $check_room_sdT;?></b></td>
        <td  align="center" valign="middle"><b><?php echo $checkslwT;?></b></td>
        <td  align="center" valign="middle"><b><?php echo $total_nocheckT;?></b></td>
        <td  align="center" valign="middle"><b><?php echo $sum_lowT;?></b></td>
        <td  align="center" valign="middle"><b><?php echo $sum_norT;?></b></td>
        <td  align="center" valign="middle"><b><?php echo $sum_overT;?></b></td>
        <td  align="center" valign="middle"><b><?php echo $sum_tooth_noT;?></b></td>
        <td  align="center" valign="middle"><b><?php echo $sum_tooth_goodT;?></b></td>
        <td  align="center" valign="middle"><b><?php echo $sum_gum_goodT;?></b></td>
        <td  align="center" valign="middle"><b><?php echo $sum_gum_noT;?></b></td>
        <td  align="center" valign="middle"><b><?php echo $sum_iodine_goodT;?></b></td>
        <td  align="center" valign="middle"><b><?php echo $sum_iodine_noT;?></b></td>
        <td  align="center" valign="middle"><b><?php  if($sum_percen_goodT <= 0 || $tosT <= 0){ echo"0.00"; }else{ $verygood = ($sum_percen_goodT*100)/$tosT;?><?php echo number_format($verygood,2,'.',',');  } ?> %</b></td>
        <td  align="center" valign="middle"><b><?php  if($sum_percen_noT <= 0 || $tosT <= 0){ echo"0.00"; }else{  $notverygood = ($sum_percen_noT*100)/$tosT;?><?php echo number_format($notverygood,2,'.',',');  }?> %</b></td>
        <td colspan="2"  align="right" valign="middle">&nbsp;</td>
        </tr>     
    </table>

   	</td>
  </tr>
</table>
</body>
</html>