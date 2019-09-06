<?php /* Smarty version Smarty-3.1.19, created on 2019-07-18 13:51:45
         compiled from ".\Apps\Admin\views\layout\member_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:223835d3008f1570332-82841742%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '35ad385c7c33e80c6f219874606e1fb1bfc60861' => 
    array (
      0 => '.\\Apps\\Admin\\views\\layout\\member_list.tpl',
      1 => 1562657695,
      2 => 'file',
    ),
    '4b0c8ba3e57f0c60af6144fd304396960b2ce574' => 
    array (
      0 => 'E:\\WWW\\waimai\\Web\\samao\\tpls\\model_list.tpl',
      1 => 1491473406,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '223835d3008f1570332-82841742',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'rows' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5d3008f16695e4_69728911',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d3008f16695e4_69728911')) {function content_5d3008f16695e4_69728911($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_minimg')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\modifier.minimg.php';
if (!is_callable('smarty_function_pagebar')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\function.pagebar.php';
?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>用户列表</title>
<link href="/public/samaores/css/form.plane.css" rel="stylesheet" type="text/css" />
<link href="/public/samaores/css/list.plane.css" rel="stylesheet" type="text/css" />


<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.topdialog.js"></script>

<!--samao model script-->
</head>
<body>
<div class="tablebox listbox margintop">
<div class="smbox-list-title">用户列表 <span id="inputbox_loading" style="display:none">正在提交中...</span></div>
<div class="smbox-list-content">


<div class="smbox-list-toptab">
    <form method="get" id="target-form">
        <a class="samao-link-btn samao-link-btn-refresh" href="javascript:window.location.reload()">刷新</a>
        <?php echo FormBox::text(array('style'=>"width:120px",'name'=>"mobile",'value'=>((string)$_smarty_tpl->tpl_vars['sch']->value['mobile']),'placeholder'=>'手机号',),$_smarty_tpl->tpl_vars['schmodel']->value);?>
        <input type="submit" value="查找" class="samao-mini-btn samao-mini-btn-search"/>&nbsp;
        <input type="hidden" name="type" value="<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
">
        <input type="hidden" name="from" value="<?php echo $_smarty_tpl->tpl_vars['from']->value;?>
">
        <?php if ($_GET['from']=='all') {?><?php } else { ?>
        <input type="hidden" name="status" value="<?php echo $_smarty_tpl->tpl_vars['status']->value;?>
">
        <?php }?>

    </form>
</div>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="smbox-list-table" id="smbox-list-table">
<tr>

<th width="10%">ID</th>
<th width="10%">用户名</th>
<th width="10%">手机号</th>
<?php if ($_smarty_tpl->tpl_vars['type']->value==1) {?>
<th width="10%">昵称</th>
<th width="10%">用户头像</th>
<?php }?>
<th width="18%">操作</th>

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
<td align="center"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['rs']->value['username'])===null||$tmp==='' ? '--' : $tmp);?>
</td>
<td align="center"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['rs']->value['mobile'])===null||$tmp==='' ? '--' : $tmp);?>
</td>
<?php if ($_smarty_tpl->tpl_vars['type']->value==1) {?>
<td align="center"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['rs']->value['nickname'])===null||$tmp==='' ? '--' : $tmp);?>
</td>
<td align="center"><img src="<?php echo smarty_modifier_minimg($_smarty_tpl->tpl_vars['rs']->value['img_head'],50,50,1);?>
"></td>
<?php }?>
<td align="center">
    <?php if ($_smarty_tpl->tpl_vars['type']->value==2) {?>
    <a dialog="1" class="samao-link-minibtn" href="/admin/merchant?user_id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">拥有商家</a>
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['status']->value==1) {?><a class="samao-link-minibtn"  href="/admin/member/review?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">审核资料</a><?php }?>
    <?php if ($_smarty_tpl->tpl_vars['status']->value!=1) {?><a class="samao-link-minibtn"  href="/admin/member/edit?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
&type=<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
&status=<?php echo $_smarty_tpl->tpl_vars['status']->value;?>
">编辑</a><?php }?>
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
