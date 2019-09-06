<?php /* Smarty version Smarty-3.1.19, created on 2019-07-18 09:04:05
         compiled from ".\Apps\Admin\views\layout\sysmenu_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:46525d2fc5854ebc53-71169102%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f062708bd7b6dc36e61c855242a64aeeef02d7d7' => 
    array (
      0 => '.\\Apps\\Admin\\views\\layout\\sysmenu_list.tpl',
      1 => 1491472336,
      2 => 'file',
    ),
    '4b0c8ba3e57f0c60af6144fd304396960b2ce574' => 
    array (
      0 => 'E:\\WWW\\waimai\\Web\\samao\\tpls\\model_list.tpl',
      1 => 1491473406,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '46525d2fc5854ebc53-71169102',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'rows' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5d2fc5855999e3_19266787',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d2fc5855999e3_19266787')) {function content_5d2fc5855999e3_19266787($_smarty_tpl) {?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>系统菜单栏目</title>
<link href="/public/samaores/css/form.plane.css" rel="stylesheet" type="text/css" />
<link href="/public/samaores/css/list.plane.css" rel="stylesheet" type="text/css" />


<!--samao model script-->
</head>
<body>
<div class="tablebox listbox margintop">
<div class="smbox-list-title">系统菜单栏目 <span id="inputbox_loading" style="display:none">正在提交中...</span></div>
<div class="smbox-list-content">


<div class="smbox-list-toptab">
<a href="/admin/sysmenu/add" class="samao-link-btn samao-link-btn-add">新增系统菜单</a>&nbsp;&nbsp;
<form method='get'>
<?php echo FormBox::select(array('header'=>'系统菜单','options'=>DB::getopts('@pf_sysmenu','id,title',0,"pid=0"),'style'=>"width:100px;",'onchange'=>'this.form.submit();','value'=>((string)$_smarty_tpl->tpl_vars['id']->value),'name'=>"id",),$_smarty_tpl->tpl_vars['model']->value);?>&nbsp;&nbsp;
</form>
</div>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="smbox-list-table" id="smbox-list-table">
<tr>

<th width="80">ID</th>
<th>菜单标题</th>
<th width="200">栏目路径</th>
<th width="100">是否展开</th>
<th width="200">排序</th>
<th width="100">是否启用</th>
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
<input class="samao-mini-btn-change" title="修改" type="button" onclick="this.form.submit();" />
<a href="/admin/sysmenu/upsortbypid?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
" class="up">上移</a>  <a href="/admin/sysmenu/dnsortbypid?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
" class="down">下移</a></td>
<td align="center"><?php echo ($_smarty_tpl->tpl_vars['rs']->value['allow']==1?'<img src="/public/samaores/images/yes.gif" />':'<img src="/public/samaores/images/no.gif" />');?>
</td>
<td align="center">
<?php if ($_smarty_tpl->tpl_vars['rs']->value['create']==1) {?><a href="/admin/sysmenu/add?pid=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">添加子项</a> | <?php }?>
<?php if ($_smarty_tpl->tpl_vars['rs']->value['allow']==0) {?><a href="/admin/sysmenu/seton_allow?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">启用</a> | 
<?php } else { ?><a onclick="return confirm('确定要关闭该菜单吗？');" href="/admin/sysmenu/setoff_allow?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">关闭</a> | 
<?php }?>
<a href="/admin/sysmenu/edit?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">编辑</a> |  
<a onclick="return confirm('确定要删除该菜单吗？一旦删除将无法恢复，请谨慎操作！');" href="/admin/sysmenu/delete?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
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
