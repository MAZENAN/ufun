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
<a class="samao-link-btn samao-link-btn-add" href="__SELF__/addCoupon?id={@$id@}">新增</a>&nbsp;&nbsp;&nbsp;&nbsp;
</div>
{@/block@}


<!--表头列-->
{@block name=table_ths@}
<th width="30">ID</th>
<th width="90">优惠券金额</th>
<th width="70">最小使用订单金额</th>
<th width="80">可用活动</th>
<th width="70">到期时间</th>
<!-- <th width="90">标题</th><th width="70">领取次数</th> -->
<!-- <th width="70">分享</th> -->
<th width="190">操作</th>
{@/block@}

<!--总列数合并单元格时可用-->
{@block name=colspan@}11{@/block@}

<!--表行列-->
{@block name=table_tds@}
<td align="center">{@$rs.id@}</td>
<!--<td align="center">{@$rs.title@}</td>
<td align="center">{@$rs.addtime@}</td>-->
<td align="center">{@if $rs.coupon@}￥{@$rs.coupon@}{@else@}-{@/if@}</td>
<td align="center">{@if $rs.scope@}￥{@$rs.scope@}{@else@}-{@/if@}</td>
<td align="center">{@if empty($rs.camp_id)@}全部产品{@else@}部分产品({@$rs.camp_id@}){@/if@}</td>
<td align="center">{@if $rs.deadline!='0000-00-00 00:00:00'@}{@date('Y-m-d',strtotime($rs.deadline))@}{@else@}-{@/if@}</td>

<td align="center">

<a class="samao-link-minibtn" href="__SELF__/editCoupon?id={@$id@}&cid={@$rs.id@}">编辑</a>
{@if $ttl!=0@}<a onclick="return confirm('确定要删除了吗？');" class="samao-link-minibtn" href="__SELF__/deleteCoupon?id={@$rs.id@}">删除</a>{@/if@}
</td>

{@/block@}

<!--分页控件区-->
{@block name=pagebar@}
<div class="samao-pagebar">{@pagebar pdata=$bar@}</div>
{@/block@}


