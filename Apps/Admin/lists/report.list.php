<?php 
return array (
  'model' => 'Report',
  'search' => 
  array (
    0 => 
    array (
      'name' => 'manage_id',
      'label' => '课程顾问',
      'boxname' => 'manage_id',
      'type' => 'select',
      'schtp' => '3',
      'style' => '',
      'css' => '',
      'options' => DB::getopts('@pf_manage',"id,name",0,"type in (7,12,13)"),
    ),
    1 => 
    array (
      'name' => 'crm_time',
      'label' => '开始日期',
      'boxname' => 'crm_time',
      'type' => 'date',
      'schtp' => '9',
      'style' => '',
      'css' => '',
    ),
    2 => 
    array (
      'name' => 'crm_time_to',
      'label' => '截至日期',
      'boxname' => 'crm_time_to',
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