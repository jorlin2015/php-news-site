-- MySQL dump 10.13  Distrib 5.7.23, for osx10.9 (x86_64)
--
-- Host: localhost    Database: im
-- ------------------------------------------------------
-- Server version	5.7.23

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='好友表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_friend`
--

LOCK TABLES `t_friend` WRITE;
/*!40000 ALTER TABLE `t_friend` DISABLE KEYS */;
INSERT INTO `t_friend` VALUES (1,8,9,1,1,1553017441022),(2,9,8,1,1,1553017853427),(5,9,10,1,1,1553067576359),(6,8,10,1,1,1553067748124),(7,10,8,1,1,1553074520438),(8,10,9,1,1,1553074541109),(9,9,16,1,1,1553083319986),(10,16,10,1,1,1553083344729),(11,10,16,1,1,1553083402891);
/*!40000 ALTER TABLE `t_friend` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COMMENT='私聊消息表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_message_private`
--

LOCK TABLES `t_message_private` WRITE;
/*!40000 ALTER TABLE `t_message_private` DISABLE KEYS */;
INSERT INTO `t_message_private` VALUES (1,1,'dddd',1553072818881,9,8,1),(2,1,'eee',1553072848521,8,9,1),(3,1,'eee',1553073103140,8,9,1),(4,1,'eee',1553073193442,9,8,1),(5,1,'111',1553073573545,9,8,1),(6,1,'222',1553073726075,9,8,1),(7,1,'333',1553073735291,8,9,1),(8,1,'qqq',1553073781329,9,8,1),(9,1,'ddd',1553073819835,8,9,1),(10,1,'555',1553073860343,8,9,1),(11,1,'000',1553074006178,8,9,1),(12,1,'eee',1553074524684,10,8,1),(13,1,'sdfsdf',1553074567182,9,10,1),(14,1,'eee',1553074932423,10,9,1),(15,1,'111',1553078040066,8,9,1),(16,1,'222',1553078048752,9,8,1),(17,1,'yui',1553078246185,8,10,1),(18,1,'sdfsdf',1553083360804,16,10,1),(19,1,'dsfsdf',1553083409043,10,16,1);
/*!40000 ALTER TABLE `t_message_private` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8 COMMENT='聊天室消息表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_message_room`
--

LOCK TABLES `t_message_room` WRITE;
/*!40000 ALTER TABLE `t_message_room` DISABLE KEYS */;
INSERT INTO `t_message_room` VALUES (12,1,'111',1552916834911,8,1,1),(13,1,'2222',1552916849679,9,1,1),(14,1,'3333',1552916856958,10,1,1),(15,1,'这是啥',1552916885683,8,1,1),(16,1,'不知道你知道吗',1552916896921,8,1,1),(17,1,'打开快点快点快点打快点快点快点',1552916901314,8,1,1),(18,1,'收到款福克斯的九分裤的',1552916904611,8,1,1),(19,1,'sdfdsfkjdskf',1552916909780,9,1,1),(20,1,'递四方速递',1552916915695,8,1,1),(21,1,'圣诞节疯狂的首付款',1552918275295,8,1,1),(22,1,'水电费独守空房',1552918278520,8,1,1),(23,1,'sdfksdfkj\n',1552918299544,8,1,1),(24,1,'胜多负少的',1552918302222,8,1,1),(25,1,' 宿舍电费都是',1552918304999,8,1,1),(26,1,' 水电费水电费',1552918307471,8,1,1),(27,1,'收到是 ',1552918310433,8,1,1),(28,1,'水电费',1552918424127,8,1,1),(29,1,'收到',1552918428867,8,1,1),(30,1,'水电费第三方',1552918879130,8,1,1),(31,1,'水电费',1552918937386,8,1,1),(32,1,'嘎嘎嘎嘎嘎过过过',1552918950639,8,1,1),(33,1,'dfsdfds\n',1553015249487,8,1,1),(34,1,'eeee',1553054821549,9,1,1),(35,1,'dddd',1553054854511,8,1,1),(36,1,'????',1553054864879,9,1,1),(37,1,'ddd',1553072915491,9,1,1),(38,1,'eee',1553072922162,9,1,1),(39,1,'qqq',1553073447886,9,1,1),(40,1,'sdfsd ',1553074597092,9,1,1),(41,1,'tttt',1553074609148,9,1,1),(42,1,'ddd',1553074663115,9,1,1),(43,1,'tttt',1553074761215,10,1,1),(44,1,'eee',1553074792739,10,1,1),(45,1,'1111',1553074879185,10,1,1),(46,1,'555',1553078058079,8,1,1);
/*!40000 ALTER TABLE `t_message_room` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `t_room`
--

LOCK TABLES `t_room` WRITE;
/*!40000 ALTER TABLE `t_room` DISABLE KEYS */;
INSERT INTO `t_room` VALUES (1,'公共聊天室',1552390984897,NULL,NULL,1);
/*!40000 ALTER TABLE `t_room` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='聊天室成员表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_room_user`
--

LOCK TABLES `t_room_user` WRITE;
/*!40000 ALTER TABLE `t_room_user` DISABLE KEYS */;
INSERT INTO `t_room_user` VALUES (8,1,8,1,1552390984898,NULL,1,NULL,NULL,NULL),(9,1,9,1,1552878956428,NULL,1,NULL,NULL,NULL),(10,1,10,1,1552904557524,NULL,1,NULL,NULL,NULL),(16,1,16,1,1553075955914,NULL,1,NULL,NULL,NULL);
/*!40000 ALTER TABLE `t_room_user` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='用户表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_user`
--

LOCK TABLES `t_user` WRITE;
/*!40000 ALTER TABLE `t_user` DISABLE KEYS */;
INSERT INTO `t_user` VALUES (8,'zhangchaolin','张朝林','0659c7992e268962384eb17fafe88364','zhangchaolin@okay.cn',1552390984891,1,NULL),(9,'jorlin','约翰','0659c7992e268962384eb17fafe88364','zhangchaolin@okay.cn',1552878956380,1,NULL),(10,'tianqiudong','田秋冬','0659c7992e268962384eb17fafe88364','tianqiudong@okay.cn',1552904557519,1,NULL),(16,'zhangliyuan','张立元','0659c7992e268962384eb17fafe88364','zhangliyuan@okay.cn',1553075955908,1,NULL);
/*!40000 ALTER TABLE `t_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-03-08 10:24:19
