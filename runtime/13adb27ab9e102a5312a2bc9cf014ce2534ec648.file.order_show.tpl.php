<?php /* Smarty version Smarty-3.1.19, created on 2019-07-18 08:46:19
         compiled from ".\Apps\Admin\views\order_show.tpl" */ ?>
<?php /*%%SmartyHeaderCode:287205d2fc15bd7fbf2-32479942%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '13adb27ab9e102a5312a2bc9cf014ce2534ec648' => 
    array (
      0 => '.\\Apps\\Admin\\views\\order_show.tpl',
      1 => 1561945019,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '287205d2fc15bd7fbf2-32479942',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'order' => 0,
    'goods' => 0,
    'xrs' => 0,
    'chids' => 0,
    'order_logs' => 0,
    'corr_fees' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5d2fc15beb9f85_54049019',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d2fc15beb9f85_54049019')) {function content_5d2fc15beb9f85_54049019($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\libs\\plugins\\modifier.date_format.php';
if (!is_callable('smarty_modifier_reckon')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\modifier.reckon.php';
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
            <?php echo ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['order']->value['status'],array('-1','0','1','2','3','4','5','6','7'))) && array_key_exists($_tempkey,$_temparr=array('已取消','待支付','已支付(待接单)','已接单(制作中)','配送中','退款中','完成退款','待评价','已完成'))?$_temparr[$_tempkey]:'');?>

            <?php }?>
        </td>
    </tr>
  <tr>
    <th>下单人</th>
      <td><?php echo DB::getval('@pf_member','nickname',$_smarty_tpl->tpl_vars['order']->value['user_id']);?>
</td>
    <th>联系电话：</th>
    <td>

    </td>
  </tr>

    <tr>
        <th>订单金额</th>
        <td><span class="org"><?php echo $_smarty_tpl->tpl_vars['order']->value['goods_amount'];?>
</span>￥</td>
        <th>配送方式与费用：</th>
        <td><?php if ('delivery_type'==0) {?>(配送到寝)<span class="org"><?php echo $_smarty_tpl->tpl_vars['order']->value['delivery_price'];?>
</span>￥<?php } else { ?>校内自提--<?php }?></td>
    </tr>
   <tr>
    <th>所属商家</th>
    <td colspan="1"><?php echo DB::getval('@pf_merchant','name',$_smarty_tpl->tpl_vars['order']->value['merchant_id']);?>
</td>
       <th>商家电话</th>
       <td colspan="1">(<?php echo DB::getval('@pf_merchant','contact_name',$_smarty_tpl->tpl_vars['order']->value['merchant_id']);?>
)<?php echo DB::getval('@pf_merchant','phone',$_smarty_tpl->tpl_vars['order']->value['merchant_id']);?>
</td>
  </tr>

  <tr>
     <th>下单时间</th>
    <td colspan="3"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['order']->value['add_time'],'%Y-%m-%d %H:%M:%S');?>

    </td>
  </tr>
  <tr>
   <tr>
    <th>财务确认时间</th>
    <td colspan="3"><?php echo $_smarty_tpl->tpl_vars['order']->value['crm_time'];?>
</td>
  </tr>
  <tr>
    <th>下单备注</th>
    <td colspan="3">
    <div><?php echo str_replace(" ","&nbsp;",str_replace(array("\r\n","\n","\r"),'<br>',htmlspecialchars($_smarty_tpl->tpl_vars['order']->value['remark'])));?>
</div>
    </td>
  </tr>
  </table>

    <h3>买家支付信息</h3>
    <div class="pay3-list">
        <table id="stulist" class="infotable"   width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
            <th width="15%"><?php if ($_smarty_tpl->tpl_vars['order']->value['status']>0) {?>已支付金额<?php } else { ?>待支付金额<?php }?></th>
            <td ><b class="storage"><?php if ($_smarty_tpl->tpl_vars['order']->value['status']<=0) {?><?php echo $_smarty_tpl->tpl_vars['order']->value['goods_amount'];?>
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










    <h3>订购商品信息</h3>
    <div class="pay3-list">
        <table id="stulist" class="infotable"   width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <th width="8%" align="left" valign="middle" bgcolor="#ebf4e3">商品名</th>
                <th width="7%" align="center" valign="middle" bgcolor="#ebf4e3">商品选项</th>
                <th width="5%" align="center" valign="middle" bgcolor="#ebf4e3">商品总数</th>
                <th width="10%" align="center" valign="middle" bgcolor="#ebf4e3">商品单价</th>
                <th width="5%" align="center" valign="middle" bgcolor="#ebf4e3">商品总价</th>
            </tr>
            <?php  $_smarty_tpl->tpl_vars['xrs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['xrs']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['goods']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['xrs']->key => $_smarty_tpl->tpl_vars['xrs']->value) {
$_smarty_tpl->tpl_vars['xrs']->_loop = true;
?>
            <tr>
                <td align="left" valign="middle"><?php echo $_smarty_tpl->tpl_vars['xrs']->value['title'];?>
</td>
                <td align="center" valign="middle" ><?php echo $_smarty_tpl->tpl_vars['xrs']->value['spec_name'];?>
</td>
                <td align="center" valign="middle" >x<b><?php echo $_smarty_tpl->tpl_vars['xrs']->value['total'];?>
</b></td>
                <td align="center" valign="middle" ><?php echo $_smarty_tpl->tpl_vars['xrs']->value['market_price'];?>
￥</td>
                <td align="center" valign="middle" ><?php echo $_smarty_tpl->tpl_vars['xrs']->value['total']*$_smarty_tpl->tpl_vars['xrs']->value['market_price'];?>
￥</td>
            </tr>
            <?php } ?>
        </table>
    </div>
    <h3>配送信息</h3>
    <div class="pay3-list">
        <table id="stulist" class="infotable"   width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <th width="5%" align="left" valign="middle" bgcolor="#ebf4e3">收货人</th>
                <th width="5%" align="center" valign="middle" bgcolor="#ebf4e3">联系电话</th>
                <th width="5%" align="center" valign="middle" bgcolor="#ebf4e3">配送方式</th>
                <th width="8%" align="center" valign="middle" bgcolor="#ebf4e3">配送学校</th>
                <th width="8%" align="center" valign="middle" bgcolor="#ebf4e3">详细地址</th>
                <th width="5%" align="center" valign="middle" bgcolor="#ebf4e3">送达时间</th>
            </tr>
            <tr>
                <td align="center" valign="middle"><?php echo $_smarty_tpl->tpl_vars['order']->value['buyer_info'];?>
</td>
                <td align="center" valign="middle" ><?php echo $_smarty_tpl->tpl_vars['order']->value['buyer_phone'];?>
</td>
                <td align="center" valign="middle" ><?php echo ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['order']->value['delivery_type'],array(0,1))) && array_key_exists($_tempkey,$_temparr=array('配送到寝','校内自提'))?$_temparr[$_tempkey]:'');?>
</td>
                <td align="center" valign="middle" ><?php echo DB::getval('@pf_school','title',$_smarty_tpl->tpl_vars['order']->value['school_id']);?>
</td>
                <td align="center" valign="middle" ><?php echo $_smarty_tpl->tpl_vars['order']->value['address'];?>
</td>
                <td align="center" valign="middle" ><?php echo $_smarty_tpl->tpl_vars['order']->value['arrive_date'];?>
(<?php echo ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['order']->value['arrive_time'],array(0,1,2))) && array_key_exists($_tempkey,$_temparr=array('上午','中午','下午'))?$_temparr[$_tempkey]:'');?>
)</td>
            </tr>
        </table>
    </div>






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
   
  <?php if (count($_smarty_tpl->tpl_vars['chids']->value)>0) {?>
 <h3>参与人员</h3>
  <div class="pay3-list">
    <table id="stulist" class="infotable"   width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th width="8%" align="left" valign="middle" bgcolor="#ebf4e3">&nbsp;&nbsp;姓名</th>
        <th width="7%" align="center" valign="middle" bgcolor="#ebf4e3">身份</th>
        <th width="5%" align="center" valign="middle" bgcolor="#ebf4e3">性别</th>
        <th width="10%" align="center" valign="middle" bgcolor="#ebf4e3">出生日期</th>
        <th width="5%" align="center" valign="middle" bgcolor="#ebf4e3">年龄</th>
        <th width="12%" align="left" valign="middle" bgcolor="#ebf4e3">学校(家长证件)</th>
        <th width="5%" align="left" valign="middle" bgcolor="#ebf4e3">年级</th>
        <th align="left" valign="middle" bgcolor="#ebf4e3">居住地址</th>
        <th width="8%" align="left" valign="middle" bgcolor="#ebf4e3">联系电话</th>
        <th width="10%" align="left" valign="middle" bgcolor="#ebf4e3">邮箱</th>
      </tr>
      <?php  $_smarty_tpl->tpl_vars['xrs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['xrs']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['chids']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['xrs']->key => $_smarty_tpl->tpl_vars['xrs']->value) {
$_smarty_tpl->tpl_vars['xrs']->_loop = true;
?>
      <tr>
        <td align="left" valign="middle">&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['xrs']->value['name'];?>
</td>
        <td align="center" valign="middle" ><?php echo (is_array(1)&&is_array('家长') ? ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['xrs']->value['family'],1)) && array_key_exists($_tempkey,$_temparr='家长')?$_temparr[$_tempkey]:'学生') : ($_smarty_tpl->tpl_vars['xrs']->value['family']==1?'家长':'学生'));?>
</td>
        <td align="center" valign="middle" ><?php echo $_smarty_tpl->tpl_vars['xrs']->value['gender'];?>
</td>
        <td align="center" valign="middle"><?php echo $_smarty_tpl->tpl_vars['xrs']->value['birthday'];?>
</td>
        <td  align="center" valign="middle"><?php if ($_smarty_tpl->tpl_vars['xrs']->value['birthday']) {?><?php echo smarty_modifier_reckon($_smarty_tpl->tpl_vars['xrs']->value['birthday']);?>
<?php }?></td>
        <?php if ($_smarty_tpl->tpl_vars['xrs']->value['family']==1) {?>
        <td align="center" colspan="2" valign="middle"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['xrs']->value['idcard'])===null||$tmp==='' ? '-' : $tmp);?>
</td>
        <?php } else { ?>
        <td align="center" valign="middle"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['xrs']->value['school'])===null||$tmp==='' ? '-' : $tmp);?>
</td>
        <td align="center" valign="middle"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['xrs']->value['grade'])===null||$tmp==='' ? '-' : $tmp);?>
</td>
        <?php }?>
        <td align="center" valign="middle"><?php echo Comm::areaNames($_smarty_tpl->tpl_vars['order']->value['ct1_area']);?>
  <?php echo $_smarty_tpl->tpl_vars['order']->value['ct1_address'];?>
</td>

        <td align="left" valign="middle"><?php echo $_smarty_tpl->tpl_vars['xrs']->value['telephone'];?>
</td>
        <td  align="left" valign="middle"><?php echo $_smarty_tpl->tpl_vars['xrs']->value['email'];?>
</td>
      </tr>
      <?php } ?>
    </table>
  </div>
  <?php if (!empty($_smarty_tpl->tpl_vars['order']->value['ct1_name'])||!empty($_smarty_tpl->tpl_vars['order']->value['ct1_phone'])) {?>
  <h3>紧急联系人</h3>
  <div class="pay1-box">
    <table  class="infotable"  width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th align="right" valign="top"></th>
        <th align="left" valign="top">联系人1</th>
        <!-- <?php if (!empty($_smarty_tpl->tpl_vars['order']->value['ct2_name'])) {?>
        <th align="left" valign="top">联系人2</th>
        <?php }?> -->
      </tr>

      <tr>
        <th align="right" valign="top">
          <span class="tit">紧急联系人：</span>
        </th>
        <td align="left" valign="top"><?php echo $_smarty_tpl->tpl_vars['order']->value['ct1_relat'];?>
</td>
       <!--  <?php if (!empty($_smarty_tpl->tpl_vars['order']->value['ct2_name'])) {?>
       <td align="left" valign="top"><?php echo $_smarty_tpl->tpl_vars['order']->value['ct2_relat'];?>
</td>
       <?php }?> -->
      </tr>

      <tr>
        <th width="100" align="right" valign="top">
          <span class="tit">姓　　名：</span>
        </th>
        <td align="left" valign="top"><?php echo $_smarty_tpl->tpl_vars['order']->value['ct1_name'];?>
</td>
        <!-- <?php if (!empty($_smarty_tpl->tpl_vars['order']->value['ct2_name'])) {?>
        <td align="left" valign="top"><?php echo $_smarty_tpl->tpl_vars['order']->value['ct2_name'];?>
</td>
        <?php }?> -->
      </tr>

      <tr>
        <th align="right" valign="top">
          <span class="tit">联系电话：</span>
        </th>
        <td align="left" valign="top"><?php echo $_smarty_tpl->tpl_vars['order']->value['ct1_phone'];?>
</td>
       <!--  <?php if (!empty($_smarty_tpl->tpl_vars['order']->value['ct2_name'])) {?>
       <td align="left" valign="top"><?php echo $_smarty_tpl->tpl_vars['order']->value['ct2_phone'];?>
</td>
       <?php }?> -->
      </tr>

      <tr>
        <th align="right" valign="top">
          <span class="tit">Email：</span>
        </th>
        <td align="left" valign="top"><?php echo $_smarty_tpl->tpl_vars['order']->value['ct1_email'];?>
</td>
        <!-- <?php if (!empty($_smarty_tpl->tpl_vars['order']->value['ct2_name'])) {?>
        <td align="left" valign="top"><?php echo $_smarty_tpl->tpl_vars['order']->value['ct2_email'];?>
</td>
        <?php }?> -->
      </tr>

      <tr>
        <th align="right" valign="top">
          <span class="tit">居住地址：</span>
        </th>
        <td align="left" valign="top"><?php echo Comm::areaNames($_smarty_tpl->tpl_vars['order']->value['ct1_area']);?>
  <?php echo $_smarty_tpl->tpl_vars['order']->value['ct1_address'];?>
</td>
        <!-- <?php if (!empty($_smarty_tpl->tpl_vars['order']->value['ct2_name'])) {?>
        <td align="left" valign="top"><?php echo Comm::areaNames($_smarty_tpl->tpl_vars['order']->value['ct2_area']);?>
  <?php echo $_smarty_tpl->tpl_vars['order']->value['ct2_address'];?>
</td>
        <?php }?> -->
      </tr>

    </table>

  </div>

  <h3>备注信息</h3>
  <div style="padding:10px 10px;"><?php echo str_replace(" ","&nbsp;",str_replace(array("\r\n","\n","\r"),'<br>',htmlspecialchars($_smarty_tpl->tpl_vars['order']->value['remarks'])));?>
</div>
  <?php }?>
<?php }?>
<?php if (count($_smarty_tpl->tpl_vars['order_logs']->value)>0) {?>
 <h3>审核日志</h3>
  <div class="pay3-list">
    <table id="stulist" class="infotable"   width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th width="25%" align="center" valign="middle" bgcolor="#ebf4e3">时间</th>
        <th width="25%" align="center" valign="middle" bgcolor="#ebf4e3">审核人</th>
        <th width="25%" align="center" valign="middle" bgcolor="#ebf4e3">环节</th>
        <th width="25%" align="center" valign="middle" bgcolor="#ebf4e3">审核结果</th>
      </tr>
      <?php  $_smarty_tpl->tpl_vars['xrs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['xrs']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['order_logs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['xrs']->key => $_smarty_tpl->tpl_vars['xrs']->value) {
$_smarty_tpl->tpl_vars['xrs']->_loop = true;
?>
      <tr>
        <td align="center" valign="middle">&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['xrs']->value['add_time'];?>
</td>
        <td align="center" valign="middle" ><?php echo DB::getval('@pf_manage','name',$_smarty_tpl->tpl_vars['xrs']->value['manage_id']);?>
</td>
        <td align="center" valign="middle" ><?php echo ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['xrs']->value['type'],array('1','2','3','4','6','7','8','9','10','11','12','13'))) && array_key_exists($_tempkey,$_temparr=array('财务审核已付款','销售审核退款','高级销售审核退款','财务审核退款','高级销售审核退补差价','财务审核退补差价','BD审核退款','BD修改供应商结算价格','高级销售修改供应商结算价格','BD审核供应商结算','高级销售审核供应商结算','财务审核供应商结算'))?$_temparr[$_tempkey]:'');?>
</td>
        <td align="center" valign="middle"><?php echo $_smarty_tpl->tpl_vars['xrs']->value['log'];?>
</td>
      </tr>
      <?php } ?>
    </table>
  </div>
<?php }?>
<?php if (count($_smarty_tpl->tpl_vars['corr_fees']->value)>0) {?>
 <h3>业绩修正值</h3>
  <div class="pay3-list">
    <table id="stulist" class="infotable"   width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th width="20%" align="center" valign="middle" bgcolor="#ebf4e3">添加时间</th>
        <th width="20%" align="center" valign="middle" bgcolor="#ebf4e3">类型</th>
        <th width="20%" align="center" valign="middle" bgcolor="#ebf4e3">金额</th>
        <th width="20%" align="center" valign="middle" bgcolor="#ebf4e3">状态</th>
        <th width="20%" align="center" valign="middle" bgcolor="#ebf4e3">审核时间</th>
      </tr>
      <?php  $_smarty_tpl->tpl_vars['xrs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['xrs']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['corr_fees']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['xrs']->key => $_smarty_tpl->tpl_vars['xrs']->value) {
$_smarty_tpl->tpl_vars['xrs']->_loop = true;
?>
      <tr>
        <td align="center" valign="middle">&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['xrs']->value['add_time'];?>
</td>
        <td align="center" valign="middle" ><?php echo (is_array(1)&&is_array('加') ? ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['xrs']->value['type'],1)) && array_key_exists($_tempkey,$_temparr='加')?$_temparr[$_tempkey]:'减') : ($_smarty_tpl->tpl_vars['xrs']->value['type']==1?'加':'减'));?>
</td>
        <td align="center" valign="middle" ><?php echo $_smarty_tpl->tpl_vars['xrs']->value['fees'];?>
</td>
        <td align="center" valign="middle">
          <?php if ($_smarty_tpl->tpl_vars['xrs']->value['state']==1) {?>审核成功
          <?php } elseif ($_smarty_tpl->tpl_vars['xrs']->value['state']==2) {?>审核失败
          <?php } elseif ($_smarty_tpl->tpl_vars['order']->value['crm_state']==7) {?>等待高级销售审核
          <?php } elseif ($_smarty_tpl->tpl_vars['order']->value['crm_state']==9) {?>等待财务审核
          <?php } else { ?>审核失败
          <?php }?>
        </td>
        <td align="center" valign="middle" ><?php echo $_smarty_tpl->tpl_vars['xrs']->value['check_time'];?>
</td>
      </tr>
      <?php } ?>
    </table>
  </div>
<?php }?>

</div>
</body>
</html>
<?php }} ?>
