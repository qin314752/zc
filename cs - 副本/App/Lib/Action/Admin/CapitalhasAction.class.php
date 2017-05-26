<?php
// 全局设置
class CapitalhasAction extends ACommonAction
{
    /**
    +----------------------------------------------------------
    * 默认操作
    +----------------------------------------------------------
    */
    public function index()
    {
		$map=array();
		if(!empty($_REQUEST['start_time']) && !empty($_REQUEST['end_time'])){
			$timespan = strtotime(urldecode($_REQUEST['start_time'])).",".strtotime(urldecode($_REQUEST['end_time']));
			$map['b.repayment_time'] = array("between",$timespan);
			$search['start_time'] = strtotime(urldecode($_REQUEST['start_time']));	
			$search['end_time'] = strtotime(urldecode($_REQUEST['end_time']));
			$query ="start_time=".$_REQUEST['start_time']."&amp;end_time=".$_REQUEST['end_time'];	
		}elseif(!empty($_REQUEST['start_time'])){
			$xtime = strtotime(urldecode($_REQUEST['start_time']));
			$map['b.repayment_time'] = array("gt",$xtime);
			$search['start_time'] = $xtime;
			$query = "start_time=".$_REQUEST['start_time'];	
		}elseif(!empty($_REQUEST['end_time'])){
			$xtime = strtotime(urldecode($_REQUEST['end_time']));
			$map['b.repayment_time'] = array("lt",$xtime);
			$search['end_time'] = $xtime;
			$query = $query."end_time=".$_REQUEST['end_time'];	
		}else{
			if(!empty($_REQUEST['day'])){
			    $day = $_REQUEST['day'];
			}else{
			    $day = 1;
			}
			$query = "day=".$day;
			$start = strtotime("-{$day} day",strtotime(date("Y-m-d",time())." 00:00:00"));
            $end = strtotime("-1 day",strtotime(date("Y-m-d",time())." 23:59:59"));
			$map['b.repayment_time'] = array(
						"between",
						"{$start},{$end}"
			);
			$search['start_time'] = $start;
			$search['end_time'] = $end;	
		}
		
//		$map['b.status'] = 1;
		//$map['i.progress'] = 100;
	
		$list = M("transfer_investor_detail b")->join("{$this->pre}transfer_borrow_info i ON i.id=b.borrow_id")->join("{$this->pre}members m ON m.id=b.borrow_uid")->field('i.borrow_name,b.id,b.borrow_id,sum(b.receive_capital) capital,sum(b.receive_interest) interest,b.repayment_time,m.user_name')->where($map)->group("b.borrow_id desc")->select();

        $this->assign("search",$search);
		$this->assign('list',$list);
		$this->assign('query',$query);
		
        $this->display();
    }

	public function export(){
		import("ORG.Io.Excel");

		$map=array();
		if(!empty($_REQUEST['start_time']) && !empty($_REQUEST['end_time'])){
			$timespan = strtotime(urldecode($_REQUEST['start_time'])).",".strtotime(urldecode($_REQUEST['end_time']));
			$map['b.repayment_time'] = array("between",$timespan);
			$search['start_time'] = strtotime(urldecode($_REQUEST['start_time']));	
			$search['end_time'] = strtotime(urldecode($_REQUEST['end_time']));	
		}elseif(!empty($_REQUEST['start_time'])){
			$xtime = strtotime(urldecode($_REQUEST['start_time']));
			$map['b.repayment_time'] = array("gt",$xtime);
			$search['start_time'] = $xtime;	
		}elseif(!empty($_REQUEST['end_time'])){
			$xtime = strtotime(urldecode($_REQUEST['end_time']));
			$map['b.repayment_time'] = array("lt",$xtime);
			$search['end_time'] = $xtime;	
		}else{
			if(!empty($_REQUEST['day'])){
			    $day = $_REQUEST['day'];
			}else{
			    $day = 1;
			}
            $start = strtotime("-{$day} day",strtotime(date("Y-m-d",time())." 00:00:00"));
            $end = strtotime("-1 day",strtotime(date("Y-m-d",time())." 23:59:59"));
			$map['b.repayment_time'] = array(
						"between",
						"{$start},{$end}"
			);
			$search['start_time'] = $start;
			$search['end_time'] = $end;	
		}
		
//		$map['b.status'] = 1;
//		$map['i.progress'] = 100;
		$pre = $this->pre;
		$list = M("transfer_investor_detail b")->join("{$this->pre}transfer_borrow_info i ON i.id=b.borrow_id")->join("{$this->pre}members m ON m.id=b.borrow_uid")->field('i.borrow_name,b.id,b.borrow_id,sum(b.receive_capital) capital,sum(b.receive_interest) interest,b.repayment_time,m.user_name')->where($map)->group("b.borrow_id desc")->select();
		$row=array();
		$row[0]=array('序号','标号ID','还款项目','已还本金','已还利息','还款人','还款时间');
		$i=1;
		foreach($list as $v){
				$row[$i]['i'] = $i;
				$row[$i]['borrow_id'] = $v['borrow_id'];
				$row[$i]['borrow_name'] = $v['borrow_name'];
				$row[$i]['capital'] = $v['capital'];
				$row[$i]['interest'] = $v['interest'];
				$row[$i]['user_name'] = $v['user_name'];
				$row[$i]['repayment_time'] = date("Y-m-d H:i:s",$v['repayment_time']);
				$i++;
		}
		
		$xls = new Excel_XML('UTF-8', false, 'datalist');
		$xls->addArray($row);
		$xls->generateXML("datalistcard");
	}
    public function san()
    {
        $map=array();
        if(!empty($_REQUEST['start_time']) && !empty($_REQUEST['end_time'])){
            $timespan = strtotime(urldecode($_REQUEST['start_time'])).",".strtotime(urldecode($_REQUEST['end_time']));
            $map['b.repayment_time'] = array("between",$timespan);
            $search['start_time'] = strtotime(urldecode($_REQUEST['start_time']));
            $search['end_time'] = strtotime(urldecode($_REQUEST['end_time']));
            $query ="start_time=".$_REQUEST['start_time']."&amp;end_time=".$_REQUEST['end_time'];
        }elseif(!empty($_REQUEST['start_time'])){
            $xtime = strtotime(urldecode($_REQUEST['start_time']));
            $map['b.repayment_time'] = array("gt",$xtime);
            $search['start_time'] = $xtime;
            $query = "start_time=".$_REQUEST['start_time'];
        }elseif(!empty($_REQUEST['end_time'])){
            $xtime = strtotime(urldecode($_REQUEST['end_time']));
            $map['b.repayment_time'] = array("lt",$xtime);
            $search['end_time'] = $xtime;
            $query = $query."end_time=".$_REQUEST['end_time'];
        }elseif (!empty($_REQUEST['day']) && $_REQUEST['day']==2) {
            $day = 2;
           $query = "day=".$day;
            $start = strtotime(date("Y-m-d",time())." 00:00:00");
            $end = strtotime(date("Y-m-d",time())." 23:59:59");
            $map['b.repayment_time'] = array(
                "between",
                "{$start},{$end}"
            );
            $search['start_time'] = $start;
            $search['end_time'] = $end;
        }else{
            if(!empty($_REQUEST['day'])){
                $day = $_REQUEST['day'];
            }else{
                $day = 1;
            }
            $query = "day=".$day;
            $start = strtotime("-{$day} day",strtotime(date("Y-m-d",time())." 00:00:00"));
            $end = strtotime("-1 day",strtotime(date("Y-m-d",time())." 23:59:59"));
            $map['b.repayment_time'] = array(
                "between",
                "{$start},{$end}"
            );
            $search['start_time'] = $start;
            $search['end_time'] = $end;
        }

//        $map['b.status'] = 2;
        //$map['i.progress'] = 100;

        $list = M("investor_detail b")->join("{$this->pre}borrow_info i ON i.id=b.borrow_id")->join("{$this->pre}members m on m.id = b.borrow_uid")->field('i.borrow_name,i.total,b.id,b.borrow_id,sum(b.receive_capital) capital,sum(b.receive_interest) interest, b.sort_order,b.repayment_time,m.user_name')->where($map)->group("b.repayment_time desc")->select();
        $this->assign("search",$search);
        $this->assign('list',$list);
        $this->assign('query',$query);

        $this->display();
    }
    public function exportsan(){
        import("ORG.Io.Excel");

        $map=array();
        if(!empty($_REQUEST['start_time']) && !empty($_REQUEST['end_time'])){
            $timespan = strtotime(urldecode($_REQUEST['start_time'])).",".strtotime(urldecode($_REQUEST['end_time']));
            $map['b.repayment_time'] = array("between",$timespan);
            $search['start_time'] = strtotime(urldecode($_REQUEST['start_time']));
            $search['end_time'] = strtotime(urldecode($_REQUEST['end_time']));
        }elseif(!empty($_REQUEST['start_time'])){
            $xtime = strtotime(urldecode($_REQUEST['start_time']));
            $map['b.repayment_time'] = array("gt",$xtime);
            $search['start_time'] = $xtime;
        }elseif(!empty($_REQUEST['end_time'])){
            $xtime = strtotime(urldecode($_REQUEST['end_time']));
            $map['b.repayment_time'] = array("lt",$xtime);
            $search['end_time'] = $xtime;
        }elseif (!empty($_REQUEST['day']) && $_REQUEST['day']==2) {
            $day = 2;
           $query = "day=".$day;
            $start = strtotime(date("Y-m-d",time())." 00:00:00");
            $end = strtotime(date("Y-m-d",time())." 23:59:59");
            $map['b.repayment_time'] = array(
                "between",
                "{$start},{$end}"
            );
            $search['start_time'] = $start;
            $search['end_time'] = $end;
        }else{
            if(!empty($_REQUEST['day'])){
                $day = $_REQUEST['day'];
            }else{
                $day = 1;
            }
            $start = strtotime("-{$day} day",strtotime(date("Y-m-d",time())." 00:00:00"));
            $end = strtotime("-1 day",strtotime(date("Y-m-d",time())." 23:59:59"));
            $map['b.repayment_time'] = array(
                "between",
                "{$start},{$end}"
            );
            $search['start_time'] = $start;
            $search['end_time'] = $end;
        }

//        $map['b.status'] = 2;
//        $map['i.progress'] = 100;
        $pre = $this->pre;
        $list = M("investor_detail b")->join("{$this->pre}borrow_info i ON i.id=b.borrow_id")->join("{$this->pre}members m on m.id = b.borrow_uid")->field('i.borrow_name,i.total,b.id,b.borrow_id,sum(b.receive_capital) capital,sum(b.receive_interest) interest, b.sort_order,b.repayment_time,m.user_name')->where($map)->group("b.repayment_time desc")->select();
        $row=array();
        $row[0]=array('序号','标号ID','还款项目','还款本金','还款利息','还款期数','还款人','还款时间');
        $i=1;
        foreach($list as $v){
            $row[$i]['i'] = $i;
            $row[$i]['borrow_id'] = $v['borrow_id'];
            $row[$i]['borrow_name'] = $v['borrow_name'];
            $row[$i]['capital'] = $v['capital'];
            $row[$i]['interest'] = $v['interest'];
            $row[$i]['sort_order'] = $v['sort_order']."/".$v['total'];
            $row[$i]['user_name'] = $v['user_name'];
            $row[$i]['repayment_type'] = date("Y-m-d H:i:s",$v['repayment_time']);
            $i++;
        }

        $xls = new Excel_XML('UTF-8', false, 'datalist');
        $xls->addArray($row);
        $xls->generateXML("datalistcard");
    }
	
}
?>