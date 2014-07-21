<?php 
 include "./modules/health/tab.php";
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel='stylesheet' href='./modules/health/config_color.css'> 
<title>ตรวจสุขภาพนักเรียน</title>
</head>
<?php
  if(isset($_REQUEST['room']))  {
				$room=$_REQUEST['room'];
	 }else{			
	 $room="";
	 }
	  if(isset($_REQUEST['level']))  {
				$level=$_REQUEST['level'];
	  }else{
		   $level="";
		  }
		    if(isset($_REQUEST['checkN']))  {
				$checkN=$_REQUEST['checkN'];
			}else{
					$checkN="";
	  }
	  
				$sqlB="SELECT* FROM health_base WHERE status='1'";
		  		$resultB=mysql_query($sqlB); 
				$recordB=mysql_fetch_array($resultB);
				$year=$recordB['study_year'];
				$term=$recordB['term'];
				$conl="";  /*ตรวจสอบปุ่มแก้ไข disable*/

		  if(isset($_REQUEST['level_TOP']))  {
				$level_TOP=$_REQUEST['level_TOP'];
				if($level_TOP!=""){
				list($level,$room)=explode("/",$level_TOP);
				$level;
				$room;
				}
				  if(isset($_REQUEST['year']))  {
				$year=$_REQUEST['year'];
				  }else{
					$year="";  
					  }
				 if(isset($_REQUEST['term']))  {
				$term=$_REQUEST['term'];
						}else{
				$term="";
							}
				 if(isset($_REQUEST['checkN']))  {			
				$checkN=$_REQUEST['checkN'];      
				 }else{
					 $checkN="";
					 }
		  }else if(isset($_REQUEST['update'])){
				  /* ตัวแปรพื้นฐานที่มาจากการบันทึก และแก้ไข*/
				  	  if(isset($_REQUEST['room']))  {
				$room=$_REQUEST['room'];
					  }else{
						  $room="";
						  }
				  if(isset($_REQUEST['level']))  {
				$level=$_REQUEST['level'];
				  }else{
					$level="";  
					  }
				  if(isset($_REQUEST['year']))  {
				$year=$_REQUEST['year'];
				  }else{
					$year="";  
					  }
				 if(isset($_REQUEST['term']))  {
				$term=$_REQUEST['term'];
						}else{
				$term="";
							}
				
				 if(isset($_REQUEST['checkN']))  {			
				$checkN=$_REQUEST['checkN'];      
				 }else{
					 $checkN="";
					 }
				  }else{
					  }		                                                                                                                                                                              

		/* save data check health*/
		if(isset($_REQUEST['submitC'])){      
				$submitC=$_REQUEST['submitC'];
		if($submitC=="บันทึก"){
				$room=$_REQUEST['room'];
				$level=$_REQUEST['level'];
				$year=$_REQUEST['year'];
				$term=$_REQUEST['term'];
				$checkN=$_REQUEST['checkN'];     
				$student_id2=$_REQUEST['student_id2'];	
				$student_number2=$_REQUEST['student_number2'];	
				$tt= date('Y');
				$ff=$tt+543;
				$dd= date('m-d h:i:s');
				$day="$ff-$dd";
				$gum=$_POST['gum'];
				$iodine=$_POST['iodine'];
				$tooth=$_POST['tooth'];
				$weight=$_POST['weight'];
				$tall=$_POST['tall'];
				$comment=$_POST['comment'];		
				$life=$_POST['life'];		
				$push=$_POST['push'];		
				$sit=$_POST['sit'];		
				$roll=$_POST['roll'];		
				$run=$_POST['run'];		
			$sqlSV="INSERT INTO health_checking VALUES('','$student_id2','$student_number2','$year','$term','$level','$room','$checkN','$gum','$iodine','$tooth','$weight','$tall','$comment','$day','','$life','$push','$sit','$roll','$run','".$_SESSION['login_user_id']."')";
												$resultSV=mysql_query($sqlSV);		
												$submitC="";										
														if($resultSV)
														{																			
														echo "<script>window.location='?option=health&task=checkhealth&&level=$level&&room=$room&&checkN=$checkN'; </script>";
														}else{
														echo "<script>alert('ไม่สามารถบันทึกข้อมูลได้'); javascript:window.location='?option=health&task=checkhealth&&level=$level&&room=$room&&checkN=$checkN'; </script>";
														}
									}
		}
				/*update data check*/
		if(isset($_REQUEST['s_up'])){    
				$s_up=$_REQUEST['s_up'];
				$submitU=$_REQUEST['submitU'];
					if($submitU=="แก้ไข"&&$s_up==1)
						{
				$room=$_REQUEST['room'];
				$level=$_REQUEST['level'];
				$year=$_REQUEST['year'];
				$term=$_REQUEST['term'];
				$checkN=$_REQUEST['checkN'];     
				$conl = $_REQUEST['conl'];	
				
				$id=$_REQUEST['id'];	
				$student_id2=$_REQUEST['student_id2'];	
				$tt= date('Y');
				$ff=$tt+543;
				$dd= date('m-d h:i:s');
				$day="$ff-$dd";
				$gum=$_REQUEST['gum'];
				$iodine=$_REQUEST['iodine'];
				$tooth=$_REQUEST['tooth'];
				$weight=$_REQUEST['weight'];
				$tall=$_REQUEST['tall'];
				$comment=$_REQUEST['comment'];		
				$life=$_REQUEST['life'];		
				$push=$_REQUEST['push'];		
				$sit=$_REQUEST['sit'];		
				$roll=$_REQUEST['roll'];		
				$run=$_REQUEST['run'];	
						$sqlUP="	UPDATE  health_checking
							SET		
								gum='$gum',
								iodine='$iodine',
								tooth='$tooth',
								weight='$weight',
								tall='$tall',
								comment='$comment',
								day='$day',
								life='$life',
								push='$push',
								sit='$sit',
								roll='$roll',
								run='$run',
								person_check='".$_SESSION['login_user_id']."'
							WHERE	check_id='$id'
							LIMIT	1	";
						$resultUP=mysql_query($sqlUP);
			$submitU="";
				echo "<script>window.location='?option=health&task=checkhealth&&level=$level&&room=$room&&checkN=$checkN'; </script>";
			}
		}
		// ค้นหารายชื่อนักเรียน
		if($level!="" && $checkN!="")
		{ 
				 $sqlmenuP0="SELECT* FROM health_personal WHERE per_position='$level' AND person_room='$room'";
				$resultmenuP0=mysql_query($sqlmenuP0); 
				$ckR=mysql_num_rows($resultmenuP0);
				$rowmenuP0=mysql_fetch_array($resultmenuP0);
 				$levelR=$rowmenuP0['per_position'];
				$roomR=$rowmenuP0['person_room'];
				if($ckR==0){
					echo "<script>alert('คุณไม่ใช่ครูประจำชั้นห้องนี้'); javascript:window.location='?option=health&task=checkhealth'; </script>";
				}else{
	
				$sqlCK="SELECT* FROM student_main WHERE class_now='$level'&&room='$room'&&status='0' ORDER BY student_number ASC";
		  		$resultCK=mysql_query($sqlCK); 
				$check_room=mysql_num_rows($resultCK);
				} // check room for person
			}
	?>
<script>
function checkfor(formsave){
	
					if (formsave.weight.value == ""){
				alert('กรอก น้ำหนัก');
					return false;}
				
					if (formsave.tall.value == ""){
				alert('กรอก ส่วนสูง');
					return false;}
			}
			
			function checkfor2(form1){
		
			if (form1.level_TOP.value == ""){
				alert('เลือก ระดับชั้น');
					return false;}

					if (form1.checkN.value == ""){
				alert('เลือก ครั้งที่ตรวจ');
					return false;}

			}
			
</script>
<script language="JavaScript">
	function chkNumber(ele)
	{
	var vchar = String.fromCharCode(event.keyCode);
	if ((vchar<'0' || vchar>'9') && (vchar != '.'))	{
	alert('กรอกตัวเลขเท่านั้น');
	 return false;
	  }else{
	ele.onKeyPress=vchar; }
	}
</script>
<body topmargin="0" bgcolor="#F4FFF4">
<br>

<table width="1200" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#99CCFF" bgcolor="#FFFFFF">
<tr>
<td height="30" bgcolor="#0066FF"><?php echo"$t2"; ?><font color="#FFFFFF">ตรววจสุขภาพนักเรียน</font></td>
</tr>
  <tr>
    <td>
  <form name="form1" action="?option=health&&task=checkhealth" method="post" enctype="multipart/form-data" onSubmit="return checkfor2(this)">
    <table width="1200" border="0" cellspacing="0" cellpadding="0">
    
      <tr>
        <td width="289" height="30">  &nbsp;&nbsp;&nbsp; ชั้น :
              <select name="level_TOP" class="colortext"> 
                <?php
			if(isset($_REQUEST['level_TOP'])){
				$level_TOP=$_REQUEST['level_TOP'];
				list($level,$room)=explode("/",$level_TOP);
					}else if(isset($_REQUEST['level'])){
				$room=$_REQUEST['room'];
				$level=$_REQUEST['level'];
						}else{}
				if($level!=""){
     			 $sqlmain1="SELECT* FROM student_main_class WHERE class_code='$level'";
				$resultmain1=mysql_query($sqlmain1); 
				$rowmain1=mysql_fetch_array($resultmain1);
                ?>
          <option value="<?php echo $level."/".$room; ?>"><?php echo $rowmain1['class_name']; ?><?php  if($room!=0){ ?>/<?php echo $room;  } ?></option>
          <?php
			}
		  	 	$sqlmenuP="SELECT* FROM health_personal WHERE personal_code='$_SESSION[login_user_id]'  order by per_position,person_room asc";
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
					<option value="<?php echo $class_code."/".$rowmenuP['person_room'];?> "><?php echo $class_name;  if($rowmenuP['person_room']!=0){ ?>/<?php echo $rowmenuP['person_room']; } ?></option>
         		 <?php
						$wn++;
					}
	?>
          </select> <font color="#FF0000">*</font>
          </td>
        <td width="181">&nbsp;ปีการศึกษา :
          <input name="year" type="text" id="year" value="<?php echo $year;?>" size="4" maxlength="4"  class="colorbk" /></td>
        <td width="240" align="left">ภาคเรียนที่ :
          <input name="term" type="text" id="term" value="<?php echo $term;?>" size="1" maxlength="1"  class="colorbk" /> 
         <a href="?option=health&&task=admin_year" title="คลิกเปลี่ยน ปีการศึกษาและภาคเรียน">[เปลี่ยน]</a></td>
        <td width="175">ครั้งที่ตรวจ :<select name="checkN" id="checkN" class="colortext">
               <?php if($_REQUEST['checkN']==""){?>
            <option value=""><--เลือก--></option>    
            <?php }else{?>  
             <option value="<?php echo $_REQUEST['checkN'];?>"><?php echo $_REQUEST['checkN'];?></option>    
            <?php }?>   
            <option value="1">1</option>        
            <option value="2">2</option>        
              </select> <font color="#FF0000">*</font></td>
        <td width="315" align="left">&nbsp;
          <input type="submit" name="submitH"  value="ค้นหา"   /></td>
      </tr>
    </table>
</form>
    </td>
  </tr>
  <tr>
    <td><table width="1200" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="150" rowspan="3" align="center" valign="middle"><img src='modules/health/iconH/logospt.jpg' alt='แก้ไข' width='80' height='80' border='0'></td>
        <td colspan="5" align="center" valign="middle">ระบบตรวจสุขภาพนักเรียน</td>
        </tr>
      <tr>
        <td>ปีการศึกษา :
          <?php echo $year; ?></td>
        <td>ภาคเรียนที่ : <?php echo $term;?></td>
        <td>ครั้งที่ตรวจ : <?php if(isset($checkN)){echo $checkN;} ?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td width="228">ระดับชั้น : <?php if(isset($rowmain1['class_name'])){ echo $rowmain1['class_name'];?><?php  if($room!=0){ ?>/<?php echo $room;  }} ?></td>
        <td width="177">จำนวน  <?php if(isset($check_room)){ echo $check_room; }?> คน</td>
        <td width="177">&nbsp; </td>
        <td width="141">&nbsp;</td>
        <td width="122">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td  valign="top"  height="260"><table width="1200" border="1" cellspacing="0" cellpadding="0">
      <tr bgcolor="#76CEEB">
        <td width="3%" rowspan="2" align="center" valign="middle">ลำดับ</td>
        <td width="5%" rowspan="2" align="center" valign="middle">รหัส<br>
          นักเรียน</td>
        <td width="3%" rowspan="2" align="center" valign="middle">เลขที่</td>
        <td width="16%" rowspan="2" align="center" valign="middle">ชื่อ - สกุล</td>
        <td height="20" colspan="12" align="center" valign="middle">ตรวจสุขภาพนักเรียน</td>
        </tr>
      <tr>
        <td width="4%" align="center" valign="middle" bgcolor="#76CEEB">น้ำหนัก<br>(กิโลกรัม)</td>
        <td width="4%" align="center" valign="middle" bgcolor="#76CEEB">ส่วนสูง<br>(เซนติเมตร)</td>
        <td width="11%" align="center" valign="middle" bgcolor="#76CEEB">เหงือก</td>
        <td width="5%" align="center" valign="middle" bgcolor="#76CEEB">ฟัน</td>
        <td width="8%" align="center" valign="middle" bgcolor="#76CEEB">ไอโอดีน</td>
        <td width="6%" align="center" valign="middle" bgcolor="#76CEEB">ชีพจร<br>
          ขณะพัก<br>
          (ครั้ง/นาที)</td>
        <td width="5%" align="center" valign="middle" bgcolor="#76CEEB">ดันพื้น<br>
          30 วินาที<br>
          (ครั้ง)</td>
        <td width="6%" align="center" valign="middle" bgcolor="#76CEEB">ลุกนั่ง<br>
          1 นาที<br>
          (ครั้ง/นาที)</td>
        <td width="6%" align="center" valign="middle" bgcolor="#76CEEB">นั่งงอตัว<br>
          ไปข้างหน้า<br>
          (ซม.)</td>
        <td width="5%" align="center" valign="middle" bgcolor="#76CEEB">วิ่ง 1200 เมตร<br>
          (นาที)</td>
        <td width="9%" align="center" valign="middle" bgcolor="#76CEEB">หมายเหตุ</td>
        <td width="4%" align="center" valign="middle" bgcolor="#76CEEB">&nbsp;</td>
      </tr>
      <?php 
	  if(isset($resultCK)){
	  $num=1;
	  $bg="";
	while($recordCK=mysql_fetch_array($resultCK)) /*student_main นักเรียน*/
	{
			$student_id=$recordCK['student_id'];
			$student_number2=$recordCK['student_number'];				 
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
		$sqlSR="SELECT* FROM health_checking WHERE student_id='$student_id'&&room='$room'&&class_now=$level&&year_std=$year&&term_std=$term&&number_check=$checkN";
		  		$resultSR=mysql_query($sqlSR); 
				$checkSR=mysql_num_rows($resultSR);
				$recordSR=mysql_fetch_array($resultSR);
	         if($checkSR==0) {
				 /* ตรวจสุขภาพ*/
		?> 
      <form name="formsave" action="?option=health&task=checkhealth" method="post" enctype="multipart/form-data" onSubmit="return checkfor(this)">
      <tr valign="middle" bgcolor="<?php echo"$bg";?>">
        <td  align="center"><?php echo"$num"; ?></td>
        <td align="center"><?php echo $recordCK['student_id'];?></td>
        <td align="center"><?php echo $recordCK['student_number'];?></td>
        <td>&nbsp;<?php echo $recordCK['prename'].$recordCK['name'];?> &nbsp;&nbsp;<?php echo $recordCK['surname'];?></td>
        <td align="center"><input name="weight" id="weight" type="text" size="3" maxlength="6"  OnKeyPress="return chkNumber(this)" class="colortext" /></td>
        <td align="center"><input name="tall" id="tall" type="text" size="3" maxlength="6"  OnKeyPress="return chkNumber(this)" class="colortext" /></td>
        <td align="center"><select name="gum" class="colortext" >
      <option value="ไม่มี">ไม่มี</option>
      <option value="เล็กน้อย">เล็กน้อย</option>
      <option value="ปานกลาง">ปานกลาง</option>
      <option value="รุนแรง">รุนแรง</option>
      <option value="รุนแรงต้องรีบรักษา">รุนแรงต้องรีบรักษา</option>
    </select></td>
        <td align="center"><select name="tooth" class="colortext" >
      <option value="ไม่ผุ">ไม่ผุ</option>
      <option value="ผุ" >ผุ</option>
    </select></td>
        <td align="center"><select name="iodine" class="colortext" >
      <option value="ปกติ">ปกติ</option>
      <option value="เริ่มผิดปกติ">เริ่มผิดปกติ</option>
      <option value="ผิดปกติ">ผิดปกติ</option>
    </select> </td>
        <td align="center"><input name="life" type="text" size="3" maxlength="6" id="life" OnKeyPress="return chkNumber(this)" class="colortext" /></td>
        <td align="center"><input name="push" type="text" size="3" maxlength="6" id="push" OnKeyPress="return chkNumber(this)" class="colortext" /></td>
        <td align="center"><input name="sit" type="text" size="3" maxlength="6" id="sit" OnKeyPress="return chkNumber(this)" class="colortext" /></td>
        <td align="center"><input name="roll" type="text" size="3" maxlength="6" id="roll" OnKeyPress="return chkNumber(this)" class="colortext" /></td>
        <td align="center"><input name="run" type="text" size="3" maxlength="6" id="run" OnKeyPress="return chkNumber(this)" class="colortext" /></td>
        <td align="center"><textarea name="comment" rows="2" cols="15" class="colortext" ></textarea></td>
          <td align="center">        
        <input type="hidden" name="student_id2" value="<?php echo"$student_id";?>">
        <input type="hidden" name="student_number2" value="<?php echo"$student_number2";?>">
        <input type="hidden" name="level" value="<?php echo"$level";?>">
        <input type="hidden" name="year" value="<?php echo"$year";?>">
        <input type="hidden" name="room" value="<?php echo"$room";?>">
        <input type="hidden" name="term" value="<?php echo"$term";?>">
        <input type="hidden" name="checkN" value="<?php echo"$checkN";?>">
        <input name="submitC" type="submit" value="บันทึก" />          
        </td>
      </tr>
      </form>
          <?php  }else{
			  /* แก้ไข*/
			//  $conl="";
					if(isset($_REQUEST['conl'])){
				$conl=$_REQUEST['conl']; /*ตรวจสอบการกดปุ่ม แก้ไข*/
				}
			  if($conl==$student_id){
				  $dis="&nbsp;";
				  $s_up=1;
				  }else{
				 $dis="disabled";
				  $s_up=0;
					  }
			
			  ?>
			  <form name="formupdate" action="?option=health&task=checkhealth" method="post" enctype="multipart/form-data">
      <tr valign="middle" bgcolor="<?php echo"$bg";?>">
        <td  align="center"><?php echo"$num";?></td>
        <td align="center"><?php echo $recordCK['student_id'];?></td>
        <td align="center"><?php echo$recordCK['student_number'];?></td>
        <td>&nbsp;<?php echo $recordCK['prename'].$recordCK['name'];?> &nbsp;&nbsp;<?php echo $recordCK['surname'];?></td>
        <td align="center"><input name="weight" type="text" size="3" maxlength="6" value="<?php echo $recordSR['weight'];?>"  <?php echo $dis;?> OnKeyPress="return chkNumber(this)"/></td>
        <td align="center"><input name="tall" type="text" size="3" maxlength="6" value="<?php echo $recordSR['tall'];?>" <?php echo"$dis"; ?> OnKeyPress="return chkNumber(this)" /></td>
        <td align="center"><select name="gum" <?php echo"$dis";?>>
        <option value="<?php echo $recordSR['gum'];?>"><?php echo $recordSR['gum'];?></option>
              <option value="ไม่มี">ไม่มี</option>
      <option value="เล็กน้อย">เล็กน้อย</option>
      <option value="ปานกลาง">ปานกลาง</option>
      <option value="รุนแรง">รุนแรง</option>
      <option value="รุนแรงต้องรีบรักษา">รุนแรงต้องรีบรักษา</option>
    </select></td>
        <td align="center"><select name="tooth" <?php echo"$dis";?>>
      <option value="<?php echo $recordSR['tooth'];?>"><?php echo $recordSR['tooth'];?></option>
            <option value="ไม่ผุ">ไม่ผุ</option>
      <option value="ผุ" >ผุ</option>
    </select></td>
        <td align="center"><select name="iodine" <?php echo $dis;?>>
      <option value="<?php echo $recordSR['iodine'];?>"><?php echo $recordSR['iodine'];?></option>
       <option value="ปกติ">ปกติ</option>
      <option value="เริ่มผิดปกติ">เริ่มผิดปกติ</option>
      <option value="ผิดปกติ">ผิดปกติ</option>
       </select> </td>
        <td align="center"><input name="life" type="text" size="3" maxlength="6" id="life" value="<?php echo $recordSR['life'];?>"  <?php echo $dis;?> OnKeyPress="return chkNumber(this)"/></td>
        <td align="center"><input name="push" type="text" size="3" maxlength="6" id="push" value="<?php echo $recordSR['push'];?>"  <?php echo $dis;?> OnKeyPress="return chkNumber(this)"/></td>
        <td align="center"><input name="sit" type="text" size="3" maxlength="6" id="sit" value="<?php echo $recordSR['sit'];?>"  <?php echo $dis;?> OnKeyPress="return chkNumber(this)"/></td>
        <td align="center"><input name="roll" type="text" size="3" maxlength="6" id="roll" value="<?php echo $recordSR['roll'];?>"  <?php echo $dis;?> OnKeyPress="return chkNumber(this)"/></td>
        <td align="center"><input name="run" type="text" size="3" maxlength="6" id="run" value="<?php echo $recordSR['run'];?>"  <?php echo $dis;?> OnKeyPress="return chkNumber(this)"/></td>
        <td align="center"><textarea name="comment" rows="2" cols="15" <?php echo $dis;?>><?php echo $recordSR['comment'];?></textarea></td>
          <td align="center">   
          <input type="hidden" name="id" value="<?php echo $recordSR['check_id'];?>">     
        <input type="hidden" name="student_id2" value="<?php echo $student_id;?>">
        <input type="hidden" name="level" value="<?php echo $level;?>">
        <input type="hidden" name="year" value="<?php echo $year;?>">
        <input type="hidden" name="room" value="<?php echo $room;?>">
        <input type="hidden" name="term" value="<?php echo $term;?>">
        <input type="hidden" name="checkN" value="<?php echo $checkN;?>">
        <input type="hidden" name="conl" value="<?php echo $student_id;?>">
        <input type="hidden" name="s_up" value="<?php echo $s_up;?>"> 
        <input type="hidden" name="update" value="1"> 
        <input name="submitU" type="submit" value="แก้ไข" />   
      
        </td>
      </tr>
      </form>
      <?php
 				 }
	  $num++;
      }
	  }
		  ?>
    </table></td>
  </tr>
</table>
</body>

</html>
