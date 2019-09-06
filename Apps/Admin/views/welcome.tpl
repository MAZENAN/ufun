<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>欢迎首页</title>
<script type="text/javascript" src="__RES__/js/jquery.js"></script>
<script type="text/javascript" src="__PUBLIC__/newlayer/layer.js"></script>
<link href="__RES__/css/form.plane.css" rel="stylesheet" type="text/css" />
<link href="__RES__/css/list.plane.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="tablebox listbox margintop">
<div class="smbox-list-title">欢迎您登陆 <strong class="blu">{@#webname#@}</strong> 后台管理系统。</div>
<div class="smbox-list-content">
<table width="98%" border="0" cellspacing="1"  align="center"  cellpadding="0">
	<tr>
		<td bgcolor="#FFFFFF" style="line-height: 25px; padding: 5px;">
		<p>登陆时间是： <strong>{@$row.thistime@}</strong><br> 登录的帐号是：<strong><font color="#FF0000">{@$row.name@}</font></strong> 
        权限为：<strong> <font color="#FF0000">{@if $row.id == 1@}超级管理员{@else@}{@$row.type|case:[1,2,3]:['高级管理员','一般管理员','仓库管理员']@}{@/if@}</font></strong>
		</p>
		<p><font color="#003399">使用时注意事项：<br />
		&nbsp;&nbsp;&nbsp;&nbsp;1.请确认你的登录是网管授权,未经授权的登录将视为非法登录。<br />
		&nbsp;&nbsp;&nbsp;&nbsp;2.本程序的改动,将直接关系前台网站页面的内容。<br />
		&nbsp;&nbsp;&nbsp;&nbsp;3.最高管理员有开放帐户的能力,是本站的最高权限,请注意保管好自已的密码。</font><br />
        
		<br />
		<br />
		<br />
		</p>
		</td>
	</tr>
</table>
</div>
</div> 
{@if $is_settle == 1@}                
<script> 
$(function () {
	        layer.open({ 
                    content: '<b style="font-size:14px">您有未审批的订单，请到订单中心进行审批！</b>',
                    type: 0,
                    area: ['300px', '180px'],
                    offset: 'rb', //右下角弹出
                    skin: 'layui-layer-lan',
                    anim: 4,
                    icon:0,
                    scrollbar:false,
                    closeBtn:1,
                    title: '系统消息',
                    btn:null,
                    yes: function(){
                   //alert(1);
                  //window.location.reload();
                  layer.closeAll();
                }
                });
});
</script>
{@/if@}
</body>
</html>
