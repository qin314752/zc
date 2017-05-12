<?php
/**
 * Created by PhpStorm.
 * User: cony
 * Date: 14-3-7
 * Time: 下午3:40
 */
namespace Home\Controller;
use Think\Controller;
class MemberController extends BaseController{


    public function index(){

        $this->display();
    }

//UC登录
    public function login(){
        $uc = new \Ucenter\Client\Client();
        $re = $uc->uc_user_login("zhangsan", "123456");//也可以$uc->ucUserLogin(),兼容驼峰式风格
        dump($re);
    }


    public function sign(){


    }

}