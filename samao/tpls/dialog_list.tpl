<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{@block name=title@}默认列表标题{@/block@}</title>
<link href="__RES__/css/form.plane.css" rel="stylesheet" type="text/css" />
<link href="__RES__/css/list.plane.css" rel="stylesheet" type="text/css" />
{@block name=head@}{@/block@}
</head>
<style type="text/css">
body {
	background-color: #FFF;
}
</style>
<body>
<div class="smbox-list-content">
{@block name=toptags@}{@/block@}
{@block name=table_topbar@}{@/block@}
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="smbox-list-table">
<tr>
{@block name=table_ths@}{@/block@}
</tr>

{@foreach from=$rows item=rs@}
<tr onmouseover="this.oldBgcolor=this.style.backgroundColor;this.style.backgroundColor='#FCFCF8';" onmouseout="this.style.backgroundColor=this.oldBgcolor">
{@block name=table_tds@}{@/block@}
</tr>
{@/foreach@}
{@block name=allopts@}{@/block@}
</table>
{@block name=pagebar@}{@/block@}
</div>
{@block name=information@}{@/block@}
{@block name=attention@}{@/block@}
{@block name=listfooter@}{@/block@}
</body>
</html>