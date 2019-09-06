<?php /* Smarty version Smarty-3.1.19, created on 2019-05-22 10:22:07
         compiled from ".\Apps\Admin\views\layout\client_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:92185ce4b24fb415d8-97463391%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9eda9706cbaa67c65d2f25e6b3973e7dba3b6755' => 
    array (
      0 => '.\\Apps\\Admin\\views\\layout\\client_list.tpl',
      1 => 1491472336,
      2 => 'file',
    ),
    '4b0c8ba3e57f0c60af6144fd304396960b2ce574' => 
    array (
      0 => 'E:\\WWW\\waimai\\Web\\samao\\tpls\\model_list.tpl',
      1 => 1491473406,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '92185ce4b24fb415d8-97463391',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'rows' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5ce4b24fc78140_83328157',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ce4b24fc78140_83328157')) {function content_5ce4b24fc78140_83328157($_smarty_tpl) {?><?php if (!is_callable('smarty_function_pagebar')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\function.pagebar.php';
?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>会员管理</title>
<link href="/public/samaores/css/form.plane.css" rel="stylesheet" type="text/css" />
<link href="/public/samaores/css/list.plane.css" rel="stylesheet" type="text/css" />


<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.topdialog.js"></script>

<!--samao model script-->
</head>
<body>
<div class="tablebox listbox margintop">
<div class="smbox-list-title">会员管理 <span id="inputbox_loading" style="display:none">正在提交中...</span></div>
<div class="smbox-list-content">


<div class="smbox-list-toptab">
<a class="samao-link-btn samao-link-btn-refresh" href="javascript:window.location.reload()">刷新</a>&nbsp;&nbsp;&nbsp;&nbsp;
<form method="get">

手机号：<?php echo FormBox::text(array('style'=>"width:120px",'name'=>"mobile",'value'=>((string)$_smarty_tpl->tpl_vars['sch']->value['mobile']),),$_smarty_tpl->tpl_vars['schmodel']->value);?>&nbsp;&nbsp;&nbsp;&nbsp;

<?php echo FormBox::select(array('header'=>'所属销售','options'=>$_smarty_tpl->tpl_vars['parent']->value,'style'=>"width:100px;",'onchange'=>'this.form.submit();','value'=>((string)$_smarty_tpl->tpl_vars['sch']->value['parent_id']),'name'=>"parent_id",),$_smarty_tpl->tpl_vars['model']->value);?>&nbsp;&nbsp;
<?php echo FormBox::select(array('header'=>'最近跟进时间','options'=>array(array(1,'一周内'),array(2,'一个月内'),array(3,'90天未跟进'),array(4,'从未跟进过')),'style'=>"width:100px;",'onchange'=>'this.form.submit();','value'=>((string)$_smarty_tpl->tpl_vars['sch']->value['client_record']),'name'=>"client_record",),$_smarty_tpl->tpl_vars['model']->value);?>&nbsp;&nbsp;

<?php echo FormBox::select(array('header'=>'客户来源','options'=>DB::getopts('@pf_client_from',null,0),'style'=>"width:100px;",'onchange'=>'this.form.submit();','value'=>((string)$_smarty_tpl->tpl_vars['sch']->value['client_source']),'name'=>"client_source",),$_smarty_tpl->tpl_vars['model']->value);?>&nbsp;&nbsp;
<br/><div class="martop_10"></div>
<a class="samao-link-btn samao-link-btn-add" href="/admin/member/add?type=">新增</a>&nbsp;&nbsp;&nbsp;&nbsp;

年龄区间&nbsp;&nbsp;<?php ob_start();?><?php if ($_smarty_tpl->tpl_vars['sch']->value['agefrom']!='') {?><?php echo (string)$_smarty_tpl->tpl_vars['sch']->value['agefrom'];?><?php }?><?php $_tmp1=ob_get_clean();?><?php echo FormBox::amountdigits(array('placeholder'=>"开始年龄",'value'=>$_tmp1,'name'=>"agefrom",),$_smarty_tpl->tpl_vars['model']->value);?>&nbsp;
至&nbsp;<?php ob_start();?><?php if ($_smarty_tpl->tpl_vars['sch']->value['ageto']!='') {?><?php echo (string)$_smarty_tpl->tpl_vars['sch']->value['ageto'];?><?php }?><?php $_tmp2=ob_get_clean();?><?php echo FormBox::amountdigits(array('placeholder'=>"结束年龄",'value'=>$_tmp2,'name'=>"ageto",),$_smarty_tpl->tpl_vars['model']->value);?>&nbsp;&nbsp;
&nbsp;&nbsp;
<?php echo FormBox::select(array('header'=>'感兴趣的营期','options'=>DB::getopts('@pf_camp_holiday',null,0),'style'=>"width:100px;",'onchange'=>'this.form.submit();','value'=>((string)$_smarty_tpl->tpl_vars['sch']->value['interest_camp']),'name'=>"interest_camp",),$_smarty_tpl->tpl_vars['model']->value);?>&nbsp;&nbsp;
<?php echo FormBox::select(array('header'=>'学校类型','options'=>DB::getopts('@pf_school_type',null,0),'onchange'=>'this.form.submit();','value'=>((string)$_smarty_tpl->tpl_vars['sch']->value['school_type']),'name'=>"school_type",),$_smarty_tpl->tpl_vars['model']->value);?>&nbsp;&nbsp;

<?php echo FormBox::select(array('header'=>'子女性别','options'=>array(array(1,'男'),array(2,'女')),'onchange'=>'this.form.submit();','value'=>((string)$_smarty_tpl->tpl_vars['sch']->value['gender']),'name'=>"gender",),$_smarty_tpl->tpl_vars['model']->value);?>&nbsp;&nbsp;
<?php echo FormBox::select(array('header'=>'护照国籍','options'=>DB::getopts('@pf_nationality',null,0),'onchange'=>'this.form.submit();','value'=>((string)$_smarty_tpl->tpl_vars['sch']->value['nationality']),'name'=>"nationality",),$_smarty_tpl->tpl_vars['model']->value);?>&nbsp;&nbsp;
<?php echo FormBox::select(array('header'=>'购买情况','options'=>array(array(1,'已购买'),array(2,'未购买')),'onchange'=>'this.form.submit();','value'=>((string)$_smarty_tpl->tpl_vars['sch']->value['buy']),'name'=>"buy",),$_smarty_tpl->tpl_vars['model']->value);?>&nbsp;&nbsp;
<?php echo FormBox::select(array('header'=>'客户成熟度','options'=>DB::getopts('@pf_client_intention',null,0),'onchange'=>'this.form.submit();','value'=>((string)$_smarty_tpl->tpl_vars['sch']->value['level']),'name'=>"level",),$_smarty_tpl->tpl_vars['model']->value);?>&nbsp;&nbsp;
<?php echo FormBox::select(array('header'=>'所属城市','options'=>DB::getOpts('@pf_area','id,name',0,"pid=0"),'style'=>"width:80px;",'onchange'=>'this.form.submit();','value'=>((string)$_smarty_tpl->tpl_vars['sch']->value['area']),'name'=>"area",),$_smarty_tpl->tpl_vars['model']->value);?>

&nbsp;&nbsp;&nbsp;
<input type="submit" value="查找" class="samao-mini-btn samao-mini-btn-search"/>
<input type="hidden" name="type" value="<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
">
<input type="hidden" name="key" value="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
">
<input type="hidden" name="status" value="<?php echo $_smarty_tpl->tpl_vars['status']->value;?>
">
</form>
</div>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="smbox-list-table" id="smbox-list-table">
<tr>

<th width="80">姓名</th>
<th width="80">微信昵称</th>                   
<th width="80">手机号码</th>  
<th width="80">城市</th>
<th width="60">参营次数</th>
<th width="80">子女</th>
<th width="80">年龄</th>
<th width="60">性别</th>
<th width="100">学校</th>
<th width="60">所属销售</th>
<th width="240">操作</th>

</tr>
<?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_smarty_tpl->tpl_vars['ttl'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['rows']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
 $_smarty_tpl->tpl_vars['ttl']->value = $_smarty_tpl->tpl_vars['rs']->key;
?>
<tr  onmouseover="this.oldBgcolor=this.style.backgroundColor;this.style.backgroundColor='#FCFCF8';" onmouseout="this.style.backgroundColor=this.oldBgcolor">

<td align="center" ><?php echo $_smarty_tpl->tpl_vars['rs']->value['name'];?>
</td>
<td align="center" ><?php echo $_smarty_tpl->tpl_vars['rs']->value['wname'];?>
</td>
<td align="center" ><?php echo $_smarty_tpl->tpl_vars['rs']->value['mobile'];?>
</td>
<td align="center" ><?php  $_smarty_tpl->tpl_vars['rd'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rd']->_loop = false;
 $_from = json_decode($_smarty_tpl->tpl_vars['rs']->value['area']); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rd']->key => $_smarty_tpl->tpl_vars['rd']->value) {
$_smarty_tpl->tpl_vars['rd']->_loop = true;
?><?php echo DB::getval('@pf_area','name',$_smarty_tpl->tpl_vars['rd']->value);?>
 <?php } ?></td>
<td align="center" ><?php echo $_smarty_tpl->tpl_vars['rs']->value['num'];?>
</td>
<td align="center"><?php  $_smarty_tpl->tpl_vars['kid'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['kid']->_loop = false;
 $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['rs']->value['kids']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['kid']->key => $_smarty_tpl->tpl_vars['kid']->value) {
$_smarty_tpl->tpl_vars['kid']->_loop = true;
 $_smarty_tpl->tpl_vars['i']->value = $_smarty_tpl->tpl_vars['kid']->key;
?><?php if ($_smarty_tpl->tpl_vars['kid']->value['c_name']) {?><?php echo $_smarty_tpl->tpl_vars['kid']->value['c_name'];?>
<?php } else { ?>-<?php }?><br /><?php } ?></td>
<td align="center"><?php  $_smarty_tpl->tpl_vars['kid'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['kid']->_loop = false;
 $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['rs']->value['kids']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['kid']->key => $_smarty_tpl->tpl_vars['kid']->value) {
$_smarty_tpl->tpl_vars['kid']->_loop = true;
 $_smarty_tpl->tpl_vars['i']->value = $_smarty_tpl->tpl_vars['kid']->key;
?><?php if ($_smarty_tpl->tpl_vars['kid']->value['age']) {?><?php echo $_smarty_tpl->tpl_vars['kid']->value['age'];?>
<?php } else { ?>-<?php }?><br /><?php } ?></td>
<td align="center"><?php  $_smarty_tpl->tpl_vars['kid'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['kid']->_loop = false;
 $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['rs']->value['kids']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['kid']->key => $_smarty_tpl->tpl_vars['kid']->value) {
$_smarty_tpl->tpl_vars['kid']->_loop = true;
 $_smarty_tpl->tpl_vars['i']->value = $_smarty_tpl->tpl_vars['kid']->key;
?><?php echo ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['kid']->value['c_gender'],array(0,1))) && array_key_exists($_tempkey,$_temparr=array('女','男'))?$_temparr[$_tempkey]:'');?>
<br /><?php } ?></td>
<td align="center"><?php  $_smarty_tpl->tpl_vars['kid'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['kid']->_loop = false;
 $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['rs']->value['kids']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['kid']->key => $_smarty_tpl->tpl_vars['kid']->value) {
$_smarty_tpl->tpl_vars['kid']->_loop = true;
 $_smarty_tpl->tpl_vars['i']->value = $_smarty_tpl->tpl_vars['kid']->key;
?><?php if ($_smarty_tpl->tpl_vars['kid']->value['school']) {?><?php echo $_smarty_tpl->tpl_vars['kid']->value['school'];?>
<?php } else { ?>-<?php }?><br /><?php } ?></td>
<td align="center"><?php echo DB::getval('@pf_manage','name',$_smarty_tpl->tpl_vars['rs']->value['parent_id']);?>
</td>
<td align="center" >
<a dialog="1" class="samao-link-minibtn" href="/admin/client_record?client_id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
&type=<?php if ($_smarty_tpl->tpl_vars['rs']->value['type']==1) {?>1<?php } elseif ($_smarty_tpl->tpl_vars['rs']->value['type']==3||$_smarty_tpl->tpl_vars['rs']->value['type']==4) {?>3<?php }?>">跟进记录</a>
<a class="samao-link-minibtn" href="/admin/member/createOrder?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">下单</a>
<a class="samao-link-minibtn" href="/admin/member/client_show?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">查看详情</a>
<a class="samao-link-minibtn" href="/admin/member/edit?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">编辑</a>
<a onclick="return confirm('确定要删除该用户吗？一旦删除将无法恢复，请谨慎操作！');" class="samao-link-minibtn" href="/admin/client/delete?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">删除</a>
</td>

</tr>
<?php } ?>

</table>

<div class="samao-pagebar"><?php echo smarty_function_pagebar(array('pdata'=>$_smarty_tpl->tpl_vars['bar']->value),$_smarty_tpl);?>
</div>

</div>
<div class="smbox-info-tips">


</div>
</div>

</body>
</html><?php }} ?>
