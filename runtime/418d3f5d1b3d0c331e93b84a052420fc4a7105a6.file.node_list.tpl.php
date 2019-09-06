<?php /* Smarty version Smarty-3.1.19, created on 2019-07-08 08:39:33
         compiled from ".\Apps\Admin\views\layout\node_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:274175d2290c5517cb1-01001181%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '418d3f5d1b3d0c331e93b84a052420fc4a7105a6' => 
    array (
      0 => '.\\Apps\\Admin\\views\\layout\\node_list.tpl',
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
  'nocache_hash' => '274175d2290c5517cb1-01001181',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'rows' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5d2290c55d2a37_35407939',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d2290c55d2a37_35407939')) {function content_5d2290c55d2a37_35407939($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_sortopt')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\modifier.sortopt.php';
?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>权限节点</title>
<link href="/public/samaores/css/form.plane.css" rel="stylesheet" type="text/css" />
<link href="/public/samaores/css/list.plane.css" rel="stylesheet" type="text/css" />


<!--samao model script-->
</head>
<body>
<div class="tablebox listbox margintop">
<div class="smbox-list-title">权限节点 <span id="inputbox_loading" style="display:none">正在提交中...</span></div>
<div class="smbox-list-content">


<div class="smbox-list-toptab">
<a href="/admin/node/add" class="samao-link-btn samao-link-btn-add">新增</a>&nbsp;&nbsp;
<form  method='get'>
<?php echo FormBox::select(array('header'=>'节点名称','options'=>DB::getopts('@pf_node','id,title',0,"pid=0"),'style'=>"width:100px;",'onchange'=>'this.form.submit();','value'=>((string)$_smarty_tpl->tpl_vars['id']->value),'name'=>"id",),$_smarty_tpl->tpl_vars['model']->value);?>&nbsp;&nbsp;
</form>
</br>
&nbsp;&nbsp;非专业技术人员，请勿乱操作此处，否则会出现严重后果
</div>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="smbox-list-table" id="smbox-list-table">
<tr>

<th width="120" align="center">节点名称</th>
<th width="80">控制器</th>
<th width="80">操作方法</th>
<th width="80">参数</th>
<th width="80">值</th>
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
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['title'];?>
</td>
<td align="center"><?php echo (is_array('')&&is_array('---') ? ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['rs']->value['controller'],'')) && array_key_exists($_tempkey,$_temparr='---')?$_temparr[$_tempkey]:$_smarty_tpl->tpl_vars['rs']->value['controller']) : ($_smarty_tpl->tpl_vars['rs']->value['controller']==''?'---':$_smarty_tpl->tpl_vars['rs']->value['controller']));?>
</td>
<td align="center"><?php echo (is_array('')&&is_array('---') ? ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['rs']->value['model'],'')) && array_key_exists($_tempkey,$_temparr='---')?$_temparr[$_tempkey]:$_smarty_tpl->tpl_vars['rs']->value['model']) : ($_smarty_tpl->tpl_vars['rs']->value['model']==''?'---':$_smarty_tpl->tpl_vars['rs']->value['model']));?>
</td>
<td align="center"><?php echo (is_array('')&&is_array('---') ? ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['rs']->value['parameter'],'')) && array_key_exists($_tempkey,$_temparr='---')?$_temparr[$_tempkey]:$_smarty_tpl->tpl_vars['rs']->value['parameter']) : ($_smarty_tpl->tpl_vars['rs']->value['parameter']==''?'---':$_smarty_tpl->tpl_vars['rs']->value['parameter']));?>
</td>
<td align="center"><?php echo (is_array('')&&is_array('---') ? ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['rs']->value['value'],'')) && array_key_exists($_tempkey,$_temparr='---')?$_temparr[$_tempkey]:$_smarty_tpl->tpl_vars['rs']->value['value']) : ($_smarty_tpl->tpl_vars['rs']->value['value']==''?'---':$_smarty_tpl->tpl_vars['rs']->value['value']));?>
</td>
<td align="center"><?php echo smarty_modifier_sortopt($_smarty_tpl->tpl_vars['rs']->value['sort'],$_smarty_tpl->tpl_vars['rs']->value['id'],0,1);?>
</td>
<td align="center">
<?php if ($_smarty_tpl->tpl_vars['rs']->value['create']==1) {?><a href="/admin/node/add?pid=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">添加方法</a> | <?php }?>
<a href="/admin/node/edit?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">编辑</a> |  
<a onclick="return confirm('确定要删除该节点吗？一旦删除将无法恢复，请谨慎操作！');" href="/admin/node/delete?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
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
