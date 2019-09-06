<?php

class GoodsController extends SmcmsController{

    public function listData($select) {

        $from = SGet('from');
        $this->assign(compact('from'));

        if (isset($this->sch['sale_nums'])){
            $sale_nums = $this->sch['sale_nums'];
            if ($sale_nums == 1){
                $select->orderby('sales_real','DESC');
            }elseif ($sale_nums == 2){
                $select->orderby('sales_real','ASC');
            }
        }
        return parent::listData($select);
    }

    public function addGetAction() {
        $from = SGet('from');
        $mid = IGet('merchant_id');

        $model = Model($this->ModelName);

        if ($from == 'm' && $mid){
            $model->Fields['merchant_id']->value = $mid;
            $menuIds = DB::getopts('@pf_seller_menu','id,title',0,'merchant_id=? AND allow=1',[$mid]);
            $model->Fields['cate_id']->options = $menuIds;
        }

        $this->setModel($model);
        $this->displayModel($model);

    }

    public function addPostAction() {
        $model = Model($this->ModelName);
        $this->setModel($model);
        $model->autoComplete($vals);
        if (!$model->validation()) {
            $this->displayModel($model);
            return;
        }
        $vals['add_time'] = date('Y-m-d H:i:s');
        $vals['update_time'] = date('Y-m-d H:i:s');
        var_dump($vals['attr']);die();
        $this->beforeSaveModel($model);//todo
//        $model->add();
        $msg = '';
        if ($vals['is_option']==1) {
            $msg = '请去添加商品规格';
            $vals['allow'] = 0;
        }
        DB::insert("@pf_{$model->tbname}",$vals);
        $this->success('插入数据成功');
    }

    public function editGetAction() {
        $model = Model($this->ModelName, Model::MODEL_EDIT);

        $this->setModel($model);
        $model->action = 'edit';
        $row = $model->getone($this->id);
        $model->Fields['cate_id']->options = DB::getopts('@pf_seller_menu','id,title',0,'allow=1 AND merchant_id=?',[$row['merchant_id']]);
        $model->setFieldVals($row);
        $this->displayModel($model);
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
        $vals['update_time'] = date('Y-m-d H:i:s');
        $this->beforeSaveModel($model);//todo
        var_dump($vals['attr']);die();
//        $model->update($this->id);
        DB::update("@pf_{$model->tbname}",$vals,$this->id);
        $this->success('编辑数据成功');
    }


   public function do_recycleAction() {
       $model = Model($this->ModelName, Model::MODEL_EDIT);
       $model->setON($this->id, 'deleted');
       $this->success();
   }

   public function ret_recycleAction(){
       $model = Model($this->ModelName, Model::MODEL_EDIT);
       $model->setOFF($this->id, 'deleted');
       $this->success();
   }

   public function check_goodsAjaxAction() {
       $schoolId = IGet('school_id');
       $goodsId = IPost('goods_id');

       $goodsRow = DB::getone('SELECT merchant_id,allow,deleted FROM @pf_goods WHERE id=?',[$goodsId]);
       if (!$goodsRow || $goodsRow['allow']!=1 || $goodsRow['deleted']!=0){
           return false;
       }

      $merRow =  DB::getone('SELECT id,supp_schools FROM @pf_merchant WHERE id=?',[$goodsRow['merchant_id']]);
       if (!$merRow){
           return false;
       }

       if (!in_array($schoolId,json_decode($merRow['supp_schools']))){
           return false;
       }
       return true;
   }

    /**
     * 批量上架
     */
   public function seton_allowsAction() {
       $ids = SPost('goods_id');
       foreach ($ids as $id){
           DB::update('@pf_goods',[
               'allow' => 1,
               'update_time' => date('Y-m-d H:i:s')
           ],$id);
       }
       $this->success('批量上架成功');
   }

    /**
     * 批量下架
     */
    public function setoff_allowsAction() {
        $ids = SPost('goods_id');
        foreach ($ids as $id){
            DB::update('@pf_goods',[
                'allow' => 0,
                'update_time' => date('Y-m-d H:i:s')
            ],$id);
        }
        $this->success('批量下架成功');
    }

    private function getOptions($goods_id) {

    }

    public function setoffAjaxAction() {
        $id = IGet('id');
        if ($id<=0){
            return false;
        }
        try{
            DB::update('@pf_goods',['allow'=>0],$id);
            return true;
        }catch (Exception $e){
            return false;
        }
    }

    public function setonAjaxAction() {
        $id = IGet('id');
        if ($id<=0){
            return false;
        }
        try{
            DB::update('@pf_goods',['allow'=>1],$id);
            return true;
        }catch (Exception $e){
            return false;
        }

    }
}