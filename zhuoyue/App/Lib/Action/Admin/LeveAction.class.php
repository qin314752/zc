<?php
// 全局设置
class LeveAction extends ACommonAction
{
    public function index()
    {
		$leveconfig = FS("Dynamic/leveconfig");

		$this->assign('leve',$leveconfig);
        $this->display();
    }

    public function save()
    {
		alogs("Leve",0,1,'执行了信用积分等级数据编辑操作！');//管理员操作日志
		FS("leveconfig",$_POST['leve'],"Dynamic/");
		$this->success("操作成功",__URL__."/index/");
    }

    public function invest()
    {
        $leveconfig = FS("Dynamic/leveinvestconfig");

        $this->assign('leve',$leveconfig);
        $this->display();
    }

    public function investsave()
    {
		alogs("Leve",0,2,'执行了投资积分等级数据编辑操作！');//管理员操作日志
        FS("leveinvestconfig",$_POST['leve'],"Dynamic/");
        $this->success("操作成功",__URL__."/invest/");
    }
}
?>