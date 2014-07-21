<?php
if($_SESSION["budget_year"]==""){
echo "<br>";
echo "<div align='center'>";
echo "ตรวจสอบการกำหนดปีงบประมาณให้ถูกต้องก่อนค่ะ";
echo "</div>";
exit();
}

$Ybudget=$_SESSION["budget_year"];

if(!isset($vid_tegic)){
$vid_tegic="";
}
echo "<form id='frm1' name='frm1'>";
?>
<link rel="stylesheet"  href="./css/js/style.css" type="text/css"/>
<p align="center">
	<font style="background-color:palegreen;  color:red;font-size : 16px; font-family :  Arial ;font-weight: bold;"><BR>:::  เพิ่มกลยุทธ์ของโรงเรียน ปีงบประมาณ <?php echo $_SESSION['budget_year'] ?>  :::</Font>
<BR><BR>
<TABLE width="100%"  border="0" align="center" cellpadding="2" cellspacing="2" height="50">
<form id="frm1" name="frm1">
<TR>
<TD  width="50%"  valign="top"> 
<TABLE  align="center"  width="60%" border="0" borderColor="#FF0033" cellpadding="0" cellspacing="0">
	<tr > 
				<tr> 
                    <td align="right"><b><font  class="tegicfrm">กลยุทธ์ที่ :</font></b></td>
                    <td align='left'>&nbsp;<input  type="text"  name="vid_tegic" size=4 maxlength=4  value=<?php echo $vid_tegic ?>> 
					</td></tr>
				<tr> 
                    <td align="right"><b><font  class="tegicfrm">ปีงบประมาณ :</font></b></td>
                    <td align="left" >&nbsp;<input  type="text" name="vbudget_year" size=4 maxlength=4 value=<?php echo $Ybudget ?> readonly="readonly"> 
					</td></tr>	
				<tr> 
                    <td align="right"><b><font  class="tegicfrm">ชื่อกลยุทธ์  : </font></b></td>
                    <td align='left' >&nbsp;<textarea name='vstrategic' rows = '3' cols='50'></textarea>
                    </td></tr>
               </table>
		</TD>
	 </table>
 <?php
echo "<p align='center'>";
echo "	<INPUT TYPE='button' name='smb' value='บันทึก' onclick='goto_url_update(1)' class='button'>";
?>
<BR><BR>
<Table width="70%" class="frmnik">
<?php
echo   "<Tr bgcolor='#F8E874'><Td   width='8%'  valign='center'  align='center' >กลยุทธ์ที่</td>";
echo   "<Td   width='12%'   valign='center'  align='center'>ปีงบประมาณ</td>";
echo   "<Td   valign='center'  align='center' >ชื่อกลยุทธ์</td>";
echo   "<Td  width='4%'  >แก้ไข</td>";
echo   "<Td  width='4%'  >ลบ</td></tr>";
$sql = "SELECT *  FROM  plan_stregic where budget_year='$Ybudget' order by id_tegic";
$dbquery=DBfieldQuery($sql);
while ($result = mysql_fetch_array($dbquery))
	{
	$id =$result['id'];
	$id_tegic =$result['id_tegic'];
	$tegic_year =$result['budget_year'];
	$strategic = $result['strategic'];

	echo   "<Tr bgcolor='#F8E874' ><Td align='center' ><FONT size='2' face='MS Sans Serif' color='#000099'>$id_tegic</td>";
	echo   "<Td align='center' ><FONT size='2' face='MS Sans Serif' color='#000099'>$tegic_year</td>";
	echo   "<Td align='left' ><FONT size='2' face='MS Sans Serif' color='#000099'>&nbsp;&nbsp;$strategic</td>";
	echo   "<Td><div align=center><a href=?option=plan&task=planproject/plan_setgicedit&id=$id  target=  _top><img src=\"./images/b_edit.png\" WIDTH='16' HEIGHT='16' BORDER=0 ALT='แก้ไขกลยุทธ์'></a></div></Td>";

	echo   "<Td><div align=center><a href=?option=plan&task=planproject/plan_setgicadd&id=$id&mcase=3  target=  _top><img src=\"./images/b_drop.png\" WIDTH='16' HEIGHT='16' BORDER=0 ALT='ลบกลยุทธ์'></a></div></Td></Tr>";
}
?>
</FORM> <!--  <Form id='user_form' name='frm1'>  -->
</Table>
</Center>
<script>
function goto_url_update(val){
	if(val==0){
		callfrm("?option=plan");   // page ย้อนกลับ vcode_clus
	}else if(val==1){
								var v1 = document.frm1.vid_tegic.value;
								var v2 = document.frm1.vbudget_year.value;
								var v3 = document.frm1.vstrategic.value;
								 if (v1.length=="0")
									{
										alert("กรุณาใส่กลยุทธ์ที่");
										document.frm1.vid_tegic.focus();           
										return false;
									 }
									else if (v2.length==0) 
									{
										alert("กรุณาใส่ปีงบประมาณ");
										document.frm1.vbudget_year.focus();           
										return false;
									}
									else if (v3.length==0) 
									{
										alert("กรุณาใส่ชื่อกลยุทธ์");
										document.frm1.vstrategic.focus();           
										return false;
									 }
									else{
										callfrm("?option=plan&task=planproject/plan_setgicadd&mcase=1"); }  //page ประมวลผล
									} // if(val==1)
					} //goto_url_update(val)
</script>
<!-- <Form id='frm1' name='frm1'> -->