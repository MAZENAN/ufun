<?php
$this->assign('title','优惠券');
$host=explode('.',$_SERVER['HTTP_HOST']);
if(in_array('www', $host)){
  $this->assign('url',str_replace("www.","m.",$_SERVER['HTTP_HOST']));
}else{
  $this->assign('url',"m.".$_SERVER['HTTP_HOST']);
}

return array (
  'model' => 'Coupons',
  'search' => 
  array (
    /*0 => 
    array (
      'name' => 'title',
      'label' => '标题',
      'boxname' => 'title',
      'type' => 'text',
      'schtp' => '2',
      'style' => '',
      'css' => '',
    ),*/
 ),   
  'usesql' => '0',
  'sql' => '',
  'sqlargs' => NULL,
  'usingfy' => '1',
  'orderby' => 'id desc',
);
