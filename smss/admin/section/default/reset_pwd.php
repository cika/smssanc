<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );

if(!isset($_REQUEST['name_search'])){
$_REQUEST['name_search']="";
}

//ส่วนหัว
echo "<br />";
echo "<table width='50%' border='0' align='center'>";
echo "<tr align='center'><td><font color='#006666' size='3'><strong>คืนค่า(Reset) รหัสผ่าน</strong></font></td></tr>";
echo "</table>";

//ส่วนการreset
if ($index==1){
$sql = "select username from system_user where id='$_GET[id]' ";
$dbquery = mysql_query($sql);
$result = mysql_fetch_array($dbquery);

$user_passnew=md5($result['username']);
$sql = "update system_user set userpass='$user_passnew' where id='$_GET[id]'";
$dbquery = mysql_query($sql);
}

//ส่วนแสดงผล
	//ส่วนของการแยกหน้า
$pagelen=20;  // 1_กำหนดแถวต่อหน้า
$url_link="file=reset_pwd&name_search=$_REQUEST[name_search]";  // 2_กำหนดลิงค์

if($_REQUEST['name_search']!=""){
$sql = "select system_user.id, person_main.name, person_main.surname, person_main.person_id, system_user.username, system_user.userpass from system_user left join person_main on system_user.person_id=person_main.person_id where person_main.name like '%$_REQUEST[name_search]%' or system_user.username like '%$_REQUEST[name_search]%' ";
}
else{
$sql = "select  id  from system_user"; // 3_กำหนด sql
}

$dbquery = mysql_query($sql);
$num_rows = mysql_num_rows($dbquery );  
$totalpages=ceil($num_rows/$pagelen);
if(isset($_REQUEST['page']))
	{
		$page=$_REQUEST['page'];
	}else{$page="";}

	if($page==""){
$page=$totalpages;
		if($page<2){
		$page=1;
		}
}
else{
		if($totalpages<$_REQUEST['page']){
		$page=$totalpages;
					if($page<1){
					$page=1;
					}
		}
		else{
		$page=$_REQUEST['page'];
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

////////////////////
echo "<form id='frm1' name='frm1'>";
echo "<table width='60%' align='center'><tr><td align='right'>";
echo "ค้นหาด้วยชื่อหรือUsername&nbsp;";
echo "<Input Type='Text' Name='name_search' value='$_REQUEST[name_search]' >";
echo "&nbsp;<INPUT TYPE='button' name='smb'  value='ค้น' onclick='goto_display(1)'>";
echo "</td></tr></table>";
echo "</form>";
//////////////////////////////////////////

if($_REQUEST['name_search']!=""){
$sql = "select system_user.id, person_main.name, person_main.surname, person_main.person_id, system_user.username, system_user.userpass from system_user left join person_main on system_user.person_id=person_main.person_id where person_main.name like '%$_REQUEST[name_search]%' or system_user.username like '%$_REQUEST[name_search]%' order by person_main.name limit $start,$pagelen";
}
else{
$sql = "select system_user.id, person_main.name, person_main.surname, person_main.person_id, system_user.username, system_user.userpass from system_user left join person_main on system_user.person_id=person_main.person_id order by system_user.username limit $start,$pagelen";
}
$dbquery = mysql_query($sql);
echo  "<table width=60% border=0 align=center>";
echo "<Tr bgcolor='#FFCCCC'><Td  align='center' width='50'>ที่</Td><Td align='center'>Username</Td><Td  align='center'>ชื่อ-สกุล</Td><Td align='center'>สถานะรหัสผ่าน</Td><Td align='center' width='50'>Reset</Td></Tr>";
$N=(($page-1)*$pagelen)+1;  //*เกี่ยวข้องกับการแยกหน้า
$M=1;
While ($result = mysql_fetch_array($dbquery))
	{
		$id = $result['id'];
		$person_id = $result['person_id'];
		$name = $result['name'];
		$surname = $result['surname'];
		$username = $result['username'];
		$userpass = $result['userpass'];
		
		if(md5($username)==$userpass){
		$pwd_status="<font color='#FF0000'>ค่าเดียวกับ Username</font>";
		}
		else {
		$pwd_status="ปกติ";
		}
			if(($M%2) == 0)
			$color="#FFFFC";
			else  	$color="#FFFFFF";
			
		echo "<Tr bgcolor=$color><Td align='center'>$N</Td><Td align='left'>$username</Td><Td  align='left'>$name $surname</Td>
		<Td align='center'>$pwd_status</Td>
		<Td align='center'><a href=?file=reset_pwd&index=1&id=$id&page=$page&name_search=$_REQUEST[name_search]><img src=../images/edit.png border='0' alt='reset password'></a></Td>
	</Tr>";
$M++;
$N++;  //*เกี่ยวข้องกับการแยกหน้า
	}
echo "</Table>";

?>
<script>
function goto_display(val){
	if(val==1){
		callfrm("?file=reset_pwd"); 
		}
}
</script>
