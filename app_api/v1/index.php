<?php
/**
 * 小程序首页
 */
require_once 'base.php';

$obj = new stdClass();
$obj->status = 500;

$school_id = IPost('sid');
$uid = IPost('uid');
$page = IPost('page',1);
$page = $page <=0 ? 1 : $page;

if ($school_id == 0){
    $school_row = DB::getone("SELECT id,title AS name FROM @pf_school WHERE allow=1 ORDER BY id ASC");
}else{
    $school_row = DB::getone("SELECT id,title AS name FROM @pf_school WHERE allow=1 AND id=?",[$school_id]);
}

if (!$school_row){
    $obj->r = '请重新选择学校';
    CommonUtil::return_info($obj);
}

$school = $school_row;
$school_id = $school['id'];

$img_path = C('QiniuRoot');

$select = new Select('@pf_merchant');
$select->find('id,allow,name,star,deliver_from_price,deliver_price,notice');
$select->where('AND status=1');
$select->where('AND supp_schools REGEXP ?',['"' . $school_id . '"']);
$select->orderby('allow','DESC');
//$select->orderby('sort','ASC');
$list = $select->getPagelist(10);

$store_list = $list->getlist();

$banner = $notice = $stores = $cates = $guess_likes = [];

if ($page == 1) {
    $banner = DB::getlist("SELECT id,name,CONCAT('{$img_path}',src) AS src,type,article_id AS aid,goods_id AS gid,merchant_id AS mid FROM @pf_movepics WHERE allow=1 AND school_id=? ORDER BY sort ASC",[$school_id]);
    $notice = DB::getlist('SELECT id,title FROM @pf_notice WHERE allow=1 AND type=0 AND school_id =? ORDER BY sort ASC',[$school_id]);
    //推荐到首页的
    $stores = DB::getlist("SELECT id,allow,name,CONCAT('{$img_path}',logo) AS logo FROM @pf_merchant WHERE status=1 AND is_recommend=1 AND supp_schools REGEXP ? ", ['"' . $school_id . '"']);
    $cates   = DB::getlist("SELECT id,title,CONCAT('{$img_path}',img) AS img FROM @pf_tag_index WHERE allow=1 ORDER BY sort ASC");
    $guess_likes = [];

    if ($uid){
        //获取购买过的
    }else{
        //按商品销量
        $guess_likes = DB::getlist("SELECT g.id AS gid,g.title,g.market_price,CONCAT('{$img_path}',g.img) AS src,g.merchant_id AS mid FROM @pf_goods AS g INNER JOIN @pf_merchant AS m ON g.merchant_id=m.id WHERE g.allow=1 AND g.deleted=0 AND m.status=1 AND m.supp_schools REGEXP ? LIMIT 6",['"' . $school_id. '"']);
    }
}

foreach ($store_list as $k=>$v){
    $goods = DB::getlist("SELECT id AS gid,CONCAT('{$img_path}',img) AS img,title,market_price FROM @pf_goods WHERE merchant_id=? AND is_recommand=1 AND allow=1 AND deleted=0 LIMIT 0,3",[$v['id']]);
    $store_list[$k]['goods'] = $goods;
}

$obj->data = [
    'school' => $school,
    'banner' => $banner,
    'notice' => $notice,
    'cates'   => $cates,
    'recommend_stores' => $stores,
    'guess_likes' => $guess_likes,
    'store_list'   => $store_list
];

$obj->status = 200;
CommonUtil::return_info($obj);