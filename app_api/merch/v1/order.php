<?php
/**
 * 商家订单处理
 */
require_once 'base.php';
$obj = new stdClass();
$obj->status = 500;

$do = isset($_POST['do']) ? trim($_POST['do']) : '';
$mid = isset($_POST['mid']) ? trim($_POST['mid']) : '';
$uid = isset($_POST['uid']) ? trim($_POST['uid']) : '';

if ($mid<=0 || $uid<=0){
    $obj->r='参数错误';
    CommonUtil::return_info($obj);
}
$all_row = check_and_get_merch($uid,$mid);
if (empty($all_row)){
    $obj->r = '商户不存在';
    CommonUtil::return_info($obj);
}

try{
    switch ($do){
        case 'all':
            order_list('all');
            break;
        case 'un_accept':
            order_list('un_accept');
            break;
        case 'accepted':
            order_list('accepted');
            break;
        case 'refund_list':
            order_list('refund');
            break;
        case 'print_list':
            print_list();
            break;
        case 'do_accept':
            order_update_status('do_accept');
            break;
        case 'do_delivery':
            order_update_status('do_delivery');
            break;
        case 'do_refund_succ':
            order_update_status('refund_succ');
            break;
        case 'do_refund_fail':
            order_update_status('refund_fail');
            break;
        default:
            $obj->r = '参数错误';
            CommonUtil::return_info($obj);
            break;
    }
}catch (Exception $e){
    $obj->r = '服务器错误请重试' . $e->getMessage();
//    $obj->r = '服务器错误请重试';
    CommonUtil::return_info($obj);
}

$obj->status = 200;
CommonUtil::return_info($obj);

/**
 * 订单列表筛选
 * all(所有) un_accept(待接单)
 */
function order_list($status) {
    global $obj,$mid,$uid;

    $select = new Select('@pf_order AS o');
    $select->leftJoinMore('@pf_school AS s','o.school_id=s.id');
    $select->find('o.id,o.add_time,o.pay_time,CONCAT(s.short_title,o.code) AS code,o.buyer_info AS buyer_name,o.buyer_phone,o.remark,o.status,o.arrive_date,o.arrive_time,o.refund_reasons,o.goods_amount,o.delivery_price');
    $select->where('AND o.merchant_id=?',[$mid]);

    switch ($status){
        case 'all':
            $select->orderby('o.pay_time','DESC');
            break;
        case 'un_accept':
            $select->where('AND status=1');
            $select->orderby('o.id','ASC');
            break;
        case 'accepted':
            $select->where('AND status=2');
            $select->orderby('o.id','ASC');
            break;
        case 'refund':
            $select->where('AND status=4');
            break;
        default:
            $obj->r='订单状态错误';
            CommonUtil::return_info($obj);
            break;
    }

    $list = $select->getPagelist(5);
    $rows = $list->getlist();

    foreach ($rows AS $k=>$row){
        $order_goods_rows = DB::getlist('SELECT * FROM @pf_order_goods WHERE order_id=?',[$row['id']]);
        $rows[$k]['status_desc'] = CommonUtil::goods_order_desc($row['status']);
        $rows[$k]['arrive_time'] = $row['arrive_date'] . ' '.[1=>'中午',2=>'下午'][$row['arrive_time']];
        $goods_ret = [];
        foreach ($order_goods_rows as $kk=>$goods_row) {
            $goods_ret[$kk]['title'] = $goods_row['title'];
            $goods_ret[$kk]['img'] = replace_image(2,$goods_row['img']);
            $goods_ret[$kk]['short_title'] = $goods_row['short_title'];
            $goods_ret[$kk]['spec_name'] = $goods_row['spec_name'];
            $goods_ret[$kk]['total'] = $goods_row['total'];
        }
        $rows[$k]['money'] = bcsub($row['goods_amount'],$row['delivery_price'],2);
        $rows[$k]['goods_list'] = $goods_ret;
    }

    $obj->data = [
        'list' => $rows
    ];
}

/**
 * @param $op 操作值
 * 商户订单操作
 * accept(接单)
 */
function order_update_status($op) {
    require_once ROOT_DIR . 'app_api/public/wxpay/lib/WxPay.Config.php';
    require_once ROOT_DIR . 'app_api/public/wxpay/wxpay.class.php';

    global $obj,$mid;

    $id = IPost('id');
    if ($id<=0){
        $obj->r = '参数错误';
        CommonUtil::return_info($obj);
    }

   $order_row = DB::getone('SELECT * FROM @pf_order WHERE id=?',[$id]);
    if (!$order_row || $order_row['merchant_id']!=$mid){
        $obj->r = '订单不存在';
        CommonUtil::return_info($obj);
    }
   $school_row = DB::getone('SELECT title,short_title,take_meal_addr FROM @pf_school WHERE id=?',[$order_row['school_id']]);
    $r = '操作成功';

    $order_update = [];
    $push_data = [];
    $template = '';
    switch ($op){
        case 'do_accept':
            if ($order_row['status']!=1) {
                $obj->r = '接单状态错误';
                CommonUtil::return_info($obj);
            }

            $push_data = [
                $school_row['short_title'] . $order_row['code'],
                '订购商品请进小程序查看',
                $order_row['arrive_date'] . [0=>'上午',1=>'中午',2=>'下午'][$order_row['arrive_time']],
                $school_row['title'] . $school_row['take_meal_addr'],
                $order_row['paid'],
                $order_row['order_id']
            ];
            $template = 'order_success';

            $order_update['status'] = 2;
            $deliver_type = $order_row['delivery_type'];
            if ($deliver_type==0){
                //发布到跑腿
                $order_create['user_id'] = $order_row['user_id'];
                $order_create['order_id'] = getOrderID(2);
                $order_create['order_type'] = 1;
                $order_create['cate_id'] = 0;
                $order_create['tag'] = '取外卖';
                $order_create['content'] = '帮我取外卖，我的取餐码:' . $order_row['code'];
                $order_create['start_address'] = $order_row['take_meal_addr'];
                $order_create['end_address'] = $order_row['address'];
                $noon_time = '12:20:00';
                $pm_time = '18:20:00';
                $arrive_time = $order_row['arrive_date'];
                if ($order_row['arrive_time']==1){
                    $arrive_time .= ' ' . $noon_time;
                }elseif($order_row['arrive_time']==2){
                    $arrive_time .= ' ' . $pm_time;
                }

//                $order_create['arrive_time'] = $order_row['arrive_date'];
                $order_create['arrive_time'] = $arrive_time;
                $order_create['tip_fee'] = $order_row['delivery_price'];
                $order_create['paid'] = $order_create['tip_fee'];
                $order_create['earn_money'] = $order_create['paid'] ;//接单人可挣钱数
                $order_create['need_pay'] = $order_create['paid'] ;
                $order_create['pay_type'] = 1;
                $order_create['is_pay'] = 1;
                $order_create['add_time'] = date('Y-m-d H:i:s') ;
                $order_create['add_date'] = date('Y-m-d') ;
                $order_create['pay_time'] = $order_row['pay_time'];
                $order_create['status'] = 1;
                $order_create['delivery_status'] = 0;
                $order_create['pid'] = $order_row['id'];
                DB::insert('@pf_earn_order',$order_create);
            }
            $r = '接单成功';
            break;
        case 'refund_succ':
            if ($order_row['status']!=4 && $order_row['refund']!=1) {
                $obj->r = '订单状态错误';
                CommonUtil::return_info($obj);
            }
            $order_update = [
                'status' => 5,
                'refund' => 2,
                'refund_time' => date('Y-m-d H:i:s')
            ];
            $push_data = [
                $order_row['title'],
                '退款商品请进小程序查看',
                $order_row['refund_fees'],
                '退款已经原路返回，具体到账时间可能会有1-3天延迟',
                date('Y-m-d H:i:s'),
                $order_row['order_id']
            ];

            $wxPay = new Wxpay();
            $result = $wxPay->wxRefund($order_row);
            if ($result['result_code'] == 'SUCCESS' && $result['return_code'] == 'SUCCESS') {
                $time = date('Y-m-d H:i:s');
                DB::update('@pf_order',['status'=>5, 'refund'=>2,'refund_fees'=>$order_row['paid'], 'refund_time'=>$time],$id);
                push('waimai_refund_success',$order_row['user_id'],$push_data);
                $obj->r = '退款申请成功,请等待到账！';
                $obj->status = 200;
                CommonUtil::return_info($obj);
            } else {
                $obj->r = '退款失败';
                CommonUtil::return_info($obj);
            }
            break;
        case 'refund_fail':
        $remark = SPost('remark');
            if ($order_row['status']!=4 && $order_row['refund']!=1) {
                $obj->r = '订单状态错误';
                CommonUtil::return_info($obj);
            }
            $order_update = [
                'status' => 5,
                'refund' => 3,
                'refund_remarks' => $remark,
                'refund_time' => date('Y-m-d H:i:s')
            ];

            $push_data = [
                $order_row['title'],
                $order_row['order_id'],
                '商品请进小程序查看',
                date('Y-m-d H:i:s'),
                $remark
            ];
            $template = 'waimai_refund_fail';
            break;
        case 'do_delivery':
            if ($order_row['status']!=2) {
                $obj->r = '订单状态错误';
                CommonUtil::return_info($obj);
            }

            $push_data = [
                $order_row['title'],
                $order_row['order_id'],
                $order_row['title'],
                $school_row['title'] . $school_row['take_meal_addr'],
                $order_row['name'] . "({$order_row['phone']})"
            ];
            $template = 'notify_take';

            $order_update['status'] = 3;
            $r = '发货通知成功';
            break;
        default :
            $obj->r = '操作参数错误';
            CommonUtil::return_info($obj);
            break;
    }

    DB::update('@pf_order',$order_update,$id);
    if (!empty($push_data) && !empty($template)) {
        push($template,$order_row['user_id'],$push_data);//推送
    }
    $obj->r = $r;
}

/**
 * 批量打印待发货订单接口
 */
function print_list() {
    global $obj,$mid;

    $arrive_date = isset($_POST['arrive_date']) ? trim($_POST['arrive_date']) : '';
    $arrive_time = IPost('arrive_time');

    if (!$arrive_date || !in_array($arrive_time,[1,2])) {
        $obj->r = '参数错误';
        CommonUtil::return_info($obj);
    }

   $order_rows = DB::getlist('SELECT og.title,og.short_title,og.spec_name,og.total,CONCAT(s.short_title,o.code) AS code,o.buyer_phone,s.title AS school FROM @pf_order_goods AS og JOIN @pf_order AS o ON og.order_id=o.id LEFT JOIN @pf_school AS s ON o.school_id=s.id WHERE o.merchant_id=? AND o.status=2 AND o.arrive_date=? AND o.arrive_time=? ORDER BY o.school_id',[$mid,$arrive_date,$arrive_time]);
    $ret = [];
    foreach ($order_rows as $row){
        $ret[$row['school']][] = $row;
        unset($order_rows);
    }
    $ret1 = [];
    foreach ($ret as $k=>$item){
        foreach ($item as $kk=>$ii){
            $ret1[$k][$ii['code']][] = $ii;
        }

    }
$ret2 = [];
    foreach ($ret1 as $k=>$school){
        foreach ($school as $kk=>$code){
            $my_count = array_sum(array_column($code,'total'));
            $n=1;
            foreach ($code as $kkk=>$goods){
                for($i=1;$i<=$goods['total'];$i++){
                    $goods['my_total'] = '第' . $n . '/' . $my_count . '件';
                    $ret2[$k][] = $goods;
                    $n++;
                }
            }
        }
    }
    $all_couunt = 0;
    foreach ($ret2 as $k=>$v){
        $count = count($v);
        $all_couunt += $count;
        $n = 1;
        foreach ($v as $kk=>$vv){
            $ret2[$k][$kk]['total']= '#' . $n . '/' .$count;
            $ret2[$k][$kk]['num']= $n;
            $ret2[$k][$kk]['buyer_phone']= '#' . $ret2[$k][$kk]['buyer_phone'];
            $n++;
        }
    }
$obj->data = ['list'=>$ret2,'count'=>$all_couunt];
}