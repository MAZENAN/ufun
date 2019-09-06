<?php

class OrderStopController extends SmcmsController{

    public function listData($select) {
        $merchantId = IGet('merchant_id');
        $this->assign(compact('merchantId'));
        $select->where('AND merchant_id=?',[$merchantId]);
        return parent::listData($select);
    }

    public function addGetAction() {
        $merchantId = IGet('merchant_id');
        $model = Model($this->ModelName);
        $model->Fields['merchant_id']->value= $merchantId;
        $this->setModel($model);
        $this->displayModel($model);
    }

    public function addPostAction() {
        $merchantId = IPost('merchant_id');
        $week = IPost('week');

        $row = DB::getone('SELECT id FROM @pf_order_stop WHERE merchant_id=? AND week=?',[$merchantId,$week]);
        if ($row){
            $this->error('添加失败,已存在该截单信息','/admin/order_stop/index?merchant_id='.$merchantId);
        }
        $model = Model($this->ModelName);
        $this->setModel($model);
        $model->autoComplete();
        if (!$model->validation()) {
            $this->displayModel($model);
            return;
        }
        $this->beforeSaveModel($model);
        $model->add();
        $this->success('插入数据成功');
    }

    public function checkAjaxPostAction(){
        $merchantId = IGet('merchant_id');
        $week = IPost('week');
        $row = DB::getone('SELECT id FROM @pf_order_stop WHERE merchant_id=? AND week=?',[$merchantId,$week]);
        return $row ? false : true;
    }
}