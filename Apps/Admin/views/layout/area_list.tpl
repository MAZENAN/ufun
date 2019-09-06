{@extends file='@model_list.tpl'@}
<!--标题-->
{@block name=title@}地区分类{@/block@}

<!--表格顶部区域-->
{@block name=table_topbar@}
<div class="smbox-list-toptab">
<form method="get">
<a class="samao-link-btn samao-link-btn-add" href="__SELF__/add">新增</a>{@if $sch.pid!=0@}<a class="samao-link-btn" href="__SELF__?pid=0">返回上级</a>{@/if@}&nbsp;&nbsp;&nbsp;&nbsp;
{@form_hidden  name="pid" model=$schmodel@}&nbsp;&nbsp;
</form>
</div>
{@/block@}

<!--表头列-->
{@block name=table_ths@}
<th width="33%">分类名称</th>
<th width="33%">排序</th>
<th width="33%">操作</th>
{@/block@}

<!--总列数合并单元格时可用-->
{@block name=colspan@}3{@/block@}

<!--表行列-->
{@block name=table_tds@}
<form method="post">
<input name="id" type="hidden" value="{@$rs.id@}" />
<input name="action" type="hidden" value="editsort" />
<td align="center">{@$rs.name@}</td>
<td align="center">{@$rs.sort|sortopt:$rs.id@}</td>
<td align="center">
{@if $sch.pid==0@}<a class="samao-link-minibtn" href="__SELF__?pid={@$rs.id@}">管理子类</a>{@/if@}
{@if $sch.pid==0@}<a class="samao-link-minibtn" href="__SELF__/add?pid={@$rs.id@}">新增子类</a>{@/if@}
<a class="samao-link-minibtn" href="__SELF__/edit?id={@$rs.id@}">编辑</a>
<a class="samao-link-minibtn" href="__SELF__/delete?id={@$rs.id@}">删除</a>
</td>
</form>
{@/block@}