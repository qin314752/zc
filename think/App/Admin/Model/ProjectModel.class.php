<?php 
	namespace Admin\Model;
	use Think\Model ;
	class ProjectModel extends Model
	{
		protected $tableName = 'project';
		 protected $_validate = array(
	     array('new_project_name','require','众筹项目名称未填写'), 
	     array('new_initiator','require','发起人未选择'),
	     array('crowd_dealer','require','发布车商未选择'), 
	     array('project_money','project_money','项目金额为100倍数','1','function'), 
	     array('new_project_time','require','开始时间未选择'), 
	     array('new_money_time','require','集资期限未选择'), 
	     array('money_size','require','众筹最小金额未选择'), 
	     array('time_longest','require','最长持有期限未选择'), 
	     array('profit_ratio','require','分红比例未填写'), 
	     array('premium_ratio','require','溢价回购利率未填写'), 
	     array('vehicle_model','require','车型未选择'), 
	   );

		
	}


 ?>