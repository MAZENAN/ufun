<?php /* Smarty version Smarty-3.1.19, created on 2019-05-14 16:47:10
         compiled from ".\Apps\Home\views\campedu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:148895cda808e164cb2-60903331%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7a7d506906f113f9c12f69bcf69cf0741910a361' => 
    array (
      0 => '.\\Apps\\Home\\views\\campedu.tpl',
      1 => 1491472322,
      2 => 'file',
    ),
    '5b38e535b597905f89b97c3ca16adbb4cea8105d' => 
    array (
      0 => '.\\Apps\\Home\\views\\libs\\layout.tpl',
      1 => 1491472323,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '148895cda808e164cb2-60903331',
  'function' => 
  array (
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
  'unifunc' => 'content_5cda808e1d56e1_20522280',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5cda808e1d56e1_20522280')) {function content_5cda808e1d56e1_20522280($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_minimg')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\modifier.minimg.php';
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


    <div class="wrap">
  <div class="homain-tit"><div class="homain-tit-box"><span><img src="/public/images/homain-tit4.png" /></span>营地教育</div></div>
  
  <div class="camp">
    <ul>
    <?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['rows']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
?>
      <li>
        <div class="camp-box">
          <div class="camp-img"><a href="/campedu-<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
.html"><img src="<?php echo smarty_modifier_minimg($_smarty_tpl->tpl_vars['rs']->value['img'],240,150,1);?>
" /></a></div>
          <div class="camp-con">
            <h1><a href="/campedu-<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
.html"><?php echo $_smarty_tpl->tpl_vars['rs']->value['title'];?>
</a></h1>
            <h2><?php echo $_smarty_tpl->tpl_vars['rs']->value['add_time'];?>
</h2>
            <div><?php echo $_smarty_tpl->tpl_vars['rs']->value['intro'];?>
</div>
            <h3><a href="/campedu-<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
.html"><span>查看详细</span></a></h3>
          </div>
          <div class="clear"></div>
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
