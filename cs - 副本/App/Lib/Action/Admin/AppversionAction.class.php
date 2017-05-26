<?php
define('ROOT',realpath(__ROOT__));
// 全局设置
class AppversionAction extends ACommonAction
{

    /**
    +----------------------------------------------------------
     * 默认操作
    +----------------------------------------------------------
     */
    public function index()
    {
        $ageconfig = FS("Dynamic/ageconfig");
        import("ORG.Util.Page");
        $size=20;
        $count = M('app_version')->count('id');
        $p = new Page($count,$size);
        $page = $p->show();
        $Lsql = "{$p->firstRow},{$p->listRows}";
        //分页处理
        $list = M('app_version')->order('id DESC')->limit($Lsql)->select();
        $row=array();
        $row['list'] = $list;
        $row['page'] = $page;
        $this->assign('row',$row);
        $this->display();
    }

    public function compile(){
        //sleep(10);
        $path=realpath(__ROOT__).'\AppVersion';
        $path=str_replace("\\","/",$path) ;
        if (file_exists($path."/". $_FILES["file"]["name"]))
        {
            $this->error($_FILES["file"]["name"] . " 已存在。 ");
        }else{
            $file_m=move_uploaded_file($_FILES["file"]["tmp_name"],$path."/".basename($_FILES['file']['name']));
            if($file_m){
                $data['app_version']=$_POST['app_version'];
                $data['app_number']=$_POST['version_hao'];
                $data['version_name']=$_POST['version_name'];
                $data['download']=$_SERVER["SERVER_NAME"]."/AppVersion/".basename($_FILES['file']['name']);
                $data['update_text']=$_POST['update_text'];
                $data['isopen']=$_POST['isopen'];
                $version_id=M('app_version')->add($data);
                if($version_id)
                    $this->success("上传成功","__URL__/index");
                else {
                    unlink($path."/".basename($_FILES['file']['name']));
                    $this->error("上传失败");
                }
            }else $this->error("上传失败");
        }
        //$this->display('index');
    }

}
?>