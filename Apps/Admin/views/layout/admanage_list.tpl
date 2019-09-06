{@extends file='@model_list.tpl'@}
<!--标题-->
{@block name=title@}广告管理{@/block@}

<!--头部脚本区-->
{@block name=head@}
<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>
{@/block@}

<!--表格顶部区域-->
{@block name=table_topbar@}
<div class="smbox-list-toptab">
<a class="samao-link-btn" href="__SELF__/add">新增</a>
</div>
{@/block@}

<!--表头列-->
{@block name=table_ths@}
<th>广告名称</th>
<th width="180">所属栏目</th>
<th width="200">排序</th>
<th width="180">操作</th>
{@/block@}

<!--总列数合并单元格时可用-->
{@block name=colspan@}4{@/block@}

<!--表行列-->
{@block name=table_tds@}
<form method="post">
<input name="id" type="hidden" value="{@$rs.id@}" />
<input name="action" type="hidden" value="editsort" />
<td align="left">{@$rs.title@}</td>
<td align="center">{@$rs.classd|smval:"@pf_adpage":"name"@}</td>
<td align="center">{@$rs.sort|sortopt:$rs.id:1@}</td>
<td align="right">
<a class="samao-link-minibtn" href="__SELF__/edit?id={@$rs.id@}">编辑</a>
<a class="samao-link-minibtn" href="__SELF__/delete?id={@$rs.id@}">删除</a>
</td>
</form>
{@/block@}

<!--分页控件区-->
{@block name=pagebar@}
<div class="samao-pagebar">{@pagebar pdata=$bar@}</div>
{@/block@}