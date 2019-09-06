{@extends file='@model_list.tpl'@}
<!--标题-->
{@block name=title@}单页文档管理{@/block@}

<!--表格顶部区域-->
{@block name=table_topbar@}
<div class="smbox-list-toptab">
<a class="samao-link-btn" href="__SELF__/add">新增</a>
</div>
{@/block@}

<!--表头列-->
{@block name=table_ths@}
<th align="left">标题</th>
<th width="120">标识符</th>
<th width="120">分组名称</th>
<th width="180">排序</th>
<th width="80">是否允许</th>
<th width="180">操作</th>
{@/block@}

<!--总列数合并单元格时可用-->
{@block name=colspan@}6{@/block@}

<!--表行列-->
{@block name=table_tds@}
<td>{@$rs.title@}</td>
<td align="center">{@$rs.key@}</td>
<td align="center">{@$rs.group|smval:'@pf_singlepage_group':'name'@}</td>
<td align="center">{@$rs.sort|sortopt:$rs.id@}</td>
<td align="center">{@$rs.allow|way@}</td>
<td align="right">
<a class="samao-link-minibtn" href="__SELF__/set{@if $rs.allow==1@}off{@else@}on{@/if@}_allow?id={@$rs.id@}">{@if $rs.allow==0@}审核{@else@}撤销{@/if@}</a>
<a class="samao-link-minibtn" href="__SELF__/edit?id={@$rs.id@}">编辑</a>
<a onclick="return confirm('确定要删除该信息吗？');" class="samao-link-minibtn" href="__SELF__/delete?id={@$rs.id@}">删除</a>
</td>
{@/block@}

<!--分页控件区-->
{@block name=pagebar@}
<div class="samao-pagebar">{@pagebar pdata=$bar@}</div>
{@/block@}