<?php /* Smarty version Smarty-3.1.19, created on 2019-05-10 13:52:04
         compiled from ".\Apps\Admin\views\layout\cdep_date_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:276815cd511841bd7d9-18134895%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5da88bc6159427e8b2e4bfc13301ac74bfaf1d55' => 
    array (
      0 => '.\\Apps\\Admin\\views\\layout\\cdep_date_list.tpl',
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
  'nocache_hash' => '276815cd511841bd7d9-18134895',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'rows' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5cd5118426fa49_53413626',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5cd5118426fa49_53413626')) {function content_5cd5118426fa49_53413626($_smarty_tpl) {?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>出发日期</title>
<link href="/public/samaores/css/form.plane.css" rel="stylesheet" type="text/css" />
<link href="/public/samaores/css/list.plane.css" rel="stylesheet" type="text/css" />


<!--samao model script-->
</head>
<body>
<div class="tablebox listbox margintop">
<div class="smbox-list-title">出发日期 <span id="inputbox_loading" style="display:none">正在提交中...</span></div>
<div class="smbox-list-content">


<div class="smbox-list-toptab">
<form method="get">
<a class="samao-link-btn" href="/admin/cdep_date/add?campid=<?php echo $_smarty_tpl->tpl_vars['sch']->value['campid'];?>
">新增</a>&nbsp;&nbsp;&nbsp;&nbsp;
<?php echo FormBox::hidden(array('name'=>"campid",),$_smarty_tpl->tpl_vars['schmodel']->value);?>&nbsp;&nbsp;
</form>
</div>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="smbox-list-table" id="smbox-list-table">
<tr>

<th width="80">期数</th>
<th>起始日期</th>
<th width="80">出发天数</th>
<th width="100">学生/家长人数</th>
<th width="80">备注</th>
<th width="80">原价/费用</th>
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

<td align="center">第<?php echo $_smarty_tpl->tpl_vars['rs']->value['periods'];?>
期</td>
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['start'];?>
</td>
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['days'];?>
天</td>
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['tourists'];?>
/<?php echo $_smarty_tpl->tpl_vars['rs']->value['parent'];?>
人</td>
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['remark'];?>
</td>
<td align="center">￥<?php echo $_smarty_tpl->tpl_vars['rs']->value['deposit'];?>
/￥<?php echo $_smarty_tpl->tpl_vars['rs']->value['cost'];?>
</td>
<td align="center"><?php if ($_smarty_tpl->tpl_vars['deadline']->value<$_smarty_tpl->tpl_vars['now']->value||$_smarty_tpl->tpl_vars['now']->value>$_smarty_tpl->tpl_vars['rs']->value['start']||($_smarty_tpl->tpl_vars['rs']->value['on_sell_time']&&$_smarty_tpl->tpl_vars['now']->value<$_smarty_tpl->tpl_vars['rs']->value['on_sell_time'])||($_smarty_tpl->tpl_vars['rs']->value['off_sell_time']&&$_smarty_tpl->tpl_vars['rs']->value['off_sell_time']<$_smarty_tpl->tpl_vars['now']->value)) {?><?php echo (0==1?'<img src="/public/samaores/images/yes.gif" />':'<img src="/public/samaores/images/no.gif" />');?>
<?php } else { ?><?php echo (1==1?'<img src="/public/samaores/images/yes.gif" />':'<img src="/public/samaores/images/no.gif" />');?>
<?php }?></td>
<td align="right">
<a class="samao-link-minibtn" href="/admin/cdep_date/cdep_plan?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
&campid=<?php echo $_smarty_tpl->tpl_vars['sch']->value['campid'];?>
">出营安排</a>
<a class="samao-link-minibtn" href="/admin/cdep_date/edit?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
&campid=<?php echo $_smarty_tpl->tpl_vars['sch']->value['campid'];?>
">编辑</a>
<a class="samao-link-minibtn" href="/admin/cdep_date/delete?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
&campid=<?php echo $_smarty_tpl->tpl_vars['sch']->value['campid'];?>
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
