<?php
// 全局设置
class CapitalrepayAction extends ACommonAction
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
			$map['b.deadline'] = array("between",$timespan);
			$search['start_time'] = strtotime(urldecode($_REQUEST['start_time']));	
			$search['end_time'] = strtotime(urldecode($_REQUEST['end_time']));
			$query ="start_time=".$_REQUEST['start_time']."&amp;end_time=".$_REQUEST['end_time'];	
		}elseif(!empty($_REQUEST['start_time'])){
			$xtime = strtotime(urldecode($_REQUEST['start_time']));
			$map['b.deadline'] = array("gt",$xtime);
			$search['start_time'] = $xtime;
			$query = "start_time=".$_REQUEST['start_time'];	
		}elseif(!empty($_REQUEST['end_time'])){
			$xtime = strtotime(urldecode($_REQUEST['end_time']));
			$map['b.deadline'] = array("lt",$xtime);
			$search['end_time'] = $xtime;
			$query = $query."end_time=".$_REQUEST['end_time'];	
		}else{
			if(!empty($_REQUEST['day'])){
			    $day = $_REQUEST['day'];
			}else{
			    $day = 1;
			}
			$query = "day=".$day;
			$start = 0;
			$end = strtotime("+{$day} day",strtotime(date("Y-m-d",time())." 23:59:59"));
			$map['b.deadline'] = array(
						"between",
						"{$start},{$end}"
			);
			$search['start_time'] = $start;
			$search['end_time'] = $end;	
		}
		
		$map['b.status'] = 7;
		//$map['i.progress'] = 100;
	
		$list = M("transfer_investor_detail b")->join("{$this->pre}transfer_borrow_info i ON i.id=b.borrow_id")
            ->join("{$this->pre}members m ON m.id=i.borrow_uid")
            ->field('i.borrow_name,m.user_name,b.id,b.borrow_id,sum(b.capital) as bmoney,sum(b.interest) as interest, sum(b.capital+b.interest) as total,b.deadline')->where($map)->group('borrow_id')->order("b.deadline desc")->select();
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
			$map['b.deadline'] = array("between",$timespan);
			$search['start_time'] = strtotime(urldecode($_REQUEST['start_time']));	
			$search['end_time'] = strtotime(urldecode($_REQUEST['end_time']));	
		}elseif(!empty($_REQUEST['start_time'])){
			$xtime = strtotime(urldecode($_REQUEST['start_time']));
			$map['b.deadline'] = array("gt",$xtime);
			$search['start_time'] = $xtime;	
		}elseif(!empty($_REQUEST['end_time'])){
			$xtime = strtotime(urldecode($_REQUEST['end_time']));
			$map['b.deadline'] = array("lt",$xtime);
			$search['end_time'] = $xtime;	
		}else{
			if(!empty($_REQUEST['day'])){
			    $day = $_REQUEST['day'];
			}else{
			    $day = 1;
			}
			$start = 0;
			$end = strtotime("+{$day} day",strtotime(date("Y-m-d",time())." 23:59:59"));
			$map['b.deadline'] = array(
						"between",
						"{$start},{$end}"
			);
			$search['start_time'] = $start;
			$search['end_time'] = $end;	
		}
		
		$map['b.status'] = 7;
//		$map['i.progress'] = 100;
		$pre = $this->pre;
		$list = M("transfer_investor_detail b")->join("{$this->pre}transfer_borrow_info i ON i.id=b.borrow_id")
            ->join("{$this->pre}members m ON m.id=i.borrow_uid")
            ->field('i.borrow_name,m.user_name,b.id,b.borrow_id,sum(b.capital) as bmoney,sum(b.interest) as interest, sum(b.capital+b.interest) as total,b.deadline')->where($map)->group('borrow_id')->order("b.deadline desc")->select();
		$row=array();
		$row[0]=array('序号','标号ID','用户名','待还款项目','待还本金','待还利息','总待还金额','待还时间');
		$i=1;
		foreach($list as $v){
				$row[$i]['i'] = $i;
				$row[$i]['borrow_id'] = $v['borrow_id'];
                $row[$i]['user_name'] = $v['user_name'];
				$row[$i]['borrow_name'] = $v['borrow_name'];
				$row[$i]['bmoney'] = $v['bmoney'];
				$row[$i]['interest'] = $v['interest'];
				$row[$i]['total'] = $v['total'];
				$row[$i]['deadline'] = date("Y-m-d H:i:s",$v['deadline']);
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
            $map['b.deadline'] = array("between",$timespan);
            $search['start_time'] = strtotime(urldecode($_REQUEST['start_time']));
            $search['end_time'] = strtotime(urldecode($_REQUEST['end_time']));
            $query ="start_time=".$_REQUEST['start_time']."&amp;end_time=".$_REQUEST['end_time'];
        }elseif(!empty($_REQUEST['start_time'])){
            $xtime = strtotime(urldecode($_REQUEST['start_time']));
            $map['b.deadline'] = array("gt",$xtime);
            $search['start_time'] = $xtime;
            $query = "start_time=".$_REQUEST['start_time'];
        }elseif(!empty($_REQUEST['end_time'])){
            $xtime = strtotime(urldecode($_REQUEST['end_time']));
            $map['b.deadline'] = array("lt",$xtime);
            $search['end_time'] = $xtime;
            $query = $query."end_time=".$_REQUEST['end_time'];
        }else{
            if(!empty($_REQUEST['day'])){
                $day = $_REQUEST['day'];
            }else{
                $day = 1;
            }
            $query = "day=".$day;
            $start = 0;
            $end = strtotime("+{$day} day",strtotime(date("Y-m-d",time())." 23:59:59"));
            $map['b.deadline'] = array(
                "between",
                "{$start},{$end}"
            );
            $search['start_time'] = $start;
            $search['end_time'] = $end;
        }

        $map['b.status'] = 7;
        //$map['i.progress'] = 100;

        $list = M("investor_detail b")->join("{$this->pre}borrow_info i ON i.id=b.borrow_id")
            ->join("{$this->pre}members m ON m.id=i.borrow_uid")
            ->field('i.borrow_name,m.user_name,b.id,b.borrow_id,sum(b.capital) as bmoney,sum(b.interest) as interest, sum(b.capital+b.interest) as total,b.deadline')->where($map)->group('borrow_id')->order("b.deadline desc")->select();
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
            $map['b.deadline'] = array("between",$timespan);
            $search['start_time'] = strtotime(urldecode($_REQUEST['start_time']));
            $search['end_time'] = strtotime(urldecode($_REQUEST['end_time']));
        }elseif(!empty($_REQUEST['start_time'])){
            $xtime = strtotime(urldecode($_REQUEST['start_time']));
            $map['b.deadline'] = array("gt",$xtime);
            $search['start_time'] = $xtime;
        }elseif(!empty($_REQUEST['end_time'])){
            $xtime = strtotime(urldecode($_REQUEST['end_time']));
            $map['b.deadline'] = array("lt",$xtime);
            $search['end_time'] = $xtime;
        }else{
            if(!empty($_REQUEST['day'])){
                $day = $_REQUEST['day'];
            }else{
                $day = 1;
            }
            $start = 0;
            $end = strtotime("+{$day} day",strtotime(date("Y-m-d",time())." 23:59:59"));
            $map['b.deadline'] = array(
                "between",
                "{$start},{$end}"
            );
            $search['start_time'] = $start;
            $search['end_time'] = $end;
        }

        $map['b.status'] = 7;
//        $map['i.progress'] = 100;
        $pre = $this->pre;
        $list = M("investor_detail b")->join("{$this->pre}borrow_info i ON i.id=b.borrow_id")
            ->join("{$this->pre}members m ON m.id=i.borrow_uid")
            ->field('i.borrow_name,m.user_name,b.id,b.borrow_id,sum(b.capital) as bmoney,sum(b.interest) as interest, sum(b.capital+b.interest) as total,b.deadline')->where($map)->group('borrow_id')->order("b.deadline desc")->select();
        $row=array();
        $row[0]=array('序号','标号ID','用户名','待还款项目','待还本金','待还利息','总待还金额','待还时间');
        $i=1;
        foreach($list as $v){
            $row[$i]['i'] = $i;
            $row[$i]['borrow_id'] = $v['borrow_id'];
            $row[$i]['user_name'] = $v['user_name'];
            $row[$i]['borrow_name'] = $v['borrow_name'];
            $row[$i]['bmoney'] = $v['bmoney'];
            $row[$i]['interest'] = $v['interest'];
            $row[$i]['total'] = $v['total'];
            $row[$i]['deadline'] = date("Y-m-d H:i:s",$v['deadline']);
            $i++;
        }

        $xls = new Excel_XML('UTF-8', false, 'datalist');
        $xls->addArray($row);
        $xls->generateXML("datalistcard");
    }
	
}
?>