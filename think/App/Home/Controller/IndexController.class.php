<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller 
{
    public function index()
	{
		echo time();
		// $this->display();
	}
	public function add()
	{
		$add = I();
		var_dump($add);
	}
}