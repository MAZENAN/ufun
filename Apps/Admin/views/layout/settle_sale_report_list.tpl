{@extends file='@model_list.tpl'@}
<!--标题-->
{@block name=title@}结算销售数据{@/block@}
<!--头部脚本区-->
{@block name=head@}
<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.topdialog.js"></script>
<script type="text/javascript" charset="utf-8" src="/public/samaores/js/jquery-ui.js"></script>
<script type="text/javascript" src="/public/samaores/js/jquery.ui.datepicker-zh-CN.js"></script>
<script type="text/javascript" src="/public/js/highcharts.js"></script>
<script type="text/javascript" src="/public/js/exporting.js"></script>
<script type="text/javascript" src="/public/js/highcharts-3d.js"></script>
<script type="text/javascript">
$(function() {$("#add_time_from").datepicker({dateFormat:'yy-mm-dd',changeMonth: true,changeYear:true,yearRange:'1900:2050'});});
$(function() {$("#add_time_to").datepicker({dateFormat:'yy-mm-dd',changeMonth: true,changeYear:true,yearRange:'1900:2050'});});</script>
<script language="javascript" type="text/javascript" src="/public/js/admin/TableSorterV2.js"></script>
<script language="javascript" type="text/javascript">
window.onload = function()
{
    new TableSorter("smbox-list-table");
}
    </script>
<style>.smbox-list-table{ width:1360px;} .smbox-list-table100{ width: 100%;} .form-list h3{ padding-left: 20px;}</style>
<link href="/public/samaores/css/jqueryui/custom.css" rel="stylesheet" type="text/css" />
<link href="/public/samaores/css/list.plane.css" rel="stylesheet" type="text/css" />
<link href="/public/samaores/css/form.plane.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">

	$(document).ready(function(){	       	
        $("#merchant_id").change(function(){
        	$("#merchant_id option").each(function(){
               if($(this).attr("selected")=="selected"){
               	$(".seller_cont input").val($(this).text());
               }
        	});
        });
        $("#title").keyup(function(){
        	
        	 if (event.keyCode == "13") {
       　　　　　$("#camp-form").submit();
                return false;
            }
        });
	    $(".samao-mini-btn-search").click(function(){
	    	$("#camp-form").submit();
	    });	
		$("#merchant_id").click(function(){
			$(".supplier .seller_cont").css("zIndex","999");
			$(".supplier .seller_cont").focus();
		});
        $(".seller_cont input").bind("input propertychange",function(){
        	$(".seller_select").show();
        	$(".seller_select ul").empty();
    	$("#merchant_id option").each(function(){
    		 if($(this).text().indexOf($(".seller_cont input").val())>=0){
    		 	var otext=$(this).text();
    		 	$(".seller_select ul").append("<li data-id="+$(this).val()+">"+otext+"</li>");  
              }    

        	}); 
    	$(".seller_select ul li").each(function(){
        	$(this).click(function(){
               var thisid=$(this).data("id");
                $(".seller_cont input").val($(this).text());
                $(".seller_select").hide();
        		$("#merchant_id option").each(function(index, el) {
        			if($(this).val()==thisid){
        				$(this).attr("selected","selected");
        				$("#merchant_id").change();
        			}
        		});
        	});
        });	     
        });
       
	});
</script>
{@/block@}
<!--头部标签区-->
{@block name=toptags@}
<div class="smbox-toptags">
	<form method="get">
		<a class="samao-link-btn samao-link-btn-refresh" href="javascript:window.location.reload()">刷新</a>&nbsp;&nbsp;
       <div class="supplier"> 
       {@form_select onchange='this.form.submit();' header="选择商户" options=DB::getopts('@pf_merchant','id,name') name="merchant_id" value="{@$sch.merchant_id@}" model=$schmodel@}&nbsp;&nbsp;
		<div class="seller_cont">
        {@$info=DB::getrow('@pf_merchant',$sch.merchant_id)@}
        {@$seller=$info['name']@}
		<input placeholder='选择商户' name="seller" value="{@$seller@}" class="form-control text" style="width:160px;"/>
		</div>
		<div class="seller_select">
			<ul></ul>
		</div>
		</div>
		

		<input name="add_time_from" id="add_time_from" class="form-control date" style="width:100px;" placeholder="请输入开始日期" type="text" {@if $sch.add_time_from@}value="{@$sch.add_time_from@}" {@/if@}/>-
		<input name="add_time_to" id="add_time_to" class="form-control date" style="width:100px;" placeholder="请输入截至日期" type="text" {@if $sch.add_time_to@}value="{@$sch.add_time_to@}" {@/if@}/>
		<input type="submit" value="查找" class="samao-mini-btn samao-mini-btn-search"/>&nbsp;&nbsp;
	</form>

{@/block@}
<br/>
{@block name=table_topbar@}<div class="form-list"><h3></h3></div>
<table width="800" border="0" align="center" cellpadding="0" cellspacing="1" style="margin:0 auto;" class="smbox-list-table2" id="smbox-list-table2" >
	<tr>
		<th align="left" bgcolor="#f7f7f7">商户</th>
		<th align="left" bgcolor="#f7f7f7">结算金额</th>
		<th align="left" bgcolor="#f7f7f7">退款金额</th>
		<th align="left" bgcolor="#f7f7f7">成单数量</th>
		<th align="left" bgcolor="#f7f7f7">退单数量</th>
		<th align="left" bgcolor="#f7f7f7">总金额</th>
	</tr>
	{@foreach from=$single item=report key=i@}
	<tr>
		<td align="left" bgcolor="#FFFFFF">
		    <span class="blu">{@$i|smval:'@pf_merchant':'name'@}</span>
		</td>
		<td align="left" bgcolor="#FFFFFF">
			<span class="blu">{@if $report.paid>0@}{@$report.paid@}元{@else@}-{@/if@}</span>
		</td>
		<td align="left" bgcolor="#FFFFFF">
			<span class="blu">{@if $report.refund_fees>0@}{@$report.refund_fees@}元{@else@}-{@/if@}</span>
		</td>
		<td align="left" bgcolor="#FFFFFF">
			<span class="blu">{@if $report.paid_num>0@}{@$report.paid_num@}单{@else@}-{@/if@}</span>
		</td>
		<td align="left" bgcolor="#FFFFFF">
                        <span class="blu">{@if $report.refund_num>0@}{@$report.refund_num@}单{@else@}-{@/if@}</span>
		</td>
		<td align="left" bgcolor="#FFFFFF">
			<span class="blu">{@$report.paid-$report.refund_fees|default:0@}元</span>
		</td>

	</tr>
	{@/foreach@}
	{@if !$sch.merchant_id@}
		<tr>
		<td align="left" bgcolor="#FFFFFF">
		    <span class="blu">总计</span>
		</td>
		<td align="left" bgcolor="#FFFFFF">
			<span class="blu">{@if $total.paid>0@}{@$total.paid@}元{@else@}-{@/if@}</span>
		</td>
		<td align="left" bgcolor="#FFFFFF">
			<span class="blu">{@if $total.refund_fees>0@}{@$total.refund_fees@}元{@else@}-{@/if@}</span>
		</td>
		<td align="left" bgcolor="#FFFFFF">
			<span class="blu">{@if $total.paid_num>0@}{@$total.paid_num@}单{@else@}-{@/if@}</span>
		</td>
		<td align="left" bgcolor="#FFFFFF">
			<span class="blu">{@if $total.refund_num>0@}{@$total.refund_num@}单{@else@}-{@/if@}</span>
		</td>
		<td align="left" bgcolor="#FFFFFF">
			<span class="blu">{@$total.paid-$total.refund_fees|default:0@}元</span>
		</td>
	</tr>
	{@/if@}
</table>
<div class="cls"></div>
<div id="container" style="min-width:700px;height:400px;"></div>
{@/block@}


{@block name=allopts@}

<div class="cls"></div>
<script>
	﻿$(function () {
    $('#container').highcharts({
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45
            }
        },
        title: {
            text: '商户结算饼状图'
        },
        subtitle: {
            text: '每个商户结算金额和比例'
        },
        plotOptions: {
            pie: {
                innerSize: 100,
                depth: 45
            }
        },
        series: [{
            name: '结算总金额',
            data: {@$single_pie@}
        }]
    });
});
</script>

{@/block@}

