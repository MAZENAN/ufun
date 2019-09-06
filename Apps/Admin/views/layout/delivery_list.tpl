{@extends file='@model_list.tpl'@}
<!--标题-->
{@block name=title@}{@$merchantId|smval:'@pf_merchant'@}（配送信息）{@/block@}
{@block name=head@}
<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.topdialog.js"></script>
{@/block@}

<!--表格顶部区域-->
{@block name=table_topbar@}
<div class="smbox-list-toptab">
    <form method="get" id="target-form">
        <a class="samao-link-btn samao-link-btn-add" href="__SELF__/add?merchant_id={@$merchantId@}">新增</a>&nbsp;&nbsp;&nbsp;&nbsp;
    </form>
</div>
{@/block@}

<!--表头列-->
{@block name=table_ths@}
<th width="10%">ID</th>
<th width="10%">星期</th>
<th width="10%">是否中午配送</th>
<th width="10%">中午截单时间</th>
<th width="10%">中午截单量</th>
<th width="10%">是否下午配送</th>
<th width="10%">下午截单时间</th>
<th width="10%">下午截单量</th>


<th width="18%">操作</th>
{@/block@}

<!--总列数合并单元格时可用-->
{@block name=colspan@}4{@/block@}

<!--表行列-->
{@block name=table_tds@}
<td align="center">{@$rs.id@}</td>
<td align="center">{@$rs.week|case:[1,2,3,4,5,6,7]:['星期一','星期二','星期三','星期四','星期五','星期六','星期日']@}</td>
<td align="center">{@$rs.is_noon|way@}</td>
<td align="center">{@if $rs.is_noon@}{@$rs.noon_stop_time@}{@else@}--{@/if@}</td>
<td align="center">{@if $rs.is_noon@}{@$rs.noon_order_nums@}{@else@}--{@/if@}</td>
<td align="center">{@$rs.is_pm|way@}</td>
<td align="center">{@if $rs.is_pm@}{@$rs.pm_stop_time@}{@else@}--{@/if@}</td>
<td align="center">{@if $rs.is_pm@}{@$rs.pm_order_nums@}{@else@}--{@/if@}</td>

<td align="center">
    <a class="samao-link-minibtn" href="__SELF__/edit?id={@$rs.id@}">编辑</a>
    <a onclick="return confirm('确定要删除吗？一旦删除将无法恢复，请谨慎操作！');" class="samao-link-minibtn" href="__SELF__/delete?id={@$rs.id@}">删除</a>
</td>
{@/block@}
<!--分页控件区-->
<!--分页控件区-->		
{@block name=pagebar@}
	<div class="samao-pagebar">{@pagebar pdata=$bar@}</div>
{@/block@}
