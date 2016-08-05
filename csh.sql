/*
SQLyog Professional v12.09 (64 bit)
MySQL - 5.5.40 : Database - csh
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`csh` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `csh`;

/*Table structure for table `message` */

DROP TABLE IF EXISTS `message`;

CREATE TABLE `message` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `topic` varchar(30) NOT NULL,
  `name` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `type` varchar(10) NOT NULL,
  `time` int(11) NOT NULL,
  `email` varchar(40) NOT NULL,
  `content` text NOT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `checked` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `message` */

insert  into `message`(`id`,`topic`,`name`,`phone`,`type`,`time`,`email`,`content`,`timestamp`,`checked`) values (1,'hello','游客','1233232323','咨询',1470335248,'123@11.com','aaaaaaaaaaaaaaaaaaaaaaaaabbbbbbbbbbbbzzzzzzzzzzzzzzzzz','2016-08-05 02:27:28',0),(2,'hello','游客','1233232323','咨询',1470335355,'123@11.com','aaaaaaaaaaaaaaaaaaaaaaaaabbbbbbbbbbbbzzzzzzzzzzzzzzzzz柔柔弱弱','2016-08-05 02:29:15',0),(3,'hello123','游客','1233232323','投诉',1470335421,'123@11.com','aaaaaaaaaaaaaaaaaaaaaaaaabbbbbbbbbbbbzzzzzzzzzzzzzzzzz柔柔弱弱','2016-08-05 02:30:21',0),(4,'个人通过提高','游客','4444','建议',1470357051,'66@ee.c0m','333333333333333','2016-08-05 08:30:51',0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
