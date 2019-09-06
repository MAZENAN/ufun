<?php

class CouponsController extends SmcmsController {

	//添加优惠券页面
	public function addGetAction() {
        $model = Model($this->ModelName);
        $model->Fields['addtime']->close = true;
        $this->setModel($model);
        $this->displayModel($model);
    }

    //添加优惠券
     public function addPostAction() {
        $model = Model($this->ModelName);
        $this->setModel($model);
        $model->autoComplete($vals);
        if (!$model->validation()) {
            $this->displayModel($model);
            return;
        }
        $this->beforeSaveModel($model);
        $vals['addtime']=date('Y-m-d H:i:s');
        $ret = DB::insert("@pf_{$model->tbname}", $vals);
        $this->success('插入数据成功');
    }


}


?>