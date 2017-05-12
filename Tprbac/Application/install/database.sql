-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2016 年 04 月 03 日 02:24
-- 服务器版本: 5.5.20
-- PHP 版本: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `tprbac`
--

-- --------------------------------------------------------

--
-- 表的结构 `pa_access`
--

CREATE TABLE IF NOT EXISTS `pa_access` (
  `role_id` smallint(6) unsigned NOT NULL,
  `node_id` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) NOT NULL,
  `pid` smallint(6) DEFAULT NULL,
  `module` varchar(50) DEFAULT NULL,
  KEY `groupId` (`role_id`),
  KEY `nodeId` (`node_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='权限分配表';

--
-- 转存表中的数据 `pa_access`
--

INSERT INTO `pa_access` (`role_id`, `node_id`, `level`, `pid`, `module`) VALUES
(2, 8, 3, 14, ''),
(2, 14, 2, 1, ''),
(2, 10, 3, 4, ''),
(2, 4, 2, 1, ''),
(2, 7, 3, 3, ''),
(2, 3, 2, 1, ''),
(2, 6, 3, 2, ''),
(2, 5, 3, 2, ''),
(2, 2, 2, 1, ''),
(2, 1, 1, 0, ''),
(3, 14, 2, 1, ''),
(3, 13, 3, 4, ''),
(3, 12, 3, 4, ''),
(3, 11, 3, 4, ''),
(3, 10, 3, 4, ''),
(3, 4, 2, 1, ''),
(3, 9, 3, 3, ''),
(3, 8, 3, 3, ''),
(3, 7, 3, 3, ''),
(3, 3, 2, 1, ''),
(3, 6, 3, 2, ''),
(3, 5, 3, 2, ''),
(3, 2, 2, 1, ''),
(3, 1, 1, 0, ''),
(4, 7, 3, 3, ''),
(4, 3, 2, 1, ''),
(4, 6, 3, 2, ''),
(4, 5, 3, 2, ''),
(4, 2, 2, 1, ''),
(4, 1, 1, 0, ''),
(2, 9, 3, 14, ''),
(2, 15, 3, 14, ''),
(2, 16, 3, 14, ''),
(2, 17, 3, 14, ''),
(2, 18, 3, 14, ''),
(2, 19, 3, 14, ''),
(2, 20, 3, 14, ''),
(2, 21, 3, 14, ''),
(2, 22, 3, 14, ''),
(2, 23, 3, 14, ''),
(2, 24, 3, 14, ''),
(2, 25, 3, 14, ''),
(2, 26, 2, 1, ''),
(2, 27, 3, 26, ''),
(2, 28, 3, 26, ''),
(2, 29, 3, 26, ''),
(2, 30, 3, 26, ''),
(2, 31, 3, 26, ''),
(2, 8, 3, 14, ''),
(2, 14, 2, 1, ''),
(2, 10, 3, 4, ''),
(2, 4, 2, 1, ''),
(2, 7, 3, 3, ''),
(2, 3, 2, 1, ''),
(2, 6, 3, 2, ''),
(2, 5, 3, 2, ''),
(2, 2, 2, 1, ''),
(2, 1, 1, 0, ''),
(3, 14, 2, 1, ''),
(3, 13, 3, 4, ''),
(3, 12, 3, 4, ''),
(3, 11, 3, 4, ''),
(3, 10, 3, 4, ''),
(3, 4, 2, 1, ''),
(3, 9, 3, 3, ''),
(3, 8, 3, 3, ''),
(3, 7, 3, 3, ''),
(3, 3, 2, 1, ''),
(3, 6, 3, 2, ''),
(3, 5, 3, 2, ''),
(3, 2, 2, 1, ''),
(3, 1, 1, 0, ''),
(4, 7, 3, 3, ''),
(4, 3, 2, 1, ''),
(4, 6, 3, 2, ''),
(4, 5, 3, 2, ''),
(4, 2, 2, 1, ''),
(4, 1, 1, 0, ''),
(2, 9, 3, 14, ''),
(2, 15, 3, 14, ''),
(2, 16, 3, 14, ''),
(2, 17, 3, 14, ''),
(2, 18, 3, 14, ''),
(2, 19, 3, 14, ''),
(2, 20, 3, 14, ''),
(2, 21, 3, 14, ''),
(2, 22, 3, 14, ''),
(2, 23, 3, 14, ''),
(2, 24, 3, 14, ''),
(2, 25, 3, 14, ''),
(2, 26, 2, 1, ''),
(2, 27, 3, 26, ''),
(2, 28, 3, 26, ''),
(2, 29, 3, 26, ''),
(2, 30, 3, 26, ''),
(2, 31, 3, 26, ''),
(2, 8, 3, 14, ''),
(2, 14, 2, 1, ''),
(2, 10, 3, 4, ''),
(2, 4, 2, 1, ''),
(2, 7, 3, 3, ''),
(2, 3, 2, 1, ''),
(2, 6, 3, 2, ''),
(2, 5, 3, 2, ''),
(2, 2, 2, 1, ''),
(2, 1, 1, 0, ''),
(3, 14, 2, 1, ''),
(3, 13, 3, 4, ''),
(3, 12, 3, 4, ''),
(3, 11, 3, 4, ''),
(3, 10, 3, 4, ''),
(3, 4, 2, 1, ''),
(3, 9, 3, 3, ''),
(3, 8, 3, 3, ''),
(3, 7, 3, 3, ''),
(3, 3, 2, 1, ''),
(3, 6, 3, 2, ''),
(3, 5, 3, 2, ''),
(3, 2, 2, 1, ''),
(3, 1, 1, 0, ''),
(4, 7, 3, 3, ''),
(4, 3, 2, 1, ''),
(4, 6, 3, 2, ''),
(4, 5, 3, 2, ''),
(4, 2, 2, 1, ''),
(4, 1, 1, 0, ''),
(2, 9, 3, 14, ''),
(2, 15, 3, 14, ''),
(2, 16, 3, 14, ''),
(2, 17, 3, 14, ''),
(2, 18, 3, 14, ''),
(2, 19, 3, 14, ''),
(2, 20, 3, 14, ''),
(2, 21, 3, 14, ''),
(2, 22, 3, 14, ''),
(2, 23, 3, 14, ''),
(2, 24, 3, 14, ''),
(2, 25, 3, 14, ''),
(2, 26, 2, 1, ''),
(2, 27, 3, 26, ''),
(2, 28, 3, 26, ''),
(2, 29, 3, 26, ''),
(2, 30, 3, 26, ''),
(2, 31, 3, 26, '');

-- --------------------------------------------------------

--
-- 表的结构 `pa_ad`
--

CREATE TABLE IF NOT EXISTS `pa_ad` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `ad_name` varchar(60) NOT NULL DEFAULT '',
  `ad_link` varchar(255) NOT NULL DEFAULT '',
  `ad_img` varchar(255) NOT NULL,
  `position` char(10) NOT NULL DEFAULT '0',
  `sort` tinyint(1) unsigned NOT NULL DEFAULT '50',
  `lang` varchar(10) NOT NULL DEFAULT 'zh-cn',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- 转存表中的数据 `pa_ad`
--

INSERT INTO `pa_ad` (`id`, `ad_name`, `ad_link`, `ad_img`, `position`, `sort`, `lang`) VALUES
(23, '首页1', 'http://www.2345.com/?kconist', '531e85f90bcc1.png', 'index', 10, 'zh-cn'),
(24, '首页2', 'http://www.2345.com/?kconist', '531e88216e887.png', 'index', 9, 'zh-cn'),
(25, '首页3', 'http://www.2345.com/?kconist', '531e88325b1c2.png', 'index', 8, 'zh-cn');

-- --------------------------------------------------------

--
-- 表的结构 `pa_admin`
--

CREATE TABLE IF NOT EXISTS `pa_admin` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL COMMENT '登录账号',
  `pwd` char(32) DEFAULT NULL COMMENT '登录密码',
  `status` int(11) DEFAULT '1' COMMENT '账号状态',
  `remark` varchar(255) DEFAULT '' COMMENT '备注信息',
  `find_code` char(5) DEFAULT NULL COMMENT '找回账号验证码',
  `time` int(10) DEFAULT NULL COMMENT '开通时间',
  PRIMARY KEY (`aid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='网站后台管理员表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `pa_category`
--

CREATE TABLE IF NOT EXISTS `pa_category` (
  `cid` int(5) NOT NULL AUTO_INCREMENT,
  `pid` int(5) DEFAULT NULL COMMENT 'parentCategory上级分类',
  `name` varchar(20) DEFAULT NULL COMMENT '分类名称',
  `type` char(2) NOT NULL DEFAULT 'n',
  `lang` varchar(10) NOT NULL DEFAULT 'zh-cn',
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='新闻分类表' AUTO_INCREMENT=57 ;

--
-- 转存表中的数据 `pa_category`
--

INSERT INTO `pa_category` (`cid`, `pid`, `name`, `type`, `lang`) VALUES
(1, 0, '信托计划', 'n', 'zh-cn'),
(2, 1, '行业新闻', 'n', 'zh-cn'),
(4, 1, '信托渠道', 'n', 'zh-cn'),
(5, 1, '行业研究', 'n', 'zh-cn'),
(3, 1, '机构动态', 'n', 'zh-cn'),
(52, 0, '分类1', 'p', 'zh-cn'),
(55, 0, '分类2', 'p', 'zh-cn'),
(54, 53, '666666666', 'n', 'zh-cn'),
(56, 0, '分类3', 'p', 'zh-cn');

-- --------------------------------------------------------

--
-- 表的结构 `pa_field`
--

CREATE TABLE IF NOT EXISTS `pa_field` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `model_id` int(11) NOT NULL COMMENT '所属模型id',
  `name` varchar(128) NOT NULL COMMENT '字段名称',
  `comment` varchar(32) NOT NULL COMMENT '字段注释',
  `type` varchar(32) NOT NULL COMMENT '字段类型',
  `length` varchar(16) NOT NULL COMMENT '字段长度',
  `value` varchar(128) NOT NULL COMMENT '字段默认值',
  `is_require` tinyint(4) DEFAULT '0' COMMENT '是否必需',
  `is_unique` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否唯一',
  `is_index` tinyint(4) DEFAULT '0' COMMENT '是否添加索引',
  `is_system` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否系统字段',
  `is_list_show` tinyint(4) NOT NULL DEFAULT '1' COMMENT '列表中显示',
  `auto_filter` varchar(32) NOT NULL COMMENT '自动过滤函数',
  `auto_fill` varchar(32) NOT NULL COMMENT '自动完成函数',
  `fill_time` varchar(16) NOT NULL DEFAULT 'both' COMMENT '填充时机',
  `relation_model` int(11) NOT NULL COMMENT '关联的模型',
  `relation_field` varchar(128) NOT NULL COMMENT '关联的字段',
  `relation_value` varchar(128) NOT NULL COMMENT '关联显示的值',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `fk_field_model` (`model_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='数据模型字段' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `pa_images`
--

CREATE TABLE IF NOT EXISTS `pa_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catname` varchar(20) NOT NULL,
  `savename` varchar(100) NOT NULL,
  `savepath` varchar(255) NOT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=52 ;

--
-- 转存表中的数据 `pa_images`
--

INSERT INTO `pa_images` (`id`, `catname`, `savename`, `savepath`, `create_time`) VALUES
(40, 'news', '20140310073926_27245.jpg', '/newconist/Uploads/image/product/20140310/20140310073926_27245.jpg', 1394437811),
(39, 'product', '20140310074050_66596.jpg', '/newconist/Uploads/image/product/20140310/20140310074050_66596.jpg', 1394437252),
(34, 'product', '20140228021215_98055.jpg', '/newconist/Uploads/image/news/20140228/20140228021215_98055.jpg', 1394176319),
(37, 'product', '20140310073926_27245.jpg', '/newconist/Uploads/image/product/20140310/20140310073926_27245.jpg', 1394437177),
(33, 'news', '20140228021215_98055.jpg', '/newconist/Uploads/image/news/20140228/20140228021215_98055.jpg', 1394159259),
(42, 'product', '20140310074033_57603.jpg', '/newconist/Uploads/image/product/20140310/20140310074033_57603.jpg', 1394441436),
(51, 'product', '20140310073926_27245.jpg', '/newconist/Uploads/image/product/20140310/20140310073926_27245.jpg', 1395295064),
(50, 'product', '20140310074033_57603.jpg', '/newconist/Uploads/image/product/20140310/20140310074033_57603.jpg', 1395295064),
(49, 'product', '20140310074050_66596.jpg', '/newconist/Uploads/image/product/20140310/20140310074050_66596.jpg', 1395295064);

-- --------------------------------------------------------

--
-- 表的结构 `pa_input`
--

CREATE TABLE IF NOT EXISTS `pa_input` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `field_id` int(11) NOT NULL COMMENT '字段id',
  `is_show` tinyint(4) NOT NULL DEFAULT '0' COMMENT '表单域是否显示',
  `label` varchar(32) NOT NULL COMMENT '表单域标签',
  `remark` varchar(128) NOT NULL COMMENT '表单域域',
  `type` varchar(32) NOT NULL COMMENT '表单域类型',
  `width` int(11) NOT NULL DEFAULT '20' COMMENT '表单域宽度',
  `height` int(11) NOT NULL DEFAULT '8' COMMENT '表单域高度',
  `opt_value` text NOT NULL COMMENT '表单域可选值',
  `value` varchar(128) NOT NULL COMMENT '表单域默认值',
  `editor` varchar(32) NOT NULL COMMENT '编辑器类型',
  `html` text NOT NULL COMMENT '表单域html替换',
  `show_order` int(11) DEFAULT NULL COMMENT '表单域显示顺序',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `fk_field_input` (`field_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='字段表单域信息' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `pa_link`
--

CREATE TABLE IF NOT EXISTS `pa_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(32) NOT NULL,
  `display` int(1) NOT NULL,
  `link` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL,
  `target` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- 表的结构 `pa_member`
--

CREATE TABLE IF NOT EXISTS `pa_member` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `weibo_uid` varchar(15) DEFAULT NULL COMMENT '对应的新浪微博uid',
  `tencent_uid` varchar(20) DEFAULT NULL COMMENT '腾讯微博UID',
  `email` varchar(100) DEFAULT NULL COMMENT '邮箱地址',
  `nickname` varchar(20) DEFAULT NULL COMMENT '用户昵称',
  `pwd` char(32) DEFAULT NULL COMMENT '密码',
  `reg_date` int(10) DEFAULT NULL,
  `reg_ip` char(15) DEFAULT NULL COMMENT '注册IP地址',
  `verify_status` int(1) DEFAULT '0' COMMENT '电子邮件验证标示 0未验证，1已验证',
  `verify_code` varchar(32) DEFAULT NULL COMMENT '电子邮件验证随机码',
  `verify_time` int(10) DEFAULT NULL COMMENT '邮箱验证时间',
  `verify_exp_time` int(10) DEFAULT NULL COMMENT '验证邮件过期时间',
  `find_fwd_code` varchar(32) DEFAULT NULL COMMENT '找回密码验证随机码',
  `find_pwd_time` int(10) DEFAULT NULL COMMENT '找回密码申请提交时间',
  `find_pwd_exp_time` int(10) DEFAULT NULL COMMENT '找回密码验证随机码过期时间',
  `avatar` varchar(100) DEFAULT NULL COMMENT '用户头像',
  `birthday` int(10) DEFAULT NULL COMMENT '用户生日',
  `sex` int(1) DEFAULT NULL COMMENT '0女1男',
  `address` varchar(50) DEFAULT NULL COMMENT '地址',
  `province` varchar(100) DEFAULT NULL COMMENT '省份',
  `city` varchar(100) DEFAULT NULL COMMENT '城市',
  `intr` varchar(500) DEFAULT NULL COMMENT '个人介绍',
  `mobile` varchar(11) DEFAULT NULL COMMENT '手机号码',
  `phone` varchar(30) DEFAULT NULL COMMENT '电话',
  `fax` varchar(30) DEFAULT NULL,
  `qq` int(15) DEFAULT NULL,
  `msn` varchar(100) DEFAULT NULL,
  `login_ip` varchar(15) DEFAULT NULL COMMENT '登录ip',
  `login_time` int(10) DEFAULT NULL COMMENT '登录时间',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='网站前台会员表' AUTO_INCREMENT=351 ;

-- --------------------------------------------------------

--
-- 表的结构 `pa_message`
--

CREATE TABLE IF NOT EXISTS `pa_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `email` varchar(32) NOT NULL,
  `moblie` char(15) NOT NULL,
  `display` int(1) NOT NULL DEFAULT '0',
  `addtime` int(11) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- 表的结构 `pa_model`
--

CREATE TABLE IF NOT EXISTS `pa_model` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(32) NOT NULL COMMENT '模型名称',
  `tbl_name` varchar(32) NOT NULL COMMENT '数据表名称',
  `menu_name` varchar(32) NOT NULL COMMENT '菜单名称',
  `is_inner` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否为内部表',
  `has_pk` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是否包含主键',
  `tbl_engine` varchar(16) NOT NULL DEFAULT 'InnoDB' COMMENT '引擎类型',
  `description` text NOT NULL COMMENT '模型描述',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='数据模型信息' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `pa_nav`
--

CREATE TABLE IF NOT EXISTS `pa_nav` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `module` varchar(20) NOT NULL,
  `nav_name` varchar(255) NOT NULL,
  `parent_id` smallint(5) NOT NULL DEFAULT '0',
  `guide` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `link` varchar(225) NOT NULL,
  `lang` varchar(10) NOT NULL DEFAULT 'zh-cn' COMMENT '语言',
  `sort` tinyint(1) unsigned NOT NULL DEFAULT '50',
  `target` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=52 ;

-- --------------------------------------------------------

--
-- 表的结构 `pa_news`
--

CREATE TABLE IF NOT EXISTS `pa_news` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `cid` smallint(3) DEFAULT NULL COMMENT '所在分类',
  `title` varchar(200) DEFAULT NULL COMMENT '新闻标题',
  `keywords` varchar(50) DEFAULT NULL COMMENT '文章关键字',
  `description` mediumtext COMMENT '文章描述',
  `status` tinyint(1) DEFAULT NULL,
  `summary` varchar(255) DEFAULT NULL COMMENT '文章摘要',
  `published` int(10) DEFAULT NULL,
  `update_time` int(10) DEFAULT NULL,
  `content` text,
  `click` int(11) NOT NULL DEFAULT '0',
  `aid` smallint(3) DEFAULT NULL COMMENT '发布者UID',
  `is_recommend` int(1) NOT NULL DEFAULT '0',
  `image_id` int(11) NOT NULL DEFAULT '0',
  `lang` varchar(5) NOT NULL DEFAULT 'zh-cn',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='新闻表' AUTO_INCREMENT=19 ;

--
-- 转存表中的数据 `pa_news`
--

INSERT INTO `pa_news` (`id`, `cid`, `title`, `keywords`, `description`, `status`, `summary`, `published`, `update_time`, `content`, `click`, `aid`, `is_recommend`, `image_id`, `lang`) VALUES
(11, 1, '俄方风高放火好好规划', '俄方风高放火好好规划', '俄方风高放火好好规划', 1, '俄方风高放火好好规划', 1394437584, 1394437811, '俄方风高放火好好规划', 5, 1, 1, 40, 'zh-cn'),
(12, 1, '复反反复复反反复复吩咐个', '他尔特', '有人提议', 1, '有人提议', 1394437604, 1394437806, '牙痛溶液', 2, 1, 1, 0, 'zh-cn'),
(13, 1, '规范化规范化广泛用途用途用途用途规范化飞过海集结', '牙痛溶液', '有人体育', 1, '膮', 1394437621, 1394438741, '月try突然', 3, 1, 1, 0, 'zh-cn'),
(14, 1, '如果对符合购房计划将会根据', '激光焊接', '结核杆菌', 1, '几个号', 1394438751, 0, '几个号', 4, 1, 1, 0, 'zh-cn'),
(15, 1, '价格具有统一规划集合计划将会', '', '空军航空', 1, '', 1394438760, 0, '', 3, 1, 1, 0, 'zh-cn'),
(16, 1, '会见法国恢复的规划法规和反光镜', 'gfdg', '激光焊接有一天梵蒂冈梵蒂冈梵蒂冈奋斗', 1, '后果将会根据可更换', 1394438775, 1395218721, '<img src="/newconist/Uploads/image/product/20140303/20140303081406_87297.jpg" alt="" />根据可更换', 28, 1, 1, 0, 'zh-cn');

-- --------------------------------------------------------

--
-- 表的结构 `pa_node`
--

CREATE TABLE IF NOT EXISTS `pa_node` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='权限节点表' AUTO_INCREMENT=81 ;

--
-- 转存表中的数据 `pa_node`
--

INSERT INTO `pa_node` (`id`, `name`, `title`, `status`, `remark`, `sort`, `pid`, `level`) VALUES
(1, 'Admin', '后台管理', 1, '网站后台管理项目', 10, 0, 1),
(2, 'Index', '管理首页', 1, '', 1, 1, 2),
(3, 'Member', '注册会员管理', 1, '', 3, 1, 2),
(4, 'Webinfo', '系统管理', 1, '', 4, 1, 2),
(5, 'index', '默认页', 1, '', 5, 2, 3),
(6, 'myInfo', '我的个人信息', 1, '', 6, 2, 3),
(7, 'index', '会员首页', 1, '', 7, 3, 3),
(8, 'index', '管理员列表', 1, '', 8, 14, 3),
(9, 'addAdmin', '添加管理员', 1, '', 9, 14, 3),
(10, 'index', '系统设置首页', 1, '', 10, 4, 3),
(11, 'setEmailConfig', '设置系统邮件', 1, '', 12, 4, 3),
(12, 'testEmailConfig', '发送测试邮件', 1, '', 0, 4, 3),
(13, 'setSafeConfig', '系统安全设置', 1, '', 0, 4, 3),
(14, 'Access', '权限管理', 1, '权限管理，为系统后台管理员设置不同的权限', 0, 1, 2),
(15, 'nodeList', '查看节点', 1, '节点列表信息', 0, 14, 3),
(16, 'roleList', '角色列表查看', 1, '角色列表查看', 0, 14, 3),
(17, 'addRole', '添加角色', 1, '', 0, 14, 3),
(18, 'editRole', '编辑角色', 1, '', 0, 14, 3),
(19, 'opNodeStatus', '便捷开启禁用节点', 1, '', 0, 14, 3),
(20, 'opRoleStatus', '便捷开启禁用角色', 1, '', 0, 14, 3),
(21, 'editNode', '编辑节点', 1, '', 0, 14, 3),
(22, 'addNode', '添加节点', 1, '', 0, 14, 3),
(23, 'addAdmin', '添加管理员', 1, '', 0, 14, 3),
(24, 'editAdmin', '编辑管理员信息', 1, '', 0, 14, 3),
(25, 'changeRole', '权限分配', 1, '', 0, 14, 3),
(26, 'News', '资讯管理', 1, '', 0, 1, 2),
(27, 'index', '新闻列表', 1, '', 0, 26, 3),
(28, 'category', '新闻分类管理', 1, '', 0, 26, 3),
(29, 'add', '发布新闻', 1, '', 0, 26, 3),
(30, 'edit', '编辑新闻', 1, '', 0, 26, 3),
(31, 'del', '删除信息', 0, '', 0, 26, 3),
(32, 'SysData', '数据库管理', 1, '包含数据库备份、还原、打包等', 0, 1, 2),
(33, 'index', '查看数据库表结构信息', 1, '', 0, 32, 3),
(34, 'backup', '备份数据库', 1, '', 0, 32, 3),
(35, 'restore', '查看已备份SQL文件', 1, '', 0, 32, 3),
(36, 'restoreData', '执行数据库还原操作', 1, '', 0, 32, 3),
(37, 'delSqlFiles', '删除SQL文件', 1, '', 0, 32, 3),
(38, 'sendSql', '邮件发送SQL文件', 1, '', 0, 32, 3),
(39, 'zipSql', '打包SQL文件', 1, '', 0, 32, 3),
(40, 'zipList', '查看已打包SQL文件', 1, '', 0, 32, 3),
(41, 'unzipSqlfile', '解压缩ZIP文件', 1, '', 0, 32, 3),
(42, 'delZipFiles', '删除zip压缩文件', 1, '', 0, 32, 3),
(43, 'downFile', '下载备份的SQL,ZIP文件', 1, '', 0, 32, 3),
(44, 'repair', '数据库优化修复', 1, '', 0, 32, 3),
(46, 'Siteinfo', '网站功能', 1, '', 0, 1, 2),
(47, 'index', '菜单列表', 1, '', 0, 46, 3),
(48, 'add_nav', '添加/编辑菜单', 1, '', 0, 46, 3),
(49, 'adindex', '轮播列表', 1, '', 0, 46, 3),
(50, 'add_ad', '添加/编辑轮播', 1, '', 0, 46, 3),
(51, 'page', '单页列表', 1, '', 0, 46, 3),
(52, 'add_page', '添加/编辑单页', 1, '', 0, 46, 3),
(53, 'tag_index', '标签列表', 1, '', 0, 46, 3),
(54, 'add_tag', '添加/编辑标签', 1, '', 0, 46, 3),
(55, 'create_tag', '模版标签生成', 1, '', 0, 46, 3),
(56, 'file_index', '文件管理', 1, '', 0, 46, 3),
(57, 'link_index', '友情链接列表', 1, '', 0, 46, 3),
(58, 'add_link', '添加/编辑友情链接', 1, '', 0, 46, 3),
(59, 'message', '留言信息列表', 1, '', 0, 46, 3),
(60, 'Product', '产品管理', 1, '', 0, 1, 2),
(61, 'delpage', '删除单页', 1, '', 0, 46, 3),
(62, 'delad', '删除轮播', 1, '', 0, 46, 3),
(63, 'dellink', '删除友情链接', 1, '', 0, 46, 3),
(64, 'delmessage', '删除留言', 1, '', 0, 46, 3),
(65, 'deltag', '删除标签', 1, '', 0, 46, 3),
(66, 'selectCat', '文章分类', 1, '', 0, 46, 3),
(67, 'index', '产品列表', 1, '', 0, 60, 3),
(68, 'edit', '编辑产品', 1, '', 0, 60, 3),
(69, 'add', '添加产品', 1, '', 0, 60, 3),
(70, 'category', '分类列表', 1, '', 0, 60, 3),
(71, 'del', '删除产品', 1, '', 0, 60, 3),
(72, 'changeAttr', '快速推荐', 1, '', 0, 60, 3),
(73, 'changeStatus', '快速审核', 0, '', 0, 60, 3),
(74, 'changePhoneStatus', '手机推荐', 1, '', 0, 60, 3),
(75, 'checkProductTitle', '标题检查', 1, '', 0, 60, 3),
(76, 'changeAttr', '快速推荐', 1, '', 0, 26, 3),
(77, 'changeStatus', '快速审核', 1, '', 0, 26, 3),
(78, 'Models', '模型管理', 1, '', 0, 1, 2),
(79, 'index', '模型列表', 1, '', 0, 78, 3),
(80, 'add', '添加模型', 1, '', 0, 78, 3);

-- --------------------------------------------------------

--
-- 表的结构 `pa_page`
--

CREATE TABLE IF NOT EXISTS `pa_page` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(30) NOT NULL DEFAULT '',
  `parent_id` smallint(5) NOT NULL DEFAULT '0',
  `page_name` varchar(150) NOT NULL DEFAULT '',
  `content` longtext NOT NULL,
  `display` int(1) NOT NULL DEFAULT '0',
  `keywords` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `lang` varchar(10) NOT NULL DEFAULT 'zh-cn',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

-- --------------------------------------------------------

--
-- 表的结构 `pa_product`
--

CREATE TABLE IF NOT EXISTS `pa_product` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `cid` smallint(3) DEFAULT NULL COMMENT '所在分类',
  `title` varchar(200) DEFAULT NULL COMMENT '产品标题',
  `price` double(10,2) NOT NULL DEFAULT '0.00' COMMENT '价格',
  `psize` varchar(32) NOT NULL,
  `image_id` varchar(255) NOT NULL COMMENT '图片',
  `keywords` varchar(50) DEFAULT NULL COMMENT '产品关键字',
  `description` mediumtext COMMENT '产品描述',
  `status` tinyint(1) DEFAULT NULL,
  `summary` varchar(255) DEFAULT NULL COMMENT '产品摘要',
  `published` int(10) DEFAULT NULL,
  `update_time` int(10) DEFAULT NULL,
  `content` text,
  `lang` varchar(10) NOT NULL DEFAULT 'zh-cn',
  `aid` smallint(3) DEFAULT NULL COMMENT '发布者UID',
  `click` int(11) NOT NULL DEFAULT '0',
  `is_recommend` int(1) NOT NULL DEFAULT '0',
  `wap_display` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='产品表' AUTO_INCREMENT=35 ;

--
-- 转存表中的数据 `pa_product`
--

INSERT INTO `pa_product` (`id`, `cid`, `title`, `price`, `psize`, `image_id`, `keywords`, `description`, `status`, `summary`, `published`, `update_time`, `content`, `lang`, `aid`, `click`, `is_recommend`, `wap_display`) VALUES
(32, 56, '添加编辑产品', 43.00, '543', '42', '', '添加编辑产品', 1, '添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品', 1394437234, 1394441436, '<span style="&quot;&quot;&quot;\\&quot;color:#333333;font-family:Verdana,&quot;&quot;&quot;" geneva,="&quot;&quot;&quot;&quot;&quot;&quot;" sans-serif;line-height:22px;background-color:#f2f2f2;\\"="&quot;&quot;&quot;&quot;&quot;&quot;">添加编辑产品</span>', 'zh-cn', 1, 3, 1, 1),
(30, 52, '添加编辑产品', 43.00, '543', '37', '', '添加编辑产品', 1, '添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品', 1394159208, 1394437177, '<span style="&quot;\\&quot;color:#333333;font-family:Verdana,&quot;" geneva,="&quot;&quot;" sans-serif;line-height:22px;background-color:#f2f2f2;\\"="&quot;&quot;">添加编辑产品</span>', 'zh-cn', 1, 1, 1, 1),
(33, 52, '添加编辑产品', 43.00, '543', '39', '', '添加编辑产品', 1, '添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品', 1394437252, 0, '<span style="&quot;\\&quot;\\\\&quot;\\\\\\\\&quot;color:#333333;font-family:Verdana,\\\\&quot;\\&quot;&quot;" geneva,="&quot;\\&quot;\\\\&quot;\\\\&quot;\\&quot;&quot;" sans-serif;line-height:22px;background-color:#f2f2f2;\\\\\\\\\\\\\\"="&quot;\\&quot;\\\\&quot;\\\\&quot;\\&quot;&quot;">添加编辑产品</span>', 'zh-cn', 1, 31, 1, 1),
(34, 55, '添加编辑产品', 43.00, '543', '49,50,51', '', '添加编辑产品', 1, '添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品添加编辑产品', 1394441422, 1395295064, '如果豆腐干豆腐干梵蒂冈', 'zh-cn', 1, 24, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `pa_role`
--

CREATE TABLE IF NOT EXISTS `pa_role` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `pid` smallint(6) DEFAULT NULL,
  `status` tinyint(1) unsigned DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `status` (`status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='权限角色表' AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `pa_role`
--

INSERT INTO `pa_role` (`id`, `name`, `pid`, `status`, `remark`) VALUES
(1, '超级管理员', 0, 1, '系统内置超级管理员组，不受权限分配账号限制'),
(2, '管理员', 1, 1, '拥有系统仅此于超级管理员的权限'),
(3, '领导', 1, 1, '拥有所有操作的读权限，无增加、删除、修改的权限'),
(4, '测试组', 1, 1, '测试');

-- --------------------------------------------------------

--
-- 表的结构 `pa_role_user`
--

CREATE TABLE IF NOT EXISTS `pa_role_user` (
  `role_id` mediumint(9) unsigned DEFAULT NULL,
  `user_id` char(32) DEFAULT NULL,
  KEY `group_id` (`role_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户角色表';

--
-- 转存表中的数据 `pa_role_user`
--

INSERT INTO `pa_role_user` (`role_id`, `user_id`) VALUES
(3, '4'),
(3, '4'),
(3, '4');

-- --------------------------------------------------------

--
-- 表的结构 `pa_tag`
--

CREATE TABLE IF NOT EXISTS `pa_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(20) NOT NULL,
  `unique_id` char(20) NOT NULL,
  `content` text NOT NULL,
  `lang` varchar(10) NOT NULL DEFAULT 'zh-cn',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- 转存表中的数据 `pa_tag`
--

INSERT INTO `pa_tag` (`id`, `name`, `unique_id`, `content`, `lang`) VALUES
(6, '关于我们', 'aboutus', '<h3> <img src="/newconist/Uploads/image/product/20140303/20140303081406_87297.jpg" width="100" height="100" align="left" alt="" /> </h3><p>  在此处输入内容覆盖多个地方官热风斯蒂芬<span>在此处输入内容覆盖多个地方官热风斯蒂芬<span>在此处输入内容覆盖多个地方官热风斯蒂芬<span>在此处输入内容覆盖多个地方官热风斯蒂芬<span>在此处输入内容覆盖多个地方官热风斯蒂芬<span>在此处输入内容覆盖多个地方官热风斯蒂芬<span>在此处输入内容覆盖多个地方官热风斯蒂芬<span>在此处输入内容覆盖多个地方官热风斯蒂芬<span>在此处输入内容覆盖多个地方官热风斯蒂芬<span>在此处输入内容覆盖多<span></span></span></span></span></span></span></span></span></span></span></p>', 'zh-cn');

--
-- 限制导出的表
--

--
-- 限制表 `pa_field`
--
ALTER TABLE `pa_field`
  ADD CONSTRAINT `pa_field_ibfk_1` FOREIGN KEY (`model_id`) REFERENCES `pa_model` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `pa_input`
--
ALTER TABLE `pa_input`
  ADD CONSTRAINT `pa_input_ibfk_1` FOREIGN KEY (`field_id`) REFERENCES `pa_field` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
