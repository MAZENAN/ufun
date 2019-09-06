<?php /* Smarty version Smarty-3.1.19, created on 2019-06-16 18:07:39
         compiled from ".\Apps\Admin\views\layout\partner_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:146065d0614ebcee170-13231925%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e7e00d17a633e54f6f0b4dd19abeea4fcb8cb03b' => 
    array (
      0 => '.\\Apps\\Admin\\views\\layout\\partner_list.tpl',
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
  'nocache_hash' => '146065d0614ebcee170-13231925',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'rows' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5d0614ebda13e4_10422903',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d0614ebda13e4_10422903')) {function content_5d0614ebda13e4_10422903($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_sortopt')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\modifier.sortopt.php';
if (!is_callable('smarty_function_pagebar')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\function.pagebar.php';
?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>合作伙伴</title>
<link href="/public/samaores/css/form.plane.css" rel="stylesheet" type="text/css" />
<link href="/public/samaores/css/list.plane.css" rel="stylesheet" type="text/css" />


<!--samao model script-->
</head>
<body>
<div class="tablebox listbox margintop">
<div class="smbox-list-title">合作伙伴 <span id="inputbox_loading" style="display:none">正在提交中...</span></div>
<div class="smbox-list-content">

<div class="smbox-toptags"><a href="?" <?php if (empty($_smarty_tpl->tpl_vars['sch']->value['type'])) {?>class="active"<?php }?>>所有信息</a><a href="?type=1" <?php if ($_smarty_tpl->tpl_vars['sch']->value['type']==1) {?>class="active"<?php }?>>友情链接</a><a href="?type=2" <?php if ($_smarty_tpl->tpl_vars['sch']->value['type']==2) {?>class="active"<?php }?>>合作支持</a></div>


<div class="smbox-list-toptab">
<form method="get">
<a class="samao-link-btn samao-link-btn-add" href="/admin/partner/add">新增链接</a>&nbsp;&nbsp;&nbsp;&nbsp;
<?php echo FormBox::hidden(array('name'=>"type",),$_smarty_tpl->tpl_vars['schmodel']->value);?>&nbsp;&nbsp;
</form>
</div>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="smbox-list-table" id="smbox-list-table">
<tr>

<th width="80">ID</th>
<th width="80">类型</th>
<th>名称</th>
<th width="230">链接地址</th>
<th width="230">排序</th>
<th width="180">操作</th>

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
<td align="center"><?php echo (is_array(1)&&is_array('友情链接') ? ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['rs']->value['type'],1)) && array_key_exists($_tempkey,$_temparr='友情链接')?$_temparr[$_tempkey]:'合作支持') : ($_smarty_tpl->tpl_vars['rs']->value['type']==1?'友情链接':'合作支持'));?>
</td>
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['name'];?>
</td>
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['url'];?>
</td>
<td align="center"><?php echo smarty_modifier_sortopt($_smarty_tpl->tpl_vars['rs']->value['sort'],$_smarty_tpl->tpl_vars['rs']->value['id']);?>
</td>
<td align="center">
<a class="samao-link-minibtn" href="/admin/partner/edit?type=<?php echo $_GET['type'];?>
&id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">编辑</a>
<a onclick="return confirm('确定要删除了吗？');" class="samao-link-minibtn" href="/admin/partner/delete?type=<?php echo $_GET['type'];?>
&id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">删除</a>
</td>
</form>

</tr>
<?php } ?>

</table>

<div class="samao-pagebar"><?php echo smarty_function_pagebar(array('pdata'=>$_smarty_tpl->tpl_vars['bar']->value),$_smarty_tpl);?>
</div>

</div>
<div class="smbox-info-tips">


</div>
</div>

</body>
</html><?php }} ?>
