<?php
	defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
	error_reporting(E_ERROR);
	if($_SESSION['admin_plan']!="plan"){
	?><script>
			alert("คุณไม่มีสิทธิ์");
		</script><?php  die( 'Direct Access to this location is not allowed.  ให้เฉพาะผู้บริหาร module ' );
	}
	$vid_person=$_SESSION['login_user_id'];
	require_once("modules/plan/planproject/plan_authen.php");  //session_
?>

<html>
<META http-equiv=Content-Type content="text/html; charset=utf-8">
<body bgcolor="#cc00cc" text="#000000" link="blue" vlink="purple" alink="red">
<p align="center">
	<Font Size=4 color='#FFFFFF'><BR>:::  เพิ่มเจ้าหน้าที่ระบบการวางแผน  :::</Font>
<BR><BR>
<TABLE width="100%"  border="0" align="center" cellpadding="2" cellspacing="2" height="50">
<Form id='frm1' name='frm1'>
<TR>
<TD  width="50%"  valign="top"> 
<TABLE  align="center"  width="60%" border="0" borderColor=#FF0033 cellpadding="0" cellspacing="0">
			<tr> 
            <td align="right" ><b><font size="3" face="MS Sans Serif" color="#FFFFFF">ชื่อ - สกุล :</font></b></td>
                    <td align="left">
		<?php
		echo   "<Select  name='idperson' size='1'  STYLE=\"font-family: 'sans-serif', fantasy; font-size: 12pt; border:0px\" onChange=\"openDir( this.form )\"=>";
		echo  '<option  style="background-color:navy; color:white;"  value ="" >  # เลือกชื่อสมาชิก </option>' ;
	   require_once("dbconfig.inc.php");
			$sql = "SELECT *  FROM   person_main where status='0' order by position_code"; 
			$dbquery =DBfieldQuery($sql);
			$num_rows = mysql_num_rows($dbquery);
			while ($result = mysql_fetch_array($dbquery))
			{
				$mid_person = $result[person_id];
				$prename_perm =  trim($result[prename]);
				$name_perm =  trim($result[name]);
				$surname_perm =  trim($result[surname]);
				$myname=$prename_perm.$name_perm.'  '.$surname_perm;
				echo '<option  value="' . $result['person_id'] .'|'. $myname. '">'. $myname.'</option>'; 
			}
?>
    </Select>
                    </td></tr><tr><td colspan='2'>&nbsp;</td></tr>
		<?php
			$sql = "SELECT * FROM person_main where person_id='$vid_person' LIMIT 1 ";
			$dbquery =DBfieldQuery($sql);
			$result = mysql_fetch_array($dbquery);
			$vid_person = $result[person_id];
			if ($vid_person==$_SESSION['login_user_id']){$vid_person='#x#x#x#x#x#x#';}
				echo "	<Input Type=Hidden Name=vname_perm>";
		?>
	<tr > 
            <td align="right"  width='20%'  ><b><font size="3" face="MS Sans Serif" color="#FFFFFF">เลขประจำตัวประชาชน :</font></b></td>
                    <td  align="left"  width='30%'  > <input  size=13  type readonly=text name="vid_person" maxlength=13 value=<?php echo $vid_person?>><b><font size="3" face="MS Sans Serif" color="#FFFFFF">  13 หลัก</font></b>
					</td></tr>
				<tr> 
                    <td align="right"><b><font size="3" face="MS Sans Serif" color="#FFFFFF">add :</font></b></td>
                    <td align="left"><input  type=checkbox  name="vperm_add"  onClick="check( this.form )" ><b><font size="3" face="MS Sans Serif" color="#FFFFFF">  สิทธิ์การบันทึกข้อมูล</font></b> 
                    </td></tr>
					<tr> 
                    <td align="right"><b><font size="3" face="MS Sans Serif" color="#FFFFFF">edit :</font></b></td>
                    <td align="left"><input  type=checkbox  name="vperm_edit"  onClick="check( this.form )" ><b><font size="3" face="MS Sans Serif" color="#FFFFFF">  สิทธิ์การแก้ไขข้อมูล</font></b>
					</td></tr>
				<tr> 
                    <td align="right"><b><font size="3" face="MS Sans Serif" color="#FFFFFF">delete :</font></b></td>
                    <td align="left"><input  type=checkbox  name="vperm_dele"  onClick="check( this.form )" ><b><font size="3" face="MS Sans Serif" color="#FFFFFF">  สิทธิ์การลบข้อมูล</font></b>
					</td></tr>	
               </table>
		</TD>
	 </table>
 <?php
echo "<p align='center'>";
echo "<input type=\"submit\" name=\"submit\" id=\"submit\" onclick='goto_url_update(this.form)'  class=\"button\" value=\"บันทึก\">";
?>
<BR><BR>
<Table width="60%" Border="1" borderColor=#990000  Bgcolor="#F8E874" Face="Ms Sans Serif" text="#FFFFFF"  align="center">
<?php
echo   "<Tr bgcolor='#FFEAFF'>";
echo 	 "<Td width='9%' valign='center' align='center'>ที่</td>";
echo 	 "<Td align='center'>ชื่อ - สกุล</td>";
echo   "<Td width='12%' valign='center'  align='center' > บันทึกข้อมูล </td>";
echo   "<Td width='12%' valign='center'  align='center' > แก้ไขข้อมูล </td>";
echo   "<Td width='12%'  valign='center'  align='center' > ลบข้อมูล </td>";
echo   "<Td width='12%' align='center'><IMG SRC='images/b_usredit.png' WIDTH='16' HEIGHT='16' BORDER=0 ALT=''></td></tr>";
$sql = "SELECT *  FROM  plan_permission order by id desc";
echo "<tr>";
$i=1;
$dbquery=DBfieldQuery($sql);
while ($result = mysql_fetch_array($dbquery))
	{
	$id_person =$result['id_person'];
	$name_perm =$result['name_perm'];
	$perm_add =$result['perm_add'];
	$perm_edit =$result['perm_edit'];
	$perm_dele =$result['perm_dele'];
	echo "<Td align='center'>$i</td><Td align='left'>$name_perm</td>";
	if($result[perm_add]==1)
	echo   "<Td align='center' ><img src=\"./images/yes.png\" WIDTH='16' HEIGHT='16' BORDER=0></td>";
	else  echo "<Td>&nbsp;</td>";	
	
	if($result[perm_edit]==1)
	echo   "<Td align='center' ><img src=\"./images/yes.png\" WIDTH='16' HEIGHT='16' BORDER=0></td>";
	else echo "<Td>&nbsp;</td>";
	
	if($result[perm_dele]==1)
	echo   "<Td align='center' ><img src=\"./images/yes.png\" WIDTH='16' HEIGHT='16' BORDER=0></td>";
 	else echo  "<Td>&nbsp;</td>";	
	
	if($_SESSION['admin_plan']=="plan")
	{
	echo   "<Td><div align=center><a href=?option=plan&task=planproject/plan_deleuser&id_person=$id_person  target=  _top><img src=\"./images/b_drop.png\" WIDTH='16' HEIGHT='16' BORDER=0 ALT='ลบผู้ใช้งาน'></a></div></Td>";
	}
	else echo "<Td>&nbsp;</td>";
	echo "</tr>";
	$i++;
	}
?>
</form> <!--  <Form id='frm1' name='frm1'>  -->
</Table>
</Center>

<script language="JavaScript">
function openDir( mylist_form ) { 
	var newIndex = mylist_form.idperson.selectedIndex; 
			if(newIndex==0)
			 { // Don't display anything if first option is selected form.size.value = ""; 
			mylist_form.vid_person.value = ""; 
			 alert( "กรุณาเลือกชื่อสมาชิก!" ); 
			 return;
			 }
	mylist_form.vid_person.value = mylist_form.idperson.options[mylist_form.idperson.selectedIndex].value.split("|")[0];
	mylist_form.vname_perm.value =mylist_form.idperson.options[mylist_form.idperson.selectedIndex].value.split("|")[1];
	return ;
}
/*====================*/
function check(mylist_form)
{
	var newIndex = mylist_form.idperson.selectedIndex; 
			if(newIndex==0)
			 {
			 alert( "กรุณาเลือกชื่อสมาชิก!" ); 
			 return;
			 }
}
/*====================*/
function goto_url_update(mylist_form){
		var newIndex = mylist_form.idperson.selectedIndex; 
switch (newIndex)
	{
	case 0:
			 alert( "กรุณาเลือกชื่อสมาชิก!" ); 
			callfrm("?option=plan&task=planproject/plan_setuser"); 
			 break;
	default:
			callfrm("?option=plan&task=planproject/plan_adduser"); 
	}
	}
</script>
</body>
</html>
<!-- <Form id='user_form' name='frm1'> -->