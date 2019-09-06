{@extends file='@model_list.tpl'@}
<!--标题-->
{@block name=title@}问答列表{@/block@}
{@block name=head@}
<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.topdialog.js"></script>
{@/block@}
<!--表格顶部区域-->
{@block name=table_topbar@}
<div class="smbox-list-toptab">
<a class="samao-link-btn samao-link-btn-refresh" href="javascript:window.location.reload()">刷新</a>&nbsp;&nbsp;&nbsp;&nbsp;
<form method="get" >
{@form_select header="是否回复"  options=[[1,'已回复'],[2,'未回复']] name="replay" onchange="this.form.submit()" model=$schmodel @}&nbsp;&nbsp;
</form>
</div>
{@/block@}

<!--表头列-->

{@block name=table_ths@}

<th width="30">ID</th>
<th width="80">产品标题</th>
<th width="100">客户</th>
<th width="160">内容</th>
<th width="80">添加时间</th>
<th width="80">条数</th>
<th width="80">操作</th>
{@/block@}

<!--总列数合并单元格时可用-->
{@block name=colspan@}6{@/block@}

<!--表行列-->
{@block name=table_tds@}
<input name="id" type="hidden" value="{@$rs.id@}" />
<input name="action" type="hidden" value="editsort" />
<td align="center">{@$rs.id@}</td>
<td align="center"><a href="/{@if $rs.type==0@}cncamp{@else@}glcamp{@/if@}-{@$rs.camp_id@}.html" target="_blank">{@$rs.title@}</a></td>
<td align="center">{@if $rs.user_id ==-1@}营天下官方{@elseif $rs.nickname@}{@$rs.nickname@}{@elseif $rs.mobile@}{@$rs.mobile@}{@else@}游客{@/if@}</td>
<td align="center">{@$rs.comment@}</td>
<td align="center">{@$rs.add_time@}</td>
<td align="center">{@$rs.sun+1@}</td>
<td align="center">
{@if $rs.user_id neq -1@}<a dialog="1" class="samao-link-minibtn" href="__SELF__/replay?id={@$rs.id@}">回复</a>{@/if@}
<a onclick="return confirm('确定要删除该内容吗？一旦删除将无法恢复，请谨慎操作！');" class="samao-link-minibtn" href="__SELF__/delete?id={@$rs.id@}">删除</a>
</td>

{@/block@}

<!--分页控件区-->
{@block name=pagebar@}
<div class="samao-pagebar">{@pagebar pdata=$bar@}</div>
{@/block@}