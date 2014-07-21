  <?php 
       	  		$sqlmenu="SELECT* FROM savings_personal WHERE personal_code='$_SESSION[login_user_id]'";
				$resultmenu=mysql_query($sqlmenu); 
				$rowmenu=mysql_fetch_array($resultmenu);
				?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr bgcolor="#FFCC00"><td>
<ul id="nav" class="dropdown dropdown-horizontal">
	<li><a href="./">รายการหลัก</a></li>
       <?php  if(isset($_SESSION['admin_savings'])){ if($_SESSION['admin_savings']=="savings"){ ?>
     <li><a href="?option=savings">ตั้งค่าระบบ</a>
                <ul>
   		  		 <li><a href="?option=savings&task=admin_year">กำหนด ปีการศึกษา</a></li> 
                  <li><a href="?option=savings&task=user">กำหนด ผู้ใช้งาน</a></li> 
                  
              </ul>
                </li>
               <?php     } 
			   }
			     ?>
              
        <?php  if($rowmenu['per_status']==1) {?>
		<li><a href="?option=savings">ออมทรัพย์</a>
        		 <ul>
      	<li><a href="?option=savings&task=add_save_day" class="dir">ฝากเงินออมทรัพย์</a></li> 
        <li><a href="?option=savings&task=update_save" class="dir">แก้ไข ฝากออมทรัพย์</a></li>
        <li><a href="?option=savings&task=to_draw" class="dir">ถอนเงินออมทรัพย์</a></li> 
 	    <li><a href="?option=savings&task=to_draw_exit" class="dir">ถอนเงินนักเรียนที่ สำเร็จการศึกษา,ย้าย,ออกกลางคัน แล้ว</a></li> 
             </ul>
        </li>
         <?php  } ?>
		<li><a href="?option=savings">รายงาน</a>
		<ul>
        <?php  if($_SESSION['login_status']<=5){?>
        <li><a href="?option=savings&task=report_all">ฝาก-ถอน ออมทรัพย์</a></li>
        <li><a href="?option=savings&task=report_all_exit">ฝาก-ถอน ออมทรัพย์ ที่สำเร็จการศึกษา,ย้าย,ออกกลางคัน</a></li>
        <?php  }else if($_SESSION['login_status']==6){?>
         <li><a href="?option=savings&task=report_save_day_personal2">ฝาก-ถอน ออมทรัพย์รายบุคคล</a></li>
         <?php  }else{}?>
		</ul>
	</li>
        <li><a href="?option=savings">คู่มือ</a>
                <ul>
   		  		 <li><a href="?option=savings&task=manual/manual">คู่มือการใช้งาน</a></li> 
                </ul>
                </li>
	</ul>
</td>
</td>
    <td align="right">อัพเดทล่าสุดเมื่อ :: 4 ก.ย.2556 &nbsp;&nbsp;</td>
</tr>
</table>