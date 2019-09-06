<?php if(!defined('SAMAO_VERSION')) exit('no direct access allowed');

class WxmenuModel extends SmcmsModel {
    public function __construct($modeltype = self::MODEL_ADD) {
        
        $this->tbname = 'wxmenu';
        $this->type = 1;
        $this->title = $modeltype==Model::MODEL_EDIT?'编辑系统菜单':'微信菜单';
        $this->toptip = '添加系统菜单项';
        $this->script = '$(function(){
    var selectfun=function(){
    var text=$(\'#pid option:selected\').text();
    var val=$(\'#pid\').val();
    if(val!=0){
      $(\'#row_show\').hide();
      $(\'#row_url\').show();
    }
    else{
      $(\'#row_show\').show();
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
        'title' => array (
'label' => '菜单标题',
'label_width' => 200,
'type' => 'text',
'data_val' => array (
  'required' => true,
),
),
'allow' => array (
'label' => '是否启用',
'label_width' => 200,
'type' => 'bool',
'default' => '1',
),
'pid' => array (
'label' => '所属上级菜单',
'label_width' => 200,
'type' => 'select',
'options' => array (
  0 => 
  array (
    0 => '0',
    1 => '头部菜单',
  ),
),
),
'show' => array (
'label' => '是否展开',
'label_width' => 200,
'type' => 'bool',
'default' => '1',
'tip_front' => '此项仅设置文件夹',
),
'url' => array (
'label' => '栏目路径',
'label_width' => 200,
'type' => 'text',
),
'sort' => array (
'label' => '排序',
'label_width' => 200,
'type' => 'digits',
),
'remark' => array (
'label' => '备注',
'label_width' => 200,
'type' => 'textarea',
),

        );
    }
}
