<html>
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
 <div class="form-box" >{@form_text name='title' class='form-control text' model=$model@}<span id="title_info" class="field-info"></span></div>
</div>

<div class="form-group"  id="row_img">
    <label class="form-label"  style="width:130px">推荐图：</label>
 <div class="form-box" >{@form_upimg name='img' class='form-control text' model=$model@}<span id="img_info" class="field-info"></span></div>
</div>

<div class="form-group"  id="row_pack_explain">
    <label class="form-label"  style="width:130px">礼包说明：</label>
 <div class="form-box" >{@form_textarea name='pack_explain' class='form-control text' style="width:500px;height:90px" model=$model@}</div>
</div>

<div class="form-group"  id="row_use_explain">
    <label class="form-label"  style="width:130px">使用说明：</label>
 <div class="form-box" >{@form_textarea name='use_explain' class='form-control text' style="width:500px;height:90px"  model=$model@}</div>
</div>
<div class="form-group"  id="row_button_text">
    <label class="form-label"  style="width:130px">立即使用按钮文字：</label>
 <div class="form-box" >{@form_text name='button_text' class='form-control text' model=$model@}</div>
</div>

<div class="form-group"  id="row_url">
    <label class="form-label"  style="width:130px">立即使用url：</label>
 <div class="form-box" >{@form_text name='url' class='form-control text' model=$model@}</div>
</div>

<div class="form-group"  id="row_total_amount">
    <label class="form-label"  style="width:130px">优惠总金额：</label>
 <div class="form-box" >{@form_text name='total_amount' class='form-control text' model=$model@}<span id="total_amount_info" class="field-info"></span></div>
</div>

<div class="form-group"  id="row_is_top">
    <label class="form-label"  style="width:130px">是否推荐：</label>
 <div class="form-box" >{@form_bool name='is_top' class='form-control bool' model=$model@}<span class="smbox-help">推荐至官网首页</span></div>
</div>

<div style="clear:both"></div>
</div>

<div class="form-submit" >
<input type="submit" class="submit" value="提交" />
<input type="button" class="back" value="返回" onclick="window.location.href='__SELF__/coupon_packs';" />
<div style="clear:both"></div>
</div>
</form>
	
		
{@foreach from = $vals item=val key=i@}
<form method="post" action="__SELF__/saveEdit" class="coupon_detail">
<div class="coupon_add">
	<dd>{@if $i!=0@}<span class="fr"><a href="__SELF__/deleteCoupon?id={@$val.id@}">删除</a></span>{@/if@}<div class="btn">优惠券{@$i+1@}</div></dd>
	<div class="form-group">
     <label class="form-label" style="width: 128px;"> 优惠券金额</label>
	 <div class="form-box" >
         {@form_text name='coupon' class='form-control text' value="{@$val.coupon@}" model=$model@}
         <i>元</i>
	 <span id="title_info" class="field-info"></span></div>
    
	</div>
    
    <div class="form-group">
     <label class="form-label" style="width: 128px;">最小订单金额</label>
	 <div class="form-box" >
	 	{@form_text name='scope' class='form-control text' value="{@$val.scope@}" model=$model@}
	 	<i>元</i>
	 <span id="title_info" class="field-info"></span></div>
	</div>
    <div class="form-group">
     <label class="form-label" style="width: 128px;">开始时间</label>
	 <div class="form-box" >
         {@form_datetime name='starttime' class='form-control text' id="starttime{@$i+1@}"  value="{@$val.starttime@}" model=$model@}
	 <span id="title_info" class="field-info"></span></div>
	</div>
	<div class="form-group">
     <label class="form-label" style="width: 128px;">到期时间</label>
	 <div class="form-box" >
         {@form_datetime name='deadline' class='form-control text' id="deadline{@$i+1@}"  value="{@$val.deadline@}" model=$model@}
	 <span id="title_info" class="field-info"></span></div>
	</div>
	<div class="form-group">
		<label class="form-label" style="width: 128px;">可用活动</label>
	 <div class="form-box" >
         {@form_text name='camp_id' class='form-control text' value="{@$val.camp_id@}" model=$model@}
	     <span>产品id以英文逗号分隔,不填则为全部可用</span>
	 <span id="title_info" class="field-info"></span></div>
	</div>
         <div class="form-group" style="display:none;">
         {@form_text name='pack_id' class='form-control text' value="{@$id@}" model=$model@}
         {@form_text name='allow' class='form-control text' value="1" model=$model@}
         <input name="cid" value="{@$val.id@}" class="form-control text" />
	</div>
	<div class="form-submit" >
	<input type="submit" class="submit" value="保存" />
	<div style="clear:both"></div>
	</div>
</div>
</form>
{@/foreach@}
<div class="coupon_add2">	
<form method="post" action="__SELF__/saveCoupon">
		<div class="coupon_add">
			<dd><span class="fr"><a href="javascript:()">删除</a></span><div class="btn">优惠券<i></i></div></dd>
	<div class="form-group">
     <label class="form-label" style="width: 128px;"> 优惠券金额</label>
	 <div class="form-box" >
	 {@form_text name='coupon' class='form-control text' value=""  model=$model@} <i>元</i>
	 <span id="title_info" class="field-info"></span></div>
   
	</div>
	<div class="form-group">
     <label class="form-label" style="width: 128px;">最小订单金额</label>
	 <div class="form-box" >
	 {@form_text name='scope' class='form-control text' value="" model=$model@} <i>元</i>
	 <span id="title_info" class="field-info"></span></div>
	</div>
         <div class="form-group">
     <label class="form-label" style="width: 128px;">开始时间</label>
	 <div class="form-box" >
	 {@form_datetime name='starttime' class='form-control text n_starttime' value=""  id="n_starttime"  model=$model@}
         <span id="title_info" class="field-info"></span></div>
	</div>
	<div class="form-group">
     <label class="form-label" style="width: 128px;">到期时间</label>
	 <div class="form-box" >
	 {@form_datetime name='deadline' class='form-control text n_deadline' value=""  id="n_deadline"  model=$model@}
         <span id="title_info" class="field-info"></span></div>
	</div>
	<div class="form-group">
     <label class="form-label" style="width: 128px;">可用活动</label>
	 <div class="form-box" >
	 {@form_text name='camp_id' class='form-control text' value=""  model=$model@}
	  <span>产品id以英文逗号分隔(最后一个也需要),不填则为全部可用</span>
	 <span id="title_info" class="field-info"></span></div>
	</div>
          <div class="form-group" style="display:none;">
         {@form_text name='pack_id' class='form-control text' value="{@$id@}" model=$model@}
         {@form_text name='allow' class='form-control text' value="1" model=$model@}
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
