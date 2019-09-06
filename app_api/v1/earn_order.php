<?php
/**
 * 赏金任务订单管理
 */
require_once 'base.php';
$obj = new stdClass();
$obj->status = 500;

$do = isset($_POST['do']) ? trim($_POST['do']) : '';
$uid = IPost('uid');
//TODO 用户检查

if ($uid<=0){
    $obj->r = '参数错误';
    CommonUtil::return_info($obj);
}

try{
    switch ($do){
        case 'create':
            order_create();
            break;
        case 'publish_detail':
            order_detail('publish');
            break;
        case 'collect_detail':
            order_detail('collect');
            break;
        case 'all':
            order_list('all');
            break;
        case 'unpaid':
            order_list('unpaid');
            break;
        case 'un_accepted':
            order_list('un_accepted');
            break;
        case 'accepted':
            order_list('accepted');
            break;
        case 'refund':
            order_list('refund');
            break;
        case 'un_confirm':
            order_list('un_confirm');
            break;
        case 'confirm_receive':
            order_update_status('confirm_receive');
            break;
        case 'do_refund':
            order_update_status('refund');
            break;
        case 'refund_pro':
            order_refund_pro();
            break;
        case 'accept_all':
            order_accept('all');
            break;
        case 'accept_un_complete':
            order_accept('un_complete');
            break;
        case 'accept_complete':
            order_accept('complete');
            break;
        case 'cancle':
            order_update_status('cancle');
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
 * 创建赏金任务订单（发布任务）
 */
function order_create() {
    global $obj,$uid;

    $cate_id = IPost('cid');
    $school_id = IPost('sid');

    $cate_row = DB::getone('SELECT title,type,allow,start_fee FROM @pf_earn_cate WHERE id=?',[$cate_id]);

    if (!$cate_row || $cate_row['allow']!=1) {
        $obj->r = '不存在的任务类型';
        CommonUtil::return_info($obj);
    }

    $order_type = $cate_row['type'];

//    $tag = trim($_POST['tag']);
    $tag = trim($cate_row['title']);
    $tip_fee = trim($_POST['tip_fee']);
    $content = trim($_POST['content']);
    $arrive_time = isset($_POST['arrive_time']) ? trim($_POST['arrive_time']) : '';
    $duration = isset($_POST['duration']) ? trim($_POST['duration']) : '';//过期时间,单位秒

    if (!$tag || !is_numeric($tip_fee) || ($tip_fee=sprintf('%0.2f',$tip_fee))<=0|| !$content || !$arrive_time || !$duration) {
        $obj->r = '参数错误';
        CommonUtil::return_info($obj);
    }

    $order_create = [];

    $start_address_id = IPost('start_addr_id');
    if ($start_address_id<=0 || $school_id<0){
        $obj->r = '参数错误';
        CommonUtil::return_info($obj);
    }
    $start_address_row = DB::getone('SELECT user_id,address FROM @pf_earn_user_address WHERE id=?',[$start_address_id]);
    if (!$start_address_row || $uid!=$start_address_row['user_id']){
        $obj->r = '开始地址不存在';
        CommonUtil::return_info($obj);
    }

    $order_create['start_address'] = $start_address_row['address'];
    $order_create['arrive_time'] = $arrive_time;
    $order_create['expire_time'] = strtotime($arrive_time);
    $order_create['valid_duration'] = $duration;
    $order_create['school_id'] = $school_id;

    switch ($order_type){
        case 1:
            $end_address_id = IPost('end_addr_id');
            if ($end_address_id<=0){
                $obj->r = '参数错误';
                CommonUtil::return_info($obj);
            }

           $end_address_row = DB::getone('SELECT user_id,address FROM @pf_earn_user_address WHERE id=?',[$end_address_id]);

           if (!$end_address_row || $uid!=$end_address_row['user_id']){
               $obj->r = '地址不存在';
               CommonUtil::return_info($obj);
           }

           $order_create['end_address'] = $end_address_row['address'];
            break;
        case 2:
            $attachment = isset($_POST['attach']) ? trim($_POST['attach']) : '';
            if (!$attachment){
                $obj->r = '请上传附件';
                CommonUtil::return_info($obj);
            }
            $order_create['attachment'] = $attachment;
            break;
        case 3:
            break;
    }


    $oid = getOrderID(2);//订单流水id
//    $need_pay = bcadd($cate_row['start_fee'],$tip_fee,2);
    $need_pay = $tip_fee;//现在费用是用户输入的费用

    $order_create['order_id'] = $oid ;
    $order_create['order_type'] = $order_type['type'] ;
    $order_create['cate_id'] = $cate_id ;
    $order_create['user_id'] = $uid ;
    $order_create['content'] = $content ;
    $order_create['status'] = 0;
    $order_create['tip_fee'] = $tip_fee;
    $order_create['is_pay'] = 0;
    $order_create['paid'] = 0.00;
    $order_create['tag'] = $tag;
    $order_create['need_pay'] = $need_pay ;
    $order_create['earn_money'] = $tip_fee ;//接单人可挣钱数
    $order_create['add_time'] = date('Y-m-d H:i:s') ;
    $order_create['add_date'] = date('Y-m-d') ;

    DB::insert('@pf_earn_order',$order_create);

    $order_id = DB::lastId();
    $obj->data = ['id'=>$order_id ,'orderid'=>$oid,'add_time'=>date('Y-m-d H:i:s')];
}

/**
 * 我发布的任务订单列表筛选
 */
function order_list($status) {
    global $obj,$uid;

    $select = new Select('@pf_earn_order AS o');
    $select->leftJoinMore('@pf_member AS m','o.deliveryer_id = m.id');
    $select->find('o.id,o.content,o.tip_fee as money,o.tag,o.start_address,o.end_address,o.status,o.order_type,o.add_time,m.real_name,m.mobile');
    $select->where('AND o.user_id=?',[$uid]);
    switch ($status){
        //所有订单列表
        case 'all':
            break;
        //未支付
        case 'unpaid':
            $select->where('AND o.status=0');
            break;
        //待接单
        case 'un_accepted':
            $select->where('AND o.status=1');
            break;
        //已被接单(配送中)
        case 'accepted':
            $select->where('AND o.status=2');
            break;
        //待确认收货(配送员已送达)
        case 'un_confirm':
            $select->where('AND o.status=3 AND o.delivery_status=2');
            break;
        //退款订单
        case 'refund':
            $select->where('AND status in(4,5)');
            $select->where('AND o.refund>0');
            break;
        default :
            $obj->r = '获取订单失败';
            CommonUtil::return_info($obj);
            break;
    }

    $select->orderby('o.id DESC');
    $list = $select->getPagelist();
    $rows = $list->getlist();

    foreach ($rows as $k=>$row){
        $rows[$k]['status_desc'] = CommonUtil::earn_order_desc($row['status']);
//        $rows[$k]['add_time'] = CommonUtil::get_last_time(strtotime($row['add_time']))  ;
        $rows[$k]['mobile'] = empty($row['mobile']) ? '' : $row['mobile'];
        $rows[$k]['real_name'] = empty($row['real_name']) ? '' : $row['real_name'];
    }
    $obj->data = [
        'list' => $rows
    ];
}

/**
 * 订单详情：我发布的任务详情和我收到的任务详情
 */
function order_detail($from) {
    global $obj,$uid;

    $id = IPost('id');
    $order_row =  DB::getone('SELECT * FROM @pf_earn_order WHERE id=?',[$id]);
    $ret = [];
    $ret['base_info'] = [];
    switch ($from){
        case 'publish':
            if (!$order_row || $order_row['user_id']!=$uid){
                $obj->r = '任务订单不存在';
                CommonUtil::return_info($obj);
            }

            $ret['base_info']['order_id'] = $order_row['order_id'];
            $ret['base_info']['add_time'] = $order_row['add_time'];
            $ret['base_info']['money'] = $order_row['need_pay'];

            $ret['base_info']['is_pay'] = $order_row['is_pay'];
            if ($ret['base_info']['is_pay']==1){
                $ret['pay_info']['pay_type'] = $order_row['pay_type'];
                $ret['pay_info']['pay_type_desc'] = CommonUtil::paytype_desc($order_row['pay_type']);
                if ($order_row['pay_type']==1){
                    $ret['pay_info']['trans_id'] = $order_row['trans_id'];
                }
                $ret['pay_info']['pay_time'] = $order_row['pay_time'];
            }

            if ($order_row['deliveryer_id']>0){
                $user_row = DB::getone('SELECT img_head,real_name,mobile FROM @pf_member WHERE id=?',[$order_row['deliveryer_id']]);
                $ret['user_info']['mobile'] = $user_row['mobile'];
                $ret['user_info']['name'] = $user_row['real_name'];
                $ret['user_info']['img_head'] = replace_image(1,$user_row['img_head']);
            }
            if ($order_row['refund']>0){
                $ret['refund_info']['refund_status'] = $order_row['refund'];
                $ret['refund_info']['refund_desc'] = CommonUtil::refund_desc($order_row['refund']);
            }
            break;
        case 'collect':
            if (!$order_row || $order_row['deliveryer_id']!=$uid){
                $obj->r = '任务不存在';
                CommonUtil::return_info($obj);
            }

            $ret['base_info']['money'] = $order_row['earn_money'];
            $user_row = DB::getone('SELECT nickname,real_name,mobile,img_head FROM @pf_member WHERE id=?',[$order_row['user_id']]);
            $ret['user_info']['mobile'] = $user_row['mobile'];
            $ret['user_info']['name'] = $user_row['real_name'] ? $user_row['real_name'] : $user_row['nickname'];
            $ret['user_info']['img_head'] = replace_image(1,$user_row['img_head']);
            break;
        default:
            $obj->r = '获取订单失败';
            CommonUtil::return_info($obj);
            break;
    }

    $ret['base_info']['id'] = $order_row['id'];
    $ret['base_info']['order_type'] = $order_row['order_type'];

    $ret['base_info']['tag'] = $order_row['tag'];
    $ret['base_info']['content'] = $order_row['content'];
    $ret['base_info']['arrive_time'] = $order_row['arrive_time'];
    $ret['base_info']['start_address'] = $order_row['start_address'];
    $ret['base_info']['end_address'] = $order_row['end_address'];
    if ($ret['base_info']['order_type']==3 && $order_row['attachment']){
        $ret['base_info']['attach'] = replace_image(0,$order_row['attachment']);
    }

    if ($from=='publish'){
        $ret['base_info']['status'] = $order_row['status'];
        $ret['base_info']['status_desc'] = CommonUtil::earn_order_desc($order_row['status']);
    }elseif ($from=='collect'){
        $status =0;
        $desc = '';
        if ($order_row['delivery_status']==1 && $order_row['status']==2){
            $status =0;
            $desc = '配送中,待确认送达';
        }elseif ($order_row['delivery_status']==2 && $order_row['status']==3){
            $status =1;
            $desc = '已送达，用户未确认';
        }elseif ($order_row['delivery_status']==2 && $order_row['status']==7){
            $status =2;
            $desc = '已送达，用户已确认';
        }
        $ret['base_info']['status'] = $status;
        $ret['base_info']['status_desc'] = $desc;
    }

    $obj->data = $ret;
}

/**
 * 我领取的任务列表 筛选
 */
function order_accept($status) {
    global $obj,$uid;

    $select = new Select('@pf_earn_order AS o');
    $select->leftJoinMore('@pf_member AS m','o.user_id = m.id');
    $select->find('o.id,o.content,o.start_address,o.end_address,o.tag,o.status,o.delivery_status,o.order_type,o.earn_money AS money,o.arrive_time,m.real_name,m.mobile');
    $select->where('AND o.deliveryer_id=?',[$uid]);
    switch ($status){
        //所有
        case 'all':
            break;
        //配送中,未完成（包含确认送达，但用户未确认）
        case 'sending':
            $select->where('AND o.delivery_status=1');
            $select->where('AND o.status=2');
            break;
        //已完成（确认送达，并且用户已确认）
        case 'complete':
            $select->where('AND o.delivery_status=2');
            $select->where('AND o.status=7');
            break;
        case 'un_complete':
            $select->where(' AND status =2 AND o.delivery_status in (1,2)');
            break;
        default:
            break;
    }

    $select->orderby('o.id DESC');

    $list = $select->getPagelist();
    $rows = $list->getlist();
    foreach ($rows as $k=>$row){
        $status = 0;
        $desc = '';
        if ($row['delivery_status']==1 && $row['status']==2){
            $status =0;
            $desc = '配送中,待确认送达';
        }elseif ($row['delivery_status']==2 && $row['status']==3){
            $status =1;
            $desc = '已送达，用户未确认';
        }elseif ($row['delivery_status']==2 && $row['status']==7){
            $status =2;
            $desc = '已送达，用户已确认';
        }
        $row[$k]['status'] = $status;
        $rows[$k]['status_desc'] = $desc;
        $rows[$k]['mobile'] = empty($row['mobile']) ? '' : $row['mobile'];
        $rows[$k]['real_name'] = empty($row['real_name']) ? '' : $row['real_name'];
    }
    $obj->data = [
        'list' => $rows
    ];
}

/**
 * 更新发布任务(订单)状态
 */
function order_update_status($op) {
    global $obj,$uid;

    $id = IPost('id');
    if ($id<=0) {
        $obj->r = '参数错误';
        CommonUtil::return_info($obj);
    }

//    $order_row = DB::getone('SELECT user_id,order_id,status,earn_money,deliveryer_id,delivery_status,paid,tag FROM @pf_earn_order WHERE id=?',[$id]);
    $order_row = DB::getone('SELECT * FROM @pf_earn_order WHERE id=?',[$id]);

    switch ($op){
        //发布人,取消订单
        case 'cancle':
            if (!$order_row || $order_row['user_id']!= $uid || $order_row['status']!=0){
                $obj->r = '可取消任务订单不存在';
                CommonUtil::return_info($obj);
            }
            DB::update('@pf_earn_order',['status'=>-1,'cancel_time'=>date('Y-m-d H:i:s')],$id);
            $obj->r = '取消成功';
            break;
        //发布人,确认收货
        case 'confirm_receive':
            if (!$order_row || $order_row['user_id']!= $uid || ($order_row['status']!=3 && $order_row['delivery_status']!=2)){
                $obj->r = '可确认收货任务订单不存在';
                CommonUtil::return_info($obj);
            }
//            DB::update('@pf_earn_order',['status'=>6,'cancel_time'=>date('Y-m-d H:i:s')],$id);
            DB::update('@pf_earn_order',['status'=>7,'receive_time'=>date('Y-m-d H:i:s')],$id);
            $money = $order_row['earn_money'];
            DB::update('@pf_member',['earn_total'=>DB::sql('ifnull(earn_total,0)+'.$money),'earn_money'=>DB::sql('ifnull(earn_money,0)+'.$money)],$order_row['deliveryer_id']);
            $obj->r = '确认收货成功';
            break;
        case 'refund':
            require_once ROOT_DIR . 'app_api/public/wxpay/lib/WxPay.Config.php';
            require_once ROOT_DIR . 'app_api/public/wxpay/wxpay.class.php';

            if (!$order_row  || !in_array($order_row['status'],[1]) || $order_row['user_id']!=$uid){
                $obj->r = '不存在可退款订单';
                CommonUtil::return_info($obj);
            }
            $reasons = SPost('reasons');
//            $order_update = [
//                'status' => 4,
//                'refund'=>1,
//                'refund_fees' => $order_row['paid'],
//                'refund_reasons'=>$reasons,
//            ];
            $order_update = [
                'status' => 5,
                'refund'=>2,
                'refund_fees' => $order_row['paid'],
                'refund_reasons'=>$reasons,
                'refund_time'=> date('Y-m-d H:i:s')
            ];
            $push_data = [
                $order_row['tag'],
                $order_row['paid'] . '￥',
                date('Y-m-d H:i:s'),
                $order_row['order_id'],
                '退款已经原路返回，具体到账时间可能会有1-3天延迟'
            ];

            $wxPay = new Wxpay();
            $result = $wxPay->wxRefund($order_row);

            if ($result['result_code'] == 'SUCCESS' && $result['return_code'] == 'SUCCESS') {
                DB::update('@pf_earn_order',$order_update,$id);
                push('earn_refund',$uid,$push_data);
                $obj->r = '退款申请成功,请等待到账！';
                $obj->status = 200;
                CommonUtil::return_info($obj);
            } else {
                $obj->r = '退款失败';
                CommonUtil::return_info($obj);
            }
            break;
        default :
            $obj->r = '状态参数错误';
            CommonUtil::return_info($obj);
            break;
    }
}

/**
 * 查看退款进度
 */
function order_refund_pro() {
    global $obj,$uid;

    $id = IPost('id');
    if ($id<=0){
        $obj->r = '参数错误';
        CommonUtil::return_info($obj);
    }
    $order_row = DB::getone('SELECT * FROM @pf_earn_order WHERE id=?',[$id]);
    if (!$order_row || $order_row['user_id']!=$uid || !in_array($order_row['status'],[4,5])){
        $obj->r = '不存在该退款订单';
        CommonUtil::return_info($obj);
    }

    $ret = [
        'id' => $order_row['id'],
        'order_id' => $order_row['order_id'],
        'order_type' => $order_row['order_type'],
        'tag' => $order_row['tag'],
        'content' => $order_row['content'],
        'start_address' => $order_row['start_address'],
        'end_address' => $order_row['end_address'],
        'paid' => $order_row['paid'],
        'pay_type' => $order_row['pay_type'],
        'pay_desc' => CommonUtil::paytype_desc($order_row['pay_type']),
        'refund_fees' => $order_row['refund_fees'],
        'status' => $order_row['status'],
        'status_desc' => CommonUtil::refund_desc($order_row['refund']),
        'reasons' => $order_row['refund_reasons']
    ];

    $obj->data = $ret;
}

