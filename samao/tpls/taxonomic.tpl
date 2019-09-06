{@foreach from=$rows item=rs@}
<tr pid="{@$rs._id@}" {@block name=tr_attr@}{@/block@} onmouseover="this.oldBgcolor=this.style.backgroundColor;this.style.backgroundColor='#FFE1E1';" onmouseout="this.style.backgroundColor=this.oldBgcolor">
{@block name=table_tds@}{@/block@}
</tr>
{@/foreach@}
