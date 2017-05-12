<?php 
namespace Admin\Controller;
use Think\Controller;
Class SystemController extends Controller
{
    public function index($i,$j,$p=1)
    {
        // var_dump($i);
        // var_dump($j);die;
        if($i != 6 ){$this->error('数据参数错误','home/index/index');}
        switch($j){
            case 1:
                $data = 1;
                break;
            case 2://管理员管理
                $this->admin_user_list($p);
                break;
            case 3://管理员权限管理
                $this->admin_list($p);
                break;
            case 4: //管理员操作日志
                $this->admin_user_log($p);
                break;
            case 5:
                $data = 1;
                break;
            case 6:
                $data = 1;
                break;
            case 7:
                $data = 1;
                break;
            default:
                $data = 1;
                break;
        }
    } 


    public  function add_admin($id)
    {
        switch($id){
            case 1;
              $data = 1;
            break;
            case 2;
            $this->admin_user_data();
            break;
            case 3;
              $this->display('Admin/System/add_admin');
            break;
            case 4;
              $data = 1;
            break;
            case 5;
              $data = 1;
            break;
            case 6;
              $data = 1;
            break;
            case 7;
              $data = 1;
            break;
            default:
                $data = 1;
                break;

        }
        
    }
    protected function admin_user_log($p)
    {
        A('Admin/Base')->pages('admin_user_log',$p);
        $this->display('Admin/System/user_log');
    }
    protected function admin_list($p)
    {
        A('Admin/Base')->pages('authority',$p);
        $this->display('Admin/System/admin_list');
    }
    public function authority()
    {
        $add = I();
        $src ='';
        foreach ($add['node'] as $key => $value) {
            $src .= $value.',';
        }
        $authority['authority_name'] = $add['authority_name'];
        $authority['group_node'] = $src;
        if(M('authority')->add($authority)){
                  if(!$log =A('Admin/Base')->log('添加'.$add['authority_name'].'权限组')){
                    $this->error('日志记录失败','/Home/login/admin');
                  }
                    $this->success('添加成功',U('/Admin/System/index?$i=6&$j=2'));
        }else{
            $this->error('添加失败',U('/Admin/System/index?$i=6&j=2'));
        }
    }

   
    
    protected function admin_user_list($p)
    {
        A('Admin/Base')->pages('user_login',$p);
        $this->display('Admin/System/admin_user_list');

    }
    protected function admin_user_data()
    {
       $data= M('authority')->select();
        $this->assign('authority',$data);
        $this->display('/Admin/System/admin_user_add');
    }
    public function admin_user_add()
    {
       $System = D("System");
        if (!$System->create())$this->error($System->getError(),U('/Admin/System/index?$i=6&j=2'));
        $info = I();
        if($info['status']==0){$info['status'] ='禁用';}else{$info['status'] ='启用';}
        $info['password'] = md5($info['password']);
        $info['last_add_time'] = time();
        $info['last_add_ip'] = get_client_ip();
        if(M('user_login')->add($info)){
            A('Admin/Base')->log('添加了新管理员'.$info['username']);
            $this->success('成功添加新管理员',U('/Admin/System/index?$i=6&j=2'));
        }else{
            $this->error('添加新管理员失败',U('/Admin/System/index?$i=6&j=2'));
        }
    

    }

    public function del($id,$username)
    {
        $src =M('user_login')->where('id='.$id)->delete();
        if($src){
            A('Admin/Base')->log('成功删除'.$username.'管理员');
            echo 1;
        }else{
            echo 0;
        }


    }
    public function del_authority($id,$username)
    {
        $src =M('authority')->where('id='.$id)->delete();
        if($src){
            A('Admin/Base')->log('成功删除'.$username.'权限组');
            echo 1;
        }else{
            echo 0;
        }
    }
    
    
    
    
    
    
}


 ?>