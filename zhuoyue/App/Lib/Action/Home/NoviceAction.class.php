<?php
/**
 * User: lex
 * createTime: 2015/10/27 14:27
 */
class NoviceAction extends HCommonAction{
    public function index()
    {
        $searchMapnew = array();
        $searchMapnew['b.money_collect']=0;
        $searchMapnew['b.borrow_status']=array("in",'2,4,6,7');
        $searchMapnew['b.is_new']=1;
        $parmnew=array();
        $parmnew['map'] = $searchMapnew;
        $parmnew['pagesize'] = 5;
        //$parmnew['limit'] = 5;

        $parmnew['orderby']="b.borrow_status ASC,b.id DESC";
        $listBorrowNew = getBorrowList($parmnew);
        foreach($listBorrowNew['list'] as $key=>$v){
            $project_pic=unserialize($listBorrowNew['list'][$key]['updata']);
            $listBorrowNew['list'][$key]['project_pic_thumb']=$project_pic[0]['img'];
        }
        $num=count($listBorrowNew['list']);
        $maxnum=$parmnew['pagesize'];
        if($num <= $maxnum){
            $is_show=0;
        }else{
            $is_show=1;
        }
        $this->assign("listBorrowNew",$listBorrowNew);
        $this->assign('is_show',$is_show);
        $this->display();
    }
}