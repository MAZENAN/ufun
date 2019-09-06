<?php /* Smarty version Smarty-3.1.19, created on 2019-07-08 19:32:25
         compiled from ".\Apps\Admin\views\layout\notice_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:178565d2329c9d6b113-89000539%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '83d1c19070cd1025e8c602d3c03adcc274fb3e0a' => 
    array (
      0 => '.\\Apps\\Admin\\views\\layout\\notice_list.tpl',
      1 => 1561107355,
      2 => 'file',
    ),
    '4b0c8ba3e57f0c60af6144fd304396960b2ce574' => 
    array (
      0 => 'E:\\WWW\\waimai\\Web\\samao\\tpls\\model_list.tpl',
      1 => 1491473406,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '178565d2329c9d6b113-89000539',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'rows' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5d2329c9e13850_75593178',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d2329c9e13850_75593178')) {function content_5d2329c9e13850_75593178($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_truncate')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\libs\\plugins\\modifier.truncate.php';
if (!is_callable('smarty_modifier_sortopt')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\modifier.sortopt.php';
if (!is_callable('smarty_function_pagebar')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\function.pagebar.php';
?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>小程序公告</title>
<link href="/public/samaores/css/form.plane.css" rel="stylesheet" type="text/css" />
<link href="/public/samaores/css/list.plane.css" rel="stylesheet" type="text/css" />


<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.topdialog.js"></script>

<!--samao model script-->
</head>
<body>
<div class="tablebox listbox margintop">
<div class="smbox-list-title">小程序公告 <span id="inputbox_loading" style="display:none">正在提交中...</span></div>
<div class="smbox-list-content">


<div class="smbox-list-toptab">
    <form method="get" id="target-form">
        <a class="samao-link-btn samao-link-btn-add" href="/admin/notice/add?type=<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
&merchant_id=<?php echo $_smarty_tpl->tpl_vars['merchantId']->value;?>
&school_id=<?php echo $_smarty_tpl->tpl_vars['schoolId']->value;?>
">新增</a>&nbsp;&nbsp;&nbsp;&nbsp;
    </form>
</div>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="smbox-list-table" id="smbox-list-table">
<tr>

<th width="8%">ID</th>
<?php if ($_smarty_tpl->tpl_vars['type']->value==0) {?>
<th width="10%">公告名</th>
<?php } elseif ($_smarty_tpl->tpl_vars['type']->value==1) {?>
<th width="10%">公告内容</th>
<?php }?>
<th width="5%">是否启用</th>
<th width="5%">排序</th>
<th width="10%">操作</th>

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
<?php if ($_smarty_tpl->tpl_vars['type']->value==0) {?>
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['title'];?>
</td>
<?php } elseif ($_smarty_tpl->tpl_vars['type']->value==1) {?>
<td align="center"><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['rs']->value['content'],15,'..',true,true);?>
</td>
<?php }?>
<td align="center"><?php echo ($_smarty_tpl->tpl_vars['rs']->value['allow']==1?'<img src="/public/samaores/images/yes.gif" />':'<img src="/public/samaores/images/no.gif" />');?>
</td>
<td align="center"><?php echo smarty_modifier_sortopt($_smarty_tpl->tpl_vars['rs']->value['sort'],$_smarty_tpl->tpl_vars['rs']->value['id']);?>
</td>

<td align="center">
    <a class="samao-link-minibtn" href="/admin/notice/edit?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
&type=<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
">编辑</a>
    <a onclick="return confirm('确定要删除吗？一旦删除将无法恢复，请谨慎操作！');" class="samao-link-minibtn" href="/admin/notice/delete?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
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
