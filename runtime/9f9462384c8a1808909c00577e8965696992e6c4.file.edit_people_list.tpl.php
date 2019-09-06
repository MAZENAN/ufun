<?php /* Smarty version Smarty-3.1.19, created on 2019-05-27 17:03:11
         compiled from ".\Apps\Admin\views\layout\edit_people_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:51385ceba7cf4f35f0-65031939%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9f9462384c8a1808909c00577e8965696992e6c4' => 
    array (
      0 => '.\\Apps\\Admin\\views\\layout\\edit_people_list.tpl',
      1 => 1491472341,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '51385ceba7cf4f35f0-65031939',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'order' => 0,
    'id' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5ceba7cf529e70_26826791',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ceba7cf529e70_26826791')) {function content_5ceba7cf529e70_26826791($_smarty_tpl) {?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改订单人数</title>
<link rel="stylesheet" type="text/css" href="/public/samaores/css/form.plane.css"/>
<link href="/public/samaores/css/jqueryui/custom.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.validate.js"></script>
<script type="text/javascript" charset="utf-8" src="/public/samaores/js/jquery-ui.js"></script>
<script type="text/javascript" charset="utf-8" src="/public/samaores/js/jquery.ui.datepicker-zh-CN.js"></script>
<script type="text/javascript" charset="utf-8" src="/public/samaores/js/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" charset="utf-8" src="/public/samaores/js/samao.select.js"></script>

</head>
<body>

<div class="samao-body">
<div class="form-title">修改订单人数</div>

<div class="samao-form">
<form method="post" action="/admin/order/editPeople" >


<div class="form-panel"  >
<div class="form-group"  id="row_add_time">
    <label class="form-label"  style="width:150px">原订单人数：</label>
    <div class="form-box" > 学生 <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['order']->value['tourists'];?>
" readonly="true" class="form-control text"/>&nbsp;&nbsp;&nbsp;&nbsp;家长 <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['order']->value['parent'];?>
" readonly="true" class="form-control text"/></div>
</div>


<div class="form-group" id="row_type">
    <label class="form-label"  style="width:150px">修改人数：</label>
    <div class="form-box" >学生 <input type="text" class="form-control text" name="tourists" id="tourists"/>&nbsp;&nbsp;&nbsp;&nbsp;家长 <input type="text" class="form-control text"   name="parent" id="parent" /></div>
</div>

<div style="clear:both"></div>
</div>

<div class="form-submit" >
<input type="submit" class="submit" value="提交" />
<input type="button" class="back" value="返回" onclick="history.go(-1)" />
<input value="" name="_BACKURL_" type="hidden" id="BACKURL" />
<input type="hidden"  value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
"name="id" />
<div style="clear:both"></div>
</div>

</form>
</div></div>
<script>
    var url=document.referrer; 
    window.document.getElementById("BACKURL").value = url;
</script>
</body>
</html>
<?php }} ?>
