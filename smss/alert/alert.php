<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
$alert=0;
$alert_content="";

//เตือนขออนุญาตไปราชการรอความเห็นชอบ
$sql_permission_alert = "select permission_main.id from permission_main left join permission_person_set on  permission_main.person_id=permission_person_set.person_id where (permission_person_set.comment_person ='$_SESSION[login_user_id]') and (permission_main.grant_x is null) and (permission_main.comment_person is null)";
$dbquery_permission_alert = mysql_query($sql_permission_alert);
if($dbquery_permission_alert){
		$permission_alert_num=mysql_num_rows($dbquery_permission_alert);	
		if($permission_alert_num>=1){
		$alert=1;
		$alert_content=$alert_content."มีผู้ขออนุญาตไปราชการรอความเห็นชอบ  ";
		}
}

//เตือนอนุญาตไปราชการรออนุมัติ(สำหรับผู้ถูกเลือกให้อนุมัติ)

$now=time();
$time_onedayago=$now-86400;
$onedayago=date("Y-m-d H:i:s",$time_onedayago); // ใช้กับalert ขออนุญาตไปราชการและการลา

$sql_permission_alert2 = "select permission_main.id from permission_main left join permission_person_set on  permission_main.person_id=permission_person_set.person_id where (permission_main.grant_person_selected ='$_SESSION[login_user_id]') and (permission_main.rec_date<'$onedayago' or permission_person_set.comment_person is null or permission_person_set.comment_person='' or permission_main.no_comment='1' or permission_main.comment_person is not null) and (permission_main.grant_person is null)";
$dbquery_permission_alert2 = mysql_query($sql_permission_alert2);
if($dbquery_permission_alert2){
		$permission_alert2_num=mysql_num_rows($dbquery_permission_alert2);	
		if($permission_alert2_num>=1){
		$alert=1;
		$alert_content=$alert_content."มีผู้ขออนุญาตไปราชการรอการอนุมัติ ";
		}
}
if($permission_alert2_num<1){
		//เตือนอนุญาตไปราชการรออนุมัติ(กรณ๊ทั่วไป)
		$sql_permission_alert2 = "select permission_main.id from permission_main left join permission_person_set on  permission_main.person_id=permission_person_set.person_id where  (permission_person_set.grant_person ='$_SESSION[login_user_id]') and (permission_main.grant_person_selected is null or permission_main.grant_person_selected='') and (permission_main.rec_date<'$onedayago' or permission_person_set.comment_person is null or permission_person_set.comment_person='' or permission_main.no_comment='1' or permission_main.comment_person is not null) and (permission_main.grant_person is null)";
		$dbquery_permission_alert2 = mysql_query($sql_permission_alert2);
		if($dbquery_permission_alert2){
				$permission_alert2_num=mysql_num_rows($dbquery_permission_alert2);	
				if($permission_alert2_num>=1){
				$alert=1;
				$alert_content=$alert_content."มีผู้ขออนุญาตไปราชการรอการอนุมัติ ";
				}
		}
} 

////////////////////////////////////////////////////////////
//เตือนลาของผู้เห็นชอบ
$sql_la_alert = "select la_main.id from la_main left join la_person_set on  la_main.person_id=la_person_set.person_id where (la_person_set.comment_person ='$_SESSION[login_user_id]') and (la_main.group_sign is null) and (la_main.commander_sign is null)";

$dbquery_la_alert = mysql_query($sql_la_alert );
if($dbquery_la_alert){
		$la_alert_num=mysql_num_rows($dbquery_la_alert);	
		if($la_alert_num>=1){
		$alert=1;
		$alert_content=$alert_content."มีผู้ขออนุญาตลารอความเห็นชอบ  ";
		}
}

//เตือนการลารออนุมัติ(สำหรับผู้ถูกเลือกให้อนุมัติ)
$sql_la_alert2 = "select la_main.id from la_main left join la_person_set on  la_main.person_id=la_person_set.person_id where (la_main.grant_p_selected ='$_SESSION[login_user_id]') and (la_main.rec_date<'$onedayago' or la_person_set.comment_person is null or la_person_set.comment_person='' or la_main.no_comment='1' or la_main.group_sign is not null) and (la_main.commander_sign is null)";

$dbquery_la_alert2 = mysql_query($sql_la_alert2);
if($dbquery_la_alert2){
		$la_alert2_num=mysql_num_rows($dbquery_la_alert2);	
		if($la_alert2_num>=1){
		$alert=1;
		$alert_content=$alert_content."มีผู้ขออนุญาตลารอการอนุมัติ ";
		}
}
if($la_alert2_num<1){
		//เตือนการลารออนุมัติ(กรณีทั่วไป)
		$sql_la_alert3 = "select la_main.id from la_main left join la_person_set on  la_main.person_id=la_person_set.person_id where (la_person_set.grant_person ='$_SESSION[login_user_id]') and (la_main.grant_p_selected is null or la_main.grant_p_selected='') and (la_main.rec_date<'$onedayago' or la_person_set.comment_person is null or la_person_set.comment_person='' or la_main.no_comment='1' or la_main.group_sign is not null) and (la_main.commander_sign is null)";
		
		$dbquery_la_alert3 = mysql_query($sql_la_alert3);
		if($dbquery_la_alert3){
				$la_alert3_num=mysql_num_rows($dbquery_la_alert3);	
				if($la_alert3_num>=1){
				$alert=1;
				$alert_content=$alert_content."มีผู้ขออนุญาตลารอการอนุมัติ ";
				}
		}
}

//เตือนขอยกเลิกวันลาของผู้เห็นชอบ
$sql_la_alert4 = "select la_cancel.id from la_cancel left join la_person_set on  la_cancel.person_id=la_person_set.person_id where (la_person_set.comment_person ='$_SESSION[login_user_id]') and (la_cancel.group_sign is null) and (la_cancel.commander_sign is null) ";

$dbquery_la_alert4 = mysql_query($sql_la_alert4 );
if($dbquery_la_alert4){
		$la_alert4_num=mysql_num_rows($dbquery_la_alert4);	
		if($la_alert4_num>=1){
		$alert=1;
		$alert_content=$alert_content."มีผู้ขออนุญาตยกเลิกวันลารอความเห็นชอบ  ";
		}
}

//เตือนการขอยกเลิกวันลารออนุมัติ(สำหรับผู้ถูกเลือกให้อนุมัติ)
$sql_la_alert5 = "select la_cancel.id from la_cancel left join la_person_set on  la_cancel.person_id=la_person_set.person_id where (la_cancel.grant_p_selected ='$_SESSION[login_user_id]') and (la_cancel.rec_date<'$onedayago' or la_person_set.comment_person is null or la_person_set.comment_person='' or la_cancel.no_comment='1' or la_cancel.group_sign is not null) and (la_cancel.commander_sign is null)";
		
$dbquery_la_alert5 = mysql_query($sql_la_alert5);
if($dbquery_la_alert5){
		$la_alert5_num=mysql_num_rows($dbquery_la_alert5);	
		if($la_alert5_num>=1){
		$alert=1;
		$alert_content=$alert_content."มีผู้ขออนุญาตยกเลิกวันลารอการอนุมัติ ";
		}
}
if($la_alert5_num<1){
		//เตือนการขอยกเลิกวันลารออนุมัติ(กรณีทั่วไป)
		$sql_la_alert6 = "select la_cancel.id from la_cancel left join la_person_set on  la_cancel.person_id=la_person_set.person_id where (la_person_set.grant_person ='$_SESSION[login_user_id]') and (la_cancel.grant_p_selected is null or la_cancel.grant_p_selected='') and (la_cancel.rec_date<'$onedayago' or la_person_set.comment_person is null or la_person_set.comment_person='' or la_cancel.no_comment='1' or la_cancel.group_sign is not null) and (la_cancel.commander_sign is null)";
		
		$dbquery_la_alert6 = mysql_query($sql_la_alert6);
		if($dbquery_la_alert6){
				$la_alert6_num=mysql_num_rows($dbquery_la_alert6);	
				if($la_alert6_num>=1){
				$alert=1;
				$alert_content=$alert_content."มีผู้ขออนุญาตยกเลิกวันลารอการอนุมัติ ";
				}
		}
}

////////////////////////////////////////////////////////////
//เตือนmail
$sql_mail_alert = "select  mail_main.ms_id from mail_main left join mail_sendto_answer on mail_main.ref_id=mail_sendto_answer.ref_id where mail_sendto_answer.send_to='$_SESSION[login_user_id]' and mail_sendto_answer.answer<'1' ";
$dbquery_mail_alert = mysql_query($sql_mail_alert );
if($dbquery_mail_alert){
		$mail_num=mysql_num_rows($dbquery_mail_alert);	
		if($mail_num>=1){
		$alert=1;
		$alert_content=$alert_content."มีจดหมายยังไม่ได้รับ  ";
		}
}

?>