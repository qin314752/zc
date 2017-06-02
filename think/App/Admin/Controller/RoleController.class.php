<?php
namespace Admin\Controller;
class RoleController extends CommonController {
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

    public function del()
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
 public function suop()
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








}