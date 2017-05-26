<?php
// 全局设置
class LoginonlineAction extends ACommonAction
{
    /**
    +----------------------------------------------------------
    * 默认操作
    +----------------------------------------------------------
    */
    public function index()
    {
		$loginconfig = FS("Dynamic/loginconfig");

		$this->assign('qq_config',$loginconfig['qq']);
		$this->assign('sina_config',$loginconfig['sina']);
		$this->assign('uc_config',$loginconfig['uc']);
		$this->assign('cookie_config',$loginconfig['cookie']);
        $this->display();
    }
    public function save()
    {	alogs("Loginonline",0,1,'执行了登录接口管理参数编辑操作！');//管理员操作日志
		FS("loginconfig",$_POST['login'],"Dynamic/");
		$this->success("操作成功",__URL__."/index/");
    }
}
?>