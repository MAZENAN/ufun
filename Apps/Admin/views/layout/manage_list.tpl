{@extends file='@model_list.tpl'@}
<!--标题-->
{@block name=title@}管理员列表{@/block@}

<!--表格顶部区域-->
{@block name=table_topbar@}
<div class="smbox-list-toptab">
<a href="__SELF__/add" class="samao-link-btn samao-link-btn-add">新增管理员</a>
</div>
{@/block@}

<!--表头列-->
{@block name=table_ths@}
<th width="60">ID</th>
<th width="120">用户名</th>
<th width="120">管理员类型</th>
<th width="150">最后登录时间</th>
<th width="150">最后一次登录IP</th>
<th width="150">管理员邮箱</th>
<th width="120">是否锁定账号</th>
<th width="180">操作</th>
{@/block@}

<!--总列数合并单元格时可用-->
{@block name=colspan@}8{@/block@}

<!--表行列-->
{@block name=table_tds@}
<td align="center">{@$rs.id@}</td>
<td>{@$rs.name@}</td>
<td align="center">{@$rs.manage_name@}</td>
<td align="center">{@$rs.lasttime@}</td>
<td align="center">{@$rs.lastip@}</td>
<td align="center">{@$rs.email@}</td>
<td align="center">{@$rs.islock|case:1:'锁定':'正常'@}</td>
<td align="center">
<a href="/admin/manage/edit?id={@$rs.id@}">编辑</a>{@if $rs.id != 1@} | <a onclick="return confirm('确定要删除吗？一旦删除将无法恢复，请谨慎操作！');" href="/admin/manage/delete?id={@$rs.id@}">删除</a>{@/if@}
</td>
{@/block@}