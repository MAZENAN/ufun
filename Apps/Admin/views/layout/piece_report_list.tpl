{@extends file='@model_list.tpl'@}
<!--标题-->
{@block name=title@}优惠券数据统计{@/block@}

<!--头部脚本区-->
{@block name=head@}
<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.topdialog.js"></script>
<script type="text/javascript" charset="utf-8" src="/public/samaores/js/jquery-ui.js"></script>
<script type="text/javascript" src="/public/samaores/js/jquery.ui.datepicker-zh-CN.js"></script>
<link href="/public/samaores/css/jqueryui/custom.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
$(function() {$("#time").datepicker({dateFormat:'yy-mm-dd',changeMonth: true,changeYear:true,yearRange:'1900:2050'});});
$(function() {$("#time_to").datepicker({dateFormat:'yy-mm-dd',changeMonth: true,changeYear:true,yearRange:'1900:2050'});});</script>
{@/block@}

<!--表格顶部区域-->
{@block name=table_topbar@}

<div class="smbox-list-toptab">
<form method="get" >
<a class="samao-link-btn samao-link-btn-refresh" href="javascript:window.location.reload()">刷新</a>&nbsp;&nbsp;&nbsp;&nbsp;
{@form_date  name="time" model=$schmodel placeholder= '请输入开始日期' style="width:100px;" value="{@$sch.time@}"@}-
{@form_date  name="time_to" model=$schmodel placeholder= '请输入结束日期' style="width:100px;" value="{@$sch.time_to@}" @}&nbsp;&nbsp;
<input type="hidden" name="packid" value="{@$sch['packid']@}" />
<input type="submit" value="查找" class="samao-mini-btn samao-mini-btn-search"/>&nbsp;&nbsp;
</form>
</div>

{@/block@}

<!--表头列-->
{@block name=table_ths@}
<th width="240">优惠券金额</th>
<th width="100">最小订单金额</th>
<th width="100">领取人数</th>
<th width="100">使用人数</th>
<th width="100">下单转化率</th>
{@/block@}


<!--表行列-->
{@block name=table_tds@}
<form method="post">
<input name="id" type="hidden" value="{@$rs.id@}" />
<input name="action" type="hidden" value="editsort" />

<td align="center">{@$rs.coupon@}</td>
<td align="center">{@$rs.scope|default:0@}</td>
<td align="center">{@$rs.get_num|default:0@}</td>
<td align="center">{@$rs.use_num|default:0@}</td>
<td align="center">{@$rs.pr*100|default:0@}{@if $rs.pr>0@}%{@/if@}</td>

</form>

{@/block@}
