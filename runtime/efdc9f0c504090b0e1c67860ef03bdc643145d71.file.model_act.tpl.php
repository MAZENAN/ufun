<?php /* Smarty version Smarty-3.1.19, created on 2019-09-05 11:33:55
         compiled from "E:\WWW\waimai\Web\samao\tpls\model_act.tpl" */ ?>
<?php /*%%SmartyHeaderCode:174865d7082232a7433-05609478%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'efdc9f0c504090b0e1c67860ef03bdc643145d71' => 
    array (
      0 => 'E:\\WWW\\waimai\\Web\\samao\\tpls\\model_act.tpl',
      1 => 1491473406,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '174865d7082232a7433-05609478',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'model' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5d7082233031a2_40694636',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d7082233031a2_40694636')) {function content_5d7082233031a2_40694636($_smarty_tpl) {?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_smarty_tpl->tpl_vars['model']->value->attrs['title'];?>
</title>
<link rel="stylesheet" type="text/css" href="/public/samaores/css/form.plane.css"/>
<!--samao model css-->
<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.validate.js"></script>
<?php if ($_smarty_tpl->tpl_vars['model']->value->attrs['istab']&&!$_smarty_tpl->tpl_vars['model']->value->attrs['tabsplit']) {?>
<script type="text/javascript" src="/public/samaores/js/samao.model.tabs.js"></script>
<?php }?>
<!--samao model script-->
</head>
<body>
<?php if ($_smarty_tpl->tpl_vars['model']->value->usehtml) {?>
<?php echo $_smarty_tpl->getSubTemplate ("modeltpl:".((string)$_smarty_tpl->tpl_vars['model']->value->name), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php }?>
<?php echo $_smarty_tpl->getSubTemplate ("modelskin:default", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<div class="samao-body">
<?php smarty_template_function_model_title($_smarty_tpl,array('model'=>$_smarty_tpl->tpl_vars['model']->value));?>

<div class="samao-form">
<form method="post">
<?php smarty_template_function_model_tabs($_smarty_tpl,array('model'=>$_smarty_tpl->tpl_vars['model']->value));?>

<?php smarty_template_function_model_toptip($_smarty_tpl,array('model'=>$_smarty_tpl->tpl_vars['model']->value));?>

<?php smarty_template_function_model_form($_smarty_tpl,array('model'=>$_smarty_tpl->tpl_vars['model']->value));?>

<?php smarty_template_function_model_submit($_smarty_tpl,array('model'=>$_smarty_tpl->tpl_vars['model']->value));?>

</form>
</div></div>
</body>
</html>
<?php }} ?>
