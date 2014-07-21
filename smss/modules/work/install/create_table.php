<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );

//ส่วนการสร้างตารางระบบย่อย
$sql_create="CREATE TABLE `work_main` (
  `id` int(11) NOT NULL auto_increment,
  `work_date` date NOT NULL,
  `person_id` varchar(13) NOT NULL,
  `work` tinyint(4) NOT NULL default '0',
  `comment` varchar(150) default NULL,
  `rec_date` datetime NOT NULL,
  `officer` varchar(13) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1" ;
$query = mysql_query($sql_create);

$sql_create="CREATE TABLE `work_permission` (
  `id` int(11) NOT NULL auto_increment,
  `person_id` varchar(13) NOT NULL,
  `p1` tinyint(4) NOT NULL,
  `officer` varchar(13) NOT NULL,
  `rec_date` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1" ;
$query = mysql_query($sql_create);
?>