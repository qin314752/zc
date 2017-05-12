<?php
namespace Admin\Controller;
use Think\Controller;
class EmptyController extends Controller
{    
    public function index()
    {
    $this->error('非法操作1','/Home/index/index');
       
    }
}