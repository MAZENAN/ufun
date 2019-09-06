<?php /* Smarty version Smarty-3.1.19, created on 2019-06-19 10:59:49
         compiled from ".\Apps\Home\views\login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9145d09a5258673d2-22821111%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1118bb165dd3ba36c9956b6e2dafaba56984cf87' => 
    array (
      0 => '.\\Apps\\Home\\views\\login.tpl',
      1 => 1491472327,
      2 => 'file',
    ),
    '2abc61f1111f3a0ff4eea5bb855993c68187476c' => 
    array (
      0 => '.\\Apps\\Home\\views\\libs\\layout2.tpl',
      1 => 1491472325,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9145d09a5258673d2-22821111',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'config' => 0,
    'i' => 0,
    'ls' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5d09a5258e7367_66683014',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d09a5258e7367_66683014')) {function content_5d09a5258e7367_66683014($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_smarty_tpl->tpl_vars['config']->value['website_name'];?>
</title>

<link href="/public/css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/public/js/jquery.min.js"></script>
<script type="text/javascript" src="/public/js/jQuery.blockUI.js"></script>
<script type="text/javascript" src="/public/js/jquery.SuperSlide.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.validate.js"></script>
<link rel="shortcut icon" href="/public/images/favicon.ico" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
</head>

<body>


<div class="top">
  <div class="top-box">
    <div class="logo"><a href="/index.html"><img src="/public/images/logo.png" /></a></div>
    <div class="top-name">登录</div>
    <div class="top-tel"><img src="/public/images/top-tel.png" /></div>
    <div class="clear"></div>
  </div>
</div>


<div class="login">
  <div class="login-main">
    <div class="login-con">
      <div class="login-box">
        <div class="login-tit">会员登录</div>
          <div style="height:22px; margin-top:-10px;"><span id="errinfo"></span></div>
        <div class="login-form">
        <form method="post" action="/login/login.html">
          <ul>
         
            <li><?php echo FormBox::text(array('name'=>'username','class'=>'inp inp1',),$_smarty_tpl->tpl_vars['model']->value);?>
			 <img src="/public/images/login-inp1.png" />
			</li>
            <li><?php echo FormBox::password(array('name'=>'pass','class'=>'inp inp2',),$_smarty_tpl->tpl_vars['model']->value);?>
			 <img src="/public/images/login-inp2.png" />
			</li>
           
            <li style="height:20px; padding:0px; line-height:20px;"><div><a href="/forget.html">忘记密码</a><span>|</span><a href="/reg.html">免费注册</a></div></li>
            <li><?php echo FormBox::hidden(array('name'=>'url',),$_smarty_tpl->tpl_vars['model']->value);?><input type="submit" value="登 录" class="btn" /></li>
          </ul>
          </form>
        </div>
        <div class="login-other">
          <h1>第三方登录</h1>
          <div><a href="/login/qqauth.html?auth=send" class="qq">QQ帐号登录</a><a href="/login/weibo.html?auth=send" class="sina">微博登录</a></div>
        </div>
      </div>
    </div>
  </div>
</div>
            
            
            <script>
 function toLogin()
 {
   //以下为按钮点击事件的逻辑。注意这里要重新打开窗口
   //否则后面跳转到QQ登录，授权页面时会直接缩小当前浏览器的窗口，而不是打开新窗口
   var A=window.open("/login/qqauth.html?auth=send","TencentLogin","width=450,height=320,menubar=0,scrollbars=1,resizable=1,status=1,titlebar=0,toolbar=0,location=1");
 } 
</script>



<div class="other-foot">
    <?php echo $_smarty_tpl->tpl_vars['config']->value['copyright'];?>
&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['config']->value['keep'];?>
<br />

<?php  $_smarty_tpl->tpl_vars['ls'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ls']->_loop = false;
 $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = DB::getlist('select * from @pf_singlepage where `group`=1 order by sort asc'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ls']->key => $_smarty_tpl->tpl_vars['ls']->value) {
$_smarty_tpl->tpl_vars['ls']->_loop = true;
 $_smarty_tpl->tpl_vars['i']->value = $_smarty_tpl->tpl_vars['ls']->key;
?>
    <?php if ($_smarty_tpl->tpl_vars['i']->value!=0) {?><span>|</span><?php }?>
    <a href="/single-<?php echo $_smarty_tpl->tpl_vars['ls']->value['key'];?>
.html"><?php echo $_smarty_tpl->tpl_vars['ls']->value['title'];?>
</a>
    <?php } ?>

</div>
<script type='text/javascript'>
    (function(m, ei, q, i, a, j, s) {
        m[a] = m[a] || function() {
            (m[a].a = m[a].a || []).push(arguments)
        };
        j = ei.createElement(q),
            s = ei.getElementsByTagName(q)[0];
        j.async = true;
        j.charset = 'UTF-8';
        j.src = i + '?v=' + new Date().getUTCDate();
        s.parentNode.insertBefore(j, s);
    })(window, document, 'script', '//eco-api.meiqia.com/dist/meiqia.js', '_MEIQIA');
    _MEIQIA('entId', 11478);

</script>

<script src="/public/js/myweb.js" type="text/javascript"></script>
</body>
</html>
<?php }} ?>
