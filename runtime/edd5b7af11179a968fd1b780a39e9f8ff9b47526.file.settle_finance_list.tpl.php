<?php /* Smarty version Smarty-3.1.19, created on 2019-05-14 16:54:39
         compiled from ".\Apps\Admin\views\layout\settle_finance_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:304455cda824f28b150-34791571%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'edd5b7af11179a968fd1b780a39e9f8ff9b47526' => 
    array (
      0 => '.\\Apps\\Admin\\views\\layout\\settle_finance_list.tpl',
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
  'nocache_hash' => '304455cda824f28b150-34791571',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'rows' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5cda824f363c36_62681917',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5cda824f363c36_62681917')) {function content_5cda824f363c36_62681917($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_sprint')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\modifier.sprint.php';
?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>财务最终审核</title>
<link href="/public/samaores/css/form.plane.css" rel="stylesheet" type="text/css" />
<link href="/public/samaores/css/list.plane.css" rel="stylesheet" type="text/css" />


<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.topdialog.js"></script>
<style>.smbox-list-content{ width:1700px;}</style>
<script type="text/javascript">

	$("input[name='submit']").live('click', function() {
		var val=$(this).attr('id');
		var price = $("#price_"+val).val();
		//alert(price);return;
		
	 	if(confirm("注意：该操作不可逆，确定结算订单吗？")){
	 		$("#cost_"+val).click();
	  }
		
	});
	 	 
	 
	
</script>

<!--samao model script-->
</head>
<body>
<div class="tablebox listbox margintop">
<div class="smbox-list-title">财务最终审核 <span id="inputbox_loading" style="display:none">正在提交中...</span></div>
<div class="smbox-list-content">



<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="smbox-list-table" id="smbox-list-table">
<tr>

<th width="380">产品名称</th>
<th width="100">订单号</th>
<th width="70">总费用</th>
<th width="70">结算价</th>
<th width="120">佣金</th>
<th width="70">负责人</th>
<th width="120">结算状态</th>
<th width="120">备注</th>
<th width="110">财务确认时间</th>
<th width="120">结算备注</th>
<th width="120">操作</th>



</tr>
<?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_smarty_tpl->tpl_vars['ttl'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['rows']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
 $_smarty_tpl->tpl_vars['ttl']->value = $_smarty_tpl->tpl_vars['rs']->key;
?>
<tr  onmouseover="this.oldBgcolor=this.style.backgroundColor;this.style.backgroundColor='#FCFCF8';" onmouseout="this.style.backgroundColor=this.oldBgcolor">

<?php  $_smarty_tpl->tpl_vars['srs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['srs']->_loop = false;
 $_smarty_tpl->tpl_vars['tt'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['rs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['srs']->key => $_smarty_tpl->tpl_vars['srs']->value) {
$_smarty_tpl->tpl_vars['srs']->_loop = true;
 $_smarty_tpl->tpl_vars['tt']->value = $_smarty_tpl->tpl_vars['srs']->key;
?>
<tr <?php if ($_smarty_tpl->tpl_vars['srs']->value['refund']==2) {?>class="tr_red"<?php }?>>
<td align="center">
	<a href="/<?php if ($_smarty_tpl->tpl_vars['srs']->value['type']==0) {?>cncamp<?php } else { ?>glcamp<?php }?>-<?php echo $_smarty_tpl->tpl_vars['srs']->value['campid'];?>
.html" target="_blank"><?php echo $_smarty_tpl->tpl_vars['srs']->value['title'];?>
(<?php echo $_smarty_tpl->tpl_vars['srs']->value['departure_option'];?>
)</a>
</td>
<td align="center">
	<span ><?php echo $_smarty_tpl->tpl_vars['srs']->value['orderid'];?>
</span><!-- span class="blu"><?php echo DB::getval('@pf_member','nickname',$_smarty_tpl->tpl_vars['rs']->value['seller_id']);?>
</span> -->
</td>
<td align="center">
	<?php echo $_smarty_tpl->tpl_vars['srs']->value['paid'];?>
&nbsp;元
</td>
<td align="center">
	<span ><?php echo $_smarty_tpl->tpl_vars['srs']->value['scommision'];?>
</span>&nbsp;<?php if ($_smarty_tpl->tpl_vars['srs']->value['scommision']!='') {?>元<?php }?>
</td>
<td align="center">
	<?php if ($_smarty_tpl->tpl_vars['srs']->value['scommision']!=0) {?><?php echo smarty_modifier_sprint((($_smarty_tpl->tpl_vars['srs']->value['paid']-$_smarty_tpl->tpl_vars['srs']->value['scommision'])/$_smarty_tpl->tpl_vars['srs']->value['scommision']*100));?>
&nbsp;%(<?php echo $_smarty_tpl->tpl_vars['srs']->value['paid']-$_smarty_tpl->tpl_vars['srs']->value['scommision'];?>
元)<?php } else { ?>-<?php }?>
</td>
<td align="center">
	<?php echo DB::getval('@pf_manage','name',$_smarty_tpl->tpl_vars['srs']->value['manage_id']);?>

</td>
<td align="center">
	<?php echo ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['srs']->value['settle_state'],array('0','1','2','3','4','5','6','7'))) && array_key_exists($_tempkey,$_temparr=array('BD待审核','高级销售待审核','财务待审核','结算完成','结算退款待BD审核','结算退款待高级销售审核','结算退款待财务审核','结算退款完成'))?$_temparr[$_tempkey]:'');?>

</td>
<td align="center">
	<?php if ($_smarty_tpl->tpl_vars['srs']->value['payremark1']!='') {?><?php echo $_smarty_tpl->tpl_vars['srs']->value['payremark1'];?>
<?php } else { ?><?php echo $_smarty_tpl->tpl_vars['srs']->value['payremark2'];?>
<?php }?>
</td>
<td align="center">
	<?php echo $_smarty_tpl->tpl_vars['srs']->value['crm_time'];?>

</td>
<td align="center">
	<?php echo $_smarty_tpl->tpl_vars['srs']->value['settle_remark'];?>

</td>
<td align="center">
	<a dialog="1" class="samao-link-minibtn" href="/admin/order/detail?id=<?php echo $_smarty_tpl->tpl_vars['srs']->value['id'];?>
">订单详情</a>
	<a class="samao-link-minibtn" href="/admin/order/audit?id=<?php echo $_smarty_tpl->tpl_vars['srs']->value['id'];?>
<?php if ($_smarty_tpl->tpl_vars['key']->value) {?>&key=<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
<?php }?>">审核</a>
</td>
</tr>
<?php } ?>
<tr>
	<?php $_smarty_tpl->tpl_vars['price'] = new Smarty_variable(DB::getone("select SUM(scommision) from @pf_order as o join @pf_camp join @pf_member as mb on o.campid=@pf_camp.id and  @pf_camp.seller_id = mb.id where state in(?,?) and refund = ? and crm_state in(?,?) and settle_state = ? and @pf_camp.seller_id=?",array(3,8,0,2,10,2,$_smarty_tpl->tpl_vars['srs']->value['seller_id'])), null, 0);?>
	<?php $_smarty_tpl->tpl_vars['refund'] = new Smarty_variable(DB::getone("select SUM(scommision) from @pf_order as o join @pf_camp join @pf_member as mb on o.campid=@pf_camp.id and  @pf_camp.seller_id = mb.id where state =? and refund = ? and crm_state =? and settle_state = ? and @pf_camp.seller_id=?",array(5,2,2,6,$_smarty_tpl->tpl_vars['srs']->value['seller_id'])), null, 0);?>
	<td colspan="1" align="center" style="font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;供应商名称：<span><?php echo $_smarty_tpl->tpl_vars['ttl']->value;?>
</span>
	<dd style="padding-left: 40px; display: inline-block;">结算价格合计：<span><?php echo $_smarty_tpl->tpl_vars['price']->value['SUM(scommision)']-$_smarty_tpl->tpl_vars['refund']->value['SUM(scommision)'];?>
&nbsp;元</span></dd>
	</td>
	
	

	<td colspan="8">
<form action="settleFinance" method="post" class="form-submit form-submit2">
		<?php  $_smarty_tpl->tpl_vars['id'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['id']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['rs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['id']->key => $_smarty_tpl->tpl_vars['id']->value) {
$_smarty_tpl->tpl_vars['id']->_loop = true;
?><input type="hidden" name="id[]" value="<?php echo $_smarty_tpl->tpl_vars['id']->value['id'];?>
"><?php } ?>
	<input type="hidden" name="key" value="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
">
	<input type="hidden" name="price" id="price_<?php echo $_smarty_tpl->tpl_vars['srs']->value['seller_id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['price']->value['SUM(scommision)']-$_smarty_tpl->tpl_vars['refund']->value['SUM(scommision)'];?>
">
	<input type="button" name="submit" value="结算" id="<?php echo $_smarty_tpl->tpl_vars['srs']->value['seller_id'];?>
" class="submit"><input type="submit" value="" id="cost_<?php echo $_smarty_tpl->tpl_vars['srs']->value['seller_id'];?>
" style="display:none"></form></td>
	

	
	
</tr>

</tr>
<?php } ?>

	


</table>

</div>
<div class="smbox-info-tips">


</div>
</div>

</body>
</html><?php }} ?>
