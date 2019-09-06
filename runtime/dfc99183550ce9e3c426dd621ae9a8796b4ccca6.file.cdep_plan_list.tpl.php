<?php /* Smarty version Smarty-3.1.19, created on 2019-05-10 13:43:52
         compiled from ".\Apps\Admin\views\layout\cdep_plan_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:166245cd50f9885bd26-70471641%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dfc99183550ce9e3c426dd621ae9a8796b4ccca6' => 
    array (
      0 => '.\\Apps\\Admin\\views\\layout\\cdep_plan_list.tpl',
      1 => 1491472337,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '166245cd50f9885bd26-70471641',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'rs' => 0,
    'val' => 0,
    'camp_templet' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5cd50f988aa9b4_85965112',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5cd50f988aa9b4_85965112')) {function content_5cd50f988aa9b4_85965112($_smarty_tpl) {?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>出营安排</title>
<link rel="stylesheet" type="text/css" href="/public/samaores/css/form.plane.css"/>
<!--samao model css-->
<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.validate.js"></script>
<script type="text/javascript" charset="utf-8" src="/public/samaores/js/samao.select.js"></script>
<script type="text/javascript" charset="utf-8" src="/public/samaores/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/public/samaores/ueditor/ueditor.all.min.js"></script>
<script type="text/javascript" charset="utf-8" src="/public/samaores/js/samao.forueditor.js"></script>
<script type="text/javascript">
$(function(){ $('#内容').initUeditor();});</script>
<script>
$(document).ready(function(){
    //模板选择 get
    $("#templet").change(function(){
        var title = $("input[name='title']").val();
        var content = $("input[name='content']").text();
        if(title || content){
            if (!confirm("模板内容将会覆盖目前已编辑内容，确认覆盖吗？")) {
               return;
          }else{
          
            };
        }
        $("#submit-templet").click();
    });
    //提交文档或模板 post
    $(".submit").click(function(){
        var id = $(this).attr('id');
        var templet = $("#templetid").val();
        //编辑模板
         //if(id ==='submit-tmp' && templet){ 
           // if (!confirm("模板内容将会覆盖目前已编辑内容，确认覆盖吗？")) {
               // return;
           // };
       // }
        
        $("#https").html('<input type="hidden" name="cdep" value="'+id+'"/>');
        $("#submit-plan").click();
    }); 
});

</script>
</head>
<body>

<div class="samao-body">
<div class="form-title">出营安排</div>

<div class="samao-form">
<div class="form-panel"  >
    <form action="/admin/cdep_date/templet" method="post">
<div class="form-group"  id="row_templet">
    <label class="form-label"  style="width:150px">选择模板：</label>
 <div class="form-box" ><select name="templet_id" id="templet" class="form-control select">
  <option value=''>新建模板</option>
<?php  $_smarty_tpl->tpl_vars["rs"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["rs"]->_loop = false;
 $_from = DB::getlist('select * from @pf_camp_templet'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["rs"]->key => $_smarty_tpl->tpl_vars["rs"]->value) {
$_smarty_tpl->tpl_vars["rs"]->_loop = true;
?>
<option value="<?php echo $_smarty_tpl->tpl_vars['rs']->value['templet_id'];?>
" <?php if ($_smarty_tpl->tpl_vars['rs']->value['templet_id']==$_smarty_tpl->tpl_vars['val']->value['templet_id']) {?>selected='selected'<?php }?>><?php echo $_smarty_tpl->tpl_vars['rs']->value['title'];?>
</option>
<?php } ?>
</select></div>
</div>
<input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
"><input type="hidden" name="campid" value="<?php echo $_smarty_tpl->tpl_vars['val']->value['campid'];?>
">
<input type="submit" style="display: none;" id="submit-templet">
    </form>
<input type="hidden" id="templetid" value="<?php echo $_smarty_tpl->tpl_vars['camp_templet']->value['templet_id'];?>
"><!--模板ID-->
<form method="post" action="/admin/cdep_date/cdep_plan">
<div id="https"></div>
<input type="hidden" name="templet_id" id="templetid" value="<?php echo $_smarty_tpl->tpl_vars['camp_templet']->value['templet_id'];?>
"/><!--模板ID-->
<input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['val']->value['id'];?>
"><!--当前出发时期ID--><input type="hidden" name="campid" value="<?php echo $_smarty_tpl->tpl_vars['val']->value['campid'];?>
"><!--产品ID-->
<input type="hidden" name="camp_plan" value="<?php echo $_smarty_tpl->tpl_vars['val']->value['camp_plan'];?>
"><!--已保存本次标识-->
<div class="form-group"  id="row_title">
    <label class="form-label"  style="width:150px">标题：</label>
    <div class="form-box" ><input name="title" id="title" class="form-control text" value="<?php echo $_smarty_tpl->tpl_vars['camp_templet']->value['title'];?>
" data_valmsg_for="#title_info" data_val="{&quot;required&quot;:true}" data_val_msg="{&quot;required&quot;:&quot;\u6807\u9898\u4e0d\u80fd\u4e3a\u7a7a&quot;}" type="text" /><span id="title_info" class="field-info"></span></div>
</div>

<div class="form-group"  id="row_内容">
 <div class="form-box" style="display:table-row; width:100%;"><label class="form-label" style="float:left">内容</label> <span id="content_info" class="field-info"></span></div>
 <div class="form-box form-xheditor" style="display:table-row; width:100%;"><textarea name="content" id="内容" class="form-control ueditor" style="width:100%;height:300px;" data_valmsg_for="#content_info" data_val="{&quot;required&quot;:true}" data_val_msg="{&quot;required&quot;:&quot;\u5185\u5bb9\u4e0d\u80fd\u4e3a\u7a7a&quot;}" ><?php echo $_smarty_tpl->tpl_vars['camp_templet']->value['content'];?>
</textarea></div>
</div><div style="clear:both"></div>
</div>
<div class="form-submit" style="width: auto;">
  <input type="button" class="submit" id="submit-text" value="提交并保存为本次" />
  <input type="button" id="submit-tmp" class="submit" value="提交并保存为模板" />
  <input  class="back" type="button" value="返回" onclick="window.location.href='/admin/cdep_date?campid=<?php echo $_smarty_tpl->tpl_vars['val']->value['campid'];?>
';" />
  <input  type="submit" id='submit-plan' style="display: none;"/>
<div style="clear:both"></div>
</div>
</form>
</div></div>
</body>
</html>
<?php }} ?>
