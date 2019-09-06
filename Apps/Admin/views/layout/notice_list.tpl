{@extends file='@model_list.tpl'@}
<!--标题-->
{@block name=title@}小程序公告{@/block@}
{@block name=head@}
<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.topdialog.js"></script>
{@/block@}

<!--表格顶部区域-->
{@block name=table_topbar@}
<div class="smbox-list-toptab">
    <form method="get" id="target-form">
        <a class="samao-link-btn samao-link-btn-add" href="__SELF__/add?type={@$type@}&merchant_id={@$merchantId@}&school_id={@$schoolId@}">新增</a>&nbsp;&nbsp;&nbsp;&nbsp;
    </form>
</div>
{@/block@}

<!--表头列-->
{@block name=table_ths@}
<th width="8%">ID</th>
{@if $type==0@}
<th width="10%">公告名</th>
{@elseif $type==1@}
<th width="10%">公告内容</th>
{@/if@}
<th width="5%">是否启用</th>
<th width="5%">排序</th>
<th width="10%">操作</th>
{@/block@}

<!--总列数合并单元格时可用-->
{@block name=colspan@}4{@/block@}

<!--表行列-->
{@block name=table_tds@}
<form method="post">
    <input name="id" type="hidden" value="{@$rs.id@}" />
    <input name="action" type="hidden" value="editsort" />
<td align="center">{@$rs.id@}</td>
{@if $type==0@}
<td align="center">{@$rs.title@}</td>
{@elseif $type==1@}
<td align="center">{@$rs.content|truncate:15:'..':true:true@}</td>
{@/if@}
<td align="center">{@$rs.allow|way@}</td>
<td align="center">{@$rs.sort|sortopt:$rs.id@}</td>

<td align="center">
    <a class="samao-link-minibtn" href="__SELF__/edit?id={@$rs.id@}&type={@$type@}">编辑</a>
    <a onclick="return confirm('确定要删除吗？一旦删除将无法恢复，请谨慎操作！');" class="samao-link-minibtn" href="__SELF__/delete?id={@$rs.id@}">删除</a>
</td>
</form>
{@/block@}
<!--分页控件区-->
<!--分页控件区-->		
{@block name=pagebar@}
	<div class="samao-pagebar">{@pagebar pdata=$bar@}</div>
{@/block@}
