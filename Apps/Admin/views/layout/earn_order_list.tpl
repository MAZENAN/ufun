{@extends file='@model_list.tpl'@}
<!--标题-->
{@block name=title@}赏金任务订单{@/block@}
{@block name=head@}
<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.topdialog.js"></script>
{@/block@}
<!--头部标签区-->
{@block name=toptags@}
<div class="smbox-toptags">
    <a href="?order_id={@$sch.order_id@}"{@if !isset($smarty.get.status) || $smarty.get.status===''@}class="active"{@/if@}>全部订单</a>
    {@foreach from=['0'=>'未付款','1'=>'已付款<span class="org">(待接单)</span>','2'=>'已接单<span class="org">(配送中)</span>','3'=>'已送达(未确认)','4'=>'退款中','5'=>'已退款','6'=>'待评价','7'=>'已完成','-1'=>'已取消'] item=xs key=ik@}
    <a href="?orderid={@$sch.order_id@}&type={@$sch.status@}&status={@$ik@}" {@if isset($smarty.get.status) && $smarty.get.status!='' && $sch.status==$ik@}class="active"{@/if@}>{@$xs@}</a>
    {@/foreach@}
</div>
{@/block@}
<!--表格顶部区域-->
{@block name=table_topbar@}
<div class="smbox-list-toptab">
    <form method="get" id="target-form">
        <a class="samao-link-btn samao-link-btn-refresh" href="javascript:window.location.reload()">刷新</a>
        {@form_text  style="width:120px" name="order_id" value="{@$sch['order_id']@}" placeholder= '请输入订单号' model=$schmodel@}
        {@form_select header="订单类型"  onchange='this.form.submit();' style="width:120px" name="order_type" model=$schmodel@}
        <input type="submit" value="查找" class="samao-mini-btn samao-mini-btn-search"/>&nbsp;
    </form>
</div>
{@/block@}

<!--表头列-->
{@block name=table_ths@}
<th width="10%">序号</th>
<th width="10%">订单编号</th>
<th width="10%">订单类型</th>
<th width="10%">下单用户</th>
<th width="10%">创建时间</th>
<th width="10%">订单状态</th>
<th width="18%">操作</th>
{@/block@}

<!--总列数合并单元格时可用-->
{@block name=colspan@}4{@/block@}

<!--表行列-->
{@block name=table_tds@}
<td align="center">
    <span class="blu">{@$ttl+1@}</span>
</td>
<td align="center">{@$rs.order_id@}</td>
<td align="center"><span class="org">{@$rs.order_type|case:[1,2,3]:['跑腿类','代购类','技能求助']@}</span></td>
<td align="center">{@$rs.user_id|smval:'@pf_member':'nickname'@}</span></td>
<td align="center">{@$rs.add_time@}</td>
<td align="center">{@$rs.status|case:['-1','0','1','2','3','4','5','6','7']:['已取消','待支付','<span style="color:#09bc7b">已支付</span>(待接单)','已接单(配送中)','已送达(未确认)','退款中','完成退款','待评价','已完成']@}</td>
<td align="center">
    <a dialog="1" class="samao-link-minibtn" href="__SELF__/detail?id={@$rs.id@}">查看订单</a>
</td>
{@/block@}
<!--分页控件区-->
<!--分页控件区-->		
{@block name=pagebar@}
	<div class="samao-pagebar">{@pagebar pdata=$bar@}</div>
{@/block@}
