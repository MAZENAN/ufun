<?php /* Smarty version Smarty-3.1.19, created on 2019-07-04 21:34:29
         compiled from ".\Apps\Admin\views\earn_order_show.tpl" */ ?>
<?php /*%%SmartyHeaderCode:55955d1e00659cbc31-25501659%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6fcc9edecb0b3dd422ac0762b4c4469bdfdaf02e' => 
    array (
      0 => '.\\Apps\\Admin\\views\\earn_order_show.tpl',
      1 => 1560957671,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '55955d1e00659cbc31-25501659',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'order' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5d1e0065a94bf4_84268671',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d1e0065a94bf4_84268671')) {function content_5d1e0065a94bf4_84268671($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\libs\\plugins\\modifier.date_format.php';
if (!is_callable('smarty_modifier_minimg')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\modifier.minimg.php';
?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>查看订单-<?php echo $_smarty_tpl->tpl_vars['order']->value['order_id'];?>
</title>
<link rel="stylesheet" type="text/css" href="/public/samaores/css/form.default.css"/>
<link href="/public/samaores/css/list.default.css" rel="stylesheet" type="text/css" />
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
.infotable th{ background-color:#F2F1F0;}

.infotable td .storage{font-size:14px; color:  #09F;}
.infotable td .order{font-size:14px; color:#9B410E;}
</style>
<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.topdialog.js"></script>
</head>
<body>
<div class="samao-form">
    <h3>订单基本信息</h3>
<table class="infotable" width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
    <th width="15%">订单号</th>
    <td ><b class="storage"><?php echo $_smarty_tpl->tpl_vars['order']->value['order_id'];?>
</b></td>
    <th width="15%">状态</th>
        <td> <?php if ($_smarty_tpl->tpl_vars['order']->value['refund']==1&&$_smarty_tpl->tpl_vars['order']->value['state']<4) {?>申请退款中<?php } else { ?>
            <?php echo ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['order']->value['status'],array('-1','0','1','2','4','5','6','7'))) && array_key_exists($_tempkey,$_temparr=array('已取消','待支付','已支付(待接单)','已接单(配送中)','退款中','完成退款','待评价','已完成'))?$_temparr[$_tempkey]:'');?>

            <?php }?>
        </td>
    </tr>
  <tr>
    <th>下单人</th>
      <td><?php echo DB::getval('@pf_member','nickname',$_smarty_tpl->tpl_vars['order']->value['user_id']);?>
(实名:<?php echo (($tmp = @DB::getval('@pf_member','real_name',$_smarty_tpl->tpl_vars['order']->value['user_id']))===null||$tmp==='' ? '--' : $tmp);?>
)</td>
    <th>联系电话：</th>
    <td><?php echo (($tmp = @DB::getval('@pf_member','mobile',$_smarty_tpl->tpl_vars['order']->value['user_id']))===null||$tmp==='' ? '--' : $tmp);?>

    </td>
  </tr>

    <tr>
        <th>订单金额</th>
        <td><span class="org"><?php echo $_smarty_tpl->tpl_vars['order']->value['need_pay'];?>
</span>￥</td>
        <th>订单类型：</th>
        <td><span class="org"><?php echo ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['order']->value['order_type'],array(1,2,3))) && array_key_exists($_tempkey,$_temparr=array('跑腿类','代购类','技能求助类'))?$_temparr[$_tempkey]:'');?>
</span></td>
    </tr>

  <tr>

     <th>订单创建时间</th>
    <td colspan="3"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['order']->value['add_time'],'%Y-%m-%d %H:%M:%S');?>

    </td>
  </tr>
  <tr>
  <tr>
    <th>下单备注</th>
    <td colspan="3">
    <div><?php echo str_replace(" ","&nbsp;",str_replace(array("\r\n","\n","\r"),'<br>',htmlspecialchars($_smarty_tpl->tpl_vars['order']->value['remark'])));?>
</div>
    </td>
  </tr>
  </table>

    <h3>发布人支付信息</h3>
    <div class="pay3-list">
        <table id="stulist" class="infotable"   width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <th width="15%">支付状态</th>
                <td ><b class="storage"><?php echo ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['order']->value['is_pay'],array(0,1))) && array_key_exists($_tempkey,$_temparr=array('未支付','已支付'))?$_temparr[$_tempkey]:'');?>
</b></td>
            </tr>
            <tr>
            <th width="15%"><?php if ($_smarty_tpl->tpl_vars['order']->value['status']>0) {?>已支付金额<?php } else { ?>待支付金额<?php }?></th>
            <td ><b class="storage"><?php if ($_smarty_tpl->tpl_vars['order']->value['status']<=0) {?><?php echo $_smarty_tpl->tpl_vars['order']->value['need_pay'];?>
<?php } else { ?><?php echo $_smarty_tpl->tpl_vars['order']->value['paid'];?>
<?php }?>￥</b></td>
            </tr>
            <?php if ($_smarty_tpl->tpl_vars['order']->value['status']>0) {?>
            <tr>
                <th width="15%">支付时间</th>
                <td ><b class="storage"><?php echo $_smarty_tpl->tpl_vars['order']->value['pay_time'];?>
</b></td>
            </tr>
            <tr>
                <th width="15%">支付方式</th>
                <td ><b class="storage"><?php echo ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['order']->value['pay_type'],array(0,1))) && array_key_exists($_tempkey,$_temparr=array('余额支付','微信支付'))?$_temparr[$_tempkey]:'');?>
</b></td>
            </tr>
            <?php }?>
        </table>
    </div>

    <h3>任务内容信息</h3>
    <div class="pay3-list">
        <table id="stulist" class="infotable"   width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <th width="15%">任务标签</th>
                <td ><?php echo $_smarty_tpl->tpl_vars['order']->value['tag'];?>
</td>
            </tr>
            <tr>
                <th width="15%">任务内容</th>
                <td ><?php echo $_smarty_tpl->tpl_vars['order']->value['content'];?>
</td>
            </tr>
            <tr>
                <th width="15%">任务附件</th>
                <td ><?php echo $_smarty_tpl->tpl_vars['order']->value['attachment'];?>
</td>
            </tr>
            <tr>
                <th width="15%">开始地址</th>
                <td ><?php echo $_smarty_tpl->tpl_vars['order']->value['start_address'];?>
</td>
            </tr>
            <tr>
                <th width="15%">结束地址</th>
                <td ><?php echo $_smarty_tpl->tpl_vars['order']->value['end_address'];?>
</td>
            </tr>
            <tr>
                <th width="15%">送达时间</th>
                <td ><?php echo $_smarty_tpl->tpl_vars['order']->value['arrive_time'];?>
</td>
            </tr>
        </table>
    </div>
    <?php if ($_smarty_tpl->tpl_vars['order']->value['deliveryer_id']>0) {?>
    <h3>配送人信息</h3>
    <div class="pay3-list">
        <table id="stulist" class="infotable"   width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <th width="5%" align="left" valign="middle" bgcolor="#ebf4e3">姓名</th>
                <th width="5%" align="center" valign="middle" bgcolor="#ebf4e3">联系电话</th>
                <th width="5%" align="center" valign="middle" bgcolor="#ebf4e3">学校</th>
                <th width="8%" align="center" valign="middle" bgcolor="#ebf4e3">入学时间</th>
                <th width="8%" align="center" valign="middle" bgcolor="#ebf4e3">认证信息</th>
            </tr>
            <tr>
                <td align="center" valign="middle"><?php echo DB::getval('@pf_member','real_name',$_smarty_tpl->tpl_vars['order']->value['deliveryer_id']);?>
</td>
                <td align="center" valign="middle" ><?php echo DB::getval('@pf_member','mobile',$_smarty_tpl->tpl_vars['order']->value['deliveryer_id']);?>
</td>
                <td align="center" valign="middle" ><?php echo DB::getval('@pf_school','title',DB::getval('@pf_member','school_id',$_smarty_tpl->tpl_vars['order']->value['deliveryer_id']));?>
</td>
                <td align="center" valign="middle" ><?php echo DB::getval('@pf_member','admission_time',$_smarty_tpl->tpl_vars['order']->value['deliveryer_id']);?>
</td>
                <td align="center" valign="middle" ><img src="<?php echo smarty_modifier_minimg(DB::getval('@pf_member','stu_card',$_smarty_tpl->tpl_vars['order']->value['deliveryer_id']),100,100,1);?>
"></td>
            </tr>
        </table>
    </div>
<?php }?>
   <?php if ($_smarty_tpl->tpl_vars['order']->value['refund']>0) {?>
   <h3>申请退款信息</h3>
   <div class="pay3-list">
   <table class="infotable" width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
    <th width="15%">退款联系人</th>
    <td ><b class="storage"><?php echo (($tmp = @DB::getval('@pf_member','nickname',$_smarty_tpl->tpl_vars['order']->value['user_id']))===null||$tmp==='' ? '--' : $tmp);?>
</b></td>
    <th width="15%">联系电话：</th>
    <td ><b class="order"><?php echo $_smarty_tpl->tpl_vars['order']->value['contact_phone'];?>
</b></td>
    </tr>
   <tr>
    <th>退款原因</th>
    <td colspan="3"><?php echo str_replace(" ","&nbsp;",str_replace(array("\r\n","\n","\r"),'<br>',htmlspecialchars($_smarty_tpl->tpl_vars['order']->value['refund_reasons'])));?>
</td>
  </tr>
  
  <?php if ($_smarty_tpl->tpl_vars['order']->value['refund']>1) {?>
   <tr>
    <th>管理员退款金额</th>
    <td colspan="3"><?php echo ('￥'.sprintf("%01.2f", floatval($_smarty_tpl->tpl_vars['order']->value['refund_fees'])));?>
 元</td>
  </tr>
   <tr>
    <th>管理员备注</th>
    <td colspan="3"><?php echo str_replace(" ","&nbsp;",str_replace(array("\r\n","\n","\r"),'<br>',htmlspecialchars($_smarty_tpl->tpl_vars['order']->value['refund_remarks'])));?>
</td>
  </tr>
 <?php }?>

  </table>
   </div>
   <?php }?>

</div>
</body>
</html>
<?php }} ?>
