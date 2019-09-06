<?php

class AutoController extends SmcmsController {

    public function addPostAction() {
        $model = Model($this->ModelName);
        $this->setModel($model);
        $model->autoComplete($vals);
        if (!$model->validation()) {
            $this->displayModel($model);
            return;
        }
        //keyword
        if ($vals['reply']==3) {
            $wechatObj = new Wechat();
            $access = $wechatObj->get_access_token();
            //$access = "IBRcmlc23YKs4EH0yXdpmzkuRpPimY3H5lU06Fg2v3RnUQVaH0VvljfYdfPE30GH9mQFrQJVA2WnOL25i4dAR-NqSbNc5raBXbn7uYTgE6D8DhHgD8FSq2Sq6UjykI0CQHSiAHACTE";
            if ($access == 1) {
                 $this->error('插入图片失败');
            }
            $media=$wechatObj->add_material($access,C('QiniuRoot').$vals['thumb']); 
            $media=json_decode($media);
                      
            $model->Fields['title']->value = $media->media_id;
        }
        
        
        $row = DB::getone('select count(*) as b from @pf_auto where keyword=?',[$vals['keyword']]);
        if ($row['b']>=1){
            $this->error("回复关键词已存在！");
        }
        
        $this->beforeSaveModel($model);
        $model->add();
        $this->success('插入数据成功');
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
        
       
        $row = DB::getone('select count(*) as b from @pf_auto where keyword=? and id!=?',[$vals['keyword'],$this->id]);
        if ($row['b']>=1){
            $this->error("回复关键词已存在！");
        }
        
        $this->beforeSaveModel($model);
        $model->update($this->id);
        $this->success('编辑数据成功');
    }

}
