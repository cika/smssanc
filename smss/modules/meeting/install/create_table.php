<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );

//ส่วนการสร้างตารางระบบย่อย
$sql_create="CREATE TABLE IF NOT EXISTS `meeting_main` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room` tinyint(4) NOT NULL,
  `book_date` date NOT NULL,
  `start_time` tinyint(4) NOT NULL,
  `finish_time` tinyint(4) NOT NULL,
  `objective` varchar(200) NOT NULL,
  `book_person` varchar(13) NOT NULL,
  `rec_date` datetime NOT NULL,
  `approve` int(11) DEFAULT NULL,
  `reason` varchar(200) DEFAULT NULL,
  `person_num` int(11) NOT NULL,
  `other` varchar(250) NOT NULL,
  `officer` varchar(13) DEFAULT NULL,
  `officer_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1" ;
$query = mysql_query($sql_create);

$sql_create="CREATE TABLE `meeting_permission` (
  `id` int(11) NOT NULL auto_increment,
  `person_id` varchar(13) NOT NULL,
  `p1` tinyint(4) NOT NULL,
  `officer` varchar(13) NOT NULL,
  `rec_date` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1" ;
$query = mysql_query($sql_create);

$sql_create="CREATE TABLE `meeting_room` (
  `id` int(11) NOT NULL auto_increment,
  `room_code` tinyint(4) NOT NULL,
  `room_name` varchar(100) NOT NULL,
  `active` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1" ;
$query = mysql_query($sql_create);

$sql_create="INSERT INTO `meeting_room` VALUES (1, 1, 'ห้องประชุม1', 1)";
$query = mysql_query($sql_create);
$sql_create="INSERT INTO `meeting_room` VALUES (2, 2, 'ห้องประชุม2', 0)";
$query = mysql_query($sql_create);
$sql_create="INSERT INTO `meeting_room` VALUES (3, 3, 'ห้องประชุม3', 0)";
$query = mysql_query($sql_create);
$sql_create="INSERT INTO `meeting_room` VALUES (4, 4, 'หอ้งประชุม4', 0)";
$query = mysql_query($sql_create);
$sql_create="INSERT INTO `meeting_room` VALUES (5, 5, 'ห้องประชุม5', 0)";
$query = mysql_query($sql_create);
$sql_create="INSERT INTO `meeting_room` VALUES (6, 6, 'ห้องประชุม6', 0)";
$query = mysql_query($sql_create);
$sql_create="INSERT INTO `meeting_room` VALUES (7, 7, 'ห้องประชุม7', 0)";
$query = mysql_query($sql_create);
$sql_create="INSERT INTO `meeting_room` VALUES (8, 8, 'ห้องประชุม8', 0)";
$query = mysql_query($sql_create);
$sql_create="INSERT INTO `meeting_room` VALUES (9, 9, 'ห้องประชุม9', 0)";
$query = mysql_query($sql_create);
$sql_create="INSERT INTO `meeting_room` VALUES (10, 10, 'ห้องประชุม10', 0)";
$query = mysql_query($sql_create);

?>