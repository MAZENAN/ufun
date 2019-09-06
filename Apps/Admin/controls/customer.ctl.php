<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class CustomerController extends SmcmsController {
    
    
    public function editGetAction() {
        $model = Model($this->ModelName, Model::MODEL_EDIT);
        $this->setModel($model);
        $model->action = 'edit';
        $row = $model->getone($this->id);
         $model->back = "";
        $model->setFieldVals($row);
        $this->displayModel($model);
    }
    
    public function editPostAction() {
       
        $model = Model($this->ModelName, Model::MODEL_EDIT);
        $this->setModel($model);
        $model->autoComplete();
        if (!$model->validation()) {
            $model->action = 'edit';
            $this->displayModel($model);
            return;
        }
        $this->beforeSaveModel($model);
        $model->update($this->id);

        $backurl = __SELF__ . "/edit?id=1";
        
        $this->success('编辑数据成功', $backurl);
    }
    
    
}

