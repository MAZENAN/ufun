<?php

class SellerMenuController extends SmcmsController{

    public function listData($select) {
        $mid = IGet('mid');
        $select->where('AND merchant_id=?',[$mid]);
        $select->orderby('sort','ASC');
        $this->assign('mid',$mid);
        return parent::listData($select);
    }

    public function addGetAction() {
        $mid = IGet('mid');
        if (!$mid){
            $this->error('参数错误!');
        }

        $model = Model($this->ModelName);
        $model->Fields['merchant_id']->value = $mid;
        $this->setModel($model);
        $this->displayModel($model);
    }

    public function menusAjaxGetAction(){
        $mid = IGet('mid');
        $menus = DB::getlist('SELECT id,title FROM @pf_seller_menu WHERE merchant_id=? AND allow=1',[$mid]);
        array_unshift($menus,['id'=>'','title'=>'请选择']);
        echo empty($menus) ? json_encode([]) : json_encode($menus);
    }


}