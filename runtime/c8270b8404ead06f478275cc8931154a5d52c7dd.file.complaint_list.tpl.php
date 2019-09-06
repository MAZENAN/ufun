<?php /* Smarty version Smarty-3.1.19, created on 2019-05-09 10:53:42
         compiled from ".\Apps\Admin\views\layout\complaint_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:53775cd39636deaa30-71337677%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c8270b8404ead06f478275cc8931154a5d52c7dd' => 
    array (
      0 => '.\\Apps\\Admin\\views\\layout\\complaint_list.tpl',
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
  'nocache_hash' => '53775cd39636deaa30-71337677',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'rows' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5cd39636ed5d08_29621845',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5cd39636ed5d08_29621845')) {function content_5cd39636ed5d08_29621845($_smarty_tpl) {?><?php if (!is_callable('smarty_function_pagebar')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\function.pagebar.php';
?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>投诉列表</title>
<link href="/public/samaores/css/form.plane.css" rel="stylesheet" type="text/css" />
<link href="/public/samaores/css/list.plane.css" rel="stylesheet" type="text/css" />


<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.topdialog.js"></script>


<!--samao model script-->
</head>
<body>
<div class="tablebox listbox margintop">
<div class="smbox-list-title">投诉列表 <span id="inputbox_loading" style="display:none">正在提交中...</span></div>
<div class="smbox-list-content">



<div class="smbox-list-toptab">
	<form method="get">
		<a class="samao-link-btn samao-link-btn-refresh" href="javascript:window.location.reload()">刷新</a>
		&nbsp;&nbsp;&nbsp;&nbsp;
                <?php echo FormBox::select(array('header'=>"是否处理",'options'=>array(array(0,'未处理'),array(1,'已处理')),'onchange'=>'this.form.submit()','name'=>"state",'value'=>((string)$_smarty_tpl->tpl_vars['sch']->value['state']),),$_smarty_tpl->tpl_vars['model']->value);?>&nbsp;&nbsp;
		<?php echo FormBox::text(array('style'=>"width:120px",'name'=>"title",'value'=>((string)$_smarty_tpl->tpl_vars['sch']->value['title']),'placeholder'=>'产品标题',),$_smarty_tpl->tpl_vars['model']->value);?>
		<input type="submit" value="查找" class="samao-mini-btn samao-mini-btn-search"/>
		&nbsp;&nbsp;
	</form>
</div>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="smbox-list-table" id="smbox-list-table">
<tr>

<th width="30">ID</th>
<th width="340">产品标题</th>
<th width="90">订单联系人</th>
<th width="90">联系电话</th>
<th width="420">投诉内容</th>
<th width="170">投诉时间</th>
<th width="80">状态</th>
<th width="260">操作</th>

</tr>
<?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_smarty_tpl->tpl_vars['ttl'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['rows']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
 $_smarty_tpl->tpl_vars['ttl']->value = $_smarty_tpl->tpl_vars['rs']->key;
?>
<tr  onmouseover="this.oldBgcolor=this.style.backgroundColor;this.style.backgroundColor='#FCFCF8';" onmouseout="this.style.backgroundColor=this.oldBgcolor">

<td align="center">
	<span class="blu"><?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
</span>
</td>
<td align="center">
	<span class="blu"><?php echo $_smarty_tpl->tpl_vars['rs']->value['title'];?>
</span>
</td>
<td align="center">
	<span class="blu"><?php echo $_smarty_tpl->tpl_vars['rs']->value['ct1_name'];?>
</span>
</td>
<td align="center">
	<span class="blu"><?php echo $_smarty_tpl->tpl_vars['rs']->value['ct1_phone'];?>
</span>
</td>
<td align="center">
	<span class="blu"><?php echo $_smarty_tpl->tpl_vars['rs']->value['info'];?>
</span>
</td>
<td align="left">
	<span class="blu"><?php echo $_smarty_tpl->tpl_vars['rs']->value['add_time'];?>
</span>
</td>
<td align="center">
	<span class="blu"><?php if ($_smarty_tpl->tpl_vars['rs']->value['state']) {?>已处理<?php } else { ?>未处理<?php }?></span>
</td>
<td align="left">
	<a dialog="1" class="samao-link-minibtn" href="/admin/order/detail?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['oid'];?>
">查看订单</a>
        <?php if ($_smarty_tpl->tpl_vars['rs']->value['state']==0) {?><a dialog="1" class="samao-link-minibtn" href="/admin/complaint/edit?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">标记为已处理</a><?php }?>
        <?php if ($_smarty_tpl->tpl_vars['rs']->value['state']==1) {?><a dialog="1" class="samao-link-minibtn" href="/admin/complaint/show?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">处理结果</a><?php }?>
</td>

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
