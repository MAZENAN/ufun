<?php /* Smarty version Smarty-3.1.19, created on 2019-07-08 09:08:09
         compiled from ".\Apps\Home\views\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:297665d2297790a6d89-02497028%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9fc1fa47b2ee17ca96b8678922d1d82973bc51ee' => 
    array (
      0 => '.\\Apps\\Home\\views\\index.tpl',
      1 => 1491472323,
      2 => 'file',
    ),
    '5b38e535b597905f89b97c3ca16adbb4cea8105d' => 
    array (
      0 => '.\\Apps\\Home\\views\\libs\\layout.tpl',
      1 => 1491472323,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '297665d2297790a6d89-02497028',
  'function' => 
  array (
    'floor' => 
    array (
      'parameter' => 
      array (
        'link' => NULL,
        'dat' => NULL,
        'tic' => '国内营',
        'icon' => '',
      ),
      'compiled' => '',
    ),
    'edulist' => 
    array (
      'parameter' => 
      array (
        'dat' => NULL,
      ),
      'compiled' => '',
    ),
  ),
  'variables' => 
  array (
    'config' => 0,
    'rs' => 0,
    'title' => 0,
    'Description' => 0,
    'Keywords' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5d2297791bdc28_93791187',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d2297791bdc28_93791187')) {function content_5d2297791bdc28_93791187($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_minimg')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\modifier.minimg.php';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php if (Route::get('ctl')=='index') {?> <?php echo $_smarty_tpl->tpl_vars['config']->value['website_name'];?>
丨找夏令营，上营天下！ <?php } else { ?> <?php if ($_smarty_tpl->tpl_vars['rs']->value['title']) {?><?php echo $_smarty_tpl->tpl_vars['rs']->value['title'];?>
丨<?php } elseif ($_smarty_tpl->tpl_vars['title']->value) {?><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
丨<?php }?><?php echo $_smarty_tpl->tpl_vars['config']->value['website_name'];?>
 <?php }?></title>
<meta name="description" content="<?php echo $_smarty_tpl->tpl_vars['Description']->value;?>
">
<meta name="keywords"  content="<?php echo $_smarty_tpl->tpl_vars['Keywords']->value;?>
">
<link href="/public/css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/public/js/jquery.min.js"></script>
<script type="text/javascript" src="/public/js/jquery.jslides.js"></script>
<script type="text/javascript" src="/public/js/simplefoucs.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.validate.js"></script>
<link rel="shortcut icon" href="/public/images/favicon.ico" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
<meta property="qc:admins" content="22423175776513150636" />
<meta property="wb:webmaster" content="f62972e62973a159" />
<meta property="qc:admins" content="36065775766513150636747716711154060454" />
<meta property="qc:admins" content="36065777121506367" />

</head>
<body>
<?php echo $_smarty_tpl->getSubTemplate ("libs/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div class="top">
  <div class="top-box">
    <div class="logo"><a href="index.html" title="营天下丨找夏令营，上营天下！"><img src="/public/images/logo.png" width="191" alt="营天下丨找夏令营，上营天下！" /></a></div>
    <?php echo $_smarty_tpl->getSubTemplate ("libs/inc_search.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    <div class="clear"></div>
  </div>
</div>

<div class="menu">
  <ul>
    <li><a href="/index.html"<?php if (Route::get('ctl')=='index') {?> class="on"<?php }?>>首页</a></li>
    <li><a href="/cncamp.html"<?php if (Route::get('ctl')=='cncamp') {?> class="on"<?php }?>>国内营</a></li>
    <li><a href="/glcamp.html"<?php if (Route::get('ctl')=='glcamp') {?> class="on"<?php }?>>国际营</a></li>
    <li><a href="/campedu.html"<?php if (Route::get('ctl')=='campedu') {?> class="on"<?php }?>>营地教育</a></li>
  </ul>
</div>


<meta property="qc:admins" content="2334243300652576375" />
<meta property="qc:admins" content="233424376576375" />
<div class="banner">
  <div id="full-screen-slider">
	<ul id="slides">
        <?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['mrow']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
?>
        <?php if (empty($_smarty_tpl->tpl_vars['rs']->value['link'])||$_smarty_tpl->tpl_vars['rs']->value['link']=="#") {?>
        <li style="background:url('<?php echo smarty_modifier_minimg($_smarty_tpl->tpl_vars['rs']->value['src'],0,0,1);?>
') repeat-x center;"></li>
        <?php } else { ?>
        <li style="background:url('<?php echo smarty_modifier_minimg($_smarty_tpl->tpl_vars['rs']->value['src'],0,0,1);?>
') repeat-x center;"><a href="<?php echo $_smarty_tpl->tpl_vars['rs']->value['link'];?>
" target="_blank" style="width:100%; height: 100%; display:block"></a></li>
        <?php }?>
        <?php } ?>
	</ul>
  </div>
</div>
<?php if (!is_callable('smarty_modifier_minimg')) include 'E:\WWW\waimai\Web\samao\smarty\ext\plugins\modifier.minimg.php';
if (!is_callable('smarty_modifier_truncate_cn')) include 'E:\WWW\waimai\Web\samao\smarty\ext\plugins\modifier.truncate_cn.php';
?><?php if (!function_exists('smarty_template_function_floor')) {
    function smarty_template_function_floor($_smarty_tpl,$params) {
    $saved_tpl_vars = $_smarty_tpl->tpl_vars;
    foreach ($_smarty_tpl->smarty->template_functions['floor']['parameter'] as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);};
    foreach ($params as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);}?>
<div class="homain-box">
<div class="homain-tit">
    <div class="homain-tit-box" style=" cursor: pointer" onclick="window.location.href='/<?php echo $_smarty_tpl->tpl_vars['link']->value;?>
.html'"><span><img src="<?php echo $_smarty_tpl->tpl_vars['icon']->value;?>
" /></span><?php echo $_smarty_tpl->tpl_vars['tic']->value;?>
</div>
<a href="/<?php echo $_smarty_tpl->tpl_vars['link']->value;?>
.html">更多&nbsp;&gt;</a>
</div>
<div class="floor">
<div class="floor-left">
<?php if ($_smarty_tpl->tpl_vars['dat']->value['one']) {?>
    <div class="floor-left-img"><a href="/<?php echo $_smarty_tpl->tpl_vars['link']->value;?>
-<?php echo $_smarty_tpl->tpl_vars['dat']->value['one']['id'];?>
.html" target="_blank"><img src="<?php echo smarty_modifier_minimg($_smarty_tpl->tpl_vars['dat']->value['one']['cover'],350,234,1);?>
" /></a></div>
    <div class="floor-left-txt">
	    <h1><a href="/<?php echo $_smarty_tpl->tpl_vars['link']->value;?>
-<?php echo $_smarty_tpl->tpl_vars['dat']->value['one']['id'];?>
.html" target="_blank" title="<?php echo $_smarty_tpl->tpl_vars['dat']->value['one']['title'];?>
"><?php echo smarty_modifier_truncate_cn($_smarty_tpl->tpl_vars['dat']->value['one']['title'],34);?>
</a></h1>
	    <div><?php echo smarty_modifier_truncate_cn($_smarty_tpl->tpl_vars['dat']->value['one']['tags'],120);?>
</div>
	    <h2><span class="time"><?php echo $_smarty_tpl->tpl_vars['dat']->value['one']['times'];?>
</span><?php echo $_smarty_tpl->tpl_vars['dat']->value['one']['cost'];?>
</h2>
    </div>
    <div class="floor-left-con">
    <!--<h1><a href="javascript:;">面向对象及行程</a></h1>-->
    <div style="padding-top: 10px; padding-left: 0px;"><?php echo str_replace(" ","&nbsp;",str_replace(array("\r\n","\n","\r"),'<br>',htmlspecialchars(smarty_modifier_truncate_cn($_smarty_tpl->tpl_vars['dat']->value['one']['features'],160))));?>
</div>
    <h2><a href="/<?php echo $_smarty_tpl->tpl_vars['link']->value;?>
-<?php echo $_smarty_tpl->tpl_vars['dat']->value['one']['id'];?>
.html">查看&nbsp;&gt;&gt;</a></h2>
    <div class="clear"></div>  
    </div>
<?php }?>
</div>
<div class="floor-list">
<ul>
<?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['dat']->value['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
?>
    <li>
    <div class="floor-list-box">
    <div class="floor-list-img"><a href="/<?php echo $_smarty_tpl->tpl_vars['link']->value;?>
-<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
.html"><img src="<?php echo smarty_modifier_minimg($_smarty_tpl->tpl_vars['rs']->value['cover'],274,158,1);?>
" /></a></div>
    <div class="floor-list-con">
    <h1><a href="/<?php echo $_smarty_tpl->tpl_vars['link']->value;?>
-<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
.html" target="_blank" title="<?php echo $_smarty_tpl->tpl_vars['rs']->value['title'];?>
"><?php echo smarty_modifier_truncate_cn($_smarty_tpl->tpl_vars['rs']->value['title'],38);?>
</a></h1>
    <div><?php echo smarty_modifier_truncate_cn($_smarty_tpl->tpl_vars['rs']->value['tags'],78);?>

     <div class="clear" style=" height: 0px; line-height: 0px;"></div>
    <h2><span><?php echo $_smarty_tpl->tpl_vars['rs']->value['times'];?>
</span><?php echo $_smarty_tpl->tpl_vars['rs']->value['cost'];?>
</h2></div>
    
    </div>
    </div>
    </li>
<?php } ?>
<div class="clear"></div>
</ul>
</div>
<div class="clear"></div>
</div>
</div>
<?php $_smarty_tpl->tpl_vars = $saved_tpl_vars;
foreach (Smarty::$global_tpl_vars as $key => $value) if(!isset($_smarty_tpl->tpl_vars[$key])) $_smarty_tpl->tpl_vars[$key] = $value;}}?>

    
<div class="homain">

<?php smarty_template_function_floor($_smarty_tpl,array('link'=>'cncamp','dat'=>$_smarty_tpl->tpl_vars['cncamp']->value,'tic'=>'国内营','icon'=>'/public/images/homain-tit2.png'));?>

<?php smarty_template_function_floor($_smarty_tpl,array('link'=>'glcamp','dat'=>$_smarty_tpl->tpl_vars['glcamp']->value,'tic'=>'国际营','icon'=>'/public/images/homain-tit1.png'));?>


  <div class="homain-box">
    <div class="homain-tit">
      <div class="homain-tit-box"   style=" cursor: pointer" onclick="window.location.href='/campedu.html'"><span><img src="/public/images/homain-tit4.png" /></span>营地教育</div>
      <a href="/campedu.html">更多&nbsp;&gt;</a>
    </div>
    
    <div class="fomain">
      <div class="fomain-slide">
      
        <div id="focus">
          <ul>
        <?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cmrow']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
?>
        <?php if (empty($_smarty_tpl->tpl_vars['rs']->value['link'])||$_smarty_tpl->tpl_vars['rs']->value['link']=="#") {?>
         <li><img src="<?php echo $_smarty_tpl->tpl_vars['rs']->value['src'];?>
" /></li>
        <?php } else { ?>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['rs']->value['link'];?>
" target="_blank"><img src="<?php echo smarty_modifier_minimg($_smarty_tpl->tpl_vars['rs']->value['src'],0,0,1);?>
" /></a></li>
        <?php }?>
        <?php } ?>
          </ul>
        </div>
      
      </div>
      
      <div class="fomain-list-box">
<?php if (!is_callable('smarty_modifier_minimg')) include 'E:\WWW\waimai\Web\samao\smarty\ext\plugins\modifier.minimg.php';
if (!is_callable('smarty_modifier_truncate_cn')) include 'E:\WWW\waimai\Web\samao\smarty\ext\plugins\modifier.truncate_cn.php';
if (!is_callable('smarty_modifier_date_format')) include 'E:\WWW\waimai\Web\samao\smarty\libs\plugins\modifier.date_format.php';
?><?php if (!function_exists('smarty_template_function_edulist')) {
    function smarty_template_function_edulist($_smarty_tpl,$params) {
    $saved_tpl_vars = $_smarty_tpl->tpl_vars;
    foreach ($_smarty_tpl->smarty->template_functions['edulist']['parameter'] as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);};
    foreach ($params as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);}?>
<div class="fomain-box">
<div class="fomain-hot">
<?php if (count($_smarty_tpl->tpl_vars['dat']->value)>0) {?>
<div class="fomain-hot-img"><a href="/campedu-<?php echo $_smarty_tpl->tpl_vars['dat']->value[0]['id'];?>
.html"><img src="<?php echo smarty_modifier_minimg($_smarty_tpl->tpl_vars['dat']->value[0]['img'],120,80,1);?>
" /></a></div>
<div class="fomain-hot-txt">
<h1><a href="/campedu-<?php echo $_smarty_tpl->tpl_vars['dat']->value[0]['id'];?>
.html" title="<?php echo $_smarty_tpl->tpl_vars['dat']->value[0]['title'];?>
"><?php echo smarty_modifier_truncate_cn($_smarty_tpl->tpl_vars['dat']->value[0]['title'],28);?>
</a></h1>
<div><?php echo smarty_modifier_truncate_cn($_smarty_tpl->tpl_vars['dat']->value[0]['intro'],80);?>
<a href="/campedu-<?php echo $_smarty_tpl->tpl_vars['dat']->value[0]['id'];?>
.html">[详细]</a></div>
</div>
<?php if (!array_shift($_smarty_tpl->tpl_vars['dat']->value)) {?><?php }?>
<?php }?>
</div>
<div class="fomain-list">
<ul>
<?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['dat']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
?>
<li><a href="/campedu-<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
.html" title="<?php echo $_smarty_tpl->tpl_vars['rs']->value['title'];?>
"><?php echo smarty_modifier_truncate_cn($_smarty_tpl->tpl_vars['rs']->value['title'],40);?>
</a><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['rs']->value['add_time'],'%Y-%m-%d');?>
</li>
<?php } ?>
</ul>
</div>
</div><?php $_smarty_tpl->tpl_vars = $saved_tpl_vars;
foreach (Smarty::$global_tpl_vars as $key => $value) if(!isset($_smarty_tpl->tpl_vars[$key])) $_smarty_tpl->tpl_vars[$key] = $value;}}?>

<?php smarty_template_function_edulist($_smarty_tpl,array('dat'=>$_smarty_tpl->tpl_vars['edu']->value[0]));?>

<?php smarty_template_function_edulist($_smarty_tpl,array('dat'=>$_smarty_tpl->tpl_vars['edu']->value[1]));?>

      </div>
      <div class="clear"></div>
    </div>
  </div>

</div>



<?php echo $_smarty_tpl->getSubTemplate ("libs/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<script src="/public/js/myweb.js" type="text/javascript"></script>
</body>
</html>
<?php }} ?>
