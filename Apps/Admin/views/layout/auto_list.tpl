{@extends file='@model_list.tpl'@}
<!--标题-->
{@block name=title@}自动回复{@/block@}

<!--表格顶部区域-->
{@block name=table_topbar@}
<div class="smbox-list-toptab">
<a class="samao-link-btn samao-link-btn-add" href="__SELF__/add">新增</a>
</div>
{@/block@}

<!--表头列-->
{@block name=table_ths@}
<th width="160">关键词</th>
<th width="80">回复类型</th>
<th>回复内容</th>
<th width="180">操作</th>
{@/block@}

<!--总列数合并单元格时可用-->
{@block name=colspan@}4{@/block@}

<!--表行列-->
{@block name=table_tds@}
<td align="center">{@$rs.keyword@}</td>
<td align="center">{@if $rs.reply==1@}文本回复{@elseif $rs.reply==2@}图文回复{@else@}图片回复{@/if@}
</td>
<td align="center">{@$rs.content@}</td>
<td align="center">
<a class="samao-link-minibtn" href="__SELF__/edit?id={@$rs.id@}">编辑</a>
<a class="samao-link-minibtn" href="__SELF__/delete?id={@$rs.id@}">删除</a>
</td>
{@/block@}
<!--分页控件区-->
{@block name=pagebar@}
<div class="samao-pagebar">{@pagebar pdata=$bar@}</div>
{@/block@}