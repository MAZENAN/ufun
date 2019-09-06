<?php /* Smarty version Smarty-3.1.19, created on 2019-06-10 09:18:32
         compiled from ".\Apps\Admin\views\layout\form_add_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:25025cfdafe8f26085-93559576%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9ad51e77be6847380d4144c4689d975d2b34a53d' => 
    array (
      0 => '.\\Apps\\Admin\\views\\layout\\form_add_list.tpl',
      1 => 1491472335,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '25025cfdafe8f26085-93559576',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'type' => 0,
    'model' => 0,
    'base_id' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5cfdafe902ae22_80888785',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5cfdafe902ae22_80888785')) {function content_5cfdafe902ae22_80888785($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>编辑报名表</title>
<style type="text/css">
html,body {
    background-color: #FFF;
}

.infotable{
border-collapse: collapse;
margin-top:5px;
}
.infotable td,.infotable th{
	line-height:24px;
	padding:5px;
	border:1px solid #ddd;
}
.infotable th{ background-color:#F2F1F0; border-right:none;}
.infotable td{  border-left:none;}
.infotable td .storage{font-size:14px; color:  #09F;}
.infotable td .order{font-size:14px; color:#9B410E;}
.form-list h3{ display: inline-block; margin-right: 15px;}
</style>
<link href="/public/samaores/css/form.plane.css" rel="stylesheet" type="text/css" />
<link href="/public/samaores/css/list.plane.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.topdialog.js"></script>
<script type="text/javascript" src="/public/js/jquery.min.js"></script>
<script type="text/javascript" src="/public/js/simplefoucs.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.validate.js"></script>
<script type="text/javascript">
$("document").ready(function(){
  //$(".digits").hide();
  $(".remove").live('click',function(){
           var id=$(this).parent().parent().attr("id");
           $("#"+id).remove();
         });
});
</script>
</head>
<body>

<div class="samao-body">
<form method="post" action="form">
 <div class="form-title"><?php if ($_smarty_tpl->tpl_vars['type']->value=='add') {?>新增报名表<?php } else { ?>编辑报名表<?php }?></div>
<div class="samao-form">

<div class="form-panel">
<div class="form-group">
    <label class="form-label" style="width:200px">报名表名称:</label>
 <div class="form-box"><?php echo FormBox::text(array('name'=>"title",),$_smarty_tpl->tpl_vars['model']->value);?></div>
   
</div>
<div class="form-group">
    <label class="form-label" style="width:200px">标题图片:</label>
 <div class="form-box"><?php echo FormBox::upimg(array('name'=>"img",),$_smarty_tpl->tpl_vars['model']->value);?></div>
</div>
<div class="form-group">
    <label class="form-label" style="width:200px">表头信息:</label>
 <div id="ajax" class="form-box"><?php echo FormBox::textarea(array('name'=>"info",),$_smarty_tpl->tpl_vars['model']->value);?></div>
</div>
<div style="clear:both"></div>
</div>

</div>
  <div class="form-list"><a dialog="1" class="samao-link-btn samao-link-btn-add" href="/admin/form/node?id=<?php echo $_smarty_tpl->tpl_vars['base_id']->value;?>
">添加选项</a></div>
                     <div class="pay1-box">
                    <table id="stulist" class="infotable"   width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <th width="8%" align="center" valign="middle" bgcolor="#ebf4e3">&nbsp;&nbsp;序号</th>
                               
                                <th width="15%" align="center" valign="middle" bgcolor="#ebf4e3">选项名称</th>
                                <th width="15%" align="center" valign="middle" bgcolor="#ebf4e3">组别</th>
                                <th width="10%" align="center" valign="middle" bgcolor="#ebf4e3">非必填项</th>
                                <th width="10%" align="center" valign="middle" bgcolor="#ebf4e3">排序</th>
                              
                                <th width="8%" align="center" valign="middle" bgcolor="#ebf4e3">操作</th>
                                
                          </tr>
                            

                        </table>
                        
                        </div>
 
<div class="form-submit">
<input type="submit" class="submit" value="保存" >
<input type="button" class="back" value="返回" onclick="window.history.go(-1);">
<input type="hidden" name="type" value="<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
">
<input type="hidden" name="base_id" value="<?php echo $_smarty_tpl->tpl_vars['base_id']->value;?>
">
<div style="clear:both"></div>
</div>
</form ></div>
</body>
</html>
<?php }} ?>
