<?php
/**
 * 店铺页面相关
 */
require_once 'base.php';
$obj = new stdClass();
$obj->status = 500;

$do = isset($_POST['do']) ? trim($_POST['do']) : '';
$uid = IPost('uid');

//if ($uid<=0){
//    $obj->r = '参数错误';
//    CommonUtil::return_info($obj);
//}
//TODO 检查用户是否存在


try{
    switch ($do){
        case 'detail':
            store_detail();
            break;
        case 'list':
            store_list();
            break;
        default:
            $obj = '参数错误';
            CommonUtil::return_info($obj);
    }
}catch (Exception $e){
    $obj->r = '接口错误，请重试';
    CommonUtil::return_info($obj);
}

$obj->status = 200;
CommonUtil::return_info($obj);

function store_detail(){
    global $obj,$uid;
    $img_path = C('QiniuRoot');
    $merchant_id = IPost('mid');

    if ($merchant_id <=0){
        $obj->r = '参数错误';
        CommonUtil::return_info($obj);
    }
    $store_row = DB::getone("SELECT id,allow,name,allow,deliver_from_price,deliver_price,CONCAT('{$img_path}',logo) AS logo FROM @pf_merchant WHERE id=? AND status=1",[$merchant_id]);
    if (empty($store_row)){
        $obj->r = '店铺不存在';
        CommonUtil::return_info($obj);
    }

    $notice_row = DB::getone('SELECT content as notice FROM @pf_notice WHERE allow=1 AND type=1 AND merchant_id=?',[$merchant_id]);
    $notice = $notice_row ? $notice_row['notice'] : '';
    $store_row['notice'] = $notice;

    $menu_rows = DB::getlist('SELECT id,title,description FROM @pf_seller_menu WHERE merchant_id=? AND allow=1 ORDER BY sort ASC',[$merchant_id]);
    $menus = empty($menu_rows) ? [] : $menu_rows;
    $store = empty($store_row) ? [] : $store_row;

    foreach ($menus as $k=>$v){
        $goods_rows = DB::getlist("SELECT id,title,subtitle,sales_real,market_price,unit,CONCAT('{$img_path}',img) AS img,is_option FROM @pf_goods WHERE merchant_id=? AND allow=1 AND deleted =0 AND cate_id = ?",[$merchant_id,$v['id']]);
        $goods = empty($goods_rows) ? [] : $goods_rows;

        foreach ($goods as $kk=>$vv){
            $cart_row = DB::getone('SELECT total FROM @pf_member_cart WHERE goods_id=? AND user_id=? AND merchant_id=? AND deleted=0',[$vv['id'],$uid,$merchant_id]);
            $total = $cart_row ? $cart_row['total'] : 0;
            $goods[$kk]['cart_total'] = $total;
            if ($vv['is_option']==1){
                $goods[$kk]['market_price'] = get_min_price($vv['id']);
            }
        }
        $menus[$k]['goods'] = $goods;
    }
    $obj->data = [
        'store' => $store,
        'menus' => $menus
    ];
}

/**
 * 店铺列表
 */
function store_list() {
    global $obj;

    $from = isset($_POST['from']) ? trim($_POST['from']) : '';
    $school_id = IPost('sid');
    $img_path = C('QiniuRoot');

    if (!in_array($from,['index','cate']) || $school_id<=0){
        $obj->r = '参数错误';
        CommonUtil::return_info($obj);
    }

    //TODO 校验学校

    $select = new Select('@pf_merchant');
    $select->find('id,name,star,deliver_from_price,deliver_price,notice');
    $select->where('AND status=1');
    $select->where('AND allow=1');
    $select->where('AND supp_schools REGEXP ?',['"' . $school_id . '"']);


    switch ($from){
        case 'index':
            break;
        case 'cate':
            $tag_id = IPost('cid');

            if ($tag_id<=0){
                $obj->r = '参数错误';
                CommonUtil::return_info($obj);
            }
            $select->where('AND tag_index_ids REGEXP ?',['"' . $tag_id . '"'] );
            break;
    }

    $list = $select->getPagelist(10);
    $store_list = $list->getlist();

    foreach ($store_list as $k=>$v){
        $goods = DB::getlist("SELECT CONCAT('{$img_path}',img) AS img,title,market_price FROM @pf_goods WHERE merchant_id=? AND is_recommand=1 AND allow=1 AND deleted=0 LIMIT 0,3",[$v['id']]);
        $store_list[$k]['goods'] = $goods;
    }

    $obj->data = [
        'list'=>$store_list
    ];
}