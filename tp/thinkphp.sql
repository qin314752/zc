/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : thinkphp

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2017-04-09 18:53:04
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for zc_admin_user_log
-- ----------------------------
DROP TABLE IF EXISTS `zc_admin_user_log`;
CREATE TABLE `zc_admin_user_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_user_name` varchar(50) NOT NULL,
  `last_log` varchar(255) NOT NULL,
  `last_log_time` int(15) NOT NULL,
  `last_log_ip` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of zc_admin_user_log
-- ----------------------------
INSERT INTO `zc_admin_user_log` VALUES ('1', 'admin', 'admin登陆后台', '1491527767', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('2', 'admin', 'admin登陆后台', '1491527891', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('3', 'admin', 'admin登陆后台', '1491535059', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('4', 'admin', 'admin登陆后台', '1491547006', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('5', 'admin', 'admin登陆后台', '1491630842', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('6', 'admin', 'admin登陆后台', '1491631179', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('7', 'admin', 'admin登陆后台', '1491631245', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('8', 'admin', 'admin登陆后台', '1491645156', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('9', 'admin', 'admin登陆后台', '1491645880', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('10', 'admin', '添加sss权限组', '1491645890', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('11', 'admin', 'admin登陆后台', '1491646146', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('12', 'admin', 'admin添加dd权限组', '1491646166', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('13', 'admin', 'admin添加qq权限组', '1491646214', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('14', 'admin', 'admin添加www权限组', '1491646329', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('15', 'admin', 'admin添加说说权限组', '1491646857', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('16', 'admin', 'admin添加呜呜权限组', '1491647014', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('17', 'admin', 'admin添加我权限组', '1491647069', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('18', 'admin', 'admin添加我我权限组', '1491647153', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('19', 'admin', 'admin添加查查权限组', '1491647168', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('20', 'admin', 'admin添加呜呜飞权限组', '1491647260', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('21', 'admin', 'admin登陆后台', '1491711329', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('22', 'admin', 'admin登陆后台', '1491719934', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('23', 'admin', 'admin成功删除13管理员', '1491721368', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('24', 'admin', 'admin成功删除12管理员', '1491721373', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('25', 'admin', 'admin成功删除11管理员', '1491721423', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('26', 'admin', 'admin添加新管理员', '1491721783', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('27', 'admin', 'admin添加4353新管理员', '1491721828', '127.0.0.1');

-- ----------------------------
-- Table structure for zc_authority
-- ----------------------------
DROP TABLE IF EXISTS `zc_authority`;
CREATE TABLE `zc_authority` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `authority_name` varchar(255) NOT NULL COMMENT '权限组名',
  `group_node` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of zc_authority
-- ----------------------------
INSERT INTO `zc_authority` VALUES ('2', '超级管理员', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,');
INSERT INTO `zc_authority` VALUES ('3', 'aa', '1,2,3,4,5,6,7,8,9,10,11,');
INSERT INTO `zc_authority` VALUES ('4', 'qqq', '1,2,6,7,8,9,10,11,');
INSERT INTO `zc_authority` VALUES ('5', '啊啊', '1,2,3,4,5,');
INSERT INTO `zc_authority` VALUES ('6', '呜呜', '1,2,3,4,5,');
INSERT INTO `zc_authority` VALUES ('7', 'sss', '1,2,3,4,5,');
INSERT INTO `zc_authority` VALUES ('8', 'www', '1,2,3,4,5,');
INSERT INTO `zc_authority` VALUES ('9', 'dd', '1,2,3,4,5,');
INSERT INTO `zc_authority` VALUES ('10', 'qq', '1,2,');
INSERT INTO `zc_authority` VALUES ('11', 'www', '14,');
INSERT INTO `zc_authority` VALUES ('12', '说说', '1,2,');
INSERT INTO `zc_authority` VALUES ('13', '呜呜', '1,2,');
INSERT INTO `zc_authority` VALUES ('14', '我', '20,21,22,23,');
INSERT INTO `zc_authority` VALUES ('15', '我我', '1,2,');
INSERT INTO `zc_authority` VALUES ('16', '查查', '1,2,');
INSERT INTO `zc_authority` VALUES ('17', '呜呜飞', '20,21,22,23,');

-- ----------------------------
-- Table structure for zc_user_login
-- ----------------------------
DROP TABLE IF EXISTS `zc_user_login`;
CREATE TABLE `zc_user_login` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `adminname` varchar(255) NOT NULL,
  `last_add_time` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `status` char(10) NOT NULL,
  `phone` char(11) NOT NULL,
  `last_add_ip` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of zc_user_login
-- ----------------------------
INSERT INTO `zc_user_login` VALUES ('13', '2', '秦中原', '1491720421', 'e10adc3949ba59abbe56e057f20f883e', 'admin', '1', '13269822845', '127.0.0.1');
INSERT INTO `zc_user_login` VALUES ('14', '12', '123', '1491720476', '202cb962ac59075b964b07152d234b70', '123', '1', '123', '127.0.0.1');
INSERT INTO `zc_user_login` VALUES ('15', '3', '秦中原', '1491720543', 'c81e728d9d4c2f636f067f89cc14862c', '1', '0', '13269822845', '127.0.0.1');
INSERT INTO `zc_user_login` VALUES ('19', '2', '4', '1491721580', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', '2', '启用', '5', '127.0.0.1');
INSERT INTO `zc_user_login` VALUES ('20', '2', '234', '1491721588', '37693cfc748049e45d87b8c7d8b9aacd', '432', '启用', '234', '127.0.0.1');
INSERT INTO `zc_user_login` VALUES ('21', '2', 'wer', '1491721606', '22c276a05aa7c90566ae2175bcc2a9b0', 'wer', '启用', '123', '127.0.0.1');
INSERT INTO `zc_user_login` VALUES ('22', '2', '423', '1491721615', 'e369853df766fa44e1ed0ff613f563bd', 'erw34', '启用', '234', '127.0.0.1');
INSERT INTO `zc_user_login` VALUES ('23', '2', 'erte2', '1491721642', '16f550a8871b1df1d8c5468a07bf375d', '6t546', '启用', '32', '127.0.0.1');
INSERT INTO `zc_user_login` VALUES ('24', '2', '2342', '1491721649', 'faa9afea49ef2ff029a833cccc778fd0', '24234', '启用', '42', '127.0.0.1');
INSERT INTO `zc_user_login` VALUES ('25', '2', '2342', '1491721656', '289dff07669d7a23de0ef88d2f7129e7', '4243', '启用', '234234', '127.0.0.1');
INSERT INTO `zc_user_login` VALUES ('26', '2', '423423', '1491721665', '2321994d85d661d792223f647000c65f', '234234', '启用', '4234', '127.0.0.1');
INSERT INTO `zc_user_login` VALUES ('27', '2', 'wer', '1491721783', 'd81f9c1be2e08964bf9f24b15f0e4900', 'ere', '启用', '234', '127.0.0.1');
INSERT INTO `zc_user_login` VALUES ('28', '2', '1234', '1491721828', '2321994d85d661d792223f647000c65f', '4353', '启用', '42', '127.0.0.1');
