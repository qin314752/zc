<?php
/*array(菜单名，菜单url参数，是否显示)*/
$i=0;
$j=0;
$menu_left =  array();
$menu_left[$i]=array('首页','#',1);
$menu_left[$i]['low_title'][$i."-".$j] = array('首页','#',1);
$menu_left[$i][$i."-".$j][] = array('欢迎页',U('/admin/welcome/index'),1);
$menu_left[$i][$i."-".$j][] = array('清空缓存',U('/admin/global/cleanall'),1);

$j++;
//$menu_left[$i]['low_title'][$i."-".$j] = array('缓存管理','#',1);
//==========================================================

$i++;
$menu_left[$i]= array('借款管理','#',0);
$menu_left[$i]['low_title'][$i."-".$j] = array('借款列表','#',1);
$menu_left[$i][$i."-".$j][] = array('初审待审核借款',U('/admin/borrow/waitverify'),1);
$menu_left[$i][$i."-".$j][] = array('复审待审核借款',U('/admin/borrow/waitverify2'),1);
$menu_left[$i][$i."-".$j][] = array('招标中借款',U('/admin/borrow/waitmoney'),1);
$menu_left[$i][$i."-".$j][] = array('还款中借款',U('/admin/borrow/repaymenting'),1);
$menu_left[$i][$i."-".$j][] = array('已完成的借款',U('/admin/borrow/done'),1);
$menu_left[$i][$i."-".$j][] = array('已流标借款',U('/admin/borrow/unfinish'),1);
$menu_left[$i][$i."-".$j][] = array('初审未通过的借款',U('/admin/borrow/fail'),1);
$menu_left[$i][$i."-".$j][] = array('复审未通过的借款',U('/admin/borrow/fail2'),1);
$menu_left[$i][$i."-".$j][] = array('异常未满的借款',U('/admin/borrow/borrowfull'),1);

$j++;
$menu_left[$i]['low_title'][$i."-".$j] = array("优计划管理","#",1);
$menu_left[$i][$i."-".$j][] = array('添加优计划',U('/admin/fund/add'),1);
$menu_left[$i][$i."-".$j][] = array("认购中的优计划",U("/admin/fund/index"),1);
$menu_left[$i][$i."-".$j][] = array("还款中的优计划",U("/admin/fund/repayment"),1);
$menu_left[$i][$i."-".$j][] = array("已完成的优计划",U("/admin/fund/endtran"),1);

$j++;
$menu_left[$i]['low_title'][$i."-".$j] = array("债权转让管理","#",1);
$menu_left[$i][$i."-".$j][] = array('债权转让',U('/admin/debt/index'),1);

$j++;
$menu_left[$i]['low_title'][$i."-".$j] = array('逾期借款管理','#',1);
$menu_left[$i][$i."-".$j][] = array('逾期统计',U('/admin/expired/detail'),0);
$menu_left[$i][$i."-".$j][] = array('已逾期借款',U('/admin/expired/index'),1);
$menu_left[$i][$i."-".$j][] = array('逾期会员列表',U('/admin/expired/member'),1);

$j++;
$menu_left[$i]['low_title'][$i."-".$j] = array("加息券管理","#",1);
$menu_left[$i][$i."-".$j][] = array('添加加息券',U('/admin/interestratecoupon/add'),1);
$menu_left[$i][$i."-".$j][] = array("加息券列表",U("/admin/interestratecoupon/index"),1);
//$menu_left[$i][$i."-".$j][] = array("发送加息券页面",U("/admin/interestratecoupon/sendpage"),1);



$j++;
$menu_left[$i]['low_title'][$i."-".$j] = array('快捷借款管理','#',1);
$menu_left[$i][$i."-".$j][] = array('快捷借款列表',U('/admin/feedback/index'),1);

//==========================================================
$i++;
$menu_left[$i]= array('众筹管理','#',1);
$menu_left[$i]['low_title'][$i."-".$j] = array('众筹项目管理','#',1);
$menu_left[$i][$i."-".$j][] = array('发起项目',U('/admin/crowdfunding/index'),1);
$menu_left[$i][$i."-".$j][] = array('认筹中的项目',U('/admin/crowdfunding/sell'),1);
$menu_left[$i][$i."-".$j][] = array('出售中的项目（投票）',U('/admin/crowdfunding/fully'),1);
$menu_left[$i][$i."-".$j][] = array('待回款中的项目',U('/admin/crowdfunding/repayment'),1);
$menu_left[$i][$i."-".$j][] = array('完成的项目',U('/admin/crowdfunding/complete'),1);
$menu_left[$i][$i."-".$j][] = array('流标的项目',U('/admin/crowdfunding/fail'),1);
$menu_left[$i][$i."-".$j][] = array('溢价回购的项目',U('/admin/crowdfunding/withdraw'),1);
//==========================================================
$j++;
$menu_left[$i]['low_title'][$i."-".$j] = array('众筹运营管理','#',1);
$menu_left[$i][$i."-".$j][] = array('添加水印',U('/admin/crowdconfig/Syimg'),1);
$menu_left[$i][$i."-".$j][] = array('运营规则',U('/admin/crowdconfig/index'),1);

$i++;
$menu_left[$i]= array('资金统计','#',1);
$menu_left[$i]['low_title'][$i."-".$j] = array('会员帐户','#',1);
$menu_left[$i][$i."-".$j][] = array('会员帐户',U('/admin/capitalAccount/index'),1);
$j++;
$menu_left[$i]['low_title'][$i."-".$j] = array('充值提现','#',1);
$menu_left[$i][$i."-".$j][] = array('充值记录',U('/admin/capitalOnline/charge'),1);
$menu_left[$i][$i."-".$j][] = array('提现记录',U('/admin/capitalOnline/withdraw'),1);
$j++;
$menu_left[$i]['low_title'][$i."-".$j] = array('会员资金变动记录','#',1);
$menu_left[$i][$i."-".$j][] = array('资金记录',U('/admin/capitalDetail/index'),1);
$j++;
$menu_left[$i]['low_title'][$i."-".$j] = array('网站资金统计','#',1);
$menu_left[$i][$i."-".$j][] = array('网站资金统计',U('/admin/capitalAll/index'),1);
/*
$j++;
$menu_left[$i]['low_title'][$i."-".$j] = array('待还款资金统计','#',1);
$menu_left[$i][$i."-".$j][] = array('u计划待还款统计',U('/admin/capitalRepay/index'),1);
$menu_left[$i][$i."-".$j][] = array('散标待还款统计',U('/admin/capitalRepay/san'),1);
$j++;
$menu_left[$i]['low_title'][$i."-".$j] = array('已还款资金统计','#',1);
$menu_left[$i][$i."-".$j][] = array('u计划已还款统计',U('/admin/capitalHas/index'),1);
$menu_left[$i][$i."-".$j][] = array('散标已还款统计',U('/admin/capitalHas/san'),1);
*/
//=================================================================
$i++;
$menu_left[$i]= array('会员管理','#',1);
$menu_left[$i]['low_title'][$i."-".$j] = array('会员管理','#',1);
$menu_left[$i][$i."-".$j][] = array('会员列表',U('/admin/members/index'),1);
/*
$menu_left[$i][$i."-".$j][] = array('会员资料列表',U('/admin/members/info'),1);
$menu_left[$i][$i."-".$j][] = array('举报信息',U('/admin/jubao/index'),1);
 */
$j++;

$menu_left[$i]['low_title'][$i."-".$j] = array('推荐人管理','#',1);
$menu_left[$i][$i."-".$j][] = array('投资记录',U('/admin/refereeDetail/index'),1);
$menu_left[$i][$i."-".$j][] = array('推广管理',U('/admin/spread/ulist'),1);
$j++;

$menu_left[$i]['low_title'][$i."-".$j] = array('认证及申请管理','#',1);
$menu_left[$i][$i."-".$j][] = array('手机认证会员',U('/admin/verifyphone/index'),1);
$menu_left[$i][$i."-".$j][] = array('视频认证申请',U('/admin/verifyvideo/index'),0);
$menu_left[$i][$i."-".$j][] = array('现场认证申请',U('/admin/verifyface/index'),0);
$menu_left[$i][$i."-".$j][] = array('VIP申请管理',U('/admin/vipapply/index'),0);
$menu_left[$i][$i."-".$j][] = array('会员实名认证申请',U('/admin/memberid/index'),1);
$menu_left[$i][$i."-".$j][] = array('额度申请待审核',U('/admin/members/infowait'),0);
$menu_left[$i][$i."-".$j][] = array('上传资料管理',U('/admin/memberdata/index'),0);

$j++;
$menu_left[$i]['low_title'][$i."-".$j] = array('评论管理','#',0);
$menu_left[$i][$i."-".$j][] = array('评论列表',U('/admin/comment/index'),1);



$i++;
$menu_left[$i]= array('充值提现','#',1);
$menu_left[$i]['low_title'][$i."-".$j] = array('充值管理','#',1);
$menu_left[$i][$i."-".$j][] = array('在线充值',U('/admin/Paylog/paylogonline'),1);
$menu_left[$i][$i."-".$j][] = array('线下充值',U('/admin/Paylog/paylogoffline'),1);
$menu_left[$i][$i."-".$j][] = array('充值记录总列表',U('/admin/Paylog/index'),1);
$j++;
$menu_left[$i]['low_title'][$i."-".$j] = array('提现管理','#',1);
$menu_left[$i][$i."-".$j][] = array('待审核提现',U('/admin/Withdrawlogwait/index'),1);
$menu_left[$i][$i."-".$j][] = array('审核通过,处理中',U('/admin/Withdrawloging/index'),1);
$menu_left[$i][$i."-".$j][] = array('已提现 ',U('/admin/Withdrawlog/withdraw2'),1);
$menu_left[$i][$i."-".$j][] = array('审核未通过',U('/admin/Withdrawlog/withdraw3'),1);
$menu_left[$i][$i."-".$j][] = array('提现申请总列表',U('/admin/Withdrawlog/index'),1);

//==========================================================
/*
$i++;
$menu_left[$i]= array('积分管理','#',1);
$menu_left[$i]['low_title'][$i."-".$j] = array('投资积分管理','#',1);
$menu_left[$i][$i."-".$j][] = array('投资积分操作记录',U('/admin/market/index'),1);
$menu_left[$i][$i."-".$j][] = array('商品兑换管理',U('/admin/market/getlog'),1);

$j++;
$menu_left[$i]['low_title'][$i."-".$j] = array('积分商城管理','#',1);
$menu_left[$i][$i."-".$j][] = array('商城商品列表',U('/admin/market/goods'),1);
$menu_left[$i][$i."-".$j][] = array('抽奖商品列表',U('/admin/market/lottery'),1);
$menu_left[$i][$i."-".$j][] = array('评论列表',U('/admin/market/comment'),1);
*/

//==========================================================
$i++;
$menu_left[$i]= array('文章管理','#',1);
$menu_left[$i]['low_title'][$i."-".$j] = array('文章管理','#',1);
$menu_left[$i][$i."-".$j][] = array('文章列表',U('/admin/article/'),1);
$menu_left[$i][$i."-".$j][] = array('文章分类',U('/admin/acategory/'),1);


//=================================================================
$i++;
$menu_left[$i]= array('系统管理','#',1);


$menu_left[$i]['low_title'][$i."-".$j] = array('系统设置','#',1);
$menu_left[$i][$i."-".$j][] = array('网站设置',U('/admin/global/websetting'),1);
$menu_left[$i][$i."-".$j][] = array('标名设置',U('/admin/global/bid'),0);
$j++;
$menu_left[$i]['low_title'][$i."-".$j] = array('管理员管理',"#",1);
$menu_left[$i][$i."-".$j][] = array('管理员管理',U('/admin/Adminuser/'),1);
$menu_left[$i][$i."-".$j][] = array('管理组权限管理',U('/admin/acl/'),1);
$menu_left[$i][$i."-".$j][] = array("管理员操作日志",U("/admin/global/adminlog"),1);

$j++;
$menu_left[$i]['low_title'][$i."-".$j] = array('数据库管理','#',1);
$menu_left[$i][$i."-".$j][] = array('数据库信息',U('/admin/db/'),1);
$menu_left[$i][$i."-".$j][] = array('备份管理',U('/admin/db/baklist'),1);
$menu_left[$i][$i."-".$j][] = array('清空数据',U('/admin/db/truncate'),1);
$j++;

$menu_left[$i]['low_title'][$i."-".$j] = array('菜单管理','#',1);
$menu_left[$i][$i."-".$j][] = array('导航菜单',U('/admin/navigation/index'),1);



//==========================================================
$i++;
$menu_left[$i]= array('运营管理','#',1);
$menu_left[$i]['low_title'][$i."-".$j] = array('参数管理','#',1);
//$menu_left[$i][$i."-".$j][] = array("自动执行",U("/admin/auto/"),1);

$menu_left[$i][$i."-".$j][] = array("运营规则",U('/admin/global/feesetting'),1);

//$menu_left[$i][$i."-".$j][] = array('业务参数',U('/admin/bconfig/index'),1);
$menu_left[$i][$i."-".$j][] = array('合同参数',U('/admin/hetong/index'),1);
//$menu_left[$i][$i."-".$j][] = array('信用级别',U('/admin/leve/index'),1);
//$menu_left[$i][$i."-".$j][] = array('投资级别',U('/admin/leve/invest'),1);
$menu_left[$i][$i."-".$j][] = array('会员年龄别称',U('/admin/age/index'),0);
//$menu_left[$i][$i."-".$j][] = array('实名认证设置',U('/admin/id5/'),1);
$menu_left[$i][$i."-".$j][] = array('NuomiID5设置',U('/admin/nuomiid5/'),1);

$j++;
$menu_left[$i]['low_title'][$i."-".$j] = array('第三方接口','#',1);
$menu_left[$i][$i."-".$j][] = array('支付接口',U('/admin/payonline/'),1);
$menu_left[$i][$i."-".$j][] = array('手机wap支付接口',U('/admin/wappay/'),1);
$menu_left[$i][$i."-".$j][] = array('线下充值银行',U('/admin/payoffline/'),1);
$menu_left[$i][$i."-".$j][] = array('登录接口管理',U('/admin/loginonline/'),1);
$menu_left[$i][$i."-".$j][] = array('通知信息接口',U('/admin/msgonline/'),1);
$menu_left[$i][$i."-".$j][] = array('手机信息记录',U('/admin/msgonline/detail/'),1);
$menu_left[$i][$i."-".$j][] = array('邮箱信息记录',U('/admin/msgonline/emaillog/'),1);
$menu_left[$i][$i."-".$j][] = array('通知信息模板',U('/admin/msgonline/templet/'),1);

$j++;
$menu_left[$i]['low_title'][$i."-".$j] = array('在线客服','#',1);
$menu_left[$i][$i."-".$j][] = array('QQ客服管理',U('/admin/QQ/index'),1);
$menu_left[$i][$i."-".$j][] = array('QQ群管理',U('/admin/QQ/qun'),1);
$menu_left[$i][$i."-".$j][] = array('客服电话管理',U('/admin/QQ/tel/'),1);

$j++;
$menu_left[$i]['low_title'][$i."-".$j] = array('广告管理','#',1);
$menu_left[$i][$i."-".$j][] = array('广告管理',U('/admin/ad/'),1);


$j++;
$menu_left[$i]['low_title'][$i."-".$j] = array('友情链接','#',1);
$menu_left[$i][$i."-".$j][] = array('友情链接',U('/admin/global/friend'),1);

$j++;
$menu_left[$i]['low_title'][$i."-".$j] = array('红包管理','#',1);
$menu_left[$i][$i."-".$j][] = array('红包管理',U('/admin/privilege/'),1);
$menu_left[$i][$i."-".$j][] = array('红包领取记录',U('/admin/privilege/record'),1);

$j++;
$menu_left[$i]['low_title'][$i."-".$j] = array('众筹红包','#',1);
$menu_left[$i][$i."-".$j][] = array('众筹红包管理',U('/admin/paybid/index'),1);

$j++;
$menu_left[$i]['low_title'][$i."-".$j] = array('APP版本更新','#',1);
$menu_left[$i][$i."-".$j][] = array('APP版本更新',U('/admin/appversion/index'),1);

$j++;
$menu_left[$i]['low_title'][$i."-".$j] = array('网站关站','#',1);
$menu_left[$i][$i."-".$j][] = array('网站关站',U('/admin/close/index'),1);


$j++;
$menu_left[$i]['low_title'][$i."-".$j] = array('百度云推送管理','#',0);
$menu_left[$i][$i."-".$j][] = array('手机客户端云推送',U('/admin/baidupush/'),1);


?>

