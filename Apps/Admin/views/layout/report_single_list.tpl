{@extends file='@model_list.tpl'@}
<!--标题-->
{@block name=title@}个人明细数据{@/block@}
<!--头部脚本区-->
{@block name=head@}
<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.topdialog.js"></script>
<script type="text/javascript" charset="utf-8" src="/public/samaores/js/jquery-ui.js"></script>
<script type="text/javascript" src="/public/samaores/js/jquery.ui.datepicker-zh-CN.js"></script>
<script type="text/javascript" src="/public/js/highcharts.js"></script>
<script type="text/javascript" src="/public/js/exporting.js"></script>
<script type="text/javascript" src="/public/js/highcharts-3d.js"></script>
<script type="text/javascript">
$(function() {$("#crm_time").datepicker({dateFormat:'yy-mm-dd',changeMonth: true,changeYear:true,yearRange:'1900:2050'});});
$(function() {$("#crm_time_to").datepicker({dateFormat:'yy-mm-dd',changeMonth: true,changeYear:true,yearRange:'1900:2050'});});</script>
<script language="javascript" type="text/javascript" src="/public/js/admin/TableSorterV2.js"></script>
<script language="javascript" type="text/javascript">
window.onload = function()
{
    new TableSorter("smbox-list-table");
}
    </script>
<style>.smbox-list-table{ width:1760px;} .smbox-list-table100{ width: 100%;} .form-list h3{ padding-left: 20px;}</style>
<link href="/public/samaores/css/jqueryui/custom.css" rel="stylesheet" type="text/css" />
<link href="/public/samaores/css/list.plane.css" rel="stylesheet" type="text/css" />
<link href="/public/samaores/css/form.plane.css" rel="stylesheet" type="text/css" />

{@/block@}
<!--头部标签区-->
{@block name=toptags@}
<div class="smbox-toptags">
	<form method="get">
		<a class="samao-link-btn samao-link-btn-refresh" href="javascript:window.location.reload()">刷新</a>&nbsp;&nbsp;
		{@form_select onchange='this.form.submit();' header="课程顾问"  options=DB::getopts('@pf_manage','id,name',0,"type in(7,12,13)") name="manage_id" value="{@$sch.manage_id@}" model=$schmodel@}&nbsp;&nbsp;
		<input name="crm_time" id="crm_time" class="form-control date" style="width:100px;" placeholder="请输入开始日期" type="text" {@if $sch.crm_time@}value="{@$sch.crm_time@}" {@/if@}/>-
		<input name="crm_time_to" id="crm_time_to" class="form-control date" style="width:100px;" placeholder="请输入截至日期" type="text" {@if $sch.crm_time_to@}value="{@$sch.crm_time_to@}" {@/if@}/>		
		<input type="submit" value="查找" class="samao-mini-btn samao-mini-btn-search"/>&nbsp;&nbsp;
	</form>
</div>
{@/block@}
<br/>
{@block name=table_topbar@}<div class="form-list"><h3>销售额</h3></div>
<table width="800" border="0" align="center" cellpadding="0" cellspacing="1" style="margin:0 auto;" class="smbox-list-table2" id="smbox-list-table2" >
	<tr>
		<th align="left" bgcolor="#f7f7f7">负责人</th>
		<th align="left" bgcolor="#f7f7f7">销售金额</th>
		<th align="left" bgcolor="#f7f7f7">退款金额</th>
		<th align="left" bgcolor="#f7f7f7">成单数量</th>
		<th align="left" bgcolor="#f7f7f7">退单数量</th>
		<th align="left" bgcolor="#f7f7f7">总业绩</th>
	</tr>
	{@foreach from=$single item=report key=i@}
	<tr>
		<td align="left" bgcolor="#FFFFFF">
		    <span class="blu">{@$i|smval:'@pf_manage'@}</span>
		</td>
		<td align="left" bgcolor="#FFFFFF">
			<span class="blu">{@if $report.paid>0@}{@$report.paid@}元{@else@}-{@/if@}</span>
		</td>
		<td align="left" bgcolor="#FFFFFF">
			<span class="blu">{@if $report.refund_fees>0@}{@$report.refund_fees@}元{@else@}-{@/if@}</span>
		</td>
		<td align="left" bgcolor="#FFFFFF">
			<span class="blu">{@if $report.paid_num>0@}{@$report.paid_num@}单{@else@}-{@/if@}</span>
		</td>
		<td align="left" bgcolor="#FFFFFF">
	<span class="blu">{@if $report.refund_num>0@}{@$report.refund_num@}单{@else@}-{@/if@}</span>
		</td>
		<td align="left" bgcolor="#FFFFFF">
			<span class="blu">{@$report.paid-$report.refund_fees|default:0@}元</span>
		</td>

	</tr>
	{@/foreach@}
	{@if !$sch.manage_id@}
		<tr>
		<td align="left" bgcolor="#FFFFFF">
		    <span class="blu">总计</span>
		</td>
		<td align="left" bgcolor="#FFFFFF">
			<span class="blu">{@if $total.paid>0@}{@$total.paid@}元{@else@}-{@/if@}</span>
		</td>
		<td align="left" bgcolor="#FFFFFF">
			<span class="blu">{@if $total.refund_fees>0@}{@$total.refund_fees@}元{@else@}-{@/if@}</span>
		</td>
		<td align="left" bgcolor="#FFFFFF">
			<span class="blu">{@if $total.paid_num>0@}{@$total.paid_num@}单{@else@}-{@/if@}</span>
		</td>
		<td align="left" bgcolor="#FFFFFF">
			<span class="blu">{@if $total.refund_num>0@}{@$total.refund_num@}单{@else@}-{@/if@}</span>
		</td>
		<td align="left" bgcolor="#FFFFFF">
			<span class="blu">{@$total.paid-$total.refund_fees|default:0@}元</span>
		</td>
	</tr>
	{@/if@}
</table>
<div class="cls"></div>
<div id="container" style="min-width:700px;height:400px;"></div>
{@/block@}

{@block name=table_ths@}
<div class="form-list">
<h3>订单详情<a onclick="return confirm('确定要导出表格吗？');" class="samao-link-minibtn" href="__SELF__/export?manage_id={@$sch.manage_id@}&crm_time={@$sch.crm_time@}&crm_time_to={@$sch.crm_time_to@}" style="float:right">导出表格</a></h3>
</div>
<th width="150">负责人</th>
<th width="80">订单号</th>
<th width="80">客户</th>
<th width="420">产品标题</th>
<th width="100">订单已付金额</th>
<th width="100">结算价格</th>
<th width="80">状态</th>
<th width="200">下单时间</th>
<th width="80">支付方式</th>
<th width="120">支付时间</th>
<th width="120">财务确认时间</th>
<th width="120">退款金额</th>
<th width="260">退款时间</th>
<th width="360">付款备注</th>

{@/block@}
<!--总列数合并单元格时可用-->
{@block name=colspan@}9{@/block@}
<!--表行列-->

{@block name=table_tds@}

<td align="center">
	<span class="blu">{@$rs.manage_id|smval:'@pf_manage'@}</span>
</td>
<td align="center">
	<span class="blu">{@$rs.orderid@}</span>
</td>
<td align="center">
	{@$rs.userid|smval:'@pf_member':'username'|default:'
	<span class=hui>--</span>
	'@}
</td>
<td align="left">
	<a href="/{@$rs.type@}-{@$rs.campid@}.html" target="_blank">{@$rs.title@}</a>
	({@$rs.departure_option@})
</td>
<td align="center">
	<span class="org">{@$rs.paid@}</span>元
</td>
<td align="center">
	{@if $rs.scommision@}<span class="org">{@$rs.scommision@}</span>元{@else@}-{@/if@}
</td>
<td align="center">
	{@if $rs.refund==1 && $rs.state<4@}
		申请退款中
	{@else@}
		{@$rs.state|case:[0,1,2,3,4,5,6,8,-1]:['未付款','待填资料','待付尾款','已付款','退款中','已退款','已取消','已完成','已作废']@}
	{@/if@}
</td>
<td align="center">
	{@strtotime($rs.addtime)|date_format:'Y-m-d'@}
</td>
<td align="center">
	{@if $rs.paytype1@}{@$rs.paytype1@}{@else@}-{@/if@}
</td>
<td align="center">
	{@strtotime($rs.paytime1)|date_format:'Y-m-d'@}
</td>
<td align="center">
	{@strtotime($rs.crm_time)|date_format:'Y-m-d'@}
</td>
<td align="center">
	{@if $rs.refund_fees!=0@}{@$rs.refund_fees@}元{@else@}-{@/if@}
</td>
<td align="center">
	{@if $rs.refund_time@}{@strtotime($rs.refund_time)|date_format:'Y-m-d'@}{@else@}-{@/if@}
</td>
<td align="center">
	{@if !empty($rs.payremark1) @}
            预付款备注：{@$rs.payremark1|htmlcode:1@}
        {@/if@}
        {@if !empty($rs.payremark2) @}
            尾款备注：{@$rs.payremark2|htmlcode:1@}
        {@/if@}
</td>
{@/block@}
{@block name=allopts@}

<table width="800"  border="0" align="left" cellpadding="0" cellspacing="1" class="smbox-list-table2">
<div class="form-list"><h3>修正值表</h3></div>
	<tr>
		<th height="19" bgcolor="#f7f7f7">负责人</th>
		<th bgcolor="#f7f7f7">订单号</th>
		<th bgcolor="#f7f7f7">修正值</th>
		<th bgcolor="#f7f7f7">审核时间</th>
	</tr>
	{@foreach from=$rows_modify item=mrs@}
	<tr>
		<td align="center" bgcolor="#ffffff">
		    <span class="blu">{@$mrs.manage_id|smval:'@pf_manage'@}</span>
		</td>
		<td align="center" bgcolor="#ffffff">
			<span class="blu">{@$mrs.orderid@}</span>
		</td>
		<td align="center" bgcolor="#ffffff">
			<span class="blu">{@if $mrs.type==1@}+{@else@}-{@/if@}{@$mrs.fees@}元</span>
		</td>
		<td align="center" bgcolor="#ffffff">
			<span class="blu">{@$mrs.check_time@}</span>
		</td>
	</tr>
	{@/foreach@}
	
</table>
<div class="cls"></div>
<script>
	﻿$(function () {
    $('#container').highcharts({
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45
            }
        },
        title: {
            text: '营天下销售业绩饼状图'
        },
        subtitle: {
            text: '每个课程顾问业绩和比例'
        },
        plotOptions: {
            pie: {
                innerSize: 100,
                depth: 45
            }
        },
        series: [{
            name: '总业绩',
            data: {@$single_pie@}
        }]
    });
});
</script>

{@/block@}

