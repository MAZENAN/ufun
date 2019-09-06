<?php
/**
 * 任务接收者操作相关
 */
require_once 'base.php';
$obj = new stdClass();
$obj->status = 500;

$do = isset($_POST['do']) ? trim($_POST['do']) : '';

$id = IPost('id');
$uid = IPost('uid');

if ($id<=0 || $uid<=0){
    $obj->r = '参数错误';
    CommonUtil::return_info($obj);
}

$hunter_row = DB::getone('SELECT type,mobile,status,real_name FROM @pf_member WHERE id=?',[$uid]);
if (!$hunter_row || $hunter_row['type']!=1){
    $obj->r = '用户不存在';
    CommonUtil::return_info($obj);
}
if ($hunter_row['status']!=2){
    $obj->r = '用户未认证';
    CommonUtil::return_info($obj);
}

try{
    switch ($do){
        case 'collect':
            order_collect();
            break;
        case 'arrive_success':
            update_delivery_status('arrive_success');
            break;
        case 'arrive_fail':
            update_delivery_status('arrive_fail');
            break;
        default :
            $obj->r = '参数错误';
            CommonUtil::return_info($obj);
            break;
    }
}catch (Exception $e){
    $obj->r = '服务器错误请重试';
    CommonUtil::return_info($obj);
}

$obj->status = 200;
CommonUtil::return_info($obj);

/**
 * 猎人抢单 TODO 检查任务等等
 */
function order_collect() {
    global $obj,$id,$uid,$hunter_row;

    $order_row = DB::getone('SELECT status,user_id FROM @pf_earn_order WHERE id=?',[$id]);
    if (!$order_row || $order_row['status']!=1){
        $obj->r = '任务不存在或已被抢单';
        CommonUtil::return_info($obj);
    }

    if ($uid == $order_row['user_id']){
        $obj->r = '您不能领取本人发布的任务';
        CommonUtil::return_info($obj);
    }

    $order_update = [
        'status' => 2,
        'deliveryer_id' => $uid,
        'deliveryer_get_time' => date('Y-m-d H:i:s'),
        'delivery_status' => 1
    ];

    DB::update('@pf_earn_order',$order_update,$id);
    $push_data = [
        $hunter_row['real_name'],
        $hunter_row['mobile'],
        date('Y-m-d H:i:s')
    ];
    push('earn_accept',$order_row['user_id'],$push_data);
    $obj->r = '抢单成功';
}

/**
 * 接单者更新配送状态(送达成功，送达失败)
 */
function update_delivery_status($op) {
    global $obj,$id,$uid,$hunter_row;

    $order_row = DB::getone('SELECT order_id,user_id,status,delivery_status,deliveryer_id FROM @pf_earn_order WHERE id=?',[$id]);
    if (!$order_row || $order_row['deliveryer_id']!=$uid){
        $obj->r = '该任务不存在';
        CommonUtil::return_info($obj);
    }

    $order_update = [];
    $push_data = [];
    $template = '';
    switch ($op){
        case 'arrive_success':
            if (($order_row['delivery_status']!=1)&&($order_row['status']!=2)){
                $obj->r = '不可更改为送达状态';
                CommonUtil::return_info($obj);
            }
            $order_update = [
                'status' => 3,
                'delivery_status' => 2
            ];
            $push_data = [
                $hunter_row['real_name'],
                $hunter_row['mobile'],
                $order_row['order_id']
            ];
            $template = 'earn_arrived';
            break;
        case 'arrive_fail':
            break;
        default :
            $obj->r = '确认状态错误';
            CommonUtil::return_info($obj);
            break;
    }

    DB::update('@pf_earn_order',$order_update,$id);
    if (!empty($template) && !empty($push_data)){
        push($template,$order_row['user_id'],$push_data);
    }
    $obj->r = '操作成功';
}