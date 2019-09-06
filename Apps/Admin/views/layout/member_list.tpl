{@extends file='@model_list.tpl'@}
<!--标题-->
{@block name=title@}用户列表{@/block@}
{@block name=head@}
<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.topdialog.js"></script>
{@/block@}

<!--表格顶部区域-->
{@block name=table_topbar@}
<div class="smbox-list-toptab">
    <form method="get" id="target-form">
        <a class="samao-link-btn samao-link-btn-refresh" href="javascript:window.location.reload()">刷新</a>
        {@form_text  style="width:120px" name="mobile" value="{@$sch['mobile']@}" placeholder= '手机号' model=$schmodel@}
        <input type="submit" value="查找" class="samao-mini-btn samao-mini-btn-search"/>&nbsp;
        <input type="hidden" name="type" value="{@$type@}">
        <input type="hidden" name="from" value="{@$from@}">
        {@if $smarty.get.from eq 'all'@}{@else@}
        <input type="hidden" name="status" value="{@$status@}">
        {@/if@}

    </form>
</div>
{@/block@}

<!--表头列-->
{@block name=table_ths@}
<th width="10%">ID</th>
<th width="10%">用户名</th>
<th width="10%">手机号</th>
{@if $type eq 1@}
<th width="10%">昵称</th>
<th width="10%">用户头像</th>
{@/if@}
<th width="18%">操作</th>
{@/block@}

<!--总列数合并单元格时可用-->
{@block name=colspan@}4{@/block@}

<!--表行列-->
{@block name=table_tds@}
<td align="center">{@$rs.id@}</td>
<td align="center">{@$rs.username|default:'--'@}</td>
<td align="center">{@$rs.mobile|default:'--'@}</td>
{@if $type eq 1@}
<td align="center">{@$rs.nickname|default:'--'@}</td>
<td align="center"><img src="{@$rs.img_head|minimg:50:50:1@}"></td>
{@/if@}
<td align="center">
    {@if $type eq 2@}
    <a dialog="1" class="samao-link-minibtn" href="/admin/merchant?user_id={@$rs.id@}">拥有商家</a>
    {@/if@}
    {@if $status eq 1@}<a class="samao-link-minibtn"  href="/admin/member/review?id={@$rs.id@}">审核资料</a>{@/if@}
    {@if $status neq 1@}<a class="samao-link-minibtn"  href="/admin/member/edit?id={@$rs.id@}&type={@$type@}&status={@$status@}">编辑</a>{@/if@}
</td>
{@/block@}
<!--分页控件区-->
<!--分页控件区-->		
{@block name=pagebar@}
	<div class="samao-pagebar">{@pagebar pdata=$bar@}</div>
{@/block@}
