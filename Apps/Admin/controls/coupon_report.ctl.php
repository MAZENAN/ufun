<?php


class CouponReportController extends SmcmsController{

	public function __construct($tplkey = NULL, $modelname = 'CouponPacksModel') {
        parent::__construct();
    }

    public function indexAction(){
        $this->doact('*');
        $iget = ['title'];
        foreach ($iget as $key) {
            $sch[$key] = SGet($key);
        }
        $this->assign('sch', $sch);
        
        $select = new Select('@pf_coupon_packs');
        $select->find('id,title');
        if (!empty($sch['title'])) {
            $select->where('and title like ? ',['%'.$sch['title'].'%']);
        }
        $select->orderby('id desc');
        $list = $select->getPagelist();
        $rows = $list->getlist();

        foreach ($rows as $key => &$value) {
            //领取人数
            $get_log = DB::getone('select count(DISTINCT mobile) as num from @pf_coupons_log as cl LEFT JOIN @pf_coupons as c on cl.coupon_id=c.id where c.pack_id=?',[$value['id']]);
            $value['get_num']=$get_log['num'];
            //使用情况
            $use_log = DB::getlist('select o.userid,o.coupon_log_id,c.coupon,cl.usetime from @pf_order as o , @pf_coupons_log as cl,@pf_coupons as c where o.coupon_log_id = cl.id and cl.coupon_id=c.id  and  c.pack_id=? and o.state>=3',[$value['id']]);
            if (!empty($use_log)) {
                $arr=$this->explain_use_log($use_log);
                $value['use_num']=$arr['use_num'];
                $value['use_piece']=$arr['use_piece'];
                $value['use_coupon']=$arr['use_coupon'];
                $value['pr']=$value['get_num']? floatval($value['use_num']/$value['get_num']) : 0 ;
                $value['pr']=round($value['pr'],3);

            }
            
        }

        $this->assign('bar', $list->getinfo());
        $this->assign('rows', $rows);
        $this->display('layout/coupon_report_list.tpl');       
    }
    public function explain_use_log($use_log){
        $arr=[];
        $coupons=0;
        $people=[];
        
        foreach ($use_log as $key => $value) {
            $coupons+=$value['coupon'];
            if (!in_array($value['userid'], $people)) {
                $people[]=$value['userid'];
            }
        }

        $arr['use_piece']=count($use_log);
        $arr['use_coupon']=$coupons;
        $arr['use_num']=count($people);

        return $arr;
    }
    public function date_reportAction(){
        
        $iget = ['time', 'time_to','packid'];
        foreach ($iget as $key) {
            $sch[$key] = SGet($key);
        }
        $packid = $sch['packid'];
        
        if (empty($sch['time'])&&empty($sch['time_to'])) {
            $month=date("Y-m");
            $sch['time']=$month."-01";
        }
        $this->assign('sch', $sch);

        //领取人数
        $where_get='';
        $where_use='';
        if ($sch['time']) {
            $where_get.=' and cl.addtime > "'.$sch['time'].'"';
            $where_use.=' and usetime > "'.$sch['time'].'"';
        }
        if ($sch['time_to']) {
            $where_get.=' and cl.addtime <= "'.$sch['time_to'].' 23:59:59"';
            $where_use.=' and usetime <= "'.$sch['time_to'].' 23:59:59"';
        }
        $rows=[];
        $get_log = DB::getlist('select count(DISTINCT mobile) as num,date_format(cl.addtime,"%Y-%m-%d") as addtime  from @pf_coupons_log as cl LEFT JOIN @pf_coupons as c on cl.coupon_id=c.id where c.pack_id=? '.$where_get.' group by  addtime',[$packid]);
        if (!empty($get_log)) {
            foreach ($get_log as $key => $value) {
               $date=$value['addtime'];
               $rows[$date]['get_num']=$value['num'];
            }
        }
        //使用情况
        $use_log = DB::getlist('select o.userid,o.coupon_log_id,c.coupon,cl.usetime from @pf_order as o , @pf_coupons_log as cl,@pf_coupons as c where o.coupon_log_id = cl.id and cl.coupon_id=c.id  and  c.pack_id=?  and o.state>=3'.$where_use,[$packid]);
        if (!empty($use_log)) {
            $temp=[];
            foreach ($use_log as $key => $value) {
                $date=date("Y-m-d",strtotime($value['usetime']));
                $temp[$date][]=$value;
            }
            foreach ($temp as $key => $value) {
                //每天的使用情况
                if (!empty( $value)) {
                    $arr=$this->explain_use_log($value);
                    $rows[$key]['use_num']=$arr['use_num'];
                    $rows[$key]['use_piece']=$arr['use_piece'];
                    $rows[$key]['use_coupon']=$arr['use_coupon'];
                    $rows[$key]['pr']=$rows[$key]['get_num']? floatval($rows[$key]['use_num']/$rows[$key]['get_num']) : 0 ;
                    $rows[$key]['pr']=round($rows[$key]['pr'],3);
                }
                   
            }

        }
        $this->assign('rows', $rows);
        $this->display('layout/date_report_list.tpl');   
    }

    public function piece_reportAction(){
        $iget = ['time', 'time_to','packid'];
        foreach ($iget as $key) {
            $sch[$key] = SGet($key);
        }
        $packid = $sch['packid'];
        
        if (empty($sch['time'])&&empty($sch['time_to'])) {
            $month=date("Y-m");
            $sch['time']=$month."-01";
        }
        $this->assign('sch', $sch);
        //领取人数
        $where_get='';
        $where_use='';
        if ($sch['time']) {
            $where_get.=' and addtime > "'.$sch['time'].'"';
            $where_use.=' and usetime > "'.$sch['time'].'"';
        }
        if ($sch['time_to']) {
            $where_get.=' and addtime <= "'.$sch['time_to'].' 23:59:59"';
            $where_use.=' and usetime <= "'.$sch['time_to'].' 23:59:59"';
        }

        $rows = DB::getlist('select id,coupon,scope from @pf_coupons where pack_id=? ',[$packid]);

        foreach ($rows as $key => &$value) {
            //领取人数
            $get_log = DB::getone('select count(DISTINCT mobile) as num from @pf_coupons_log where coupon_id=?'.$where_get,[$value['id']]);
            $value['get_num']=$get_log['num'];
            //使用情况
            $use_log = DB::getlist('select o.userid,o.coupon_log_id,cl.usetime from @pf_order as o , @pf_coupons_log as cl where o.coupon_log_id = cl.id  and cl.coupon_id=?  and o.state>=3'.$where_use,[$value['id']]);
            if (!empty($use_log)) {
                $arr=$this->explain_use_log($use_log);
                $value['use_num']=$arr['use_num'];
                $value['use_piece']=$arr['use_piece'];
                $value['use_coupon']=$arr['use_coupon'];
                $value['pr']=$value['get_num']? floatval($value['use_num']/$value['get_num']) : 0 ;
                $value['pr']=round($value['pr'],3);
            }
        }
        $this->assign('rows', $rows);
        $this->display('layout/piece_report_list.tpl');  
    }

    
}