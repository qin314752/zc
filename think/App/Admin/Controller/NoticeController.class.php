<?php
namespace Admin\Controller;
use Org\Util\Mail;
class NoticeController extends CommonController {
    public function index(){
       $note = FS('Dynamic/note');
       $mandao  = residue($note['sn'],$note['pwd'],$note['provider']);
       $yimei = '0'; //亿美软通短信提供商 暂无数据   
       $this->assign('note',$note);
       $this->assign('mandao',$mandao);
       $this->assign('yimei',$yimei);
       $this->display();
    }
    public function data()
    {
        $arr = I();
        $str = FS('note',$arr,'Dynamic/');
        $this->redirect('index');
    }
    
    public function template()
    {
       $emailtxt = FS('Dynamic/emailtxt');
      $smstxt = FS('Dynamic/smstxt');
      $this->assign('emailtxt',$emailtxt);
      $this->assign('smstxt',$smstxt);
      $this->display();
    }

    public function template_data()
    {
      $add = I();
      $email = array('email_regsuccess'=>$add['email_regsuccess'],'email_safecode'=>$add['email_safecode'],'email_changephone'=>$add['email_changephone'],'email_getpass'=>$add['email_getpass'],'email_getpaypass'=>$add['email_getpaypass'],);
      unset($add['email_regsuccess'],$add['email_safecode'],$add['email_changephone'],$add['email_getpass'],$add['email_getpaypass']);
      FS('emailtxt',$email,'Dynamic/');
      FS('smstxt',$add,'Dynamic/');
      $this->redirect('template');
    }
    





















}


?>
