<?php
        $sqlmenu="SELECT* FROM health_personal WHERE personal_code='$_SESSION[login_user_id]'";
		$resultmenu=mysql_query($sqlmenu); 
		$rowmenu=mysql_fetch_array($resultmenu);
			?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr bgcolor="#FFCC00"><td>
<ul id="nav" class="dropdown dropdown-horizontal">
	<li><a href="./">รายการหลัก</a></li>
       <?php if(isset($_SESSION['admin_health'])){  if($_SESSION['admin_health']=="health"){ ?>
     <li><a href="?option=health">ตั้งค่าระบบ</a>
                <ul>
   		  		 <li><a href="?option=health&task=admin_year">กำหนด ปีการศึกษา</a></li> 
                  <li><a href="?option=health&task=user">กำหนด ผู้ใช้งาน</a></li> 
              </ul>
                </li>
               <?php    }   
	   }
		 if($rowmenu['per_status']==1) {?>
		<li><a href="?option=health">ตรวจสุขภาพ</a>
        		 <ul>
               <li><a href="?option=health&task=checkhealth" class="dir">ตรวจสุขภาพนักเรียน</a></li> 
             </ul>
        </li>
         <?php } ?>
		<li><a href="?option=health">รายงาน</a>
		<ul>
        <?php if($_SESSION['login_status']<=5){?>
        <li><a href="?option=health&task=report_all">ผลการตรวจสุขภาพ แบบ BMI</a></li>
        <li><a href="?option=health&task=report_all2">ผลการตรวจสุขภาพ แบบ แยกตามเพศ</a></li>
        <?php }else if($_SESSION['login_status']==6){?>
         <li><a href="?option=health&task=report_all_type_personal_std">ผลการตรวจสุขภาพ แบบ BMI</a></li>
         <li><a href="?option=health&task=report_all_type_personal_std2">ผลการตรวจสุขภาพ แบบ แยกตามเพศ</a></li>
         <?php }else{}?>
		</ul>
	</li>
        <li><a href="?option=health">คู่มือ</a>
                <ul>
                 <li><a href="?option=health&task=manual/sol">สูตรที่ใช้คำนวณ</a></li>                 
   		  		 <li><a href="?option=health&task=manual/manual">คู่มือการใช้งาน</a></li> 
                </ul>
                </li>
	</ul>
</td>
    <td align="right">อัพเดทล่าสุดเมื่อ :: 4 ก.ย.2556 &nbsp;&nbsp;</td>
</tr>
</table>