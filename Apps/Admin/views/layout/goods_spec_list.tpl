{@extends file='@model_list.tpl'@}
<!--标题-->
{@block name=title@}规格列表{@/block@}
{@block name=head@}
<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.topdialog.js"></script>
{@/block@}

<!--表格顶部区域-->
{@block name=table_topbar@}
<div class="smbox-list-toptab">
    <form method="get" id="target-form">
        <a class="samao-link-btn samao-link-btn-add" href="__SELF__/add?gid={@$gid@}">新增</a>&nbsp;&nbsp;&nbsp;&nbsp;
        <a class="samao-link-btn samao-link-btn-add" href="__SELF__/add_coco?gid={@$gid@}">新增&nbsp;&nbsp;[COCO]</a>&nbsp;&nbsp;&nbsp;&nbsp;
        <a class="samao-link-btn samao-link-btn-add" href="__SELF__/add_diandian?gid={@$gid@}">新增&nbsp;&nbsp;[一点点]</a>&nbsp;&nbsp;&nbsp;&nbsp;
        <a class="samao-link-btn samao-link-btn-add" href="__SELF__/add_lemon?gid={@$gid@}">新增&nbsp;&nbsp;[快乐柠檬]</a>&nbsp;&nbsp;&nbsp;&nbsp;
    </form>
</div>
{@/block@}

<!--表头列-->
{@block name=table_ths@}
<th width="10%">ID</th>
<th width="10%">名称</th>
<th width="10%">规格价格</th>
<th width="10%">库存</th>
<th width="15%">排序</th>
<th width="10%">是否启用</th>
<!--<th width="10%">是否必选</th>-->
<th width="18%">操作</th>
{@/block@}

<!--总列数合并单元格时可用-->
{@block name=colspan@}4{@/block@}

<!--表行列-->
{@block name=table_tds@}
<td align="center">{@$rs.id@}</td>
{@if $rs.pid @}
<td align="center">{@$rs.level@}{@$rs.title@}</td>
{@else@}
<td>{@$rs.level@}<b>{@$rs.title@}</b></td>
{@/if@}
<td align="center">{@if $rs.pid>0@}<b>{@$rs.price@}￥{@/if@}</b></td>
<td align="center">{@if $rs.pid>0@}<b>{@$rs.stock@}{@/if@}</b></td>
<td align="center">{@$rs.sort|sortopt:$rs.id:1@}</td>
<td align="center">{@$rs.allow|way@}</td>
<!--<td align="center">{@if $rs.pid eq 0@}{@$rs.required|case:[0,1]:['非必选','必选']@}{@/if@}</td>-->
<td align="center">
    {@if $rs.allow == 0@}<a class="samao-link-minibtn" href="__SELF__/seton_allow?id={@$rs.id@}">启用</a>
    {@else@}<a class="samao-link-minibtn" onclick="return confirm('确定要关闭该选项吗？');" href="__SELF__/setoff_allow?id={@$rs.id@}">关闭</a>
    {@/if@}
    <a class="samao-link-minibtn" href="__SELF__/edit?id={@$rs.id@}&gid={@$gid@}">编辑</a>
    <a onclick="return confirm('确定要删除吗？一旦删除将无法恢复，请谨慎操作！');" class="samao-link-minibtn" href="__SELF__/delete?id={@$rs.id@}">删除</a>
</td>
{@/block@}
<!--分页控件区-->
<!--分页控件区-->
