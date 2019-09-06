<?php /* Smarty version Smarty-3.1.19, created on 2019-07-02 13:51:37
         compiled from ".\Apps\Admin\views\layout\movepics_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:244935d1af0e97aa9d8-21999687%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9e13f344b1adf6defe81a8d99ea57238a5014a41' => 
    array (
      0 => '.\\Apps\\Admin\\views\\layout\\movepics_list.tpl',
      1 => 1559647612,
      2 => 'file',
    ),
    '4b0c8ba3e57f0c60af6144fd304396960b2ce574' => 
    array (
      0 => 'E:\\WWW\\waimai\\Web\\samao\\tpls\\model_list.tpl',
      1 => 1491473406,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '244935d1af0e97aa9d8-21999687',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'rows' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5d1af0e984da58_23408510',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d1af0e984da58_23408510')) {function content_5d1af0e984da58_23408510($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_minimg')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\modifier.minimg.php';
if (!is_callable('smarty_modifier_sortopt')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\modifier.sortopt.php';
?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
-首页滚动图片</title>
<link href="/public/samaores/css/form.plane.css" rel="stylesheet" type="text/css" />
<link href="/public/samaores/css/list.plane.css" rel="stylesheet" type="text/css" />


<!--samao model script-->
</head>
<body>
<div class="tablebox listbox margintop">
<div class="smbox-list-title"><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
-首页滚动图片 <span id="inputbox_loading" style="display:none">正在提交中...</span></div>
<div class="smbox-list-content">


<div class="smbox-list-toptab">
<a href="/admin/movepics/add?school_id=<?php echo $_smarty_tpl->tpl_vars['schoolId']->value;?>
" class="samao-link-btn samao-link-btn-add">新增</a>
</div>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="smbox-list-table" id="smbox-list-table">
<tr>

<th width="80">ID</th>
<th width="100">图片</th>
<th>图片名称</th>
<th>类型</th>
<th width="160">排序</th>
<th width="80">是否启用</th>
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
<td align="center"><img src="<?php echo smarty_modifier_minimg($_smarty_tpl->tpl_vars['rs']->value['src'],192,42,1);?>
" height=40 /></td>
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['name'];?>
</td>
<td align="center"><?php echo ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['rs']->value['type'],array('0','1','2'))) && array_key_exists($_tempkey,$_temparr=array('商铺','商品','文章'))?$_temparr[$_tempkey]:'');?>
</td>
<td align="center"><?php echo smarty_modifier_sortopt($_smarty_tpl->tpl_vars['rs']->value['sort'],$_smarty_tpl->tpl_vars['rs']->value['id']);?>
</td>
<td align="center"><?php echo ($_smarty_tpl->tpl_vars['rs']->value['allow']==1?'<img src="/public/samaores/images/yes.gif" />':'<img src="/public/samaores/images/no.gif" />');?>
</td>
<td align="center">
<a class="samao-link-minibtn" href="/admin/movepics/edit?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">编辑</a>
<a class="samao-link-minibtn" href="/admin/movepics/set<?php if ($_smarty_tpl->tpl_vars['rs']->value['allow']==1) {?>off<?php } else { ?>on<?php }?>_allow?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
"><?php if ($_smarty_tpl->tpl_vars['rs']->value['allow']==1) {?>关闭<?php } else { ?>启用<?php }?></a>
<a onclick="return confirm('确定删除该项吗？');" class="samao-link-minibtn" href="/admin/movepics/delete?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">删除</a>
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
