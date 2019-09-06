<?php

class ManageController extends SmcmsController {

   public function listData($select) {
            $select->find('*,
        (select name from @pf_group where id=@pf_manage.type) as manage_name');
        return parent::listData($select);
    }
    
    public function addPostAction() {
        if ($this->AdmID != 1) {
            $this->error('您没有权限执行本次操作!');
        }
        $model = Model($this->ModelName);
        $this->setModel($model);
        $User = $model->autoComplete();
        if (!$model->validation()) {
            $this->displayModel($model);
            return;
        }
        $User->pwd = md5($User->pwd);
        $model->add();
        $this->success('添加管理员成功');
    }

    public function editPostAction() {
        if ($this->AdmID != 1) {
            $this->error('您没有权限执行本次操作!');
        }
        $model = Model($this->ModelName, Model::MODEL_EDIT);
        $this->setModel($model);
        $User = $model->autoComplete();
        if (!$model->validation()) {
            $model->action = 'edit';
            $this->displayModel($model);
            return;
        }
        if(!empty($User->pwd)){
            $User->pwd = md5($User->pwd);
        }else{
            $model->Fields['pwd']->close = true;
        }
        $model->update($this->id);
        $this->success('编辑管理员成功');
    }

    public function deleteAction() {
        if ($this->AdmID != 1) {
            $this->error('您没有权限执行本次操作!');
        }
        $model = Model($this->ModelName);
        if ($this->id == 1) {
            $this->error('删除管理员失败，最高管理员不能被删除');
        }
        $model->delete($this->id);
        $this->success('删除数据成功');
    }

}
