<?php /* Smarty version Smarty-3.1.19, created on 2019-06-10 09:18:36
         compiled from ".\Apps\Admin\views\layout\form_select_node_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:183665cfdafec1d50b0-81635081%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '21e3ca0d5ab0c37f4acc2c5a425880358ef0c091' => 
    array (
      0 => '.\\Apps\\Admin\\views\\layout\\form_select_node_list.tpl',
      1 => 1491472336,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '183665cfdafec1d50b0-81635081',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'rows' => 0,
    'key' => 0,
    'rs' => 0,
    'keys' => 0,
    'rsc' => 0,
    'rss' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5cfdafec227943_99383899',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5cfdafec227943_99383899')) {function content_5cfdafec227943_99383899($_smarty_tpl) {?><!DOCTYPE html>
<html>
	<head> 
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<title>添加选项</title> 
	<link rel="stylesheet" type="text/css" href="/public/samaores/css/form.plane.css" />
     <style>
    ul.samao-box li { height: auto; margin: 5px; }
    ul.samao-box li label span{ color: #000; }
    </style>
	</head>
	<body>
		<script type="text/javascript" src="/public/samaores/js/jquery.js"></script> 
		<script type="text/javascript" src="/public/samaores/js/samao.validate.js"></script> 
		<script type="text/javascript">
		$('document').ready(function(){
		var index=0;
            window.parent.$('iframe').each(function(){
                var url=$(this).attr("src");
                if(url == "/admin/form"){           
                    var obj=$(this)[0].contentWindow;
                   obj.$(".form-tr").each(function(){
                   		var fid=$(this).attr("id");
                   		
                   		$("#id_"+fid).attr("checked","checked");
                   		
                   		obj.$(".form-tr").remove();
                   });

                } 
                index++;
             });
         

		$(".submit").live('click', function() {
			var html='';
			$(".check").each(function () {
        	if($(this).attr("checked") === 'checked'){
        		var id = $(this).val();
        		var sort = $(this).attr("sort");
        		var name = $(this).attr("name");
                        var pid  = $(this).attr("pid");
                var req = $(this).attr("req");
                var check='';
                var dis = '';
                var node_id = '';
                if(req == 1){
                    node_id = id;
                    check='checked';
                    dis ='disabled=disabled';
                }
                //alert(req);return;
        		var belong = $(this).attr("belong");
        		html += '<tr id="'+id+'" class="form-tr"><td class="form-td" align="center" valign="middle" >'+id+'<input type="hidden" name="id[]" value="'+id+'" /></td><td align="center" valign="middle">'+name+'</td><td align="center" valign="middle" >'+pid+'</td><td align="center" valign="middle"><input type="checkbox" '+dis+' name="required[]" value="'+id+'"'+check +'/><input type="hidden" name="node_id[]" value="'+node_id+'"  /></td><td align="center" valign="middle"><input type="hidden" name="sort[]" value="'+sort+'" style="width:50px" />'+sort+'</td><td  align="center" valign="middle"><a href="#" class="remove">删除</a></td></tr>';	
        	}
     	});
        var index=0;
            window.parent.$('iframe').each(function(){
                var url=$(this).attr("src");
                if(url == "/admin/form"){           
                    var obj=$(this)[0].contentWindow;
                    obj.$('#stulist').append(html);
        			window.close();

                } 
                index++;
             });
	});
});
</script>
<div style="display:none" id="h"></div>

		<div class="samao-body"> 
		<div class="form-title">
			添加选项
		</div> 

			<div class="samao-form"> 
                            <?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['rows']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['rs']->key;
?>
                                <div class="form-box">
                                    <h2><?php echo ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['key']->value,array('0','1','2'))) && array_key_exists($_tempkey,$_temparr=array('学生信息','家长(会员)信息','其它信息'))?$_temparr[$_tempkey]:'');?>
</h2>
                                    
                                       
                                    	 <?php  $_smarty_tpl->tpl_vars['rsc'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rsc']->_loop = false;
 $_smarty_tpl->tpl_vars['keys'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['rs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rsc']->key => $_smarty_tpl->tpl_vars['rsc']->value) {
$_smarty_tpl->tpl_vars['rsc']->_loop = true;
 $_smarty_tpl->tpl_vars['keys']->value = $_smarty_tpl->tpl_vars['rsc']->key;
?>
                                          <ul class="samao-box">
                                            <label class="keys"><?php echo $_smarty_tpl->tpl_vars['keys']->value;?>
:</label>
                                        <dt class="form-radio">
                                            <?php  $_smarty_tpl->tpl_vars['rss'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rss']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['rsc']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rss']->key => $_smarty_tpl->tpl_vars['rss']->value) {
$_smarty_tpl->tpl_vars['rss']->_loop = true;
?>
                                            <li class="form-control">
                                                <label><input class="check" type="checkbox" name="<?php echo $_smarty_tpl->tpl_vars['rss']->value['name'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['rss']->value['id'];?>
" pid="<?php echo $_smarty_tpl->tpl_vars['keys']->value;?>
" id="id_<?php echo $_smarty_tpl->tpl_vars['rss']->value['id'];?>
" req=<?php echo $_smarty_tpl->tpl_vars['rss']->value['required'];?>
 sort=<?php echo $_smarty_tpl->tpl_vars['rss']->value['sort'];?>
 belong=<?php echo $_smarty_tpl->tpl_vars['rss']->value['belong'];?>
  <?php if (in_array($_smarty_tpl->tpl_vars['rss']->value['id'],$_smarty_tpl->tpl_vars['rss']->value['node'])) {?>disabled='disabled' <?php }?>/><span><?php echo $_smarty_tpl->tpl_vars['rss']->value['name'];?>
</span></label>
                                            </li> 
                                            <?php } ?>
                                        </dt>
                                    </ul> <?php } ?>
                                </div>
                                <div style="clear:both"></div> 
                            <?php } ?>
				
			</div> 
			<div class="form-submit"> 
				<input type="button" class="submit" value="提交" /> 
				<input type="button" class="back" value="返回" onclick="javascript:(window.close())" /> 
				
			</div> 
		
	</div>
	</body>
</html><?php }} ?>
