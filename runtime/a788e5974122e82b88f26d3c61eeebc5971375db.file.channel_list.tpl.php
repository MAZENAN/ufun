<?php /* Smarty version Smarty-3.1.19, created on 2019-07-08 08:52:01
         compiled from ".\Apps\Admin\views\layout\channel_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:247205d2293b1ae3bb4-52669612%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a788e5974122e82b88f26d3c61eeebc5971375db' => 
    array (
      0 => '.\\Apps\\Admin\\views\\layout\\channel_list.tpl',
      1 => 1491472337,
      2 => 'file',
    ),
    '4b0c8ba3e57f0c60af6144fd304396960b2ce574' => 
    array (
      0 => 'E:\\WWW\\waimai\\Web\\samao\\tpls\\model_list.tpl',
      1 => 1491473406,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '247205d2293b1ae3bb4-52669612',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'rows' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5d2293b1b9a5b9_68205259',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d2293b1b9a5b9_68205259')) {function content_5d2293b1b9a5b9_68205259($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_minimg')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\modifier.minimg.php';
if (!is_callable('smarty_modifier_sortopt')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\modifier.sortopt.php';
if (!is_callable('smarty_function_pagebar')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\function.pagebar.php';
?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>首页频道</title>
<link href="/public/samaores/css/form.plane.css" rel="stylesheet" type="text/css" />
<link href="/public/samaores/css/list.plane.css" rel="stylesheet" type="text/css" />


<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>

<!--samao model script-->
</head>
<body>
<div class="tablebox listbox margintop">
<div class="smbox-list-title">首页频道 <span id="inputbox_loading" style="display:none">正在提交中...</span></div>
<div class="smbox-list-content">


<div class="smbox-list-toptab">
 <a class="samao-link-btn samao-link-btn-refresh" href="javascript:window.location.reload()">刷新</a>&nbsp;&nbsp;&nbsp;&nbsp;
<a class="samao-link-btn samao-link-btn-add" href="/admin/channel/add">新增</a>&nbsp;&nbsp;&nbsp;&nbsp;
</div>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="smbox-list-table" id="smbox-list-table">
<tr>

<th width="80">ID</th>
<th width="110">频道名称</th>
<th width="110">图标</th>
<th width="180">权重排序</th>
<th width="100">类型</th>
<th width="120">上架时间</th>
<th width="120">下架时间</th>
<th width="80">状态</th>
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
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['name'];?>
</td>
<td align="center"><img src="<?php echo smarty_modifier_minimg($_smarty_tpl->tpl_vars['rs']->value['icon'],0,0,1);?>
" height="50" width="70"/></td>
<td align="center"><?php echo smarty_modifier_sortopt($_smarty_tpl->tpl_vars['rs']->value['sort'],$_smarty_tpl->tpl_vars['rs']->value['id'],1);?>
</td>
<td align="center"><?php echo ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['rs']->value['type'],array(0,1,2))) && array_key_exists($_tempkey,$_temparr=array('专题','关联营期','产品列表'))?$_temparr[$_tempkey]:'');?>
</td>
<td align="center"><?php if ($_smarty_tpl->tpl_vars['rs']->value['uptime']!='0000-00-00 00:00:00') {?><?php echo $_smarty_tpl->tpl_vars['rs']->value['uptime'];?>
<?php }?></td>
<td align="center"><?php if ($_smarty_tpl->tpl_vars['rs']->value['downtime']!='0000-00-00 00:00:00') {?><?php echo $_smarty_tpl->tpl_vars['rs']->value['downtime'];?>
<?php }?></td>
<td align="center"><?php echo ($_smarty_tpl->tpl_vars['rs']->value['allow']==1?'<img src="/public/samaores/images/yes.gif" />':'<img src="/public/samaores/images/no.gif" />');?>
</td>
<td align="center">
<a class="samao-link-minibtn" href="/admin/channel/set<?php if ($_smarty_tpl->tpl_vars['rs']->value['allow']==1) {?>off<?php } else { ?>on<?php }?>_allow?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
"><?php if ($_smarty_tpl->tpl_vars['rs']->value['allow']==0) {?>上架<?php } else { ?>下架<?php }?></a>
<a class="samao-link-minibtn" href="/admin/channel/edit?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">编辑</a>
<?php if ($_smarty_tpl->tpl_vars['rs']->value['type']==2) {?><a class="samao-link-minibtn" href="/admin/channel_camp/index?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">产品列表</a><?php }?>
<a onclick="return confirm('确定要删除了吗？');" class="samao-link-minibtn" href="/admin/channel/delete?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
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
