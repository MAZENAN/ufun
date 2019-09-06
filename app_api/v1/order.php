<?php
/**
 * 订单相关
 * //TODO 用户删除订单以及筛选
 * 订单状态:-1取消0待付款1已付款(待发货)2卖家已接单(制作中)3卖家已发货(配送中)4退款中5已退款6待评价7已完成
 */
require_once 'base.php';
$obj = new stdClass();
$obj->status = 500;

$do = isset($_POST['do']) ? trim($_POST['do']) : '';
$uid = IPost('uid');
if ($uid<=0){
    $obj->r = '参数错误';
    CommonUtil::return_info($obj);
}
//TODO
//    if (!check_user_exist($uid)){
//    $obj->r = '用户不存在';
//    CommonUtil::return_info($obj);
//}

try{
    switch ($do){
        case 'create':
            create_order();
            break;
        case 'detail':
            order_detail();
            break;
        case 'cancle':
            order_cancle();
            break;
        case 'do_refund':
            order_refund();
            break;
        case 'refund_pro':
            order_refund_pro();
            break;
        case 'refund_all':
            order_list('refund');
            break;
        case 'all':
            order_list('all');
            break;
        case 'paid':
            order_list('paid');
            break;
        case 'comment':
            order_list('un_comment');
            break;
        case 'undone':
            order_list('undone');
            break;
        default :
            $obj->r = '参数错误';
            CommonUtil::return_info($obj);
            break;
    }
}catch(Exception $e){
    $obj->r = '接口错误请重试';
//    $obj->r = '接口错误请重试' . $e->getMessage();
    CommonUtil::return_info($obj);
}

$obj->status = 200;
CommonUtil::return_info($obj);

/**
 * 根据购物车创建订单 TODO 事务
 */
function create_order() {
    global $obj,$uid;

    $mid = IPost('mid');
//    $sid = IPost('sid'); //从我的地址中选择的学校id
    $remark = SPost('remark');//备注
    $pay_type = IPost('pay_type');//支付方式
    #配送信息
    $addr_id = IPost('addr_id');//地址id
    $delivery_type = IPost('delivery_type');//配送类型0配送到寝1校内自提
    $arrive_date = isset($_POST['arrive_date']) ? trim($_POST['arrive_date']) : null ;//送达时间
    $arrive_desc = isset($_POST['arrive_desc']) ? trim($_POST['arrive_desc']) : null;//送达时间描述
    $arrive_time = IPost('arrive_time');//送达时间中午或下午

    if ($mid<=0||!in_array($delivery_type,[0,1])||$addr_id<=0||!in_array($pay_type,[0,1])||is_null($arrive_date)||is_null($arrive_time)||is_null($arrive_desc)){
        $obj->r = '参数错误';
        CommonUtil::return_info($obj);
    }

   $merchant_row =  DB::getone('SELECT allow,name,status,deliver_price FROM @pf_merchant WHERE id=?',[$mid]);
    if (!$merchant_row || $merchant_row['status']!=1){
        $obj->r = '店铺不存在';
        CommonUtil::return_info($obj);
    }

    if ($merchant_row['allow']!=1){
        $obj->r = '店铺暂停营业';
        CommonUtil::return_info($obj);
    }

    $addr_row = DB::getone('SELECT user_id,gender,username,mobile,school_id,address FROM @pf_user_address WHERE id=?',[$addr_id]);
    if (!$addr_row || $addr_row['user_id']!=$uid){
        $obj->r = '配送信息错误';
        CommonUtil::return_info($obj);
    }
    $sid = $addr_row['school_id'];
    $buyer_name = $addr_row['username'];
    $buyer_gender = $addr_row['gender'];
    if ($buyer_gender==0){
        $buyer_name .= '(先生)';
    }elseif ($buyer_gender==1){
        $buyer_name .= '(女士)';
    }

    $buyer_phone = $addr_row['mobile'];


    $school_row =  DB::getone('SELECT title,take_meal_addr FROM @pf_school WHERE id=?',[$sid]);
    if (!$school_row){
        $obj->r = '配送学校参数错误';
        CommonUtil::return_info($obj);
    }

    $address = '';
    $deliver_price = 0;
    if ($delivery_type==0){
        $address = $school_row['title'] . '  ' . $addr_row['address'];
        $deliver_price += $merchant_row['deliver_price'];
    }elseif ($delivery_type==1){
        $address = $school_row['title'] ;
    }
    $take_meal_addr = $school_row['title'] . $school_row['take_meal_addr'];


//查询购物车信息
    $cart_rows = DB::getlist('SELECT goods_id,merchant_id,total,spec_ids FROM @pf_member_cart WHERE user_id=? AND merchant_id=? AND deleted=0 AND is_choose=1',[$uid,$mid]);

    if (!$cart_rows){
        $obj->r = '创建订单失败！';
        CommonUtil::return_info($obj);
    }

        //TODO 商品总价验证是否满起送价

        $cartArr = [];
        $goods_price = 0.0;//商品总价格
        $goods_total = 0;
        foreach ($cart_rows as $k=>$v){
            $total = $v['total'];

            $goods =  DB::getone('SELECT id,title,short_title,market_price,allow,is_option,img FROM @pf_goods WHERE id=?',[$v['goods_id']]);
            if ($goods['allow']==0){
                continue;
            }
            if ($goods['is_option']){
                $specArr = json_decode($v['spec_ids']);
                if (json_last_error()!=JSON_ERROR_NONE || !$specArr){
                    continue;
                }

                $spec_titles = '';
                $spec_price = 0.0;
                foreach ($specArr as $specID){
                    $spec_row =  DB::getone('SELECT title,price FROM @pf_goods_spec WHERE id=?',[$specID]);
                    $spec_titles .= $spec_row['title'] .'/';
                    $spec_price += $spec_row['price'];
                }
                $cartArr[$k]['price'] = $spec_price;
                $cartArr[$k]['is_option'] = 1;
                $temp_price = $spec_price * $total;
                $goods_price += $temp_price;
                $cartArr[$k]['spec_title'] = $spec_titles;
            }else{
                $cartArr[$k]['price'] =$goods['market_price'];
                $cartArr[$k]['is_option'] = 0;
                $temp_price = $goods['market_price'] * $total;
                $goods_price += $temp_price;
            }

            $cartArr[$k]['id'] = $goods['id'];
            $cartArr[$k]['title'] = $goods['title'];
            $cartArr[$k]['short_title'] = $goods['short_title'];
            $cartArr[$k]['total'] = $total;
            $cartArr[$k]['img'] = $goods['img'];

            $goods_total += $total;
        }

    $orderId = getOrderID();
    $order_code = CommonUtil::random(4,true);
    $order_insert = [
        'user_id' => $uid,
        'remark' => $remark,
        'order_id' => $orderId,
        'code' => $order_code,
        'merchant_id' => $mid,
        'title' => $merchant_row['name'],
        'status' => 0,
        'pay_type' => $pay_type,
        'buyer_info' => $buyer_name,
        'buyer_phone' => $buyer_phone,
        'address' => $address,
        'take_meal_addr' => $take_meal_addr,
        'school_id' => $sid,
        'add_time' => date('Y-m-d H:i:s'),
        'add_date' => date('Y-m-d'),
        'arrive_date' => $arrive_date,
        'arrive_time' => $arrive_time,
        'arrive_desc' => $arrive_desc,
        'delivery_type' => $delivery_type,
        'delivery_price' => $deliver_price,
        'total' => $goods_total,
        'goods_amount' => $goods_price+$deliver_price
    ];
    //插入订单
    DB::insert('@pf_order',$order_insert);

    $order_id = DB::lastId();

    if ($order_id){
        //插入订单商品表
        foreach ($cartArr as $v){
            $spec_name = $v['is_option']==1 ? $v['spec_title'] : '';

            $goods_order_insert = [
                'order_id' => $order_id,
                'goods_id' => $v['id'],
                'title' => $v['title'],
                'short_title' => $v['short_title'],
                'img' => $v['img'],
                'is_option' => $v['is_option'],
                'spec_name' => $spec_name,
                'market_price' => $v['price'],
                'total' => $v['total'],
                'add_time' => date('Y-m-d H:i:s')
            ];
            DB::insert('@pf_order_goods',$goods_order_insert);
        }
        DB::update('@pf_member_cart',['deleted'=>1],'user_id=? AND deleted=0 AND merchant_id=?',[$uid,$mid]);
        $obj->data = ['id'=>$order_id ,'orderid'=>$orderId,'add_time'=>date('Y-m-d H:i:s')];
    }else{
        $obj->r = '生成订单失败';
        CommonUtil::return_info($obj);
    }
}


/**
 * 用户订单列表筛选
 * @param $status
 * @throws Exception
 */
function order_list($status) {
    global $obj,$uid;
    $img_path = C('QiniuRoot');

    $select = new Select('@pf_order AS o');
    $select->leftJoinMore('@pf_merchant AS m','o.merchant_id=m.id');
    $select->leftJoinMore('@pf_school AS s','o.school_id=s.id');
    $select->find("o.id,o.goods_amount,o.paid,o.status,o.total,CONCAT('{$img_path}',m.logo) AS logo,m.name,CONCAT(s.short_title,o.code) AS code");
    $select->where('AND o.user_id=?',[$uid]);
    switch ($status) {
        case 'all':
            break;
        case 'undone':
            $select->where('AND o.status =0');
            break;
        case 'refund':
            $select->where('AND o.status in(4,5)');
            break;
        case 'paid':
            $select->where('AND o.status in(1,2,3,7)');
            break;
        case 'un_comment':
            $select->where('AND o.status=6');
            break;
    }
    $select->orderby('o.id DESC');
    $list = $select->getPagelist(10);
    $order_rows = $list->getlist();

    foreach ($order_rows as $k=>$row){
        $goods_rows = DB::getlist("SELECT title,total,market_price price,CONCAT('{$img_path}',img) AS img FROM @pf_order_goods WHERE order_id=?",[$row['id']]);
        $order_rows[$k]['list'] = $goods_rows;
    }
    $obj->data = $order_rows;
}


/**
 * 用户取消订单
 */
function order_cancle() {
    global $uid,$obj;

    $order_id = IPost('id');
    if ($order_id<=0){
        $obj->r = '参数错误';
        CommonUtil::return_info($obj);
    }

    $order_row = DB::getone('SELECT user_id,status FROM @pf_order WHERE id=?',[$order_id]);
    if (!$order_row  || $order_row['status']!=0 || $order_row['user_id']!=$uid){
        $obj->r = '不存在可取消订单';
        CommonUtil::return_info($obj);
    }

    $order_update = [
        'status' => -1,
        'cancel_time' => date('Y-m-d H:i:s')
    ];
    DB::update('@pf_order',$order_update,$order_id);
}

/**
 * 用户退款
 */
function order_refund() {
    global $uid,$obj;

    $order_id = IPost('id');
    $reasons = SPost('reasons');
    if ($order_id<=0 || empty($reasons)){
        $obj->r = '参数错误';
        CommonUtil::return_info($obj);
    }

    $order_row = DB::getone('SELECT user_id,status,paid FROM @pf_order WHERE id=?',[$order_id]);
    if (!$order_row  || !in_array($order_row['status'],[1,2,3]) || $order_row['user_id']!=$uid){
        $obj->r = '不存在可退款订单';
        CommonUtil::return_info($obj);
    }

    $order_update = [
        'status' => 4,
        'refund'=>1,
        'refund_fees' => $order_row['paid'],
        'refund_reasons'=>$reasons
    ];
    DB::update('@pf_order',$order_update,$order_id);
}

/**
 * 订单详情
 */
function order_detail() {
    global $obj,$uid;

    $order_id = IPost('id');
    if ($order_id<=0){
        $obj->r = '参数错误';
        CommonUtil::return_info($obj);
    }

    $order_row = DB::getone('SELECT id,user_id,status,code,order_id,add_time,delivery_type,address,buyer_info,buyer_phone,pay_type,merchant_id,goods_amount,paid,school_id FROM @pf_order WHERE id=?',[$order_id]);

    if (!$order_row  || $order_row['user_id']!=$uid){
        $obj->r = '订单不存在';
        CommonUtil::return_info($obj);
    }
    $school_row = DB::getone('SELECT short_title FROM @pf_school WHERE id=?',[$order_row['school_id']]);
    $merchant_row = DB::getone('SELECT name,logo,phone FROM @pf_merchant WHERE id=?',[$order_row['merchant_id']]);
    $merchant_row['logo'] = replace_image(1,$merchant_row['logo']);
    $goods_rows = DB::getlist('SELECT title,img,total,market_price FROM @pf_order_goods WHERE order_id=?',[$order_row['id']]);

    $delivery_type = ['配送到寝','校内自取'][$order_row['delivery_type']];
    $pay_type = ['余额支付','微信支付'][$order_row['pay_type']];

    $goods = [];
    foreach ($goods_rows as $k=>$row){
        $goods[$k]['title'] = $row['title'];
        $goods[$k]['img'] = replace_image(1,$row['img']);
        $goods[$k]['total'] = $row['total'];
        $goods[$k]['price'] = $row['total']*$row['market_price'];
    }
    $order_detail = [
        'status' => $order_row['status'],
        'goods_amount' => $order_row['goods_amount'],
        'paid' => $order_row['paid'],
        'delivery' => [
            'type' => $delivery_type,
            'addr' => $order_row['address'],
            'username' => $order_row['buyer_info'],
            'phone' => $order_row['buyer_phone']

        ],
        'order' => [
            'orderid' => $order_row['order_id'],
            'add_time' => $order_row['add_time'],
            'way' => $pay_type
            ],
        'store' => [
            'name' => $merchant_row['name'],
            'logo' => $merchant_row['logo'],
            'phone' => $merchant_row['phone']
        ],
        'goods' => $goods,
        'code' => $school_row['short_title'] . $order_row['code']
    ];
    $obj->data = $order_detail;


}

/**
 * 查看退款进度
 */
function order_refund_pro() {
    global $obj,$uid;

    $order_id = IPost('id');
    if ($order_id<=0){
        $obj->r = '参数错误';
        CommonUtil::return_info($obj);
    }

    $order_row = DB::getone('SELECT id,user_id,status,order_id,add_time,pay_type,merchant_id,paid,refund,refund_fees,refund_reasons,refund_remarks FROM @pf_order WHERE id=?',[$order_id]);
    if (!$order_row || $order_row['user_id']!=$uid || !in_array($order_row['status'],[4,5])){
        $obj->r = '订单不存在';
        CommonUtil::return_info($obj);
    }
    $merchant_row = DB::getone('SELECT phone FROM @pf_merchant WHERE id=?',[$order_row['merchant_id']]);
    $goods_rows = DB::getlist('SELECT title,total,img,market_price FROM @pf_order_goods WHERE order_id=?',[$order_row['id']]);

    $goods = [];

    foreach ($goods_rows as $k=>$row){
        $goods[$k]['title'] = $row['title'];
        $goods[$k]['total'] = $row['total'];
        $goods[$k]['total'] = $row['total'];
        $goods[$k]['price'] = $row['total']*$row['market_price'];
        $goods[$k]['img'] = replace_image(1,$row['img']);
    }

    $pay_type = ['余额','微信账户'][$order_row['pay_type']];

    $refund = [
        'id' => $order_row['order_id'],
        'phone' => $merchant_row['phone'],
        'goods' => $goods,
        'reasons' => $order_row['refund_reasons'],
        'account' => $pay_type
    ];

    if ($order_row['status']==4){
        $refund['money'] = $order_row['paid'];
        $refund['refund'] = 1;
    }elseif ($order_row['status']==5){
        $refund['money'] = $order_row['refund_fees'];
        $refund['refund'] = $order_row['refund'];
        $refund['reasons'] = ($order_row['refund_remarks'] ? $order_row['refund_remarks']: '');
    }
    $obj->data = $refund;
}

