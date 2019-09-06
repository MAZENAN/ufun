<?php /* Smarty version Smarty-3.1.19, created on 2019-07-08 09:08:09
         compiled from ".\Apps\Home\views\libs\header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:122815d2297791ccf08-15435763%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f7ef961c4300cfdf392d1aca6f71506a9970d4e1' => 
    array (
      0 => '.\\Apps\\Home\\views\\libs\\header.tpl',
      1 => 1491472323,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '122815d2297791ccf08-15435763',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'user' => 0,
    'config' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5d2297791e2f00_66076029',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d2297791e2f00_66076029')) {function content_5d2297791e2f00_66076029($_smarty_tpl) {?><div class="header">
  <div class="head-box">
   <?php if (empty($_smarty_tpl->tpl_vars['user']->value['id'])||empty($_smarty_tpl->tpl_vars['user']->value['name'])) {?>
       <div class="welcome">您好，欢迎来到<?php echo $_smarty_tpl->tpl_vars['config']->value['website_name'];?>
！ <a href="/login.html"  target="_self">[登录]</a>&nbsp;&nbsp;<a href="/reg.html" >[免费注册]</a></div>
    <?php } else { ?>
    <div class="welcome">您好，<a href="/user.html" style="color:#3490ff;"><?php echo $_smarty_tpl->tpl_vars['user']->value['name'];?>
</a> 欢迎来到<?php echo $_smarty_tpl->tpl_vars['config']->value['website_name'];?>
！ <a href="/user.html">[会员中心]</a>&nbsp;&nbsp;<a href="/login/out.html">[退出]</a></div>
  <?php }?>  
  
    <div class="head_right">
    <?php if (!(empty($_smarty_tpl->tpl_vars['user']->value['id'])||empty($_smarty_tpl->tpl_vars['user']->value['name']))) {?>
      <div class="head-customer">
        <h1><a href="/user.html">我的账号</a></h1>
        <ul>
          <li><a href="/account.html">账户信息</a></li>
          <li><a href="/order.html">我的订单</a></li>
          <li><a href="/score.html">我的积分</a></li>
          <li><a href="/favorites.html">个人收藏</a></li>
          <li><a href="/history.html">浏览历史</a></li>
          <li><a href="/message.html">系统提示</a></li>
          <li><a href="/login/out.html">安全退出</a></li>
        </ul>
      </div>
      <?php }?> 
      <?php echo $_smarty_tpl->getSubTemplate ("libs/kefu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

      <div class="head-tel"><img src="/public/images/head-tel.png" /></div>
    </div>
    <div class="clear"></div>
  </div>
</div><?php }} ?>
