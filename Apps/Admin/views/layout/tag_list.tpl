{@extends file='@model_list.tpl'@}
<!--标题-->
{@block name=title@}{@$title@}{@/block@}

<!--表格顶部区域-->
{@block name=table_topbar@}
<div class="smbox-list-toptab">
<a class="samao-link-btn samao-link-btn-refresh" href="javascript:window.location.reload()">刷新</a>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="__SELF__/add?type={@$type@}" class="samao-link-btn samao-link-btn-add">新增</a>&nbsp;&nbsp;
<form  method='get'>
    <input type="hidden" name="type" value="{@$type@}"/>
{@form_select header='标签选择' options=DB::getopts('@pf_tag','id,title',0,"pid=0 and type={@$type@}") style="width:100px;" onchange='this.form.submit();' value="{@$id@}" name="id" model=$model@}&nbsp;&nbsp;
</form>
</div>
{@/block@}

<!--表头列-->
{@block name=table_ths@}
<th width="20">序号</th>
<th width="120" align="center">标签名称</th>
<th width="140">排序</th>
<th width="140">操作</th>
{@/block@}

<!--总列数合并单元格时可用-->
{@block name=colspan@}7{@/block@}

<!--表行列-->
{@block name=table_tds@}
<form method="post">
<input name="id" type="hidden" value="{@$rs.id@}" />
<input name="action" type="hidden" value="editsort" />
<td align="center">{@$rs.id@}</td>
<td align="center">{@$rs.title@}</td>
<td align="center">{@$rs.sort|sortopt:$rs.id:1@}</td>
<td align="center">
{@if $type == 2@}
{@if $rs.create == 1@}<a href="__SELF__/add?pid={@$rs.id@}&type={@$type@}">添加二级标签</a> | 
{@if $rs.allow == 0@}<a href="__SELF__/seton_allow?id={@$rs.id@}">启用</a> | 
{@else@}<a onclick="return confirm('确定要关闭该菜单吗？');" href="__SELF__/setoff_allow?id={@$rs.id@}">关闭</a> | {@/if@}
{@/if@}{@/if@}
<a href="__SELF__/edit?id={@$rs.id@}&type={@$type@}">编辑</a> |  
<a onclick="return confirm('确定要删除该节点吗？一旦删除将无法恢复，请谨慎操作！');" href="__SELF__/delete?id={@$rs.id@}">删除</a> 
</td>
</form>
{@/block@}