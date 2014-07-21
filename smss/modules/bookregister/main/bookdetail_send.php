<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
<!--
.style1 {
	font-size: 12px;
}
-->
</style>
</head>
<body>

<?php
date_default_timezone_set('Asia/Bangkok');
require_once "../../../smss_connect.php";	
require_once("../../../mainfile.php");
require_once("../time_inc.php");

$user=$_SESSION['login_user_id'];

$sql = mysql_query ("SELECT * FROM  bookregister_send WHERE  ms_id='$_REQUEST[id]' ") ;
$result= mysql_fetch_array($sql) ;
		$id = $result['ms_id'];
		$year = $result['year'];
		$register_number = $result['register_number'];
		$book_no = $result['book_no'];
		$signdate = $result['signdate'];
		$book_from = $result['book_from'];
		$book_to = $result['book_to'];
		$subject = $result['subject'];
		$operation = $result['operation'];
		$comment = $result['comment'];
		$register_date = $result['register_date'];
		$ref_id = $result['ref_id'];

$signdate=thai_date_3($signdate);
$register_date=thai_date_3($register_date);

$sql_person=mysql_query ("SELECT * FROM  person_main WHERE  person_id='$result[officer]' ") ;
$result_person= mysql_fetch_array($sql_person) ;
	?>

	<div align="center">
	<table border="0" width="480" id="table1" style="border-collapse: collapse; border: 1px dotted #FF00FF; ; padding-left:4px; padding-right:4px; padding-top:1px; padding-bottom:1px" cellpadding="2" >
		<tr>
			<td bgcolor="#0000FF" colspan="2" style="border: 1px dotted #808000" align='center'><font color="#FFFFFF">
			<span lang="en-us"><font size="2">&nbsp;</font></span><font size="2">รายละเอียดหนังสือส่ง
			</font></font></td>
		</tr>
		<tr>
			<td width="449" align="left" colspan="2" style="border: 1px dotted #808000">
			<font size="2" color="#993366">&nbsp;เลขทะเบียนส่ง : </font> <FONT SIZE="2" COLOR="#9900CC"><?php echo $register_number;?></font></td>
		</tr>
		<tr>
			<td width="449" align="left" colspan="2" style="border: 1px dotted #808000">
			<font size="2" color="#993366">&nbsp;ปี : </font><FONT SIZE="2" COLOR="#9900CC"><?php echo $year;?></font> </td>
		</tr>
		<tr>
		</tr>
		<tr>
			<td width="449" align="left" colspan="2" style="border: 1px dotted #808000">
			<font size="2" color="#993366">&nbsp;วันลงทะเบียน : </font><FONT SIZE="2" COLOR="#9900CC"><?php echo $register_date;?></font> </td>
		</tr>
		<tr>
			<td width="449" align="left" colspan="2" style="border: 1px dotted #808000">
			<font size="2" color="#993366">&nbsp;ที่ : </font> <FONT SIZE="2" COLOR="#9900CC"><?php echo $book_no;?></font></td>
		</tr>
		<tr>
			<td width="449" align="left" colspan="2" style="border: 1px dotted #808000">
			<font size="2" color="#993366">&nbsp;ลงวันที่ : </font> <FONT SIZE="2" COLOR="#9900CC"><?php echo $signdate;?></font></td>
		</tr>
			<td width="449" align="left" colspan="2" style="border: 1px dotted #808000">
			<font size="2" color="#993366">&nbsp;จาก : </font> <FONT SIZE="2" COLOR="#9900CC"><?php echo $book_from;?></font></td>
		</tr>
			<td width="449" align="left" colspan="2" style="border: 1px dotted #808000">
			<font size="2" color="#993366">&nbsp;ถึง : </font> <FONT SIZE="2" COLOR="#9900CC"><?php echo $book_to;?></font></td>
		</tr>
		<tr>
			<td width="449" align="right" colspan="2" style="border: 1px dotted #808000">
			<p align="left"><font size="2" color="#993366">&nbsp;เรื่อง : </font><FONT SIZE="2" COLOR="#9900CC"><?php echo $subject;?></FONT></td>
		</tr>
		<tr>
			<td width="449" align="left" colspan="2" style="border: 1px dotted #808000">
			<font size="2" color="#993366">&nbsp;การปฏิบัติบัติ : </font> <FONT SIZE="2" COLOR="#9900CC"><?php echo $operation;?></font></td>
		</tr>
		<tr>
			<td width="449" align="left" colspan="2" style="border: 1px dotted #808000">
			<font size="2" color="#993366">&nbsp;หมายเหตุ : </font> <FONT SIZE="2" COLOR="#9900CC"><?php echo $comment;?></font></td>
		</tr>
		
	<tr>
			<td align="left" style="border: 1px dotted #808000"><font size="2" color="#993366">&nbsp;ไฟล์แนบ&nbsp;</font></td>
			<td  width="377" align="left" style="border: 1px dotted #808000">
			<div align="center">
				<table border="1" width="95%" id="table3" style="border-collapse: collapse" bordercolor=#669999 cellspacing="2" cellpadding="2">
<?php

// check file attach
$sql_file = mysql_query ("SELECT * FROM bookregister_send_filebook WHERE  ref_id = '$ref_id' ") ;
$file_num = mysql_num_rows ($sql_file) ;

if ($file_num<> 0) {
$list = 1 ;
while ($list<= $file_num&&$row= mysql_fetch_array($sql_file)) {
$file_name = $row ['file_name'] ;
$file_des = $row ['file_des'] ;

//xx
if($result['secret']==1){
				if($_SESSION['login_user_id']==$result['officer']){
				?>
									<tr>
										<td align="left">&nbsp;<FONT SIZE="2"><?php echo $list;?>. </FONT><A HREF="../upload_files2/<?php echo $file_name;?>" title="คลิกเพื่อเปิดไฟล์แนบลำดับที่ <?php echo $list;?>" target="_BLANK"><FONT SIZE="2" COLOR="#CC0099"><span style="text-decoration: none"><?php echo $file_des;?></span></FONT></A></td>
									</tr>
				<?php
				}
				else{
				?>
									<tr>
										<td align="left">&nbsp;<FONT SIZE="2"><?php echo $list;?>. </FONT><FONT SIZE="2" COLOR="#CC0099"><span style="text-decoration: none"><?php echo $file_des;?></span></FONT></td>
									</tr>
				<?php
				}
}
else{
				?>
									<tr>
										<td align="left">&nbsp;<FONT SIZE="2"><?php echo $list;?>. </FONT><A HREF="../upload_files2/<?php echo $file_name;?>" title="คลิกเพื่อเปิดไฟล์แนบลำดับที่ <?php echo $list;?>" target="_BLANK"><FONT SIZE="2" COLOR="#CC0099"><span style="text-decoration: none"><?php echo $file_des;?></span></FONT></A></td>
									</tr>
				<?php 
}
//endxx				

	$list ++ ;
	}

}else {
?>
<tr>
						<td>&nbsp;<FONT SIZE="2" COLOR="#FF0099"> ไม่มีไฟล์แนบ</FONT></td>
</tr>

<?php
}

?>

				</table>
			</div>
			</td>
		</tr>
		
		<tr>
			<td width="449" align="left" colspan="2" style="border: 1px dotted #808000">
			<font size="2" color="#993366">&nbsp;เจ้าหน้าที่ผู้ลงทะเบียน : </font><FONT SIZE="2" COLOR="#9900CC">&nbsp;<?php echo $result_person['prename'].$result_person['name'];?>&nbsp;<?php echo $result_person['surname'];?></font></td>
</tr>
	</table><BR>
</div>
<CENTER><input border="0" src="../images/button95.jpg" name="I1" width="100" height="20" type="image" onClick="javascript:window.close()">&nbsp;&nbsp;&nbsp;<A HREF="javascript:window.print()" title="พิมหน้านี้"><img border="0" src="../images/print.gif" width="25" height="25"></A></CENTER>

</body>
</html>




