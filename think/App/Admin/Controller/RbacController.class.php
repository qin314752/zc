<?php
namespace Admin\Controller;
class RbacController extends CommonController {
   
   	//管理员列表
    public function admin_user_list()
    {
    	$data = M('user_login')->select();
    	$this->assign('data',$data);
    	$this->display();
    }

    public function admin_add()
    {   
    	$data = M('role')->getField('id,name');
    	$this->assign('data',$data);
    	$this->display();

    }
    //编辑管理员
    public function admin_edit()
    {
        $id = $_GET['id'];
        $data = M('user_login')->where("id=$id")->select();
        $role = M('role')->getField('id,name');
        $this->assign('role',$role);
        $this->assign('data',$data[0]);
        $this->display();
    }
    //更新数据
    public function admin_update()
    { 
        $data = I();
        if($data['password'] != $data['password2'] ){echo 2; die;}
            $data['password'] = md5($data['password']);
            unset($data['password2']);
            $data['last_add_time'] = time();
            $data['last_add_ip'] = get_client_ip();
            $a = M('user_login')->save($data);
            if(!empty($a)){echo 1;}
    }
    //管理员添加
    public function admin_add_user()
    {
    	$data = I();
        if($data['password'] != $data['password2'] ){echo 2; die;}
            $data['password'] = md5($data['password']);
            unset($data['password2']);
            $arr = explode('_',$data['user_role']);
            $data['user_role']=$arr[1];
	    	$data['last_add_time'] = time();
	    	$data['last_add_ip'] = get_client_ip();
            $user_id = M('user_login')->add($data);
            $str = M('role_user')->add(['user_id'=>$user_id,'role_id'=>$arr[0]]);
	    	if($str&&$user_id){echo 1;}
    }
    public function del(){
        $id = I('get.id');
        $user = M('user_login')->where("id=$id")->delete();
        $role_user = M('role_user')->where("user_id=$id")->delete();
        if($user&&$role_user){echo 0;}

    }
    public function suop()
    {
        $data = I();
        if($data['status']==0){
            $data['status']=1;
        }else{
            $data['status']=0;
        }
        $a = M('user_login')->save($data);
        if(!empty($a)){echo $data['status'];}

    }


//角色列表
    public function admin_role(){
    	$data = M('role')->getField('id,name,status');
    	$this->assign('data',$data);
        $this->display();
    }
    // 角色添加
    public function admin_role_add()
    {
    	$data = M('node')->select();
		$node = node_merge($data);
		$this->assign('node',$node);
		$this->display();
    }
    //角色-权限添加
    public function add_role()
    {
    	$arr = I();
    	$role_id = M('role')->add(['name'=>$arr['name'],'status'=>$arr['status']]);
		$data = array();
		foreach ($arr['access'] as $v) {
			$tmp = explode('_',$v);
			$data[] = array(
					'role_id'=>$role_id,
					'node_id'=>$tmp['0'],
					'level'=>$tmp['1'],
				); 
		}
		if(M('access')->addAll($data)){echo 1;}
    }

    public function del1()
    {
    	$id = I('get.id');
    	$role = M('role')->where(array('id'=>$id))->delete();
    	$access = M('access')->where(array('role_id'=>$id))->delete();
    	if($role&&$access){echo 1;}
    }
	//角色-权限修改
    public function admin_role_edit()
    {
		$role_id= I('get.id');
		$role_name= I('get.name');
		$access = M('access')->where(array('role_id'=>$role_id))->getField('node_id',true);
		$node = M('node')->select();
		$new_node = node_merge($node,$access);
		$this->assign('role_id',$role_id);
		$this->assign('role_name',$role_name);
		$this->assign('node',$new_node);
		$this->display();
    }

     //角色-权限修改后存入
    public function edit_role()
    {
    	$arr = I();
    	$role_id = $arr['role_id'];
    	if($arr['name'] != $arr['role_name']){
    		M('role')->where(array('id'=>$arr['role_id']))->save(array('name'=>$arr['name']));
    	} 
    	$del = M('access')->where("role_id=$role_id")->delete();
    	if($del){
    		$data = array();
			foreach ($arr['access'] as $v) {
				$tmp = explode('_',$v);
				$data[] = array(
						'role_id'=>$role_id,
						'node_id'=>$tmp['0'],
						'level'=>$tmp['1'],
					); 
			}
			if(M('access')->addAll($data)){echo 1;}
    	}
		
    }
 public function suop1()
    {
        $data = I();
        if($data['status']==0){
            $data['status']=1;
        }else{
            $data['status']=0;
        }
        $a = M('role')->save($data);
        if(!empty($a)){echo $data['status'];}

    }


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