<?php
/**
 * 用户购物车相关
 * mid 店铺id
 * gid 商品id
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

$cur_week = date('w')==0 ? 7 : date('w');
define('CUR_WEEK',$cur_week);
//TODO
//if (!check_user_exist($uid)){
//    $obj->r = '用户不存在';
//    CommonUtil::return_info($obj);
//}

try{
    switch ($do){
        case 'add':
            add_to_cart();
            break;
        case 'check':
            check();
            break;
        case 'increase':
            change_total('increase');
            break;
        case 'decrease':
            change_total('decrease');
            break;
        case 'clear':
            clear_in_store();
            break;
        case 'submit':
            submit_cart();
            break;
        case 'detail':
            detail_in_store();
            break;
        case 'choose':
            change_choose();
            break;
        default:
            $obj->r = 'do参数错误';
            CommonUtil::return_info($obj);
    }  
}catch (Exception $e){
    $obj->r = '接口错误请重试!'.$e->getMessage();
    //save_log($e);
    CommonUtil::return_info($obj);
}

$obj->status = 200;
CommonUtil::return_info($obj);

/**
 * 添加商品到购物车
 *
 */
function add_to_cart(){
    global $obj,$uid;

    $gid = IPost('gid');
    $type = IPost('type');//0添加单规格1添加多规格
    $spec_ids = isset($_POST['specs']) ? trim($_POST['specs']) : null;

    if ($gid<=0){
        $obj->r = '参数错误';
        CommonUtil::return_info($obj);
    }
    if (!in_array($type,[0,1])){
        $obj->r = '参数错误';
        CommonUtil::return_info($obj);
    }
    if ($type==1){
        if (is_null($spec_ids)){
            $obj->r = '参数错误';
            CommonUtil::return_info($obj);
        }
        $specs_arr = json_decode($spec_ids);
        if (json_last_error() != JSON_ERROR_NONE || !$specs_arr){
            $obj->r = '参数错误';
            CommonUtil::return_info($obj);
        }
    }

    $goods_row = DB::getone('SELECT title,img,product_price,market_price,is_option,merchant_id,deleted,allow FROM @pf_goods WHERE id=?',[$gid]);

    if (!$goods_row){
        $obj->r = '商品不存在，加入购物车失败';
        CommonUtil::return_info($obj);
    }
    if ($goods_row['allow']==0 || $goods_row['deleted']==1){
        $obj->r = '商品已下架，加入购物车失败';
        CommonUtil::return_info($obj);
    }

    if ($type != $goods_row['is_option']){
        $obj->r = '参数错误';
        CommonUtil::return_info($obj);
    }

    $cart_insert['user_id'] = $uid;
    $cart_insert['goods_id'] = $gid;
    $cart_insert['merchant_id'] = $goods_row['merchant_id'];
    $cart_insert['goods_name'] = $goods_row['title'];
    $cart_insert['goods_url'] = $goods_row['img'];
    $cart_insert['total'] = 1;
    $cart_insert['add_time'] = date('Y-m-d H:i:s');
    if ($type==0){
        //添加单规格商品
        $cart_insert['market_price'] = $goods_row['market_price'];
    }else{
        //添加多规格商品
        $cart_insert['spec_ids'] = $spec_ids;
        //TODO 可靠性怎么保障,需要价格遍历？

        $total_price = 0.0;
        foreach ($specs_arr as $spec_id){
            $price = DB::getval('@pf_goods_spec','price',$spec_id);
            if ($price){
                $total_price += $price;
            }
        }
        $cart_insert['market_price'] = $total_price;
    }
        DB::insert('@pf_member_cart',$cart_insert);
    $obj->data = ['id'=>DB::lastId()];
}

/**
 * 改变购物车商品数量
 * cid 购物车记录id
 * @throws Exception
 */
function change_total($type){
    global $obj,$uid;

    $cart_id = IPost('cid');

    if ($cart_id<=0){
        $obj->r = '参数错误';
        CommonUtil::return_info($obj);
    }

    $cart_row = DB::getone('SELECT id,user_id,total,deleted FROM @pf_member_cart WHERE id=?',[$cart_id]);
    if (!$cart_row || $uid!=$cart_row['user_id'] || $cart_row['deleted']==1){
        $obj->r = '修改失败';
        CommonUtil::return_info($obj);
    }

    $cart_update = [];
    if ($type=='increase'){
        $cart_update = ['total' => DB::sql('total+1')];
        $total = $cart_row['total']+1;
    }elseif($type=='decrease'){
        $cart_update =  $cart_row['total']<=1 ? ['total'=>0, 'deleted'=>1] : ['total'=>DB::sql('total-1')];
        $total = $cart_row['total']-1;
    }
    DB::update('@pf_member_cart',$cart_update,$cart_id);
    $obj->data = ['id'=>$cart_id,'total'=>$total];
}

/**
 * 清空店内的购物车
 * @throws Exception
 */
function clear_in_store(){
    global $obj,$uid;

    $mid = IPost('mid');

    if ($mid<=0){
        $obj->r = '参数错误';
        CommonUtil::return_info($obj);
    }

    DB::update('@pf_member_cart',['deleted'=>1],'user_id=? AND merchant_id=? AND deleted=0',[$uid,$mid]);
}

/**
 * 购物车结算页面数据
 * @throws Exception
 */
function submit_cart(){
    global $obj,$uid;

    $mid = IPost('mid');
    $sid = IPost('sid');

    if ($mid<=0 || $sid<=0){
        $obj->r = '参数错误';
        CommonUtil::return_info($obj);
    }

    $school_row = DB::getone('SELECT CONCAT(title,take_meal_addr) as take_addr,allow  FROM @pf_school WHERE id=?',[$sid]);
    if (!$school_row || $school_row['allow']!=1){
        $obj->r = '请重新选择配送学校';
        CommonUtil::return_info($obj);
    }
    //查询店铺信息
    $merchant_row =  DB::getone('SELECT id,name,allow,status,supp_schools,deliver_price from @pf_merchant WHERE id=?',[$mid]);
    if (!$merchant_row){
        $obj->r = '商家不存在';
        CommonUtil::return_info($obj);
    }
    if ($merchant_row['allow']!=1 || $merchant_row['status']!=1){
        $obj->r = '该商家暂未营业';
        CommonUtil::return_info($obj);
    }

    if (!in_array($sid,json_decode($merchant_row['supp_schools']))){
        $obj->r = '超出该商家配送范围';
        CommonUtil::return_info($obj);
    }
    //查询购物车信息
    $cart_rows = DB::getlist('SELECT id,goods_id,merchant_id,total,spec_ids,is_choose FROM @pf_member_cart WHERE user_id=? AND merchant_id=? AND deleted=0',[$uid,$mid]);

    if (!$cart_rows){
        $obj->r = '结算信息错误';
        CommonUtil::return_info($obj);
    }

//TODO 商品总价验证是否满起送价

    $cartArr = [];
    $pay_price = 0.0;
    foreach ($cart_rows as $k=>$v){
        $total = $v['total'];

        $goods =  DB::getone('SELECT title,market_price,allow,is_option,img FROM @pf_goods WHERE id=?',[$v['goods_id']]);
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
            $temp_price = $spec_price * $total;
//            $temp_price = $cartArr[$k]['price'] = $spec_price * $total;
            if ($v['is_choose']==1)
            $pay_price += $temp_price;
            $cartArr[$k]['spec_title'] = $spec_titles;

        }else{
            $cartArr[$k]['price'] = $goods['market_price'];
            $temp_price  = $goods['market_price'] * $total;
//            $temp_price = $cartArr[$k]['price'] = $goods['market_price'] * $total;
            if ($v['is_choose']==1)
            $pay_price += $temp_price;
        }
        $cartArr[$k]['title'] = $goods['title'];
        $cartArr[$k]['cid'] = $v['id'];
        $cartArr[$k]['total'] = $total;
        $cartArr[$k]['img'] = replace_image(1,$goods['img']);
        $cartArr[$k]['is_choose'] = $v['is_choose'];
    }

    $goods_info = [
        'store_name' =>$merchant_row['name'],
        'goods_list' => $cartArr
    ];


    $deliver_info = get_delivery_info($mid);
    if (empty($deliver_info)){
        throw new Exception('接口错误');
    }

    $current_week = date('w');
    $current_week = $current_week==0 ? 7 : $current_week;
//    $current_week = 7;
    $index = get_time_index($deliver_info,$current_week);
    if ($index==-1){
        throw new Exception('接口错误');
    }
    $deliver_time[] = $deliver_info[$index];
    if (isset($deliver_info[$index+1])){
        $deliver_time[] = $deliver_info[$index+1];
    }

    $school_ids = implode(',',json_decode($merchant_row['supp_schools']));

    $default_addr = DB::getone("SELECT id,address,username,mobile,gender,school_id FROM @pf_user_address WHERE user_id=? AND school_id in($school_ids) AND is_default=1",[$uid]);
    $self_addr = [];
    $take_addr = '';
    if ($default_addr){
        $school =DB::getone('SELECT title,take_meal_addr FROM @pf_school WHERE id=?',[$default_addr['school_id']]);
        $self_addr['id'] = $default_addr['id'];
        $self_addr['mobile'] = $default_addr['mobile'];
        $self_addr['sid'] = $default_addr['school_id'];
        $self_addr['gender'] = $default_addr['gender'];
        $self_name = $default_addr['username'];

        if ($self_addr['gender']==0){
            $self_name .= '(先生)';
        }elseif ($self_addr['gender']==1){
            $self_name .= '(女士)';
        }
        $self_addr['username'] = $self_name;
        $self_addr['address'] = '';
        if ($school){
            $self_addr['address'] = $school['title'] . $default_addr['address'];
            $take_addr = $school['title'] .$school['take_meal_addr'];
        }
    }

    $obj->data = [
        'self_addr' => $self_addr,
        'goods_info' => $goods_info,
        'pay_price' => $pay_price,
//        'take_addr' => $school_row['take_addr'],
        'take_addr' => $take_addr,
        'deliver_time' => $deliver_time,
        'delivery_price' => $merchant_row['deliver_price'],
        'timestamps' => time()
    ];
}

/**
 * 店铺内购物车详情
 */
function detail_in_store(){
    global $obj,$uid;
    $cart_num = 0;
    $goods_amount = 0.0;

    $mid = IPost('mid');

    if ($mid<=0){
        $obj->r = '参数错误';
        CommonUtil::return_info($obj);
    }

    $cart_rows = DB::getlist('SELECT id,goods_id,spec_ids,total FROM @pf_member_cart WHERE user_id=? AND merchant_id=? AND deleted=0',[$uid,$mid]);
    if (!$cart_rows){
        $obj->data = [];
    }

    $cartArr = [];
    foreach ($cart_rows as $k=>$v){
        $total = $v['total'];

       $goods =  DB::getone('SELECT title,market_price,allow,deleted,is_option FROM @pf_goods WHERE id=?',[$v['goods_id']]);
        if (!$goods || $goods['allow']==0 || $goods['deleted']==1){
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
            $cartArr[$k]['price'] = $spec_price * $total;
            $cartArr[$k]['spec_title'] = $spec_titles;
        }else{
            $cartArr[$k]['price'] = $goods['market_price'] * $total;
        }
        $goods_amount += $cartArr[$k]['price'];

        $cartArr[$k]['title'] = $goods['title'];
        $cartArr[$k]['total'] = $total;
        $cartArr[$k]['id'] = $v['id'];
        $cartArr[$k]['goods_id'] = $v['goods_id'];
        $cart_num +=$total;
    }
    $obj->data = ['list'=>$cartArr,'cart_num'=>$cart_num,'goods_amount'=>$goods_amount];
}

/**
 * 检查购物车是否存在该商品
 */
function check() {
    global $obj,$uid;

    $gid = IPost('gid');
    $type = IPost('type');//0添加单规格1添加多规格
    $spec_ids = isset($_POST['specs']) ? trim($_POST['specs']) : null;

    if ($gid<=0){
        $obj->r = '参数错误';
        CommonUtil::return_info($obj);
    }
    if (!in_array($type,[0,1])){
        $obj->r = '参数错误';
        CommonUtil::return_info($obj);
    }
    if ($type==1){
        if (is_null($spec_ids)){
            $obj->r = '参数错误';
            CommonUtil::return_info($obj);
        }
    }

    $goods_row = DB::getone('SELECT allow,deleted,merchant_id FROM @pf_goods WHERE id=?',[$gid]);
    if (!$goods_row || $goods_row['allow']==0 || $goods_row['deleted'] ==1){
        $obj->r = '商品不存在';
        CommonUtil::return_info($obj);
    }
    if ($type==1){
       $cart_row =  DB::getone('SELECT id FROM @pf_member_cart WHERE user_id=? AND goods_id=? AND merchant_id=? AND spec_ids=? AND deleted=0',[$uid,$gid,$goods_row['merchant_id'],$spec_ids]);
    }else{
        $cart_row =  DB::getone('SELECT id FROM @pf_member_cart WHERE user_id=? AND goods_id=? AND merchant_id=? AND deleted=0',[$uid,$gid,$goods_row['merchant_id']]);
    }

  $obj->data = $cart_row ? ['id'=>$cart_row['id']] : ['id'=>-1];

}

/**
 * 更新购物车选中状态
 * @throws Exception
 */
function change_choose() {
    global $obj,$uid;
    $cart_id = IPost('cid');
    $is_choose = IPost('is_choose');

    if ($cart_id<=0 || !in_array($is_choose,array(0,1))){
        $obj->r = '参数错误';
        CommonUtil::return_info($obj);
    }

    DB::update('@pf_member_cart',array('is_choose'=>$is_choose),$cart_id);
}