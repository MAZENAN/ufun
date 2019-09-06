{@extends file='@model_list.tpl'@}
<!--标题-->
{@block name=title@}{@/block@}
{@block name=head@}
<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.topdialog.js"></script>
{@/block@}

<!--表格顶部区域-->
{@block name=table_topbar@}
<div class="smbox-list-toptab">
    <form method="get" id="target-form">
        <a class="samao-link-btn samao-link-btn-add" href="__SELF__/add">新增</a>&nbsp;&nbsp;&nbsp;&nbsp;
    </form>
</div>
{@/block@}

<!--表头列-->
{@block name=table_ths@}
<th width="10%">会员ID</th>
<th width="10%">logo</th>
<th width="10%">公告</th>
<th width="10%">状态</th>
<th width="10%">是否支持自取0否1是</th>
<th width="10%">联系电话</th>
<th width="10%">联系手机</th>
<th width="10%">地址</th>

<th width="18%">操作</th>
{@/block@}

<!--总列数合并单元格时可用-->
{@block name=colspan@}4{@/block@}

<!--表行列-->
{@block name=table_tds@}
<td align="center">{@$rs.id@}</td>
<td align="center">{@$rs.logo@}</td>
<td align="center">{@$rs.name@}</td>
<td align="center">{@$rs.allow@}</td>
<td align="center">{@$rs.isselftake@}</td>
<td align="center">{@$rs.tel@}</td>
<td align="center">{@$rs.mobile@}</td>
<td align="center">{@$rs.address@}</td>

<td align="center">
    <a dialog="1" class="samao-link-minibtn" href="__SELF__/show?id={@$rs.id@}">详情</a>
    <a class="samao-link-minibtn" href="__SELF__/edit?id={@$rs.id@}">编辑</a>
    <a onclick="return confirm('确定要删除吗？一旦删除将无法恢复，请谨慎操作！');" class="samao-link-minibtn" href="__SELF__/delete?id={@$rs.id@}">删除</a>
</td>
{@/block@}
<!--分页控件区-->
<!--分页控件区-->		
{@block name=pagebar@}
	<div class="samao-pagebar">{@pagebar pdata=$bar@}</div>
{@/block@}
