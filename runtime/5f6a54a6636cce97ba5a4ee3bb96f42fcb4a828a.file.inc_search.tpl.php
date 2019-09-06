<?php /* Smarty version Smarty-3.1.19, created on 2019-07-08 09:08:09
         compiled from ".\Apps\Home\views\libs\inc_search.tpl" */ ?>
<?php /*%%SmartyHeaderCode:212845d22977924e578-66141964%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5f6a54a6636cce97ba5a4ee3bb96f42fcb4a828a' => 
    array (
      0 => '.\\Apps\\Home\\views\\libs\\inc_search.tpl',
      1 => 1491472323,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '212845d22977924e578-66141964',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5d229779251456_13862102',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d229779251456_13862102')) {function content_5d229779251456_13862102($_smarty_tpl) {?><div class="search">
<form method="get"  action="/search.html">
<input type="text" placeholder="请输入项目名称" value="<?php echo SGet('keyword');?>
"  name="keyword" class="inp" /><input type="submit" value=" " class="btn" />
</form>
</div><?php }} ?>
