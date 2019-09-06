{@extends file='@model_list.tpl'@}
<!--标题-->
{@block name=title@}{@$title@}{@/block@}

<!--头部脚本区-->
{@block name=head@}
<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.topdialog.js"></script>

{@/block@}

<!--表格顶部区域-->

{@block name=table_topbar@}
<div class="smbox-list-toptab">
<a class="samao-link-btn samao-link-btn-add" href="__SELF__/add">新增</a>&nbsp;&nbsp;&nbsp;&nbsp;<a class="samao-link-btn samao-link-btn-refresh" href="javascript:window.location.reload()">刷新</a>
</div>
{@/block@}


<!--表头列-->
{@block name=table_ths@}
<th width="30">ID</th>
<th width="90">标题</th>
<th width="90">优惠券总额</th>
<th width="50">优惠券张数</th>
<th width="80">单张优惠券金额</th>
<th width="70">最小使用订单金额</th>
<th width="90">到期时间</th>
<th width="50">是否上架</th>
<th width="50">是否推荐</th>
<th width="190">操作</th>
{@/block@}

<!--总列数合并单元格时可用-->
{@block name=colspan@}10{@/block@}

<!--表行列-->
{@foreach from=$rows item=rs@}
{@block name=table_tds@}
<form method="post">
<input name="id" type="hidden" value="{@$rs.id@}" />
<input name="action" type="hidden" value="editsort" />
<td align="center">{@$rs.id@}</td>
<td align="center">{@$rs.title@}</td>
<td align="center">￥{@$rs.total_amount@}</td>
<td align="center">{@$rs.num@}</td>
<td align="center">{@foreach from=$rs.coupons item=cou@}{@if $cou.coupon@}￥{@$cou.coupon@}{@else@}-{@/if@}<br />{@/foreach@}</td>
<td align="center">{@foreach from=$rs.coupons item=cou@}{@if $cou.scope@}￥{@$cou.scope@}{@else@}-{@/if@}<br />{@/foreach@}</td>
<td align="center">{@foreach from=$rs.coupons item=cou@}{@if $cou.deadline=='0000-00-00 00:00:00' || empty($cou.deadline)@}-{@else@}{@date('Y-m-d',strtotime($cou.deadline))@}{@/if@}<br />{@/foreach@}</td>
<td align="center">{@$rs.allow|way@}</td>
<td align="center">{@$rs.is_top|way@}</td>
<td align="center">
	<div id="copy{@$rs.id@}" class="theme-address" style="font-size:0px;height:0;">{@$url@}/coupon_packs.html?coupon_id={@$rs.id@}</div>
<a class="copyaddress_{@$rs.id@} samao-link-minibtn" type="button" data-clipboard-action="copy" data-clipboard-target="#copy{@$rs.id@}">复制分享链接</a>
<a class="samao-link-minibtn" href="__SELF__/edit?id={@$rs.id@}">编辑</a>
<!--<a dialog="1" class="samao-link-minibtn"  href="__SELF__/couponsList?id={@$rs.id@}">添加优惠券</a>-->
<a class="samao-link-minibtn" href="__SELF__/set{@if $rs.allow==1@}off{@else@}on{@/if@}_allow?id={@$rs.id@}">{@if $rs.allow==0@}上架{@else@}下架{@/if@}</a>
<a onclick="return confirm('确定要删除了吗？');" class="samao-link-minibtn" href="__SELF__/delete?id={@$rs.id@}">删除</a>
</td>
</form>
<script type="text/javascript" src="__PUBLIC__/js/clipboard.min.js"></script>
<script>
var clipboard = new Clipboard('.copyaddress_{@$rs.id@}');
clipboard.on('success', function(e) {
  alert("地址{@$url@}/coupon_packs.html?coupon_id={@$rs.id@}已复制到剪贴板中");
  console.log(e);
});

clipboard.on('error', function(e) {
  console.log(e);
});
</script>
{@/block@}
{@/foreach@}
<!--分页控件区-->
{@block name=pagebar@}
<div class="samao-pagebar">{@pagebar pdata=$bar@}</div>
{@/block@}


