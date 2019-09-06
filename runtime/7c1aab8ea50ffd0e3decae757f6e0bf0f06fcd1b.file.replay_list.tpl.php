<?php /* Smarty version Smarty-3.1.19, created on 2019-05-09 10:53:28
         compiled from ".\Apps\Admin\views\layout\replay_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:88915cd3962869c4e2-90569498%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7c1aab8ea50ffd0e3decae757f6e0bf0f06fcd1b' => 
    array (
      0 => '.\\Apps\\Admin\\views\\layout\\replay_list.tpl',
      1 => 1491472341,
      2 => 'file',
    ),
    '4b0c8ba3e57f0c60af6144fd304396960b2ce574' => 
    array (
      0 => 'E:\\WWW\\waimai\\Web\\samao\\tpls\\model_list.tpl',
      1 => 1491473406,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '88915cd3962869c4e2-90569498',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'rows' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5cd39628758575_97182894',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5cd39628758575_97182894')) {function content_5cd39628758575_97182894($_smarty_tpl) {?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>回复列表</title>
<link href="/public/samaores/css/form.plane.css" rel="stylesheet" type="text/css" />
<link href="/public/samaores/css/list.plane.css" rel="stylesheet" type="text/css" />


<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>

<link rel="stylesheet" type="text/css" href="/public/samaores/css/form.plane.css"/>
<script type="text/javascript" src="/public/samaores/js/samao.validate.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
      //var text = $('.name_'+<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
).text();
      $(".smbox-h3").children().text($('.name_'+<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
).text());
      $('input[name="centent"]').val($('.centent_'+<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
).text());//默认获取第一个提问内容
      $('input[name="user_id"]').val($('.centent_'+<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
).attr('userid'));//默认获取第一个
      $(".replay a").click(function(){
          var id = $(this).attr('id');
          var pid = $(this).attr('pid');
          var user_id = $(this).attr('userid');
          var name = $('.name_'+id).text();
          var centent = $(".centent_"+id).text();
          $(".smbox-h3").children().text(name);
          $("input[name='id']").val(pid);
          //$("input[name='pid']").val(pid);
          $("input[name='user_id']").val(user_id);
          $("input[name='centent']").val(centent);
    });
      $("#comment").keydown(function(event){
        if(event.keyCode==13){          
          $(".submit").click();
        }
      });
  });
</script>
<style type="text/css">
  .smbox-h3{ padding:5px 0 5px 40px; color: #4cb335; width: 120px;float:right; }
  .smbox-list-content{ margin-bottom: 180px; }
  .smbox-info-tips{ position: fixed; bottom: 0; width: 100%; box-shadow: 0 0 8px #ddd; }
  .form-submit{ margin-bottom: 10px; padding-top: 10px; }
</style>

<!--samao model script-->
</head>
<body>
<div class="tablebox listbox margintop">
<div class="smbox-list-title">回复列表 <span id="inputbox_loading" style="display:none">正在提交中...</span></div>
<div class="smbox-list-content">


<div class="smbox-list-toptab">
<a class="samao-link-btn samao-link-btn-refresh" href="javascript:window.location.reload()">刷新</a>&nbsp;&nbsp;&nbsp;&nbsp;
</div>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="smbox-list-table" id="smbox-list-table">
<tr>


<th width="30">添加时间</th>
<th width="40">提问人</th>
<th width="150">提问内容</th>
<th width="60">操作</th>

</tr>
<?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_smarty_tpl->tpl_vars['ttl'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['rows']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
 $_smarty_tpl->tpl_vars['ttl']->value = $_smarty_tpl->tpl_vars['rs']->key;
?>
<tr  onmouseover="this.oldBgcolor=this.style.backgroundColor;this.style.backgroundColor='#FCFCF8';" onmouseout="this.style.backgroundColor=this.oldBgcolor">

<!--<input name="id" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
" />
<input name="action" type="hidden" value="editsort" />-->
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['add_time'];?>
</td>
<td align="center" class="name_<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">
    <?php if ($_smarty_tpl->tpl_vars['rs']->value['user_id']==-1) {?>
        营天下官方 回复
        <?php if ($_smarty_tpl->tpl_vars['rs']->value['p_userid']) {?>
            <?php if ($_smarty_tpl->tpl_vars['rs']->value['nickname']) {?>
               <?php echo $_smarty_tpl->tpl_vars['rs']->value['nickname'];?>

            <?php } elseif ($_smarty_tpl->tpl_vars['rs']->value['mobile']) {?>
                <?php echo $_smarty_tpl->tpl_vars['rs']->value['mobile'];?>

            <?php }?>
            提问
        <?php } else { ?>
            游客提问
        <?php }?>
    <?php } elseif ($_smarty_tpl->tpl_vars['rs']->value['user_id']) {?>
        <?php if ($_smarty_tpl->tpl_vars['rs']->value['nickname']) {?>
            <?php echo $_smarty_tpl->tpl_vars['rs']->value['nickname'];?>
提问
        <?php } elseif ($_smarty_tpl->tpl_vars['rs']->value['mobile']) {?>
            <?php echo $_smarty_tpl->tpl_vars['rs']->value['mobile'];?>
提问
        <?php }?>
    <?php } else { ?>
        游客提问
    <?php }?>
</td>
<td align="center" class="centent_<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
" userid="<?php echo $_smarty_tpl->tpl_vars['rs']->value['user_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['rs']->value['comment'];?>
</td>
<td align="center" class="replay" >
<?php if ($_smarty_tpl->tpl_vars['rs']->value['user_id']!=-1) {?>
<a class="samao-link-minibtn"   pid="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" userid="<?php echo $_smarty_tpl->tpl_vars['rs']->value['user_id'];?>
" id="<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">回复</a>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['rs']->value['id']!=$_smarty_tpl->tpl_vars['id']->value) {?>
<a onclick="return confirm('确定要删除该内容吗？一旦删除将无法恢复，请谨慎操作！');" class="samao-link-minibtn" href="/admin/grow_comment/delete?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
&replay=1">删除</a>
<?php }?>
</td>

</tr>
<?php } ?>

</table>

</div>
<div class="smbox-info-tips">

<form  method="post">
    
<div class="form-group" id="row_comment">
  <label class="form-label"><div class="smbox-h3">回复<label></label></div></label>
  <div class="form-box"><?php echo FormBox::textarea(array('name'=>'comment','placeholder'=>'请输入回复内容',),$_smarty_tpl->tpl_vars['model']->value);?><span id="comment_info" class="field-info"></span></div>
</div>
<div class="form-submit" >
<input type="submit" class="submit" value="提交" />
<input type="button" class="back" value="返回" onclick="javascript:history.back(window.close());"/>
<div style="clear:both"></div>
</div>
<input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
"/>
<input type="hidden" name="pid" />
<input type="hidden" name="user_id" />
<input type="hidden" name="camp_id" value="<?php echo $_smarty_tpl->tpl_vars['rs']->value['camp_id'];?>
"/>
<input type="hidden" name="title" value="<?php echo $_smarty_tpl->tpl_vars['rs']->value['title'];?>
"/>
<input type="hidden" name="centent" />
 </form>


</div>
</div>

</body>
</html><?php }} ?>
