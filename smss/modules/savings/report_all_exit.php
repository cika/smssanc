<?php 
 include "./modules/savings/tab.php";
				$sqlbs="SELECT* FROM savings_base   WHERE status='1'";
				$resultbs=mysql_query($sqlbs); 
				$rowbs=mysql_fetch_array($resultbs);
				$Year_bs=$rowbs['study_year']; //ปีการศึกษา
				
				if(isset($_REQUEST['level'])){
				$level=$_REQUEST['level']; //ระดับชั้น
				$room=$_REQUEST['room']; // ห้องที่
				}
				$dy= date('d');  //สำหรับแสดงที่หน้า page
				$my= date('m');  //สำหรับแสดงที่หน้า page
				$tt= date('Y');  //สำหรับแสดงที่หน้า page
				$yr=$tt+543; //สำหรับแสดงที่หน้า page		
							
				if(isset($_REQUEST['pasted'])){
				$pasted=$_REQUEST['pasted']; //ปีการศึกษา
				}else{
					$pasted = $Year_bs;				
					}						
	 $month_S =$my; 
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
			//	$check_room_draw = 0;
						$total_num_save = 0; //รวมจำนวนคนฝาก
						$total_num_draw = 0; //รวมจำนวนคนถอน			
						$total_sum_save = 0; /* รวมยอดเงินที่ฝากทั้งหมด*/
						$total_sum_draw = 0;  /* รวมยอดถอนเงินทั้งหมด*/
						$total_sum = 0; /*ยอดเงินคงเหลือ*/
						$total_sum_saveX = 0; /* รวมยอดเงินที่ฝากทั้งหมด*/
						$total_sum_drawX =  0;  /* รวมยอดถอนเงินทั้งหมด*/
						$total_sumX = 0;  /*ยอดเงินคงเหลือ*/
						$check_room_sdT = 0; /*จำนวนนักเรียนทั้งหมด*/
						$check_room_save_total= 0; /*จำนวนที่ฝาก*/
						$check_room_draw_total= 0; /*จำนวนที่ถอน*/
						$total_rr =0;
						$total_rr2 =0;
	?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel='stylesheet' href='./modules/savings/config_color.css'> 
<title>ออมทรัพย์นักเรียน</title>
<style>
.menu{background-color:; }
.menu-over{background-color:#22F942;}
</style>

</head>

<body topmargin="0" bgcolor="#F4FFF4">
<br>
<table width="1000" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#99CCFF" bgcolor="#FFFFFF">
<tr>
<td width="880" height="30" bgcolor="#0066FF"><font color="#FFFFFF"><?php echo $t2;?>ออมทรัพย์นักเรียน</font></td>
</tr>
  <tr>
    <td>
	  <form name="form1" action="?option=savings&&task=report_all_exit" method="post" enctype="multipart/form-data">
	<table width="1000" border="0">
      <tr>
        <td width="101" rowspan="3" align="center" valign="middle"><img src='modules/savings/iconS/logoS.jpg' width='65' height='80' border='0'></td>
        <td width="889" align="center"><strong>รายงาน</strong><br>
        ระบบออมทรัพย์นักเรียน</td>
        </tr>
      <tr>
        <td height="35" align="center">ออมทรัพย์นักเรียน สำหรับนักเรียนที่สำเร็จการศึกษา ย้าย และออกกลางคัน<br>
          ปีการศึกษา  <?php echo $pasted;?></td>
      <tr>
        <td height="35" align="center">เลือก ปีการศึกษา : 

                  <select name="pasted" class="colortext">
                  <option value="<?php echo $pasted;?>"><?php echo $pasted;?></option>
					<?php   
						$sqlpast="SELECT DISTINCT year_past FROM savings_money  order by year_past DESC"; /*หาจำนวนปีการศึกษา*/
						$resultpast=mysql_query($sqlpast); 
						$past=1;			
						while($rowspast=mysql_fetch_array($resultpast))
						{
						echo"<option value='".$rowspast['year_past']."'>".$rowspast['year_past']."</option>";
							$past++;
							}
		?>
        </select>
		<?php echo $t2;?><input type="submit" name="submitS"  value="แสดงรายงาน"   /></td>
        </tr>
    </table>
    </form>
    </td>
  </tr>
  <tr>
    <td  valign="top">
	<table width="1000" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="163" rowspan="2" align="center" valign="middle" bgcolor="#76CEEB">ระดับชั้น</td>
        <td width="102" rowspan="2" align="center" valign="middle" bgcolor="#76CEEB">จำนวนนักเรียน</td>
        <td colspan="2" align="center" valign="middle" bgcolor="#76CEEB"><strong>ฝาก</strong><br>
          ปีการศึกษา
<?php echo $pasted;?></td>
        <td colspan="2" align="center" valign="middle" bgcolor="#76CEEB"><strong>ถอน</strong><br>
          ปีการศึกษา <?php echo $pasted;?></td>
        <td width="108" rowspan="2" align="center" valign="middle" bgcolor="#76CEEB">คงเหลือสุทธิ<br>
          ปีการศึกษา
          <?php echo $pasted;?></td>
        <td width="107" rowspan="2" align="center" valign="middle" bgcolor="#76CEEB">รายละเอียด</td>
        </tr>
      <tr>
        <td width="135" align="center" valign="middle" bgcolor="#76CEEB">จำนวนครั้งที่ฝาก</td>
        <td width="130" align="center" valign="middle" bgcolor="#76CEEB">รวมเงินฝาก</td>
        <td width="131" align="center" valign="middle" bgcolor="#76CEEB">จำนวนครั้งที่ถอน</td>
        <td width="108" align="center" valign="middle" bgcolor="#76CEEB">รวมเงินถอน</td>
      </tr>      
     <?php 
					$sqlCK="SELECT* FROM student_main_class order by id ASC"; /*หาระดับชั้น student_main_class*/
					$resultCK=mysql_query($sqlCK); 
				$bg="";
					  $num=1;
				while($recordCK=mysql_fetch_array($resultCK))
					{	
   			$sqlSM="SELECT DISTINCT room FROM student_main  WHERE class_now='$recordCK[class_code]' AND status!='0' order by room ASC"; /*หาจำนวนห้อง*/
						$resultSM=mysql_query($sqlSM); 
						$lp=1;			
						while($recordSM=mysql_fetch_array($resultSM))
							{	
					$sqlsd="SELECT  * FROM student_main  WHERE class_now='$recordCK[class_code]' AND status!='0' AND room='$recordSM[room]'"; /*หาคนทั้งหมดในห้องนั้นๆ*/
						$resultsd=mysql_query($sqlsd); 
						$check_room_sd=mysql_num_rows($resultsd);		/* จำนวนนักเรียนทั้งหมด status!=0*/			
						$person=1;			
						while($recordsd=mysql_fetch_array($resultsd))
					{	
					if($recordsd['status']!=0){
						$sqlsave="SELECT  * FROM savings_money  WHERE level_class='$recordCK[class_code]' AND std_id='$recordsd[student_id]' AND room='$recordSM[room]' AND year_past='$pasted' AND acc_type='1'";
						$resultssave=mysql_query($sqlsave); 
						$check_room_save=mysql_num_rows($resultssave);	/* จำนวนนักเรียนที่ฝากเงิน*/			
					//	$save_total=mysql_fetch_array($resultssave);
						
						$sqldraw="SELECT  * FROM savings_money  WHERE level_class='$recordCK[class_code]' AND std_id='$recordsd[student_id]' AND room='$recordSM[room]' AND year_past='$pasted' AND acc_type='2'";
						$resultsdraw=mysql_query($sqldraw); 
						$check_room_draw=mysql_num_rows($resultsdraw);	/* จำนวนนักเรียนที่ถอนเงิน*/	
					//	$draw_total=mysql_fetch_array($resultsdraw);

		      	$sqlslw1="SELECT SUM(amount_money) AS total_PER_save FROM savings_money WHERE std_id='$recordsd[student_id]' AND year_past='$pasted' AND acc_type='1'"; /*หายอดฝาก ของคนนั้นๆ*/
		  		$resultslw1=mysql_query($sqlslw1); 
				$recordslw1=mysql_fetch_array($resultslw1);
			//	$checkslw1=mysql_num_rows($resultslw1);

         			$sqlbb="SELECT SUM(amount_money) AS total_PER_draw FROM savings_money WHERE std_id='$recordsd[student_id]' AND year_past='$pasted' AND acc_type='2'"; /*หายอดถอน ของคนนั้นๆ*/
		  		$resultbb=mysql_query($sqlbb); 
				$recordbb=mysql_fetch_array($resultbb);
			//	$checkbb=mysql_num_rows($resultbb);		
						$total_num_save = $total_num_save + $check_room_save; //รวมจำนวนคนฝาก
						$total_num_draw = $total_num_draw + $check_room_draw; //รวมจำนวนคนถอน			
						$total_sum_save = $total_sum_save + $recordslw1['total_PER_save']; /* รวมยอดเงินที่ฝากทั้งหมด*/
						$total_sum_draw = $total_sum_draw + $recordbb['total_PER_draw'];  /* รวมยอดถอนเงินทั้งหมด*/
						$total_sum = $total_sum_save - $total_sum_draw; /*ยอดเงินคงเหลือ*/
			}			
					$person++; /*หาคนทั้งหมดในห้องนั้นๆ*/
		}
		
						$total_sum_saveX = $total_sum_saveX + $total_sum_save; /* รวมยอดเงินที่ฝากทั้งหมด*/
						$total_sum_drawX =  $total_sum_drawX + $total_sum_draw;  /* รวมยอดถอนเงินทั้งหมด*/
						$total_sumX = $total_sumX + $total_sum;  /*ยอดเงินคงเหลือ*/
						$check_room_sdT = $check_room_sdT + $check_room_sd; /*จำนวนนักเรียนทั้งหมด*/
						$check_room_save_total= $check_room_save_total + $check_room_save; /*จำนวนที่ฝาก*/
						$check_room_draw_total= $check_room_draw_total + $check_room_draw; /*จำนวนที่ถอน*/

				if($bg==$cp1){
				$bg=$cp2;
				}else{
				$bg=$cp1;
				}
	  ?>
      <tr bgcolor="<?php echo $bg;?>"  onMouseOver="this.className='menu-over'" onMouseOut="this.className='menu'" class="menu">
        <td  align="left" valign="middle">&nbsp;<?php echo $recordCK['class_name'];?><?php  if($recordSM['room']!=0){?>/<?php echo $recordSM['room'];?><?php  } ?></td>
        <td align="center" valign="middle"><?php echo $check_room_sd;?></td>
        <td align="center" valign="middle"><?php echo $total_num_save;?></td>
        <td align="right" valign="middle"><?php echo number_format($total_rr,2,'.',',');?>&nbsp;</td>
        <td align="center" valign="middle"><?php echo $total_num_draw;?>&nbsp;</td>
        <td align="right" valign="middle"><?php echo number_format($total_rr2,2,'.',',');?>&nbsp;</td> 
        <td align="right" valign="middle"><?php  if($total_sum >=0){?>
          <?php echo number_format($total_sum,2,'.',',');?>
          <?php  }?>&nbsp;</td>
        <td align="center" valign="middle">[<a href="?option=savings&task=report_save_day_room_exit&level=<?php echo $recordCK['class_code'];?>&room=<?php echo $recordSM['room'];?>&pasted=<?php echo $pasted;?>" title="ดูรายละเอียด">รายละเอียด</a>]</td>
        </tr>
        <?php 
								$total_num_save = ""; //รวมจำนวนคนฝาก
								$total_num_draw = ""; //รวมจำนวนคนถอน			
								$total_sum_save = ""; /* รวมยอดเงินที่ฝากทั้งหมด*/
								$total_sum_draw = ""; /* รวมยอดถอนเงินทั้งหมด*/
		 	
			$lp++; //หาจำนวนห้องเรียนของแต่ละชั้น
		 }
		
			$num++;
					}// end num หาระดับชั้นเรียน
					
		 				?>

      <tr>
        <td height="30"  align="center" valign="middle"><strong>รวม</strong></td>
        <td  align="center" valign="middle"><strong><?php echo $check_room_sdT;?></strong></td>
        <td  align="center" valign="middle"><?php echo $check_room_save_total;?>&nbsp;</td>
        <td  align="right" valign="middle"><strong><?php  if($total_sum_saveX>=0){?> <?php echo number_format($total_sum_saveX,2,'.',',');?>
          <?php  }?></strong>&nbsp;</td>
        <td  align="center" valign="middle"><?php echo $check_room_draw_total;?>&nbsp;</td>
        <td  align="right" valign="middle"><strong>
          <?php  if($total_sum_drawX>=0){?>
          <?php echo number_format($total_sum_drawX,2,'.',',');?>
          <?php  }?>
        </strong>&nbsp;</td>
        <td  align="right" valign="middle"><strong>
          <?php  if($total_sumX>=0){?>
          <?php echo number_format($total_sumX,2,'.',',');?>
          <?php  }?>
        </strong>&nbsp;</td>
        <td  align="right" valign="middle">&nbsp;</td>
        </tr>
     
    </table>

   	</td>
  </tr>
</table>
</body>
</html>