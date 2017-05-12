<?php 
	namespace Admin\Model;
	use Think\Model ;
	class LoginModel extends Model
	{
		protected $tableName = 'user_login';
		 protected $_validate = array(
	     array('verify_code','require','验证码必须有'), 
	     array('username','require','用户名必须有！'),
	     array('password','require','密码必须有！'), 
	     // array('username','','帐号名称已经存在！',1,'unique',1), // 验证用户名是否已经存在
	     // array('email','email','Email格式错误！',2), // 如果输入则验证Email格式是否正确
	     // array('password','6,30','密码长度不正确',0,'length'), // 验证密码是否在指定长度范围
	     // array('repassword','password','确认密码不一致',0,'confirm'), // 验证确认密码是否和密码一致     
	   );

	}


 ?>