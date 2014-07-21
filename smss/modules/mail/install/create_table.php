<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );

//ส่วนการสร้างตารางระบบย่อย
$sql_create="CREATE TABLE `mail_filebook` (
  `id` int(11) NOT NULL auto_increment,
  `ref_id` varchar(50) NOT NULL,
  `file_name` varchar(100) NOT NULL,
  `file_des` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1" ;
$query = mysql_query($sql_create);

$sql_create="CREATE TABLE `mail_group` (
  `grp_id` int(11) NOT NULL auto_increment,
  `grp_name` varchar(50) NOT NULL,
  PRIMARY KEY  (`grp_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
$query = mysql_query($sql_create);

$sql_create="CREATE TABLE `mail_group_member` (
  `id` int(11) NOT NULL auto_increment,
  `grp_id` int(11) NOT NULL,
  `person_id` varchar(13) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1" ;
$query = mysql_query($sql_create);

$sql_create="CREATE TABLE IF NOT EXISTS `mail_main` (
  `ms_id` int(11) NOT NULL AUTO_INCREMENT,
  `sender` varchar(13) NOT NULL,
  `subject` varchar(150) NOT NULL,
  `detail` text,
  `ref_id` varchar(50) NOT NULL,
  `send_date` datetime NOT NULL,
  PRIMARY KEY (`ms_id`),
  KEY `ref_id` (`ref_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1" ;
$query = mysql_query($sql_create);

$sql_create="CREATE TABLE `mail_permission` (
  `id` int(11) NOT NULL auto_increment,
  `person_id` varchar(13) NOT NULL,
  `p1` tinyint(4) NOT NULL,
  `officer` varchar(13) NOT NULL,
  `rec_date` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1" ;
$query = mysql_query($sql_create);

$sql_create="CREATE TABLE IF NOT EXISTS `mail_sendto_answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_id` varchar(50) NOT NULL,
  `send_to` varchar(13) NOT NULL,
  `answer` tinyint(4) NOT NULL DEFAULT '0',
  `answer_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ref_id` (`ref_id`),
  KEY `send_to` (`send_to`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1" ;
$query = mysql_query($sql_create);

?>