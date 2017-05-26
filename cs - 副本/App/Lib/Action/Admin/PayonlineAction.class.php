<?php
// 全局设置
class PayonlineAction extends ACommonAction
{
    /**
    +----------------------------------------------------------
    * 默认操作
    +----------------------------------------------------------
    */
    public function index()
    {
		$payconfig = FS("Dynamic/payconfig");

		$this->assign('guofubao_config',$payconfig['guofubao']);
		$this->assign('ips_config',$payconfig['ips']);
		$this->assign('chinabank_config',$payconfig['chinabank']);
		$this->assign('baofoo_config', $payconfig['baofoo']);
		$this->assign('shengpay_config', $payconfig['shengpay']);
		$this->assign('tenpay_config', $payconfig['tenpay']);
		$this->assign('ecpss_config', $payconfig['ecpss']);
		$this->assign('easypay_config', $payconfig['easypay']);
		$this->assign('cmpay_config', $payconfig['cmpay']);
		$this->assign('allinpay_config',$payconfig['allinpay']);
        $this->display();
    }
    public function save()
    {
		FS("payconfig",$_POST['pay'],"Dynamic/");
		alogs("Payonline",0,1,'执行了第三方支付接口参数的编辑操作！');//管理员操作日志
		$this->success("操作成功",__URL__."/index/");
    }
}
?>