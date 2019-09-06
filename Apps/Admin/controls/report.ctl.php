<?php


class ReportController extends SmcmsController{

	public function __construct($tplkey = NULL, $modelname = 'OrderModel') {
        parent::__construct();
    }

    public function indexAction(){
        $this->doact('*');
        $row = DB::getlist('select * from @pf_order where  NOT ISNULL(crm_time) and crm_time > "2015-01-01 08:00:00"'); //where  NOT ISNULL(crm_time)
        $info = DB::getlist('select * from @pf_order_modify where state = 1');
        //未与供应商结算的金额
        $data = DB::getlist('select * from @pf_order where  NOT ISNULL(crm_time) and crm_time > "2015-01-01 08:00:00" and settle_state < 3');
        $get=SGet('year');
        $part = empty($get) ? date('Y'):$get;//接收传递过来的年份
        foreach ($info as $k ) {
            $c=date('Y',strtotime($k['check_time']));
            $m=date('m',strtotime($k['check_time']));
            if($part == $c){
                if($k['type'] == 1){
                    $report[$m]['sales'] +=$k['fees'];//补差价
                    $count['count_sales'] +=$k['fees'];//总计销售金额
                }else{
                    $report[$m]['refund_fees'] +=$k['fees'];//退差价
                    $count['count_refund_fees'] +=$k['fees'];//总计退款金额
                }
            }	
        }
        foreach ($row as $key) {
            $y=date('Y',strtotime($key['crm_time']));//财务确认收款年份
            //$m=date('m',strtotime($key['crm_time']));//财务确认收款时间
            $r_y=date('Y',strtotime($key['refund_time']));//退款年份         
            $year[$y]=$y;//财务确认收款年份
            if($part == $y || $part == $r_y){
                if($key['refund'] ==2 && $part != $y){
                    $m = date('m',strtotime($key['refund_time']));//退款确认时间
                    
                }else{
                    $m = date('m',strtotime($key['crm_time']));//财务确认收款时间
                }
                $report[$m]['month'] = $m;//月份
                if($key['refund'] ==2 && $part == $r_y){//判断退款状态及其年份
                    $r_m=date('m',strtotime($key['refund_time']));//退款时间
                    $report[$r_m]['refund_fees'] +=$key['refund_fees'];//退款金额
                    $report[$r_m]['refund_fees_count'] +=1;//退款订单单数
                    $year[$r_y]=$r_y;//退款年份
                    $count['count_refund_fees'] +=$key['refund_fees'];//总计退款金额
                    $count['refund_fees_count'] +=1;//总退单数
                }
                if($part == $y ){
                    $report[$m]['sales'] += $key['paid'];//销售金额
                    $report[$m]['results'] = $report[$m]['sales'] - $report[$m]['refund_fees'];//销售业绩
                    $report[$m]['sales_count'] +=1;//成单数
                    $count['sales_count'] +=1;//总成单数
                    $count['count_sales'] +=$key['paid'];//总计销售金额
                }
                $report[$m]['refund_fees'] +=0;//线形图退款金额
                $report[$m]['sales'] += 0;//销售金额
                $report[$m]['results'] +=0;
            }

        }
        foreach ($data as $value) {
            $y=date('Y',strtotime($value['crm_time']));//年份
            $m=date('m',strtotime($value['crm_time']));//财务确认收款时间

            if($part == $y){
                $report[$m]['unscommision'] += $value['scommision']; 
                $count['count_unscommision'] += $value['scommision'];
            }

        }
        unset($year[date('Y')]);//删除当前的年份，因为模板中默认是当前的年份，两个会冲突
        if($report){
            ksort($report);//给月份排序，从小到大
        }
        $this->assign('count',$count);
        $this->assign('year',$year);
        $this->assign('rows',$report);
        $this->display('layout/report_list.tpl');
	}
    public function singleAction() {
        
        $iget = ['manage_id', 'crm_time', 'crm_time_to'];
        foreach ($iget as $key) {
            $sch[$key] = SGet($key);
        }
        if (empty($sch['crm_time'])&&empty($sch['crm_time_to'])) {
            $month=date("Y-m");
            $sch['crm_time']=$month."-01";
        }
        $this->assign('sch', $sch);
        $selectA = new Select('@pf_order');
        $selectB = new Select('@pf_order');
        $selectC = new Select('@pf_order_modify');
        $selectC->join('@pf_order');
        
        $selectA->find('*,1 as report_type');
        $selectB->find('*,0 as report_type');
        $selectC->find('@pf_order_modify.*,@pf_order.orderid  ,  @pf_order.manage_id');

        //$selectA->where('and crm_state>=? ',[2]);
        $selectC->where('and @pf_order_modify.state = ? and  @pf_order_modify.order_id=@pf_order.id ',[1]);
       

        if (!empty($sch['manage_id'])) {
            $selectA->where('and manage_id=? ',[$sch['manage_id']]);
            $selectB->where('and refund=2 and manage_id=? ',[$sch['manage_id']]);
            $selectC->where('and @pf_order.manage_id=?  ',[$sch['manage_id']]);
        }
        if (!empty($sch['crm_time'])) {
            $selectA->where('and crm_time >=? ',[$sch['crm_time']]);
            $selectB->where('and refund=2 and refund_time >=? ',[$sch['crm_time']]);
            $selectC->where('and @pf_order_modify.check_time >=? ',[$sch['crm_time']]);
        }
        if (!empty($sch['crm_time_to'])) {
            $selectA->where('and crm_time <? ',[$sch['crm_time_to']." 24:00:00"]);
            $selectB->where('and refund=2 and refund_time <? ',[$sch['crm_time_to']." 24:00:00"]);
            $selectC->where('and @pf_order_modify.check_time <? ',[$sch['crm_time_to']." 24:00:00"]);
        }

        $selectA->union($selectB);

        $selectA->orderby('id asc');

        //每个人的业绩：order
        $count=$selectA->getCount();
        if (intval($count)!=0) {
            $list = $selectA->getPagelist(intval($count));
            $rows = $list->getlist();
        }else{
            $rows=[];
        }
        $report=[];
        $id_array=[];
        foreach ($rows as $key => $value) {
            if ($value['report_type']==1) {
                $report[$value['manage_id']]['paid']+=$value['paid'];
                $report[$value['manage_id']]['paid_num']++;
            }else{
                $report[$value['manage_id']]['refund_fees']+=$value['refund_fees'];
                $report[$value['manage_id']]['refund_num']++;
            }
            if (in_array($value['orderid'], $id_array)) {
                unset($rows[$key]);
            }else{
                $id_array[]=$value['orderid'];
            }
        }
        $this->assign('rows', $rows);
        //每个人的修正值
        $count_modify=$selectC->getCount();
        if (intval($count)!=0) {
            $list = $selectC->getPagelist(intval($count));
            $rows_modify = $list->getlist(); 
        }else{
            $rows_modify=[];
        }

        $report_modify=[];
        foreach ($rows_modify as $key => $value) {
            if ($value['type']==1) {
                $report_modify[$value['manage_id']]['paid']+=$value['fees'];
            }else{
                $report_modify[$value['manage_id']]['refund_fees']+=$value['fees'];
            }
        }
        $this->assign('rows_modify', $rows_modify);

        //每个人的业绩+修正值
        $single=[];
        $total=[];
        $pie=[];
        foreach ($report as $key => $value) {
            $single[$key]['paid']=$value['paid']+$report_modify[$key]['paid'];
            $single[$key]['refund_fees']=$value['refund_fees']+$report_modify[$key]['refund_fees'];
            $single[$key]['paid_num']=$value['paid_num']+$report_modify[$key]['paid_num'];
            $single[$key]['refund_num']=$value['refund_num']+$report_modify[$key]['refund_num'];
            //获取全部
            $total['paid']+=$value['paid']+$report_modify[$key]['paid'];
            $total['refund_fees']+=$value['refund_fees']+$report_modify[$key]['refund_fees'];
            $total['paid_num']+=$value['paid_num']+$report_modify[$key]['paid_num'];
            $total['refund_num']+=$value['refund_num']+$report_modify[$key]['refund_num'];
            //饼状图
            $single_pie=[];
            $single_pie[0]=DB::getval('@pf_manage','name',$key);
            $single_pie[1]+=$value['paid']+$report_modify[$key]['paid']-$value['refund_fees']-$report_modify[$key]['refund_fees'];
            array_push($pie, $single_pie);
        }
        foreach ($pie as $key => $single_pie) {
            $percent=sprintf("%.2f", $single_pie[1]/($total['paid']-$total['refund_fees'])*100); 
            $pie[$key][0]=$single_pie[0].'('.$percent.'%)';
        }

        $this->assign('single', $single);
        $this->assign('single_pie',json_encode($pie) );

        $this->assign('total', $total);

        $this->display('layout/report_single_list.tpl');       
    }
    /**
     * 导出订单详情列表
     * 
     */
    public function exportAction() {
        include 'libs/PHPExcel/Classes/PHPExcel.php';
        include 'libs/PHPExcel/Classes/PHPExcel/Writer/Excel2007.php';
        include 'libs/PHPExcel/Classes/PHPExcel/Writer/Excel5.php'; //用于输出.xls的
        
         $iget = ['manage_id', 'crm_time', 'crm_time_to'];  
         foreach ($iget as $key) {
            $sch[$key] = SGet($key);
        }
       
        //创建一个excel
        $objPHPExcel = new PHPExcel();
        $letter = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N');
        $header = array("负责人","订单号","客户","产品标题","订单已付金额","结算价格","状态","下单时间","支付方式","支付时间","财务确认时间","退款金额","退款时间","付款备注");
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
    //创建新表格
       
        $head = array("负责人","订单号","修正值","审核时间");
        $letters = array('A','B','C','D');
        $data = $this->reviseData($sch);
        if($data){
            $objPHPExcel->createSheet();
            for($i=0;$i<count($head);$i++){
                $objPHPExcel->setActiveSheetIndex(1)->setCellValue("$letters[$i]1",$head[$i]);
            }
            $objPHPExcel->getActiveSheet()->setTitle('修正值表'); //设置工作表名称
            for($a=2;$a<count($data)+2;$a++){
                $j=0;
                foreach ($data[$a-2] as $val){
                    $objPHPExcel->setActiveSheetIndex(1)->setCellValue("$letters[$j]$a",' '.$val);   
                   
                    $j++;
                }
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
    public function exportData($sch){
     
        if (empty($sch['crm_time'])&&empty($sch['crm_time_to'])) {
            $month=date("Y-m");
            $sch['crm_time']=$month."-01";
        }
       
        $selectA = new Select('@pf_order');
        $selectA->find('*,1 as report_type');
        //$selectA->where('and crm_state>=? ',[2]);
      
        $selectB = new Select('@pf_order');
        $selectB->find('*,0 as report_type');
        
       

        if (!empty($sch['manage_id'])) {
            $selectA->where('and manage_id=? ',[$sch['manage_id']]);
            $selectB->where('and refund=2 and manage_id=? ',[$sch['manage_id']]);
        }
        if (!empty($sch['crm_time'])) {
            $selectA->where('and crm_time >? ',[$sch['crm_time']]);
            $selectB->where('and refund=2 and refund_time >? ',[$sch['crm_time']]);
        }
        if (!empty($sch['crm_time_to'])) {
            $selectA->where('and crm_time <? ',[$sch['crm_time_to']." 24:00:00"]);
            $selectB->where('and refund=2 and refund_time <? ',[$sch['crm_time_to']]);
        }

        $selectA->union($selectB);
        $selectA->orderby('id asc');

        //每个人的业绩：order
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
            if (in_array($value['orderid'], $id_array)) {
                continue;
            }else{
                $id_array[]=$value['orderid'];
            }
            if(empty($value['manage_id'])){
                $report[$k]['manage_name'] = '';
            }else{
                 $name=DB::getone('select name from @pf_manage where id=?',[$value['manage_id']]);
                 $report[$k]['manage_name'] = $name['name'];
            }
            $report[$k]['orderid']=$value['orderid'];
            
            $username=DB::getone('select username from @pf_member where id=?',[$value['userid']]);
            $report[$k]['username'] = $username['username'];
            
            
            $report[$k]['title'] = $value['title'];
            $report[$k]['paid'] = $value['paid'];
            $report[$k]['scommision'] = $value['scommision'];
            if($value['refund']==1 && $value['state']<4){
                $report[$k]['state'] = '申请退款中';
            }else{
                switch ($value['state']) {
                    case 0:
                        $report[$k]['state'] = '未付款';
                        break;
                    case 1:
                        $report[$k]['state'] = '待填资料';
                        break;
                    case 2:
                        $report[$k]['state'] = '待付尾款';
                        break;
                    case 3:
                        $report[$k]['state'] = '已付款';
                        break;
                    case 4:
                        $report[$k]['state'] = '退款中';
                        break;
                    case 5:
                        $report[$k]['state'] = '已退款';
                        break;
                    case 6:
                        $report[$k]['state'] = '已取消';
                        break;
                    case 8:
                        $report[$k]['state'] = '已完成';
                        break;
                    case -1:
                        $report[$k]['state'] = '已作废';
                        break;
                    default:
                        $report[$k]['state'] = '';
                        break;
                }
            }
            
            $report[$k]['addtime'] = $value['addtime'];
            $report[$k]['paytype1'] = $value['paytype1'];
            $report[$k]['paytime1'] = $value['paytime1'];
            $report[$k]['crm_time'] = $value['crm_time'];
            $report[$k]['refund_fees'] = $value['refund_fees'];
            $report[$k]['refund_time'] = $value['refund_time'];
            $report[$k]['remark'] = '';
            if($value['payremark1']){
                 $report[$k]['remark'] = $report[$k]['remark'].'预付款备注:'.$value['payremark1'];
            }
            if($value['payremark2']){
                $report[$k]['remark'] = $report[$k]['remark'].'尾款备注:'.$value['payremark2'];
            }
            $k++;
        }

        return $report;

    }
    //修正数据
    public function reviseData($sch) {
        if (empty($sch['crm_time'])&&empty($sch['crm_time_to'])) {
            $month=date("Y-m");
            $sch['crm_time']=$month."-01";
            
        }
       
        $selectC = new Select('@pf_order_modify');
        $selectC->join('@pf_order');
        $selectC->find('@pf_order_modify.*,@pf_order.orderid  ,  @pf_order.manage_id');
        $selectC->where('and @pf_order_modify.state = ? and  @pf_order_modify.order_id=@pf_order.id ',[1]);
       
        if (!empty($sch['manage_id'])) {
            $selectC->where('and @pf_order.manage_id=?  ',[$sch['manage_id']]);
        }
        if (!empty($sch['crm_time'])) {
            $selectC->where('and @pf_order_modify.check_time >? ',[$sch['crm_time']]);
        }
        if (!empty($sch['crm_time_to'])) {
            $selectC->where('and @pf_order_modify.check_time <? ',[$sch['crm_time_to']]);
        }
        //每个人的修正值
        $count_modify=$selectC->getCount();
        if (intval($count_modify)!=0) {
            $list = $selectC->getPagelist(intval($count_modify));
            $rows_modify = $list->getlist(); 
        }else{
            $rows_modify=[];
        }
        $data = [];
        foreach ($rows_modify as $key => $value) {
            if(empty($value['manage_id'])){
                $data[$key]['manage_name'] = '';
            }else{
                $name=DB::getone('select name from @pf_manage where id=?',[$value['manage_id']]);
                $data[$key]['manage_name'] = $name['name'];
            }
            $data[$key]['orderid'] = $value['orderid'];
            $data[$key]['fee'] = $value['type']==1?'+':'-'.$value['fees'];  
            $data[$key]['time'] = $value['check_time'];
        }
        
        return $data;
    }
 
 
}