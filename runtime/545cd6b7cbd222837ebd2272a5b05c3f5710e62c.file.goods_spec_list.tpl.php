<?php /* Smarty version Smarty-3.1.19, created on 2019-09-05 11:18:38
         compiled from ".\Apps\Admin\views\layout\goods_spec_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:89025d707e8e29cc73-70876501%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '545cd6b7cbd222837ebd2272a5b05c3f5710e62c' => 
    array (
      0 => '.\\Apps\\Admin\\views\\layout\\goods_spec_list.tpl',
      1 => 1567589348,
      2 => 'file',
    ),
    '4b0c8ba3e57f0c60af6144fd304396960b2ce574' => 
    array (
      0 => 'E:\\WWW\\waimai\\Web\\samao\\tpls\\model_list.tpl',
      1 => 1491473406,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '89025d707e8e29cc73-70876501',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'rows' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5d707e8e3a0847_84059336',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d707e8e3a0847_84059336')) {function content_5d707e8e3a0847_84059336($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_sortopt')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\modifier.sortopt.php';
?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>规格列表</title>
<link href="/public/samaores/css/form.plane.css" rel="stylesheet" type="text/css" />
<link href="/public/samaores/css/list.plane.css" rel="stylesheet" type="text/css" />


<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.topdialog.js"></script>

<!--samao model script-->
</head>
<body>
<div class="tablebox listbox margintop">
<div class="smbox-list-title">规格列表 <span id="inputbox_loading" style="display:none">正在提交中...</span></div>
<div class="smbox-list-content">


<div class="smbox-list-toptab">
    <form method="get" id="target-form">
        <a class="samao-link-btn samao-link-btn-add" href="/admin/goods_spec/add?gid=<?php echo $_smarty_tpl->tpl_vars['gid']->value;?>
">新增</a>&nbsp;&nbsp;&nbsp;&nbsp;
        <a class="samao-link-btn samao-link-btn-add" href="/admin/goods_spec/add_coco?gid=<?php echo $_smarty_tpl->tpl_vars['gid']->value;?>
">新增&nbsp;&nbsp;[COCO]</a>&nbsp;&nbsp;&nbsp;&nbsp;
        <a class="samao-link-btn samao-link-btn-add" href="/admin/goods_spec/add_diandian?gid=<?php echo $_smarty_tpl->tpl_vars['gid']->value;?>
">新增&nbsp;&nbsp;[一点点]</a>&nbsp;&nbsp;&nbsp;&nbsp;
        <a class="samao-link-btn samao-link-btn-add" href="/admin/goods_spec/add_lemon?gid=<?php echo $_smarty_tpl->tpl_vars['gid']->value;?>
">新增&nbsp;&nbsp;[快乐柠檬]</a>&nbsp;&nbsp;&nbsp;&nbsp;
    </form>
</div>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="smbox-list-table" id="smbox-list-table">
<tr>

<th width="10%">ID</th>
<th width="10%">名称</th>
<th width="10%">规格价格</th>
<th width="10%">库存</th>
<th width="15%">排序</th>
<th width="10%">是否启用</th>
<!--<th width="10%">是否必选</th>-->
<th width="18%">操作</th>

</tr>
<?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_smarty_tpl->tpl_vars['ttl'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['rows']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
 $_smarty_tpl->tpl_vars['ttl']->value = $_smarty_tpl->tpl_vars['rs']->key;
?>
<tr  onmouseover="this.oldBgcolor=this.style.backgroundColor;this.style.backgroundColor='#FCFCF8';" onmouseout="this.style.backgroundColor=this.oldBgcolor">

<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
</td>
<?php if ($_smarty_tpl->tpl_vars['rs']->value['pid']) {?>
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['level'];?>
<?php echo $_smarty_tpl->tpl_vars['rs']->value['title'];?>
</td>
<?php } else { ?>
<td><?php echo $_smarty_tpl->tpl_vars['rs']->value['level'];?>
<b><?php echo $_smarty_tpl->tpl_vars['rs']->value['title'];?>
</b></td>
<?php }?>
<td align="center"><?php if ($_smarty_tpl->tpl_vars['rs']->value['pid']>0) {?><b><?php echo $_smarty_tpl->tpl_vars['rs']->value['price'];?>
￥<?php }?></b></td>
<td align="center"><?php if ($_smarty_tpl->tpl_vars['rs']->value['pid']>0) {?><b><?php echo $_smarty_tpl->tpl_vars['rs']->value['stock'];?>
<?php }?></b></td>
<td align="center"><?php echo smarty_modifier_sortopt($_smarty_tpl->tpl_vars['rs']->value['sort'],$_smarty_tpl->tpl_vars['rs']->value['id'],1);?>
</td>
<td align="center"><?php echo ($_smarty_tpl->tpl_vars['rs']->value['allow']==1?'<img src="/public/samaores/images/yes.gif" />':'<img src="/public/samaores/images/no.gif" />');?>
</td>
<!--<td align="center"><?php if ($_smarty_tpl->tpl_vars['rs']->value['pid']==0) {?><?php echo ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['rs']->value['required'],array(0,1))) && array_key_exists($_tempkey,$_temparr=array('非必选','必选'))?$_temparr[$_tempkey]:'');?>
<?php }?></td>-->
<td align="center">
    <?php if ($_smarty_tpl->tpl_vars['rs']->value['allow']==0) {?><a class="samao-link-minibtn" href="/admin/goods_spec/seton_allow?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">启用</a>
    <?php } else { ?><a class="samao-link-minibtn" onclick="return confirm('确定要关闭该选项吗？');" href="/admin/goods_spec/setoff_allow?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">关闭</a>
    <?php }?>
    <a class="samao-link-minibtn" href="/admin/goods_spec/edit?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
&gid=<?php echo $_smarty_tpl->tpl_vars['gid']->value;?>
">编辑</a>
    <a onclick="return confirm('确定要删除吗？一旦删除将无法恢复，请谨慎操作！');" class="samao-link-minibtn" href="/admin/goods_spec/delete?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">删除</a>
</td>

</tr>
<?php } ?>

</table>

</div>
<div class="smbox-info-tips">


</div>
</div>

</body>
</html><?php }} ?>
