<?php
    /**
    * 手机版用户中心公共类
    */
    class MobileAction extends Action
    {
        public $uid;
        public $uname;
        public $glo;
        
        function _initialize(){
            if(session('u_id')){ 
                $this->uid = session('u_id');
                $this->uname = session('u_user_name');  
                $this->assign('uname', $this->uname);
                $this->assign('uid', $this->uid);
                $datag = get_global_setting();
                $this->glo = $datag;//供PHP里面使用
                $this->assign("glo",$datag);//公共参数
            }else{   
                $this->redirect('M/Pub/login');
            }
			
            $hetong = M('hetong')->field('name,dizhi,tel')->find();
			$this->assign("web",$hetong);
        }
    }
?>
