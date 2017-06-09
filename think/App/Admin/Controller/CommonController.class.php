<?php
namespace Admin\Controller;
use Think\Controller;
use Org\Util\Rbac;
class CommonController extends Controller {

    /**
      +----------------------------------------------------------
     * 初始化
     * 如果 继承本类的类自身也需要初始化那么需要在使用本继承类的类里使用parent::_initialize();
      +----------------------------------------------------------
     */
    public function _initialize() {
        // if(!isset($_SESSION[C('USER_AUTH_KEY')])){
        //   $this->redirect('tp.cn');
        // }

        // $notauth = in_array(ACTION_NAME, explode(',',C('NOT_AUTH_MODULE')));
        // if(C(USER_AUTH_ON)&&!$notauth)
        // //权限认证的过滤器方法
        // if(!Rbac::AccessDecision()){
        //   $b = ACTION_NAME.'没有权限';
        //   $this->assign('a',$b);
        //   $this->error('没有权限',U(CONTROLLER_NAME.'/'.ACTION_NAME));
        // }
        //  if (C('USER_AUTH_ON') && !in_array(CONTROLLER_NAME, explode(',', C('NOT_AUTH_MODULE')))) {
        //     if (!RBAC::AccessDecision()) {
        //         //检查认证识别号
        //         if (!$_SESSION [C('USER_AUTH_KEY')]) {
        //             //跳转到认证网关
        //             redirect(C('USER_AUTH_GATEWAY'));
        //         }
        //         // 没有权限 抛出错误
        //         if (C('RBAC_ERROR_PAGE')) {
        //             // 定义权限错误页面
        //             redirect(C('RBAC_ERROR_PAGE'));
        //         } else {
        //             if (C('GUEST_AUTH_ON')) {
        //                 $this->assign('jumpUrl', C('USER_AUTH_GATEWAY'));
        //             }
        //             // 提示错误信息
        //             $this->error(L('_VALID_ACCESS_'));
        //         }
        //     }
        // }
        $this->assign("menu", $this->show_menu()['menu_top']);
        $this->assign("sub_menu", $this->show_menu()['menu_left']);
    }







    /**
      +----------------------------------------------------------
     * 显示一级菜单
      +----------------------------------------------------------
     */
    private function show_menu() {
      $data = array();
        require(C('WEB_ROOT')."App/Admin/Common/menu.inc.php");
            foreach ($menu_left as $key => $value) {
              $data['menu_top']  .= '<li class="dropDown dropDown_hover" ><a class="dropDown_A" href="javascript:;" class="'.$value[1].'" onclick="clic(\''.$value[1].'\')">'.$value[0].'</a></li>';
              $data['menu_left'][$key] = $value;
          }
          return $data; 
    }

  

    
    
}