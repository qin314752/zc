<?php
// 全局设置
class JubaoAction extends ACommonAction
{
    /**
    +----------------------------------------------------------
    * 默认操作
    +----------------------------------------------------------
    */
    public function index()
    {
		$field= true;
		$this->_list(D('Jubao'),$field,'','id','DESC');
        $this->display();
    }
	
}
?>