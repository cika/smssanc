<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );

//ส่วนการสร้างตารางระบบย่อย
$sql_create="CREATE TABLE `news_mainitem` (
  `id` int(11) NOT NULL auto_increment,
  `code` int(11) NOT NULL,
  `mainitem` varchar(150) NOT NULL,
  `item_active` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
$dbquery = mysql_db_query($dbname, $sql_create);

$sql_create="CREATE TABLE `news_news` (
  `id` int(11) NOT NULL auto_increment,
  `report_date` datetime NOT NULL,
  `news` varchar(250) NOT NULL,
  `file` varchar(150) NOT NULL,
  `section` int(11) NOT NULL,
  `mainitem_code` int(11) NOT NULL,
  `officer` varchar(13) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
$dbquery = mysql_db_query($dbname, $sql_create);

$sql_create="CREATE TABLE `news_permission` (
  `id` int(11) NOT NULL auto_increment,
  `person_id` varchar(13) NOT NULL,
  `p1` tinyint(4) NOT NULL,
  `officer` varchar(13) NOT NULL,
  `rec_date` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1"; 
$dbquery = mysql_db_query($dbname, $sql_create);

$sql_create="CREATE TABLE `news_section` (
  `id` int(11) NOT NULL auto_increment,
  `code` tinyint(4) NOT NULL,
  `name` varchar(100) NOT NULL,
  `mainitem_code` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1"; 
$dbquery = mysql_db_query($dbname, $sql_create);

?>