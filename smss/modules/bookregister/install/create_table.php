<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );

//ส่วนการสร้างตารางระบบย่อย
$sql_create="CREATE TABLE IF NOT EXISTS `bookregister_certificate` (
  `ms_id` int(11) NOT NULL AUTO_INCREMENT,
  `year` int(11) NOT NULL,
  `register_number` int(11) NOT NULL,
  `book_no` varchar(50) NOT NULL,
  `signdate` date NOT NULL,
  `name_cer` varchar(150) NOT NULL,
  `subject` varchar(150) NOT NULL,
  `subject2` varchar(250) NOT NULL,
  `comment` varchar(100) DEFAULT NULL,
  `sign_person` varchar(4) NOT NULL,
  `register_date` date NOT NULL,
  `officer` varchar(13) DEFAULT NULL,
  `file_name` varchar(50) DEFAULT NULL,
  `khet_print` tinyint(4) NOT NULL DEFAULT '0',
  `check_status` tinyint(4) NOT NULL DEFAULT '0',
  `quarantee` tinyint(4) NOT NULL DEFAULT '0',
  `quarantee_person` varchar(13) NOT NULL,
  `quarantee_date` date NOT NULL,
  PRIMARY KEY (`ms_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
$query = mysql_query($sql_create);

$sql_create="CREATE TABLE IF NOT EXISTS `bookregister_office_no` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `office_no` varchar(100) NOT NULL,
  `school_code` varchar(15) DEFAULT NULL,
  `officer` varchar(13) DEFAULT NULL,
  `rec_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1" ;
$query = mysql_query($sql_create);

$sql_create="INSERT INTO `bookregister_office_no` (`id`, `office_no`, `school_code`, `officer`, `rec_date`) VALUES ('1', 'ที่ ศธ1234/', NULL, NULL, NULL)";

$query = mysql_query($sql_create);

$sql_create="CREATE TABLE IF NOT EXISTS `bookregister_cer_officer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `person_id` varchar(13) NOT NULL,
  `p1` tinyint(4) NOT NULL,
  `officer` varchar(13) NOT NULL,
  `rec_date` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `person_id` (`person_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1" ;
$query = mysql_query($sql_create);

$sql_create="CREATE TABLE IF NOT EXISTS `bookregister_cer_sign` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(13) NOT NULL,
  `name` varchar(200) NOT NULL,
  `position1` varchar(200) NOT NULL,
  `position2` varchar(200) NOT NULL,
  `sign_pic` varchar(150) NOT NULL,
  `sign_now` tinyint(4) NOT NULL DEFAULT '0',
  `officer` varchar(13) NOT NULL,
  `rec_date` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1" ;
$query = mysql_query($sql_create);

$sql_create="CREATE TABLE IF NOT EXISTS `bookregister_command` (
  `ms_id` int(11) NOT NULL AUTO_INCREMENT,
  `year` int(11) NOT NULL,
  `register_number` int(11) NOT NULL,
  `book_no` varchar(50) NOT NULL,
  `signdate` date NOT NULL,
  `subject` varchar(150) NOT NULL,
  `comment` varchar(100) DEFAULT NULL,
  `register_date` date NOT NULL,
  `officer` varchar(13) DEFAULT NULL,
  `file_name` varchar(100) DEFAULT NULL,
  `file_des` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ms_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1" ;
$query = mysql_query($sql_create);

$sql_create="CREATE TABLE IF NOT EXISTS `bookregister_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `person_id` varchar(13) NOT NULL,
  `p1` tinyint(4) NOT NULL,
  `p2` tinyint(4) DEFAULT NULL,
  `school_code` varchar(15) DEFAULT NULL,
  `officer` varchar(13) NOT NULL,
  `rec_date` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `person_id` (`person_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1" ;
$query = mysql_query($sql_create);

$sql_create="CREATE TABLE IF NOT EXISTS `bookregister_receive` (
  `ms_id` int(11) NOT NULL AUTO_INCREMENT,
  `year` int(11) NOT NULL,
  `register_number` int(11) NOT NULL,
  `book_no` varchar(50) NOT NULL,
  `signdate` date NOT NULL,
  `book_from` varchar(200) NOT NULL,
  `book_to` varchar(200) NOT NULL,
  `subject` varchar(150) NOT NULL,
  `operation` varchar(150) DEFAULT NULL,
  `workgroup` tinyint(4) NOT NULL DEFAULT '0',
  `record_type` tinyint(4) NOT NULL DEFAULT '0',
  `comment` varchar(100) DEFAULT NULL,
  `register_date` date NOT NULL,
  `ref_id` varchar(50) NOT NULL,
  `officer` varchar(13) DEFAULT NULL,
  `book_link` tinyint(4) NOT NULL DEFAULT '0',
  `secret` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ms_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1" ;
$query = mysql_query($sql_create);

$sql_create="CREATE TABLE IF NOT EXISTS `bookregister_receive_filebook` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_id` varchar(50) NOT NULL,
  `file_name` varchar(100) NOT NULL,
  `file_des` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
$query = mysql_query($sql_create);

$sql_create="CREATE TABLE IF NOT EXISTS `bookregister_send` (
  `ms_id` int(11) NOT NULL AUTO_INCREMENT,
  `year` int(11) NOT NULL,
  `register_number` int(11) NOT NULL,
  `book_no` varchar(50) NOT NULL,
  `signdate` date NOT NULL,
  `book_from` varchar(200) NOT NULL,
  `book_to` varchar(200) NOT NULL,
  `subject` varchar(150) NOT NULL,
  `operation` varchar(150) DEFAULT NULL,
  `workgroup` tinyint(4) NOT NULL DEFAULT '0',
  `comment` varchar(100) DEFAULT NULL,
  `register_date` date NOT NULL,
  `ref_id` varchar(50) NOT NULL,
  `officer` varchar(13) DEFAULT NULL,
  `secret` tinyint(4) NOT NULL DEFAULT '0',
  `office_type` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ms_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
$query = mysql_query($sql_create);

$sql_create="CREATE TABLE IF NOT EXISTS `bookregister_send_filebook` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_id` varchar(50) NOT NULL,
  `file_name` varchar(100) NOT NULL,
  `file_des` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
$query = mysql_query($sql_create);

$sql_create="CREATE TABLE IF NOT EXISTS `bookregister_year` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year` int(11) NOT NULL,
  `year_active` tinyint(4) NOT NULL DEFAULT '0',
  `start_receive_num` int(11) NOT NULL DEFAULT '1',
  `start_send_num` int(11) NOT NULL DEFAULT '1',
  `start_command_num` int(11) NOT NULL DEFAULT '1',
  `start_cer_num` int(11) NOT NULL DEFAULT '1',
  `school_code` varchar(15) DEFAULT NULL,
  `officer` varchar(13) DEFAULT NULL,
  `rec_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
$query = mysql_query($sql_create);

?>