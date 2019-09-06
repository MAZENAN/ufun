<?php

class SinglePageController extends SmcmsController {

    public function editGetAction() {
        $model = Model($this->ModelName, Model::MODEL_EDIT);
        $this->setModel($model);
        $model->action = 'edit';
        if ($this->id) {
            $row = $model->getone($this->id);
        } else {
            $key = SGet('key');
            $row = DB::getone('select * from @pf_singlepage where `key`=?', array($key));
            $this->id = $row['id'];
            $model->Fields['key']->close = true;
            $model->back = "";
        }
        $model->title = '编辑 ' . $row['title'];
        $model->setFieldVals($row);
        $this->displayModel($model);
    }

    public function editPostAction() {
        $model = Model($this->ModelName, Model::MODEL_EDIT);
        $backurl = NULL;
        if ($this->id) {
            $row = $model->getone($this->id);
        } else {
            $key = SGet('key');
            $row = DB::getone('select * from @pf_singlepage where `key`=?', array($key));
            $this->id = $row['id'];
            $model->Fields['key']->close = true;
            $model->back = "";
            $backurl = __SELF__ . "/edit?key={$key}";
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
