<?php /* Smarty version Smarty-3.1.19, created on 2019-05-09 10:52:41
         compiled from ".\Apps\Admin\views\layout\grow_comment_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:145395cd395f9a820d8-80059913%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0ba80cae5c3030cb4d3b8b9b4bbc42222b3bd45e' => 
    array (
      0 => '.\\Apps\\Admin\\views\\layout\\grow_comment_list.tpl',
      1 => 1491472340,
      2 => 'file',
    ),
    '4b0c8ba3e57f0c60af6144fd304396960b2ce574' => 
    array (
      0 => 'E:\\WWW\\waimai\\Web\\samao\\tpls\\model_list.tpl',
      1 => 1491473406,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '145395cd395f9a820d8-80059913',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'rows' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5cd395f9b23da4_03079200',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5cd395f9b23da4_03079200')) {function content_5cd395f9b23da4_03079200($_smarty_tpl) {?><?php if (!is_callable('smarty_function_pagebar')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\function.pagebar.php';
?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>问答列表</title>
<link href="/public/samaores/css/form.plane.css" rel="stylesheet" type="text/css" />
<link href="/public/samaores/css/list.plane.css" rel="stylesheet" type="text/css" />


<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.topdialog.js"></script>

<!--samao model script-->
</head>
<body>
<div class="tablebox listbox margintop">
<div class="smbox-list-title">问答列表 <span id="inputbox_loading" style="display:none">正在提交中...</span></div>
<div class="smbox-list-content">


<div class="smbox-list-toptab">
<a class="samao-link-btn samao-link-btn-refresh" href="javascript:window.location.reload()">刷新</a>&nbsp;&nbsp;&nbsp;&nbsp;
<form method="get" >
<?php echo FormBox::select(array('header'=>"是否回复",'options'=>array(array(1,'已回复'),array(2,'未回复')),'name'=>"replay",'onchange'=>"this.form.submit()",),$_smarty_tpl->tpl_vars['schmodel']->value);?>&nbsp;&nbsp;
</form>
</div>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="smbox-list-table" id="smbox-list-table">
<tr>


<th width="30">ID</th>
<th width="80">产品标题</th>
<th width="100">客户</th>
<th width="160">内容</th>
<th width="80">添加时间</th>
<th width="80">条数</th>
<th width="80">操作</th>

</tr>
<?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_smarty_tpl->tpl_vars['ttl'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['rows']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
 $_smarty_tpl->tpl_vars['ttl']->value = $_smarty_tpl->tpl_vars['rs']->key;
?>
<tr  onmouseover="this.oldBgcolor=this.style.backgroundColor;this.style.backgroundColor='#FCFCF8';" onmouseout="this.style.backgroundColor=this.oldBgcolor">

<input name="id" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
" />
<input name="action" type="hidden" value="editsort" />
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
</td>
<td align="center"><a href="/campedu-<?php echo $_smarty_tpl->tpl_vars['rs']->value['camp_id'];?>
.html" target="_blank"><?php echo $_smarty_tpl->tpl_vars['rs']->value['title'];?>
</a></td>
<td align="center"><?php if ($_smarty_tpl->tpl_vars['rs']->value['user_id']==-1) {?>营天下官方<?php } elseif ($_smarty_tpl->tpl_vars['rs']->value['nickname']) {?><?php echo $_smarty_tpl->tpl_vars['rs']->value['nickname'];?>
<?php } elseif ($_smarty_tpl->tpl_vars['rs']->value['mobile']) {?><?php echo $_smarty_tpl->tpl_vars['rs']->value['mobile'];?>
<?php } else { ?>游客<?php }?></td>
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['comment'];?>
</td>
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['add_time'];?>
</td>
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['sun']+1;?>
</td>
<td align="center">
<?php if ($_smarty_tpl->tpl_vars['rs']->value['user_id']!=-1) {?><a dialog="1" class="samao-link-minibtn" href="/admin/grow_comment/replay?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">回复</a><?php }?>
<a onclick="return confirm('确定要删除该内容吗？一旦删除将无法恢复，请谨慎操作！');" class="samao-link-minibtn" href="/admin/grow_comment/delete?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">删除</a>
</td>


</tr>
<?php } ?>

</table>

<div class="samao-pagebar"><?php echo smarty_function_pagebar(array('pdata'=>$_smarty_tpl->tpl_vars['bar']->value),$_smarty_tpl);?>
</div>

</div>
<div class="smbox-info-tips">


</div>
</div>

</body>
</html><?php }} ?>
