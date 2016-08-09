/*
SQLyog Enterprise v12.08 (32 bit)
MySQL - 5.6.17 : Database - csh
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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `message` */

insert  into `message`(`id`,`topic`,`name`,`phone`,`type`,`time`,`email`,`content`,`timestamp`,`checked`) values (1,'hello','游客','1233232323','咨询',1470335248,'123@11.com','aaaaaaaaaaaaaaaaaaaaaaaaabbbbbbbbbbbbzzzzzzzzzzzzzzzzz','2016-08-05 02:27:28',0),(2,'hello','游客','1233232323','咨询',1470335355,'123@11.com','aaaaaaaaaaaaaaaaaaaaaaaaabbbbbbbbbbbbzzzzzzzzzzzzzzzzz柔柔弱弱','2016-08-05 02:29:15',0),(3,'hello123','游客','1233232323','投诉',1470335421,'123@11.com','aaaaaaaaaaaaaaaaaaaaaaaaabbbbbbbbbbbbzzzzzzzzzzzzzzzzz柔柔弱弱','2016-08-05 02:30:21',0),(4,'个人通过提高','游客','4444','建议',1470357051,'66@ee.c0m','333333333333333','2016-08-05 08:30:51',0),(5,'88888','aaaaa','12333333','建议',1470359088,'11@qq.com','dffddddddddd','2016-08-05 09:04:48',0),(6,'你好方式阿飞','游客','','其他',1470366426,'3333@qq.cmo','帆帆帆帆帆帆帆帆帆帆','2016-08-05 11:07:06',0);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL COMMENT '用户名',
  `password` varchar(50) NOT NULL COMMENT '密码',
  `sex` varchar(10) NOT NULL COMMENT '性别',
  `phone` varchar(20) NOT NULL COMMENT '电话',
  `email` varchar(50) NOT NULL COMMENT '邮箱',
  `reg_time` int(11) NOT NULL COMMENT '注册时间',
  `recent_log` int(11) NOT NULL COMMENT '最近登陆时间',
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '数据更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `user` */

insert  into `user`(`id`,`username`,`password`,`sex`,`phone`,`email`,`reg_time`,`recent_log`,`update_time`) values (1,'abc123','111111','男','13655445455','1111@qq.com',1470707511,0,'2016-08-09 09:51:51'),(2,'aaaa1','111111','男','12121212122','33@qq.com',1470707845,0,'2016-08-09 09:57:25');

/*Table structure for table `user_pic` */

DROP TABLE IF EXISTS `user_pic`;

CREATE TABLE `user_pic` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `pic_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `user_pic` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
