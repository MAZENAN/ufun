<?php 
return array (
  'model' => 'Report',
  'search' => 
  array (
    0 => 
    array (
      'name' => 'merchant_id',
      'label' => '商户',
      'boxname' => 'merchant_id',
      'type' => 'select',
      'schtp' => '3',
      'style' => '',
      'css' => '',
      'options' => DB::getopts('@pf_merchant',"id,name"),
    ),
    1 => 
    array (
      'name' => 'settle_time',
      'label' => '开始日期',
      'boxname' => 'settle_time',
      'type' => 'date',
      'schtp' => '9',
      'style' => '',
      'css' => '',
    ),
    2 => 
    array (
      'name' => 'settle_time_to',
      'label' => '截至日期',
      'boxname' => 'settle_time_to',
      'type' => 'date',
      'schtp' => '9',
      'style' => '',
      'css' => '',
    ),

  ),
  'usesql' => '0',
  'sql' => '',
  'sqlargs' => NULL,
  'usingfy' => '1',
  'orderby' => '',
);