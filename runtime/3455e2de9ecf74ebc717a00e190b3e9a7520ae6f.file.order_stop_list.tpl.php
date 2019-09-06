<?php /* Smarty version Smarty-3.1.19, created on 2019-05-25 21:51:48
         compiled from ".\Apps\Admin\views\layout\order_stop_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:237345ce94874492176-98068605%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3455e2de9ecf74ebc717a00e190b3e9a7520ae6f' => 
    array (
      0 => '.\\Apps\\Admin\\views\\layout\\order_stop_list.tpl',
      1 => 1558513743,
      2 => 'file',
    ),
    '4b0c8ba3e57f0c60af6144fd304396960b2ce574' => 
    array (
      0 => 'E:\\WWW\\waimai\\Web\\samao\\tpls\\model_list.tpl',
      1 => 1491473406,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '237345ce94874492176-98068605',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'rows' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5ce9487454cf54_74125492',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ce9487454cf54_74125492')) {function content_5ce9487454cf54_74125492($_smarty_tpl) {?><?php if (!is_callable('smarty_function_pagebar')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\function.pagebar.php';
?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo DB::getval('@pf_merchant','name',$_smarty_tpl->tpl_vars['merchantId']->value);?>
（截单设置）</title>
<link href="/public/samaores/css/form.plane.css" rel="stylesheet" type="text/css" />
<link href="/public/samaores/css/list.plane.css" rel="stylesheet" type="text/css" />


<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.topdialog.js"></script>

<!--samao model script-->
</head>
<body>
<div class="tablebox listbox margintop">
<div class="smbox-list-title"><?php echo DB::getval('@pf_merchant','name',$_smarty_tpl->tpl_vars['merchantId']->value);?>
（截单设置） <span id="inputbox_loading" style="display:none">正在提交中...</span></div>
<div class="smbox-list-content">


<div class="smbox-list-toptab">
    <form method="get" id="target-form">
        <a class="samao-link-btn samao-link-btn-add" href="/admin/order_stop/add?merchant_id=<?php echo $_smarty_tpl->tpl_vars['merchantId']->value;?>
">新增</a>&nbsp;&nbsp;&nbsp;&nbsp;
    </form>
</div>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="smbox-list-table" id="smbox-list-table">
<tr>

<th width="10%">ID</th>
<th width="10%">星期</th>
<th width="10%">上午截单时间</th>
<th width="10%">上午最大接单量</th>
<th width="10%">下午截单时间</th>
<th width="10%">下午最大接单量</th>
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
<td align="center"><?php echo ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['rs']->value['week'],array(1,2,3,4,5,6,7))) && array_key_exists($_tempkey,$_temparr=array('星期一','星期二','星期三','星期四','星期五','星期六','星期日'))?$_temparr[$_tempkey]:'');?>
</td>
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['am_stop_time'];?>
</td>
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['am_amount'];?>
</td>
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['pm_stop_time'];?>
</td>
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['pm_amount'];?>
</td>

<td align="center">
    <a class="samao-link-minibtn" href="/admin/order_stop/edit?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">编辑</a>
    <a onclick="return confirm('确定要删除吗？一旦删除将无法恢复，请谨慎操作！');" class="samao-link-minibtn" href="/admin/order_stop/delete?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
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
