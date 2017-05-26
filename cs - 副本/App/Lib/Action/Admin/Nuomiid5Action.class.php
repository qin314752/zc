<?php
/**
 * User: leixiao
 */
Class Nuomiid5Action extends ACommonAction{

    public function index()
    {
        $id5_config = FS("Dynamic/nuomiid5");
       // dump($id5_config);
        $this->assign("id5_config",$id5_config);
        $this->display();
    }
    public function save()
    {
        //dump($_POST['nuomiid5']);exit;
        FS("nuomiid5",$_POST['nuomiid5'],"Dynamic/");
        alogs("nuomiid5",0,1,'执行了nuomiid5身份验证接口参数的编辑操作！');//管理员操作日志
        $this->success("操作成功",__URL__."/index/");
    }
}