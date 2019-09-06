{@extends file='@model_list.tpl'@}
<!--标题-->
{@block name=title@}分类列表{@/block@}
{@block name=head@}
<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.topdialog.js"></script>
{@/block@}

<!--表格顶部区域-->
{@block name=table_topbar@}
<div class="smbox-list-toptab">
    <form method="get" id="target-form">
        <a class="samao-link-btn samao-link-btn-refresh" href="javascript:window.location.reload()">刷新</a>
        <a class="samao-link-btn samao-link-btn-add" href="__SELF__/add">新增</a>&nbsp;&nbsp;&nbsp;&nbsp;
    </form>
</div>
{@/block@}

<!--表头列-->
{@block name=table_ths@}
<th width="10%">ID</th>
<th width="10%">任务标题</th>
<th width="10%">icon</th>
<th width="10%">赏金类型</th>
<th width="10%">是否启用</th>
<th width="18%">操作</th>
{@/block@}

<!--总列数合并单元格时可用-->
{@block name=colspan@}6{@/block@}

<!--表行列-->
{@block name=table_tds@}
<td align="center">{@$rs.id@}</td>
<td align="center">{@$rs.title@}</td>
<td align="center"><img src="{@$rs.img|minimg:50:50:1@}"></td>
<td align="center"><span class="org">{@$rs.type|case:[1,2,3]:['跑腿类','代购类','技能求助类']@}</span></td>
<td align="center">{@$rs.allow|way@}</td>

<td align="center">
    <a class="samao-link-minibtn" href="__SELF__/edit?id={@$rs.id@}">查看编辑</a>
    <a onclick="return confirm('确定要删除吗？一旦删除将无法恢复，请谨慎操作！');" class="samao-link-minibtn" href="__SELF__/delete?id={@$rs.id@}">删除</a>
</td>
{@/block@}
<!--分页控件区-->
<!--分页控件区-->		
{@block name=pagebar@}
	<div class="samao-pagebar">{@pagebar pdata=$bar@}</div>
{@/block@}
