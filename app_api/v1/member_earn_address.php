<?php
/**
 * 赏金地址管理
 */

require_once 'base.php';
$obj = new stdClass();
$obj->status = 500;

$do = isset($_POST['do']) ? trim($_POST['do']) : '';
$uid = IPost('uid');
//TODO 用户检查

try{
    switch ($do){
        case 'add':
            address_add();
            break;
        case 'all':
            address_list();
            break;
        case 'modify':
            address_modify();
            break;
        case 'del':
            address_delete();
            break;
        default:
            $obj->r = '参数错误';
            CommonUtil::return_info($obj);
    }
}catch (Exception $e){
    $obj->r = '服务器错误请重试';
    CommonUtil::return_info($obj);
}
$obj->status = 200;
CommonUtil::return_info($obj);

/**
 * 创建地址
 */
function address_add() {
    global $obj,$uid;

    $address = trim($_POST['addr']);
    $type = IPost('type');

    if (!in_array($type,[1,2]) || !$address){
        $obj->r = '参数错误';
        CommonUtil::return_info($obj);
    }

    $addr_insert = [
        'user_id' => $uid,
        'type' => $type,
        'address' => $address,
        'add_time' => date('Y-m-d H:i:s')
    ];

    DB::insert('@pf_earn_user_address',$addr_insert);
}

/**
 * 地址列表
 */
function address_list() {
    global $obj,$uid;

    $type = IPost('type');
    if (!in_array($type,[1,2])){
        $obj->r = '参数错误';
        CommonUtil::return_info($obj);
    }

    $addr_list = DB::getlist('SELECT id,address,type FROM @pf_earn_user_address WHERE user_id=? AND type=?',[$uid,$type]);

    $obj->data = [
        'list' => $addr_list
    ];
}

/**
 * 修改地址
 */
function address_modify() {
    global $obj,$uid;

    $address = trim($_POST['addr']);
    $id = IPost('id');

    if ($id<=0 || !$address){
        $obj->r = '参数错误';
        CommonUtil::return_info($obj);
    }

    $addr_row = DB::getone('SELECT user_id FROM @pf_earn_user_address WHERE id=?',[$id]);
    if (!$addr_row || $addr_row['user_id']!=$uid){
        $obj->r = '地址不存在';
        CommonUtil::return_info($obj);
    }

    $addr_update = [
        'user_id' => $uid,
        'address' => $address
    ];

    DB::update('@pf_earn_user_address',$addr_update,$id);
}

/**
 * @throws Exception
 * 删除用户地址
 */
function address_delete() {
    global $obj,$uid;

    $id = IPost('id');

    $addr_row = DB::getone('SELECT user_id FROM @pf_earn_user_address WHERE id=?',[$id]);

    if (!$addr_row || $addr_row['user_id']!=$uid){
        $obj->r = '地址不存在';
        CommonUtil::return_info($obj);
    }

    DB::delete('@pf_earn_user_address',$id);
}