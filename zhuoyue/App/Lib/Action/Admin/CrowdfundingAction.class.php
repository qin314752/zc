<?php
// 全局设置
class CrowdfundingAction extends ACommonAction
{

    public function index()
    {
        if($_GET['id']){
            $crowd_info=M('crowd_info')->find($_GET['id']);
            $this->assign('crowd_info', $crowd_info);
        }
        $this->assign('crowd_count',(M('crowd_info')->count('id'))+1);
            $list = M('crowd_config')->order("order_sn DESC")->select();
            $zcmin = explode("|", $list[0]['text']);//众筹最小投资额度
            $zcmax = explode("|", $list[1]['text']);//众筹最大投资额度
            $zccollect = explode("|", $list[2]['text']);//众筹集资期限
            $zcdeadline = explode("|", $list[3]['text']);//众筹最长持有期限

            $zc_min = array();
            foreach ($zcmin as $val) {
                $zc_min += array($val => $val . "元");
            }
            $zc_max = array();
            foreach ($zcmax as $val) {
                $zc_max += array($val => $val . "万元");
            }
            $zc_collect = array();
            foreach ($zccollect as $val) {
                $zc_collect += array($val => $val . "天");
            }
            $zc_deadline = array();
            foreach ($zcdeadline as $val) {
                $zc_deadline += array($val => $val . "个月");
            }
            $use_name = M('members')->field('id,user_name')->where("is_crowd_users=1")->select();
            $username = array();
            foreach ($use_name as $val) {
                $username += array($val['id'] => $val['user_name']);
            }
            $this->assign('user_name', $username);
            $this->assign('zc_deadline', $zc_deadline);
            $this->assign('zc_collect', $zc_collect);
            $this->assign('zc_max', $zc_max);
            $this->assign('zc_min', $zc_min);
        $article=M('article')->field('id,title')->where('type_id=59')->select();
        $che_article = array();
        foreach($article as $art){
            $che_article += array($art['id']=>$art['title']);
        }
        $this->assign('che_article',$che_article);

        $hetong = '<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-align:center">
    <span style=";font-family:Calibri;font-weight:bold;font-size:16px">委托协议</span><span style=";font-family:Calibri;font-size:16px">&nbsp;</span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-indent:336px;text-align:left">
    <span style=";font-family:Calibri;font-size:16px">协议编号：&nbsp;</span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-align:left">
    <span style=";font-family:Calibri;font-weight:bold;font-size:16px">甲方（委托方）：</span><span style=";font-family:Calibri;font-size:16px">&nbsp;</span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-align:left">
    <span style=";font-family:Calibri;font-weight:bold;font-size:16px">身份证号码：</span><span style=";font-family:Calibri;font-size:16px">&nbsp;</span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-align:left">
    <span style=";font-family:Calibri;font-weight:bold;font-size:16px">乙方（受托方）：</span><span style="font-family:Calibri;font-size:16px;font-weight: bold;">刘践迪</span></span><span style=";font-family:Calibri;font-size:16px">&nbsp;</span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-align:left">
    <span style=";font-family:Calibri;font-weight:bold;font-size:16px">丙方（担保方）：济南江融网络科技有限公司</span><span style=";font-family:Calibri;font-size:16px">&nbsp;</span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-align:left">
    <span style=";font-family:Calibri;font-weight:bold;font-size:16px">鉴于：</span><span style=";font-family:Calibri;font-size:16px">&nbsp;</span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-indent:32px;text-align:left">
    <span style=";font-family:Calibri;font-size:16px">甲方需购买</span><span style=";font-family:Calibri;text-underline:single;font-size:16px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style=";font-family:Calibri;font-size:16px">的车辆（以下&nbsp;简称<span style="font-family:Calibri">“</span><span style="font-family:宋体">该车辆</span><span style="font-family:Calibri">”</span><span style="font-family:宋体">），车架识别代码为</span></span><span style=";font-family:Calibri;text-underline:single;font-size:16px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style=";font-family:Calibri;font-size:16px">，发动机号码为</span><span style=";font-family:Calibri;text-underline:single;font-size:16px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style=";font-family:Calibri;font-size:16px">，注册日期为&nbsp;</span><span style=";font-family:Calibri;text-underline:single;font-size:16px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style=";font-family:Calibri;font-size:16px">；&nbsp;因该车辆购买价格较高，甲方无法以自有资金完全购买，考虑与其他意欲购买该车辆的自然人或法人（与其他参与了购买该车辆的实际持有人合称为<span style="font-family:Calibri">“</span><span style="font-family:宋体">合作人</span><span style="font-family:Calibri">”&nbsp;</span><span style="font-family:宋体">）共同出资购买、共同拥有该车辆。&nbsp;</span></span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-indent:32px;text-align:left">
    <span style=";font-family:Calibri;font-size:16px">现甲、乙、丙三方经友好协商，达成以下协议，以供三方共同&nbsp;遵守：&nbsp;</span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-align:left">
    <span style=";font-family:Calibri;font-weight:bold;font-size:16px">一、甲方委托的事项</span><span style=";font-family:Calibri;font-size:16px">&nbsp;</span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-indent:24px;text-align:left">
    <span style=";font-family:Calibri;font-size:16px">1.<span style="font-family:宋体">委托乙方与该车辆的原权属人沟通购买该车辆，办理付款、缴税、产权登记等相关手续；&nbsp;</span></span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-indent:24px;text-align:left">
    <span style=";font-family:Calibri;font-size:16px">2.<span style="font-family:宋体">委托乙方作为该车辆在车辆管理部门的名义登记人，代甲方持有该车辆的产权份额；&nbsp;</span></span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-indent:24px;text-align:left">
    <span style=";font-family:Calibri;font-size:16px">3.<span style="font-family:宋体">委托乙方对该车辆进行一般清洗、管理，并代缴相关费用；&nbsp;</span></span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-indent:24px;text-align:left">
    <span style=";font-family:Calibri;font-size:16px">4.<span style="font-family:宋体">委托乙方在成功购买该车辆后宣传并寻找有意向单独购买该车辆的优质客户，并引导客户看车等活动；&nbsp;</span></span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-indent:24px;text-align:left">
    <span style=";font-family:Calibri;font-size:16px">5.<span style="font-family:宋体">根据甲方及合作人的决定处置该车辆，并将处置该车辆所得款项扣除相关费用后按甲方及合作人对该车辆所持有的份额比例&nbsp;分配。&nbsp;</span></span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-align:left">
    <span style=";font-family:Calibri;font-weight:bold;font-size:16px">二、乙方的权利</span><span style=";font-family:Calibri;font-size:16px">&nbsp;</span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-indent:24px;text-align:left">
    <span style=";font-family:Calibri;font-size:16px">1.<span style="font-family:宋体">根据该车辆的市场价格变化及政策调整，向甲方及合作人发起处置该车辆的提议；&nbsp;</span></span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-indent:24px;text-align:left">
    <span style=";font-family:Calibri;font-size:16px">2.<span style="font-family:宋体">若发生影响该车辆权益的紧急事件，乙方有权作出有利于甲方及合作人权益的紧急处理；&nbsp;</span></span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-indent:24px;text-align:left">
    <span style=";font-family:Calibri;font-size:16px">3.<span style="font-family:宋体">根据甲方及合作人对该车辆的处置决定，选择该车辆的优质买受候选人；&nbsp;</span></span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-indent:24px;text-align:left">
    <span style=";font-family:Calibri;font-size:16px">4.<span style="font-family:宋体">乙方可在适当时候与甲方协商收购甲方对该车辆的占有份额；&nbsp;</span></span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-indent:24px;text-align:left">
    <span style=";font-family:Calibri;font-size:16px">5.<span style="font-family:宋体">如甲方转让其对该车辆的占有份额的，在同等条件下，乙方享有优先购买权。&nbsp;</span></span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-align:left">
    <span style=";font-family:Calibri;font-weight:bold;font-size:16px">三、乙方的义务</span><span style=";font-family:Calibri;font-size:16px">&nbsp;</span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-indent:24px;text-align:left">
    <span style=";font-family:Calibri;font-size:16px">1.<span style="font-family:宋体">以有利于甲方及合作人的方式善意管理该车辆，不定期向甲方及合作人汇报委托事项的进展情况；&nbsp;</span></span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-indent:24px;text-align:left">
    <span style=";font-family:Calibri;font-size:16px">2.<span style="font-family:宋体">成功购买该车辆后，不定期向甲方及合作人公布该车辆的产权状况、车辆状态；&nbsp;</span></span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-indent:24px;text-align:left">
    <span style=";font-family:Calibri;font-size:16px">3.<span style="font-family:宋体">关注该车辆的市场价格变化、政策调整等信息，并出具报告，供甲方及合作人及时获知该车辆的相关信息，保障其合法权益&nbsp;；&nbsp;</span></span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-indent:24px;text-align:left">
    <span style=";font-family:Calibri;font-size:16px">4.<span style="font-family:宋体">乙方应依甲方及合作人的决定处置该车辆，包括但不限于出售、出租、抵押、借用、装饰、改装等影响该车辆权益的行为；&nbsp;</span></span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-indent:24px;text-align:left">
    <span style=";font-family:Calibri;font-size:16px">5.<span style="font-family:宋体">甲方转让其对该车辆所占有的份额时，乙方应协助办理相关手续。&nbsp;</span></span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-align:left">
    <span style=";font-family:Calibri;font-weight:bold;font-size:16px">四、投票规则</span><span style=";font-family:Calibri;font-size:16px">&nbsp;</span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-indent:24px;text-align:left">
    <span style=";font-family:Calibri;font-size:16px">1.<span style="font-family:宋体">乙方可根据该车辆的市场价值变化在该众筹平台</span><span style="font-family:Calibri">“www.jinbailizc.cn”</span><span style="font-family:宋体">（以下简称</span><span style="font-family:Calibri">“</span><span style="font-family:宋体"> 金百利众筹</span><span style="font-family:Calibri">”</span><span style="font-family:宋体">）发起处置该车辆的投票，甲方及合作人可在投票期间对投票事项进行投票表决。&nbsp;</span></span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-indent:24px;text-align:left">
    <span style=";font-family:Calibri;font-size:16px">2.<span style="font-family:宋体">乙方将委托 金百利众筹以本协议第七条所述的方式通知甲方及合作人参与投票，并告知投票事项、投票期间及未及时投票的后果&nbsp;。若甲方在投票期间未进行任何投票活动的，则视为对投票事项内容的默认同意。&nbsp;</span></span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-indent:24px;text-align:left">
    <span style=";font-family:Calibri;font-size:16px">3.<span style="font-family:宋体">投票按甲方及所有合作人达到总人数的&nbsp;</span><span style="font-family:Calibri">51%</span><span style="font-family:宋体">（包含本数）以上同意即视为投票事项通过。&nbsp;</span></span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-indent:24px;text-align:left">
    <span style=";font-family:Calibri;font-size:16px">4.<span style="font-family:宋体">无论甲方及合作人以明示或者默认的形式做出的投票决定，都不可撤回或撤销，且为乙方执行投票决定的唯一指令，视为甲&nbsp;方自己真实的指令，甲方应对乙方忠实执行上述指令产生的任何结果承担责任。&nbsp;</span></span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-align:left">
    <span style=";font-family:Calibri;font-weight:bold;font-size:16px">五、丙方的担保责任</span><span style=";font-family:Calibri;font-size:16px">&nbsp;</span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-indent:24px;text-align:left">
    <span style=";font-family:Calibri;font-size:16px">1.<span style="font-family:宋体">丙方承诺并保证，在乙方出现下列情形时，对甲方造成的经济损失进行担保，担保数额以甲方参与购买该车辆投入的本金数&nbsp;额为限：&nbsp;</span></span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-indent:24px;text-align:left">
    <span style=";font-family:Calibri;font-size:16px">（<span style="font-family:Calibri">1</span><span style="font-family:宋体">）乙方未按约定，擅自挪用甲方投入乙方在&nbsp; 金百利众筹的关联账户用于购买该车辆的资金。&nbsp;</span></span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-indent:24px;text-align:left">
    <span style=";font-family:Calibri;font-size:16px">（<span style="font-family:Calibri">2</span><span style="font-family:宋体">）乙方未按约定将出售该车辆的款项扣除相&nbsp;关费用后按甲方占有的份额比例划转至甲方在 金百利众筹的关联账户。&nbsp;</span></span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-indent:24px;text-align:left">
    <span style=";font-family:Calibri;font-size:16px">（<span style="font-family:Calibri">3</span><span style="font-family:宋体">）其他乙方因违反国家法律、法规的规定而&nbsp;导致被吊销营业执照或被追究刑事责任的情形。&nbsp;</span></span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-indent:32px;text-align:left">
    <span style=";font-family:Calibri;font-size:16px">2.<span style="font-family:宋体">除本条第&nbsp;</span><span style="font-family:Calibri">1&nbsp;</span><span style="font-family:宋体">款所述情形外，丙方不对甲方参与该项目的任何亏损和收益负责。&nbsp;</span></span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-align:left">
    <span style=";font-family:Calibri;font-weight:bold;font-size:16px">六、费用</span><span style=";font-family:Calibri;font-size:16px">&nbsp;</span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-indent:24px;text-align:left">
    <span style=";font-family:Calibri;font-size:16px">1.<span style="font-family:宋体">甲方及合作人委托乙方购买的该车辆总价值为&nbsp;</span><span style="font-family:Calibri">___________&nbsp;</span><span style="font-family:宋体">元（大写元人民币），甲方购买所持有的份额&nbsp;占该车辆总额的</span><span style="font-family:Calibri">______%</span><span style="font-family:宋体">既为</span></span><span style=";font-family:Calibri;text-underline:single;font-size:16px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style=";font-family:Calibri;font-size:16px">元（大写&nbsp;</span><span style=";font-family:Calibri;text-underline:single;font-size:16px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style=";font-family:Calibri;font-size:16px">元人民币）；&nbsp;</span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-indent:24px;text-align:left">
    <span style=";font-family:Calibri;font-size:16px">2.<span style="font-family:宋体">乙方收取</span><span style="font-family:Calibri">____________________</span><span style="font-family:宋体">作为管理费；&nbsp;</span></span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-indent:24px;text-align:left">
    <span style=";font-family:Calibri;font-size:16px">3.<span style="font-family:宋体">乙方在代甲方购买、持有、管理及处置该车辆等过程中代缴的费用从处置该车辆所获得的款项中扣除；&nbsp;</span></span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-indent:24px;text-align:left">
    <span style=";font-family:Calibri;font-size:16px">4.<span style="font-family:宋体">如甲方因处置该车辆获得的收益需缴纳相关税费（如有）的，由甲方自行承担，也可由乙方从款项中扣除。&nbsp;</span></span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-indent:24px;text-align:left">
    <span style=";font-family:Calibri;font-size:16px">5.<span style="font-family:宋体">丙方收取</span><span style="font-family:Calibri">______________________</span><span style="font-family:宋体">作为担保费。&nbsp;</span></span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-indent:24px;text-align:left">
    <span style=";font-family:Calibri;font-size:16px">6.<span style="font-family:宋体">甲方委托乙方向 金百利众筹支付</span></span><span style=";font-family:Calibri;text-underline:single;font-size:16px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style=";font-family:Calibri;font-size:16px">作为平台服&nbsp;务费。&nbsp;</span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-align:left">
    <span style=";font-family:Calibri;font-weight:bold;font-size:16px">七、通知事项及方式</span><span style=";font-family:Calibri;font-size:16px">&nbsp;</span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-indent:24px;text-align:left">
    <span style=";font-family:Calibri;font-size:16px">1.<span style="font-family:宋体">乙方将通过发送手机短信、个人电子邮件（以甲方在 金百利众筹平台上注册时或更新时提供的信息为准）、 金百利众筹平台站内信和&nbsp;网站公告四种方式将下列事项告知甲方：&nbsp;</span></span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-indent:8px;text-align:left">
    <span style=";font-family:Calibri;font-size:16px">（<span style="font-family:Calibri">1</span><span style="font-family:宋体">）委托事项的进展情况；&nbsp;</span></span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-indent:8px;text-align:left">
    <span style=";font-family:Calibri;font-size:16px">（<span style="font-family:Calibri">2</span><span style="font-family:宋体">）对该车辆的维修、管理及代缴费用等情况&nbsp;；&nbsp;</span></span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-indent:8px;text-align:left">
    <span style=";font-family:Calibri;font-size:16px">（<span style="font-family:Calibri">3</span><span style="font-family:宋体">）车辆状况及价格变化、政策调整等信息的&nbsp;报告；&nbsp;</span></span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-indent:8px;text-align:left">
    <span style=";font-family:Calibri;font-size:16px">（<span style="font-family:Calibri">4</span><span style="font-family:宋体">）发生的紧急事件及处理情况；&nbsp;</span></span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-indent:8px;text-align:left">
    <span style=";font-family:Calibri;font-size:16px">（<span style="font-family:Calibri">5</span><span style="font-family:宋体">）需甲方及合作人投票决定的事项及投票结&nbsp;果；&nbsp;</span></span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-indent:8px;text-align:left">
    <span style=";font-family:Calibri;font-size:16px">（<span style="font-family:Calibri">6</span><span style="font-family:宋体">）根据本条第（</span><span style="font-family:Calibri">5</span><span style="font-family:宋体">）项的投票&nbsp;决定所处理的结果。&nbsp;</span></span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-indent:24px;text-align:left">
    <span style=";font-family:Calibri;font-size:16px">2.<span style="font-family:宋体">乙方经上述四种方式将通知事项发送给甲方，即视为成功送达。如甲方接收上述信息的手机号码、个人电子邮箱、 金百利众筹平台站内信地址发生变更的，甲方应&nbsp;及时更新其在 金百利众筹平台上的个人信息，如因甲方未及时更新而导致未能及时接收乙方通知的，由甲方自行承担相关后果。&nbsp;</span></span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-align:left">
    <span style=";font-family:Calibri;font-weight:bold;font-size:16px">八、协议的解除</span><span style=";font-family:Calibri;font-size:16px">&nbsp;</span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-indent:24px;text-align:left">
    <span style=";font-family:Calibri;font-size:16px">1.<span style="font-family:宋体">乙方根据本协议第二条第&nbsp;</span><span style="font-family:Calibri">5&nbsp;</span><span style="font-family:宋体">款购买甲方对该车辆所占有的全部份额后，本委托协议自动解除；&nbsp;</span></span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-indent:24px;text-align:left">
    <span style=";font-family:Calibri;font-size:16px">2.<span style="font-family:宋体">乙方根据甲方及合作人的处置决定处置该车辆并将甲方按约定可得的款项划入甲方在 金百利众筹的关联账户后，本协议自动解除&nbsp;。&nbsp;</span></span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-indent:24px;text-align:left">
    <span style=";font-family:Calibri;font-size:16px">3.<span style="font-family:宋体">甲方通过 金百利众筹</span><span style="font-family:Calibri">“</span><span style="font-family:宋体"> 金百利众筹</span><span style="font-family:Calibri">”</span><span style="font-family:宋体">产品协议转让专区转让其对该车辆占有的全部份额时，本协议自动解除。&nbsp;</span></span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-align:left">
    <span style=";font-family:Calibri;font-weight:bold;font-size:16px">九、特别提示</span><span style=";font-family:Calibri;font-size:16px">&nbsp;</span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-indent:24px;text-align:left">
    <span style=";font-family:Calibri;font-size:16px">1.<span style="font-family:宋体">甲方作为具有完全民事行为能力人，对本协议涉及事项的风险有充分的认知，一经签署本协议，即视为充分理解并完全接受&nbsp;本协议的内容。&nbsp;</span></span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-indent:24px;text-align:left">
    <span style=";font-family:Calibri;font-size:16px">2.<span style="font-family:宋体">乙方仅作为甲方及合作人表决的执行人，甲方对与合作人共同购买该车辆可能产生的亏损或收益的后果由其自行承担，与乙&nbsp;方无关；乙方不参与该车辆处置后的收益分成，也不负担处置该车辆产生的亏损。&nbsp;</span></span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-indent:24px;text-align:left">
    <span style=";font-family:Calibri;font-size:16px">3.<span style="font-family:宋体">乙方不承诺甲方对该车辆的处置会产生任何的收益。&nbsp;</span></span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-align:left">
    <span style=";font-family:Calibri;font-weight:bold;font-size:16px">十、其他事项</span><span style=";font-family:Calibri;font-size:16px">&nbsp;</span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-align:left">
    <span style=";font-family:Calibri;font-size:16px">&nbsp;&nbsp;</span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-indent:24px;text-align:left">
    <span style=";font-family:Calibri;font-size:16px">1.<span style="font-family:宋体">如因本协议所产生的争议，由甲、乙、丙三方友好协商。协商不成的，由车辆所在地人民法院管辖。&nbsp;</span></span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-indent:24px;text-align:left">
    <span style=";font-family:Calibri;font-size:16px">2.<span style="font-family:宋体">本协议为电子协议，自甲、乙、丙三方签字或盖章之日起生效&nbsp;</span></span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-align:left">
    <span style=";font-family:Calibri;font-weight:bold;font-size:16px">各方签署：&nbsp;</span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-align:left">
    <span style=";font-family:Calibri;font-weight:bold;font-size:16px">甲方：</span><span style=";font-family:Calibri;font-size:16px">&nbsp;</span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-align:left">
    <span style=";font-family:Calibri;font-weight:bold;font-size:16px">乙方：</span><span style=";font-family:Calibri;font-size:16px;font-weight: bold;">刘践迪</span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-align:left">
    <span style=";font-family:Calibri;font-weight:bold;font-size:16px">丙方：</span><span style="font-family:Calibri;font-size:16px;font-weight: bold;">济南江融网络科技有限公司
</span></span><span style=";font-family:Calibri;font-size:16px">&nbsp;</span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-align:left">
    <span style=";font-family:Calibri;font-weight:bold;font-size:16px">协议签订地：</span><span style=";font-family:Calibri;font-size:16px">山东省济南市市中区经一路明珠怡和商务港25A层25A17
</span>
</p>
<p style="margin-top:7px;margin-right:0;margin-bottom:7px;margin-left:0;margin-top:auto;margin-bottom:auto;text-align:left">
    <span style=";font-family:Calibri;font-weight:bold;font-size:16px">协议签署日期：</span><span style=";font-family:Calibri;font-size:16px">&nbsp;</span>
</p>
<p>
    <br/>
</p>';
        $this->assign('hetong',$hetong);
        $table = '<div style="width: 1200px;height: 220px;">
    <div style="width: 50%;float: left;height: 145px;padding-top: 27px;">
        <table style="border-collapse:collapse;width:361.1500pt;margin-left:6.7500pt;margin-right:6.7500pt;">
            <tbody>
            <tr style="height:19.4500pt;">
            <td rowspan="5" style="width:35.5500pt;padding:0.0000pt 5.4000pt 0.0000pt 5.4000pt ;border-left:0.5000pt solid rgb(220,220,220);border-right:0.5000pt solid rgb(220,220,220);border-top:0.5000pt solid rgb(220,220,220);border-bottom:0.5000pt solid rgb(220,220,220);background:rgb(231,236,238);" valign="center" width="47">
                <p style="margin-right:5.6500pt;margin-left:5.6500pt;text-align:left;">
                    <span style="font-family:微软雅黑;color:rgb(68,68,68);font-weight:bold;font-size:10.5000pt;">车<br />辆<br />参<br />数</span></p>
            </td>
            <td style="width:82.4500pt;padding:0.0000pt 5.4000pt 0.0000pt 5.4000pt ;border-left:none;border-right:0.5000pt solid rgb(220,220,220);border-top:0.5000pt solid rgb(220,220,220);border-bottom:0.5000pt solid rgb(220,220,220);background:rgb(255,255,255);" valign="center" width="109">
                <p style="text-align:left;">
                    <span style="font-family:微软雅黑;color:rgb(153,153,153);letter-spacing:0.0000pt;font-weight:normal;text-transform:none;font-style:normal;font-size:9.0000pt;">品牌</span><span style="font-family:微软雅黑;color:rgb(153,153,153);letter-spacing:0.0000pt;font-weight:normal;text-transform:none;font-style:normal;font-size:9.0000pt;">：</span></p>
            </td>
            <td style="width:75.6500pt;padding:0.0000pt 5.4000pt 0.0000pt 5.4000pt ;border-left:none;border-right:0.5000pt solid rgb(220,220,220);border-top:0.5000pt solid rgb(220,220,220);border-bottom:0.5000pt solid rgb(220,220,220);background:rgb(255,255,255);" valign="center" width="100">
                <p style="text-align:left;">
                    <span style="font-family:微软雅黑;color:rgb(68,68,68);font-weight:bold;font-size:10.5000pt;">奥迪</span></p>
            </td>
            <td style="width:76.2500pt;padding:0.0000pt 5.4000pt 0.0000pt 5.4000pt ;border-left:none;border-right:0.5000pt solid rgb(220,220,220);border-top:0.5000pt solid rgb(220,220,220);border-bottom:0.5000pt solid rgb(220,220,220);background:rgb(255,255,255);" valign="center" width="101">
                <p style="text-align:left;">
                    <span style="font-family:微软雅黑;color:rgb(153,153,153);letter-spacing:0.0000pt;font-weight:normal;text-transform:none;font-style:normal;font-size:9.0000pt;">级别：</span></p>
            </td>
            <td style="width:91.2500pt;padding:0.0000pt 5.4000pt 0.0000pt 5.4000pt ;border-left:none;border-right:0.5000pt solid rgb(220,220,220);border-top:0.5000pt solid rgb(220,220,220);border-bottom:0.5000pt solid rgb(220,220,220);background:rgb(255,255,255);" valign="center" width="121">
                <p style="text-align:left;">
                    <span style="font-family:微软雅黑;color:rgb(68,68,68);font-weight:bold;font-size:10.5000pt;">中型车</span></p>
            </td>
        </tr>
        <tr style="height:21.9500pt;">
            <td style="width:82.4500pt;padding:0.0000pt 5.4000pt 0.0000pt 5.4000pt ;border-left:none;border-right:0.5000pt solid rgb(220,220,220);border-top:none;border-bottom:0.5000pt solid rgb(220,220,220);background:rgb(255,255,255);" valign="center" width="109">
                <p style="text-align:left;">
                    <span style="font-family:微软雅黑;color:rgb(153,153,153);letter-spacing:0.0000pt;font-weight:normal;text-transform:none;font-style:normal;font-size:9.0000pt;">型号</span><span style="font-family:微软雅黑;color:rgb(153,153,153);letter-spacing:0.0000pt;font-weight:normal;text-transform:none;font-style:normal;font-size:9.0000pt;">：</span></p>
            </td>
            <td style="width:75.6500pt;padding:0.0000pt 5.4000pt 0.0000pt 5.4000pt ;border-left:none;border-right:0.5000pt solid rgb(220,220,220);border-top:none;border-bottom:0.5000pt solid rgb(220,220,220);background:rgb(255,255,255);" valign="center" width="100">
                <p style="text-align:left;">
                    <span style="font-family:微软雅黑;color:rgb(68,68,68);font-weight:bold;font-size:10.5000pt;">A4L</span></p>
            </td>
            <td style="width:76.2500pt;padding:0.0000pt 5.4000pt 0.0000pt 5.4000pt ;border-left:none;border-right:0.5000pt solid rgb(220,220,220);border-top:none;border-bottom:0.5000pt solid rgb(220,220,220);background:rgb(255,255,255);" valign="center" width="101">
                <p style="text-align:left;">
                    <span style="font-family:微软雅黑;color:rgb(153,153,153);letter-spacing:0.0000pt;font-weight:normal;text-transform:none;font-style:normal;font-size:9.0000pt;">变速箱：</span></p>
            </td>
            <td style="width:91.2500pt;padding:0.0000pt 5.4000pt 0.0000pt 5.4000pt ;border-left:none;border-right:0.5000pt solid rgb(220,220,220);border-top:none;border-bottom:0.5000pt solid rgb(220,220,220);background:rgb(255,255,255);" valign="center" width="121">
                <p style="text-align:left;">
                    <span style="font-family:微软雅黑;color:rgb(68,68,68);font-weight:bold;font-size:10.5000pt;">无级变速</span></p>
            </td>
        </tr>
        <tr style="height:25.7000pt;">
            <td style="width:82.4500pt;padding:0.0000pt 5.4000pt 0.0000pt 5.4000pt ;border-left:none;border-right:0.5000pt solid rgb(220,220,220);border-top:none;border-bottom:0.5000pt solid rgb(220,220,220);background:rgb(255,255,255);" valign="center" width="109">
                <p style="text-align:left;">
                    <span style="font-family:微软雅黑;color:rgb(153,153,153);letter-spacing:0.0000pt;font-weight:normal;text-transform:none;font-style:normal;font-size:9.0000pt;">颜色：</span></p>
            </td>
            <td style="width:75.6500pt;padding:0.0000pt 5.4000pt 0.0000pt 5.4000pt ;border-left:none;border-right:0.5000pt solid rgb(220,220,220);border-top:none;border-bottom:0.5000pt solid rgb(220,220,220);background:rgb(255,255,255);" valign="center" width="100">
                <p style="text-align:left;">
                    <span style="font-family:微软雅黑;color:rgb(68,68,68);font-weight:bold;font-size:10.5000pt;">白色</span></p>
            </td>
            <td style="width:76.2500pt;padding:0.0000pt 5.4000pt 0.0000pt 5.4000pt ;border-left:none;border-right:0.5000pt solid rgb(220,220,220);border-top:none;border-bottom:0.5000pt solid rgb(220,220,220);background:rgb(255,255,255);" valign="center" width="101">
                <p style="text-align:left;">
                    <span style="font-family:微软雅黑;color:rgb(153,153,153);letter-spacing:0.0000pt;font-weight:normal;text-transform:none;font-style:normal;font-size:9.0000pt;">驱动形式：</span></p>
            </td>
            <td style="width:91.2500pt;padding:0.0000pt 5.4000pt 0.0000pt 5.4000pt ;border-left:none;border-right:0.5000pt solid rgb(220,220,220);border-top:none;border-bottom:0.5000pt solid rgb(220,220,220);background:rgb(255,255,255);" valign="center" width="121">
                <p style="text-align:left;">
                    <span style="font-family:微软雅黑;color:rgb(68,68,68);font-weight:bold;font-size:10.5000pt;">前驱</span></p>
            </td>
        </tr>
        <tr style="height:22.7000pt;">
            <td style="width:82.4500pt;padding:0.0000pt 5.4000pt 0.0000pt 5.4000pt ;border-left:none;border-right:0.5000pt solid rgb(220,220,220);border-top:none;border-bottom:0.5000pt solid rgb(220,220,220);background:rgb(255,255,255);" valign="center" width="109">
                <p style="text-align:left;">
                    <span style="font-family:微软雅黑;color:rgb(153,153,153);letter-spacing:0.0000pt;font-weight:normal;text-transform:none;font-style:normal;font-size:9.0000pt;">排量：</span></p>
            </td>
            <td style="width:75.6500pt;padding:0.0000pt 5.4000pt 0.0000pt 5.4000pt ;border-left:none;border-right:0.5000pt solid rgb(220,220,220);border-top:none;border-bottom:0.5000pt solid rgb(220,220,220);background:rgb(255,255,255);" valign="center" width="100">
                <p style="text-align:left;">
                    <span style="font-family:微软雅黑;color:rgb(68,68,68);font-weight:bold;font-size:10.5000pt;">2.0T</span></p>
            </td>
            <td style="width:76.2500pt;padding:0.0000pt 5.4000pt 0.0000pt 5.4000pt ;border-left:none;border-right:0.5000pt solid rgb(220,220,220);border-top:none;border-bottom:0.5000pt solid rgb(220,220,220);background:rgb(255,255,255);" valign="center" width="101">
                <p style="text-align:left;">
                    <span style="font-family:微软雅黑;color:rgb(153,153,153);letter-spacing:0.0000pt;font-weight:normal;text-transform:none;font-style:normal;font-size:9.0000pt;">车身结构：</span></p>
            </td>
            <td style="width:91.2500pt;padding:0.0000pt 5.4000pt 0.0000pt 5.4000pt ;border-left:none;border-right:0.5000pt solid rgb(220,220,220);border-top:none;border-bottom:0.5000pt solid rgb(220,220,220);background:rgb(255,255,255);" valign="center" width="121">
                <p style="text-align:left;">
                    <span style="font-family:微软雅黑;color:rgb(68,68,68);font-weight:bold;font-size:10.5000pt;">三厢车</span></p>
            </td>
        </tr>
        <tr style="height:17.0000pt;">
            <td style="width:82.4500pt;padding:0.0000pt 5.4000pt 0.0000pt 5.4000pt ;border-left:none;border-right:0.5000pt solid rgb(220,220,220);border-top:none;border-bottom:0.5000pt solid rgb(220,220,220);background:rgb(255,255,255);" valign="center" width="109">
                <p style="text-align:left;">
                    <span style="font-family:微软雅黑;color:rgb(153,153,153);letter-spacing:0.0000pt;font-weight:normal;text-transform:none;font-style:normal;font-size:9.0000pt;">燃料：</span></p>
            </td>
            <td style="width:75.6500pt;padding:0.0000pt 5.4000pt 0.0000pt 5.4000pt ;border-left:none;border-right:0.5000pt solid rgb(220,220,220);border-top:none;border-bottom:0.5000pt solid rgb(220,220,220);background:rgb(255,255,255);" valign="center" width="100">
                <p style="text-align:left;">
                    <span style="font-family:微软雅黑;color:rgb(68,68,68);font-weight:bold;font-size:10.5000pt;">汽油</span></p>
            </td>
            <td style="width:76.2500pt;padding:0.0000pt 5.4000pt 0.0000pt 5.4000pt ;border-left:none;border-right:0.5000pt solid rgb(220,220,220);border-top:none;border-bottom:0.5000pt solid rgb(220,220,220);background:rgb(255,255,255);" valign="center" width="101">
                <p style="text-align:left;">
                    <span style="font-family:微软雅黑;color:rgb(153,153,153);letter-spacing:0.0000pt;font-weight:normal;text-transform:none;font-style:normal;font-size:9.0000pt;">整车质保：</span></p>
            </td>
            <td style="width:91.2500pt;padding:0.0000pt 5.4000pt 0.0000pt 5.4000pt ;border-left:none;border-right:0.5000pt solid rgb(220,220,220);border-top:none;border-bottom:0.5000pt solid rgb(220,220,220);background:rgb(255,255,255);" valign="center" width="121">
                <p style="text-align:left;">
                    <span style="font-family:微软雅黑;color:rgb(68,68,68);font-weight:bold;font-size:10.5000pt;">在保质期内</span></p>
            </td>
        </tr>
        </tbody>
    </table></div>
    <div style="width: 50%;float: left;height: 195px;">
        <p>
            <span style="font-family:宋体;font-size:10.5000pt;">&nbsp;</span></p>
        <table style="border-collapse:collapse;width:361.1500pt;margin-left:6.7500pt;margin-right:6.7500pt;">
            <tbody>
            <tr style="height:19.4500pt;">
                <td rowspan="5" style="width:35.5500pt;padding:0.0000pt 5.4000pt 0.0000pt 5.4000pt ;border-left:0.5000pt solid rgb(220,220,220);border-right:0.5000pt solid rgb(220,220,220);border-top:0.5000pt solid rgb(220,220,220);border-bottom:0.5000pt solid rgb(220,220,220);background:rgb(231,236,238);" valign="center" width="47">
                    <p style="margin-right:5.6500pt;margin-left:5.6500pt;text-align:left;">
                        <span style="font-family:微软雅黑;color:rgb(68,68,68);font-weight:bold;font-size:10.5000pt;">项<br />目<br />参<br />数</span></p>
                </td>
                <td style="width:82.4500pt;padding:0.0000pt 5.4000pt 0.0000pt 5.4000pt ;border-left:none;border-right:0.5000pt solid rgb(220,220,220);border-top:0.5000pt solid rgb(220,220,220);border-bottom:0.5000pt solid rgb(220,220,220);background:rgb(255,255,255);" valign="center" width="109">
                    <p style="text-align:left;">
                        <span style="font-family:微软雅黑;color:rgb(153,153,153);letter-spacing:0.0000pt;font-weight:normal;text-transform:none;font-style:normal;font-size:9.0000pt;">初次登记日期：</span></p>
                </td>
                <td style="width:75.6500pt;padding:0.0000pt 5.4000pt 0.0000pt 5.4000pt ;border-left:none;border-right:0.5000pt solid rgb(220,220,220);border-top:0.5000pt solid rgb(220,220,220);border-bottom:0.5000pt solid rgb(220,220,220);background:rgb(255,255,255);" valign="center" width="100">
                    <p style="text-align:left;">
                        <span style="font-family:微软雅黑;color:rgb(68,68,68);font-weight:bold;font-size:10.5000pt;">2015年11月</span></p>
                </td>
                <td style="width:76.2500pt;padding:0.0000pt 5.4000pt 0.0000pt 5.4000pt ;border-left:none;border-right:0.5000pt solid rgb(220,220,220);border-top:0.5000pt solid rgb(220,220,220);border-bottom:0.5000pt solid rgb(220,220,220);background:rgb(255,255,255);" valign="center" width="101">
                    <p style="text-align:left;">
                        <span style="font-family:微软雅黑;color:rgb(153,153,153);letter-spacing:0.0000pt;font-weight:normal;text-transform:none;font-style:normal;font-size:9.0000pt;">保养手册：</span></p>
                </td>
                <td style="width:91.2500pt;padding:0.0000pt 5.4000pt 0.0000pt 5.4000pt ;border-left:none;border-right:0.5000pt solid rgb(220,220,220);border-top:0.5000pt solid rgb(220,220,220);border-bottom:0.5000pt solid rgb(220,220,220);background:rgb(255,255,255);" valign="center" width="121">
                    <p style="text-align:left;">
                        <span style="font-family:微软雅黑;color:rgb(68,68,68);font-weight:bold;font-size:10.5000pt;">有</span></p>
                </td>
            </tr>
            <tr style="height:21.9500pt;">
                <td style="width:82.4500pt;padding:0.0000pt 5.4000pt 0.0000pt 5.4000pt ;border-left:none;border-right:0.5000pt solid rgb(220,220,220);border-top:none;border-bottom:0.5000pt solid rgb(220,220,220);background:rgb(255,255,255);" valign="center" width="109">
                    <p style="text-align:left;">
                        <span style="font-family:微软雅黑;color:rgb(153,153,153);letter-spacing:0.0000pt;font-weight:normal;text-transform:none;font-style:normal;font-size:9.0000pt;">车辆年限：</span></p>
                </td>
                <td style="width:75.6500pt;padding:0.0000pt 5.4000pt 0.0000pt 5.4000pt ;border-left:none;border-right:0.5000pt solid rgb(220,220,220);border-top:none;border-bottom:0.5000pt solid rgb(220,220,220);background:rgb(255,255,255);" valign="center" width="100">
                    <p style="text-align:left;">
                        <span style="font-family:微软雅黑;color:rgb(68,68,68);font-weight:bold;font-size:10.5000pt;">1年</span></p>
                </td>
                <td style="width:76.2500pt;padding:0.0000pt 5.4000pt 0.0000pt 5.4000pt ;border-left:none;border-right:0.5000pt solid rgb(220,220,220);border-top:none;border-bottom:0.5000pt solid rgb(220,220,220);background:rgb(255,255,255);" valign="center" width="101">
                    <p style="text-align:left;">
                        <span style="font-family:微软雅黑;color:rgb(153,153,153);letter-spacing:0.0000pt;font-weight:normal;text-transform:none;font-style:normal;font-size:9.0000pt;">备用钥匙：</span></p>
                </td>
                <td style="width:91.2500pt;padding:0.0000pt 5.4000pt 0.0000pt 5.4000pt ;border-left:none;border-right:0.5000pt solid rgb(220,220,220);border-top:none;border-bottom:0.5000pt solid rgb(220,220,220);background:rgb(255,255,255);" valign="center" width="121">
                    <p style="text-align:left;">
                        <span style="font-family:微软雅黑;color:rgb(68,68,68);font-weight:bold;font-size:10.5000pt;">有</span></p>
                </td>
            </tr>
            <tr style="height:25.7000pt;">
                <td style="width:82.4500pt;padding:0.0000pt 5.4000pt 0.0000pt 5.4000pt ;border-left:none;border-right:0.5000pt solid rgb(220,220,220);border-top:none;border-bottom:0.5000pt solid rgb(220,220,220);background:rgb(255,255,255);" valign="center" width="109">
                    <p style="text-align:left;">
                        <span style="font-family:微软雅黑;color:rgb(153,153,153);letter-spacing:0.0000pt;font-weight:normal;text-transform:none;font-style:normal;font-size:9.0000pt;">过户次数：</span></p>
                </td>
                <td style="width:75.6500pt;padding:0.0000pt 5.4000pt 0.0000pt 5.4000pt ;border-left:none;border-right:0.5000pt solid rgb(220,220,220);border-top:none;border-bottom:0.5000pt solid rgb(220,220,220);background:rgb(255,255,255);" valign="center" width="100">
                    <p style="text-align:left;">
                        <span style="font-family:微软雅黑;color:rgb(68,68,68);font-weight:bold;font-size:10.5000pt;">2次</span></p>
                </td>
                <td style="width:76.2500pt;padding:0.0000pt 5.4000pt 0.0000pt 5.4000pt ;border-left:none;border-right:0.5000pt solid rgb(220,220,220);border-top:none;border-bottom:0.5000pt solid rgb(220,220,220);background:rgb(255,255,255);" valign="center" width="101">
                    <p style="text-align:left;">
                        <span style="font-family:微软雅黑;color:rgb(153,153,153);letter-spacing:0.0000pt;font-weight:normal;text-transform:none;font-style:normal;font-size:9.0000pt;">登记证书：</span></p>
                </td>
                <td style="width:91.2500pt;padding:0.0000pt 5.4000pt 0.0000pt 5.4000pt ;border-left:none;border-right:0.5000pt solid rgb(220,220,220);border-top:none;border-bottom:0.5000pt solid rgb(220,220,220);background:rgb(255,255,255);" valign="center" width="121">
                    <p style="text-align:left;">
                        <span style="font-family:微软雅黑;color:rgb(68,68,68);font-weight:bold;font-size:10.5000pt;">有</span></p>
                </td>
            </tr>
            <tr style="height:22.7000pt;">
                <td style="width:82.4500pt;padding:0.0000pt 5.4000pt 0.0000pt 5.4000pt ;border-left:none;border-right:0.5000pt solid rgb(220,220,220);border-top:none;border-bottom:0.5000pt solid rgb(220,220,220);background:rgb(255,255,255);" valign="center" width="109">
                    <p style="text-align:left;">
                        <span style="font-family:微软雅黑;color:rgb(153,153,153);letter-spacing:0.0000pt;font-weight:normal;text-transform:none;font-style:normal;font-size:9.0000pt;">行驶里程：</span></p>
                </td>
                <td style="width:75.6500pt;padding:0.0000pt 5.4000pt 0.0000pt 5.4000pt ;border-left:none;border-right:0.5000pt solid rgb(220,220,220);border-top:none;border-bottom:0.5000pt solid rgb(220,220,220);background:rgb(255,255,255);" valign="center" width="100">
                    <p style="text-align:left;">
                        <span style="font-family:微软雅黑;color:rgb(68,68,68);font-weight:bold;font-size:10.5000pt;">20000KM</span></p>
                </td>
                <td style="width:76.2500pt;padding:0.0000pt 5.4000pt 0.0000pt 5.4000pt ;border-left:none;border-right:0.5000pt solid rgb(220,220,220);border-top:none;border-bottom:0.5000pt solid rgb(220,220,220);background:rgb(255,255,255);" valign="center" width="101">
                    <p style="text-align:left;">
                        <span style="font-family:微软雅黑;color:rgb(153,153,153);letter-spacing:0.0000pt;font-weight:normal;text-transform:none;font-style:normal;font-size:9.0000pt;">行驶证书：</span></p>
                </td>
                <td style="width:91.2500pt;padding:0.0000pt 5.4000pt 0.0000pt 5.4000pt ;border-left:none;border-right:0.5000pt solid rgb(220,220,220);border-top:none;border-bottom:0.5000pt solid rgb(220,220,220);background:rgb(255,255,255);" valign="center" width="121">
                    <p style="text-align:left;">
                        <span style="font-family:微软雅黑;color:rgb(68,68,68);font-weight:bold;font-size:10.5000pt;">有</span></p>
                </td>
            </tr>
            <tr style="height:17.0000pt;">
                <td style="width:82.4500pt;padding:0.0000pt 5.4000pt 0.0000pt 5.4000pt ;border-left:none;border-right:0.5000pt solid rgb(220,220,220);border-top:none;border-bottom:0.5000pt solid rgb(220,220,220);background:rgb(255,255,255);" valign="center" width="109">
                    <p style="text-align:left;">
                        <span style="font-family:微软雅黑;color:rgb(153,153,153);letter-spacing:0.0000pt;font-weight:normal;text-transform:none;font-style:normal;font-size:9.0000pt;">是否在保：</span></p>
                </td>
                <td style="width:75.6500pt;padding:0.0000pt 5.4000pt 0.0000pt 5.4000pt ;border-left:none;border-right:0.5000pt solid rgb(220,220,220);border-top:none;border-bottom:0.5000pt solid rgb(220,220,220);background:rgb(255,255,255);" valign="center" width="100">
                    <p style="text-align:left;">
                        <span style="font-family:微软雅黑;color:rgb(68,68,68);font-weight:bold;font-size:10.5000pt;">是</span></p>
                </td>
                <td style="width:76.2500pt;padding:0.0000pt 5.4000pt 0.0000pt 5.4000pt ;border-left:none;border-right:0.5000pt solid rgb(220,220,220);border-top:none;border-bottom:0.5000pt solid rgb(220,220,220);background:rgb(255,255,255);" valign="center" width="101">
                    <p style="text-align:left;">
                        <span style="font-family:微软雅黑;color:rgb(153,153,153);letter-spacing:0.0000pt;font-weight:normal;text-transform:none;font-style:normal;font-size:9.0000pt;">原车漆面积：</span></p>
                </td>
                <td style="width:91.2500pt;padding:0.0000pt 5.4000pt 0.0000pt 5.4000pt ;border-left:none;border-right:0.5000pt solid rgb(220,220,220);border-top:none;border-bottom:0.5000pt solid rgb(220,220,220);background:rgb(255,255,255);" valign="center" width="121">
                    <p style="text-align:left;">
                        <span style="font-family:微软雅黑;color:rgb(68,68,68);font-weight:bold;font-size:10.5000pt;">93%</span></p>
                </td>
            </tr>
            </tbody>
        </table>

    </div>
</div>
<div style="width: 1200px;float: left;margin-left: 8px;">
    <table style="border-collapse:collapse;width:1083px;">
        <tbody>
        <tr style="height:36.9500pt;">
            <td style="width:189.4000pt;padding:0.0000pt 5.4000pt 0.0000pt 5.4000pt ;border-left:0.5000pt solid rgb(220,220,220);border-right:0.5000pt solid rgb(220,220,220);border-top:0.5000pt solid rgb(220,220,220);border-bottom:0.5000pt solid rgb(220,220,220);background:rgb(231,236,238);" valign="center" width="252">
                <p style="text-align:center;">
                    <span style="font-family:微软雅黑;color:rgb(68,68,68);font-weight:bold;font-size:10.5000pt;">新车指导价</span></p>
            </td>
            <td style="width:189.4000pt;padding:0.0000pt 5.4000pt 0.0000pt 5.4000pt ;border-left:none;border-right:0.5000pt solid rgb(220,220,220);border-top:0.5000pt solid rgb(220,220,220);border-bottom:0.5000pt solid rgb(220,220,220);background:rgb(231,236,238);" valign="center" width="252">
                <p style="text-align:center;">
                    <span style="font-family:微软雅黑;color:rgb(68,68,68);font-weight:bold;font-size:10.5000pt;">车行指导价</span></p>
            </td>
            <td style="width:189.5000pt;padding:0.0000pt 5.4000pt 0.0000pt 5.4000pt ;border-left:none;border-right:0.5000pt solid rgb(220,220,220);border-top:0.5000pt solid rgb(220,220,220);border-bottom:0.5000pt solid rgb(220,220,220);background:rgb(231,236,238);" valign="center" width="252">
                <p style="text-align:center;">
                    <span style="font-family:微软雅黑;color:rgb(68,68,68);font-weight:bold;font-size:10.5000pt;">预计销售价</span></p>
            </td>
        </tr>
        <tr style="height:27.9500pt;">
            <td style="width:189.4000pt;padding:0.0000pt 5.4000pt 0.0000pt 5.4000pt ;border-left:0.5000pt solid rgb(220,220,220);border-right:0.5000pt solid rgb(220,220,220);border-top:none;border-bottom:0.5000pt solid rgb(220,220,220);background:rgb(255,255,255);" valign="center" width="252">
                <p style="text-align:center;">
                    <span style="font-family:微软雅黑;color:rgb(68,68,68);font-weight:bold;font-size:10.5000pt;">48.9万元</span></p>
            </td>
            <td style="width:189.4000pt;padding:0.0000pt 5.4000pt 0.0000pt 5.4000pt ;border-left:none;border-right:0.5000pt solid rgb(220,220,220);border-top:none;border-bottom:0.5000pt solid rgb(220,220,220);background:rgb(255,255,255);" valign="center" width="252">
                <p style="text-align:center;">
                    <span style="font-family:微软雅黑;color:rgb(68,68,68);font-weight:bold;font-size:10.5000pt;">35.9万元</span></p>
            </td>
            <td style="width:189.5000pt;padding:0.0000pt 5.4000pt 0.0000pt 5.4000pt ;border-left:none;border-right:0.5000pt solid rgb(220,220,220);border-top:none;border-bottom:0.5000pt solid rgb(220,220,220);background:rgb(255,255,255);" valign="center" width="252">
                <p style="text-align:center;">
                    <span style="font-family:微软雅黑;color:rgb(68,68,68);font-weight:bold;font-size:10.5000pt;">37.9万元</span></p>
            </td>
        </tr>
        </tbody>
    </table>
</div>';
        $this->assign('table',$table);
        $this->display();
    }

    public function add(){

//        dump($_POST['crowd_money']);
//        dump($_POST['zc_min']);
//        exit;
        if(!$_POST['crowd_info']) $this->error("车辆参数不能为空");
        if(!$_POST['crowd_car_zk']) $this->error("车辆状况不能为空");
        //if(!$_POST['crowd_car_xq']) $this->error("项目详情不能为空");
        if(!$_POST['crowd_agreement']) $this->error("合同不能为空");
        if(!$_POST['swfimglist']) $this->error("车辆图片不能为空");
        if(intval($_POST['crowd_money']) < intval($_POST['zc_min'])) $this->error("集资金额不能小于最小投资额度");
        if($_POST['crowd_money']%100!= 0) $this->error("集资金额必须为100的倍数");
        if(!$_POST['back_rate']) $this->error("分红比例不能为空！");
        if(!$_POST['withdraw_rate']) $this->error("溢价回购率不能为空！");
        if(!is_numeric($_POST['back_rate'])) $this->error("分红比例必须为数字！");
        if(!is_numeric($_POST['withdraw_rate'])) $this->error("溢价回购率必须为数字！");
        $data['crowd_name']=$_POST['crowd_name'];
        $data['user_id']=$_POST['user_name'];
        if($_POST['che_article']){
            $data['car_dealer']=$_POST['che_article'];
        }
        //$data['car_dealer']=$_POST['che_article'];
        $data['crowd_money']=$_POST['crowd_money'];
        $data['crowd_duration']=$_POST['zc_collect'];
        $data['min_money']=$_POST['zc_min'];
        //更改最大投资额度为项目金额的50%（后台配置）
        $zc_max= M('crowd_config')->field('text')->find('2');
        if($zc_max['text']<=0) $this->error("后台配置文件中最大投资额度必须大于0");
        $c_max=$_POST['crowd_money']*$zc_max['text']/10;
        if($c_max<$data['min_money']) $this->error("最小投资额度必须小于最大投资额度");
        $data['max_money']=$c_max;
        $data['is_use']=$_POST['is_use'];
        $data['max_duration']=$_POST['zc_deadline'];
        $data['car_parameter']=$_POST['crowd_info'];
        $data['car_info']=$_POST['crowd_car_zk'];
        $data['crowd_agreement']=$_POST['crowd_agreement'];
        $data['back_rate'] = $_POST['back_rate'];
        $data['withdraw_rate'] = $_POST['withdraw_rate'];
        $data['crowd_xq'] = $_POST['crowd_car_xq'];
        $picinfo = array();
        require_once("/CORE/Extend/Library/Think/Image.class.php");
       // require_once("App/Lib/Image/ImageText.class.php");
        foreach($_POST['picinfo'] as $key=>$v){
            $picinfo[$key]['info'] =$_POST['picinfo'][$key];
        }
        foreach($_POST['swfimglist'] as $key=>$v){
            $l_img= $_POST['swfimglist'][$key];
            $image = new \Think\Image();
            $new_img_name = time().rand(1,1000).'.jpg';
            $text = empty($picinfo[$key]['info'])?" 金百利众筹":$picinfo[$key]['info'];
           // $image->open("./".$l_img)->text($text,'./simsun.ttc',40,'#fff',\Think\Image::IMAGE_WATER_SOUTH)->save("Static/Uploads/Product/".$new_img_name);
            $sy=M('crowd_config')->where(" type='watermark' ")->find();
            if($sy){
                $image->open("./".$l_img)->water(substr($sy['text'],1),9,50)->save("Static/Uploads/Product/".$new_img_name);
            }else{
                $image->open("./".$l_img)->save("Static/Uploads/Product/".$new_img_name);
            }


            //获取图像信息
            //调试加文字水印
            //创建图片的实例
            //end
            @unlink($l_img);
            $picinfo[$key]['img'] = "/Static/Uploads/Product/".$new_img_name;
        }
        $data['crowd_picture']=serialize($picinfo);
        //a:1:{i:0;a:2:{s:4:"info";s:9:" 金百利众筹";s:3:"img";s:41:"/Static/Uploads/Product/1459320328717.jpg";}}
        $data['status']=1;
        $data['add_time']=time();
        $data['start_time']=strtotime($_POST['begin']);
        $data['add_ip']=$_SERVER["REMOTE_ADDR"];
        $data['car_type']=$_POST['car_type'];//var_dump(M('crowd_info')->add($data));exit();
		if(!empty($_POST['mima'])){         //众筹密码
        $data['mima']= MD5($_POST['mima']);
        $data['yuanmi']=$_POST['mima'];
        }else{
            $data['mima']=NULL;
			$data['yuanmi']=NULL;
        }
        $crowd_id=M('crowd_info')->add($data);
        file_put_contents('crowd.txt', M('crowd_info')->getLastSql());
        if($crowd_id){
            crowdAuto($crowd_id,$data['crowd_money']);
            $this->success("发布成功","__URL__/sell");
        }
		//else $this->error("集资金额不能小于最小投资额度");
		else $this->error("发布失败");
    }

    //投票
    public function fully(){
        //分页处理
        import("ORG.Util.Page");
        $size=10;
        $count = M('crowd_info')->where('status=2 or status=3')->count('id');
        $p = new Page($count,$size);
        $page = $p->show();
        $Lsql = "{$p->firstRow},{$p->listRows}";

        $per = C('DB_PREFIX');
        $list = M('crowd_info ci')->
        field("ci.*,m.user_name")
            ->join("{$per}members m ON m.id=ci.user_id")
            ->where('ci.status=2 or ci.status=3')->order('id DESC')->limit($Lsql)
            ->select();
        //众筹的投票状态
        for($i=0;$i<count($list);$i++){
            $status=M('crowd_voting')
                ->field('id,status')
                ->where('crowd_id='.$list[$i]['id'])
                ->order('id DESC')
                ->find();
            $list[$i]['voting_status']=$status['status'];
            $list[$i]['voting_id']=$status['id'];
        }
        //dump($list);
        $this->assign('pagebar',$page);
        $this->assign('list',$list);
        $this->display();
    }

    //swf上传图片
    public function swfUpload(){
        if($_POST['picpath']){
            $imgpath = substr($_POST['picpath'],1);
            if(in_array($imgpath,$_SESSION['imgfiles'])){
                unlink(C("WEB_ROOT").$imgpath);
                $thumb = get_thumb_pic($imgpath);
                $res = unlink(C("WEB_ROOT").$thumb);
                if($res) $this->success("删除成功","",$_POST['oid']);
                else $this->error("删除失败","",$_POST['oid']);
            }else{
                $this->error("图片不存在","",$_POST['oid']);
            }
        }else{
            $this->savePathNew = C('ADMIN_UPLOAD_DIR').'Product/' ;
            $this->thumbMaxWidth = C('PRODUCT_UPLOAD_W');
            $this->thumbMaxHeight = C('PRODUCT_UPLOAD_H');
            $this->saveRule = date("YmdHis",time()).rand(0,1000);
            $info = $this->CUpload();
            //require_once("/CORE/Extend/Library/Think/Image.class.php");
            //$image = new \Think\Image(); 
            //$image->open("./".$info[0]['savepath'].$info[0]['savename'])->water('./Style/logo.png',\Think\Image::IMAGE_WATER_CENTER,50)->save("./".$info[0]['savepath'].$info[0]['savename']); 
//            $str= var_export($info,true);
//            file_put_contents('file.txt',$str);
            $data['product_thumb'] = $info[0]['savepath'].$info[0]['savename'];
            if(!isset($_SESSION['count_file'])) $_SESSION['count_file']=1;
            else $_SESSION['count_file']++;
            $_SESSION['imgfiles'][$_SESSION['count_file']] = $data['product_thumb'];
            echo "{$_SESSION['count_file']}:".__ROOT__."/".$data['product_thumb'];//返回给前台显示缩略图
        }
    }
    public function sell()
    {
        //分页处理
        import("ORG.Util.Page");
        $size=10;
        $count = M('crowd_info')->where('status=1')->count('id');
        $p = new Page($count,$size);
        $page = $p->show();
        $Lsql = "{$p->firstRow},{$p->listRows}";

        $per = C('DB_PREFIX');
       $list = M('crowd_info ci')->
           field("ci.*,m.user_name")
           ->join("{$per}members m ON m.id=ci.user_id")
           ->where('ci.status=1')->limit($Lsql)
           ->select();

       $this->assign("pagebar", $page);
        $this->assign('list',$list);
        $this->display();
    }
    public function edit()
    {
        if($_GET['id']){
            $crowd_info=M('crowd_info')->find($_GET['id']);

            $this->assign('crowd_info', $crowd_info);
        }
        $list = M('crowd_config')->order("order_sn DESC")->select();
        $zcmin = explode("|", $list[0]['text']);//众筹最小投资额度
        $zcmax = explode("|", $list[1]['text']);//众筹最大投资额度
        $zccollect = explode("|", $list[2]['text']);//众筹集资期限
        $zcdeadline = explode("|", $list[3]['text']);//众筹最长持有期限

        $zc_min = array();
        foreach ($zcmin as $val) {
            $zc_min += array($val => $val . "元");
        }
        $zc_max = array();
        foreach ($zcmax as $val) {
            $zc_max += array($val => $val . "万元");
        }
        $zc_collect = array();
        foreach ($zccollect as $val) {
            $zc_collect += array($val => $val . "天");
        }
        $zc_deadline = array();
        foreach ($zcdeadline as $val) {
            $zc_deadline += array($val => $val . "个月");
        }
    
        $use_name = M('members')->field('id,user_name')->where("is_crowd_users=1")->select();

        $username = array();
        foreach ($use_name as $val) {
            $username += array($val['id'] => $val['user_name']);
        }
        $this->assign('user_name', $username);
        $this->assign('zc_deadline', $zc_deadline);
        $this->assign('zc_collect', $zc_collect);
        $this->assign('zc_max', $zc_max);
        $this->assign('zc_min', $zc_min);
        $this->display();
    }
    public function doedit()
    {
        $id = $_POST['id'];
        if(!$_POST['crowd_info']) $this->error("车辆参数不能为空");
        if(!$_POST['crowd_car_zk']) $this->error("车辆状况不能为空");
        if(!$_POST['crowd_agreement']) $this->error("合同不能为空");
        //if(!$_POST['crowd_car_xq']) $this->error("项目详情不能为空");
        if(!$_POST['swfimglist']) $this->error("车辆图片不能为空");
        if($_POST['crowd_money']<$_POST['zc_min']) $this->error("集资金额不能小于最小投资额度");
        $data['crowd_name']=$_POST['crowd_name'];
        $data['user_id']=$_POST['user_name'];
        $data['crowd_money']=$_POST['crowd_money'];
        $data['crowd_duration']=$_POST['zc_collect'];
        $data['min_money']=$_POST['zc_min'];
        //$data['max_money']=$_POST['zc_max'];
        $data['is_use']=$_POST['is_use'];
        $data['max_duration']=$_POST['zc_deadline'];
        $data['car_parameter']=$_POST['crowd_info'];
        $data['car_info']=$_POST['crowd_car_zk'];
        $data['crowd_agreement']=$_POST['crowd_agreement'];
        $data['back_rate'] = $_POST['back_rate'];
        $data['withdraw_rate'] = $_POST['withdraw_rate'];
        $data['crowd_xq'] = $_POST['crowd_car_xq'];
        $data['start_time']=strtotime($_POST['begin']);
        $picinfo = array();
        require_once("/CORE/Extend/Library/Think/Image.class.php");
        // require_once("App/Lib/Image/ImageText.class.php");
        foreach($_POST['picinfo'] as $key=>$v){
            $picinfo[$key]['info'] =$_POST['picinfo'][$key];
        }
        foreach($_POST['swfimglist'] as $key=>$v){
            $l_img= $_POST['swfimglist'][$key];
            $image = new \Think\Image();
            $new_img_name = time().rand(1,1000).'.jpg';
            $text = empty($picinfo[$key]['info'])?" 金百利众筹":$picinfo[$key]['info'];
//            $image->open("./".$l_img)->text($text,'./simsun.ttc',40,'#fff',\Think\Image::IMAGE_WATER_SOUTH)->save("Static/Uploads/Product/".$new_img_name);
            //获取图像信息
            //调试加文字水印
            //创建图片的实例
            //end
            @unlink($l_img);
            $picinfo[$key]['img'] = $l_img;
        }
        $data['crowd_picture']=serialize($picinfo);
        $data['status']=1;
        $data['add_ip']=$_SERVER["REMOTE_ADDR"];
        $data['car_type']=$_POST['car_type'];
		if(!empty($_POST['mima'])){            //众筹密码
        $data['mima']= MD5($_POST['mima']);
        $data['yuanmi']=$_POST['mima'];
        }else{
            $data['mima']=NULL;
			$data['yuanmi']=NULL;
        }
        $crowd_id = M('crowd_info')->where('id = '.$id)->save($data);
        if($crowd_id){
            $this->success("修改成功!","__URL__/sell");
        }else{
            $this->error('修改失败！');
        }

    }
    public function mb_unserialize($serial_str) {
        $serial_str= str_replace("\r", "", $serial_str);
        $serial_str= preg_replace('!s:(\d+):"(.*?)";!se', "'s:'.strlen('$2').':\"$2\";'", $serial_str );
        return unserialize($serial_str);
    }
    public function settings(){
        if($_GET['id']){
            $list = M('crowd_info')->find($_GET['id']);
            $list['count']=M('crowd_investor')->where('crowd_id='.$list['id'])->count('distinct  user_id');
            $crowd_config = M('crowd_config')->order("order_sn DESC")->select();
            $zc_deadline = explode("|", $crowd_config[4]['text']);//众筹最小投资额度
            $deadline = array();
            foreach ($zc_deadline as $val) {
                $deadline += array($val => $val . "小时");
            }
            $this->assign('deadline',$deadline);
            $this->assign('list',$list);
            $this->display();

        }else {
            $data['crowd_id']=$_POST['crowd_id'];
            $data['crowd_money']=$_POST['crowd_money'];
            $data['vote_money']=$_POST['voting_money'];
            $data['status']=1;
            $data['deadline']=strtotime(date("Y-m-d H:i:s",strtotime("+".$_POST['deadline']." hours",time())));
            $data['add_time']=time();
            $voting_id=M('crowd_voting')->add($data);
            if($voting_id) {
                //发起投票成功，发送短信
                //给每个投资用户发送短信
                $sql1="SELECT DISTINCT user_id FROM nuomi_crowd_investor WHERE crowd_id =".$_POST['crowd_id'];
                $model1=M();
                $arr1 = $model1->query($sql1);
                foreach($arr1 as $key=>$v){
                    $user_id = $arr1[$key]['user_id'];
                    $userinfo = M('members')->field("user_name,user_phone")->where('id = '.$user_id)->find();
                    addInnerMsg($user_id,"您投资的众筹正在发起投票","尊敬的".$userinfo['user_name']."，您好，您投资的".$_POST['crowd_id']."号众筹已发起投票！请尽快登录系统参与投票，到期未参与投票将自动默认赞成票");//发送站内信
                    SMStip("crowdvote",$userinfo['user_phone'],array("#USERANEM#","#CROWDID#"),array($userinfo['user_name'],$_POST['crowd_id']));//发送短信
                }
                M('crowd_info')->where('id='.$_POST['crowd_id'])->save(array('status'=>3));
                $this->success("添加成功","__URL__/fully");}

            else $this->error("添加失败");
        }

    }
    public function fullylist(){
        $per = C('DB_PREFIX');
        $list=M('crowd_vote_detail vd')
            ->field("vd.*,m.user_name")
            ->join("{$per}members m ON m.id=vd.user_id")
            ->where('vd.vote_id='.$_GET['id'])->order('vd.id DESC')->select();
        $this->assign('list',$list);
        $this->display();
    }
    public function withdraw_money(){

    }
    public function withdrawdetail(){
        $per = C('DB_PREFIX');
        $list=M('crowd_investor ci')
            ->field('ci.user_id,ci.capital,ci.ratio')
            ->where('crowd_id='.$_GET['crowd_id'])
            ->select();
        $crowd_info=M('crowd_info')->field('id,crowd_money,crowd_name,withdraw_rate')->find($_GET['crowd_id']);
        $this->withdraw_repayment_record();
        $this->assign('crowd_info',$crowd_info);
        $this->assign('list',$list);
        $this->display();
    }
    public function withdraw_repayment_record()
    {
        isset($_GET['repayment_ratio']) && $repayment_ratio = floatval($_GET['repayment_ratio']);//放款比例
        isset($_GET['id']) && $crowd_id = intval($_GET['id']);;//众筹ID
        $old_crowd_id = intval($_GET['crowd_id']);
        $Page = D('Page');
        $pre = C('DB_PREFIX');
        import("ORG.Util.Page");
        $size=10;
        $count = M('crowd_investor ci')
            ->field("ci.*,m.user_name,cf.has_crowd_money")
            ->join("{$pre}members m ON m.id = ci.user_id")
            ->join("{$pre}crowd_info cf ON cf.id = ci.crowd_id")
            ->order('ci.id DESC')
            ->where('ci.crowd_id = '.$old_crowd_id)
            ->count('ci.id');
        $Page = new Page($count,$size);
        $show = $Page->ajax_show();
        $this->assign('ajaxpage',$show);
        if(isset($_GET['repayment_ratio']) ){

        }

        if($_GET['id']){
            $Lsql = "{$Page->firstRow},{$Page->listRows}";
            $record_list = M('crowd_investor ci')
                ->field("ci.*,m.user_name,cf.has_crowd_money,cf.max_duration")
                ->join("{$pre}members m ON m.id = ci.user_id")
                ->join("{$pre}crowd_info cf ON cf.id = ci.crowd_id")
                ->order('ci.id DESC')
                ->where('ci.crowd_id = '.$crowd_id)
                ->limit($Lsql)
                ->select();
            foreach($record_list as $key=>$v){
                $record_list[$key]['receive'] = round(((($record_list[$key]['capital']*round(($repayment_ratio/100),4))/12)*$record_list[$key]['max_duration']),4);
            }
            $string = '';
            foreach($record_list as $k=>$v){
                $string .="<tr>";
                $string .="<td class='td2'>".$v['id']."</td>";
                $string .="<td class='td2'>".$v['user_name']."</td>";
                $string .="<td class='td2'>".$v['capital']."元</td>";
                $string .="<td class='td2'>".$v['receive']."元</td>";
                $string .="<td class='td2'>".date("Y-m-d H:i",$v['add_time'])."</td>";
                $string .="</tr>";
            }
            echo empty($string)?'暂时没有投资记录':$string;
        }
    }
    public function withdraw_go_repayment()
    {
        $crowd_id = $_GET['id'];//众筹ID
        $repayment_ratio = floatval($_GET['repayment_ratio']);//发放比例
        if($crowd_id == '' || $repayment_ratio == ''){
            $this->error("众筹ID或发放比例不能为空！！");
        }
        if($repayment_ratio > 100){
            $this->error("发放比例最大为100%！！");
        }
        $user_crowd=M('crowd_info')->field('user_id,has_crowd_money')->where('crowd_id = '.$crowd_id.'and status=8')->find();
        $user_money=M('member_money')->field('account_money,back_money')->where("uid=".$user_crowd['user_id'])->find();

        if($user_crowd['has_crowd_money']>($user_money['account_money']+$user_money['back_money'])){
            $this->error("发起人账号资金不足，请充值后再分配收益！");
        }

        $save_repayment_ratio = M('crowd_info')->where('id = '.$crowd_id)->save(array("repayment_ratio"=>$repayment_ratio));
        if(false !== $save_repayment_ratio || 0 !== $save_repayment_ratio ){
            $done = Crowd_withdraw_repayment($crowd_id,$repayment_ratio);
            if($done){
                $this->success("收益发放成功！","__URL__/withdraw");
            }else{
                $this->error("收益发放失败！！");
            }
        }else{
            $this->error("发放比率保存失败！！");
        }

    }
    public function withdraw()
    {
        //分页处理
        import("ORG.Util.Page");
        $size=10;
        $count = M('crowd_info')->where('status=8')->count('id');
        $p = new Page($count,$size);
        $page = $p->show();
        $Lsql = "{$p->firstRow},{$p->listRows}";

        $per = C('DB_PREFIX');

        $list = M('crowd_info ci')->
        field("ci.*,m.user_name")
            ->join("{$per}members m ON m.id=ci.user_id")
            ->where('ci.status=8')->order('id DESC')->limit($Lsql)
            ->select();
        $this->assign("pagebar", $page);
        $this->assign('list',$list);
        $this->display();
    }
    public function fail()
    {
        import("ORG.Util.Page");
        $per = C('DB_PREFIX');
        //分页
        $size=10;
        $count = M('crowd_info')->where('status = 6')->count('id');
        $p = new Page($count,$size);
        $page = $p->show();
        $Lsql = "{$p->firstRow},{$p->listRows}";
        $list = M('crowd_info ci')->field('ci.*,m.user_name')
                ->join("{$per}members m ON ci.user_id=m.id")
            ->where('ci.status = 6')->order('id DESC')->limit($Lsql)->select();
        $this->assign('list',$list);
        $this->assign('pagebar',$page);
        $this->display();
    }
    //回款中的众筹
    public function repayment()
    {
        $per = C('DB_PREFIX');
        import("ORG.Util.Page");
        //分页
        $size=10;
        $count = M('crowd_info')->where('ci.status = 4')->count('id');
        $p = new Page($count,$size);
        $page = $p->show();
        $Lsql = "{$p->firstRow},{$p->listRows}";
        $list = M('crowd_info ci')
            ->field("ci.*,m.user_name,vo.vote_money")
            ->join("{$per}members m ON m.id=ci.user_id")
            ->join("{$per}crowd_voting vo ON vo.crowd_id=ci.id")
            ->where('ci.status = 4')->order('id DESC')
            ->limit($Lsql)
            ->select();
        $this->assign('list',$list);
        $this->assign('pagebar',$page);
        $this->display();
    }
    public function repaymentdetail()
    {
        $per = C('DB_PREFIX');
        $crowd_id = $_GET['crowd_id'];//众筹ID
        $crowd_detail = M('crowd_info ci')
            ->field("ci.*,vo.vote_money")
            ->join("{$per}crowd_voting vo ON vo.crowd_id= ci.id")
            ->where('ci.id = '.$crowd_id.' AND ci.status = 4 AND vo.status = 3')
            ->find();
        $this->repayment_record();
        $this->assign('crowd_detail',$crowd_detail);
        $this->display();
    }
    public function repayment_record()
    {
        isset($_GET['repayment_ratio']) && $repayment_ratio = floatval($_GET['repayment_ratio']);//放款比例
        isset($_GET['id']) && $crowd_id = intval($_GET['id']);;//众筹ID
        if(isset($_GET['repayment_ratio']) && isset($_GET['id'])){
            M('crowd_info')->where('id='.$_GET['id'])->save(array("back_rate"=>$_GET['repayment_ratio']));
        }
        $old_crowd_id = intval($_GET['crowd_id']);
        $Page = D('Page');
        $pre = C('DB_PREFIX');
        import("ORG.Util.Page");
        $size=10;
        $count = M('crowd_investor')
            ->where('crowd_id = '.$old_crowd_id)->count('id');
        $Page = new Page($count,$size);
        $show = $Page->ajax_show();
        $this->assign('ajaxpage',$show);

        if($_GET['id']){
            $Lsql = "{$Page->firstRow},{$Page->listRows}";
            $record_list = M('crowd_investor ci')
                ->field("ci.*,m.user_name,cf.has_crowd_money,vo.vote_money")
                ->join("{$pre}members m ON m.id = ci.user_id")
                ->join("{$pre}crowd_info cf ON cf.id = ci.crowd_id")
                ->join("{$pre}crowd_voting vo ON vo.crowd_id= cf.id")
                ->order('ci.id DESC')
                ->where('ci.crowd_id = '.$crowd_id.' AND vo.status = 3')
                ->limit($Lsql)
                ->select();
            foreach($record_list as $key=>$v){
                $record_list[$key]['receive'] = round(($record_list[$key]['ratio']*round(($repayment_ratio/100),4)*round(($record_list[$key]['vote_money']-$record_list[$key]['has_crowd_money']),4)),4);//逾期收益
            }
            $string = '';
            foreach($record_list as $k=>$v){
                $string .="<tr>";
                $string .="<td class='td2'>".$v['id']."</td>";
                $string .="<td class='td2'>".$v['user_name']."</td>";
                $string .="<td class='td2'>".$v['capital']."元</td>";
                $string .="<td class='td2'>".$v['receive']."元</td>";
                $string .="<td class='td2'>".date("Y-m-d H:i",$v['add_time'])."</td>";
                $string .="<td class='td2'>".($v['capital']+$v['receive'])."元</td>";
                $string .="</tr>";
            }
            echo empty($string)?'暂时没有投资记录':$string;
        }
    }
    public function go_repayment(){
        $pre = C('DB_PREFIX');
        $crowd_id = $_GET['id'];//众筹ID
        $repayment_ratio = floatval($_GET['repayment_ratio']);//发放比例
        if($crowd_id == '' || $repayment_ratio == ''){
            $this->error("众筹ID或发放比例不能为空!");
        }
        if($repayment_ratio > 100){
            $this->error("发放比例最大为100%！！");
        }
        $user_crowd=M('crowd_voting')->field('crowd_id,vote_money')->where('crowd_id = '.$crowd_id.' and status=3')->find();

        $user_crowd_info=M('crowd_info')->field('user_id')->find($user_crowd['crowd_id']);
        $user_money=M('member_money')->field('account_money,back_money')->where("uid=".$user_crowd_info['user_id'])->find();
        if($user_crowd['vote_money']>($user_money['account_money']+$user_money['back_money'])){
            $this->error("发起人账号资金不足，请充值后再分配收益！");
        }
        $save_repayment_ratio = M('crowd_info')->where('id = '.$crowd_id)->save(array("repayment_ratio"=>$repayment_ratio));
        if(false !== $save_repayment_ratio || 0 !== $save_repayment_ratio ){
            $done = Crowd_repayment($crowd_id,$repayment_ratio);
            if($done){
                //如果收益发放成功，则发送站内信和短信
                $record_list = M('crowd_investor ci')
                    ->field("ci.*,m.user_name,m.user_phone,cf.has_crowd_money,vo.vote_money")
                    ->join("{$pre}members m ON m.id = ci.user_id")
                    ->join("{$pre}crowd_info cf ON cf.id = ci.crowd_id")
                    ->join("{$pre}crowd_voting vo ON vo.crowd_id= cf.id")
                    ->order('ci.id DESC')
                    ->where('ci.crowd_id = '.$crowd_id.' AND vo.status = 3')
                    ->select();
                foreach($record_list as $key=>$v){
                    $record_list[$key]['receive'] = round(($record_list[$key]['ratio']*round(($repayment_ratio/100),4)*round(($record_list[$key]['vote_money']-$record_list[$key]['has_crowd_money']),4)),4);//预期收益
                    addInnerMsg($record_list[$key]['user_id'],"您投资的众筹回款已到账！","尊敬的".$record_list[$key]['user_name']."，您好，您投资的".$crowd_id."号众筹众筹已回款！返还本金".$record_list[$key]['capital']);//发送站内信
                    SMStip("crowdvotedone",$record_list[$key]['user_phone'],array("#USERANEM#","#CROWDID#","#MONEY#"),array($record_list[$key]['user_name'],$crowd_id,$record_list[$key]['capital']));//发送短信
                    addInnerMsg($record_list[$key]['user_id'],"您投资的众筹回款已到账！","尊敬的".$record_list[$key]['user_name']."，您好，您投资的".$crowd_id."号众筹众筹已回款！到账收益".$record_list[$key]['receive']);//发送站内信
                    SMStip("crowdvotedone",$record_list[$key]['user_phone'],array("#USERANEM#","#CROWDID#","#MONEY#"),array($record_list[$key]['user_name'],$crowd_id,$record_list[$key]['receive']));//发送短信
                };//该众筹的投资列表
                $this->success("收益发放成功！","__URL__/repayment");
            }else{
                $this->error("收益发放失败！！");
            }
        }else{
            $this->error("发放比率保存失败！！");
        }

    }
    public function complete(){
        $per = C('DB_PREFIX');
        import("ORG.Util.Page");
        //分页
        $size=10;
        $count = M('crowd_info')->where('status in (5,9)')->count('id');
        $p = new Page($count,$size);
        $page = $p->show();
        $Lsql = "{$p->firstRow},{$p->listRows}";
        $list = M('crowd_info ci')
            ->field("ci.*,m.user_name")
            ->join("{$per}members m ON m.id=ci.user_id")
            ->where('ci.status in (5,9) ')
            ->limit($Lsql)
            ->select();
        foreach($list as $kay=>$var){
           $voting =M('crowd_voting')->field('id,vote_money')
                ->where('crowd_id='.$var['id'])
                ->order('id DESC')->limit(1)->find();
            $list[$kay]['vote_money']=$voting['vote_money'];

        }
        //,vo.vote_money
        $this->assign('list',$list);
        $this->assign("page",$page);
        $this->display();
    }
    public function complete_detail()
    {
        $crowd_id = $_GET['crowd_id'];//众筹ID
        $repayment_arr = M('crowd_info')->field('repayment_ratio,status')->where('id = '.$crowd_id)->find();
        $repayment_ratio = $repayment_arr['repayment_ratio'];
        $Page = D('Page');
        $pre = C('DB_PREFIX');
        import("ORG.Util.Page");
        $size=10;
        $count = M('crowd_investor')
            ->where('crowd_id = '.$crowd_id)->count('id');
        $Page = new Page($count,$size);
        $show = $Page->ajax_show();
            $Lsql = "{$Page->firstRow},{$Page->listRows}";
            $record_list = M('crowd_investor ci')
                ->field("ci.*,m.user_name,cf.has_crowd_money,cf.max_duration")
                ->join("{$pre}members m ON m.id = ci.user_id")
                ->join("{$pre}crowd_info cf ON cf.id = ci.crowd_id")
               // ->join("{$pre}crowd_voting vo ON vo.crowd_id= cf.id")
                ->order('ci.id DESC')
                ->where('ci.crowd_id = '.$crowd_id)
                ->limit($Lsql)
                ->select();
        foreach($record_list as $kay => $val){
            //,vo.vote_money
            $voting=M('crowd_voting')->field('vote_money')->where('crowd_id='.$val['crowd_id'])->order('id DESC')->limit(1)->find();
            $record_list[$kay]['vote_money']=$voting['vote_money'];
        }

        if($repayment_arr['status']==9){
            //溢价回购完成的众筹，收益计算的不一样
            foreach($record_list as $key=>$v) {
                $record_list[$key]['receive'] = round(((($record_list[$key]['capital'] * round(($repayment_ratio / 100), 4)) / 12) * $record_list[$key]['max_duration']), 4);
            }
        }else{
            foreach($record_list as $key=>$v){
                $record_list[$key]['receive'] = round(($record_list[$key]['ratio']*round(($repayment_ratio/100),4)*round(($record_list[$key]['vote_money']-$record_list[$key]['has_crowd_money']),4)),4);//预期收益
            }
        }


        $this->assign('ajaxpage',$show);
        $this->assign('record_list',$record_list);
        $this->display();
    }
}
?>