<?php /* Smarty version Smarty-3.1.19, created on 2019-07-08 10:10:02
         compiled from ".\Apps\Admin\views\layout\msg_list_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:168755d22a5faceb1c4-89614222%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd4210762c7cc045c69028e53c2df64ef32c92f2f' => 
    array (
      0 => '.\\Apps\\Admin\\views\\layout\\msg_list_list.tpl',
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
  'nocache_hash' => '168755d22a5faceb1c4-89614222',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'rows' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5d22a5fad79d00_21195962',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d22a5fad79d00_21195962')) {function content_5d22a5fad79d00_21195962($_smarty_tpl) {?><?php if (!is_callable('smarty_function_pagebar')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\function.pagebar.php';
?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>发送短消息</title>
<link href="/public/samaores/css/form.plane.css" rel="stylesheet" type="text/css" />
<link href="/public/samaores/css/list.plane.css" rel="stylesheet" type="text/css" />


<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.forlist.js"></script>

<!--samao model script-->
</head>
<body>
<div class="tablebox listbox margintop">
<div class="smbox-list-title">发送短消息 <span id="inputbox_loading" style="display:none">正在提交中...</span></div>
<div class="smbox-list-content">


<div class="smbox-list-toptab">
<a class="samao-link-btn samao-link-btn-add" href="/admin/msg_list/add">新增</a>
</div>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="smbox-list-table" id="smbox-list-table">
<tr>

<th width="60">选择</th>
<th>标题</th>
<th width="80">消息类型</th>
<th width="180">添加时间</th>
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

<td align="center"><input type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
" class="checkitem" /></td>
<td><?php echo $_smarty_tpl->tpl_vars['rs']->value['title'];?>
</td>
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['type'];?>
</td>
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['addtime'];?>
</td>
<td align="center">
<a class="samao-link-minibtn" href="/admin/msg_list/edit?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">编辑</a>
<a onclick="return confirm('确定要删除该信息了吗？');" class="samao-link-minibtn" href="/admin/msg_list/delete?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">删除</a>
</td>

</tr>
<?php } ?>

<tr style="background-color:#F1F1F1">
<td align="center">
<input type="checkbox" id="checkall" />

</td>
<td>全选/撤销 &nbsp;&nbsp; <span id="allopts">
<a  class="samao-link-btn optbtn" href="/admin/msg_list/selected_delete?ids=[ids]">删除选择</a>
</span></td>
<td></td>
<td></td>
<td></td>
</tr>

</table>

<div class="samao-pagebar"><?php echo smarty_function_pagebar(array('pdata'=>$_smarty_tpl->tpl_vars['bar']->value),$_smarty_tpl);?>
</div>

</div>
<div class="smbox-info-tips">


</div>
</div>

</body>
</html><?php }} ?>
