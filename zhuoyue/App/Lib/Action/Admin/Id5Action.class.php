<?php
// 全局设置
class id5Action extends ACommonAction
{
    /**
    +----------------------------------------------------------
    * 默认操作 id5认证
    +----------------------------------------------------------
    */
    public function index()
    {
       $id5_config = FS("Dynamic/id5");
       $this->assign("id5_config",$id5_config);
       $this->display();
    }
    public function save()
    {
        FS("id5",$_POST['id5'],"Dynamic/");
        alogs("id5",0,1,'执行了身份验证接口参数的编辑操作！');//管理员操作日志
        $this->success("操作成功",__URL__."/index/");
    }
    
}
?>