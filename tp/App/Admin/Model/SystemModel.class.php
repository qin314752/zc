<?php 
	namespace Admin\Model;
	use Think\Model ;

	class SystemModel extends Model
	{

		protected $tableName = 'user_login';
		 protected $_validate = array(
	     array('username','require','用户名必须有！'),
	     array('password','require','密码必须有！'), 
	     array('adminname','require','真实姓名必须有'), 
	     array('phone','require','电话必须有'), 
	     array('username','','用户名称已经存在！',1,'unique',1), // 验证用户名是否已经存在
	   );

	
}





?>