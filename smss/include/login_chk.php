<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
//sd page 

		if(trim($_POST['username'])==""){
		echo "<script>document.location.href='index.php';</script>\n";
		exit();
		}
$username 	= trim($_POST['username']);
$pass = trim($_POST['pass']);
$pass = md5($pass);

if($username=='admin'){
$sql = "select * from system_user where username='admin' and status='1' ";
}
else{
$sql = "select * from system_user where username='$username' and status='1' ";
}
$dbquery = mysql_query($sql);
$result1 = mysql_fetch_array($dbquery);
		if($result1){
		$Myusername = $result1['username'];
		$Mypwd=$result1['userpass'];
				if (strcmp($Mypwd,$pass)) {
				echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
				echo "<script>alert('Password ไม่ถูกต้อง'); document.location.href='index.php';</script>\n";
				exit();
				}
				
		//ตรวจสอบว่าเป็น admin
		if($Myusername=='admin'){
		$_SESSION['login_status'] =99;
		}
		else{	
		//ตรวจสอบเป็นบุคลากรปัจจุบันหรือไม่่	
		$sql_user = "select * from person_main left join person_position on person_main.position_code=person_position.position_code where person_main.person_id='$result1[person_id]' and person_main.status ='0' ";
		$dbquery_user = mysql_query($sql_user);
		$result_user = mysql_fetch_array($dbquery_user);
				if($result_user){
						if($result_user['position_code']==1){
						$_SESSION['login_status'] =2;	
						}
						else if($result_user['position_code']==2){
						$_SESSION['login_status'] =3;	
						}
						else{
						$_SESSION['login_status'] =4;
						}
				}	
				else{
						echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
						echo "<script>alert('คุณไม่ได้เป็นบุคลากรปัจจุบันของหน่วยงาน จึงไม่ได้รับสิทธิ์ใช้งาน'); document.location.href='index.php';</script>\n";
						exit();
				}					
		}
		
		$_SESSION['login_user_id'] = $result1['person_id'];
		if(!isset($result_user['name'])){
		$_SESSION['login_name']=$Myusername; 
		}
		else{
			$_SESSION['login_prename'] = $result_user['prename'];	
			$_SESSION['login_name'] = $result_user['name'];	
			$_SESSION['login_surname'] = $result_user['surname'];	
			$_SESSION['login_userposition'] = $result_user['position_name'];		
		}

		$sql_module_admin = "select * from system_module_admin where person_id='$result1[person_id]' ";
		$dbquery_module_admin = mysql_query($sql_module_admin);
		While ($result_module_admin = mysql_fetch_array($dbquery_module_admin)){
		$_SESSION['admin_'.$result_module_admin['module']]=$result_module_admin['module'];
		}
		}
		
		else if(!$result1){
		//ตรวจว่ามีชื่่อในทะเบียน user หรือไม่
		$sql4 = "select * from system_user where person_id='$username' and status='1' ";
		$dbquery4 = mysql_query($sql4);
		$num_rows=mysql_num_rows($dbquery4);
		if($num_rows>=1){
				echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
				echo "<script>alert('คุณมีชื่อผู้ใช้อยู่แล้ว กรุณา login ด้วย Username และ Password'); document.location.href='index.php';</script>\n";
				exit();
		}

		$sql2 = "select * from person_main where person_id='$username' and status='0' ";
		$dbquery2 = mysql_query($sql2);
		$result2 = mysql_fetch_array($dbquery2);
				if($result2){
				$system_warning_1=1;
				$_SESSION['login_user_id'] = $result2['person_id'];
				$_SESSION['login_status'] =5;	
				$_SESSION['login_prename'] = $result2['prename'];	
				$_SESSION['login_name'] = $result2['name'];	
				$_SESSION['login_surname'] = $result2['surname'];	
				}	
				else if(!$result2){
				$sql3 = "select * from student_main where student_id='$username' and status='0' ";
				$dbquery3 = mysql_query($sql3);
				$result3 = mysql_fetch_array($dbquery3);
						if($result3){
						$_SESSION['login_user_id'] = $result3['student_id'];
						$_SESSION['login_status'] =6;	
						$_SESSION['login_prename'] = $result3['prename'];	
						$_SESSION['login_name'] = $result3['name'];	
						$_SESSION['login_surname'] = $result3['surname'];	
						}
						else{
						echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
						echo "<script>alert('ไม่พบข้อมูลว่าเป็นบุคลากรหรือนักเรียนปัจจุบัน'); document.location.href='index.php';</script>\n";
						exit();
						}	
				}
		}
		$sql_school_name = "select * from  system_school_name";
		$dbquery_school_name = mysql_query($sql_school_name);
		$result_school_name = mysql_fetch_array($dbquery_school_name);
		$_SESSION['school_name'] =$result_school_name['school_name'];		


//ส่วนของ version และปรับปรุงระบบ		
$sql_version = "select * from system_version order by id";
$dbquery_version = mysql_query($sql_version);
$result_version = mysql_fetch_array($dbquery_version);	

require_once('version.php');
$_SESSION['system_version'] = $code_version;	

if($result_version['smss_version']!=$code_version){
	require_once('update/update.php');
}

if(!isset($_SESSION['login_name'])){
$_SESSION['login_name']="";
}

if(!isset($_SESSION['login_surname'])){
$_SESSION['login_surname']="";
}

if(!isset($_SESSION['school_name'])){
$_SESSION['school_name']="";
}

$_SESSION['SMSS']=1;
if(isset($_SESSION['AMSSPLUS'])){
unset($_SESSION['AMSSPLUS']);
}

if(isset($system_office_code)){
$_SESSION['office_code']=$system_office_code;
}
else{
$_SESSION['office_code']="";
}

//ส่วนของระบบแจ้งเตือน
require_once('alert/alert.php');

?>