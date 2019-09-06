<?php /* Smarty version Smarty-3.1.19, created on 2019-07-08 08:39:15
         compiled from ".\Apps\Admin\views\layout\area_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:63985d2290b3f0bbf5-50321797%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5469929e124d6e3cff2995f9deb619147ae9b2b6' => 
    array (
      0 => '.\\Apps\\Admin\\views\\layout\\area_list.tpl',
      1 => 1557376968,
      2 => 'file',
    ),
    '4b0c8ba3e57f0c60af6144fd304396960b2ce574' => 
    array (
      0 => 'E:\\WWW\\waimai\\Web\\samao\\tpls\\model_list.tpl',
      1 => 1491473406,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '63985d2290b3f0bbf5-50321797',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'rows' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5d2290b40d5291_44390763',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d2290b40d5291_44390763')) {function content_5d2290b40d5291_44390763($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_sortopt')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\modifier.sortopt.php';
?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>地区分类</title>
<link href="/public/samaores/css/form.plane.css" rel="stylesheet" type="text/css" />
<link href="/public/samaores/css/list.plane.css" rel="stylesheet" type="text/css" />


<!--samao model script-->
</head>
<body>
<div class="tablebox listbox margintop">
<div class="smbox-list-title">地区分类 <span id="inputbox_loading" style="display:none">正在提交中...</span></div>
<div class="smbox-list-content">


<div class="smbox-list-toptab">
<form method="get">
<a class="samao-link-btn samao-link-btn-add" href="/admin/area/add">新增</a><?php if ($_smarty_tpl->tpl_vars['sch']->value['pid']!=0) {?><a class="samao-link-btn" href="/admin/area?pid=0">返回上级</a><?php }?>&nbsp;&nbsp;&nbsp;&nbsp;
<?php echo FormBox::hidden(array('name'=>"pid",),$_smarty_tpl->tpl_vars['schmodel']->value);?>&nbsp;&nbsp;
</form>
</div>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="smbox-list-table" id="smbox-list-table">
<tr>

<th width="33%">分类名称</th>
<th width="33%">排序</th>
<th width="33%">操作</th>

</tr>
<?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_smarty_tpl->tpl_vars['ttl'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['rows']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
 $_smarty_tpl->tpl_vars['ttl']->value = $_smarty_tpl->tpl_vars['rs']->key;
?>
<tr  onmouseover="this.oldBgcolor=this.style.backgroundColor;this.style.backgroundColor='#FCFCF8';" onmouseout="this.style.backgroundColor=this.oldBgcolor">

<form method="post">
<input name="id" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
" />
<input name="action" type="hidden" value="editsort" />
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['name'];?>
</td>
<td align="center"><?php echo smarty_modifier_sortopt($_smarty_tpl->tpl_vars['rs']->value['sort'],$_smarty_tpl->tpl_vars['rs']->value['id']);?>
</td>
<td align="center">
<?php if ($_smarty_tpl->tpl_vars['sch']->value['pid']==0) {?><a class="samao-link-minibtn" href="/admin/area?pid=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">管理子类</a><?php }?>
<?php if ($_smarty_tpl->tpl_vars['sch']->value['pid']==0) {?><a class="samao-link-minibtn" href="/admin/area/add?pid=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">新增子类</a><?php }?>
<a class="samao-link-minibtn" href="/admin/area/edit?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">编辑</a>
<a class="samao-link-minibtn" href="/admin/area/delete?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">删除</a>
</td>
</form>

</tr>
<?php } ?>

</table>

</div>
<div class="smbox-info-tips">


</div>
</div>

</body>
</html><?php }} ?>
