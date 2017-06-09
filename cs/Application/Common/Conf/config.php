<?php

/*
 * 通用配置文件
 * Author：leo.li（281978297@qq.com）
 * Date:2013-02-01
 */
return array(
    /* 数据库设置 */
    'DB_TYPE' => 'mysql', // 数据库类型
    'SHOW_PAGE_TRACE' => FALSE,
    'TOKEN_ON' => true, // 是否开启令牌验证
    'TOKEN_NAME' => '__conist__', // 令牌验证的表单隐藏字段名称
    'TOKEN_TYPE' => 'md5', //令牌哈希验证规则 默认为MD5
    'TOKEN_RESET' => FALSE, //令牌验证出错后是否重置令牌 默认为true

    'LOAD_EXT_CONFIG' => 'systemConfig',

    'DEFAULT_C_LAYER'       =>  'Controller', // 默认的控制器层名称
    'MODULE_ALLOW_LIST'     =>  array('Home','Conist'), // 配置你原来的分组列表
    'DEFAULT_MODULE'        =>  'Home', // 配置你原来的默认分组
	'MODULE_DENY_LIST'      =>  array('Common','Runtime','Ucenter'),
	'URL_MODULE_MAP'    =>    array('conist'=>'admin'),	//模块映射


);
/*$config2 = WEB_ROOT . "Common/Conf/systemConfig.php";
$config2 = file_exists($config2) ? include "$config2" : array();

return array_merge($config1, $config2);*/