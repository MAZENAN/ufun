<?php /* Smarty version Smarty-3.1.19, created on 2019-09-05 11:17:48
         compiled from ".\Apps\Admin\views\layout\merchant_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:90725d707e5c3e54a4-41279280%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '26e9cf2221fbf88b4ae946b91150c38b19e9a12a' => 
    array (
      0 => '.\\Apps\\Admin\\views\\layout\\merchant_list.tpl',
      1 => 1562585032,
      2 => 'file',
    ),
    '4b0c8ba3e57f0c60af6144fd304396960b2ce574' => 
    array (
      0 => 'E:\\WWW\\waimai\\Web\\samao\\tpls\\model_list.tpl',
      1 => 1491473406,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '90725d707e5c3e54a4-41279280',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'rows' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5d707e5c4fa725_96573112',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d707e5c4fa725_96573112')) {function content_5d707e5c4fa725_96573112($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_minimg')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\modifier.minimg.php';
if (!is_callable('smarty_function_pagebar')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\function.pagebar.php';
?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>商户列表</title>
<link href="/public/samaores/css/form.plane.css" rel="stylesheet" type="text/css" />
<link href="/public/samaores/css/list.plane.css" rel="stylesheet" type="text/css" />


<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.topdialog.js"></script>
<script type="text/javascript">
    $(function () {

        var count=0;
        $("#btnCheckAll").live("click", function () {
            $(".checkbox").attr("checked", true);
            $("#btnCheckAll").val("取消全选");
            $("input[type='button']").attr("id",'clearCheckAll');
            count=0;
            $(".checkbox").each(function() {
                count += 1;
            });
            $(".check_count").html(count);
        });

        $("#clearCheckAll").live("click", function () {
            $(".checkbox").attr("checked", false);
            $("#clearCheckAll").val("全选");
            $("input[type='button']").attr("id",'btnCheckAll');
            count=0;
            $(".check_count").html(count);
        });
        $(".checkbox").live("click", function () {
            if ($(this).attr("checked")) {
                count += 1;
            }  else{
                count -= 1;
            }
            $(".check_count").html(count);
        });
        $("#submit").live('click',function(){
            if(count==0){
                alert('请选择商户！');
                return;
            }
            $("#form").submit();
        });
        $("#off_submit").live('click',function(){
            if(count==0){
                alert('请选择商户！');
                return;
            }
            $("#form").attr('action','/admin/merchant/setoff_allows');
            $("#form").submit();
        });
    })
</script>
<style type="text/css">
    .form-submit{ width: 500px; }
    .form-submit dt{ float: left; line-height: 30px; padding-right: 20px; }
    .form-submit input{ float: left; }
    .form-submit input{ width: 102px; }
    .form-submit dt span.check_count{ min-width:20px; text-align: center; display: inline-block; }
    span.blu{ width: 100%; height: 100%; display: block; cursor: pointer;}
</style>

<!--samao model script-->
</head>
<body>
<div class="tablebox listbox margintop">
<div class="smbox-list-title">商户列表 <span id="inputbox_loading" style="display:none">正在提交中...</span></div>
<div class="smbox-list-content">


<div class="smbox-list-toptab">
    <form method="get">
        <a class="samao-link-btn samao-link-btn-refresh" href="javascript:window.location.reload()">刷新</a>&nbsp;
        <a class="samao-link-btn samao-link-btn-add" href="/admin/merchant/add">新增商户</a>&nbsp;&nbsp;&nbsp;&nbsp;
        <?php echo FormBox::text(array('name'=>"name",'style'=>"width:120px",'placeholder'=>"商户名",'value'=>((string)$_smarty_tpl->tpl_vars['sch']->value['name']),),$_smarty_tpl->tpl_vars['schmodel']->value);?>
        <?php echo FormBox::text(array('name'=>"phone",'style'=>"width:120px",'placeholder'=>"联系电话",'value'=>((string)$_smarty_tpl->tpl_vars['sch']->value['phone']),),$_smarty_tpl->tpl_vars['schmodel']->value);?>
        <?php echo FormBox::select(array('header'=>"营业状态",'options'=>array(array(0,'关闭'),array(1,'营业')),'onchange'=>'this.form.submit();','name'=>"allow",),$_smarty_tpl->tpl_vars['schmodel']->value);?>
        <?php echo FormBox::select(array('header'=>"入驻状态",'options'=>array(array(0,'待审核'),array(1,'入驻成功'),array(2,'入驻失败'),array(3,'停止入驻')),'onchange'=>'this.form.submit();','name'=>"status",),$_smarty_tpl->tpl_vars['schmodel']->value);?>
        <?php echo FormBox::select(array('header'=>"店铺类型",'options'=>array(array(0,'普通类型'),array(1,'自营类型')),'onchange'=>'this.form.submit();','name'=>"type",),$_smarty_tpl->tpl_vars['schmodel']->value);?>
        <input type="submit" value="查找" class="samao-mini-btn samao-mini-btn-search"/>
    </form>
</div>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="smbox-list-table" id="smbox-list-table">
<tr>

<form method="post" action="/admin/merchant/seton_allows" id="form">
<th width="30">ID</th>
<th width="30">选择</th>
<th width="10">商户名</th>
<th width="10">logo</th>
<!--<th width="10%">所属人用户名</th>-->
<!--<th width="10%">所属人电话</th>-->
<th width="10">入驻状态</th>
<th width="30">营业状态</th>
<th width="10">联系人</th>
<th width="10">联系手机</th>
<th width="10">店铺类型</th>
<th width="80">操作</th>

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
<td align="center" ><label for="merch_id<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">
    <span class="blu"><input type="checkbox" name="merch_id[]" class="checkbox" id="merch_id<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
"/></span></label>
</td>
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['name'];?>
</td>
<td align="center"><img src="<?php echo smarty_modifier_minimg($_smarty_tpl->tpl_vars['rs']->value['logo'],50,50,1);?>
" alt="logo"></td>
<!--<td align="center">{ @$rs.user_id|smval:'@pf_member':'username'@}</td>-->
<!--<td align="center">{ @$rs.user_id|smval:'@pf_member':'mobile'@}</td>-->
<td align="center"><?php echo ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['rs']->value['status'],array('0','1','2','3'))) && array_key_exists($_tempkey,$_temparr=array('未入驻','入驻成功','入驻失败','暂停中'))?$_temparr[$_tempkey]:'');?>
</td>
<td align="center"><?php echo ($_smarty_tpl->tpl_vars['rs']->value['allow']==1?'<img src="/public/samaores/images/yes.gif" />':'<img src="/public/samaores/images/no.gif" />');?>
</td>
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['contact_name'];?>
</td>
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['phone'];?>
</td>
<td align="center"><?php echo ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['rs']->value['type'],array(0,1))) && array_key_exists($_tempkey,$_temparr=array('普通类型','自营类型'))?$_temparr[$_tempkey]:'');?>
</td>
<td align="center">
    <a dialog="1" class="samao-link-minibtn" href="/admin/seller_menu/index?mid=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">商品分类管理</a>
    <a dialog="1" class="samao-link-minibtn" href="/admin/goods/index?from=m&merchant_id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">商品管理</a>
   <!-- <a dialog="1" class="samao-link-minibtn" href="/admin/order_stop/index?merchant_id={ @$rs.id@}">截单设置</a>-->
    <a dialog="1" class="samao-link-minibtn" href="/admin/delivery/index?merchant_id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">配送时间</a>
    <a dialog="1" class="samao-link-minibtn" href="/admin/notice/index?type=1&merchant_id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">店内公告</a>
    <!--<a dialog="1" class="samao-link-minibtn" href="/admin/merchant/show?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">详情</a>-->
    <?php if ($_smarty_tpl->tpl_vars['rs']->value['allow']==0) {?><a class="samao-link-minibtn" href="/admin/merchant/seton_allow?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">开启营业</a>
    <?php } else { ?><a class="samao-link-minibtn" onclick="return confirm('确定要暂停营业吗？');" href="/admin/merchant/setoff_allow?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">暂停营业</a>
    <?php }?>
    <a class="samao-link-minibtn" href="/admin/merchant/edit?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">编辑</a>
    <a onclick="return confirm('确定要删除吗？一旦删除将无法恢复，请谨慎操作！');" class="samao-link-minibtn" href="/admin/merchant/delete?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">删除</a>
</td>

</tr>
<?php } ?>

</table>

	<div class="samao-pagebar"><?php echo smarty_function_pagebar(array('pdata'=>$_smarty_tpl->tpl_vars['bar']->value),$_smarty_tpl);?>
</div>

</div>
<div class="smbox-info-tips">

</form>
<div class="form-submit" >
    <dt>已选择<span class="check_count">0</span>个</dt>
    <input type="button" class="back" value="全选"  id="btnCheckAll"/>
    <input type="submit" class="submit" value="上线营业" id="submit"/>
    <input type="submit" class="submit" value="暂停营业" id="off_submit"/>
    <div style="clear:both"></div>
</div>



</div>
</div>

</body>
</html><?php }} ?>
