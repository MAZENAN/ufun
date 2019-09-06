<?php /* Smarty version Smarty-3.1.19, created on 2019-07-08 08:52:23
         compiled from ".\Apps\Admin\views\layout\channel_camp_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15785d2293c74abf23-73955490%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '407550bffaadc4f0d41d322418b065aa2a8c89b7' => 
    array (
      0 => '.\\Apps\\Admin\\views\\layout\\channel_camp_list.tpl',
      1 => 1491472336,
      2 => 'file',
    ),
    '4b0c8ba3e57f0c60af6144fd304396960b2ce574' => 
    array (
      0 => 'E:\\WWW\\waimai\\Web\\samao\\tpls\\model_list.tpl',
      1 => 1491473406,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15785d2293c74abf23-73955490',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'rows' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5d2293c7551890_56311129',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d2293c7551890_56311129')) {function content_5d2293c7551890_56311129($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_sortopt')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\modifier.sortopt.php';
if (!is_callable('smarty_function_pagebar')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\function.pagebar.php';
?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>频道_产品列表</title>
<link href="/public/samaores/css/form.plane.css" rel="stylesheet" type="text/css" />
<link href="/public/samaores/css/list.plane.css" rel="stylesheet" type="text/css" />


<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.topdialog.js"></script>


<!--samao model script-->
</head>
<body>
<div class="tablebox listbox margintop">
<div class="smbox-list-title">频道_产品列表 <span id="inputbox_loading" style="display:none">正在提交中...</span></div>
<div class="smbox-list-content">


<div class="smbox-list-toptab">
<a class="samao-link-btn samao-link-btn-refresh" href="javascript:window.location.reload()">刷新</a>&nbsp;&nbsp;&nbsp;&nbsp;
<a dialog="1" class="samao-link-btn samao-link-btn-add" href="/admin/channel_camp/addCamp?id=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">新增</a>&nbsp;&nbsp;&nbsp;&nbsp;
<a class="samao-link-btn samao-link-btn-back" href="/admin/channel">返回</a>&nbsp;&nbsp;&nbsp;&nbsp;
</div>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="smbox-list-table" id="smbox-list-table">
<tr>

<th width="80">ID</th>
<th width="180">产品名称</th>
<th width="150">权重排序</th>
<th width="80">状态</th>
<th width="100">操作</th>

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
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['camp_id'];?>
</td>
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['title'];?>
</td>
<td align="center"><?php echo smarty_modifier_sortopt($_smarty_tpl->tpl_vars['rs']->value['sort'],$_smarty_tpl->tpl_vars['rs']->value['id'],1);?>
</td>
<td align="center"><?php echo ($_smarty_tpl->tpl_vars['rs']->value['allow']==1?'<img src="/public/samaores/images/yes.gif" />':'<img src="/public/samaores/images/no.gif" />');?>
</td>
<td align="center">
<a onclick="return confirm('确定要删除了吗？');" class="samao-link-minibtn" href="/admin/channel_camp/delete?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
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
