<?php /* Smarty version Smarty-3.1.19, created on 2019-09-06 18:18:45
         compiled from ".\Apps\Admin\views\layout\earn_order_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:135305d723285bb06e5-63783836%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f3b3084779d8c4753f7984262282d70c0bfe41f9' => 
    array (
      0 => '.\\Apps\\Admin\\views\\layout\\earn_order_list.tpl',
      1 => 1567755285,
      2 => 'file',
    ),
    '4b0c8ba3e57f0c60af6144fd304396960b2ce574' => 
    array (
      0 => 'E:\\WWW\\waimai\\Web\\samao\\tpls\\model_list.tpl',
      1 => 1491473406,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '135305d723285bb06e5-63783836',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'rows' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5d723285ca3419_21064982',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d723285ca3419_21064982')) {function content_5d723285ca3419_21064982($_smarty_tpl) {?><?php if (!is_callable('smarty_function_pagebar')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\function.pagebar.php';
?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>赏金任务订单</title>
<link href="/public/samaores/css/form.plane.css" rel="stylesheet" type="text/css" />
<link href="/public/samaores/css/list.plane.css" rel="stylesheet" type="text/css" />


<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.topdialog.js"></script>

<!--samao model script-->
</head>
<body>
<div class="tablebox listbox margintop">
<div class="smbox-list-title">赏金任务订单 <span id="inputbox_loading" style="display:none">正在提交中...</span></div>
<div class="smbox-list-content">

<div class="smbox-toptags">
    <a href="?order_id=<?php echo $_smarty_tpl->tpl_vars['sch']->value['order_id'];?>
"<?php if (!isset($_GET['status'])||$_GET['status']==='') {?>class="active"<?php }?>>全部订单</a>
    <?php  $_smarty_tpl->tpl_vars['xs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['xs']->_loop = false;
 $_smarty_tpl->tpl_vars['ik'] = new Smarty_Variable;
 $_from = array('0'=>'未付款','1'=>'已付款<span class="org">(待接单)</span>','2'=>'已接单<span class="org">(配送中)</span>','3'=>'已送达(未确认)','4'=>'退款中','5'=>'已退款','6'=>'待评价','7'=>'已完成','-1'=>'已取消'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['xs']->key => $_smarty_tpl->tpl_vars['xs']->value) {
$_smarty_tpl->tpl_vars['xs']->_loop = true;
 $_smarty_tpl->tpl_vars['ik']->value = $_smarty_tpl->tpl_vars['xs']->key;
?>
    <a href="?orderid=<?php echo $_smarty_tpl->tpl_vars['sch']->value['order_id'];?>
&type=<?php echo $_smarty_tpl->tpl_vars['sch']->value['status'];?>
&status=<?php echo $_smarty_tpl->tpl_vars['ik']->value;?>
" <?php if (isset($_GET['status'])&&$_GET['status']!=''&&$_smarty_tpl->tpl_vars['sch']->value['status']==$_smarty_tpl->tpl_vars['ik']->value) {?>class="active"<?php }?>><?php echo $_smarty_tpl->tpl_vars['xs']->value;?>
</a>
    <?php } ?>
</div>


<div class="smbox-list-toptab">
    <form method="get" id="target-form">
        <a class="samao-link-btn samao-link-btn-refresh" href="javascript:window.location.reload()">刷新</a>
        <?php echo FormBox::text(array('style'=>"width:120px",'name'=>"order_id",'value'=>((string)$_smarty_tpl->tpl_vars['sch']->value['order_id']),'placeholder'=>'请输入订单号',),$_smarty_tpl->tpl_vars['schmodel']->value);?>
        <?php echo FormBox::select(array('header'=>"订单类型",'onchange'=>'this.form.submit();','style'=>"width:120px",'name'=>"order_type",),$_smarty_tpl->tpl_vars['schmodel']->value);?>
        <input type="submit" value="查找" class="samao-mini-btn samao-mini-btn-search"/>&nbsp;
    </form>
</div>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="smbox-list-table" id="smbox-list-table">
<tr>

<th width="10%">序号</th>
<th width="10%">订单编号</th>
<th width="10%">订单类型</th>
<th width="10%">下单用户</th>
<th width="10%">创建时间</th>
<th width="10%">订单状态</th>
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

<td align="center">
    <span class="blu"><?php echo $_smarty_tpl->tpl_vars['ttl']->value+1;?>
</span>
</td>
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['order_id'];?>
</td>
<td align="center"><span class="org"><?php echo ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['rs']->value['order_type'],array(1,2,3))) && array_key_exists($_tempkey,$_temparr=array('跑腿类','代购类','技能求助'))?$_temparr[$_tempkey]:'');?>
</span></td>
<td align="center"><?php echo DB::getval('@pf_member','nickname',$_smarty_tpl->tpl_vars['rs']->value['user_id']);?>
</span></td>
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['add_time'];?>
</td>
<td align="center"><?php echo ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['rs']->value['status'],array('-1','0','1','2','3','4','5','6','7'))) && array_key_exists($_tempkey,$_temparr=array('已取消','待支付','<span style="color:#09bc7b">已支付</span>(待接单)','已接单(配送中)','已送达(未确认)','退款中','完成退款','待评价','已完成'))?$_temparr[$_tempkey]:'');?>
</td>
<td align="center">
    <a dialog="1" class="samao-link-minibtn" href="/admin/earn_order/detail?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">查看订单</a>
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
