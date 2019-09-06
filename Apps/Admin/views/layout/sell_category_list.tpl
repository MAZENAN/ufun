{@extends file='@model_list.tpl'@}
<!--标题-->
{@block name=title@}经营分类{@/block@}
{@block name=head@}
<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.topdialog.js"></script>
{@/block@}

<!--表格顶部区域-->
{@block name=table_topbar@}
<div class="smbox-list-toptab">
    <form method="get" id="target-form">
        <a class="samao-link-btn samao-link-btn-add" href="__SELF__/add?pid={@$sch.pid@}">新增</a>&nbsp;&nbsp;&nbsp;&nbsp;{@if $sch.pid!=0@}<a class="samao-link-btn" href="__SELF__?pid=0">返回上级</a>{@/if@}&nbsp;&nbsp;&nbsp;&nbsp;
        {@form_hidden  name="pid" model=$schmodel@}&nbsp;&nbsp;
    </form>
</div>
{@/block@}

<!--表头列-->
{@block name=table_ths@}
<th width="10%">ID</th>
<th width="10%">分类名</th>
<th width="10%">是否启用</th>
<th width="18%">操作</th>
{@/block@}

<!--总列数合并单元格时可用-->
{@block name=colspan@}4{@/block@}

<!--表行列-->
{@block name=table_tds@}
<td align="center">{@$rs.id@}</td>
<td align="center">{@$rs.title@}</td>
<td align="center">{@$rs.allow|way@}</td>

<td align="center">
    {@if $sch.pid==0@}
    <a class="samao-link-minibtn" href="__SELF__?pid={@$rs.id@}">管理子类</a>
    {@/if@}
    <a class="samao-link-minibtn" href="__SELF__/edit?id={@$rs.id@}">编辑</a>
    <a onclick="return confirm('确定要删除吗？一旦删除将无法恢复，请谨慎操作！');" class="samao-link-minibtn" href="__SELF__/delete?id={@$rs.id@}">删除</a>
</td>
{@/block@}
<!--分页控件区-->
<!--分页控件区-->		
{@block name=pagebar@}
	<div class="samao-pagebar">{@pagebar pdata=$bar@}</div>
{@/block@}
