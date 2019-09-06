<?php

class SettleReportController extends SmcmsController{

	public function __construct($tplkey = NULL, $modelname = 'OrderModel') {
        parent::__construct();
    }

    public function settleAction(){
        
        $iget = ['merchant_id', 'settle_time', 'settle_time_to'];
        foreach ($iget as $key) {
            $sch[$key] = SGet($key);
        }
        if (empty($sch['settle_time'])&&empty($sch['settle_time_to'])) {
            $month=date("Y-m");
            $sch['settle_time']=$month."-01";
        }
        $this->assign('sch', $sch);
        
        $selectA = new Select('@pf_order');
        $selectB = new Select('@pf_order');

        $selectA->find('*,1 AS report_type');
        $selectB->find('*,0 AS report_type');

        if (!empty($sch['merchant_id'])) {
            $selectA->where('AND merchant_id=? ',[$sch['merchant_id']]);
            $selectB->where('AND merchant_id=? ',[$sch['merchant_id']]);
        }
        if (!empty($sch['settle_time'])) {
            $selectA->where('AND add_date >=? ',[$sch['settle_time']]);
            $selectB->where('AND refund_time >=? ',[$sch['settle_time']]);
        }
        if (!empty($sch['settle_time_to'])) {
            $selectA->where('AND add_time <? ',[$sch['settle_time_to']." 24:00:00"]);
            $selectB->where('AND refund_time <? ',[$sch['settle_time_to']." 24:00:00"]);
        }
        $selectA->union($selectB);
        //$selectA->orderby('id asc');
        $count=$selectA->getCount();
        if (intval($count)!=0) {
            $list = $selectA->getPagelist(intval($count));
            $rows = $list->getlist(); 
        }else{
            $rows=[];
        }

        $this->assign('rows', $rows);
         
        $report=[];
        foreach ($rows as $key => $value) {
            if ($value['report_type']==1) {
                $report[$value['merchant_id']]['paid'] += $value['paid'];
                $report[$value['merchant_id']]['paid_num']++;
            }else{
                $report[$value['merchant_id']]['refund_fees'] += $value['refund_fees'];
                $report[$value['merchant_id']]['refund_num']++;
            }
        }
        $single=[];
        $total=[];
        $pie=[];
        foreach ($report as $key => $value) {
            $single[$key]['paid'] = $value['paid'];
            $single[$key]['refund_fees'] = $value['refund_fees'];
            $single[$key]['paid_num'] = $value['paid_num'];
            $single[$key]['refund_num'] = $value['refund_num'];
            //获取全部
            $total['paid'] += $value['paid'];
            $total['refund_fees'] += $value['refund_fees'];
            $total['paid_num'] += $value['paid_num'];
            $total['refund_num'] += $value['refund_num'];
            //饼状图
            $single_pie = [];
            $single_pie[0] = DB::getval('@pf_merchant','name',$key);
            $single_pie[1] += $value['paid']-$value['refund_fees'];
            array_push($pie, $single_pie);
        }
        foreach ($pie as $key => $single_pie) {
            if($single_pie[1]==0 || $total['paid']-$total['refund_fees']==0){
                $percent=0;
            }else{
                $percent=sprintf("%.2f", $single_pie[1]/($total['paid']-$total['refund_fees'])*100); 
            }
            
            $pie[$key][0]=$single_pie[0].'('.$percent.'%)';
        }
        $this->assign('single', $single);
        $this->assign('single_pie',json_encode($pie) );
        $this->assign('total', $total);
        $this->display('layout/settle_report_list.tpl');       
    }

    /**
     * 导出订单详情列表
     * 
     */
    public function exportListAction(){
        include 'libs/PHPExcel/Classes/PHPExcel.php';
        include 'libs/PHPExcel/Classes/PHPExcel/Writer/Excel5.php'; //用于输出.xls的
        
         $iget = ['merchant_id', 'settle_time', 'settle_time_to'];
         foreach ($iget as $key) {
            $sch[$key] = SGet($key);
        }
       
        //创建一个excel
        $objPHPExcel = new PHPExcel();
        $letter = array('A','B','C','D','E','F','G','H');
        $header = array("商户名","订单号","商品名","订单金额(元)","订单状态","已支付(元)","退款时间","退款金额(元)");
        $rows = $this->exportData($sch);
        
        for($i=0;$i<count($header);$i++){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue("$letter[$i]1",$header[$i]);
        }
        
        $objPHPExcel->getActiveSheet()->setTitle('订单详情'); //设置工作表名称
        for($a=2;$a<count($rows)+2;$a++){
            $j=0;
            foreach ($rows[$a-2] as $val){
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue("$letter[$j]$a",' '.$val);  
                $j++;
            }
        }

        $obj_Writer = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
        $date = date("Ymd_His",time());
        $filename .= "{$date}.xls";
 
        header("Content-Type: application/force-download"); 
        header("Content-Type: application/octet-stream"); 
        header("Content-Type: application/download"); 
        header('Content-Disposition:inline;filename="'.$filename.'"'); 
        header("Content-Transfer-Encoding: binary"); 
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
        header("Pragma: no-cache"); 
        $obj_Writer->save('php://output');
    }

    /**
     * 查询订单详情数据
     * @param type $iget
     * @return array
     */
    public function exportData($sch) {
     
        if (empty($sch['settle_time'])&&empty($sch['settle_time_to'])) {
            $month=date("Y-m");
            $sch['settle_time']=$month."-01";
        }
       
        $selectA = new Select('@pf_order');
        $selectB = new Select('@pf_order');

        $selectA->find('*');
        $selectB->find('*');

        if (!empty($sch['merchant_id'])) {
            $selectA->where('and merchant_id=? ',[$sch['merchant_id']]);
            $selectB->where('and merchant_id=? ',[$sch['merchant_id']]);
        }
        if (!empty($sch['settle_time'])) {
            $selectA->where('and @pf_order.add_date >? ',[$sch['settle_time']]);
            $selectB->where('and @pf_order.refund_time >? ',[$sch['settle_time']]);
        }
        if (!empty($sch['settle_time_to'])) {
            $selectA->where('and @pf_order.add_date <? ',[$sch['settle_time_to']." 24:00:00"]);
            $selectB->where('and @pf_order.refund_time <? ',[$sch['settle_time_to']." 24:00:00"]);
        }

        $selectA->union($selectB);
        //$selectA->orderby('id asc');

        $count=$selectA->getCount();
        if (intval($count)!=0) {
            $list = $selectA->getPagelist(intval($count));
            $rows = $list->getlist(); 
        }else{
            $rows=[];
        }
        
        $report=[];
        $id_array=[];
        $k=0;
        foreach ($rows as $key => $value) {
            if (in_array($value['order_id'], $id_array)) {
                continue;
            }else{
                $id_array[]=$value['order_id'];
            }
            if(empty($value['merchant_id'])){
                $report[$k]['name'] = '';
            }else{
                 $name=DB::getone('select name from @pf_merchant where id=?',[$value['merchant_id']]);
                 $report[$k]['name'] = $name['name'];
            }
            $report[$k]['order_id']=$value['order_id'];
            $report[$k]['title'] = $value['title'];
            $report[$k]['goods_amount'] = $value['goods_amount'];
            $report[$k]['status'] = $value['status'];
            $report[$k]['paid'] = $value['paid'];
            $report[$k]['refund_time'] = $value['refund_time'];
            $report[$k]['refund_fees'] = $value['refund_fees'];
            $k++;
        }
        return $report;
    }

    public function saleAction() {
        $iget = ['merchant_id', 'add_time_from', 'add_time_to'];
        foreach ($iget as $key) {
            $sch[$key] = SGet($key);
        }
        if (empty($sch['add_time_from'])&&empty($sch['add_time_to'])) {
            $month=date("Y-m");
            $sch['add_time_from']=$month."-01";
        }
        $this->assign('sch', $sch);

        $selectA = new Select('@pf_order');
        $selectB = new Select('@pf_order');//退款单

        $selectA->find('goods_amount,merchant_id,refund,refund_fees,refund_time,add_time,add_date,delivery_price,paid,school_id,1 AS report_type');
        $selectB->find('goods_amount,merchant_id,refund,refund_fees,refund_time,add_time,add_date,delivery_price,paid,school_id,0 AS report_type');

        if (!empty($sch['merchant_id'])) {
            $selectA->where('AND merchant_id=? ',[$sch['merchant_id']]);
            $selectB->where('AND merchant_id=? ',[$sch['merchant_id']]);
        }
        if (!empty($sch['add_time_from'])) {
            $selectA->where('AND add_date >=? ',[$sch['add_time_from']]);
            $selectB->where('AND refund=2  AND refund_time >=? ',[$sch['add_time_from']]);
        }
        if (!empty($sch['add_time_to'])) {
            $selectA->where('AND add_time <? ',[$sch['add_time_to']." 24:00:00"]);
            $selectB->where('AND refund=2 AND refund_time <? ',[$sch['add_time_to']." 24:00:00"]);
        }
        $selectA->union($selectB);

        $count=$selectA->getCount();
        if (intval($count)!=0) {
            $list = $selectA->getPagelist(intval($count));
            $rows = $list->getlist();
        }else{
            $rows=[];
        }
        $this->assign('rows', $rows);

        $report=[];
        foreach ($rows as $key => $value) {
            if ($value['report_type']==1) {
                $report[$value['merchant_id']]['paid'] += $value['paid'];
                $report[$value['merchant_id']]['paid_num']++;
            }else{
                $report[$value['merchant_id']]['refund_fees'] += $value['refund_fees'];
                $report[$value['merchant_id']]['refund_num']++;
            }
        }

        $single = [];
        $total = [];
        $pie = [];
        foreach ($report as $key => $value) {
            $single[$key]['paid'] = $value['paid'];
            $single[$key]['refund_fees'] = $value['refund_fees'];
            $single[$key]['paid_num'] = $value['paid_num'];
            $single[$key]['refund_num'] = $value['refund_num'];
            //获取全部
            $total['paid'] += $value['paid'];
            $total['refund_fees'] += $value['refund_fees'];
            $total['paid_num'] += $value['paid_num'];
            $total['refund_num'] += $value['refund_num'];
            //饼状图
            $single_pie = [];
            $single_pie[0] = DB::getval('@pf_merchant','name',$key);
            $single_pie[1] += $value['paid']-$value['refund_fees'];
            array_push($pie, $single_pie);
        }

        foreach ($pie as $key => $single_pie) {
            if($single_pie[1]==0 || $total['paid']-$total['refund_fees']==0){
                $percent=0;
            }else{
                $percent=sprintf("%.2f", $single_pie[1]/($total['paid']-$total['refund_fees'])*100);
            }

            $pie[$key][0]=$single_pie[0].'('.$percent.'%)';
        }

        $this->assign('single', $single);
        $this->assign('single_pie',json_encode($pie) );
        $this->assign('total', $total);
        $this->display('layout/settle_sale_report_list.tpl');
    }
    
}