<?php
/*array(菜单名，菜单url参数，是否显示)*/
$i=0;
$j=0;
$menu_left =  array();
//=================================================================

$menu_left[$i]= array('首页','shouye',1);


$menu_left[$i]['low_title'][$i."-".$j] = array('首页');
$menu_left[$i][$i."-".$j][] = array('欢迎',U('/Admin/global/websetting'));
$menu_left[$i][$i."-".$j][] = array('清除缓存',U('/Admin/global/bid'));
$j++;
$menu_left[$i]['low_title'][$i."-".$j] = array('22222');
$menu_left[$i][$i."-".$j][] = array('2',U('/Admin/global/websetting'));
$menu_left[$i][$i."-".$j][] = array('2222',U('/Admin/global/bid'));


//=================================================================
$i++;
$menu_left[$i]= array('众筹项目','zc',1);
$menu_left[$i]['low_title'][$i."-".$j] = array('众筹项目管理');
$menu_left[$i][$i."-".$j][] = array('发起项目',U('/Admin/Crowd/index'));
$menu_left[$i][$i."-".$j][] = array('认筹中的项目',U('/Admin/crowdfunding/sell'));
$menu_left[$i][$i."-".$j][] = array('出售中的项目（投票）',U('/Admin/crowdfunding/fully'));
$menu_left[$i][$i."-".$j][] = array('待回款中的项目',U('/Admin/crowdfunding/repayment'));
$menu_left[$i][$i."-".$j][] = array('完成的项目',U('/Admin/crowdfunding/complete'));
$menu_left[$i][$i."-".$j][] = array('流标的项目',U('/Admin/crowdfunding/fail'));
$menu_left[$i][$i."-".$j][] = array('溢价回购的项目',U('/Admin/crowdfunding/withdraw'));

$j++;
$menu_left[$i]['low_title'][$i."-".$j] = array('众筹运营管理');
$menu_left[$i][$i."-".$j][] = array('添加水印',U('/Admin/crowdconfig/Syimg'));
$menu_left[$i][$i."-".$j][] = array('运营规则',U('/Admin/crowdconfig/index'));


//==========================================================
$i++;
$menu_left[$i]= array('系统管理','xitong',1);


$menu_left[$i]['low_title'][$i."-".$j] = array('系统设置');
$menu_left[$i][$i."-".$j][] = array('网站设置',U('/Admin/global/websetting'));
$menu_left[$i][$i."-".$j][] = array('标名设置',U('/Admin/global/bid'));
$j++;
$menu_left[$i]['low_title'][$i."-".$j] = array('管理员管理');
$menu_left[$i][$i."-".$j][] = array('管理员管理',U('/Admin/User/admin_user_list'));
$menu_left[$i][$i."-".$j][] = array('角色管理',U('/Admin/Role/admin_role'));
$menu_left[$i][$i."-".$j][] = array('管理组权限管理',U('/Admin/Node/admin_node'));
$menu_left[$i][$i."-".$j][] = array("管理员操作日志",U("/Admin/global/Adminlog"));

$j++;
$menu_left[$i]['low_title'][$i."-".$j] = array('数据库管理');
$menu_left[$i][$i."-".$j][] = array('数据库信息',U('/Admin/SysData/index'));
$menu_left[$i][$i."-".$j][] = array('备份管理',U('/Admin/db/baklist'));
$menu_left[$i][$i."-".$j][] = array('清空数据',U('/Admin/db/truncate'));
$j++;

$menu_left[$i]['low_title'][$i."-".$j] = array('菜单管理');
$menu_left[$i][$i."-".$j][] = array('导航菜单',U('/Admin/navigation/index'));

//==========================================================
$i++;
$menu_left[$i]= array('运营管理','yunying',1);
$menu_left[$i]['low_title'][$i."-".$j] = array('参数管理');

$menu_left[$i][$i."-".$j][] = array("运营规则",U('/Admin/global/feesetting'));

$menu_left[$i][$i."-".$j][] = array('合同参数',U('/Admin/hetong/index'));
$menu_left[$i][$i."-".$j][] = array('NuomiID5设置',U('/Admin/nuomiid5/'));

$j++;
$menu_left[$i]['low_title'][$i."-".$j] = array('第三方接口');
$menu_left[$i][$i."-".$j][] = array('支付接口',U('/Admin/payonline/'));
$menu_left[$i][$i."-".$j][] = array('手机wap支付接口',U('/Admin/wappay/'));
$menu_left[$i][$i."-".$j][] = array('线下充值银行',U('/Admin/payoffline/'));
$menu_left[$i][$i."-".$j][] = array('登录接口管理',U('/Admin/loginonline/'));
$menu_left[$i][$i."-".$j][] = array('通知信息接口',U('/Admin/Notice/index'));
$menu_left[$i][$i."-".$j][] = array('手机信息记录',U('/Admin/msgonline/detail/'));
$menu_left[$i][$i."-".$j][] = array('邮箱信息记录',U('/Admin/msgonline/emaillog/'));
$menu_left[$i][$i."-".$j][] = array('通知信息模板',U('/Admin/Notice/template'));

$j++;
$menu_left[$i]['low_title'][$i."-".$j] = array('在线客服');
$menu_left[$i][$i."-".$j][] = array('QQ客服管理',U('/Admin/QQ/index'));
$menu_left[$i][$i."-".$j][] = array('QQ群管理',U('/Admin/QQ/qun'));
$menu_left[$i][$i."-".$j][] = array('客服电话管理',U('/Admin/QQ/tel/'));

$j++;
$menu_left[$i]['low_title'][$i."-".$j] = array('广告管理');
$menu_left[$i][$i."-".$j][] = array('广告管理',U('/Admin/ad/'));


$j++;
$menu_left[$i]['low_title'][$i."-".$j] = array('友情链接');
$menu_left[$i][$i."-".$j][] = array('友情链接',U('/Admin/global/friend'));


$j++;
$menu_left[$i]['low_title'][$i."-".$j] = array('网站关站');
$menu_left[$i][$i."-".$j][] = array('网站关站',U('/Admin/close/index'));






?>

