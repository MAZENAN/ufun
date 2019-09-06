<?php /* Smarty version Smarty-3.1.19, created on 2019-06-19 14:39:08
         compiled from ".\Apps\Home\views\test.tpl" */ ?>
<?php /*%%SmartyHeaderCode:28955d09d88c1d9e02-15346962%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cff14f11f2ad48c656548338e2711bd622ef530d' => 
    array (
      0 => '.\\Apps\\Home\\views\\test.tpl',
      1 => 1560924696,
      2 => 'file',
    ),
    '0ecb5cefb4d6238e16b5afa4adbfa2eb789de519' => 
    array (
      0 => '.\\Apps\\Home\\views\\libs\\layout3.tpl',
      1 => 1491472323,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '28955d09d88c1d9e02-15346962',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'config' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5d09d88c2ba963_40777521',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d09d88c2ba963_40777521')) {function content_5d09d88c2ba963_40777521($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_smarty_tpl->tpl_vars['config']->value['website_name'];?>
</title>

<link href="/public/css/style.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="/public/js/jquery.min.js"></script>
<script type="text/javascript" src="/public/js/jquery.jslides.js"></script>
<script type="text/javascript" src="/public/js/simplefoucs.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.validate.js"></script>
<link rel="shortcut icon" href="/public/images/favicon.ico" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>


</head>

<body>

<?php echo $_smarty_tpl->getSubTemplate ("libs/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>



<div class="top">
  <div class="top-box">
    <div class="logo"><a href="index.html"><img src="/public/images/logo.png" /></a></div>
    <?php echo $_smarty_tpl->getSubTemplate ("libs/inc_search.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    <div class="clear"></div>
  </div>
</div>

<div class="menu">
  <ul>
    <li><a href="/index.html" class="on">首页</a></li>
    <li><a href="/cncamp.html">国内营</a></li>
    <li><a href="/glcamp.html">国际营</a></li>
    <!-- <li><a href="/ovcamp.html">境外游学</a></li> -->
    <li><a href="/campedu.html">营地教育</a></li>
  </ul>
</div>
  


<div class="wrap">

  <div class="user">
    <div class="user-left">
      <div class="user-menu">
        <div class="user-menu-tit"><div>我的个人中心</div></div>
        <div class="user-menu-list">
          <ul>
            <li<?php if (Route::get('ctl')=='user') {?> class="on"<?php }?>><h1 class="menu1"><a href="/user.html">个人主页</a></h1></li>
            <li<?php if (Route::get('ctl')=='account'&&Route::get('act')!='coupons') {?> class="on"<?php }?>>
              <h1 class="menu2"><a href="/account.html">账户信息</a></h1>
              <div class="user-menu-three">
                <!-- <a href="/account.html"<?php if (Route::get('act')=='index'||Route::get('act')=='base') {?> class="on"<?php }?>>个人资料</a> -->
                <a href="/account/children.html"<?php if (Route::get('act')=='children'||Route::get('act')=='addchild'||Route::get('act')=='editchild') {?> class="on"<?php }?>>营员资料</a>
                <a href="/account/mycount.html"<?php if (Route::get('act')=='mycount') {?> class="on"<?php }?>>我的账号</a>
                <a href="/account/changepwd.html"<?php if (Route::get('act')=='changepwd') {?> class="on"<?php }?>>修改密码</a>
              </div>
            </li>
            <li<?php if (Route::get('ctl')=='order') {?> class="on"<?php }?>><h1 class="menu3"><a href="/order.html">我的订单</a></h1></li>
            <li<?php if (Route::get('ctl')=='score') {?> class="on"<?php }?>><h1 class="menu4"><a href="/score.html">我的积分</a></h1></li>
            <li<?php if (Route::get('act')=='coupons') {?> class="on"<?php }?>><h1 class="menu8"><a href="/account/coupons.html">我的优惠券</a></h1></li>
            <li<?php if (Route::get('ctl')=='favorites') {?> class="on"<?php }?>><h1 class="menu5"><a href="/favorites.html">个人收藏</a></h1></li>
            <li<?php if (Route::get('ctl')=='history') {?> class="on"<?php }?>><h1 class="menu6"><a href="/history.html">浏览历史</a></h1></li> 
            <li<?php if (Route::get('ctl')=='message') {?> class="on"<?php }?>><h1 class="menu7"><a href="/message.html">系统提示</a></h1></li>
            
          </ul>
        </div>
      </div>
    </div>
    <div class="user-right">
    
<?php echo FormBox::upfile(array('name'=>'upfile','class'=>'inp inp1',),$_smarty_tpl->tpl_vars['model']->value);?>

    
    </div>
    <div class="clear"></div>
  </div>


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

<?php echo $_smarty_tpl->getSubTemplate ("libs/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>



<script src="/public/js/myweb.js" type="text/javascript"></script>
</body>
</html>
<?php }} ?>
