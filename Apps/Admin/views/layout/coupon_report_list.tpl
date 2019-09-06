{@extends file='@model_list.tpl'@}
<!--标题-->
{@block name=title@}优惠券数据统计{@/block@}

<!--头部脚本区-->
{@block name=head@}
<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.topdialog.js"></script>

{@/block@}

<!--表格顶部区域-->
{@block name=table_topbar@}

<div class="smbox-list-toptab">
	<form method="get" id="camp-form">
		<a class="samao-link-btn samao-link-btn-refresh" href="javascript:window.location.reload()">刷新</a>&nbsp;&nbsp;&nbsp;&nbsp;
		{@form_text  name="title" model=$schmodel placeholder= '优惠券礼包标题'  value="{@$sch.title@}"@}&nbsp;&nbsp;
		<input type="submit" value="查找" class="samao-mini-btn samao-mini-btn-search"/>&nbsp;&nbsp;
	</form>
</div>
{@/block@}

<!--表头列-->
{@block name=table_ths@}
<th width="240">优惠券礼包名称</th>
<th width="100">领取人数</th>
<th width="100">使用人数</th>
<th width="100">使用张数</th>
<th width="100">使用金额</th>
<th width="100">下单转化率</th>
<th width="240">操作</th>
{@/block@}


<!--表行列-->
{@block name=table_tds@}
<form method="post">
<input name="id" type="hidden" value="{@$rs.id@}" />
<input name="action" type="hidden" value="editsort" />

<td align="center">{@$rs.title@}</td>
<td align="center">{@$rs.get_num|default:0@}</td>
<td align="center">{@$rs.use_num|default:0@}</td>
<td align="center">{@$rs.use_piece|default:0@}</td>
<td align="center">{@$rs.use_coupon|default:0@}</td>
<td align="center">{@$rs.pr*100|default:0@}{@if $rs.pr>0@}%{@/if@}</td>

<td align="center">
<a dialog="1" class="samao-link-minibtn" href="__SELF__/date_report?packid={@$rs.id@}">查看每日</a>
<a dialog="1" class="samao-link-minibtn" href="__SELF__/piece_report?packid={@$rs.id@}">查看每张</a>
</td>
</form>

{@/block@}

<!--分页控件区-->
{@block name=pagebar@}
<div class="samao-pagebar">{@pagebar pdata=$bar@}</div>
{@/block@}