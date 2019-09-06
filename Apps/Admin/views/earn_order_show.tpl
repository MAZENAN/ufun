<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>查看订单-{@$order.order_id@}</title>
<link rel="stylesheet" type="text/css" href="__RES__/css/form.default.css"/>
<link href="__RES__/css/list.default.css" rel="stylesheet" type="text/css" />
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
<script type="text/javascript" src="__RES__/js/jquery.js"></script>
<script type="text/javascript" src="__RES__/js/samao.topdialog.js"></script>
</head>
<body>
<div class="samao-form">
    <h3>订单基本信息</h3>
<table class="infotable" width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
    <th width="15%">订单号</th>
    <td ><b class="storage">{@$order.order_id@}</b></td>
    <th width="15%">状态</th>
        <td> {@if $order.refund==1 && $order.state<4@}申请退款中{@else@}
            {@$order.status|case:['-1','0','1','2','4','5','6','7']:['已取消','待支付','已支付(待接单)','已接单(配送中)','退款中','完成退款','待评价','已完成']@}
            {@/if@}
        </td>
    </tr>
  <tr>
    <th>下单人</th>
      <td>{@$order.user_id|smval:'@pf_member':'nickname'@}(实名:{@$order.user_id|smval:'@pf_member':'real_name'|default:'--'@})</td>
    <th>联系电话：</th>
    <td>{@$order.user_id|smval:'@pf_member':'mobile'|default:'--'@}
    </td>
  </tr>

    <tr>
        <th>订单金额</th>
        <td><span class="org">{@$order.need_pay@}</span>￥</td>
        <th>订单类型：</th>
        <td><span class="org">{@$order.order_type|case:[1,2,3]:['跑腿类','代购类','技能求助类']@}</span></td>
    </tr>

  <tr>

     <th>订单创建时间</th>
    <td colspan="3">{@$order.add_time|date_format:'%Y-%m-%d %H:%M:%S'@}
    </td>
  </tr>
  <tr>
  <tr>
    <th>下单备注</th>
    <td colspan="3">
    <div>{@$order.remark|htmlcode:1@}</div>
    </td>
  </tr>
  </table>

    <h3>发布人支付信息</h3>
    <div class="pay3-list">
        <table id="stulist" class="infotable"   width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <th width="15%">支付状态</th>
                <td ><b class="storage">{@$order.is_pay|case:[0,1]:['未支付','已支付']@}</b></td>
            </tr>
            <tr>
            <th width="15%">{@if $order.status>0@}已支付金额{@else@}待支付金额{@/if@}</th>
            <td ><b class="storage">{@if $order.status<=0@}{@$order.need_pay@}{@else@}{@$order.paid@}{@/if@}￥</b></td>
            </tr>
            {@if $order.status>0@}
            <tr>
                <th width="15%">支付时间</th>
                <td ><b class="storage">{@$order.pay_time@}</b></td>
            </tr>
            <tr>
                <th width="15%">支付方式</th>
                <td ><b class="storage">{@$order.pay_type|case:[0,1]:['余额支付','微信支付']@}</b></td>
            </tr>
            {@/if@}
        </table>
    </div>

    <h3>任务内容信息</h3>
    <div class="pay3-list">
        <table id="stulist" class="infotable"   width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <th width="15%">任务标签</th>
                <td >{@$order.tag@}</td>
            </tr>
            <tr>
                <th width="15%">任务内容</th>
                <td >{@$order.content@}</td>
            </tr>
            <tr>
                <th width="15%">任务附件</th>
                <td >{@$order.attachment@}</td>
            </tr>
            <tr>
                <th width="15%">开始地址</th>
                <td >{@$order.start_address@}</td>
            </tr>
            <tr>
                <th width="15%">结束地址</th>
                <td >{@$order.end_address@}</td>
            </tr>
            <tr>
                <th width="15%">送达时间</th>
                <td >{@$order.arrive_time@}</td>
            </tr>
        </table>
    </div>
    {@if $order.deliveryer_id>0@}
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
                <td align="center" valign="middle">{@$order.deliveryer_id|smval:'@pf_member':'real_name'@}</td>
                <td align="center" valign="middle" >{@$order.deliveryer_id|smval:'@pf_member':'mobile'@}</td>
                <td align="center" valign="middle" >{@$order.deliveryer_id|smval:'@pf_member':'school_id'|smval:'@pf_school':'title'@}</td>
                <td align="center" valign="middle" >{@$order.deliveryer_id|smval:'@pf_member':'admission_time'@}</td>
                <td align="center" valign="middle" ><img src="{@$order.deliveryer_id|smval:'@pf_member':'stu_card'|minimg:100:100:1@}"></td>
            </tr>
        </table>
    </div>
{@/if@}
   {@if $order.refund >0@}
   <h3>申请退款信息</h3>
   <div class="pay3-list">
   <table class="infotable" width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
    <th width="15%">退款联系人</th>
    <td ><b class="storage">{@$order.user_id|smval:'@pf_member':'nickname'|default:'--'@}</b></td>
    <th width="15%">联系电话：</th>
    <td ><b class="order">{@$order.contact_phone@}</b></td>
    </tr>
   <tr>
    <th>退款原因</th>
    <td colspan="3">{@$order.refund_reasons|htmlcode:1@}</td>
  </tr>
  
  {@if $order.refund >1@}
   <tr>
    <th>管理员退款金额</th>
    <td colspan="3">{@$order.refund_fees|money@} 元</td>
  </tr>
   <tr>
    <th>管理员备注</th>
    <td colspan="3">{@$order.refund_remarks|htmlcode:1@}</td>
  </tr>
 {@/if@}

  </table>
   </div>
   {@/if@}

</div>
</body>
</html>
