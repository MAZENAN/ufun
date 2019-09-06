<?php /* Smarty version Smarty-3.1.19, created on 2019-05-09 10:52:25
         compiled from ".\Apps\Admin\views\layout\comment_mark_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:270925cd395e93c3f01-66982084%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e811b53dd226e6e6b2a15de6a560bdd4c18fcf70' => 
    array (
      0 => '.\\Apps\\Admin\\views\\layout\\comment_mark_list.tpl',
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
  'nocache_hash' => '270925cd395e93c3f01-66982084',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'rows' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5cd395e94e3c22_33344844',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5cd395e94e3c22_33344844')) {function content_5cd395e94e3c22_33344844($_smarty_tpl) {?><?php if (!is_callable('smarty_function_pagebar')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\function.pagebar.php';
?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>点评列表</title>
<link href="/public/samaores/css/form.plane.css" rel="stylesheet" type="text/css" />
<link href="/public/samaores/css/list.plane.css" rel="stylesheet" type="text/css" />


<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.topdialog.js"></script>
<script type="text/javascript">
	$("#del").live('click', function() {
		var id=$(this).attr('rel');
		if (confirm("注意：该操作不可逆，确定取消订单吗？")) {
			window.location.href="/admin/comment_mark/delete?id="+id;
		};
	});
</script>

<!--samao model script-->
</head>
<body>
<div class="tablebox listbox margintop">
<div class="smbox-list-title">点评列表 <span id="inputbox_loading" style="display:none">正在提交中...</span></div>
<div class="smbox-list-content">



<div class="smbox-list-toptab">
	<form method="get">
		<a class="samao-link-btn samao-link-btn-refresh" href="javascript:window.location.reload()">刷新</a>
		&nbsp;&nbsp;&nbsp;&nbsp;
		<?php echo FormBox::select(array('options'=>array(array(1,'产品标题'),array(2,'订单号'),array(3,'手机号')),'name'=>"screen",),$_smarty_tpl->tpl_vars['model']->value);?>&nbsp;&nbsp;
		<?php echo FormBox::text(array('style'=>"width:120px",'name'=>"content",'value'=>((string)$_smarty_tpl->tpl_vars['content']->value),'placeholder'=>'请输入查找内容',),$_smarty_tpl->tpl_vars['model']->value);?>
		<input type="submit" value="查找" class="samao-mini-btn samao-mini-btn-search"/>
	
	</form>
</div>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="smbox-list-table" id="smbox-list-table">
<tr>

<th width="50">ID</th>
<th width="130">会员手机号</th>
<th width="80">订单号</th>
<th width="420">产品标题</th>
<th width="120">总评</th>
<th width="120">态度</th>
<th width="120">专业性</th>
<th width="120">一致度</th>
<th width="280">评论内容</th>
<th width="120">意见/建议</th>

<th width="140">评论时间</th>
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

<td align="center">
	<span class="blu"><?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
</span>
</td>
<td align="center">
	<span class="blu"><?php echo $_smarty_tpl->tpl_vars['rs']->value['mobile'];?>
</span>
</td>
<td align="center">
	<span class="blu"><?php echo $_smarty_tpl->tpl_vars['rs']->value['orderid'];?>
</span>
</td>
<td align="center">
    <a href="/<?php if ($_smarty_tpl->tpl_vars['rs']->value['type']=='0') {?>cncamp<?php } elseif ($_smarty_tpl->tpl_vars['rs']->value['type']=='1') {?>glcamp<?php }?>-<?php echo $_smarty_tpl->tpl_vars['rs']->value['cid'];?>
.html" target="_blank"><?php echo $_smarty_tpl->tpl_vars['rs']->value['title'];?>
(<?php echo $_smarty_tpl->tpl_vars['rs']->value['departure_option'];?>
)</a>
</td>
<td align="center">
	<?php echo $_smarty_tpl->tpl_vars['rs']->value['point'];?>

</td>
<td align="center">
	<?php echo $_smarty_tpl->tpl_vars['rs']->value['q1'];?>

</td>
<td align="center">
	<?php echo $_smarty_tpl->tpl_vars['rs']->value['q2'];?>

</td>
<td align="center">
	<?php echo $_smarty_tpl->tpl_vars['rs']->value['q3'];?>

</td>
<td align="center">
	<?php echo $_smarty_tpl->tpl_vars['rs']->value['info'];?>

</td>
<td align="center">
	<?php echo $_smarty_tpl->tpl_vars['rs']->value['opinion'];?>

</td>

<td align="center">
	<?php echo $_smarty_tpl->tpl_vars['rs']->value['add_time'];?>

</td>
<td align="center">
<!--<a class="samao-link-minibtn" href="/admin/comment_mark/replay?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">回复</a>-->
<a class="samao-link-minibtn" href="#" rel="<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
" id="del">删除</a>	
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
