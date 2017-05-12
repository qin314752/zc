<?php
namespace Admin\Controller;
use Think\Controller;
use Org\Util\Rbac;
use Org\Util\Mail;
class MailController extends CommonController {
    public function index(){
        $this->display();
    }
    public function add() {
	$aa = new Mail();
	$aa->sendMail();
}



}