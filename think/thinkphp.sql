/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : thinkphp

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2017-05-11 16:47:00
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for zc_access
-- ----------------------------
DROP TABLE IF EXISTS `zc_access`;
CREATE TABLE `zc_access` (
  `role_id` smallint(6) unsigned NOT NULL,
  `node_id` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) NOT NULL,
  `module` varchar(50) DEFAULT NULL,
  KEY `groupId` (`role_id`),
  KEY `nodeId` (`node_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of zc_access
-- ----------------------------
INSERT INTO `zc_access` VALUES ('1', '1', '1', null);
INSERT INTO `zc_access` VALUES ('1', '2', '2', null);
INSERT INTO `zc_access` VALUES ('1', '9', '3', null);
INSERT INTO `zc_access` VALUES ('1', '3', '2', null);
INSERT INTO `zc_access` VALUES ('1', '4', '3', null);
INSERT INTO `zc_access` VALUES ('1', '10', '3', null);
INSERT INTO `zc_access` VALUES ('1', '11', '3', null);
INSERT INTO `zc_access` VALUES ('1', '12', '3', null);
INSERT INTO `zc_access` VALUES ('1', '13', '3', null);
INSERT INTO `zc_access` VALUES ('1', '5', '2', null);
INSERT INTO `zc_access` VALUES ('1', '7', '3', null);
INSERT INTO `zc_access` VALUES ('1', '14', '3', null);
INSERT INTO `zc_access` VALUES ('1', '15', '3', null);
INSERT INTO `zc_access` VALUES ('1', '16', '3', null);
INSERT INTO `zc_access` VALUES ('1', '17', '3', null);
INSERT INTO `zc_access` VALUES ('1', '6', '2', null);
INSERT INTO `zc_access` VALUES ('1', '8', '3', null);
INSERT INTO `zc_access` VALUES ('1', '18', '3', null);
INSERT INTO `zc_access` VALUES ('2', '1', '1', null);
INSERT INTO `zc_access` VALUES ('2', '3', '2', null);
INSERT INTO `zc_access` VALUES ('2', '4', '3', null);
INSERT INTO `zc_access` VALUES ('2', '10', '3', null);
INSERT INTO `zc_access` VALUES ('2', '11', '3', null);
INSERT INTO `zc_access` VALUES ('2', '12', '3', null);
INSERT INTO `zc_access` VALUES ('2', '5', '2', null);
INSERT INTO `zc_access` VALUES ('2', '7', '3', null);
INSERT INTO `zc_access` VALUES ('2', '16', '3', null);

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
) ENGINE=MyISAM AUTO_INCREMENT=101 DEFAULT CHARSET=utf8;

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
INSERT INTO `zc_admin_user_log` VALUES ('28', 'admin', 'admin登陆后台', '1491786499', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('29', 'admin', 'admin添加试试权限组', '1491787434', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('30', 'admin', 'admin成功删除234234管理员', '1491787693', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('31', 'admin', 'admin成功删除试试权限组', '1491788433', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('32', 'admin', 'admin成功删除4243管理员', '1491788985', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('33', 'admin', 'admin成功删除123管理员', '1491789615', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('34', 'admin', 'admin成功删除2管理员', '1491789646', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('35', 'admin', 'admin成功删除qq权限组', '1491789826', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('36', 'admin', 'admin成功删除dd权限组', '1491789828', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('37', 'admin', 'admin登陆后台', '1491794287', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('38', 'admin', 'admin登陆后台', '1491794882', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('39', 'admin', 'admin登陆后台', '1491794959', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('40', 'admin', 'admin登陆后台', '1491795718', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('41', 'admin', 'admin添加了新管理员qq', '1491795954', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('42', 'admin', 'admin成功删除qq管理员', '1491795965', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('43', 'admin', 'admin添加ww权限组', '1491795973', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('44', 'admin', 'admin成功删除ww权限组', '1491796008', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('45', 'admin', 'admin登陆后台', '1491798696', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('46', 'admin', 'admin登陆后台', '1491798892', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('47', 'admin', 'admin成功删除1管理员', '1491802240', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('48', 'admin', 'admin登陆后台', '1491805635', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('49', 'admin', 'admin登陆后台', '1491805713', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('50', 'admin', 'admin登陆后台', '1491805891', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('51', 'admin', 'admin登陆后台', '1491805960', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('52', 'admin', 'admin登陆后台', '1491806382', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('53', 'admin', 'admin登陆后台', '1491957665', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('54', 'admin', 'admin登陆后台', '1491958464', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('55', 'admin', 'admin登陆后台', '1491967877', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('56', 'admin', 'admin登陆后台', '1491974694', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('57', 'admin', 'admin登陆后台', '1491974786', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('58', 'admin', 'admin登陆后台', '1491979937', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('59', 'admin', 'admin登陆后台', '1491980343', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('60', 'admin', 'admin登陆后台', '1492045283', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('61', 'admin', 'admin登陆后台', '1492161039', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('62', 'home', 'home登陆后台', '1492589525', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('63', 'admin', 'admin登陆后台', '1492589997', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('64', 'admin', 'admin登陆后台', '1492590111', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('65', 'admin', 'admin登陆后台', '1492590338', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('66', 'admin', 'admin登陆后台', '1492590414', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('67', 'admin', 'admin登陆后台', '1492593293', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('68', 'admin', 'admin登陆后台', '1492593494', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('69', 'admin', 'admin登陆后台', '1492670277', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('70', 'admin', 'admin登陆后台', '1492670409', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('71', 'admin', 'admin登陆后台', '1492670451', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('72', 'admin', 'admin登陆后台', '1492670527', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('73', 'admin', 'admin登陆后台', '1492670597', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('74', 'admin', 'admin登陆后台', '1492670884', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('75', 'admin', 'admin登陆后台', '1494222828', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('76', 'admin', 'admin登陆后台', '1494223459', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('77', 'admin', 'admin登陆后台', '1494223763', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('78', 'admin', 'admin登陆后台', '1494231018', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('79', 'admin', 'admin登陆后台', '1494233358', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('80', 'admin', 'admin登陆后台', '1494233602', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('81', 'admin', 'admin登陆后台', '1494292792', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('82', 'admin', 'admin登陆后台', '1494293046', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('83', 'admin', 'admin登陆后台', '1494293198', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('84', 'admin', 'admin登陆后台', '1494295187', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('85', 'admin', 'admin登陆后台', '1494295273', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('86', 'admin', 'admin登陆后台', '1494295375', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('87', 'admin', 'admin登陆后台', '1494301327', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('88', 'admin', 'admin登陆后台', '1494301399', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('89', 'admin', 'admin登陆后台', '1494307102', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('90', 'admin', 'admin登陆后台', '1494307449', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('91', 'admin', 'admin登陆后台', '1494312216', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('92', 'admin', 'admin登陆后台', '1494312352', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('93', 'admin', 'admin登陆后台', '1494312599', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('94', 'admin', 'admin登陆后台', '1494312642', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('95', 'admin', 'admin登陆后台', '1494312683', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('96', 'admin', 'admin登陆后台', '1494312845', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('97', 'admin', 'admin登陆后台', '1494312974', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('98', 'home', 'home登陆后台', '1494381582', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('99', 'admin', 'admin登陆后台', '1494382090', '127.0.0.1');
INSERT INTO `zc_admin_user_log` VALUES ('100', 'admin', 'admin登陆后台', '1494404820', '127.0.0.1');

-- ----------------------------
-- Table structure for zc_node
-- ----------------------------
DROP TABLE IF EXISTS `zc_node`;
CREATE TABLE `zc_node` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `remark` varchar(255) DEFAULT NULL,
  `sort` smallint(6) unsigned DEFAULT NULL,
  `pid` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `level` (`level`),
  KEY `pid` (`pid`),
  KEY `status` (`status`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of zc_node
-- ----------------------------
INSERT INTO `zc_node` VALUES ('1', 'Admin', '后台应用', '1', null, null, '0', '1');
INSERT INTO `zc_node` VALUES ('2', 'Index', '默认控制器', '1', null, null, '1', '2');
INSERT INTO `zc_node` VALUES ('3', 'User', '管理员', '1', null, null, '1', '2');
INSERT INTO `zc_node` VALUES ('4', 'admin_user_list', '列表', '1', null, null, '3', '3');
INSERT INTO `zc_node` VALUES ('5', 'Role', '角色', '1', null, null, '1', '2');
INSERT INTO `zc_node` VALUES ('6', 'Node', '权限', '1', null, null, '1', '2');
INSERT INTO `zc_node` VALUES ('7', 'admin_role', '列表', '1', null, null, '5', '3');
INSERT INTO `zc_node` VALUES ('8', 'admin_node', '列表', '1', null, null, '6', '3');
INSERT INTO `zc_node` VALUES ('9', 'index', '列表', '1', null, null, '2', '3');
INSERT INTO `zc_node` VALUES ('10', 'admin_add', '添加', '1', null, null, '3', '3');
INSERT INTO `zc_node` VALUES ('11', 'admin_edit', '编辑', '1', null, null, '3', '3');
INSERT INTO `zc_node` VALUES ('12', 'del', '删除', '1', null, null, '3', '3');
INSERT INTO `zc_node` VALUES ('13', 'suop', '停用/启用', '1', null, null, '3', '3');
INSERT INTO `zc_node` VALUES ('14', 'admin_role_add', '添加', '1', null, null, '5', '3');
INSERT INTO `zc_node` VALUES ('15', 'admin_role_edit', '编辑', '1', null, null, '5', '3');
INSERT INTO `zc_node` VALUES ('16', 'del', '删除', '1', null, null, '5', '3');
INSERT INTO `zc_node` VALUES ('17', 'suop', '停用/启用', '1', null, null, '5', '3');
INSERT INTO `zc_node` VALUES ('18', 'admin_add_node', '添加', '1', null, null, '6', '3');

-- ----------------------------
-- Table structure for zc_role
-- ----------------------------
DROP TABLE IF EXISTS `zc_role`;
CREATE TABLE `zc_role` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `pid` smallint(6) DEFAULT NULL,
  `status` tinyint(1) unsigned DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of zc_role
-- ----------------------------
INSERT INTO `zc_role` VALUES ('1', '超级管理员', null, '1', null);
INSERT INTO `zc_role` VALUES ('2', '测试', null, '1', null);

-- ----------------------------
-- Table structure for zc_role_user
-- ----------------------------
DROP TABLE IF EXISTS `zc_role_user`;
CREATE TABLE `zc_role_user` (
  `role_id` mediumint(9) unsigned DEFAULT NULL,
  `user_id` char(32) DEFAULT NULL,
  KEY `group_id` (`role_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of zc_role_user
-- ----------------------------
INSERT INTO `zc_role_user` VALUES ('2', '87');
INSERT INTO `zc_role_user` VALUES ('1', '88');

-- ----------------------------
-- Table structure for zc_user_login
-- ----------------------------
DROP TABLE IF EXISTS `zc_user_login`;
CREATE TABLE `zc_user_login` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `adminname` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` char(10) DEFAULT NULL,
  `phone` char(11) DEFAULT NULL,
  `last_add_time` varchar(20) DEFAULT NULL,
  `last_add_ip` varchar(20) DEFAULT NULL,
  `user_role` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=89 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of zc_user_login
-- ----------------------------
INSERT INTO `zc_user_login` VALUES ('88', 'home', '123123', 'e10adc3949ba59abbe56e057f20f883e', '1', '12345678910', '1494312933', '127.0.0.1', '超级管理员');
INSERT INTO `zc_user_login` VALUES ('87', 'admin', '123', 'e10adc3949ba59abbe56e057f20f883e', '1', '12345678910', '1494312917', '127.0.0.1', '测试');
