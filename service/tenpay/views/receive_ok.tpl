<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>充值成功</title>
<style>
body{margin:0px;padding:0px;font-size:12px;background-color:#FFFFFF;font-family:Tahoma,Geneva,sans-serif;color:#666;}
html,body,div,span,object,iframe,em,img,dl,dt,dd,ol,ul,li,fieldset,form,label,legend,table,tr,th,td,video,a,p,h2,h3,h4{margin:0;padding:0;border:0;outline:0;}
a:visited,a:link{color:#444;text-decoration:none;}
a:hover,a:active{color:#D34001;text-decoration:none;}
.hui{color:#999;}
.red{color:#FF0000;}
.blu{color:#3287CD;}
.navpath{height:34px;border:1px solid #CCCCCC;margin-top:0px;line-height:34px;padding-left:10px;padding-right:10px;width:958px;margin-left:auto;margin-right:auto;}
.navpath a{color:#06C;}
.navpath .left{float:left;}
.navpath .right{float:right;}
.navpath .right a{font-weight:bold;color:#CC0000;}
.main{width:980px;margin-left:auto;margin-right:auto;margin-top:50px;}
.content{
	border:#CCC 1px solid;
	}
.content-title,.list-title{
	height:34px;
	background-image: url(__PUBLIC__/css/img/yanshen.png);
	background-repeat:repeat-x;
	background-position: left -305px;
	line-height:34px;
	padding-left:15px;
	font-size:14px;
	font-weight:bold;
	}
</style>
</head>
<body>

<div class="main">

<div class="navpath">
<div class="left">您当前的位置 ：<a href="/">网站首页 </a> &gt; 账户充值</div>
<div class="right"><a href="/">返回首页</a></div>
</div>
<div class="content" style="margin-top:10px;">
<div class="content-title">账户充值</div>
<div class="content-body">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td height="69" colspan="2" align="center" valign="middle"><strong style="font-size:18px; color:#093;font-family: '微软雅黑';">充值成功</strong></td>
</tr>
<tr>
  <td height="30" align="right" valign="middle">充值订单号：</td>
  <td align="left" valign="middle">{@$dat.oid@}</td>
</tr>
<tr>
<td width="50%" height="30" align="right" valign="middle">充值会员：</td>
<td width="50%" align="left" valign="middle">{@$dat.user@}</td>
</tr>
<tr>
<td height="30" align="right" valign="middle">本次充值金额：</td>
<td align="left" valign="middle" style="font-size:18px">{@$dat.money|money@} 元</td>
</tr>
<tr>
<td height="30" align="right" valign="middle">充值后余额：</td>
<td align="left" valign="middle"  style="font-size:18px"><span class="org">{@$dat.usmoney|money@}</span>元</td>
</tr>
<tr>
<td height="50" colspan="2" align="center" valign="middle">
<a href="/">点击返回首页</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="/user/index.html">点击返回会员中心</a></td>
</tr>
<tr>
<td height="50" colspan="2" align="center" valign="middle">&nbsp;</td>
</tr>
</table>
</div>
</div>

</div>
<div class="clear"></div>

</body>
</html>
