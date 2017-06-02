<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller 
{
    public function index()
	{
$this->show('尊敬的#UserName您好！<br>恭喜您注册成功,请点击下面的链接即可完成激活#LINK#<br><div style="text-align:right">客服中心</div>');
	}
	public function add()
	{
		$add = I();
		var_dump($add);
	}


}