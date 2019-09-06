<?php

class SmsController extends SmcmsController {

    public function editPostAction() {
        $model = Model("sms", Model::MODEL_EDIT);
        $this->setModel($model);
        $model->autoComplete($vals);
        if (!$model->validation()) {
            $model->action = 'edit';
            $this->displayModel($model);
            return;
        }
        $msg = '【营天下】' . $vals['content'];
        $mobile = '';
        if ($vals['reply'] == 1) {
            $mobile_rows = DB::getlist('select mobile from @pf_member where mobile<>""');
            if (empty($mobile_rows)) {
                $this->error("不存在对应手机号！");
            }
            /*  foreach ($rowss as $k => $v) {
              $mobile.= implode(',', $v);
              } */
            $mobile_rows = array_chunk($mobile_rows, 200, false);

            foreach ($mobile_rows as $k => $v) {
                foreach ($v as $k1 => $v1) {
                    $mobile.=$v1['mobile'] . ',';
                }
                $mobile = rtrim($mobile, ',');
                if (!empty($mobile)) {
                   $rs = SMS::send($mobile, $msg);
                }
                $mobile = '';
            }
        } else {
            $mobile = $vals['mobile'];

            if (empty($mobile)) {
                $this->error("不存在对应手机号！");
            }
            
            $rs = SMS::send($mobile, $msg);
            if ($rs != true) {
                $this->error("发送短信失败！");
            }
        }

        $this->beforeSaveModel($model);
        $this->success('发送会员短信成功');
    }

    public function editGetAction() {
        $model = Model("sms", Model::MODEL_EDIT);
        $this->setModel($model);
        $model->action = 'edit';

        $row['money'] = SMS::getSmsMoney();
        $model->setFieldVals($row);
        $this->displayModel($model);
    }

}
