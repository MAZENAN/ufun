<?php /* Smarty version Smarty-3.1.19, created on 2019-05-14 16:46:23
         compiled from ".\Apps\Home\views\campedu_detail.tpl" */ ?>
<?php /*%%SmartyHeaderCode:127645cda805f1ee184-63978741%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c6c884d542d374edf644c8ebdaa38368f8e88235' => 
    array (
      0 => '.\\Apps\\Home\\views\\campedu_detail.tpl',
      1 => 1491472325,
      2 => 'file',
    ),
    '5b38e535b597905f89b97c3ca16adbb4cea8105d' => 
    array (
      0 => '.\\Apps\\Home\\views\\libs\\layout.tpl',
      1 => 1491472323,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '127645cda805f1ee184-63978741',
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
  'unifunc' => 'content_5cda805f25a737_44024941',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5cda805f25a737_44024941')) {function content_5cda805f25a737_44024941($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
  
  
  <div class="camp_con">
    <div class="camp_con-tit"><?php echo $_smarty_tpl->tpl_vars['rs']->value['title'];?>
</div>
    <div class="camp_con-note">发布日期：<?php echo $_smarty_tpl->tpl_vars['rs']->value['add_time'];?>
<span>|</span>来源：<?php echo $_smarty_tpl->tpl_vars['rs']->value['source'];?>
　<a href="/campedu.html">[返回]</a></div>
    <div class="camp_con-main">
<?php echo $_smarty_tpl->tpl_vars['rs']->value['content'];?>

    </div>
  </div>
  <div class="con_page">
    <ul>
      <li class="left"><?php if (!empty($_smarty_tpl->tpl_vars['rs']->value['prev'])) {?><a href="/campedu-<?php echo $_smarty_tpl->tpl_vars['rs']->value['prev']['id'];?>
.html" >上一页：<?php echo $_smarty_tpl->tpl_vars['rs']->value['prev']['title'];?>
</a><?php } else { ?>上一页：无<?php }?></li>
      <li class="right"><?php if (!empty($_smarty_tpl->tpl_vars['rs']->value['next'])) {?><a href="/campedu-<?php echo $_smarty_tpl->tpl_vars['rs']->value['next']['id'];?>
.html">下一页：<?php echo $_smarty_tpl->tpl_vars['rs']->value['next']['title'];?>
</a><?php } else { ?>下一页：无<?php }?></li>
    </ul>
  </div>
</div>


<?php echo $_smarty_tpl->getSubTemplate ("libs/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<script src="/public/js/myweb.js" type="text/javascript"></script>
</body>
</html>
<?php }} ?>
