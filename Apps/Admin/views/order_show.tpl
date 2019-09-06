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
            {@$order.status|case:['-1','0','1','2','3','4','5','6','7']:['已取消','待支付','已支付(待接单)','已接单(制作中)','配送中','退款中','完成退款','待评价','已完成']@}
            {@/if@}
        </td>
    </tr>
  <tr>
    <th>下单人</th>
      <td>{@$order.user_id|smval:'@pf_member':'nickname'@}</td>
    <th>联系电话：</th>
    <td>

    </td>
  </tr>

    <tr>
        <th>订单金额</th>
        <td><span class="org">{@$order.goods_amount@}</span>￥</td>
        <th>配送方式与费用：</th>
        <td>{@if delivery_type==0@}(配送到寝)<span class="org">{@$order.delivery_price@}</span>￥{@else@}校内自提--{@/if@}</td>
    </tr>
   <tr>
    <th>所属商家</th>
    <td colspan="1">{@$order.merchant_id|smval:'@pf_merchant':'name'@}</td>
       <th>商家电话</th>
       <td colspan="1">({@$order.merchant_id|smval:'@pf_merchant':'contact_name'@}){@$order.merchant_id|smval:'@pf_merchant':'phone'@}</td>
  </tr>

  <tr>
     <th>下单时间</th>
    <td colspan="3">{@$order.add_time|date_format:'%Y-%m-%d %H:%M:%S'@}
    </td>
  </tr>
  <tr>
   <tr>
    <th>财务确认时间</th>
    <td colspan="3">{@$order.crm_time@}</td>
  </tr>
  <tr>
    <th>下单备注</th>
    <td colspan="3">
    <div>{@$order.remark|htmlcode:1@}</div>
    </td>
  </tr>
  </table>

    <h3>买家支付信息</h3>
    <div class="pay3-list">
        <table id="stulist" class="infotable"   width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
            <th width="15%">{@if $order.status>0@}已支付金额{@else@}待支付金额{@/if@}</th>
            <td ><b class="storage">{@if $order.status<=0@}{@$order.goods_amount@}{@else@}{@$order.paid@}{@/if@}￥</b></td>
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
            {@foreach from=$goods item=xrs@}
            <tr>
                <td align="left" valign="middle">{@$xrs.title@}</td>
                <td align="center" valign="middle" >{@$xrs.spec_name@}</td>
                <td align="center" valign="middle" >x<b>{@$xrs.total@}</b></td>
                <td align="center" valign="middle" >{@$xrs.market_price@}￥</td>
                <td align="center" valign="middle" >{@$xrs.total*$xrs.market_price@}￥</td>
            </tr>
            {@/foreach@}
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
                <td align="center" valign="middle">{@$order.buyer_info@}</td>
                <td align="center" valign="middle" >{@$order.buyer_phone@}</td>
                <td align="center" valign="middle" >{@$order.delivery_type|case:[0,1]:['配送到寝','校内自提']@}</td>
                <td align="center" valign="middle" >{@$order.school_id|smval:'@pf_school':'title'@}</td>
                <td align="center" valign="middle" >{@$order.address@}</td>
                <td align="center" valign="middle" >{@$order.arrive_date@}({@$order.arrive_time|case:[0,1,2]:['上午','中午','下午']@})</td>
            </tr>
        </table>
    </div>






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
   
  {@if count($chids)>0@}
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
      {@foreach from=$chids item=xrs@}
      <tr>
        <td align="left" valign="middle">&nbsp;&nbsp;{@$xrs.name@}</td>
        <td align="center" valign="middle" >{@$xrs.family|case:1:'家长':'学生'@}</td>
        <td align="center" valign="middle" >{@$xrs.gender@}</td>
        <td align="center" valign="middle">{@$xrs.birthday@}</td>
        <td  align="center" valign="middle">{@if $xrs.birthday@}{@$xrs.birthday|reckon@}{@/if@}</td>
        {@if $xrs.family==1@}
        <td align="center" colspan="2" valign="middle">{@$xrs.idcard|default:'-'@}</td>
        {@else@}
        <td align="center" valign="middle">{@$xrs.school|default:'-'@}</td>
        <td align="center" valign="middle">{@$xrs.grade|default:'-'@}</td>
        {@/if@}
        <td align="center" valign="middle">{@Comm::areaNames($order.ct1_area)@}  {@$order.ct1_address@}</td>

        <td align="left" valign="middle">{@$xrs.telephone@}</td>
        <td  align="left" valign="middle">{@$xrs.email@}</td>
      </tr>
      {@/foreach@}
    </table>
  </div>
  {@if !empty($order.ct1_name) || !empty($order.ct1_phone)@}
  <h3>紧急联系人</h3>
  <div class="pay1-box">
    <table  class="infotable"  width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th align="right" valign="top"></th>
        <th align="left" valign="top">联系人1</th>
        <!-- {@if !empty($order.ct2_name)@}
        <th align="left" valign="top">联系人2</th>
        {@/if@} -->
      </tr>

      <tr>
        <th align="right" valign="top">
          <span class="tit">紧急联系人：</span>
        </th>
        <td align="left" valign="top">{@$order.ct1_relat@}</td>
       <!--  {@if !empty($order.ct2_name)@}
       <td align="left" valign="top">{@$order.ct2_relat@}</td>
       {@/if@} -->
      </tr>

      <tr>
        <th width="100" align="right" valign="top">
          <span class="tit">姓　　名：</span>
        </th>
        <td align="left" valign="top">{@$order.ct1_name@}</td>
        <!-- {@if !empty($order.ct2_name)@}
        <td align="left" valign="top">{@$order.ct2_name@}</td>
        {@/if@} -->
      </tr>

      <tr>
        <th align="right" valign="top">
          <span class="tit">联系电话：</span>
        </th>
        <td align="left" valign="top">{@$order.ct1_phone@}</td>
       <!--  {@if !empty($order.ct2_name)@}
       <td align="left" valign="top">{@$order.ct2_phone@}</td>
       {@/if@} -->
      </tr>

      <tr>
        <th align="right" valign="top">
          <span class="tit">Email：</span>
        </th>
        <td align="left" valign="top">{@$order.ct1_email@}</td>
        <!-- {@if !empty($order.ct2_name)@}
        <td align="left" valign="top">{@$order.ct2_email@}</td>
        {@/if@} -->
      </tr>

      <tr>
        <th align="right" valign="top">
          <span class="tit">居住地址：</span>
        </th>
        <td align="left" valign="top">{@Comm::areaNames($order.ct1_area)@}  {@$order.ct1_address@}</td>
        <!-- {@if !empty($order.ct2_name)@}
        <td align="left" valign="top">{@Comm::areaNames($order.ct2_area)@}  {@$order.ct2_address@}</td>
        {@/if@} -->
      </tr>

    </table>

  </div>

  <h3>备注信息</h3>
  <div style="padding:10px 10px;">{@$order.remarks|htmlcode:1@}</div>
  {@/if@}
{@/if@}
{@if count($order_logs)>0@}
 <h3>审核日志</h3>
  <div class="pay3-list">
    <table id="stulist" class="infotable"   width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th width="25%" align="center" valign="middle" bgcolor="#ebf4e3">时间</th>
        <th width="25%" align="center" valign="middle" bgcolor="#ebf4e3">审核人</th>
        <th width="25%" align="center" valign="middle" bgcolor="#ebf4e3">环节</th>
        <th width="25%" align="center" valign="middle" bgcolor="#ebf4e3">审核结果</th>
      </tr>
      {@foreach from=$order_logs item=xrs@}
      <tr>
        <td align="center" valign="middle">&nbsp;&nbsp;{@$xrs.add_time@}</td>
        <td align="center" valign="middle" >{@$xrs.manage_id|smval:'@pf_manage':'name'@}</td>
        <td align="center" valign="middle" >{@$xrs.type|case:['1','2','3','4','6','7','8','9','10','11','12','13']:['财务审核已付款','销售审核退款','高级销售审核退款','财务审核退款','高级销售审核退补差价','财务审核退补差价','BD审核退款','BD修改供应商结算价格','高级销售修改供应商结算价格','BD审核供应商结算','高级销售审核供应商结算','财务审核供应商结算']@}</td>
        <td align="center" valign="middle">{@$xrs.log@}</td>
      </tr>
      {@/foreach@}
    </table>
  </div>
{@/if@}
{@if count($corr_fees)>0@}
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
      {@foreach from=$corr_fees item=xrs @}
      <tr>
        <td align="center" valign="middle">&nbsp;&nbsp;{@$xrs.add_time@}</td>
        <td align="center" valign="middle" >{@$xrs.type|case:1:'加':'减'@}</td>
        <td align="center" valign="middle" >{@$xrs.fees@}</td>
        <td align="center" valign="middle">
          {@if $xrs.state==1@}审核成功
          {@elseif $xrs.state==2@}审核失败
          {@elseif $order.crm_state==7@}等待高级销售审核
          {@elseif $order.crm_state==9@}等待财务审核
          {@else@}审核失败
          {@/if@}
        </td>
        <td align="center" valign="middle" >{@$xrs.check_time@}</td>
      </tr>
      {@/foreach@}
    </table>
  </div>
{@/if@}

</div>
</body>
</html>
