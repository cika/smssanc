<?
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
//ส่วนการสร้างตารางระบบย่อย
$sql_create="CREATE TABLE `student_inclass_main` (
  `check_date` date NOT NULL COMMENT 'วันที่บันทึก',
  `student_id` int(11) NOT NULL COMMENT 'รหัสนักเรียน',
  `class_now` tinyint(4) NOT NULL COMMENT 'ชั้นเรียนปัจจุบันที่บันทึก',
  `room_now` tinyint(4) NOT NULL COMMENT 'ห้องเรียนปัจจุบันที่บันทึก',
  `student_check_year` int(11) NOT NULL COMMENT 'ปีการศึกษาที่บันทึก',
  `check_val` varchar(50) NOT NULL COMMENT 'ค่าการเช็ค',
  `check_person_id` varchar(13) NOT NULL COMMENT 'ผู้ทำรายการ',
  `save_date` datetime NOT NULL COMMENT 'วันที่ทำรายการบันทึก',
  PRIMARY KEY  (`check_date`,`student_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8";
$query = mysql_query($sql_create);

$sql_create="CREATE TABLE `student_inclass_permission` (
  `class_now` tinyint(4) NOT NULL,
  `room_now` tinyint(4) NOT NULL,
  `person_id` varchar(13) NOT NULL,
  `student_check_year` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8";
$query = mysql_query($sql_create);

$sql_create="CREATE TABLE `student_inclass_year` (
  `id` int(11) NOT NULL auto_increment,
  `student_check_year` int(11) NOT NULL,
  `num_period` int(2) NOT NULL,
  `lunch_period` int(2) NOT NULL,
  `year_active` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `student_check_year` (`student_check_year`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1" ;
$query = mysql_query($sql_create);
?>