<?php
// 金糯米内核类库，2014-06-11_listam
class RepaymentAction extends MCommonAction {

    public function index(){
		$this->display();
    }

    public function summary(){
		$pre = C('DB_PREFIX');
		
		$this->assign("borrow_interest",$borrow_interest);
		$data['html'] = $this->fetch();
		exit(json_encode($data));
    }
}