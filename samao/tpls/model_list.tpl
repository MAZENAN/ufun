<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{@block name=title@}默认列表标题{@/block@}</title>
<link href="__RES__/css/form.plane.css" rel="stylesheet" type="text/css" />
<link href="__RES__/css/list.plane.css" rel="stylesheet" type="text/css" />

{@block name=head@}{@/block@}
{@model_script@}
</head>
<body>
<div class="tablebox listbox margintop">
<div class="smbox-list-title">{@block name=title@}默认列表标题{@/block@} <span id="inputbox_loading" style="display:none">正在提交中...</span></div>
<div class="smbox-list-content">
{@block name=toptags@}{@/block@}
{@block name=table_topbar@}{@/block@}
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="smbox-list-table" id="smbox-list-table">
<tr>
{@block name=table_ths@}{@/block@}
</tr>
{@foreach from=$rows item=rs key=ttl@}
<tr {@block name=tr_attr@}{@/block@} onmouseover="this.oldBgcolor=this.style.backgroundColor;this.style.backgroundColor='#FCFCF8';" onmouseout="this.style.backgroundColor=this.oldBgcolor">
{@block name=table_tds@}{@/block@}
</tr>
{@/foreach@}
{@block name=allopts@}{@/block@}
</table>
{@block name=pagebar@}{@/block@}
</div>
<div class="smbox-info-tips">
{@block name=information@}{@/block@}
{@block name=attention@}{@/block@}
</div>
</div>
{@block name=listfooter@}{@/block@}
</body>
</html>