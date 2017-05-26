<?php
    /**
    * App网贷系统接口文件
    * @author 刘克涛
    * @time 2015-07-15
    */
    class SdappAction extends HCommonAction
    {


        /**
         * App网贷接口  债权转账列表接口
         * @author 陈峰
         * @time 2015-08-21
         * @params:[callback:JSON_CALLBACK(默认),page,pagesize]
         * return:[result:list]
         */
        public function debt_list(){
            header("text/xml; charset = utf-8");
            $pre = C('DB_PREFIX');
            $suffix=C("URL_HTML_SUFFIX");
            $page = $_REQUEST['page']==""?1:$_REQUEST['page'];
            $pagesize = $_REQUEST['pagesize']==""?5:$_REQUEST['pagesize'];
            $callback = $_REQUEST['callback'];

            $map = array();
            $map['b.borrow_status']=array("in","2,4,6,7");
//            $map['d.status']=array("in","2,4");
            $map['d.status']=array("in","2");

            $field = "d.transfer_price, d.status, d.money, d.total_period,
                        d.period, d.valid, d.id as debt_id, i.id as invest_id,
                        i.investor_uid, i.deadline, b.id, b.borrow_name,
                        b.borrow_interest_rate,b.borrow_status,b.borrow_duration,
                        m.credits, m.user_name";
            $list = M("invest_detb d")
                ->join("{$pre}borrow_investor i ON d.invest_id=i.id")
                ->join("{$pre}borrow_info b ON i.borrow_id = b.id")
                ->join("{$pre}members m ON i.investor_uid=m.id")
                ->field($field)
                ->where($map)
                ->limit(($page-1)*$pagesize .','. $pagesize)
                ->order("d.status asc")
                ->select();

//            var_dump($list);

            if(!is_array($list)){
                $output = array('result'=>'nothing');
                exit($callback."(".json_encode($output).")");
            }
            $output = array('result'=>$list);
            exit($callback."(".json_encode($output).")");
        }

        public function debt_pre_investormoney(){

        }
        /**
         * App网贷接口  债权转账购买接口
         * @author 陈峰
         * @time 2015-08-21
         * @params:[callback:JSON_CALLBACK(默认),sUserName,sPassWord,invest_id,pin]
         * return:[result:list]
         */
        public function debt_investormoney(){
            header("text/xml; charset = utf-8");
            $this->debt_pre_investormoney();
            $pre = C('DB_PREFIX');
            $callback = $_REQUEST['callback'];

            $invest_id = intval($_REQUEST['invest_id']);
            $paypass = strval($_REQUEST['pin']);# 明文

            $data['id'] = $_SESSION["phone_id"];
            $user = M("members")->where($data)->find();

            D("DebtBehavior");
            $Debt = new DebtBehavior($user['id']);
            // 检测是否可以购买  密码是否正确，余额是否充足
            $result = $Debt->buy($paypass, $invest_id);

//                if($result === 'TRUE'){
            if($result === '购买成功'){
//                    ajaxmsg('购买成功');
                $output = array('result'=>"dlg_invest_success");// 购买成功
                exit($callback."(".json_encode($output).")");
//                }else if($result==='购买失败'){
//                    $output = array('result'=>"dlg_invest_error");// 购买失败
//                    exit($callback."(".json_encode($output).")");
            }else if($result==='不能购买自己发布的债权'){
                $output = array('result'=>"buy_self_debt_error");// 购买失败
                exit($callback."(".json_encode($output).")");
            }else if($result==='本债权转让已过期'){
                $output = array('result'=>"timeout_error");// 购买失败
                exit($callback."(".json_encode($output).")");
            }else if($result==='原借款人不能购买债权'){
                $output = array('result'=>"borrower_buy_error");// 购买失败
                exit($callback."(".json_encode($output).")");
            }else if($result==='支付密码错误'){
                $output = array('result'=>"pin_error");// 购买失败
                exit($callback."(".json_encode($output).")");
            }else if($result==='您的账户余额不足'){
                $output = array('result'=>" insufficient_balance");// 购买失败
                exit($callback."(".json_encode($output).")");
            }else{
//                    ajaxmsg($result, 1);
                $output = array('result'=>"dlg_invest_error");//失败
                exit($callback."(".json_encode($output).")");
            }

        }

        /**
         * App网贷接口  登陆接口
         * @author 刘克涛
         * @time 2015-07-15
         * @params:[callback:JSON_CALLBACK(默认),sUserName,sPassWord]
         * return:[result:dlg_ok(登陆成功)/dlg_ban(用户被锁定)/dlg_error(登录失败)]
         */
        public function phone_register(){

        }
        function is_login($re){
            $info = $re;
            header("text/xml; charset = utf-8");

            (false!==strpos($info['sUserName'],"@"))?$data['user_email'] = text($info['sUserName']):$data['user_name'] = text($info['sUserName']);
            $vo = M('members')->field('id,user_name,user_email,user_pass,is_ban')->where($data)->find();
            if($vo['is_ban']==1){
                return "dlg_ban";
            }

            $data['user_pass'] = MD5($info['sPassWord']);
            $vm = M('members')->field('id,user_name')->where($data)->find();

            if(is_array($vm)){
                foreach($vm as $key=>$v){
                    session("phone_{$key}",$v);
                }
                $up['uid'] = $vo['id'];
                $up['add_time'] = time();
                $up['ip'] = get_client_ip();
                M('member_login')->add($up);
                return "dlg_ok";
            }else{
                return "dlg_error";
            }
        }
        public function login(){

            $callback = $_REQUEST['callback'];
            $result = $this->is_login($_REQUEST);
            $output = array('result'=>$result);
            exit($callback."(".json_encode($output).")");
        }
        public function logout(){
            $callback = $_REQUEST['callback'];
            $vo = array("id","user_name");
            foreach($vo as $v){
                session("phone_{$v}",NULL);
            }
            $output = array('result'=>"dlg_ok");
            exit($callback."(".json_encode($output).")");
        }
        /**
         * App判断是否登陆
         */
        public function is_phone_login(){
            $callback = $_REQUEST['callback'];
            $result = $_SESSION["phone_id"]==""?"dlg_out":"dlg_ok";
            $output = array('result'=>$result);
            exit($callback."(".json_encode($output).")");
        }



        /**
         * App网贷接口  散标列表接口
         * @author 刘克涛
         * @time 2015-07-15
         * @params:[callback:JSON_CALLBACK(默认),page,pagesize]
         * return:[result:list]
         */
        public function borrowlist(){
            $pre = C('DB_PREFIX');
            $suffix=C("URL_HTML_SUFFIX");
            $page = $_REQUEST['page']==""?1:$_REQUEST['page'];
            $pagesize = $_REQUEST['pagesize']==""?5:$_REQUEST['pagesize'];
            $callback = $_REQUEST['callback'];
            $map=array();
            if(isset($_REQUEST['repayment_type']))
            {
                $map['b.repayment_type'] = $_REQUEST['repayment_type'];
            }
            if(isset($_REQUEST['borrow_type']))
            {
                $map['b.borrow_type'] = $_REQUEST['borrow_type'];
            }
            if(isset($_REQUEST['borrow_status']))
            {
                $map['b.borrow_status'] = $_REQUEST['borrow_status'];
            }
            if(!isset($_REQUEST['repayment_type'])&&!isset($_REQUEST['borrow_status'])&&!isset($_REQUEST['borrow_type'])){
                $map['b.borrow_status'] = array("in",array(2,4,6,7));
            }

            $Bconfig = require C("APP_ROOT")."Conf/borrow_config.php";
            $page_start = $pagesize*($page-1);
            $page_end = $pagesize;
            $limit = "$page_start,$page_end";
            header("text/xml; charset = utf-8");
            $field = "b.id,b.borrow_name,b.borrow_type,
            b.borrow_times,b.borrow_status,b.borrow_money,
            b.repayment_type,b.borrow_interest_rate,b.borrow_duration,
            b.collect_time,b.add_time,b.province,b.has_borrow,b.has_vouch,
            b.city,b.area,b.reward_type,b.reward_num,b.password,m.user_name,
            m.id as uid,m.credits,m.customer_name,b.is_tuijian,b.deadline,
            b.danbao,b.borrow_info,b.risk_control";

            $list = M("borrow_info b")->field($field)->join("{$pre}members m ON m.id=b.borrow_uid")->where($map)->order("b.borrow_status ASC,b.id DESC")->limit($limit)->select();
            $areaList = getArea();
            foreach($list as $key=>$v){
                $list[$key]["borrow_type"] = $Bconfig['BORROW_TYPE'][$v['borrow_type']];
                $list[$key]['location'] = $areaList[$v['province']].$areaList[$v['city']];

                if($v['danbao']!=0 ){
                    $danbao = M('article')->field("id,title")->where("type_id =7 and id ={$v['danbao']}")->find();
                    $list[$key]['danbao']=$danbao['title'];//担保机构
                }else{
                    $list[$key]['danbao']='暂无担保机构';//担保机构
                }
                if($v['repayment_type']==1){
                    $list[$key]['borrow_duration']=$v['borrow_duration']."天";
                }else{
                    $list[$key]['borrow_duration']=$v['borrow_duration']."个月";
                }

            }
            if(!is_array($list)){
                $output = array('result'=>'nothing');
                exit($callback."(".json_encode($output).")");
            }
            $output = array('result'=>$list);
            exit($callback."(".json_encode($output).")");

        }
        /**
         * App网贷接口  优计划列表接口
         * @author 刘克涛
         * @time 2015-07-15
         * @params:[callback:JSON_CALLBACK(默认),page,pagesize]
         * return:[result:list]
         */
        public function transferlist(){
            $pre = C('DB_PREFIX');
            $suffix=C("URL_HTML_SUFFIX");
            $page = $_REQUEST['page']==""?1:$_REQUEST['page'];
            $pagesize = $_REQUEST['pagesize']==""?5:$_REQUEST['pagesize'];
            $callback = $_REQUEST['callback'];
            $page_start = $pagesize*($page-1);
            $page_end = $pagesize;
            $limit = "$page_start,$page_end";
            header("text/xml; charset = utf-8");
            if(isset($_REQUEST['borrow_status']))
            {
                $map['b.borrow_status'] = $_REQUEST['borrow_status'];
            }
            $map['b.is_jijin']=1;
            $map['b.on_off']=1;
            $map['b.online_time']=array("lt",time()+300);
            $orderby = "b.is_show desc,b.borrow_status ASC,b.borrow_duration ASC,b.online_time desc";

            $field = "b.id,b.borrow_name,b.borrow_status,b.borrow_money,
            b.transfer_out,b.transfer_back,b.transfer_total,b.per_transfer,
            b.borrow_interest_rate,
            b.borrow_duration,b.deadline,
            b.is_show,m.province,m.city,m.area,m.user_name,m.id as uid,
            m.credits,m.customer_name,b.b_img,
            b.danbao,b.online_time";

            $list = M("transfer_borrow_info b")->field($field)->join("{$pre}members m ON m.id=b.borrow_uid")->where($map)->order($orderby)->limit($limit)->select();
            $areaList = getarea();

            foreach($list as $key => $v)
            {
                $list[$key]['location'] = $areaList[$v['province']].$areaList[$v['city']];

                $list[$key]['investornum'] = M('transfer_borrow_investor')->where("borrow_id={$v['id']}")->count("id");
                if($v['danbao']!=0 ){
                    $list[$key]['danbaoid'] = intval($v['danbao']);
                    $danbao = M('article')->field('id,title')->where("type_id=7 and id={$v['danbao']}")->find();
                    $list[$key]['danbao']=$danbao['title'];//担保机构
                }else{
                    $list[$key]['danbao']='暂无担保机构';//担保机构
                }
                //收益率
                $monthData['month_times'] = 12;
                $monthData['account'] = $v['borrow_money'];
                $monthData['year_apr'] = $v['borrow_interest_rate'];
                $monthData['type'] = "all";
                $repay_detail = CompoundMonth($monthData);
                if($v['borrow_duration']==1){
                    $list[$key]['shouyi'] = $v['borrow_interest_rate'];
                }else{
                    $list[$key]['shouyi'] = $repay_detail['shouyi'];
                }
                //收益率结束
            }


            if(!is_array($list)){
                $output = array('result'=>'nothing');
                exit($callback."(".json_encode($output).")");
            }
            $output = array('result'=>$list);
            exit($callback."(".json_encode($output).")");

        }
        /**
         * App网贷接口  散标详情
         * @author 刘克涛
         * @time 2015-07-15
         * @params:[callback:JSON_CALLBACK(默认),id]
         * return:[result:list](包括当前用户的可用资金情况)
         */
        public function borrow_detail(){
            $pre = C('DB_PREFIX');
            $callback = $_REQUEST['callback'];
            $id = $_REQUEST['id'];
            $Bconfig = require C("APP_ROOT")."Conf/borrow_config.php";
            $list = M("borrow_info bi")
                ->field('bi.*,ac.title,ac.id as aid,ms.phone_status,ms.id_status,ms.email_status,na.up_time')
                ->join("{$pre}article ac on ac.id= bi.danbao")
                ->join("{$pre}members_status ms ON ms.uid=bi.borrow_uid")
                ->join("{$pre}name_apply na ON na.uid = ms.uid")
                ->where('bi.id='.$id)->find();
            if($list['repayment_type']==1){
                $list['borrow_duration'].="天";
            }else{
                $list['borrow_duration'].="个月";
            }
            $list["borrow_type"] = $Bconfig['BORROW_TYPE'][$list['borrow_type']];
            $list["borrow_use"] =$this->gloconf['BORROW_USE'][$list['borrow_use']];


            if(!is_array($list)){
                $output = array('result'=>'dlg_error');
                exit($callback."(".json_encode($output).")");
            }
            $output = array('result'=>$list);
            exit($callback."(".json_encode($output).")");
        }
        /**
         * App网贷接口  优计划详情
         * @author 刘克涛
         * @time 2015-07-15
         * @params:[callback:JSON_CALLBACK(默认),id]
         * return:[result:list]
         */
        public function transfer_detail(){
            $pre = C('DB_PREFIX');
            $callback = $_REQUEST['callback'];
            $id = $_REQUEST['id'];

            $field="b.*,d.borrow_breif,d.borrow_img";
            $list = M("transfer_borrow_info b")
                ->field($field)
                ->join("{$pre}transfer_detail d ON d.borrow_id=b.id")
                ->find($id);
            if(!is_array($list)){
                $output = array('result'=>'dlg_error');
                exit($callback."(".json_encode($output).")");
            }
            if($list['is_jijin'] != 1){
                $output = array('result'=>'dlg_illegal');
                exit($callback."(".json_encode($output).")");
            }
            $list['updata'] = unserialize($list['updata']);
            if($list['danbao']!=0 ){
                $danbao = M('article')->field('id,title')->where("type_id=7 and id={$list['danbao']}")->find();
                $list['danbao']=$danbao['title'];//担保机构
                $list['danbaoid'] = $danbao['id'];
            }else{
                $list['danbao']='暂无担保机构';//担保机构
            }
            $monthData['month_times'] = 12;
            $monthData['account'] = 100000;
            $monthData['year_apr'] = $list['borrow_interest_rate'];
            $monthData['type'] = "all";
            $repay_detail = CompoundMonth($monthData);
            $list['Compound'] = $repay_detail['shouyi'];
            $output = array('result'=>$list);
            exit($callback."(".json_encode($output).")");

        }
        /**
         * App网贷接口  散标加入记录
         * @author 刘克涛
         * @time 2015-07-15
         * @params:[callback:JSON_CALLBACK(默认)]
         * return:[result:list]
         */
        public function borrow_investor(){
            $pre = C('DB_PREFIX');
            $callback = $_REQUEST['callback'];
            $id = $_REQUEST['id'];
            $pagesize = $_REQUEST['pagesize']==""?10:$_REQUEST['pagesize'];
            $page = $_REQUEST['page']==""?1:$_REQUEST['page'];
            $page_start = $pagesize*($page-1);
            $page_end = $pagesize;
            $limit = "$page_start,$page_end";
            if($pagesize=="all"){
                $count = M("borrow_investor")->where("borrow_id={$id}")->count("id");
                $limit  = "0,$count";
            }

            header("text/xml; charset = utf-8");
            $field = "b.investor_capital, b.add_time, b.is_auto, m.user_name";
            $list = M("borrow_investor as b")
                ->join("{$pre}members as m on  b.investor_uid = m.id")
                ->join("{$pre}borrow_info as i on  b.borrow_id = i.id")
                ->field($field)
                ->where('b.borrow_id='.$id)
                ->order('b.id')
                ->limit($limit)
                ->select();
            foreach ($list as $k=>$v) {
                $list[$k]['user_name'] = hidecard($v['user_name'],5);
                $list[$k]['is_auto'] = $v['is_auto']?'自动':'手动';

            }
            $output = array('result'=>$list);
            exit($callback."(".json_encode($output).")");

        }



        /**
         * App网贷接口  优选理财加入记录
         * @author 刘克涛
         * @time 2015-07-15
         * @params:[callback:JSON_CALLBACK(默认)]
         * return:[result:list]
         */
        public function transfer_investor(){
            $pre = C('DB_PREFIX');
            $callback = $_REQUEST['callback'];
            $id = $_REQUEST['id'];
            $pagesize = $_REQUEST['pagesize']==""?10:$_REQUEST['pagesize'];
            $page = $_REQUEST['page']==""?1:$_REQUEST['page'];
            $page_start = $pagesize*($page-1);
            $page_end = $pagesize;
            $limit = "$page_start,$page_end";
            if($pagesize=="all"){
                $count = M("transfer_borrow_investor")->where("borrow_id={$id}")->count("id");
                $limit  = "0,$count";
            }

            header("text/xml; charset = utf-8");
            $field = " b.investor_capital,b.add_time, b.is_auto, m.user_name";
            $list = M("transfer_borrow_investor as b")
                ->join("{$pre}members as m on  b.investor_uid = m.id")
                ->join("{$pre}transfer_borrow_info as i on  b.borrow_id = i.id")
                ->field($field)
                ->where('b.borrow_id='.$id)
                ->order('b.id desc')
                ->limit($limit)
                ->select();

            foreach ($list as $k=>$v) {
                $list[$k]['user_name'] = hidecard($v['user_name'],5);
                $list[$k]['is_auto'] = $v['is_auto']?'自动':'手动';

            }
            $output = array('result'=>$list);
            exit($callback."(".json_encode($output).")");

        }

        /**
         * App网贷接口  用户基本信息
         * @author 刘克涛
         * @time 2015-07-15
         * @params:[callback:JSON_CALLBACK(默认)]
         * return:[result:list]
         */
        public function memberinfo(){
            $callback = $_REQUEST['callback'];

            $pre = C('DB_PREFIX');
            $data['m.id'] = $_SESSION["phone_id"];
            $field="m.id,m.user_name,m.user_phone,m.user_leve,
                    ms.phone_status,m.pin_pass,ms.id_status,
                    ms.email_status,m.credits,m.integral,
                    mm.account_money,mm.back_money,mm.money_freeze,mm.money_collect,
                    mi.idcard,mi.real_name";
            $vm = M('members m')
                ->join("{$pre}member_money mm on mm.uid = m.id")
                ->join("{$pre}members_status ms on ms.uid = m.id")
                ->join("{$pre}member_info mi on mi.uid = m.id")
                ->field($field)
                ->where($data)
                ->find();
            $bank_count = M('member_banks')->where("uid= {$vm['id']}")->count();
            $list['id'] = $vm['id'];
            $list['user_name'] = $vm['user_name'];
            $list['user_name_hide'] = hidecard($vm['user_name'],5);
            $list['user_phone'] = $vm['user_phone'];
            $list['vip'] = $vm['user_leve'];
            $list['phone_status'] =$vm['phone_status'];
            $list['pin_status'] = $vm['pin_pass']==""?0:1;
            $list['id_status'] = $vm['id_status'];
            $list['bank_status'] =$bank_count==0?0:1;
            $list['idcard'] = $vm['idcard']==""?"empty":hidecard($vm['idcard'],1);
            $list['real_name'] = hidecard($vm['real_name'],4)==""?"empty":hidecard($vm['real_name'],4);
            $list['email_status'] = $vm['email_status'];
            $list['credits_name'] = $this->getLeveIco($vm['credits']);
            $list['integral_name'] = $this->getInvestLeveIco($vm['integral']);
            $list['balance_money'] = $vm['account_money']+$vm['back_money'];
            $list['total_money'] = $list['balance_money']+$vm['money_collect']+$vm['money_freeze'];
            $list['freeze_money'] = $vm['money_freeze'];
            $borrow_collect = M("investor_detail")
                ->where("investor_uid={$vm['id']} and status in (4,6,7)")
                ->sum("interest-interest_fee");
            $transfer_collect = M("transfer_investor_detail")
                ->where("investor_uid={$vm['id']} and status = 7")
                ->sum("interest-interest_fee");
            $list['collect_interest'] = $borrow_collect+$transfer_collect;
            $output = array('result'=>$list);
            exit($callback."(".json_encode($output).")");


        }

        /**
         * 用户投资列表
         */
        public function userinvestor(){
            $callback = $_REQUEST['callback'];

            $pre = C('DB_PREFIX');
            $data['id'] = $_SESSION["phone_id"];
            $user = M("members")->where($data)->find();
            $data_['investor_uid'] = $user['id'];
            $data_['status'] = array("in",array(4,6,7));
            //散标的未还list
            $b_list = M("borrow_investor")->where($data_)->select();
            //u计划未还的list
            $t_list = M("transfer_borrow_investor")
                ->where("status = 1 and investor_uid = {$user['id']}")
                ->select();
            //散标的已还list
            $b_list_ = M("borrow_investor")->where("status = 5 and investor_uid = {$user['id']}")->select();
            //u计划已还的list
            $t_list_ = M("transfer_borrow_investor")
                ->where("status = 2 and investor_uid = {$user['id']}")
                ->select();
            $list= array("b_list"=>$b_list,"t_list"=>$t_list,"b_list_"=>$b_list_,"t_list_"=>$t_list_);
            $output = array('result'=>$list);
            exit($callback."(".json_encode($output).")");

        }
        /**
         * 可用银行列表
         */
        public function banklist(){
            $callback = $_REQUEST['callback'];
            $borrowconfig=  require C("ROOT_URL")."Dynamic/borrowconfig.php";
            $output = array('result'=>$borrowconfig['BANK_NAME']);
            exit($callback."(".json_encode($output).")");
        }

        /**
         * 绑卡接口
         */
        public function bindbank(){
            $callback = $_REQUEST['callback'];

            $pre = C('DB_PREFIX');
            $data['id'] = $_SESSION["phone_id"];
            $user = M("members")->where($data)->find();

            $bank_info = M('member_banks')->field("uid, bank_num")->where("uid= {$user['id']}")->find();
            !$bank_info['uid'] && $data['uid'] = $user['id'] ;
            $data['bank_num'] = text($_REQUEST['banknum']);
            $data['bank_name'] = text($_REQUEST['bankname']);
            $data['bank_address'] = text($_REQUEST['bankaddress']);
            $data['bank_province'] = text($_REQUEST['province']);
            $data['bank_city'] = text($_REQUEST['cityname']);
            $data['add_ip'] = get_client_ip();
            $data['add_time'] = time();

            if($bank_info['uid']){
                /////////////////////新增银行卡修改锁定开关 开始 20130510 fans///////////////////////////
                if(intval($this->glo['edit_bank'])!= 1 && $bank_info['bank_num']){
                    $output = array('result'=>$bank_info);
                    exit($callback."(".json_encode($output).")");

                }
            }else{
                $newid = M('member_banks')->add($data);
                if($newid){
                    MTip('chk2',$user['id']);
                    $output = array('result'=>"binding_success");
                    exit($callback."(".json_encode($output).")");
                }else{
                    $output = array('result'=>"binding_error");
                    exit($callback."(".json_encode($output).")");
                }
            }


        }

        /**
         * 省市区对应关系
         */
        public function getarea(){
            $callback = $_REQUEST['callback'];
            $list = M("area")->select();
            $output = array('result'=>$list);
            exit($callback."(".json_encode($output).")");

        }

        /**
         * 站内信
         */
        public function inner_msg(){
            $callback = $_REQUEST['callback'];

            $pre = C('DB_PREFIX');
            $data['id'] = $_SESSION["phone_id"];
            $user = M("members")->where($data)->find();

            $list = M("inner_msg")->where("uid = {$user['id']}")->select();
            if(is_array($list)){
                $output = array('result'=>$list);
                exit($callback."(".json_encode($output).")");
            }
            else{
                $output = array('result'=>"nothing");
                exit($callback."(".json_encode($output).")");
            }


        }

        /**
         *
         */
        public function investormoney(){
            $callback = $_REQUEST['callback'];

            $money = $_REQUEST['money'];
            $borrow_id = $_REQUEST['borrow_id'];
            $pin = md5($_REQUEST['pin']);
            $binfo = M("borrow_info")->where("id={$borrow_id}")->find();
            $pre = C('DB_PREFIX');
            $data['id'] = $_SESSION["phone_id"];
            $user = M("members")->where($data)->find();
            $money_info = getMinfo($user['id'],'m.pin_pass,mm.account_money,mm.back_money,mm.money_collect');
            $pin_pass = $money_info['pin_pass'];
            if($user['id'] == $binfo['borrow_uid']){
                $output = array('result'=>"cannot_invest_own");//不能投自己的标
                exit($callback."(".json_encode($output).")");
            }
            if(!empty($binfo['password'])){
                if(empty($_REQUEST['borrow_pass'])){
                    $output = array('result'=>"borrow_pwd_empty");//此标是定向标，必须验证投标密码
                    exit($callback."(".json_encode($output).")");
                }
                else if($binfo['password']<>md5($_REQUEST['borrow_pass'])){
                    $output = array('result'=>"borrow_pwd_error");//投标密码不正确
                    exit($callback."(".json_encode($output).")");
                }
            }
            if($pin<>$pin_pass){
                $output = array('result'=>"pin_error");//支付密码错误
                exit($callback."(".json_encode($output).")");
            }
            $capital = M('borrow_investor')->where("borrow_id={$borrow_id} AND investor_uid={$user['id']}")->sum('investor_capital');
            if(($capital+$money)>$binfo['borrow_max']&&$binfo['borrow_max']>0){
                $output = array('result'=>"beyond_borrow_max");//您已投标{$capital}元，此投上限为{$binfo['borrow_max']}元，你最多只能再投{$xtee}
                exit($callback."(".json_encode($output).")");
            }
            $need = $binfo['borrow_money'] - $binfo['has_borrow'];
            $caninvest = $need - $binfo['borrow_min'];
            if( $money>$caninvest && $need==0){
                $output = array('result'=>"borrow_full");//此标已被抢投满了
                exit($callback."(".json_encode($output).")");
            }
            if($money + $binfo['has_borrow']-$binfo['borrow_money']>0){
                $output = array('result'=>"dlg_money_overflow");//投资金额大于借款剩余
                exit($callback."(".json_encode($output).")");
            }
            if(($binfo['borrow_min']-$money)>0){
                $output = array('result'=>"borrow_min");//投资金额小于最小投资金额
                exit($callback."(".json_encode($output).")");
            }
            if($binfo['money_collect']>0){
                if($money_info['money_collect']<$binfo['money_collect']) {
                    $output = array('result'=>"money_collect_limit");//待收限制
                    exit($callback."(".json_encode($output).")");
                }
            }
            if($money-$money_info['back_money']-$money_info['account_money']>0){
                $output = array('result'=>"not_sufficient_funds");//用户余额不足
                exit($callback."(".json_encode($output).")");
            }
            $done = investMoney($user['id'],$borrow_id,$money);
            if($done===true) {
                $output = array('result'=>"dlg_invest_success");//成功
                exit($callback."(".json_encode($output).")");
            }else{
                $output = array('result'=>"dlg_invest_error");//失败
                exit($callback."(".json_encode($output).")");
            }


        }

        public function tinvestormoney(){
            $callback = $_REQUEST['callback'];
            $tnum = $_REQUEST['num'];
            $borrow_id = $_REQUEST['borrow_id'];
            $repayment_type = intval($_REQUEST['chooseWay'])==""?4:intval($_REQUEST['chooseWay']);
            $pin = md5($_REQUEST['pin']);
            $binfo = M("transfer_borrow_info")->where("id={$borrow_id}")->find();
            $pre = C('DB_PREFIX');
            $data['id'] = $_SESSION["phone_id"];
            $user = M("members")->where($data)->find();
            $money_info = getMinfo($user['id'],'m.pin_pass,mm.account_money,mm.back_money,mm.money_collect');
            $amoney = $money_info['account_money']+$money_info['back_money'];
            $pin_pass = $money_info['pin_pass'];
            $month = $binfo['borrow_duration'];
            if($binfo['on_off']!=1){
                $output = array('result'=>"cannot_invest");//不能投标
                exit($callback."(".json_encode($output).")");
            }
            if($binfo['online_time'] > time()){
                $output = array('result'=>"not_online_time");//未到上线时间
                exit($callback."(".json_encode($output).")");
            }
            if($this->uid == $binfo['borrow_uid']){
                $output = array('result'=>"cannot_invest_own");//不能投自己的标
                exit($callback."(".json_encode($output).")");
            }
            if($tnum < 1) {
                $output = array('result'=>"one_more");//最少要投已1份
                exit($callback."(".json_encode($output).")");
            }
            if($binfo['borrow_max'] > 0){
                if($binfo['borrow_max'] -$tnum<0){
                    $output = array('result'=>"borrow_max");//超出单人购买上限
                    exit($callback."(".json_encode($output).")");
                }
            }
            if($pin<>$pin_pass){
                $output = array('result'=>"pin_error");//支付密码错误
                exit($callback."(".json_encode($output).")");
            }
            if($binfo['transfer_out'] > 0 && $binfo['borrow_max'] > 0){
                $havebuy = M("transfer_borrow_investor")->where("investor_uid={$user['id']} and borrow_id={$borrow_id}")->sum("transfer_num");
                if($binfo['borrow_max'] - $tnum - $havebuy<0){
                    $output = array('result'=>"borrow_max");//超出单人购买上限
                    exit($callback."(".json_encode($output).")");
                }

            }
            $max_num = $binfo['transfer_total'] - $binfo['transfer_out'];
            if($max_num < $tnum){
                $output = array('result'=>"beyond_need");//购买份数超过标剩余
                exit($callback."(".json_encode($output).")");
            }
            $money = $binfo['per_transfer'] * $tnum;
            if($amoney < $money){
                $output = array('result'=>"not_sufficient_funds");//用户余额不足
                exit($callback."(".json_encode($output).")");
            }

            $done = TinvestMoney($user['id'],$borrow_id,$tnum,$month,0,$repayment_type);
            if($done===true) {
                $output = array('result'=>"dlg_invest_success");//成功
                exit($callback."(".json_encode($output).")");
            }else{
                $output = array('result'=>"dlg_invest_error");//失败
                exit($callback."(".json_encode($output).")");
            }


        }

        private function getLeveIco($num){
            $leveconfig = FS("Dynamic/leveconfig");
            foreach($leveconfig as $key=>$v){
                if($num>=$v['start'] && $num<=$v['end']){
                    return $v['name'];
                }
            }
        }
        private function getInvestLeveIco($num){
            $leveconfig = FS("Dynamic/leveinvestconfig");
            foreach($leveconfig as $key=>$v){
                if($num>=$v['start'] && $num<=$v['end']){
                    return $v['name'] ;
                }
            }
        }
    }
?>
