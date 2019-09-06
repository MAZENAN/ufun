<?php /* Smarty version Smarty-3.1.19, created on 2019-06-10 09:19:14
         compiled from ".\Apps\Admin\views\layout\form_node_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:141315cfdb012e0cb39-40120055%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '350519db3c8f5762d0271d71f43ff0e08412952d' => 
    array (
      0 => '.\\Apps\\Admin\\views\\layout\\form_node_list.tpl',
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
  'nocache_hash' => '141315cfdb012e0cb39-40120055',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'rows' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5cfdb012ebdf45_74941142',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5cfdb012ebdf45_74941142')) {function content_5cfdb012ebdf45_74941142($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_sortopt')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\modifier.sortopt.php';
if (!is_callable('smarty_function_pagebar')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\function.pagebar.php';
?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>报名表节点</title>
<link href="/public/samaores/css/form.plane.css" rel="stylesheet" type="text/css" />
<link href="/public/samaores/css/list.plane.css" rel="stylesheet" type="text/css" />


<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.topdialog.js"></script>

<!--samao model script-->
</head>
<body>
<div class="tablebox listbox margintop">
<div class="smbox-list-title">报名表节点 <span id="inputbox_loading" style="display:none">正在提交中...</span></div>
<div class="smbox-list-content">


<div class="smbox-list-toptab">
<a class="samao-link-btn samao-link-btn-add" href="/admin/form_node/add">新增</a>&nbsp;&nbsp;&nbsp;&nbsp;

<a class="samao-link-btn samao-link-btn-refresh" href="javascript:window.location.reload()">刷新</a>&nbsp;&nbsp;&nbsp;&nbsp;
</div>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="smbox-list-table" id="smbox-list-table">
<tr>


<th width="80">ID</th>
<th width="80">组别</th>
<th width="100">名称</th>
<th width="60">字段英文</th>
<th width="80">类型</th>
<th width="80">预选项</th>
<th width="40">必填</th>
<th width="80">排序</th>
<th width="150">操作</th>

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
<td align="center"><?php echo ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['rs']->value['belong'],array(0,1,2))) && array_key_exists($_tempkey,$_temparr=array('学生信息','家长信息','其他'))?$_temparr[$_tempkey]:'');?>
</td>
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['name'];?>
</td>
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['field'];?>
</td>
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['type'];?>
</td>
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['values'];?>
</td>
<td align="center"><?php echo (is_array(1)&&is_array('是') ? ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['rs']->value['required'],1)) && array_key_exists($_tempkey,$_temparr='是')?$_temparr[$_tempkey]:'否') : ($_smarty_tpl->tpl_vars['rs']->value['required']==1?'是':'否'));?>
</td>
<td align="center"><?php echo smarty_modifier_sortopt($_smarty_tpl->tpl_vars['rs']->value['sort'],$_smarty_tpl->tpl_vars['rs']->value['id'],1);?>
</td>
<td align="center">
	<?php if ($_smarty_tpl->tpl_vars['rs']->value['belong']==2) {?>
<a class="samao-link-minibtn" href="/admin/form_node/edit?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">编辑</a>
<a onclick="return confirm('确定要删除该节点吗？一旦删除将无法恢复，请谨慎操作！');" class="samao-link-minibtn" href="/admin/form_node/delete?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">删除</a><?php }?>
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
