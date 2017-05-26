<?php

/**
 * 加息券
 */
class InterestratecouponAction extends MCommonAction
{
	public function index()
	{
		$this->display( );
	}

    public function summary(){
        $uid = $this->uid;
        $pre = C('DB_PREFIX');
        //$this->assign("dc",M('investor_detail')->where("investor_uid = {$this->uid}")->sum('substitute_money'));
        $this->assign("mx",getMemberBorrowScan($this->uid));
        $data['html'] = $this->fetch();
        exit(json_encode($data));
    }

    /**
     * 未使用加息券
     */
    public function notused()
    {
        $pre = C("DB_PREFIX");

        $model = M('interestratecoupon_detail d');

        $map = array();
        $map['i.online_time'] = array("elt",time());
        $map['i.deadline'] = array("egt",time());
        $map['i.status'] = array("eq",1);
        $map["d.uid"] = $this->uid;
        $map['d.utility_time'] = array("eq",0);

        import( "ORG.Util.Page" );
        $count = M('interestratecoupon_detail d')
            ->join("{$pre}interestratecoupon i on i.id=d.cid")
            ->where($map)->count("d.id");

        $p = new Page($count,20);
        $page = $p->show();
        $Lsql = "{$p->firstRow},{$p->listRows}";

        $field = "d.*,i.title,i.interest_rate,i.online_time,i.deadline,i.status,i.min_duration,i.max_duration,i.min_invest_money";
        $list = M('interestratecoupon_detail d')
            ->join("{$pre}interestratecoupon i on i.id=d.cid")
            ->field($field)
            ->where($map)
            ->order("d.id DESC")
            ->limit($Lsql)
            ->select();
        $this->assign("list", $list);
        $this->assign("pagebar", $page);
        $data['html'] = $this->fetch();
        exit(json_encode($data));
    }

    /**
     * 使用中加息券
     */
    public function using()
    {
        $pre = C("DB_PREFIX");

        $model = M('interestratecoupon_detail d');

        $map = array();
        $map['i.status'] = array("eq",1);
        $map["d.uid"] = $this->uid;
        $map['d.utility_time'] = array("gt",0);
        $map['b.borrow_status'] = array("in","2,4,6");

        import( "ORG.Util.Page" );
        $count = M('interestratecoupon_detail d')
            ->join("{$pre}interestratecoupon i on i.id=d.cid")
            ->join("{$pre}borrow_investor bi on bi.id=d.iid")
            ->join("{$pre}borrow_info b on b.id=d.bid")
            ->where($map)->count("d.id");

        $p = new Page($count,20);
        $page = $p->show();
        $Lsql = "{$p->firstRow},{$p->listRows}";

        $field = "d.*";
        $field.= ",i.title,i.interest_rate,i.online_time,i.deadline,i.status,i.min_duration,i.max_duration,i.min_invest_money";
        $field.= ",b.id bid,b.borrow_name";
        $field.= ",bi.id iid,bi.investor_capital money";

        $list = M('interestratecoupon_detail d')
            ->join("{$pre}interestratecoupon i on i.id=d.cid")
            ->join("{$pre}borrow_info b on b.id=d.bid")
            ->join("{$pre}borrow_investor bi on bi.id=d.iid")
            ->field($field)
            ->where($map)
            ->order("d.id DESC")
            ->limit($Lsql)
            ->select();

        $this->assign("list", $list);
        $this->assign("pagebar", $page);
        $data['html'] = $this->fetch();
        exit(json_encode($data));
    }

    /**
     * 已使用的加息券
     */
    public function used()
    {
        $pre = C("DB_PREFIX");

        $map = array();
        $map['i.status'] = array("eq",1);
        $map["d.uid"] = $this->uid;
        $map['d.utility_time'] = array("gt",0);
        $map['b.borrow_status'] = array("in","7,9");

        import( "ORG.Util.Page" );
        $count = M('interestratecoupon_detail d')
            ->join("{$pre}borrow_info b on b.id=d.bid")
            ->join("{$pre}interestratecoupon i on i.id=d.cid")
            ->where($map)->count("d.id");
        $p = new Page($count,20);
        $page = $p->show();
        $Lsql = "{$p->firstRow},{$p->listRows}";

        $field = "d.*";
        $field.= ",i.title,i.interest_rate,i.online_time,i.deadline,i.status,i.min_duration,i.max_duration,i.min_invest_money";
        $field.= ",b.id bid,b.borrow_name";
        $field.= ",bi.id iid,bi.investor_capital money";

        $list = M('interestratecoupon_detail d')
            ->join("{$pre}interestratecoupon i on i.id=d.cid")
            ->join("{$pre}borrow_info b on b.id=d.bid")
            ->join("{$pre}borrow_investor bi on bi.id=d.iid")
            ->field($field)
            ->where($map)
            ->order("d.id DESC")
            ->limit($Lsql)
            ->select();

        $this->assign("list", $list);
        $this->assign("pagebar", $page);
        $data['html'] = $this->fetch();
        exit(json_encode($data));
    }

    /**
     * 过期的加息券
     */
    public function expire()
    {
        $pre = C("DB_PREFIX");

        $model = M('interestratecoupon_detail d');

        $map = array();
        $map['i.deadline'] = array("lt",time());
        $map['i.status'] = array("eq",1);
        $map["d.uid"] = $this->uid;
        $map['d.utility_time'] = array("eq",0);

        import( "ORG.Util.Page" );
        $count = M('interestratecoupon_detail d')
            ->join("{$pre}interestratecoupon i on i.id=d.cid")
            ->where($map)->count("d.id");
        $p = new Page($count,20);
        $page = $p->show();
        $Lsql = "{$p->firstRow},{$p->listRows}";

        $field = "d.*,i.title,i.interest_rate,i.online_time,i.deadline,i.status,i.min_duration,i.max_duration,i.min_invest_money";
        $list = M("interestratecoupon_detail d")
            ->join("{$pre}interestratecoupon i on i.id=d.cid")
            ->field($field)
            ->where($map)
            ->order("d.id DESC")
            ->limit($Lsql)
            ->select();

        $this->assign("list", $list);
        $this->assign("pagebar", $page);
        $data['html'] = $this->fetch();
        exit(json_encode($data));
    }
}

?>
