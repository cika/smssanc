<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
//sd page 
include "modules/$_REQUEST[option]/inc.php";

$page=(isset($_REQUEST['page']))?$_REQUEST['page']:"";
$edit_year=(isset($_REQUEST['edit_year']))?$_REQUEST['edit_year']:"";
$id=(isset($_GET['id']))?$_GET['id']:"";
//ส่วนหัว
echo "<br />";

if($_SESSION['admin_student_check']!="student_check"){
	echo '<BR><center><FONT SIZE="4" COLOR="#FF0000"><B>คุณไม่ได้รับสิทธิ์การใช้งานส่วนนี้</B></FONT></center>';
}else{
if(!(($index==1) or ($index==2) or ($index==5))){
	echo "<table width='50%' border='0' align='center'>";
	echo "<tr align='center'><td><font color='#006666' size='3'><strong>กำหนดปีการศึกษา</strong></font></td></tr>";
	echo "</table>";
	}

	//ส่วนฟอร์มรับข้อมูล
	if($index==1){
	echo "<form id='frm1' name='frm1' method=post action=?option=student_check&task=set/year&index=4 onSubmit='javascript:return chkForm();'><Center>
<Font color='#006666' Size=3><B>เพิ่มข้อมูลปีการศึกษา</Font></Cener><Br><Br>
<Table width='300' Border='0' Bgcolor='#Fcf9d8'>
	<Tr>
		<Td align='right'>ปีการศึกษา&nbsp;&nbsp;&nbsp;&nbsp;</Td><Td align='left'><Input Type='Text' Name='set_year' id='set_year' Size='4' maxlength='4' onkeydown='integerOnly()'></Td>
	</Tr>
	<Tr>
		<Td align='right'>ปีการศึกษาปัจจุบัน&nbsp;&nbsp;&nbsp;&nbsp;</Td>
		<td>
			<div align='left'>
				<select  name='year_active' id='year_active' size='1'>
					<option  value = ''>เลือก</option>
					<option value = '1'>ใช่</option>
					<option value = '0'>ไม่ใช่</option>
				</select>
			</div>
		</td>
	</tr>
	<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
	<tr><td align='right'><INPUT TYPE='SUBMIT' name='smb' value='ตกลง' class=entrybutton>
		&nbsp;&nbsp;&nbsp;</td>
	<td align='left'><INPUT TYPE='button' name='back' value='ย้อนกลับ' onclick='goto_url(0)' class=entrybutton'></td></tr>
	</Table>
	</form>";
	}

	//
	if($index==2) {

	}

	//ส่วนลบข้อมูล
	if($index==3){
		if($_GET['del_year']){
		$sql="Delete FROM `student_check_year` where student_check_year='$_GET[del_year]'";

		$dbquery = mysql_query( $sql);
		}
}

	//ส่วนบันทึกข้อมูล
	if($index==4){
	$rec_date = date("Y-m-d");
if(isset($_POST['updates'])){
	$sqlCHK = mysql_num_rows(mysql_query("select student_check_year from student_check_year where student_check_year='$_POST[set_year]'"));
		//echo "ggg>".$sqlCHK;
		if($sqlCHK>0 && $_POST['set_year']==$_POST['set_year_old']){
			if($_POST['year_active']=='1'){
				$uquery = mysql_query("update student_check_year set  year_active='0'");
			}
		$sql = "Update student_check_year Set student_check_year='".$_POST['set_year']."', year_active='".$_POST['year_active']."' Where student_check_year=$_POST[set_year_old]";
		$dbquery = mysql_query($sql);
				echo "<font color=darkgreen><strong><center>แก้ไขข้อมูลปีการศึกษาเรียบร้อยแล้ว</center></strong></font>";
		}else{
				echo "<font color=red><strong><center>ไม่สามารถแก้ไขข้อมูลได้ เนื่องจากมีข้อมูล ปีการศึกษา ".$_POST['set_year']." อยู่ในระบบแล้ว</center></strong></font>";
		}
}else{
	$sqlCHK = mysql_num_rows(mysql_query("select student_check_year from student_check_year where student_check_year='$_POST[set_year]'"));
		//echo "ggg>".$sqlCHK;
		if($sqlCHK>0){
				echo "<font color=red><strong><center>ไม่สามารถเพิ่มข้อมูลได้ เนื่องจากมีข้อมูล ปีการศึกษา ".$_POST['set_year']." อยู่ในระบบแล้ว</center></strong></font>";
		}else{
		$sql = "insert into student_check_year (student_check_year, year_active) values ('$_POST[set_year]', '$_POST[year_active]')";
		//echo $sql;
			if($_POST['year_active']=='1'){
				$uquery = mysql_query("update student_check_year set  year_active='0'");
			}
		$dbquery = mysql_query( $sql);
				echo "<font color=darkgreen><strong><center>เพิ่มข้อมูลปีการศึกษา ".$_POST['set_year']." ในระบบแล้ว</center></strong></font>";
		}//if($sqlCHK>0)
	}
}//if$index==4

	//แก้ไข
	if ($index==5){
	echo "<form id='frm1' name='frm1' method=post action=?option=student_check&task=set/year&index=4 onSubmit='javascript:return chkForm();'>
	<Center><Font color='#006666' Size=3><B>แก้ไขข้อมูลปีการศึกษา</Font></Cener><Br><Br>
<Table width='300' Border='0' Bgcolor='#Fcf9d8'>
	<Tr>
		<Td align='right'>
			ปีการศึกษา&nbsp;&nbsp;&nbsp;&nbsp;
	</Td>
		<Td align='left'>
			<Input Type='Text' Name='set_year' id='set_year' Size='4' maxlength='4' onkeydown='integerOnly()' value=$edit_year>
		</Td>
	</Tr>
	<Tr>
		<Td align='right'>ปีการศึกษาปัจจุบัน&nbsp;&nbsp;&nbsp;&nbsp;
		</Td>
		<td>
			<div align='left'>
				<select  name='year_active' id='year_active' size='1'>
					<option  value = ''>เลือก</option>
					<option value = '1'>ใช่</option>
					<option value = '0'>ไม่ใช่</option>
				</select>
			</div>
		</td>
	</tr>
	<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
	<tr><td align='right'>
	<Input Type='hidden' Name='set_year_old' value=$edit_year>
		<INPUT TYPE='SUBMIT' name='updates' value='ตกลง' class=entrybutton>
		&nbsp;&nbsp;&nbsp;</td>
	<td align='left'><INPUT TYPE='button' name='back' value='ย้อนกลับ' onclick='goto_url(0)' class=entrybutton'></td></tr>
	</Table>
	</form>";
	}

	//ส่วนปรับปรุงข้อมูล
	if ($index==6){
		if($_POST[year_active]=='1'){
		$sql = "update student_check_year set  year_active='0' ";
		$dbquery = mysql_query( $sql);
		}
	$sql = "update student_check_year set  student_check_year='$_POST[student_check_year]', year_active='$_POST[year_active]' where id='$_POST[id]'";
	$dbquery = mysql_query( $sql);
	}

	//ส่วนปรับปรุงปีการศึกษาทำงานปัจจุบัน
	if ($index==7){
		if($_GET['year_active']==1){
		$year_active=0;
		}
		else{
		$year_active=1;
		$sql = "update student_check_year set  year_active='0' ";
		$dbquery = mysql_query( $sql);
		}
	$sql = "update student_check_year set  year_active='$year_active' where id='$id'";
	$dbquery = mysql_query( $sql);
	}

	//ส่วนแสดงผล
	if(!(($index==1) or ($index==2) or ($index==5))){
		//ส่วนของการแยกหน้า
	$pagelen=20;  // 1_กำหนดแถวต่อหน้า
	$url_link="option=student_check&task=set/year";  // 2_กำหนดลิงค์ฺ
	$sql = "select * from student_check_year"; // 3_กำหนด sql

	$dbquery = mysql_query( $sql);
	$num_rows = mysql_num_rows($dbquery );  
	$totalpages=ceil($num_rows/$pagelen);
	if($page==""){
	$page=$totalpages;
			if($page<2){
			$page=1;
			}
	}
	else{
			if($totalpages<$page){
			$page=$totalpages;
						if($page<1){
						$page=1;
						}
			}
			else{
			$page=$page;
			}
	}

	$start=($page-1)*$pagelen;

	if(($totalpages>1) and ($totalpages<16)){
	echo "<div align=center>";
	echo "หน้า	";
				for($i=1; $i<=$totalpages; $i++)	{
						if($i==$page){
						echo "[<b><font size=+1 color=#990000>$i</font></b>]";
						}
						else {
						echo "<a href=$PHP_SELF?$url_link&page=$i>[$i]</a>";
						}
				}
	echo "</div>";
	}			
	if($totalpages>15){
				if($page <=8){
				$e_page=15;
				$s_page=1;
				}
				if($page>8){
						if($totalpages-$page>=7){
						$e_page=$page+7;
						$s_page=$page-7;
						}
						else{
						$e_page=$totalpages;
						$s_page=$totalpages-15;
						}
				}
				echo "<div align=center>";
				if($page!=1){
				$f_page1=$page-1;
				echo "<<a href=$PHP_SELF?$url_link&page=1>หน้าแรก </a>";
				echo "<<<a href=$PHP_SELF?$url_link&page=$f_page1>หน้าก่อน </a>";
				}
				else {
				echo "หน้า	";
				}					
				for($i=$s_page; $i<=$e_page; $i++){
						if($i==$page){
						echo "[<b><font size=+1 color=#990000>$i</font></b>]";
						}
						else {
						echo "<a href=$PHP_SELF?$url_link&page=$i>[$i]</a>";
						}
				}
				if($page<$totalpages)	{
				$f_page2=$page+1;
				echo "<a href=$PHP_SELF?$url_link&page=$f_page2> หน้าถัดไป</a>>>";
				echo "<a href=$PHP_SELF?$url_link&page=$totalpages> หน้าสุดท้าย</a>>";
				}
				echo " <select onchange=\"location.href=this.options[this.selectedIndex].value;\" size=\"1\" name=\"select\">";
				echo "<option  value=\"\">หน้า</option>";
					for($p=1;$p<=$totalpages;$p++){
					echo "<option  value=\"?$url_link&page=$p\">$p</option>";
					}
				echo "</select>";
	echo "</div>";  
	}					
	//จบแยกหน้า

	$sql = "select * from  student_check_year order by student_check_year desc limit $start,$pagelen";
	$dbquery = mysql_query( $sql);
	echo  "<table width=50% border=0 align=center>";
	echo "<Tr><Td colspan='5' align='left'><INPUT TYPE='button' name='smb' value='เพิ่มปีการศึกษา' onclick='location.href=\"?option=student_check&task=set/year&index=1\"' ></Td></Tr>";

	echo "<Tr bgcolor='#FFCCCC'><Td  align='center'>ที่</Td><Td  align='center'>ปีการศึกษา</Td><Td  align='center'>ปีการศึกษาปัจจุบัน</Td><Td  align='center'>ลบ</Td><Td  align='center'>แก้ไข</Td></Tr>";
	$N=(($page-1)*$pagelen)+1;  //*เกี่ยวข้องกับการแยกหน้า
	$M=1;
	While ($result = mysql_fetch_array($dbquery))
		{
			$id = $result['id'];
			$student_check_year= $result['student_check_year'];
			$year_active = $result['year_active'];
			if($year_active==1){
			$active_pic="<img src=images/yes.png border='0' alt='ปีทำงานปัจจุบัน'>";
			}
			else{
			$active_pic="<img src=images/no.png border='0' alt='ไม่ใช่ปีทำงานปัจจุบัน'>";
			}
			
				$color=(($M%2) == 0)?" class='even'":" class='odd'";
$del_pic='<a href="?option=student_check&task=set/year&index=3&del_year='.$student_check_year.'" onclick=\'javascript:return confirm("ยืนยันการลบข้อมูล");\'><img src="images/drop.png" alt="ลบ" border="0"></a>';
$edit_pic='<a href="?option=student_check&task=set/year&index=5&edit_year='.$student_check_year.'"><img src="images/edit.png" alt="แก้ไข" border="0">';
			echo "<Tr $color>
			<Td align='center' width='50'>$N</Td>
			<Td  align='center'>$student_check_year</Td>
			<Td align='center'><a href=?option=student_check&task=set/year&index=7&id=$id&year_active=$year_active&page=$page>$active_pic</a></Td>
			<Td align='center'>$del_pic</Td>
			<Td align='center'>$edit_pic</Td>
		</Tr>";
	$M++;
	$N++;  //*เกี่ยวข้องกับการแยกหน้า
		}
	echo "</Table>";
	}

	?>
	<script>
	function goto_url(val){
		if(val==0){
	//		callfrm("?option=student_check&task=set/year");   // page ย้อนกลับ 
	<?php echo "location.href=\"?option=student_check&task=set/year&id=$id&page=$page"; ?>";
		}
	}
			function chkForm()
				{
					if(document.frm1.set_year.value=="")
					{
						alert("กรุณาระบุปีที่ต้องการบันทึก");
						document.frm1.set_year.focus();
						//alert(document.frmSave.datepicker.value);
						return false;
					}
				}

	</script>
<?php
}
?>