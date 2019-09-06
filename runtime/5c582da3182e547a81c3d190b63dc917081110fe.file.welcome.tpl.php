<?php /* Smarty version Smarty-3.1.19, created on 2019-09-06 15:31:59
         compiled from ".\Apps\Admin\views\welcome.tpl" */ ?>
<?php /*%%SmartyHeaderCode:195375d720b6f65f5c4-10661364%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5c582da3182e547a81c3d190b63dc917081110fe' => 
    array (
      0 => '.\\Apps\\Admin\\views\\welcome.tpl',
      1 => 1491472342,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '195375d720b6f65f5c4-10661364',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'row' => 0,
    'is_settle' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5d720b6f6a4e89_73495504',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d720b6f6a4e89_73495504')) {function content_5d720b6f6a4e89_73495504($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>欢迎首页</title>
<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>
<script type="text/javascript" src="/public/newlayer/layer.js"></script>
<link href="/public/samaores/css/form.plane.css" rel="stylesheet" type="text/css" />
<link href="/public/samaores/css/list.plane.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="tablebox listbox margintop">
<div class="smbox-list-title">欢迎您登陆 <strong class="blu"><?php echo $_smarty_tpl->getConfigVariable('webname');?>
</strong> 后台管理系统。</div>
<div class="smbox-list-content">
<table width="98%" border="0" cellspacing="1"  align="center"  cellpadding="0">
	<tr>
		<td bgcolor="#FFFFFF" style="line-height: 25px; padding: 5px;">
		<p>登陆时间是： <strong><?php echo $_smarty_tpl->tpl_vars['row']->value['thistime'];?>
</strong><br> 登录的帐号是：<strong><font color="#FF0000"><?php echo $_smarty_tpl->tpl_vars['row']->value['name'];?>
</font></strong> 
        权限为：<strong> <font color="#FF0000"><?php if ($_smarty_tpl->tpl_vars['row']->value['id']==1) {?>超级管理员<?php } else { ?><?php echo ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['row']->value['type'],array(1,2,3))) && array_key_exists($_tempkey,$_temparr=array('高级管理员','一般管理员','仓库管理员'))?$_temparr[$_tempkey]:'');?>
<?php }?></font></strong>
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
<?php if ($_smarty_tpl->tpl_vars['is_settle']->value==1) {?>                
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
<?php }?>
</body>
</html>
<?php }} ?>
