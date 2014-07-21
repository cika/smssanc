<?php 
 include "./modules/savings/tab.php";
  ?>
  <head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel='stylesheet' href='./modules/savings/config_color.css'> 
<title>กำหนดผู้ใช้งาน</title>
</head>
  <?php 
					if(isset($_REQUEST['show'])){
						$show=$_REQUEST['show'];
						}else{
							$show="";
							}	
								
						if(isset($_REQUEST['per_id'])){
						$per_id=$_REQUEST['per_id'];
						}			
					  	/* update*/	
						if(isset($_REQUEST['submitUP'])){	
						if($_REQUEST['submitUP']=="แก้ไข")
						{
						$personal_name=$_REQUEST['personal_name'];
						$personal_position=$_REQUEST['personal_position'];
						$personal_status=$_REQUEST['personal_status'];
						 $personal_add=$_REQUEST['personal_add'];
						$personal_draw=$_REQUEST['personal_draw'];
						$per_id=$_REQUEST['per_id'];
						list($class_code_S,$per_room)=explode("/",$personal_position);
						$class_code_S;
						$per_room;
				//		$show=$_REQUEST['show'];
			$sqlcpU="SELECT* FROM savings_personal WHERE personal_code='$personal_name' AND per_position='$class_code_S' AND person_room='$per_room' AND per_id<>'$per_id'";
				$resultcpU=mysql_query($sqlcpU); 
   			 	$rowscpU=mysql_num_rows($resultcpU);
				if($rowscpU==0){
						$sql="	UPDATE  savings_personal
							SET		
								personal_code='$personal_name',
								per_position='$personal_position',
								per_status='$personal_status',
								per_add='$personal_add',
								person_room='$per_room',
								per_draw='$personal_draw'
								
							WHERE	per_id='$per_id'
							LIMIT	1	";
						$result=mysql_query($sql);
			$submitUP="";
			echo "<script>window.location='?option=savings&task=user'; </script>";
										}else{
			$submitUP="";								
			echo "<script>alert(' ระบบมีข้อมูลคุณที่เป็นครูประจำชั้นนี้อยู่แล้ว กรุณาเปลี่ยนใหม่');window.location='?option=savings&task=user'; </script>";	
					}
				}
						}
/*ADD Data*/
	if(isset($_REQUEST['submitAD'])){	
	$submitAD=$_REQUEST['submitAD'];
			if($submitAD=="บันทึก")
			{
						$personal_name=$_REQUEST['personal_name'];
						$personal_position=$_REQUEST['personal_position'];
						$personal_status=$_REQUEST['personal_status'];
						 $personal_add=$_REQUEST['personal_add'];
						$personal_draw=$_REQUEST['personal_draw'];
					//	$per_id=$_REQUEST['per_id'];
						list($class_code_S,$per_room)=explode("/",$personal_position);
						$class_code_S;
						$per_room;
					//	$show=$_REQUEST['show'];
				$sqlcp="SELECT* FROM savings_personal WHERE personal_code='$personal_name' AND per_position='$class_code_S' AND person_room='$per_room'";
				$resultcp=mysql_query($sqlcp); 
   			 	$rowscp=mysql_num_rows($resultcp);
				if($rowscp==0){
				$sql="INSERT INTO savings_personal VALUES('','$personal_name','$personal_position','$personal_status','$personal_add','$personal_draw','$per_room')";
			$result=mysql_query($sql);	
			$submitAD="";
			echo "<script>window.location='?option=savings&task=user'; </script>";
							}else{
				$submitAD="";
			echo "<script>alert(' ระบบมีข้อมูลคุณที่เป็นครูประจำชั้นนี้อยู่แล้ว กรุณาเปลี่ยนใหม่');window.location='?option=savings&task=user'; </script>";	
					}
				}
	}
		/*Delete Data*/
	if(isset($_REQUEST['show'])){		
		if($show==1)
		{
				$sqld="DELETE FROM savings_personal WHERE per_id='$per_id'";
				$result=mysql_query($sqld);		
				echo "<script>window.location='?option=savings&task=user'; </script>";
			}
	}
?>

<script>
function checkfof(form1){
					if (form1.personal_name.value == ""){
				alert('เลือก ชื่อ-สกุล');
					return false;}					
					if (form1.personal_position.value == ""){
				alert('เลือก ตำแหน่งงาน');
					return false;}					
			}
</script>
<body topmargin="0" bgcolor="#F4FFF4">
<br>
<div align="center"> <img src="./modules/savings/iconS/user.gif"></div>
<?php 
if($show==3){
?>
    <form id="form1" name="form1" method="post" action="?option=savings&task=user" enctype="multipart/form-data" onSubmit="return checkfof(this)">
    <table  border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#99CCFF" bgcolor="#FFFFFF">
    <tr><td>
      <table width="500"  border="0" align="center" cellpadding="" cellspacing="">
  <tr>
    <td height="30" align="left" bgcolor="#0066FF" class="topbg"><?php echo $t2;?>
     <font color="#FFFFFF">  เพิ่มข้อมูลผู้ใช้งาน</font></td>
  </tr>
  <tr>
    <td align="center" valign="top">

    <table width="484" border="0" align="center">
      <tr>
        <td colspan="2" align="center">&nbsp;</td>
      </tr>
      <tr>
        <td width="166" align="right" valign="middle">ชื่อ-สกุล : </td>
        <td width="280" align="left" valign="middle">  <select name="personal_name" id="personal_name" class="colortext">
        <option value=""><-------------เลือก------------> </option>
          <?php 
		 		 $sqlmainP="SELECT* FROM person_main WHERE status='0'";
				$resultmainP=mysql_query($sqlmainP); 
   			    $n1=1;
				while($rowbsmainP=mysql_fetch_array($resultmainP))
				{
					$person_id=$rowbsmainP['person_id'];
					$prename=$rowbsmainP['prename'];
					$name=$rowbsmainP['name'];
					$surname=$rowbsmainP['surname'];
					?>
					<option value="<?php echo $person_id;?>"> <?php echo $prename;?><?php echo $name;?>&nbsp;&nbsp;<?php echo $surname;?>   </option>
         		 <?php 
				}
				$n1++;
	?>
          </select>  <font size="2" color="#FF0000">*</font>        </td>
        </tr>
      <tr>
        <td align="right" valign="middle">ตำแหน่งงาน : </td>
        <td align="left" valign="middle">        
        <select name="personal_position" id="personal_position" class="colortext">
        <option value=""><---------------เลือก---------------> </option>
          <?php 
		 		 $sqlroom="SELECT  * FROM student_main_class";
				$resultroom=mysql_query($sqlroom); 
   			    $Room=1;
				while($rowroom=mysql_fetch_array($resultroom))
				{
			 $sqlCL="SELECT DISTINCT room FROM student_main  WHERE class_now='$rowroom[class_code]' order by room asc"; /*หาห้อง*/
						$resultCL=mysql_query($sqlCL); 
						$ck_rows=mysql_num_rows($resultCL);
						$CL=0;			
						while($recordCL=mysql_fetch_array($resultCL))
					{	
									?>
					<option value="<?php echo $rowroom['class_code'];?>/<?php echo $recordCL['room'];?>">ครูประจำชั้น <?php echo $rowroom['class_name'];?><?php  if($ck_rows!=0){ if($recordCL['room']!=0){ ?>/<?php echo $recordCL['room'];?><?php  } }?></option>
         		 <?php 
				 $CL++;
					}
				$Room++;					
				}
	?>
          </select> 
          <font size="2" color="#FF0000">*</font></td>
        </tr>
      
      <tr>
        <td align="right" valign="middle">สถานะใช้งาน : </td>
        <td align="left" valign="middle"><select name="personal_status" class="colortext">
        <option value="1">เปิดการใช้งาน</option>
        <option value="0">ระงับการใช้งาน</option>
        </select>
        </td>
        </tr>
      <tr>
        <td align="right">:: สิทธิในการทำงาน :: </td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="right">บันทึกออมทรัพย์ : </td>
        <td align="left"><select name="personal_add" class="colortext">
        <option value="0">ไม่</option>
        <option value="1">ใช่</option>
        </select></td>
      </tr>
      <tr>
        <td align="right">ถอนออมทรัพย์ : </td>
        <td align="left"><select name="personal_draw" class="colortext">
        <option value="0">ไม่</option>
        <option value="1">ใช่</option>
        </select></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
         <?php  
	  					$sqlSTD="SELECT * FROM student_main WHERE status='0'"; /*จำนวนนวนนักเรียน*/
						$resultSTD=mysql_query($sqlSTD); 
						$ck_STD=mysql_num_rows($resultSTD);
						if($ck_STD==0){
						?>
      <tr>
        <td align="center" colspan="2"><img src="modules/savings/iconS/bullet.gif" width="11" height="14">&nbsp;ระบบยังไม่มีข้อมูลพื้นฐานนักเรียน <br>
          กรุณาเพิ่มข้อมูลพื้นฐานนักเรียนก่อน จึงจะสามารถเพิ่มข้อมูลผู้ใช้งานได้</td>
        </tr>					
				<?php  }else{?>
      <tr>
        <td align="right"><input type="submit" name="submitAD"  value="บันทึก"></td>
        <td align="left"><input type="reset" name="ResetAD" id="button" value="ยกเลิก"></td>
        </tr>
                <?php 
		 }
		?>
    </table>
      <br></td>
  </tr>
</table>
</td></tr></table>
</form>
<?php  }?>
<?php 
/*  update */
if($show==2){
?>
    <form id="form1" name="form1" method="post" action="?option=savings&task=user" enctype="multipart/form-data" onSubmit="return checkfof(this)">   
     <table  border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#99CCFF" bgcolor="#FFFFFF">
    <tr><td>
     <table width="500" border="0" align="center">
      <tr>        
           <td colspan="2" height="30" align="left" bgcolor="#0066FF" class="topbg"><?php echo $t2;?>  <font color="#FFFFFF">แก้ไขข้อมูลผู้ใช้งาน</font>
      </tr>
         <?php 
		 		 $sqlmainPup="SELECT* FROM savings_personal WHERE per_id='$per_id'";
				$resultmainPup=mysql_query($sqlmainPup); 
   			 	$rowbsmainPup=mysql_fetch_array($resultmainPup);
				?>
      <tr>
        <td colspan="2" align="right" valign="middle">&nbsp;</td>
        </tr>
        <?php 
       $sqlmainPsw="SELECT* FROM person_main WHERE person_id='$rowbsmainPup[personal_code]'";
		$resultmainPsw=mysql_query($sqlmainPsw); 
		$rowbsmainPsw=mysql_fetch_array($resultmainPsw);
				?>
      <tr>
        <td width="234" align="right" valign="middle">ชื่อ-สกุล : </td>
        <td width="256" align="left" valign="middle"><select name="personal_name" id="personal_name" class="colortext">
        <option value="<?php echo $rowbsmainPsw['person_id'];?>"><?php echo $rowbsmainPsw['prename'];?><?php echo $rowbsmainPsw['name'];?> &nbsp;&nbsp;<?php echo $rowbsmainPsw['surname'];?></option>
          <?php 
		 		 $sqlmainP="SELECT* FROM person_main WHERE status='0'";
				$resultmainP=mysql_query($sqlmainP); 
   			    $n1=1;
				while($rowbsmainP=mysql_fetch_array($resultmainP))
				{
					$person_id=$rowbsmainP['person_id'];
					$prename=$rowbsmainP['prename'];
					$name=$rowbsmainP['name'];
					$surname=$rowbsmainP['surname'];
					?>
          <option value="<?php echo $person_id;?>">
            <?php echo $prename;?>
            <?php echo $name;?>
            &nbsp;&nbsp;
            <?php echo $surname;?>
            </option>
          <?php 
				}
				$n1++;
	?>
        </select></td>
      </tr>
           <tr>
        <td align="right" valign="middle">ตำแหน่งงาน : </td>
        <td align="left" valign="middle">        
        <select name="personal_position" id="personal_position" class="colortext">
        <?php 
		 $sqlroomA="SELECT  * FROM student_main_class WHERE class_code='$rowbsmainPup[per_position]'";
				$resultroomA=mysql_query($sqlroomA); 
				$rowroomA=mysql_fetch_array($resultroomA);
?>
        <option value="<?php echo $rowbsmainPup['per_position'];?>/<?php echo $rowbsmainPup['person_room'];?>">ครูประจำชั้น <?php echo $rowroomA['class_name'];?><?php if($rowbsmainPup['person_room']!=0){ ?>/<?php echo $rowbsmainPup['person_room'];?><?php  } ?></option>
          <?php 
		 		 $sqlroom="SELECT  * FROM student_main_class";
				$resultroom=mysql_query($sqlroom); 
   			    $Room=1;
				while($rowroom=mysql_fetch_array($resultroom))
				{
					   $sqlCL="SELECT DISTINCT room FROM student_main  WHERE class_now='$rowroom[class_code]' order by room asc"; /*หาห้อง*/
						$resultCL=mysql_query($sqlCL); 
						$ck_rows=mysql_num_rows($resultCL);
						$CL=0;			
						while($recordCL=mysql_fetch_array($resultCL))
					{	
									?>
					<option value="<?php echo $rowroom['class_code'];?>/<?php echo $recordCL['room'];?>">ครูประจำชั้น <?php echo $rowroom['class_name'];?><?php  if($ck_rows!=0){ if($recordCL['room']!=0){ ?>/<?php echo $recordCL['room'];?><?php  } }?></option>
         		 <?php 
				 $CL++;
					}
				$Room++;					
				}
	?>
          </select> 
          <font size="2" color="#FF0000">*</font></td>
        </tr>
      
      <tr>
        <td align="right" valign="middle">สถานะใช้งาน : </td>
        <td align="left" valign="middle">
        <?php 
        if($rowbsmainPup['per_status']==0){
			$ark3="ระงับการใช้งาน";
			}else{
				$ark3="เปิดการใช้งาน";
				}
		?>
        <select name="personal_status" class="colortext">
        <option value="<?php echo $rowbsmainPup['per_status'];?>"><?php echo $ark3;?></option>
        <option value="1">เปิดการใช้งาน</option>
        <option value="0">ระงับการใช้งาน</option>
        </select>
        </td>
        </tr>
      <tr>
        <td align="right">:: สิทธิในการทำงาน :: </td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="right">บันทึกออมทรัพย์ : </td>
        <td align="left">
         <?php 
        if($rowbsmainPup['per_add']==0){
			$ark4="ระงับการใช้งาน";
			}else{
				$ark4="เปิดการใช้งาน";
				}
		?>
        <select name="personal_add" class="colortext">
        <option value="<?php echo $rowbsmainPup['per_add'];?>"><?php echo $ark4;?></option>
        <option value="0">ไม่</option>
        <option value="1">ใช่</option>
        </select></td>
      </tr>
      <tr>
        <td align="right">ถอนออมทรัพย์ : </td>
        <td align="left">
          <?php 
        if($rowbsmainPup['per_draw']==0){
			$ark5="ระงับการใช้งาน";
			}else{
				$ark5="เปิดการใช้งาน";
				}
		?>
        <select name="personal_draw" class="colortext">
        <option value="<?php echo $rowbsmainPup['per_draw'];?>"><?php echo $ark5;?></option>
        <option value="0">ไม่</option>
        <option value="1">ใช่</option>
        </select></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
       <tr>
        <td align="right"><input type="submit" name="submitUP"  value="แก้ไข">
        <input type="hidden" name="per_id" value="<?php echo $rowbsmainPup['per_id'];?>">
        </td>
        <td align="left"><input type="reset" name="ResetUP" id="button" value="ยกเลิก"></td>
        </tr>
    </table>
      <br></td>
  </tr>
</table>
</td></tr></table>
</form>
<?php 
 }
 ?>

<table width="731" border="0" align="center">
  <tr align="center" valign="middle" >
    <td width="55"><input type="button" value=" เพิ่ม " name="add" onclick='location.href="?option=savings&show=3&task=user"'></td>
    <td width="140">&nbsp;</td>
    <td width="119">&nbsp;</td>
    <td width="112">&nbsp;</td>
    <td width="90">&nbsp;</td>
    <td width="90">&nbsp;</td>
    <td width="99">&nbsp;</td>
  </tr>
  <tr align="center" valign="middle" >
    <td bgcolor="#76CEEB" class="topbg">ลำดับ</td>
    <td bgcolor="#76CEEB" class="topbg">ชื่อ-สกุล</td>
    <td bgcolor="#76CEEB" class="topbg">ตำแหน่งงาน</td>
    <td bgcolor="#76CEEB" class="topbg">สถานะใช้งาน</td>
    <td bgcolor="#76CEEB" class="topbg">บันทึกออมทรัพย์</td>
    <td bgcolor="#76CEEB" class="topbg">ถอนออมทรัพย์</td>
    <td bgcolor="#76CEEB" class="topbg">จัดการ</td>
  </tr>
  <?php 
  		 $sqlS="SELECT* FROM savings_personal order by per_id desc";
		 $resultS=mysql_query($sqlS); 
 		 $Bnum=1;
		 $bg="";
		  while($recordS=mysql_fetch_array($resultS)){
			
				$c1="#DDF4F9";
			 	$c2="#FEE2FC";
				if($bg==$c1){
				$bg=$c2;
				}else{
				$bg=$c1;
				}
		 		 $sqlmainL="SELECT* FROM person_main WHERE person_id='$recordS[personal_code]'";
				$resultmainL=mysql_query($sqlmainL); 
				$rowL=mysql_fetch_array($resultmainL);
				
				 $sqlroomSS="SELECT  * FROM student_main_class WHERE class_code='$recordS[per_position]'";
				$resultroomSS=mysql_query($sqlroomSS); 
				$rowroomSS=mysql_fetch_array($resultroomSS);
  ?>
  <tr bgcolor="<?php echo $bg;?>">
    <td align="center"><?php echo $Bnum;?></td>
    <td align="left">&nbsp;<?php echo $rowL['prename'];?><?php echo $rowL['name'];?>&nbsp;&nbsp;<?php echo $rowL['surname'];?></td>
    <td align="left">ครูประจำชั้น <?php echo $rowroomSS['class_name'];?><?php  if($recordS['person_room']==0){?>&nbsp;<?php  }else{?>/<?php echo $recordS['person_room'];?><?php  }?></td>
    <td align="center"><?php  if($recordS['per_status']==1)
	{
	echo"เปิดการใช้งาน";
		}else{
		echo"ระงับการใช้งาน";
		}
	?></td>
    <td align="center"><?php  if($recordS['per_add']==1)
	{
	echo"ใช่";
		}else{
		echo"ไม่";
		}
	?></td>
    <td align="center"><?php  if($recordS['per_draw']==1)
	{
	echo"ใช่";
		}else{
		echo"ไม่";
		}
	?></td>
    <td align="center">[<a href="?option=savings&task=user&stcbase=del&per_id=<?php echo $recordS['per_id'];?>&show=1" onClick="return confirm('คุณต้องการจะลบ <?php echo $rowL['prename'];?><?php echo $rowL['name'];?>&nbsp;&nbsp;<?php echo $rowL['surname'];?>')">ลบ</a>]  [<a href="?option=savings&task=user&stcbase=up&per_id=<?php echo $recordS['per_id'];?>&show=2">แก้ไข</a>]</td>
  </tr>
  <?php  
  $Bnum++;
		  }
  ?>
</table>

</body>
</html>
