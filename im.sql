CREATE TABLE t_user(
    USER_ID INT NOT NULL AUTO_INCREMENT  COMMENT '用户ID' ,
    USER_NAME VARCHAR(32) NOT NULL   COMMENT '用户名' ,
    USER_ALIAS VARCHAR(32)    COMMENT '昵称' ,
    USER_PWD VARCHAR(32) NOT NULL   COMMENT '密码' ,
    USER_CREATE_TIME INT NOT NULL   COMMENT '注册时间 时间戳' ,
    USER_STATUS INT NOT NULL  DEFAULT 1 COMMENT '状态 1：生效；
0：停用' ,
    USER_IMG VARCHAR(32)    COMMENT '头像' ,
    PRIMARY KEY (USER_ID)
) COMMENT = '用户表';/*SQL@Run*/
ALTER TABLE t_user COMMENT '用户表';/*SQL@Run*/
CREATE TABLE t_message_room(
    RMSG_ID BIGINT NOT NULL AUTO_INCREMENT  COMMENT '消息ID' ,
    RMSG_TYPE INT NOT NULL  DEFAULT 1 COMMENT '消息类型 1：文本；
2：图片；
3：音频；
4：视频；
5：表情；
6：文件' ,
    RMSG_CONTENT VARCHAR(32) NOT NULL   COMMENT '消息内容' ,
    RMSG_TIME INT NOT NULL   COMMENT '发送时间' ,
    RMSG_SENDER BIGINT NOT NULL   COMMENT '发送人' ,
    RMSG_ROOM INT NOT NULL   COMMENT '房间号' ,
    RMSG_STATUS INT NOT NULL  DEFAULT 1 COMMENT '状态 1：成功；
2：已经撤回；' ,
    PRIMARY KEY (RMSG_ID)
) COMMENT = '聊天室消息表 ';/*SQL@Run*/
ALTER TABLE t_message_room COMMENT '聊天室消息表';/*SQL@Run*/
CREATE TABLE t_message_private(
    PMSG_ID BIGINT NOT NULL AUTO_INCREMENT  COMMENT '消息ID' ,
    PMSG_TYPE INT NOT NULL  DEFAULT 1 COMMENT '消息类型 1：文本；
2：图片；
3：音频；
4：视频；
5：表情；
6：文件' ,
    PMSG_CONTENT VARCHAR(32) NOT NULL   COMMENT '消息内容' ,
    PMSG_TIME VARCHAR(32) NOT NULL   COMMENT '发送时间' ,
    PMSG_SENDER INT NOT NULL   COMMENT '发送人' ,
    PMSG_RECEIVER INT NOT NULL   COMMENT '接收人' ,
    PMSG_STATUS INT NOT NULL  DEFAULT 1 COMMENT '状态 1：正常；
2：已撤回；' ,
    PRIMARY KEY (PMSG_ID)
) COMMENT = '私聊消息表 ';/*SQL@Run*/
ALTER TABLE t_message_private COMMENT '私聊消息表';/*SQL@Run*/
CREATE TABLE t_room(
    ROOM_ID INT NOT NULL AUTO_INCREMENT  COMMENT '房间ID' ,
    ROOM_NAME VARCHAR(32) NOT NULL   COMMENT '房间名' ,
    ROOM_CREATE_TIME INT NOT NULL   COMMENT '创建时间' ,
    ROOM_MAX_USER INT    COMMENT '最大人数 为空则不限制' ,
    ROOM_NOTICE VARCHAR(128)    COMMENT '公告' ,
    ROOM_STATUS INT    COMMENT '状态 1：生效；
0：停用；' ,
    PRIMARY KEY (ROOM_ID)
) COMMENT = '聊天室表 ';/*SQL@Run*/
ALTER TABLE t_room COMMENT '聊天室表';/*SQL@Run*/
CREATE TABLE t_room_user(
    RUSER_ID BIGINT NOT NULL AUTO_INCREMENT  COMMENT 'ID号' ,
    RUSER_ROOM INT NOT NULL   COMMENT '房间号' ,
    RUSER_USER INT NOT NULL   COMMENT '成员' ,
    RUSER_ROLE INT NOT NULL  DEFAULT 1 COMMENT '角色 1：普通成员；
2：房间主人；
3：房间管理员；' ,
    RUSER_ENTER_TIME INT NOT NULL   COMMENT '加入房间时间' ,
    RUSER_LEAVE_TIME INT    COMMENT '退出房间时间' ,
    RUSER_STATUS INT NOT NULL  DEFAULT 1 COMMENT '状态 1：正常；
2：已退出；
3：已禁言；' ,
    RUSER_STOP_TIME_START INT    COMMENT '禁言开始时间 时间戳' ,
    RUSER_STOP_TIME_END INT    COMMENT '禁言结束时间 时间戳' ,
    RUSER_READ_TIME INT    COMMENT '最后查看时间 时间戳' ,
    PRIMARY KEY (RUSER_ID)
) COMMENT = '聊天室成员表 ';/*SQL@Run*/
ALTER TABLE t_room_user COMMENT '聊天室成员表';/*SQL@Run*/
CREATE TABLE t_friend(
    RFRIEND_ID INT NOT NULL AUTO_INCREMENT  COMMENT '主键ID' ,
    RFRIEND_USER INT NOT NULL   COMMENT '用户ID' ,
    RFRIEND_FRIEND INT NOT NULL   COMMENT '好友ID' ,
    RFRIEND_TYPE INT NOT NULL  DEFAULT 1 COMMENT '好友类型 1：普通好友；
2：特别关注；' ,
    RFRIEND_STATUS INT    COMMENT '好友状态 1：正常；
2：已申请，待对方同意；
3：对方已拒绝；
4：已解除；' ,
    RFRIEND_TIME INT    COMMENT '最后操作时间 时间戳' ,
    PRIMARY KEY (RFRIEND_ID)
) COMMENT = '好友表 ';/*SQL@Run*/
ALTER TABLE t_friend COMMENT '好友表';/*SQL@Run*/
