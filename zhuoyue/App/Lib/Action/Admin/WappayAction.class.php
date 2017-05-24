<?php
// 全局设置
class WappayAction extends ACommonAction
{
    /**
    +----------------------------------------------------------
    * 默认操作
    +----------------------------------------------------------
    */
    public function index()
    {
	$payconfig = FS("Dynamic/wappayconfig");
        $this->assign('baofuwap_config',$payconfig['baofuwap']);
        $this->assign('kuaiqian_config',$payconfig['kuaiqian']);
        $this->assign('allinpaywap_config',$payconfig['allinpaywap']);
        $this->display();
    }
    public function save()
    {
        FS("wappayconfig",$_POST['wappay'],"Dynamic/");
        alogs("Wappay",0,1,'执行了第三方支付接口参数的编辑操作！');//管理员操作日志
        $this->success("操作成功",__URL__."/index/");
    }
}
?>