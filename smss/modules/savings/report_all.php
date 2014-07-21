<?php 
 include "./modules/savings/tab.php";
				 if(isset($_REQUEST['level'])){
								$level=$_REQUEST['level']; //ระดับชั้น
								$room=$_REQUEST['room']; // ห้องที่
								$year=$_REQUEST['year']; //ปีการศึกษา
				 }	
						$dy= date('d');  //สำหรับแสดงที่หน้า page
						$my= date('m');  //สำหรับแสดงที่หน้า page
						$tt= date('Y');  //สำหรับแสดงที่หน้า page
						$yr=$tt+543; //สำหรับแสดงที่หน้า page
				if(!isset($_REQUEST['dateInput'])){
					$dateInput="$dy/$my/$tt";
					$dateInputBT="$tt-$my-$dy";
					list($day_S,$month_S,$year_S)=explode("/",$dateInput);
				$day_S;
				$month_S;
				$year_S;
				$yearps=$year_S+543;
					}else{
					$dateInput=$_REQUEST['dateInput']; //วันที่	
				list($day_S,$month_S,$year_S)=explode("/",$dateInput);
				$day_S;
				$month_S;
				$year_S;
				$dateInputBT="$year_S-$month_S-$day_S";
				$yearps=$year_S+543;
					}
	 //สำหรับแสดงที่หน้า page		 
    if($month_S=="01"){
		$date_show="มกราคม";
		}else if($month_S=="02"){
			$date_show="กุมภาพันธ์";
			}else if($month_S=="03"){
			$date_show="มีนาคม";
			}else if($month_S=="04"){
			$date_show="เมษายน";
			}else if($month_S=="05"){
			$date_show="พฤษภาคม";
			}else if($month_S=="06"){
			$date_show="มิถุนายน";
			}else if($month_S=="07"){
			$date_show="กรกฎาคม";
			}else if($month_S=="08"){
			$date_show="สิงหาคม";
			}else if($month_S=="09"){
			$date_show="กันยายน";
			}else if($month_S=="10"){
			$date_show="ตุลาคม";
			}else if($month_S=="11"){
			$date_show="พฤศจิกายน";
			}else if($month_S=="12"){
				$date_show="ธันวาคม";
			}else{}
	?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel='stylesheet' href='./modules/savings/config_color.css'> 
<title>ออมทรัพย์นักเรียน</title>
<style>
.menu{background-color:; }
.menu-over{background-color:#22F942;}
</style>
<link rel="stylesheet" type="text/css" href="modules/savings/css/smoothness/jquery-ui-1.7.2.custom.css">
<script type="text/javascript" src="modules/savings/js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="modules/savings/js/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript">
$(function(){
	// แทรกโค้ต jquery
	$("#dateInput").datepicker();
});
</script>

<link rel="stylesheet" type="text/css" href="modules/savings/css/smoothness/jquery-ui-1.7.2.custom.css">
<script type="text/javascript" src="modules/savings/js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="modules/savings/js/jquery-ui-1.7.2.custom.min.js"></script>
<script type="text/javascript">
$(function(){
	// แทรกโค้ต jquery
	$("#dateInput").datepicker();
});
</script>
<script type="text/javascript">
$(function(){
	// แทรกโค้ต jquery
	$("#dateInput").datepicker({ dateFormat: 'yy-mm-dd' });
	// รูปแบบวันที่ที่ได้จะเป็น 2009-08-16
});
</script>
<script type="text/javascript">
$(function(){
	// แทรกโค้ต jquery
	$("#dateInput").datepicker({
		numberOfMonths: 2,
		showButtonPanel: true
	});
});
</script>
<script type="text/javascript">
$(function(){
	// แทรกโค้ต jquery
	$("#dateInput").datepicker({minDate: -20, maxDate: '+1M +10D'});
	// minDate: -20 ไม่สามารถเลือกวันที่ ก่อน 20 วันก่อนหน้าได้
	// maxDate: '+1M +10D' ไม่สามารถเลือก วันที่ถัดจาก อีก 1 เดือนและ 10 วัน ได้
	// หากต้องการให้เลือกวันที่ได้เฉพาะวันปัจจุบันเป็นต้นไป
	// สามารถกำหนด เป็น $("#dateInput").datepicker({minDate: 0});
});
</script>
</head>

<body topmargin="0" bgcolor="#F4FFF4">
<br>
<table width="1000" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#99CCFF" bgcolor="#FFFFFF">
<tr>
<td width="880" height="30" bgcolor="#0066FF"><font color="#FFFFFF"><?php echo $t2;?>ออมทรัพย์นักเรียน</font></td>
</tr>
 
  <tr>
    <td>
	  <form name="form1" action="?option=savings&&task=report_all" method="post" enctype="multipart/form-data">
	<table width="1000" border="0">
      <tr>
        <td width="99" rowspan="3" align="center" valign="middle"><img src='modules/savings/iconS/logoS.jpg' width='65' height='80' border='0'></td>
        <td width="891" align="center"><strong>รายงาน</strong><br>
        ระบบออมทรัพย์นักเรียน</td>
        </tr>
      <tr>
        <td height="35" align="center">แสดงรายงานข้มูล ณ วันที่ : <?php echo $day_S;?><?php echo $t1;?><?php echo $date_show;?><?php echo $t1;?><?php echo $yearps;?> </td>
        </tr>
      <tr>
        <td height="35" align="center">เลือกจากปฏิทิน :
          <input type="text" name="dateInput" id="dateInput" size="15" value="<?php echo $dateInput;?>" class="colortext" /><?php echo $t3;?> <input type="submit" name="submitS"  value="แสดงรายงาน"   /></td>
        </tr>
    </table>
    </form>
    </td>
  </tr>
  <tr>
    <td  valign="top">
	<table width="1000" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="164" align="center" valign="middle" bgcolor="#76CEEB">ระดับชั้น</td>
        <td width="103" align="center" valign="middle" bgcolor="#76CEEB">จำนวนนักเรียน<br>
          ทั้งหมด</td>
        <td width="126" align="center" valign="middle" bgcolor="#76CEEB">จำนวนรายการที่<br>
          ฝาก-ถอน <strong>ณ</strong> วันที่<br><?php echo $day_S;?><?php echo $t1;?><?php echo $date_show;?><?php echo $t1;?><?php echo $yearps;?></td>
        <td width="127" align="center" valign="middle" bgcolor="#76CEEB">จำนวนยอดเงินฝาก <br>
          <strong>ณ</strong> วันที่<br><?php echo $day_S;?><?php echo $t1;?><?php echo $date_show;?><?php echo $t1;?><?php echo $yearps;?></td>
        <td width="146" align="center" valign="middle" bgcolor="#76CEEB">จำนวนยอดเงินถอน<br>
          <strong>ณ</strong> วันที่<br><?php echo $day_S;?><?php echo $t1;?><?php echo $date_show;?><?php echo $t1;?><?php echo $yearps;?></td>
        <td width="215" align="center" valign="middle" bgcolor="#76CEEB">ยอดเงินคงเหลือสุทธิ <br> <strong>ตั้งแต่เริ่มฝาก</strong>
        <?php echo $t1;?> <strong>ถึง</strong><br> 
        <?php echo $day_S;?><?php echo $t1;?><?php echo $date_show;?><?php echo $t1;?><?php echo $yearps;?></td>
        <td width="103" align="center" valign="middle" bgcolor="#76CEEB">รายละเอียด</td>
        </tr>      
      <?php 
						$total_rr= $total_rr = 0; /* หายอดฝากตั้งแต่เริ่มฝาก*/
						$total_rr2 = 0;  /* หายอดถอนตั้งแต่เริ่มฝาก*/
						$total_now = 0; /* รวมยอดเงินที่ฝากทั้งหมด*/
						$total_nowbb = 0;  /* รวมยอดถอนเงินทั้งหมด*/
						$total_sum = 0; /*ยอดเงินคงเหลือ*/
						$total_nowX = 0;  /* รวมยอดเงินที่ฝากทั้งหมด*/
						$total_nowbbX = 0;  /* รวมยอดถอนเงินทั้งหมด*/
						$total_sumX = 0;   /*ยอดเงินคงเหลือ*/
						$check_room_sdT = 0; /*จำนวนนักเรียนทั้งหมด*/
						$check_room_sdNT = 0;  /*จำนวนนักเรียนที่ฝาก-ถอนวันนี้*/
						$bg="";
						
					$sqlCK="SELECT* FROM student_main_class order by id ASC"; /*หาระดับชั้น student_main_class*/
					$resultCK=mysql_query($sqlCK); 
					$check_room=mysql_num_rows($resultCK);
					  $num=1;
				while($recordCK=mysql_fetch_array($resultCK))
					{	
   			 			$sqlSM="SELECT DISTINCT room FROM student_main  WHERE class_now='$recordCK[class_code]' AND status='0' order by room ASC"; /*หาจำนวนห้อง*/
						$resultSM=mysql_query($sqlSM); 
						$check_room_SM=mysql_num_rows($resultSM);
						$lp=1;			
						while($recordSM=mysql_fetch_array($resultSM))
							{	
						$sqlsdN="SELECT  * FROM savings_money  WHERE level_class='$recordCK[class_code]' AND room='$recordSM[room]' AND day_act='$dateInput'";
						$resultsdN=mysql_query($sqlsdN); 
						$check_room_sdN=mysql_num_rows($resultsdN);	/* จำนวนนักเรียนที่ฝากเงินและถอน วันนี้*/			
				
					/* ********************************* */
					$sqlsd="SELECT  * FROM student_main  WHERE class_now='$recordCK[class_code]' AND status='0' AND room='$recordSM[room]'"; /*หาคนทั้งหมดในห้องนั้นๆ*/
						$resultsd=mysql_query($sqlsd); 
						$check_room_sd=mysql_num_rows($resultsd);		/* จำนวนนักเรียนทั้งหมด*/			
						$person=1;			
						while($recordsd=mysql_fetch_array($resultsd))
					{	
					
		      			$sqlslw1="SELECT SUM(amount_money) AS totalPER FROM savings_money WHERE std_id='$recordsd[student_id]' AND day_act='$dateInput' AND acc_type='1'"; /*หายอดฝาก ของคนนั้นๆ*/
		  		$resultslw1=mysql_query($sqlslw1); 
				$recordslw1=mysql_fetch_array($resultslw1);
			//	$checkslw1=mysql_num_rows($resultslw1);

         			$sqlbb="SELECT SUM(amount_money) AS totalPERbb FROM savings_money WHERE std_id='$recordsd[student_id]' AND day_act='$dateInput' AND acc_type='2'"; /*หายอดถอน ของคนนั้นๆ*/
		  		$resultbb=mysql_query($sqlbb); 
				$recordbb=mysql_fetch_array($resultbb);
			//	$checkbb=mysql_num_rows($resultbb);
				//*******************หายอดรวมสุทธิ*************************//
				$sqlstart="SELECT * FROM savings_total WHERE std_id='$recordsd[student_id]' AND comment='1'";	 // ค้นหาวันที่ฝากวันแรก
				$resultstart=mysql_query($sqlstart); 
				$recordstart=mysql_fetch_array($resultstart);	
				
				$sqlrr="SELECT SUM(amount_money) AS totalrr FROM savings_money WHERE std_id='$recordsd[student_id]' AND office >= '$recordstart[day_start]' AND office <='$dateInputBT' AND acc_type='1'"; /*หายอดฝากตั้งแต่เริ่มฝาก ของคนนั้นๆ*/
		  		$resultrr=mysql_query($sqlrr);  
				$recordrr=mysql_fetch_array($resultrr);					
				
		//		$sqlrr="SELECT SUM(amount_money) AS totalrr FROM savings_money WHERE std_id='$recordsd[student_id]'  AND acc_type='1'"; /*หายอดฝากตั้งแต่เริ่มฝาก ของคนนั้นๆ*/

				$sqlrr2="SELECT SUM(amount_money) AS totalrr2 FROM savings_money WHERE std_id='$recordsd[student_id]' AND office >= '$recordstart[day_start]' AND office <='$dateInputBT' AND acc_type='2'"; /*หายอดถอนตั้งแต่เริ่มฝาก ของคนนั้นๆ*/
		  		$resultrr2=mysql_query($sqlrr2); 
				$recordrr2=mysql_fetch_array($resultrr2);								
	//			$sqlrr2="SELECT SUM(amount_money) AS totalrr2 FROM savings_money WHERE std_id='$recordsd[student_id]' AND acc_type='2'"; /*หายอดถอนตั้งแต่เริ่มฝาก ของคนนั้นๆ*/

					 	$person++; /*หาคนทั้งหมดในห้องนั้นๆ*/
						
						$total_rr= $total_rr + $recordrr['totalrr']; /* หายอดฝากตั้งแต่เริ่มฝาก*/
						$total_rr2= $total_rr2 + $recordrr2['totalrr2']; /* หายอดถอนตั้งแต่เริ่มฝาก*/
						$total_now = $total_now + $recordslw1['totalPER']; /* รวมยอดเงินที่ฝากทั้งหมด*/
						$total_nowbb = $total_nowbb + $recordbb['totalPERbb'];  /* รวมยอดถอนเงินทั้งหมด*/
						$total_sum = $total_rr - $total_rr2; /*ยอดเงินคงเหลือ*/
		}
		
						$total_nowX = $total_nowX + $total_now; /* รวมยอดเงินที่ฝากทั้งหมด*/
						$total_nowbbX =  $total_nowbbX + $total_nowbb;  /* รวมยอดถอนเงินทั้งหมด*/
						$total_sumX = $total_sumX + $total_sum;  /*ยอดเงินคงเหลือ*/
						$check_room_sdT = $check_room_sdT + $check_room_sd; /*จำนวนนักเรียนทั้งหมด*/
						$check_room_sdNT= $check_room_sdNT + $check_room_sdN; /*จำนวนนักเรียนที่ฝาก-ถอนวันนี้*/
									//............................................................................
				$c1="#DDF4F9";
			 	$c2="#FEE2FC";
				//..............................................................................
				if($bg==$c1){
				$bg=$c2;
				}else{
				$bg=$c1;
				}
	  ?>
      <tr bgcolor="<?php echo $bg;?>"  onMouseOver="this.className='menu-over'" onMouseOut="this.className='menu'" class="menu">
        <td  align="left" valign="middle">&nbsp;<?php echo $recordCK['class_name'];?><?php  if($recordSM['room']!=0){?>/<?php echo $recordSM['room'];?><?php  } ?></td>
        <td align="center" valign="middle"><?php echo $check_room_sd;?></td>
        <td align="center" valign="middle"><?php echo $check_room_sdN;?></td>
        <td align="right" valign="middle"><?php  if($total_now>=0){?><?php  echo number_format($total_now,2,'.',',');?><?php  }?></td>
        <td align="right" valign="middle"><?php  if($total_nowbb>=0){?><?php echo number_format($total_nowbb,2,'.',',');?><?php  }?></td>
        <td align="right" valign="middle"><?php  if($total_sum>=0){?><?php echo number_format($total_sum,2,'.',',');?><?php  }?></td>
        <td align="center" valign="middle">[<a href="?option=savings&task=report_save_day_room&level=<?php echo $recordCK['class_code'];?>&room=<?php echo $recordSM['room'];?>&dateInput=<?php echo $dateInput;?>" title="ดูรายละเอียด">รายละเอียด</a>]</td>
        </tr>
        <?php 
		$total_nowbb=0;  /*  จำนวนเงินถอน*/
		$total_now=0; /*รวมยอดเงินที่ฝากทั้งหมดของวันนี้*/
		$total_rr=0; /*หายอดถอนตั้งแต่เริ่มฝาก*/
		$total_rr2=0; /*หายอดฝากตั้งแต่เริ่มฝาก*/
		$check_room_sdN=0; /* จำนวนนักเรียนที่ฝากเงิน วันนี้*/	
		 	
			$lp++; //หาจำนวนห้องเรียนของแต่ละชั้น
		 }
		
			$num++;
					}// end num หาระดับชั้นเรียน
					
		 				?>

      <tr>
        <td height="30"  align="center" valign="middle"><strong>รวม</strong></td>
        <td  align="center" valign="middle"><strong><?php echo $check_room_sdT;?></strong></td>
        <td  align="center" valign="middle"><strong><?php echo $check_room_sdNT;?></strong></td>
        <td  align="right" valign="middle"><strong>
         <?php  if($total_nowX>=0){?> <?php echo number_format($total_nowX,2,'.',',');?><?php  }?>
        </strong></td>
        <td  align="right" valign="middle"><strong>
         <?php  if($total_nowbbX>=0){?> <?php echo number_format($total_nowbbX,2,'.',',');?><?php  }?>
        </strong></td>
        <td  align="right" valign="middle"><strong>
          <?php  if($total_sumX>=0){?><?php echo number_format($total_sumX,2,'.',',');?><?php  }?>
        </strong></td>
        <td  align="right" valign="middle">&nbsp;</td>
        </tr>
     
    </table>

   	</td>
  </tr>
</table>
</body>
</html>