<?php
class ConfigController extends SmcmsController{
    public function editGetAction(){
        $model = Model($this->ModelName, Model::MODEL_EDIT);
        $this->setModel($model);
        $model->action = 'edit';
        if($this->id){
            $row = $model->getone($this->id);
        }else{
            $row = DB::getone('select * from @pf_config order by id asc');
        }
        $model->setFieldVals($row);
        $this->displayModel($model);
    }

    public function editPostAction() {
        $model = Model($this->ModelName, Model::MODEL_EDIT);
        $backurl = NULL;
        if ($this->id) {
            $row = $model->getone($this->id);
        } else {
            $row = DB::getone('select * from @pf_config order by id asc');
            $this->id = $row['id'];
            $backurl = __SELF__ . "/edit?id=".$this->id;
        }
        $model->autoComplete();
        if (!$model->validation()) {
            $model->action = 'edit';
            $this->displayModel($model);
            return;
        }
        $model->update($this->id);
        $this->success('编辑数据成功', $backurl);
    }
}