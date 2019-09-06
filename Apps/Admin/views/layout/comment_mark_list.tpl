{@extends file='@model_list.tpl'@}
<!--标题-->
{@block name=title@}点评列表{@/block@}
<!--头部脚本区-->
{@block name=head@}
<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.topdialog.js"></script>
<script type="text/javascript">
	$("#del").live('click', function() {
		var id=$(this).attr('rel');
		if (confirm("注意：该操作不可逆，确定取消订单吗？")) {
			window.location.href="__SELF__/delete?id="+id;
		};
	});
</script>
{@/block@}
<!--头部标签区-->
{@block name=toptags@}
{@/block@}
<!--表格顶部区域-->
{@block name=table_topbar@}
<div class="smbox-list-toptab">
	<form method="get">
		<a class="samao-link-btn samao-link-btn-refresh" href="javascript:window.location.reload()">刷新</a>
		&nbsp;&nbsp;&nbsp;&nbsp;
		{@form_select options=[[1,'产品标题'],[2,'订单号'],[3,'手机号']] name="screen"  model=$model @}&nbsp;&nbsp;
		{@form_text  style="width:120px" name="content" value="{@$content@}" placeholder= '请输入查找内容' model=$model@}
		<input type="submit" value="查找" class="samao-mini-btn samao-mini-btn-search"/>
	
	</form>
</div>
{@/block@}
<!--表头列-->
{@block name=table_ths@}
<th width="50">ID</th>
<th width="130">会员手机号</th>
<th width="80">订单号</th>
<th width="420">产品标题</th>
<th width="120">总评</th>
<th width="120">态度</th>
<th width="120">专业性</th>
<th width="120">一致度</th>
<th width="280">评论内容</th>
<th width="120">意见/建议</th>

<th width="140">评论时间</th>
<th width="190">操作</th>
{@/block@}
<!--总列数合并单元格时可用-->
{@block name=colspan@}9{@/block@}
<!--表行列-->
{@block name=table_tds@}
<td align="center">
	<span class="blu">{@$rs.id@}</span>
</td>
<td align="center">
	<span class="blu">{@$rs.mobile@}</span>
</td>
<td align="center">
	<span class="blu">{@$rs.orderid@}</span>
</td>
<td align="center">
    <a href="/{@if $rs.type =='0'@}cncamp{@elseif $rs.type=='1'@}glcamp{@/if@}-{@$rs.cid@}.html" target="_blank">{@$rs.title@}({@$rs.departure_option@})</a>
</td>
<td align="center">
	{@$rs.point@}
</td>
<td align="center">
	{@$rs.q1@}
</td>
<td align="center">
	{@$rs.q2@}
</td>
<td align="center">
	{@$rs.q3@}
</td>
<td align="center">
	{@$rs.info@}
</td>
<td align="center">
	{@$rs.opinion@}
</td>

<td align="center">
	{@$rs.add_time@}
</td>
<td align="center">
<!--<a class="samao-link-minibtn" href="__SELF__/replay?id={@$rs.id@}">回复</a>-->
<a class="samao-link-minibtn" href="#" rel="{@$rs.id@}" id="del">删除</a>	
</td>
{@/block@}
<!--分页控件区-->		
{@block name=pagebar@}
	<div class="samao-pagebar">{@pagebar pdata=$bar@}</div>
{@/block@}

