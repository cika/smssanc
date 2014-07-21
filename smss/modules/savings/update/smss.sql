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

INSERT INTO `savings_base` VALUES (1, 2555, 1);

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
  `office` varchar(20) default NULL,
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

