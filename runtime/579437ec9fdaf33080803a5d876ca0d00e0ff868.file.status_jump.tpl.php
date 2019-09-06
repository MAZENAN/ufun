<?php /* Smarty version Smarty-3.1.19, created on 2019-09-05 11:32:35
         compiled from "E:\WWW\waimai\Web\samao\tpls\status_jump.tpl" */ ?>
<?php /*%%SmartyHeaderCode:199355d7081d363e236-34116010%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '579437ec9fdaf33080803a5d876ca0d00e0ff868' => 
    array (
      0 => 'E:\\WWW\\waimai\\Web\\samao\\tpls\\status_jump.tpl',
      1 => 1491473406,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '199355d7081d363e236-34116010',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'status' => 0,
    'message' => 0,
    'error' => 0,
    'jumpUrl' => 0,
    'waitSecond' => 0,
    'script' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5d7081d366c2c8_80909194',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d7081d366c2c8_80909194')) {function content_5d7081d366c2c8_80909194($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>跳转提示</title>
<style type="text/css">
*{ padding: 0; margin: 0; }
body{ background: #fff; font-family: '微软雅黑'; color: #333; font-size: 16px;}
.system-message{ padding: 30px 48px 60px 48px; margin: 80px auto; width: 700px; border:1px solid #DDD; background-color:#FFF; 
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
<?php if ($_smarty_tpl->tpl_vars['status']->value) {?>
<img src="/public/samaores/images/success.jpg" width="500" height="93" />
<p class="success"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</p>
<?php } else { ?>
<img src="/public/samaores/images/error.jpg" width="500" height="93" />
<p class="error"><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</p>
<?php }?>
<p class="detail"></p>
<p class="jump">
页面自动 <a id="href" href="<?php echo $_smarty_tpl->tpl_vars['jumpUrl']->value;?>
">跳转</a> 等待时间： <b id="wait"><?php echo $_smarty_tpl->tpl_vars['waitSecond']->value;?>
</b>
</p>
</div>
<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>
<script type="text/javascript">
(function(){
var wait = document.getElementById('wait'),href = document.getElementById('href').href;
var interval = setInterval(function(){
	var time = --wait.innerHTML;
	if(time == 0) {
         <?php if ($_smarty_tpl->tpl_vars['script']->value) {?>
            <?php echo $_smarty_tpl->tpl_vars['script']->value;?>
;
         <?php } else { ?>
         location.href = href;
        <?php }?>
	clearInterval(interval);
	};
}, 1000);
})();
</script>

</body>
</html><?php }} ?>
