<?php

class MerchantController extends SmcmsController{

    public function addPostAction() {
        $model = Model($this->ModelName);
        $this->setModel($model);
        $model->autoComplete($vals);
        if (!$model->validation()) {
            $this->displayModel($model);
            return;
        }

        $mobile = $vals['mobile'];
        $pass = $vals['pass'];
        $row = DB::getone('SELECT id,mobile FROM @pf_member WHERE mobile=? AND type=2',[$mobile]);
//        DB::beginTransaction();
      //  try{
            if (empty($row)){
                $user = [
                    'mobile'=>$mobile,
                    'username'=>$mobile,
                    'pass'=>md5($pass),
                    'type'=>2,
                    'addtime'=>date('Y-m-d H:i:s')
                ];
                DB::insert('@pf_member',$user);
                $uid = DB::lastId();
            }else{
                $uid = $row['id'];
            }

            if ($uid){
                unset($vals['mobile']);
                unset($vals['pass']);
//                unset($vals['delivery_time1']);
//                unset($vals['delivery_time2']);
//                unset($vals['delivery_time3']);

                $vals['user_id'] = $uid;
                $vals['add_time'] = date('Y-m-d H:i:s');
                $vals['update_time'] = date('Y-m-d H:i:s');
                $vals['allow'] = 0;
                $this->beforeSaveModel($model);
                DB::insert("@pf_{$model->tbname}",$vals);
                $this->success('添加商户成功,请去添加配送信息');
            }else{
                //$this->error('添加商户失败');
                $this->displayModel($model);
                return;
            }
//            DB::commit();
//        }catch (Exception $e){
//            DB::rollBack();
//            $this->error('添加商户失败');
//        }


    }

    public function editGetAction() {
        $model = Model($this->ModelName, Model::MODEL_EDIT);

        $model->Fields['mobile']->close = true;
        $model->Fields['pass']->close = true;

        $tabs = $model->tabs;
        unset($tabs['account']);
        $model->tabs = $tabs;

        $this->setModel($model);
        $model->action = 'edit';
        $row = $model->getone($this->id);
        $model->setFieldVals($row);
        $this->displayModel($model);
    }

    public function editPostAction() {
        $model = Model($this->ModelName, Model::MODEL_EDIT);
        $this->setModel($model);
        $model->Fields['mobile']->close = true;
        $model->Fields['pass']->close = true;
        $model->autoComplete($vals);
        if (!$model->validation()) {
            $model->action = 'edit';
            $this->displayModel($model);
            return;
        }
        $delivery_rows = $this->get_delivery($this->id);
        $msg = '';
        if (!$delivery_rows){
            $vals['allow'] = 0;
            $msg = ',请去添加配送信息';
        }
        $this->beforeSaveModel($model);
        DB::update("@pf_{$model->tbname}",$vals,$this->id);
        $this->success('更新商户信息成功' . $msg);
    }

    public function check_accountAjaxAction() {
        $mobile = SPost('mobile');
        $row = DB::getone('SELECT id FROM @pf_member WHERE mobile=? AND type=2',[$mobile]);
        return empty($row) ? true : false ;
    }

    private function get_delivery($merch_id) {
        $rows = $delivery_rows =DB::getlist('SELECT id FROM @pf_delivery WHERE merchant_id = ? AND (is_noon=1 OR is_pm=1)',[$merch_id]);
        return $rows;
    }

    public function seton_allowAction() {
        $rows = $this->get_delivery($this->id);

        if ($rows){
            $model = Model($this->ModelName);
            $model->setON($this->id, 'allow');
            $this->success();
        }else{
            $this->error('请去添加配送时间');
        }
    }

    /**
     * 批量上线营业
     */
    public function seton_allowsAction() {
        $ids = SPost('merch_id');
        foreach ($ids as $id){
            DB::update('@pf_merchant',[
                'allow' => 1,
                'update_time' => date('Y-m-d H:i:s')
            ],$id);
        }
        $this->success('批量上线营业成功');
    }

    /**
     * 批量关闭店铺
     */
    public function setoff_allowsAction() {
        $ids = SPost('merch_id');
        foreach ($ids as $id){
            DB::update('@pf_merchant',[
                'allow' => 0,
                'update_time' => date('Y-m-d H:i:s')
            ],$id);
        }
        $this->success('批量关闭营业成功');
    }
}