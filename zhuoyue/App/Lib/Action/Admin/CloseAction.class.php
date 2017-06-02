<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/29
 * Time: 9:16
 */
class CloseAction extends ACommonAction {

    public function index(){
        var_dump($_POST);
        die;
        if($_POST['isopen']){
            $website=json_encode($_POST);
            file_put_contents("website.txt",$website);
            $this->success('修改成功！');
        }else{
            $web_close=json_decode(file_get_contents("website.txt"),true);
            if($web_close) $this->assign("web_close",$web_close);
            //var_dump($web_close);
            $this->display();
        }

    }
}
?>