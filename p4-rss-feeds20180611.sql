SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `p4_categories`;
CREATE TABLE `p4_categories` (
  `CategoryID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Category` varchar(255) DEFAULT '',
  `Description` text,
  PRIMARY KEY (`CategoryID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `p4_categories` (`CategoryID`, `Category`, `Description`) VALUES
(1,	'Health',	'Latest news on Health'),
(2,	'Sports',	'Latest news in Sports'),
(3,	'Tech',	    'Latest news in Tech');

DROP TABLE IF EXISTS `p4_feeds`;
CREATE TABLE `p4_feeds` (
  `FeedID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `CategoryID` int(10) unsigned DEFAULT '0',
  `FeedURL` varchar(255) DEFAULT '',
  `Title` varchar(255) DEFAULT '',
  `Description` text,
  `PubDate` datetime DEFAULT NULL,
  PRIMARY KEY (`FeedID`),
  KEY `CategoryID` (`CategoryID`),
  CONSTRAINT `p4_feeds_ibfk_1` FOREIGN KEY (`CategoryID`) REFERENCES `p4_categories` (`CategoryID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- insert rss feeds
INSERT INTO `p4_feeds` (`FeedID`, `CategoryID`, `FeedURL`, `Title`, `Description`, `PubDate`) VALUES
(1,	1,	'http://blog.questnutrition.com/feed/',	'Quest Nutrition - Nutrition',	'Your hangout for a tasty, transformative lifestyle. Our mission is to revolutionize food and make healthy eating fun.',	'2018-06-11 15:25:54'),
(2,	1,	'http://fitness.reebok.com/api/blog/rss?locale=en-US',	'Reebok - Fitness',	'At Reebok, we love fitness. It is what wakes us up in the morning, what we think about all day, and what drives us toward tomorrow.',	'2018-06-11 15:25:54'),
(3,	1,	'https://www.nytimes.com/svc/collections/v1/publish/http://www.nytimes.com/section/health/rss.xml',	'New York Times - Wellness',	'Find all health related news',	'2018-06-11 15:25:54'),
(4,	2,	'http://www.nba.com/rss/nba_rss.xml',	'NBA',	'The Latest News About the NBA',	'2018-06-11 15:25:54'),
(5,	2,	'http://www.espn.com/espn/rss/nfl/news',	'NFL',	'The Latest News About the NFL',	'2018-06-11 15:25:54'),
(6,	2,	'http://www.espn.com/espn/rss/mlb/news',	'MLB',	'The Latest News About the MLB',	'2018-06-11 15:25:54'),
(7,	3,	'https://www.techrepublic.com/rssfeeds/topic/tech-industry/',	'Tech Republic - Tech Industry',	'The Latest Tech News on the Tech Industry',	'2018-06-11 15:25:54'),
(8,	3,	'https://www.wired.com/feed/category/gear/latest/rss',	'Wired - Gear',	'The Latest Tech News on Gear',	'2018-06-11 15:25:54'),
(9,	3,	'https://www.techrepublic.com/rssfeeds/topic/developer/',	'Tech Republic - Developer',	'The Latest Tech News on Developer',	'2018-06-11 15:25:54');