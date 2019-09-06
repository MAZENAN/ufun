<?php /* Smarty version Smarty-3.1.19, created on 2019-05-10 13:53:22
         compiled from ".\Apps\Admin\views\layout\edit_packs_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:83945cd511d2d032c9-89892353%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3c6d80b70961800ece0361daf882b91282c97850' => 
    array (
      0 => '.\\Apps\\Admin\\views\\layout\\edit_packs_list.tpl',
      1 => 1491472337,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '83945cd511d2d032c9-89892353',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'model' => 0,
    'vals' => 0,
    'i' => 0,
    'val' => 0,
    'id' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5cd511d2db78e5_26880781',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5cd511d2db78e5_26880781')) {function content_5cd511d2db78e5_26880781($_smarty_tpl) {?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>优惠券大礼包</title>
<link rel="stylesheet" type="text/css" href="/public/samaores/css/form.plane.css"/>
<link href="/public/samaores/css/jqueryui/custom.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.validate.js"></script>
<script type="text/javascript" charset="utf-8" src="/public/samaores/js/jquery-ui.js"></script>
<script type="text/javascript" charset="utf-8" src="/public/samaores/js/samao.topdialog.js"></script>
<script type="text/javascript" charset="utf-8" src="/public/samaores/js/samao.upfile.js"></script>
<script type="text/javascript">
$(function() {$("#img").initAjaxUpFile({extensions:"jpg,jpeg,gif,png",upurl:"\/service\/upfile.php",type:1,afterUpfile:function(){upload_showimg('#img');}});});</script>
<style type="text/css">
.coupon_add{ margin: 20px 0px; width: 800px; border:1px solid #ddd; padding:0 15px; }
.coupon_add dd{ margin: 0px; }
.coupon_add dd span{ float: right; line-height: 32px; padding-right: 20px; font-size: 16px; color: #999; margin:20px 0; }
.coupon_add dd span a{ color: #999; font-size: 14px; }
.coupon_add .btn,.add_coupons_btn{ color: #FFFFFF;
    border: solid 1px #00A2CA;
    background: #00A2CA;
    padding: 0px 10px;
    float: left;
    margin: 20px 0;
    height: 25px; line-height: 25px; border-radius: 4px; }
.add_coupons_btn{ cursor: pointer; padding: 0 25px; height: 30px; line-height: 30px; }
.coupon_add2{ display: none; }
input[type=text]{ height: 28px; }
.form-box i{ color: #666; font-style: normal; }
.coupon_add .btn i{ font-style: normal; }
.form-box span{ color: #999; font-size: 14px; }
</style>
</head>
<body> 

<div class="samao-body">
<div class="form-title">优惠券大礼包</div>

<div class="samao-form">
<form method="post">


<div class="form-panel"  >
<div class="form-group"  id="row_title">
    <label class="form-label"  style="width:130px">标题：</label>
 <div class="form-box" ><?php echo FormBox::text(array('name'=>'title','class'=>'form-control text',),$_smarty_tpl->tpl_vars['model']->value);?><span id="title_info" class="field-info"></span></div>
</div>

<div class="form-group"  id="row_img">
    <label class="form-label"  style="width:130px">推荐图：</label>
 <div class="form-box" ><?php echo FormBox::upimg(array('name'=>'img','class'=>'form-control text',),$_smarty_tpl->tpl_vars['model']->value);?><span id="img_info" class="field-info"></span></div>
</div>

<div class="form-group"  id="row_pack_explain">
    <label class="form-label"  style="width:130px">礼包说明：</label>
 <div class="form-box" ><?php echo FormBox::textarea(array('name'=>'pack_explain','class'=>'form-control text','style'=>"width:500px;height:90px",),$_smarty_tpl->tpl_vars['model']->value);?></div>
</div>

<div class="form-group"  id="row_use_explain">
    <label class="form-label"  style="width:130px">使用说明：</label>
 <div class="form-box" ><?php echo FormBox::textarea(array('name'=>'use_explain','class'=>'form-control text','style'=>"width:500px;height:90px",),$_smarty_tpl->tpl_vars['model']->value);?></div>
</div>
<div class="form-group"  id="row_button_text">
    <label class="form-label"  style="width:130px">立即使用按钮文字：</label>
 <div class="form-box" ><?php echo FormBox::text(array('name'=>'button_text','class'=>'form-control text',),$_smarty_tpl->tpl_vars['model']->value);?></div>
</div>

<div class="form-group"  id="row_url">
    <label class="form-label"  style="width:130px">立即使用url：</label>
 <div class="form-box" ><?php echo FormBox::text(array('name'=>'url','class'=>'form-control text',),$_smarty_tpl->tpl_vars['model']->value);?></div>
</div>

<div class="form-group"  id="row_total_amount">
    <label class="form-label"  style="width:130px">优惠总金额：</label>
 <div class="form-box" ><?php echo FormBox::text(array('name'=>'total_amount','class'=>'form-control text',),$_smarty_tpl->tpl_vars['model']->value);?><span id="total_amount_info" class="field-info"></span></div>
</div>

<div class="form-group"  id="row_is_top">
    <label class="form-label"  style="width:130px">是否推荐：</label>
 <div class="form-box" ><?php echo FormBox::bool(array('name'=>'is_top','class'=>'form-control bool',),$_smarty_tpl->tpl_vars['model']->value);?><span class="smbox-help">推荐至官网首页</span></div>
</div>

<div style="clear:both"></div>
</div>

<div class="form-submit" >
<input type="submit" class="submit" value="提交" />
<input type="button" class="back" value="返回" onclick="window.location.href='/admin/coupon_packs/coupon_packs';" />
<div style="clear:both"></div>
</div>
</form>
	
		
<?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['val']->_loop = false;
 $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['vals']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value) {
$_smarty_tpl->tpl_vars['val']->_loop = true;
 $_smarty_tpl->tpl_vars['i']->value = $_smarty_tpl->tpl_vars['val']->key;
?>
<form method="post" action="/admin/coupon_packs/saveEdit" class="coupon_detail">
<div class="coupon_add">
	<dd><?php if ($_smarty_tpl->tpl_vars['i']->value!=0) {?><span class="fr"><a href="/admin/coupon_packs/deleteCoupon?id=<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
">删除</a></span><?php }?><div class="btn">优惠券<?php echo $_smarty_tpl->tpl_vars['i']->value+1;?>
</div></dd>
	<div class="form-group">
     <label class="form-label" style="width: 128px;"> 优惠券金额</label>
	 <div class="form-box" >
         <?php echo FormBox::text(array('name'=>'coupon','class'=>'form-control text','value'=>((string)$_smarty_tpl->tpl_vars['val']->value['coupon']),),$_smarty_tpl->tpl_vars['model']->value);?>
         <i>元</i>
	 <span id="title_info" class="field-info"></span></div>
    
	</div>
    
    <div class="form-group">
     <label class="form-label" style="width: 128px;">最小订单金额</label>
	 <div class="form-box" >
	 	<?php echo FormBox::text(array('name'=>'scope','class'=>'form-control text','value'=>((string)$_smarty_tpl->tpl_vars['val']->value['scope']),),$_smarty_tpl->tpl_vars['model']->value);?>
	 	<i>元</i>
	 <span id="title_info" class="field-info"></span></div>
	</div>
    <div class="form-group">
     <label class="form-label" style="width: 128px;">开始时间</label>
	 <div class="form-box" >
         <?php echo FormBox::datetime(array('name'=>'starttime','class'=>'form-control text','id'=>"starttime".((string)($_smarty_tpl->tpl_vars['i']->value+1)),'value'=>((string)$_smarty_tpl->tpl_vars['val']->value['starttime']),),$_smarty_tpl->tpl_vars['model']->value);?>
	 <span id="title_info" class="field-info"></span></div>
	</div>
	<div class="form-group">
     <label class="form-label" style="width: 128px;">到期时间</label>
	 <div class="form-box" >
         <?php echo FormBox::datetime(array('name'=>'deadline','class'=>'form-control text','id'=>"deadline".((string)($_smarty_tpl->tpl_vars['i']->value+1)),'value'=>((string)$_smarty_tpl->tpl_vars['val']->value['deadline']),),$_smarty_tpl->tpl_vars['model']->value);?>
	 <span id="title_info" class="field-info"></span></div>
	</div>
	<div class="form-group">
		<label class="form-label" style="width: 128px;">可用活动</label>
	 <div class="form-box" >
         <?php echo FormBox::text(array('name'=>'camp_id','class'=>'form-control text','value'=>((string)$_smarty_tpl->tpl_vars['val']->value['camp_id']),),$_smarty_tpl->tpl_vars['model']->value);?>
	     <span>产品id以英文逗号分隔,不填则为全部可用</span>
	 <span id="title_info" class="field-info"></span></div>
	</div>
         <div class="form-group" style="display:none;">
         <?php echo FormBox::text(array('name'=>'pack_id','class'=>'form-control text','value'=>((string)$_smarty_tpl->tpl_vars['id']->value),),$_smarty_tpl->tpl_vars['model']->value);?>
         <?php echo FormBox::text(array('name'=>'allow','class'=>'form-control text','value'=>"1",),$_smarty_tpl->tpl_vars['model']->value);?>
         <input name="cid" value="<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
" class="form-control text" />
	</div>
	<div class="form-submit" >
	<input type="submit" class="submit" value="保存" />
	<div style="clear:both"></div>
	</div>
</div>
</form>
<?php } ?>
<div class="coupon_add2">	
<form method="post" action="/admin/coupon_packs/saveCoupon">
		<div class="coupon_add">
			<dd><span class="fr"><a href="javascript:()">删除</a></span><div class="btn">优惠券<i></i></div></dd>
	<div class="form-group">
     <label class="form-label" style="width: 128px;"> 优惠券金额</label>
	 <div class="form-box" >
	 <?php echo FormBox::text(array('name'=>'coupon','class'=>'form-control text','value'=>'',),$_smarty_tpl->tpl_vars['model']->value);?> <i>元</i>
	 <span id="title_info" class="field-info"></span></div>
   
	</div>
	<div class="form-group">
     <label class="form-label" style="width: 128px;">最小订单金额</label>
	 <div class="form-box" >
	 <?php echo FormBox::text(array('name'=>'scope','class'=>'form-control text','value'=>'',),$_smarty_tpl->tpl_vars['model']->value);?> <i>元</i>
	 <span id="title_info" class="field-info"></span></div>
	</div>
         <div class="form-group">
     <label class="form-label" style="width: 128px;">开始时间</label>
	 <div class="form-box" >
	 <?php echo FormBox::datetime(array('name'=>'starttime','class'=>'form-control text n_starttime','value'=>'','id'=>"n_starttime",),$_smarty_tpl->tpl_vars['model']->value);?>
         <span id="title_info" class="field-info"></span></div>
	</div>
	<div class="form-group">
     <label class="form-label" style="width: 128px;">到期时间</label>
	 <div class="form-box" >
	 <?php echo FormBox::datetime(array('name'=>'deadline','class'=>'form-control text n_deadline','value'=>'','id'=>"n_deadline",),$_smarty_tpl->tpl_vars['model']->value);?>
         <span id="title_info" class="field-info"></span></div>
	</div>
	<div class="form-group">
     <label class="form-label" style="width: 128px;">可用活动</label>
	 <div class="form-box" >
	 <?php echo FormBox::text(array('name'=>'camp_id','class'=>'form-control text','value'=>'',),$_smarty_tpl->tpl_vars['model']->value);?>
	  <span>产品id以英文逗号分隔(最后一个也需要),不填则为全部可用</span>
	 <span id="title_info" class="field-info"></span></div>
	</div>
          <div class="form-group" style="display:none;">
         <?php echo FormBox::text(array('name'=>'pack_id','class'=>'form-control text','value'=>((string)$_smarty_tpl->tpl_vars['id']->value),),$_smarty_tpl->tpl_vars['model']->value);?>
         <?php echo FormBox::text(array('name'=>'allow','class'=>'form-control text','value'=>"1",),$_smarty_tpl->tpl_vars['model']->value);?>
	</div>
	<div class="form-submit" >
	<input type="submit" class="submit" value="保存" />
	<div style="clear:both"></div>
	</div>
</div>	
	</form>
	</div>
	<div class="add_coupons_btn">添加优惠券</div>
</div></div>
<script type="text/javascript">
$(document).ready(function(){
	 $(".add_coupons_btn").click(function(){
		$(".coupon_add2").toggle();
		$(".add_coupons_btn").toggle();
	 });
	 $(".coupon_add dd span a").click(function(){
         $(".coupon_add2").toggle();
         $(".add_coupons_btn").toggle();
	 });
		 	
});
	
</script>
</body>
</html>
<?php }} ?>
