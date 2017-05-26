<?php
/**
 * User: Administrator
 */
class ProfileAction extends HCommonAction{
    public function index(){
        $web_close=json_decode(file_get_contents("website.txt"),true);
        if($web_close['isopen'] == "2") $this->assign("web_close",$web_close);
        $parm['type_id'] = 10;
        $parm['limit'] =1;
        $fabiaoList=getArticleList($parm);
        $this->assign("fabiaoList",$fabiaoList['list'][0]['art_content']);

        $Osql="sort_order DESC";
        $field="id,type_name,type_set,add_time,type_url,type_nid,parent_id,type_content";
        $map['is_hiden'] = 0;
        $map['parent_id'] = 8;
        $data = D('Acategory')->field($field)->where($map)->order($Osql)->limit(20)->select();
        //Á´½Ó´¦Àí
        $typefix = get_type_leve_nid(8);
        $typeu = $typefix[0];
        $suffix=C("URL_HTML_SUFFIX");
        foreach($data as $key=>$v){
            $data[$key]['turl'] = MU("Home/{$typeu}/{$v['type_nid']}","typelist",array("suffix"=>$suffix));
        }
        $this->assign('data',$data);
		$zhuce = $_GET['zhuce'];
		$this->assign('zhuce',$zhuce);

		$where['id'] = 10;
		$about = D('Acategory')->field('type_content')->where($where)->select();
		$this->assign('about',$about);
		
		$this->assign('title',$_GET['title']);
		
        $this->display();
    }
    public function jucaibao(){
        $this->display();
    }
    public function newguide(){
        $this->display();
    }
    public function article(){
        $content=M('article_category')->field('type_content')->find($_POST['id']);
        $content['type_content'];
        echo $content['type_content'];
    }
}