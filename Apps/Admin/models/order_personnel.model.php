<?php if(!defined('SAMAO_VERSION')) exit('no direct access allowed');

class OrderPersonnelModel extends SmcmsModel {
    public function __construct($modeltype = self::MODEL_ADD) {
        
        $this->tbname = 'order_personnel';
        $this->type = 1;
        $this->title = '订单人员';
        $this->istab = false;
        $this->tabsplit = false;
        $this->btns_left = 0;
        parent::__construct($modeltype);
    }
    public function fields() {
        return array(
        'chid' => array (
'label' => '孩子ID',
'label_width' => 200,
'type' => 'digits',
),
'family' => array (
'label' => '是否家人',
'label_width' => 200,
'type' => 'digits',
),
'name' => array (
'label' => '姓名',
'label_width' => 200,
'type' => 'text',
'data_val' => array (
  'required' => true,
),
'data_val_msg' => array (
  'required' => '姓名不能为空',
),
),
'gender' => array (
'label' => '性别',
'label_width' => 200,
'type' => 'radiogroup',
'options' => array (
  0 => 
  array (
    0 => '男',
    1 => '男',
  ),
  1 => 
  array (
    0 => '女',
    1 => '女',
  ),
),
'default' => '男',
),
'birthday' => array (
'label' => '生日',
'label_width' => 200,
'type' => 'datetime',
'data_val' => array (
  'required' => true,
),
'data_val_msg' => array (
  'required' => '生日不能为空',
),
),
'age' => array (
'label' => '年龄',
'label_width' => 200,
'type' => 'digits',
'data_val' => array (
  'required' => true,
  'digits' => true,
),
'data_val_msg' => array (
  'required' => '年龄不能为空',
  'digits' => '年龄必须是整数形式',
),
),
'school' => array (
'label' => '目前所在学校',
'label_width' => 200,
'type' => 'text',
'data_val' => array (
  'required' => true,
),
'data_val_msg' => array (
  'required' => '目前所在学校不能为空',
),
),
'grade' => array (
'label' => '所在年级',
'label_width' => 200,
'type' => 'text',
'data_val' => array (
  'required' => true,
),
'data_val_msg' => array (
  'required' => '所在年级不能为空',
),
),
'area' => array (
'label' => '区域',
'label_width' => 200,
'type' => 'linkage',
'headers' => array (
  0 => '省份/区域',
  1 => '城市/地区',
),
'length' => 2,
'data_url' => '__APPROOT__/account/getarea.html',
'data_val_msg' => array (
  'required' => '区域不能为空',
),
'data_vals' => array (
  0 => 
  array (
    'required' => true,
  ),
  1 => 
  array (
    'required' => true,
  ),
),
'data_val_msgs' => array (
  0 => 
  array (
    'required' => '请选择省份/区域',
  ),
  1 => 
  array (
    'required' => '请选择城市/地区',
  ),
),
),
'address' => array (
'label' => '地址信息',
'label_width' => 200,
'type' => 'text',
'data_val' => array (
  'required' => true,
),
'data_val_msg' => array (
  'required' => '地址信息不能为空',
),
),
'telephone' => array (
'label' => '联系电话',
'label_width' => 200,
'type' => 'text',
),
'email' => array (
'label' => '邮箱',
'label_width' => 200,
'type' => 'text',
),
'oid' => array (
'label' => '订单id',
'label_width' => 200,
'type' => 'digits',
),

        );
    }
}
