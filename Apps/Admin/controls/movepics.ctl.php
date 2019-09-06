<?php

class MovepicsController extends SmcmsController {
    function indexAction() {
        $schoolId = IGet('school_id');
        $title =  DB::getval('@pf_school','title',$schoolId);
        $this->assign(compact('schoolId','title'));
        return parent::indexAction();
    }

    public function addGetAction() {
        $schoolId = IGet('school_id');

        $model = Model($this->ModelName);
        $model->Fields['merchant_id']->options =  DB::getopts('@pf_merchant','id,name',0,'status=1 AND supp_schools REGEXP ?',['"' . $schoolId . '"'] );
        $model->Fields['school_id']->default =  $schoolId;

        $model->Fields['goods_id']->data_val =  array(
            'required' => true,
            'digits' => true,
            'remote' => array(
                array(
                    0 => '/admin/goods/check_goods?school_id=' . $schoolId,
                    1 => 'POST'
                )
            ),
        );
        $model->Fields['article_id']->data_val =  array(
            'required' => true,
            'digits' => true,
            'remote' => array(
                array(
                    0 => '/admin/article/check_article?school_id=' . $schoolId,
                    1 => 'POST'
                )
            ),
        );
        $this->setModel($model);
        $this->displayModel($model);
    }


    //TODO 优化代码
   public function editGetAction() {
       $model = Model($this->ModelName, Model::MODEL_EDIT);
       $schoolId =  DB::getval('@pf_movepics','school_id',$this->id);
       $model->Fields['merchant_id']->options =  DB::getopts('@pf_merchant','id,name',0,'status=1 AND supp_schools REGEXP ?',['"' . $schoolId . '"'] );


       $model->Fields['goods_id']->data_val =  array(
           'required' => true,
           'digits' => true,
           'remote' => array(
               array(
                   0 => '/admin/goods/check_goods?school_id=' . $schoolId,
                   1 => 'POST'
               )
           ),
       );
       $model->Fields['article_id']->data_val =  array(
           'required' => true,
           'digits' => true,
           'remote' => array(
               array(
                   0 => '/admin/article/check_article?school_id=' . $schoolId,
                   1 => 'POST'
               )
           ),
       );
       $this->setModel($model);
       $model->action = 'edit';
       $row = $model->getone($this->id);
       $model->setFieldVals($row);
       $this->displayModel($model);
   }

   public function beforeSaveModel($model) {
       $type = $model->Fields['type']->value;
       if ($type==1){
           $goodsId = $model->Fields['goods_id']->value;
           $merId = DB::getval('@pf_goods','merchant_id',$goodsId);
           $model->Fields['merchant_id']->value = $merId;
       }
   }
}