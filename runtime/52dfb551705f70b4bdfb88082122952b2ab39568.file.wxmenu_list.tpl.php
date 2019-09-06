<?php /* Smarty version Smarty-3.1.19, created on 2019-05-14 11:02:04
         compiled from ".\Apps\Admin\views\layout\wxmenu_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:48665cda2facc7c5e0-91037117%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '52dfb551705f70b4bdfb88082122952b2ab39568' => 
    array (
      0 => '.\\Apps\\Admin\\views\\layout\\wxmenu_list.tpl',
      1 => 1491472341,
      2 => 'file',
    ),
    '4b0c8ba3e57f0c60af6144fd304396960b2ce574' => 
    array (
      0 => 'E:\\WWW\\waimai\\Web\\samao\\tpls\\model_list.tpl',
      1 => 1491473406,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '48665cda2facc7c5e0-91037117',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'rows' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5cda2facd2dd62_90299517',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5cda2facd2dd62_90299517')) {function content_5cda2facd2dd62_90299517($_smarty_tpl) {?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>微信菜单</title>
<link href="/public/samaores/css/form.plane.css" rel="stylesheet" type="text/css" />
<link href="/public/samaores/css/list.plane.css" rel="stylesheet" type="text/css" />


<!--samao model script-->
</head>
<body>
<div class="tablebox listbox margintop">
<div class="smbox-list-title">微信菜单 <span id="inputbox_loading" style="display:none">正在提交中...</span></div>
<div class="smbox-list-content">


<div class="smbox-list-toptab">
<a href="/admin/wxmenu/add" class="samao-link-btn">微信菜单</a>
<a href="/admin/wxmenu/updata" style="float: right" class="samao-link-btn">更新菜单</a>
</div>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="smbox-list-table" id="smbox-list-table">
<tr>

<th width="80">ID</th>
<th width="120">菜单标题</th>
<th width="120">栏目路径</th>
<th width="80">是否展开</th>
<th width="200">排序</th>
<th width="80">是否启用</th>
<th width="180">操作</th>

</tr>
<?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_smarty_tpl->tpl_vars['ttl'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['rows']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
 $_smarty_tpl->tpl_vars['ttl']->value = $_smarty_tpl->tpl_vars['rs']->key;
?>
<tr  onmouseover="this.oldBgcolor=this.style.backgroundColor;this.style.backgroundColor='#FCFCF8';" onmouseout="this.style.backgroundColor=this.oldBgcolor">

<form method="post">
<input name="id" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
" />
<input name="action" type="hidden" value="editsort" />
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['rs']->value['title'];?>
</td>
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['url'];?>
</td>
<td align="center"><?php echo ($_smarty_tpl->tpl_vars['rs']->value['show']==1?'<img src="/public/samaores/images/yes.gif" />':'<img src="/public/samaores/images/no.gif" />');?>
</td>
<td align="center"><?php echo FormBox::digits(array('name'=>'sort','class'=>"form-control digits",'value'=>$_smarty_tpl->tpl_vars['rs']->value['sort'],'style'=>'width:40px;',));?>
<input class="samao-mini-btn-change" title="修改" type="button" onclick="this.form.submit();" />&nbsp;&nbsp;
<a href="/admin/wxmenu/upsortbypid?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
" class="up">上移</a>  <a href="/admin/wxmenu/dnsortbypid?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
" class="down">下移</a></td>
<td align="center"><?php echo ($_smarty_tpl->tpl_vars['rs']->value['allow']==1?'<img src="/public/samaores/images/yes.gif" />':'<img src="/public/samaores/images/no.gif" />');?>
</td>
<td align="center">
<?php if ($_smarty_tpl->tpl_vars['rs']->value['create']==1) {?><a href="/admin/wxmenu/add?pid=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">添加子项</a> | <?php }?>
<?php if ($_smarty_tpl->tpl_vars['rs']->value['allow']==0) {?><a href="/admin/wxmenu/seton_allow?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">启用</a> | 
<?php } else { ?><a href="/admin/wxmenu/setoff_allow?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">关闭</a> | 
<?php }?>
<a href="/admin/wxmenu/edit?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">编辑</a> |  
<a href="/admin/wxmenu/delete?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">删除</a> 
</td>
</form>

</tr>
<?php } ?>

</table>

</div>
<div class="smbox-info-tips">


</div>
</div>

</body>
</html><?php }} ?>
