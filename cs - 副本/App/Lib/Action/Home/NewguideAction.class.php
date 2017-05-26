<?php
/**
 * User: Administrator
 */
class NewguideAction extends HCommonAction{
    public function newguide(){
        $web_close=json_decode(file_get_contents("website.txt"),true);
        if($web_close['isopen'] == "2") $this->assign("web_close",$web_close);
        $this->display();
    }
    public function jucaibao(){
        $this->display();
    }
    public function register(){
        $this->display();
    }
}
