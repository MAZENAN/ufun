{@extends file='@model_list.tpl'@}
<!--标题-->
{@block name=title@}微信菜单{@/block@}

<!--表格顶部区域-->
{@block name=table_topbar@}
<div class="smbox-list-toptab">
<a href="__SELF__/add" class="samao-link-btn">微信菜单</a>
<a href="__SELF__/updata" style="float: right" class="samao-link-btn">更新菜单</a>
</div>
{@/block@}

<!--表头列-->
{@block name=table_ths@}
<th width="80">ID</th>
<th width="120">菜单标题</th>
<th width="120">栏目路径</th>
<th width="80">是否展开</th>
<th width="200">排序</th>
<th width="80">是否启用</th>
<th width="180">操作</th>
{@/block@}

<!--总列数合并单元格时可用-->
{@block name=colspan@}7{@/block@}

<!--表行列-->
{@block name=table_tds@}
<form method="post">
<input name="id" type="hidden" value="{@$rs.id@}" />
<input name="action" type="hidden" value="editsort" />
<td align="center">{@$rs.id@}</td>
<td>{@$rs.title@}</td>
<td align="center">{@$rs.url@}</td>
<td align="center">{@$rs.show|way@}</td>
<td align="center">{@form_digits name='sort' class="form-control digits" value=$rs.sort style='width:40px;'@}
<input class="samao-mini-btn-change" title="修改" type="button" onclick="this.form.submit();" />&nbsp;&nbsp;
<a href="__SELF__/upsortbypid?id={@$rs.id@}" class="up">上移</a>  <a href="__SELF__/dnsortbypid?id={@$rs.id@}" class="down">下移</a></td>
<td align="center">{@$rs.allow|way@}</td>
<td align="center">
{@if $rs.create == 1@}<a href="__SELF__/add?pid={@$rs.id@}">添加子项</a> | {@/if@}
{@if $rs.allow == 0@}<a href="__SELF__/seton_allow?id={@$rs.id@}">启用</a> | 
{@else@}<a href="__SELF__/setoff_allow?id={@$rs.id@}">关闭</a> | 
{@/if@}
<a href="__SELF__/edit?id={@$rs.id@}">编辑</a> |  
<a href="__SELF__/delete?id={@$rs.id@}">删除</a> 
</td>
</form>
{@/block@}