/**
 * p4-news06062018.sql
 *
 * @package ITC250
 * @author Jesse Hernandez <jesse.hernandez2@seattlecentral.edu>
 * @version 1.0 2018/06/05
 * @link http://www.jesseh-codes.com/
 * 
 */

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `p4_categories`;
CREATE TABLE `p4_categories` (
  `CategoryID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Categoryname` varchar(64) DEFAULT '',
  PRIMARY KEY (`CategoryID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `p4_feed`;
CREATE TABLE `p4_feed` (
  `FeedID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `CategoryID` int(10) unsigned NOT NULL DEFAULT '1',
  `Title` varchar(2000) DEFAULT '',
  `URL` varchar(1000) DEFAULT NULL,
  `Description` varchar(2000) DEFAULT '',
  `ImgURL` varchar(1000) DEFAULT NULL,
  `PubDate` timestamp NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`FeedID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;