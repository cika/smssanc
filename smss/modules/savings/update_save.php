<?php 
 include "./modules/savings/tab.php";
 $conl="";
 $totalP=0;
	 if(!isset($_REQUEST['year_in'])){
		//	if($year_in==""){
				$sqlbs="SELECT* FROM savings_base   WHERE status='1'";
				$resultbs=mysql_query($sqlbs); 
				$rowbs=mysql_fetch_array($resultbs);
				$Year_bs=$rowbs['study_year']; //ปีการศึกษา
			}else{
				$year_in=$_REQUEST['year_in'];
				$Year_bs = $year_in;
			}

				$dy= date('d');  //สำหรับแสดงที่หน้า page
				$my= date('m');  //สำหรับแสดงที่หน้า page
				$tt= date('Y');  //สำหรับแสดงที่หน้า page
				$yr=$tt+543; //สำหรับแสดงที่หน้า page	
				
				if(isset($_REQUEST['level_TOP'])){
						$level_TOP=$_REQUEST['level_TOP'];	
						list($level,$room)=explode("/",$level_TOP);
							$level;
							$room;
						$dateInput=$_REQUEST['dateInput']; // day
						list($day_S,$month_S,$year_S)=explode("/",$dateInput);
						$day_S;
						$month_S;
						$year_S;				
						$year_new=$year_S+543;
				}else if(isset($_REQUEST['level'])){
						$level=$_REQUEST['level']; //ระดับชั้น
						if(isset($_REQUEST['room'])){
						$room=$_REQUEST['room']; // ห้องที่
						}else{
						$room="";	
							}
						$dateInput=$_REQUEST['dateInput']; // day
						list($day_S,$month_S,$year_S)=explode("/",$dateInput);
						$day_S;
						$month_S;
						$year_S;				
						$year_new=$year_S+543;
					}else{
						 $level="";
						$dateInput="$dy/$my/$tt";
						list($day_S,$month_S,$year_S)=explode("/",$dateInput);
						$day_S;
						$month_S;
						$year_S;				
						$year_new=$year_S+543;
					}
 
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

				if(isset($_REQUEST['level_TOP'])){		
				 $sqlmenuP0="SELECT* FROM savings_personal WHERE personal_code='$_SESSION[login_user_id]'&&per_position='$level' AND person_room='$room'";
				$resultmenuP0=mysql_query($sqlmenuP0); 
				$ckR=mysql_num_rows($resultmenuP0);
				$rowmenuP0=mysql_fetch_array($resultmenuP0);
 				$levelR=$rowmenuP0['per_position'];/*ชั้น*/
				$roomR=$rowmenuP0['person_room']; /*ห้อง*/
				$statusR=$rowmenuP0['per_status']; /*สถานะ*/
				$addR=$rowmenuP0['per_add']; /*บันทึก*/
				$drawR=$rowmenuP0['per_draw']; /*ถอน*/
				if($ckR==0){
					echo "<script>alert('คุณไม่ใช่ครูประจำชั้นห้องนี้'); javascript:window.location='?option=savings&task=update_save'; </script>";
				}else if($statusR==0){
						echo "<script>alert('คุณไม่มีสิทธิในส่วนนี้'); javascript:window.location='?option=savings&task=update_save'; </script>";			
				}else if($addR==0){	
					echo "<script>alert('คุณไม่มีสิทธิในส่วนนี้'); javascript:window.location='?option=savings&task=update_save'; </script>";
				} else{
				
					if($room=="" || $room==0)		
					{
						$sqlCK="SELECT* FROM student_main  WHERE class_now='$level' AND room='0' AND status='0'  ORDER BY student_number ASC";
						$resultCK=mysql_query($sqlCK); 
						$check_room=mysql_num_rows($resultCK);
					}else{
							$sqlCK="SELECT* FROM student_main  WHERE class_now='$level'&&room='$room' AND status='0'  ORDER BY student_number ASC";
						$resultCK=mysql_query($sqlCK); 
						$check_room=mysql_num_rows($resultCK);
							}
						}
					}
						
						/***************update*****************/
							/*update data check*/
		if(isset($_REQUEST['s_up'])){
				$s_up=$_REQUEST['s_up'];
				$submitU=$_REQUEST['submitU'];				
					if($submitU=="แก้ไข"&&$s_up==1)
						{
				$id=$_REQUEST['id'];
				$save_id=$_REQUEST['save_id'];	
				$money=$_REQUEST['money'];
				$tt= date('Y');
				$ff=$tt+543;
				$dd= date('m-d h:i:s');
				$day="$ff-$dd";				

						$sqlUP="	UPDATE  savings_money
							SET		
								amount_money='$money'								
							WHERE	save_id='$save_id'
							LIMIT	1	";
						$resultUP=mysql_query($sqlUP);
			$submitU="";
			$s_up="" ;
				echo "<script>window.location='?option=savings&task=update_save&&level=$level&&room=$room&&dateInput=$dateInput&&level_TOP=$level_TOP&&year_in=$year_in'; </script>";
			}
		}
						/*****************end update*****************/
	?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel='stylesheet' href='./modules/savings/config_color.css'> 
<title>ออมทรัพย์นักเรียน</title>
<script>
			function checkfor2(form1){		
			if (form1.level_TOP.value == ""){
				alert('เลือก ชั้น');
					return false;}
			if (form1.dateInput.value == ""){
				alert('เลือก วันเดือนปี');
					return false;}
			}
</script>
<?php for($cn=1;$cn<=2;$cn++) {?>	
<SCRIPT language=JavaScript>
function check_number() {
money<?php echo $cn;?>=event.keyCode
if (((money<?php echo $cn;?> < 48) || (money<?php echo $cn;?> > 57))&& money<?php echo $cn;?> != 46) {
event.returnValue = false;
alert("ต้องเป็นตัวเลขเท่านั้น... \nกรุณาตรวจสอบข้อมูลของท่านอีกครั้ง...");
}
} 
</script>
<?php } ?>
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
    <form name="form1" action="?option=savings&&task=update_save" method="post" enctype="multipart/form-data" onSubmit="return checkfor2(this)">
      <tr>
        <td width="247">&nbsp;&nbsp;&nbsp; ชั้น :
             <?php 
			 if(isset($_REQUEST['level_TOP'])) {
     			 $sqlmain1="SELECT* FROM student_main_class WHERE class_code='$level'";
				$resultmain1=mysql_query($sqlmain1); 
				$rowmain1=mysql_fetch_array($resultmain1);
			 }
                ?>
          <select name="level_TOP" class="colortext">
          <?php  if($level_TOP =="") {?>
          <option value=""><------เลือกชั้น------></option>
          <?php  }else{?>
            <option value="<?php echo $level;?>/<?php echo $room;?>"> <?php echo $rowmain1['class_name'];?><?php   if($room!=0){ ?>/<?php echo $room;?><?php  } ?> </option>
          <?php  }?>
          <?php 
		  	 $sqlmenuP="SELECT* FROM savings_personal WHERE personal_code='$_SESSION[login_user_id]' order by per_position,person_room asc";
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
					<option value="<?php echo $class_code;?>/<?php echo $rowmenuP['person_room'];?>"><?php echo $class_name;?><?php   if($rowmenuP['person_room']!=0){ ?>/<?php echo $rowmenuP['person_room'];?><?php  } ?></option>
         		 <?php 
						$wn++;
					}
	?>
          </select>
          </td>
        <td width="198">&nbsp;เลือกวัน :
          <input type="text" name="dateInput" id="dateInput" size="15" value="<?php echo $dateInput;?>" class="colortext" /></td>
        <td width="192">ปีการศึกษา : <input type="text" name="year_in" size="3" maxlength="4" value="<?php echo $Year_bs;?>" class="colorbk"> <a href="?option=savings&&task=admin_year" title="คลิกเปลี่ยน ปีการศึกษา">[เปลี่ยน]</a></td>
        <td width="243" align="left">
        <input type="submit" name="submitS"  value="ค้นหา"   /></td>
        </tr>
     </form>   
    </table>
    </td>
  </tr>
  <tr>
    <td>
	
	<table width="880" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="118" rowspan="3" align="center" valign="middle"><img src='modules/savings/iconS/logoS.jpg' width='65' height='80' border='0'></td>
        <td colspan="4" align="center"><strong><br>
          แก้ไขข้อมูลออมทรัพย์</strong><br>
          <br>
  ปีการศึกษา <?php echo $Year_bs;?><br>
  <?php  if($dateInput!=""){?> วันที่ <?php echo $day_S;?>&nbsp;เดือน&nbsp;<?php echo $date_show;?> พ.ศ. <?php echo $year_new;?><?php  }?>
</td>
        </tr>
        <?php
		if(isset($level)){
		   $sqlmain="SELECT* FROM student_main_class WHERE class_code='$level'";
			$resultmain=mysql_query($sqlmain); 
   			$rowbsmain=mysql_fetch_array($resultmain);
		}
				?>
      <tr>
        <td colspan="2">ระดับชั้น :
          <?php if(isset($level)){ echo $rowbsmain['class_name']; }?><?php if(isset($room)){   if($room!=0){ ?>/<?php echo $room;?><?php  }  }?></td>
        <td width="219">&nbsp;</td>
        <td align="center">&nbsp;</td>
      </tr>
      <tr>
        <td width="247">&nbsp;</td>
        <td width="128">&nbsp;</td>
        <td>&nbsp;</td>
        <td width="168">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td  valign="top">
	<table width="880" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="118" height="25" align="center" valign="middle" bgcolor="#76CEEB">รหัสนักเรียน</td>
        <td width="79" align="center" valign="middle" bgcolor="#76CEEB">เลขที่</td>
        <td width="260" align="center" valign="middle" bgcolor="#76CEEB">ชื่อ - สกุล</td>
        <td width="172" align="center" valign="middle" bgcolor="#76CEEB">วัน เวลา ที่ฝาก</td>
        <td width="140" align="center" valign="middle" bgcolor="#76CEEB">จำนวนเงินฝาก</td>
        <td width="97" align="center" valign="middle" bgcolor="#76CEEB">แก้ไข</td>
        </tr>      
         <?php 
	 if(isset($_REQUEST['level_TOP'])) {
	  $num=1;
	  $bg="";
	while($recordCK=mysql_fetch_array($resultCK))
		{	
						$std_ckid=$recordCK['student_id'];
				$sqlSMU="SELECT * FROM savings_money  WHERE std_id='$std_ckid'&&year_past='$Year_bs'&&day_act='$dateInput'&&acc_type='1'";
				$resultSMU=mysql_query($sqlSMU); 
				$num2=1;
					while($recordSMU=mysql_fetch_array($resultSMU)){
						if(isset($_REQUEST['conl'])){
						 $conl=$_REQUEST['conl']; /*ตรวจสอบการกดปุ่ม แก้ไข*/
						}
			  if($conl==$std_ckid){
				  $dis="&nbsp;";
				  $s_up=1; 
				    $class_col="class='colortext'";
				  }else{
				 $dis="disabled";
				  $s_up=0;
				//  $class_col="class='colorbk'";
				$class_col="";
					  }

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
        <form name="formupdate" action="?option=savings&task=update_save" method="post" enctype="multipart/form-data">
        
      <tr bgcolor="<?php echo $bg;?>"   onMouseOver="this.className='menu-over'" onMouseOut="this.className='menu'" class="menu">
        <td  align="center" valign="middle"><?php echo $recordCK['student_id'];?></td>
        <td align="center" valign="middle"><?php echo $recordCK['student_number'];?></td>
        <td valign="middle">&nbsp;<?php echo $recordCK['prename'].$recordCK['name'];?>&nbsp;&nbsp;&nbsp;<?php echo $recordCK['surname'];?></td>
      <?php  if($recordSMU['day_act'] =="" || $recordSMU['amount_money'] == "") {
		   echo"<td align='right' valign='middle'>&nbsp;</td>
	  <td align='right' valign='middle'>&nbsp;</td>
	  <td align='right' valign='middle'>&nbsp;</td>
	  ";}else{?>
        <td align="center" valign="middle"><?php echo $recordSMU['day_act'];?>&nbsp;</td>
        <td align="right" valign="middle"><input name="money" type="text" size="5" maxlength="6" value="<?php echo $recordSMU['amount_money'];?>" <?php echo $dis;  ?> onkeypress=check_number(); <?php echo $class_col;?>/>&nbsp;</td>
        <td align="center" valign="middle">
        <input type="hidden" name="level_TOP" value="<?php echo $level_TOP;?>">
          <input type="hidden" name="save_id" value="<?php echo $recordSMU['save_id'];?>">   
         <input type="hidden" name="id" value="<?php echo $recordCK['student_id'];?>">   
         <input type="hidden" name="room" value="<?php echo $room;?>">
         <input type="hidden" name="level" value="<?php echo $level;?>">
         <input type="hidden" name="dateInput" value="<?php echo $dateInput;?>">
         <input type="hidden" name="year_in" value="<?php echo $Year_bs;?>">
           <input type="hidden" name="s_up" value="<?php echo $s_up;?>">
           <input type="hidden" name="conl" value="<?php echo $recordCK['student_id'];?>">
           <input type="submit" name="submitU" value="แก้ไข">
        </td>
        <?php  } ?>
        </tr>
        </form>
         <?php
		$totalP=$totalP + $recordSMU['amount_money']; /*รวมเงินทั้งหมด*/
			  $num2++;
    }
	  $num++;
    }
//	 }
		  ?>
      <tr>
        <td colspan="4"  align="right" valign="middle"><strong>รวมสุทธิ</strong>&nbsp;&nbsp;</td>
        <td  align="right" valign="middle"><strong>
          <?php echo number_format($totalP,'2','.',',')?>
        </strong>&nbsp;</td>
        <td  align="right" valign="middle">&nbsp;</td>
        </tr>
        <?php  } ?>
    </table>

   	</td>
  </tr>
</table>
</body>
</html>