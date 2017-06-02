<?php
namespace Admin\Controller;
class SysDataController extends CommonController {
    public function index(){
         $M = M();
        $tabs = $M->query('SHOW TABLE STATUS');
        $total = 0;
            foreach ($tabs as $k => $v) {
            $tabs[$k]['size'] = byteFormat($v['data_length'] + $v['index_length']);
            $total+=$v['data_length'] + $v['index_length'];
        }
        $this->assign("data", $tabs);
        $this->assign("total", byteFormat($total));
        $this->assign("tables", count($tabs));
        $this->display();
    }
    public function  SysData_list()
    {
        $name = I('get.name');
        $M = M();

        $table_list = $M->query('desc '.$name);
        $this->assign('data_name',$name);
        $this->assign('data_list',$table_list);
        $this->display();

    }


}