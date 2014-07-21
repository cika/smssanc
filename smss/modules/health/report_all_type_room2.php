<?php 
 include "./modules/health/tab.php";
	
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
			$valsum="";

				$sqlCKC="SELECT* FROM student_main_class WHERE class_code='$class_code'";
				$resultCKC=mysql_query($sqlCKC); 
				$recordCKC=mysql_fetch_array($resultCKC);
		
		if($room!="")
		/*กรณีมีหลายห้อง*/
			{		
					if(!isset($start)){
						$start = 0;
						}
						$limit = '60';	
				$sqlCK="SELECT* FROM student_main WHERE class_now='$recordCKC[class_code]' AND room='$room' AND status='0'";
		  		$resultCK=mysql_query($sqlCK); 
				$check_room=mysql_num_rows($resultCK);
				$Query=mysql_query("SELECT* FROM student_main  WHERE class_now='$recordCKC[class_code]' AND room='$room'  AND status='0' ORDER BY student_number ASC LIMIT $start,$limit");	
			}else{ /*กรณีมีห้องเดียว*/
				if(!isset($start)){
						$start = 0;
						}
						$limit = '60';	
				$sqlCK="SELECT* FROM student_main WHERE class_now='$recordCKC[class_code]'  AND status='0'";
		  		$resultCK=mysql_query($sqlCK); 
				$check_room=mysql_num_rows($resultCK);
				$Query=mysql_query("SELECT* FROM student_main  WHERE class_now='$recordCKC[class_code]'  AND status='0' ORDER BY student_number ASC LIMIT $start,$limit");
				}
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
<td height="30" bgcolor="#0066FF"><?php echo $t2;?><font color="#FFFFFF">รายงาน :: ตรววจสุขภาพนักเรียนรายห้อง</font></td>
</tr>
  <tr>
    <td>
    <table width="1198" border="0">
      <tr>
        <td width="149" rowspan="4" align="center" valign="middle"><img src='modules/health/iconH/logospt.jpg' alt='แก้ไข' width='80' height='80' border='0'></td>
        <td colspan="4" align="center"><strong>รายงาน แบบแยกตามเพศ</strong><br>
          การตรวจสุขภาพนักเรียนรายห้อง<br>
          <br></td>
        <td width="149" rowspan="4" align="center"><a href='?option=health&task=report_all2&ck=<?php echo $ck;?>&tm=<?php echo $tm;?>&year_in=<?php echo $year_bs;?>'><img src='modules/health/iconH/bk.gif' border="0" title="ย้อนกลับ"></a> </td>
        </tr>
        <form name="form1" action="?option=health&&task=report_all_type_room2" method="post" enctype="multipart/form-data">
      <tr>
        <td colspan="4" align="center">ปีการศึกษา : <input type="text" name="year_in" size="3" maxlength="4" value="<?php echo $year_bs;?>" class="colortext">&nbsp;&nbsp;
          <input type="hidden" name="tm" value="<?php echo $tm;?>">
          <input type="hidden" name="ck" value="<?php echo $ck;?>">
          <input type="hidden" name="class_code" value="<?php echo $class_code;?>">
          <input type="hidden" name="room" value="<?php echo $room;?>">
          <!--    <input type="submit" name="submitS"  value="แสดงรายงาน"   /> --></td>
        
      </tr>
      </form>
      <tr>
        <td align="left">ปีการศึกษา :
          <?php echo $year_bs;?></td>
        <td align="left">ภาคเรียนที่ : <?php echo $tm;?></td>
        <td align="left">ครั้งที่ตรวจ : <?php echo $ck;?></td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td width="226" align="left">ระดับชั้น : <?php echo $recordCKC['class_name'];?><?php  if($room!=0){ ?>/<?php echo $room;?><?php } ?></td>
        <td width="176" align="left">จำนวน  <?php echo $check_room;?> คน</td>
        <td width="182" align="left">&nbsp;</td>

        <td width="139" align="center">&nbsp;  </td>
      
        </tr>
    </table>

    </td>
  </tr>
  <tr>
    <td  valign="top"  height="260"><table width="1200" border="1" cellspacing="0" cellpadding="0">
      <tr bgcolor="#76CEEB">
        <td width="3%" rowspan="2" align="center" valign="middle">ลำดับ</td>
        <td width="5%" rowspan="2" align="center" valign="middle">รหัส<br>
          นักเรียน</td>
        <td width="3%" rowspan="2" align="center" valign="middle">เลขที่</td>
        <td width="14%" rowspan="2" align="center" valign="middle">ชื่อ - สกุล</td>
        <td colspan="13" align="center" valign="middle">ผลการตรวจสุขภาพนักเรียน</td>
        </tr>
      <tr>
        <td width="5%" align="center" valign="middle" bgcolor="#76CEEB">น้ำหนัก<br>
          (ก.ก.)</td>
        <td width="4%" align="center" valign="middle" bgcolor="#76CEEB">ส่วนสูง<br>
          (ซม.)</td>
        <td width="8%" align="center" valign="middle" bgcolor="#76CEEB">เทียบเกณฑ์<br>
          มาตรฐาน</td>
        <td width="6%" align="center" valign="middle" bgcolor="#76CEEB">เหงือก</td>
        <td width="3%" align="center" valign="middle" bgcolor="#76CEEB">ฟัน</td>
        <td width="7%" align="center" valign="middle" bgcolor="#76CEEB">ไอโอดีน</td>
        <td width="6%" align="center" valign="middle" bgcolor="#76CEEB">ชีพจร<br>
          ขณะพัก<br>
          (ครั้ง/นาที)</td>
        <td width="6%" align="center" valign="middle" bgcolor="#76CEEB">ดันพื้น<br>
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
        <td width="6%" align="center" valign="middle" bgcolor="#76CEEB">วันเวลา<br>
          ที่ตรวจ</td>
        <td width="8%" align="center" valign="middle" bgcolor="#76CEEB">หมายเหตุ</td>
      </tr>
      <?php 
	  $num=1;
	  $bg="";
	while($recordSR=mysql_fetch_array($Query))
	{
			$student_id=$recordSR['student_id'];
			
				$c1="#E9FEF0";
			 	$c2="#FDFEE2";
				//..............................................................................
				if($bg==$c1){
				$bg=$c2;
				}else{
				$bg=$c1;
				}
	  ?>
        <?php
		
				$sqlshow="SELECT* FROM health_checking WHERE student_id='$student_id'&&year_std='$year_bs'&&term_std='$tm'&&number_check='$ck'";
		  		$resultshow=mysql_query($sqlshow); 
				$checkshow=mysql_num_rows($resultshow);
				$recordshow=mysql_fetch_array($resultshow);
			/*	$ac1="ผอม";
				$ac2="ปกติ";
				$ac3="น้ำหนักเกิน";
				$ac4="อ้วนระดับ 1";
				$ac5="อ้วนระดับ 2";
				$ac6="อันตราย";				
			*/	
						$sqlsex="SELECT  * FROM student_main  WHERE student_id='$recordshow[student_id]' AND status='0'";
						$resultsex=mysql_query($sqlsex); 
						$recordsex=mysql_fetch_array($resultsex);
				$weight=$recordshow['weight']; /*น้ำหนัก*/
				$tall=$recordshow['tall']; /*ส่วนสูง*/
				
				$sum_sex1=0; $sum_sex2=0; $sum_sex_low1=0; $sum_sex_over1=0; $valsum=""; /* คืนค่าเป็น 0*/
				/* คำนวณหาน้ำหนักตามเกณฑ์มาตรฐาน*/
				if($recordsex['sex']==1){
					$sum_sex1 = $tall - 100; 
							$sum_sex_low1 = $sum_sex1 - 5;
							$sum_sex_over1 = $sum_sex1 + 5;
								if($weight < $sum_sex_low1){
									$ac1="ผอม";
									$action_show="ผอม";
									$valsum = $sum_sex_low1;
									}else if($weight > $sum_sex_over1){
										$ac3="อ้วน";
										$action_show="อ้วน";
										$valsum = $sum_sex_over1;
										}else{
											$ac2="ปกติ";
											$action_show="ปกติ";
											$valsum = $sum_sex1;
											}
					}else if($recordsex['sex']==2){
						$sum_sex2=$tall - 110; 
							$sum_sex_low2 = $sum_sex2 - 5;
							$sum_sex_over2 = $sum_sex2 + 5;
									if($weight < $sum_sex_low2){
										$ac1="ผอม";
										$action_show="ผอม";
										$valsum = $sum_sex_low2;
										}else if($weight > $sum_sex_over2){
											$ac3="อ้วน";
											$action_show="อ้วน";
											$valsum = $sum_sex_over2;
											}else{
												$ac2="ปกติ";
												 $action_show="ปกติ";
												 $valsum = $sum_sex2;
												}
						}else{
							$ac4="ไม่ทราบผล";
							 $action_show="ไม่ทราบผล";
							 $valsum = "<font color='#FF9900'>* ไม่ได้ระบุเพศ</font>";
							}
				
			  ?>
      <tr valign="middle" bgcolor="<?php echo $bg;?>"  onmouseover="this.className='menu-over'" onMouseOut="this.className='menu'" class="menu">
        <td  align="center"><?php echo $num;?></td>
        <td align="center"><a href="?option=health&task=report_all_type_personal2&class_code=<?php echo $class_code;?>&year_in=<?php echo $year_bs;?>&student_id=<?php echo $student_id;?>&room=<?php echo $room;?>&ck=<?php echo $ck;?>&tm=<?php echo $tm;?>" title="รายละเอียดข้อมูลสุขภาพ <?php echo $recordSR['prename'].$recordSR['name'];?> &nbsp;&nbsp;<?php echo $recordSR['surname'];?>"><?php echo $student_id;?></a></td>
        <td align="center"><?php echo $recordSR['student_number'];?></td>
        <td>&nbsp;<?php echo $recordSR['prename'].$recordSR['name'];?> &nbsp;&nbsp;<?php echo $recordSR['surname'];?></td>
        <td align="center"><?php if($recordshow['weight']==""){echo"-";}else{ echo $recordshow['weight']; }?></td>
        <td align="center"><?php if($recordshow['tall']==""){echo"-";}else{ echo $recordshow['tall']; }?></td>
        <td align="center"><?php if($recordshow['weight']=="" || $recordshow['tall']==""){echo"-";}else{ echo"$valsum<br>$action_show"; }?></td>
        <td align="center"><?php if($recordshow['gum']==""){echo"-";}else{ echo $recordshow['gum']; }?></td>
        <td align="center"><?php if($recordshow['tooth']==""){echo"-";}else{ echo $recordshow['tooth']; }?></td>
        <td align="center"><?php if($recordshow['iodine']==""){echo"-";}else{ echo $recordshow['iodine']; }?></td>
        <td align="center"><?php if($recordshow['life']==""){echo"-";}else{ echo $recordshow['life']; }?></td>
        <td align="center"><?php if($recordshow['push']==""){echo"-";}else{ echo $recordshow['push']; }?></td>
        <td align="center"><?php if($recordshow['sit']==""){echo"-";}else{ echo $recordshow['sit']; }?></td>
        <td align="center"><?php if($recordshow['roll']==""){echo"-";}else{ echo $recordshow['roll']; }?></td>
        <td align="center"><?php if($recordshow['run']==""){echo"-";}else{ echo $recordshow['run']; }?></td>
        <td align="center"><?php if($recordshow['day']==""){echo"-";}else{ echo $recordshow['day']; }?></td>
        <td align="center"><?php if($recordshow['comment']==""){ if($recordshow['weight']=="" && $recordshow['tall']==""){echo"ยังไม่ตรวจ";}else{echo"-";}
		}else{ echo $recordshow['comment']; }?></td>
      </tr>
      <?php
 			  $num++;
    		  }
		  ?>
    </table>

  
						</td>
						</tr>
	  </table>
    
    
    
    </td>
  </tr>
</table>
</body>

</html>
