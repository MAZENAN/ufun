<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>优惠券</title>
<link rel="stylesheet" type="text/css" href="/public/samaores/css/form.plane.css"/>
<link href="/public/samaores/css/jqueryui/custom.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.validate.js"></script>
<script type="text/javascript" charset="utf-8" src="/public/samaores/js/samao.select.js"></script>
<script type="text/javascript" charset="utf-8" src="/public/samaores/js/jquery-ui.js"></script>
<script type="text/javascript" charset="utf-8" src="/public/samaores/js/jquery.ui.datepicker-zh-CN.js"></script>
<script type="text/javascript">
$(function() {$("#deadline").datepicker({dateFormat:'yy-mm-dd',changeMonth: true,changeYear:true,yearRange:'1900:2050'});});</script>

</head>
<body>

<div class="samao-body">
<div class="form-title">优惠券</div>

<div class="samao-form">
{@if $cid@}
<form method="post" action="__SELF__/saveEdit">
{@else@}
<form method="post" action="__SELF__/saveCoupon">
{@/if@}

<div class="form-panel"  >


<div class="form-group"  id="row_coupon">
    <label class="form-label"  style="width:130px">优惠券金额：</label>
 <div class="form-box" >{@form_text name='coupon' class='form-control text' model=$model@}<span id="coupon_info" class="field-info"></span></div>
</div>


<div class="form-group"  id="row_scope">
    <label class="form-label"  style="width:130px">最低订单金额：</label>
 <div class="form-box" >{@form_text name='scope' class='form-control text' model=$model@}<span id="scope_info" class="field-info"></span></div>
</div>

<div class="form-group"  id="row_deadline">
    <label class="form-label"  style="width:130px">到期时间：</label>
 <div class="form-box" >{@form_date name='deadline' class='form-control text' model=$model@}<span id="deadline_info" class="field-info"></span></div>
</div>

<div class="form-group"  id="row_camp_id">
    <label class="form-label"  style="width:130px">可用活动：</label>
 <div class="form-box" >{@form_text name='camp_id'  placeholder= '粘贴可用产品id，用英文逗号隔开' class='form-control text' model=$model@}<span class="smbox-help">全部产品都可用则不填</span></div>
</div>

<input name="pack_id" id="pack_id" class="form-control text" value="{@$id@}" type="hidden"  />
<input name="cid" id="cid" class="form-control text" value="{@$cid@}" type="hidden"  />
<div style="clear:both"></div>
</div>

<div class="form-submit" >
<input type="submit" class="submit" value="提交" />
<input type="button" class="back" value="返回" onclick="javascript:history.go(-1);" />
<div style="clear:both"></div>
</div>

</form>
</div></div>
</body>
</html>
