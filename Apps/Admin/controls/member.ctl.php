<?php

class MemberController extends SmcmsController{

    public function listData($select) {
        $type = IGet('type');
        $status = IGet('status');
        $from = SGet('from');
        $this->assign(compact('type','status','from'));
        return parent::listData($select);
    }

    public function editGetAction() {
        $model = Model($this->ModelName, Model::MODEL_EDIT);
        $this->setModel($model);
        $model->action = 'edit';
        $row = $model->getone($this->id);
        $model->setFieldVals($row);
        $this->displayModel($model);
    }

    public function setModel($model) {
        $status = IGet('status');
        $type = IGet('type');
        if ($status==1){
            $model->Fields['username']->close = true;
            $model->Fields['pass']->close = true;
            $model->Fields['email']->close = true;
            $model->Fields['errtice']->close = true;
            $model->Fields['errtime']->close = true;
            $model->Fields['lock']->close = true;
            $model->Fields['last_login_time']->close = true;
            $model->Fields['this_login_time']->close = true;
            $model->Fields['name']->close = true;
            $model->Fields['telephone']->close = true;
            $model->Fields['area']->close = true;
            $model->Fields['nickname']->close = true;
            $model->Fields['score']->close = true;
            $model->Fields['unionid']->close = true;
            $model->Fields['card']->close = true;
            $model->Fields['webchat']->close = true;
            $model->Fields['addtime']->close = true;
            $model->Fields['img_head']->close = true;
            $model->Fields['remark']->close = true;
            $model->Fields['address']->close = true;
            $model->Fields['openid']->close = true;
            $model->Fields['auth_mobile']->close = true;
            $model->Fields['bind_mobile']->close = true;
        }
        if ($type==2){
            $model->Fields['email']->close = true;
            $model->Fields['status']->close = true;
            $model->Fields['pass']->data_val = array(
                'required' => true,
                'minlength' => 6
            );
            $model->Fields['errtice']->close = true;
            $model->Fields['errtime']->close = true;
            $model->Fields['lock']->close = true;
            $model->Fields['name']->close = true;
            $model->Fields['gender']->close = true;
            $model->Fields['telephone']->close = true;
            $model->Fields['area']->close = true;
            $model->Fields['nickname']->close = true;
            $model->Fields['real_name']->close = true;
            $model->Fields['school_id']->close = true;
            $model->Fields['stu_card']->close = true;
            $model->Fields['admission_time']->close = true;
            $model->Fields['score']->close = true;
            $model->Fields['unionid']->close = true;
            $model->Fields['card']->close = true;
            $model->Fields['webchat']->close = true;
            $model->Fields['addtime']->close = true;
            $model->Fields['img_head']->close = true;
            $model->Fields['remark']->close = true;
            $model->Fields['address']->close = true;
            $model->Fields['openid']->close = true;
            $model->Fields['auth_mobile']->close = true;
            $model->Fields['bind_mobile']->close = true;
        }
    }

    public function editPostAction() {
        $model = Model($this->ModelName, Model::MODEL_EDIT);
        $this->setModel($model);
        if (!$model->validation()) {
            $model->action = 'edit';
            $this->displayModel($model);
            return;
        }
        $this->beforeSaveModel($model);
        $model->update($this->id);
        $this->success('编辑数据成功');
    }

    public function beforeSaveModel($model) {
        $user = $model->autoComplete();
        if (!empty($user->pass)) {
            $user->pass = md5($user->pass);
        }
    }

//    public function reviewAction() {
//       $user = DB::getone('SELECT m.mobile,m.real_name,s.title AS school_name,m.admission_time,m.stu_card,m.status FROM @pf_member AS m LEFT JOIN @pf_school AS s ON m.school_id =s.id WHERE m.id=?',[$this->id]);
//       $this->assign(compact('user'));
//       $this->display('user_auth_review.tpl');
//    }

    public function reviewAction() {
        if (empty($this->id)){
            $this->error('参数错误');
        }
        $user = DB::getone('SELECT m.mobile,m.real_name,s.title AS school_name,m.admission_time,m.stu_card,m.status FROM @pf_member AS m LEFT JOIN @pf_school AS s ON m.school_id =s.id WHERE m.id=?',[$this->id]);
        if (!$user){
            $this->error('用户不存在');
        }
        $model = new UserAuthReviewModel(Model::MODEL_EDIT);

        if (IS_POST) {
            $model->autoComplete($vals);
            if ($model->validation()) {
                if ($vals['check_status']==1){
                    $user_update = [
                        'status' => 2,
                        'remark' => $vals['remark']
                    ];
                    $state = '认证成功';
                    $refmark = '恭喜您认证成功!';
                }else{
                    $user_update = [
                        'status' => 3,
                        'remark' => $vals['remark'],
                        'ref_mark' => $vals['ref_mark']
                    ];
                    $state = '认证失败';
                    $refmark = $vals['ref_mark'];
                }
                DB::update('@pf_member',$user_update,$this->id);
                $push_data = [$state,$user['real_name'],$refmark,date('Y-m-d H:i:s')];
                Comm::push('authenticate',$this->id,$push_data);
                $this->success('审核完成！');
            }
        }
        $row = [];
        $row['mobile'] = $user['mobile'];
        $row['real_name'] = $user['real_name'];
        $row['school_name'] = $user['school_name'];
        $row['admission_time'] = $user['admission_time'];
        $row['stu_card'] = $user['stu_card'];
        $row['status'] = $user['status'];

        $model->setFieldVals($row);
        $this->displayModel($model);
    }

}