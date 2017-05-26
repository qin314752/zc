<?php
    /**
    *  债权转让
    */
    class DebtAction extends MCommonAction
    {
        public $Detb;

        public function __construct()
        {
            parent::__construct();
            D("DebtBehavior");
            $this->Debt  = new DebtBehavior($this->uid);
        }
        /**
        * 债权转让默认页
        * 
        */
        public function index()
        {
           $this->display();
        } 
        /**
        * 可流转的标
        * 
        */
        public function change()
        {
           $list = $this->Debt->canTransfer();
           $this->assign('list', $list);
           $data['html'] = $this->fetch();
           exit(json_encode($data));
        }
        public function sellhtml()
        {
            $invest_id = isset($_GET['id'])? intval($_GET['id']):0;
            !$invest_id && ajaxmsg(L('parameter_error'),0);
            $info = $this->Debt->countDebt($invest_id);
            $this->assign('info', $info);
            $datag = get_global_setting();
            $this->assign('debt_fee', $datag['debt_fee']);
            $this->assign('invest_id', $invest_id);
            
            $borrow = M('borrow_investor i')
            ->join(C('DB_PREFIX')."borrow_info b ON i.borrow_id = b.id")
            ->field("borrow_name")
            ->where("i.id=".$invest_id)
            ->find();
            $this->assign("borrow_name", $borrow['borrow_name']);
            
            $d['content'] = $this->fetch();
            echo json_encode($d);
        }
        public function sell()
        {
            $money = floatval($_POST['money']);
            $paypass = $_POST['paypass'];
            $invest_id = intval($_POST['invest_id']);
            if($money && $paypass && $invest_id){
                $result = $this->Debt->sell($invest_id, $money, $paypass);
                if($result ==='TRUE')
                {
                    ajaxmsg('债权转让购买成功');   
                }else{
                    ajaxmsg($result,0);
                }
            }else{
                ajaxmsg('债权转让购买失败',0);
            }
            
            
        }
        /**
        * 进行中的债权
        * 
        */
        public function onBonds()
        {
            $list = $this->Debt->onBonds();
            $this->assign('list', $list);
            $data['html'] = $this->fetch();
            exit(json_encode($data));
        }
        /**
        *    成功的债权
        * 
        */
        public function successClaims()
        {
            $list = $this->Debt->successDebt();
            $this->assign('list', $list);
            $data['html'] = $this->fetch();
            exit(json_encode($data));
        }
        /**
        * 已购买的债权
        * 
        */
        public function buydetb()
        {
            $list = $this->Debt->buydetb();
            $this->assign('list', $list);
            $data['html'] = $this->fetch();
            exit(json_encode($data)); 
        }
        /**
        * 回收中的债权
        * 
        */
        public function ondetb()
        {
            $list = $this->Debt->onDetb();
            $this->assign('list', $list);
            $data['html'] = $this->fetch();
            exit(json_encode($data));
        }
        
        /**
        * 撤销转让债权ajax
        * 
        */
        public function cancelhtml()
        {
            $invest_id = $_REQUEST['invest_id'];
            $this->assign('invest_id', $invest_id);
            
            $d['content'] = $this->fetch();
            echo json_encode($d);
        }
        /**
        *  撤销债权转让
        * 
        */
        public function cancel()
        {
            $invest_id = $_REQUEST['invest_id'];
            $paypsss = strval($_POST['paypass']);
            !$invest_id && ajaxmsg(L('parameter_error'), 0);
        
            if($this->Debt->cancel($invest_id, $paypsss)) {
                ajaxmsg(L('撤销成功'), 1);
            }else{  
                ajaxmsg(L('撤销失败'), 0);
            }
            
        }
        
        /**
        * 取消的债权软让
        * 
        */
        public function cancellist()
        {
            $list = $this->Debt->cancelList();
            $this->assign('list', $list);
            $data['html'] = $this->fetch();
            exit(json_encode($data));
        }
        
        public function  agreement()
        {
            $invest_id = $this->_get('invest_id','trim',0);
            $this->assign("invest_id",$invest_id);
            $ht=M('hetong')->field('hetong_img,name,dizhi,tel')->find(); 
            $content = M("article_category")->field("type_content, type_name")->where("type_nid='agreement_debt'")->find();
            $this->assign('content', $content['type_content']);
            $this->assign('title', $content['type_name']);
            $this->assign('ht', $ht);
            
            $debt = M("invest_detb d")
                    ->join(C('DB_PREFIX')."borrow_investor i ON d.invest_id=i.id")
                    ->join(C('DB_PREFIX')."borrow_info b ON i.borrow_id=b.id")
                    ->join(C('DB_PREFIX')."members m ON d.sell_uid=m.id")
                    ->field("d.serialid, d.buy_time, d.transfer_price, d.buy_uid, m.user_name, b.borrow_name, b.id, b.borrow_interest_rate, b.total, b.has_pay")
                    ->where("d.invest_id={$invest_id}")->find();
            $debt_total = $this->Debt->getAlsoPeriods($invest_id);
            $this->assign('debt_total', $debt_total);
            $buy_user = M("members")->field("user_name")->where("id={$debt['buy_uid']}")->find();
            $this->assign('buy_user', $buy_user['user_name']);
            $this->assign('debt', $debt);
            $this->display();
        }


        public function download(){

            $invest_id = $this->_get('invest_id','trim',0);
            $ht=M('hetong')->field('hetong_img,name,dizhi,tel')->find();
            $content = M("article_category")->field("type_content, type_name")->where("type_nid='agreement_debt'")->find();
            $this->assign('content', $content['type_content']);
            $this->assign('title', $content['type_name']);
            $this->assign('ht', $ht);

            $debt = M("invest_detb d")
                ->join(C('DB_PREFIX')."borrow_investor i ON d.invest_id=i.id")
                ->join(C('DB_PREFIX')."borrow_info b ON i.borrow_id=b.id")
                ->join(C('DB_PREFIX')."members m ON d.sell_uid=m.id")
                ->field("d.serialid,i.*,b.borrow_use,d.buy_time,m.id as user_id,d.transfer_price, d.buy_uid, m.user_name, b.borrow_name, b.id, b.borrow_interest_rate, b.total, b.has_pay")
                ->where("d.invest_id={$invest_id}")->find();
            $debt_total = $this->Debt->getAlsoPeriods($invest_id);

            $type1 = $this->gloconf['BORROW_USE'];
            $debt['borrow_use'] = $type1[$debt['borrow_use']];

            $list3=M('member_info i')->field("i.zy,i.idcard")->where("uid = ".$debt['sell_uid'])->find();
            if(empty($list3)){
//                $this->assign('zy','未填写');
                $zy = '未填写';
//                $this->assign('idcard','未填写');
                $idcard = '未填写';
            }else{
                $this->assign('zy',$list3['zy']);
                $zy = $list3['zy'];
//                $this->assign('idcard',$list3['idcard']);
                $idcard = $list3['idcard'];
            }
            $list4=M('member_info i')->field("i.zy,i.idcard")->where("uid = ".$debt['sell_uid'])->find();
            if(empty($list4)){
//                $this->assign('s_zy','未填写');
                $s_zy = '未填写';
//                $this->assign('s_idcard','未填写');
                $s_idcard = '未填写';
            }else{
//                $this->assign('s_zy',$list3['zy']);
                $s_zy = $list3['zy'];
//                $this->assign('s_idcard',$list3['idcard']);
                $s_idcard = $list3['idcard'];
            }
//            $this->assign('debt_total', $debt_total);
//            $debt_total = $debt_total;
            $buy_user = M("members")->field("user_name")->where("id={$debt['buy_uid']}")->find();
//            $this->assign('buy_user', $buy_user['user_name']);
            $buy_user = $buy_user['user_name'];
//            $this->assign('debt', $debt);
//            $this->display();

            $type1 = $this->gloconf['BORROW_USE'];
            $binfo['borrow_use'] = $type1[$binfo['borrow_use']];
            $ht=M('hetong')->field('hetong_img,name,dizhi,tel')->find();

            $type = $borrow_config['REPAYMENT_TYPE'];
            //echo $binfo['repayment_type'];
            $binfo['repayment_name'] = $type[$binfo['repayment_type']];

//            $iinfo['repay'] = getFloatValue(($iinfo['investor_capital']+$iinfo['investor_interest'])/$binfo['borrow_duration'],2);
//            $bid = "SDHT";
//            $detail_list = M('investor_detail')->field(true)->where("invest_id={$invest_id}")->select();

            $hetongArr = M("hetong")->field('id,hetong_img,thumb_hetong_img,add_time,deal_user,name,dizhi,tel')->select();
            if(count($hetongArr)>0){
                $hetong = $hetongArr[0];

                if($hetong["hetong_img"]){
                    $hetong_img = C('WEB_URL').'/'.$hetong["hetong_img"];
                }else{
                    $hetong_img = C('WEB_URL').'/Style/danbaoimg.png';
                }
            }else{
                $hetong_img = C('WEB_URL').'/Style/danbaoimg.png';
            }

            require_once("/CORE/Extend/Library/tcpdf/tcpdf.php");
            $l = Array();
            $l['a_meta_charset'] = 'UTF-8';
            $l['a_meta_dir'] = 'ltr';
            $l['a_meta_language'] = 'cn';
            $l['w_page'] = '页面';
            $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
//        $pdf = new TCPDF('P', "新宋体", 'A4', true, 'UTF-8', false);

            $pdf->SetDefaultMonospacedFont('courier');
            $pdf->SetCreator("金糯米系统");
            $pdf->SetAuthor("金糯米系统");
            $pdf->SetTitle("金糯米系统");
            $pdf->SetSubject("金糯米系统");
            $pdf->SetKeywords("金糯米系统");
            $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, ''.'', '');
//        $pdf->setHeaderFont('cid0jp', '', 20);
            $pdf->setHeaderFont(PDF_FONT_NAME_MAIN, '', 20);
//
            $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
            $pdf->SetMargins(15, 27, 15);
            $pdf->SetHeaderMargin(5);
            $pdf->SetFooterMargin(10);
            $pdf->SetAutoPageBreak(TRUE, 15);
//        $pdf->SetFont('cid0jp', '', 20);
            $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 20);

            $pdf->AddPage();

            $time3 = date("Y年m月d日",$binfo["second_verify_time"]);
            $time4 = date("Y年m月d日",$binfo["deadline"]);

            $html = '
  <div style="font-size:26px;">
        <p style="text-align:center;font-size:36px;">
            <br/>债权转让及受让协议<br/>
        </p>
        <p style="text-align:center"><span>编号：<span style="text-decoration: underline;"><u><strong>SDHT-D-'
                .$debt["serialid"]
                .'</strong></u></span></span>
            <br/><br/><br/>
        </p>
      <p>
          <span>本债权转让及受让协议（&quot;本协议&quot;）由以下各方于'.date('Y-m-d',$debt["buy_time"]).'签署并履行：</span>
      </p>
      <p>
          <span>转让人（原债权人）：<span>'.$debt["user_name"].'</span></span>
      </p>
      <p>
          <span>受让人（新债权人）：<span>详见本协议“第一条转让及受让债权信息</span></span>
      </p>
      <p>
          <span>鉴于：转让人与本协议&quot;第一条&quot;约定的借款人签订《借款协议》，由转让人向借款人出借款项，借款人按照《借款协议》及附件的约定按期偿还本息。现转让人与受让人经平等协商，由转让人将《借款协议》项下对借款人享有的全部或者部分债权转让给受让人，受让人同意受让该债权。现各方就该债权转让及受让事宜达成本协议，以资信守。</span>
      </p>
      <p>
          <span>第一条 转让及受让债权信息</span>
      </p>
      <br>
      <br>
      <table border="1">
          <tbody>
          <tr>
                <td style="text-align:center;">转让人姓名
                </td>
                <td style="text-align:center;">借款人身份证号码
                </td>
                <td style="text-align:center;">《借款协议》编号
                </td>
                <td style="text-align:center;">借款人职业情况
                </td>
                <td style="text-align:center;">借款人借款用途
                </td>
                <td style="text-align:center;">还款期限（月）
                </td>
                <td style="text-align:center;">剩余还款月数
                </td>
          </tr>
          <tr>
              <td style="text-align:center;">'.$debt["user_name"].'</td>
              <td style="text-align:center;">'.$idcard.'</td>
              <td style="text-align:center;">SDHT-D-'.$debt["serialid"].'</td>
              <td style="text-align:center;">'.$zy.'</td>
              <td style="text-align:center;">'.$debt["borrow_use"].'</td>
              <td style="text-align:center;"> ' . $debt["total"] . '个月</td>
              <td style="text-align:center;">'.($debt['total']-$debt['has_pay']).'个月</td>
          </tr>
          </tbody>
      </table>
      <p>
      <table border="1">
          <tbody>
          <tr>
              <td style="text-align:center;">序号</td>
              <td style="text-align:center;">受让人姓名</td>
              <td style="text-align:center;">受让人身份证号码后四位</td>
              <td style="text-align:center;">受让债权需支付对价</td>
              <td style="text-align:center;">还款期限（月）</td>
              <td style="text-align:center;">剩余还款月数</td>
              <td style="text-align:center;">预期内部收益率</td>
          </tr>
          <tr>
              <td style="text-align:center;">
              1
              </td>
              <td style="text-align:center;">'.$buy_user.'</td>
              <td style="text-align:center;">'.$s_idcard.'</td>
              <td style="text-align:center;">￥'.$debt["transfer_price"].'</td>
              <td style="text-align:center;">'.$debt["total"].'个月</td>
              <td style="text-align:center;">'.($debt['total']-$debt['has_pay']).'个月</td>
              <td style="text-align:center;">'.$debt["borrow_interest_rate"].'%</td>
          </tr>
          </tbody>
      </table>
      </p>
      <br/>
      <p>
          <span>第二条 支付价款</span>
      </p>
      <p>
          <span>受让人在本协议签署或生成后3个工作日内，将本协议项下的对价直接划付至转让人账户（可通过受让人授权的第三方支付机构或银行）。转让人和受让人均同意第三方支付机构或银行接受委托后进行的行为所产生的法律后果均由相应委托方承担。</span>
      </p>
      <p>
          <span>第三条 中介方地位</span>
      </p>
      <p>
          <span>转让人与受让人在此确认，湖南祁商普融信息咨询服务有限公司（以下简称&quot;中介方&quot;）作为中介服务机构，不是本协议所涉及的借贷关系的当事人；转让人、受让人和借款人中的任何一方根据借贷关系和/或债权转让及受让关系向对方主张权利时，不得将中介方列为共同被告，也不得要求中介方承担连带责任。</span>
      </p>
      <p>
          <span>第四条 法律关系</span>
      </p>
      <p>
          <span>1)受让人按照本协议&quot;第一条&quot;规定支付对价后，即享受转让人在原《借款协议》项下出借人的利息收益（中介方需从利息中扣除相应服务管理费）。</span>
      </p>
      <p>
          <span>2) 为方便管理和专业的风险控制，受让人获取债权后，并不对债权对应的抵/质押权作变更，受让人委托授权转让人继续作为抵/质押权人，管理或保管抵/质押财产。</span>
      </p>
      <p>
          <span>第五条 其他</span>
      </p>
      <p>
          <span>1)本协议采用电子文本形式制成，并保存在中介方为此设立的专用服务器上备查，各方均认可该形式的协议效力。</span>
      </p>
      <p>
          <span>2)转让人及受让人同意中介方根据具体情况对本协议进行更新。</span>
      </p>
      <p>
          <span>3)转让人与受让人以书面形式（包括电子文本等）签订的补充协议与本协议具有同等的法律效力。</span>
      </p>
      <p>
          <span>4)转让人通过本协议所获得的收益应自行申报并缴纳税款。</span>
      </p>
      <p>
          <span>5)中介方接受转让人和受让人的委托所产生的法律后果由相应委托方承担。如因转让人或受让人或其他第三方（包括但不限于技术问题）造成的延误或错误，中介方不承担任何责任。</span>
      </p>
      <p>
          <span>6)转让人和受让人均确认，本协议的签署、生效和履行以不违反中国的法律法规为前提。如果本协议中的任何一条或多条违反适用的法律法规，则该条将被视为无效，但该无效条款并不影响本协议其他条款的效力。</span>
      </p>
      <p>
          <span>7)本协议的签订地及履行地为湖南省长沙市天心区；如果转让人和受让人在本协议履行过程中发生任何争议，应友好协商解决；如协商不成，则须提交协议签订地及履行地长沙市天心区人民法院进行诉讼。</span>
      </p>
      <p>
          <span>8)《借款协议》作为本协议的附件，与本协议具有同等的法律效力。</span>
      </p>
      <p>
          <span>9)本协议自文本最终生成之日起成立；自受让人将本协议&quot;第一条&quot;约定的款项划付至转让人账户时生效，同时，受让人与借款人之间建立借款法律关系，受让人受《借款协议》内容的约束。</span>
      </p>
          '.
//      <div class="Seal">
//          居间人：<br>
//          <img src="/{$ht.hetong_img}" border="0" width="100px" height="100px"> <br>
//          <span class="seal_text">'.date('Y-m-d',$debt["buy_time"]).'</span> </div>
                '
        <p>
            <br/>
        </p>
        <p style="text-align: right;text-indent:250px;">
            <table border="0" style="width:220px;">
                <tr>
                    <td style="width:50px;text-align:left; vertical-align:bottom;"><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>居间人：
                    </td>
                    <td style="width:120px;text-align:left;">
                        <img src="'.$hetong_img.'" alt="" style="width:120px;height:120px;"/>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:left;">'.date('Y-m-d',$debt["buy_time"]).'
                    </td>
                </tr>
            </table>
        </p>
  </div>';

//            #<img src="/{$ht.hetong_img}" border="0" width="100px" height="100px"> <br>
//            #<img src="'.$hetong_img.'" alt="" style="width:120px;height:120px;"/>
//            #&nbsp;&nbsp;&nbsp;&nbsp;<img src="'.$danbao_img.'" alt="" style="width:120px;height:120px;"/>
            $pdf->writeHTML($html, true, false, true, false, '');
//            $pdf->SetProtection(array('annot-forms'), $mInvest["user_phone"]);
            $pdf->Output('hetong.pdf', 'I');
        }
       
    }
?>
