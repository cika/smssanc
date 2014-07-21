<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );

//ส่วนการสร้างตารางระบบย่อย
$sql_create="CREATE TABLE `cabinet_cabinet` (
  `id` int(11) NOT NULL auto_increment,
  `cabinet_id` int(11) NOT NULL,
  `cabinet_type` tinyint(4) NOT NULL,
  `cabinet_name` varchar(100) NOT NULL,
  `cabinet_size` double NOT NULL,
  `tray_size` double NOT NULL,
  `cabinet_person` varchar(13) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `cabinet_id` (`cabinet_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1" ;
$query = mysql_query($sql_create);

$sql_create="CREATE TABLE `cabinet_tray` (
  `id` int(11) NOT NULL auto_increment,
  `tray_id` bigint(20) NOT NULL,
  `cabinet_id` int(11) NOT NULL,
  `tray_name` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
$query = mysql_query($sql_create);

$sql_create="CREATE TABLE `cabinet_file` (
  `id` int(11) NOT NULL auto_increment,
  `file_id` int(11) NOT NULL,
  `tray_id` bigint(11) NOT NULL,
  `cabinet_id` int(11) NOT NULL,
  `file_name` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1" ;
$query = mysql_query($sql_create);

$sql_create="CREATE TABLE `cabinet_main` (
  `id` int(11) NOT NULL auto_increment,
  `file_id` int(11) NOT NULL,
  `tray_id` bigint(11) NOT NULL,
  `cabinet_id` int(11) NOT NULL,
  `cabinet_type` tinyint(4) NOT NULL,
  `doc_subject` varchar(150) NOT NULL,
  `doc_size` double NOT NULL,
  `doc_name` varchar(100) NOT NULL,
  `doc_type` varchar(10) NOT NULL,
  `status` tinyint(4) NOT NULL default '0',
  `person_id` varchar(13) NOT NULL,
  `rec_date` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1" ;
$query = mysql_query($sql_create);

$sql_create="CREATE TABLE `cabinet_permission` (
  `id` int(11) NOT NULL auto_increment,
  `person_id` varchar(13) NOT NULL,
  `p1` tinyint(4) default NULL,
  `officer` varchar(13) NOT NULL,
  `rec_date` date NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `person_id` (`person_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1" ;
$query = mysql_query($sql_create);

?>