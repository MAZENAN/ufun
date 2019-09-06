<?php /* Smarty version Smarty-3.1.19, created on 2019-06-30 14:35:26
         compiled from ".\Apps\Admin\views\layout\tag_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:146655d18582e3466e4-95251375%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f69a6c2fe43ed2a42eb276b8cd8bebf3b59e777e' => 
    array (
      0 => '.\\Apps\\Admin\\views\\layout\\tag_list.tpl',
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
  'nocache_hash' => '146655d18582e3466e4-95251375',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'rows' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5d18582e415499_53386100',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d18582e415499_53386100')) {function content_5d18582e415499_53386100($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_sortopt')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\modifier.sortopt.php';
?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
<link href="/public/samaores/css/form.plane.css" rel="stylesheet" type="text/css" />
<link href="/public/samaores/css/list.plane.css" rel="stylesheet" type="text/css" />


<!--samao model script-->
</head>
<body>
<div class="tablebox listbox margintop">
<div class="smbox-list-title"><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
 <span id="inputbox_loading" style="display:none">正在提交中...</span></div>
<div class="smbox-list-content">


<div class="smbox-list-toptab">
<a class="samao-link-btn samao-link-btn-refresh" href="javascript:window.location.reload()">刷新</a>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="/admin/tag/add?type=<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
" class="samao-link-btn samao-link-btn-add">新增</a>&nbsp;&nbsp;
<form  method='get'>
    <input type="hidden" name="type" value="<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
"/>
<?php echo FormBox::select(array('header'=>'标签选择','options'=>DB::getopts('@pf_tag','id,title',0,"pid=0 and type=".((string)$_smarty_tpl->tpl_vars['type']->value)),'style'=>"width:100px;",'onchange'=>'this.form.submit();','value'=>((string)$_smarty_tpl->tpl_vars['id']->value),'name'=>"id",),$_smarty_tpl->tpl_vars['model']->value);?>&nbsp;&nbsp;
</form>
</div>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="smbox-list-table" id="smbox-list-table">
<tr>

<th width="20">序号</th>
<th width="120" align="center">标签名称</th>
<th width="140">排序</th>
<th width="140">操作</th>

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
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['title'];?>
</td>
<td align="center"><?php echo smarty_modifier_sortopt($_smarty_tpl->tpl_vars['rs']->value['sort'],$_smarty_tpl->tpl_vars['rs']->value['id'],1);?>
</td>
<td align="center">
<?php if ($_smarty_tpl->tpl_vars['type']->value==2) {?>
<?php if ($_smarty_tpl->tpl_vars['rs']->value['create']==1) {?><a href="/admin/tag/add?pid=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
&type=<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
">添加二级标签</a> | 
<?php if ($_smarty_tpl->tpl_vars['rs']->value['allow']==0) {?><a href="/admin/tag/seton_allow?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">启用</a> | 
<?php } else { ?><a onclick="return confirm('确定要关闭该菜单吗？');" href="/admin/tag/setoff_allow?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">关闭</a> | <?php }?>
<?php }?><?php }?>
<a href="/admin/tag/edit?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
&type=<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
">编辑</a> |  
<a onclick="return confirm('确定要删除该节点吗？一旦删除将无法恢复，请谨慎操作！');" href="/admin/tag/delete?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
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
