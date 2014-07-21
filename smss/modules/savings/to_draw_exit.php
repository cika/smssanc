<script src="./ajax/framework.js"></script>
<script>
function ajaxCall() {
	var data = getFormData("form1");
	var URL = "./modules/savings/return_ajax_proj_exit.php";
	ajaxLoad("get", URL, data, "displayAJAX");
}
function removeOption() {
	var el = document.getElementById('student');
	while(el.length>0) {
		el.options[0] = null;
	}
}
</script>
<SCRIPT language=JavaScript>
function check_number() {
amount_draw=event.keyCode
if (((amount_draw < 48) || (amount_draw > 57))&& amount_draw != 46) {
event.returnValue = false;
alert("ต้องเป็นตัวเลขเท่านั้น... \nกรุณาตรวจสอบข้อมูลของท่านอีกครั้ง...");
}
} 
</script>
<?php 
 include "./modules/savings/tab.php";

				$dy= date('d');
				$my= date('m');
				$tt= date('Y');
				$yr=$tt+543;
				$day_start="$tt-$my-$dy"; /*วันเดือนปี ที่บันทึก*/
				$day_start_ks="$dy/$my/$tt";
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
			

				if(isset($_REQUEST['year_TOP'])){
				$year_TOP =$_REQUEST['year_TOP'];	
				}else{
				$moneySave=0;
				$moneysumdraw=0;
				$totalP=0;
					}
			
				if(isset($_REQUEST['student'])){
					$student=$_REQUEST['student']; //รหัสนักเรียน		
				if($student!="")
					{	
					/*ชื่อ*/	
					$Test=1;	
						$sqlCKN="SELECT* FROM student_main  WHERE student_id='$student'";
						$resultCKN=mysql_query($sqlCKN); 
						$recordCKN=mysql_fetch_array($resultCKN);
						$level=$recordCKN['class_now'];
						$room=$recordCKN['room'];
						$student_number=$recordCKN['student_number'];
						/*ข้อมูลเงิน*/	
						$sqlCK="SELECT* FROM savings_money  WHERE std_id='$student'";
						$resultCK=mysql_query($sqlCK); 
						$check_room=mysql_num_rows($resultCK);
						$recordCK=mysql_fetch_array($resultCK);
						
						$sqlSM="SELECT SUM(amount_money) AS sumsave FROM savings_money  WHERE std_id='$student'&&acc_type='1'";
						$resultSM=mysql_query($sqlSM); 
						 $recordSM=mysql_fetch_array($resultSM);
						 $moneySave=$recordSM['sumsave'];  /*รวมยอดฝาก*/

$sqlSM2="SELECT SUM(amount_money) AS sumdraw FROM savings_money  WHERE std_id='$student'&&acc_type='2'";
						$resultSM2=mysql_query($sqlSM2); 
						 $recordSM2=mysql_fetch_array($resultSM2);
						 $moneysumdraw=$recordSM2['sumdraw']; /*รวมยอดถอน*/
						 
						$totalP=$moneySave - $moneysumdraw; /*คงเหลือของแต่ละคน*/
						}
					$time= date('h:i:s');	
				if(isset($_REQUEST['DrawCK']))	{
					$amount_draw=$_REQUEST['amount_draw'];
					$DrawCK=$_REQUEST['DrawCK'];
				if($DrawCK==1){
				$year=$_REQUEST['year'];	  
				$sqlmenu="SELECT* FROM savings_personal WHERE per_status='1'";
				$resultmenu=mysql_query($sqlmenu); 
				$rowmenu=mysql_fetch_array($resultmenu);
				 if($rowmenu['per_status']==1) {
					 
											if($amount_draw > $totalP || $amount_draw < 0 || $amount_draw == 0)
											{																		
											echo "<script>alert('จำนวนเงินไม่เพียงพอสำหรับการถอนเงิน กรุณาตรวจสอบใหม่ ');window.location='?option=savings&&task=to_draw_exit&&student=$student&&year=$year&&year_TOP=$year';</script>";
											}else{
								$sqlSave="INSERT INTO savings_money VALUES('','$student','$year','$amount_draw','$dy','$my','$tt','$time','$day_start','$day_start_ks','2','$level','$room','$student_number','$_SESSION[login_user_id]')";
								$resultSave=mysql_query($sqlSave);	
										//		$Test=1; /*เงื่อนไข บันทึกข้อมูลแล้ว*/
												if($resultSave){	
											echo"		<table align=\"center\" width='600' border='1' cellspacing='0' cellpadding='0'  bordercolor='#99CCFF' bgcolor='#FFFFFF'>
												  <tr>
													<td align=\"left\" height=\"30\" bgcolor=\"#0066FF\"><font color=\"#FFFFFF\">$t2
  ถอนเงิน</font></td>
												  </tr>
												  <tr>
													<td>
													<div align=\"right\"><font color=\"#00CC00\"><img src=\"modules/savings/iconS/yes.png\" width=\"16\" height=\"16\">$t2 บันทึกข้อมูลถอนออมทรัพย์เรียบร้อยแล้ว</font>$t2</div><br>
&nbsp;&nbsp;&nbsp;ปีการศึกษา $year<br>
&nbsp;&nbsp;&nbsp;วันที่ $dy $date_show $yr<br><br>

</td>
 </tr>
"; 						$sqlCKN2="SELECT* FROM student_main  WHERE student_id='$student'";
						$resultCKN2=mysql_query($sqlCKN2); 
						$recordCKN2=mysql_fetch_array($resultCKN2);
						
				$sqlmain1R="SELECT* FROM student_main_class WHERE class_code='$level'";
				$resultmain1R=mysql_query($sqlmain1R); 
				$rowmain1R=mysql_fetch_array($resultmain1R);
						echo"
												  <tr>
													<td><br>
													&nbsp;&nbsp;&nbsp;รหัสนักเรียน $student<br>
													&nbsp;&nbsp;&nbsp;เลขที่ $student_number<br>
													&nbsp;&nbsp;&nbsp;ชื่อ-สกุล ".$recordCKN2['prename'].$recordCKN2['name']."&nbsp;&nbsp;&nbsp;".$recordCKN2['surname']."<br>
													&nbsp;&nbsp;&nbsp;ชั้น ".$rowmain1R['class_name']?><?php  if($room!=0){ echo"/$room";?> <?php  } echo" <br>
													&nbsp;&nbsp;&nbsp;จำนวนเงินที่ถอน  <b> <font color=\"#0000FF\">$amount_draw</font> </b>บาท<br><br><br>
						<div align=\"center\"> <a href=\"?option=savings&&task=to_draw_exit\" title='ย้อนกลับ'><img src='modules/savings/iconS/bk.gif' border='0'></a</div>
												<br><br>
														</td>
												  </tr>
												</table>
												";	
													/*	echo "<script>alert('บันทึกรายการเสร็จเรียบร้อยแล้ว'); </script>";
														print "<meta http-equiv='refresh' content='0; '>";
													*/
													$DrawCK=0;
																		}else{  /*	if($resultSave){	*/
																				echo "<script>alert('ไม่สามารถทำรายการถอนเงินออมทรัพย์ได้'); </script>";
																				print "<meta http-equiv='refresh' content='0; '>";
																			     }
																	} /*}else{*/
																}else{    /*/// if($rowmenu['per_status']==1) {*/
																		echo "<script>alert('คุณไม่มีสิทธิถอนเงินนักเรียนคนนี้'); </script>";
																		 print "<meta http-equiv='refresh' content='0; '>";
																		}
					} /*// if($DrawCK==1){ */
				} /*//if(isset($_REQUEST['DrawCK']))	{ */
				} /*if(isset($_REQUEST['student'])){*/
	?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel='stylesheet' href='./modules/savings/config_color.css'> 
<title>ออมทรัพย์นักเรียน</title>
<script>
function checkfor(form1){
	
					if (form1.year_TOP.value == ""){
				alert('เลือก ปีการศึกษา');
					return false;}
					
				if (form1.student.value == ""){
				alert('เลือกนักเรียน');
					return false;}
			}
</script> 
 <style type="text/css" media="print">
input{
display:none;
}
</style>
<style type="text/css"></style>

</head>

<body topmargin="0" bgcolor="#F4FFF4">
                    <br>
         <?php 
		 	 if(!isset($_REQUEST['DrawCK'])){
			 if(isset($level)){
//		 if($Test!=1) /*ตรวจสอบเงื่อนไข ว่าไม่ได้บันทึกข้อมูล*/
	//	 {
    		  $sqlmain1="SELECT* FROM student_main_class WHERE class_code='$level'";
				$resultmain1=mysql_query($sqlmain1); 
				$rowmain1=mysql_fetch_array($resultmain1);
				$level_show=$rowmain1['class_name'];
	}

                ?>
<table width="880" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#99CCFF" bgcolor="#FFFFFF">
<tr>
<td width="880" height="30" bgcolor="#0066FF"><font color="#FFFFFF"><?php echo $t2;?>
  ถอนเงิน สำหรับนักเรียนที่สำเร็จการศึกษา ย้ายออก และออกกลางคัน</font></td>
</tr>
  <tr>
    <td>
     <table width="866" border="0" cellspacing="0" cellpadding="0">
     <form name="form1" id="form1" action="?option=savings&&task=to_draw_exit" method="POST" enctype="multipart/form-data"  onSubmit="return checkfor(this)">
      <tr>
        <td width="288">   
           &nbsp;&nbsp;&nbsp; ปีการศึกษาที่ออก :
           <select name="year_TOP" id="year_TOP" onChange = "ajaxCall()" class="colortext">
      <?php  if($year_TOP==""){?>
	        <option value=""><----เลือก----></option>
            <?php  }else{ ?>
			 <option value="<?php echo $year_TOP;?>"> <?php echo $year_TOP;?></option>
			<?php 
				}
			    $sqlmain1="SELECT DISTINCT out_edyear FROM student_main WHERE status<>'0' order by out_edyear ASC"; /*หาปีการศึกษาที่นักเรียนจบ*/
				$resultmain1=mysql_query($sqlmain1); 
				$wn=1;
				while($rowmain1=mysql_fetch_array($resultmain1))
				{ ?>
            <option value="<?php echo $rowmain1['out_edyear'];?>"> <?php echo $rowmain1['out_edyear'];?></option>
         		 <?php 
						$wn++;
					}
	
	?>
          </select>
         <font color="#FF0000"> *</font></td>
        <td width="443" align="left">
                 <?php 
				  if(isset($student)){
    			  $sqlmain12="SELECT* FROM student_main WHERE student_id='$student'";
				$resultmain12=mysql_query($sqlmain12); 
				$rowmain12=mysql_fetch_array($resultmain12);
				  }
                ?>
        <Select  name='student' id='student' size='1'  class="colortext">
           <?php  if(!isset($student)){?>
          <option value=""><------เลือกนักเรียน------></option>
          <?php  }else{?>
            <option value="<?php echo $student;?>"> <?php echo $rowmain12['prename'];?><?php echo $rowmain12['name'];?> <?php echo $rowmain12['surname'];?></option>
          <?php  }?>
</select>
       <font color="#FF0000"> *</font>    &nbsp;&nbsp;&nbsp;<input type="submit" name="submitH"  value="ตกลง"   />          </td>
        <td width="135" align="left">&nbsp;</td>
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
        <td colspan="3" align="center">ระบบออมทรัพย์นักเรียน </td>
        </tr>
      <tr>
        <td>รหัสนักเรียน : <?php  if(isset($student)){  echo $recordCKN['student_id']; }?></td>
        <td>ชื่อ-สกุล :
          <?php  if(isset($student)){  echo $recordCKN['prename'].$recordCKN['name']; }?>
          &nbsp;&nbsp;
          <?php if(isset($student)){  echo $recordCKN['surname'];?></td>
        <td width="276">เลขที่ : <?php echo $recordCKN['student_number']; }?></td>
        </tr>
      <tr> 
        <td width="247">ปีการศึกษาที่ออก :
          <?php  if(isset($_REQUEST['year_TOP'])){  echo $_REQUEST['year_TOP']; }?></td>
        <td width="239">ระดับชั้น :
          <?php   if(isset($student)){   echo $level_show?><?php   if(isset($room)){  if($room!=0){ ?>/<?php echo $room;?><?php  } } }?></td>
        <td>&nbsp;</td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td  valign="top">
		<table width="880" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="168" height="30" align="center" valign="middle" bgcolor="#76CEEB">ยอดเงินฝาก</td>
        <td width="149" align="center" valign="middle" bgcolor="#76CEEB">ยอดถอนเงิน</td>
        <td width="119" align="center" valign="middle" bgcolor="#76CEEB">ยอดคงเหลือสุทธิ</td>
        <td width="165" align="center" valign="middle" bgcolor="#76CEEB">ยอดที่สามารถถอนได้</td>
        <td width="117" align="center" valign="middle" bgcolor="#76CEEB">จำนวนที่ต้องการถอน</td>
        <td width="148" align="center" valign="middle" bgcolor="#76CEEB">&nbsp;</td>
        </tr>      
      <?php 
		$dateyear= date('Y-m-d');	   /*วันเดือนปี ปัจจุบัน*/
?>
      <form name="formSave" action="?option=savings&&task=to_draw_exit" method="post" enctype="multipart/form-data">
      <tr bgcolor="#FFFFCC">
        <td height="30"  align="center" valign="middle"><?php echo number_format($moneySave,'2','.',',');?></td>
         <td align="center" valign="middle"><?php echo number_format($moneysumdraw,'2','.',',');?></td>
        <td align="center" valign="middle"><?php echo number_format($totalP,'2','.',',');?></td>
        <td align="center" valign="middle"><?php echo number_format($totalP,'2','.',',');?></td>
        <td align="center" valign="middle">
        <?php if($totalP > 0) {?><input type="text" name="amount_draw" size="7" onkeypress=check_number();  class="colortext"> <?php }?></td>
        <td align="center" valign="middle"><?php if($totalP > 0) {?><input type="submit" name="submitDraw" value="ถอนเงิน" onClick="return confirm('คุณต้องการที่จะถอนเงิน ?')">
          <input type="hidden" name="DrawCK" value="1">
          <input type="hidden" name="totalP" value="<?php echo $totalP;?>">
          <input type="hidden" name="year" value="<?php echo $year_TOP;?>">
          <input type="hidden" name="student" value="<?php echo $student;?>"> &nbsp;<input type="reset" name="reset" value="ยกเลิก" > <?php }else{echo"<font color='#FF0000'>* ไม่มียอดคงเหลือที่สามารถถอนได้</font>";}?></td>
        </tr>
       </form> 
    </table>

   	</td>
  </tr>
</table>
<?php
	//		 }
  } /*///////  if(!isset($_REQUEST['DrawCK'])){ */  ?>
</body>
</html>