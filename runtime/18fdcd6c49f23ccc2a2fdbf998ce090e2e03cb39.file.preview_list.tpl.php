<?php /* Smarty version Smarty-3.1.19, created on 2019-06-10 09:19:10
         compiled from ".\Apps\Admin\views\layout\preview_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13045cfdb00e891ee3-05013255%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '18fdcd6c49f23ccc2a2fdbf998ce090e2e03cb39' => 
    array (
      0 => '.\\Apps\\Admin\\views\\layout\\preview_list.tpl',
      1 => 1491472341,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13045cfdb00e891ee3-05013255',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'form_info' => 0,
    'rows0' => 0,
    'i' => 0,
    'rs' => 0,
    'model' => 0,
    'rows1' => 0,
    'j' => 0,
    'rows2' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5cfdb00ea5e2a7_69936120',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5cfdb00ea5e2a7_69936120')) {function content_5cfdb00ea5e2a7_69936120($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_minimg')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\modifier.minimg.php';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>报名表预览</title>
<script type="text/javascript" src="/public/js/jquery.min.js"></script>
<script type="text/javascript" src="/public/js/jquery.jslides.js"></script>
<script type="text/javascript" src="/public/js/simplefoucs.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.validate.js"></script>
<link rel="shortcut icon" href="/public/images/favicon.ico" />
<link rel="stylesheet" href="/public/mb/css/preview.css" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

<style>

</style>
 <script type="text/javascript">
  {*    $(document).ready(function(){  
          var ref=0;
          var p_ref=0;
          $(".select_kid").click(function(event) {
              $(".kids_name").show();
              ref = $(this).attr("ref");//当前模块排序  
          });
          $(".children").click(function(){             
                var info = $(this).attr("info");          
                var s =$.parseJSON(info);
                for(var key in s){
                    if($("input[name="+key+ref+"]").attr("type")=='radio'||$("input[name="+key+ref+"]").attr("type")=='select'){
                       $(".kids #"+key+ref+"_"+s[key]).attr("checked","checked");
                     }else{
                      $(".kids #"+key+ref).val(s[key]);
                    }
                }
                $(".kids_name").hide();
            });
        
        $(".select_parent").click(function(event) {
              $(".parents_name").show();
              p_ref = $(this).attr("ref");//当前模块排序 

          });   
        $(".patriarch").click(function(){
            var info = $(this).attr("info");
            var s =$.parseJSON(info);       
                for(var key in s){
                    if (key=='c_name') {
                      $(".parents #p_name"+p_ref).val(s[key]);
                    }else if (key=='c_gender') {
                       $(".parents #p_gender"+p_ref+"_"+s[key]).attr("checked","checked");
                    }else if (key=='IDcard') {
                      $(".parents #p_IDcard"+p_ref).val(s[key]);
                    }else{
                      if($("input[name="+key+p_ref+"]").attr("type")=='radio'||$("input[name="+key+p_ref+"]").attr("type")=='select'){
                       $(".parents #"+key+p_ref+"_"+s[key]).attr("checked","checked");
                     }else{
                      $(".parents #"+key+p_ref).val(s[key]);
                    }
                    }                    
                }
                $(".parents_name").hide();
        });
              $(".close").click(function(){
                $(this).parent().hide();
              });
      });*}
    </script>
</head>
<body>
<div class="page">
<header class="head">
  <h2><?php echo $_smarty_tpl->tpl_vars['form_info']->value['title'];?>
</h2>
</header>
<div class="banner"> <img src="<?php echo smarty_modifier_minimg($_smarty_tpl->tpl_vars['form_info']->value['img'],640,402,1);?>
" width="100%" /> </div>
<div class="content"> 
<h4>快来报名吧！</h4>
    <p>
<?php echo $_smarty_tpl->tpl_vars['form_info']->value['info'];?>

</p>
<br>
<p>课程名称 : <label>探秘疯狂动物城，畅游童话世界——千叶亲子营</label></p><br>
<p>开营日期 : <label>2016-10-21</label></p>
  <form action="add.html"  method="post">
    <?php if (!empty($_smarty_tpl->tpl_vars['rows0']->value)) {?>
    <h2>子女信息</h2>
    

    <div class="kids_name">
    <div class="close">
      <img src="../../../public/images/special/close.png" width="15" />
    </div>
    </div>

    <div class="kid_parent">
        <ul class="kids">
              
      <?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['rows0']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
 $_smarty_tpl->tpl_vars['i']->value = $_smarty_tpl->tpl_vars['rs']->key;
?>
      <li>
        <?php if ($_smarty_tpl->tpl_vars['i']->value==0) {?>
        <dt>
          <span>学生信息1</span>
          <span class="select_kid" ref="<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
">选择子女</span></dt>
          <input type="hidden" name="camper_id<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" id="camper_id<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" value="">
        <?php }?>
        
        <p><?php echo $_smarty_tpl->tpl_vars['rs']->value['name'];?>
</p>
        <?php if ($_smarty_tpl->tpl_vars['rs']->value['type']=='text') {?>
        <?php echo FormBox::text(array('name'=>((string)$_smarty_tpl->tpl_vars['rs']->value['field']),'id'=>((string)$_smarty_tpl->tpl_vars['rs']->value['field']),'class'=>'inp inp1',),$_smarty_tpl->tpl_vars['model']->value);?>
        <?php } elseif ($_smarty_tpl->tpl_vars['rs']->value['type']=='radiogroup') {?>
        <?php echo FormBox::radiogroup(array('name'=>((string)$_smarty_tpl->tpl_vars['rs']->value['field']),'id'=>((string)$_smarty_tpl->tpl_vars['rs']->value['field']),'class'=>'inp inp1',),$_smarty_tpl->tpl_vars['model']->value);?>
        <?php } elseif ($_smarty_tpl->tpl_vars['rs']->value['type']=='checkgroup') {?>
        <?php echo FormBox::checkgroup(array('name'=>((string)$_smarty_tpl->tpl_vars['rs']->value['field']),'id'=>((string)$_smarty_tpl->tpl_vars['rs']->value['field']),'class'=>'inp inp1',),$_smarty_tpl->tpl_vars['model']->value);?>
        <?php } elseif ($_smarty_tpl->tpl_vars['rs']->value['type']=='input') {?>
        <?php echo FormBox::input(array('name'=>((string)$_smarty_tpl->tpl_vars['rs']->value['field']),'id'=>((string)$_smarty_tpl->tpl_vars['rs']->value['field']),'class'=>'inp inp1',),$_smarty_tpl->tpl_vars['model']->value);?>
        <?php } elseif ($_smarty_tpl->tpl_vars['rs']->value['type']=='linkage') {?> 
        <?php echo FormBox::linkage(array('name'=>((string)$_smarty_tpl->tpl_vars['rs']->value['field']),'id'=>((string)$_smarty_tpl->tpl_vars['rs']->value['field']),'class'=>'inp inp1',),$_smarty_tpl->tpl_vars['model']->value);?>
        <?php } elseif ($_smarty_tpl->tpl_vars['rs']->value['type']=='select') {?> 
        <?php echo FormBox::select(array('name'=>((string)$_smarty_tpl->tpl_vars['rs']->value['field']),'id'=>((string)$_smarty_tpl->tpl_vars['rs']->value['field']),'class'=>'inp inp1',),$_smarty_tpl->tpl_vars['model']->value);?>
        <?php } elseif ($_smarty_tpl->tpl_vars['rs']->value['type']=='textarea') {?> 
        <?php echo FormBox::textarea(array('name'=>((string)$_smarty_tpl->tpl_vars['rs']->value['field']),'id'=>((string)$_smarty_tpl->tpl_vars['rs']->value['field']),'class'=>'inp inp1',),$_smarty_tpl->tpl_vars['model']->value);?>
        <?php } elseif ($_smarty_tpl->tpl_vars['rs']->value['type']=='date') {?> 
        <?php echo FormBox::date(array('name'=>((string)$_smarty_tpl->tpl_vars['rs']->value['field']),'id'=>((string)$_smarty_tpl->tpl_vars['rs']->value['field']),'class'=>'inp inp1',),$_smarty_tpl->tpl_vars['model']->value);?>
        <?php }?>
      </li>
      <?php } ?>

      </ul>
    </div>
    <?php }?>
        
  <?php if (!empty($_smarty_tpl->tpl_vars['rows1']->value)) {?>
  <h2>家长营员信息</h2>
 
  <div class="parents_name">
  <div class="close">
      <img src="../../../public/special/close.png" width="15">
    </div>
 
  </div>
  <div class="parent_par"><ul class="parents">
    <?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_smarty_tpl->tpl_vars['j'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['rows1']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
 $_smarty_tpl->tpl_vars['j']->value = $_smarty_tpl->tpl_vars['rs']->key;
?>
    <li>
      <?php if ($_smarty_tpl->tpl_vars['j']->value==0) {?>
        <dt><span class="select_parent" ref="<?php echo $_smarty_tpl->tpl_vars['j']->value;?>
">选择家长</span>
          <span>家长信息1</span>   </dt> 
        <input type="hidden" name="p_camper_id<?php echo $_smarty_tpl->tpl_vars['j']->value;?>
" id="p_camper_id<?php echo $_smarty_tpl->tpl_vars['j']->value;?>
" value="">
      <?php }?>
      <p><?php echo $_smarty_tpl->tpl_vars['rs']->value['name'];?>
</p>
      <?php if ($_smarty_tpl->tpl_vars['rs']->value['type']=='text') {?>
        <?php echo FormBox::text(array('name'=>((string)$_smarty_tpl->tpl_vars['rs']->value['field']),'id'=>((string)$_smarty_tpl->tpl_vars['rs']->value['field']),'class'=>'inp inp1',),$_smarty_tpl->tpl_vars['model']->value);?>
        <?php } elseif ($_smarty_tpl->tpl_vars['rs']->value['type']=='radiogroup') {?>
        <?php echo FormBox::radiogroup(array('name'=>((string)$_smarty_tpl->tpl_vars['rs']->value['field']),'id'=>((string)$_smarty_tpl->tpl_vars['rs']->value['field']),'class'=>'inp inp1',),$_smarty_tpl->tpl_vars['model']->value);?>
        <?php } elseif ($_smarty_tpl->tpl_vars['rs']->value['type']=='checkgroup') {?>
        <?php echo FormBox::checkgroup(array('name'=>((string)$_smarty_tpl->tpl_vars['rs']->value['field']),'id'=>((string)$_smarty_tpl->tpl_vars['rs']->value['field']),'class'=>'inp inp1',),$_smarty_tpl->tpl_vars['model']->value);?>
        <?php } elseif ($_smarty_tpl->tpl_vars['rs']->value['type']=='input') {?>
        <?php echo FormBox::input(array('name'=>((string)$_smarty_tpl->tpl_vars['rs']->value['field']),'id'=>((string)$_smarty_tpl->tpl_vars['rs']->value['field']),'class'=>'inp inp1',),$_smarty_tpl->tpl_vars['model']->value);?>
        <?php } elseif ($_smarty_tpl->tpl_vars['rs']->value['type']=='linkage') {?> 
        <?php echo FormBox::linkage(array('name'=>((string)$_smarty_tpl->tpl_vars['rs']->value['field']),'id'=>((string)$_smarty_tpl->tpl_vars['rs']->value['field']),'class'=>'inp inp1',),$_smarty_tpl->tpl_vars['model']->value);?>
        <?php } elseif ($_smarty_tpl->tpl_vars['rs']->value['type']=='select') {?> 
        <?php echo FormBox::select(array('name'=>((string)$_smarty_tpl->tpl_vars['rs']->value['field']),'id'=>((string)$_smarty_tpl->tpl_vars['rs']->value['field']),'class'=>'inp inp1',),$_smarty_tpl->tpl_vars['model']->value);?>
        <?php } elseif ($_smarty_tpl->tpl_vars['rs']->value['type']=='textarea') {?> 
        <?php echo FormBox::textarea(array('name'=>((string)$_smarty_tpl->tpl_vars['rs']->value['field']),'id'=>((string)$_smarty_tpl->tpl_vars['rs']->value['field']),'class'=>'inp inp1',),$_smarty_tpl->tpl_vars['model']->value);?>
        <?php } elseif ($_smarty_tpl->tpl_vars['rs']->value['type']=='date') {?> 
        <?php echo FormBox::date(array('name'=>((string)$_smarty_tpl->tpl_vars['rs']->value['field']),'id'=>((string)$_smarty_tpl->tpl_vars['rs']->value['field']),'class'=>'inp inp1',),$_smarty_tpl->tpl_vars['model']->value);?>
        <?php }?>
     <span id="c_name_info" class="field-val-error"></span></li>
    <?php } ?>
    </ul></div>
    <?php }?>
  
    <?php if (!empty($_smarty_tpl->tpl_vars['rows2']->value)) {?>
    <h2>其它</h2>
   
    <li>
      <p class="yellow"></p>
    </li>
    <label></label>
    <a class="addparent"></a> 
    <?php }?>
    <ul class="">
      <?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['rows2']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
?>
      <li>
        <p><?php echo $_smarty_tpl->tpl_vars['rs']->value['name'];?>
</p>
        <?php if ($_smarty_tpl->tpl_vars['rs']->value['type']=='text') {?>
        <?php echo FormBox::text(array('name'=>((string)$_smarty_tpl->tpl_vars['rs']->value['field']),'id'=>((string)$_smarty_tpl->tpl_vars['rs']->value['field']),'class'=>'inp inp1',),$_smarty_tpl->tpl_vars['model']->value);?>
        <?php } elseif ($_smarty_tpl->tpl_vars['rs']->value['type']=='radiogroup') {?>
        <?php echo FormBox::radiogroup(array('name'=>((string)$_smarty_tpl->tpl_vars['rs']->value['field']),'id'=>((string)$_smarty_tpl->tpl_vars['rs']->value['field']),'class'=>'inp inp1',),$_smarty_tpl->tpl_vars['model']->value);?>
        <?php } elseif ($_smarty_tpl->tpl_vars['rs']->value['type']=='checkgroup') {?>
        <?php echo FormBox::checkgroup(array('name'=>((string)$_smarty_tpl->tpl_vars['rs']->value['field']),'id'=>((string)$_smarty_tpl->tpl_vars['rs']->value['field']),'class'=>'inp inp1',),$_smarty_tpl->tpl_vars['model']->value);?>
        <?php } elseif ($_smarty_tpl->tpl_vars['rs']->value['type']=='input') {?>
        <?php echo FormBox::input(array('name'=>((string)$_smarty_tpl->tpl_vars['rs']->value['field']),'id'=>((string)$_smarty_tpl->tpl_vars['rs']->value['field']),'class'=>'inp inp1',),$_smarty_tpl->tpl_vars['model']->value);?>
        <?php } elseif ($_smarty_tpl->tpl_vars['rs']->value['type']=='linkage') {?> 
        <?php echo FormBox::linkage(array('name'=>((string)$_smarty_tpl->tpl_vars['rs']->value['field']),'id'=>((string)$_smarty_tpl->tpl_vars['rs']->value['field']),'class'=>'inp inp1',),$_smarty_tpl->tpl_vars['model']->value);?>
        <?php } elseif ($_smarty_tpl->tpl_vars['rs']->value['type']=='select') {?> 
        <?php echo FormBox::select(array('name'=>((string)$_smarty_tpl->tpl_vars['rs']->value['field']),'id'=>((string)$_smarty_tpl->tpl_vars['rs']->value['field']),'class'=>'inp inp1',),$_smarty_tpl->tpl_vars['model']->value);?>
        <?php } elseif ($_smarty_tpl->tpl_vars['rs']->value['type']=='textarea') {?> 
        <?php echo FormBox::textarea(array('name'=>((string)$_smarty_tpl->tpl_vars['rs']->value['field']),'id'=>((string)$_smarty_tpl->tpl_vars['rs']->value['field']),'class'=>'inp inp1',),$_smarty_tpl->tpl_vars['model']->value);?>
        <?php } elseif ($_smarty_tpl->tpl_vars['rs']->value['type']=='date') {?> 
        <?php echo FormBox::date(array('name'=>((string)$_smarty_tpl->tpl_vars['rs']->value['field']),'id'=>((string)$_smarty_tpl->tpl_vars['rs']->value['field']),'class'=>'inp inp1',),$_smarty_tpl->tpl_vars['model']->value);?>
        <?php }?>
        <span id="c_name_info" class="field-val-error"></span> </li>
      <?php } ?>
      
    </ul>
    <div class="form-submit">
        <input type="button" class="submit" value="返回" onclick="window.location.href='/admin/form/form';">
        <div style="clear:both"></div>
      </div>
  </form>
</div>
</div>
</body>
</html><?php }} ?>
