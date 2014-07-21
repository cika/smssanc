<TABLE BORDER="0" CELLSPACING="0" WIDTH="100%" >
<tr bgcolor="#FFCC00"><td>
<?php
	require_once("./modules/plan/planproject/plan_authen.php");
	require_once("./modules/plan/planproject/plan_person.php");
	require_once("./modules/plan/planproject/plan_default.php");

if(!isset($_SESSION['admin_plan'])){
$_SESSION['admin_plan']="";
}

echo "<ul id=\"nav\" class=\"dropdown dropdown-horizontal\">";
	echo "<li><a href=\"./\">รายการหลัก</a></li>";
	if($_SESSION['admin_plan']=="plan"){
	echo "<li><a href=\"?option=plan\" class=\"dir\">ตั้งค่าระบบ</a>";
		echo "<ul>";
			echo "<li><a href=\"?option=plan&task=planproject/plan_setuser\">กำหนดเจ้าหน้าที่</a></li>";
			echo "<li><a href=\"?option=plan&task=planproject/plan_year\">กำหนดปีงบประมาณ</a></li>";
			echo "<li><a href=\"?option=plan&task=planproject/plan_setgic_year\">กำหนดปีมาตรฐานการศึกษา</a></li>";
			echo "<li><a href=\"?option=plan&task=planproject/plan_setgic\">กำหนดกลยุทธ์</a></li>";
		echo "</ul>";
	echo "</li>";
	}
	if(($_SESSION['login_status']<=4) and ($_SESSION["mpms_add"]==1 or $_SESSION["mpms_edit"] ==1 or $_SESSION["mpms_dele"]==1)){	
	echo "<li><a href=\"?option=plan\" class=\"dir\">โครงการ</a>";
		echo "<ul>";
			echo "<li><a href=\"?option=plan&task=planproject/plan_in_proj\">กำหนดโครงการ</a></li>";
			echo "<li><a href=\"?option=plan&task=planproject/plan_in_acti\">กำหนดกิจกรรม</a></li>";
			echo "<li><a href=\"?option=plan&task=planproject/plan_upload_detail\">แนบเอกสารโครงการ</a></li>";
		echo "</ul>";
	echo "</li>";
	}
	echo "<li><a href=\"?option=plan\" class=\"dir\">รายงานโครงการ</a>";
		echo "<ul>";
			echo "<li><a href=\"?option=plan&task=planproject/plan_show_plan\">โครงการจำแนกตามกลุ่ม(งาน)</a></li>";
			echo "<li><a href=\"?option=plan&task=planproject/plan_show_plan2\">โครงการจำแนกตามกลยุทธ์</a></li>";
			echo "<li><a href=\"?option=plan&task=planproject/plan_owner_report\">รายงานผลการดำเนินงาน</a></li>";
		echo "</ul>";
	echo "</li>";
	echo "<li><a href=\"?option=plan\" class=\"dir\">คู่มือ</a>";
		echo "<ul>";
				echo "<li><a href='modules/plan/manual/plan.pdf' target='_blank'>เอกสารคู่มือ</a></li>";
		echo "</ul>";
	echo "</li>";
echo "</ul>";
?>
</td></tr>
</table>