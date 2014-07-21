<?php
session_start(); 
?>
<META http-equiv=Content-Type content="text/html; charset=utf-8">
<Form id='user_form' name='frm1'>
<?


$_SESSION["sd_year"]=2554;
$_SESSION["budget_year"]=2554;




$contents=file_get_contents ( "modules/plan/planproject/plan_default.php" );?><CENTER>
<textarea name="mytextarea" rows = "10" cols="100"><?php echo $contents;?></textarea></CENTER>
 <?
                    <td align="right"><b><font size="3" face="MS Sans Serif" color="#009900">รหัสโครงการ :</font></b></td>
                    <td align='left' > <input  size=4 type readonly=text name="vcode_proj" maxlength=3


echo "<p align='center'>";
echo "<input type=\"submit\" name=\"submit\" id=\"submit\" onclick='goto_url_update(1)'  class=\"button\" value=\"บันทึก\">";
echo "<input type='submit'  name=\"reset \" id=\"reset\" onclick='goto_url_update(0)'  class=\"button\" value=\"ยกเลิก\">";
?>
</form>
<script language="JavaScript">
function goto_url_update(val){
	if(val==0){
		callfrm("?option=plan&task=default");   // page ย้อนกลับ vcode_clus
	}else if(val==1){
				callfrm("?option=plan&task=planproject/plan_addyear"); }  //page ประมวลผล
						}
</script>
