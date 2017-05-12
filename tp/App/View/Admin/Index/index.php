
<extend name='./App/View/Admin/head.php' />

<block name="centent">
<div class="header">

    <div class="dl-title">
        <!--<img src="/chinapost/Public/assets/img/top.png">-->
    </div>

    <div class="dl-log">欢迎您，<span class="dl-log-user">{$adminname}</span><a href="{:U('Admin/index/out')}" title="退出系统" class="dl-log-quit">[退出]</a>
    </div>
</div>
<div class="content">
    <div class="dl-main-nav">
        <div class="dl-inform"><div class="dl-inform-title"><s class="dl-inform-icon dl-up"></s></div></div>
        <ul id="J_Nav"  class="nav-list ks-clear">
            <li class="nav-item dl-selected"><div class="nav-item-inner nav-home">首页</div></li>   
            <li class="nav-item dl-selected"><div class="nav-item-inner nav-order">业务管理</div></li>
            <li class="nav-item dl-selected"><div class="nav-item-inner nav-order">会员管理</div></li>
            <li class="nav-item dl-selected"><div class="nav-item-inner nav-order">充值提现</div></li>
            <li class="nav-item dl-selected"><div class="nav-item-inner nav-order">文章列表</div></li>
            <li class="nav-item dl-selected"><div class="nav-item-inner nav-order">系统管理</div></li>
            <li class="nav-item dl-selected"><div class="nav-item-inner nav-order">运营管理</div></li>

        </ul>
    </div>
    <ul id="J_NavContent" class="dl-tab-conten">

    </ul>
</div>
<script>
    BUI.use('common/main',function(){
        var config = [

  {id:'1',homePage : '1',menu:[{text:'首页',items:[{id:'1',text:'欢迎页',href:'Node/index.html'},
                                                    {id:'2',text:'清空缓存',href:"{:U('Admin/index/clear_cache')}"},
                                                          ]}
                  ]},

  {id:'2',homePage : '1',menu:[{text:'业务管理',items:[{id:'1',text:'机构管理',href:'Node/index.html'},
                                                            {id:'2',text:'角色管理',href:'Role/index.html'},
                                                            {id:'3',text:'用户管理',href:'User/index.html'},
                                                            {id:'4',text:'菜单管理',href:'Menu/index.html'}
                                                          ]}
                 ]},

  {id:'3',homePage : '1',menu:[{text:'会员管理',items:[{id:'1',text:'会员列表',href:'Node/index.html'},
                                       
                                               ]},
                            {text:'认证及申请管理',items:[{id:'2',text:'手机认证会员',href:'Node/index.html'},
                                              {id:'3',text:'会员实名认证管理',href:'Node/index.html'},
                                       
                                               ]},

                  ]},

  {id:'4',homePage : '1',menu:[{text:'充值提现',items:[{id:'1',text:'在线充值',href:'Node/index.html'},
                                                      {id:'2',text:'线下充值',href:'Node/index.html'},
                                                      {id:'3',text:'充值记录总列表',href:'Node/index.html'},        
                                                          ]},
                                 {text:'提现管理',items:[{id:'4',text:'待审核提现',href:'Node/index.html'},
                                                         {id:'5',text:'审核通过处理中',href:'Role/index.html'},
                                                         {id:'6',text:'已提现',href:'Role/index.html'},
                                                         {id:'7',text:'审核未通过',href:'Role/index.html'},
                                                         {id:'8',text:'提现申请总列表',href:'Role/index.html'},
                                                          ]},

                 ]},

  {id:'5',homePage : '1',menu:[{text:'文章列表',items:[{id:'1',text:'文章列表',href:'Node/index.html'},
                                                         {id:'2',text:'文章分类',href:'Role/index.html'},
                                                            
                                          ]},
                 ]},

  {id:'6',homePage : '1',menu:[{text:'系统管理 ',items:[{id:'1',text:'网站设置',href:"{:U('Admin/System/index?$i=6&$j=1')}"}]},
                              {text:'管理员管理 ',items:[{id:'2',text:'管理员管理',href:"{:U('Admin/System/index?$i=6&$j=2')}"},
                                                        {id:'3',text:'管理员权限管理',href:"{:U('Admin/System/index?$i=6&$j=3')}"},
                                                        {id:'4',text:'管理员操作日志',href:"{:U('Admin/System/index?$i=6&$j=4')}"},

                                                          ]},
                              {text:'数据库管理 ',items:[{id:'5',text:'数据库信息',href:'Node/index.html'},
                                                         {id:'6',text:'备份数据',href:'Node/index.html'},
                                                         {id:'7',text:'清空数据',href:'Node/index.html'},

                                            ]},

                 ]},

  {id:'7',homePage : '1',menu:[{text:'参数管理',items:[{id:'1',text:'运营规则',href:'Node/index.html'},
                                                        {id:'2',text:'角色管理',href:'Role/index.html'},
                                                        {id:'3',text:'用户管理',href:'User/index.html'},
                                                        {id:'4',text:'菜单管理',href:'Menu/index.html'}
                                         ]},
                            {text:'第三方接口',items:[{id:'5',text:'支付接口',href:'Node/index.html'},
                                                     {id:'6',text:'登录接口',href:'Role/index.html'},
                                                     {id:'7',text:'通知信息接口',href:'Role/index.html'},
                                                     {id:'8',text:'手机信息记录',href:'Role/index.html'},
                                                     {id:'9',text:'邮箱信息记录',href:'Role/index.html'},
                                                     {id:'10',text:'通知信息模板',href:'Role/index.html'},
                                                      ]},
                            {text:'在线客服',items:[{id:'11',text:'QQ在线客服管理',href:'Node/index.html'},
                                                    {id:'12',text:'QQ在线客服管理',href:'Role/index.html'},
                                                    {id:'13',text:'客服电话管理',href:'Role/index.html'},
                                                                          ]},
                            {text:'广告管理',items:[{id:'14',text:'广告管理',href:'Node/index.html'}]},
                            {text:'友情链接',items:[{id:'15',text:'友情链接管理',href:'Node/index.html'}]},
                            {text:'网站关站',items:[{id:'16',text:'网站关站设置',href:"{:U('Admin/index')}"}]},
                            ]},


                ];





        new PageUtil.MainPage({
            modulesConfig : config
        });
    });
</script>
</block>