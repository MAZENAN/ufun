<?php /* Smarty version Smarty-3.1.19, created on 2019-09-06 15:31:48
         compiled from ".\Apps\Admin\views\login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:124055d720b641c43a3-89573712%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '395d7711a96ada0ad1aa17e67b2dd0f85289f975' => 
    array (
      0 => '.\\Apps\\Admin\\views\\login.tpl',
      1 => 1491472342,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '124055d720b641c43a3-89573712',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5d720b64379330_44064547',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d720b64379330_44064547')) {function content_5d720b64379330_44064547($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="/public/css/admin/login.css"/>
<title>登录系统</title>


</head>
<body>
<table width="591"  class="table" height="392" align="center"  border="0" cellpadding="0" cellspacing="0">
<tr>
<td height="92">&nbsp;</td>
<td width="306">&nbsp;</td>
</tr>
<tr>
<td width="285" height="200">&nbsp;</td>
<td valign="top">
<form method="post">
<table border="0" align="center" style="width:300px" class="smbox-model-table" cellpadding="0" cellspacing="0">
<tr>
<td class="smbox-row"><table class="smbox-table" width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<th width="80" height="40">用&nbsp;户&nbsp;名：</th>
<td><input name="username" type="text" class="model-text"/></td>
</tr>
</table></td>
</tr>
<tr>
<td class="smbox-row"><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<th width="80" height="40">登录密码：</th>
<td><input type="password"  name="password" class="model-text"/></td>
</tr>
</table></td>
</tr>
<tr>
<td class="smbox-row"><table  width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<th width="80" height="40">验&nbsp;证&nbsp;码：</th>
<td width="68"><input type="text"  name="code" class="model-text" style="width:60px;"/></td>
<td width="60"><img id="codeimg" src="<?php echo $_smarty_tpl->getConfigVariable('SERVICE_VALIDCODE_URL');?>
" alt="看不清楚点击刷新！" height="24" onclick="this.src='<?php echo $_smarty_tpl->getConfigVariable('SERVICE_VALIDCODE_URL');?>
?r='+Math.random();" /></td>
<td width="92"><a href="#" onclick="document.getElementById('codeimg').src='<?php echo $_smarty_tpl->getConfigVariable('SERVICE_VALIDCODE_URL');?>
?r='+Math.random();return false;">看不清?</a></td>
</tr>
</table></td>
</tr>

</table>
<table border="0" align="center" style="width:300px" cellpadding="0" cellspacing="0">
<tr>
<th height="44">
<input type="submit" class="loginbtn" value=" " />
<input value="add" name="action" type="hidden" />
</th></tr>
<tr><td>&nbsp;</td></tr>
</table>
</form>
</td>
</tr>
<tr>
<td height="100">&nbsp;</td>
<td>&nbsp;</td>
</tr>
</table>
</body>
</html>
<?php }} ?>
