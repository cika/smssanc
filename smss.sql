-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- โฮสต์: localhost
-- เวลาในการสร้าง: 
-- รุ่นของเซิร์ฟเวอร์: 5.0.51
-- รุ่นของ PHP: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- ฐานข้อมูล: `smss`
-- 

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `achievement_main`
-- 

CREATE TABLE `achievement_main` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `achievement_main`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `achievement_permission`
-- 

CREATE TABLE `achievement_permission` (
  `id` int(11) NOT NULL auto_increment,
  `person_id` varchar(13) NOT NULL,
  `p1` tinyint(4) NOT NULL,
  `p2` tinyint(4) NOT NULL,
  `p3` tinyint(4) NOT NULL,
  `officer` varchar(13) NOT NULL,
  `rec_date` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- dump ตาราง `achievement_permission`
-- 

INSERT INTO `achievement_permission` VALUES (1, '3341600218859', 1, 1, 1, '3341600218859', '2014-06-30');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `bookregister_certificate`
-- 

CREATE TABLE `bookregister_certificate` (
  `ms_id` int(11) NOT NULL auto_increment,
  `year` int(11) NOT NULL,
  `register_number` int(11) NOT NULL,
  `book_no` varchar(50) NOT NULL,
  `signdate` date NOT NULL,
  `name_cer` varchar(150) NOT NULL,
  `subject` varchar(150) NOT NULL,
  `subject2` varchar(250) NOT NULL,
  `comment` varchar(100) default NULL,
  `sign_person` varchar(4) NOT NULL,
  `register_date` date NOT NULL,
  `officer` varchar(13) default NULL,
  `file_name` varchar(50) default NULL,
  `khet_print` tinyint(4) NOT NULL default '0',
  `check_status` tinyint(4) NOT NULL default '0',
  `quarantee` tinyint(4) NOT NULL default '0',
  `quarantee_person` varchar(13) NOT NULL,
  `quarantee_date` date NOT NULL,
  PRIMARY KEY  (`ms_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `bookregister_certificate`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `bookregister_cer_officer`
-- 

CREATE TABLE `bookregister_cer_officer` (
  `id` int(11) NOT NULL auto_increment,
  `person_id` varchar(13) NOT NULL,
  `p1` tinyint(4) NOT NULL,
  `officer` varchar(13) NOT NULL,
  `rec_date` date NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `person_id` (`person_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- dump ตาราง `bookregister_cer_officer`
-- 

INSERT INTO `bookregister_cer_officer` VALUES (1, '3341600218859', 1, '3341600218859', '2014-06-30');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `bookregister_cer_sign`
-- 

CREATE TABLE `bookregister_cer_sign` (
  `id` int(11) NOT NULL auto_increment,
  `code` varchar(13) NOT NULL,
  `name` varchar(200) NOT NULL,
  `position1` varchar(200) NOT NULL,
  `position2` varchar(200) NOT NULL,
  `sign_pic` varchar(150) NOT NULL,
  `sign_now` tinyint(4) NOT NULL default '0',
  `officer` varchar(13) NOT NULL,
  `rec_date` date NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- dump ตาราง `bookregister_cer_sign`
-- 

INSERT INTO `bookregister_cer_sign` VALUES (1, '1', 'นายจักรทิพย์  กีฬา', 'ผู้อำนวยการ', 'โรงเรียนอำนาจเจริญ', '', 1, '3341600218859', '2014-06-30');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `bookregister_command`
-- 

CREATE TABLE `bookregister_command` (
  `ms_id` int(11) NOT NULL auto_increment,
  `year` int(11) NOT NULL,
  `register_number` int(11) NOT NULL,
  `book_no` varchar(50) NOT NULL,
  `signdate` date NOT NULL,
  `subject` varchar(150) NOT NULL,
  `comment` varchar(100) default NULL,
  `register_date` date NOT NULL,
  `officer` varchar(13) default NULL,
  `file_name` varchar(100) default NULL,
  `file_des` varchar(100) default NULL,
  PRIMARY KEY  (`ms_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `bookregister_command`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `bookregister_office_no`
-- 

CREATE TABLE `bookregister_office_no` (
  `id` int(11) NOT NULL auto_increment,
  `office_no` varchar(100) NOT NULL,
  `school_code` varchar(15) default NULL,
  `officer` varchar(13) default NULL,
  `rec_date` date default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- dump ตาราง `bookregister_office_no`
-- 

INSERT INTO `bookregister_office_no` VALUES (1, 'ที่ ศธ1234/', NULL, NULL, NULL);

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `bookregister_permission`
-- 

CREATE TABLE `bookregister_permission` (
  `id` int(11) NOT NULL auto_increment,
  `person_id` varchar(13) NOT NULL,
  `p1` tinyint(4) NOT NULL,
  `p2` tinyint(4) default NULL,
  `school_code` varchar(15) default NULL,
  `officer` varchar(13) NOT NULL,
  `rec_date` date NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `person_id` (`person_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- dump ตาราง `bookregister_permission`
-- 

INSERT INTO `bookregister_permission` VALUES (1, '3341600218859', 1, NULL, NULL, '3341600218859', '2014-06-30');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `bookregister_receive`
-- 

CREATE TABLE `bookregister_receive` (
  `ms_id` int(11) NOT NULL auto_increment,
  `year` int(11) NOT NULL,
  `register_number` int(11) NOT NULL,
  `book_no` varchar(50) NOT NULL,
  `signdate` date NOT NULL,
  `book_from` varchar(200) NOT NULL,
  `book_to` varchar(200) NOT NULL,
  `subject` varchar(150) NOT NULL,
  `operation` varchar(150) default NULL,
  `workgroup` tinyint(4) NOT NULL default '0',
  `record_type` tinyint(4) NOT NULL default '0',
  `comment` varchar(100) default NULL,
  `register_date` date NOT NULL,
  `ref_id` varchar(50) NOT NULL,
  `officer` varchar(13) default NULL,
  `book_link` tinyint(4) NOT NULL default '0',
  `secret` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`ms_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `bookregister_receive`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `bookregister_receive_filebook`
-- 

CREATE TABLE `bookregister_receive_filebook` (
  `id` int(11) NOT NULL auto_increment,
  `ref_id` varchar(50) NOT NULL,
  `file_name` varchar(100) NOT NULL,
  `file_des` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `bookregister_receive_filebook`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `bookregister_send`
-- 

CREATE TABLE `bookregister_send` (
  `ms_id` int(11) NOT NULL auto_increment,
  `year` int(11) NOT NULL,
  `register_number` int(11) NOT NULL,
  `book_no` varchar(50) NOT NULL,
  `signdate` date NOT NULL,
  `book_from` varchar(200) NOT NULL,
  `book_to` varchar(200) NOT NULL,
  `subject` varchar(150) NOT NULL,
  `operation` varchar(150) default NULL,
  `workgroup` tinyint(4) NOT NULL default '0',
  `comment` varchar(100) default NULL,
  `register_date` date NOT NULL,
  `ref_id` varchar(50) NOT NULL,
  `officer` varchar(13) default NULL,
  `secret` tinyint(4) NOT NULL default '0',
  `office_type` tinyint(4) NOT NULL default '1',
  PRIMARY KEY  (`ms_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `bookregister_send`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `bookregister_send_filebook`
-- 

CREATE TABLE `bookregister_send_filebook` (
  `id` int(11) NOT NULL auto_increment,
  `ref_id` varchar(50) NOT NULL,
  `file_name` varchar(100) NOT NULL,
  `file_des` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `bookregister_send_filebook`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `bookregister_year`
-- 

CREATE TABLE `bookregister_year` (
  `id` int(11) NOT NULL auto_increment,
  `year` int(11) NOT NULL,
  `year_active` tinyint(4) NOT NULL default '0',
  `start_receive_num` int(11) NOT NULL default '1',
  `start_send_num` int(11) NOT NULL default '1',
  `start_command_num` int(11) NOT NULL default '1',
  `start_cer_num` int(11) NOT NULL default '1',
  `school_code` varchar(15) default NULL,
  `officer` varchar(13) default NULL,
  `rec_date` date default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- dump ตาราง `bookregister_year`
-- 

INSERT INTO `bookregister_year` VALUES (1, 2557, 1, 1, 1, 1, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `budget_bud`
-- 

CREATE TABLE `budget_bud` (
  `id` int(11) NOT NULL auto_increment,
  `budget_year` int(11) NOT NULL,
  `doc` varchar(50) NOT NULL,
  `refer_wd_id` int(11) NOT NULL,
  `status` tinyint(11) default NULL,
  `bud_type_id` int(11) default NULL,
  `item` varchar(150) default NULL,
  `receive_amount` double default NULL,
  `pay_amount` double default NULL,
  `payed_person` varchar(50) NOT NULL,
  `pay_group` int(4) default NULL,
  `rec_date` date NOT NULL,
  `officer` varchar(13) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `budget_bud`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `budget_category`
-- 

CREATE TABLE `budget_category` (
  `id` int(11) NOT NULL auto_increment,
  `category_id` int(11) NOT NULL,
  `category_name` varchar(30) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `category_id` (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- 
-- dump ตาราง `budget_category`
-- 

INSERT INTO `budget_category` VALUES (1, 1, 'เงินนอกงบประมาณ');
INSERT INTO `budget_category` VALUES (2, 2, 'เงินงบประมาณ');
INSERT INTO `budget_category` VALUES (3, 3, 'เงินรายได้แผ่นดิน');
INSERT INTO `budget_category` VALUES (6, 4, 'วงเงินงบประมาณที่ได้รับจัดสรร');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `budget_deega`
-- 

CREATE TABLE `budget_deega` (
  `id` int(11) NOT NULL auto_increment,
  `budget_year` int(11) NOT NULL,
  `deega_num` float NOT NULL default '0',
  `doc` varchar(20) NOT NULL,
  `receive_num` char(3) NOT NULL default '',
  `plan` char(2) NOT NULL default '',
  `project` varchar(20) NOT NULL,
  `activity` varchar(20) NOT NULL,
  `pay_group` char(3) NOT NULL default '',
  `item` varchar(50) NOT NULL default '',
  `withdraw` double NOT NULL default '0',
  `tax` double NOT NULL default '0',
  `pay` double NOT NULL default '0',
  `officer` varchar(13) NOT NULL,
  `rec_date` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `budget_deega`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `budget_main`
-- 

CREATE TABLE `budget_main` (
  `id` int(11) NOT NULL auto_increment,
  `budget_year` int(11) NOT NULL,
  `doc` varchar(30) NOT NULL,
  `refer_wd_id` int(11) default NULL,
  `type_id` int(11) NOT NULL,
  `item` varchar(100) NOT NULL,
  `receive_amount` double default NULL,
  `pay_amount` double default NULL,
  `payed_person` varchar(50) NOT NULL,
  `change_amount` double default NULL,
  `pay_group` int(4) default NULL,
  `status` tinyint(4) NOT NULL,
  `rec_date` date NOT NULL,
  `officer` varchar(13) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `budget_main`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `budget_money_return`
-- 

CREATE TABLE `budget_money_return` (
  `id` int(11) NOT NULL auto_increment,
  `budget_year` int(11) default NULL,
  `document` varchar(30) NOT NULL default '',
  `item` varchar(100) NOT NULL default '',
  `pj_activity` varchar(20) NOT NULL default '',
  `money` double NOT NULL default '0',
  `pay_type` varchar(10) NOT NULL,
  `p_request` varchar(13) NOT NULL default '',
  `officer` varchar(13) NOT NULL default '',
  `rec_date` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `budget_money_return`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `budget_pay_type`
-- 

CREATE TABLE `budget_pay_type` (
  `id` int(11) NOT NULL auto_increment,
  `pay_type_id` int(11) NOT NULL,
  `pay_group_id` tinyint(4) NOT NULL,
  `pay_type_name` varchar(30) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `pay_type_id` (`pay_type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

-- 
-- dump ตาราง `budget_pay_type`
-- 

INSERT INTO `budget_pay_type` VALUES (1, 101, 1, 'เงินเดือน');
INSERT INTO `budget_pay_type` VALUES (15, 102, 1, 'ค่าจ้างประจำ');
INSERT INTO `budget_pay_type` VALUES (3, 103, 1, 'ค่าจ้างชั่วคราว');
INSERT INTO `budget_pay_type` VALUES (4, 104, 1, 'ค่าตอบแทนพนักงานราชการ');
INSERT INTO `budget_pay_type` VALUES (5, 201, 2, 'ค่าตอบแทน');
INSERT INTO `budget_pay_type` VALUES (6, 202, 2, 'ค่าใช้สอย');
INSERT INTO `budget_pay_type` VALUES (7, 203, 2, 'ค่าวัสดุ');
INSERT INTO `budget_pay_type` VALUES (8, 204, 2, 'ค่าสาธารณูปโภค');
INSERT INTO `budget_pay_type` VALUES (9, 301, 3, 'ค่าครุภัณฑ์');
INSERT INTO `budget_pay_type` VALUES (10, 302, 3, 'ค่าที่ดินและสิ่งก่อสร้าง');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `budget_permission`
-- 

CREATE TABLE `budget_permission` (
  `id` int(11) NOT NULL auto_increment,
  `person_id` varchar(13) NOT NULL,
  `p1` tinyint(4) NOT NULL,
  `p2` tinyint(4) NOT NULL,
  `p3` tinyint(4) NOT NULL,
  `p4` tinyint(4) NOT NULL,
  `officer` varchar(13) NOT NULL,
  `rec_date` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- dump ตาราง `budget_permission`
-- 

INSERT INTO `budget_permission` VALUES (1, '3341600218859', 1, 1, 1, 1, '3341600218859', '2014-06-30');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `budget_project`
-- 

CREATE TABLE `budget_project` (
  `id` int(11) NOT NULL auto_increment,
  `budget_year` int(11) NOT NULL,
  `code` varchar(16) NOT NULL default '',
  `name` varchar(80) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `budget_project`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `budget_receive`
-- 

CREATE TABLE `budget_receive` (
  `id` int(11) NOT NULL auto_increment,
  `budget_year` int(11) NOT NULL,
  `num` float NOT NULL default '0',
  `book_number` varchar(30) NOT NULL default '',
  `out_date` varchar(50) NOT NULL default '',
  `book_ref` varchar(30) NOT NULL default '',
  `plan` char(1) NOT NULL default '',
  `project` varchar(16) NOT NULL default '',
  `activity` varchar(50) NOT NULL default '',
  `activity2` varchar(200) NOT NULL default '',
  `m_source` varchar(7) NOT NULL default '',
  `account` varchar(30) NOT NULL default '',
  `m_pay` char(3) NOT NULL default '',
  `item` varchar(250) NOT NULL default '',
  `detail` varchar(250) NOT NULL default '',
  `money` double NOT NULL default '0',
  `rec_date` date default NULL,
  `officer` varchar(13) NOT NULL default '',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `num` (`num`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `budget_receive`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `budget_type`
-- 

CREATE TABLE `budget_type` (
  `id` int(11) NOT NULL auto_increment,
  `type_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `type_name` varchar(70) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `type_id` (`type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=49 ;

-- 
-- dump ตาราง `budget_type`
-- 

INSERT INTO `budget_type` VALUES (1, 101, 1, 'เงินรายได้สถานศึกษา');
INSERT INTO `budget_type` VALUES (2, 102, 1, 'เงินบริจาค');
INSERT INTO `budget_type` VALUES (33, 103, 1, 'เงินภาษีหัก ณ ที่จ่าย');
INSERT INTO `budget_type` VALUES (4, 104, 1, 'เงินลูกเสือ');
INSERT INTO `budget_type` VALUES (34, 105, 1, 'เงินเนตรนารี');
INSERT INTO `budget_type` VALUES (6, 106, 1, 'เงินยุวกาชาด');
INSERT INTO `budget_type` VALUES (7, 107, 1, 'เงินประกันสัญญา');
INSERT INTO `budget_type` VALUES (8, 108, 1, 'เงินอุดหนุนทั่วไป(ค่าใช้จ่ายรายหัวก่อนประถมศึกษา)');
INSERT INTO `budget_type` VALUES (47, 119, 1, 'เงินบริจาคมีวัตถุประสงค์');
INSERT INTO `budget_type` VALUES (38, 304, 3, 'รายได้เบ็ดเตล็ดอื่น');
INSERT INTO `budget_type` VALUES (14, 301, 3, 'ค่าขายของเบ็ดเตล็ด');
INSERT INTO `budget_type` VALUES (36, 302, 3, 'ค่าธรรมเนียมเบ็ดเตล็ด');
INSERT INTO `budget_type` VALUES (37, 303, 3, 'เงินเหลือจ่ายปีเก่าส่งคืน');
INSERT INTO `budget_type` VALUES (29, 109, 1, 'เงินอุดหนุนทั่วไป(ค่าใช้จ่ายรายหัวประถมศึกษา)');
INSERT INTO `budget_type` VALUES (23, 112, 1, 'เงินอุดหนุนทั่วไป(ปัจจัยพื้นฐานนักเรียนยากจนประถมศึกษา)');
INSERT INTO `budget_type` VALUES (24, 113, 1, 'เงินอุดหนุนทั่วไป(ปัจจัยพื้นฐานนักเรียนยากจนมัธยมต้น)');
INSERT INTO `budget_type` VALUES (25, 114, 1, 'เรียนฟรี15ปี(ค่าหนังสือเรียน)');
INSERT INTO `budget_type` VALUES (26, 115, 1, 'เรียนฟรี15ปี(ค่าอุปกรณ์การเรียน)');
INSERT INTO `budget_type` VALUES (27, 116, 1, 'เรียนฟรี15ปี(ค่าเครื่องแบบนักเรียน)');
INSERT INTO `budget_type` VALUES (28, 117, 1, 'เรียนฟรี15ปี(ค่ากิจกรรมพัฒนาผู้เรียน)');
INSERT INTO `budget_type` VALUES (30, 110, 1, 'เงินอุดหนุนทั่วไป(ค่าใช้จ่ายรายหัวมัธยมศึกษาตอนต้น)');
INSERT INTO `budget_type` VALUES (31, 111, 1, 'เงินอุดหนุนทั่วไป(ค่าใช้จ่ายรายหัวมัธยมศึกษาตอนปลาย)');
INSERT INTO `budget_type` VALUES (35, 118, 1, 'เงินอาหารกลางวัน');
INSERT INTO `budget_type` VALUES (48, 120, 1, 'เงินอุดหนุนที่ได้รับจากอบต./เทศบาล');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `budget_withdraw`
-- 

CREATE TABLE `budget_withdraw` (
  `id` int(11) NOT NULL auto_increment,
  `budget_year` int(11) default NULL,
  `document` varchar(30) NOT NULL default '',
  `item` varchar(100) NOT NULL default '',
  `pj_activity` varchar(20) NOT NULL default '',
  `money` double NOT NULL default '0',
  `pay_type` varchar(10) NOT NULL,
  `p_request` varchar(50) NOT NULL,
  `status` tinyint(4) default '0',
  `officer` varchar(13) NOT NULL default '',
  `rec_date` date NOT NULL,
  `borrowed_rec_date` date NOT NULL,
  `withdraw_rec_date` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `budget_withdraw`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `budget_year`
-- 

CREATE TABLE `budget_year` (
  `id` int(11) NOT NULL auto_increment,
  `budget_year` int(11) NOT NULL,
  `year_active` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `budget_year` (`budget_year`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- dump ตาราง `budget_year`
-- 

INSERT INTO `budget_year` VALUES (1, 2557, 1);

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `cabinet_cabinet`
-- 

CREATE TABLE `cabinet_cabinet` (
  `id` int(11) NOT NULL auto_increment,
  `cabinet_id` int(11) NOT NULL,
  `cabinet_type` tinyint(4) NOT NULL,
  `cabinet_name` varchar(100) NOT NULL,
  `cabinet_size` double NOT NULL,
  `tray_size` double NOT NULL,
  `cabinet_person` varchar(13) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `cabinet_id` (`cabinet_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `cabinet_cabinet`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `cabinet_file`
-- 

CREATE TABLE `cabinet_file` (
  `id` int(11) NOT NULL auto_increment,
  `file_id` int(11) NOT NULL,
  `tray_id` bigint(11) NOT NULL,
  `cabinet_id` int(11) NOT NULL,
  `file_name` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `cabinet_file`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `cabinet_main`
-- 

CREATE TABLE `cabinet_main` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `cabinet_main`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `cabinet_permission`
-- 

CREATE TABLE `cabinet_permission` (
  `id` int(11) NOT NULL auto_increment,
  `person_id` varchar(13) NOT NULL,
  `p1` tinyint(4) default NULL,
  `officer` varchar(13) NOT NULL,
  `rec_date` date NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `person_id` (`person_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- dump ตาราง `cabinet_permission`
-- 

INSERT INTO `cabinet_permission` VALUES (1, '3341600218859', 1, '3341600218859', '2014-06-30');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `cabinet_tray`
-- 

CREATE TABLE `cabinet_tray` (
  `id` int(11) NOT NULL auto_increment,
  `tray_id` bigint(20) NOT NULL,
  `cabinet_id` int(11) NOT NULL,
  `tray_name` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `cabinet_tray`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `health_base`
-- 

CREATE TABLE `health_base` (
  `base_id` int(5) NOT NULL auto_increment,
  `study_year` int(5) NOT NULL,
  `term` int(3) NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY  (`base_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `health_base`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `health_checking`
-- 

CREATE TABLE `health_checking` (
  `check_id` int(11) NOT NULL auto_increment,
  `student_id` int(11) NOT NULL,
  `student_number` varchar(13) NOT NULL,
  `year_std` varchar(5) NOT NULL,
  `term_std` varchar(3) NOT NULL,
  `class_now` tinyint(4) NOT NULL,
  `room` tinyint(4) NOT NULL,
  `number_check` int(5) NOT NULL,
  `gum` varchar(100) NOT NULL,
  `iodine` varchar(100) NOT NULL,
  `tooth` varchar(100) NOT NULL,
  `weight` varchar(10) NOT NULL,
  `tall` varchar(10) NOT NULL,
  `comment` text NOT NULL,
  `day` datetime NOT NULL,
  `usenull` text,
  `life` varchar(10) NOT NULL,
  `push` varchar(10) NOT NULL,
  `sit` varchar(10) NOT NULL,
  `roll` varchar(10) NOT NULL,
  `run` varchar(10) NOT NULL,
  `person_check` varchar(255) NOT NULL,
  PRIMARY KEY  (`check_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `health_checking`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `health_personal`
-- 

CREATE TABLE `health_personal` (
  `per_id` int(11) NOT NULL auto_increment,
  `personal_code` varchar(13) NOT NULL,
  `per_position` int(3) NOT NULL,
  `per_status` int(3) NOT NULL,
  `person_room` int(3) NOT NULL,
  PRIMARY KEY  (`per_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `health_personal`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `la_cancel`
-- 

CREATE TABLE `la_cancel` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `la_cancel`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `la_collect`
-- 

CREATE TABLE `la_collect` (
  `id` int(11) NOT NULL auto_increment,
  `year` int(11) NOT NULL,
  `person_id` varchar(13) NOT NULL,
  `collect_day` tinyint(4) NOT NULL default '0',
  `this_year_day` tinyint(4) NOT NULL default '0',
  `officer` varchar(13) default NULL,
  `rec_date` date default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `la_collect`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `la_main`
-- 

CREATE TABLE `la_main` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `la_main`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `la_permission`
-- 

CREATE TABLE `la_permission` (
  `id` int(11) NOT NULL auto_increment,
  `person_id` varchar(13) NOT NULL,
  `p1` tinyint(4) NOT NULL,
  `officer` varchar(13) NOT NULL,
  `rec_date` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- dump ตาราง `la_permission`
-- 

INSERT INTO `la_permission` VALUES (1, '3341600218859', 1, '3341600218859', '2014-06-30');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `la_person_set`
-- 

CREATE TABLE `la_person_set` (
  `id` int(11) NOT NULL auto_increment,
  `person_id` varchar(13) NOT NULL,
  `comment_person` varchar(13) default NULL,
  `grant_person` varchar(13) default NULL,
  `officer` varchar(13) default NULL,
  `rec_date` date default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `person_id` (`person_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `la_person_set`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `la_year`
-- 

CREATE TABLE `la_year` (
  `id` int(11) NOT NULL auto_increment,
  `budget_year` int(11) NOT NULL,
  `year_active` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `budget_year` (`budget_year`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- dump ตาราง `la_year`
-- 

INSERT INTO `la_year` VALUES (1, 2557, 1);

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `mail_filebook`
-- 

CREATE TABLE `mail_filebook` (
  `id` int(11) NOT NULL auto_increment,
  `ref_id` varchar(50) NOT NULL,
  `file_name` varchar(100) NOT NULL,
  `file_des` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `mail_filebook`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `mail_group`
-- 

CREATE TABLE `mail_group` (
  `grp_id` int(11) NOT NULL auto_increment,
  `grp_name` varchar(50) NOT NULL,
  PRIMARY KEY  (`grp_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `mail_group`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `mail_group_member`
-- 

CREATE TABLE `mail_group_member` (
  `id` int(11) NOT NULL auto_increment,
  `grp_id` int(11) NOT NULL,
  `person_id` varchar(13) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `mail_group_member`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `mail_main`
-- 

CREATE TABLE `mail_main` (
  `ms_id` int(11) NOT NULL auto_increment,
  `sender` varchar(13) NOT NULL,
  `subject` varchar(150) NOT NULL,
  `detail` text,
  `ref_id` varchar(50) NOT NULL,
  `send_date` datetime NOT NULL,
  PRIMARY KEY  (`ms_id`),
  KEY `ref_id` (`ref_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `mail_main`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `mail_permission`
-- 

CREATE TABLE `mail_permission` (
  `id` int(11) NOT NULL auto_increment,
  `person_id` varchar(13) NOT NULL,
  `p1` tinyint(4) NOT NULL,
  `officer` varchar(13) NOT NULL,
  `rec_date` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `mail_permission`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `mail_sendto_answer`
-- 

CREATE TABLE `mail_sendto_answer` (
  `id` int(11) NOT NULL auto_increment,
  `ref_id` varchar(50) NOT NULL,
  `send_to` varchar(13) NOT NULL,
  `answer` tinyint(4) NOT NULL default '0',
  `answer_time` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `ref_id` (`ref_id`),
  KEY `send_to` (`send_to`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `mail_sendto_answer`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `meeting_main`
-- 

CREATE TABLE `meeting_main` (
  `id` int(11) NOT NULL auto_increment,
  `room` tinyint(4) NOT NULL,
  `book_date` date NOT NULL,
  `start_time` tinyint(4) NOT NULL,
  `finish_time` tinyint(4) NOT NULL,
  `objective` varchar(200) NOT NULL,
  `book_person` varchar(13) NOT NULL,
  `rec_date` datetime NOT NULL,
  `approve` int(11) default NULL,
  `reason` varchar(200) default NULL,
  `person_num` int(11) NOT NULL,
  `other` varchar(250) NOT NULL,
  `officer` varchar(13) default NULL,
  `officer_date` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `meeting_main`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `meeting_permission`
-- 

CREATE TABLE `meeting_permission` (
  `id` int(11) NOT NULL auto_increment,
  `person_id` varchar(13) NOT NULL,
  `p1` tinyint(4) NOT NULL,
  `officer` varchar(13) NOT NULL,
  `rec_date` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- dump ตาราง `meeting_permission`
-- 

INSERT INTO `meeting_permission` VALUES (1, '3341600218859', 1, '3341600218859', '2014-06-30');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `meeting_room`
-- 

CREATE TABLE `meeting_room` (
  `id` int(11) NOT NULL auto_increment,
  `room_code` tinyint(4) NOT NULL,
  `room_name` varchar(100) NOT NULL,
  `active` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

-- 
-- dump ตาราง `meeting_room`
-- 

INSERT INTO `meeting_room` VALUES (1, 1, 'ห้องประชุม1', 1);
INSERT INTO `meeting_room` VALUES (2, 2, 'ห้องประชุม2', 1);
INSERT INTO `meeting_room` VALUES (3, 3, 'ห้องประชุม3', 0);
INSERT INTO `meeting_room` VALUES (4, 4, 'หอ้งประชุม4', 0);
INSERT INTO `meeting_room` VALUES (5, 5, 'ห้องประชุม5', 0);
INSERT INTO `meeting_room` VALUES (6, 6, 'ห้องประชุม6', 0);
INSERT INTO `meeting_room` VALUES (7, 7, 'ห้องประชุม7', 0);
INSERT INTO `meeting_room` VALUES (8, 8, 'ห้องประชุม8', 0);
INSERT INTO `meeting_room` VALUES (9, 9, 'ห้องประชุม9', 0);
INSERT INTO `meeting_room` VALUES (10, 10, 'ห้องประชุม10', 0);

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `news_mainitem`
-- 

CREATE TABLE `news_mainitem` (
  `id` int(11) NOT NULL auto_increment,
  `code` int(11) NOT NULL,
  `mainitem` varchar(150) NOT NULL,
  `item_active` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `news_mainitem`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `news_news`
-- 

CREATE TABLE `news_news` (
  `id` int(11) NOT NULL auto_increment,
  `report_date` datetime NOT NULL,
  `news` varchar(250) NOT NULL,
  `file` varchar(150) NOT NULL,
  `section` int(11) NOT NULL,
  `mainitem_code` int(11) NOT NULL,
  `officer` varchar(13) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `news_news`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `news_permission`
-- 

CREATE TABLE `news_permission` (
  `id` int(11) NOT NULL auto_increment,
  `person_id` varchar(13) NOT NULL,
  `p1` tinyint(4) NOT NULL,
  `officer` varchar(13) NOT NULL,
  `rec_date` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- dump ตาราง `news_permission`
-- 

INSERT INTO `news_permission` VALUES (1, '3341600218859', 1, '3341600218859', '2014-06-30');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `news_section`
-- 

CREATE TABLE `news_section` (
  `id` int(11) NOT NULL auto_increment,
  `code` tinyint(4) NOT NULL,
  `name` varchar(100) NOT NULL,
  `mainitem_code` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `news_section`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `permission_date`
-- 

CREATE TABLE `permission_date` (
  `id` int(11) NOT NULL auto_increment,
  `person_id` varchar(13) NOT NULL,
  `ref_id` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `rec_date` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `permission_date`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `permission_main`
-- 

CREATE TABLE `permission_main` (
  `id` int(11) NOT NULL auto_increment,
  `person_id` varchar(13) NOT NULL,
  `ref_id` varchar(50) NOT NULL,
  `subject` varchar(150) NOT NULL,
  `place` varchar(150) NOT NULL,
  `vehicle` varchar(150) default NULL,
  `document` varchar(150) default NULL,
  `no_comment` tinyint(4) NOT NULL default '0',
  `grant_person_selected` varchar(13) default NULL,
  `rec_date` datetime NOT NULL,
  `comment` varchar(200) default NULL,
  `comment_person` varchar(13) default NULL,
  `comment_date` datetime default NULL,
  `grant_x` tinyint(4) default NULL,
  `grant_comment` varchar(200) default NULL,
  `grant_person` varchar(13) default NULL,
  `grant_date` datetime default NULL,
  `report` text,
  `report_date` datetime default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `ref_id` (`ref_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `permission_main`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `permission_permission`
-- 

CREATE TABLE `permission_permission` (
  `id` int(11) NOT NULL auto_increment,
  `person_id` varchar(13) NOT NULL,
  `p1` tinyint(4) NOT NULL,
  `officer` varchar(13) NOT NULL,
  `rec_date` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- dump ตาราง `permission_permission`
-- 

INSERT INTO `permission_permission` VALUES (1, '3341600218859', 1, '3341600218859', '2014-06-30');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `permission_person_set`
-- 

CREATE TABLE `permission_person_set` (
  `id` int(11) NOT NULL auto_increment,
  `person_id` varchar(13) NOT NULL,
  `comment_person` varchar(13) default NULL,
  `grant_person` varchar(13) default NULL,
  `officer` varchar(13) default NULL,
  `rec_date` date default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `person_id` (`person_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `permission_person_set`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `person_main`
-- 

CREATE TABLE `person_main` (
  `id` int(11) NOT NULL auto_increment,
  `person_id` varchar(13) NOT NULL,
  `prename` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `position_code` tinyint(4) NOT NULL,
  `pic` varchar(150) default NULL,
  `status` tinyint(4) NOT NULL default '0',
  `person_order` tinyint(4) default '0',
  `officer` varchar(13) NOT NULL,
  `rec_date` date NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `person_id` (`person_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

-- 
-- dump ตาราง `person_main`
-- 

INSERT INTO `person_main` VALUES (18, '3341600218859', 'นาย', 'เจษฎา', 'ศิริโภค', 3, '', 0, 0, '7777', '2014-06-30');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `person_permission`
-- 

CREATE TABLE `person_permission` (
  `id` int(11) NOT NULL auto_increment,
  `person_id` varchar(13) NOT NULL,
  `p1` tinyint(4) NOT NULL,
  `officer` varchar(13) NOT NULL,
  `rec_date` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- dump ตาราง `person_permission`
-- 

INSERT INTO `person_permission` VALUES (1, '3341600218859', 1, '3341600218859', '2014-06-30');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `person_position`
-- 

CREATE TABLE `person_position` (
  `id` int(11) NOT NULL auto_increment,
  `position_code` int(11) NOT NULL,
  `position_name` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `position_code` (`position_code`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- 
-- dump ตาราง `person_position`
-- 

INSERT INTO `person_position` VALUES (1, 1, 'ผู้อำนวยการโรงเรียน');
INSERT INTO `person_position` VALUES (2, 2, 'รองผู้อำนวยการโรงเรียน');
INSERT INTO `person_position` VALUES (3, 3, 'ครู');
INSERT INTO `person_position` VALUES (4, 4, 'ครูผู้ช่วย');
INSERT INTO `person_position` VALUES (5, 5, 'ครูพิเศษ');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `plan_acti`
-- 

CREATE TABLE `plan_acti` (
  `id` int(11) NOT NULL auto_increment,
  `budget_year` int(11) default NULL,
  `code_clus` tinyint(4) NOT NULL,
  `code_proj` char(3) NOT NULL default '',
  `code_acti` char(6) NOT NULL default '',
  `code_approve` char(3) NOT NULL default '',
  `budget_acti` decimal(10,2) NOT NULL default '0.00',
  `budget_approve` decimal(10,2) NOT NULL default '0.00',
  `dayinput` date NOT NULL default '0000-00-00',
  `daythai` char(13) NOT NULL default '',
  `name_acti` char(150) NOT NULL,
  `owner_acti` char(50) NOT NULL default '',
  `id_defalt` char(13) NOT NULL default '',
  `dayseri` datetime NOT NULL default '0000-00-00 00:00:00',
  `begin_date` date NOT NULL,
  `finish_date` date NOT NULL,
  `stop` tinyint(1) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `plan_acti`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `plan_permission`
-- 

CREATE TABLE `plan_permission` (
  `id` int(11) NOT NULL auto_increment,
  `id_person` char(13) NOT NULL default '',
  `name_perm` char(40) NOT NULL default '',
  `password_new` char(4) NOT NULL default '',
  `password_old` char(4) NOT NULL default '',
  `perm_view` char(1) NOT NULL default '',
  `perm_read` char(1) NOT NULL default '',
  `perm_add` char(1) NOT NULL default '',
  `perm_edit` char(1) NOT NULL default '',
  `perm_dele` char(1) NOT NULL default '',
  `comment` char(1) NOT NULL default '',
  `moderate` char(1) NOT NULL default '',
  `admin` char(1) NOT NULL default '',
  `id_defalt` char(13) NOT NULL default '',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id_person` (`id_person`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- dump ตาราง `plan_permission`
-- 

INSERT INTO `plan_permission` VALUES (1, '3341600218859', 'นายเจษฎา  ศิริโภค', '8859', '8859', '0', '0', '1', '1', '1', '0', '0', '0', '3341600218859');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `plan_proj`
-- 

CREATE TABLE `plan_proj` (
  `id` int(11) NOT NULL auto_increment,
  `budget_year` int(11) default NULL,
  `code_clus` tinyint(4) NOT NULL,
  `code_tegy` char(1) NOT NULL default '',
  `code_proj` char(3) NOT NULL default '',
  `budget_proj` double NOT NULL default '0',
  `budget_approve` double NOT NULL default '0',
  `name_proj` varchar(250) NOT NULL default '',
  `owner_proj` varchar(50) NOT NULL default '',
  `file_detail` varchar(100) NOT NULL default '',
  `dayrec` datetime NOT NULL default '0000-00-00 00:00:00',
  `eval_tegy` varchar(250) NOT NULL default '',
  `eval_activity` longtext NOT NULL,
  `eval_result` longtext NOT NULL,
  `eval_obstacle` longtext NOT NULL,
  `eval_particular` varchar(100) NOT NULL default '',
  `begin_date` date NOT NULL,
  `finish_date` date NOT NULL,
  `allow_edit` char(1) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `plan_proj`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `plan_setgic_year`
-- 

CREATE TABLE `plan_setgic_year` (
  `id` int(11) NOT NULL auto_increment,
  `budget_year` int(11) NOT NULL,
  `year_active` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `budget_year` (`budget_year`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- dump ตาราง `plan_setgic_year`
-- 

INSERT INTO `plan_setgic_year` VALUES (1, 2557, 1);

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `plan_standard`
-- 

CREATE TABLE `plan_standard` (
  `id` int(11) NOT NULL auto_increment,
  `budget_year` int(11) NOT NULL,
  `sd_year` int(4) NOT NULL,
  `code_clus` tinyint(4) NOT NULL,
  `code_proj` char(3) NOT NULL,
  `code_acti` char(6) NOT NULL,
  `sd_level` char(1) NOT NULL,
  `sd_id` int(11) NOT NULL,
  `id_indicator` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `plan_standard`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `plan_stregic`
-- 

CREATE TABLE `plan_stregic` (
  `id` int(11) NOT NULL auto_increment,
  `id_tegic` int(3) NOT NULL,
  `budget_year` int(4) NOT NULL,
  `strategic` varchar(200) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `plan_stregic`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `plan_year`
-- 

CREATE TABLE `plan_year` (
  `id` int(11) NOT NULL auto_increment,
  `budget_year` int(11) NOT NULL,
  `year_active` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `budget_year` (`budget_year`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- dump ตาราง `plan_year`
-- 

INSERT INTO `plan_year` VALUES (1, 2557, 1);

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `savings_account`
-- 

CREATE TABLE `savings_account` (
  `account_id` int(11) NOT NULL auto_increment,
  `acc_code` varchar(10) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY  (`account_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- 
-- dump ตาราง `savings_account`
-- 

INSERT INTO `savings_account` VALUES (1, '1', 'ฝาก');
INSERT INTO `savings_account` VALUES (2, '2', 'ถอน');
INSERT INTO `savings_account` VALUES (3, '3', 'ยอดยกมา');
INSERT INTO `savings_account` VALUES (4, '4', 'ดอกเบี้ยเงินฝาก');
INSERT INTO `savings_account` VALUES (5, '5', 'รายการแก้ไข');
INSERT INTO `savings_account` VALUES (6, '6', 'ปิดบัญชี');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `savings_base`
-- 

CREATE TABLE `savings_base` (
  `base_id` int(5) NOT NULL auto_increment,
  `study_year` int(5) NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY  (`base_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- dump ตาราง `savings_base`
-- 

INSERT INTO `savings_base` VALUES (1, 2557, 0);

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `savings_money`
-- 

CREATE TABLE `savings_money` (
  `save_id` int(11) NOT NULL auto_increment,
  `std_id` varchar(15) NOT NULL,
  `year_past` varchar(4) NOT NULL,
  `amount_money` varchar(15) NOT NULL,
  `day_save` varchar(3) NOT NULL,
  `month_save` varchar(3) NOT NULL,
  `year_save` varchar(5) NOT NULL,
  `timer` time NOT NULL,
  `office` varchar(15) default NULL,
  `day_act` varchar(20) NOT NULL,
  `acc_type` varchar(10) NOT NULL,
  `level_class` varchar(5) NOT NULL,
  `room` varchar(5) NOT NULL,
  `student_number` varchar(5) NOT NULL,
  `rec_officer` varchar(13) default NULL,
  PRIMARY KEY  (`save_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `savings_money`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `savings_personal`
-- 

CREATE TABLE `savings_personal` (
  `per_id` int(11) NOT NULL auto_increment,
  `personal_code` varchar(13) NOT NULL,
  `per_position` int(3) NOT NULL,
  `per_status` int(3) NOT NULL,
  `per_add` int(3) NOT NULL,
  `per_draw` int(3) NOT NULL,
  `person_room` int(3) NOT NULL,
  PRIMARY KEY  (`per_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `savings_personal`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `savings_total`
-- 

CREATE TABLE `savings_total` (
  `total_id` int(11) NOT NULL auto_increment,
  `std_id` varchar(13) NOT NULL,
  `year` varchar(5) NOT NULL,
  `day_start` date NOT NULL,
  `comment` varchar(100) NOT NULL,
  PRIMARY KEY  (`total_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `savings_total`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `standard_basic_indicator`
-- 

CREATE TABLE `standard_basic_indicator` (
  `id` int(11) NOT NULL auto_increment,
  `sd_year` int(11) NOT NULL,
  `id_indicator` int(11) NOT NULL,
  `sd_id` int(11) NOT NULL,
  `indicator_name` varchar(250) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=156 ;

-- 
-- dump ตาราง `standard_basic_indicator`
-- 

INSERT INTO `standard_basic_indicator` VALUES (5, 2553, 101, 1, '1.1. มีวินัย มีความรับผิดชอบและปฏิบัติตนตามหลักธรรมเบื้องต้นของศาสนาที่ตนนับถือ');
INSERT INTO `standard_basic_indicator` VALUES (6, 2553, 102, 1, '1.2. มีความซื่อสัตย์สุจริต');
INSERT INTO `standard_basic_indicator` VALUES (7, 2553, 103, 1, '1.3. ความกตัญญูกตเวที');
INSERT INTO `standard_basic_indicator` VALUES (8, 2553, 104, 1, '1.4. มีความเมตตากรุณา เอื้อเฟื้อเผื่อแผ่ และเสียสละเพื่อส่วนรวม');
INSERT INTO `standard_basic_indicator` VALUES (9, 2553, 105, 1, '1.5. ประหยัด รู้จักใช้ทรัพย์สิ่งของส่วนตนและส่วนรวมอย่างคุ้มค่า');
INSERT INTO `standard_basic_indicator` VALUES (10, 2553, 106, 1, '1.6. ภูมิใจในความเป็นไทย เห็นคุณค่าภูมิปัญญาไทย นิยมไทยและดำรงไว้ซึ่งความเป็นไทย');
INSERT INTO `standard_basic_indicator` VALUES (11, 2553, 201, 2, '2.1. รู้คุณค่าของสิ่งแวดล้อมและตระหนักถึงผลกระทบที่เกิดจากการเปลี่ยนแปลงสิ่งแวดล้อม');
INSERT INTO `standard_basic_indicator` VALUES (12, 2553, 202, 2, '2.2. เข้าร่วมหรือมีส่วนร่วมกิจกรรม/โครงการอนุรักษ์และพัฒนาสิ่งแวดล้อม');
INSERT INTO `standard_basic_indicator` VALUES (13, 2553, 301, 3, '3.1. มีทักษะในการจัดการและทำงานให้สำเร็จ');
INSERT INTO `standard_basic_indicator` VALUES (14, 2553, 302, 3, '3.2. เพียรพยายาม ขยัน อดทน ละเอียดรอบคอบในการทำงาน');
INSERT INTO `standard_basic_indicator` VALUES (15, 2553, 303, 3, '3.3. ทำงานอย่างมีความสุข พัฒนางานและภูมิใจในผลงานของตนเอง');
INSERT INTO `standard_basic_indicator` VALUES (16, 2553, 304, 3, '3.4. ทำงานร่วมกับผู้อื่นได้');
INSERT INTO `standard_basic_indicator` VALUES (17, 2553, 305, 3, '3.5. มีความรู้สึกที่ดีต่ออาชีพสุจริตและหาความรู้เกี่ยวกับอาชีพที่ตนสนใจ');
INSERT INTO `standard_basic_indicator` VALUES (18, 2553, 401, 4, '4.1. สามารถวิเคราะห์ สังเคราะห์ สรุปความคิดรวบยอด คิดอย่างเป็นระบบและมีความคิดแบบองค์รวม');
INSERT INTO `standard_basic_indicator` VALUES (19, 2553, 402, 4, '4.2. สามารถคาดคะเน กำหนดเป้าหมายและแนวทางการตัดสินใจได้');
INSERT INTO `standard_basic_indicator` VALUES (20, 2553, 403, 4, '4.3. ประเมินและเลือกแนวทางการตัดสินใจและแก้ไขปัญหาอย่างมีสติ');
INSERT INTO `standard_basic_indicator` VALUES (21, 2553, 404, 4, '4.4. มีความคิดริเริ่มสร้างสรรค์ มองโลกในแง่ดี และมีจินตนาการ');
INSERT INTO `standard_basic_indicator` VALUES (23, 2553, 501, 5, '5.1. มีระดับผลสัมฤทธิ์ทางการเรียนเฉลี่ยตามเกณฑ์');
INSERT INTO `standard_basic_indicator` VALUES (24, 2553, 502, 5, '5.2. มีผลการทดสอบรวบยอดระดับชาติเฉลี่ยตามเกณฑ์');
INSERT INTO `standard_basic_indicator` VALUES (25, 2553, 503, 5, '5.3. สามารถสื่อความคิดผ่านการพูด เขียน หรือนำเสนอด้วยวิธีต่าง ๆ        ');
INSERT INTO `standard_basic_indicator` VALUES (26, 2553, 504, 5, '5.4. สามารถใช้ภาษาเพื่อการสื่อสารได้ทั้งภาษาไทยและภาษาต่างประเทศ');
INSERT INTO `standard_basic_indicator` VALUES (27, 2553, 505, 5, '5.5. สามารถใช้เทคโนโลยีสารสนเทศเพื่อการพัฒนาการเรียนรู้ ');
INSERT INTO `standard_basic_indicator` VALUES (28, 2553, 601, 6, '6.1. มีนิสัยรักการอ่าน การเขียน และการฟัง รู้จักตั้งคำถามเพื่อหาเหตุผล');
INSERT INTO `standard_basic_indicator` VALUES (29, 2553, 602, 6, '6.2. สนใจแสวงหาความรู้จากแหล่งต่างๆ รอบตัวใช้ห้องสมุด แหล่งความรู้และสื่อต่างๆได้ ทั้งในและนอกสถานศึกษา ');
INSERT INTO `standard_basic_indicator` VALUES (30, 2553, 603, 6, '6.3. มีวิธีการเรียนรู้ของตนเองเรียนร่วมกับผู้อื่นได้สนุกกับการเรียนรู้และชอบมาโรงเรียน');
INSERT INTO `standard_basic_indicator` VALUES (31, 2553, 701, 7, '7.1.มีสุขนิสัยในการดูแลสุขภาพกายและออกกำลังกายสม่ำเสมอ');
INSERT INTO `standard_basic_indicator` VALUES (32, 2553, 702, 7, '7.2. มีน้ำหนัก ส่วนสูงและมีสมรรถภาพทางกายตามเกณฑ์');
INSERT INTO `standard_basic_indicator` VALUES (33, 2553, 703, 7, '7.3. ป้องกันตนเองจากสิ่งเสพติดให้โทษและหลีกเลี่ยงสภาวะที่เสี่ยงต่อความรุนแรง โรคภัย อุบัติเหตุ และปัญหาทางเพศ');
INSERT INTO `standard_basic_indicator` VALUES (34, 2553, 704, 7, '7.4. มีความมั่นใจและกล้าแสดงออกอย่างเหมาะสม และให้เกียรติผู้อื่น');
INSERT INTO `standard_basic_indicator` VALUES (35, 2553, 705, 7, '7.5. มีมนุษยสัมพันธ์ที่ดีต่อเพื่อน  ครู และผู้อื่น');
INSERT INTO `standard_basic_indicator` VALUES (36, 2553, 801, 8, '8.1. ชื่นชม ร่วมกิจกรรม และมีผลงานด้านศิลปะ');
INSERT INTO `standard_basic_indicator` VALUES (37, 2553, 802, 8, '8.2. ชื่นชม ร่วมกิจกรรม และมีผลงานด้านดนตรี/นาฏศิลป์');
INSERT INTO `standard_basic_indicator` VALUES (38, 2553, 803, 8, '8.3. ชื่นชม ร่วมกิจกรรม และมีผลงานด้านกีฬา/นันทนาการ');
INSERT INTO `standard_basic_indicator` VALUES (39, 2553, 901, 9, '9.1. มีคุณธรรมจริยธรรม และปฏิบัติตนตามจรรยาบรรณของวิชาชีพ');
INSERT INTO `standard_basic_indicator` VALUES (40, 2553, 902, 9, '9.2. มีมนุษยสัมพันธ์ที่ดีกับผู้เรียน ผู้ปกครอง และชุมชน');
INSERT INTO `standard_basic_indicator` VALUES (41, 2553, 903, 9, '9.3. มีความมุ่งมั่นและอุทิศตนในการสอนและพัฒนาผู้เรียน');
INSERT INTO `standard_basic_indicator` VALUES (42, 2553, 904, 9, '9.4. มีการแสวงหาความรู้และเทคนิควิธีการใหม่ๆ รับฟังความคิดเห็น ใจกว้างและยอมรับการเปลี่ยนแปลง');
INSERT INTO `standard_basic_indicator` VALUES (43, 2553, 905, 9, '9.5. จบการศึกษาระดับปริญญาตรีทางการศึกษาหรือเทียบเท่าขึ้นไป');
INSERT INTO `standard_basic_indicator` VALUES (44, 2553, 906, 9, '9.6. สอนตรงตามวิชาเอก-โท หรือ ตรงตามความถนัด');
INSERT INTO `standard_basic_indicator` VALUES (45, 2553, 907, 9, '9.7. มีจำนวนเพียงพอ  (หมายรวมทั้งครูและบุคลากรสนับสนุน)');
INSERT INTO `standard_basic_indicator` VALUES (46, 2553, 1001, 10, '10.1. มีความรู้ความเข้าใจเป้าหมายการจัดการศึกษาและหลักสูตรการศึกษาขั้นพื้นฐาน');
INSERT INTO `standard_basic_indicator` VALUES (47, 2553, 1002, 10, '10.2. มีการวิเคราะห์ศักยภาพของผู้เรียนและเข้าใจผู้เรียนเป็นรายบุคคล');
INSERT INTO `standard_basic_indicator` VALUES (48, 2553, 1003, 10, '10.3. มีความสามารถในการจัดการเรียนการสอนที่เน้นผู้เรียนเป็นสำคัญ');
INSERT INTO `standard_basic_indicator` VALUES (49, 2553, 1004, 10, '10.4. มีความสามารถในการใช้เทคโนโลยีในการพัฒนาการเรียนรู้ของตนเองและผู้เรียน');
INSERT INTO `standard_basic_indicator` VALUES (50, 2553, 1005, 10, '10.5. มีการประเมินผลการเรียนการสอนที่สอดคล้องกับสภาพการเรียนรู้ที่จัดให้ผู้เรียน และอิงพัฒนาการของผู้เรียน');
INSERT INTO `standard_basic_indicator` VALUES (51, 2553, 1006, 10, '10.6. มีการนำผลการประเมินมาปรับเปลี่ยนการเรียนการสอนเพื่อพัฒนาผู้เรียนให้เต็มตามศักยภาพ');
INSERT INTO `standard_basic_indicator` VALUES (52, 2553, 1007, 10, '10.7. มีการวิจัยเพื่อพัฒนาการเรียนรู้ของผู้เรียน และนำผลไปใช้พัฒนาผู้เรียน');
INSERT INTO `standard_basic_indicator` VALUES (53, 2553, 1101, 11, '11.1. มีคุณธรรม จริยธรรม และปฏิบัติตนตามจรรยาบรรณของวิชาชีพ');
INSERT INTO `standard_basic_indicator` VALUES (54, 2553, 1102, 11, '11.2. มีความคิดริเริ่ม มีวิสัยทัศน์ และเป็นผู้นำทางวิชาการ');
INSERT INTO `standard_basic_indicator` VALUES (55, 2553, 1103, 11, '11.3. มีความสามารถในการบริหารงานวิชาการและการจัดการ');
INSERT INTO `standard_basic_indicator` VALUES (56, 2553, 1104, 11, '11.4. มีการบริหารที่มีประสิทธิภาพและประสิทธิผล ผู้เกี่ยวข้องพึงพอใจ');
INSERT INTO `standard_basic_indicator` VALUES (57, 2553, 1201, 12, '12.1. มีการจัดองค์กร โครงสร้าง และระบบการบริหารงานที่มีความคล่องตัวสูงและปรับเปลี่ยนได้เหมาะสมตามสถานการณ์');
INSERT INTO `standard_basic_indicator` VALUES (58, 2553, 1202, 12, '12.2. มีการจัดการข้อมูลสารสนเทศอย่างครอบคลุมและทันต่อการใช้งาน');
INSERT INTO `standard_basic_indicator` VALUES (59, 2553, 1203, 12, '12.3. มีระบบการประกันคุณภาพภายในที่ดำเนินงานอย่างต่อเนื่อง');
INSERT INTO `standard_basic_indicator` VALUES (60, 2553, 1204, 12, '12.4. มีการพัฒนาบุคลากรอย่างเป็นระบบและต่อเนื่อง');
INSERT INTO `standard_basic_indicator` VALUES (61, 2553, 1205, 12, '12.5. ผู้รับบริการและผู้เกี่ยวข้องพึงพอใจผลการบริหารงานและการพัฒนาผู้เรียน');
INSERT INTO `standard_basic_indicator` VALUES (62, 2553, 1301, 13, '13.1. มีการกระจายอำนาจการบริหารและการจัดการศึกษา');
INSERT INTO `standard_basic_indicator` VALUES (63, 2553, 1302, 13, '13.2.  มีการบริหารเชิงกลยุทธ์และใช้หลักการมีส่วนร่วม');
INSERT INTO `standard_basic_indicator` VALUES (64, 2553, 1303, 13, '13.3. มีคณะกรรมการสถานศึกษาร่วมพัฒนาสถานศึกษา');
INSERT INTO `standard_basic_indicator` VALUES (65, 2553, 1304, 13, '13.4. มีรูปแบบการบริหารที่มุ่งผลสัมฤทธิ์ของงาน');
INSERT INTO `standard_basic_indicator` VALUES (66, 2553, 1305, 13, '13.5. มีการตรวจสอบและถ่วงดุล');
INSERT INTO `standard_basic_indicator` VALUES (67, 2553, 1401, 14, '14.1. มีหลักสูตรที่เหมาะสมกับผู้เรียนและท้องถิ่น');
INSERT INTO `standard_basic_indicator` VALUES (68, 2553, 1402, 14, '14.2. มีรายวิชา/กิจกรรมที่หลากหลายให้ผู้เรียนเลือกเรียนตามความสนใจ');
INSERT INTO `standard_basic_indicator` VALUES (70, 2553, 1403, 14, '14.3. มีการส่งเสริมให้ครูจัดทำแผนการจัดการเรียนรู้ที่ตอบสอนงความถนัดและความสามารถของผู้เรียน');
INSERT INTO `standard_basic_indicator` VALUES (71, 2553, 1404, 14, '14.4. มีการส่งเสริมและพัฒนานวัตกรรมการจัดการเรียนรู้และสื่ออุปกรณ์การเรียนที่เอื้อต่อการเรียนรู้');
INSERT INTO `standard_basic_indicator` VALUES (72, 2553, 1405, 14, '14.5. มีการจัดระบบการบันทึก การรายงานผลและการส่งต่อข้อมูลของผู้เรียน');
INSERT INTO `standard_basic_indicator` VALUES (73, 2553, 1406, 14, '14.6. มีระบบการนิเทศการเรียนการสอนและนำผลไปปรับปรุงการสอนอยู่เสมอ');
INSERT INTO `standard_basic_indicator` VALUES (74, 2553, 1407, 14, '14.7. มีการนำแหล่งเรียนรู้และภูมิปัญญาท้องถิ่นมาใช้ในการเรียนการสอน');
INSERT INTO `standard_basic_indicator` VALUES (75, 2553, 1501, 15, '15.1. มีการจัดและพัฒนาระบบดูแลช่วยเหลือผู้เรียนที่เข้มแข็งและทั่วถึง');
INSERT INTO `standard_basic_indicator` VALUES (76, 2553, 1502, 15, '15.2. มีการจัดกิจกรรมส่งเสริมและตอบสนองความสามารถทางวิชาการและความคิดสร้างสรรค์ของผู้เรียน');
INSERT INTO `standard_basic_indicator` VALUES (77, 2553, 1503, 15, '15.3. มีการจัดกิจกรรมส่งเสริมและตอบสนองความสามารถพิเศษและความถนัดของผู้เรียนให้เต็มตามศักยภาพ');
INSERT INTO `standard_basic_indicator` VALUES (78, 2553, 1504, 15, '15.4. มีการจัดกิจกรรมส่งเสริมค่านิยมที่ดีงาม');
INSERT INTO `standard_basic_indicator` VALUES (79, 2553, 1505, 15, '15.5. มีการจัดกิจกรรมส่งเสริมด้านศิลปะ ดนตรี/นาฏศิลป์ และกีฬา/นันทนาการ');
INSERT INTO `standard_basic_indicator` VALUES (80, 2553, 1506, 15, '15.6. มีการจัดกิจกรรมสืบสานและสร้างสรรค์  วัฒนธรรม  ประเพณี และภูมิปัญญาไทย');
INSERT INTO `standard_basic_indicator` VALUES (81, 2553, 1507, 15, '15.7. มีการจัดกิจกรรมส่งเสริมความเป็นประชาธิปไตย');
INSERT INTO `standard_basic_indicator` VALUES (82, 2553, 1601, 16, '16.1. มีสภาพแวดล้อมที่เอื้อต่อการเรียนรู้ มีอาคารสถานที่เหมาะสม');
INSERT INTO `standard_basic_indicator` VALUES (83, 2553, 1602, 16, '16.2. มีการส่งเสริมสุขภาพอนามัยและความปลอดภัยของผู้เรียน');
INSERT INTO `standard_basic_indicator` VALUES (84, 2553, 1603, 16, '16.3. มีการการให้บริการเทคโนโลยีสารสนเทศรูปแบบที่เอื้อต่อการเรียนรู้ด้วยตนเอง  และการเรียนรู้แบบมีส่วนรวม');
INSERT INTO `standard_basic_indicator` VALUES (85, 2553, 1604, 16, '16.4. มีห้องเรียน  ห้องปฏิบัติการ ห้องสมุด พื้นที่สีเขียว และสิ่งอำนวยความสะดวกพอเพียง  และอยู่ในสภาพใช้การได้ดี');
INSERT INTO `standard_basic_indicator` VALUES (86, 2553, 1605, 16, '16.5. มีการจัดและใช้แหล่งเรียนรู้ทั้งในและนอกสถานศึกษา');
INSERT INTO `standard_basic_indicator` VALUES (87, 2553, 1701, 17, '17.1. มีการเชื่อมโยงและแลกเปลี่ยนข้อมูลกับแหล่งเรียนรู้และภูมิปัญญาในท้องถิ่น');
INSERT INTO `standard_basic_indicator` VALUES (88, 2553, 1702, 17, '17.2. สนับสนุนให้แหล่งเรียนรู้ ภูมิปัญญา และชุมชน เข้ามามีส่วนร่วมในกาจัดทำหลักสูตรระดับสถานศึกษา');
INSERT INTO `standard_basic_indicator` VALUES (89, 2553, 1801, 18, '18.1. เป็นแหล่งวิทยาการในการแสวงหาความรู้และบริการชุมชน');
INSERT INTO `standard_basic_indicator` VALUES (90, 2553, 1802, 18, '18.2. มีการแลกเปลี่ยนเรียนรู้ร่วมกัน');
INSERT INTO `standard_basic_indicator` VALUES (91, 2554, 101, 1, '1.1 มีสุขนิสัยในการดูแลสุขภาพและออกกำลังกายสม่ำเสมอ');
INSERT INTO `standard_basic_indicator` VALUES (92, 2554, 102, 1, '1.2 มีน้ำหนัก ส่วนสูง และมีสมรรถนภาพทางกายตามเกณฑ์มาตรฐาน');
INSERT INTO `standard_basic_indicator` VALUES (93, 2554, 103, 1, '1.3 ป้องกันตนเองจากสิ่งเสพติดให้โทษและหลีกเลี่ยงตนเองจากสภาวะที่เสี่ยงต่อความรุนแรง โรค ภีย อุบัติเหตุ และปัญหาทางเพศ');
INSERT INTO `standard_basic_indicator` VALUES (94, 2554, 104, 1, '1.4 เห็นคุณค่าในตนเอง มีความมั่นใจ กล้าแสดงออกอย่างเหมาะสม');
INSERT INTO `standard_basic_indicator` VALUES (95, 2554, 105, 1, '1.5 มีมนุษยสัมพันธ์ที่ดีและให้เกียรติผู้อื่น');
INSERT INTO `standard_basic_indicator` VALUES (96, 2554, 106, 1, '1.6 สร้างผลงานจากการเข้าร่วมกิจกรรมด้านศิลปะ ดนตรี/นาฏศิลป์ กีฬา/นันทนาการ');
INSERT INTO `standard_basic_indicator` VALUES (97, 2554, 201, 2, '2.1 มีคุณลักษณะที่พึงประสงค์ตามหลักสูตร');
INSERT INTO `standard_basic_indicator` VALUES (98, 2554, 202, 2, '2.2 เอื้ออาทรผู้อื่นและกตัญญูกตเวทีต่อผู้มีพระคุณ');
INSERT INTO `standard_basic_indicator` VALUES (99, 2554, 203, 2, '2.3 ยอมรับความคิดและวัฒนธรรมที่แตกต่าง');
INSERT INTO `standard_basic_indicator` VALUES (100, 2554, 204, 2, '2.4 ตระหนัก รู้คุณค่า ร่วมอนุรักษ์และพัฒนาสิ่งแวดล้อม');
INSERT INTO `standard_basic_indicator` VALUES (101, 2554, 301, 3, '3.1 มีนิสัยรักการอ่านและแสวงหาความรู้ด้วยตนเองจากห้องสมุด แหล่งเรียนรู้ และสื่อต่าง ๆ รอบตัว');
INSERT INTO `standard_basic_indicator` VALUES (102, 2554, 302, 3, '3.2 มีทักษะในการอ่าน ฟัง พูด ดู เขียน และตั้งคำถามเพื่อค้นคว้าหาความรู้เพิ่มเติม');
INSERT INTO `standard_basic_indicator` VALUES (103, 2554, 303, 3, '3.3 เรียนรู้ร่วมกันเป็นกลุ่ม และเปลี่ยนความคิดเห็นเพื่อการเรียนรู้ระหว่างกัน');
INSERT INTO `standard_basic_indicator` VALUES (104, 2554, 304, 3, '3.4 ใช้เทคโนโลยีในการเรียนรู้และนำเสนอผลงาน');
INSERT INTO `standard_basic_indicator` VALUES (105, 2554, 401, 4, '4.1 สรุปความคิดเห็นจากเรื่องที่อ่าน ฟัง และดู และสื่อสารโดยการพูดหรือเขียนตามความคิดเห็นของตนเอง');
INSERT INTO `standard_basic_indicator` VALUES (106, 2554, 402, 4, '4.2 นำเสนอวิธีคิด วิธีแก้ปัญหาด้วยภาษาหรือวิธีของตนเอง');
INSERT INTO `standard_basic_indicator` VALUES (107, 2554, 403, 4, '4.3 กำหนดเป้าหมาย คาดการณ์ ตัดสินใจแก้ปัญหาโดยมีเหตุผลประกอบ');
INSERT INTO `standard_basic_indicator` VALUES (108, 2554, 404, 4, '4.4 มีความคิดริเริ่ม และสร้างสรรค์ผลงานด้วยความภาคภูมิใจ');
INSERT INTO `standard_basic_indicator` VALUES (109, 2554, 501, 5, '5.1 ผลสัมฤทธิ์ทางการเรียนแต่ละกลุ่มสาระเป็นไปตามเกณฑ์');
INSERT INTO `standard_basic_indicator` VALUES (110, 2554, 502, 5, '5.2 ผลการประเมินสมรรถนะสำคัญตามหลักสูตรเป็นไปตามเกณฑ์');
INSERT INTO `standard_basic_indicator` VALUES (111, 2554, 503, 5, '5.3 ผลการประเมินการอ่าน คิดวิเคราะห์ และเขียนเป็นไปตามเกณฑ์');
INSERT INTO `standard_basic_indicator` VALUES (112, 2554, 504, 5, '5.4 ผลการทดสอบระดับชาติเป็นไปตามเกณฑ์');
INSERT INTO `standard_basic_indicator` VALUES (113, 2554, 601, 6, '6.1 วางแผนการทำงานและดำเนินการจนสำเร็จ');
INSERT INTO `standard_basic_indicator` VALUES (114, 2554, 602, 6, '6.2 ทำงานอย่างมีความสุข มุ่งมั่นพัฒนางาน และภูมิใจในผลงานของตนเอง');
INSERT INTO `standard_basic_indicator` VALUES (115, 2554, 603, 6, '6.3 ทำงานร่วมกับผู้อื่นได้');
INSERT INTO `standard_basic_indicator` VALUES (116, 2554, 604, 6, '6.4 มีความรู้สึกที่ดีต่ออาชีพสุจริตและหาความรู้เกี่ยวกับอาชีพที่ตนเองสนใจ');
INSERT INTO `standard_basic_indicator` VALUES (117, 2554, 701, 7, '7.1 ครูมีการกำหนดเป้าหมายคุณภาพผู้เรียนทั้งด้านความรู้ ทักษะกระบวนการ สมรรถนะ และคุณลักษณะที่พึงประสงค์');
INSERT INTO `standard_basic_indicator` VALUES (118, 2554, 702, 7, '7.2 ครูมีการวิเคราะห์ผู้เรียนเป็นรายบุคคล และใช้ข้อมูลในการวางแผนจัดการเรียนรู้เพื่อพัฒนาศักยภาพผู้เรียน');
INSERT INTO `standard_basic_indicator` VALUES (119, 2554, 703, 7, '7.3 ครูออกแบบและจัดการเรียนรู้ที่ตอบสนองความแตกต่างระหว่างบุคคลและพัฒนาการทางสติปัญญา');
INSERT INTO `standard_basic_indicator` VALUES (120, 2554, 704, 7, '7.4 ครูใช้สื่อและเทคโนโลยีที่เหมาะสมผนวกกับการนำบริบทและภูมิปัญญาของท้องถิ่นมาบูรณาการในการจัดการเรียนรู้');
INSERT INTO `standard_basic_indicator` VALUES (121, 2554, 705, 7, '7.5 ครูมีการวัดและประเมินผลที่มุ่งเน้นการพัฒนาการเรียนรู้ของผู้เรียน ด้วยวิธีการที่หลากหลาย');
INSERT INTO `standard_basic_indicator` VALUES (122, 2554, 706, 7, '7.6 ครูให้คำแนะนำ คำปรึกษา และแก้ไขปัญหาให้แก่ผู้เรียน ทั้งด้านการเรียนและคุณภาพชีวิตด้วยความเสมอภาค');
INSERT INTO `standard_basic_indicator` VALUES (123, 2554, 707, 7, '7.7 ครูมีการศึกษา วิจัยและพัฒนาการจัดการเรียนรู้ในวิชาที่ตนรับผิดชอบ และใช้ผลในการปรับการสอน');
INSERT INTO `standard_basic_indicator` VALUES (124, 2554, 708, 7, '7.8 ครูประพฤติปฏิบัติตนเป็นแบบอย่างที่ดี และเป็นสมาชิกที่ดีของสถานศึกษา');
INSERT INTO `standard_basic_indicator` VALUES (125, 2554, 709, 7, '7.9 ครูจัดการเรียนการสอนตามวิชาที่ได้รับมอบหมายเต็มเวลา เต็มความสามารถ');
INSERT INTO `standard_basic_indicator` VALUES (126, 2554, 801, 8, '8.1 ผู้บริหารมีวิสัยทัศน์ ภาวะผู้นำ และความคิดริเริ่มที่เน้นการพัฒนาผู้เรียน');
INSERT INTO `standard_basic_indicator` VALUES (127, 2554, 802, 8, '8.2 ผู้บริหารใช้หลักการบริหารแบบมีส่วนร่วมและใช้ข้อมูลผลการประเมินหรือผลการวิจัยเป็นฐานคิด ทั้งด้านวิชาการและการจัดการ');
INSERT INTO `standard_basic_indicator` VALUES (128, 2554, 803, 8, '8.3 ผู้บริหารสามารถบริหารจัดการให้บรรลุเป้าหมายที่กำหนดไว้ในแผนปฏิบัติการ');
INSERT INTO `standard_basic_indicator` VALUES (129, 2554, 804, 8, '8.4 ผู้บริหารส่งเสริมและพัฒนาศักยภาพบุคลากรให้พร้อมรับการกระจายอำนาจ');
INSERT INTO `standard_basic_indicator` VALUES (130, 2554, 805, 8, '8.5 นักเรียน ผู้ปกครอง และชุมชน พึงพอใจต่อผลการบริหารจัดการศึกษา');
INSERT INTO `standard_basic_indicator` VALUES (131, 2554, 806, 8, '8.6 ผู้บริหารให้คำแนะนำ คำปรึกษาทางวิชาการและเอาใจใส่การจัดการศึกษาเต็มศักยภาพและเต็มเวลา');
INSERT INTO `standard_basic_indicator` VALUES (132, 2554, 901, 9, '9.1 คณะกรรมการสถานศึกษารู้และปฏิบัติหน้าที่ตามที่ระเบียบกำหนด');
INSERT INTO `standard_basic_indicator` VALUES (133, 2554, 902, 9, '9.2 คณะกรรมการสถานศึกษากำกับติดตาม ดูแล และขับเคลื่อนการดำเนินงานของสถานศึกษาให้บรรลุผลสำเร็จตามเป้าหมาย');
INSERT INTO `standard_basic_indicator` VALUES (134, 2554, 903, 9, '9.3 ผู้ปกครองและชุมชนเข้ามามีส่วนร่วมในการพัฒนาสถานศึกษา');
INSERT INTO `standard_basic_indicator` VALUES (135, 2554, 1001, 10, '10.1 หลักสูตรสถานศึกษาเหมาะสมและสอดคล้องกับท้องถิ่น');
INSERT INTO `standard_basic_indicator` VALUES (136, 2554, 1002, 10, '10.2 จัดรายวิชาเพิ่มเติมที่หลากหลายให้ผู้เรียนเลือกเรียนตามความถนัด ความสามารถ และความสนใจ');
INSERT INTO `standard_basic_indicator` VALUES (137, 2554, 1003, 10, '10.3 จัดกิจกรรมพัฒนาผู้เรียนที่ส่งเสริมและตอบสนองความต้องการ ความสามารถ ความถนัด และความสนใจของผู้เรียน');
INSERT INTO `standard_basic_indicator` VALUES (138, 2554, 1004, 10, '10.4 สนับสนุนให้ครูจัดกระบวนการเรียนรู้ที่ให้ผู้เรียนได้ลงมือปฏิบัติจริงจนสรุปความรู้ได้ด้วยตนเอง');
INSERT INTO `standard_basic_indicator` VALUES (139, 2554, 1005, 10, '10.5 นิเทศภายใน กำกับ ติดตามตรวจสอบ และนำผลไปปรับปรุงการเรียนการสอนอย่างสม่ำเสมอ');
INSERT INTO `standard_basic_indicator` VALUES (140, 2554, 1006, 10, '10.6 จัดระบบดูแลช่วยเหลือผู้เรียนที่มีประสิทธิภาพและครอบคลุมถึงผู้เรียนทุกคน');
INSERT INTO `standard_basic_indicator` VALUES (141, 2554, 1101, 11, '11.1 ห้องเรียน ห้องปฏิบัติการ อาคารเรียนมั่นคง สะอาดและปลอดภัย มีสิ่งอำนวยความสะดวกพอเพียง อยู่ในสภาพใช้การได้ดี สภาพแวดล้อมร่มรื่น และมีแหล่งเรียนรู้สำหรับผู้เรียน');
INSERT INTO `standard_basic_indicator` VALUES (142, 2554, 1102, 11, '11.2 จัดโครงการ กิจกรรมที่ส่งเสริมสุขภาพอนามัยและความปลอดภัยของผู้เรียน');
INSERT INTO `standard_basic_indicator` VALUES (143, 2554, 1103, 11, '11.3 จัดห้องสมุดที่ให้บริการสื่อเทคโนโลยีสารสนเทศที่เอื้อให้ผู้เรียนเรียนรู้ด้วยตนเองและหรือเรียนรู้แบบมีส่วนร่วม');
INSERT INTO `standard_basic_indicator` VALUES (144, 2554, 1201, 12, '12.1 กำหนดมาตรฐานการศึกษาของสถานศึกษา');
INSERT INTO `standard_basic_indicator` VALUES (145, 2554, 1202, 12, '12.2 จัดทำและดำเนินการตามแผนพัฒนาการจัดการศึกษาของสถานศึกษาที่มุ่งพัฒนาคุณภาพตามมาตรฐานการศึกษาของสถานศึกษา');
INSERT INTO `standard_basic_indicator` VALUES (146, 2554, 1203, 12, '12.3 จัดระบบข้อมูลสารสนเทศและใช้สารสนเทศในการบริหารจัดการเพื่อพัฒนาคุณภาพการศึกษาอย่างต่อเนื่อง');
INSERT INTO `standard_basic_indicator` VALUES (147, 2554, 1204, 12, '12.4 ติดตามตรวจสอบ และประเมินคุณภาพภายในตามมาตรฐานการศึกษาของสถานศึกษา');
INSERT INTO `standard_basic_indicator` VALUES (148, 2554, 1205, 12, '12.5 นำผลประเมินคุณภาพทั้งภายในและภายนอกไปใช้วางแผนพัฒนาคุณภาพการศึกษาอย่างต่อเนื่อง');
INSERT INTO `standard_basic_indicator` VALUES (149, 2554, 1206, 12, '12.6 จัดทำรายงานประจำปีที่เป็นรายงานการประเมินคุณภาพภายใน');
INSERT INTO `standard_basic_indicator` VALUES (150, 2554, 1301, 13, '13.1 มีการสร้างและพัฒนาแหล่งเรียนรู้ภายในสถานศึกษาและใช้ประโยชน์จากแหล่งเรียนรู้ทั้งภายในและภายนอกสถานศึกษา เพื่อพัฒนาการเรียนรู้ของผู้เรียนและบุคลากรของสถานศึกษา รวมทั้งผู้ที่เกี่ยวข้อง');
INSERT INTO `standard_basic_indicator` VALUES (151, 2554, 1302, 13, '13.2 มีการแลกเปลี่ยนเรียนรู้ระหว่างบุคลากรภายในสถานศึกษา ระหว่างสถานศึกษากับครอบครัว ชุมชน และองค์กรที่เกี่ยวข้อง');
INSERT INTO `standard_basic_indicator` VALUES (152, 2554, 1401, 14, '14.1 จัดโครงการ กิจกรรมที่ส่งเสริมให้ผู้เรียนบรรลุตามเป้าหมายวิสัยทัศน์ ปรัชญา และจุดเน้นของสถานศึกษา');
INSERT INTO `standard_basic_indicator` VALUES (153, 2554, 1402, 14, '14.2 ผลการดำเนินงานส่งเสิรมให้ผู้เรียนบรรลุตามเป้าหมาย วิสัยทัศน์ ปรัชญา และจุดเน้นของสถานศึกษา');
INSERT INTO `standard_basic_indicator` VALUES (154, 2554, 1501, 15, '15.1 จัดโครงการ กิจกรรมพิเศษเพื่อตอบสนองนโยบาย จุดเน้น ตามแนวทางปฏิรูปการศึกษา');
INSERT INTO `standard_basic_indicator` VALUES (155, 2554, 1502, 15, '15.2 ผลการดำเนินงานบรรลุตามเป้าหมาย');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `standard_basic_sd`
-- 

CREATE TABLE `standard_basic_sd` (
  `id` int(11) NOT NULL auto_increment,
  `sd_year` int(11) NOT NULL,
  `sd_id` int(11) NOT NULL,
  `sd_name` varchar(150) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=38 ;

-- 
-- dump ตาราง `standard_basic_sd`
-- 

INSERT INTO `standard_basic_sd` VALUES (5, 2553, 2, 'ผู้เรียนมีจิตสำนึกในการอนุรักษ์และพัฒนาสิ่งแวดล้อม');
INSERT INTO `standard_basic_sd` VALUES (4, 2553, 1, 'ผู้เรียนมีคุณธรรม จริยธรรม และค่านิยมที่พึงประสงค์');
INSERT INTO `standard_basic_sd` VALUES (6, 2553, 3, 'ผู้เรียนมีทักษะในการทำงาน รักการทำงาน สามารถทำงานร่วมกับผู้อื่นและมีเจตคติที่ดีต่ออาชีพสุจริต');
INSERT INTO `standard_basic_sd` VALUES (7, 2553, 4, 'ผู้เรียนมีความสามารถในการคิดวิเคราะห์ คิดสังเคราะห์ มีวิจารณญาณ มีความคิดสร้างสรรค์ คิดไตรตรอง และมีวิสัยทัศน์');
INSERT INTO `standard_basic_sd` VALUES (8, 2553, 5, 'มีความรู้และทักษะที่จำเป็นตามหลักสูตร');
INSERT INTO `standard_basic_sd` VALUES (9, 2553, 6, 'มีความรู้และทักษะที่จำเป็นตามหลักสูตร');
INSERT INTO `standard_basic_sd` VALUES (10, 2553, 7, 'ผู้เรียนมีสุขนิสัย สุขภาพกาย และสุขภาพจิตที่ดี');
INSERT INTO `standard_basic_sd` VALUES (11, 2553, 8, 'ผู้เรียนมีสุนทรียภาพและลักษณะนิสัยด้านศิลปะ ดนตรีและกีฬา');
INSERT INTO `standard_basic_sd` VALUES (12, 2553, 9, 'ครูมีคุณธรรม จริยธรรม มีวุฒิ/ความรู้ความสามารถตรงกับงานที่รับผิดชอบ หมั่นพัฒนาตนเองเข้ากับชุมชนได้ดีและมีครูพอเพียง');
INSERT INTO `standard_basic_sd` VALUES (13, 2553, 10, 'ครูมีความสามารถในการจัดประสบการณ์การเรียนรู้ได้อย่างมีประสิทธิภาพและเน้นผู้เรียนเป็นสำคัญ');
INSERT INTO `standard_basic_sd` VALUES (14, 2553, 11, 'ผู้บริหารมีคุณธรรม จริยธรรม มีภาวะผู้นำ และมีความสามารถ ในการบริหารจัดการศึกษา');
INSERT INTO `standard_basic_sd` VALUES (15, 2553, 12, 'สถานศึกษามีการจัดองค์กร โครงสร้าง ระบบการบริหารงานและพัฒนาองค์กรอย่างเป็นระบบครบวงจร');
INSERT INTO `standard_basic_sd` VALUES (16, 2553, 13, 'สถานศึกษามีการบริหารและจัดการศึกษาโดยใช้สถานศึกษาเป็นฐาน');
INSERT INTO `standard_basic_sd` VALUES (17, 2553, 14, 'สถานศึกษามีการจัดหลักสูตรและกระบวนการเรียนรู้ที่เน้นผู้เรียนเป็นสำคัญ');
INSERT INTO `standard_basic_sd` VALUES (18, 2553, 15, 'สถานศึกษามีการจัดกิจกรรมส่งเสริมคุณภาพผู้เรียนอย่างหลากหลาย');
INSERT INTO `standard_basic_sd` VALUES (19, 2553, 16, 'สถานศึกษามีการจัดสภาพแวดล้อมและการบริการที่ส่งเสริมให้ผู้เรียนพัฒนาตามธรรมชาติเต็มศักยภาพ');
INSERT INTO `standard_basic_sd` VALUES (20, 2553, 17, 'สถานศึกษามีการสนับสนุนและใช้แหล่งเรียนรู้และภูมิปัญญาในท้องถิ่น');
INSERT INTO `standard_basic_sd` VALUES (21, 2553, 18, 'สถานศึกษามีการร่วมมือกันระหว่างบ้าน  องค์กรทางศาสนา  สถาบันทางวิชาการ  และองค์กรภาครัฐและเอกชน  เพื่อพัฒนาวิถีการเรียนรู้ในชุมชน');
INSERT INTO `standard_basic_sd` VALUES (23, 2554, 1, 'ผู้เรียนมีสุขภาวะที่ดีและมีสุนทรียภาพ');
INSERT INTO `standard_basic_sd` VALUES (24, 2554, 2, 'ผู้เรียนมีคุณธรรม จริยธรรม และค่านิยมที่พึงประสงค์');
INSERT INTO `standard_basic_sd` VALUES (25, 2554, 3, 'ผู้เรียนมีทักษะในการแสวงหาความรู้ด้วยตนเอง รักเรียนรู้ และพัฒนาตนเองอย่างต่อเนื่อง');
INSERT INTO `standard_basic_sd` VALUES (26, 2554, 4, 'ผู้เรียนมีความสามารถในการคิดอย่างเป็นระบบ คิดสร้างสรรค์ ตัดสินใจ แก้ปัญหาได้อย่างมีสติสมเหตุผล');
INSERT INTO `standard_basic_sd` VALUES (27, 2554, 5, 'ผู้เรียนมีความรู้และทักษะที่จำเป็นตามหลักสูตร');
INSERT INTO `standard_basic_sd` VALUES (28, 2554, 6, 'ผู้เรียนมีทักษะในการทำงาน รักการทำงาน สามารถทำงานร่วมกับผู้อื่นได้ และมีเจตคติที่ดีต่ออาชีพสุจริต');
INSERT INTO `standard_basic_sd` VALUES (29, 2554, 7, 'ครูปฏิบัติงานตามบทบาทหน้าที่อย่างมีประสิทธิภาพและเกิดประสิทธิผล');
INSERT INTO `standard_basic_sd` VALUES (30, 2554, 8, 'ผู้บริหารปฏิบัติงานตามบทบาทหน้าที่อย่างมีประสิทธิภาพและเกิดประสิทธิผล');
INSERT INTO `standard_basic_sd` VALUES (31, 2554, 9, 'คณะกรรมการสถานศึกษา และผู้ปกครอง ชุมชน ปฏิบัติงานตามบทบาทหน้าที่อย่างมีประสิทธิภาพและเกิดประสิทธิผล');
INSERT INTO `standard_basic_sd` VALUES (32, 2554, 10, 'สถานศึกษามีการจัดหลักสูตร กระบวนการเรียนรู้ และกิจกรรมพัฒนาคุณภาพผู้เรียนอย่างรอบด้าน');
INSERT INTO `standard_basic_sd` VALUES (33, 2554, 11, 'สถานศึกษามีการจัดสภาพแวดล้อมและการบริการที่ส่งเสริมให้ผู้เรียนพัฒนาเต็มศักยภาพ');
INSERT INTO `standard_basic_sd` VALUES (34, 2554, 12, 'สถานศึกษามีการประกันคุณภาพภายในของสถานศึกษาตามที่กำหนดในกฎกระทรวง');
INSERT INTO `standard_basic_sd` VALUES (35, 2554, 13, 'สถานศึกษามีการสร้าง ส่งสเริม สนับสนุน ให้สถานศึกษาเป็นสังคมแห่งการเรียนรู้');
INSERT INTO `standard_basic_sd` VALUES (36, 2554, 14, 'การพัฒนาสถานศึกษาให้บรรลุเป้าหมายตามวิสัยทัศน์ ปรัชญา และจุดเน้นที่กำหนดขึ้น');
INSERT INTO `standard_basic_sd` VALUES (37, 2554, 15, 'การจัดกิจกรรมตามนโนบาย จุดเน้น แนวทางการปฏิรูปการศึกษาเพื่อพัฒนาและส่งเสริมสถานศึกษาให้ยกระดับคุณภาพสูงขึ้น');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `standard_elementary_indicator`
-- 

CREATE TABLE `standard_elementary_indicator` (
  `id` int(11) NOT NULL auto_increment,
  `sd_year` int(11) NOT NULL,
  `id_indicator` int(11) NOT NULL,
  `sd_id` int(11) NOT NULL,
  `indicator_name` varchar(250) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=186 ;

-- 
-- dump ตาราง `standard_elementary_indicator`
-- 

INSERT INTO `standard_elementary_indicator` VALUES (3, 2553, 101, 1, '1.1 มีวินัย มีความรับผิดชอบ ปฏิบัติตามข้อตกลงร่วมกัน');
INSERT INTO `standard_elementary_indicator` VALUES (4, 2553, 102, 1, '1.2 มีความซื่อสัตย์สุจริต');
INSERT INTO `standard_elementary_indicator` VALUES (5, 2553, 103, 1, '1.3 มีความกตัญญูกตเวที');
INSERT INTO `standard_elementary_indicator` VALUES (6, 2553, 104, 1, '1.4 มีเมตตากรุณา มีความรู้สึกที่ดีต่อตนเองและผู้อื่น');
INSERT INTO `standard_elementary_indicator` VALUES (7, 2553, 105, 1, '1.5 ประหยัด รู้จักใช้และรักษาทรัพยากร และสิ่งแวดล้อม');
INSERT INTO `standard_elementary_indicator` VALUES (8, 2553, 106, 1, '1.6 มีมารยาทและปฏิบัติตนตามวัฒนธรรมไทย');
INSERT INTO `standard_elementary_indicator` VALUES (9, 2553, 201, 2, '2.1 รับรู้คุณค่าของสิ่งแวดล้อมและผลกระทบที่เกิดจากการเปลี่ยนแปลงสิ่งแวดล้อม');
INSERT INTO `standard_elementary_indicator` VALUES (10, 2553, 202, 2, '2.2 เข้าร่วมหรือมีส่วนร่วมกิจกรรม/โครงการอนุรักษ์และพัฒนาสิ่งแวดล้อม');
INSERT INTO `standard_elementary_indicator` VALUES (11, 2553, 301, 3, '3.1 สนใจและกระตือรือร้นในการทำงาน');
INSERT INTO `standard_elementary_indicator` VALUES (12, 2553, 302, 3, '3.2 ทำงานจนสำเร็จและภูมิใจในผลงาน');
INSERT INTO `standard_elementary_indicator` VALUES (13, 2553, 303, 3, '3.3 เล่นและทำกิจกรรมร่วมกับผู้อื่นได้');
INSERT INTO `standard_elementary_indicator` VALUES (14, 2553, 304, 3, '3.4 มีความรู้สึกที่ดีต่ออาชีพสุจริต');
INSERT INTO `standard_elementary_indicator` VALUES (15, 2553, 401, 4, '4.1 มีความคิดรวบยอดเกี่ยวกับสิ่งต่างๆ ที่เกิดจากการเรียนรู้');
INSERT INTO `standard_elementary_indicator` VALUES (16, 2553, 402, 4, '4.2 แก้ปัญหาได้เหมาะสมกับวัย');
INSERT INTO `standard_elementary_indicator` VALUES (17, 2553, 403, 4, '4.3 มีจินตนาการ และ มีความคิดริเริ่มสร้างสรรค์');
INSERT INTO `standard_elementary_indicator` VALUES (18, 2553, 501, 5, '5.1 มีทักษะในการใช้กล้ามเนื้อใหญ่-เล็ก');
INSERT INTO `standard_elementary_indicator` VALUES (19, 2553, 502, 5, '5.2 มีทักษะในการใช้ประสาทสัมผัสทั้ง 5');
INSERT INTO `standard_elementary_indicator` VALUES (20, 2553, 503, 5, '5.3 มีทักษะในการสื่อสาร');
INSERT INTO `standard_elementary_indicator` VALUES (21, 2553, 504, 5, '5.4 มีทักษะในการสังเกตและสำรวจ');
INSERT INTO `standard_elementary_indicator` VALUES (22, 2553, 505, 5, '5.5 มีทักษะในเรื่องมิติสัมพันธ์');
INSERT INTO `standard_elementary_indicator` VALUES (23, 2553, 506, 5, '5.6 มีทักษะในเรื่องจำนวน ปริมาณ น้ำหนัก และการกะประมาณ');
INSERT INTO `standard_elementary_indicator` VALUES (24, 2553, 507, 5, '5.7 เชื่อมโยงความรู้และทักษะต่างๆ');
INSERT INTO `standard_elementary_indicator` VALUES (25, 2553, 601, 6, '6.1 รู้จักตั้งคำถามเพื่อหาเหตุผล และมีความสนใจใฝ่รู้');
INSERT INTO `standard_elementary_indicator` VALUES (26, 2553, 602, 6, '6.2 มีความกระตือรือร้นในการเรียนรู้สิ่งต่างๆ รอบตัว และสนุกกับการเรียนรู้');
INSERT INTO `standard_elementary_indicator` VALUES (27, 2553, 701, 7, '7.1 รักการออกกำลังกาย ดูแลสุขภาพ และช่วยเหลือตนเองได้');
INSERT INTO `standard_elementary_indicator` VALUES (28, 2553, 702, 7, '7.2 มีน้ำหนัก ส่วนสูง และมีสมรรถภาพทางกายตามเกณฑ์');
INSERT INTO `standard_elementary_indicator` VALUES (29, 2553, 703, 7, '7.3 เห็นโทษของสิ่งเสพติดให้โทษและสิ่งมอมเมา');
INSERT INTO `standard_elementary_indicator` VALUES (30, 2553, 704, 7, '7.4 มีความมั่นใจ กล้าแสดงออกอย่างเหมาะสม');
INSERT INTO `standard_elementary_indicator` VALUES (31, 2553, 705, 7, '7.5 ร่าเริง แจ่มใส มีมนุษยสัมพันธ์ที่ดีต่อเพื่อน ครู และผู้อื่น');
INSERT INTO `standard_elementary_indicator` VALUES (32, 2553, 801, 8, '8.1 ร่าเริง แจ่มใส มีมนุษยสัมพันธ์ที่ดีต่อเพื่อน ครู และผู้อื่น');
INSERT INTO `standard_elementary_indicator` VALUES (33, 2553, 802, 8, '8.2 มีความสนใจและร่วมกิจกรรมด้านดนตรี');
INSERT INTO `standard_elementary_indicator` VALUES (34, 2553, 803, 8, '8.3 มีความสนใจและร่วมกิจกรรมการเคลื่อนไหว');
INSERT INTO `standard_elementary_indicator` VALUES (35, 2553, 901, 9, '9.1 มีคุณธรรมจริยธรรม และปฏิบัติตนตามจรรยาบรรณของวิชาชีพ');
INSERT INTO `standard_elementary_indicator` VALUES (36, 2553, 902, 9, '9.2 มีมนุษยสัมพันธ์ที่ดีกับเด็ก ผู้ปกครอง และชุมชน');
INSERT INTO `standard_elementary_indicator` VALUES (37, 2553, 903, 9, '9.3 มีความมุ่งมั่นและอุทิศตนในการสอนและพัฒนาเด็ก');
INSERT INTO `standard_elementary_indicator` VALUES (38, 2553, 904, 9, '9.4 มีการแสวงหาความรู้และเทคนิควิธีการใหม่ๆ รับฟังความคิดเห็นใจกว้าง และยอมรับการเปลี่ยนแปลง');
INSERT INTO `standard_elementary_indicator` VALUES (39, 2553, 905, 9, '9.5 จบการศึกษาระดับปริญญาตรีทางการศึกษาหรือเทียบเท่าขึ้นไป');
INSERT INTO `standard_elementary_indicator` VALUES (40, 2553, 906, 9, '9.6 สอนตรงตามวิชาเอก-โท หรือ ตรงตามความถนัด');
INSERT INTO `standard_elementary_indicator` VALUES (41, 2553, 907, 9, '9.7 มีจำนวนพอเพียง (หมายรวมทั้งครูและบุคลากรสนับสนุน)');
INSERT INTO `standard_elementary_indicator` VALUES (42, 2553, 1001, 10, '10.1 มีความรู้ความเข้าใจเป้าหมายการจัดการศึกษาและหลักสูตรการศึกษาปฐมวัย');
INSERT INTO `standard_elementary_indicator` VALUES (43, 2553, 1002, 10, '10.2 มีการวิเคราะห์เด็กเป็นรายบุคคล');
INSERT INTO `standard_elementary_indicator` VALUES (44, 2553, 1003, 10, '10.3 มีความสามารถในการจัดประสบการณ์ที่เน้นเด็กเป็นสำคัญ');
INSERT INTO `standard_elementary_indicator` VALUES (45, 2553, 1004, 10, '10.4 มีความสามารถในการใช้สื่อที่เหมาะสมและสอดคล้องกับการเรียนรู้ของเด็ก');
INSERT INTO `standard_elementary_indicator` VALUES (46, 2553, 1005, 10, '10.5 มีการประเมินพัฒนาการของเด็กตามสภาพจริงโดยคำนึงถึงพัฒนาการตามวัย');
INSERT INTO `standard_elementary_indicator` VALUES (47, 2553, 1006, 10, '10.6 มีการนำผลการประเมินพัฒนาการมาปรับเปลี่ยนการจัดประสบการณ์เพื่อพัฒนาเด็กให้เต็มตามศักยภาพ');
INSERT INTO `standard_elementary_indicator` VALUES (48, 2553, 1007, 10, '10.7 มีการวิจัยเพื่อพัฒนาการเรียนรู้ของเด็กและนำผลไปใช้พัฒนาเด็ก');
INSERT INTO `standard_elementary_indicator` VALUES (49, 2553, 1101, 11, '11.1 มีคุณธรรม จริยธรรม และปฏิบัติตนตามจรรยาบรรณของวิชาชีพ');
INSERT INTO `standard_elementary_indicator` VALUES (50, 2553, 1102, 11, '11.2 มีความคิดริเริ่ม มีวิสัยทัศน์ และเป็นผู้นำทางวิชาการ');
INSERT INTO `standard_elementary_indicator` VALUES (51, 2553, 1103, 11, '11.3 มีความสามารถในการบริหารงานวิชาการและการจัดการ');
INSERT INTO `standard_elementary_indicator` VALUES (52, 2553, 1104, 11, '11.4 มีการบริหารที่มีประสิทธิภาพและประสิทธิผล ผู้เกี่ยวข้องพึงพอใจ');
INSERT INTO `standard_elementary_indicator` VALUES (53, 2553, 1201, 12, '12.1 มีการจัดองค์กร โครงสร้าง และระบบการบริหารงานที่มีความคล่องตัวสูงและปรับเปลี่ยนได้เหมาะสมตามสถานการณ์');
INSERT INTO `standard_elementary_indicator` VALUES (54, 2553, 1202, 12, '12.2 มีการจัดการข้อมูลสารสนเทศอย่างเป็นระบบ ครอบคลุมและทันต่อการใช้งาน');
INSERT INTO `standard_elementary_indicator` VALUES (55, 2553, 1203, 12, '12.3 มีระบบการประกันคุณภาพภายในที่ดำเนินงานอย่างต่อเนื่อง');
INSERT INTO `standard_elementary_indicator` VALUES (56, 2553, 1204, 12, '12.4 มีการพัฒนาบุคลากรอย่างเป็นระบบและต่อเนื่อง');
INSERT INTO `standard_elementary_indicator` VALUES (57, 2553, 1205, 12, '12.5 ผู้รับบริการและผู้เกี่ยวข้องพึงพอใจผลการบริหารงานและการพัฒนาเด็ก');
INSERT INTO `standard_elementary_indicator` VALUES (58, 2553, 1301, 13, '13.1 มีการกระจายอำนาจการบริหาร และการจัดการศึกษา');
INSERT INTO `standard_elementary_indicator` VALUES (59, 2553, 1302, 13, '13.2 มีการบริหารเชิงกลยุทธ์ และใช้หลักการมีส่วนร่วม');
INSERT INTO `standard_elementary_indicator` VALUES (60, 2553, 1303, 13, '13.3 มีคณะกรรมการสถานศึกษาร่วมพัฒนาสถานศึกษา');
INSERT INTO `standard_elementary_indicator` VALUES (61, 2553, 1304, 13, '13.4 มีการบริหารที่มุ่งผลสัมฤทธิ์ของงาน');
INSERT INTO `standard_elementary_indicator` VALUES (62, 2553, 1305, 13, '13.5 มีการตรวจสอบและถ่วงดุล');
INSERT INTO `standard_elementary_indicator` VALUES (63, 2553, 1401, 14, '14.1 มีหลักสูตรที่เหมาะสมกับเด็กและท้องถิ่น');
INSERT INTO `standard_elementary_indicator` VALUES (64, 2553, 1402, 14, '14.2 มีการส่งเสริมให้ครูจัดทำแผนการจัดประสบการณ์การเรียนรู้ที่ตอบสนองความสนใจและเหมาะสมกับวัยของเด็ก');
INSERT INTO `standard_elementary_indicator` VALUES (65, 2553, 1403, 14, '14.3 มีการส่งเสริมและพัฒนานวัตกรรมการจัดประสบการณ์การเรียนรู้ และสื่ออุปกรณ์การเรียนที่เอื้อต่อการเรียนรู้');
INSERT INTO `standard_elementary_indicator` VALUES (66, 2553, 1404, 14, '14.4 มีการจัดกิจกรรมการเรียนรู้โดยบูรณาการผ่านการเล่นและเด็กได้เรียนรู้จากประสบการณ์ตรง');
INSERT INTO `standard_elementary_indicator` VALUES (67, 2553, 1405, 14, '14.5 มีการบันทึก การรายงานผล และการส่งต่อข้อมูลของเด็กอย่างเป็นระบบ');
INSERT INTO `standard_elementary_indicator` VALUES (68, 2553, 1406, 14, '14.6 มีการนิเทศและนำผลไปปรับปรุงการจัดกิจกรรม/ประสบการณ์อย่างสม่ำเสมอ');
INSERT INTO `standard_elementary_indicator` VALUES (69, 2553, 1407, 14, '14.7 มีการนำแหล่งเรียนรู้และภูมิปัญญาท้องถิ่นมาใช้ในการจัดประสบการณ์');
INSERT INTO `standard_elementary_indicator` VALUES (70, 2553, 1501, 15, '15.1 มีการจัดและพัฒนาระบบดูแลช่วยเหลือเด็กอย่างทั่วถึง');
INSERT INTO `standard_elementary_indicator` VALUES (71, 2553, 1502, 15, '15.2 มีการจัดกิจกรรม กระตุ้นพัฒนาการทางสมอง ตอบสนองความสนใจ และส่งเสริมความคิดสร้างสรรค์ของเด็ก');
INSERT INTO `standard_elementary_indicator` VALUES (72, 2553, 1503, 15, '15.3 มีการจัดกิจกรรมส่งเสริมค่านิยมที่ดีงาม');
INSERT INTO `standard_elementary_indicator` VALUES (73, 2553, 1504, 15, '15.4 มีการจัดกิจกรรมส่งเสริมด้านศิลปะ ดนตรี และการเคลื่อนไหว');
INSERT INTO `standard_elementary_indicator` VALUES (74, 2553, 1505, 15, '15.5 มีการจัดกิจกรรมสืบสานและสร้างสรรค์ วัฒนธรรม ประเพณี และภูมิปัญญาไทย');
INSERT INTO `standard_elementary_indicator` VALUES (75, 2553, 1506, 15, '15.6 มีการจัดกิจกรรมส่งเสริมความเป็นประชาธิปไตย');
INSERT INTO `standard_elementary_indicator` VALUES (76, 2553, 1601, 16, '16.1 มีสภาพแวดล้อมที่เอื้อต่อการเรียนรู้ มีอาคารสถานที่เหมาะสม');
INSERT INTO `standard_elementary_indicator` VALUES (77, 2553, 1602, 16, '16.2 มีการส่งเสริมสุขภาพอนามัยและความปลอดภัยของเด็ก');
INSERT INTO `standard_elementary_indicator` VALUES (78, 2553, 1603, 16, '16.3 มีการให้บริการเทคโนโลยีสารสนเทศที่เอื้อต่อการเรียนรู้ด้วยตนเองและการเรียนรู้แบบมีส่วนร่วม');
INSERT INTO `standard_elementary_indicator` VALUES (79, 2553, 1604, 16, '16.4 มีห้องเรียน ห้องสมุด สนามเด็กเล่น พื้นที่สีเขียว และสิ่งอำนวยความสะดวกพอเพียงและอยู่ในสภาพใช้การได้ดี');
INSERT INTO `standard_elementary_indicator` VALUES (80, 2553, 1605, 16, '16.5 มีการจัดและใช้แหล่งเรียนรู้ทั้งในและนอกสถานศึกษา');
INSERT INTO `standard_elementary_indicator` VALUES (81, 2553, 1701, 17, '17.1 มีการเชื่อมโยงและแลกเปลี่ยนข้อมูลกับแหล่งเรียนรู้และภูมิปัญญาในท้องถิ่น');
INSERT INTO `standard_elementary_indicator` VALUES (82, 2553, 1702, 17, '17.2 สนับสนุนให้แหล่งเรียนรู้ ภูมิปัญญา และชุมชน เข้ามามีส่วนร่วมในการจัดทำหลักสูตรระดับสถานศึกษา');
INSERT INTO `standard_elementary_indicator` VALUES (83, 2553, 1801, 18, '18.1 เป็นแหล่งวิทยาการในการแสวงหาความรู้และบริการชุมชน');
INSERT INTO `standard_elementary_indicator` VALUES (84, 2553, 1802, 18, '18.2 มีการแลกเปลี่ยนเรียนรู้ร่วมกัน');
INSERT INTO `standard_elementary_indicator` VALUES (87, 2554, 101, 1, '1.1 มีน้ำหนักส่วนสูงเป็นไปตามเกณฑ์มาตรฐาน');
INSERT INTO `standard_elementary_indicator` VALUES (88, 2554, 102, 1, '1.2 มีทักษะการเคลื่อนไหวตามวัย');
INSERT INTO `standard_elementary_indicator` VALUES (89, 2554, 103, 1, '1.3 มีสุขนิสัยในการดูแลสุขภาพของตน');
INSERT INTO `standard_elementary_indicator` VALUES (90, 2554, 104, 1, '1.4 หลีกเลี่ยงต่อสภวะที่เสี่ยงต่อโรค อุบัติเหตุ ภัย สิ่งแวดล้อม');
INSERT INTO `standard_elementary_indicator` VALUES (172, 2554, 204, 2, '2.4 ชื่นชมศิลปะ ดนตรี การเคลื่อนไหว และรักธรรมชาติ');
INSERT INTO `standard_elementary_indicator` VALUES (93, 2554, 201, 2, '2.1 ร่าเริงแจ่มใส มีความรู้สึกที่ดีต่อตนเอง');
INSERT INTO `standard_elementary_indicator` VALUES (94, 2554, 202, 2, '2.2 มีความมั่นใจและกล้าแสดงออก');
INSERT INTO `standard_elementary_indicator` VALUES (171, 2554, 203, 2, '2.3 ควบคุมอารมณ์ตนเองให้เหมาะสมกับวัย');
INSERT INTO `standard_elementary_indicator` VALUES (95, 2554, 301, 3, '3.1 มีวินัย รับผิดชอบ เชื่อฟังคำสั่งสอนของพ่อแม่ ครูอาจารย์');
INSERT INTO `standard_elementary_indicator` VALUES (96, 2554, 302, 3, '3.2 มีความซื่อสัตย์สุจริต ช่วยเหลือแบ่งปัน');
INSERT INTO `standard_elementary_indicator` VALUES (97, 2554, 303, 3, '3.3 เล่นและทำงานร่วมกับผู้อื่นได้');
INSERT INTO `standard_elementary_indicator` VALUES (98, 2554, 304, 3, '3.4 ประพฤติตนตามวัฒนธรรมไทยและศาสนาที่ตนนับถือ');
INSERT INTO `standard_elementary_indicator` VALUES (99, 2554, 401, 4, '4.1 สนใจเรียนรู้สิ่งรอบตัว ซักถามอย่างตั้งใจ และรักการเรียนรู้');
INSERT INTO `standard_elementary_indicator` VALUES (100, 2554, 402, 4, '4.2 มีความคิดรอบยอดเกี่ยวกับสิ่งต่าง ๆ ที่เกิดจากประสบการณ์การเรียนรู้');
INSERT INTO `standard_elementary_indicator` VALUES (101, 2554, 403, 4, '4.3 มีทักษะทางภาษาที่เหมาะสมกับวัย');
INSERT INTO `standard_elementary_indicator` VALUES (102, 2554, 501, 5, '5.1 ครูเข้าใจปรัชญา หลักการ และธรรมชาติของการจัดการศึกษาปฐมวัย และสามารถนำมาประยุกต์ใช้ในการจัดประสบการณ์');
INSERT INTO `standard_elementary_indicator` VALUES (103, 2554, 502, 5, '5.2 ครูจัดทำแผนการจัดประสบการณ์ที่สอดคล้องกับหลักสูตรการศึกษาปฐมวัย และสามารถจัดประสบการณ์การเรียนรู้ที่หลากหลาย สอดคล้องกับความแตกต่างระหว่างบุคคล');
INSERT INTO `standard_elementary_indicator` VALUES (104, 2554, 503, 5, '5.3 ครูบริหารจัดการชั้นเรียนที่สร้างวินัยเชิงบวก');
INSERT INTO `standard_elementary_indicator` VALUES (105, 2554, 504, 5, '5.4 ครูใช้สื่อเทคโนโลยีที่เหมาะสม สอดคล้องกับพัฒนาการของเด็ก');
INSERT INTO `standard_elementary_indicator` VALUES (106, 2554, 505, 5, '5.5 ครูใช้เครื่องมือการวัดและประเมินพัฒนาการของเด็กอย่างหลากหลาย และสรุปรายงานผลพัฒนาการของเด็กแก่ผู้ปกครอง');
INSERT INTO `standard_elementary_indicator` VALUES (107, 2554, 506, 5, '5.6 ครูวิจัยและพัฒนาการจัดการเรียนรู้ที่ตนรับผิดชอบ และใช้ผลในการปรับการจัดประสบการณ์');
INSERT INTO `standard_elementary_indicator` VALUES (108, 2554, 507, 5, '5.7 ครูจัดสิ่งแวดล้อมให้เกิดการเรียนรู้ได้ตลอดเวลา');
INSERT INTO `standard_elementary_indicator` VALUES (109, 2554, 601, 6, '6.1 ผู้บริหารเข้าใจปรัชญาและหลักการจัดการศึกษาปฐมวัย');
INSERT INTO `standard_elementary_indicator` VALUES (110, 2554, 602, 6, '6.2 ผู้บริหารมีวิสัยทัศน์ ภาวะผู้นำ และความคิดริเริ่มที่เน้นการพัฒนาเด็กปฐมวัย');
INSERT INTO `standard_elementary_indicator` VALUES (111, 2554, 701, 7, '7.1 มีหลักสูตรการศึกษาปฐมวัยของสถานศึกษาและนำสู่การปฏิบัติได้อย่างมีประสิทธิภาพ');
INSERT INTO `standard_elementary_indicator` VALUES (112, 2554, 702, 7, '7.2 มีระบบและกลไกให้ผู้มีส่วนร่วมทุกฝ่ายตระหนักและเข้าใจการจัดการศึกษาปฐมวัย');
INSERT INTO `standard_elementary_indicator` VALUES (113, 2554, 703, 7, '7.3 จัดกิจกรรมเสริมสร้างความตระหนักรู้และความเข้าใจหลักการจัดการศึกษาปฐมวัย');
INSERT INTO `standard_elementary_indicator` VALUES (114, 2554, 704, 7, '7.4 สร้างการมีส่วนร่วมและแสวงหาความร่วมมือกับผู้ปกครอง ชุมชน และท้องถิ่น');
INSERT INTO `standard_elementary_indicator` VALUES (115, 2554, 705, 7, '7.5 จัดสิ่งอำนวยความสะดวกเพื่อพัฒนาเด็กอย่างรอบด้าน');
INSERT INTO `standard_elementary_indicator` VALUES (116, 2554, 801, 8, '8.1 กำหนดมาตรฐานการศึกษาปฐมวัยของสถานศึกษา');
INSERT INTO `standard_elementary_indicator` VALUES (117, 2554, 802, 8, '8.2 จัดทำและดำเนินการตามแผนพัฒนาการจัดการศึกษาของสถานศึกษาที่มุ่งพัฒนาคุณภาพตามมาตรฐานการศึกษาของสถานศึกษา');
INSERT INTO `standard_elementary_indicator` VALUES (118, 2554, 803, 8, '8.3 จัดระบบข้อมูลสารสนเทศและใช้สารสนเทศในการบริหารจัดการ');
INSERT INTO `standard_elementary_indicator` VALUES (119, 2554, 901, 9, '9.1 เป็นแหล่งเรียนรู้เพื่อพัฒนาการเรียนรู้ของเด็กและบุคลากรในสถานศึกษา');
INSERT INTO `standard_elementary_indicator` VALUES (120, 2554, 902, 9, '9.2 มีการแลกเปลี่ยนเรียนรู้ร่วมกันภายในสถานศึกษา ระหว่างสถานศึกษากับครอบครัว ชุมชน และองค์กรที่เกี่ยวข้อง');
INSERT INTO `standard_elementary_indicator` VALUES (126, 2554, 1001, 10, '10.1 จัดโครงการ กิจกรรมพัฒนาเด็กให้บรรลุตามเป้าหมาย ปรัชญา วิสัยทัศน์ และจุดเน้นการจัดการศึกษาปฐมวัยของสถานศึกษา');
INSERT INTO `standard_elementary_indicator` VALUES (127, 2554, 1002, 10, '10.2 ผลการดำเนินงานบรรลุเป้าหมาย');
INSERT INTO `standard_elementary_indicator` VALUES (133, 2554, 1101, 11, '11.1 จัดโครงการ กิจกรรมส่งเสริมสนับสนุนตามนโยบายเกี่ยวกับการจัดการศึกษาปฐมวัย');
INSERT INTO `standard_elementary_indicator` VALUES (134, 2554, 1102, 11, '11.2 ผลการดำเนินงานบรรลุตามเป้าหมาย');
INSERT INTO `standard_elementary_indicator` VALUES (173, 2554, 404, 4, '4.4 มีทักษะกระบวนการทางวิทยาศาสตร์และคณิตศาสตร์');
INSERT INTO `standard_elementary_indicator` VALUES (174, 2554, 405, 4, '4.5 มีจินตนาการและความคิดสร้างสรรค์');
INSERT INTO `standard_elementary_indicator` VALUES (175, 2554, 508, 5, '5.8 ครูมีปฏิสัมพันธ์ที่ดีกับเด็ก และผู้ปกครอง');
INSERT INTO `standard_elementary_indicator` VALUES (176, 2554, 509, 5, '5.9 ครูมีวุฒิและความรู้ความสามารถในดานการศึกษาปฐมวัย');
INSERT INTO `standard_elementary_indicator` VALUES (177, 2554, 5010, 5, '5.10 ครูจัดทำสารนิทัศน์และนำมาไตร่ตรองเพื่อใช้ประโยชน์ในการพัฒนาเด็ก');
INSERT INTO `standard_elementary_indicator` VALUES (178, 2554, 603, 6, '6.3 ผู้บริหารใช้หลักการบริหารแบบมีส่วนร่วมและใช้ข้อมูลการประเมินผลหรือการวิจัยเป็นฐานคิดทั้งด้านวิชาการ และการจัดการ');
INSERT INTO `standard_elementary_indicator` VALUES (179, 2554, 604, 6, '6.4 ผู้บริหารสามารถบริหารจัดการการศึกษาให้บรรลุเป้าหมายตามแผนพัฒนาคุณภาพสถานศึกษา');
INSERT INTO `standard_elementary_indicator` VALUES (180, 2554, 605, 6, '6.5 ผู้บริหารส่งเสริมและพัฒนาศักยภาพบุคลากรให้มีประสิทธิภาพ');
INSERT INTO `standard_elementary_indicator` VALUES (181, 2554, 606, 6, '6.6 ผู้บริหารให้คำแนะนำ คำปรึกษาทางวิชาการและเอาใจใส่การจัดการศึกษาปฐมวัยเต็มศักยภาพและเต็มเวลา');
INSERT INTO `standard_elementary_indicator` VALUES (182, 2554, 607, 6, '6.7 เด็ก ผู้ปกครอง และชุมชนพึงพอใจผลการบริหารจัดการศึกษาปฐมวัย');
INSERT INTO `standard_elementary_indicator` VALUES (183, 2554, 804, 8, '8.4 ติดต่ามตรวจสอบ และประเมินผลการดำเนินงานคุณภาพภายในตามมาตรฐานการศึกษาของสถานศึกษา');
INSERT INTO `standard_elementary_indicator` VALUES (184, 2554, 805, 8, '8.5 นำผลการประเมินคุณภาพทั้งภายในและภายนอกไปใช้วางแผนพัฒนาคุณภาพการศึกษาอย่างต่อเนื่อง');
INSERT INTO `standard_elementary_indicator` VALUES (185, 2554, 806, 8, '8.6 จัดทำรายงานประจำปีที่เป็นรายงานการประเมินคุณภาพภายใน');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `standard_elementary_sd`
-- 

CREATE TABLE `standard_elementary_sd` (
  `id` int(11) NOT NULL auto_increment,
  `sd_year` int(11) NOT NULL,
  `sd_id` int(11) NOT NULL,
  `sd_name` varchar(150) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

-- 
-- dump ตาราง `standard_elementary_sd`
-- 

INSERT INTO `standard_elementary_sd` VALUES (5, 2553, 1, 'เด็กมีคุณธรรม จริยธรรม และค่านิยมที่พึงประสงค์');
INSERT INTO `standard_elementary_sd` VALUES (6, 2553, 2, 'เด็กมีจิตสำนึกในการอนุรักษ์และพัฒนาสิ่งแวดล้อม');
INSERT INTO `standard_elementary_sd` VALUES (7, 2553, 3, 'เด็กสามารถทำงานจนสำเร็จ ทำงานร่วมกับผู้อื่นได้ และมีความรู้สึกที่ดีต่ออาชีพสุจริต');
INSERT INTO `standard_elementary_sd` VALUES (8, 2553, 4, 'เด็กสามารถคิดรวบยอด คิดแก้ปัญหา และคิดริเริ่มสร้างสรรค์');
INSERT INTO `standard_elementary_sd` VALUES (9, 2553, 5, 'เด็กมีความรู้และทักษะเบื้องต้น');
INSERT INTO `standard_elementary_sd` VALUES (10, 2553, 6, 'เด็กมีความสนใจใฝ่รู้ รักการอ่าน และพัฒนาตนเอง');
INSERT INTO `standard_elementary_sd` VALUES (11, 2553, 7, 'เด็กมีสุขนิสัย สุขภาพกาย และสุขภาพจิตที่ดี');
INSERT INTO `standard_elementary_sd` VALUES (12, 2553, 8, 'เด็กมีสุนทรียภาพและลักษณะนิสัยด้านศิลปะ ดนตรี และการเคลื่อนไหว');
INSERT INTO `standard_elementary_sd` VALUES (13, 2553, 9, 'ครูมีคุณธรรม จริยธรรม มีวุฒิ/ความรู้ความสามารถตรงกับงานที่');
INSERT INTO `standard_elementary_sd` VALUES (14, 2553, 10, 'ครูมีความสามารถในการจัดประสบการณ์การเรียนรู้ได้อย่างมีประสิทธิภาพและเน้นเด็กเป็นสำคัญ');
INSERT INTO `standard_elementary_sd` VALUES (15, 2553, 11, 'ผู้บริหารมีคุณธรรม จริยธรรม มีภาวะผู้นำ และมีความสามารถในการบริหารจัดการศึกษา');
INSERT INTO `standard_elementary_sd` VALUES (16, 2553, 12, 'สถานศึกษามีการจัดองค์กร โครงสร้าง ระบบการบริหารงานและพัฒนาองค์กรอย่างเป็นระบบครบวงจร');
INSERT INTO `standard_elementary_sd` VALUES (17, 2553, 13, 'สถานศึกษามีการบริหารและจัดการศึกษาโดยใช้สถานศึกษาเป็นฐาน');
INSERT INTO `standard_elementary_sd` VALUES (18, 2553, 14, 'สถานศึกษามีการจัดหลักสูตร และประสบการณ์การเรียนรู้ที่เน้นเด็กเป็นสำคัญ');
INSERT INTO `standard_elementary_sd` VALUES (19, 2553, 15, 'สถานศึกษามีการจัดกิจกรรมส่งเสริมคุณภาพเด็กอย่างหลากหลาย');
INSERT INTO `standard_elementary_sd` VALUES (20, 2553, 16, 'สถานศึกษามีการจัดสภาพแวดล้อมและการบริการที่ส่งเสริมให้เด็กพัฒนาตามธรรมชาติเต็มศักยภาพ');
INSERT INTO `standard_elementary_sd` VALUES (21, 2553, 17, 'สถานศึกษามีการสนับสนุนและใช้แหล่งเรียนรู้และภูมิปัญญาในท้องถิ่น');
INSERT INTO `standard_elementary_sd` VALUES (22, 2553, 18, 'สถานศึกษามีการร่วมมือกันระหว่างบ้าน องค์กรทางศาสนาสถาบันทางวิชาการ และองค์กรภาครัฐและเอกชน เพื่อพัฒนาวิถีการเรียนรู้ในชุมชน');
INSERT INTO `standard_elementary_sd` VALUES (24, 2554, 1, 'เด็กมีพัฒาการด้านร่างกาย');
INSERT INTO `standard_elementary_sd` VALUES (25, 2554, 2, 'เด็กมีพัฒนาการด้านอารมณ์และจิตใจ');
INSERT INTO `standard_elementary_sd` VALUES (26, 2554, 3, 'เด็กมีพัฒนาการด้านสังคม');
INSERT INTO `standard_elementary_sd` VALUES (27, 2554, 4, 'เด็กมีพัฒนาการด้านสติปัญญา');
INSERT INTO `standard_elementary_sd` VALUES (28, 2554, 5, 'ครูปฏิบัติงานตามบทบาทหน้าที่อย่างมีประสิทธิภาพและเกิดประสิทธิผล');
INSERT INTO `standard_elementary_sd` VALUES (29, 2554, 6, 'ผู้บริหารปฏิบัติงานตามบทบาทหน้าที่อย่างมีประสิทธิภาพและเกิดประสิทธิผล');
INSERT INTO `standard_elementary_sd` VALUES (30, 2554, 7, 'แนวทางการจัดการศึกษา');
INSERT INTO `standard_elementary_sd` VALUES (31, 2554, 8, 'สถานศึกษามีการประกันคุณภาพภายในของสถานตามที่กำหนดในกฎกระทรวง');
INSERT INTO `standard_elementary_sd` VALUES (32, 2554, 9, 'สถานศึกษามีการสร้าง ส่งเสริม สนับสนุน ให้สถานศึกษาเป็นสังคมแห่งการเรียนรู้');
INSERT INTO `standard_elementary_sd` VALUES (33, 2554, 10, 'พัฒนาสถานศึกษาให้บรรลุตามปรัชญา วิสัยทัศน์ และจุดเน้นของการศึกษาปฐมวัย');
INSERT INTO `standard_elementary_sd` VALUES (34, 2554, 11, 'พัฒนาสถานศึกษาตามนโยบายเกี่ยวกับการจัดการศึกษาปฐมวัย');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `standard_permission`
-- 

CREATE TABLE `standard_permission` (
  `id` int(11) NOT NULL auto_increment,
  `person_id` varchar(13) NOT NULL,
  `p1` tinyint(4) NOT NULL,
  `officer` varchar(13) NOT NULL,
  `rec_date` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- dump ตาราง `standard_permission`
-- 

INSERT INTO `standard_permission` VALUES (1, '3341600218859', 1, '3341600218859', '2014-06-30');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `student_check_main`
-- 

CREATE TABLE `student_check_main` (
  `check_date` date NOT NULL COMMENT 'วันที่บันทึก',
  `student_id` int(11) NOT NULL COMMENT 'รหัสนักเรียน',
  `class_now` tinyint(4) NOT NULL COMMENT 'ชั้นเรียนปัจจุบันที่บันทึก',
  `room_now` tinyint(4) NOT NULL COMMENT 'ห้องเรียนปัจจุบันที่บันทึก',
  `student_check_year` int(11) NOT NULL COMMENT 'ปีการศึกษาที่บันทึก',
  `check_val` varchar(1) NOT NULL COMMENT 'ค่าการเช็ค',
  `check_person_id` varchar(13) NOT NULL COMMENT 'ผู้ทำรายการ',
  `save_date` datetime NOT NULL COMMENT 'วันที่ทำรายการบันทึก',
  PRIMARY KEY  (`check_date`,`student_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `student_check_main`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `student_check_permission`
-- 

CREATE TABLE `student_check_permission` (
  `class_now` tinyint(4) NOT NULL,
  `room_now` tinyint(4) NOT NULL,
  `person_id` varchar(13) NOT NULL,
  `student_check_year` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `student_check_permission`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `student_check_year`
-- 

CREATE TABLE `student_check_year` (
  `id` int(11) NOT NULL auto_increment,
  `student_check_year` int(11) NOT NULL,
  `year_active` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `student_check_year` (`student_check_year`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- dump ตาราง `student_check_year`
-- 

INSERT INTO `student_check_year` VALUES (1, 2557, 1);

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `student_inclass_main`
-- 

CREATE TABLE `student_inclass_main` (
  `check_date` date NOT NULL COMMENT 'วันที่บันทึก',
  `student_id` int(11) NOT NULL COMMENT 'รหัสนักเรียน',
  `class_now` tinyint(4) NOT NULL COMMENT 'ชั้นเรียนปัจจุบันที่บันทึก',
  `room_now` tinyint(4) NOT NULL COMMENT 'ห้องเรียนปัจจุบันที่บันทึก',
  `student_check_year` int(11) NOT NULL COMMENT 'ปีการศึกษาที่บันทึก',
  `check_val` varchar(50) NOT NULL COMMENT 'ค่าการเช็ค',
  `check_person_id` varchar(13) NOT NULL COMMENT 'ผู้ทำรายการ',
  `save_date` datetime NOT NULL COMMENT 'วันที่ทำรายการบันทึก',
  PRIMARY KEY  (`check_date`,`student_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `student_inclass_main`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `student_inclass_permission`
-- 

CREATE TABLE `student_inclass_permission` (
  `class_now` tinyint(4) NOT NULL,
  `room_now` tinyint(4) NOT NULL,
  `person_id` varchar(13) NOT NULL,
  `student_check_year` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `student_inclass_permission`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `student_inclass_year`
-- 

CREATE TABLE `student_inclass_year` (
  `id` int(11) NOT NULL auto_increment,
  `student_check_year` int(11) NOT NULL,
  `num_period` int(2) NOT NULL,
  `lunch_period` int(2) NOT NULL,
  `year_active` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `student_check_year` (`student_check_year`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- dump ตาราง `student_inclass_year`
-- 

INSERT INTO `student_inclass_year` VALUES (1, 2557, 8, 0, 1);

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `student_main`
-- 

CREATE TABLE `student_main` (
  `id` int(11) NOT NULL auto_increment,
  `student_id` varchar(7) NOT NULL,
  `student_number` int(11) default NULL,
  `prename` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `person_id` varchar(20) default NULL,
  `sex` tinyint(4) NOT NULL default '0',
  `pic` varchar(150) default NULL,
  `class_now` tinyint(4) default NULL,
  `room` tinyint(4) NOT NULL default '0',
  `status` tinyint(4) NOT NULL default '0',
  `out_edyear` int(11) default NULL,
  `officer` varchar(13) NOT NULL,
  `rec_date` date NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `student_number` (`student_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=59 ;

-- 
-- dump ตาราง `student_main`
-- 

INSERT INTO `student_main` VALUES (1, '27573', 1, 'นางสาว', 'ลิยดาวรรณ', 'ผานิตย์', '1370300008240', 2, NULL, 6, 1, 0, NULL, '', '0000-00-00');
INSERT INTO `student_main` VALUES (2, '27577', 2, 'นางสาว', 'นัฏอนงค์', 'ลาภสาร', '1379900008567', 2, NULL, 6, 1, 0, NULL, '', '0000-00-00');
INSERT INTO `student_main` VALUES (3, '27583', 3, 'นางสาว', 'วิจิตตรา', 'เดโชชัย', '1379900013790', 2, NULL, 6, 1, 0, NULL, '', '0000-00-00');
INSERT INTO `student_main` VALUES (4, '27603', 4, 'นางสาว', 'จุฑารัตน์', 'เถาว์สอน', '1350100372231', 2, NULL, 6, 1, 0, NULL, '', '0000-00-00');
INSERT INTO `student_main` VALUES (5, '27605', 5, 'นางสาว', 'ธัญสินี', 'ธรรมนาวรรณ', '1349900711896', 2, NULL, 6, 1, 0, NULL, '', '0000-00-00');
INSERT INTO `student_main` VALUES (6, '27626', 6, 'นางสาว', 'พรนิภา', 'การุณ', '2379900000301', 2, NULL, 6, 1, 0, NULL, '', '0000-00-00');
INSERT INTO `student_main` VALUES (7, '27627', 7, 'นาย', 'พิษณุ', 'เดชเสน', '1379900009148', 1, NULL, 6, 1, 0, NULL, '', '0000-00-00');
INSERT INTO `student_main` VALUES (8, '27628', 8, 'นางสาว', 'ทิพย์วิมล', 'วรรณงาม', '1379900011266', 2, NULL, 6, 1, 0, NULL, '', '0000-00-00');
INSERT INTO `student_main` VALUES (9, '27632', 9, 'นาย', 'เริงศักดิ์', 'จารุศิลป์', '1349900694517', 1, NULL, 6, 1, 0, NULL, '', '0000-00-00');
INSERT INTO `student_main` VALUES (10, '27640', 10, 'นาย', 'ภานุเดช', 'นามเกาะ', '1349900752860', 1, NULL, 6, 1, 0, NULL, '', '0000-00-00');
INSERT INTO `student_main` VALUES (11, '27643', 11, 'นางสาว', 'ชื่นฤทัย', 'ภักตรนิกร', '1379900024422', 2, NULL, 6, 1, 0, NULL, '', '0000-00-00');
INSERT INTO `student_main` VALUES (12, '27653', 12, 'นางสาว', 'ชุตินาถ', 'สาโรงลุน', '1370100025841', 2, NULL, 6, 1, 0, NULL, '', '0000-00-00');
INSERT INTO `student_main` VALUES (13, '27666', 13, 'นางสาว', 'ณัฐริกา', 'สุขสะอาด', '1370500008090', 2, NULL, 6, 1, 0, NULL, '', '0000-00-00');
INSERT INTO `student_main` VALUES (14, '27674', 14, 'นางสาว', 'กนกวรรณ', 'วงศ์จันทร์', '1379900014842', 2, NULL, 6, 1, 0, NULL, '', '0000-00-00');
INSERT INTO `student_main` VALUES (15, '27694', 15, 'นาย', 'วสุ', 'รงรอง', '1349900742244', 1, NULL, 6, 1, 0, NULL, '', '0000-00-00');
INSERT INTO `student_main` VALUES (16, '27695', 16, 'นางสาว', 'ชนมน', 'พันธุ์ดี', '1379900020516', 2, NULL, 6, 1, 0, NULL, '', '0000-00-00');
INSERT INTO `student_main` VALUES (17, '27705', 17, 'นาย', 'ศุภวัฒน์', 'บุญทศ', '1379900025933', 1, NULL, 6, 1, 0, NULL, '', '0000-00-00');
INSERT INTO `student_main` VALUES (18, '27710', 18, 'นางสาว', 'เกศราภรณ์', 'คลังทอง', '1370700003938', 2, NULL, 6, 1, 0, NULL, '', '0000-00-00');
INSERT INTO `student_main` VALUES (19, '27715', 19, 'นางสาว', 'กมลรัตน์', 'อุดมศรี', '1379900009199', 2, NULL, 6, 1, 0, NULL, '', '0000-00-00');
INSERT INTO `student_main` VALUES (20, '27717', 20, 'นางสาว', 'กัตติกา', 'กันยะวงค์', '1379900003999', 2, NULL, 6, 1, 0, NULL, '', '0000-00-00');
INSERT INTO `student_main` VALUES (21, '27755', 21, 'นางสาว', 'ภัทราพร', 'ลาภรัตน์', '1379900030040', 2, NULL, 6, 1, 0, NULL, '', '0000-00-00');
INSERT INTO `student_main` VALUES (22, '27761', 22, 'นางสาว', 'ธาริกุล', 'วัฒนาธร', '1100801089139', 2, NULL, 6, 1, 0, NULL, '', '0000-00-00');
INSERT INTO `student_main` VALUES (23, '27768', 23, 'นาย', 'นิรันดร', 'สุวะมาศ', '1499900236763', 1, NULL, 6, 1, 0, NULL, '', '0000-00-00');
INSERT INTO `student_main` VALUES (24, '27771', 24, 'นางสาว', 'อุไรวรรณ', 'พุทธรัตน์', '1379900020303', 2, NULL, 6, 1, 0, NULL, '', '0000-00-00');
INSERT INTO `student_main` VALUES (25, '27773', 25, 'นางสาว', 'สุรีพร', 'เข็มสุข', '1349900735396', 2, NULL, 6, 1, 0, NULL, '', '0000-00-00');
INSERT INTO `student_main` VALUES (26, '27789', 26, 'นางสาว', 'อรอนงค์', 'แก้วลา', '1379900009504', 2, NULL, 6, 1, 0, NULL, '', '0000-00-00');
INSERT INTO `student_main` VALUES (27, '27791', 27, 'นาย', 'ณัฐพงศ์', 'วุฒิสลา', '1379900032824', 1, NULL, 6, 1, 0, NULL, '', '0000-00-00');
INSERT INTO `student_main` VALUES (28, '27822', 28, 'นางสาว', 'ศิริวัฒน์', 'ขจัดมลทิน', '1370500006984', 2, NULL, 6, 1, 0, NULL, '', '0000-00-00');
INSERT INTO `student_main` VALUES (29, '27825', 29, 'นาย', 'อาณัฐ', 'สีธาตุ', '2379900000084', 1, NULL, 6, 1, 0, NULL, '', '0000-00-00');
INSERT INTO `student_main` VALUES (30, '27842', 30, 'นาย', 'นวพล', 'ดวงศรี', '1379900011827', 1, NULL, 6, 1, 0, NULL, '', '0000-00-00');
INSERT INTO `student_main` VALUES (31, '27843', 31, 'นางสาว', 'จันทร์ธนี', 'ศรีโรจน์', '1379900007510', 2, NULL, 6, 1, 0, NULL, '', '0000-00-00');
INSERT INTO `student_main` VALUES (32, '27852', 32, 'นางสาว', 'สุจิตรา', 'กาศแก้ว', '1103100405266', 2, NULL, 6, 1, 0, NULL, '', '0000-00-00');
INSERT INTO `student_main` VALUES (33, '27862', 33, 'นางสาว', 'สุกานดา', 'บุญเกต', '1379900021067', 2, NULL, 6, 1, 0, NULL, '', '0000-00-00');
INSERT INTO `student_main` VALUES (34, '27881', 34, 'นางสาว', 'สิริลักษณ์', 'แสงเพชร', '1379900012467', 2, NULL, 6, 1, 0, NULL, '', '0000-00-00');
INSERT INTO `student_main` VALUES (35, '27909', 35, 'นางสาว', 'กัลยา', 'วงศ์สิมบุตร', '1379900009679', 2, NULL, 6, 1, 0, NULL, '', '0000-00-00');
INSERT INTO `student_main` VALUES (36, '27924', 36, 'นางสาว', 'ลักขณาพร', 'แซ่ตั้ง', '1349700165529', 2, NULL, 6, 1, 0, NULL, '', '0000-00-00');
INSERT INTO `student_main` VALUES (37, '27925', 37, 'นาย', 'ภูววิทิต', 'สมสอาด', '1350100364999', 1, NULL, 6, 1, 0, NULL, '', '0000-00-00');
INSERT INTO `student_main` VALUES (38, '27938', 38, 'นาย', 'ทรงวุฒิ', 'โสมอินทร์', '1379900002801', 1, NULL, 6, 1, 0, NULL, '', '0000-00-00');
INSERT INTO `student_main` VALUES (39, '27939', 39, 'นางสาว', 'มิ่งขวัญ', 'วระโพธิ์', '1379900019534', 2, NULL, 6, 1, 0, NULL, '', '0000-00-00');
INSERT INTO `student_main` VALUES (40, '27942', 40, 'นางสาว', 'พัชริดา', 'เพ็งพา', '1379900011533', 2, NULL, 6, 1, 0, NULL, '', '0000-00-00');
INSERT INTO `student_main` VALUES (41, '27943', 41, 'นางสาว', 'แคทรียา', 'เพ็งพา', '1379900011525', 2, NULL, 6, 1, 0, NULL, '', '0000-00-00');
INSERT INTO `student_main` VALUES (42, '27944', 42, 'นางสาว', 'ขวัญชีวา', 'ผังดี', '1379900026646', 2, NULL, 6, 1, 0, NULL, '', '0000-00-00');
INSERT INTO `student_main` VALUES (43, '28020', 43, 'นาย', 'รวิภาส', 'จิตรเจริญ', '1349900742741', 1, NULL, 6, 1, 0, NULL, '', '0000-00-00');
INSERT INTO `student_main` VALUES (44, '28054', 44, 'นาย', 'ชัยรัชต์', 'ชิดดี', '1379900018031', 1, NULL, 6, 1, 0, NULL, '', '0000-00-00');
INSERT INTO `student_main` VALUES (45, '28116', 45, 'นางสาว', 'หนึ่งฤทัย', 'เรืองสมบัติ', '1370300009343', 2, NULL, 6, 1, 0, NULL, '', '0000-00-00');
INSERT INTO `student_main` VALUES (46, '28131', 46, 'นางสาว', 'ณัฐริกา', 'กมลรัตน์', '1350100383551', 2, NULL, 6, 1, 0, NULL, '', '0000-00-00');
INSERT INTO `student_main` VALUES (47, '28143', 47, 'นางสาว', 'หทัยรัตน์', 'สุวรรณรัตน์', '1199900520979', 2, NULL, 6, 1, 0, NULL, '', '0000-00-00');
INSERT INTO `student_main` VALUES (48, '28175', 48, 'นาย', 'นพเกล้า', 'วรสาร', '1379900011282', 1, NULL, 6, 1, 0, NULL, '', '0000-00-00');
INSERT INTO `student_main` VALUES (49, '28295', 49, 'นางสาว', 'นุชจรินทร์', 'โคดม', '1379900029441', 2, NULL, 6, 1, 0, NULL, '', '0000-00-00');
INSERT INTO `student_main` VALUES (50, '34045', 50, 'นางสาว', 'จีรภา', 'เดชภูมี', '1479900293538', 2, NULL, 6, 1, 0, NULL, '', '0000-00-00');
INSERT INTO `student_main` VALUES (51, '35834', 51, 'นางสาว', 'พีรดา', 'เพชรพิมพ์', '1279900025993', 2, NULL, 6, 1, 0, NULL, '', '0000-00-00');
INSERT INTO `student_main` VALUES (52, '36592', 52, 'นางสาว', 'จิรัชญา', 'ผ่องศาลา', '1329900605361', 2, NULL, 6, 1, 0, NULL, '', '0000-00-00');
INSERT INTO `student_main` VALUES (53, '36593', 53, 'นางสาว', 'ฐิติมา', 'หลักจันทร์', '1103701877898', 2, NULL, 6, 1, 0, NULL, '', '0000-00-00');
INSERT INTO `student_main` VALUES (54, '36594', 54, 'นางสาว', 'บุษยมาส', 'ทานะขันธ์', '1379900017388', 2, NULL, 6, 1, 0, NULL, '', '0000-00-00');
INSERT INTO `student_main` VALUES (55, '36595', 55, 'นางสาว', 'ประภาพรรณ', 'บุตรมาศ', '1190500054484', 2, NULL, 6, 1, 0, NULL, '', '0000-00-00');
INSERT INTO `student_main` VALUES (56, '36596', 56, 'นางสาว', 'มนทิพย์', 'พรสุข', '1370500004671', 2, NULL, 6, 1, 0, NULL, '', '0000-00-00');
INSERT INTO `student_main` VALUES (57, '36597', 57, 'นาย', 'วัชรพล', 'จารุศิลป์', '1370500006968', 1, NULL, 6, 1, 0, NULL, '', '0000-00-00');
INSERT INTO `student_main` VALUES (58, '36598', 58, 'นางสาว', 'วันเพ็ญ', 'โมลิพันธ์', '1490200087481', 2, NULL, 6, 1, 0, NULL, '', '0000-00-00');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `student_main_class`
-- 

CREATE TABLE `student_main_class` (
  `id` int(11) NOT NULL auto_increment,
  `class_code` tinyint(4) NOT NULL,
  `class_name` varchar(150) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `class_code` (`class_code`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- 
-- dump ตาราง `student_main_class`
-- 

INSERT INTO `student_main_class` VALUES (1, 1, 'มัธยมศึกษาปีที่ 1');
INSERT INTO `student_main_class` VALUES (2, 2, 'มัธยมศึกษาปีที่ 2');
INSERT INTO `student_main_class` VALUES (3, 3, 'มัธยมศึกษาปีที่ 3');
INSERT INTO `student_main_class` VALUES (4, 4, 'มัธยมศึกษาปีที่ 4');
INSERT INTO `student_main_class` VALUES (5, 5, 'มัธยมศึกษาปีที่ 5');
INSERT INTO `student_main_class` VALUES (6, 6, 'มัธยมศึกษาปีที่ 6');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `student_main_classlog`
-- 

CREATE TABLE `student_main_classlog` (
  `id` int(11) NOT NULL auto_increment,
  `ed_year` int(11) NOT NULL,
  `student_id` varchar(7) NOT NULL,
  `student_number` int(11) default NULL,
  `class_code` tinyint(4) NOT NULL,
  `room` tinyint(4) default '0',
  `officer` varchar(13) NOT NULL,
  `rec_date` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `student_main_classlog`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `student_main_edyear`
-- 

CREATE TABLE `student_main_edyear` (
  `id` int(11) NOT NULL auto_increment,
  `ed_year` int(11) NOT NULL,
  `year_active` tinyint(4) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `ed_year` (`ed_year`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- dump ตาราง `student_main_edyear`
-- 

INSERT INTO `student_main_edyear` VALUES (1, 2557, 1);

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `student_main_permission`
-- 

CREATE TABLE `student_main_permission` (
  `id` int(11) NOT NULL auto_increment,
  `person_id` varchar(13) NOT NULL,
  `p1` tinyint(4) NOT NULL,
  `officer` varchar(13) NOT NULL,
  `rec_date` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- dump ตาราง `student_main_permission`
-- 

INSERT INTO `student_main_permission` VALUES (1, '3341600218859', 1, '3341600218859', '2014-06-30');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `system_ed_year`
-- 

CREATE TABLE `system_ed_year` (
  `id` int(11) NOT NULL auto_increment,
  `ed_year` int(11) NOT NULL,
  `active_ed_year` tinyint(4) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `ed_year` (`ed_year`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `system_ed_year`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `system_module`
-- 

CREATE TABLE `system_module` (
  `id` int(11) NOT NULL auto_increment,
  `module` varchar(50) NOT NULL,
  `module_desc` varchar(100) NOT NULL,
  `workgroup` tinyint(4) default NULL,
  `module_active` tinyint(4) default NULL,
  `module_order` int(11) NOT NULL,
  `web_link` tinyint(4) default NULL,
  `url` varchar(150) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `module` (`module`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=98 ;

-- 
-- dump ตาราง `system_module`
-- 

INSERT INTO `system_module` VALUES (1, 'budget', 'การเงินและบัญชี', 2, 1, 30, NULL, NULL);
INSERT INTO `system_module` VALUES (32, 'person', 'ข้อมูลพื้นฐานครูและบุคลากร', 3, 1, 32, NULL, NULL);
INSERT INTO `system_module` VALUES (36, 'standard', 'มาตรฐานการศึกษา', 1, 1, 26, NULL, NULL);
INSERT INTO `system_module` VALUES (49, 'health', 'ตรวจสุขภาพนักเรียน', 1, 1, 20, NULL, NULL);
INSERT INTO `system_module` VALUES (50, 'student_check', 'การมาเรียน', 1, 1, 16, NULL, NULL);
INSERT INTO `system_module` VALUES (70, 'work', '﻿การปฏิบัติราชการ', 4, 1, 6, NULL, NULL);
INSERT INTO `system_module` VALUES (71, 'news', '﻿รายงานข่าว', 4, 1, 14, NULL, NULL);
INSERT INTO `system_module` VALUES (48, 'savings', 'ออมทรัพย์นักเรียน', 1, 1, 18, NULL, NULL);
INSERT INTO `system_module` VALUES (45, 'student_main', 'ข้อมูลพื้นฐานนักเรียน', 1, 1, 21, NULL, NULL);
INSERT INTO `system_module` VALUES (47, 'plan', 'การวางแผน', 2, 1, 28, NULL, NULL);
INSERT INTO `system_module` VALUES (73, 'la', '﻿การลา', 4, 1, 12, NULL, NULL);
INSERT INTO `system_module` VALUES (80, 'mail', 'ไปรษณีย์', 4, 1, 2, NULL, NULL);
INSERT INTO `system_module` VALUES (75, 'meeting', '﻿จองห้องประชุม', 4, 1, 4, NULL, NULL);
INSERT INTO `system_module` VALUES (76, 'permission', '﻿ขออนุญาตไปราชการ', 4, 1, 10, NULL, NULL);
INSERT INTO `system_module` VALUES (81, 'achievement', '﻿ผลสัมฤทธิ์ทางการเรียน', 1, 1, 22, NULL, NULL);
INSERT INTO `system_module` VALUES (83, 'cabinet', '﻿ตู้เอกสาร', 4, 1, 8, NULL, NULL);
INSERT INTO `system_module` VALUES (96, 'bookregister', '﻿ทะเบียนหนังสือราชการ', 4, 1, 0, NULL, NULL);
INSERT INTO `system_module` VALUES (97, 'student_inclass', '﻿การเข้าชั้นเรียน', 1, 1, 0, 0, '');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `system_module_admin`
-- 

CREATE TABLE `system_module_admin` (
  `id` int(11) NOT NULL auto_increment,
  `person_id` varchar(13) NOT NULL,
  `module` varchar(30) NOT NULL,
  `officer` varchar(13) NOT NULL,
  `rec_date` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

-- 
-- dump ตาราง `system_module_admin`
-- 

INSERT INTO `system_module_admin` VALUES (2, '3341600218859', 'achievement', '3341600218859', '2014-06-30');
INSERT INTO `system_module_admin` VALUES (3, '3341600218859', 'bookregister', '3341600218859', '2014-06-30');
INSERT INTO `system_module_admin` VALUES (4, '3341600218859', 'budget', '3341600218859', '2014-06-30');
INSERT INTO `system_module_admin` VALUES (5, '3341600218859', 'cabinet', '3341600218859', '2014-06-30');
INSERT INTO `system_module_admin` VALUES (6, '3341600218859', 'health', '3341600218859', '2014-06-30');
INSERT INTO `system_module_admin` VALUES (12, '3341600218859', 'news', '3341600218859', '2014-06-30');
INSERT INTO `system_module_admin` VALUES (11, '3341600218859', 'meeting', '3341600218859', '2014-06-30');
INSERT INTO `system_module_admin` VALUES (9, '3341600218859', 'la', '3341600218859', '2014-06-30');
INSERT INTO `system_module_admin` VALUES (10, '3341600218859', 'mail', '3341600218859', '2014-06-30');
INSERT INTO `system_module_admin` VALUES (13, '3341600218859', 'permission', '3341600218859', '2014-06-30');
INSERT INTO `system_module_admin` VALUES (14, '3341600218859', 'person', '3341600218859', '2014-06-30');
INSERT INTO `system_module_admin` VALUES (15, '3341600218859', 'plan', '3341600218859', '2014-06-30');
INSERT INTO `system_module_admin` VALUES (16, '3341600218859', 'savings', '3341600218859', '2014-06-30');
INSERT INTO `system_module_admin` VALUES (17, '3341600218859', 'standard', '3341600218859', '2014-06-30');
INSERT INTO `system_module_admin` VALUES (18, '3341600218859', 'student_check', '3341600218859', '2014-06-30');
INSERT INTO `system_module_admin` VALUES (19, '3341600218859', 'student_inclass', '3341600218859', '2014-06-30');
INSERT INTO `system_module_admin` VALUES (20, '3341600218859', 'student_main', '3341600218859', '2014-06-30');
INSERT INTO `system_module_admin` VALUES (21, '3341600218859', 'work', '3341600218859', '2014-06-30');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `system_school_name`
-- 

CREATE TABLE `system_school_name` (
  `id` tinyint(4) NOT NULL,
  `school_name` varchar(200) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `system_school_name`
-- 

INSERT INTO `system_school_name` VALUES (1, 'โรงเรียนอำนาจเจริญ');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `system_user`
-- 

CREATE TABLE `system_user` (
  `id` int(11) NOT NULL auto_increment,
  `person_id` varchar(13) NOT NULL,
  `username` varchar(30) NOT NULL,
  `userpass` varchar(150) NOT NULL,
  `smss_admin` tinyint(4) default NULL,
  `status` tinyint(4) NOT NULL,
  `officer` varchar(13) NOT NULL,
  `rec_date` date NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `person_id` (`person_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

-- 
-- dump ตาราง `system_user`
-- 

INSERT INTO `system_user` VALUES (22, '7777', 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 1, 1, '', '0000-00-00');
INSERT INTO `system_user` VALUES (26, '3341600218859', 'krujet', '662449f0ab4f5a22a781daff91207661', 1, 1, '3341600218859', '2014-06-30');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `system_user_level`
-- 

CREATE TABLE `system_user_level` (
  `id` int(11) NOT NULL auto_increment,
  `level` tinyint(4) NOT NULL,
  `level_name` varchar(50) NOT NULL,
  `level_desc` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `level` (`level`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- 
-- dump ตาราง `system_user_level`
-- 

INSERT INTO `system_user_level` VALUES (1, 1, 'ผู้ดูแลระบบ', 'สิทธิ์ในการจัดการระบบ');
INSERT INTO `system_user_level` VALUES (2, 2, 'ผู้บริหารสูงสุดของหน่วงงาน', 'สิทธิ์ในการดูรายงานสำหรับผู้บริหารสูงสุด');
INSERT INTO `system_user_level` VALUES (3, 3, 'ผู้ช่วยผู้บริหารหน่วยงาน', 'สิทธิ์ในการดูรายงานสำหรับผู้บริหาร');
INSERT INTO `system_user_level` VALUES (5, 4, 'ครูและบุคลากร', 'มีสิทธิ์ในการทำงานในระบบงานย่อยต่าง ๆ');
INSERT INTO `system_user_level` VALUES (8, 5, 'นักเรียน', 'สิทธิ์ระกับนักเรียน');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `system_version`
-- 

CREATE TABLE `system_version` (
  `id` int(11) NOT NULL auto_increment,
  `smss_version` varchar(100) NOT NULL,
  `status1` int(11) default NULL,
  `status2` int(11) default NULL,
  `status3` int(11) default NULL,
  `status4` int(11) default NULL,
  `status5` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- dump ตาราง `system_version`
-- 

INSERT INTO `system_version` VALUES (1, '2.51', 1, 0, 0, 0, 0);

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `system_workgroup`
-- 

CREATE TABLE `system_workgroup` (
  `id` tinyint(4) NOT NULL auto_increment,
  `workgroup` tinyint(4) NOT NULL,
  `workgroup_desc` varchar(50) NOT NULL,
  `workgroup_order` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `workgroup` (`workgroup`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- 
-- dump ตาราง `system_workgroup`
-- 

INSERT INTO `system_workgroup` VALUES (1, 1, 'บริหารวิชาการ', 4);
INSERT INTO `system_workgroup` VALUES (2, 2, 'บริหารงบประมาณ', 6);
INSERT INTO `system_workgroup` VALUES (3, 3, 'บริหารงานบุคคล', 8);
INSERT INTO `system_workgroup` VALUES (4, 4, 'บริหารทั่วไป', 10);

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `work_main`
-- 

CREATE TABLE `work_main` (
  `id` int(11) NOT NULL auto_increment,
  `work_date` date NOT NULL,
  `person_id` varchar(13) NOT NULL,
  `work` tinyint(4) NOT NULL default '0',
  `comment` varchar(150) default NULL,
  `rec_date` datetime NOT NULL,
  `officer` varchar(13) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- dump ตาราง `work_main`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `work_permission`
-- 

CREATE TABLE `work_permission` (
  `id` int(11) NOT NULL auto_increment,
  `person_id` varchar(13) NOT NULL,
  `p1` tinyint(4) NOT NULL,
  `officer` varchar(13) NOT NULL,
  `rec_date` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- dump ตาราง `work_permission`
-- 

INSERT INTO `work_permission` VALUES (1, '3341600218859', 1, '3341600218859', '2014-06-30');
