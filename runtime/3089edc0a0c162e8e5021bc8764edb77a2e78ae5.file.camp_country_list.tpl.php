<?php /* Smarty version Smarty-3.1.19, created on 2019-05-14 11:01:56
         compiled from ".\Apps\Admin\views\layout\camp_country_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:157145cda2fa41c8873-04778547%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3089edc0a0c162e8e5021bc8764edb77a2e78ae5' => 
    array (
      0 => '.\\Apps\\Admin\\views\\layout\\camp_country_list.tpl',
      1 => 1491472341,
      2 => 'file',
    ),
    '4b0c8ba3e57f0c60af6144fd304396960b2ce574' => 
    array (
      0 => 'E:\\WWW\\waimai\\Web\\samao\\tpls\\model_list.tpl',
      1 => 1491473406,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '157145cda2fa41c8873-04778547',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'rows' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5cda2fa4262a65_39389357',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5cda2fa4262a65_39389357')) {function content_5cda2fa4262a65_39389357($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_sortopt')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\modifier.sortopt.php';
?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>营地国家</title>
<link href="/public/samaores/css/form.plane.css" rel="stylesheet" type="text/css" />
<link href="/public/samaores/css/list.plane.css" rel="stylesheet" type="text/css" />


<!--samao model script-->
</head>
<body>
<div class="tablebox listbox margintop">
<div class="smbox-list-title">营地国家 <span id="inputbox_loading" style="display:none">正在提交中...</span></div>
<div class="smbox-list-content">


<div class="smbox-list-toptab">
<a class="samao-link-btn samao-link-btn-add" href="/admin/camp_country/add">新增</a>
</div>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="smbox-list-table" id="smbox-list-table">
<tr>

<th width="10%">ID</th>
<th width="35%">类别名称</th>
<th width="40%">排序</th>
<th width="15%">操作</th>

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
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
</td>
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['name'];?>
</td>
<td align="center"><?php echo smarty_modifier_sortopt($_smarty_tpl->tpl_vars['rs']->value['sort'],$_smarty_tpl->tpl_vars['rs']->value['id']);?>
</td>
<td align="center">
<a class="samao-link-minibtn" href="/admin/camp_country/edit?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">编辑</a>
<a class="samao-link-minibtn" href="/admin/camp_country/delete?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
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
