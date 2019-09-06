<?php

class ArticleController extends SmcmsController{

    public function listData($select) {
        $schoolId = IGet('school_id');
        $name = DB::getval('@pf_school','title',$schoolId);
        $this->assign(compact('schoolId','name'));
        return parent::listData($select);
    }

    public function addGetAction() {
        $schoolId = IGet('school_id');
        $model = Model($this->ModelName);
        $model->Fields['school_id']->default = $schoolId;

        $this->setModel($model);
        $this->displayModel($model);
    }

    public function check_articleAjaxAction() {
        $schoolId = IGet('school_id');
        $articleId = IPost('article_id');

        $article_row = DB::getone('SELECT school_id,allow FROM @pf_article WHERE id=?',[$articleId]);

        if (!$article_row || $schoolId!=$article_row['school_id'] || $article_row['allow']!=1){
            return false;
        }
        return true;
    }
}