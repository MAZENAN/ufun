{@extends file='@model_list.tpl'@}
<!--标题-->
{@block name=title@}提现日志{@/block@}
{@block name=head@}
<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.topdialog.js"></script>
{@/block@}

<!--表格顶部区域-->
{@block name=table_topbar@}
<div class="smbox-list-toptab">
    <form method="get" id="target-form">
        <a class="samao-link-btn samao-link-btn-refresh" href="javascript:window.location.reload()">刷新</a>
    </form>
</div>
{@/block@}

<!--表头列-->
{@block name=table_ths@}
<th width="10%">ID</th>
<th width="10%">用户</th>
<th width="10%">类型</th>
<th width="10%">提现结果</th>
<th width="10%">提现时间</th>

<th width="18%">操作</th>
{@/block@}

<!--总列数合并单元格时可用-->
{@block name=colspan@}4{@/block@}

<!--表行列-->
{@block name=table_tds@}
<td align="center">{@$rs.id@}</td>
<td align="center">{@$rs.user_id|smval:'@pf_member':'real_name'@}({@$rs.user_id|smval:'@pf_member':'mobile'@})<img src="{@$rs.user_id|smval:'@pf_member':'img_head'|minimg:50:50:1@}"></td>
<td align="center">{@$rs.type|case:[0]:['赏金提现']@}</td>
<td align="center">{@$rs.ret|case:[0,1]:['<span class="red">失败</span>','<span class="gre">成功</span>']@}</td>
<td align="center">{@$rs.add_time@}</td>

<td align="center">
    <a dialog="1" class="samao-link-minibtn" href="__SELF__/detail?id={@$rs.id@}">查看</a>
</td>
{@/block@}
<!--分页控件区-->
<!--分页控件区-->		
{@block name=pagebar@}
	<div class="samao-pagebar">{@pagebar pdata=$bar@}</div>
{@/block@}
