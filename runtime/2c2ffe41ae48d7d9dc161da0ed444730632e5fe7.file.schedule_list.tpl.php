<?php /* Smarty version Smarty-3.1.19, created on 2019-05-10 13:51:57
         compiled from ".\Apps\Admin\views\layout\schedule_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:105115cd5117db82f46-77481568%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2c2ffe41ae48d7d9dc161da0ed444730632e5fe7' => 
    array (
      0 => '.\\Apps\\Admin\\views\\layout\\schedule_list.tpl',
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
  'nocache_hash' => '105115cd5117db82f46-77481568',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'rows' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5cd5117dc04f87_70691183',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5cd5117dc04f87_70691183')) {function content_5cd5117dc04f87_70691183($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_sortopt')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\modifier.sortopt.php';
?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_smarty_tpl->tpl_vars['row']->value['title'];?>
 的日程安排</title>
<link href="/public/samaores/css/form.plane.css" rel="stylesheet" type="text/css" />
<link href="/public/samaores/css/list.plane.css" rel="stylesheet" type="text/css" />


<!--samao model script-->
</head>
<body>
<div class="tablebox listbox margintop">
<div class="smbox-list-title"><?php echo $_smarty_tpl->tpl_vars['row']->value['title'];?>
 的日程安排 <span id="inputbox_loading" style="display:none">正在提交中...</span></div>
<div class="smbox-list-content">


<div class="smbox-list-toptab">
<form method="get">
<a class="samao-link-btn" href="/admin/schedule/add?campid=<?php echo $_smarty_tpl->tpl_vars['sch']->value['campid'];?>
">新增日程</a>&nbsp;&nbsp;&nbsp;&nbsp;

<?php echo FormBox::hidden(array('name'=>"campid",),$_smarty_tpl->tpl_vars['schmodel']->value);?>&nbsp;&nbsp;
</form>
</div>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="smbox-list-table" id="smbox-list-table">
<tr>

<th width="80">日期名称</th>
<th align="">日程标题</th>
<th width="180">权重排序</th>
<th width="180" align="center">操作</th>

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
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['name'];?>
</td>
<td align="left"><?php echo $_smarty_tpl->tpl_vars['rs']->value['tic'];?>
</td>

<td align="center"><?php echo smarty_modifier_sortopt($_smarty_tpl->tpl_vars['rs']->value['sort'],$_smarty_tpl->tpl_vars['rs']->value['id']);?>
</td>
<td align="center">
<a class="samao-link-minibtn" href="/admin/schedule/edit?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
&campid=<?php echo $_smarty_tpl->tpl_vars['sch']->value['campid'];?>
">编辑</a>
<a onclick="return confirm('真的删除吗？');" class="samao-link-minibtn" href="/admin/schedule/delete?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
&campid=<?php echo $_smarty_tpl->tpl_vars['sch']->value['campid'];?>
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
