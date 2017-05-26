
 /* 插入数据 `shang_member_banks` */
 INSERT INTO `shang_member_banks` VALUES ('2','','','','','','1460629605','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_member_banks` */
 INSERT INTO `shang_member_banks` VALUES ('6','','','','','','1460530179','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_member_banks` */
 INSERT INTO `shang_member_banks` VALUES ('8','','','','','','1460531549','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_member_banks` */
 INSERT INTO `shang_member_banks` VALUES ('9','','','','','','1460594924','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_member_banks` */
 INSERT INTO `shang_member_banks` VALUES ('11','','','','','','0','');/* DBReback Separation */
 /* 插入数据 `shang_member_banks` */
 INSERT INTO `shang_member_banks` VALUES ('12','','','','','','0','');/* DBReback Separation */
 /* 插入数据 `shang_member_banks` */
 INSERT INTO `shang_member_banks` VALUES ('13','','','','','','1460959205','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_member_banks` */
 INSERT INTO `shang_member_banks` VALUES ('7','','','','','','0','');/* DBReback Separation */
 /* 插入数据 `shang_member_banks` */
 INSERT INTO `shang_member_banks` VALUES ('4','12312312312321313','北京','北京','qwe','招商银行','1460966255','61.156.219.212');/* DBReback Separation */ 
 /* 数据表结构 `shang_member_borrow_show`*/ 
 DROP TABLE IF EXISTS `shang_member_borrow_show`;/* DBReback Separation */ 
 CREATE TABLE `shang_member_borrow_show` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `data_url` varchar(100) NOT NULL,
  `data_name` varchar(50) NOT NULL,
  `sort` int(8) unsigned NOT NULL,
  `deal_user` varchar(50) NOT NULL,
  `deal_time` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* DBReback Separation */ 
 /* 数据表结构 `shang_member_contact_info`*/ 
 DROP TABLE IF EXISTS `shang_member_contact_info`;/* DBReback Separation */ 
 CREATE TABLE `shang_member_contact_info` (
  `uid` int(10) unsigned NOT NULL,
  `address` varchar(200) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `contact1` varchar(50) NOT NULL,
  `contact1_re` varchar(20) NOT NULL,
  `contact1_tel` varchar(50) NOT NULL,
  `contact2` varchar(50) NOT NULL,
  `contact2_re` varchar(20) NOT NULL,
  `contact2_tel` varchar(20) NOT NULL,
  `contact1_other` varchar(100) NOT NULL,
  `contact2_other` varchar(100) NOT NULL,
  `contact3` varchar(40) DEFAULT NULL,
  `contact3_re` varchar(20) DEFAULT NULL,
  `contact3_tel` varchar(100) DEFAULT NULL,
  `contact3_other` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* DBReback Separation */ 
 /* 数据表结构 `shang_member_creditslog`*/ 
 DROP TABLE IF EXISTS `shang_member_creditslog`;/* DBReback Separation */ 
 CREATE TABLE `shang_member_creditslog` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  `affect_credits` mediumint(9) NOT NULL,
  `account_credits` mediumint(9) NOT NULL,
  `info` varchar(50) NOT NULL,
  `add_time` int(10) unsigned NOT NULL,
  `add_ip` varchar(16) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`,`type`,`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;/* DBReback Separation */
 /* 插入数据 `shang_member_creditslog` */
 INSERT INTO `shang_member_creditslog` VALUES ('1','7','6','10','10','安全问题认证通过,奖励积分10','1460531490','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_member_creditslog` */
 INSERT INTO `shang_member_creditslog` VALUES ('2','7','2','10','20','实名认证通过,奖励积分10','1460531625','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_member_creditslog` */
 INSERT INTO `shang_member_creditslog` VALUES ('3','1','2','10','10','实名认证通过,奖励积分10','1460689308','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_member_creditslog` */
 INSERT INTO `shang_member_creditslog` VALUES ('4','14','10','10','10','手机认证通过,奖励积分10','1460950506','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_member_creditslog` */
 INSERT INTO `shang_member_creditslog` VALUES ('5','15','10','10','10','手机认证通过,奖励积分10','1460951375','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_member_creditslog` */
 INSERT INTO `shang_member_creditslog` VALUES ('6','16','10','10','10','手机认证通过,奖励积分10','1460951523','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_member_creditslog` */
 INSERT INTO `shang_member_creditslog` VALUES ('7','17','10','10','10','手机认证通过,奖励积分10','1460961454','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_member_creditslog` */
 INSERT INTO `shang_member_creditslog` VALUES ('8','4','2','10','10','实名认证通过,奖励积分10','1460966229','61.156.219.212');/* DBReback Separation */ 
 /* 数据表结构 `shang_member_data_info`*/ 
 DROP TABLE IF EXISTS `shang_member_data_info`;/* DBReback Separation */ 
 CREATE TABLE `shang_member_data_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `data_url` varchar(100) NOT NULL,
  `type` smallint(5) unsigned NOT NULL,
  `status` tinyint(3) unsigned NOT NULL,
  `add_time` int(10) unsigned NOT NULL,
  `data_name` varchar(50) NOT NULL,
  `size` int(10) unsigned NOT NULL,
  `ext` varchar(10) NOT NULL,
  `deal_info` varchar(40) NOT NULL,
  `deal_credits` smallint(5) unsigned NOT NULL,
  `deal_user` int(11) NOT NULL,
  `deal_time` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`,`type`,`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* DBReback Separation */ 
 /* 数据表结构 `shang_member_department_info`*/ 
 DROP TABLE IF EXISTS `shang_member_department_info`;/* DBReback Separation */ 
 CREATE TABLE `shang_member_department_info` (
  `uid` int(11) NOT NULL,
  `department_name` varchar(50) NOT NULL,
  `department_tel` varchar(20) NOT NULL,
  `department_address` varchar(200) NOT NULL,
  `department_year` varchar(20) NOT NULL,
  `voucher_name` varchar(20) NOT NULL,
  `voucher_tel` varchar(20) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* DBReback Separation */ 
 /* 数据表结构 `shang_member_ensure_info`*/ 
 DROP TABLE IF EXISTS `shang_member_ensure_info`;/* DBReback Separation */ 
 CREATE TABLE `shang_member_ensure_info` (
  `uid` int(11) NOT NULL,
  `ensuer1_name` varchar(20) NOT NULL,
  `ensuer1_re` varchar(20) NOT NULL,
  `ensuer1_tel` varchar(20) NOT NULL,
  `ensuer2_name` varchar(20) NOT NULL,
  `ensuer2_re` varchar(20) NOT NULL,
  `ensuer2_tel` varchar(20) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* DBReback Separation */ 
 /* 数据表结构 `shang_member_financial_info`*/ 
 DROP TABLE IF EXISTS `shang_member_financial_info`;/* DBReback Separation */ 
 CREATE TABLE `shang_member_financial_info` (
  `uid` int(10) unsigned NOT NULL,
  `fin_monthin` varchar(20) NOT NULL,
  `fin_incomedes` varchar(2000) NOT NULL,
  `fin_monthout` varchar(20) NOT NULL,
  `fin_outdes` varchar(2000) NOT NULL,
  `fin_house` varchar(50) NOT NULL,
  `fin_housevalue` varchar(20) NOT NULL,
  `fin_car` varchar(20) NOT NULL,
  `fin_carvalue` varchar(20) NOT NULL,
  `fin_stockcompany` varchar(50) NOT NULL,
  `fin_stockcompanyvalue` varchar(50) NOT NULL,
  `fin_otheremark` varchar(2000) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* DBReback Separation */ 
 /* 数据表结构 `shang_member_friend`*/ 
 DROP TABLE IF EXISTS `shang_member_friend`;/* DBReback Separation */ 
 CREATE TABLE `shang_member_friend` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `friend_id` int(10) unsigned NOT NULL,
  `apply_status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `add_time` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* DBReback Separation */ 
 /* 数据表结构 `shang_member_house_info`*/ 
 DROP TABLE IF EXISTS `shang_member_house_info`;/* DBReback Separation */ 
 CREATE TABLE `shang_member_house_info` (
  `uid` int(11) NOT NULL,
  `house_dizhi` varchar(200) NOT NULL,
  `house_mianji` float(10,2) NOT NULL,
  `house_nian` varchar(10) NOT NULL,
  `house_gong` varchar(20) NOT NULL,
  `house_suo1` varchar(20) NOT NULL,
  `house_suo2` varchar(20) NOT NULL,
  `house_feng1` float(10,2) NOT NULL,
  `house_feng2` float(10,2) NOT NULL,
  `house_dai` int(11) NOT NULL,
  `house_yuegong` float(10,2) NOT NULL,
  `house_shangxian` float(10,2) NOT NULL,
  `house_anjiebank` varchar(20) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* DBReback Separation */ 
 /* 数据表结构 `shang_member_info`*/ 
 DROP TABLE IF EXISTS `shang_member_info`;/* DBReback Separation */ 
 CREATE TABLE `shang_member_info` (
  `uid` int(10) unsigned NOT NULL,
  `sex` varchar(20) NOT NULL,
  `zy` varchar(40) NOT NULL,
  `cell_phone` varchar(11) NOT NULL,
  `info` varchar(500) NOT NULL,
  `marry` varchar(20) NOT NULL,
  `education` varchar(50) NOT NULL,
  `income` varchar(20) NOT NULL,
  `age` int(11) NOT NULL,
  `idcard` varchar(20) NOT NULL,
  `card_img` varchar(200) NOT NULL,
  `real_name` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `province` int(11) NOT NULL,
  `province_now` int(11) NOT NULL,
  `city` int(11) NOT NULL,
  `city_now` int(11) NOT NULL,
  `area` int(11) NOT NULL,
  `area_now` int(11) NOT NULL,
  `up_time` int(10) unsigned NOT NULL,
  `card_back_img` varchar(200) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* DBReback Separation */
 /* 插入数据 `shang_member_info` */
 INSERT INTO `shang_member_info` VALUES ('1','','','18266479979','','','','','0','370523199209251641','','韩贤','','0','0','0','0','0','0','1460519122','');/* DBReback Separation */
 /* 插入数据 `shang_member_info` */
 INSERT INTO `shang_member_info` VALUES ('2','','','15553833036','','','','','0','370323199110233020','','杨洪举','','0','0','0','0','0','0','1460519138','');/* DBReback Separation */
 /* 插入数据 `shang_member_info` */
 INSERT INTO `shang_member_info` VALUES ('3','','','15822623833','','','','','0','372325199711153637','','张超群','','0','0','0','0','0','0','1460524269','');/* DBReback Separation */
 /* 插入数据 `shang_member_info` */
 INSERT INTO `shang_member_info` VALUES ('4','','','15550533758','','','','','0','370323199303190321','','杨洪举11','','0','0','0','0','0','0','1460526063','');/* DBReback Separation */
 /* 插入数据 `shang_member_info` */
 INSERT INTO `shang_member_info` VALUES ('5','','','13287319810','','','','','0','370323199408090325','','杨洪举22','','0','0','0','0','0','0','1460526239','');/* DBReback Separation */
 /* 插入数据 `shang_member_info` */
 INSERT INTO `shang_member_info` VALUES ('6','','','17853738946','','','','','0','1','','张鸿强','','0','0','0','0','0','0','1460530071','');/* DBReback Separation */
 /* 插入数据 `shang_member_info` */
 INSERT INTO `shang_member_info` VALUES ('7','','','13835715949','','','','','0','142602199803142512','','行飞','','0','0','0','0','0','0','1460530148','');/* DBReback Separation */
 /* 插入数据 `shang_member_info` */
 INSERT INTO `shang_member_info` VALUES ('8','','','','','','','','0','','','','','0','0','0','0','0','0','1460530904','');/* DBReback Separation */
 /* 插入数据 `shang_member_info` */
 INSERT INTO `shang_member_info` VALUES ('9','','','18363280418','','','','','0','2','','孟凡设','','0','0','0','0','0','0','1460594841','');/* DBReback Separation */
 /* 插入数据 `shang_member_info` */
 INSERT INTO `shang_member_info` VALUES ('10','','','15553833032','','','','','0','','','','','0','0','0','0','0','0','0','');/* DBReback Separation */
 /* 插入数据 `shang_member_info` */
 INSERT INTO `shang_member_info` VALUES ('11','','','15254618081','','','','','0','372922199012104434','','李振立','','0','0','0','0','0','0','1460636648','');/* DBReback Separation */
 /* 插入数据 `shang_member_info` */
 INSERT INTO `shang_member_info` VALUES ('12','','','18366965610','','','','','0','123','','zhuxiaoxiao','','0','0','0','0','0','0','1460950152','');/* DBReback Separation */
 /* 插入数据 `shang_member_info` */
 INSERT INTO `shang_member_info` VALUES ('13','','','18725214691','','','','','0','533032198711290321','','二狗','','0','0','0','0','0','0','1460946686','');/* DBReback Separation */
 /* 插入数据 `shang_member_info` */
 INSERT INTO `shang_member_info` VALUES ('14','','','18353360751','','','','','0','','','','','0','0','0','0','0','0','0','');/* DBReback Separation */
 /* 插入数据 `shang_member_info` */
 INSERT INTO `shang_member_info` VALUES ('15','','','18353360752','','','','','0','','','','','0','0','0','0','0','0','0','');/* DBReback Separation */
 /* 插入数据 `shang_member_info` */
 INSERT INTO `shang_member_info` VALUES ('16','','','18353360753','','','','','0','','','','','0','0','0','0','0','0','0','');/* DBReback Separation */
 /* 插入数据 `shang_member_info` */
 INSERT INTO `shang_member_info` VALUES ('17','','','18353360755','','','','','0','','','','','0','0','0','0','0','0','0','');/* DBReback Separation */
 /* 插入数据 `shang_member_info` */
 INSERT INTO `shang_member_info` VALUES ('18','','','13706360071','','','','','0','370502199008206017','','杨超超','','0','0','0','0','0','0','1461113289','');/* DBReback Separation */ 
 /* 数据表结构 `shang_member_integrallog`*/ 
 DROP TABLE IF EXISTS `shang_member_integrallog`;/* DBReback Separation */ 
 CREATE TABLE `shang_member_integrallog` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  `affect_integral` mediumint(9) NOT NULL,
  `active_integral` mediumint(9) NOT NULL,
  `account_integral` mediumint(9) NOT NULL,
  `info` varchar(50) NOT NULL,
  `add_time` int(10) unsigned NOT NULL,
  `add_ip` varchar(16) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`,`type`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* DBReback Separation */ 
 /* 数据表结构 `shang_member_limitlog`*/ 
 DROP TABLE IF EXISTS `shang_member_limitlog`;/* DBReback Separation */ 
 CREATE TABLE `shang_member_limitlog` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  `credit_limit` float(15,2) NOT NULL,
  `borrow_vouch_limit` float(15,2) NOT NULL,
  `invest_vouch_limit` float(15,2) NOT NULL,
  `info` varchar(50) NOT NULL,
  `add_time` int(10) unsigned NOT NULL,
  `add_ip` varchar(16) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`,`type`,`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;/* DBReback Separation */ 
 /* 数据表结构 `shang_member_login`*/ 
 DROP TABLE IF EXISTS `shang_member_login`;/* DBReback Separation */ 
 CREATE TABLE `shang_member_login` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `ip` varchar(15) NOT NULL,
  `add_time` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`,`id`)
) ENGINE=MyISAM AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;/* DBReback Separation */
 /* 插入数据 `shang_member_login` */
 INSERT INTO `shang_member_login` VALUES ('1','3','61.156.219.212','1460526227');/* DBReback Separation */
 /* 插入数据 `shang_member_login` */
 INSERT INTO `shang_member_login` VALUES ('2','2','61.156.219.212','1460526336');/* DBReback Separation */
 /* 插入数据 `shang_member_login` */
 INSERT INTO `shang_member_login` VALUES ('3','1','61.156.219.211','1460529066');/* DBReback Separation */
 /* 插入数据 `shang_member_login` */
 INSERT INTO `shang_member_login` VALUES ('4','4','61.156.219.212','1460529673');/* DBReback Separation */
 /* 插入数据 `shang_member_login` */
 INSERT INTO `shang_member_login` VALUES ('5','5','61.156.219.212','1460529723');/* DBReback Separation */
 /* 插入数据 `shang_member_login` */
 INSERT INTO `shang_member_login` VALUES ('6','2','61.156.219.212','1460529870');/* DBReback Separation */
 /* 插入数据 `shang_member_login` */
 INSERT INTO `shang_member_login` VALUES ('7','4','61.156.219.212','1460530125');/* DBReback Separation */
 /* 插入数据 `shang_member_login` */
 INSERT INTO `shang_member_login` VALUES ('8','2','61.156.219.212','1460595635');/* DBReback Separation */
 /* 插入数据 `shang_member_login` */
 INSERT INTO `shang_member_login` VALUES ('9','4','61.156.219.212','1460596939');/* DBReback Separation */
 /* 插入数据 `shang_member_login` */
 INSERT INTO `shang_member_login` VALUES ('10','1','61.156.219.211','1460597485');/* DBReback Separation */
 /* 插入数据 `shang_member_login` */
 INSERT INTO `shang_member_login` VALUES ('11','4','61.156.219.211','1460598711');/* DBReback Separation */
 /* 插入数据 `shang_member_login` */
 INSERT INTO `shang_member_login` VALUES ('12','4','61.156.219.212','1460599335');/* DBReback Separation */
 /* 插入数据 `shang_member_login` */
 INSERT INTO `shang_member_login` VALUES ('13','1','61.156.219.211','1460600127');/* DBReback Separation */
 /* 插入数据 `shang_member_login` */
 INSERT INTO `shang_member_login` VALUES ('14','5','61.156.219.212','1460603362');/* DBReback Separation */
 /* 插入数据 `shang_member_login` */
 INSERT INTO `shang_member_login` VALUES ('15','4','61.156.219.212','1460612521');/* DBReback Separation */
 /* 插入数据 `shang_member_login` */
 INSERT INTO `shang_member_login` VALUES ('16','1','61.156.219.211','1460618779');/* DBReback Separation */
 /* 插入数据 `shang_member_login` */
 INSERT INTO `shang_member_login` VALUES ('17','4','61.156.219.212','1460625705');/* DBReback Separation */
 /* 插入数据 `shang_member_login` */
 INSERT INTO `shang_member_login` VALUES ('18','2','61.156.219.212','1460629621');/* DBReback Separation */
 /* 插入数据 `shang_member_login` */
 INSERT INTO `shang_member_login` VALUES ('19','2','61.156.219.212','1460629751');/* DBReback Separation */
 /* 插入数据 `shang_member_login` */
 INSERT INTO `shang_member_login` VALUES ('20','9','61.156.219.211','1460684621');/* DBReback Separation */
 /* 插入数据 `shang_member_login` */
 INSERT INTO `shang_member_login` VALUES ('21','4','61.156.219.211','1460684626');/* DBReback Separation */
 /* 插入数据 `shang_member_login` */
 INSERT INTO `shang_member_login` VALUES ('22','1','61.156.219.211','1460684741');/* DBReback Separation */
 /* 插入数据 `shang_member_login` */
 INSERT INTO `shang_member_login` VALUES ('23','1','61.156.219.211','1460689257');/* DBReback Separation */
 /* 插入数据 `shang_member_login` */
 INSERT INTO `shang_member_login` VALUES ('24','1','61.156.219.212','1460691868');/* DBReback Separation */
 /* 插入数据 `shang_member_login` */
 INSERT INTO `shang_member_login` VALUES ('25','2','61.156.219.212','1460773356');/* DBReback Separation */
 /* 插入数据 `shang_member_login` */
 INSERT INTO `shang_member_login` VALUES ('26','1','61.156.219.212','1460783599');/* DBReback Separation */
 /* 插入数据 `shang_member_login` */
 INSERT INTO `shang_member_login` VALUES ('27','1','61.156.219.212','1460787697');/* DBReback Separation */
 /* 插入数据 `shang_member_login` */
 INSERT INTO `shang_member_login` VALUES ('28','1','61.156.219.211','1460940477');/* DBReback Separation */
 /* 插入数据 `shang_member_login` */
 INSERT INTO `shang_member_login` VALUES ('29','7','61.156.219.211','1460944621');/* DBReback Separation */
 /* 插入数据 `shang_member_login` */
 INSERT INTO `shang_member_login` VALUES ('30','1','61.156.219.211','1460945242');/* DBReback Separation */
 /* 插入数据 `shang_member_login` */
 INSERT INTO `shang_member_login` VALUES ('31','2','61.156.219.212','1460949191');/* DBReback Separation */
 /* 插入数据 `shang_member_login` */
 INSERT INTO `shang_member_login` VALUES ('32','12','61.156.219.212','1460949942');/* DBReback Separation */
 /* 插入数据 `shang_member_login` */
 INSERT INTO `shang_member_login` VALUES ('33','12','61.156.219.212','1460950434');/* DBReback Separation */
 /* 插入数据 `shang_member_login` */
 INSERT INTO `shang_member_login` VALUES ('34','12','61.156.219.212','1460950995');/* DBReback Separation */
 /* 插入数据 `shang_member_login` */
 INSERT INTO `shang_member_login` VALUES ('35','12','61.156.219.212','1460951584');/* DBReback Separation */
 /* 插入数据 `shang_member_login` */
 INSERT INTO `shang_member_login` VALUES ('36','12','61.156.219.212','1460951813');/* DBReback Separation */
 /* 插入数据 `shang_member_login` */
 INSERT INTO `shang_member_login` VALUES ('37','1','61.156.219.211','1460957922');/* DBReback Separation */
 /* 插入数据 `shang_member_login` */
 INSERT INTO `shang_member_login` VALUES ('38','12','61.156.219.212','1460958313');/* DBReback Separation */
 /* 插入数据 `shang_member_login` */
 INSERT INTO `shang_member_login` VALUES ('39','9','61.156.219.211','1460959596');/* DBReback Separation */
 /* 插入数据 `shang_member_login` */
 INSERT INTO `shang_member_login` VALUES ('40','17','61.156.219.212','1460961680');/* DBReback Separation */
 /* 插入数据 `shang_member_login` */
 INSERT INTO `shang_member_login` VALUES ('41','4','61.156.219.212','1460964198');/* DBReback Separation */
 /* 插入数据 `shang_member_login` */
 INSERT INTO `shang_member_login` VALUES ('42','5','61.156.219.212','1460966307');/* DBReback Separation */
 /* 插入数据 `shang_member_login` */
 INSERT INTO `shang_member_login` VALUES ('43','17','61.156.219.212','1460967486');/* DBReback Separation */
 /* 插入数据 `shang_member_login` */
 INSERT INTO `shang_member_login` VALUES ('44','15','61.156.219.212','1460968866');/* DBReback Separation */
 /* 插入数据 `shang_member_login` */
 INSERT INTO `shang_member_login` VALUES ('45','14','61.156.219.212','1460969061');/* DBReback Separation */
 /* 插入数据 `shang_member_login` */
 INSERT INTO `shang_member_login` VALUES ('46','16','61.156.219.212','1460970413');/* DBReback Separation */
 /* 插入数据 `shang_member_login` */
 INSERT INTO `shang_member_login` VALUES ('47','17','61.156.219.212','1460970430');/* DBReback Separation */
 /* 插入数据 `shang_member_login` */
 INSERT INTO `shang_member_login` VALUES ('48','14','61.156.219.212','1460970504');/* DBReback Separation */
 /* 插入数据 `shang_member_login` */
 INSERT INTO `shang_member_login` VALUES ('49','12','61.156.219.212','1461027769');/* DBReback Separation */
 /* 插入数据 `shang_member_login` */
 INSERT INTO `shang_member_login` VALUES ('50','2','61.156.219.212','1461033999');/* DBReback Separation */
 /* 插入数据 `shang_member_login` */
 INSERT INTO `shang_member_login` VALUES ('51','2','61.156.219.212','1461035744');/* DBReback Separation */
 /* 插入数据 `shang_member_login` */
 INSERT INTO `shang_member_login` VALUES ('52','2','61.156.219.212','1461045747');/* DBReback Separation */
 /* 插入数据 `shang_member_login` */
 INSERT INTO `shang_member_login` VALUES ('53','4','61.156.219.212','1461045806');/* DBReback Separation */
 /* 插入数据 `shang_member_login` */
 INSERT INTO `shang_member_login` VALUES ('54','12','61.156.219.211','1461118135');/* DBReback Separation */
 /* 插入数据 `shang_member_login` */
 INSERT INTO `shang_member_login` VALUES ('55','4','61.156.219.211','1461119138');/* DBReback Separation */
 /* 插入数据 `shang_member_login` */
 INSERT INTO `shang_member_login` VALUES ('56','1','61.156.219.211','1461119148');/* DBReback Separation */ 
 /* 数据表结构 `shang_member_money`*/ 
 DROP TABLE IF EXISTS `shang_member_money`;/* DBReback Separation */ 
 CREATE TABLE `shang_member_money` (
  `uid` int(10) unsigned NOT NULL,
  `money_freeze` decimal(15,2) NOT NULL COMMENT '冻结金额',
  `money_collect` decimal(15,2) NOT NULL COMMENT '待收金额',
  `account_money` decimal(15,2) NOT NULL COMMENT '充值资金存放池_可用余额',
  `back_money` decimal(15,2) NOT NULL COMMENT '回款资金存放池_可用余额',
  `credit_limit` decimal(15,2) NOT NULL,
  `credit_cuse` decimal(15,2) NOT NULL,
  `borrow_vouch_limit` decimal(15,2) NOT NULL,
  `borrow_vouch_cuse` decimal(15,2) NOT NULL,
  `invest_vouch_limit` decimal(15,2) NOT NULL,
  `invest_vouch_cuse` decimal(15,2) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;/* DBReback Separation */
 /* 插入数据 `shang_member_money` */
 INSERT INTO `shang_member_money` VALUES ('1','4500.00','0.00','1253000.00','234102.00','0.00','0.00','0.00','0.00','0.00','0.00');/* DBReback Separation */
 /* 插入数据 `shang_member_money` */
 INSERT INTO `shang_member_money` VALUES ('2','0.00','0.00','160400.00','7.00','0.00','0.00','0.00','0.00','0.00','0.00');/* DBReback Separation */
 /* 插入数据 `shang_member_money` */
 INSERT INTO `shang_member_money` VALUES ('3','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00');/* DBReback Separation */
 /* 插入数据 `shang_member_money` */
 INSERT INTO `shang_member_money` VALUES ('4','200.00','0.00','49691900.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00');/* DBReback Separation */
 /* 插入数据 `shang_member_money` */
 INSERT INTO `shang_member_money` VALUES ('5','0.00','0.00','9690000.00','18200.00','0.00','0.00','0.00','0.00','0.00','0.00');/* DBReback Separation */
 /* 插入数据 `shang_member_money` */
 INSERT INTO `shang_member_money` VALUES ('6','0.00','0.00','752500.00','257000.00','0.00','0.00','0.00','0.00','0.00','0.00');/* DBReback Separation */
 /* 插入数据 `shang_member_money` */
 INSERT INTO `shang_member_money` VALUES ('7','0.00','0.00','9999999999999.99','-9999999999999.99','0.00','0.00','0.00','0.00','0.00','0.00');/* DBReback Separation */
 /* 插入数据 `shang_member_money` */
 INSERT INTO `shang_member_money` VALUES ('8','9999999650000.00','0.00','350000.00','-11110127778.00','0.00','0.00','0.00','0.00','0.00','0.00');/* DBReback Separation */
 /* 插入数据 `shang_member_money` */
 INSERT INTO `shang_member_money` VALUES ('9','0.00','0.00','949800.00','42000.00','0.00','0.00','0.00','0.00','0.00','0.00');/* DBReback Separation */
 /* 插入数据 `shang_member_money` */
 INSERT INTO `shang_member_money` VALUES ('13','96000.00','0.00','9999950000.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00');/* DBReback Separation */
 /* 插入数据 `shang_member_money` */
 INSERT INTO `shang_member_money` VALUES ('14','3333.00','0.00','99999.00','0.00','0.00','0.00','0.00','0.00','0.00','0.00');/* DBReback Separation */ 
 /* 数据表结构 `shang_member_moneylog`*/ 
 DROP TABLE IF EXISTS `shang_member_moneylog`;/* DBReback Separation */ 
 CREATE TABLE `shang_member_moneylog` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  `affect_money` decimal(15,2) NOT NULL COMMENT '影响金额',
  `account_money` decimal(15,2) NOT NULL COMMENT '充值资金存放池_可用余额',
  `back_money` decimal(15,2) NOT NULL COMMENT '回款资金存放池_可用余额',
  `collect_money` decimal(15,2) NOT NULL COMMENT '待收金额',
  `freeze_money` decimal(15,2) NOT NULL COMMENT '冻结金额',
  `info` varchar(200) NOT NULL,
  `add_time` int(10) unsigned NOT NULL,
  `add_ip` varchar(16) NOT NULL,
  `target_uid` int(11) NOT NULL DEFAULT '0',
  `target_uname` varchar(20) NOT NULL,
  `tag` int(10) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`,`type`,`id`)
) ENGINE=InnoDB AUTO_INCREMENT=183 DEFAULT CHARSET=utf8;/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('1','2','27','200000.00','200000.00','0.00','0.00','0.00','管理员手动审核充值','1460519198','61.156.219.212','0','@网站管理员@','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('2','2','32','400.00','200400.00','0.00','0.00','0.00','线下充值奖励','1460519198','61.156.219.212','0','@网站管理员@','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('3','3','7','10000000.00','10000000.00','0.00','0.00','0.00','0','1460525218','61.156.219.212','0','@网站管理员@','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('4','4','7','50000000.00','50000000.00','0.00','0.00','0.00','0','1460526179','61.156.219.212','0','@网站管理员@','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('5','5','7','10000000.00','10000000.00','0.00','0.00','0.00','0','1460526260','61.156.219.212','0','@网站管理员@','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('6','4','56','-50000.00','49950000.00','0.00','0.00','50000.00','预约成功，冻结预约金50000元','1460529703','61.156.219.212','0','@网站管理员@','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('7','5','56','-80000.00','9920000.00','0.00','0.00','80000.00','预约成功，冻结预约金80000元','1460529744','61.156.219.212','0','@网站管理员@','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('8','1','27','1000000.00','1000000.00','0.00','0.00','0.00','管理员手动审核充值','1460529745','61.156.219.211','0','@网站管理员@','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('9','1','32','2000.00','1002000.00','0.00','0.00','0.00','线下充值奖励','1460529745','61.156.219.211','0','@网站管理员@','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('10','5','50','-250000.00','9670000.00','0.00','0.00','330000.00','对1号众筹进行投资','1460529775','61.156.219.212','2','15553833036','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('11','4','50','-250000.00','49700000.00','0.00','0.00','300000.00','对1号众筹进行投资','1460529795','61.156.219.212','2','15553833036','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('12','5','53','250000.00','9670000.00','0.00','0.00','80000.00','1号众筹满标，扣除冻结金额250000.00','1460529795','61.156.219.212','2','15553833036','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('13','4','53','250000.00','49700000.00','0.00','0.00','50000.00','1号众筹满标，扣除冻结金额250000.00','1460529795','61.156.219.212','2','15553833036','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('14','2','54','500000.00','700400.00','0.00','0.00','0.00','1号众筹满标，收到众筹金额500000元','1460529795','61.156.219.212','0','@网站管理员@','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('15','2','55','-550000.00','150400.00','0.00','0.00','0.00','第1号众筹出售成功,扣除投资人本金和收益550000.00','1460529852','61.156.219.212','0','@网站管理员@','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('16','4','52','250000.00','49700000.00','250000.00','0.00','50000.00','第1号众筹出售成功,返还本金250000.00','1460529852','61.156.219.212','2','15553833036','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('17','4','51','5000.00','49700000.00','255000.00','0.00','50000.00','第1号众筹出售成功,获得收益5000','1460529852','61.156.219.212','2','15553833036','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('18','2','13','5.00','150400.00','5.00','0.00','0.00','第1号众筹出售成功,获得推荐奖励5','1460529852','61.156.219.212','2','15553833036','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('19','5','52','250000.00','9670000.00','250000.00','0.00','80000.00','第1号众筹出售成功,返还本金250000.00','1460529852','61.156.219.212','2','15553833036','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('20','5','51','5000.00','9670000.00','255000.00','0.00','80000.00','第1号众筹出售成功,获得收益5000','1460529852','61.156.219.212','2','15553833036','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('21','4','50','-50000.00','49700000.00','255000.00','0.00','50000.00','使用预约金对7号众筹进行投资','1460529901','61.156.219.211','1','18266479979','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('22','5','50','-40000.00','9670000.00','255000.00','0.00','80000.00','使用预约金对7号众筹进行投资','1460529901','61.156.219.211','1','18266479979','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('23','3','7','-10000000.00','0.00','0.00','0.00','0.00','1','1460530068','61.156.219.212','0','@网站管理员@','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('24','4','50','-224900.00','49700000.00','30100.00','0.00','274900.00','对4号众筹进行投资,使用红包100.00元','1460530156','61.156.219.212','1','18266479979','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('25','6','27','1000000.00','1000000.00','0.00','0.00','0.00','管理员手动审核充值','1460530161','61.156.219.211','0','@网站管理员@','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('26','6','32','2000.00','1002000.00','0.00','0.00','0.00','线下充值奖励','1460530161','61.156.219.211','0','@网站管理员@','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('27','5','50','-225000.00','9670000.00','30000.00','0.00','305000.00','对4号众筹进行投资','1460530172','61.156.219.212','1','18266479979','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('28','4','53','224900.00','49700000.00','30100.00','0.00','50000.00','4号众筹满标，扣除冻结金额224900','1460530172','61.156.219.212','1','18266479979','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('29','5','53','225000.00','9670000.00','30000.00','0.00','80000.00','4号众筹满标，扣除冻结金额225000.00','1460530172','61.156.219.212','1','18266479979','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('30','1','54','450000.00','1452000.00','0.00','0.00','0.00','4号众筹满标，收到众筹金额450000元','1460530172','61.156.219.212','0','@网站管理员@','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('31','6','50','-199500.00','802500.00','0.00','0.00','199500.00','对2号众筹进行投资,使用红包500.00元','1460530225','61.156.219.211','2','15553833036','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('32','6','50','-100000.00','702500.00','0.00','0.00','299500.00','对3号众筹进行投资','1460530260','61.156.219.211','1','18266479979','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('33','4','50','-40000.00','49690100.00','0.00','0.00','90000.00','对7号众筹进行投资','1460530296','61.156.219.212','1','18266479979','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('34','7','7','9999999999999.99','9999999999999.99','0.00','0.00','0.00','123','1460530331','61.156.219.212','0','@网站管理员@','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('35','5','50','-50000.00','9650000.00','0.00','0.00','130000.00','对7号众筹进行投资','1460530339','61.156.219.212','1','18266479979','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('36','4','53','50000.00','49690100.00','0.00','0.00','40000.00','7号众筹满标，扣除冻结金额50000.00','1460530339','61.156.219.212','1','18266479979','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('37','5','53','40000.00','9650000.00','0.00','0.00','90000.00','7号众筹满标，扣除冻结金额40000.00','1460530339','61.156.219.212','1','18266479979','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('38','4','53','40000.00','49690100.00','0.00','0.00','0.00','7号众筹满标，扣除冻结金额40000.00','1460530339','61.156.219.212','1','18266479979','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('39','5','53','50000.00','9650000.00','0.00','0.00','40000.00','7号众筹满标，扣除冻结金额50000.00','1460530339','61.156.219.212','1','18266479979','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('40','1','54','180000.00','1632000.00','0.00','0.00','0.00','7号众筹满标，收到众筹金额180000元','1460530339','61.156.219.212','0','@网站管理员@','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('41','1','50','-250000.00','1382000.00','0.00','0.00','250000.00','对2号众筹进行投资','1460530384','61.156.219.211','2','15553833036','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('42','6','50','-50000.00','652500.00','0.00','0.00','349500.00','对2号众筹进行投资','1460530412','61.156.219.211','2','15553833036','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('43','6','53','199500.00','652500.00','0.00','0.00','150000.00','2号众筹满标，扣除冻结金额199500','1460530412','61.156.219.211','2','15553833036','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('44','1','53','250000.00','1382000.00','0.00','0.00','0.00','2号众筹满标，扣除冻结金额250000.00','1460530412','61.156.219.211','2','15553833036','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('45','6','53','50000.00','652500.00','0.00','0.00','100000.00','2号众筹满标，扣除冻结金额50000.00','1460530412','61.156.219.211','2','15553833036','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('46','2','54','500000.00','650400.00','5.00','0.00','0.00','2号众筹满标，收到众筹金额500000元','1460530412','61.156.219.211','0','@网站管理员@','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('47','7','50','-149900.00','9999999850100.00','0.00','0.00','149900.00','对5号众筹进行投资,使用红包100.00元','1460530872','61.156.219.212','2','15553833036','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('48','8','7','3333333.00','3333333.00','0.00','0.00','0.00','123','1460530950','61.156.219.212','0','@网站管理员@','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('49','8','50','-350000.00','2983333.00','0.00','0.00','350000.00','对6号众筹进行投资','1460531019','61.156.219.212','2','15553833036','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('50','8','7','-2000000.00','983333.00','0.00','0.00','350000.00','1','1460531308','61.156.219.212','0','@网站管理员@','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('51','7','7','-9999999999999.99','0.00','-9999999999999.99','0.00','149900.00','111','1460531330','61.156.219.212','0','@网站管理员@','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('52','7','7','9999999999999.99','9999999999999.99','-9999999999999.99','0.00','149900.00','1','1460531339','61.156.219.212','0','@网站管理员@','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('53','8','7','9999999999999.99','983333.00','0.00','0.00','9999999999999.99','111','1460531431','61.156.219.212','0','@网站管理员@','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('54','8','7','-11111111111.00','0.00','-11110127778.00','0.00','9999999999999.99','111','1460531457','61.156.219.212','0','@网站管理员@','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('55','7','7','-1111111.00','9999999999999.99','-9999999999999.99','0.00','-961211.00','12','1460531567','61.156.219.212','0','@网站管理员@','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('56','7','7','9999999999999.99','9999999999999.99','-9999999999999.99','0.00','9999999999999.99','12312312','1460531583','61.156.219.212','0','@网站管理员@','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('57','9','27','1000000.00','1000000.00','0.00','0.00','0.00','管理员手动审核充值','1460594890','61.156.219.211','0','@网站管理员@','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('58','9','32','2000.00','1002000.00','0.00','0.00','0.00','线下充值奖励','1460594890','61.156.219.211','0','@网站管理员@','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('59','4','56','-50000.00','49640100.00','0.00','0.00','50000.00','预约成功，冻结预约金50000元','1460597030','61.156.219.212','0','@网站管理员@','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('60','5','50','-20000.00','9650000.00','0.00','0.00','40000.00','使用预约金对8号众筹进行投资','1460597486','61.156.219.212','2','15553833036','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('61','4','50','-20000.00','49640100.00','0.00','0.00','50000.00','使用预约金对8号众筹进行投资','1460597486','61.156.219.212','2','15553833036','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('62','1','55','-200000.00','1182000.00','0.00','0.00','0.00','第7号众筹出售成功,扣除投资人本金和收益200000.00','1460597617','61.156.219.211','0','@网站管理员@','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('63','5','52','50000.00','9650000.00','50000.00','0.00','40000.00','第7号众筹出售成功,返还本金50000.00','1460597617','61.156.219.211','1','18266479979','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('64','5','51','1111.20','9650000.00','51111.20','0.00','40000.00','第7号众筹出售成功,获得收益1111.2','1460597617','61.156.219.211','1','18266479979','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('65','4','52','40000.00','49640100.00','40000.00','0.00','50000.00','第7号众筹出售成功,返还本金40000.00','1460597617','61.156.219.211','1','18266479979','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('66','4','51','888.80','49640100.00','40888.80','0.00','50000.00','第7号众筹出售成功,获得收益888.8','1460597617','61.156.219.211','1','18266479979','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('67','2','13','0.89','650400.00','5.89','0.00','0.00','第7号众筹出售成功,获得推荐奖励0.89','1460597617','61.156.219.211','1','18266479979','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('68','5','52','40000.00','9650000.00','91111.20','0.00','40000.00','第7号众筹出售成功,返还本金40000.00','1460597617','61.156.219.211','1','18266479979','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('69','5','51','888.80','9650000.00','92000.00','0.00','40000.00','第7号众筹出售成功,获得收益888.8','1460597617','61.156.219.211','1','18266479979','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('70','4','52','50000.00','49640100.00','90888.80','0.00','50000.00','第7号众筹出售成功,返还本金50000.00','1460597617','61.156.219.211','1','18266479979','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('71','4','51','1111.20','49640100.00','92000.00','0.00','50000.00','第7号众筹出售成功,获得收益1111.2','1460597617','61.156.219.211','1','18266479979','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('72','2','13','1.11','650400.00','7.00','0.00','0.00','第7号众筹出售成功,获得推荐奖励1.11','1460597617','61.156.219.211','1','18266479979','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('73','5','50','-8000.00','9650000.00','92000.00','0.00','40000.00','使用预约金对9号众筹进行投资','1460599308','61.156.219.212','2','15553833036','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('74','4','50','-8000.00','49640100.00','92000.00','0.00','50000.00','使用预约金对9号众筹进行投资','1460599309','61.156.219.212','2','15553833036','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('75','5','50','-2400.00','9650000.00','92000.00','0.00','40000.00','使用预约金对10号众筹进行投资','1460599496','61.156.219.212','2','15553833036','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('76','4','50','-2400.00','49640100.00','92000.00','0.00','50000.00','使用预约金对10号众筹进行投资','1460599496','61.156.219.212','2','15553833036','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('77','5','50','-3200.00','9650000.00','92000.00','0.00','40000.00','使用预约金对11号众筹进行投资','1460599712','61.156.219.211','1','18266479979','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('78','4','50','-3200.00','49640100.00','92000.00','0.00','50000.00','使用预约金对11号众筹进行投资','1460599712','61.156.219.211','1','18266479979','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('79','9','50','-30000.00','972000.00','0.00','0.00','30000.00','对10号众筹进行投资','1460600076','61.156.219.211','2','15553833036','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('80','5','50','-6400.00','9650000.00','92000.00','0.00','40000.00','使用预约金对12号众筹进行投资','1460601642','61.156.219.211','1','18266479979','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('81','4','50','-8000.00','49640100.00','92000.00','0.00','50000.00','使用预约金对12号众筹进行投资','1460601642','61.156.219.211','1','18266479979','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('82','4','50','-400.00','49640100.00','92000.00','0.00','50000.00','使用预约金对13号众筹进行投资','1460601733','61.156.219.211','1','18266479979','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('83','4','50','-1200.00','49640100.00','90800.00','0.00','51200.00','对10号众筹进行投资','1460602543','61.156.219.211','2','15553833036','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('84','4','50','-23000.00','49640100.00','67800.00','0.00','74200.00','对10号众筹进行投资','1460602607','61.156.219.211','2','15553833036','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('85','9','56','-3000.00','969000.00','0.00','0.00','33000.00','预约成功，冻结预约金3000元','1460602873','61.156.219.211','0','@网站管理员@','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('86','9','57','3000.00','972000.00','0.00','0.00','30000.00','第4号众筹预约手动取消，返回剩余额度资金','1460602900','61.156.219.211','0','@网站管理员@','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('87','4','50','-3200.00','49640100.00','67800.00','0.00','74200.00','使用预约金对14号众筹进行投资','1460603014','61.156.219.211','1','18266479979','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('88','4','50','-1500.00','49640100.00','66300.00','0.00','75700.00','对14号众筹进行投资','1460603210','61.156.219.212','1','18266479979','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('89','4','50','-1100.00','49640100.00','65200.00','0.00','76800.00','对14号众筹进行投资','1460603233','61.156.219.212','1','18266479979','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('90','4','50','-1200.00','49640100.00','64000.00','0.00','78000.00','对14号众筹进行投资','1460603287','61.156.219.212','1','18266479979','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('91','9','50','-11000.00','961000.00','0.00','0.00','41000.00','对14号众筹进行投资','1460603288','61.156.219.211','1','18266479979','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('92','4','50','-33000.00','49640100.00','31000.00','0.00','111000.00','对14号众筹进行投资','1460603308','61.156.219.212','1','18266479979','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('93','9','50','-1200.00','959800.00','0.00','0.00','42200.00','对14号众筹进行投资','1460603346','61.156.219.211','1','18266479979','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('94','5','50','-26000.00','9650000.00','66000.00','0.00','66000.00','对14号众筹进行投资','1460603389','61.156.219.212','1','18266479979','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('95','5','50','-1800.00','9650000.00','64200.00','0.00','67800.00','对14号众筹进行投资','1460603462','61.156.219.212','1','18266479979','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('96','4','53','3200.00','49640100.00','31000.00','0.00','107800.00','14号众筹满标，扣除冻结金额3200.00','1460603462','61.156.219.212','1','18266479979','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('97','4','53','1500.00','49640100.00','31000.00','0.00','106300.00','14号众筹满标，扣除冻结金额1500.00','1460603462','61.156.219.212','1','18266479979','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('98','4','53','1100.00','49640100.00','31000.00','0.00','105200.00','14号众筹满标，扣除冻结金额1100.00','1460603462','61.156.219.212','1','18266479979','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('99','4','53','1200.00','49640100.00','31000.00','0.00','104000.00','14号众筹满标，扣除冻结金额1200.00','1460603462','61.156.219.212','1','18266479979','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('100','9','53','11000.00','959800.00','0.00','0.00','31200.00','14号众筹满标，扣除冻结金额11000.00','1460603462','61.156.219.212','1','18266479979','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('101','4','53','33000.00','49640100.00','31000.00','0.00','71000.00','14号众筹满标，扣除冻结金额33000.00','1460603462','61.156.219.212','1','18266479979','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('102','9','53','1200.00','959800.00','0.00','0.00','30000.00','14号众筹满标，扣除冻结金额1200.00','1460603462','61.156.219.212','1','18266479979','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('103','5','53','26000.00','9650000.00','64200.00','0.00','41800.00','14号众筹满标，扣除冻结金额26000.00','1460603462','61.156.219.212','1','18266479979','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('104','5','53','1800.00','9650000.00','64200.00','0.00','40000.00','14号众筹满标，扣除冻结金额1800.00','1460603462','61.156.219.212','1','18266479979','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('105','1','54','80000.00','1262000.00','0.00','0.00','0.00','14号众筹满标，收到众筹金额80000元','1460603462','61.156.219.212','0','@网站管理员@','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('106','4','50','-3600.00','49640100.00','31000.00','0.00','71000.00','使用预约金对16号众筹进行投资','1460603773','61.156.219.211','1','18266479979','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('107','4','50','-1200.00','49640100.00','31000.00','0.00','71000.00','使用预约金对17号众筹进行投资','1460604151','61.156.219.212','2','15553833036','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('108','8','8','350000.00','350000.00','-11110127778.00','0.00','9999999650000.00','第6号众筹募集期内标未满,流标，返回冻结资金','1460618096','61.156.219.211','2','15553833036','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('109','2','55','-550000.00','100400.00','7.00','0.00','0.00','第2号众筹出售成功,扣除投资人本金和收益550000.00','1460622338','61.156.219.211','0','@网站管理员@','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('110','6','52','50000.00','652500.00','50000.00','0.00','100000.00','第2号众筹出售成功,返还本金50000.00','1460622338','61.156.219.211','2','15553833036','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('111','6','51','1500.00','652500.00','51500.00','0.00','100000.00','第2号众筹出售成功,获得收益1500','1460622338','61.156.219.211','2','15553833036','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('112','1','52','250000.00','1262000.00','250000.00','0.00','0.00','第2号众筹出售成功,返还本金250000.00','1460622338','61.156.219.211','2','15553833036','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('113','1','51','7500.00','1262000.00','257500.00','0.00','0.00','第2号众筹出售成功,获得收益7500','1460622338','61.156.219.211','2','15553833036','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('114','6','52','199500.00','652500.00','251000.00','0.00','100000.00','第2号众筹出售成功,返还本金199500','1460622338','61.156.219.211','2','15553833036','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('115','6','51','6000.00','652500.00','257000.00','0.00','100000.00','第2号众筹出售成功,获得收益6000','1460622338','61.156.219.211','2','15553833036','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('116','4','8','1200.00','49641300.00','31000.00','0.00','69800.00','第17号众筹募集期内标未满,流标，返回冻结资金','1460651438','220.181.108.81','2','15553833036','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('117','5','8','20000.00','9670000.00','64200.00','0.00','20000.00','第8号众筹募集期内标未满,流标，返回冻结资金','1460684265','61.135.169.10','2','15553833036','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('118','4','8','20000.00','49661300.00','31000.00','0.00','49800.00','第8号众筹募集期内标未满,流标，返回冻结资金','1460684265','61.135.169.10','2','15553833036','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('119','9','50','-10000.00','949800.00','0.00','0.00','40000.00','对16号众筹进行投资','1460684643','61.156.219.211','1','18266479979','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('120','1','50','-1000.00','1262000.00','256500.00','0.00','1000.00','对15号众筹进行投资','1460684773','61.156.219.211','2','15553833036','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('121','5','8','8000.00','9678000.00','64200.00','0.00','12000.00','第9号众筹募集期内标未满,流标，返回冻结资金','1460686507','121.42.0.77','2','15553833036','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('122','4','8','8000.00','49669300.00','31000.00','0.00','41800.00','第9号众筹募集期内标未满,流标，返回冻结资金','1460686507','121.42.0.77','2','15553833036','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('123','1','4','-100.00','1262000.00','256400.00','0.00','1100.00','提现,默认自动扣减手续费10元','1460691944','61.156.219.212','0','@网站管理员@','1');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('124','6','8','100000.00','752500.00','257000.00','0.00','0.00','第3号众筹募集期内标未满,流标，返回冻结资金','1461403285','61.156.219.212','1','18266479979','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('125','7','8','149900.00','9999999999999.99','-9999999999999.99','0.00','9999999850100.00','第5号众筹募集期内标未满,流标，返回冻结资金,返还红包100.00元','1461403285','61.156.219.212','2','15553833036','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('126','5','8','2400.00','9680400.00','64200.00','0.00','9600.00','第10号众筹募集期内标未满,流标，返回冻结资金','1461403285','61.156.219.212','2','15553833036','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('127','4','8','2400.00','49671700.00','31000.00','0.00','39400.00','第10号众筹募集期内标未满,流标，返回冻结资金','1461403285','61.156.219.212','2','15553833036','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('128','9','8','30000.00','979800.00','0.00','0.00','10000.00','第10号众筹募集期内标未满,流标，返回冻结资金','1461403285','61.156.219.212','2','15553833036','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('129','4','8','1200.00','49672900.00','31000.00','0.00','38200.00','第10号众筹募集期内标未满,流标，返回冻结资金','1461403285','61.156.219.212','2','15553833036','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('130','4','8','23000.00','49695900.00','31000.00','0.00','15200.00','第10号众筹募集期内标未满,流标，返回冻结资金','1461403285','61.156.219.212','2','15553833036','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('131','5','8','6400.00','9686800.00','64200.00','0.00','3200.00','第12号众筹募集期内标未满,流标，返回冻结资金','1461403285','61.156.219.212','1','18266479979','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('132','4','8','8000.00','49703900.00','31000.00','0.00','7200.00','第12号众筹募集期内标未满,流标，返回冻结资金','1461403285','61.156.219.212','1','18266479979','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('133','4','8','400.00','49704300.00','31000.00','0.00','6800.00','第13号众筹募集期内标未满,流标，返回冻结资金','1461403285','61.156.219.212','1','18266479979','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('134','1','8','1000.00','1263000.00','256400.00','0.00','100.00','第15号众筹募集期内标未满,流标，返回冻结资金','1461403285','61.156.219.212','2','15553833036','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('135','5','8','3200.00','9690000.00','64200.00','0.00','0.00','第11号众筹募集期内标未满,流标，返回冻结资金','1466857514','27.202.62.220','1','18266479979','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('136','4','8','3200.00','49707500.00','31000.00','0.00','3600.00','第11号众筹募集期内标未满,流标，返回冻结资金','1466857514','27.202.62.220','1','18266479979','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('137','4','8','3600.00','49711100.00','31000.00','0.00','0.00','第16号众筹募集期内标未满,流标，返回冻结资金','1466857514','27.202.62.220','1','18266479979','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('138','9','8','10000.00','989800.00','0.00','0.00','0.00','第16号众筹募集期内标未满,流标，返回冻结资金','1466857514','27.202.62.220','1','18266479979','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('139','1','56','-10000.00','1253000.00','256400.00','0.00','10100.00','预约成功，冻结预约金10000元','1460945394','61.156.219.211','0','@网站管理员@','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('140','7','7','-9999999999999.99','9999999999999.99','-9999999999999.99','0.00','-9999999999999.99','1','1460945590','61.156.219.211','0','@网站管理员@','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('142','1','50','-2400.00','1253000.00','256400.00','0.00','10100.00','使用预约金对21号众筹进行投资','1460945741','61.156.219.211','2','15553833036','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('143','13','7','10000000000.00','10000000000.00','0.00','0.00','0.00','11','1460946172','61.156.219.211','0','@网站管理员@','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('145','7','7','9999999999999.99','9999999999999.99','-9999999999999.99','0.00','9999999999999.99','1','1460946397','61.156.219.211','0','@网站管理员@','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('146','7','7','-9999999999999.99','9999999999999.99','-9999999999999.99','0.00','0.00','1','1460946413','61.156.219.211','0','@网站管理员@','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('149','13','56','-100000.00','9999900000.00','0.00','0.00','100000.00','预约成功，冻结预约金100000元','1460946758','182.247.67.144','0','@网站管理员@','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('150','13','50','-30000.00','9999870000.00','0.00','0.00','130000.00','对21号众筹进行投资','1460946969','182.247.67.144','2','15553833036','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('151','1','50','-27500.00','1253000.00','228900.00','0.00','37600.00','对21号众筹进行投资,使用红包100.00元','1460949292','61.156.219.211','2','15553833036','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('152','1','53','2400.00','1253000.00','228900.00','0.00','35200.00','21号众筹满标，扣除冻结金额2400.00','1460949292','61.156.219.211','2','15553833036','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('153','13','53','30000.00','9999870000.00','0.00','0.00','100000.00','21号众筹满标，扣除冻结金额30000.00','1460949292','61.156.219.211','2','15553833036','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('154','1','53','27500.00','1253000.00','228900.00','0.00','7700.00','21号众筹满标，扣除冻结金额27500','1460949292','61.156.219.211','2','15553833036','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('155','2','54','60000.00','160400.00','7.00','0.00','0.00','21号众筹满标，收到众筹金额60000元','1460949292','61.156.219.211','0','@网站管理员@','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('156','1','50','-3200.00','1253000.00','228900.00','0.00','7700.00','使用预约金对22号众筹进行投资','1460958678','61.156.219.211','2','15553833036','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('157','13','50','-3200.00','9999870000.00','0.00','0.00','100000.00','使用预约金对22号众筹进行投资','1460958678','61.156.219.211','2','15553833036','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('158','13','50','-4000.00','9999870000.00','0.00','0.00','100000.00','使用预约金对23号众筹进行投资','1460959296','61.156.219.211','1','18266479979','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('159','1','50','-3200.00','1253000.00','228900.00','0.00','7700.00','使用预约金对24号众筹进行投资','1460959509','61.156.219.211','13','18725214691','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('160','1','50','-36600.00','1253000.00','192300.00','0.00','44300.00','对24号众筹进行投资,使用红包200.00元','1460959557','61.156.219.211','13','18725214691','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('161','9','50','-40000.00','949800.00','0.00','0.00','40000.00','对24号众筹进行投资','1460959614','61.156.219.211','13','18725214691','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('162','1','53','3200.00','1253000.00','192300.00','0.00','41100.00','24号众筹满标，扣除冻结金额3200.00','1460959615','61.156.219.211','13','18725214691','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('163','1','53','36600.00','1253000.00','192300.00','0.00','4500.00','24号众筹满标，扣除冻结金额36600','1460959615','61.156.219.211','13','18725214691','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('164','9','53','40000.00','949800.00','0.00','0.00','0.00','24号众筹满标，扣除冻结金额40000.00','1460959615','61.156.219.211','13','18725214691','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('165','13','54','80000.00','9999950000.00','0.00','0.00','100000.00','24号众筹满标，收到众筹金额80000元','1460959615','61.156.219.211','0','@网站管理员@','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('166','13','55','-100000.00','9999850000.00','0.00','0.00','100000.00','第24号众筹出售成功,扣除投资人本金和收益100000.00','1460959674','61.156.219.211','0','@网站管理员@','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('167','9','52','40000.00','949800.00','40000.00','0.00','0.00','第24号众筹出售成功,返还本金40000.00','1460959674','61.156.219.211','13','18725214691','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('168','9','51','2000.00','949800.00','42000.00','0.00','0.00','第24号众筹出售成功,获得收益2000','1460959674','61.156.219.211','13','18725214691','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('169','1','13','2.00','1253000.00','192302.00','0.00','4500.00','第24号众筹出售成功,获得推荐奖励2','1460959674','61.156.219.211','13','18725214691','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('170','1','52','36600.00','1253000.00','228902.00','0.00','4500.00','第24号众筹出售成功,返还本金36600','1460959674','61.156.219.211','13','18725214691','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('171','1','51','1840.00','1253000.00','230742.00','0.00','4500.00','第24号众筹出售成功,获得收益1840','1460959674','61.156.219.211','13','18725214691','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('172','1','52','3200.00','1253000.00','233942.00','0.00','4500.00','第24号众筹出售成功,返还本金3200.00','1460959674','61.156.219.211','13','18725214691','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('173','1','51','160.00','1253000.00','234102.00','0.00','4500.00','第24号众筹出售成功,获得收益160','1460959674','61.156.219.211','13','18725214691','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('174','4','50','-10000.00','49711100.00','21000.00','0.00','10000.00','对23号众筹进行投资','1460966143','61.156.219.212','13','18725214691','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('175','4','50','-40000.00','49692100.00','0.00','0.00','50000.00','对23号众筹进行投资','1460966183','61.156.219.212','13','18725214691','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('176','4','4','-200.00','49691900.00','0.00','0.00','50200.00','提现,默认自动扣减手续费10元','1460966278','61.156.219.212','0','@网站管理员@','2');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('177','5','50','-46000.00','9690000.00','18200.00','0.00','46000.00','对23号众筹进行投资','1460966320','61.156.219.212','13','18725214691','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('178','13','53','4000.00','9999850000.00','0.00','0.00','96000.00','23号众筹满标，扣除冻结金额4000.00','1460966320','61.156.219.212','13','18725214691','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('179','4','53','10000.00','49691900.00','0.00','0.00','40200.00','23号众筹满标，扣除冻结金额10000.00','1460966320','61.156.219.212','13','18725214691','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('180','4','53','40000.00','49691900.00','0.00','0.00','200.00','23号众筹满标，扣除冻结金额40000.00','1460966320','61.156.219.212','13','18725214691','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('181','5','53','46000.00','9690000.00','18200.00','0.00','0.00','23号众筹满标，扣除冻结金额46000.00','1460966320','61.156.219.212','13','18725214691','0');/* DBReback Separation */
 /* 插入数据 `shang_member_moneylog` */
 INSERT INTO `shang_member_moneylog` VALUES ('182','13','54','100000.00','9999950000.00','0.00','0.00','96000.00','23号众筹满标，收到众筹金额100000元','1460966320','61.156.219.212','0','@网站管理员@','0');/* DBReback Separation */ 
 /* 数据表结构 `shang_member_msg`*/ 
 DROP TABLE IF EXISTS `shang_member_msg`;/* DBReback Separation */ 
 CREATE TABLE `shang_member_msg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_uid` int(11) NOT NULL,
  `from_uname` varchar(20) NOT NULL,
  `to_uid` int(11) NOT NULL,
  `to_uname` varchar(20) NOT NULL,
  `title` varchar(50) NOT NULL,
  `msg` varchar(2000) NOT NULL,
  `add_time` int(10) unsigned NOT NULL,
  `is_read` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `type` smallint(6) NOT NULL,
  `to_del` tinyint(4) NOT NULL DEFAULT '0',
  `from_del` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* DBReback Separation */ 
 /* 数据表结构 `shang_member_payonline`*/ 
 DROP TABLE IF EXISTS `shang_member_payonline`;/* DBReback Separation */ 
 CREATE TABLE `shang_member_payonline` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `nid` char(32) NOT NULL,
  `money` decimal(15,2) NOT NULL,
  `fee` decimal(8,2) NOT NULL,
  `way` varchar(20) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `add_time` int(10) unsigned NOT NULL,
  `add_ip` varchar(16) NOT NULL,
  `tran_id` varchar(50) NOT NULL,
  `off_bank` varchar(50) NOT NULL,
  `off_way` varchar(100) NOT NULL,
  `deal_user` varchar(40) NOT NULL,
  `deal_uid` int(11) NOT NULL,
  `payimg` varchar(1000) NOT NULL COMMENT '上传打款凭证',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`,`status`,`nid`,`id`),
  KEY `uid_2` (`uid`,`money`,`add_time`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;/* DBReback Separation */
 /* 插入数据 `shang_member_payonline` */
 INSERT INTO `shang_member_payonline` VALUES ('1','2','offline','200000.00','0.00','off','1','1460519186','61.156.219.212','00','中国银行 开户名：刘克涛','00000','tuanshang','113','');/* DBReback Separation */
 /* 插入数据 `shang_member_payonline` */
 INSERT INTO `shang_member_payonline` VALUES ('2','1','offline','1000000.00','0.00','off','1','1460529734','61.156.219.211','3695656856521512','中国银行 开户名：刘克涛','网银转帐','tuanshang','113','');/* DBReback Separation */
 /* 插入数据 `shang_member_payonline` */
 INSERT INTO `shang_member_payonline` VALUES ('3','6','offline','1000000.00','0.00','off','1','1460530143','61.156.219.211','3695656856521512','中国银行 开户名：刘克涛','网银转帐','tuanshang','113','');/* DBReback Separation */
 /* 插入数据 `shang_member_payonline` */
 INSERT INTO `shang_member_payonline` VALUES ('4','9','offline','1000000.00','0.00','off','1','1460594879','61.156.219.211','3695656856521512','中国银行 开户名：刘克涛','网银转帐','tuanshang','113','');/* DBReback Separation */
 /* 插入数据 `shang_member_payonline` */
 INSERT INTO `shang_member_payonline` VALUES ('5','1','offline','100.00','0.00','off','0','1460949837','61.156.219.211','3695656856521512','中国银行 开户名：刘克涛','网银转帐','','0','');/* DBReback Separation */ 
 /* 数据表结构 `shang_member_remark`*/ 
 DROP TABLE IF EXISTS `shang_member_remark`;/* DBReback Separation */ 
 CREATE TABLE `shang_member_remark` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `remark` varchar(500) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `admin_real_name` varchar(50) NOT NULL,
  `add_time` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* DBReback Separation */ 
 /* 数据表结构 `shang_member_safequestion`*/ 
 DROP TABLE IF EXISTS `shang_member_safequestion`;/* DBReback Separation */ 
 CREATE TABLE `shang_member_safequestion` (
  `uid` int(10) unsigned NOT NULL,
  `question1` varchar(100) NOT NULL,
  `answer1` varchar(100) NOT NULL,
  `question2` varchar(100) NOT NULL,
  `answer2` varchar(100) NOT NULL,
  `add_time` int(11) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* DBReback Separation */
 /* 插入数据 `shang_member_safequestion` */
 INSERT INTO `shang_member_safequestion` VALUES ('7','您的出生地是哪里？','山西侯马','您是什么学历？','高中','1460531490');/* DBReback Separation */ 
 /* 数据表结构 `shang_member_withdraw`*/ 
 DROP TABLE IF EXISTS `shang_member_withdraw`;/* DBReback Separation */ 
 CREATE TABLE `shang_member_withdraw` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `withdraw_money` decimal(15,2) NOT NULL,
  `withdraw_status` tinyint(4) NOT NULL,
  `withdraw_fee` decimal(15,2) NOT NULL,
  `add_time` int(10) unsigned NOT NULL,
  `add_ip` varchar(16) NOT NULL,
  `deal_time` int(10) unsigned NOT NULL,
  `deal_user` varchar(50) NOT NULL,
  `deal_info` varchar(200) NOT NULL,
  `second_fee` decimal(15,2) NOT NULL COMMENT '修改后的提现手续费',
  `success_money` decimal(15,2) NOT NULL COMMENT '实际到账金额',
  `account_num` decimal(15,2) DEFAULT NULL COMMENT '从充值资金池中体现的金额',
  `back_num` decimal(15,2) DEFAULT NULL COMMENT '从回款资金池中体现的金额',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`,`withdraw_status`,`add_time`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;/* DBReback Separation */
 /* 插入数据 `shang_member_withdraw` */
 INSERT INTO `shang_member_withdraw` VALUES ('1','1','100.00','0','10.00','1460691944','61.156.219.212','0','','','10.00','0.00','0.00','100.00');/* DBReback Separation */
 /* 插入数据 `shang_member_withdraw` */
 INSERT INTO `shang_member_withdraw` VALUES ('2','4','200.00','0','10.00','1460966278','61.156.219.212','0','','','10.00','0.00','200.00','0.00');/* DBReback Separation */ 
 /* 数据表结构 `shang_members`*/ 
 DROP TABLE IF EXISTS `shang_members`;/* DBReback Separation */ 
 CREATE TABLE `shang_members` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `user_pass` char(32) NOT NULL,
  `user_type` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `pin_pass` char(32) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_phone` varchar(11) NOT NULL,
  `reg_time` int(10) unsigned NOT NULL,
  `reg_ip` varchar(15) NOT NULL,
  `user_leve` tinyint(4) NOT NULL DEFAULT '0',
  `time_limit` int(10) unsigned NOT NULL,
  `credits` int(10) NOT NULL,
  `recommend_id` int(10) unsigned NOT NULL DEFAULT '0',
  `customer_id` int(10) unsigned NOT NULL,
  `customer_name` varchar(20) NOT NULL,
  `province` int(10) unsigned NOT NULL,
  `city` int(10) unsigned NOT NULL,
  `area` int(10) unsigned NOT NULL,
  `is_ban` int(11) NOT NULL DEFAULT '0' COMMENT '是否冻结0：否； 1：是',
  `reward_money` decimal(15,2) NOT NULL COMMENT '奖金金额',
  `invest_credits` decimal(15,2) unsigned NOT NULL,
  `integral` int(15) NOT NULL COMMENT '会员总积分',
  `active_integral` int(15) NOT NULL COMMENT '会员活跃积分',
  `is_borrow` int(2) NOT NULL DEFAULT '1' COMMENT '是否允许会员发标。0：不允许；1：允许',
  `is_transfer` int(2) NOT NULL DEFAULT '0' COMMENT '是否是流转会员 0代表非流转会员，1代表是流转会员',
  `is_vip` tinyint(3) NOT NULL DEFAULT '0' COMMENT '是否开启特权发标，0：不开启；1：开启',
  `last_log_ip` char(15) NOT NULL,
  `last_log_time` int(10) NOT NULL DEFAULT '0',
  `recommend_time` int(10) DEFAULT '0',
  `is_crowd_users` int(11) NOT NULL DEFAULT '0' COMMENT '0-正常用户 1-众筹发标人员',
  PRIMARY KEY (`id`),
  KEY `user_email` (`user_email`),
  KEY `user_name` (`user_name`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;/* DBReback Separation */
 /* 插入数据 `shang_members` */
 INSERT INTO `shang_members` VALUES ('1','18266479979','e10adc3949ba59abbe56e057f20f883e','1','670b14728ad9902aecba32e22fa4f6bd','','18266479979','1460519105','61.156.219.211','0','0','10','0','0','','0','0','0','0','0.00','0.00','0','0','1','0','0','61.156.219.211','1460519105','0','1');/* DBReback Separation */
 /* 插入数据 `shang_members` */
 INSERT INTO `shang_members` VALUES ('2','15553833036','e10adc3949ba59abbe56e057f20f883e','1','e10adc3949ba59abbe56e057f20f883e','','15553833036','1460519125','61.156.219.212','0','0','0','0','0','','0','0','0','0','0.00','0.00','0','0','1','0','0','61.156.219.212','1460519125','0','1');/* DBReback Separation */
 /* 插入数据 `shang_members` */
 INSERT INTO `shang_members` VALUES ('3','15822623833','231058f20b1110311b2bb30b64ec2afd','1','af4dce2bc8dd34afe482d34769935d43','','15822623833','1460524240','61.156.219.212','0','0','0','0','0','','0','0','0','0','0.00','0.00','0','0','1','0','0','61.156.219.212','1460524240','0','0');/* DBReback Separation */
 /* 插入数据 `shang_members` */
 INSERT INTO `shang_members` VALUES ('4','15550533758','e10adc3949ba59abbe56e057f20f883e','1','670b14728ad9902aecba32e22fa4f6bd','','15550533758','1460526047','61.156.219.212','0','0','10','2','0','','0','0','0','0','0.00','0.00','0','0','1','0','0','61.156.219.212','1460526047','1460526047','0');/* DBReback Separation */
 /* 插入数据 `shang_members` */
 INSERT INTO `shang_members` VALUES ('5','13287319810','e10adc3949ba59abbe56e057f20f883e','1','670b14728ad9902aecba32e22fa4f6bd','','13287319810','1460526222','61.156.219.212','0','0','0','0','0','','0','0','0','0','0.00','0.00','0','0','1','0','0','61.156.219.212','1460526222','0','0');/* DBReback Separation */
 /* 插入数据 `shang_members` */
 INSERT INTO `shang_members` VALUES ('6','17853738946','e10adc3949ba59abbe56e057f20f883e','1','670b14728ad9902aecba32e22fa4f6bd','','17853738946','1460530060','61.156.219.211','0','0','0','0','0','','0','0','0','0','0.00','0.00','0','0','1','0','0','61.156.219.211','1460530060','0','0');/* DBReback Separation */
 /* 插入数据 `shang_members` */
 INSERT INTO `shang_members` VALUES ('7','13835715949','4297f44b13955235245b2497399d7a93','1','f5bb0c8de146c67b44babbf4e6584cc0','','13835715949','1460530132','61.156.219.212','0','0','20','0','0','','0','0','0','0','0.00','0.00','0','0','1','0','0','61.156.219.212','1460530132','0','0');/* DBReback Separation */
 /* 插入数据 `shang_members` */
 INSERT INTO `shang_members` VALUES ('8','','e10adc3949ba59abbe56e057f20f883e','1','25d55ad283aa400af464c76d713c07ad','','','1460530886','61.156.219.212','0','0','0','0','0','','0','0','0','0','0.00','0.00','0','0','1','0','0','61.156.219.212','1460530886','0','0');/* DBReback Separation */
 /* 插入数据 `shang_members` */
 INSERT INTO `shang_members` VALUES ('9','18363280418','e10adc3949ba59abbe56e057f20f883e','1','670b14728ad9902aecba32e22fa4f6bd','','18363280418','1460594784','61.156.219.211','0','0','0','1','0','','0','0','0','0','0.00','0.00','0','0','1','0','0','61.156.219.211','1460594784','1460595019','0');/* DBReback Separation */
 /* 插入数据 `shang_members` */
 INSERT INTO `shang_members` VALUES ('10','15553833032','e10adc3949ba59abbe56e057f20f883e','1','','','15553833032','1460598470','61.156.219.212','0','0','0','0','0','','0','0','0','0','0.00','0.00','0','0','1','0','0','','0','0','0');/* DBReback Separation */
 /* 插入数据 `shang_members` */
 INSERT INTO `shang_members` VALUES ('11','15254618081','e38652e84c48c0d47f533c0ea35c9aea','1','3d48b3735c1f39a0dff901a22bbfea07','','15254618081','1460636635','61.156.219.212','0','0','0','0','0','','0','0','0','0','0.00','0.00','0','0','1','0','0','61.156.219.212','1460636635','0','0');/* DBReback Separation */
 /* 插入数据 `shang_members` */
 INSERT INTO `shang_members` VALUES ('12','18366965610','e10adc3949ba59abbe56e057f20f883e','1','670b14728ad9902aecba32e22fa4f6bd','','18366965610','1460776325','61.156.219.212','0','0','0','0','0','','0','0','0','0','0.00','0.00','0','0','1','0','0','','0','0','0');/* DBReback Separation */
 /* 插入数据 `shang_members` */
 INSERT INTO `shang_members` VALUES ('13','18725214691','fe9c3f263b680a920e10108cb054cba8','1','292eb591d4845f8a075060f6b2839de6','','18725214691','1460945813','182.247.67.144','0','0','0','0','0','','0','0','0','0','0.00','0.00','0','0','1','0','0','182.247.67.144','1460945813','0','1');/* DBReback Separation */
 /* 插入数据 `shang_members` */
 INSERT INTO `shang_members` VALUES ('14','18353360751','14e1b600b1fd579f47433b88e8d85291','1','','','18353360751','1460950506','61.156.219.212','0','0','10','0','0','','0','0','0','0','0.00','0.00','0','0','1','0','0','61.156.219.212','1460950506','0','0');/* DBReback Separation */
 /* 插入数据 `shang_members` */
 INSERT INTO `shang_members` VALUES ('15','18353360752','14e1b600b1fd579f47433b88e8d85291','1','','','18353360752','1460951375','61.156.219.212','0','0','10','0','0','','0','0','0','0','0.00','0.00','0','0','1','0','0','61.156.219.212','1460951375','0','0');/* DBReback Separation */
 /* 插入数据 `shang_members` */
 INSERT INTO `shang_members` VALUES ('16','18353360753','14e1b600b1fd579f47433b88e8d85291','1','','','18353360753','1460951523','61.156.219.212','0','0','10','0','0','','0','0','0','0','0.00','0.00','0','0','1','0','0','61.156.219.212','1460951523','0','0');/* DBReback Separation */
 /* 插入数据 `shang_members` */
 INSERT INTO `shang_members` VALUES ('17','18353360755','14e1b600b1fd579f47433b88e8d85291','1','','','18353360755','1460961454','61.156.219.212','0','0','10','0','0','','0','0','0','0','0.00','0.00','0','0','1','0','0','61.156.219.212','1460961454','0','0');/* DBReback Separation */
 /* 插入数据 `shang_members` */
 INSERT INTO `shang_members` VALUES ('18','13706360071','e10adc3949ba59abbe56e057f20f883e','1','fcea920f7412b5da7be0cf42b8c93759','','13706360071','1461113274','61.156.219.211','0','0','0','0','0','','0','0','0','0','0.00','0.00','0','0','1','0','0','61.156.219.211','1461113274','0','0');/* DBReback Separation */ 
 /* 数据表结构 `shang_members_status`*/ 
 DROP TABLE IF EXISTS `shang_members_status`;/* DBReback Separation */ 
 CREATE TABLE `shang_members_status` (
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `phone_status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `phone_credits` int(10) unsigned NOT NULL DEFAULT '0',
  `id_status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '0:未上传1:验证通过2:等待验证',
  `id_credits` int(10) unsigned NOT NULL DEFAULT '0',
  `face_status` tinyint(4) NOT NULL DEFAULT '0',
  `face_credits` int(10) unsigned NOT NULL DEFAULT '0',
  `email_status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `email_credits` int(10) unsigned NOT NULL DEFAULT '0',
  `account_status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `account_credits` int(10) unsigned NOT NULL DEFAULT '0',
  `credit_status` tinyint(4) NOT NULL DEFAULT '0',
  `credit_credits` int(10) unsigned NOT NULL DEFAULT '0',
  `safequestion_status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `safequestion_credits` int(10) unsigned NOT NULL DEFAULT '0',
  `video_status` tinyint(4) NOT NULL DEFAULT '0',
  `video_credits` int(10) unsigned NOT NULL DEFAULT '0',
  `vip_status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `vip_credits` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;/* DBReback Separation */
 /* 插入数据 `shang_members_status` */
 INSERT INTO `shang_members_status` VALUES ('1','1','0','1','10','0','0','0','0','0','0','0','0','0','0','0','0','0','0');/* DBReback Separation */
 /* 插入数据 `shang_members_status` */
 INSERT INTO `shang_members_status` VALUES ('2','1','0','3','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0');/* DBReback Separation */
 /* 插入数据 `shang_members_status` */
 INSERT INTO `shang_members_status` VALUES ('3','1','0','3','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0');/* DBReback Separation */
 /* 插入数据 `shang_members_status` */
 INSERT INTO `shang_members_status` VALUES ('4','1','0','1','10','0','0','0','0','0','0','0','0','0','0','0','0','0','0');/* DBReback Separation */
 /* 插入数据 `shang_members_status` */
 INSERT INTO `shang_members_status` VALUES ('5','1','0','3','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0');/* DBReback Separation */
 /* 插入数据 `shang_members_status` */
 INSERT INTO `shang_members_status` VALUES ('6','1','0','3','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0');/* DBReback Separation */
 /* 插入数据 `shang_members_status` */
 INSERT INTO `shang_members_status` VALUES ('7','1','0','1','10','0','0','0','0','0','0','0','0','1','10','0','0','0','0');/* DBReback Separation */
 /* 插入数据 `shang_members_status` */
 INSERT INTO `shang_members_status` VALUES ('8','1','0','3','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0');/* DBReback Separation */
 /* 插入数据 `shang_members_status` */
 INSERT INTO `shang_members_status` VALUES ('9','1','0','3','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0');/* DBReback Separation */
 /* 插入数据 `shang_members_status` */
 INSERT INTO `shang_members_status` VALUES ('10','1','10','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0');/* DBReback Separation */
 /* 插入数据 `shang_members_status` */
 INSERT INTO `shang_members_status` VALUES ('11','1','0','3','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0');/* DBReback Separation */
 /* 插入数据 `shang_members_status` */
 INSERT INTO `shang_members_status` VALUES ('12','1','10','3','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0');/* DBReback Separation */
 /* 插入数据 `shang_members_status` */
 INSERT INTO `shang_members_status` VALUES ('13','1','0','3','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0');/* DBReback Separation */
 /* 插入数据 `shang_members_status` */
 INSERT INTO `shang_members_status` VALUES ('14','1','10','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0');/* DBReback Separation */
 /* 插入数据 `shang_members_status` */
 INSERT INTO `shang_members_status` VALUES ('15','1','10','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0');/* DBReback Separation */
 /* 插入数据 `shang_members_status` */
 INSERT INTO `shang_members_status` VALUES ('16','1','10','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0');/* DBReback Separation */
 /* 插入数据 `shang_members_status` */
 INSERT INTO `shang_members_status` VALUES ('17','1','10','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0');/* DBReback Separation */
 /* 插入数据 `shang_members_status` */
 INSERT INTO `shang_members_status` VALUES ('18','1','0','3','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0');/* DBReback Separation */ 
 /* 数据表结构 `shang_name_apply`*/ 
 DROP TABLE IF EXISTS `shang_name_apply`;/* DBReback Separation */ 
 CREATE TABLE `shang_name_apply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `up_time` int(10) NOT NULL,
  `status` tinyint(3) unsigned NOT NULL,
  `idcard` varchar(20) NOT NULL,
  `deal_info` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;/* DBReback Separation */
 /* 插入数据 `shang_name_apply` */
 INSERT INTO `shang_name_apply` VALUES ('1','1','1460519122','1','370523199209251641','通过');/* DBReback Separation */
 /* 插入数据 `shang_name_apply` */
 INSERT INTO `shang_name_apply` VALUES ('2','2','1460519138','0','370323199110233020','');/* DBReback Separation */
 /* 插入数据 `shang_name_apply` */
 INSERT INTO `shang_name_apply` VALUES ('3','3','1460524269','0','372325199711153637','');/* DBReback Separation */
 /* 插入数据 `shang_name_apply` */
 INSERT INTO `shang_name_apply` VALUES ('4','4','1460526063','1','370323199303190321','w');/* DBReback Separation */
 /* 插入数据 `shang_name_apply` */
 INSERT INTO `shang_name_apply` VALUES ('5','5','1460526239','0','370323199408090325','');/* DBReback Separation */
 /* 插入数据 `shang_name_apply` */
 INSERT INTO `shang_name_apply` VALUES ('6','6','1460530071','0','1','');/* DBReback Separation */
 /* 插入数据 `shang_name_apply` */
 INSERT INTO `shang_name_apply` VALUES ('7','7','1460530148','1','142602199803142512','通过');/* DBReback Separation */
 /* 插入数据 `shang_name_apply` */
 INSERT INTO `shang_name_apply` VALUES ('8','8','1460530904','0','350583199503204312','');/* DBReback Separation */
 /* 插入数据 `shang_name_apply` */
 INSERT INTO `shang_name_apply` VALUES ('9','9','1460594841','0','2','');/* DBReback Separation */
 /* 插入数据 `shang_name_apply` */
 INSERT INTO `shang_name_apply` VALUES ('10','11','1460636648','0','372922199012104434','');/* DBReback Separation */
 /* 插入数据 `shang_name_apply` */
 INSERT INTO `shang_name_apply` VALUES ('11','13','1460946686','0','533032198711290321','');/* DBReback Separation */
 /* 插入数据 `shang_name_apply` */
 INSERT INTO `shang_name_apply` VALUES ('12','12','1460950152','0','123','');/* DBReback Separation */
 /* 插入数据 `shang_name_apply` */
 INSERT INTO `shang_name_apply` VALUES ('13','18','1461113289','0','370502199008206017','');/* DBReback Separation */ 
 /* 数据表结构 `shang_navigation`*/ 
 DROP TABLE IF EXISTS `shang_navigation`;/* DBReback Separation */ 
 CREATE TABLE `shang_navigation` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(40) NOT NULL,
  `type_url` varchar(200) NOT NULL,
  `type_keyword` varchar(200) NOT NULL,
  `type_info` varchar(400) NOT NULL,
  `type_content` text NOT NULL,
  `sort_order` int(11) NOT NULL,
  `type_set` tinyint(1) NOT NULL DEFAULT '0',
  `parent_id` smallint(6) NOT NULL,
  `type_nid` varchar(50) NOT NULL,
  `is_hiden` int(1) unsigned NOT NULL DEFAULT '0',
  `add_time` int(10) unsigned NOT NULL,
  `is_sys` tinyint(3) unsigned NOT NULL,
  `model` char(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=71 DEFAULT CHARSET=utf8;/* DBReback Separation */
 /* 插入数据 `shang_navigation` */
 INSERT INTO `shang_navigation` VALUES ('1','首页','/index.html','','','','10','2','0','indexs','0','1386156845','0','navigation');/* DBReback Separation */
 /* 插入数据 `shang_navigation` */
 INSERT INTO `shang_navigation` VALUES ('7','关于我们','/aboutus/intro.html','','','<div><img style=\"margin:10px;width:360px;height:256px;float:right;\" alt=\"\" src=\"/UF/Uploads/Article/20131125183424.gif\" /> 　　XXX网站隶属于XXXXXX管理有限公司。XXXXXX经工商局登记注册于2013年成立，注册资本1000万。位于XXXXXXXXXXXXXXXXXXXXXXXXX。是目前XX地区最安全、最专业的网络信贷理财平台之一</div><div>XXXX顺应全球电子商务未来发展的趋势，充分挖掘互联网金融市场潜力，通过建立一个安全、高效、诚信、互惠互助的网络借贷平台，让人们有机会相互帮助实现双赢的结果，帮助投资者及创业者更好地应对目前世界金融危机影响下的经济困境。</div><div>我们深信，依赖现代网络创新技术将民间借贷引入的模式，定会在快捷、便利、透明的体系下得到更健康的发展，并实现利益最大化！</div><div>XXXXX严格遵守国家相关法律法规，并敦促其会员在信息发布和使用过程中严格遵守相关法规。同时，我们也将竭尽所能，不断完善对网站平台的管理！</div><div>让我们携起手来，愿您的财富同xxxx一起成长！</div><div>愿您的创业梦想，在盛世下飞翔！</div><div>&nbsp;</div><div><div><strong><span style=\"font-size:24px;\">P2P平台介绍</span></strong></div><div>XXXXX采用创新的技术和理念，通过互联网建立一个安全、高效、诚信的平台，规范了个人之间的借贷行为，使之更加安全、有效。让人们有机会得到帮助，以及帮助到需要的朋友，同时得到更好的回报。</div><div>现实中朋友家人之间往往由于面子等问题不方便借款以及不好意思催款。XXXXX鼓励大家通过这一平台来帮助解决这些问题。另外，如果朋友家人正好没有钱帮您，而朋友的朋友很可能有闲钱，大家通过人人聚财这个平台就可传递这种信赖关系,扩大信赖的朋友圈子，解决自己的问题。</div><div>通过下面图片可以了解XXXXX如何工作的：需要钱的人发布信息，其他人以竞标方式参与，聚合大众的力量，以市场化的方式决定利率，以及监督借款行为。</div><div style=\"text-align:center;\">&nbsp;<img style=\"margin:0px;float:none;\" alt=\"\" src=\"/UF/Uploads/Article/20131125182918.gif\" /></div><div><strong><span style=\"font-size:24px;\">平成立目的台</span></strong></div><div>为有需要帮助的人伸出援手！为有能力的人实现资产增值！让我们成为成功路上最好的伙伴！&nbsp;</div><div>&nbsp;</div><div><strong><span style=\"font-size:24px;\">愿景</span></strong></div><div>打造一个全民参与、安全、高效、诚信、互惠互利的互联网金融服务平台</div><div>&nbsp;</div></div>','4','2','0','about','1','1386157108','0','navigation');/* DBReback Separation */
 /* 插入数据 `shang_navigation` */
 INSERT INTO `shang_navigation` VALUES ('9','我的账户','/member/index.html','','','','2','2','0','members','1','1386157201','0','navigation');/* DBReback Separation */
 /* 插入数据 `shang_navigation` */
 INSERT INTO `shang_navigation` VALUES ('48','联系我们','/aboutus/contact.html','','','','0','2','7','','0','1399189875','0','navigation');/* DBReback Separation */
 /* 插入数据 `shang_navigation` */
 INSERT INTO `shang_navigation` VALUES ('46','最新动态','/news/index.html','','','','8','2','7','','0','1399189538','0','navigation');/* DBReback Separation */
 /* 插入数据 `shang_navigation` */
 INSERT INTO `shang_navigation` VALUES ('47','招贤纳士','/aboutus/invite.html','','','','7','2','7','','0','1399189583','0','navigation');/* DBReback Separation */
 /* 插入数据 `shang_navigation` */
 INSERT INTO `shang_navigation` VALUES ('45','运营团队','/aboutus/team.html','','','','10','2','7','','0','1399189491','0','navigation');/* DBReback Separation */
 /* 插入数据 `shang_navigation` */
 INSERT INTO `shang_navigation` VALUES ('61','汽车众筹','/crowdinvest/index','','','','9','2','0','','0','1451267958','0','navigation');/* DBReback Separation */
 /* 插入数据 `shang_navigation` */
 INSERT INTO `shang_navigation` VALUES ('63','关于我们','/profile/index','','','','0','2','0','','0','1451878040','0','navigation');/* DBReback Separation */
 /* 插入数据 `shang_navigation` */
 INSERT INTO `shang_navigation` VALUES ('64','新手指引','/newguide/newguide','','','','2','2','0','','0','1451907061','0','navigation');/* DBReback Separation */
 /* 插入数据 `shang_navigation` */
 INSERT INTO `shang_navigation` VALUES ('65','新闻资讯','/gonggao/index.html','','','','6','2','0','','0','1452135178','0','navigation');/* DBReback Separation */
 /* 插入数据 `shang_navigation` */
 INSERT INTO `shang_navigation` VALUES ('67','注册指引','/newguide/register','','','','0','2','64','','0','1452048430','0','navigation');/* DBReback Separation */
 /* 插入数据 `shang_navigation` */
 INSERT INTO `shang_navigation` VALUES ('68','众筹指引','/newguide/newguide','','','','0','2','64','','0','1452048468','0','navigation');/* DBReback Separation */
 /* 插入数据 `shang_navigation` */
 INSERT INTO `shang_navigation` VALUES ('70','红包','/privilege/index','','','','5','2','0','','1','1458612737','0','navigation');/* DBReback Separation */ 
 /* 数据表结构 `shang_oauth`*/ 
 DROP TABLE IF EXISTS `shang_oauth`;/* DBReback Separation */ 
 CREATE TABLE `shang_oauth` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `is_bind` tinyint(30) NOT NULL DEFAULT '0',
  `site` varchar(30) NOT NULL DEFAULT '',
  `openid` varchar(255) NOT NULL DEFAULT '',
  `nickname` varchar(255) NOT NULL DEFAULT '',
  `avatar` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `logintimes` int(10) unsigned NOT NULL DEFAULT '0',
  `logintime` int(10) unsigned NOT NULL DEFAULT '0',
  `bind_uid` int(10) NOT NULL DEFAULT '0',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `site` (`site`,`openid`),
  KEY `uname` (`is_bind`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* DBReback Separation */ 
 /* 数据表结构 `shang_pay_bid_money`*/ 
 DROP TABLE IF EXISTS `shang_pay_bid_money`;/* DBReback Separation */ 
 CREATE TABLE `shang_pay_bid_money` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `pay_money` decimal(15,2) NOT NULL COMMENT '在投金额',
  `donate_money` decimal(15,2) NOT NULL COMMENT '赠送金额',
  `begin_time` int(20) DEFAULT NULL COMMENT '开始时间',
  `over_time` int(20) DEFAULT NULL COMMENT '结束时间',
  `count` int(10) NOT NULL COMMENT '使用天数',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;/* DBReback Separation */
 /* 插入数据 `shang_pay_bid_money` */
 INSERT INTO `shang_pay_bid_money` VALUES ('1','50000.00','500.00','1460443617','1461998819','10');/* DBReback Separation */
 /* 插入数据 `shang_pay_bid_money` */
 INSERT INTO `shang_pay_bid_money` VALUES ('2','10000.00','100.00','1460443645','1462171649','20');/* DBReback Separation */
 /* 插入数据 `shang_pay_bid_money` */
 INSERT INTO `shang_pay_bid_money` VALUES ('3','20000.00','200.00','1460443666','1461998961','15');/* DBReback Separation */ 
 /* 数据表结构 `shang_pay_bid_userlog`*/ 
 DROP TABLE IF EXISTS `shang_pay_bid_userlog`;/* DBReback Separation */ 
 CREATE TABLE `shang_pay_bid_userlog` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `pid` int(10) NOT NULL COMMENT '投标金id',
  `uid` int(10) NOT NULL COMMENT '用户id',
  `pay_money` decimal(15,2) NOT NULL COMMENT '使用条件（在投金额）',
  `bid_money` decimal(15,2) NOT NULL COMMENT '赠送金额',
  `add_time` int(20) NOT NULL COMMENT '领取时间',
  `end_time` int(20) DEFAULT NULL COMMENT '过期时间',
  `status` int(10) NOT NULL DEFAULT '0' COMMENT '1 可用  2 以用  3 过期 ',
  `borrow_id` int(10) DEFAULT NULL,
  `crowd_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;/* DBReback Separation */
 /* 插入数据 `shang_pay_bid_userlog` */
 INSERT INTO `shang_pay_bid_userlog` VALUES ('1','1','6','50000.00','500.00','1460530060','1461394060','2','7','2');/* DBReback Separation */
 /* 插入数据 `shang_pay_bid_userlog` */
 INSERT INTO `shang_pay_bid_userlog` VALUES ('4','2','4','10000.00','100.00','1460530125','1462258125','2','5','4');/* DBReback Separation */
 /* 插入数据 `shang_pay_bid_userlog` */
 INSERT INTO `shang_pay_bid_userlog` VALUES ('7','2','7','10000.00','100.00','1460530132','1462258132','1','','5');/* DBReback Separation */
 /* 插入数据 `shang_pay_bid_userlog` */
 INSERT INTO `shang_pay_bid_userlog` VALUES ('8','2','4','10000.00','100.00','1460530132','1462258132','1','','');/* DBReback Separation */
 /* 插入数据 `shang_pay_bid_userlog` */
 INSERT INTO `shang_pay_bid_userlog` VALUES ('9','1','1','50000.00','500.00','1460689257','1461553257','1','','');/* DBReback Separation */
 /* 插入数据 `shang_pay_bid_userlog` */
 INSERT INTO `shang_pay_bid_userlog` VALUES ('10','2','1','10000.00','100.00','1460689257','1462417257','2','44','21');/* DBReback Separation */
 /* 插入数据 `shang_pay_bid_userlog` */
 INSERT INTO `shang_pay_bid_userlog` VALUES ('11','3','1','20000.00','200.00','1460689257','1461985257','2','49','24');/* DBReback Separation */
 /* 插入数据 `shang_pay_bid_userlog` */
 INSERT INTO `shang_pay_bid_userlog` VALUES ('12','1','2','50000.00','500.00','1460773356','1461637356','1','','');/* DBReback Separation */
 /* 插入数据 `shang_pay_bid_userlog` */
 INSERT INTO `shang_pay_bid_userlog` VALUES ('13','2','2','10000.00','100.00','1460773356','1462501356','1','','');/* DBReback Separation */
 /* 插入数据 `shang_pay_bid_userlog` */
 INSERT INTO `shang_pay_bid_userlog` VALUES ('14','3','2','20000.00','200.00','1460773356','1462069356','1','','');/* DBReback Separation */
 /* 插入数据 `shang_pay_bid_userlog` */
 INSERT INTO `shang_pay_bid_userlog` VALUES ('15','1','7','50000.00','500.00','1460944621','1461808621','1','','');/* DBReback Separation */
 /* 插入数据 `shang_pay_bid_userlog` */
 INSERT INTO `shang_pay_bid_userlog` VALUES ('16','3','7','20000.00','200.00','1460944621','1462240621','1','','');/* DBReback Separation */
 /* 插入数据 `shang_pay_bid_userlog` */
 INSERT INTO `shang_pay_bid_userlog` VALUES ('17','1','13','50000.00','500.00','1460945813','1461809813','1','','');/* DBReback Separation */
 /* 插入数据 `shang_pay_bid_userlog` */
 INSERT INTO `shang_pay_bid_userlog` VALUES ('18','2','13','10000.00','100.00','1460945813','1462673813','1','','');/* DBReback Separation */
 /* 插入数据 `shang_pay_bid_userlog` */
 INSERT INTO `shang_pay_bid_userlog` VALUES ('19','3','13','20000.00','200.00','1460945813','1462241813','1','','');/* DBReback Separation */
 /* 插入数据 `shang_pay_bid_userlog` */
 INSERT INTO `shang_pay_bid_userlog` VALUES ('20','1','12','50000.00','500.00','1460949942','1461813942','1','','');/* DBReback Separation */
 /* 插入数据 `shang_pay_bid_userlog` */
 INSERT INTO `shang_pay_bid_userlog` VALUES ('21','2','12','10000.00','100.00','1460949942','1462677942','1','','');/* DBReback Separation */
 /* 插入数据 `shang_pay_bid_userlog` */
 INSERT INTO `shang_pay_bid_userlog` VALUES ('22','3','12','20000.00','200.00','1460949942','1462245942','1','','');/* DBReback Separation */
 /* 插入数据 `shang_pay_bid_userlog` */
 INSERT INTO `shang_pay_bid_userlog` VALUES ('23','1','9','50000.00','500.00','1460959596','1461823596','1','','');/* DBReback Separation */
 /* 插入数据 `shang_pay_bid_userlog` */
 INSERT INTO `shang_pay_bid_userlog` VALUES ('24','2','9','10000.00','100.00','1460959596','1462687596','1','','');/* DBReback Separation */
 /* 插入数据 `shang_pay_bid_userlog` */
 INSERT INTO `shang_pay_bid_userlog` VALUES ('25','3','9','20000.00','200.00','1460959596','1462255596','1','','');/* DBReback Separation */
 /* 插入数据 `shang_pay_bid_userlog` */
 INSERT INTO `shang_pay_bid_userlog` VALUES ('26','1','4','50000.00','500.00','1460964198','1461828198','1','','');/* DBReback Separation */
 /* 插入数据 `shang_pay_bid_userlog` */
 INSERT INTO `shang_pay_bid_userlog` VALUES ('27','3','4','20000.00','200.00','1460964199','1462260199','1','','');/* DBReback Separation */
 /* 插入数据 `shang_pay_bid_userlog` */
 INSERT INTO `shang_pay_bid_userlog` VALUES ('28','1','5','50000.00','500.00','1460966307','1461830307','1','','');/* DBReback Separation */
 /* 插入数据 `shang_pay_bid_userlog` */
 INSERT INTO `shang_pay_bid_userlog` VALUES ('29','2','5','10000.00','100.00','1460966307','1462694307','1','','');/* DBReback Separation */
 /* 插入数据 `shang_pay_bid_userlog` */
 INSERT INTO `shang_pay_bid_userlog` VALUES ('30','3','5','20000.00','200.00','1460966307','1462262307','1','','');/* DBReback Separation */
 /* 插入数据 `shang_pay_bid_userlog` */
 INSERT INTO `shang_pay_bid_userlog` VALUES ('31','1','18','50000.00','500.00','1461113274','1461977274','1','','');/* DBReback Separation */
 /* 插入数据 `shang_pay_bid_userlog` */
 INSERT INTO `shang_pay_bid_userlog` VALUES ('32','2','18','10000.00','100.00','1461113274','1462841274','1','','');/* DBReback Separation */
 /* 插入数据 `shang_pay_bid_userlog` */
 INSERT INTO `shang_pay_bid_userlog` VALUES ('33','3','18','20000.00','200.00','1461113274','1462409274','1','','');/* DBReback Separation */ 
 /* 数据表结构 `shang_qq`*/ 
 DROP TABLE IF EXISTS `shang_qq`;/* DBReback Separation */ 
 CREATE TABLE `shang_qq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `qq_num` varchar(50) NOT NULL,
  `qq_title` varchar(100) NOT NULL,
  `qq_order` int(2) NOT NULL,
  `is_show` int(1) NOT NULL DEFAULT '1',
  `type` int(1) NOT NULL COMMENT '0：qq号；1：qq群；2：客服电话',
  `tag` int(1) DEFAULT NULL COMMENT '此属性仅当type为0时有效,用作区分普通qq和企业营销qq,tag为1时表示普通qq,为2时为企业营销qq',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;/* DBReback Separation */ 
 /* 数据表结构 `shang_smslog`*/ 
 DROP TABLE IF EXISTS `shang_smslog`;/* DBReback Separation */ 
 CREATE TABLE `shang_smslog` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL,
  `admin_real_name` varchar(50) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_phone` varchar(50) NOT NULL,
  `title` varchar(20) NOT NULL,
  `content` varchar(500) NOT NULL,
  `add_time` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* DBReback Separation */ 
 /* 数据表结构 `shang_sys_tip`*/ 
 DROP TABLE IF EXISTS `shang_sys_tip`;/* DBReback Separation */ 
 CREATE TABLE `shang_sys_tip` (
  `uid` int(10) unsigned NOT NULL,
  `tipset` varchar(300) NOT NULL,
  PRIMARY KEY (`uid`),
  KEY `tipset` (`tipset`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* DBReback Separation */ 
 /* 数据表结构 `shang_today_reward`*/ 
 DROP TABLE IF EXISTS `shang_today_reward`;/* DBReback Separation */ 
 CREATE TABLE `shang_today_reward` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `borrow_id` int(10) unsigned NOT NULL,
  `reward_uid` int(10) unsigned NOT NULL,
  `invest_money` decimal(15,2) unsigned NOT NULL,
  `reward_money` decimal(10,2) unsigned NOT NULL,
  `reward_status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `add_time` int(10) NOT NULL,
  `deal_time` int(10) NOT NULL,
  `add_ip` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* DBReback Separation */ 
 /* 数据表结构 `shang_tqj_config`*/ 
 DROP TABLE IF EXISTS `shang_tqj_config`;/* DBReback Separation */ 
 CREATE TABLE `shang_tqj_config` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '特权金ID',
  `name` varchar(200) CHARACTER SET utf8 NOT NULL,
  `begin_time` int(20) NOT NULL COMMENT '开始时间',
  `over_time` int(20) NOT NULL COMMENT '结束时间',
  `money` decimal(15,2) NOT NULL COMMENT '特权金额',
  `rate` int(10) NOT NULL COMMENT '年利率',
  `biggest` int(10) NOT NULL COMMENT '最大领取次数',
  `status_approve` varchar(100) NOT NULL COMMENT '领取条件—认证',
  `status_due_money` decimal(15,2) DEFAULT NULL COMMENT '领取条件—待收本金',
  `isopen` int(10) NOT NULL COMMENT '是否开启',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;/* DBReback Separation */ 
 /* 数据表结构 `shang_tqj_log`*/ 
 DROP TABLE IF EXISTS `shang_tqj_log`;/* DBReback Separation */ 
 CREATE TABLE `shang_tqj_log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `tqj_id` int(10) NOT NULL,
  `title` varchar(200) CHARACTER SET utf8 NOT NULL,
  `earnings` decimal(15,2) NOT NULL COMMENT '收益',
  `get_time` int(10) NOT NULL COMMENT '领取时间',
  `tqj_money` decimal(15,2) NOT NULL COMMENT '特权金额',
  `tqj_rate` int(10) NOT NULL COMMENT '利率',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;/* DBReback Separation */ 
 /* 数据表结构 `shang_tqj_user`*/ 
 DROP TABLE IF EXISTS `shang_tqj_user`;/* DBReback Separation */ 
 CREATE TABLE `shang_tqj_user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tqj_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `get_time` int(10) NOT NULL COMMENT '领取时间',
  `tqj_money` decimal(15,2) NOT NULL COMMENT '特权金',
  `tqj_rate` int(10) NOT NULL COMMENT '利率',
  `status` int(10) NOT NULL COMMENT '状态 2-结束 1-进行中',
  `get_the_number` int(10) NOT NULL COMMENT '领取次数',
  `actual_the_number` int(10) DEFAULT '0' COMMENT '实际领取次数',
  `affect_money` decimal(15,2) NOT NULL COMMENT '用户每天的收益',
  `title` varchar(200) CHARACTER SET utf8 NOT NULL COMMENT '特权金标题',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;/* DBReback Separation */ 
 /* 数据表结构 `shang_transfer_borrow_info`*/ 
 DROP TABLE IF EXISTS `shang_transfer_borrow_info`;/* DBReback Separation */ 
 CREATE TABLE `shang_transfer_borrow_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `borrow_name` varchar(50) NOT NULL,
  `borrow_uid` int(11) NOT NULL,
  `borrow_duration` tinyint(3) unsigned NOT NULL,
  `borrow_money` decimal(15,2) NOT NULL,
  `borrow_interest` decimal(15,2) NOT NULL,
  `borrow_interest_rate` decimal(5,2) NOT NULL,
  `repayment_money` decimal(15,2) NOT NULL,
  `repayment_interest` decimal(15,2) NOT NULL,
  `repayment_type` tinyint(3) unsigned NOT NULL,
  `borrow_status` tinyint(3) unsigned NOT NULL,
  `transfer_out` int(10) NOT NULL,
  `transfer_back` int(10) unsigned NOT NULL,
  `transfer_total` int(10) NOT NULL,
  `per_transfer` int(10) NOT NULL,
  `add_time` int(10) NOT NULL,
  `deadline` int(10) unsigned NOT NULL,
  `add_ip` varchar(16) NOT NULL,
  `deal_user` int(10) unsigned NOT NULL,
  `deal_time` int(10) unsigned NOT NULL,
  `deal_info` varchar(500) NOT NULL,
  `borrow_info` varchar(2000) NOT NULL,
  `ensure_department` varchar(10) NOT NULL,
  `updata` varchar(2000) NOT NULL,
  `progress` tinyint(3) unsigned NOT NULL,
  `total` tinyint(4) NOT NULL,
  `is_show` tinyint(4) NOT NULL DEFAULT '1',
  `min_month` tinyint(4) NOT NULL DEFAULT '0',
  `reward_rate` float(5,2) NOT NULL DEFAULT '0.00' COMMENT '网站奖励(每月)',
  `increase_rate` float(5,2) NOT NULL DEFAULT '0.00' COMMENT '每月增加年利率',
  `borrow_fee` decimal(15,2) NOT NULL COMMENT '借款管理费',
  `level_can` tinyint(3) NOT NULL DEFAULT '0' COMMENT '0:允许普通会员投标；1:只允许VIP投标',
  `borrow_min` int(11) NOT NULL COMMENT '最低投标额度',
  `borrow_max` int(11) NOT NULL COMMENT '最高投标额度',
  `danbao` decimal(15,2) NOT NULL COMMENT '担保机构',
  `is_tuijian` tinyint(3) NOT NULL DEFAULT '0' COMMENT '是否设为推荐标 0表示不推荐；1表示推荐',
  `borrow_type` int(11) NOT NULL DEFAULT '6' COMMENT '刘',
  `b_img` varchar(200) NOT NULL COMMENT '流转标展示图片',
  `collect_day` int(10) NOT NULL COMMENT '允许投标的期限',
  `is_auto` tinyint(3) NOT NULL DEFAULT '0' COMMENT '是否允许自动投标 0：否；1：是。',
  `is_jijin` tinyint(3) NOT NULL DEFAULT '0' COMMENT '是否是定投宝 0：企业直投；1：定投宝',
  `online_time` int(10) NOT NULL DEFAULT '0' COMMENT '上线时间',
  `on_off` tinyint(2) NOT NULL COMMENT '是否显示 0：显示；1：不显示',
  PRIMARY KEY (`id`),
  KEY `borrow_uid` (`borrow_uid`,`borrow_status`) USING BTREE,
  KEY `borrow_status` (`is_show`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;/* DBReback Separation */ 
 /* 数据表结构 `shang_transfer_borrow_info_lock`*/ 
 DROP TABLE IF EXISTS `shang_transfer_borrow_info_lock`;/* DBReback Separation */ 
 CREATE TABLE `shang_transfer_borrow_info_lock` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `suo` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;/* DBReback Separation */ 
 /* 数据表结构 `shang_transfer_borrow_investor`*/ 
 DROP TABLE IF EXISTS `shang_transfer_borrow_investor`;/* DBReback Separation */ 
 CREATE TABLE `shang_transfer_borrow_investor` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `borrow_id` int(10) unsigned NOT NULL,
  `investor_uid` int(10) unsigned NOT NULL,
  `borrow_uid` int(11) NOT NULL,
  `investor_capital` decimal(15,2) NOT NULL,
  `investor_interest` decimal(15,2) NOT NULL,
  `invest_fee` decimal(15,2) NOT NULL,
  `receive_capital` decimal(15,2) NOT NULL,
  `receive_interest` decimal(15,2) NOT NULL,
  `add_time` int(10) unsigned NOT NULL,
  `deadline` int(10) unsigned NOT NULL,
  `is_auto` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `reward_money` decimal(15,2) NOT NULL,
  `transfer_num` int(10) unsigned NOT NULL DEFAULT '0',
  `transfer_month` int(10) unsigned NOT NULL DEFAULT '0',
  `back_time` int(10) unsigned NOT NULL,
  `final_interest_rate` float(5,2) NOT NULL DEFAULT '0.00',
  `is_jijin` tinyint(3) NOT NULL COMMENT '是否定投保：1：定投宝；0：直投',
  PRIMARY KEY (`id`),
  KEY `investor_uid` (`investor_uid`,`status`) USING BTREE,
  KEY `borrow_id` (`borrow_id`,`investor_uid`,`status`) USING BTREE,
  KEY `deadline` (`deadline`,`status`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;/* DBReback Separation */ 
 /* 数据表结构 `shang_transfer_detail`*/ 
 DROP TABLE IF EXISTS `shang_transfer_detail`;/* DBReback Separation */ 
 CREATE TABLE `shang_transfer_detail` (
  `borrow_id` int(10) unsigned NOT NULL,
  `borrow_breif` varchar(2000) NOT NULL,
  `borrow_capital` varchar(2000) NOT NULL,
  `borrow_use` varchar(2000) NOT NULL,
  `borrow_risk` varchar(2000) NOT NULL,
  `borrow_guarantee` varchar(50) NOT NULL,
  `borrow_img` varchar(2000) NOT NULL,
  PRIMARY KEY (`borrow_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* DBReback Separation */ 
 /* 数据表结构 `shang_transfer_investor_detail`*/ 
 DROP TABLE IF EXISTS `shang_transfer_investor_detail`;/* DBReback Separation */ 
 CREATE TABLE `shang_transfer_investor_detail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `repayment_time` int(10) unsigned NOT NULL DEFAULT '0',
  `borrow_id` int(10) unsigned NOT NULL,
  `invest_id` int(10) unsigned NOT NULL,
  `investor_uid` int(10) unsigned NOT NULL,
  `borrow_uid` int(10) unsigned NOT NULL,
  `capital` decimal(15,2) NOT NULL,
  `interest` decimal(15,2) NOT NULL,
  `interest_fee` decimal(15,2) NOT NULL,
  `status` tinyint(3) unsigned NOT NULL,
  `receive_interest` decimal(15,2) NOT NULL,
  `receive_capital` decimal(15,2) NOT NULL,
  `sort_order` tinyint(3) unsigned NOT NULL,
  `total` tinyint(3) unsigned NOT NULL,
  `deadline` int(10) unsigned NOT NULL,
  `expired_money` decimal(15,2) NOT NULL,
  `expired_days` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `call_fee` decimal(5,2) NOT NULL,
  `substitute_money` decimal(15,2) NOT NULL,
  `substitute_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `invest_id` (`invest_id`,`status`,`deadline`) USING BTREE,
  KEY `borrow_id` (`borrow_id`,`sort_order`,`investor_uid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;/* DBReback Separation */ 
 /* 数据表结构 `shang_user_email_log`*/ 
 DROP TABLE IF EXISTS `shang_user_email_log`;/* DBReback Separation */ 
 CREATE TABLE `shang_user_email_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `send_email` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `email_title` varchar(250) DEFAULT NULL,
  `status` int(2) DEFAULT NULL,
  `msg` text,
  `addtime` varchar(32) DEFAULT NULL,
  `addip` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;/* DBReback Separation */ 
 /* 数据表结构 `shang_verify`*/ 
 DROP TABLE IF EXISTS `shang_verify`;/* DBReback Separation */ 
 CREATE TABLE `shang_verify` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(32) NOT NULL,
  `send_time` int(10) NOT NULL,
  `ukey` int(10) unsigned NOT NULL,
  `type` tinyint(3) unsigned NOT NULL COMMENT '1:邮件激活验证',
  PRIMARY KEY (`id`),
  KEY `code` (`ukey`,`type`,`send_time`,`code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* DBReback Separation */ 
 /* 数据表结构 `shang_video_apply`*/ 
 DROP TABLE IF EXISTS `shang_video_apply`;/* DBReback Separation */ 
 CREATE TABLE `shang_video_apply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `add_time` int(10) unsigned NOT NULL,
  `add_ip` varchar(16) NOT NULL,
  `apply_status` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `credits` int(11) NOT NULL DEFAULT '0',
  `deal_user` int(10) unsigned NOT NULL,
  `deal_time` int(10) unsigned NOT NULL,
  `deal_info` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* DBReback Separation */ 
 /* 数据表结构 `shang_vip_apply`*/ 
 DROP TABLE IF EXISTS `shang_vip_apply`;/* DBReback Separation */ 
 CREATE TABLE `shang_vip_apply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `kfid` int(10) unsigned NOT NULL,
  `province_now` int(10) unsigned NOT NULL,
  `city_now` int(11) NOT NULL,
  `area_now` int(11) NOT NULL,
  `des` varchar(1000) NOT NULL,
  `add_time` int(10) NOT NULL,
  `status` tinyint(3) unsigned NOT NULL,
  `deal_time` int(10) unsigned NOT NULL,
  `deal_user` int(10) unsigned NOT NULL,
  `deal_info` varchar(200) NOT NULL COMMENT '处理意见',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* DBReback Separation */ 
 /* 数据表结构 `shang_wap_bank`*/ 
 DROP TABLE IF EXISTS `shang_wap_bank`;/* DBReback Separation */ 
 CREATE TABLE `shang_wap_bank` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `acc_no` varchar(20) NOT NULL,
  `id_card` varchar(30) NOT NULL,
  `id_holder` varchar(2000) CHARACTER SET utf8 NOT NULL,
  `mobile` varchar(30) DEFAULT NULL,
  `pay_code` varchar(10) NOT NULL,
  `uid` int(10) NOT NULL,
  `add_time` int(10) NOT NULL,
  `is_charge` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;/* DBReback Separation */ 
 /* 数据表结构 `shang_xbo_smslog`*/ 
 DROP TABLE IF EXISTS `shang_xbo_smslog`;/* DBReback Separation */ 
 CREATE TABLE `shang_xbo_smslog` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `to_user_id` mediumint(8) unsigned DEFAULT NULL,
  `to_user_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `to_phone` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `addtime` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `addtime_des` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `back_status` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `back_status_des` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `add_ip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=178 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('1','','','18266479979','您的验证码为476417【聚创铸鼎】','1460519088','2016-04-13=11-44-48','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('2','','','15553833036','您的验证码为844632【聚创铸鼎】','1460519099','2016-04-13=11-44-59','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('3','2','2','15553833036','15553833036您好，您2016-04-13 11:46:26线下充值的200000.00元已到帐【聚创铸鼎】','1460519198','2016-04-13=11-46-38','','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('4','','','15822623833','您的验证码为649980【聚创铸鼎】','1460524218','2016-04-13=13-10-18','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('5','','','15550533758','您的验证码为956185【聚创铸鼎】','1460526017','2016-04-13=13-40-17','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('6','','','13287319810','您的验证码为902251【聚创铸鼎】','1460526211','2016-04-13=13-43-31','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('7','4','4','15550533758','15550533758您好，您成功预约金额50000！【聚创铸鼎】','1460529703','2016-04-13=14-41-43','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('8','5','5','13287319810','13287319810您好，您成功预约金额80000！【聚创铸鼎】','1460529744','2016-04-13=14-42-24','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('9','1','1','18266479979','18266479979您好，您2016-04-13 14:42:14线下充值的1000000.00元已到帐【聚创铸鼎】','1460529745','2016-04-13=14-42-25','','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('10','5','5','13287319810','13287319810您好，您成功对1号众筹投资250000元【聚创铸鼎】','1460529776','2016-04-13=14-42-56','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('11','5','5','13287319810','13287319810您好，您投资的1号众筹筹资成功！正在出售中！【聚创铸鼎】','1460529795','2016-04-13=14-43-15','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('12','4','4','15550533758','15550533758您好，您投资的1号众筹筹资成功！正在出售中！【聚创铸鼎】','1460529795','2016-04-13=14-43-15','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('13','4','4','15550533758','15550533758您好，您成功对1号众筹投资250000元【聚创铸鼎】','1460529795','2016-04-13=14-43-15','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('14','5','5','13287319810','13287319810您好，您投资的1号众筹已发起投票！请尽快登录系统参与投票，到期未参与投票将自动默认赞成票【聚创铸鼎】','1460529814','2016-04-13=14-43-34','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('15','4','4','15550533758','15550533758您好，您投资的1号众筹已发起投票！请尽快登录系统参与投票，到期未参与投票将自动默认赞成票【聚创铸鼎】','1460529814','2016-04-13=14-43-34','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('16','5','5','13287319810','13287319810您好，您投资的1号众筹投票成功！投票金额550000.00,该众筹正在回款中！【聚创铸鼎】','1460529836','2016-04-13=14-43-56','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('17','4','4','15550533758','15550533758您好，您投资的1号众筹投票成功！投票金额550000.00,该众筹正在回款中！【聚创铸鼎】','1460529837','2016-04-13=14-43-57','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('18','4','4','15550533758','15550533758您好，您投资的1号众筹已回款！到账金额250000.00！【聚创铸鼎】','1460529852','2016-04-13=14-44-12','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('19','4','4','15550533758','15550533758您好，您投资的1号众筹已回款！到账金额5000！【聚创铸鼎】','1460529853','2016-04-13=14-44-13','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('20','5','5','13287319810','13287319810您好，您投资的1号众筹已回款！到账金额250000.00！【聚创铸鼎】','1460529853','2016-04-13=14-44-13','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('21','5','5','13287319810','13287319810您好，您投资的1号众筹已回款！到账金额5000！【聚创铸鼎】','1460529853','2016-04-13=14-44-13','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('22','4','4','15550533758','15550533758您好，您预约已成功投资第7期项目，成功投资金额为50000.00元【聚创铸鼎】','1460529901','2016-04-13=14-45-01','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('23','5','5','13287319810','13287319810您好，您预约已成功投资第7期项目，成功投资金额为40000元【聚创铸鼎】','1460529901','2016-04-13=14-45-01','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('24','','','17853738946','您的验证码为039904【聚创铸鼎】','1460530039','2016-04-13=14-47-19','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('25','','','13835715949','您的验证码为598738【聚创铸鼎】','1460530108','2016-04-13=14-48-28','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('26','4','4','15550533758','15550533758您好，您成功对4号众筹投资225000元【聚创铸鼎】','1460530156','2016-04-13=14-49-16','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('27','6','6','17853738946','17853738946您好，您2016-04-13 14:49:03线下充值的1000000.00元已到帐【聚创铸鼎】','1460530161','2016-04-13=14-49-21','','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('28','4','4','15550533758','15550533758您好，您投资的4号众筹筹资成功！正在出售中！【聚创铸鼎】','1460530172','2016-04-13=14-49-32','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('29','5','5','13287319810','13287319810您好，您投资的4号众筹筹资成功！正在出售中！【聚创铸鼎】','1460530172','2016-04-13=14-49-32','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('30','5','5','13287319810','13287319810您好，您成功对4号众筹投资225000元【聚创铸鼎】','1460530173','2016-04-13=14-49-33','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('31','6','6','17853738946','17853738946您好，您成功对2号众筹投资200000元【聚创铸鼎】','1460530226','2016-04-13=14-50-26','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('32','6','6','17853738946','17853738946您好，您成功对3号众筹投资100000元【聚创铸鼎】','1460530260','2016-04-13=14-51-00','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('33','4','4','15550533758','15550533758您好，您成功对7号众筹投资40000元【聚创铸鼎】','1460530297','2016-04-13=14-51-37','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('34','4','4','15550533758','15550533758您好，您投资的7号众筹筹资成功！正在出售中！【聚创铸鼎】','1460530339','2016-04-13=14-52-19','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('35','5','5','13287319810','13287319810您好，您投资的7号众筹筹资成功！正在出售中！【聚创铸鼎】','1460530339','2016-04-13=14-52-19','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('36','5','5','13287319810','13287319810您好，您成功对7号众筹投资50000元【聚创铸鼎】','1460530340','2016-04-13=14-52-20','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('37','1','1','18266479979','18266479979您好，您成功对2号众筹投资250000元【聚创铸鼎】','1460530385','2016-04-13=14-53-05','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('38','4','4','15550533758','15550533758您好，您投资的7号众筹已发起投票！请尽快登录系统参与投票，到期未参与投票将自动默认赞成票【聚创铸鼎】','1460530391','2016-04-13=14-53-11','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('39','5','5','13287319810','13287319810您好，您投资的7号众筹已发起投票！请尽快登录系统参与投票，到期未参与投票将自动默认赞成票【聚创铸鼎】','1460530392','2016-04-13=14-53-12','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('40','6','6','17853738946','17853738946您好，您投资的2号众筹筹资成功！正在出售中！【聚创铸鼎】','1460530413','2016-04-13=14-53-33','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('41','1','1','18266479979','18266479979您好，您投资的2号众筹筹资成功！正在出售中！【聚创铸鼎】','1460530413','2016-04-13=14-53-33','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('42','6','6','17853738946','17853738946您好，您成功对2号众筹投资50000元【聚创铸鼎】','1460530413','2016-04-13=14-53-33','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('43','6','6','17853738946','17853738946您好，您投资的2号众筹已发起投票！请尽快登录系统参与投票，到期未参与投票将自动默认赞成票【聚创铸鼎】','1460530430','2016-04-13=14-53-50','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('44','1','1','18266479979','18266479979您好，您投资的2号众筹已发起投票！请尽快登录系统参与投票，到期未参与投票将自动默认赞成票【聚创铸鼎】','1460530430','2016-04-13=14-53-50','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('45','6','6','17853738946','17853738946您好，您投资的2号众筹投票成功！投票金额550000.00,该众筹正在回款中！【聚创铸鼎】','1460530519','2016-04-13=14-55-19','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('46','1','1','18266479979','18266479979您好，您投资的2号众筹投票成功！投票金额550000.00,该众筹正在回款中！【聚创铸鼎】','1460530519','2016-04-13=14-55-19','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('47','','','13599260916','您的验证码为075284【聚创铸鼎】','1460530860','2016-04-13=15-01-00','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('48','7','7','13835715949','13835715949您好，您成功对5号众筹投资150000元【聚创铸鼎】','1460530872','2016-04-13=15-01-12','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('49','8','8','13599260916','13599260916您好，您成功对6号众筹投资350000元【聚创铸鼎】','1460531020','2016-04-13=15-03-40','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('50','4','4','15550533758','15550533758您好，您投资的7号众筹投票成功！投票金额200000.00,该众筹正在回款中！【聚创铸鼎】','1460592586','2016-04-14=08-09-46','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('51','5','5','13287319810','13287319810您好，您投资的7号众筹投票成功！投票金额200000.00,该众筹正在回款中！【聚创铸鼎】','1460592591','2016-04-14=08-09-51','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('52','','','18363280418','您的验证码为338201【聚创铸鼎】','1460594763','2016-04-14=08-46-03','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('53','9','9','18363280418','18363280418您好，您2016-04-14 08:47:59线下充值的1000000.00元已到帐【聚创铸鼎】','1460594890','2016-04-14=08-48-10','','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('54','4','4','15550533758','15550533758您好，您成功预约金额50000！【聚创铸鼎】','1460597030','2016-04-14=09-23-50','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('55','4','4','15550533758','15550533758您好，您投资的4号众筹已发起投票！请尽快登录系统参与投票，到期未参与投票将自动默认赞成票【聚创铸鼎】','1460597423','2016-04-14=09-30-23','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('56','5','5','13287319810','13287319810您好，您投资的4号众筹已发起投票！请尽快登录系统参与投票，到期未参与投票将自动默认赞成票【聚创铸鼎】','1460597423','2016-04-14=09-30-23','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('57','5','5','13287319810','13287319810您好，您预约已成功投资第8期项目，成功投资金额为20000元【聚创铸鼎】','1460597486','2016-04-14=09-31-26','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('58','4','4','15550533758','15550533758您好，您预约已成功投资第8期项目，成功投资金额为20000元【聚创铸鼎】','1460597486','2016-04-14=09-31-26','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('59','5','5','13287319810','13287319810您好，您投资的7号众筹已回款！到账金额50000.00！【聚创铸鼎】','1460597617','2016-04-14=09-33-37','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('60','5','5','13287319810','13287319810您好，您投资的7号众筹已回款！到账金额1111.2！【聚创铸鼎】','1460597617','2016-04-14=09-33-37','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('61','4','4','15550533758','15550533758您好，您投资的7号众筹已回款！到账金额40000.00！【聚创铸鼎】','1460597618','2016-04-14=09-33-38','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('62','4','4','15550533758','15550533758您好，您投资的7号众筹已回款！到账金额888.8！【聚创铸鼎】','1460597618','2016-04-14=09-33-38','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('63','5','5','13287319810','13287319810您好，您投资的7号众筹已回款！到账金额40000.00！【聚创铸鼎】','1460597618','2016-04-14=09-33-38','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('64','5','5','13287319810','13287319810您好，您投资的7号众筹已回款！到账金额888.8！【聚创铸鼎】','1460597619','2016-04-14=09-33-39','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('65','4','4','15550533758','15550533758您好，您投资的7号众筹已回款！到账金额50000.00！【聚创铸鼎】','1460597619','2016-04-14=09-33-39','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('66','4','4','15550533758','15550533758您好，您投资的7号众筹已回款！到账金额1111.2！【聚创铸鼎】','1460597619','2016-04-14=09-33-39','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('67','','','15553833032','您的验证码为061981【聚创铸鼎】','1460598455','2016-04-14=09-47-35','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('68','5','5','13287319810','13287319810您好，您预约已成功投资第9期项目，成功投资金额为8000元【聚创铸鼎】','1460599309','2016-04-14=10-01-49','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('69','4','4','15550533758','15550533758您好，您预约已成功投资第9期项目，成功投资金额为8000元【聚创铸鼎】','1460599309','2016-04-14=10-01-49','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('70','5','5','13287319810','13287319810您好，您预约已成功投资第10期项目，成功投资金额为2400元【聚创铸鼎】','1460599496','2016-04-14=10-04-56','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('71','4','4','15550533758','15550533758您好，您预约已成功投资第10期项目，成功投资金额为2400元【聚创铸鼎】','1460599496','2016-04-14=10-04-56','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('72','5','5','13287319810','13287319810您好，您预约已成功投资第11期项目，成功投资金额为3200元【聚创铸鼎】','1460599712','2016-04-14=10-08-32','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('73','4','4','15550533758','15550533758您好，您预约已成功投资第11期项目，成功投资金额为3200元【聚创铸鼎】','1460599712','2016-04-14=10-08-32','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('74','9','9','18363280418','18363280418您好，您成功对10号众筹投资30000元【聚创铸鼎】','1460600076','2016-04-14=10-14-36','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('75','5','5','13287319810','13287319810您好，您预约已成功投资第12期项目，成功投资金额为6400.00元【聚创铸鼎】','1460601642','2016-04-14=10-40-42','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('76','4','4','15550533758','15550533758您好，您预约已成功投资第12期项目，成功投资金额为8000元【聚创铸鼎】','1460601642','2016-04-14=10-40-42','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('77','4','4','15550533758','15550533758您好，您预约已成功投资第13期项目，成功投资金额为400元【聚创铸鼎】','1460601736','2016-04-14=10-42-16','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('78','4','4','15550533758','15550533758您好，您成功对10号众筹投资1200元【聚创铸鼎】','1460602544','2016-04-14=10-55-44','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('79','4','4','15550533758','15550533758您好，您成功对10号众筹投资23000元【聚创铸鼎】','1460602607','2016-04-14=10-56-47','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('80','9','9','18363280418','18363280418您好，您成功预约金额3000！【聚创铸鼎】','1460602873','2016-04-14=11-01-13','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('81','4','4','15550533758','15550533758您好，您预约已成功投资第14期项目，成功投资金额为3200元【聚创铸鼎】','1460603014','2016-04-14=11-03-34','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('82','4','4','15550533758','15550533758您好，您成功对14号众筹投资1500元【聚创铸鼎】','1460603211','2016-04-14=11-06-51','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('83','4','4','15550533758','15550533758您好，您成功对14号众筹投资1100元【聚创铸鼎】','1460603234','2016-04-14=11-07-14','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('84','4','4','15550533758','15550533758您好，您成功对14号众筹投资1200元【聚创铸鼎】','1460603287','2016-04-14=11-08-07','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('85','9','9','18363280418','18363280418您好，您成功对14号众筹投资11000元【聚创铸鼎】','1460603288','2016-04-14=11-08-08','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('86','4','4','15550533758','15550533758您好，您成功对14号众筹投资33000元【聚创铸鼎】','1460603308','2016-04-14=11-08-28','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('87','9','9','18363280418','18363280418您好，您成功对14号众筹投资1200元【聚创铸鼎】','1460603346','2016-04-14=11-09-06','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('88','5','5','13287319810','13287319810您好，您成功对14号众筹投资26000元【聚创铸鼎】','1460603389','2016-04-14=11-09-49','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('89','4','4','15550533758','15550533758您好，您投资的14号众筹筹资成功！正在出售中！【聚创铸鼎】','1460603463','2016-04-14=11-11-03','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('90','9','9','18363280418','18363280418您好，您投资的14号众筹筹资成功！正在出售中！【聚创铸鼎】','1460603463','2016-04-14=11-11-03','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('91','5','5','13287319810','13287319810您好，您投资的14号众筹筹资成功！正在出售中！【聚创铸鼎】','1460603463','2016-04-14=11-11-03','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('92','5','5','13287319810','13287319810您好，您成功对14号众筹投资1800元【聚创铸鼎】','1460603463','2016-04-14=11-11-03','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('93','4','4','15550533758','15550533758您好，您预约已成功投资第16期项目，成功投资金额为3600元【聚创铸鼎】','1460603774','2016-04-14=11-16-14','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('94','4','4','15550533758','15550533758您好，您预约已成功投资第17期项目，成功投资金额为1200.00元【聚创铸鼎】','1460604151','2016-04-14=11-22-31','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('95','4','4','15550533758','15550533758您好，您投资的4号众筹投票成功！投票金额500000.00,该众筹正在回款中！【聚创铸鼎】','1460619748','2016-04-14=15-42-28','1','漫道二次短信接口','127.0.0.1');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('96','5','5','13287319810','13287319810您好，您投资的4号众筹投票成功！投票金额500000.00,该众筹正在回款中！【聚创铸鼎】','1460619749','2016-04-14=15-42-29','1','漫道二次短信接口','127.0.0.1');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('97','6','6','17853738946','17853738946您好，您投资的2号众筹已回款！到账金额50000.00！【聚创铸鼎】','1460622338','2016-04-14=16-25-38','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('98','6','6','17853738946','17853738946您好，您投资的2号众筹已回款！到账金额1500！【聚创铸鼎】','1460622338','2016-04-14=16-25-38','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('99','1','1','18266479979','18266479979您好，您投资的2号众筹已回款！到账金额250000.00！【聚创铸鼎】','1460622339','2016-04-14=16-25-39','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('100','1','1','18266479979','18266479979您好，您投资的2号众筹已回款！到账金额7500！【聚创铸鼎】','1460622339','2016-04-14=16-25-39','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('101','6','6','17853738946','17853738946您好，您投资的2号众筹已回款！到账金额200000.00！【聚创铸鼎】','1460622339','2016-04-14=16-25-39','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('102','6','6','17853738946','17853738946您好，您投资的2号众筹已回款！到账金额6000！【聚创铸鼎】','1460622340','2016-04-14=16-25-40','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('103','','','15254618081','您的验证码为415922【聚创铸鼎】','1460635707','2016-04-14=20-08-27','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('104','9','9','18363280418','18363280418您好，您成功对16号众筹投资10000元【聚创铸鼎】','1460684643','2016-04-15=09-44-03','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('105','1','1','18266479979','18266479979您好，您成功对15号众筹投资1000元【聚创铸鼎】','1460684773','2016-04-15=09-46-13','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('106','','','18366965610','您的验证码为170492【聚创铸鼎】','1460776295','2016-04-16=11-11-35','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('107','1','1','18266479979','18266479979您好，您成功预约金额10000！【聚创铸鼎】','1460945394','2016-04-18=10-09-54','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('108','1','1','18266479979','18266479979您好，您预约已成功投资第21期项目，成功投资金额为2400元【聚创铸鼎】','1460945741','2016-04-18=10-15-41','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('109','','','18725214691','您的验证码为143558【聚创铸鼎】','1460945747','2016-04-18=10-15-47','1','漫道二次短信接口','182.247.67.144');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('110','','','15666666666','您的验证码为321345【聚创铸鼎】','1460946379','2016-04-18=10-26-19','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('111','','','18353360751','您的验证码为565289【聚创铸鼎】','1460946412','2016-04-18=10-26-52','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('112','','','18353360751','您的验证码为919837【聚创铸鼎】','1460946414','2016-04-18=10-26-54','1','漫道二次短信接口','111.206.36.141');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('113','','','18353360751','您的验证码为891656【聚创铸鼎】','1460946432','2016-04-18=10-27-12','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('114','13','13','18725214691','18725214691您好，您成功预约金额100000！【聚创铸鼎】','1460946758','2016-04-18=10-32-38','1','漫道二次短信接口','182.247.67.144');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('115','','','15666666666','您的验证码为767201【聚创铸鼎】','1460946770','2016-04-18=10-32-50','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('116','13','13','18725214691','18725214691您好，您成功对21号众筹投资30000元【聚创铸鼎】','1460946969','2016-04-18=10-36-09','1','漫道二次短信接口','182.247.67.144');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('117','','','15666666666','您的验证码为906653【聚创铸鼎】','1460947167','2016-04-18=10-39-27','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('118','','','15666666666','您的验证码为431783【聚创铸鼎】','1460947169','2016-04-18=10-39-29','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('119','','','15666666666','您的验证码为461027【聚创铸鼎】','1460947174','2016-04-18=10-39-34','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('120','','','15666666890','您的验证码为911026【聚创铸鼎】','1460947187','2016-04-18=10-39-47','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('121','','','15666666890','您的验证码为347148【聚创铸鼎】','1460947187','2016-04-18=10-39-47','1','漫道二次短信接口','61.135.165.7');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('122','','','18353360751','您的验证码为430465【聚创铸鼎】','1460947190','2016-04-18=10-39-50','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('123','','','15666472280','您的验证码为593352【聚创铸鼎】','1460947197','2016-04-18=10-39-57','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('124','','','15666472280','您的验证码为452609【聚创铸鼎】','1460947199','2016-04-18=10-39-59','1','漫道二次短信接口','61.135.169.10');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('125','','','15666472280','您的验证码为483614【聚创铸鼎】','1460947222','2016-04-18=10-40-22','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('126','','','15666472280','您的验证码为015339【聚创铸鼎】','1460947276','2016-04-18=10-41-16','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('127','','','15666472280','您的验证码为295079【聚创铸鼎】','1460947306','2016-04-18=10-41-46','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('128','','','15666472280','您的验证码为140863【聚创铸鼎】','1460947381','2016-04-18=10-43-01','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('129','','','18353360751','您的验证码为653380【聚创铸鼎】','1460947462','2016-04-18=10-44-22','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('130','','','18353360751','您的验证码为732291【聚创铸鼎】','1460947595','2016-04-18=10-46-35','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('131','','','18353360751','您的验证码为786516【聚创铸鼎】','1460949124','2016-04-18=11-12-04','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('132','','','18353360751','您的验证码为672704【聚创铸鼎】','1460949195','2016-04-18=11-13-15','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('133','','','18353360751','您的验证码为382445【聚创铸鼎】','1460949233','2016-04-18=11-13-53','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('134','','','18353360751','您的验证码为073806【聚创铸鼎】','1460949281','2016-04-18=11-14-41','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('135','1','1','18266479979','18266479979您好，您投资的21号众筹筹资成功！正在出售中！【聚创铸鼎】','1460949293','2016-04-18=11-14-53','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('136','13','13','18725214691','18725214691您好，您投资的21号众筹筹资成功！正在出售中！【聚创铸鼎】','1460949293','2016-04-18=11-14-53','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('137','1','1','18266479979','18266479979您好，您成功对21号众筹投资27600元【聚创铸鼎】','1460949293','2016-04-18=11-14-53','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('138','1','1','18266479979','18266479979您好，您投资的21号众筹已发起投票！请尽快登录系统参与投票，到期未参与投票将自动默认赞成票【聚创铸鼎】','1460949313','2016-04-18=11-15-13','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('139','13','13','18725214691','18725214691您好，您投资的21号众筹已发起投票！请尽快登录系统参与投票，到期未参与投票将自动默认赞成票【聚创铸鼎】','1460949314','2016-04-18=11-15-14','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('140','','','15666472280','您的验证码为499126【聚创铸鼎】','1460949403','2016-04-18=11-16-43','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('141','','','15666472280','您的验证码为547292【聚创铸鼎】','1460949481','2016-04-18=11-18-01','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('142','','','18353360751','您的验证码为109510【聚创铸鼎】','1460949796','2016-04-18=11-23-16','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('143','','','18353360751','您的验证码为870713【聚创铸鼎】','1460950052','2016-04-18=11-27-32','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('144','','','18353360751','您的验证码为787752【聚创铸鼎】','1460950166','2016-04-18=11-29-26','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('145','','','18353360751','您的验证码为284926【聚创铸鼎】','1460950189','2016-04-18=11-29-49','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('146','','','18353360751','您的验证码为187332【聚创铸鼎】','1460950202','2016-04-18=11-30-02','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('147','','','18353360751','您的验证码为569179【聚创铸鼎】','1460950506','2016-04-18=11-35-06','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('148','','','18353360752','您的验证码为839250【聚创铸鼎】','1460951351','2016-04-18=11-49-11','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('149','','','18353360753','您的验证码为132557【聚创铸鼎】','1460951496','2016-04-18=11-51-36','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('150','1','1','18266479979','18266479979您好，您预约已成功投资第22期项目，成功投资金额为3200元【聚创铸鼎】','1460958678','2016-04-18=13-51-18','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('151','13','13','18725214691','18725214691您好，您预约已成功投资第22期项目，成功投资金额为3200元【聚创铸鼎】','1460958679','2016-04-18=13-51-19','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('152','13','13','18725214691','18725214691您好，您预约已成功投资第23期项目，成功投资金额为4000元【聚创铸鼎】','1460959297','2016-04-18=14-01-37','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('153','1','1','18266479979','18266479979您好，您预约已成功投资第24期项目，成功投资金额为3200元【聚创铸鼎】','1460959509','2016-04-18=14-05-09','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('154','1','1','18266479979','18266479979您好，您成功对24号众筹投资36800元【聚创铸鼎】','1460959557','2016-04-18=14-05-57','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('155','1','1','18266479979','18266479979您好，您投资的24号众筹筹资成功！正在出售中！【聚创铸鼎】','1460959615','2016-04-18=14-06-55','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('156','9','9','18363280418','18363280418您好，您投资的24号众筹筹资成功！正在出售中！【聚创铸鼎】','1460959615','2016-04-18=14-06-55','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('157','9','9','18363280418','18363280418您好，您成功对24号众筹投资40000元【聚创铸鼎】','1460959615','2016-04-18=14-06-55','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('158','1','1','18266479979','18266479979您好，您投资的24号众筹已发起投票！请尽快登录系统参与投票，到期未参与投票将自动默认赞成票【聚创铸鼎】','1460959633','2016-04-18=14-07-13','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('159','9','9','18363280418','18363280418您好，您投资的24号众筹已发起投票！请尽快登录系统参与投票，到期未参与投票将自动默认赞成票【聚创铸鼎】','1460959634','2016-04-18=14-07-14','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('160','1','1','18266479979','18266479979您好，您投资的24号众筹投票成功！投票金额100000.00,该众筹正在回款中！【聚创铸鼎】','1460959656','2016-04-18=14-07-36','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('161','9','9','18363280418','18363280418您好，您投资的24号众筹投票成功！投票金额100000.00,该众筹正在回款中！【聚创铸鼎】','1460959656','2016-04-18=14-07-36','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('162','9','9','18363280418','18363280418您好，您投资的24号众筹已回款！到账金额40000.00！【聚创铸鼎】','1460959674','2016-04-18=14-07-54','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('163','9','9','18363280418','18363280418您好，您投资的24号众筹已回款！到账金额2000！【聚创铸鼎】','1460959674','2016-04-18=14-07-54','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('164','1','1','18266479979','18266479979您好，您投资的24号众筹已回款！到账金额36800.00！【聚创铸鼎】','1460959675','2016-04-18=14-07-55','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('165','1','1','18266479979','18266479979您好，您投资的24号众筹已回款！到账金额1840！【聚创铸鼎】','1460959675','2016-04-18=14-07-55','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('166','1','1','18266479979','18266479979您好，您投资的24号众筹已回款！到账金额3200.00！【聚创铸鼎】','1460959675','2016-04-18=14-07-55','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('167','1','1','18266479979','18266479979您好，您投资的24号众筹已回款！到账金额160！【聚创铸鼎】','1460959676','2016-04-18=14-07-56','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('168','','','18353360755','您的验证码为564203【聚创铸鼎】','1460961448','2016-04-18=14-37-28','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('169','4','4','15550533758','15550533758您好，您成功对23号众筹投资10000元【聚创铸鼎】','1460966143','2016-04-18=15-55-43','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('170','4','4','15550533758','15550533758您好，您成功对23号众筹投资40000元【聚创铸鼎】','1460966183','2016-04-18=15-56-23','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('171','13','13','18725214691','18725214691您好，您投资的23号众筹筹资成功！正在出售中！【聚创铸鼎】','1460966321','2016-04-18=15-58-41','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('172','4','4','15550533758','15550533758您好，您投资的23号众筹筹资成功！正在出售中！【聚创铸鼎】','1460966321','2016-04-18=15-58-41','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('173','5','5','13287319810','13287319810您好，您投资的23号众筹筹资成功！正在出售中！【聚创铸鼎】','1460966321','2016-04-18=15-58-41','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('174','5','5','13287319810','13287319810您好，您成功对23号众筹投资46000元【聚创铸鼎】','1460966322','2016-04-18=15-58-42','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('175','1','1','18266479979','18266479979您好，您投资的21号众筹投票成功！投票金额70000.00,该众筹正在回款中！【聚创铸鼎】','1461026860','2016-04-19=08-47-40','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('176','13','13','18725214691','18725214691您好，您投资的21号众筹投票成功！投票金额70000.00,该众筹正在回款中！【聚创铸鼎】','1461026861','2016-04-19=08-47-41','1','漫道二次短信接口','61.156.219.212');/* DBReback Separation */
 /* 插入数据 `shang_xbo_smslog` */
 INSERT INTO `shang_xbo_smslog` VALUES ('177','','','13706360071','您的验证码为258508【聚创铸鼎】','1461113246','2016-04-20=08-47-26','1','漫道二次短信接口','61.156.219.211');/* DBReback Separation */ 
 /* 数据表结构 `shang_yuebao_info`*/ 
 DROP TABLE IF EXISTS `shang_yuebao_info`;/* DBReback Separation */ 
 CREATE TABLE `shang_yuebao_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `money` decimal(15,2) DEFAULT NULL,
  `interest` decimal(15,2) DEFAULT NULL,
  `panny_interest` decimal(15,2) DEFAULT NULL,
  `add_time` int(10) DEFAULT '0',
  `status` int(10) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;/* DBReback Separation */
 /* 插入数据 `shang_yuebao_info` */
 INSERT INTO `shang_yuebao_info` VALUES ('20','3','50.00','0.01','0.01','1452085812','1');/* DBReback Separation */
 /* 插入数据 `shang_yuebao_info` */
 INSERT INTO `shang_yuebao_info` VALUES ('21','22','4000100.00','1333.36','0.01','1452088064','1');/* DBReback Separation */
 /* 插入数据 `shang_yuebao_info` */
 INSERT INTO `shang_yuebao_info` VALUES ('22','15','400000.00','0.00','0.00','1453704267','1');/* DBReback Separation */ 
 /* 数据表结构 `shang_yuebao_log`*/ 
 DROP TABLE IF EXISTS `shang_yuebao_log`;/* DBReback Separation */ 
 CREATE TABLE `shang_yuebao_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(10) DEFAULT '0',
  `type` int(10) DEFAULT NULL,
  `affect_money` decimal(15,2) DEFAULT NULL,
  `total_money` decimal(15,2) DEFAULT NULL,
  `info` varchar(80) CHARACTER SET utf8 DEFAULT NULL,
  `add_time` int(10) DEFAULT NULL,
  `ip` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=263 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;/* DBReback Separation */
 /* 插入数据 `shang_yuebao_log` */
 INSERT INTO `shang_yuebao_log` VALUES ('253','3','141','50.00','50.00','【3】号用户【15254618081】向聚创宝转入【50】元【2016-01-06 21:10:12】','1452085812','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_yuebao_log` */
 INSERT INTO `shang_yuebao_log` VALUES ('254','22','141','200.00','200.00','【22】号用户【18661395415】向聚财宝转入【200】元【2016-01-06 21:47:44】','1452088064','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_yuebao_log` */
 INSERT INTO `shang_yuebao_log` VALUES ('255','22','141','2000000.00','2000200.00','【22】号用户【18661395415】向聚财宝转入【2000000】元【2016-01-05 16:22:30】','1451982150','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_yuebao_log` */
 INSERT INTO `shang_yuebao_log` VALUES ('256','22','141','2000000.00','4000200.00','【22】号用户【18661395415】向聚财宝转入【2000000】元【2016-01-05 20:24:53】','1451996693','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_yuebao_log` */
 INSERT INTO `shang_yuebao_log` VALUES ('257','22','141','400.00','4000600.00','【22】号用户【18661395415】向聚财宝转入【400】元【2016-01-05 21:08:08】','1451999288','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_yuebao_log` */
 INSERT INTO `shang_yuebao_log` VALUES ('258','22','142','-500.00','4000100.00','【22】号用户【18661395415】从聚财宝转出【500】元【2016-01-06 10:06:48】','1452046008','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_yuebao_log` */
 INSERT INTO `shang_yuebao_log` VALUES ('259','3','143','0.01','50.00','【3】号用户【15254618081】收到利息【0.01】元【2016-01-08 09:24:50】','1452216290','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_yuebao_log` */
 INSERT INTO `shang_yuebao_log` VALUES ('260','22','143','1333.36','4000100.00','【22】号用户【18661395415】收到利息【1333.36】元【2016-01-08 09:24:50】','1452216290','61.156.219.211');/* DBReback Separation */
 /* 插入数据 `shang_yuebao_log` */
 INSERT INTO `shang_yuebao_log` VALUES ('261','15','141','200000.00','200000.00','【15】号用户【15306444443】向聚财宝转入【200000】元【2016-01-25 14:44:27】','1453704267','124.128.134.209');/* DBReback Separation */
 /* 插入数据 `shang_yuebao_log` */
 INSERT INTO `shang_yuebao_log` VALUES ('262','15','141','200000.00','400000.00','【15】号用户【15306444443】向聚财宝转入【200000】元【2016-01-25 14:44:27】','1453704267','124.128.134.209');/* DBReback Separation */