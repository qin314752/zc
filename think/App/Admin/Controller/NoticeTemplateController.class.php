<?php
namespace Admin\Controller;
use Org\Util\Mail;
class NoticeTemplateController extends CommonController {
    public function index(){
        $this->display();
    }
    public function add() {
	$aa = new Mail();
	$aa->sendMail();
	}
	public function data()
	{
		var_dump(I());
	}
}