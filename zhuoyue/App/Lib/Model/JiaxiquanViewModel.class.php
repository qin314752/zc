<?php

/**
 * 加息券
 */
class JiaxiquanViewModel extends ViewModel {
    public $fields = array(
        '_pk'=>'InterestratecouponDetail.id',
    );
    public $viewFields = array(
        'InterestratecouponDetail'=>array('id'=>'id','utility_time','_type'=>'LEFT'),
        'Interestratecoupon'=>array('title','interest_rate','min_duration','max_duration','min_invest_money','online_time','deadline','status','_on'=>'Interestratecoupon.id=InterestratecouponDetail.cid'),
        'Members'=>array('user_name','_on'=>'Members.id=InterestratecouponDetail.uid'),
    );
}
?>