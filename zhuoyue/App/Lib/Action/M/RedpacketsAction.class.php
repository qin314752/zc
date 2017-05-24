<?php
/**
 +------------------------------------------------------------------------------
 * 微信端红包
 +------------------------------------------------------------------------------
 * @date     2016-3-30
 +------------------------------------------------------------------------------ 
 */
class RedpacketsAction extends MobileAction {
    
    /**
     +----------------------------------------------------------
     * 红包列表
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     */
    public function index() {
        
        $map['uid'] = $this->uid;
        $size = 10;
        if($this->isAjax()){
            $map['status'] = $_REQUEST['status']; // 红包状态，1：可用，2：已使用，3：已过期
        }else{
            $map['status'] = 1;
        }
        $order['id'] = 'DESC';
        $user_log = M('pay_bid_userlog');
               
        
        // 分页处理
        import("ORG.Util.Page");
        $count = $user_log->where($map)->count('id');
        $p = new Page($count,$size);
        $page = $p->ajax_show();
        $Lsql = "{$p->firstRow},{$p->listRows}";
        
        // 红包列表
        $list = $user_log->where($map)->limit($Lsql)->order($order)->select();
        $this->assign('list',$list);
        $this->assign('page',$page);
        $this->assign('status',$map['status']); 
        
        if($this->isAjax()){
            // 返回异步请求数据
            $data['html'] = $this->fetch('packet_list');
            $data['status'] = $map['status']; 
            exit(json_encode($data));
        }
        
        $this->display();
    }
    
}