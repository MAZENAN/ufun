<?php

class MsgListController extends SmcmsController {

    public function addPostAction() {
        $model = Model($this->ModelName);
        $model->autoComplete($vals);
        if ($vals['accept'] == 2) {
            $users = explode("\n", $vals['users']);
            $users = array_filter($users, 'trim');
            $ids = [];
            foreach ($users as $urs) {
                $urs = trim($urs);
                $row = DB::getone('select id from @pf_member where username=?', [$urs]);
                if (!$row) {
                    $model->addError('users', '账号: ' . $urs . ' 不存在！');
                }
                $ids[] = $row['id'];
            }
            if (!$model->validation()) {
                $this->displayModel($model);
                return;
            }
            unset($vals['users']);
            foreach ($ids as $id) {
                $vals['userid'] = $id;
                DB::insert('@pf_msg', $vals);
            }
        } else if ($vals['accept'] == 1) {
            if (!$model->validation()) {
                $this->displayModel($model);
                return;
            }
            unset($vals['users']);
            $vals['userid'] = 0;
            DB::insert('@pf_msg', $vals);
        }
        $this->success('插入数据成功');
    }

    public function editGetAction() {
        $model = Model('Msg', Model::MODEL_EDIT);
        $this->setModel($model);
        $model->action = 'edit';
        $row = $model->getone($this->id);
        $model->setFieldVals($row);
        $this->displayModel($model);
    }

    public function editPostAction() {
        $model = Model('Msg', Model::MODEL_EDIT);
        $this->setModel($model);
        $model->autoComplete();
        if (!$model->validation()) {
            $model->action = 'edit';
            $this->displayModel($model);
            return;
        }
        $this->beforeSaveModel($model);
        $model->update($this->id);
        $this->success('编辑数据成功');
    }

}
