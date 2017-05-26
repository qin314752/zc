<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/20
 * Time: 9:41
 */
class PaybidAction extends ACommonAction{

    //显示
    public function index(){

        $data['size']=15;
        $list = PayBidlist($data);
        for($i=0;$i<count($list['list']);$i++){
            if(time()<$list['list'][$i]['begin_time']){
                $list['list'][$i]['status']="未开始";
            }elseif(time()>$list['list'][$i]['over_time']){
                $list['list'][$i]['status']="已结束";
            }else{
                $list['list'][$i]['status']="进行中";
            }
            $list['list'][$i]['begin_time']=date("Y-m-d H:m:s",$list['list'][$i]['begin_time']);
            $list['list'][$i]['over_time']=date("Y-m-d H:m:s",$list['list'][$i]['over_time']);
        }
        $this->assign("count",$list['list']);
        $this->assign('pagebar',$list['page']);
        $this->display();
    }
    //修改
    public function amend(){
        if(!$_POST['id']) $this->error("非法修改","__URL__/index");
        //["xg"]=> string(1) "1" ["pay_money"]=> string(7) "1000.00" ["bid_money"]=> string(5) "20.00" ["count"]=> string(1) "6" ["start_time"]=> string(19) "2015-11-17 13:51:48" ["end_time"]=> string(19) "2015-11-24 13:51:50"
        $pay_bid=D('pay_bid_money');
        $pay_bid->startTrans();
        $arr['pay_money']=$_POST['pay_money'];
        $arr['donate_money']=$_POST['bid_money'];
        $arr['count']=$_POST['count'];
        $arr['begin_time']=strtotime($_POST['start_time']);
        $arr['over_time']=strtotime($_POST['end_time']);
        $id=M('pay_bid_money')->where('id='.$_POST['id'])->save($arr);
        if($id){
            $pay_bid->commit();
            $this->success("修改成功","__URL__/index");
        }else{
            $pay_bid->rollback();
            $this->error("修改失败","__URL__/index");
        }
        //$this->display();
    }
    //添加
    public function doadd(){
        //sleep(10);
        if($_GET['id']){
            $pay_bid=M('pay_bid_money')->find($_GET['id']);
            if($pay_bid){
                $this->assign("list",$pay_bid);
            }else{
                $this->error("查无此数据","__URL__/index");
            }
        }
//        elseif($_POST['start_time'] && $_POST['end_time']){
//
//            $start_time=strtotime($_POST['start_time']);
//            $data['start_time']=date('H:i:s',$start_time);
//            //$data['start_time']=strtotime($data['start_time']);
//
//            $end_time=strtotime($_POST['end_time']);
//            $data['end_time']=date('H:i:s',$end_time);
//            //$data['end_time']=strtotime($data['end_time']);
//
//            $data=json_encode($data);
//            file_put_contents('datatime.txt', $data);
//
//
//           $time_bid=json_encode($_POST);
//           file_put_contents('bidtime.txt', $time_bid);
//           $this->success("修改成功","__URL__/index");
//
//        }elseif($_GET['bid'] && $_GET['isopen']){
//            $b_arr['is_open']=$_GET['isopen'];
//            $b_id=M('pay_bid_money')->where('id='.$_GET['bid'])->save($b_arr);
//            //file_put_contents("sql.txt",M('pay_bid_money')->getListSql()) ;
//
//            if($b_id){
//                $this->success("修改成功","__URL__/index");
//            }else{
//                $this->error("修改失败","__URL__/index");
//            }
//        }
        else{
            $pay_bid=D('pay_bid_money');
            //["crowd_money"]=> string(4) "1000" ["start_time"]=> string(10) "2016-03-16" ["end_time"]=> string(10) "2016-03-31" ["donate_money"]=> string(4) "1000" ["deadline"]=> string(1) "5"
            $pay_bid->startTrans();
            $arr['pay_money']=$_POST['crowd_money'];
            $arr['donate_money']=$_POST['donate_money'];
            $arr['count']=$_POST['deadline'];
            $arr['begin_time']=strtotime($_POST['start_time']);
            $arr['over_time']=strtotime($_POST['end_time']);
            $id=M('pay_bid_money')->add($arr);
            if($id){
                $pay_bid->commit();
                $this->success("添加成功","__URL__/index");
            }else{
                $pay_bid->rollback();
                $this->error("添加失败","__URL__/index");
            }
        }
        $this->display();
    }
    //查询
    public function record(){
        if(!$_GET['id']) $this->error("非法查询","__URL__/index");
        $arr['pid']=$_GET['id'];
        $arr['status']=1;
        $arr['size']=20;
        $list = PayBidlist($arr);
        for($i=0;$i<count($list['list']);$i++){
            $list['list'][$i]['user_name']=M('members')->where('id='.$list['list'][$i]['uid'])->getField('user_name');
            $list['list'][$i]['add_time']=date("Y-m-d H:i:s", $list['list'][$i]['add_time']) ;
        }
        $this->assign("count",$list['list']);
        $this->assign('pagebar',$list['page']);
        $this->display();
    }
    public function addtqj(){

        $this->display();
    }
    public function delete(){
        $pay_bid=M('pay_bid_money')->find($_POST['id']);
        //echo M('pay_bid_money')->
        if($pay_bid){
            $bidtime=file_get_contents("bidtime.txt");
            $bid_time=json_decode($bidtime, true);
            echo strtotime($bid_time['start_time'])."-".time()."-".strtotime($bid_time['end_time'])  ;
        }else{
            echo 0;
        }


    }
}
?>