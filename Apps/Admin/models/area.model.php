<?php

if (!defined('SAMAO_VERSION'))
    exit('no direct access allowed');

class AreaModel extends SmcmsModel {

    public function __construct($modeltype = self::MODEL_ADD) {

        $this->tbname = 'area';
        $this->type = 1;
        $this->title = $modeltype == Model::MODEL_EDIT ? '编辑系统菜单' : '添加地区分类';
        $this->toptip = '添加系统菜单项';
        $this->script = '$(function(){
var selectfun=function(){
   var text=$(\'#pid option:selected\').text();
   var val=$(\'#pid\').val();
   if(text.substr(0,4)==\'+---\'){
      $(\'#row_show\').hide();
      $(\'#row_url\').show();
   }
   else{
       if(val==0){
        $(\'#row_show\').hide();
       }else{
           $(\'#row_show\').show();
       }
      $(\'#row_url\').hide();
   }
};
selectfun();
$(\'#pid\').change(selectfun);
});';
        $this->istab = false;
        $this->tabsplit = false;
        $this->basecontroler = 'SmcmsController';
        $this->btns_left = 0;
        parent::__construct($modeltype);
    }

    public function fields() {
        return array(
            'name' => array(
                'label' => '分类名称',
                'label_width' => 200,
                'type' => 'textarea',
                'style' => 'width:400px',
                'tip_back' => '多个添加用,分割',
                'data_val' => array(
                    'required' => true,
                ),
                'placeholder' => '请填写分类名称',
            ),
            'allow' => array(
                'label' => '是否启用',
                'label_width' => 200,
                'type' => 'bool',
                'default' => '1',
            ),
            'pid' => array(
                'label' => '所属上级分类',
                'label_width' => 200,
                'type' => 'hidden',
                'default' => IGet('pid'),
                'row_hide' => true,
                'valtype' => 'int',
            ),
            'sort' => array(
                'label' => '排序',
                'label_width' => 200,
                'type' => 'digits',
                'default' => $this->getNextSort(),
            ),
        );
    }

}
