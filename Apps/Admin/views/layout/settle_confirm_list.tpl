{@extends file='@model_list.tpl'@}
<!--标题-->
{@block name=title@}{@if $key==''@}BD结算审核列表{@else@}高级销售审核列表{@/if@}{@/block@}
<!--头部脚本区-->
{@block name=head@}
<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.topdialog.js"></script>

<script type="text/javascript">

	 
	 $("input[name='button']").live('click',function(){
	 	var log = $("#log").val();
	 	var state = $("input[name='check_status']").attr('checked');
	 	if(log == 'log' && state == undefined){
	 		var txt=$('#error_log').val();//alert(txt.length);alert(state);
	 		if(txt ==''){
	 			var error='请填写未通过原因';
	 			$("#error_log_info").html(error);return;
	 		}else{
	 			$("#form").submit();
	 		}
	 	}else{
	 		$("#form").submit();
	 	}
	 	 
	 });
	$("input[name='check_status']").live('click',function(){
	 	
	 	var state=$("input[name='check_status']").attr("checked");
	 	if(state == undefined){
	 		$("#row_error_log").show();
	 	}else{
	 		$("#row_error_log").hide();
	 	}
	 	
	 });
</script>
{@/block@}
<!--表格顶部区域-->
{@block name=table_topbar@}
{@/block@}
<!--表头列-->
{@block name=table_ths@}
<th width="30">序号</th>
<th width="80">供应商</th>
<th width="80">产品名称</th>
<th width="100">订单号</th>
<th width="100">总费用</th>
<th width="80">结算价</th>
<th width="120">结算状态</th>
<form action="settleConfirm" method="post" id="form">
<input type="hidden" name="confirm_list" value="1">
{@/block@}
<!--总列数合并单元格时可用-->
{@block name=colspan@}

{@/block@}
<!--表行列-->

{@block name=table_tds@}
<tr {@if $rs.refund==2@}class="tr_red"{@/if@}>
<td align="center">{@$ttl+1@}</td>
<td align="center">
	<span class="blu">{@$rs.seller_id|smval:'@pf_member':'nickname'@}</span>
	<input type="hidden" name="id[]" value="{@$rs.id@}">
	
</td>
<td align="center">
	<a href="/{@if $rs.type == 0@}cncamp{@else@}glcamp{@/if@}-{@$rs.campid@}.html" target="_blank">{@$rs.title@}</a>
</td>
<td align="center">
	<span >{@$rs.orderid@}</span>
</td>
<td align="center">
	{@$rs.need_topay@}&nbsp;元
</td>
<td align="center">
	{@if $rs.scommision !=''@}{@$rs.scommision@}&nbsp;元{@/if@}
</td>

<td align="center">
	{@$rs.settle_state|case:['0','1','2','3','4','5','6','7']:['BD待审核','高级销售待审核','财务待审核','结算完成','结算退款待BD审核','结算退款待高级销售审核','结算退款待财务审核','结算退款完成']@}
</td>
</tr>
{@/block@}
{@block name=allopts@}

<input type="hidden" name="key" value="{@$key@}">
{@/block@}
{@block name=information@}
{@if $key !=''@}
<div class="form-group"  id="row_check_status">
    <label class="form-label"  style="width:150px">审核状态：</label>
{@form_radiogroup   name="check_status" model=$model @}
</div>
<input type="hidden"  value="log" id="log"/>
<div class="form-group"  id="row_error_log">
    <label class="form-label"  style="width:150px">审核未通过原因：</label>
 <div class="form-box" >{@form_textarea  name="error_log" model=$model@}<span id="error_log_info" class="field-info field-val-error"></span></div>

</div>
{@/if@}
<div class="form-submit" >
<input type="button" name="button" class="submit" value="提交"/>
<input type="button"  value="返回" onclick="javascript:(window.history.go(-1))"/>
<div style="clear:both"></div>
</div>
</form>
{@/block@}
