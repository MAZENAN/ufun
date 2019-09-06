<?php /* Smarty version Smarty-3.1.19, created on 2019-09-06 15:31:58
         compiled from ".\Apps\Admin\views\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:58705d720b6e927816-78989464%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '91050f23d9b630557aa45d18a27710caf7cbe9ee' => 
    array (
      0 => '.\\Apps\\Admin\\views\\index.tpl',
      1 => 1561951398,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '58705d720b6e927816-78989464',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'rows' => 0,
    'i' => 0,
    'rs' => 0,
    'adm' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5d720b6ebf67a3_99972621',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d720b6ebf67a3_99972621')) {function content_5d720b6ebf67a3_99972621($_smarty_tpl) {?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit" />
<title>后台管理</title>
<link rel="stylesheet" type="text/css" href="/public/samaores/css/jqueryui/custom.css">
<link rel="stylesheet" type="text/css" href="/public/css/admin/main.css">
<script src="/public/samaores/js/jquery.js"></script>
<script>var OnePage='<?php echo $_smarty_tpl->getConfigVariable('AdminNoPage');?>
';</script>
<script src="/public/js/admin/main.js"></script>
<script src="/public/samaores/js/jquery-ui.js"></script>
<script src="/public/samaores/js/samao.topdialog.js"></script>
<script>
$(document).ready(function(){
     $(".quick-menu li").hover(function(){
       $(".quick-menu-list").show();
    },function(){
       $(".quick-menu-list").hide();
    });
});
   
</script>
</head>
<body>

<div id="header">
<div class="topline"></div>
<div>
    <div class="logo"><img src="/public/css/admin/imgs/logo.png" width="" height="45"></div>
    
<ul id="mainmune" class="mainmune">
<?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['rows']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
 $_smarty_tpl->tpl_vars['i']->value = $_smarty_tpl->tpl_vars['rs']->key;
?>
<?php if ($_smarty_tpl->tpl_vars['i']->value==0) {?><li class="idx"><span class="lfirst"></span><a href="/admin/index/left?mid=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
" target="left" ><?php echo $_smarty_tpl->tpl_vars['rs']->value['title'];?>
</a><span class="<?php if (count($_smarty_tpl->tpl_vars['rows']->value)==1) {?>rlast<?php } else { ?>rfirst<?php }?>"></span></li>
<?php } elseif ($_smarty_tpl->tpl_vars['i']->value==count($_smarty_tpl->tpl_vars['rows']->value)-1) {?><li><span class="llast"></span><a href="/admin/index/left?mid=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
" target="left" ><?php echo $_smarty_tpl->tpl_vars['rs']->value['title'];?>
</a><span class="rlast"></span></li>
<?php } else { ?><li><span class="l"></span><a href="/admin/index/left?mid=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
" target="left" ><?php echo $_smarty_tpl->tpl_vars['rs']->value['title'];?>
</a><span class="r"></span></li>
<?php }?>   
<?php } ?>
</ul>

    <div id="logininfo">您好！<span class="name"><?php echo $_smarty_tpl->tpl_vars['adm']->value['name'];?>
</span>&nbsp;&nbsp;[<?php if ($_smarty_tpl->tpl_vars['adm']->value['id']==1) {?>超级管理员<?php } else { ?><?php echo ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['adm']->value['type'],array(1,2,3))) && array_key_exists($_tempkey,$_temparr=array('高级管理员','一般管理员','仓库管理员'))?$_temparr[$_tempkey]:'');?>
<?php }?>]<span>&nbsp;&nbsp;&nbsp;</span>
                    <a href="/admin/index/logout">[退出]</a><span>&nbsp;|&nbsp;</span>
					<a href="http://<?php echo $_smarty_tpl->getConfigVariable('basehost');?>
" target="_blank" id="site_homepage">站点首页</a>
    </div>
    <!--<div class="quick-menu">
        <li><dt><a>快捷菜单</a></dt>
        <div class="quick-menu-list">
            <ul>
            <a href="/admin/camp?type=0" target="Main">国内营</a>
            <a href="/admin/camp?type=1" target="Main">国际营</a>
            <a href="/admin/coupon_packs" target="Main">优惠券</a>
            </ul>
        </div></li>
    </div>-->
</div>
</div>

<div id="content">
<!--右侧内容区域-->
<div id="right">
<div class="sbar"><a href="#" id="bardiv"></a></div>

<div id="pagebar" <?php if ($_smarty_tpl->getConfigVariable('AdminNoPage')) {?> style="display:none"<?php }?>>
    <div id="pbar"><div id="movebar"></div></div>
    <div id="pbtns">
    <a id="moveleft" class="btnleft" href="#"></a>
    <a id="moveright" class="btnright" href="#"></a>
    <a id="closeall" class="btnclose" href="#"></a>
    </div>
</div>

<div id="rcontent"><iframe scrolling="auto" name="Main" id="Main" src="/admin/index/welcome" frameborder="0" width="100%" height="100%"></iframe></div>
</div>
<!--左侧菜单区域-->
<div id="left">

</div>
</div>
</body>
</html><?php }} ?>
