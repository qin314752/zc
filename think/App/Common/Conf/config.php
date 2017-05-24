<?php
return array(
		//'配置项'=>'配置值'
	'TMPL_TEMPLATE_SUFFIX'=>'.php',
	/**
	 *----------------------------------------------------
	 * 数据库配置
	 *----------------------------------------------------
	 */
	'DB_FIELDS_CACHE'=>false,	// 关闭字段缓存
	'DB_TYPE'   => 'mysql', // 数据库类型
	'DB_HOST'   => 'localhost', // 服务器地址
	'DB_NAME'   => 'thinkphp', // 数据库名
	'DB_USER'   => 'root', // 用户名
	'DB_PWD'    => '', // 密码
	'DB_PORT'   => 3306, // 端口
	'DB_PREFIX' => 'zc_',// 数据库表前缀 
	'DB_CHARSET'=> 'utf8', // 字符集

	/**
	 *----------------------------------------------------
	 * RBAC权限配置
	 *----------------------------------------------------
	 */

	'USER_AUTH_ON' => true,      // 是否需要认证
	'RBAC_SUPERADMIN'=>'home',
	'ADMIN_AUTH_KEY'=>'superadmin',
	'USER_AUTH_TYPE' => '1',      // 认证类型
	'USER_AUTH_KEY' => 'authId',      // 认证识别号
	'REQUIRE_AUTH_MODULE' => '',      //  需要认证模块
	'NOT_AUTH_MODULE' => 'Index',      // 无需认证模块
	'USER_AUTH_GATEWAY' => __ROOT__,      // 认证网关
	// 'RBAC_DB_DSN' => '',       //  数据库连接DSN
	'RBAC_ROLE_TABLE' => 'zc_role',      // 角色表名称
	'RBAC_USER_TABLE' => 'zc_role_user',      // 用户表名称
	'RBAC_ACCESS_TABLE' => 'zc_access',      // 权限表名称
	'RBAC_NODE_TABLE' => 'zc_node',      // 权限表名称
	'RBAC_ERROR_PAGE' => '', //错误页面
	'GUEST_AUTH_ON' => '', //游客
	/**
	 * 提示页面
	 */
	'Runtime'   =>  __ROOT__.'Runtime',
	'TMPL_ACTION_ERROR' => './Public/error/error.php',
	'TMPL_ACTION_SUCCESS' => './Public/error/error.php',
	'WEB_ROOT'=>explode('App/Common',str_replace('\\', '/', dirname(__FILE__)),-1)[0],//网站根目录物理路径
);