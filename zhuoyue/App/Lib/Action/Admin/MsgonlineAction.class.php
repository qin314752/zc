<?php
// 全局设置
class MsgonlineAction extends ACommonAction
{
    /**
    +----------------------------------------------------------
    * 默认操作
    +----------------------------------------------------------
    */
    public function index()
    {
		$msgconfig = FS("Dynamic/msgconfig");
		$type = $msgconfig['sms']['type'];// type=0 吉信通短信接口   type=1 漫道短信接口
		$uid1=$msgconfig['sms']['user1']; //分配给你的账号
		$pwd1=$msgconfig['sms']['pass1']; //密码 
		
		$uid2=$msgconfig['sms']['user2']; //分配给你的账号
		$pwd2=$msgconfig['sms']['pass2']; //密码 
		
		$uid3=$msgconfig['sms']['user3']; //分配给你的账号
		$pwd3=$msgconfig['sms']['pass3']; //密码

        $uid4=$msgconfig['sms']['userid4']; //分配给你的账号
        $account4=$msgconfig['sms']['user4']; //分配给你的账号
        $pwd4=$msgconfig['sms']['pass4']; //密码
		if($type==0){
			$d = @file_get_contents("http://service.winic.org:8009/webservice/public/remoney.asp?uid={$uid1}&pwd={$pwd1}",false);
			if($d<0) $d="用户名或密码错误";
			else $d = "￥".$d;
			$this->assign('winic',$d);
		}else if($type==1){
			$d=@file_get_contents("http://sdk2.zucp.net:8060/webservice.asmx/balance?sn={$uid2}&pwd={$pwd2}",false);
			preg_match('/<string.*?>(.*?)<\/string>/', $d, $matches);
			
			if($matches[1]<0){ 
				switch($matches[1]){
					case -2:
						$d="帐号/密码不正确或者序列号未注册";
					break;
					case -4:
						$d="余额不足";
					break;
					case -6:
						$d="参数有误";
					break;
					case -7:
						$d="权限受限,该序列号是否已经开通了调用该方法的权限";
					break;
					case -12:
						$d="序列号状态错误，请确认序列号是否被禁用";
					break;
					default:
						$d="用户名或密码错误";
					break;
				}
			}else{
				$d = $d."条";
			}
			$this->assign('zucp',$d);
		}elseif($type==4){
            //$url="http://218.244.136.70:8888/sms.aspx?action=overage";
            $post_data = array();
            $post_data['userid'] = $uid4;
            $post_data['account'] = $account4;
            $post_data['password'] = $pwd4;
            $url='http://115.29.242.32:8888/sms.aspx?action=overage';
            //$d = @file_get_contents("http://218.244.136.70:8888/sms.aspx?action=overage&userid={$uid4}&account={$account4}&password={$pwd4}",false);
            $o='';
            foreach ($post_data as $k=>$v)
            {
                $o.=("$k=".$v).'&';
            }
            $post_data=substr($o,0,-1);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($ch);
            preg_match_all('/<overage>(.*)<\/overage>/isU', $result, $data);
            $remain = '';
            //dump($post_data);
            // dump($data);
            $remain = $data[1][0];
            $this->assign("mdec",$remain);
        }else{
			$d = @file_get_contents("http://sdk4report.eucp.b2m.cn:8080/sdkproxy/querybalance.action?cdkey={$uid3}&password={$pwd3}",false);
			preg_match_all('/<response>(.*)<\/response>/isU',$d,$arr);
			foreach($arr[1] as $k=>$v){
				preg_match_all('#<message>(.*)</message>#isU',$v,$ar[$k]);
				$data[]=$ar[$k][1];
			}
			
			$d = $data[0][0]*10;
			if($d<0) $d="用户名或密码错误";
			else $d = $d."条";
			$this->assign('emay',$d);
		}

       //取出短信群

        $sms_list = M('xbo_smslog')->select();
        //--end
        $this->assign('sms_list',$sms_list);
		$this->assign('stmp_config',$msgconfig['stmp']);
		$this->assign('sms_config',$msgconfig['sms']);
		$this->assign('sms_config_type',$msgconfig['sms']['type']);
		$this->assign('baidu_config',$msgconfig['baidu']);
		$this->assign("type_list", array("3"=>'关闭短信平台服务',"1"=>'漫道短信提供商',"2"=>'亿美软通短信提供商',"4"=>"漫道二次接口"));
        $this->display();
    }
    public function save()
    {	$status = $_POST['msg']['sms']['type'];
		if($status=='1'){
                        $oldpwd=$_POST['msg']['sms']['pass2'];
			$pwd = $_POST['msg']['sms']['user2'].$_POST['msg']['sms']['pass2'];
			$_POST['msg']['sms']['pass2'] =strtoupper(md5($pwd));//$pwd
			$_POST['msg']['sms']['pwd'] = $oldpwd;
		}
		
		FS("msgconfig",$_POST['msg'],"Dynamic/");
		alogs("Msgonline",0,1,'成功执行了通知信息接口的编辑操作！');//管理员操作日志
		$this->success("操作成功",__URL__."/index/");
    }
	
	
    public function templet()
    {
		$emailTxt = FS("Dynamic/emailtxt");
		$smsTxt = FS("Dynamic/smstxt");
		$msgTxt = FS("Dynamic/msgtxt");

		$this->assign('emailTxt',de_xie($emailTxt));
		$this->assign('smsTxt',de_xie($smsTxt));
		$this->assign('msgTxt',de_xie($msgTxt));
        $this->display();
    }
	
    public function templetsave()
    {
		FS("emailtxt",$_POST['email'],"Dynamic/");
		FS("smstxt",$_POST['sms'],"Dynamic/");
		FS("msgtxt",$_POST['msg'],"Dynamic/");
		alogs("Msgonline",0,1,'成功执行了通知信息模板的编辑操作！');//管理员操作日志
		$this->success("操作成功",__URL__."/templet/");
    }
    //获取手机信息记录
    public function detail(){
    	$pre = C("DB_PREFIX");
    	$Data = D('xbo_smslog'); // 实例化Data数据对象
    	//获取搜索条件
    	 if(isset($_GET['uname']) && $_GET['uname']!=null){
        $where['user_name']=array('like',"%{$_GET['uname']}%");
    }
	     if(isset($_GET['phone']) && $_GET['phone']!=null){
	        $where['to_phone']=array('like',"%{$_GET['phone']}%");
    }
	     if(isset($_GET['back_status']) && $_GET['back_status']!=null){
	        $where['back_status_des']=array('like',"%{$_GET['back_status']}%");
    }	     			   	
	    import('ORG.Util.Page');// 导入分页类
	    $count      = $Data->where($where)->count();// 查询满足要求的总记录数 $map表示查询条件
	    $Page       = new Page($count,20);// 实例化分页类 传入总记录数
	    //经测试，不用传parameter参数即可成功，使用GET传参数
	   //   foreach($where as $key=>$val) {
    //     $Page->parameter   .=   "$key=".urlencode($val).'&';
    // }
	    $show       = $Page->show();// 分页显示输出
	    // 进行分页数据查询
	    $list = D("xbo_smslog as e")
	    		->join($pre."members as m ON e.to_user_id=m.id ")
	    		->field("e.*, m.user_name")
	    		->where($where)->order('id desc')
	    		->limit($Page->firstRow.','.$Page->listRows)
	    		->select();
	    $this->assign('list',$list);// 赋值数据集
	    $this->assign('page',$show);// 赋值分页输出
	    $this->display(); // 输出模板
    	
    }
    //获取邮箱记录
    public function emaillog(){
    	$pre = C("DB_PREFIX");//表前缀
    	$inemail=M('User_email_log');
    	 if(isset($_GET['username']) && $_GET['username']!=null){
        $where['user_name']=array('like',"%{$_GET['username']}%");
    }
	     if(isset($_GET['email']) && $_GET['email']!=null){
	        $where['email']=array('like',"%{$_GET['email']}%");
    }
    	import('ORG.Util.Page');// 导入分页类
    	$count      = $inemail->where($where)->count();// 查询满足要求的总记录数
		$Page       = new Page($count,20);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show       = $Page->show();// 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		//$list = $inemail->order('addtime')->limit($Page->firstRow.','.$Page->listRows)->select();
		 $list = M("User_email_log as e")
	    		->join($pre."members as m ON e.user_id=m.id ")
	    		->field("e.*, m.user_name")
	    		->where($where)
	    		->order('addtime desc')
	    		->limit($Page->firstRow.','.$Page->listRows)
	    		->select();
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		$this->display(); // 输出模板
    	
    }
     public function showdetail()
    {
    	 $id = $_GET['id'];
		 $inemail=M('User_email_log');
		 $where['id']=$id;
		 $arr=$inemail->where($where)->select();
		 $this->assign('list',$arr);
		 $this->display();
		
    }
}
?>