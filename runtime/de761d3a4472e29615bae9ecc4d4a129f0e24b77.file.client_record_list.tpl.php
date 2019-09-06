<?php /* Smarty version Smarty-3.1.19, created on 2019-05-06 22:37:21
         compiled from ".\Apps\Admin\views\layout\client_record_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:48015cd046a11847c1-40633291%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'de761d3a4472e29615bae9ecc4d4a129f0e24b77' => 
    array (
      0 => '.\\Apps\\Admin\\views\\layout\\client_record_list.tpl',
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
  'nocache_hash' => '48015cd046a11847c1-40633291',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'rows' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5cd046a12470e4_99734393',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5cd046a12470e4_99734393')) {function content_5cd046a12470e4_99734393($_smarty_tpl) {?><?php if (!is_callable('smarty_function_pagebar')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\function.pagebar.php';
?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
<link href="/public/samaores/css/form.plane.css" rel="stylesheet" type="text/css" />
<link href="/public/samaores/css/list.plane.css" rel="stylesheet" type="text/css" />


<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.topdialog.js"></script>


<!--samao model script-->
</head>
<body>
<div class="tablebox listbox margintop">
<div class="smbox-list-title"><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
 <span id="inputbox_loading" style="display:none">正在提交中...</span></div>
<div class="smbox-list-content">


<div class="smbox-list-toptab">
<a class="samao-link-btn samao-link-btn-refresh" href="javascript:window.location.reload()">刷新</a>
<a class="samao-link-btn samao-link-btn-add" href="/admin/client_record/add?client_id=<?php echo $_smarty_tpl->tpl_vars['sch']->value['client_id'];?>
<?php if ($_smarty_tpl->tpl_vars['type']->value==3) {?>&type=3<?php }?>">新增</a>&nbsp;&nbsp;&nbsp;&nbsp;

</div>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="smbox-list-table" id="smbox-list-table">
<tr>

<th width="30">ID</th>
<th width="100">跟进时间</th>
<th width="100">跟进人</th>
<th width="70">联系方式</th>
<th width="160">跟进结果</th>
<th width="100">操作</th>

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
<td align="center"><?php echo $_smarty_tpl->tpl_vars['ttl']->value+1;?>
</td>
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['add_time'];?>
</td>
<td align="center"><?php echo DB::getval('@pf_manage','name',$_smarty_tpl->tpl_vars['rs']->value['manage_id']);?>
</td>
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['contact'];?>
</td>
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['content'];?>
</td>

<td align="center">
<a class="samao-link-minibtn" href="/admin/client_record/edit?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
&client_id=<?php echo $_smarty_tpl->tpl_vars['sch']->value['client_id'];?>
<?php if ($_smarty_tpl->tpl_vars['type']->value==3) {?>&type=3<?php }?>">编辑</a>
<a onclick="return confirm('确定要删除了吗？');" class="samao-link-minibtn" href="/admin/client_record/delete?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
&client_id=<?php echo $_smarty_tpl->tpl_vars['sch']->value['client_id'];?>
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
