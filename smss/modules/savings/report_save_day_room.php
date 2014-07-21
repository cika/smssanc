<?php 
 include "./modules/savings/tab.php";

				$total_s_end = 0;  /*รวมยอดฝากทั้งหมด*/
				$total_d_end = 0; /*รวมยอดถอนทั้งหมด*/
				$total_e_end = 0; /*คงเหลือของแต่ละคนทั้งหมด*/	
				$totalP=0;
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
				$year_new=$year_S+543;
					}else{
			$dateInput=$_REQUEST['dateInput']; // day		
				list($day_S,$month_S,$year_S)=explode("/",$dateInput);
				$day_S;
				$month_S;
				$year_S;
				$dateInputBT="$year_S-$month_S-$day_S";
				$year_new=$year_S+543;
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
		if(isset($_REQUEST['level'])){
			$level=$_REQUEST['level']; //ระดับชั้น
				$room=$_REQUEST['room']; // ห้องที่
				if($level!=""&&$dateInput!=="")
					{			
						$sqlCK="SELECT* FROM student_main  WHERE class_now='$level' && room='$room' && status='0'  ORDER BY student_number ASC";
						$resultCK=mysql_query($sqlCK); 
						$check_room=mysql_num_rows($resultCK);
					}
		}
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
<table width="880" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#99CCFF" bgcolor="#FFFFFF">
<tr>
<td width="880" height="30" bgcolor="#0066FF"><font color="#FFFFFF"><?php echo $t2;?>ออมทรัพย์นักเรียน</font></td>
</tr>
  <tr>
    <td>
     <table width="880" border="0" cellspacing="0" cellpadding="0">
    <form name="form1" action="?option=savings&&task=report_save_day_room" method="post" enctype="multipart/form-data">
      <tr>
        <td width="230">&nbsp;   </td>
        <td width="284" align="center">&nbsp;เลือกวัน :
          <input type="text" name="dateInput" id="dateInput" size="15" value="<?php echo $dateInput;?>"  class="colortext"/></td>
        <td width="366" align="left">
          <input type="hidden" name="level" value="<?php echo $level;?>">
          <input type="hidden" name="room" value="<?php echo $room;?>">
          <input type="submit" name="submitS"  value="แสดงรายงาน"   /></td>
        </tr>
     </form>   
    </table>
    </td>
  </tr>
  <tr>
    <td>
	
	<table width="880" border="0">
      <tr>
        <td width="118" rowspan="3" align="center" valign="middle"><img src='modules/savings/iconS/logoS.jpg' width='65' height='80' border='0'></td>
        <td colspan="3" align="center"><strong>รายงาน</strong><br>
          ยอดฝากประจำ วัน<?php  if($dateInput!=""){?>ที่ <?php echo $day_S;?>&nbsp;เดือน&nbsp;<?php echo $date_show;?> พ.ศ. <?php echo $year_new;?><?php  }?></td>
        <td width="145" rowspan="3" align="center" valign="middle"><a href="?option=savings&task=report_all&dateInput=<?php echo $dateInput;?>" title="ย้อนกลับ"><img src='modules/savings/iconS/bk.gif'  border='0'></a></td>
        </tr>
        <?php
		if(isset($level)){
				 $sqlmain="SELECT* FROM student_main_class WHERE class_code='$level'";
				$resultmain=mysql_query($sqlmain); 
   			    $rowbsmain=mysql_fetch_array($resultmain);
		}
				?>
      <tr>
        <td colspan="3" align="left" valign="middle">ระดับชั้น :
          <?php if(isset($level)){ echo $rowbsmain['class_name'];?><?php if(isset($room)){  if($room!=0){ ?>/<?php echo $room;?><?php  }  } } ?></td>
        </tr>
      <tr>
        <td width="223">&nbsp;</td>
        <td width="188">&nbsp;</td>
        <td width="206">&nbsp;</td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td  valign="top">
	<table width="880" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="44" align="center" valign="middle" bgcolor="#76CEEB">ลำดับ</td>
        <td width="87" align="center" valign="middle" bgcolor="#76CEEB">รหัสนักเรียน</td>
        <td width="54" align="center" valign="middle" bgcolor="#76CEEB">เลขที่</td>
        <td width="196" align="center" valign="middle" bgcolor="#76CEEB">ชื่อ - สกุล</td>
        <td width="128" align="center" valign="middle" bgcolor="#76CEEB">จำนวนยอดเงินฝาก<br>
          <strong>ณ</strong> วันที่ <br><?php echo $day_S;?><?php echo $t1;?><?php echo $date_show;?><?php echo $t1;?><?php echo $year_new;?></td>
        <td width="127" align="center" valign="middle" bgcolor="#76CEEB">จำนวนยอดถอนเงิน<br>
          <strong>ณ</strong> วันที่ <br><?php echo $day_S;?><?php echo $t1;?><?php echo $date_show;?><?php echo $t1;?><?php echo $year_new;?></td>
        <td width="228" align="center" valign="middle" bgcolor="#76CEEB">ยอดเงินคงเหลือสุทธิ <br> <strong>ตั้งแต่เริ่มฝาก</strong>
        <?php echo $t1;?> <strong>ถึง</strong><br> 
         <?php echo $day_S;?><?php echo $t1;?><?php echo $date_show;?><?php echo $t1;?><?php echo $year_new;?></td>
        </tr>      
         <?php 
	  $num=1;
	  $bg="";
	while($recordCK=mysql_fetch_array($resultCK))
		{	
						$std_ckid=$recordCK['student_id'];
				
						$sqlSM="SELECT SUM(amount_money) AS sumsave FROM savings_money  WHERE std_id='$std_ckid'&&day_act='$dateInput'&&acc_type='1'";
						$resultSM=mysql_query($sqlSM); 
						 $recordSM=mysql_fetch_array($resultSM);
						 $moneySave=$recordSM['sumsave'];  /*รวมยอดฝาก*/

$sqlSM2="SELECT SUM(amount_money) AS sumdraw FROM savings_money  WHERE std_id='$std_ckid'&&day_act='$dateInput'&&acc_type='2'";
						$resultSM2=mysql_query($sqlSM2); 
						 $recordSM2=mysql_fetch_array($resultSM2);
						 $moneysumdraw=$recordSM2['sumdraw']; /*รวมยอดถอน*/
			/********************คำนวณหายอดคงเหลือสุทธิ*************/
				$sqlstart="SELECT * FROM savings_total WHERE std_id='$std_ckid' AND comment='1'";	 // ค้นหาวันที่ฝากวันแรก
				$resultstart=mysql_query($sqlstart); 
				$recordstart=mysql_fetch_array($resultstart);
	$sqled="SELECT SUM(amount_money) AS saveed FROM savings_money  WHERE std_id='$std_ckid' AND office >= '$recordstart[day_start]' AND office <='$dateInputBT' AND acc_type='1'";
						$resulted=mysql_query($sqled);  /*&&year_past='$Year_bs'*/
						 $recorded=mysql_fetch_array($resulted);
						 $saveed=$recorded['saveed'];  /*รวมยอดฝากทั้งหมด*/

$sqled2="SELECT SUM(amount_money) AS sumdrawed FROM savings_money  WHERE std_id='$std_ckid' AND office >= '$recordstart[day_start]' AND office <='$dateInputBT'AND acc_type='2'";
						$resulted2=mysql_query($sqled2);  /*&&year_past='$Year_bs'*/
						 $recorded2=mysql_fetch_array($resulted2);
						 $sumdrawed=$recorded2['sumdrawed']; /*รวมยอดถอนทั้งหมด*/
						 /****************สิ้นสุดหาจำนวนคงเหลือสุทธิ*****************/
				//............................................................................
				$c1="#DDF4F9";
			 	$c2="#FEE2FC";
				//..............................................................................
				if($bg==$c1){
				$bg=$c2;
				}else{
				$bg=$c1;
				}
				//...................................................................................
				$totalP=$saveed - $sumdrawed; /*คงเหลือของแต่ละคน*/
		
	  ?>
      <tr bgcolor="<?php echo $bg;?>"   onMouseOver="this.className='menu-over'" onMouseOut="this.className='menu'" class="menu">
        <td  align="center" valign="middle"><?php echo $num;?></td>
        <td align="center" valign="middle"><a href="?option=savings&task=report_save_day_personal&student_id=<?php echo $recordCK['student_id'];?>&dateInput=<?php echo $dateInput;?>&room=<?php echo $room;?>&level=<?php echo $level;?>" title="ดูรายละเอียด <?php echo $recordCK['prename'].$recordCK['name'];?>&nbsp;&nbsp;&nbsp;<?php echo $recordCK['surname'];?>"><?php echo $recordCK['student_id'];?></a></td>
        <td align="center" valign="middle"><?php echo $recordCK['student_number'];?></td>
        <td valign="middle">&nbsp;<?php echo $recordCK['prename'].$recordCK['name'];?>&nbsp;&nbsp;&nbsp;<?php echo $recordCK['surname'];?></td>
        <td align="right" valign="middle"> <?php  if($moneySave>=0){?><?php echo number_format($moneySave,'2','.',',');?><?php  }?>&nbsp;</td>
        <td align="right" valign="middle"> <?php  if($moneysumdraw>=0){?><?php echo number_format($moneysumdraw,'2','.',',');?><?php  }?>&nbsp;</td>
        <td align="right" valign="middle"> <?php  if($totalP>=0){?><?php echo number_format($totalP,'2','.',',');?><?php  }?>&nbsp;&nbsp;</td>
        </tr>
         <?php
				$total_s_end = $total_s_end + $moneySave;  /*รวมยอดฝากทั้งหมด*/
				 $total_d_end = $total_d_end + $moneysumdraw; /*รวมยอดถอนทั้งหมด*/
				$total_e_end = $total_e_end + $totalP; /*คงเหลือของแต่ละคนทั้งหมด*/	
				$totalP=0;
	  $num++;
    }
		  ?>
      <tr>
        <td colspan="4"  align="right" valign="middle"><strong>รวมสุทธิ</strong>&nbsp;</td>
        <td  align="right" valign="middle"><strong>
          <?php  if($total_s_end>=0){?> <?php echo number_format($total_s_end,'2','.',',');?><?php  }?>
        </strong>&nbsp;</td>
        <td  align="right" valign="middle"><strong>
          <?php  if($total_d_end>=0){?> <?php echo number_format($total_d_end,'2','.',',');?><?php  }?>
        </strong>&nbsp;</td>
        <td  align="right" valign="middle"><strong>
           <?php  if($total_e_end>=0){?><?php echo number_format($total_e_end,'2','.',',');?><?php  }?>
        </strong>&nbsp;</td>
        </tr>
     
    </table>

   	</td>
  </tr>
</table>
</body>
</html>