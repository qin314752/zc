<?php
/**
 * User: Administrator
 */
class CrowdconfigAction extends ACommonAction{
    public function index(){
        $list = M('crowd_config')->order("order_sn DESC")->select();
        //dump($list);
        $this->assign('list', $list);

        $sy=M('crowd_config')->where(" type='watermark' ")->find();
        if($sy){
            $this->assign('sy', $sy);
        }
        $this->display();
    }
    public function doEdit()
    {
        $data = $_POST;
        foreach($data as $key => $v){
        if(is_numeric($key)) M('crowd_config')->where("id = '{$key}'")->setField('text',EnHtml($v));
    }

        $this->success('更新成功');
    }
    public function Syimg(){
        $this->display();
    }
    public function imgadd(){
        if($_GET['id']){
            M('crowd_config')->where("id =".$_GET['id'])->delete();
            $this->success('删除水印成功');
        }else{
            $cou=M('crowd_config')->where("type = 'watermark' ")->count();

            if($cou == 0){
                $data['type']="watermark";
                $data['text']=$_POST['swfimglist'][0];
                $data['tip']="众筹水印";
                $data['name']="众筹水印";
                $data['order_sn']=0;
                $data['code']="zc_sy";
                $data['is_sys']=1;
                $data['isyc']=1;
                M('crowd_config')->add($data);
                $this->success('添加水印成功');

            }else{
                $this->error('水印已存在，请删除旧的水印后再添加新的水印。');
            }

        }

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
//            $str= var_export($info,true);
//            file_put_contents('file.txt',$str);
            $data['product_thumb'] = $info[0]['savepath'].$info[0]['savename'];
            if(!isset($_SESSION['count_file'])) $_SESSION['count_file']=1;
            else $_SESSION['count_file']++;
            $_SESSION['imgfiles'][$_SESSION['count_file']] = $data['product_thumb'];
            echo "{$_SESSION['count_file']}:".__ROOT__."/".$data['product_thumb'];//返回给前台显示缩略图
        }
    }

}