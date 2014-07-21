<?php 
  include "./modules/health/tab.php";
  	/* update*/
					if(isset($_POST['submitUP'])){
						$submitUP=$_REQUEST['submitUP'];	
						if($submitUP=="แก้ไข")
						{
						$yearb=$_REQUEST['yearb'];
						$termb=$_REQUEST['termb'];
						$idB=$_REQUEST['idB'];	
						$sql="	UPDATE  health_base
							SET		
								study_year='$yearb',
								term='$termb'
							WHERE	base_id='$idB'
							LIMIT	1	";
						$result=mysql_query($sql);
			$submitUP=="";
			echo "<script>window.location='?option=health&task=admin_year'; </script>";
			}
					}
/*ADD Data*/
if(isset($_POST['submitAD'])){
	$submitAD=$_REQUEST['submitAD'];	
			if($submitAD=="บันทึก")
			{
						$yearb=$_REQUEST['yearb'];
						$termb=$_REQUEST['termb'];
				$sql="INSERT INTO health_base VALUES('','$yearb','$termb','0')";
												$result=mysql_query($sql);	
			$submitAD=="";
			echo "<script>window.location='?option=health&task=admin_year'; </script>";
				}
}
		/*Delete Data*/
		if(isset($_REQUEST['show'])){
		$show=$_REQUEST['show'];		
		if($show==1)
		{
			$idB=$_REQUEST['idB'];	
				$sql="DELETE FROM health_base WHERE base_id='$idB'";
							$result=mysql_query($sql);		
							echo "<script>window.location='?option=health&task=admin_year'; </script>";
			}
		}
		if(isset($_REQUEST['checkU'])){
		$checkU=$_REQUEST['checkU'];	
		$idB=$_REQUEST['idB'];	
			if($checkU=="U")
			{
				/* set 0 all*/
				$sqlU="	UPDATE  health_base
							SET		
								status='0'								
							WHERE	base_id
							";
						$resultU=mysql_query($sqlU);
					/*set 1*/	
							$sqlU2="	UPDATE  health_base
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
<title>กำหนดปีการศึกษา</title>
<link rel='stylesheet' href='modules/health/css_health.css'>
<link rel='stylesheet' href='modules/health/config_color.css'>
</head>
<script>
function checkfof(form1){
	
					if (form1.yearb.value == ""){
				alert('กรอก ปีการศึกษา');
					return false;}
					
					if (form1.termb.value == ""){
				alert('กรอก ภาคเรียน');
					return false;}
			}
</script>
<script language="JavaScript">
	function chkNumber(ele)
	{
	var vchar = String.fromCharCode(event.keyCode);
	if ((vchar<'0' || vchar>'9')){
	alert('กรอกตัวเลขเท่านั้น');
	 return false; }else{
	ele.onKeyPress=vchar;}
	}
</script>
<body topmargin="0" bgcolor="#F4FFF4">
<br>
<div align="center"> <img src="./modules/health/iconH/year.gif"></div>
<?php
if(isset($_REQUEST['show'])){
	if($show==3){
?>
    <form id="form1" name="form1" method="post" action="?option=health&task=admin_year" enctype="multipart/form-data" onSubmit="return checkfof(this)">
    <table  border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#99CCFF" bgcolor="#FFFFFF">
    <tr><td>
      <table width="500"  border="0" align="center" cellpadding="" cellspacing="">
  <tr>
    <td height="30" align="left" bgcolor="#0066FF" class="topbg"><?php echo $t2;?>
     <font color="#FFFFFF">  เพิ่มข้อมูลปีการศึกษา</font></td>
  </tr>
  <tr>
    <td align="center" valign="top">

    <table width="204" border="0" align="center">
      <tr>
        <td colspan="2" align="center">&nbsp;</td>
      </tr>
      <tr>
        <td width="114" valign="middle">ปีการศึกษา :</td>
        <td width="90" align="left" valign="middle"><input name="yearb" type="text" id="yearb" size="4" maxlength="4" OnKeyPress="return chkNumber(this)"  class="colortext" />        </td>
        </tr>
      <tr>
        <td valign="middle">ภาคเรียนที่ :</td>
        <td align="left" valign="middle"><input name="termb" type="text" id="termb" size="2" maxlength="1" OnKeyPress="return chkNumber(this)" class="colortext"/>        </td>
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
<?php  }
}
/*  update */
if(isset($_REQUEST['show'])){
if($show==2){
?>
    <form id="form1" name="form1" method="post" action="?option=health&task=admin_year" enctype="multipart/form-data" onSubmit="return checkfof(this)">   
     <table  border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#99CCFF" bgcolor="#FFFFFF">
    <tr><td>
      <table width="500"  border="0" align="center" cellpadding="" cellspacing="">
  <tr>
    <td height="30" align="left" bgcolor="#0066FF" class="topbg"><?php echo $t2;?>
     <font color="#FFFFFF">  แก้ไขข้อมูลปีการศึกษา</font></td>
  </tr>
  <tr>
    <td align="center" valign="top" >
    <?php
//	if(isset($_REQUEST['idB'])){
       			$sqlB="SELECT* FROM health_base WHERE base_id='$_REQUEST[idB]'";
		   		$resultB=mysql_query($sqlB); 
		   		$recordB=mysql_fetch_array($resultB);
//	}
	?>
    <table width="204" border="0" align="center">

      <tr>
        <td colspan="2" align="center">&nbsp;</td>
      </tr>
      <tr>
        <td width="114" valign="middle">ปีการศึกษา :</td>
        <td width="90" align="left" valign="middle"><input name="yearb" type="text" id="yearb" size="4" maxlength="4" value="<?php echo $recordB['study_year'];?>" OnKeyPress="return chkNumber(this)" class="colortext"/>        </td>
        </tr>
      <tr>
        <td valign="middle">ภาคเรียนที่ :</td>
        <td align="left" valign="middle"><input name="termb" type="text" id="termb" size="2" maxlength="1" value="<?php echo $recordB['term'];?>" OnKeyPress="return chkNumber(this)"  class="colortext" />        </td>
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
		$sqlS="SELECT* FROM health_base order by base_id desc";
		$resultS=mysql_query($sqlS); 
	//	$resultS=mysql_db_query($dbname,$sqlS); 
?>
<table width="500" border="0" align="center">
  <tr align="center" valign="middle" >
    <td width="54"><input type="button" value=" เพิ่ม " name="add" onclick='location.href="?option=health&show=3&task=admin_year"'></td>
    <td width="109">&nbsp;</td>
    <td width="99">&nbsp;</td>
    <td width="126">&nbsp;</td>
    <td width="90">&nbsp;</td>
  </tr>
  <tr align="center" valign="middle" >
    <td width="54" bgcolor="#76CEEB" class="topbg">ลำดับ</td>
    <td width="109" bgcolor="#76CEEB" class="topbg">ปีการศึกษา</td>
    <td width="99" bgcolor="#76CEEB" class="topbg">ภาคเรียน</td>
    <td width="126" bgcolor="#76CEEB" class="topbg">สถานะใช้งาน</td>
    <td width="90" bgcolor="#76CEEB" class="topbg">จัดการ</td>
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
    <td align="center"><?php echo"$Bnum";?></td>
    <td align="center"><?php echo $recordS['study_year'];?></td>
    <td align="center"><?php echo $recordS['term'];?></td>
    <td align="center"><?php if($recordS['status']==1)
	{
	  echo"	<a href='?option=health&task=admin_year&idB=$recordS[base_id]&checkU=U'><img src='modules/health/iconH/yes.png' border='0'></a>";
		}else{
		echo"	<a href='?option=health&task=admin_year&idB=$recordS[base_id]&checkU=U'><img src='modules/health/iconH/no.png' border='0'></a>";
		}
	?></td>
    <td align="center"><?php  if($recordS['status']==1) { print'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';}else {?>[<a href="?option=health&task=admin_year&stcbase=del&idB=<?php echo $recordS['base_id']; ?>&show=1" onClick="return confirm('คุณต้องการจะลบ ปีการศึกษา <?php echo $recordS['study_year'];?> ภาคเรียนที่  <?php echo $recordS['term'];?> ')">ลบ</a>]<?php }?> [<a href="?option=health&task=admin_year&stcbase=up&idB=<?php echo $recordS['base_id']; ?>&show=2">แก้ไข</a>]</td>
  </tr>
  <?php
  $Bnum++;
		  }
  ?>
</table>

</body>
</html>
