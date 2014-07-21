<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
?>
<tr bgcolor="#FFCC00">
<td colspan="5">
<ul id="nav" class="dropdown dropdown-horizontal">
<?php		
//**
if(!($_SESSION['login_status']==5)){

$sql_workgroup = "select  * from system_workgroup order by workgroup_order";
$dbquery_workgroup = mysql_query($sql_workgroup);
While ($result_workgroup = mysql_fetch_array($dbquery_workgroup)) {	
		echo "<li>";
		echo "<a href='./' class='dir'>$result_workgroup[workgroup_desc]</a>";
					$sql_module = "select  * from system_module where workgroup='$result_workgroup[workgroup]' and module_active='1' order by module_order";
					$dbquery_module = mysql_query($sql_module);
					echo "<ul>";
					While ($result_module = mysql_fetch_array($dbquery_module)){
					if($result_module['web_link']==1){
					echo "<li><a href='$result_module[url]' target='_blank'>$result_module[module_desc]</a></li>";
					}
					else {
					echo "<li><a href='?option=$result_module[module]'>$result_module[module_desc]</a></li>";
					}
							if(!isset($_SESSION['module_name_'.$result_module['module']])){
							$_SESSION['module_name_'.$result_module['module']]=$result_module['module_desc'];
							}
					}
					echo "</ul>";
		echo "</li>";
 }
 } //end **
?>	
	<li><a href="./" class="dir">ผู้ใช้ (User)</a>
		<ul>
<?php			
			if($_SESSION['login_status']<=4){	
			echo "<li><a href='?file=user_change_pwd'>เปลี่ยนรหัสผ่าน</a></li>";
			}
			if($_SESSION['login_status']==5){	
			echo "<li><a href='?file=register'>ลงทะเบียนผู้ใช้</a></li>";
			}
			echo "<li><a href='?file=manual/smss_team'>Mail ถึงทีมงานSMSS</a></li>";

?>			
		</ul>
	</li>

</ul>
</td>
<td align="right">Version <?php echo $_SESSION['system_version']; ?>&nbsp;&nbsp;&nbsp;</td>
</tr>
