<?php 
 include "./modules/savings/tab.php";
				$sqlbs="SELECT* FROM savings_base   WHERE status='1'";
				$resultbs=mysql_query($sqlbs); 
				$rowbs=mysql_fetch_array($resultbs);
				$Year_bs=$rowbs['study_year']; //ปีการศึกษา
				?>
 <html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel='stylesheet' href='./modules/savings/config_color.css'> 
<title>ออมทรัพย์นักเรียน</title>
<script>
function checkfor(form1){
	
					if (form1.level_TOP.value == ""){
				alert('เลือก ชั้น');
					return false;}
			}
	
</script>
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
<?php for($cn=1;$cn<=2;$cn++) {?>	
<SCRIPT language=JavaScript>
function check_number() {
amount_money<?php echo $cn;?>=event.keyCode
if (((amount_money<?php echo $cn;?> < 48) || (amount_money<?php echo $cn;?> > 57))&& amount_money<?php echo $cn;?> != 46) {
event.returnValue = false;
alert("ต้องเป็นตัวเลขเท่านั้น... \nกรุณาตรวจสอบข้อมูลของท่านอีกครั้ง...");
}
} 
</script>
<?php } ?>
</head>
<body topmargin="0" bgcolor="#F4FFF4">
<br>
<?php
	//save to database
			if(isset($_REQUEST['submit_send'])){
				$dy= date('d');  //สำหรับแสดงที่หน้า page
				$my= date('m');  //สำหรับแสดงที่หน้า page
				$tt= date('Y');  //สำหรับแสดงที่หน้า page
				$yr=$tt+543; //สำหรับแสดงที่หน้า page
						if($_REQUEST['submit_send']!=""){			
											$year_part=$_REQUEST['year_last']; //ปีการศึกษา
											if(isset($_REQUEST['level'])){
											$level=$_REQUEST['level']; //ระดับชั้น
											}else{
												$level="";
												}
											if(isset($_REQUEST['room'])){
												$room=$_REQUEST['room']; // ห้องที่
												}else{
												$room="";	
													}
											$dateInput=$_REQUEST['dateInput']; //วันที่บันทึก
										list($day_S2,$month_S2,$year_S2)=explode("/",$dateInput);
										$day_S2;
										$month_S2;
										$year_S2;
										$yearps2=$year_S2+543;				
											$day_start="$year_S2-$month_S2-$day_S2"; /*วันเดือนปี ที่บันทึก*/
											$day_start_ks="$day_S2/$month_S2/$year_S2"; /*วันเดือนปี ที่บันทึก*/
											$time= date('h:i:s');				
											$dateInput="$dy/$my/$tt";
		
											$check_room=$_REQUEST['check_room'];
										
										for($k=1;$k<=$check_room;$k++){		
										if($_POST["amount_money$k"] !="")		{				
																$sqlSave="INSERT INTO savings_money VALUES('','".$_POST["ID$k"]."','$year_part','".$_POST["amount_money$k"]."','$day_S2','$month_S2','$year_S2','$time','$day_start','$day_start_ks','1','$level','$room','".$_POST["ber$k"]."','$_SESSION[login_user_id]')";
														$resultSave=mysql_query($sqlSave);										
										
														/* ตรวจสอบจากตารางยอดทั้งหมด*/
														$sqltotal="SELECT* FROM savings_total   WHERE year='$year_part' AND std_id='".$_POST["ID$k"]."'";
														$resulttotal=mysql_query($sqltotal); 
														$check_total=mysql_num_rows($resulttotal);
														$rowtotal=mysql_fetch_array($resulttotal);
															if($check_total==0){
																/*เพิ่มใหม่*/
																$sqlstotal="INSERT INTO savings_total VALUES('','".$_POST["ID$k"]."','$year_part','$day_start','1')";
															$resultstotal=mysql_query($sqlstotal);	
															}			
														}
														$Test=1;
												}		
			?>
        <?php if($Test==1){  /* ถ้า Test =1 กรณีบันทึกข้อมูลออมทรัพย์แสร็จแล้ว */
										$dateInput=$_REQUEST['dateInput']; //วันที่บันทึก
										list($day_S2,$month_S2,$year_S2)=explode("/",$dateInput);
										$day_S2;
										$month_S2;
										$year_S2;
										$yearps2=$year_S2+543;	
	
							 $my = $month_S2;
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
			   $sqlmainL="SELECT* FROM student_main_class WHERE class_code='$level'";
				$resultmainL=mysql_query($sqlmainL); 
				$rowmainL=mysql_fetch_array($resultmainL);
										?>
<table width="880" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#99CCFF" bgcolor="#FFFFFF">
<tr>
<td width="880" height="30" bgcolor="#0066FF"><font color="#FFFFFF"><?php echo $t2;?>
  ระบบออมทรัพย์นักเรียน</font></td>
</tr>
  <tr>
    <td bgcolor="#EBEEFE"><div align="right">[ <a href="?option=savings&&task=add_save_day">ฝากออมทรัพย์</a> ] <font color="#00CC00"><img src="modules/savings/iconS/yes.png" width="16" height="16"><?php echo $t2;?>บันทึกข้อมูลออมทรัพย์เรียบร้อยแล้ว</font><?php echo $t2;?></div>
   <?php echo $t2;?>ปีการศึกษา : <?php echo $year_part;?><br>
<?php echo $t2;?>ชั้น :  <?php echo $rowmainL['class_name'];?><?php if($room!=0){ ?>/<?php echo $room;?><?php } ?><br>
<?php echo $t2;?>วันที่ : <?php echo $day_S2;?> <?php echo $date_show;?> <?php echo $yearps2;?><?php echo $t2;?> <br>
<?php echo $t2;?><?php echo "ผู้บันทึกข้อมูล : $_SESSION[login_name]&nbsp;$_SESSION[login_surname]";?>
<br><br></td>
  </tr>
  <tr>
    <td  valign="top">
	<table width="880" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="48" align="center" valign="middle" bgcolor="#76CEEB">ลำดับ</td>
        <td width="91" align="center" valign="middle" bgcolor="#76CEEB">รหัสนักเรียน</td>
        <td width="83" align="center" valign="middle" bgcolor="#76CEEB">เลขที่</td>
        <td width="435" align="center" valign="middle" bgcolor="#76CEEB">ชื่อ - สกุล</td>
        <td width="211" align="center" valign="middle" bgcolor="#76CEEB">จำนวนเงินฝาก (บาท)</td>
        </tr>      
      <?php 
	  $bg="";
	  $sum_report="";
	 	for($k2=1;$k2<=$check_room;$k2++){		
						if($_POST["amount_money$k2"] !="")		{	
						$sqlss="SELECT* FROM student_main  WHERE student_id='".$_POST["ID$k2"]."'";
						$resultss=mysql_query($sqlss); 
						$recordss=mysql_fetch_array($resultss);
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
      <tr bgcolor="<?php echo $bg;?>">
        <td  align="center" valign="middle"><?php echo $k2;?></td>
        <td align="center" valign="middle"><?php echo $_POST["ID$k2"];?></td>
        <td align="center" valign="middle"><?php echo $_POST["ber$k2"];?></td>
        <td valign="middle"><?php echo $recordss['prename'].$recordss['name'];?>&nbsp;&nbsp;&nbsp;<?php echo $recordss['surname'];?></td>
        <td align="center" valign="middle"><?php echo $_POST["amount_money$k2"];?></td>
        </tr>
      <?php
	  			$sum_report=$sum_report+$_POST["amount_money$k2"];
			}
    }

		  ?>
         <tr>
        <td colspan="4"  align="right" valign="middle" bgcolor="#66CCCC">รวมสุทธิ<?php echo $t2;?></td>
        <td align="center" valign="middle" bgcolor="#66CCCC"><?php echo $sum_report;?></td>
      </tr>
    </table>
		<br><br>
		<table width="300" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="center">[ <a href="?option=savings&&task=add_save_day">ฝากออมทรัพย์</a> ]</td>
    </tr>
</table>
<br><br>
   	</td>
  </tr>
</table>

<?php } /*end test*/ 
					$check_room=0;
					 $submit_send="";
					 $dateInput="";
					$Test=0;
					/*	echo "<script>alert('บันทึกรายการเสร็จเรียบร้อยแล้ว'); </script>";
					print "<meta http-equiv='refresh' content='0; '>"; */
				}else{
					 $submit_send="";	
					  $Test=0;				
						}
			}else{  /* //// if(isset($_REQUEST['submit_send'])){ */
						//end save to database  สิ้นสุดบันทึกรายการออมทรัพย์
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
				$year_last=$Year_bs;		/*ปีการศึกษา*/
				if(isset($_REQUEST['level_TOP'])){
				$level_TOP = $_REQUEST['level_TOP'];
						list($level,$room)=explode("/",$level_TOP);
						$level;
						$room;
						$Test=0;
				}else if(isset($_REQUEST['level'])){
					$level=$_REQUEST['level']; //ระดับชั้น
					$room=$_REQUEST['room']; // ห้องที่	
			//		$year=$_REQUEST['year']; //ปีการศึกษา
					$Test=0;
					}else{
						$level="";  
						$Test=0;
						$check_room=0;
						}
				$dy= date('d');  //สำหรับแสดงที่หน้า page
				$my= date('m');  //สำหรับแสดงที่หน้า page
				$tt= date('Y');  //สำหรับแสดงที่หน้า page
				$yr=$tt+543; //สำหรับแสดงที่หน้า page
				if(isset($_REQUEST['dateInput'])){
				$dateInput=$_REQUEST['dateInput']; //วันที่				
		//		if($_REQUEST['dateInput']==""){
						list($day_S,$month_S,$year_S)=explode("/",$dateInput);
						$day_S;
						$month_S;
						$year_S;
						$yearps=$year_S+543;
					}else{
				$dateInput="$dy/$my/$tt";
						list($day_S,$month_S,$year_S)=explode("/",$dateInput);
						$day_S;
						$month_S;
						$year_S;
						$yearps=$year_S+543;
			//	$dateInputBT="$year_S-$month_S-$day_S";
				}
		//		}
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

			 if($level!="")
				{		
				$sqlmenuP0="SELECT* FROM savings_personal WHERE per_position='$level' AND person_room='$room'";
				$resultmenuP0=mysql_query($sqlmenuP0); 
				$ckR=mysql_num_rows($resultmenuP0);
				$rowmenuP0=mysql_fetch_array($resultmenuP0);
 				$levelR=$rowmenuP0['per_position'];
				$roomR=$rowmenuP0['person_room'];
				if($ckR==0){
					echo "<script>alert('คุณไม่ใช่ครูประจำชั้นห้องนี้'); javascript:window.location='?option=savings&task=add_save_day'; </script>";
				}else{
					if($room=="" || $room==0)	
					{		
						$sqlCK="SELECT* FROM student_main  WHERE class_now='$level'&&room=''&&status='0' ORDER BY student_number ASC";
						$resultCK=mysql_query($sqlCK); 
						$check_room=mysql_num_rows($resultCK);
					}else
					{
						$sqlCK="SELECT* FROM student_main  WHERE class_now='$level'&&room='$room'&&status='0' ORDER BY student_number ASC";
						$resultCK=mysql_query($sqlCK); 
						$check_room=mysql_num_rows($resultCK);
						}
				}
			}
	 if($Test ==0){    ?>
<table width="880" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#99CCFF" bgcolor="#FFFFFF">
<tr>
<td width="880" height="30" bgcolor="#0066FF"><font color="#FFFFFF"><?php echo $t2;?>
  ระบบออมทรัพย์นักเรียน</font></td>
</tr>
  <tr>
    <td>
  <form name="form1" action="?option=savings&&task=add_save_day" method="post" enctype="multipart/form-data"  onSubmit="return checkfor(this)">
     <table width="866" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="208">&nbsp;&nbsp;ปีการศึกษา :
          <input name="year" type="text" id="year" value="<?php echo $year_last;?>" size="4" maxlength="4"  class="colorbk" /> <a href="?option=savings&&task=admin_year" title="คลิกเปลี่ยน ปีการศึกษา">[เปลี่ยน]</a></td>
        <td width="236">&nbsp;&nbsp;บันทึก ณ วันที่ <input type="text" name="dateInput" id="dateInput" size="15" value="<?php echo $dateInput;?>" class="colortext"  /></td>
        <td width="243" align="left">&nbsp;&nbsp;&nbsp; ชั้น :    
          <?php
		  if(isset($level)){
		 	  $sqlmain1="SELECT* FROM student_main_class WHERE class_code='$level'";
				$resultmain1=mysql_query($sqlmain1); 
				$rowmain1=mysql_fetch_array($resultmain1);
		  }
                ?>
          <select name="level_TOP" class="colortext" >
            <?php if($level =="") {?>
            <option value=""><------เลือกชั้น------></option>
            <?php }else{?>
            <option value="<?php echo $level;?>/<?php echo $room;?>">
			<?php echo $rowmain1['class_name'];?><?php if(isset($room)){ if($room!=0){ ?>/<?php echo $room; } }?>
              </option>
            <?php }?>
            <?php $sqlmenuP="SELECT* FROM savings_personal WHERE personal_code='$_SESSION[login_user_id]' order by per_position,person_room asc";
				$resultmenuP=mysql_query($sqlmenuP); 
				$wn=1;
				while($rowmenuP=mysql_fetch_array($resultmenuP))
				{
		 		 $sqlmain="SELECT* FROM student_main_class WHERE class_code='$rowmenuP[per_position]'";
				$resultmain=mysql_query($sqlmain); 
				$rowbsmain=mysql_fetch_array($resultmain);	
					$class_code=$rowbsmain['class_code']; 
					$class_name=$rowbsmain['class_name'];  
					?>
            <option value="<?php echo $class_code;?>/<?php echo $rowmenuP['person_room'];?>"><?php echo $class_name;?><?php if($rowmenuP['person_room']!=0){ ?>/<?php echo $rowmenuP['person_room'];   } ?>  </option>
            <?php $wn++;
					}
	?>
          </select></td>
        <td width="179" align="left"><input type="submit" name="submitH"  value="ค้นหา"   /></td>
        </tr>
    </table>
</form>
    </td>
  </tr>
  <tr>
    <td>
	
	<table width="880" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="118" rowspan="3" align="center" valign="middle"><img src='modules/savings/iconS/logoS.jpg' width='65' height='80' border='0'></td>
        <td colspan="3" align="center">ระบบออมทรัพย์นักเรียน</td>
        </tr>
      <tr>
        <td>ปีการศึกษา :
          <?php echo $year_last;?></td>
        <td width="378" align="left">วันที่ : <?php echo $day_S;?><?php echo $t1;?><?php echo $date_show;?><?php echo $t1;?><?php echo $yearps;?></td>
        <td align="right">&nbsp;</td>
      </tr>
      <tr>
        <td width="247">ระดับชั้น : <?php if(isset($rowmain1['class_name'])){ echo $rowmain1['class_name'];?><?php if($room!=0){ ?>/<?php echo $room;?><?php } } ?>
         </td>
        <td>จำนวน
          <?php if(isset($check_room)){ echo $check_room; } ?>
          คน</td>
        <td width="137">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td  valign="top">
	<form name="form1" action="?option=savings&&task=add_save_day" method="post" enctype="multipart/form-data">
	<table width="880" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="48" height="25" align="center" valign="middle" bgcolor="#76CEEB">ลำดับ</td>
        <td width="91" align="center" valign="middle" bgcolor="#76CEEB">รหัสนักเรียน</td>
        <td width="83" align="center" valign="middle" bgcolor="#76CEEB">เลขที่</td>
        <td width="435" align="center" valign="middle" bgcolor="#76CEEB">ชื่อ - สกุล</td>
        <td width="211" align="center" valign="middle" bgcolor="#76CEEB">จำนวนเงินฝาก (บาท)</td>
        </tr>      
      <?php 
	  if($level !=""){
	  $num=1;
	  $bg="";
	while($recordCK=mysql_fetch_array($resultCK))
		{	
				$std_ckid=$recordCK['student_id'];
				//............................................................................
				$c1="#DDF4F9";
			 	$c2="#FFCC99";
				//..............................................................................
				if($bg==$c1){
				$bg=$c2;
				}else{
				$bg=$c1;
				}
				//...................................................................................
	  ?>
      <tr bgcolor="<?php echo $bg;?>">
        <td  align="center" valign="middle"><?php echo $num;?></td>
        <td align="center" valign="middle"><?php echo $recordCK['student_id'];?></td>
        <td align="center" valign="middle"><?php echo $recordCK['student_number'];?></td>
        <td valign="middle"><?php echo $recordCK['prename'].$recordCK['name'];?>&nbsp;&nbsp;&nbsp;<?php echo $recordCK['surname'];?></td>
        <td align="center" valign="middle"><input name='amount_money<?php echo $num;?>' type='text' size='5' maxlength='7' onkeypress=check_number(); class="colortext"><input type="hidden" name="ID<?php echo $num;?>" value="<?php echo $recordCK['student_id'];?>"><input type="hidden" name="ber<?php echo $num;?>" value="<?php echo $recordCK['student_number'];?>"></td>
        </tr>
      <?php

	  $num++;
    }
	  }
		  ?>
    </table>
		<br>
  <?php
			 if($check_room==0){}else{?> 
		<table width="300" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td align="right">
	<input type="hidden" name="dateInput" value="<?php echo $dateInput;?>">
    <input type="hidden" name="room" value="<?php echo $room;?>">
    <input type="hidden" name="level" value="<?php echo $level;?>">
	<input type="hidden" name="year_last" value="<?php echo $year_last;?>">
	<input type="hidden" name="check_room" value="<?php echo $check_room;?>">
	<input type="submit" name="submit_send" value="บันทึก" onClick="return confirm('กรุณาตรวจสอบความถูกต้อง เมื่อกดยืนยันแล้วจะไม่สามารถแก้ไขข้อมูลได้อีก')"></td>
    <td align="left"><input type="reset" name="reset2" value="ยกเลิก"></td>
  </tr>
</table>
<?php 
		}?>
<br>
	  </form> 
   	</td>
  </tr>
</table>
<?php
		 }/*end $Test!=1*/ 
 } /*end  check save ////// if(isset($_REQUEST['submit_send'])){ */  ?>
</body>
</html>