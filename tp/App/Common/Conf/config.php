<?php
return array(
	//'配置项'=>'配置值'
	'URL_CASE_INSENSITIVE'=>true,//路由不区分大小写为true.忽略地址大小写
	'TMPL_TEMPLATE_SUFFIX'=>'.php', //模板文件的默认后缀的情况是 .php
	'VIEW_PATH'=>APP_PATH.'View/',
    'URL_MODEL'               =>     2,    //路由 URL重新
    // 'APP_GROUP_LIST'         =>     'Home,Admin',
    'URL_CASE_INSENSITIVE'  =>  true, 
    'APP_ROOT'=>str_replace(array('\\','Conf','config.php','//'), array('/','/','','/'), dirname(__FILE__)),//APP目录物理路径
    'APP_RUNTIME'=>str_replace(array('\\','app','Common','Conf','//'), array('/','/','/','/',''), dirname(__FILE__)),//APP目录物理路径app\Common\Conf




	'DB_FIELDS_CACHE'=>false,	// 关闭字段缓存
	'DB_TYPE'   => 'mysql', // 数据库类型
	'DB_HOST'   => 'localhost', // 服务器地址
	'DB_NAME'   => 'thinkphp', // 数据库名
	'DB_USER'   => 'root', // 用户名
	'DB_PWD'    => '', // 密码
	'DB_PORT'   => 3306, // 端口
	'DB_PREFIX' => 'zc_',// 数据库表前缀 
	'DB_CHARSET'=> 'utf8', // 字符集


);