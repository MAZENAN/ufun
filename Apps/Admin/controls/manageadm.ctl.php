<?php

class ManageadmController extends SmcmsController {

    public function indexAction() {
        $this->doact('modfy');
        $row = DB::getrow('@pf_manage', $this->AdmID);
        $model = new ManageAdmModel();
        $model->setFieldVals($row);
        $model->action = 'modfy';
        $model->back = '重置';
        $model->backscript = 'reset();';
        $this->displayModel($model);
    }

    public function doact() {
        parent::doact('modfy');
    }

    public function modfyPostAction() {
        $model = new ManageAdmModel();
        $row = DB::getrow('@pf_manage', $this->AdmID);
        $User = $model->autoComplete();
        if (md5($User->oldpass) != $row['pwd']) {
            $model->addError('oldpass', '旧密码输入不正确!');
        }
        if (!$model->validation()) {
            $model->action = 'modfy';
            $model->setFieldVals($row);
            $this->displayModel($model);
            return;
        }
        $User->pwd = md5($User->pwd);
        $model->update($this->AdmID);
        $this->success('修改用户密码成功！', __SELF__);
    }

}
