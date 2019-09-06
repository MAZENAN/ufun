{@extends file='@model_list.tpl'@}
<!--标题-->
{@block name=title@}发送短消息{@/block@}

<!--头部脚本区-->
{@block name=head@}
<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.forlist.js"></script>
{@/block@}

<!--表格顶部区域-->
{@block name=table_topbar@}
<div class="smbox-list-toptab">
<a class="samao-link-btn samao-link-btn-add" href="__SELF__/add">新增</a>
</div>
{@/block@}

<!--表头列-->
{@block name=table_ths@}
<th width="60">选择</th>
<th>标题</th>
<th width="80">消息类型</th>
<th width="180">添加时间</th>
<th width="180">操作</th>
{@/block@}

<!--总列数合并单元格时可用-->
{@block name=colspan@}5{@/block@}

<!--表行列-->
{@block name=table_tds@}
<td align="center"><input type="checkbox" value="{@$rs.id@}" class="checkitem" /></td>
<td>{@$rs.title@}</td>
<td align="center">{@$rs.type@}</td>
<td align="center">{@$rs.addtime@}</td>
<td align="center">
<a class="samao-link-minibtn" href="__SELF__/edit?id={@$rs.id@}">编辑</a>
<a onclick="return confirm('确定要删除该信息了吗？');" class="samao-link-minibtn" href="__SELF__/delete?id={@$rs.id@}">删除</a>
</td>
{@/block@}

<!--全选操作区-->
{@block name=allopts@}
<tr style="background-color:#F1F1F1">
<td align="center">
<input type="checkbox" id="checkall" />

</td>
<td>全选/撤销 &nbsp;&nbsp; <span id="allopts">
<a  class="samao-link-btn optbtn" href="__SELF__/selected_delete?ids=[ids]">删除选择</a>
</span></td>
<td></td>
<td></td>
<td></td>
</tr>
{@/block@}

<!--分页控件区-->
{@block name=pagebar@}
<div class="samao-pagebar">{@pagebar pdata=$bar@}</div>
{@/block@}