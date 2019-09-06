<?php
require_once 'base.php';

$obj = new stdClass();
$obj->status = 500;

$tag_id = IPost('id');
$sid = IPost('sid');

if ($tag_id<=0 || $sid<=0){
    $obj->r = '参数错误';
    CommonUtil::return_info($obj);
}

try{
    $select = new Select('@pf_goods AS g');
    $select->join('@pf_merchant AS m');
    $select->find('g.title,g.img,g.market_price AS price,m.id AS mid');
    $select->where('AND g.merchant_id=m.id AND g.allow=1 AND g.deleted=0');
    $select->where('AND m.supp_schools REGEXP ?',['"' . $sid . '"']);
    $list =  $select->getPagelist(14);
    $rows = $list->getlist();
    foreach ($rows as $k=>$v){
        $rows[$k]['img'] = replace_image(1,$v['img']);
    }
}catch (Exception $e){
    $obj->r = '接口错误';
    CommonUtil::return_info($obj);
}
$title = DB::getval('@pf_tag_index','title',$tag_id);

$obj->data = ['title'=>$title,'list'=>$rows];
$obj->status = 200;
CommonUtil::return_info($obj);