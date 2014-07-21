<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
?>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="css/login.css" type="text/css" />
<script language="javascript" type="text/javascript">
	function setFocus() {
		document.loginForm.username.select();
		document.loginForm.username.focus();
	}
</script>
</head>
<body onLoad="setFocus();">
<!-- Div ของ login -->
<div id="ctr" align="center">
	<div class="login">
		<div class="login-form">
			<img src="../images/login/login.gif" alt="Login" />
        	<form action="index.php" method="post" name="loginForm" id="loginForm">
			<div class="form-block">
	        	<div class="inputlabel">Username</div>
		    	<div><input name="username" type="text" class="inputbox" size="15" /></div>
	        	<div class="inputlabel">Password</div>
		    	<div><input name="pass" type="password" class="inputbox" size="15" /></div>
	        	<div align="left"><input type="submit" name="submit" class="button" value="Login" />
				&nbsp;<input type="reset" class="button" value="Reset" /></div>
        	</div>
			</form>
    	</div>
		<div class="login-text">
			<div class="ctr"><img src="../images/login/login_key.jpg" alt="security" /></div>
        	<p>ระบบสนับสนุนการบริหารจัดการสถานศึกษา</p>
			<p>School Management Support System : SMSS</p>
    	</div>
		<div class="clr"></div>
	</div>
</div>
<!-- จบ Login -->
<noscript>
!Warning! Javascript must be enabled for proper operation of the Administrator
</noscript>
</body>
</html>