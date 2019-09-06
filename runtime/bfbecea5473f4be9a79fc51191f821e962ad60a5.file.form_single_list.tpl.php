<?php /* Smarty version Smarty-3.1.19, created on 2019-06-10 09:18:39
         compiled from ".\Apps\Admin\views\layout\form_single_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:92275cfdafef2e1848-03150612%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bfbecea5473f4be9a79fc51191f821e962ad60a5' => 
    array (
      0 => '.\\Apps\\Admin\\views\\layout\\form_single_list.tpl',
      1 => 1491472341,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '92275cfdafef2e1848-03150612',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'model' => 0,
    'base_id' => 0,
    'rows' => 0,
    'rs' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5cfdafef350e58_16156522',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5cfdafef350e58_16156522')) {function content_5cfdafef350e58_16156522($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_sortopt')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\modifier.sortopt.php';
?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>报名表详情</title>
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
<script type="text/javascript">
$("document").ready(function(){
 
  $("input[type='checkbox']").live('click',function(){
      var id =$(this).attr("id");
      var req =$(this).attr("checked");
      var required = '';
        required = 0;
      if(req != undefined){
          required = 1;
        }

     window.location.href="/admin/form/click?required="+required+"&id="+id;
  });
});
</script>
</head>
<body>

<div class="samao-body">

 <div class="form-title">报名表详情</div>
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
  <div class="form-list"><a class="samao-link-btn samao-link-btn-add" href="/admin/form/form_edit?type=1&id=<?php echo $_smarty_tpl->tpl_vars['base_id']->value;?>
">编辑</a></div>
                     <div class="pay1-box">
                    <table id="stulist" class="smbox-list-table"   width="100%" border="0" cellspacing="0" cellpadding="0" >
                            <tr>
                                <th width="8%" align="center" valign="middle" bgcolor="#ebf4e3">&nbsp;&nbsp;序号</th>
                               
                                <th width="15%" align="center" valign="middle" bgcolor="#ebf4e3">选项名称</th>
                                <th width="15%" align="center" valign="middle" bgcolor="#ebf4e3">组别</th>
                                <th width="10%" align="center" valign="middle" bgcolor="#ebf4e3">必填项</th>
                                <th width="10%" align="center" valign="middle" bgcolor="#ebf4e3">排序</th>
                              
                                <th width="8%" align="center" valign="middle" bgcolor="#ebf4e3">操作</th>
                                
                          </tr>
                            <?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['rows']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
?>
                            <form method="post" action="editsort">
                           <tr>
                               
                                <td align="center" valign="middle" ><input type="hidden" name="id[]" value="<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
"><input type="hidden" name="extend_id" value="<?php echo $_smarty_tpl->tpl_vars['rs']->value['extend_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
</td>
                                <td align="center" valign="middle" ><?php echo $_smarty_tpl->tpl_vars['rs']->value['name'];?>
</td>
                                <td align="center" valign="middle" ><?php echo DB::getval('@pf_form_node','name',$_smarty_tpl->tpl_vars['rs']->value['pid']);?>
</td>
                                <td align="center" valign="middle"><input type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
" name="required[]" <?php if ($_smarty_tpl->tpl_vars['rs']->value['req']==1) {?>checked  disabled="disabled"<?php }?><?php if ($_smarty_tpl->tpl_vars['rs']->value['required']==1) {?>checked<?php }?> id="<?php echo $_smarty_tpl->tpl_vars['rs']->value['extend_id'];?>
" req="<?php echo $_smarty_tpl->tpl_vars['rs']->value['required'];?>
"></td>
                                <td  align="center"><input type="hidden" name="sorts[]" value="<?php echo $_smarty_tpl->tpl_vars['rs']->value['sort'];?>
"><?php echo smarty_modifier_sortopt($_smarty_tpl->tpl_vars['rs']->value['sort'],$_smarty_tpl->tpl_vars['rs']->value['extend_id'],1,0);?>
</td>
                                <td  align="center" valign="middle"><a href="/admin/form/delete_extend?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['extend_id'];?>
">删除</a></td> 
                                
                                
                                 </tr>
                                 </form >
                            <?php } ?>

                        </table>
                        
                        </div>
 
<div class="form-submit">
  <input type="button" class="submit" value="返回" onclick="window.history.go(-1);">
<div style="clear:both"></div>
</div>
</div>
</body>
</html>
<?php }} ?>
