{@extends file='@model_list.tpl'@}
<!--标题-->
{@block name=title@}管理组{@/block@}

<!--表格顶部区域-->
{@block name=table_topbar@}
<div class="smbox-list-toptab">
<a class="samao-link-btn samao-link-btn-add" href="__SELF__/add">新增</a>
</div>
{@/block@}

<!--表头列-->
{@block name=table_ths@}
<th width="50%">管理组</th>
<th width="50%">操作</th>
{@/block@}

<!--总列数合并单元格时可用-->
{@block name=colspan@}2{@/block@}

<!--表行列-->
{@block name=table_tds@}
<td align="center">{@$rs.name@}</td>
<td align="center">
<a class="samao-link-minibtn" href="__SELF__/node?group={@$rs.id@}">管理节点</a>
<a class="samao-link-minibtn" href="__SELF__/edit?id={@$rs.id@}">编辑</a>
<a class="samao-link-minibtn" href="__SELF__/delete?id={@$rs.id@}">删除</a>
</td>
{@/block@}