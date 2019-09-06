<?php /* Smarty version Smarty-3.1.19, created on 2019-05-10 16:56:51
         compiled from ".\Apps\Admin\views\layout\coupon_packs_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:215555cd53cd3bbd9d1-66444767%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '11826865a52b306f9888a595f57d3c0809908007' => 
    array (
      0 => '.\\Apps\\Admin\\views\\layout\\coupon_packs_list.tpl',
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
  'nocache_hash' => '215555cd53cd3bbd9d1-66444767',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'rows' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5cd53cd3df4276_69011242',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5cd53cd3df4276_69011242')) {function content_5cd53cd3df4276_69011242($_smarty_tpl) {?><?php if (!is_callable('smarty_function_pagebar')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\function.pagebar.php';
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
<a class="samao-link-btn samao-link-btn-add" href="/admin/coupon_packs/add">新增</a>&nbsp;&nbsp;&nbsp;&nbsp;<a class="samao-link-btn samao-link-btn-refresh" href="javascript:window.location.reload()">刷新</a>
</div>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="smbox-list-table" id="smbox-list-table">
<tr>

<th width="30">ID</th>
<th width="90">标题</th>
<th width="90">优惠券总额</th>
<th width="50">优惠券张数</th>
<th width="80">单张优惠券金额</th>
<th width="70">最小使用订单金额</th>
<th width="90">到期时间</th>
<th width="50">是否上架</th>
<th width="50">是否推荐</th>
<th width="190">操作</th>

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
<td align="center">￥<?php echo $_smarty_tpl->tpl_vars['rs']->value['total_amount'];?>
</td>
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['num'];?>
</td>
<td align="center"><?php  $_smarty_tpl->tpl_vars['cou'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cou']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['rs']->value['coupons']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cou']->key => $_smarty_tpl->tpl_vars['cou']->value) {
$_smarty_tpl->tpl_vars['cou']->_loop = true;
?><?php if ($_smarty_tpl->tpl_vars['cou']->value['coupon']) {?>￥<?php echo $_smarty_tpl->tpl_vars['cou']->value['coupon'];?>
<?php } else { ?>-<?php }?><br /><?php } ?></td>
<td align="center"><?php  $_smarty_tpl->tpl_vars['cou'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cou']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['rs']->value['coupons']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cou']->key => $_smarty_tpl->tpl_vars['cou']->value) {
$_smarty_tpl->tpl_vars['cou']->_loop = true;
?><?php if ($_smarty_tpl->tpl_vars['cou']->value['scope']) {?>￥<?php echo $_smarty_tpl->tpl_vars['cou']->value['scope'];?>
<?php } else { ?>-<?php }?><br /><?php } ?></td>
<td align="center"><?php  $_smarty_tpl->tpl_vars['cou'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cou']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['rs']->value['coupons']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cou']->key => $_smarty_tpl->tpl_vars['cou']->value) {
$_smarty_tpl->tpl_vars['cou']->_loop = true;
?><?php if ($_smarty_tpl->tpl_vars['cou']->value['deadline']=='0000-00-00 00:00:00'||empty($_smarty_tpl->tpl_vars['cou']->value['deadline'])) {?>-<?php } else { ?><?php echo date('Y-m-d',strtotime($_smarty_tpl->tpl_vars['cou']->value['deadline']));?>
<?php }?><br /><?php } ?></td>
<td align="center"><?php echo ($_smarty_tpl->tpl_vars['rs']->value['allow']==1?'<img src="/public/samaores/images/yes.gif" />':'<img src="/public/samaores/images/no.gif" />');?>
</td>
<td align="center"><?php echo ($_smarty_tpl->tpl_vars['rs']->value['is_top']==1?'<img src="/public/samaores/images/yes.gif" />':'<img src="/public/samaores/images/no.gif" />');?>
</td>
<td align="center">
	<div id="copy<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
" class="theme-address" style="font-size:0px;height:0;"><?php echo $_smarty_tpl->tpl_vars['url']->value;?>
/coupon_packs.html?coupon_id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
</div>
<a class="copyaddress_<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
 samao-link-minibtn" type="button" data-clipboard-action="copy" data-clipboard-target="#copy<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">复制分享链接</a>
<a class="samao-link-minibtn" href="/admin/coupon_packs/edit?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">编辑</a>
<!--<a dialog="1" class="samao-link-minibtn"  href="/admin/coupon_packs/couponsList?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">添加优惠券</a>-->
<a class="samao-link-minibtn" href="/admin/coupon_packs/set<?php if ($_smarty_tpl->tpl_vars['rs']->value['allow']==1) {?>off<?php } else { ?>on<?php }?>_allow?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
"><?php if ($_smarty_tpl->tpl_vars['rs']->value['allow']==0) {?>上架<?php } else { ?>下架<?php }?></a>
<a onclick="return confirm('确定要删除了吗？');" class="samao-link-minibtn" href="/admin/coupon_packs/delete?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">删除</a>
</td>
</form>
<script type="text/javascript" src="/public/js/clipboard.min.js"></script>
<script>
var clipboard = new Clipboard('.copyaddress_<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
');
clipboard.on('success', function(e) {
  alert("地址<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
/coupon_packs.html?coupon_id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
已复制到剪贴板中");
  console.log(e);
});

clipboard.on('error', function(e) {
  console.log(e);
});
</script>

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
