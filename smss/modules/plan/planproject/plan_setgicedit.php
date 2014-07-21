<?php
	$edit_id=$_REQUEST["id"];
	$Ybudget=$_SESSION["budget_year"];
	$sql = "SELECT *  FROM  plan_stregic where id='$edit_id'  limit 1";
	$dbquery=DBfieldQuery($sql);
    $result = mysql_fetch_array($dbquery)

?>
<link rel="stylesheet"  href="./css/js/style.css" type="text/css"/>
<p align="center">
	<font style="background-color:palegreen;  color:red;font-size : 20px; font-family :  Arial ;font-weight: bold;"><BR>:::  แก้ไขกลยุทธ์ของหน่วยงาน ปีงบประมาณ <?php echo $_SESSION['budget_year'] ?>  :::</Font>
<BR><BR>
<TABLE width="100%"  border="0" align="center" cellpadding="2" cellspacing="2" height="50">
<form id='frm1' name='frm1'>
<TR>
<TD  width="50%"  valign="top"> 
<TABLE  align="center"  width="60%" border="0" borderColor=#FF0033 cellpadding="0" cellspacing="0">
	<tr > 
				<tr> 
                    <td align="right"><b><font  class="tegicfrm">กลยุทธ์ที่ :</font></b></td>
                    <td align='left'>&nbsp;<input   type=text  name="vid_tegic" size=4 maxlength=4  value=<?php echo $result['id_tegic']?>> 
					</td></tr>
				<tr> 
                    <td align="right"><b><font  class="tegicfrm">ปีงบประมาณ :</font></b></td>
                    <td align='left' >&nbsp;<input  type=text name="vbudget_year" size=4 maxlength=4  value=<?php echo $result['budget_year']?> readonly="readonly"> 
					</td></tr>	
				<tr> 
                    <td align="right"><b><font  class="tegicfrm">ชื่อกลยุทธ์  : </font></b></td>
                    <td align='left' >&nbsp;<textarea name='vstrategic' rows = '3' cols='50'><?php echo $result['strategic'] ?></textarea>
                    </td></tr>
               </table>
		</TD>
	 </table>
 <?php
echo "<p align='center'>";
echo "<INPUT TYPE='button' name='smb' value='บันทึก' onclick='goto_url_update(1)' class='button'>&nbsp;<INPUT TYPE='button' name='smb' value='ย้อนกลับ' onclick='goto_url_update(0)' class='button'>";
?>

<script>
function goto_url_update(val){
	if(val==0){
		callfrm("?option=plan&task=planproject/plan_setgic");   // page ย้อนกลับ vcode_clus
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
										callfrm("?option=plan&task=planproject/plan_setgicadd&mcase=2&id=<?php echo $edit_id?>"); }  //page ประมวลผล
									} // if(val==1)
					} //goto_url_update(val)
</script> 
