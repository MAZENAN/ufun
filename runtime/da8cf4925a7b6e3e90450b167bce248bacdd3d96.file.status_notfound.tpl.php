<?php /* Smarty version Smarty-3.1.19, created on 2019-06-03 11:33:52
         compiled from "E:\WWW\waimai\Web\samao\tpls\status_notfound.tpl" */ ?>
<?php /*%%SmartyHeaderCode:267235cf49520690280-27451804%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'da8cf4925a7b6e3e90450b167bce248bacdd3d96' => 
    array (
      0 => 'E:\\WWW\\waimai\\Web\\samao\\tpls\\status_notfound.tpl',
      1 => 1491473406,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '267235cf49520690280-27451804',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'error' => 0,
    'jumpUrl' => 0,
    'waitSecond' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5cf4952072ab72_74097510',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5cf4952072ab72_74097510')) {function content_5cf4952072ab72_74097510($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>您访问的页面不存在</title>
<style type="text/css">
*{ padding: 0; margin: 0; }
body{ background: #fff; font-family: '微软雅黑'; color: #333; font-size: 16px; }
.system-message{ padding: 30px 48px 60px 48px; margin: 80px auto; width: 800px; border:1px solid #DDD; background-color:#FFF; 
-webkit-border-radius: 10px;
		-moz-border-radius: 10px;
		border-radius: 10px;}
.system-message .jump{ padding-top: 10px;padding-left:30px;}
.system-message .jump a{ color: #333;}
.system-message .success,.system-message .error{ line-height: 1.8em; font-size: 28px; padding-left:30px;}
.system-message .detail{ font-size: 12px; line-height: 20px; margin-top: 12px; display:none}
</style>
</head>
<body>
<div class="system-message">
<img src="/public/samaores/images/404.jpg" width="500" height="93" />
<p class="error"><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</p>
<p class="detail"></p>
<p class="jump">
页面自动 <a id="href" href="<?php echo $_smarty_tpl->tpl_vars['jumpUrl']->value;?>
">跳转</a> 等待时间： <b id="wait"><?php echo $_smarty_tpl->tpl_vars['waitSecond']->value;?>
</b>秒。
</p>
</div>
<script type="text/javascript">
(function(){
var wait = document.getElementById('wait'),href = document.getElementById('href').href;
var interval = setInterval(function(){
	var time = --wait.innerHTML;
	if(time == 0) {
		location.href = href;
		clearInterval(interval);
	};
}, 1000);
})();
</script>
</body>
</html><?php }} ?>
