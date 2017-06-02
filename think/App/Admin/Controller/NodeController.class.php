<?php
namespace Admin\Controller;
class NodeController extends CommonController {
	// 权限列表
    public function admin_node(){
    	$data = M('node')->select();
		$node = node_merge($data);
		// var_dump($node);die;
		$this->assign('node',$node);
        $this->display();
    }
   

//添加权限
    public  function admin_add_node()
	{
		
		$this->pid = I('pid',0,'intval');
		$this->level = I('level',1,'intval');
		switch ($this->level) {
			case 1:
				$this->type = '应用';
				break;
			case 2:
				$this->type = '控制器';
				break;
			case 3:
				$this->type = '方法';
				break;
			
			
		}
		$this->display();
	}
	//新权限写入
	public function add_node()
	{
		$data = I();
		if(M('node')->add($data)){echo 1;}
	}
}