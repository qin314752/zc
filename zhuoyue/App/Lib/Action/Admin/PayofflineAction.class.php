<?php
// 全局设置
class PayofflineAction extends ACommonAction
{
    /**
    +----------------------------------------------------------
    * 默认操作
    +----------------------------------------------------------
    */
    public function index()
    {
	
		 if(isset($_POST['bank'])){ 
            $bank_arr = array();
            foreach($_POST['bank'] as $k=>$v){
                $bank_arr[$k]=array(
                                'bank'=>stripslashes($v), 
                                'payee'=>stripslashes($_POST['payee'][$k]),
                                'account'=>stripslashes($_POST['account'][$k]),
                                'address'=>stripslashes($_POST['address'][$k]),
                                );
            }
		
            $info = $_POST['info'];   
            $this->saveConfig($bank_arr,$info);
            $this->success("操作成功",__URL__);
            exit;
        }
        
        import("ORG.Net.Keditor");
        $ke=new Keditor();
        $ke->id="info";
        $ke->width="700px";
        $ke->height="300px";
        $ke->items="['source', '|', 'fullscreen', 'undo', 'redo', 'print', 'cut', 'copy', 'paste',
        'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',
        'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
        'superscript', '|', 'selectall', '-',
        'title', 'fontname', 'fontsize', '|', 'textcolor', 'bgcolor', 'bold',
        'italic', 'underline', 'strikethrough', 'removeformat', '|','table', 'hr', 'emoticons', 'link', 'unlink', '|', 'about']
        ";
        $ke->resizeMode=1;

        $ke->jspath="/Style/kindeditor/kindeditor.js";
        $ke->form="bankForm";
        $keshow=$ke->show();
        $this->assign("keshow",$keshow);
            
            
        $config = FS("Dynamic/payoff");
        $this->assign('bank', $config['BANK']);
        $this->assign('info', $config['BANK_INFO']);
        $this->display();
    }
	
    private function saveConfig($arr,$info)
    {
        $config['BANK'] = $arr;
        $config['BANK_INFO'] = $info; 
        FS("payoff", $config, "Dynamic/");
    }
    
}
?>