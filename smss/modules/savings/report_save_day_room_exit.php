<?php 
 include "./modules/savings/tab.php";
				$sqlbs="SELECT* FROM savings_base   WHERE status='1'";
				$resultbs=mysql_query($sqlbs); 
				$rowbs=mysql_fetch_array($resultbs);
				$Year_bs=$rowbs['study_year']; //ปีการศึกษา

		 		$moneySave =0;
		 		$moneysumdraw =0;
				$totalP =0;
				$total_s_end = 0;  /*รวมยอดฝากทั้งหมด*/
				 $total_d_end = 0; /*รวมยอดถอนทั้งหมด*/
				$total_e_end = 0; /*คงเหลือของแต่ละคนทั้งหมด*/	
				$saveed =0;
				$sumdrawed =0;
				
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
				$month_S=$my;
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

			//	if($pasted!="")
				if(isset($pasted)){
			//		{			
					if($room=="" || $room==0)		
					{
						$sqlCK="SELECT* FROM student_main  WHERE class_now='$level' && status !='0'  ORDER BY student_number ASC";
						$resultCK=mysql_query($sqlCK); 
						$check_room=mysql_num_rows($resultCK);
					}else{
							$sqlCK="SELECT* FROM student_main  WHERE class_now='$level'&&room='$room' && status !='0'  ORDER BY student_number ASC";
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
    <form name="form1" action="?option=savings&&task=report_save_day_room_exit" method="post" enctype="multipart/form-data">
      <tr>
        <td width="157">&nbsp;   </td>
        <td width="298" height="30" align="right" valign="middle">เลือก ปีการศึกษา : 
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
        </select><?php echo $t3;?></td>
        <td width="425" align="left">
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
        <td width="125" rowspan="3" align="center" valign="middle"><img src='modules/savings/iconS/logoS.jpg' width='65' height='80' border='0'></td>
        <td colspan="3" align="center"><strong>
          รายงาน</strong><br>
     
          ออมทรัพย์ ปีการศึกษา    <?php echo $pasted;?></td>
        <td width="135" rowspan="3" align="center"><a href="?option=savings&task=report_all_exit&&pasted=<?php echo $pasted;?>"><img src='modules/savings/iconS/bk.gif' border='0'></a></td>
        </tr>
        <?php
			if(isset($level)){
			$sqlmain="SELECT* FROM student_main_class WHERE class_code='$level'";
			$resultmain=mysql_query($sqlmain); 
   			$rowbsmain=mysql_fetch_array($resultmain);
			}
				?>
      <tr>
        <td colspan="3" align="left">ระดับชั้น :
          <?php if(isset($level)){ echo $rowbsmain['class_name'];?><?php if(isset($room)){   if($room!=0){ ?>/<?php echo $room;?><?php } } } ?></td>
        </tr>
      <tr>
        <td width="231">&nbsp;</td>
        <td width="168">&nbsp;</td>
        <td width="199">&nbsp;</td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td  valign="top">
	<table width="880" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="46" align="center" valign="middle" bgcolor="#76CEEB">ลำดับ</td>
        <td width="89" align="center" valign="middle" bgcolor="#76CEEB">รหัสนักเรียน</td>
        <td width="60" align="center" valign="middle" bgcolor="#76CEEB">เลขที่</td>
        <td width="260" align="center" valign="middle" bgcolor="#76CEEB">ชื่อ - สกุล</td>
        <td width="134" align="center" valign="middle" bgcolor="#76CEEB">ยอดฝากสุทธิ<br>
        ปีการศึกษา  <?php echo $pasted;?></td>
        <td width="137" align="center" valign="middle" bgcolor="#76CEEB">ยอดถอนสุทธิ<br> 
        ปีการศึกษา  <?php echo $pasted;?>
</td>
        <td width="138" align="center" valign="middle" bgcolor="#76CEEB">ยอดคงเหลือสุทธิ<br>
          ปีการศึกษา <?php echo $pasted;?></td>
        </tr>      
         <?php 
	  $num=1;
	  $bg="";
	while($recordCK=mysql_fetch_array($resultCK))
		{	
						$std_ckid=$recordCK['student_id'];
				
						$sqlSM="SELECT SUM(amount_money) AS sumsave FROM savings_money  WHERE std_id='$std_ckid'&&year_past='$pasted'&&acc_type='1'";
						$resultSM=mysql_query($sqlSM); 
						 $recordSM=mysql_fetch_array($resultSM);
						 $moneySave=$recordSM['sumsave'];  /*รวมยอดฝาก*/

$sqlSM2="SELECT SUM(amount_money) AS sumdraw FROM savings_money  WHERE std_id='$std_ckid'&&year_past='$pasted'&&acc_type='2'";
						$resultSM2=mysql_query($sqlSM2); 
						 $recordSM2=mysql_fetch_array($resultSM2);
						 $moneysumdraw=$recordSM2['sumdraw']; /*รวมยอดถอน*/
					 /****************สิ้นสุดหาจำนวนคงเหลือสุทธิ*****************/

				if($bg==$cp1){
				$bg=$cp2;
				}else{
				$bg=$cp1;
				}
				//...................................................................................
				$totalP=$moneySave - $moneysumdraw; /*คงเหลือของแต่ละคน*/
		
	  ?>
      <tr bgcolor="<?php echo $bg;?>"   onMouseOver="this.className='menu-over'" onMouseOut="this.className='menu'" class="menu">
        <td  align="center" valign="middle"><?php echo $num;?></td>
        <td align="center" valign="middle"><a href="?option=savings&task=report_save_day_personal_exit&student_id=<?php echo $recordCK['student_id'];?>&room=<?php echo $room;?>&level=<?php echo $level;?>&pasted=<?php echo $pasted;?>" title="ดูรายละเอียด <?php echo $recordCK['prename'].$recordCK['name'];?>&nbsp;&nbsp;&nbsp;<?php echo $recordCK['surname'];?>"><?php echo $recordCK['student_id'];?></a></td>
        <td align="center" valign="middle"><?php echo $recordCK['student_number'];?></td>
        <td valign="middle">&nbsp;<?php echo $recordCK['prename'].$recordCK['name'];?>&nbsp;&nbsp;&nbsp;<?php echo $recordCK['surname'];?></td>
        <td align="right" valign="middle"><?php echo number_format($moneySave,'2','.',',');?>&nbsp;</td>
        <td align="right" valign="middle"><?php echo number_format($moneysumdraw,'2','.',',');?>&nbsp;</td>
        <td align="right" valign="middle"><?php  if($totalP >=0){ echo number_format($totalP,'2','.',',');  }?>&nbsp;&nbsp;</td>
        </tr>
         <?php
				$total_s_end = $total_s_end + $moneySave;  /*รวมยอดฝากทั้งหมด*/
				 $total_d_end = $total_d_end + $moneysumdraw; /*รวมยอดถอนทั้งหมด*/
				$total_e_end = $total_e_end + $totalP; /*คงเหลือของแต่ละคนทั้งหมด*/	
	  $num++;
    }
		  ?>
      <tr>
        <td colspan="4"  align="right" valign="middle"><strong>รวมสุทธิ</strong>&nbsp;</td>
        <td  align="right" valign="middle"><strong>
          <?php if($total_s_end >=0){ echo number_format($total_s_end,'2','.',','); }?>
        </strong>&nbsp;</td>
        <td  align="right" valign="middle"><strong>
          <?php if($total_d_end >=0){ echo number_format($total_d_end,'2','.',','); }?>
        </strong>&nbsp;</td>
        <td  align="right" valign="middle"><strong>
          <?php if($total_e_end >=0){ echo number_format($total_e_end,'2','.',','); }?>
        </strong>&nbsp;</td>
        </tr>
     
    </table>

   	</td>
  </tr>
</table>
</body>
</html>