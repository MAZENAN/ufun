<dl style="margin-top:10px;">
    <dd><a href="__APPROOT__/index/welcome" hidefocus="true" target="Main">后台首页</a></dd>
</dl>
{@foreach from=$items item=item key=id@}
<dl>
    <dt><span>{@$item.title@}</span><i class="icon folder-open"></i></dt>
    {@foreach from=$item.item item=rs@}
    <dd {@$item.show|case:0:'style="display:none"'@}><a href="__APPROOT__/{@$rs.url@}" hidefocus="true" target="Main">{@$rs.title@}</a></dd>
     {@/foreach@}
</dl>
{@/foreach@}
