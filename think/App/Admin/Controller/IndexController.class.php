<?php
namespace Admin\Controller;
class IndexController extends CommonController {
    public function index(){
        $this->display();
    }
    public function add() {
	$aa = new Mail();
	$aa->sendMail();
}
	
	public function del(){
		$a = Rmall(C('Runtime'));
		if($a)
		{
			echo 1;
		}

	}


}