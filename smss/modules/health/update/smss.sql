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
-- โครงสร้างตาราง `health_base`
-- 

CREATE TABLE `health_base` (
  `base_id` int(5) NOT NULL auto_increment,
  `study_year` int(5) NOT NULL,
  `term` int(3) NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY  (`base_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- dump ตาราง `health_base`
-- 

INSERT INTO `health_base` VALUES (1, 2555, 1, 1);

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

