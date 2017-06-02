<?php
namespace Admin\Controller;
class UserController extends CommonController { 
   	
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



}
 