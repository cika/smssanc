<?php
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );

//ส่วนการสร้างตารางระบบย่อย
$sql_create="CREATE TABLE `achievement_main` (
  `id` int(11) NOT NULL auto_increment,
  `test_type` tinyint(4) NOT NULL,
  `test_class` tinyint(4) NOT NULL,
  `ed_year` int(11) NOT NULL,
 `level` tinyint(4) NOT NULL,
  `thai` float NOT NULL default '0',
  `math` float NOT NULL default '0',
  `science` float NOT NULL default '0',
  `social` float NOT NULL default '0',
  `english` float NOT NULL default '0',
  `health` float NOT NULL default '0',
  `art` float NOT NULL default '0',
  `vocation` float NOT NULL default '0',
  `score_avg` float NOT NULL default '0',
  `officer` varchar(13) default NULL,
  `rec_date` date default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1" ;
$query = mysql_query($sql_create);

$sql_create="CREATE TABLE `achievement_permission` (
  `id` int(11) NOT NULL auto_increment,
  `person_id` varchar(13) NOT NULL,
  `p1` tinyint(4) NOT NULL,
  `p2` tinyint(4) NOT NULL,
  `p3` tinyint(4) NOT NULL,
  `officer` varchar(13) NOT NULL,
  `rec_date` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1" ;
$query = mysql_query($sql_create);

?>