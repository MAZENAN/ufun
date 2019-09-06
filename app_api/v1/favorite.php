<?php
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
//if (!check_user_exist($uid)){
//    $obj->r = '用户不存在';
//    CommonUtil::return_info($obj);
//}

try{
    switch ($do){
        case 'store':
            fav_store();
            break;
        case 'goods':
            fav_goods();
            break;
        case 'un_store':
            cancle_store();
            break;
        case 'un_goods':
            cancle_goods();
            break;
        default:
            $obj->r='参数错误';
            CommonUtil::return_info($obj);
            break;
    }
}catch (Exception $e){
    $obj->r='接口错误请重试';
    CommonUtil::return_info($obj);
}

$obj->status = 200;
CommonUtil::return_info($obj);

/**
 * 收藏店铺
 */
function fav_store() {
    global $obj;


}

/**
 * 收藏商品
 */
function fav_goods() {

}

/**
 * 店铺列表
 */
function store_list() {

}

/**
 * 商品列表
 */
function goods_list() {

}

/**
 * 取消收藏店铺
 */
function cancle_store() {}

/**
 * 取消收藏商品
 */
function cancle_goods() {}