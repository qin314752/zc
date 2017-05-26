<?php
// 金糯米内核类库，2014-06-11_listam
class AgreementAction extends MCommonAction {
	
 public function downfile(){
		$per = C('DB_PREFIX');
		//$borrow_config = require C("APP_ROOT")."Conf/borrow_config.php";
		$invest_id=intval($_GET['id']);
     $this->assign("reqId",$invest_id);
		//$borrow_id=intval($_GET['id']);
		$iinfo = M('borrow_investor')->field('id,borrow_id,investor_capital,investor_interest,deadline,investor_uid,add_time')->where("(investor_uid={$this->uid} OR borrow_uid={$this->uid}) AND id={$invest_id}")->find();
		$binfo = M('borrow_info')->field('id,repayment_type,borrow_duration,borrow_uid,borrow_type,borrow_use,borrow_money,full_time,add_time,borrow_interest_rate,deadline,second_verify_time')->find($iinfo['borrow_id']);
		$mBorrow = M("members m")->join("{$per}member_info mi ON mi.uid=m.id")->field('mi.real_name,m.user_name')->where("m.id={$binfo['borrow_uid']}")->find();
		$mInvest = M("members m")->join("{$per}member_info mi ON mi.uid=m.id")->field('mi.real_name,m.user_name')->where("m.id={$iinfo['investor_uid']}")->find();
		if(!is_array($iinfo)||!is_array($binfo)||!is_array($mBorrow)||!is_array($mInvest)) exit;
		
		$detail = M('investor_detail d')->field('d.borrow_id,d.investor_uid,d.borrow_uid,d.capital,sum(d.capital+d.interest-d.interest_fee) benxi,d.total')->where("d.borrow_id={$iinfo['borrow_id']} and d.invest_id ={$iinfo['id']}")->group('d.investor_uid')->find();

		//$detailinfo = M('investor_detail d')->join("{$per}borrow_investor bi ON bi.id=d.invest_id")->join("{$per}members m ON m.id=d.investor_uid")->field('d.borrow_id,d.investor_uid,d.borrow_uid,d.capital,sum(d.capital+d.interest-d.interest_fee) benxi,d.total,m.user_name,bi.investor_capital,bi.add_time')->where("d.borrow_id={$iinfo['borrow_id']} and d.invest_id ={$iinfo['id']}")->group('d.investor_uid')->find();
		$detailinfo = M('investor_detail d')->field('d.borrow_id,d.investor_uid,d.borrow_uid,(d.capital+d.interest-d.interest_fee) benxi,d.capital,d.interest,d.interest_fee,d.sort_order,d.deadline')->where("d.borrow_id={$iinfo['borrow_id']} and d.invest_id ={$iinfo['id']}")->select();
		
		
		$time = M('borrow_investor')->field('id,add_time')->where("borrow_id={$iinfo['borrow_id']} order by add_time asc")->limit(1)->find();
		
		if($binfo['repayment_type']==1){
				$deadline_last = strtotime("+{$binfo['borrow_duration']} day",$time['add_time']);
			}else{
				$deadline_last = strtotime("+{$binfo['borrow_duration']} month",$time['add_time']);
			}
		$this->assign('deadline_last',$deadline_last);
		$this->assign('detailinfo',$detailinfo);
		$this->assign('detail',$detail);

		$type1 = $this->gloconf['BORROW_USE'];
		$binfo['borrow_use'] = $type1[$binfo['borrow_use']];
		$ht=M('hetong')->field('hetong_img,name,dizhi,tel')->find();
		
		$this->assign("ht",$ht);
                $borrow_config = require C("APP_ROOT")."Conf/borrow_config.php";
		$type = $borrow_config['REPAYMENT_TYPE'];
		//echo $binfo['repayment_type'];
		$binfo['repayment_type'] = $type[$binfo['repayment_type']];

		$iinfo['repay'] = getFloatValue(($iinfo['investor_capital']+$iinfo['investor_interest'])/$binfo['borrow_duration'],2);
		
		$this->assign("bid","SDHT");
		//print_r($type);
		$this->assign('iinfo',$iinfo);
		$this->assign('binfo',$binfo);
		$this->assign('mBorrow',$mBorrow);
		$this->assign('mInvest',$mInvest);

		$detail_list = M('investor_detail')->field(true)->where("invest_id={$invest_id}")->select();
		$this->assign("detail_list",$detail_list);



     #<img src="'.$hetong_img.'" alt="" style="width:120px;height:120px;"/>
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
     $this->assign("hetong_img",$hetong_img);

		
		$this->display("index");
		
		//$html = $this->fetch('index');
		
		//$this->mypdf->writeHTML($html, true, false, true, false, '');
		
		
		//$this->mypdf->MultiCell(0, 5, "ssssssssssssssssssssssssssssssss", 0, 'J', 0, 2, '', '', true, 0, false);		
		
		//路径,x坐标,y坐标,图片宽度,图片高度（''表示自适应）,网址,
		//$mask = $this->mypdf->Image($this->pdfPath.'images/alpha.png', 130, 0, 100, '', '', '', '', false, 100, '', true);
		//$this->mypdf->Image($this->pdfPath.'images/image_with_alpha.png', 130, 0, 60, 60, '', '', '', false, 10, '', true, $mask);//出图的,放在后面图就在上层，放在前面图就在下层
		//$this->mypdf->Image($this->pdfPath.'images/236.png', 130, 200, 50, 50, '', '', '', false, 10, '', true,$html);//出图的,放在后面图就在上层，放在前面图就在下层

		// ---------------------------------------------------------
		
		//Close and output PDF document
		//$this->mypdf->Output('jiedaihetong.pdf', 'I');
		
    }
	
	 public function downliuzhuanfile(){
		$per = C('DB_PREFIX');
		$borrow_config = require C("APP_ROOT")."Conf/borrow_config.php";
		$type = $borrow_config['REPAYMENT_TYPE'];

		$invest_id=intval($_GET['id']);
		
		$iinfo = M("transfer_borrow_investor")->field(true)->where("investor_uid={$this->uid} AND id={$invest_id}")->find();

		$binfo = M('transfer_borrow_info')->field(true)->find($iinfo['borrow_id']);
		$tou =  M('transfer_investor_detail')->where(" borrow_id={$iinfo['borrow_id']} AND investor_uid={$this->uid} ")->find();
		
		$mBorrow = M("members m")->join("{$per}member_info mi ON mi.uid=m.id")->field('mi.real_name,m.user_name')->where("m.id={$binfo['borrow_uid']}")->find();
		$mInvest = M("members m")->join("{$per}member_info mi ON mi.uid=m.id")->field('mi.real_name,m.user_name')->where("m.id={$iinfo['investor_uid']}")->find();
		
		if(!is_array($tou)) $mBorrow['real_name'] = hidecard($mBorrow['real_name'],5);

		$binfo['repayment_name'] = $type[$binfo['repayment_type']];

		$this->assign("bid","SDHT-L-".str_repeat("0",5-strlen($binfo['id'])).$binfo['id']);
		
		$detailinfo = M('transfer_investor_detail d')->join("{$per}transfer_borrow_investor bi ON bi.id=d.invest_id")->join("{$per}members m ON m.id=d.investor_uid")->field('d.borrow_id,d.investor_uid,d.borrow_uid,d.capital,sum(d.capital+d.interest-d.interest_fee) benxi,d.total,m.user_name,bi.investor_capital,bi.add_time')->where("d.borrow_id={$iinfo['borrow_id']} and d.invest_id ={$iinfo['id']}")->group('d.investor_uid')->find();
		
		$time = M('transfer_borrow_investor')->field('id,add_time')->where("borrow_id={$iinfo['borrow_id']} order by add_time asc")->limit(1)->find();
		
		$deadline_last = strtotime("+{$binfo['borrow_duration']} month",$time['add_time']);
		
		$this->assign('deadline_last',$deadline_last);
		$this->assign('detailinfo',$detailinfo);

		$type1 = $this->gloconf['BORROW_USE'];
		$binfo['borrow_use'] = $type1[$binfo['borrow_use']];



		$type = $borrow_config['REPAYMENT_TYPE'];
		//echo $binfo['repayment_type'];
		$binfo['repayment_name'] = $type[$binfo['repayment_type']];

		$iinfo['repay'] = getFloatValue(($iinfo['investor_capital']+$iinfo['investor_interest'])/$binfo['borrow_duration'],2);
		
		
		
		$this->assign('iinfo',$iinfo);
		$this->assign('binfo',$binfo);
		$this->assign('mBorrow',$mBorrow);
		$this->assign('mInvest',$mInvest);

		$detail_list = M('transfer_investor_detail')->field(true)->where("invest_id={$invest_id}")->select();
		$this->assign("detail_list",$detail_list);

		$ht=M('hetong')->field('hetong_img,name,dizhi,tel')->find();
		$this->assign("ht",$ht);
		$this->display("transfer");
    }

 public function downdingtoubao(){
		$per = C('DB_PREFIX');
		$borrow_config = require C("APP_ROOT")."Conf/borrow_config.php";
		$type = $borrow_config['REPAYMENT_TYPE'];

		$invest_id=intval($_GET['id']);
		if(empty($invest_id)) $this->display("dingtoubao");
     $this->assign("invest_id",$invest_id);
		$datag = get_global_setting();
		$fee_rate = $datag['fee_invest_manage'];//投资者成交管理费费率
		$iinfo = M("transfer_borrow_investor")->field(true)->where("investor_uid={$this->uid} AND id={$invest_id}")->find();

		$binfo = M('transfer_borrow_info')->field(true)->find($iinfo['borrow_id']);
		$tou =  M('transfer_investor_detail')->where("invest_id={$iinfo['id']} AND investor_uid={$this->uid} ")->find();
		$detail = M("transfer_detail")->field(true)->find($iinfo['borrow_id']);
		$mBorrow = M("members m")->join("{$per}member_info mi ON mi.uid=m.id")->field('mi.real_name,mi.address,mi.cell_phone,m.user_name')->where("m.id={$binfo['borrow_uid']}")->find();
		$mInvest = M("members m")->join("{$per}member_info mi ON mi.uid=m.id")->field('mi.real_name,mi.address,mi.cell_phone,mi.idcard,m.user_name,m.user_email')->where("m.id={$iinfo['investor_uid']}")->find();
		$danbao = M('article')->field('id,title,art_img')->where("id={$binfo['danbao']}")->find();
		if(!is_array($tou)) $mBorrow['real_name'] = hidecard($mBorrow['real_name'],4);

		$binfo['repayment_name'] = $type[$binfo['repayment_type']];

		$this->assign("bid","SDHT-U-".str_repeat("0",5-strlen($iinfo['id'])).$iinfo['id']);
		
		$detailinfo = M('transfer_investor_detail d')->join("{$per}transfer_borrow_investor bi ON bi.id=d.invest_id")->join("{$per}members m ON m.id=d.investor_uid")->field('d.borrow_id,d.investor_uid,d.borrow_uid,d.capital,sum(d.capital+d.interest-d.interest_fee) benxi,d.total,m.user_name,bi.investor_capital,bi.add_time')->where("d.borrow_id={$iinfo['borrow_id']} and d.invest_id ={$iinfo['id']}")->group('d.investor_uid')->find();
		
		$time = M('transfer_borrow_investor')->field('id,add_time,deadline')->where("borrow_id={$iinfo['borrow_id']} order by add_time asc")->limit(1)->find();
		
		$deadline_last = $time['deadline'];
		
		$this->assign('deadline_last',$deadline_last);
		$this->assign('detailinfo',$detailinfo);

		$type1 = $this->gloconf['BORROW_USE'];
		$binfo['borrow_use'] = $type1[$binfo['borrow_use']];



		$type = $borrow_config['REPAYMENT_TYPE'];
		//echo $binfo['repayment_type'];
		$binfo['repayment_name'] = $type[$binfo['repayment_type']];

		$iinfo['repay'] = getFloatValue(($iinfo['investor_capital']+$iinfo['investor_interest'])/$binfo['borrow_duration'],2);
		$Bconfig = require C("APP_ROOT")."Conf/borrow_config.php";
		$ht=M('hetong')->field('hetong_img,name,dizhi,tel')->find();
		$this->assign("ht",$ht);
		$this->assign("fee_rate",$fee_rate);
		$this->assign("Bconfig",$Bconfig);
		$this->assign('iinfo',$iinfo);
		$this->assign('binfo',$binfo);
		$this->assign('tou',$tou);
		$this->assign('mBorrow',$mBorrow);
		$this->assign('mInvest',$mInvest);
		$this->assign('danbao',$danbao);
		$this->assign('detail',$detail);
     $this->assign("borrow_id",$iinfo['borrow_id']);

		$detail_list = M('transfer_investor_detail')->field(true)->where("invest_id={$invest_id}")->select();
		$this->assign("detail_list",$detail_list);

		$ht=M('hetong')->field('hetong_img,name,dizhi,tel')->find();
		$this->assign("ht",$ht);
		$this->display("dingtoubao");
    }

    //众筹合同
    public function contract(){
        if(!isset($_GET['id'])) $this->error("发生错误，请重试");
        $pre = C('DB_PREFIX');
        $list=M('crowd_investor ci')
            ->field("ci.*,mm.user_name,mi.idcard")
            ->join("{$pre}member_info mi ON mi.uid = ci.user_id")
            ->join("{$pre}members mm ON mm.id = ci.user_id")
            ->where("ci.id=".$_GET['id'])->find();
        $list['ratio']=$list['ratio']*100;
        $this->assign("list",$list);
        $this->display();
    }

    public function download(){

        $datag = get_global_setting();
        $per = C('DB_PREFIX');
        $invest_id=intval($_GET['id']);
        $iinfo = M('borrow_investor')->field('id,borrow_id,investor_capital,investor_interest,deadline,investor_uid,add_time')->where("(investor_uid={$this->uid} OR borrow_uid={$this->uid}) AND id={$invest_id}")->find();
        $binfo = M('borrow_info b')->field('b.id,b.repayment_type,b.borrow_duration,b.borrow_uid,b.borrow_type,b.borrow_use,b.borrow_money,b.full_time,b.add_time,b.borrow_interest_rate,b.deadline,b.second_verify_time,b.danbao,a.title')->join("{$per}article a on a.id = b.danbao")->where("b.id = {$iinfo['borrow_id']}")->find();
//        var_dump($binfo['repayment_type']);
//        exit;
        switch($binfo['repayment_type']){
            case 1:
                $repayment_type = '按天到期还款';
                break;
            case 2:
                $repayment_type = '按月分期还款';
                break;
            case 3:
                $repayment_type = '按季分期还款';
                break;
            case 4:
                $repayment_type = '每月还息到期还本';
                break;
        }
//        exit($repayment_type);
        $dbmap = array();
        $dbmap['id'] = $binfo['danbao'];
        $dbinfo = M('article')->field('id,title,art_img')->where($dbmap)->find();

        $mBorrow = M("members m")->join("{$per}member_info mi ON mi.uid=m.id")->field('mi.real_name,m.user_name')->where("m.id={$binfo['borrow_uid']}")->find();
        $mInvest = M("members m")->join("{$per}member_info mi ON mi.uid=m.id")->field('mi.real_name,m.user_name,m.user_phone')->where("m.id={$iinfo['investor_uid']}")->find();
        if(!is_array($iinfo)||!is_array($binfo)||!is_array($mBorrow)||!is_array($mInvest)) exit;

        $detail = M('investor_detail d')->field('d.borrow_id,d.investor_uid,d.borrow_uid,d.capital,sum(d.capital+d.interest-d.interest_fee) benxi,d.total')->where("d.borrow_id={$iinfo['borrow_id']} and d.invest_id ={$iinfo['id']}")->group('d.investor_uid')->find();

        //$detailinfo = M('investor_detail d')->join("{$per}borrow_investor bi ON bi.id=d.invest_id")->join("{$per}members m ON m.id=d.investor_uid")->field('d.borrow_id,d.investor_uid,d.borrow_uid,d.capital,sum(d.capital+d.interest-d.interest_fee) benxi,d.total,m.user_name,bi.investor_capital,bi.add_time')->where("d.borrow_id={$iinfo['borrow_id']} and d.invest_id ={$iinfo['id']}")->group('d.investor_uid')->find();
        $detailinfo = M('investor_detail d')->field('d.borrow_id,d.investor_uid,d.borrow_uid,(d.capital+d.interest-d.interest_fee) benxi,d.capital,d.interest,d.interest_fee,d.sort_order,d.deadline')->where("d.borrow_id={$iinfo['borrow_id']} and d.invest_id ={$iinfo['id']}")->select();


        $time = M('borrow_investor')->field('id,add_time')->where("borrow_id={$iinfo['borrow_id']} order by add_time asc")->limit(1)->find();

        if($binfo['repayment_type']==1){
            $deadline_last = strtotime("+{$binfo['borrow_duration']} day",$time['add_time']);
        }else{
            $deadline_last = strtotime("+{$binfo['borrow_duration']} month",$time['add_time']);
        }

        $type1 = $this->gloconf['BORROW_USE'];
        $binfo['borrow_use'] = $type1[$binfo['borrow_use']];
        $ht=M('hetong')->field('hetong_img,name,dizhi,tel')->find();

        $type = $borrow_config['REPAYMENT_TYPE'];
        //echo $binfo['repayment_type'];
        $binfo['repayment_name'] = $type[$binfo['repayment_type']];

        $iinfo['repay'] = getFloatValue(($iinfo['investor_capital']+$iinfo['investor_interest'])/$binfo['borrow_duration'],2);

        $bid = "SDHT";
        //print_r($type);

        $detail_list = M('investor_detail')->field(true)->where("invest_id={$invest_id}")->select();


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

        $pdf->SetDefaultMonospacedFont('courier');
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('金糯米系统');
        $pdf->SetTitle('金糯米系统');
        $pdf->SetSubject('金糯米系统');
        $pdf->SetKeywords('金糯米系统');
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, ''.'', '');
        $pdf->setHeaderFont(PDF_FONT_NAME_MAIN, '', 20);
//
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
        $pdf->SetMargins(15, 27, 15);
        $pdf->SetHeaderMargin(5);
        $pdf->SetFooterMargin(10);
        $pdf->SetAutoPageBreak(TRUE, 15);
        $pdf->SetFont(PDF_FONT_NAME_MAIN, '', 20);
        $pdf->AddPage();
        $time3 = date("Y年m月d日",$binfo["second_verify_time"]);
        $time4 = date("Y年m月d日",$binfo["deadline"]);
        $html = '
<div style="width:850px;">
    <div style="color: #4c4948;font-size: 36px;font-weight: normal;text-align:center;">
        借款协议
    </div>
    <div style="color: #4c4948;font-size: 30px;font-weight: normal;padding-left:260px;">

        <table style="width:100%;" border="0">
            <tr>
                <td  style="width:120px;"></td>
                <td>合同编号：'.$bid.date("Ymd",$iinfo["add_time"]).$iinfo["id"]
            .'<br/><br/>甲方（借款人）：'./*$mBorrow["real_name"].*/'（本站ID：'.hidecard($mBorrow["user_name"])
            .'）<br/><br/>乙方（投资人）：详见本协议第一条<br/><br/>丙方（担保机构）：'.$binfo["title"]
            .'<br/><br/>丁方（居间方）：'.$ht["name"]
            .'<br/><br/>生效日期：'.date("Y年m月d日",$binfo["second_verify_time"]).'<br/><br/>
                </td>
            </tr>
        </table>
    </div>

    <div style="color: #4c4948;font-size: 24px;">
        <p>&nbsp;&nbsp;&nbsp;&nbsp;丁方为互联网金融借贷平台居间方，拥有'.$datag["web_name"].C("WEB_URL").'（以下简称“本平台”）的经营权，提供借贷咨询，为交易提供信息服务。甲方通过本平台向乙方进行借款，并承诺其提供给乙方、丁方的信息是完全真实的。乙方承诺对本协议涉及的借款具有完全的支配能力，是其自有闲散资金，为其合法所得；相关借款事项根据《中华人民共和国合同法》等相关法律法规的规定，甲乙丁三方达成如下协议：</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;<strong>第一条：投资人投资信息</strong></p>

        <table style="width:100%;border:1px solid #666;">
            <tr>
                <td  style="border:1px solid #666;text-align:center;padding-top:8px;padding-bottom:8px;line-height:8px;width:60px;">投资人</td>
                <td  style="border:1px solid #666;text-align:center;padding-top:8px;padding-bottom:8px;line-height:8px;">金额 </td>
                <td  style="border:1px solid #666;text-align:center;padding-top:8px;padding-bottom:8px;line-height:8px;">期限</td>
                <td  style="border:1px solid #666;text-align:center;padding-top:8px;padding-bottom:8px;line-height:8px;">年利率</td>
                <td  style="border:1px solid #666;text-align:center;padding-top:8px;padding-bottom:8px;line-height:8px;">开始日</td>
                <td  style="border:1px solid #666;text-align:center;padding-top:8px;padding-bottom:8px;line-height:8px;">到期日</td>
                <td  style="border:1px solid #666;text-align:center;padding-top:8px;padding-bottom:8px;line-height:8px;">还款方式</td>
                <td  style="border:1px solid #666;text-align:center;padding-top:8px;padding-bottom:8px;line-height:8px;">总本息</td>
            </tr>
            <tr>
                <td  style="border:1px solid #666;text-align:center;padding-top:8px;padding-bottom:8px;line-height:8px;width:60px;">&nbsp; '.hidecard($mInvest["user_name"]).' &nbsp; </td>
                <td  style="border:1px solid #666;text-align:center;padding-top:8px;padding-bottom:8px;line-height:8px;">&nbsp; '.$iinfo["investor_capital"].'</td>
                <td  style="border:1px solid #666;text-align:center;padding-top:8px;padding-bottom:8px;line-height:8px;">&nbsp; '.$binfo["borrow_duration"].($binfo["repayment_type"]==1?"天":"个月").'</td>
                <td  style="border:1px solid #666;text-align:center;padding-top:8px;padding-bottom:8px;line-height:8px;">&nbsp; '.$binfo["borrow_interest_rate"].'%/年</td>
                <td  style="border:1px solid #666;text-align:center;padding-top:8px;padding-bottom:8px;line-height:8px;">'."".date("Y年m月d日",$binfo["second_verify_time"]).'</td>
                <td  style="border:1px solid #666;text-align:center;padding-top:8px;padding-bottom:8px;line-height:8px;">'."".date("Y年m月d日",$binfo["deadline"]).'</td>
                <td  style="border:1px solid #666;text-align:center;padding-top:8px;padding-bottom:8px;line-height:8px;">&nbsp; '.$repayment_type.'</td>
                <td  style="border:1px solid #666;text-align:center;padding-top:8px;padding-bottom:8px;line-height:8px;">&nbsp; '.$detail["benxi"].'</td>
            </tr>
        </table>
        <p>&nbsp;</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;<strong>第二条：还款</strong></p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;1、还款计划：</p>
        <table style="width:100%;border:1px solid #666;">
            <tr>
                <td  style="border:1px solid #666;text-align:center;padding-top:8px;padding-bottom:8px;line-height:8px;width:60px;">投资人</td>
                <td  style="border:1px solid #666;text-align:center;padding-top:8px;padding-bottom:8px;line-height:8px;" >金额 </td>
                <td  style="border:1px solid #666;text-align:center;padding-top:8px;padding-bottom:8px;line-height:8px;" >期限</td>
                <td  style="border:1px solid #666;text-align:center;padding-top:8px;padding-bottom:8px;line-height:8px;" >年利率</td>
                <td  style="border:1px solid #666;text-align:center;padding-top:8px;padding-bottom:8px;line-height:8px;" >开始日</td>
                <td  style="border:1px solid #666;text-align:center;padding-top:8px;padding-bottom:8px;line-height:8px;" >到期日</td>
                <td  style="border:1px solid #666;text-align:center;padding-top:8px;padding-bottom:8px;line-height:8px;" >还款方式</td>
                <td  style="border:1px solid #666;text-align:center;padding-top:8px;padding-bottom:8px;line-height:8px;" >总本息</td>
            </tr>
            <tr>
                <td  style="border:1px solid #666;text-align:center;line-height:8px;width:60px;"> &nbsp; '.hidecard($mInvest["user_name"]).' &nbsp; </td>
                <td  style="border:1px solid #666;text-align:center;line-height:8px;"> &nbsp; '.$iinfo["investor_capital"].' &nbsp; </td>
                <td  style="border:1px solid #666;text-align:center;line-height:8px;"> &nbsp; '.$binfo["borrow_duration"].'
                    '.($binfo["repayment_type"]==1?"天":"个月").' &nbsp;
                    </td>
                <td  style="border:1px solid #666;text-align:center;line-height:8px;">&nbsp; '.$binfo["borrow_interest_rate"].'%/年 &nbsp;</td>
                <td  style="border:1px solid #666;text-align:center;line-height:8px;"> &nbsp; '."".$time3.' &nbsp;</td>
                <td  style="border:1px solid #666;text-align:center;line-height:8px;"> &nbsp; '."".$time4.' &nbsp;</td>
                <td  style="border:1px solid #666;text-align:center;line-height:8px;">&nbsp; '.$repayment_type.' </td>
                <td  style="border:1px solid #666;text-align:center;line-height:8px;">&nbsp; '.$detail["benxi"].' </td>
            </tr>
        </table>
<p>&nbsp;</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;2、借款人承诺按照本协议以上约定的时间和金额，按期足额向投资者还款。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;<strong>第三条： 借款流程</strong></p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;1、本协议成立：乙方在丁方的投融资服务平台上对甲方发布的借款需求点击“投标”按钮时，本协议即时成立。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;2、出借资金冻结：同时，乙方点击“投标”按钮即视为其已经向丁方发出不可撤销的授权指令，授权丁方委托其指定的第三方支付机构及监管银行冻结乙方确认向甲方出借的资金。冻结将在本协议生效时或本协议确定失效时解除。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;3、本协议生效：本协议在甲方发布的借款需求所对应的出借资金已经全部冻结时立即生效。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;4、出借资金划转：本协议生效的同时，甲方即不可撤销地授权丁方委托其指定的第三方支付机构及监管银行将冻结资金按委托支付协议的约定分期或者一次性划转至甲方账户中，划转完毕即视为借款发放成功，甲方可通过“提现”操作将划转的资金转至其银行账户上，甲方是否提现资金不影响本协议的效力。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;<strong>第四条：本息还款方式</strong></p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;1、甲方授权丁方委托其指定的第三方支付机构及监管银行，按还款计划将金额等同于乙方当期应收金额的资金划转至乙方账户项下，划转完毕即视为本期还款发放成功。为此，甲方应保证在每期还款日（且不晚于当日16:00时）的甲方平台账户余额足以支付当期应付利息或本金。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;2、甲方应按照本协议约定的借款本金偿还安排，保证在借款到期前3个工作日内（不得迟于到期日16:00时）甲方平台账户内的余额足以支付甲方应当偿还的借款本金及未付利息。甲方授权丁方委托其指定的第三方支付机构及监管银行，按本协议约定在到期日，将甲方的应付本息划转至监管账户中乙方平台账户项下，划转完毕即视为借款本金还款成功。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;3、还款日遇节假日的，还款日为节假日到来的前一日，如遇到还款当月无还款日对应日的月份，还款日为应还款当月的最后一日。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;4、募集期：本协议募集期是指乙方出借资金被冻结的次日至丁方指令向甲方放款的前一日。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;<strong>第五条：履约保证金</strong></p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;为保证借款协议的顺利履行，甲方须就该笔业务支付履约保证金，履约保证金按借款协议本金的5%计算，在甲方提取所借款项前，由甲方一次性缴存到第三方支付机构及监管银行账户。协议履约结束后2个工作日内退还给甲方。如甲方在协议履行过程中存在相关逾期支付等违约事项，该保证金用于抵扣相应支付款项及相关费用，如有余额则于协议履行完毕后2个工作日内退还甲方。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;<strong>第六条：甲方的权利和义务</strong></p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;1、必须按协议约定的还款日期按时足额向乙方偿还本金和利息。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;2、必须一次性足额向丁方支付融资借款服务费用。 </p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;3、承诺所借款项专款专用，不用于任何违法用途。 </p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;4、应确保其提供的信息和资料的真实性、合法性、有效性，不得提供虚假信息或隐瞒重要事实。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;5、有权了解其在丙方的信用评审进度及结果。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;6、未经乙方事先书面（包括但不限于电子邮件等方式）同意，不得将本协议项下的任何权利义务转让给任何第三方。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;7、在乙方将债权转让后，向受让人继续履行本协议项下其对乙方的还款义务，不得以未接到债权转让通知为由拒绝履行还款义务。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;<strong>第七条：乙方的权利和义务</strong></p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;1、按协议约定的借款期限向甲方收取足额的借款本金，并享有所出借款项所带来的利息收益。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;2、有权在借款前有偿地委托丁方对甲方提供的资料、信息的真实性、合法性、有效性进行审查确认。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;3、可以根据自己的意愿进行本协议项下其对甲方债权的转让。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;4、通过丁方对甲方的用款情况进行监督检查。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;5、应自行承担由利息所得带来的可能的税费。 </p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;6、在甲方违约时向丙方主张连带责任保证还款的权利。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;7、 保证其所用于出借的资金来源合法，且是该资金的合法支配权人，如第三方对资金归属、支配权、合法性等问题主张异议，给甲方或丙方、丁方造成损失的，应当赔偿损失。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;<strong>第八条：丙方的权利和义务 </strong></p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;1、同意为本协议项下甲方向乙方负有的按时清偿借款本息的义务提供连带责任保证，保证担保的范围为本协议项下的借款本金及利息、违约金，以及甲方根据本协议或适用的中国法律应支付的其他赔偿金和乙方实现本协议项下债权的费用（包括诉讼费、律师费等）以及其他费用等。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;2、在甲方未按照本协议的约定按时、足额清偿任何一期借款利息或本金时，应在甲方逾期后30日以内，将代偿资金划转至丁方项指定的第三方支付机构及监管银行账户，并授权丁方向乙方的平台账户进行支付，以履行其在本协议项下的担保责任。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;3、保证期间：自本协议项下债务履行期限届满之日起2年。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;4、根据本协议规定履行担保责任后，乙方在本协议项下的所有权利视为已经得到满足和实现，乙方不得再对甲方提出任何请求或主张；丙方可以向甲方进行追偿，乙方应提供合理及必要的协助。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;5、怠于履行代偿义务情形下，丁方有权使用丙方保证金（由丙、丁双方签署的《合作协议》确定）直接代偿而无需丙方另行同意；在保证金不足以代偿情形下，丁方可动用其他可支配资金先行为丙方垫付代偿资金，此等垫付行为一经发生即视为丙方履行了担保责任，此时丙方对丁方承担代偿资金返还责任，丁方有权向丙方主张债权。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;6、有权就为本协议借款所提供的服务向甲方收取担保费等费用，上述费用的收取方式由甲丙双方另行约定。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;<strong>第九条：丁方的权利和义务</strong></p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;1、为甲、乙、丙三方提供居间融资平台服务。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;2、在甲方违约时，可动用甲方的履约保证金及计提风险准备金代甲方向乙方进行债务清偿。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;3、风险准备金不足时，有权代表乙方向丙方发起担保方清偿要求，要求丙方按照本协议的约定承担担保责任。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;4、有权就为本协议借款所提供的尽职调查、顾问咨询、平台服务、债权转让等向甲方、乙方、丙方及债权转让受让方收取费用，上述费用的收取方式由甲方、乙方、丙方及债权转让受让方与丁方另行约定。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;5、受乙方的委托对甲方的资料进行审查和对甲方进行必要的尽职调查。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;6、接受甲、乙双方的委托行为所产生的法律后果由相应委托方承担。如因乙方或甲方或其他方（包括但不限于技术问题）造成的延误或错误，不承担任何责任。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;7、甲、乙、丁三方一致同意，在有必要时，丁方有权代乙方对甲方进行关于本《借款协议》的违约提醒及催收工作，包括但不限于：电话通知、上门催收提醒、发律师函、对甲方提起诉讼等。甲方对前述委托的提醒、催收事项已明确知晓并 应积极配合。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;<strong>第十条：逾期还款</strong></p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;1、每月还款日24:00时前，甲方融资平台账户内余额不足以支付当月应还款的，则视为逾期，甲方应承担违约责任。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;2、协议履行期间内，逾期违约金可根据丁方融资平台相关规则的变化进行相应调整。如相关规则发生变化，则融资平台会在网站公示该等规则的变化。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;<strong>第十一条：债权转让</strong></p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;1、债权存续期间，乙方有权将其所持有的全部或部分债权在融资平台上进行转让，签署相关《债权转让协议》，该《债权转让协议》视为本协议的补充协议，用以载明债权人变更事项。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;2、乙方在此委托丁方，《债权转让协议》一经签订，即由丁方通过其网络管理系统向甲方注册账号发出债权转让通知消息（站内短信），该等消息一经发出即视为债权转让的通知送达甲方，债权转让自通知送达即时对甲方发生债权转让的效力。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;3、 丙方承诺丙方担保义务不因债权流转为免责事由，丙方的担保责任无条件及于被转让债权及债权受让人，且该转让行为引起的债权人变更无需通知丙方。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;<strong>第十二条：保密</strong></p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;1、本协议任何一方（“接受方”）对从其它方（“披露方”）获得的有关该方业务、财务状况、身份信息及其它保密事项与专有资料（以下简称“保密资料”）应当予以保密，未经信息披露方事先书面同意，不得向本协议以外的任何第三方披露；资料接受方可仅为本协议目的向其确有知悉必要的雇员披露其它方提供的保密资料，但同时须指示其雇员遵守本条规定的保密及不披露义务。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;2、本保密义务应在本协议期满、解除或终止后仍然有效。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;<strong>第十三条：违约</strong></p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;1、 除本协议另有约定外， 如甲方擅自改变本协议第一条规定的借款用途；或未经乙方同意擅自转让本协议项下借款债务以及提供虚假资料或者故意隐瞒重要事实的，即构成违约，丁方有权宣告借款提前到期甲方应向乙方支付借款本金总额的 10% 作为违约金。甲方须在丁方宣告借款提前到期后的三日内，向甲方融资平台账户一次性支付余下的所有本金、利息和违约金，丁方再根据其与乙方之间的约定指示第三方支付机构及监管银行向乙方划转该等资金。如甲方行为涉嫌犯罪的，丁方将有权向相关国家机关报案，追究甲方的刑事责任。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;2、因甲方严重违反还款义务，造成丙方履行担保代偿责任的，甲方应向乙方和丙方以借款本金总额为基数按每日 5‰ 的金额支付违约金（其中：丙方代偿前的该违约金支付给乙方，代偿后违约金支付给丙方）。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;3、丁方保留将甲方违约失信的相关信息向媒体进行披露的权利。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;4、甲方任何一期逾期的，自逾期之日起，以借款本金总额为基数按每日 5‰ 的金额承担违约金，直至清偿当期履行完毕。任何一期逾期超过5日，或者累计逾期达到3次的，丁方有权宣告借款提前到期，此种情形下，甲方还款顺序为逾期违约金、实现债权的费用、利息、本金。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;5、如发生上述违约情况之一的，乙方要求提前终止本协议并且甲方不能按照本协议约定向乙方一次性支付余下的所有本金、利息和违约金，则丙方须履行涉及的担保责任。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;<strong>第十四条：其他</strong></p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;1、本协议经甲乙双方通过融资平台以网络在线点击确认的方式签订。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;2、甲方发布的相应借款需求未在10个工作日内被全部满足并已经适当冻结相应拟出借资金的，自第10个工作日24：00时起，本协议自动终止，但甲方同意仅接受当时已冻结资金的除外；甲方将本协议下全部本金、利息、违约金及其他相关费用全部偿还完毕之时，本协议亦自动终止。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;3、本协议的任何修改、补充均须以丁方的融资平台电子文本形式作出。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;4、各方均确认，本协议的签订、生效和履行以不违反法律为前提。如果本协议中的任何一条或多条违反适用的法律，则该条将被视为无效，但该无效条款并不影响本协议其他条款的效力。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;5、如果各方在本协议履行过程中发生任何争议，应友好协商解决；协商不成的，任何一方均可按级别管辖向昆明市西山区人民法院或昆明市中级人民法院提起诉讼，诉讼费、律师代理等费用由败诉方承担，但丙方行使追偿权的诉讼管辖，由委托担保合同约定。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;6、各方委托融资平台保管所有与本协议有关的书面文件或电子信息。</p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;7、本协议中所使用的定义，除非在上下文中另有定义，应具有融资平台公布的《平台网站使用条款》中定义的含义。本协议中，除非另有规定，否则应适用融资平台公布的《平台网站使用条款》规定的释义规则。</p>
        <p style="">&nbsp;&nbsp;&nbsp;&nbsp;居间方：'.$hetong["name"].'&nbsp;&nbsp;&nbsp;&nbsp;<img src="'.$hetong_img.'" alt="" style="width:120px;height:120px;"/></p>
        <p style="padding-top:200px;display:none;">&nbsp;&nbsp;&nbsp;&nbsp;担保方：'.$dbinfo['title'].'</p>
        <p style="">&nbsp;&nbsp;&nbsp;&nbsp;'.date("Y年m月d日",$binfo["second_verify_time"]).'</p>
    </div>
</div>';
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->SetProtection(array('annot-forms'), $mInvest["user_phone"]);
        $pdf->Output($bid.date("Ymd",$iinfo["add_time"]).$iinfo["id"].'.pdf', 'D');
    }


    public function downloaddingtoubao(){
        $per = C('DB_PREFIX');
        $borrow_config = require C("APP_ROOT")."Conf/borrow_config.php";
        $type = $borrow_config['REPAYMENT_TYPE'];

        $invest_id=intval($_GET['id']);
        $borrow_id=intval($_GET['borrow_id']);

        if(empty($invest_id))  $this->display("dingtoubao");
        $datag = get_global_setting();
        $fee_rate = $datag['fee_invest_manage'];//投资者成交管理费费率
        $iinfo = M("transfer_borrow_investor")->field(true)->where("investor_uid={$this->uid} AND id={$invest_id}")->find();

        $binfo = M('transfer_borrow_info')->field(true)->find($iinfo['borrow_id']);
        $tou =  M('transfer_investor_detail')->where("invest_id={$iinfo['id']} AND investor_uid={$this->uid} ")->find();
        $detail = M("transfer_detail")->field(true)->find($iinfo['borrow_id']);
        $mBorrow = M("members m")->join("{$per}member_info mi ON mi.uid=m.id")->field('mi.real_name,mi.address,mi.cell_phone,m.user_name')->where("m.id={$binfo['borrow_uid']}")->find();
        $mInvest = M("members m")->join("{$per}member_info mi ON mi.uid=m.id")->field('mi.real_name,mi.address,mi.cell_phone,mi.idcard,m.user_name,m.user_email')->where("m.id={$iinfo['investor_uid']}")->find();
        $danbao = M('article')->field('id,title,art_img')->where("id={$binfo['danbao']}")->find();
        if(!is_array($tou)) $mBorrow['real_name'] = hidecard($mBorrow['real_name'],4);

        $binfo['repayment_name'] = $type[$binfo['repayment_type']];

        $bid = "SDHT-U-".str_repeat("0",5-strlen($iinfo['id'])).$iinfo['id'];

        $detailinfo = M('transfer_investor_detail d')
            ->join("{$per}transfer_borrow_investor bi ON bi.id=d.invest_id")
            ->join("{$per}members m ON m.id=d.investor_uid")
            ->field('d.borrow_id,d.investor_uid,d.borrow_uid,d.capital,sum(d.capital+d.interest-d.interest_fee) benxi,sum(d.interest-d.interest_fee) z_interest,d.deadline,d.total,m.user_name,bi.investor_capital,bi.add_time')->where("d.borrow_id={$iinfo['borrow_id']} and d.invest_id ={$iinfo['id']}")->group('d.investor_uid')->find();
        $time = M('transfer_borrow_investor')->field('id,add_time,deadline')->where("borrow_id={$iinfo['borrow_id']} order by add_time asc")->limit(1)->find();

        $deadline_last = $time['deadline'];

        $type1 = $this->gloconf['BORROW_USE'];
        $binfo['borrow_use'] = $type1[$binfo['borrow_use']];

        $type = $borrow_config['REPAYMENT_TYPE'];
        //echo $binfo['repayment_type'];
        //新增
        $prefix=C('DB_PREFIX');
        $map['i.investor_uid'] = $this->uid;
        $map['i.status'] = 1;
        $map['i.id']=$invest_id;
        $map['i.is_jijin'] = 1;
        $map['b.borrow_type'] = 6;
        $map['i.borrow_id']=$borrow_id;
        $field3 = "i.*,i.add_time as invest_time,i.receive_interest as ds_interest,m.user_name as borrow_user,b.borrow_duration,b.borrow_interest_rate,b.repayment_type,b.add_time as borrow_time,b.borrow_money,b.borrow_name,m.credits";
        $list3 = M("transfer_borrow_investor i")
            ->field($field3)->where($map)
            ->join("{$prefix}transfer_borrow_info b ON b.id=i.borrow_id")
            ->join( "{$prefix}members m ON m.id=b.borrow_uid")->order("i.id DESC")->select();
        $list4=M('transfer_investor_detail d')
            ->join("{$per}transfer_borrow_investor bi ON bi.id=d.invest_id")
            ->join("{$per}members m ON m.id=d.investor_uid")
            ->field('d.*')
            ->where("d.borrow_id={$iinfo['borrow_id']} and d.invest_id ={$iinfo['id']}")
            ->select();
        if($list4[0]['capital']==0){
            $way=0;
            $month_interest=$detailinfo['z_interest']/$list3[0]['borrow_duration'];
        }else{
            $way=1;//利息复投，挺扯淡的一个办法，没办法了，先这样暂时解决把
        }
        //新增结束
        $binfo['repayment_name'] = $type[$binfo['repayment_type']];

        $iinfo['repay'] = getFloatValue(($iinfo['investor_capital']+$iinfo['investor_interest'])/$binfo['borrow_duration'],2);
        $Bconfig = require C("APP_ROOT")."Conf/borrow_config.php";
        $ht=M('hetong')->field('hetong_img,name,dizhi,tel')->find();

        $detail_list = M('transfer_investor_detail')->field(true)->where("invest_id={$invest_id}")->select();

        $ht=M('hetong')->field('hetong_img,name,dizhi,tel')->find();

        $type1 = $this->gloconf['BORROW_USE'];
        $binfo['borrow_use'] = $type1[$binfo['borrow_use']];
        $ht=M('hetong')->field('hetong_img,name,dizhi,tel')->find();

        $type = $borrow_config['REPAYMENT_TYPE'];
        $binfo['repayment_name'] = $type[$binfo['repayment_type']];

        $hetongArr = M("hetong")->field('id,hetong_img,thumb_hetong_img,add_time,deal_user,name,dizhi,tel')->select();
        if(count($hetongArr)>0){
            $hetong = $hetongArr[0];

            if($hetong["hetong_img"]){
                $hetong_img = C('WEB_URL').$hetong["hetong_img"];
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

        $html = '<div style="font-size:26px;">';
        $html .= '<p style="text-align:center;font-size:36px;"><br/>优计划<span style="text-decoration:underline;">&nbsp;'.$binfo["borrow_name"].'&nbsp;</span>协议<br/></p>';

        $html .= '<p style="text-align:center"><span>编号：<span style="text-decoration: underline;"><u><strong>'.$bid.'</strong></u></span></span></p>';

        $html .='<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>';
        $html .='<p>尊敬的客户：<br/>
                网贷系统V4优计划（以下称"优计划"）旨在为投资理财用户提供效率更高、退出更加灵活、资金利用率更高的服务，以便更好地服务于出借人。
                </p>';

        $html .= '
    <p>甲方：<span style=" text-decoration:underline">&nbsp;';

        if($mInvest["real_name"]){
            $html .= $mInvest["real_name"];
        }else{
            $html .= "未填写";
        }



//            |default="未填写"}&nbsp;&nbsp;&nbsp;
        $html .= '</span></p>
    <p>身份证号码：<span style="text-decoration:underline">&nbsp;';

//        {$mInvest.idcard|default="未填写"}&nbsp;&nbsp;&nbsp;
        if($mInvest["idcard"]){
            $html .= $mInvest["idcard"];
        }else{
            $html .= "未填写";
        }

        $html .= '</span></p>
    <p>联系电话：<span style="text-decoration:underline">&nbsp;';

//        {$mInvest.cell_phone|default="未填写"}&nbsp;&nbsp;&nbsp;
        if($mInvest["cell_phone"]){
            $html .= $mInvest["cell_phone"];
        }else{
            $html .= "未填写";
        }

        $html .= '</span></p>
    <p>乙方：<span style="text-decoration:underline">&nbsp;';
//        {$ht.name|default="未填写"}
        if($ht["name"]){
            $html .= $ht["name"];
        }else{
            $html .= "未填写";
        }

        $html .= '</span></p>
    <p>住所：<span style="text-decoration:underline">&nbsp;';
        if($ht["dizhi"]){
            $html .= $ht["dizhi"];
        }else{
            $html .= "未填写";
        }

        $html .= '</span></p>
    <p>咨询电话：<span style="text-decoration:underline">&nbsp;';
        if($ht["tel"]){
            $html .= $ht["tel"];
        }else{
            $html .= "未填写";
        }

        $html .= '</span></p>
    <p></p>
    <p>甲乙双方经友好协商，本着平等自愿、诚实信用的原则，达成如下协议：</p>
    <p></p>
    <p>1、优计划服务意向</p>
    <p>&nbsp; 1.1&nbsp;在P2C模式下，乙方推出"出借人优先自动投标及到计划锁定结束按相关规则退出"的优计划计划，为加入优计划计划的出借人提供更加贴心、便捷的服务，并将尽最大努力维护出借人的合法利益。</p>
	<p>&nbsp; 1.2&nbsp;甲方同意加入本次优计划计划，并自愿遵守网贷系统V4网站的所有规则。</p>
	<br />
	<p>2、优计划金额</p>
	<p>&nbsp; 2.1&nbsp;申请加入时间：'.date("Y-m-d",$iinfo['add_time']).'  加入金额（单位:元）：   '.$list3[0]["investor_capital"].'   </p>
	<p>&nbsp; 2.2&nbsp;甲方加入本次优计划计划后，乙方将按照甲方首次加入计划的时间先后顺序，将甲方加入计划的金额在网贷系统V4P2C平台安排进入优先自动投标。</p>

<p>3、本次优计划计划的具体内容和要求如下：</p>
<p>&nbsp; 3.1&nbsp;名称：优计划-<u>'.$binfo["borrow_name"].'</u>（上下文均称"本次优计划计划"）</p>
<p>&nbsp; 3.2&nbsp;描述：甲方加入本次优计划计划后，在锁定期内，加入优计划计划的金额将被优先安排自动投标。锁定期结束，甲方可以自由选择继续参加或整体退出本次优计划计划。</p>

<p style="display:none;">&nbsp; 3.3&nbsp;加入金额要求：最低加入金额为人民币【100.00】元，并以人民币【100.00】整数倍递增，最高不超过人民币【500,000.00】元。</p>

<p>&nbsp; 3.4&nbsp;锁定期：自加入成功之日期起，甲方加入本期祁商通后为锁定期内，甲方加入本期通的资金不能提现；且甲方不能申请提前退出本期祁商通；锁定期为收益计算期。</p>

<p>&nbsp;3.6&nbsp; 锁定期：自首次计划加入日期至<span style=" text-decoration:underline">&nbsp;&nbsp;&nbsp;'.date("Y-m-d",$iinfo['deadline']).'&nbsp;&nbsp;&nbsp;</span>。锁定期内，甲方加入的优计划计划金额不能转让或提现。</p>

<p>&nbsp; 3.7&nbsp; 开放期：自锁定期结束次日开始。</p>

<p>&nbsp;3.8 &nbsp; 退出情形：锁定期内甲方不可将本次优计划计划金额提前退出。锁定结束之后，默认退出计划；甲方可以选择按相关规则将加入本次优计划计划的全部金额逐一退出；如选择继续持有，则该优计划计划中尚未到期的项目作为出借人投资的散标，出借人可以按照散标的处理规则自行选择转让或者持有到期，年化利率按照散标计算。退出后，甲方的本次优计划计划金额将不再被安排优先自动投标。</p>

<p>&nbsp;3.9 &nbsp;退出方式：甲方选择退出本次优计划计划的，3天之内平台将安排以转让优计划计划下相对应债权的方式实现退出，如3天之内未完成转让则由出借人继续持有未转出项目。如相对应的债权处于逾期状态的，暂不转让，需在相应债权清偿逾期欠款后转让或根据本金保障协议通过平台垫付后实现。</p>

<p>&nbsp;3.11 &nbsp; 甲方收益及支付：甲方的收益将按本次优计划计划所投标的对应的《借款协议》分别确认。根据所投项目的还款周期，优计划计划所投标的的利息收入将根据用户的选择（用户有三种选择：a.提现到银行卡，b.转入出借人在网贷系统V4平台的账户，c.利息复投），如果选择提现到银行卡则自动提取至甲方指定账户；如果选择转入到出借人自己的网贷系统V4账户，则利息按期自动转入；如果选择利息复投则系统会自动在优计划计划内自动投标。选择退出计划后，转让本次计划项下所有债权后的收益，也将提取至指定账户。</p>

<p>&nbsp;3.12 &nbsp; 相应费用：甲方加入优计划计划时，以加入优计划计划金额的0.00           % 向乙方支付加入费，此项费用由乙方另行收取，不从本次优计划计划金额中扣除；甲方以本次计划所投标的利息收入的&nbsp;&nbsp;&nbsp;'.$fee_rate.'%&nbsp;&nbsp;&nbsp; 向乙方支付服务费；每月提取本次计划项下所投标的利息收入，如果选择提现方式至银行卡账户的，提现费用按照'.$datag['web_name'].'现有规则执行。</p>

<p>4、优计划计划保障</p>

<p>&nbsp;4.1 &nbsp; 为降低甲方因投资标的过于集中而所带来的信用违约风险，乙方将对甲方加入本次优计划计划金额安排分散化的优先自动投标。</p>

<p>&nbsp;4.2 &nbsp; 为保证本次优计划计划的及时性，在甲方加入本次优计划计划时，一旦优计划计划满标审核通过即刻开始为甲方加入计划金额安排优先投标。</p>

<p>&nbsp;4.3 &nbsp; 为增加投标的优先性，乙方将为甲方加入的优计划计划金额安排优先自动投标，保障甲方加入计划金额（尚未订立借款协议的部分）可以按加入计划顺序优先进行自动投标。</p>

<p>5、意外事件</p>

<p> 如因司法机关或行政机关对甲方采取强制措施导致其本次优计划计划金额对应的资金被全部或部分扣划，视为甲方就全部本金进行了提前支取，本协议自动终止。本协议因此而自动终止的，甲方将不再享有相应收益。</p>



<p>6、税费</p>

<p> 甲方承担本优计划计划所获收益的应纳税额。</p>

<p>7、甲方声明和保证</p>

<p>&nbsp;7.1 &nbsp; 在签署本协议书以前，乙方已就本协议书及有关交易文件的全部条款和内容向甲方进行了详细的说明和解释，甲方已认真阅读本协议有关条款，对有关条款不存在任何疑问或异议，并对协议双方的权利、义务、责任与风险有清楚和准确的理解。</p>

<p>&nbsp;7.2 &nbsp; 甲方保证所使用的资金为合法取得，且具有排他性的支配权。</p>

<p>&nbsp;7.3 &nbsp; 甲方保证为履行本协议而向乙方提供的全部资料均真实、有效。</p>

<p>8、其他</p>

<p>&nbsp;8.1 &nbsp; 本次优计划计划不提供纸质账单。甲方需要通过网贷系统V4网站或客服人员、网站平台查询等方式了解相关信息。如未及时查询，或由于通讯故障、系统故障以及其他不可抗力等因素影响使甲方无法及时了解相关信息，由此产生的责任和风险由甲方自行承担。</p>

<p>&nbsp;8.2 &nbsp; 本次优计划计划并非独立于甲方在注册、使用网贷系统V4网站时需要遵守的相应规则和订立的相关协议。甲方必须遵守网贷系统V4的相关规则和签署的相关协议，如违背的，将自行承担相应后果。</p>

<p>&nbsp;8.3 &nbsp; 由于地震、火灾、战争等不可抗力导致的交易中断、延误的，甲乙双方互不追究责任。但应在条件允许的情况下，应采取一切必要的补救措施以减小不可抗力造成的损失。</p>

<p>&nbsp;8.4 &nbsp; 本次优计划计划金额未达到优计划计划规模要求，经网贷系统V4合理判断难以按照优计划计划协议约定向甲方提供相应服务的，网贷系统V4有权宣布优计划计划不成立。</p>

<p>&nbsp;8.5 &nbsp; 本次优计划计划内，如甲方追加优计划计划金额，则在甲方与乙方之间存在多份优计划计划协议书情况下，应以最后订立协议书所约定的内容为准。其中，每一份协议书均为对应甲方加入优计划计划金额时，甲乙双方的权利义务的约定。</p>

<p>&nbsp;8.6 &nbsp; 本协议项下产生的纠纷，双方先行协商解决，协商不成的，任何一方可向乙方所在地法院提起诉讼。</p>

<p>&nbsp;8.7 &nbsp; 本协议采用电子文本形式制成，并永久保存在乙方为此设立的专用服务器上备查，对各方均具有法律约束力。</p>
';
        $html .= '</div>';
        $pdf->writeHTML($html, true, false, true, false, '');
//            $pdf->SetProtection(array('annot-forms'), $mInvest["user_phone"]);
        $pdf->Output('hetong.pdf', 'D');
    }
}