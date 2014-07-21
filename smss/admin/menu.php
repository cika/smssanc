<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
?>

<tr bgcolor="#FFCC00">
<td colspan="6">
<ul id="nav" class="dropdown dropdown-horizontal">
	<li><a href="./" class="dir">ตั้งค่าระบบ</a>
		<ul>
			<li><a href="?file=school_name">ชื่อโรงเรียน</a></li>			
			<li><a href="?file=workgroup">กลุ่ม(งาน)</a></li>
			<li><a href="?file=module">ระบบงายย่อย(Module)</a></li>		</ul>
	</li>
	<li><a href="./" class="dir">สิทธิ์ระบบงานย่อย</a>
		<ul>
			<li><a href="?file=module_admin">ผู้ดูแล(Admin)ระบบงานย่อย</a></li>
		</ul>
	</li>
	<li><a href="./" class="dir">ลงทะเบียน</a>
		<ul>
			<li><a href="?file=register">ลงทะเบียนการใช้ SMSS</a></li>
		</ul>
	</li>
	<li><a href="./" class="dir">ผู้ใช้ (User)</a>
		<ul>
			<li><a href="?file=user_change_pwd">เปลี่ยนรหัสผ่านตนเอง</a></li>
			<li><a href="?file=reset_pwd">คืนค่า(Reset)รหัสผ่านผู้ใช้</a></li>
			<li><a href="?file=add_user">เพิ่ม แก้ไข ผู้ใช้(User)</a></li>
		</ul>
	</li>
	<li><a href="./" class="dir">คู่มือ</a>
		<ul>
			<li><a href='section/default/manual/smss.pdf' target='_blank'>คู่มือ SMSS ส่วนจัดการระบบ</a></li>
		</ul>
	</li>
</ul>
</td>
</tr>
