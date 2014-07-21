<?php 
 include "./modules/savings/tab.php";
  	/* update*/
					if(isset($_POST['submitUP'])){
							$submitUP=$_REQUEST['submitUP'];	
						if($submitUP=="แก้ไข")
						{
						 $yearb=$_REQUEST['yearb'];
				
						$idB=$_REQUEST['idB'];
						$sql="	UPDATE  savings_base
							SET		
								study_year='$yearb'
							WHERE	base_id='$idB'
							LIMIT	1	";
						$result=mysql_query($sql);
			$submitUP=="";
			echo "<script>window.location='?option=savings&task=admin_year'; </script>";
			}
					}
/*ADD Data*/
			if(isset($_POST['submitAD'])){
			$submitAD=$_REQUEST['submitAD'];		
			if($submitAD=="บันทึก")
			{
						$yearb=$_REQUEST['yearb'];
				$sql="INSERT INTO savings_base VALUES('','$yearb','0')";
			$result=mysql_query($sql);	
			$submitAD=="";
			echo "<script>window.location='?option=savings&task=admin_year'; </script>";
				}
			}
			
		/*Delete Data*/
			if(isset($_REQUEST['show'])){
		$show=$_REQUEST['show'];		
		if($show==1)
		{
				$idB=$_REQUEST['idB'];	
				$sql="DELETE FROM savings_base WHERE base_id='$idB'";
							$result=mysql_query($sql);		
							echo "<script>window.location='?option=savings&task=admin_year'; </script>";
			}
			}
					if(isset($_REQUEST['checkU'])){
		$checkU=$_REQUEST['checkU'];	
		$idB=$_REQUEST['idB'];	
			if($checkU=="U")
			{
				/* set 0 all*/
				$sqlU="	UPDATE  savings_base
							SET		
								status='0'								
							WHERE	base_id
							";
						$resultU=mysql_query($sqlU);
					
					/*set 1*/	
							$sqlU2="	UPDATE  savings_base
							SET		
								status='1'								
							WHERE	base_id='$idB'
							LIMIT	1	";
						$resultU2=mysql_query($sqlU2);
				}
			}
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel='stylesheet' href='./modules/savings/config_color.css'> 
<title>ข้อมูลพื้นฐาน</title>
</head>
<script>
function checkfof(form1){
	
					if (form1.yearb.value == ""){
				alert('กรอก ปีการศึกษา');
					return false;}
			}
</script>
<SCRIPT language=JavaScript>
function check_number() {
yearb=event.keyCode
if ((yearb < 48) || (yearb > 57)) {
event.returnValue = false;
alert("ต้องเป็นตัวเลขเท่านั้น... \nกรุณาตรวจสอบข้อมูลของท่านอีกครั้ง...");
}
} 
</script>
<body topmargin="0" bgcolor="#F4FFF4">
<br>
<div align="center"> <img src="./modules/savings/iconS/year.gif"></div>
<?php
if(isset($_REQUEST['show'])){
if($show==3){
?>
    <form id="form1" name="form1" method="post" action="?option=savings&task=admin_year" enctype="multipart/form-data" onSubmit="return checkfof(this)">
    <table  border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#99CCFF" bgcolor="#FFFFFF">
    <tr><td>
      <table width="500"  border="0" align="center" cellpadding="" cellspacing="">
  <tr>
    <td height="30" align="left" bgcolor="#0066FF" class="topbg"><?php echo $t2;?>
     <font color="#FFFFFF">  เพิ่มข้อมูลพื้นฐาน</font></td>
  </tr>
  <tr>
    <td align="center" valign="top">

    <table width="204" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="2" align="center">&nbsp;</td>
      </tr>
      <tr>
        <td width="114" valign="middle">ปีการศึกษา :</td>
        <td width="90" align="left" valign="middle"><input name="yearb" type="text" id="yearb" size="4" maxlength="4" onkeypress=check_number();  class="colortext"/>        </td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="right"><input type="submit" name="submitAD"  value="บันทึก"></td>
        <td><input type="reset" name="ResetAD" id="button" value="ยกเลิก"></td>
        </tr>
    </table>
      <br></td>
  </tr>
</table>
</td></tr></table>
</form>
<?php 
		}
		}
?>
<?php
/*  update */
if(isset($_REQUEST['show'])){
if($show==2){
?>
    <form id="form1" name="form1" method="post" action="?option=savings&task=admin_year" enctype="multipart/form-data" onSubmit="return checkfof(this)">   
     <table  border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#99CCFF" bgcolor="#FFFFFF">
    <tr><td>
      <table width="500"  border="0" align="center" cellpadding="" cellspacing="">
  <tr>
    <td height="30" align="left" bgcolor="#0066FF" class="topbg"><?php echo $t2;?>
     <font color="#FFFFFF">  แก้ไขข้อมูลพื้นฐาน</font></td>
  </tr>
  <tr>
    <td align="center" valign="top" >
    <?php
       		$sqlB="SELECT* FROM savings_base WHERE base_id='$_REQUEST[idB]'";
		   		$resultB=mysql_query($sqlB); 
		   		$recordB=mysql_fetch_array($resultB);
	?>
    <table width="204" border="0" align="center" cellpadding="0" cellspacing="0">

      <tr>
        <td colspan="2" align="center">&nbsp;</td>
      </tr>
      <tr>
        <td width="114" valign="middle">ปีการศึกษา :</td>
        <td width="90" align="left" valign="middle"><input name="yearb" type="text" id="yearb" size="4" maxlength="4" value="<?php echo $recordB['study_year'];?>" onkeypress=check_number();  class="colortext">        </td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="right"><input type="submit" name="submitUP"  value="แก้ไข">
        <input type="hidden" name="idB" value="<?php echo $recordB['base_id'];?>">
        </td>
        <td><input type="reset" name="ResetUP" id="button" value="ยกเลิก"></td>
        </tr>
    </table>
      <br></td>
  </tr>
</table>
</td></tr></table>
</form>
<?php
		}
		}
?>
<?php
				 $sqlS="SELECT* FROM savings_base order by base_id desc";
		   		$resultS=mysql_query($sqlS); 
		   		
?>
<table width="500" border="0" align="center">
  <tr align="center" valign="middle" >
    <td width="69"><input type="button" value=" เพิ่ม " name="add" onclick='location.href="?option=savings&show=3&task=admin_year"'> </td>
    <td width="157">&nbsp;</td>
    <td width="122">&nbsp;</td>
    <td width="134">&nbsp;</td>
  </tr>
  <tr align="center" valign="middle" >
    <td width="69" bgcolor="#76CEEB" class="topbg">ลำดับ</td>
    <td bgcolor="#76CEEB" class="topbg">ปีการศึกษา</td>
    <td width="122" bgcolor="#76CEEB" class="topbg">สถานะใช้งาน</td>
    <td width="134" bgcolor="#76CEEB" class="topbg">จัดการ</td>
  </tr>
  <?php
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
  ?>
  <tr bgcolor="<?php echo $bg;?>">
    <td align="center"><?php echo $Bnum;?></td>
    <td align="center"><?php echo $recordS['study_year'];?></td>
    <td align="center"><?php if($recordS['status']==1)
	{
	echo"	<a href='?option=savings&task=admin_year&idB=$recordS[0]&checkU=U'><img src='modules/savings/iconS/yes.png' border='0'></a>";
		}else{
		echo"	<a href='?option=savings&task=admin_year&idB=$recordS[0]&checkU=U'><img src='modules/savings/iconS/no.png' border='0'></a>";
		}
	?></td>
    <td align="center"><?php if($recordS['status']==1) { print'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';}else {?>[<a href="?option=savings&task=admin_year&stcbase=del&idB=<?php echo $recordS['base_id'];?>&show=1" onClick="return confirm('คุณต้องการจะลบ ปีการศึกษา <?php echo $recordS['study_year'];?> ')">ลบ</a>]<?php }?> [<a href="?option=savings&task=admin_year&stcbase=up&idB=<?php echo $recordS['base_id'];?>&show=2">แก้ไข</a>]</td>
  </tr>
  <?php 
  $Bnum++;
		  }
  ?>
</table>

</body>
</html>
