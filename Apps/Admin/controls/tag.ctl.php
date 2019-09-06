<?php

class TagController extends SmcmsController {
    
    public $title = null;
    
    public function __construct($tplkey = NULL, $modelname = NULL) {
         $type=SGet('type');
        switch ($type){
            case 0:
                $this->title = "成长课堂标签";
                break;
            case 1:
                $this->title = "教育风向标签";
                break;
            case 2:
                $this->title = "课程体系标签";
                break;
            case 3:
                $this->title = "文章标签";
                break;
            case 4:
                $this->title = "产品标签";
                break;   
        }
        parent::__construct($tplkey, $modelname);
    }
    public function indexAction() {
        $this->doact("*");
        $getid = SGet('id');
        $type = SGet('type');
        if($getid > 0){
            $id = $getid;
            $rows = DB::getlist("select * from @pf_tag where pid=? and id = ? and `type`=? order by sort desc",array(0,$id,$type));
        }else{
            $rows = DB::getlist("select * from @pf_tag where pid=? and `type`=? order by sort desc",array(0,$type));
        }//ysq
        
        $arr = array();
        foreach ($rows as $key => $value) {
            $value['title'] = '<b>' . $value['title'] . '</b>';
            $value['no'] = 1;
            $value['create'] = 1;
            $arr[] = $value;
            $rowss = DB::getlist("select * from @pf_tag where pid=?  order by sort asc", array($value['id']));
            foreach ($rowss as $k => $v) {
                $v['title'] = '+--- <span class="blu">' . $v['title'] . '</span>';
                $v['create'] = 0;
                $v['no'] = 0;
                $arr[] = $v;
            }
        }
        $this->assign('id',$id);
        $this->assign('type',$type);
        $this->assign('title',$this->title);
        $this->assign("rows", $arr);
        $this->assign("sch", $this->sch);
        $this->displayList();
    }
    public function addGetAction() {
        $model = Model($this->ModelName,Model::MODEL_ADD);
        $model->title=$this->title;
        if(SGet('type') != 2 || SGet('pid') > 0){
            $model->Fields['img']->close=true;
        }
        $this->setModel($model);
        $this->displayModel($model);
    }
    public function editGetAction() {
         $model = Model($this->ModelName, Model::MODEL_EDIT);
         $this->setModel($model);
         $model->title = $this->title;
         $model->action = 'edit';
         $row = $model->getone($this->id);
         if($row['type'] != 2 || $row['pid'] > 0){
            $model->Fields['img']->close=true;
        }
         $model->setFieldVals($row);
         $this->displayModel($model);
     }
    public function deleteAction() {
        $id = SGet('id');
       if($id){
           DB::delete('@pf_tag',"where id =? or pid = ?",[$id,$id]);
           $this->success();
           return;
       }
       $this->error('当前标签不存在');
    }

}
