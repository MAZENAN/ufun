<?php /* Smarty version Smarty-3.1.19, created on 2019-05-14 16:47:05
         compiled from ".\Apps\Home\views\glcamp.tpl" */ ?>
<?php /*%%SmartyHeaderCode:242315cda80894e1982-14227664%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a203f06b5389ec749131bee0f7c8c6353f4d4cf3' => 
    array (
      0 => '.\\Apps\\Home\\views\\glcamp.tpl',
      1 => 1491472327,
      2 => 'file',
    ),
    '5b38e535b597905f89b97c3ca16adbb4cea8105d' => 
    array (
      0 => '.\\Apps\\Home\\views\\libs\\layout.tpl',
      1 => 1491472323,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '242315cda80894e1982-14227664',
  'function' => 
  array (
    'seachbar' => 
    array (
      'parameter' => 
      array (
        'title' => '',
        'keyname' => 'test',
        'tbname' => '',
      ),
      'compiled' => '',
    ),
    'dest_seachbar' => 
    array (
      'parameter' => 
      array (
        'title' => '',
        'keyname' => 'test',
        'tbname' => '',
      ),
      'compiled' => '',
    ),
  ),
  'variables' => 
  array (
    'config' => 0,
    'rs' => 0,
    'title' => 0,
    'Description' => 0,
    'Keywords' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5cda8089617366_82022534',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5cda8089617366_82022534')) {function content_5cda8089617366_82022534($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_minimg')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\modifier.minimg.php';
if (!is_callable('smarty_function_pagebar')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\function.pagebar.php';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php if (Route::get('ctl')=='index') {?> <?php echo $_smarty_tpl->tpl_vars['config']->value['website_name'];?>
丨找夏令营，上营天下！ <?php } else { ?> <?php if ($_smarty_tpl->tpl_vars['rs']->value['title']) {?><?php echo $_smarty_tpl->tpl_vars['rs']->value['title'];?>
丨<?php } elseif ($_smarty_tpl->tpl_vars['title']->value) {?><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
丨<?php }?><?php echo $_smarty_tpl->tpl_vars['config']->value['website_name'];?>
 <?php }?></title>
<meta name="description" content="<?php echo $_smarty_tpl->tpl_vars['Description']->value;?>
">
<meta name="keywords"  content="<?php echo $_smarty_tpl->tpl_vars['Keywords']->value;?>
">
<link href="/public/css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/public/js/jquery.min.js"></script>
<script type="text/javascript" src="/public/js/jquery.jslides.js"></script>
<script type="text/javascript" src="/public/js/simplefoucs.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.validate.js"></script>
<link rel="shortcut icon" href="/public/images/favicon.ico" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
<meta property="qc:admins" content="22423175776513150636" />
<meta property="wb:webmaster" content="f62972e62973a159" />
<meta property="qc:admins" content="36065775766513150636747716711154060454" />
<meta property="qc:admins" content="36065777121506367" />

<script>
    $(function(){
            $('.price-select').on('change',function(){
                var that=$(this);
                var bid=that.data('bindid');
                var pem=$('#'+bid);
                var val=that.val();
                if(val){
                    pem.html('<b>￥'+val+'</b>元');
                }
                else{
                    pem.html('<b>&nbsp;&nbsp;--&nbsp;&nbsp;</b>');
                }
            });
    });
</script>

</head>
<body>
<?php echo $_smarty_tpl->getSubTemplate ("libs/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div class="top">
  <div class="top-box">
    <div class="logo"><a href="index.html" title="营天下丨找夏令营，上营天下！"><img src="/public/images/logo.png" width="191" alt="营天下丨找夏令营，上营天下！" /></a></div>
    <?php echo $_smarty_tpl->getSubTemplate ("libs/inc_search.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    <div class="clear"></div>
  </div>
</div>

<div class="menu">
  <ul>
    <li><a href="/index.html"<?php if (Route::get('ctl')=='index') {?> class="on"<?php }?>>首页</a></li>
    <li><a href="/cncamp.html"<?php if (Route::get('ctl')=='cncamp') {?> class="on"<?php }?>>国内营</a></li>
    <li><a href="/glcamp.html"<?php if (Route::get('ctl')=='glcamp') {?> class="on"<?php }?>>国际营</a></li>
    <li><a href="/campedu.html"<?php if (Route::get('ctl')=='campedu') {?> class="on"<?php }?>>营地教育</a></li>
  </ul>
</div>


<?php if (!function_exists('smarty_template_function_seachbar')) {
    function smarty_template_function_seachbar($_smarty_tpl,$params) {
    $saved_tpl_vars = $_smarty_tpl->tpl_vars;
    foreach ($_smarty_tpl->smarty->template_functions['seachbar']['parameter'] as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);};
    foreach ($params as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);}?>
    
<div class="filter-list">
        <span style="width: 75px; text-align: right;"><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
：</span>
         <span style=" float: left; width: 1050px;">
        <a href="gs-<?php echo Comm::links($_smarty_tpl->tpl_vars['sch']->value,array($_smarty_tpl->tpl_vars['keyname']->value=>0));?>
" <?php echo (is_array(0)&&is_array('class="on"') ? ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['sch']->value[$_smarty_tpl->tpl_vars['keyname']->value],0)) && array_key_exists($_tempkey,$_temparr='class="on"')?$_temparr[$_tempkey]:'') : ($_smarty_tpl->tpl_vars['sch']->value[$_smarty_tpl->tpl_vars['keyname']->value]==0?'class="on"':''));?>
>不限</a>
        <?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_from = DB::getOpts($_smarty_tpl->tpl_vars['tbname']->value,null,1); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
?>
        <a href="gs-<?php echo Comm::links($_smarty_tpl->tpl_vars['sch']->value,array($_smarty_tpl->tpl_vars['keyname']->value=>$_smarty_tpl->tpl_vars['rs']->value[0]));?>
" <?php echo (is_array($_smarty_tpl->tpl_vars['rs']->value[0])&&is_array('class="on"') ? ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['sch']->value[$_smarty_tpl->tpl_vars['keyname']->value],$_smarty_tpl->tpl_vars['rs']->value[0])) && array_key_exists($_tempkey,$_temparr='class="on"')?$_temparr[$_tempkey]:'') : ($_smarty_tpl->tpl_vars['sch']->value[$_smarty_tpl->tpl_vars['keyname']->value]==$_smarty_tpl->tpl_vars['rs']->value[0]?'class="on"':''));?>
><?php echo $_smarty_tpl->tpl_vars['rs']->value[1];?>
</a>
        <?php } ?>
         </span>

</div>
<?php $_smarty_tpl->tpl_vars = $saved_tpl_vars;
foreach (Smarty::$global_tpl_vars as $key => $value) if(!isset($_smarty_tpl->tpl_vars[$key])) $_smarty_tpl->tpl_vars[$key] = $value;}}?>


<?php if (!function_exists('smarty_template_function_dest_seachbar')) {
    function smarty_template_function_dest_seachbar($_smarty_tpl,$params) {
    $saved_tpl_vars = $_smarty_tpl->tpl_vars;
    foreach ($_smarty_tpl->smarty->template_functions['dest_seachbar']['parameter'] as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);};
    foreach ($params as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);}?>
<div class="clear"></div>
<div class="filter-list">
        <span style="width: 75px; text-align: right;"><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
：</span>
        
        <span style=" float: left; width: 1050px;">
            <a href="gs-<?php echo Comm::links($_smarty_tpl->tpl_vars['sch']->value,array($_smarty_tpl->tpl_vars['keyname']->value=>0));?>
" <?php echo (is_array(0)&&is_array('class="on"') ? ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['sch']->value[$_smarty_tpl->tpl_vars['keyname']->value],0)) && array_key_exists($_tempkey,$_temparr='class="on"')?$_temparr[$_tempkey]:'') : ($_smarty_tpl->tpl_vars['sch']->value[$_smarty_tpl->tpl_vars['keyname']->value]==0?'class="on"':''));?>
>不限</a>
            <?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_from = DB::getOpts($_smarty_tpl->tpl_vars['tbname']->value,'@pf_camp.camp_country,@pf_camp_country.name,@pf_camp_country.sort',1,'@pf_camp.camp_country=@pf_camp_country.id and @pf_camp.allow=1 GROUP BY camp_country'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
?>
            <a href="gs-<?php echo Comm::links($_smarty_tpl->tpl_vars['sch']->value,array($_smarty_tpl->tpl_vars['keyname']->value=>$_smarty_tpl->tpl_vars['rs']->value[0]));?>
" <?php echo (is_array($_smarty_tpl->tpl_vars['rs']->value[0])&&is_array('class="on"') ? ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['sch']->value[$_smarty_tpl->tpl_vars['keyname']->value],$_smarty_tpl->tpl_vars['rs']->value[0])) && array_key_exists($_tempkey,$_temparr='class="on"')?$_temparr[$_tempkey]:'') : ($_smarty_tpl->tpl_vars['sch']->value[$_smarty_tpl->tpl_vars['keyname']->value]==$_smarty_tpl->tpl_vars['rs']->value[0]?'class="on"':''));?>
><?php echo $_smarty_tpl->tpl_vars['rs']->value[1];?>
</a>
            <?php } ?>
            
        </span>
</div>
<?php $_smarty_tpl->tpl_vars = $saved_tpl_vars;
foreach (Smarty::$global_tpl_vars as $key => $value) if(!isset($_smarty_tpl->tpl_vars[$key])) $_smarty_tpl->tpl_vars[$key] = $value;}}?>


<div class="wrap">

  <div class="filter">
    <div class="filter-box">
    <?php smarty_template_function_dest_seachbar($_smarty_tpl,array('title'=>'所在国家','keyname'=>'camp_country','tbname'=>'@pf_camp,@pf_camp_country'));?>

    <?php smarty_template_function_seachbar($_smarty_tpl,array('title'=>'项目主题','keyname'=>'camp_category','tbname'=>'@pf_camp_category'));?>

     <!--<?php smarty_template_function_seachbar($_smarty_tpl,array('title'=>'适合年龄','keyname'=>'camp_age','tbname'=>'@pf_camp_age'));?>
-->
     <div class="clear"></div>
     <div class="filter-list">
        <span style="width: 75px; text-align: right;">适合年龄：</span>
        <span style=" float: left; width: 1050px;">
        <a href="gs-<?php echo Comm::links($_smarty_tpl->tpl_vars['sch']->value,array('agefrom'=>0));?>
" <?php echo (is_array(0)&&is_array('class="on"') ? ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['sch']->value['agefrom'],0)) && array_key_exists($_tempkey,$_temparr='class="on"')?$_temparr[$_tempkey]:'') : ($_smarty_tpl->tpl_vars['sch']->value['agefrom']==0?'class="on"':''));?>
>不限</a>
        <a href="gs-<?php echo Comm::links($_smarty_tpl->tpl_vars['sch']->value,array('agefrom'=>1));?>
" <?php echo (is_array(1)&&is_array('class="on"') ? ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['sch']->value['agefrom'],1)) && array_key_exists($_tempkey,$_temparr='class="on"')?$_temparr[$_tempkey]:'') : ($_smarty_tpl->tpl_vars['sch']->value['agefrom']==1?'class="on"':''));?>
>4~6岁</a>
	<a href="gs-<?php echo Comm::links($_smarty_tpl->tpl_vars['sch']->value,array('agefrom'=>2));?>
" <?php echo (is_array(2)&&is_array('class="on"') ? ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['sch']->value['agefrom'],2)) && array_key_exists($_tempkey,$_temparr='class="on"')?$_temparr[$_tempkey]:'') : ($_smarty_tpl->tpl_vars['sch']->value['agefrom']==2?'class="on"':''));?>
>7~12岁</a>
        <a href="gs-<?php echo Comm::links($_smarty_tpl->tpl_vars['sch']->value,array('agefrom'=>3));?>
" <?php echo (is_array(3)&&is_array('class="on"') ? ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['sch']->value['agefrom'],3)) && array_key_exists($_tempkey,$_temparr='class="on"')?$_temparr[$_tempkey]:'') : ($_smarty_tpl->tpl_vars['sch']->value['agefrom']==3?'class="on"':''));?>
>12~18岁</a>
      
</div>
    

       <div class="filter-list">
        <span style="width: 75px; text-align: right;">项目类型：</span>
        <span style=" float: left; width: 1050px;">
        <a href="gs-<?php echo Comm::links($_smarty_tpl->tpl_vars['sch']->value,array('boarding'=>0));?>
" <?php echo (is_array(0)&&is_array('class="on"') ? ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['sch']->value['boarding'],0)) && array_key_exists($_tempkey,$_temparr='class="on"')?$_temparr[$_tempkey]:'') : ($_smarty_tpl->tpl_vars['sch']->value['boarding']==0?'class="on"':''));?>
>不限</a>
        <a href="gs-<?php echo Comm::links($_smarty_tpl->tpl_vars['sch']->value,array('boarding'=>1));?>
" <?php echo (is_array(1)&&is_array('class="on"') ? ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['sch']->value['boarding'],1)) && array_key_exists($_tempkey,$_temparr='class="on"')?$_temparr[$_tempkey]:'') : ($_smarty_tpl->tpl_vars['sch']->value['boarding']==1?'class="on"':''));?>
>日营</a>
        <a href="gs-<?php echo Comm::links($_smarty_tpl->tpl_vars['sch']->value,array('boarding'=>2));?>
" <?php echo (is_array(2)&&is_array('class="on"') ? ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['sch']->value['boarding'],2)) && array_key_exists($_tempkey,$_temparr='class="on"')?$_temparr[$_tempkey]:'') : ($_smarty_tpl->tpl_vars['sch']->value['boarding']==2?'class="on"':''));?>
>寄宿营</a>
        <a href="gs-<?php echo Comm::links($_smarty_tpl->tpl_vars['sch']->value,array('boarding'=>3));?>
" <?php echo (is_array(3)&&is_array('class="on"') ? ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['sch']->value['boarding'],3)) && array_key_exists($_tempkey,$_temparr='class="on"')?$_temparr[$_tempkey]:'') : ($_smarty_tpl->tpl_vars['sch']->value['boarding']==3?'class="on"':''));?>
>游学</a>

        </span>
  </div>


 <div class="filter-list">
        <span>关键字查找：</span>
        <div class="formbox">
        <form method="get" action="gs-<?php echo Comm::links($_smarty_tpl->tpl_vars['sch']->value,array(),false);?>
">
        <input type="text" placeholder="请输入您的关键字" value="<?php echo SGet('keyword');?>
"  name="keyword" class="inp" /><input type="submit" value="查找" class="btn" />
        </form>
        </div>
    </div>
    <?php smarty_template_function_seachbar($_smarty_tpl,array('title'=>'是否亲子','keyname'=>'camp_type','tbname'=>'@pf_camp_type'));?>

    </div>
    <div class="filter-btn"><span></span></div>
  </div>
  
  <div class="dosearch"><span><a>正在搜索</a></span><?php echo $_smarty_tpl->tpl_vars['schtext']->value;?>
</div>
  <div class="sort">
  
    
    <a href="gs-<?php echo Comm::links($_smarty_tpl->tpl_vars['sch']->value,array('order'=>0));?>
" class="on">综合排序</a>
    <?php if ($_smarty_tpl->tpl_vars['sch']->value['order']==1) {?>
    <a href="gs-<?php echo Comm::links($_smarty_tpl->tpl_vars['sch']->value,array('order'=>2));?>
"><span class="up">出发日期</span></a>
    <?php } elseif ($_smarty_tpl->tpl_vars['sch']->value['order']==2) {?>
    <a href="gs-<?php echo Comm::links($_smarty_tpl->tpl_vars['sch']->value,array('order'=>1));?>
"><span class="up">出发日期</span></a>
    <?php } else { ?>
    <a href="gs-<?php echo Comm::links($_smarty_tpl->tpl_vars['sch']->value,array('order'=>1));?>
"><span class="null">出发日期</span></a>
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['sch']->value['order']==3) {?>
    <a href="gs-<?php echo Comm::links($_smarty_tpl->tpl_vars['sch']->value,array('order'=>4));?>
"><span class="up">费用</span></a>
    <?php } elseif ($_smarty_tpl->tpl_vars['sch']->value['order']==4) {?>
    <a href="gs-<?php echo Comm::links($_smarty_tpl->tpl_vars['sch']->value,array('order'=>3));?>
"><span class="down">费用</span></a>  
    <?php } else { ?>
    <a href="gs-<?php echo Comm::links($_smarty_tpl->tpl_vars['sch']->value,array('order'=>3));?>
"><span class="null">费用</span></a>
    <?php }?>
    
  </div>
  
  
  <div class="theme">
    <ul>
    <?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['rows']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
?>
      <li>
        <div class="theme-box">
            <div class="theme-tit"><a href="/glcamp-<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
.html" target="_blank"><?php echo $_smarty_tpl->tpl_vars['rs']->value['title'];?>
<?php if ($_smarty_tpl->tpl_vars['rs']->value['has']==0) {?>(已截止)<?php }?></a></div>
          <div class="theme-main">
            <div class="theme-img"><a href="/glcamp-<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
.html" target="_blank"><img src="<?php echo smarty_modifier_minimg($_smarty_tpl->tpl_vars['rs']->value['cover'],310,230,1);?>
" /></a></div>
            <div class="theme-con">
              <div class="theme-con-head">
                <ul>
                  <li>项目地点：<?php echo $_smarty_tpl->tpl_vars['rs']->value['camp_location'];?>
</li>
                 
                  <li>适合年龄：<span class="orange"><?php if ($_smarty_tpl->tpl_vars['rs']->value['agefrom']==$_smarty_tpl->tpl_vars['rs']->value['ageto']) {?><?php echo $_smarty_tpl->tpl_vars['rs']->value['agefrom'];?>
<?php } else { ?><?php echo $_smarty_tpl->tpl_vars['rs']->value['agefrom'];?>
-<?php echo $_smarty_tpl->tpl_vars['rs']->value['ageto'];?>
<?php }?> </span>岁&nbsp;&nbsp;</li>
                 
                  <li>项目类型：<?php echo ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['rs']->value['boarding'],array('0','1','2'))) && array_key_exists($_tempkey,$_temparr=array('日营','寄宿营','游学'))?$_temparr[$_tempkey]:'');?>
 </li>
                  <li><span class="tit">出发日期：</span>
                   <select class="price-select" data-bindid="price_<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">
                    <?php if ($_smarty_tpl->tpl_vars['rs']->value['ncost']==0) {?><option value="">暂无可选行程时间</option><?php }?>
                   <?php $_smarty_tpl->tpl_vars['select'] = new Smarty_variable(true, null, 0);?>
                   <?php  $_smarty_tpl->tpl_vars['drs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['drs']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['rs']->value['times']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['drs']->key => $_smarty_tpl->tpl_vars['drs']->value) {
$_smarty_tpl->tpl_vars['drs']->_loop = true;
?>
                  <option value="<?php echo $_smarty_tpl->tpl_vars['drs']->value['cost'];?>
"<?php if ($_smarty_tpl->tpl_vars['drs']->value['cost']==$_smarty_tpl->tpl_vars['rs']->value['ncost']&&$_smarty_tpl->tpl_vars['select']->value==true&&$_smarty_tpl->tpl_vars['drs']->value['allow']==2) {?><?php $_smarty_tpl->tpl_vars['select'] = new Smarty_variable(false, null, 0);?>selected<?php }?>><?php echo Comm::formatCampDate($_smarty_tpl->tpl_vars['drs']->value);?>
<?php if ($_smarty_tpl->tpl_vars['drs']->value['allow']==0) {?>(已截止)<?php }?><?php if ($_smarty_tpl->tpl_vars['drs']->value['allow']==1) {?>(未开始)<?php }?></option>
                  <?php }
if (!$_smarty_tpl->tpl_vars['drs']->_loop) {
?>
                  <option value="">暂未安排行程时间</option>
                  <?php } ?>
                  </select></li>
                  <li>报名截止日期：<?php echo $_smarty_tpl->tpl_vars['rs']->value['deadline'];?>
</li>
               
                  <li><!-- 适合年龄：<span class="orange"><?php echo $_smarty_tpl->tpl_vars['rs']->value['agefrom'];?>
-<?php echo $_smarty_tpl->tpl_vars['rs']->value['ageto'];?>
</span> 岁&nbsp;&nbsp; --></li>
                
                 
                    <li>是否亲子：<?php echo DB::getval('@pf_camp_type','name',$_smarty_tpl->tpl_vars['rs']->value['camp_type']);?>
 </li>
                  <div class="clear"></div>
                </ul>
              </div>
              <div class="theme-con-foot">
              

                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="left" valign="middle">
                      <h1>项目特色</h1>
                      
                      <?php  $_smarty_tpl->tpl_vars['pt'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['pt']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['rs']->value['features']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['pt']->key => $_smarty_tpl->tpl_vars['pt']->value) {
$_smarty_tpl->tpl_vars['pt']->_loop = true;
?>
                      <?php if (trim($_smarty_tpl->tpl_vars['pt']->value)!='') {?>
                        <p><?php echo $_smarty_tpl->tpl_vars['pt']->value;?>
</p>
                      <?php }?>
					<?php } ?>
                      
                      
                    </td>
                    <td width="190" align="center" valign="middle"><span id="price_<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
"><?php if ($_smarty_tpl->tpl_vars['rs']->value['ncost']) {?><b>￥<?php echo $_smarty_tpl->tpl_vars['rs']->value['ncost'];?>
</b>元<?php } else { ?><b>&nbsp;&nbsp;--&nbsp;&nbsp;</b><?php }?></span></td>
                    <td width="190" align="center" valign="middle"><a href="/glcamp-<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
.html"  target="_blank">查看详细</a></td>
                  </tr>
                </table>

              </div>
            </div>
            <div class="clear"></div>
          </div>
        </div>
      </li>
    <?php } ?>
    </ul>
  </div>
  
  
  <div class="samao-pagebar"><?php echo smarty_function_pagebar(array('pdata'=>$_smarty_tpl->tpl_vars['bar']->value),$_smarty_tpl);?>
</div>

  
  

</div>


<?php echo $_smarty_tpl->getSubTemplate ("libs/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<script src="/public/js/myweb.js" type="text/javascript"></script>
</body>
</html>
<?php }} ?>
