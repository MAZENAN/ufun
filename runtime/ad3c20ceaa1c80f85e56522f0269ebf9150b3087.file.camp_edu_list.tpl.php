<?php /* Smarty version Smarty-3.1.19, created on 2019-05-06 16:44:39
         compiled from ".\Apps\Admin\views\layout\camp_edu_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:140445ccff3f7e98049-37287769%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ad3c20ceaa1c80f85e56522f0269ebf9150b3087' => 
    array (
      0 => '.\\Apps\\Admin\\views\\layout\\camp_edu_list.tpl',
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
  'nocache_hash' => '140445ccff3f7e98049-37287769',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'rows' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5ccff3f8037466_04569985',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ccff3f8037466_04569985')) {function content_5ccff3f8037466_04569985($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_minimg')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\modifier.minimg.php';
if (!is_callable('smarty_modifier_sortopt')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\modifier.sortopt.php';
if (!is_callable('smarty_function_pagebar')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\function.pagebar.php';
?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
<link href="/public/samaores/css/form.plane.css" rel="stylesheet" type="text/css" />
<link href="/public/samaores/css/list.plane.css" rel="stylesheet" type="text/css" />


<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>

<!--samao model script-->
</head>
<body>
<div class="tablebox listbox margintop">
<div class="smbox-list-title"><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
 <span id="inputbox_loading" style="display:none">正在提交中...</span></div>
<div class="smbox-list-content">


<div class="smbox-list-toptab">
<form method="get">
<a class="samao-link-btn samao-link-btn-refresh" href="javascript:window.location.reload()">刷新</a>&nbsp;&nbsp;&nbsp;&nbsp;
<?php if ($_smarty_tpl->tpl_vars['type']->value!=8) {?>
<a class="samao-link-btn samao-link-btn-add" href="/admin/camp_edu/add?type=<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
">新增</a>&nbsp;&nbsp;&nbsp;&nbsp;
<?php echo FormBox::text(array('name'=>"title",'placeholder'=>"文章标题",),$_smarty_tpl->tpl_vars['schmodel']->value);?>&nbsp;&nbsp;
<input type="submit" value="查找" class="samao-mini-btn samao-mini-btn-search"/>&nbsp;&nbsp;
<?php if ($_smarty_tpl->tpl_vars['tags']->value) {?>
<?php echo FormBox::select(array('style'=>"width:80px",'header'=>"选择标签",'onchange'=>'this.form.submit();','name'=>"tag",),$_smarty_tpl->tpl_vars['schmodel']->value);?>&nbsp;&nbsp;
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['tags_comm']->value) {?>
<?php echo FormBox::select(array('header'=>"选择文章通用标签",'onchange'=>'this.form.submit();','name'=>"tag_comm",),$_smarty_tpl->tpl_vars['schmodel']->value);?>&nbsp;&nbsp;
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['type']->value==6) {?><?php echo FormBox::select(array('header'=>"选择推荐列表",'onchange'=>'this.form.submit();','options'=>array(array('"1"','阅读无公害'),array('"2"','趣味阅读')),'name'=>"commend",),$_smarty_tpl->tpl_vars['schmodel']->value);?>&nbsp;&nbsp;<?php }?>
<?php if ($_smarty_tpl->tpl_vars['tags_course']->value) {?>
<?php echo FormBox::select(array('header'=>"选择课程体系标签",'onchange'=>'this.form.submit();','name'=>"tag_course",),$_smarty_tpl->tpl_vars['schmodel']->value);?>&nbsp;&nbsp;
<?php }?>

<?php echo FormBox::select(array('options'=>array(array(1,'正常排序'),array(2,'点击量升序'),array(3,'点击量降序'),array(4,'发布日期升序'),array(5,'发布日期降序')),'onchange'=>'this.form.submit();','name'=>"order",),$_smarty_tpl->tpl_vars['schmodel']->value);?>
<?php }?>
<input type="hidden" name="type" value="<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
">
</form>
</div>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="smbox-list-table" id="smbox-list-table">
<tr>

<?php if ($_smarty_tpl->tpl_vars['type']->value==8) {?>
<th width="180">课程体系</th>
<th>文章标题</th>
<?php } else { ?>

<th width="60">ID</th>
<?php if ($_smarty_tpl->tpl_vars['type']->value!=7) {?><th width="110">图片</th><?php }?>
<th>标题</th>
<th width="180">权重排序</th>
<?php if ($_smarty_tpl->tpl_vars['tags']->value||$_smarty_tpl->tpl_vars['tags_course']->value) {?><th width="80">标签</th><?php }?>
<th width="80">是否上架</th>

<?php }?>
<th width="150">操作</th>

</tr>
<?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_smarty_tpl->tpl_vars['ttl'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['rows']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
 $_smarty_tpl->tpl_vars['ttl']->value = $_smarty_tpl->tpl_vars['rs']->key;
?>
<tr  onmouseover="this.oldBgcolor=this.style.backgroundColor;this.style.backgroundColor='#FCFCF8';" onmouseout="this.style.backgroundColor=this.oldBgcolor">

<?php if ($_smarty_tpl->tpl_vars['type']->value==8) {?>
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['title'];?>
</td>
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['article'];?>
</td>
<td align="center">
<a class="samao-link-minibtn" href="/admin/camp_edu/edit?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['article_id'];?>
&type=8&is_top=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">编辑</a>
</td>
<?php } else { ?>
<form method="post">
<input name="id" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
" />
<input name="action" type="hidden" value="editsort" />
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
</td>
<?php if ($_smarty_tpl->tpl_vars['type']->value!=7) {?><td align="center"><img src="<?php echo smarty_modifier_minimg($_smarty_tpl->tpl_vars['rs']->value['mobile_img'],70,50,1);?>
" height="50" width="70"/></td><?php }?>

<td><a  href="/campedu-<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
.html" target="_blank"><?php echo $_smarty_tpl->tpl_vars['rs']->value['title'];?>
</a></td>
<td align="center"><?php echo smarty_modifier_sortopt($_smarty_tpl->tpl_vars['rs']->value['sort'],$_smarty_tpl->tpl_vars['rs']->value['id'],1);?>
</td>
<?php if ($_smarty_tpl->tpl_vars['tags']->value||$_smarty_tpl->tpl_vars['tags_course']->value) {?><td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['tag_title'];?>
</td><?php }?>
<td align="center"><?php echo ($_smarty_tpl->tpl_vars['rs']->value['allow']==1?'<img src="/public/samaores/images/yes.gif" />':'<img src="/public/samaores/images/no.gif" />');?>
</td>
<td align="center">
<a class="samao-link-minibtn" href="/admin/camp_edu/set<?php if ($_smarty_tpl->tpl_vars['rs']->value['allow']==1) {?>off<?php } else { ?>on<?php }?>_allow?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
"><?php if ($_smarty_tpl->tpl_vars['rs']->value['allow']==0) {?>上架<?php } else { ?>下架<?php }?></a>
<a class="samao-link-minibtn" href="/admin/camp_edu/edit?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
&type=<?php echo $_smarty_tpl->tpl_vars['rs']->value['type'];?>
">编辑</a>
<a onclick="return confirm('确定要删除了吗？');" class="samao-link-minibtn" href="/admin/camp_edu/delete?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">删除</a>
</td>
</form>
<?php }?>

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
