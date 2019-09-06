<?php
/**
 * 商品相关
 */
require_once 'base.php';
$obj = new stdClass();
$obj->status = 500;

$do = isset($_POST['do']) ? trim($_POST['do']) : '';

try{
    switch ($do){
        case 'spec':
            get_goods_spec();
            break;
        case 'spec_num':
            get_checked_spec();
            break;
        default:
            $obj->r = '参数错误';
            CommonUtil::return_info($obj);
    }
}catch (Exception $e){
    $obj->r = '接口错误，请重试';
    CommonUtil::return_info($obj);
}

$obj->status = 200;
CommonUtil::return_info($obj);


function get_goods_spec(){
    global $obj;
    $gid = IPost('gid');
    $user_id = IPost('uid');
    if ($gid<=0){
        $obj->r = '参数错误';
        CommonUtil::return_info($obj);
    }

    $ret_arr = [];
    if ($user_id > 0) {
        $cart_rows = DB::getlist('select id,total,spec_ids from @pf_member_cart where user_id=? and goods_id=? and deleted=0',array($user_id,$gid));
        foreach ($cart_rows as $k=>$row) {
            $spec_arr = json_decode($row['spec_ids']);
            $str = implode('_', $spec_arr);
            if (!$str)
                continue;
            $ret_arr[$str]['cid'] = $row['id'];
            $ret_arr[$str]['total'] = $row['total'];
        }
    }
    if (!$ret_arr)
        $ret_arr = new stdClass();

    $specs = DB::getlist('SELECT * FROM @pf_goods_spec WHERE goods_id=? AND allow=1 ORDER BY pid ASC, sort ASC',[$gid]);
    $arr = [];
    foreach($specs as $v) {
        if($v['pid'] == 0) {
            unset($v['price']);
            unset($v['sort']);
            unset($v['allow']);
            unset($v['stock']);
            unset($v['pid']);
            unset($v['required']);
            $arr[$v['id']] = $v;
        }else{
            $arr[$v['pid']]['child'][] = $v;
        }
    }

    $sepec_arr = [];
    foreach ($arr as $v){
        $sepec_arr[] = $v;
    }
    $obj->data = [
        'specs' => $sepec_arr,
        'spec_num' => $ret_arr
    ];
}

function get_checked_spec() {
    global $obj;
    $goods_id = IPost('gid');
    $user_id = IPost('uid');

    if ($goods_id<=0 || $user_id<=0) {
        $obj->r = '参数错误';
        CommonUtil::return_info($obj);
    }
    //todo
    $cart_rows = DB::getlist('select id,total,spec_ids from @pf_member_cart where user_id=? and goods_id=?',array($user_id,$goods_id));
    $ret_arr = [];

    foreach ($cart_rows as $k=>$row) {
        $spec_arr = json_decode($row['spec_ids']);
        $str = implode('_', $spec_arr);
        if (!$str)
            continue;
        $ret_arr[$str]['id'] = $row['id'];
        $ret_arr[$str]['total'] = $row['total'];

    }
    $obj->data = ['spec_num' => $ret_arr];
}