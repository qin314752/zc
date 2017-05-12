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




    }


    /**
      +----------------------------------------------------------
     * 显示一级菜单
      +----------------------------------------------------------
     */
    private function show_menu() {
        $cache = C('admin_big_menu');
        $model=M('model')->where('is_inner=0')->field('tbl_name,menu_name')->select();
        foreach ($model as $key => $value) {
          $k=ucwords(str_replace(C('DB_PREFIX'),'', $value['tbl_name']));
          $cache[$k]=$value['menu_name'];
        }
        $count = count($cache);
        $i = 1;
        $menu = "";
        foreach ($cache as $url => $name) {
            if ($i == 1) {
                $css = $url == CONTROLLER_NAME || !$cache[CONTROLLER_NAME] ? "fisrt_current" : "fisrt";
                $menu.='<li class="' . $css . '"><span><a href="' . U($url . '/index') . '">' . $name . '</a></span></li>';
            } else if ($i == $count) {
                $css = $url == CONTROLLER_NAME ? "end_current" : "end";
                $menu.='<li class="' . $css . '"><span><a href="' . U($url . '/index') . '">' . $name . '</a></span></li>';
            } else {
                $css = $url == CONTROLLER_NAME ? "current" : "";
                $menu.='<li class="' . $css . '"><span><a href="' . U($url . '/index') . '">' . $name . '</a></span></li>';
            }
            $i++;
        }
        return $menu;
    }

    /**
      +----------------------------------------------------------
     * 显示二级菜单
      +----------------------------------------------------------
     */
    private function show_sub_menu() {
        $big = CONTROLLER_NAME == "Index" ? "Common" : CONTROLLER_NAME;
        $cache = C('admin_sub_menu');       
        if($mo=C($big)){
          $model[$big]=array();
          foreach ($mo['sub_menu'] as $value) {
              if(!$value['hidden']){
                  foreach ($value['item'] as $k => $v) {
                    $kv=explode('/', $k);
                    $model[$big][$kv[1]]=$v;
                  }
              }
          }
          $cache=array_merge($cache,$model);
        }
        $sub_menu = array();
        if ($cache[$big]) {
            $cache = $cache[$big];
            foreach ($cache as $url => $title) {
                $url = $big == "Common" ? $url : "$big/$url";
                $sub_menu[] = array('url' => U("$url"), 'title' => $title);
            }
            return $sub_menu;
        } else {
            return $sub_menu[] = array('url' => '#', 'title' => "该菜单组不存在");
        }
    }


    
    
}