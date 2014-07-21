<?php
if($result_version['smss_version']<1.0){
$sql="ALTER TABLE `health_checking` ADD `life` VARCHAR( 10 ) NOT NULL ,
ADD `push` VARCHAR( 10 ) NOT NULL ,
ADD `sit` VARCHAR( 10 ) NOT NULL ,
ADD `roll` VARCHAR( 10 ) NOT NULL ,
ADD `run` VARCHAR( 10 ) NOT NULL ,
ADD `person_check` VARCHAR( 255 ) NOT NULL" ;
$dbquery = mysql_query($sql);

$sql="ALTER TABLE `savings_money` ADD `rec_officer` VARCHAR( 13 ) NULL" ;
$dbquery = mysql_query($sql);

$sql="ALTER TABLE `student_main` ADD `sex` TINYINT NOT NULL DEFAULT '0' AFTER `person_id`" ;
$dbquery = mysql_query($sql);

$sql="ALTER TABLE `student_main` ADD `pic` VARCHAR( 150 ) NULL AFTER `sex`" ;
$dbquery = mysql_query($sql);

$sql="ALTER TABLE `student_main` ADD `out_edyear` INT NULL AFTER `status`" ;
$dbquery = mysql_query($sql);

$sql="ALTER TABLE `student_main` CHANGE `status` `status` TINYINT( 4 ) NOT NULL DEFAULT '0' "; 
$dbquery = mysql_query($sql);

$sql="ALTER TABLE `person_main` ADD `pic` VARCHAR( 150 ) NULL AFTER `position_code` ";
$dbquery = mysql_query($sql);

$sql="ALTER TABLE `person_main` ADD `person_order` TINYINT NOT NULL DEFAULT '0' AFTER `status` ";
$dbquery = mysql_query($sql);

$sql="ALTER TABLE `person_main` CHANGE `status` `status` TINYINT( 4 ) NOT NULL DEFAULT '0' ";
$dbquery = mysql_query($sql);

$sql="CREATE TABLE `student_main_classlog` (
  `id` int(11) NOT NULL auto_increment,
  `ed_year` int(11) NOT NULL,
  `student_id` varchar(7) NOT NULL,
  `student_number` int(11) default NULL,
  `class_code` tinyint(4) NOT NULL,
  `room` tinyint(4) default '0',
  `officer` varchar(13) NOT NULL,
  `rec_date` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 " ;
$dbquery = mysql_query($sql);

$sql="CREATE TABLE `student_main_edyear` (
  `id` int(11) NOT NULL auto_increment,
  `ed_year` int(11) NOT NULL,
  `year_active` tinyint(4) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `ed_year` (`ed_year`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 " ;
$dbquery = mysql_query($sql);
}
?>
