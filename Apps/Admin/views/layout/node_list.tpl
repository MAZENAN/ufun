{@extends file='@model_list.tpl'@}
<!--标题-->
{@block name=title@}权限节点{@/block@}

<!--表格顶部区域-->
{@block name=table_topbar@}
<div class="smbox-list-toptab">
<a href="__SELF__/add" class="samao-link-btn samao-link-btn-add">新增</a>&nbsp;&nbsp;
<form  method='get'>
{@form_select header='节点名称' options=DB::getopts('@pf_node','id,title',0,"pid=0") style="width:100px;" onchange='this.form.submit();' value="{@$id@}" name="id" model=$model@}&nbsp;&nbsp;
</form>
</br>
&nbsp;&nbsp;非专业技术人员，请勿乱操作此处，否则会出现严重后果
</div>
{@/block@}

<!--表头列-->
{@block name=table_ths@}
<th width="120" align="center">节点名称</th>
<th width="80">控制器</th>
<th width="80">操作方法</th>
<th width="80">参数</th>
<th width="80">值</th>
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
<td align="center">{@$rs.title@}</td>
<td align="center">{@$rs.controller|case:"":'---':$rs.controller@}</td>
<td align="center">{@$rs.model|case:"":'---':$rs.model@}</td>
<td align="center">{@$rs.parameter|case:"":'---':$rs.parameter@}</td>
<td align="center">{@$rs.value|case:"":'---':$rs.value@}</td>
<td align="center">{@$rs.sort|sortopt:$rs.id:0:1@}</td>
<td align="center">
{@if $rs.create == 1@}<a href="__SELF__/add?pid={@$rs.id@}">添加方法</a> | {@/if@}
<a href="__SELF__/edit?id={@$rs.id@}">编辑</a> |  
<a onclick="return confirm('确定要删除该节点吗？一旦删除将无法恢复，请谨慎操作！');" href="__SELF__/delete?id={@$rs.id@}">删除</a> 
</td>
</form>
{@/block@}