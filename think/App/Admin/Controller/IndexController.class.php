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
	
	public function cache(){
		$cache = Rmall(C('Runtime'));
		if($cache){
			$this->success('已清除缓存',U('index'));
		}else{
			$this->error('清除缓存失败',U('index'));

		}

	}


}