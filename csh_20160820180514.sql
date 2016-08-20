-- MySQL dump 10.13  Distrib 5.5.40, for Win64 (x86)
--
-- Host: localhost    Database: csh
-- ------------------------------------------------------
-- Server version	5.5.40

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `state` tinyint(4) NOT NULL DEFAULT '0',
  `level` tinyint(4) NOT NULL DEFAULT '1',
  `note` varchar(50) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `recent_login` int(11) NOT NULL COMMENT '最近登录时间',
  `add_time` int(11) DEFAULT NULL COMMENT '添加时间',
  `login_ip` varchar(40) DEFAULT NULL COMMENT '最近登录ip',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uni` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'root','root',1,0,'超级管理员（最高权限，可管理其他普通管理员）','2016-08-20 09:26:05',1471685165,1471352746,'0.0.0.0'),(2,'admin','admin',1,1,'普通管理员','2016-08-19 13:00:16',1471611616,1471352746,'0.0.0.0'),(9,'fdsf','fdsf',1,1,'','2016-08-20 09:27:21',0,NULL,NULL),(10,'fdsfds','fdsfsf',1,1,'2','2016-08-20 09:28:02',0,NULL,NULL);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cname` varchar(20) NOT NULL,
  `cphone` varchar(20) NOT NULL,
  `cemail` varchar(40) NOT NULL,
  `caddress` varchar(100) NOT NULL,
  `cqq` varchar(15) NOT NULL,
  `editer` varchar(20) NOT NULL,
  `edittime` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact`
--

LOCK TABLES `contact` WRITE;
/*!40000 ALTER TABLE `contact` DISABLE KEYS */;
INSERT INTO `contact` VALUES (1,'bingo','1378778877','boyyb88@gmail.com','重庆市南岸区青龙路罗马假日','619280492','admin',1471610276,'2016-08-19 12:37:56');
/*!40000 ALTER TABLE `contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message`
--

LOCK TABLES `message` WRITE;
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
INSERT INTO `message` VALUES (1,'hello','游客','1233232323','咨询',1470335248,'123@11.com','aaaaaaaaaaaaaaaaaaaaaaaaabbbbbbbbbbbbzzzzzzzzzzzzzzzzz','2016-08-18 13:06:39',1),(2,'hello','游客','1233232323','咨询',1470335355,'123@11.com','aaaaaaaaaaaaaaaaaaaaaaaaabbbbbbbbbbbbzzzzzzzzzzzzzzzzz柔柔弱弱','2016-08-18 12:16:38',1),(3,'hello123','游客','1233232323','建议',1470335421,'123@11.com','aaaaaaaaaaaaaaaaaaaaaaaaabbbbbbbbbbbbzzzzzzzzzzzzzzzzz柔柔弱弱','2016-08-19 11:07:05',1),(4,'个人通过提高','游客','4444','建议',1470357051,'66@ee.c0m','333333333333333','2016-08-18 13:11:24',0),(6,'你好方式阿飞','游客','33333333333333','其他',1470366426,'3333@qq.cmo','帆帆帆帆帆帆帆帆帆帆','2016-08-18 13:10:57',1);
/*!40000 ALTER TABLE `message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL COMMENT '用户名',
  `password` varchar(50) NOT NULL COMMENT '密码',
  `sex` varchar(10) NOT NULL COMMENT '性别',
  `phone` varchar(20) NOT NULL COMMENT '电话',
  `email` varchar(50) NOT NULL COMMENT '邮箱',
  `reg_time` int(11) NOT NULL COMMENT '注册时间',
  `recent_login` int(11) NOT NULL COMMENT '最近登陆时间',
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '数据更新时间',
  `score` int(11) NOT NULL DEFAULT '0' COMMENT '会员积分',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'abc123','111111','男','13655445455','1111@qq.com',1470707511,0,'2016-08-09 01:51:51',0),(2,'aaaa1','111111','男','12121212122','33@qq.com',1470707845,0,'2016-08-09 01:57:25',0),(6,'admin','111111','男','13629795255','boyyb87@qq.com',1470764536,0,'2016-08-09 17:42:18',0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_level`
--

DROP TABLE IF EXISTS `user_level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_level` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `level_name` varchar(20) NOT NULL COMMENT '等级名称',
  `score_from` int(11) NOT NULL COMMENT '积分范围',
  `score_to` int(11) NOT NULL COMMENT '积分范围',
  `note` text NOT NULL COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_level`
--

LOCK TABLES `user_level` WRITE;
/*!40000 ALTER TABLE `user_level` DISABLE KEYS */;
INSERT INTO `user_level` VALUES (1,'普通会员',0,1000,''),(2,'黄金会员',1001,5000,''),(3,'铂金会员',5001,12000,''),(4,'钻石会员',12001,100000,'');
/*!40000 ALTER TABLE `user_level` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_pic`
--

DROP TABLE IF EXISTS `user_pic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_pic` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `pic_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_pic`
--

LOCK TABLES `user_pic` WRITE;
/*!40000 ALTER TABLE `user_pic` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_pic` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-08-20 18:05:15
