<?php /* Smarty version Smarty-3.1.19, created on 2019-05-10 13:45:06
         compiled from ".\Apps\Admin\views\layout\camp_diary_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:46525cd50fe2cfe226-21113772%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '90d38e62c8726a03ab7e2e82259f5bbd6e8b019e' => 
    array (
      0 => '.\\Apps\\Admin\\views\\layout\\camp_diary_list.tpl',
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
  'nocache_hash' => '46525cd50fe2cfe226-21113772',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'rows' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5cd50fe2d95062_21488587',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5cd50fe2d95062_21488587')) {function content_5cd50fe2d95062_21488587($_smarty_tpl) {?><?php if (!is_callable('smarty_function_pagebar')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\function.pagebar.php';
?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>营地相册</title>
<link href="/public/samaores/css/form.plane.css" rel="stylesheet" type="text/css" />
<link href="/public/samaores/css/list.plane.css" rel="stylesheet" type="text/css" />


<!--samao model script-->
</head>
<body>
<div class="tablebox listbox margintop">
<div class="smbox-list-title">营地相册 <span id="inputbox_loading" style="display:none">正在提交中...</span></div>
<div class="smbox-list-content">


<div class="smbox-list-toptab">
<form method="get">
<a class="samao-link-btn" href="/admin/camp_diary/addDiary?campid=<?php echo $_smarty_tpl->tpl_vars['campid']->value;?>
">上传营地相册</a>&nbsp;&nbsp;&nbsp;&nbsp;
<?php echo FormBox::hidden(array('name'=>"campid",),$_smarty_tpl->tpl_vars['schmodel']->value);?>&nbsp;&nbsp;
</form>
</div>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="smbox-list-table" id="smbox-list-table">
<tr>

<th width="80">期数</th>
<th width="160">起始日期</th>
<th width="80">天数</th>
<th width="80">图片数</th>

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

<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['periods'];?>
</td>
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['start'];?>
</td>
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['days'];?>
</td>
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['num'];?>
</td>
<td align="center">
<a class="samao-link-minibtn" href="/admin/camp_diary/editDiary?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
&campid=<?php echo $_smarty_tpl->tpl_vars['campid']->value;?>
">编辑</a>
<a onclick="return confirm('确定要删除了吗？');" class="samao-link-minibtn" href="/admin/camp_diary/delete?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
&campid=<?php echo $_smarty_tpl->tpl_vars['campid']->value;?>
">删除</a>
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
