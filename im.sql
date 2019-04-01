-- MySQL dump 10.13  Distrib 5.7.10, for osx10.9 (x86_64)
--
-- Host: localhost    Database: im
-- ------------------------------------------------------
-- Server version	5.7.10

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
-- Table structure for table `t_friend`
--

DROP TABLE IF EXISTS `t_friend`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_friend` (
  `RFRIEND_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `RFRIEND_USER` int(11) NOT NULL COMMENT '用户ID',
  `RFRIEND_FRIEND` int(11) NOT NULL COMMENT '好友ID',
  `RFRIEND_TYPE` int(11) NOT NULL DEFAULT '1' COMMENT '好友类型 1：普通好友；\n2：特别关注；',
  `RFRIEND_STATUS` int(11) NOT NULL DEFAULT '1',
  `RFRIEND_TIME` bigint(20) DEFAULT NULL COMMENT '最后操作时间 时间戳',
  PRIMARY KEY (`RFRIEND_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='好友表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `t_message_private`
--

DROP TABLE IF EXISTS `t_message_private`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_message_private` (
  `PMSG_ID` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '消息ID',
  `PMSG_TYPE` int(11) NOT NULL DEFAULT '1' COMMENT '消息类型 1：文本；\n2：图片；\n3：音频；\n4：视频；\n5：表情；\n6：文件',
  `PMSG_CONTENT` varchar(32) NOT NULL COMMENT '消息内容',
  `PMSG_TIME` bigint(20) NOT NULL COMMENT '发送时间',
  `PMSG_SENDER` int(11) NOT NULL COMMENT '发送人',
  `PMSG_RECEIVER` int(11) NOT NULL COMMENT '接收人',
  `PMSG_STATUS` int(11) NOT NULL DEFAULT '1' COMMENT '状态 1：正常；\n2：已撤回；',
  PRIMARY KEY (`PMSG_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='私聊消息表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `t_message_room`
--

DROP TABLE IF EXISTS `t_message_room`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_message_room` (
  `RMSG_ID` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '消息ID',
  `RMSG_TYPE` int(11) NOT NULL DEFAULT '1' COMMENT '消息类型 1：文本；\n2：图片；\n3：音频；\n4：视频；\n5：表情；\n6：文件',
  `RMSG_CONTENT` varchar(32) NOT NULL COMMENT '消息内容',
  `RMSG_TIME` bigint(20) NOT NULL COMMENT '发送时间',
  `RMSG_SENDER` bigint(20) NOT NULL COMMENT '发送人',
  `RMSG_ROOM` int(11) NOT NULL COMMENT '房间号',
  `RMSG_STATUS` int(11) NOT NULL DEFAULT '1' COMMENT '状态 1：成功；\n2：已经撤回；',
  PRIMARY KEY (`RMSG_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='聊天室消息表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `t_room`
--

DROP TABLE IF EXISTS `t_room`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_room` (
  `ROOM_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT '房间ID',
  `ROOM_NAME` varchar(32) NOT NULL COMMENT '房间名',
  `ROOM_CREATE_TIME` bigint(20) NOT NULL COMMENT '创建时间',
  `ROOM_MAX_USER` int(11) DEFAULT NULL COMMENT '最大人数 为空则不限制',
  `ROOM_NOTICE` varchar(128) DEFAULT NULL COMMENT '公告',
  `ROOM_STATUS` int(11) DEFAULT '1' COMMENT '状态 1：生效；\n0：停用；',
  PRIMARY KEY (`ROOM_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='聊天室表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `t_room_user`
--

DROP TABLE IF EXISTS `t_room_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_room_user` (
  `RUSER_ID` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'ID号',
  `RUSER_ROOM` int(11) NOT NULL COMMENT '房间号',
  `RUSER_USER` int(11) NOT NULL COMMENT '成员',
  `RUSER_ROLE` int(11) NOT NULL DEFAULT '1' COMMENT '角色 1：普通成员；\n2：房间主人；\n3：房间管理员；',
  `RUSER_ENTER_TIME` bigint(20) NOT NULL COMMENT '加入房间时间',
  `RUSER_LEAVE_TIME` bigint(20) DEFAULT NULL COMMENT '退出房间时间',
  `RUSER_STATUS` int(11) NOT NULL DEFAULT '1' COMMENT '状态 1：正常；\n2：已退出；\n3：已禁言；',
  `RUSER_STOP_TIME_START` bigint(20) DEFAULT NULL COMMENT '禁言开始时间 时间戳',
  `RUSER_STOP_TIME_END` bigint(20) DEFAULT NULL COMMENT '禁言结束时间 时间戳',
  `RUSER_READ_TIME` bigint(20) DEFAULT NULL COMMENT '最后查看时间 时间戳',
  PRIMARY KEY (`RUSER_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='聊天室成员表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `t_user`
--

DROP TABLE IF EXISTS `t_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_user` (
  `USER_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `USER_NAME` varchar(32) NOT NULL COMMENT '用户名',
  `USER_ALIAS` varchar(32) DEFAULT NULL COMMENT '昵称',
  `USER_PWD` varchar(32) NOT NULL COMMENT '密码',
  `USER_EMAIL` varchar(32) DEFAULT NULL COMMENT '邮箱',
  `USER_CREATE_TIME` bigint(20) NOT NULL COMMENT '注册时间 时间戳',
  `USER_STATUS` int(11) NOT NULL DEFAULT '1' COMMENT '状态 1：生效；\n0：停用',
  `USER_IMG` varchar(32) DEFAULT NULL COMMENT '头像',
  PRIMARY KEY (`USER_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='用户表';
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-04-01 16:55:31

-- MySQL dump 10.13  Distrib 5.7.10, for osx10.9 (x86_64)
--
-- Host: localhost    Database: im
-- ------------------------------------------------------
-- Server version 5.7.10

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
-- Dumping data for table `t_room`
--

LOCK TABLES `t_room` WRITE;
/*!40000 ALTER TABLE `t_room` DISABLE KEYS */;
INSERT INTO `t_room` VALUES (1,'公共聊天室',1552390984897,NULL,NULL,1);
/*!40000 ALTER TABLE `t_room` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-04-01 18:34:36

