{@extends file='@model_list.tpl'@}
<!--标题-->
{@block name=title@}财务最终审核{@/block@}
<!--头部脚本区-->
{@block name=head@}
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
{@/block@}
<!--表格顶部区域-->
{@block name=table_topbar@}
{@/block@}
<!--表头列-->
{@block name=table_ths@}
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


{@/block@}
<!--总列数合并单元格时可用-->
{@block name=colspan@}

{@/block@}
<!--表行列-->

{@block name=table_tds@}
{@foreach from=$rs item=srs key=tt@}
<tr {@if $srs.refund==2@}class="tr_red"{@/if@}>
<td align="center">
	<a href="/{@if $srs.type == 0@}cncamp{@else@}glcamp{@/if@}-{@$srs.campid@}.html" target="_blank">{@$srs.title@}({@$srs.departure_option@})</a>
</td>
<td align="center">
	<span >{@$srs.orderid@}</span><!-- span class="blu">{@$rs.seller_id|smval:'@pf_member':'nickname'@}</span> -->
</td>
<td align="center">
	{@$srs.paid@}&nbsp;元
</td>
<td align="center">
	<span >{@$srs.scommision@}</span>&nbsp;{@if $srs.scommision !=''@}元{@/if@}
</td>
<td align="center">
	{@if $srs.scommision!=0 @}{@(($srs.paid-$srs.scommision)/$srs.scommision*100)|sprint@}&nbsp;%({@$srs.paid-$srs.scommision@}元){@else@}-{@/if@}
</td>
<td align="center">
	{@$srs.manage_id|smval:'@pf_manage':'name'@}
</td>
<td align="center">
	{@$srs.settle_state|case:['0','1','2','3','4','5','6','7']:['BD待审核','高级销售待审核','财务待审核','结算完成','结算退款待BD审核','结算退款待高级销售审核','结算退款待财务审核','结算退款完成']@}
</td>
<td align="center">
	{@if $srs.payremark1 != ''@}{@$srs.payremark1@}{@else@}{@$srs.payremark2@}{@/if@}
</td>
<td align="center">
	{@$srs.crm_time@}
</td>
<td align="center">
	{@$srs.settle_remark@}
</td>
<td align="center">
	<a dialog="1" class="samao-link-minibtn" href="__SELF__/detail?id={@$srs.id@}">订单详情</a>
	<a class="samao-link-minibtn" href="__SELF__/audit?id={@$srs.id@}{@if $key@}&key={@$key@}{@/if@}">审核</a>
</td>
</tr>
{@/foreach@}
<tr>
	{@$price=DB::getone("select SUM(scommision) from @pf_order as o join @pf_camp join @pf_member as mb on o.campid=@pf_camp.id and  @pf_camp.seller_id = mb.id where state in(?,?) and refund = ? and crm_state in(?,?) and settle_state = ? and @pf_camp.seller_id=?" ,[3,8,0,2,10,2,$srs.seller_id])@}
	{@$refund=DB::getone("select SUM(scommision) from @pf_order as o join @pf_camp join @pf_member as mb on o.campid=@pf_camp.id and  @pf_camp.seller_id = mb.id where state =? and refund = ? and crm_state =? and settle_state = ? and @pf_camp.seller_id=?" ,[5,2,2,6,$srs.seller_id])@}
	<td colspan="1" align="center" style="font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;供应商名称：<span>{@$ttl@}</span>
	<dd style="padding-left: 40px; display: inline-block;">结算价格合计：<span>{@$price['SUM(scommision)']-$refund['SUM(scommision)']@}&nbsp;元</span></dd>
	</td>
	
	

	<td colspan="8">
<form action="settleFinance" method="post" class="form-submit form-submit2">
		{@foreach from=$rs item=id@}<input type="hidden" name="id[]" value="{@$id.id@}">{@/foreach@}
	<input type="hidden" name="key" value="{@$key@}">
	<input type="hidden" name="price" id="price_{@$srs.seller_id@}" value="{@$price['SUM(scommision)']-$refund['SUM(scommision)']@}">
	<input type="button" name="submit" value="结算" id="{@$srs.seller_id@}" class="submit"><input type="submit" value="" id="cost_{@$srs.seller_id@}" style="display:none"></form></td>
	

	
	
</tr>
{@/block@}
{@block name=allopts@}
	

{@/block@}
