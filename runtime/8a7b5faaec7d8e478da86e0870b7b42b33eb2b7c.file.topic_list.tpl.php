<?php /* Smarty version Smarty-3.1.19, created on 2019-05-14 11:02:37
         compiled from ".\Apps\Admin\views\layout\topic_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:183725cda2fcd2df5b5-74920789%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8a7b5faaec7d8e478da86e0870b7b42b33eb2b7c' => 
    array (
      0 => '.\\Apps\\Admin\\views\\layout\\topic_list.tpl',
      1 => 1491472337,
      2 => 'file',
    ),
    '4b0c8ba3e57f0c60af6144fd304396960b2ce574' => 
    array (
      0 => 'E:\\WWW\\waimai\\Web\\samao\\tpls\\model_list.tpl',
      1 => 1491473406,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '183725cda2fcd2df5b5-74920789',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'rows' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5cda2fcd3bd6b3_86157962',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5cda2fcd3bd6b3_86157962')) {function content_5cda2fcd3bd6b3_86157962($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_sortopt')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\modifier.sortopt.php';
if (!is_callable('smarty_function_pagebar')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\function.pagebar.php';
?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>专题列表</title>
<link href="/public/samaores/css/form.plane.css" rel="stylesheet" type="text/css" />
<link href="/public/samaores/css/list.plane.css" rel="stylesheet" type="text/css" />


<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.topdialog.js"></script>
<script type="text/javascript" src="/public/js/clipboard.min.js"></script>
<style>
.one_word{ padding: 15px 20px; border-bottom: 1px solid #d5d7dc;  }
.one_word input.text{ width: 200px; height: 24px; border:1px solid #d5d7dc; padding-left: 5px; margin-left: 5px; }
.one_word .samao-mini-btn{ background:#0090b4; color: #fff; cursor: pointer; }
.one_word .samao-mini-btn:hover{ background: #00a2ca;  }
</style>

<!--samao model script-->
</head>
<body>
<div class="tablebox listbox margintop">
<div class="smbox-list-title">专题列表 <span id="inputbox_loading" style="display:none">正在提交中...</span></div>
<div class="smbox-list-content">


<div class="one_word">
    <form method="get" action="/admin/topic/save">
        首页一句话：<input type="text" class="text" name="sentence" value="<?php echo $_smarty_tpl->tpl_vars['sentence']->value;?>
" /> <input type="submit" value="保存配置" class="samao-mini-btn"/>
    </form>
    
</div>
<div class="smbox-list-toptab">
<a class="samao-link-btn samao-link-btn-refresh" href="javascript:window.location.reload()">刷新</a>&nbsp;&nbsp;&nbsp;&nbsp;
<a class="samao-link-btn samao-link-btn-add" href="/admin/topic/add">新增专题</a>&nbsp;&nbsp;&nbsp;&nbsp;

</div>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="smbox-list-table" id="smbox-list-table">
<tr>

<th width="80">专题ID</th>
<th width="80">专题名称</th>
<th width="60">上线时间</th>
<th width="80">排序</th>
<th width="80">状态</th>
<th width="240">操作</th>

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
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['name'];?>
</td>
<td align="center"><?php if ($_smarty_tpl->tpl_vars['rs']->value['allow']==1) {?><?php echo $_smarty_tpl->tpl_vars['rs']->value['uptime'];?>
<?php }?></td>
<td align="center"><?php echo smarty_modifier_sortopt($_smarty_tpl->tpl_vars['rs']->value['sort'],$_smarty_tpl->tpl_vars['rs']->value['id'],1);?>
</td>
<td align="center"><?php echo ($_smarty_tpl->tpl_vars['rs']->value['allow']==1?'<img src="/public/samaores/images/yes.gif" />':'<img src="/public/samaores/images/no.gif" />');?>
</td>
<td align="center">
    <div id="copy<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
" class="theme-address" style="font-size:0px;height:0;">m.<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
/topic/index/<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
.html</div>
<a class="copyaddress_<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
 samao-link-minibtn" type="button" data-clipboard-action="copy" data-clipboard-target="#copy<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">复制专题链接</a>
<a dialog="1" class="samao-link-minibtn" href="/admin/topic/category?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">分类</a>
<a class="samao-link-minibtn" href="/admin/topic/set<?php if ($_smarty_tpl->tpl_vars['rs']->value['allow']==1) {?>off<?php } else { ?>on<?php }?>_allow?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
"><?php if ($_smarty_tpl->tpl_vars['rs']->value['allow']==0) {?>上架<?php } else { ?>下架<?php }?></a>
<a class="samao-link-minibtn" href="/admin/topic/edit?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">编辑</a>
<a onclick="return confirm('确定要删除该用户吗？一旦删除将无法恢复，请谨慎操作！');" class="samao-link-minibtn" href="/admin/topic/delete?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">删除</a>

</td>
</form>
<script>
var clipboard = new Clipboard('.copyaddress_<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
');
clipboard.on('success', function(e) {
  alert("地址已复制到剪贴板中");
  console.log(e);
});

clipboard.on('error', function(e) {
  console.log(e);
});
</script>

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
