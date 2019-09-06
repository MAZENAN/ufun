<?php /* Smarty version Smarty-3.1.19, created on 2019-09-05 11:33:52
         compiled from ".\Apps\Admin\views\layout\goods_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:89525d708220128731-91721331%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '508850929f32ab40bfd299ca5007ba1bb28abfce' => 
    array (
      0 => '.\\Apps\\Admin\\views\\layout\\goods_list.tpl',
      1 => 1567653801,
      2 => 'file',
    ),
    '4b0c8ba3e57f0c60af6144fd304396960b2ce574' => 
    array (
      0 => 'E:\\WWW\\waimai\\Web\\samao\\tpls\\model_list.tpl',
      1 => 1491473406,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '89525d708220128731-91721331',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'rows' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5d708220297b55_01489348',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d708220297b55_01489348')) {function content_5d708220297b55_01489348($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_minimg')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\modifier.minimg.php';
if (!is_callable('smarty_modifier_sortopt')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\modifier.sortopt.php';
if (!is_callable('smarty_function_pagebar')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\function.pagebar.php';
?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>商品列表</title>
<link href="/public/samaores/css/form.plane.css" rel="stylesheet" type="text/css" />
<link href="/public/samaores/css/list.plane.css" rel="stylesheet" type="text/css" />


<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.topdialog.js"></script>
<script type="text/javascript" src="/public/js/admin/main.js"></script>
<script type="text/javascript" src="/public/js/admin/allow_check.js"></script>

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
             alert('请选择商品！');
             return;
         }
         $("#form").submit();
     });
     $("#off_submit").live('click',function(){
         if(count==0){
             alert('请选择商品！');
             return;
         }
         $("#form").attr('action','/admin/goods/setoff_allows');
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

    ul.allow_status{ height:33px;}
    ul.allow_status li{ padding:0; width:60px; height:35px; }
    ul.allow_status li label{ font-size:14px; color:#fff; line-height:32px; width:60px; height:32px; border:1px solid #ccc; display:block; text-align:center; }
    ul.allow_status li label input{ display:none;}
    ul.allow_status li.audit-cur label{ background:#00A2CA; transition:.4s all ease;}
</style>

<!--samao model script-->
</head>
<body>
<div class="tablebox listbox margintop">
<div class="smbox-list-title">商品列表 <span id="inputbox_loading" style="display:none">正在提交中...</span></div>
<div class="smbox-list-content">


<div class="smbox-list-toptab">
    <form method="get">
        <a class="samao-link-btn samao-link-btn-refresh" href="javascript:window.location.reload()">刷新</a>
        <a class="samao-link-btn samao-link-btn-add" href="/admin/goods/add?from=<?php echo $_smarty_tpl->tpl_vars['from']->value;?>
<?php if ($_smarty_tpl->tpl_vars['from']->value=='m') {?>&merchant_id=<?php echo $_smarty_tpl->tpl_vars['sch']->value['merchant_id'];?>
<?php }?>">添加商品</a>&nbsp;&nbsp;&nbsp;&nbsp;
        <?php echo FormBox::text(array('name'=>"title",'style'=>"width:120px",'value'=>((string)$_smarty_tpl->tpl_vars['sch']->value['title']),'placeholder'=>"商品名",),$_smarty_tpl->tpl_vars['schmodel']->value);?>
        <?php echo FormBox::select(array('header'=>"上下架",'options'=>array(array(0,'已下架'),array(1,'上架中')),'onchange'=>'this.form.submit();','style'=>"width:80px",'name'=>"allow",),$_smarty_tpl->tpl_vars['schmodel']->value);?>
        <?php echo FormBox::select(array('header'=>"所有商品",'options'=>array(array(0,'仓库中'),array(1,'回收站')),'onchange'=>'this.form.submit();','style'=>"width:80px",'name'=>"deleted",),$_smarty_tpl->tpl_vars['schmodel']->value);?>
        <?php echo FormBox::select(array('header'=>"商品类型",'options'=>array(array(0,'普通'),array(1,'多规格')),'onchange'=>'this.form.submit();','style'=>"width:80px",'name'=>"is_option",),$_smarty_tpl->tpl_vars['schmodel']->value);?>
        <?php if ($_smarty_tpl->tpl_vars['from']->value!='m') {?>
        <?php echo FormBox::select(array('header'=>"所属商家",'onchange'=>'this.form.submit();','style'=>"width:80px",'name'=>"merchant_id",),$_smarty_tpl->tpl_vars['schmodel']->value);?>
        <?php } elseif ($_smarty_tpl->tpl_vars['from']->value=='m') {?>
        <input type="hidden" name="merchant_id" value="<?php echo $_smarty_tpl->tpl_vars['sch']->value['merchant_id'];?>
">
        <?php }?>
        <?php echo FormBox::select(array('header'=>"按销量",'options'=>array(array(1,'从高到底'),array(2,'从低到高')),'onchange'=>'this.form.submit();','style'=>"width:80px",'name'=>"sale_nums",),$_smarty_tpl->tpl_vars['schmodel']->value);?>
        <input type="submit" value="查找" class="samao-mini-btn samao-mini-btn-search"/>
       <!-- <input type="hidden" name="deleted" value="<?php echo $_smarty_tpl->tpl_vars['deleted']->value;?>
">-->
        <input type="hidden" name="from" value="<?php echo $_smarty_tpl->tpl_vars['from']->value;?>
">
    </form>
</div>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="smbox-list-table" id="smbox-list-table">
<tr>

<form method="post" action="/admin/goods/seton_allows" id="form">
<th width="5%">商品ID</th>
<th width="30">选择</th>
<th width="10%">商品标题</th>
<th width="10%">商户名</th>
<th width="10%">商品图</th>
<th width="5%">价格</th>
<th width="5%">库存</th>
<th width="5%">销量</th>
<th width="5%">上架状态</th>
<th width="10%">属性</th>
<th width="10%">排序</th>
<th width="20%">操作</th>

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
<td align="center" ><label for="goods_id<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">
        <span class="blu"><input type="checkbox" name="goods_id[]" class="checkbox" id="goods_id<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
"/></span></label>
</td>
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['title'];?>
</td>
<td align="center"><a data-href="/admin/merchant" href="javascript:void(0)" onclick="jump_aa()" target="Main" id="merchant"><?php echo DB::getval('@pf_merchant','name',$_smarty_tpl->tpl_vars['rs']->value['merchant_id']);?>
</a></td>
<td align="center"><img src="<?php echo smarty_modifier_minimg($_smarty_tpl->tpl_vars['rs']->value['img'],50,50,1);?>
" width="50"> </td>
<td align="center"><span class="org"><?php echo $_smarty_tpl->tpl_vars['rs']->value['market_price'];?>
</span>￥</td>
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['total'];?>
</td>
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['sales_real'];?>
</td>
<td align="center">

<div class="form-box">
    <ul id="allow_status" class="allow_status samao-box samao-box-show">
        <input disabled="disabled" type="hidden" name="allow" id="allow_<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['rs']->value['allow'];?>
"/>
        <li id="li_0_<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
" class="form-control radiogroup <?php if ($_smarty_tpl->tpl_vars['rs']->value['allow']==1) {?>audit-cur<?php }?>" onclick="allow_on(<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
)">
            <label for="check_status_0_<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
" style="border-right: none; border-radius: 5px 0px 0px 5px;">
                <input disabled="disabled" type="radio" id="check_status_0_<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
" name="check_status_<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
" value="1" <?php if ($_smarty_tpl->tpl_vars['rs']->value['allow']==1) {?>checked="checked"<?php }?> >上架</label>
        </li>
        <li id="li_1_<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
" class="form-control radiogroup <?php if ($_smarty_tpl->tpl_vars['rs']->value['allow']==0) {?>audit-cur<?php }?>"  onclick="allow_off(<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
)">
            <label id="lab_l_<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
" for="check_status_1_<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
" style="border-left: none; border-radius: 0px 5px 5px 0px; background: <?php if ($_smarty_tpl->tpl_vars['rs']->value['allow']==0) {?>rgb(128, 128, 128)<?php } else { ?>rgb(255, 255, 255)<?php }?>;">
                <input disabled="disabled" type="radio" id="check_status_1_<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
" name="check_status_<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
" value="0" <?php if ($_smarty_tpl->tpl_vars['rs']->value['allow']==0) {?>checked="checked"<?php }?>>下架</label>
        </li>
    </ul>
</div>

</td>
<!--<td align="center">{ @ $rs.allow|way @}</td>-->

<td align="center"><span class="org"><?php echo ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['rs']->value['is_new'],array('0','1'))) && array_key_exists($_tempkey,$_temparr=array('','新品 '))?$_temparr[$_tempkey]:'');?>
<?php echo ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['rs']->value['is_recommand'],array('0','1'))) && array_key_exists($_tempkey,$_temparr=array('','推荐 '))?$_temparr[$_tempkey]:'');?>
<?php echo ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['rs']->value['is_hot'],array('0','1'))) && array_key_exists($_tempkey,$_temparr=array('','热卖 '))?$_temparr[$_tempkey]:'');?>
<?php echo ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['rs']->value['is_discount'],array('0','1'))) && array_key_exists($_tempkey,$_temparr=array('','促销 '))?$_temparr[$_tempkey]:'');?>
</span></td>
<td align="center"><?php echo smarty_modifier_sortopt($_smarty_tpl->tpl_vars['rs']->value['sort'],$_smarty_tpl->tpl_vars['rs']->value['id'],5);?>
</td>
<td align="center">
    <a class="samao-link-minibtn" href="/admin/goods/edit?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">编辑</a>
    <?php if ($_smarty_tpl->tpl_vars['rs']->value['is_option']) {?>
    <a dialog="1" class="samao-link-minibtn" class="samao-link-minibtn" href="/admin/goods_spec?gid=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">规格管理</a>
    <a dialog="1" class="samao-link-minibtn" class="samao-link-minibtn" href="/admin/goods_options?goods_id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
&mid=<?php echo $_smarty_tpl->tpl_vars['rs']->value['merchant_id'];?>
">新规格管理</a>
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['rs']->value['deleted']==0) {?>
    <a onclick="return confirm('确定要置入回收站吗？');" class="samao-link-minibtn" href="/admin/goods/do_recycle?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">回收</a>
    <?php } elseif ($_smarty_tpl->tpl_vars['rs']->value['deleted']==1) {?>
    <a onclick="return confirm('确定要恢复该商品吗？');" class="samao-link-minibtn" href="/admin/goods/ret_recycle?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">恢复</a>
    <?php }?>
    <a onclick="return confirm('确定要删除吗？一旦删除将无法恢复，请谨慎操作！');" class="samao-link-minibtn" href="/admin/goods/delete?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">彻底删除</a>
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
    <input type="submit" class="submit" value="上架" id="submit"/>
    <input type="submit" class="submit" value="下架" id="off_submit"/>
    <div style="clear:both"></div>
</div>



</div>
</div>

</body>
</html><?php }} ?>
