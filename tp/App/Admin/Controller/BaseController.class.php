<?php 
namespace Admin\Controller;
use Think\Controller;
Class BaseController extends Controller
{
	 public function log($centent)
    {
     
      $info['last_log'] = session('adminname').$centent;
      $info['last_log_time'] = time();
      $info['last_log_ip'] = get_client_ip();
      $info['admin_user_name'] = session('adminname');
      return  $ser = M('admin_user_log')->add($info);

    }
    public function pages($table,$p)
    {
        $user_log = M($table);
        $list = $user_log->order('id desc')->page($p.',10')->select();
        $this->assign('data',$list);
        $count = $user_log->count(); 
        $pages =ceil($count/10);
        $this->assign('count',$count);
        $this->assign('pages',$pages);
        $Page = new \Think\Page($count,10);
        $show = $Page->show();
        $this->assign('show',$show);  
        // var_dump($list);die;


    }
    
}


 ?>