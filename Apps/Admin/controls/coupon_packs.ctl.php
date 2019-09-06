<?php

class CouponPacksController extends SmcmsController {
    
     public function indexAction() {
        $this->doact('*');
        $select = new Select('@pf_coupon_packs');
        $select->find('id,title,total_amount,is_top,allow');
        $select->orderby('id desc');
        $list = $select->getPagelist();
        $rows = $list->getlist();
        foreach ($rows as &$value) {
            $num = DB::getone("select count(id) as num from @pf_coupons where pack_id=?", [$value['id']]);
            $infos = DB::getlist("select scope,coupon,title as c_title,deadline from @pf_coupons where pack_id=?", [$value['id']]);
            $value['num'] = $num['num'];
            $value['coupons'] = $infos;
            
        }
        $this->assign('rows',$rows);
        $this->assign('bar', $list->getinfo());
        $this->display('layout/coupon_packs_list.tpl');
    }
    

  //添加优惠礼包
     public function addPostAction() {
        $model = Model($this->ModelName);
        $this->setModel($model);
        $model->autoComplete($vals);
        if (!$model->validation()) {
            $this->displayModel($model);
            return;
        }
        $this->beforeSaveModel($model);
      
        $vals['add_time'] = date('Y-m-d H:i:s');
        $ret = DB::insert("@pf_{$model->tbname}", $vals);
        $row['title'] = '优惠券';
        $row['addtime']=date('Y-m-d H:i:s');
        $last_id = DB::lastId();
        $row['pack_id'] = $last_id;
        $ret = DB::insert("@pf_coupons", $row);
        $this->success('插入数据成功',__SELF__.'/edit?id='.$last_id,1);
    }

    public function editGetAction() {
        $model = Model($this->ModelName, Model::MODEL_EDIT);
        $this->setModel($model);
        $model->action = 'edit';
        $model->Fields['coupon']->close=FALSE;
        $model->Fields['scope']->close=FALSE;
        $model->Fields['starttime']->close=FALSE;
        $model->Fields['deadline']->close=FALSE;
        $model->Fields['camp_id']->close=FALSE;
        $model->Fields['pack_id']->close=FALSE;
        $model->Fields['allow']->close=FALSE;
        $row = $model->getone($this->id);
        $vals = DB::getlist("select * from @pf_coupons where pack_id=? order by id asc", [$this->id]);
        $model->setFieldVals($row);
        $this->assign('vals',$vals);
        $this->assign('id',  $this->id);
        $this->displayModel($model,'layout/edit_packs_list.tpl');
    }

    public function editPostAction() {
        $model = Model($this->ModelName, Model::MODEL_EDIT);
        $this->setModel($model);
        $model->autoComplete($vals);
        if (!$model->validation()) {
            $model->action = 'edit';
            $this->displayModel($model);
            return;
        }
        $this->beforeSaveModel($model);
        $model->update($this->id);
        $this->success('编辑数据成功',__SELF__.'/coupon_packs');
    }
    
//优惠券列表(目前没有用)
    public function couponsListAction($param) {
        $id = $this->id;
        $coupon = new Select('@pf_coupons');
        $coupon->find('id,coupon,scope,deadline,camp_id');
        $coupon->where(' and pack_id=?', [$id]);
        $coupon->orderby('id asc');
        $list = $coupon->getPagelist();
        $rows = $list->getlist();
        $this->assign('rows',$rows);
        $this->assign('bar', $list->getinfo());
//        $list = DB::getlist("select * from @pf_coupons where pack_id=?", [$id]);
//        $this->assign('rows',$list);
        $this->assign('id',$id);
        $this->display('layout/coupons_list.tpl');
        
    }
    
    //添加优惠券页面
    public function addCouponAction() {
        $model = new CouponsModel(0);
        $this->setModel($model);
        $id = $this->id;//礼包id
        $this->assign('id',$id);
        $this->displayModel($model,'layout/coupon_add_list.tpl');
    }

    //添加优惠券
     public function saveCouponAction() {
        $model = new CouponsModel(0);
        $this->setModel($model);
        $model->autoComplete($vals);
        if (!$model->validation()) {
            $this->displayModel($model);
            return;
        }
        //替换中文字符，
        $str1 = $vals['camp_id'];
        $str2="，";
        if(strpos($str1,$str2)){
            $vals['camp_id'] = str_replace("，",",",$str1);
        }
        
        $this->beforeSaveModel($model);
//        if($vals['scope']<$vals['coupon']){
//             $this->error('订单金额不能小于优惠券金额!');
//        }
        $vals['title'] = '优惠券';
        $vals['addtime']=date('Y-m-d H:i:s');
        $ret = DB::insert("@pf_{$model->tbname}", $vals);
        $this->success('插入数据成功',__SELF__.'/edit?id='.$vals['pack_id']);
        
     }
     
     //修改优惠券页面
    public function editCouponAction() {
        $model = new CouponsModel(1);
        $id = $this->id;
        $cid = IGet('cid');//优惠券id
        $coupon = DB::getone("select * from @pf_coupons where id=?",[$cid]);
        $model->setFieldVals($coupon);
        $this->assign('id',$id);
        $this->assign('cid',$cid);
        $this->displayModel($model,'layout/coupon_add_list.tpl');
    }
    
//保存优惠券
     public function saveEditAction() {
        $model = new CouponsModel(1);
        $this->setModel($model);
        $model->autoComplete($vals);
        $cid = IPost('cid');
        if (!$model->validation()) {
            $this->displayModel($model);
            return;
        }
        //替换中文字符，
        $str1 = $vals['camp_id'];
        $str2="，";
        if(strpos($str1,$str2)){
            $vals['camp_id'] = str_replace("，",",",$str1);
        }
        
        $this->beforeSaveModel($model);
//        if($vals['scope']<$vals['coupon']){
//             $this->error('订单金额不能小于优惠券金额!');
//        }
        $vals['addtime']=date('Y-m-d H:i:s');
        $ret = DB::update("@pf_{$model->tbname}", $vals,$cid);
        $this->success('修改数据成功',__SELF__.'/edit?id='.$vals['pack_id']);
       
     }
     
     //删除礼包及所属优惠券
      public function deleteAction() {
        $model = Model($this->ModelName);
        $model->delete($this->id);
        DB::delete('@pf_coupons', ' pack_id=? ',[$this->id]);
        $this->success('删除数据成功');
    }
     
     
     //删除优惠券
     public function deleteCouponAction() {
         $cid = $this->id;
         DB::delete('@pf_coupons', ' id=? ',[$cid]);
         $this->success('删除优惠券成功!');
     }

}


?>