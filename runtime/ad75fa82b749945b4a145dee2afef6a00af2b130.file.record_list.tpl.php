<?php /* Smarty version Smarty-3.1.19, created on 2019-07-02 17:15:04
         compiled from ".\Apps\Admin\views\layout\record_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4013089865d1b20989f4968-38506194%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ad75fa82b749945b4a145dee2afef6a00af2b130' => 
    array (
      0 => '.\\Apps\\Admin\\views\\layout\\record_list.tpl',
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
  'nocache_hash' => '4013089865d1b20989f4968-38506194',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'rows' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5d1b2098a60db7_56705437',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d1b2098a60db7_56705437')) {function content_5d1b2098a60db7_56705437($_smarty_tpl) {?><?php if (!is_callable('smarty_function_pagebar')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\function.pagebar.php';
?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>销售跟进记录</title>
<link href="/public/samaores/css/form.plane.css" rel="stylesheet" type="text/css" />
<link href="/public/samaores/css/list.plane.css" rel="stylesheet" type="text/css" />


<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.topdialog.js"></script>
<script type="text/javascript" charset="utf-8" src="/public/samaores/js/jquery-ui.js"></script>
<script type="text/javascript" src="/public/samaores/js/jquery.ui.datepicker-zh-CN.js"></script>
<script type="text/javascript" src="/public/js/highcharts.js"></script>
<script type="text/javascript" src="/public/js/exporting.js"></script>

<script type="text/javascript">
$(function() {$("#addtime").datepicker({dateFormat:'yy-mm-dd',changeMonth: true,changeYear:true,yearRange:'1900:2050'});});
$(function() {$("#addtime_to").datepicker({dateFormat:'yy-mm-dd',changeMonth: true,changeYear:true,yearRange:'1900:2050'});});</script>
<script language="javascript" type="text/javascript" src="/public/js/admin/TableSorterV2.js"></script>
<script language="javascript" type="text/javascript">
window.onload = function()
{
    new TableSorter("smbox-list-table");
}
    </script>
<style>.smbox-list-table{ width:1760px;} .smbox-list-table100{ width: 100%;} .form-list h3{ padding-left: 20px;}
table{ float: left; margin-left: 20px; }
.form-list{overflow: hidden;}
.form-list h3{ float: left; }
.form-list h3.first{ width: 900px; }
</style>
<link href="/public/samaores/css/jqueryui/custom.css" rel="stylesheet" type="text/css" />
<link href="/public/samaores/css/list.plane.css" rel="stylesheet" type="text/css" />
<link href="/public/samaores/css/form.plane.css" rel="stylesheet" type="text/css" />


<!--samao model script-->
</head>
<body>
<div class="tablebox listbox margintop">
<div class="smbox-list-title">销售跟进记录 <span id="inputbox_loading" style="display:none">正在提交中...</span></div>
<div class="smbox-list-content">

<div class="smbox-toptags">
	<form method="get">
		<a class="samao-link-btn samao-link-btn-refresh" href="javascript:window.location.reload()">刷新</a>&nbsp;&nbsp;
		<?php echo FormBox::select(array('onchange'=>'this.form.submit();','header'=>"课程顾问",'options'=>DB::getopts('@pf_manage','id,name',0,"type in(7,8,12,13) and islock = 0"),'name'=>"manage_id",'value'=>((string)$_smarty_tpl->tpl_vars['sch']->value['manage_id']),),$_smarty_tpl->tpl_vars['schmodel']->value);?>&nbsp;&nbsp;
		<input name="addtime" id="addtime" class="form-control date" style="width:100px;" placeholder="请选择跟进日期" type="text" <?php if ($_smarty_tpl->tpl_vars['sch']->value['addtime']) {?>value="<?php echo $_smarty_tpl->tpl_vars['sch']->value['addtime'];?>
" <?php }?>/>-
		<input name="addtime_to" id="addtime_to" class="form-control date" style="width:100px;" placeholder="请选择截至日期" type="text" <?php if ($_smarty_tpl->tpl_vars['sch']->value['addtime_to']) {?>value="<?php echo $_smarty_tpl->tpl_vars['sch']->value['addtime_to'];?>
" <?php }?>/>		
		<input type="submit" value="查找" class="samao-mini-btn samao-mini-btn-search"/>&nbsp;&nbsp;
	</form>
</div>

<div class="form-list"><h3 class="first">跟进记录</h3><?php if (empty($_smarty_tpl->tpl_vars['sch']->value['manage_id'])) {?><h3>总数</h3><?php }?></div>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="1" class="smbox-list-table2 table" id="smbox-list-table2" >
	<tr>
		<th width="10%" align="center" bgcolor="#f7f7f7">负责人</th>
		<th width="15%" align="center" bgcolor="#f7f7f7">时间</th>
		<th width="10%" align="center" bgcolor="#f7f7f7">跟进用户</th>
		<?php if ($_smarty_tpl->tpl_vars['sch']->value['manage_id']) {?>
		<th width="10%" align="center" bgcolor="#f7f7f7">用户手机号</th>
		<th width="10%" align="center" bgcolor="#f7f7f7">跟进方式</th>
		<?php }?>
		<th width="55%" align="center" bgcolor="#f7f7f7">跟进结果</th>
		
	</tr>
	<?php  $_smarty_tpl->tpl_vars['manage'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['manage']->_loop = false;
 $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['rows']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['manage']->key => $_smarty_tpl->tpl_vars['manage']->value) {
$_smarty_tpl->tpl_vars['manage']->_loop = true;
 $_smarty_tpl->tpl_vars['i']->value = $_smarty_tpl->tpl_vars['manage']->key;
?>
	<tr>
		<td align="center" bgcolor="#FFFFFF">
		    <span class="blu"><?php echo DB::getval('@pf_manage','name',$_smarty_tpl->tpl_vars['manage']->value['manage_id']);?>
</span>
		</td>
		<td align="center" bgcolor="#FFFFFF">
			<span class="blu"><?php echo $_smarty_tpl->tpl_vars['manage']->value['add_time'];?>
</span>
		</td>
		<td align="center" bgcolor="#FFFFFF">
			<span class="blu"><?php echo $_smarty_tpl->tpl_vars['manage']->value['c_name'];?>
</span>
		</td>
		<?php if ($_smarty_tpl->tpl_vars['sch']->value['manage_id']) {?>
		<td align="center" bgcolor="#FFFFFF">
			<span class="blu"><?php echo $_smarty_tpl->tpl_vars['manage']->value['c_mobile'];?>
</span>
		</td>
		<td align="center" bgcolor="#FFFFFF">
			<span class="blu"><?php echo $_smarty_tpl->tpl_vars['manage']->value['contact'];?>
</span>
		</td>
		<?php }?>
		<td align="center" bgcolor="#FFFFFF">
	                <span class="blu"><?php echo $_smarty_tpl->tpl_vars['manage']->value['content'];?>
</span>
		</td>
	</tr>
	<?php } ?>	
</table>
<?php if (empty($_smarty_tpl->tpl_vars['sch']->value['manage_id'])) {?>
<table width="150" border="0" align="center" cellpadding="0" cellspacing="1" class="smbox-list-table2 table2" id="smbox-list-table2" >
	<tr>
		<th align="center" bgcolor="#f7f7f7">全部</th>	
                <th align="center" bgcolor="#f7f7f7"><?php echo $_smarty_tpl->tpl_vars['count']->value;?>
</th>
	</tr>
        <?php  $_smarty_tpl->tpl_vars['m'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['m']->_loop = false;
 $_smarty_tpl->tpl_vars['n'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['info']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['m']->key => $_smarty_tpl->tpl_vars['m']->value) {
$_smarty_tpl->tpl_vars['m']->_loop = true;
 $_smarty_tpl->tpl_vars['n']->value = $_smarty_tpl->tpl_vars['m']->key;
?>
            <?php if (is_array($_smarty_tpl->tpl_vars['m']->value)) {?>
	<tr>
		<td align="center" bgcolor="#ffffff"><?php echo DB::getval('@pf_manage','name',$_smarty_tpl->tpl_vars['m']->value['mid']);?>
</td>		
                <td align="center" bgcolor="#ffffff"><?php echo $_smarty_tpl->tpl_vars['m']->value['num'];?>
</td>
        </tr>
	
        <?php }?>
            <?php } ?>
</table>
<?php }?>
<div class="cls"></div>


<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="smbox-list-table" id="smbox-list-table">
<tr>

</tr>
<?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_smarty_tpl->tpl_vars['ttl'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['rows']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
 $_smarty_tpl->tpl_vars['ttl']->value = $_smarty_tpl->tpl_vars['rs']->key;
?>
<tr  onmouseover="this.oldBgcolor=this.style.backgroundColor;this.style.backgroundColor='#FCFCF8';" onmouseout="this.style.backgroundColor=this.oldBgcolor">

</tr>
<?php } ?>

</table>

	<div class="samao-pagebar"><?php echo smarty_function_pagebar(array('pdata'=>$_smarty_tpl->tpl_vars['bar']->value),$_smarty_tpl);?>
</div>
	<script type="text/javascript">
	$(document).ready(function(){
		$(".table2").prev(".table").width("900px");
	});
</script>

</div>
<div class="smbox-info-tips">


</div>
</div>

</body>
</html><?php }} ?>
