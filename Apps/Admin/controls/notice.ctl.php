<?php

class NoticeController extends SmcmsController{

    public function listData($select) {
        $type = IGet('type');
        $merchantId = IGet('merchant_id');
        $schoolId = IGet('school_id');
        $select->where('AND type=?',[$type]);

        switch ($type){
            case 0:
                $select->where('AND school_id=?',[$schoolId]);
                break;
            case 1:
                $select->where('AND merchant_id=?',[$merchantId]);
                break;
            default:
                break;
        }

        $this->assign(compact('type','merchantId','schoolId'));
        return parent::listData($select);
    }

//        public function addGetAction() {
//            $type = IGet('type');
//            $merchantId = IGet('merchant_id');
//            $school_id = IGet('school_id');
//
//            $model = Model($this->ModelName);
//            $model->Fields['type']->value = $type;
//            $model->Fields['merchant_id']->value = $merchantId;
//            $model->Fields['school_id']->value = $school_id;
//            $this->setModel($model);
//            $this->displayModel($model);
//        }

        public function setModel($model) {
            $type = IGet('type');
            $merchantId = IGet('merchant_id');
            $school_id = IGet('school_id');

            $model->Fields['type']->value = $type;
            $model->Fields['merchant_id']->value = $merchantId;
            $model->Fields['school_id']->value = $school_id;
            if ($type==1){
                $model->Fields['content']->type = 'textarea';
                $model->Fields['content']->style = 'width:400px;height:100px';
            }
        }
}