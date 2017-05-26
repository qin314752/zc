<?php
// 金糯米内核类库，2014-06-11_listam
class AutoAction extends ACommonAction {
	private $updir = NULL;
	public function _MyInit(){
		Mheader("gbk");
		$this->updir = dirname(C("APP_ROOT"))."/CORE/Auto/";
	}
	public function index(){
		$res = file_get_contents($this->updir."config.txt");
		$this->assign("vo",explode("|",$res));
		$this->display();
	}


	public function save(){
		$str = text($_POST['o_time'])."|";
		$str .= text($_POST['o_rate'])."|";
		$str .= text($_POST['o_key']);
		$res = file_put_contents($this->updir."config.txt",$str);

        $str1 = $this->updir."AutoRepayment/wget.exe -O - -q -t 1 ".$_SERVER['HTTP_ORIGIN']."/auto/autorepayment?key=".$_POST['o_key'];
        file_put_contents($this->updir."AutoRepayment/do.bat",$str1);

        $str2 = "schtasks /create /tn AutoRepayment /tr ".$this->updir."AutoRepayment/do.bat  /sc daily /st 23:50:00";
        file_put_contents($this->updir."AutoRepayment/createTask.bat",$str2);

        $str3 = "schtasks /delete /tn AutoRepayment /f";
        file_put_contents($this->updir."AutoRepayment/delTask.bat",$str3);


        if($res){
			alogs("Auto",0,1,'自动值守程序参数修改成功！');//管理员操作日志
			$this->success("保存成功,如执行时间有改动，请重启程序");
		}else{
			alogs("Auto",0,0,'自动值守程序参数修改失败！');//管理员操作日志
			$this->error("保存失败,请重试");
		}
	}


    public function start(){
        exec($this->updir."AutoRepayment/delTask.bat",$out,$status);
        print_r($out[2]);
	}



	public function close(){
        exec($this->updir."AutoRepayment/do.bat",$out,$status);
        if($status == '0'){
           echo iconv('utf-8','gbk','运行成功');
        }else{
           echo iconv('utf-8','gbk','运行失败');
        }
	}
	public function startServer(){
		exec($this->updir."startserver.exe -1",$out,$status);
		print_r($out);
	}
	public function stopServer(){
		exec($this->updir."stopserver.exe -1",$out,$status);
		print_r($out);
	}


	public function showstatus(){
		exec($this->updir."AutoRepayment/createTask.bat",$out,$status);
		print_r($out[2]);
	}
}