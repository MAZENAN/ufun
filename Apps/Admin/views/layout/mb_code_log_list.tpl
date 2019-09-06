{@extends file='@model_list.tpl'@}
<!--标题-->
{@block name=title@}短信日志{@/block@}

<!--表格顶部区域-->
{@block name=table_topbar@}
<div class="smbox-list-toptab">

</div>
{@/block@}

<!--表头列-->
{@block name=table_ths@}
<th width="80">手机号码</th>
<th width="80">验证码</th>
<th width="80">ip</th>
<th width="80">添加时间</th>
{@/block@}

<!--总列数合并单元格时可用-->
{@block name=colspan@}4{@/block@}

<!--表行列-->
{@block name=table_tds@}
<td align="center">{@$rs.mobile@}</td>
<td align="center">{@$rs.mbcode@}</td>
<td align="center">{@$rs.ip@}</td>
<td align="center">{@$rs.addtime|date_format:'%Y-%m-%d %H:%M:%S'@}</td>
{@/block@}

<!--分页控件区-->
{@block name=pagebar@}
<div class="samao-pagebar">{@pagebar pdata=$bar@}</div>
{@/block@}