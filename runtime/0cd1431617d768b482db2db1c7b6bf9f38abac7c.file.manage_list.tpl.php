<?php /* Smarty version Smarty-3.1.19, created on 2019-07-08 08:42:29
         compiled from ".\Apps\Admin\views\layout\manage_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:195575d2291758bc3a2-24828691%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0cd1431617d768b482db2db1c7b6bf9f38abac7c' => 
    array (
      0 => '.\\Apps\\Admin\\views\\layout\\manage_list.tpl',
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
  'nocache_hash' => '195575d2291758bc3a2-24828691',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'rows' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5d2291759421c9_94172676',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d2291759421c9_94172676')) {function content_5d2291759421c9_94172676($_smarty_tpl) {?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理员列表</title>
<link href="/public/samaores/css/form.plane.css" rel="stylesheet" type="text/css" />
<link href="/public/samaores/css/list.plane.css" rel="stylesheet" type="text/css" />


<!--samao model script-->
</head>
<body>
<div class="tablebox listbox margintop">
<div class="smbox-list-title">管理员列表 <span id="inputbox_loading" style="display:none">正在提交中...</span></div>
<div class="smbox-list-content">


<div class="smbox-list-toptab">
<a href="/admin/manage/add" class="samao-link-btn samao-link-btn-add">新增管理员</a>
</div>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="smbox-list-table" id="smbox-list-table">
<tr>

<th width="60">ID</th>
<th width="120">用户名</th>
<th width="120">管理员类型</th>
<th width="150">最后登录时间</th>
<th width="150">最后一次登录IP</th>
<th width="150">管理员邮箱</th>
<th width="120">是否锁定账号</th>
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

<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['rs']->value['name'];?>
</td>
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['manage_name'];?>
</td>
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['lasttime'];?>
</td>
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['lastip'];?>
</td>
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['email'];?>
</td>
<td align="center"><?php echo (is_array(1)&&is_array('锁定') ? ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['rs']->value['islock'],1)) && array_key_exists($_tempkey,$_temparr='锁定')?$_temparr[$_tempkey]:'正常') : ($_smarty_tpl->tpl_vars['rs']->value['islock']==1?'锁定':'正常'));?>
</td>
<td align="center">
<a href="/admin/manage/edit?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">编辑</a><?php if ($_smarty_tpl->tpl_vars['rs']->value['id']!=1) {?> | <a onclick="return confirm('确定要删除吗？一旦删除将无法恢复，请谨慎操作！');" href="/admin/manage/delete?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">删除</a><?php }?>
</td>

</tr>
<?php } ?>

</table>

</div>
<div class="smbox-info-tips">


</div>
</div>

</body>
</html><?php }} ?>
