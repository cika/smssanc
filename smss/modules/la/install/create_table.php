<?
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );

//ส่วนการสร้างตารางระบบย่อย
$sql_create="CREATE TABLE `la_cancel` (
  `id` int(11) NOT NULL auto_increment,
  `person_id` varchar(13) NOT NULL,
  `la_type` tinyint(4) NOT NULL,
  `write_at` varchar(100) default NULL,
  `permission_start` date NOT NULL,
  `permission_finish` date NOT NULL,
  `permission_total` int(11) NOT NULL,
  `because` varchar(200) NOT NULL,
  `cancel_la_start` date NOT NULL,
  `cancel_la_finish` date NOT NULL,
  `cancel_la_total` int(11) NOT NULL,
  `no_comment` int(11) NOT NULL default '0',
  `grant_p_selected` varchar(13) default NULL,
  `rec_date` datetime NOT NULL,
  `officer_comment` varchar(200) default NULL,
  `officer_sign` varchar(13) default NULL,
  `officer_date` datetime default NULL,
  `group_comment` varchar(100) default NULL,
  `group_sign` varchar(13) default NULL,
  `group_date` datetime default NULL,
  `comment_date` datetime default NULL,
  `commander_grant` tinyint(4) default NULL,
  `commander_comment` varchar(100) default NULL,
  `commander_sign` varchar(13) default NULL,
  `grant_date` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
$query = mysql_query($sql_create);

$sql_create="CREATE TABLE `la_main` (
  `id` int(11) NOT NULL auto_increment,
  `person_id` varchar(13) NOT NULL,
  `la_type` tinyint(4) NOT NULL,
  `write_at` varchar(100) default NULL,
  `because` varchar(250) default NULL,
  `la_start` date NOT NULL,
  `la_finish` date NOT NULL,
  `la_total` int(11) NOT NULL,
  `last_la_start` date default NULL,
  `last_la_finish` date default NULL,
  `last_la_total` int(11) default NULL,
  `contact` varchar(150) default NULL,
  `contact_tel` varchar(20) default NULL,
  `document` varchar(100) default NULL,
  `no_comment` tinyint(4) NOT NULL default '0',
  `grant_p_selected` varchar(13) default NULL,
  `sick_ago` int(11) default NULL,
  `sick_this` int(11) default NULL,
  `sick_total` int(11) default NULL,
  `privacy_ago` int(11) default NULL,
  `privacy_this` int(11) default NULL,
  `privacy_total` int(11) default NULL,
  `birth_ago` int(11) default NULL,
  `birth_this` int(11) default NULL,
  `birth_total` int(11) default NULL,
  `relax_ago` int(11) default NULL,
  `relax_this` int(11) default NULL,
  `relax_total` int(11) default NULL,
  `relax_collect` tinyint(4) default NULL,
  `relax_this_year` tinyint(4) default NULL,
  `job_person` varchar(13) default NULL,
  `job_person_sign` tinyint(4) NOT NULL default '0',
  `rec_date` datetime NOT NULL,
  `officer_comment` varchar(200) default NULL,
  `officer_sign` varchar(13) default NULL,
  `officer_date` datetime default NULL,
  `group_comment` varchar(100) default NULL,
  `group_sign` varchar(13) default NULL,
  `group_date` datetime default NULL,
  `comment_date` datetime default NULL,
  `commander_grant` tinyint(4) default NULL,
  `commander_comment` varchar(100) default NULL,
  `commander_sign` varchar(13) default NULL,
  `grant_date` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1" ;
$query = mysql_query($sql_create);

$sql_create="CREATE TABLE `la_permission` (
  `id` int(11) NOT NULL auto_increment,
  `person_id` varchar(13) NOT NULL,
  `p1` tinyint(4) NOT NULL,
  `officer` varchar(13) NOT NULL,
  `rec_date` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1" ;
$query = mysql_query($sql_create);

$sql_create="CREATE TABLE `la_person_set` (
  `id` int(11) NOT NULL auto_increment,
  `person_id` varchar(13) NOT NULL,
  `comment_person` varchar(13) default NULL,
  `grant_person` varchar(13) default NULL,
  `officer` varchar(13) default NULL,
  `rec_date` date default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `person_id` (`person_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1" ;
$query = mysql_query($sql_create);

$sql_create="CREATE TABLE `la_year` (
  `id` int(11) NOT NULL auto_increment,
  `budget_year` int(11) NOT NULL,
  `year_active` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `budget_year` (`budget_year`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1" ;
$query = mysql_query($sql_create);

$sql_create="CREATE TABLE `la_collect` (
  `id` int(11) NOT NULL auto_increment,
  `year` int(11) NOT NULL,
  `person_id` varchar(13) NOT NULL,
  `collect_day` tinyint(4) NOT NULL default '0',
  `this_year_day` tinyint(4) NOT NULL default '0',
  `officer` varchar(13) default NULL,
  `rec_date` date default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1" ;
$query = mysql_query($sql_create);

?>