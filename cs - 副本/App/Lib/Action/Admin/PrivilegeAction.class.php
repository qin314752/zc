<?php
header("Content-type:text/html;charset=utf-8");
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/4/23
 * Time: 14:06
 */
class PrivilegeAction extends ACommonAction {
    public function index(){

        $data['size']=16;
        $list = getTqjlist($data);
//        foreach($list['list'] as $val){
//            $status=explode("-",$val['status_approve']);
//            var_dump($status);
//        }
        for($i=0;$i<count($list['list']);$i++){
            $list['list'][$i]['status_approve']=explode("-",$list['list'][$i]['status_approve']);
            for($j=0;$j<count($list['list'][$i]['status_approve']);$j++){
                if($list['list'][$i]['status_approve'][$j]==0){
                    $list['list'][$i]['shouji']="手机认证";
                }
                if($list['list'][$i]['status_approve'][$j]==1){
                    $list['list'][$i]['shiming']="实名认证";
                }
                if($list['list'][$i]['status_approve'][$j]==2){
                    $list['list'][$i]['youxiang']="邮箱认证";
                }
                if($list['list'][$i]['status_approve'][$j]==3){
                    $list['list'][$i]['daishou']="在投金额";
                }

            }
        }

        $this->assign("count",$list['list']);
        $this->assign('pagebar',$list['page']);
        $this->display();

    }
    //用户领取记录
    public function record(){
        if(isset($_GET['id'])){
            $tqj_id=$_GET['id'];
            $list=M('tqj_user')->where('tqj_id='.$tqj_id)->select();
            for($i=0;$i<count($list);$i++){
                $list[$i]['user_name']=M('members')->where('id='.$list[$i]['user_id'])->getField('user_name');
                $list[$i]['get_time']=date("Y-m-d H:i:s",$list[$i]['get_time']);
                $list[$i]['affect_money']=$list[$i]['affect_money']*$list[$i]['get_the_number'];
                if($list[$i]['get_the_number']>$list[$i]['actual_the_number']){
                    $list[$i]['status']="进行中";
                }else{
                    $list[$i]['status']="已结束";
                }

            }
            $this->assign("count",$list);
        }else{
            $data['test']=1;
            $data['size']=16;
            $list = getTqjlist($data);
            for($i=0;$i<count($list['list']);$i++){
                $list['list'][$i]['user_name']=M('members')->where('id='.$list['list'][$i]['user_id'])->getField('user_name');
                $list['list'][$i]['get_time']=date("Y-m-d H:i:s",$list['list'][$i]['get_time']);
                //$list['list'][$i]['affect_money']=round($list['list'][$i]['tqj_money']*$list['list'][$i]['tqj_rate']*0.01/365,2);//每天收益
                $list['list'][$i]['affect_money']=$list['list'][$i]['affect_money']*$list['list'][$i]['get_the_number'];
                if($list['list'][$i]['get_the_number']>$list['list'][$i]['actual_the_number']){
                    $list['list'][$i]['status']="进行中";
                }else{
                    $list['list'][$i]['status']="已结束";
                }
            }
            $this->assign("count",$list['list']);
            $this->assign('pagebar',$list['page']);
        }

        $this->display();

    }
    //添加-修改
    public function doadd(){
        if(isset($_POST['test'])){
            $ad_type=implode("-",$_POST['ad_type']);

           // var_dump($ad_type);exit;

            $data['name']=$_POST['title'];
            $data['money']=preg_replace('/^0+/','',$_POST['money']);
            $data['rate']=preg_replace('/^0+/','',$_POST['rate']);
            $data['begin_time']=strtotime($_POST['begin']);
            $data['over_time']=strtotime($_POST['over']." 23:59:59");
            $data['status_due_money']=preg_replace('/^0+/','',$_POST['principal']);
            $data['status_approve']=$ad_type;
            $data['biggest']=preg_replace('/^0+/','',$_POST['number']);
            $data['isopen']=$_POST['isopen'];
            $id['id']=$_POST['test'];

            $count = M('tqj_config')->where($id)->save($data);
            $this->success("修改成功","__URL__/index");
        }else{
            $ad_type=implode("-",$_POST['ad_type']);

            $data['name']=$_POST['title'];
            $data['money']=preg_replace('/^0+/','',$_POST['money']);
            $data['rate']=preg_replace('/^0+/','',$_POST['rate']);
            $data['begin_time']=strtotime($_POST['begin']);
            $data['over_time']=strtotime($_POST['over']." 23:59:59");
            $data['status_due_money']=preg_replace('/^0+/','',$_POST['principal']);
            $data['status_approve']=$ad_type;
            $data['biggest']=preg_replace('/^0+/','',$_POST['number']);
            $data['isopen']=$_POST['isopen'];
//        var_dump($data);
            $count = M('tqj_config')->add($data);
            $this->success("添加成功","__URL__/index");
//        $this->display('index');

        }

    }
    //修改
    public function amend(){
        $id=$_GET['id'];
        $data=M('tqj_config')->find($id);
        $data['begin_time']=date("Y-m-d",$data['begin_time']);
        $data['over_time']=date("Y-m-d",$data['over_time']);

        $status=explode("-",$data['status_approve']);
        for($i=0;$i<count($status);$i++){
            if($status[$i]==0){
                $data['shouji']=1;
            }

            if($status[$i]==1){
                $data['shiming']=1;
            }

            if($status[$i]==2){
                $data['youxiang']=1;
            }

            if($status[$i]==3){
                $data['daishou']=1;
            }
        }
        //var_dump($data);
        $this->assign('data',$data);
        $this->display();
    }

    //删除
    public function delete(){

        $id['id']=$_GET['id'];
        $count = M('tqj_config')->where($id)->delete();
        $this->success("删除成功");
    }


}