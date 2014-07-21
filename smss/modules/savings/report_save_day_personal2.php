<?php 
 include "./modules/savings/tab.php";
			$sqlbs="SELECT* FROM savings_base   WHERE status='1'";
				$resultbs=mysql_query($sqlbs); 
				$rowbs=mysql_fetch_array($resultbs);
				$Year_bs=$rowbs['study_year']; //ปีการศึกษา
				$moneySave =0;
				$moneysumdraw =0;
				$totalP =0;

			//	$level=$_REQUEST['level']; //ระดับชั้น
			//	$room=$_REQUEST['room']; // ห้องที่
				
						$dy= date('d');  //สำหรับแสดงที่หน้า page
						$my= date('m');  //สำหรับแสดงที่หน้า page
						$tt= date('Y');  //สำหรับแสดงที่หน้า page
						$yr=$tt+543; //สำหรับแสดงที่หน้า page
						if(isset($_REQUEST['pasted'])){
							$pasted=$_POST['pasted']; //ปีการศึกษา
						}else{
							$pasted = $Year_bs;				
						}
	 //สำหรับแสดงที่หน้า page		
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

						$student_id=$_SESSION['login_user_id'];
						$sqlCK="SELECT* FROM student_main  WHERE student_id='$student_id'";
						$resultCK=mysql_query($sqlCK); 
						$check_room=mysql_num_rows($resultCK);
		
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
    <td align="center">
    
	      <?php  
					$recordCK=mysql_fetch_array($resultCK);	  
		   		$sqlmain="SELECT* FROM student_main_class WHERE class_code='$recordCK[class_now]'";
				$resultmain=mysql_query($sqlmain); 
   			    $rowbsmain=mysql_fetch_array($resultmain);
				
						$sqlSM="SELECT SUM(amount_money) AS sumsave FROM savings_money  WHERE std_id='$recordCK[student_id]'&&acc_type='1'&&year_past='$pasted'";
						$resultSM=mysql_query($sqlSM);  /*&&year_past='$Year_bs'*/
						 $recordSM=mysql_fetch_array($resultSM);
						 $moneySave=$recordSM['sumsave'];  /*รวมยอดฝาก*/

			$sqlSM2="SELECT SUM(amount_money) AS sumdraw FROM savings_money  WHERE std_id='$recordCK[student_id]'&&acc_type='2'&&year_past='$pasted'";
						$resultSM2=mysql_query($sqlSM2);  /*&&year_past='$pasted'*/
						 $recordSM2=mysql_fetch_array($resultSM2);
						 $moneysumdraw=$recordSM2['sumdraw']; /*รวมยอดถอน*/
				
						$totalP=$moneySave - $moneysumdraw; /*คงเหลือของแต่ละคน*/
				?>
	      <strong>รายงาน</strong>
	<table width="880" border="0">
	  <tr>
        <td width="115" rowspan="4" align="center" valign="middle"><?php  if($recordCK['pic']!="") {?><img src='<?php echo $recordCK['pic'];?>' width='65' height='80' border='0'> <?php  }else{?><img src='modules/savings/iconS/logoS.jpg' width='65' height='80' border='0'><?php  }?></td>
     <form name="form1" action="?option=savings&&task=report_save_day_personal2" method="post" enctype="multipart/form-data">
       <td colspan="2" align="right" valign="middle">ณ ปีการศึกษา :
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
              
        <td align="center"> 
          <input type="submit" name="submitS"  value="แสดงรายงาน"   /></td>
         </form>
        <td align="center">&nbsp;</td>
        </tr>
      <tr>
        <td colspan="3" align="center">ยอดฝาก - ถอน ประจำปีการศึกษา <?php echo $pasted;?></td>
        <td align="right" bgcolor="#C7F8F8">ยอดฝากทั้งหมด :<?php  if($moneySave >= 0) {?> <?php echo number_format($moneySave,'2','.',',');?><?php  }?> บาท</td>
      </tr>  
      <tr>
        <td width="134" align="left">รหัสนักเรียน : <?php echo $recordCK['student_id'];?></td>
        <td width="219" align="left">ชื่อ-สกุล : <?php echo $recordCK['prename'];?><?php echo $recordCK['name'];?>&nbsp;&nbsp;<?php echo $recordCK['surname'];?></td>
        <td width="148" align="left">เลขที่ : <?php echo $recordCK['student_number'];?></td>
        <td align="right" bgcolor="#FCF7DA">ยอดถอนทั้งหมด : <?php  if($moneysumdraw>=0) {?><?php echo number_format($moneysumdraw,'2','.',',');?><?php  }?> บาท</td>
      </tr>
      <tr>
        <td colspan="2" align="left">ชั้น :
  <?php echo $rowbsmain['class_name'];?><?php   if($recordCK['room']!=0){ ?>/<?php echo $recordCK['room'];?><?php  } ?>
  <?php echo $t2;?>สถานะ : 
  <?php  if($recordCK['status']==0){ echo"กำลังศึกษา";}
  		else if($recordCK['status']==1){ echo"สำเร็จการศึกษา";}
		else if($recordCK['status']==2){ echo"ย้ายสถานศึกษา";}
		else if($recordCK['status']==3){ echo"ออกกลางคัน";}
		else{}
  ?>
  </td>
        <td align="left">ปีการศึกษา : <?php echo $pasted;?> </td>
        <td width="242" align="right" bgcolor="#C7F8F8">ยอดคงเหลือสุทธิ : <?php  if($totalP >= 0) {?><?php echo number_format($totalP,'2','.',',');?><?php  }?> บาท</td>
      </tr>
  </table></td>
  </tr>
  <tr>
    <td  valign="top">
	<table width="880" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="38" height="25" align="center" valign="middle" bgcolor="#76CEEB">ลำดับ</td>
        <td width="147" align="center" valign="middle" bgcolor="#76CEEB">ปีการศึกษา</td>
        <td width="213" align="center" valign="middle" bgcolor="#76CEEB">วันเดือนปี</td>
        <td width="282" align="center" valign="middle" bgcolor="#76CEEB">จำนวนยอดเงินฝาก - ถอน</td>
        <td width="188" align="center" valign="middle" bgcolor="#76CEEB">หมายเหตุ</td>
        </tr>      
         <?php 
		 $sqlLL="SELECT * FROM savings_money  WHERE std_id='$recordCK[student_id]'&&year_past='$pasted'  ORDER BY year_past,save_id ASC";
		$resultLL=mysql_query($sqlLL);  
		$bg="";
	  $num=1;
	while($recordLL=mysql_fetch_array($resultLL))
		{				
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
				$sqlacc="SELECT* FROM savings_account  WHERE acc_code='$recordLL[acc_type]'";
				$resultacc=mysql_query($sqlacc); 
   			    $rowacc=mysql_fetch_array($resultacc);
	  ?>
      <tr bgcolor="<?php echo $bg;?>"   onMouseOver="this.className='menu-over'" onMouseOut="this.className='menu'" class="menu">
        <td  align="center" valign="middle"><?php echo $num;?></td>
        <td  align="center" valign="middle"><?php echo $recordLL['year_past'];?></td>
        <td align="center" valign="middle"><?php echo $recordLL['day_act'];?>&nbsp;&nbsp;&nbsp; <?php echo $recordLL['timer'];?></td>
        <td align="right" valign="middle"><?php  if($recordLL['acc_type']==1){?><font color="#0000FF">
		<?php  }else if($recordLL['acc_type']==2){?><font color="#CC0000">
        <?php  }else if($recordLL['acc_type']==3){?><font color="#CC00FF">
        <?php  }else if($recordLL['acc_type']==4){?><font color="#990033">
        <?php  }else if($recordLL['acc_type']==5){?><font color="#FFCC00">
        <?php  }else if($recordLL['acc_type']==6){?><font color="#FF0000">
        <?php  }else{}?>
          <?php echo number_format($recordLL['amount_money'],'2','.',',');?> &nbsp;</font></td>
        <td align="center" valign="middle"><?php  if($recordLL['acc_type']==1){?><font color="#0000FF">
		<?php  }else if($recordLL['acc_type']==2){?><font color="#CC0000">
        <?php  }else if($recordLL['acc_type']==3){?><font color="#CC00FF">
        <?php  }else if($recordLL['acc_type']==4){?><font color="#990033">
        <?php  }else if($recordLL['acc_type']==5){?><font color="#FFCC00">
        <?php  }else if($recordLL['acc_type']==6){?><font color="#FF0000">
        <?php  }else{}?>
		<?php echo $rowacc['description'];?></font></td>
        </tr>
         <?php
	  $num++;
    }
		  ?>
      <tr>
        <td height="30" colspan="5"  align="center" valign="middle"><b>
      <font color="#0000FF">  ยอดฝากทั้งหมด : <?php  if($moneySave >= 0){?><?php echo number_format($moneySave,'2','.',',');?><?php  }?> บาท<?php echo $t3;?></font>
     <font color="#CC0000">   ยอดถอนทั้งหมด : <?php  if($moneysumdraw >= 0){?><?php echo number_format($moneysumdraw,'2','.',',');?><?php  }?> บาท<?php echo $t3;?></font>
      <font color="#009900">  ยอดคงเหลือสุทธิ : <?php  if($totalP >= 0){?><?php echo number_format($totalP,'2','.',',');?><?php  }?> บาท
       </font> </b></td>
        </tr>
     
    </table>

   	</td>
  </tr>
</table>
</body>
</html>