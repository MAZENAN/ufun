{@extends file='@model_list.tpl'@}
<!--标题-->
{@block name=title@}总体销售业绩{@/block@}
<!--头部脚本区-->
{@block name=head@}
<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.topdialog.js"></script>
<script type="text/javascript" src="/public/js/highcharts.js"></script>
<style>
    .samao-link-btn-refresh{ margin-right: 20px;}
</style>
{@/block@}
<!--头部标签区-->

{@block name=toptags@}

<div class="smbox-toptags">
<a class="samao-link-btn samao-link-btn-refresh" href="javascript:window.location.reload()">刷新</a>
	<a href="?year={@date('Y')@}"{@if !isset($smarty.get.year) || $smarty.get.year==='' || $smarty.get.year==date('Y')@}class="active"{@/if@}>{@date('Y')@}</a>
	{@foreach from=$year item=xs key=ik@}
	<a href="?year={@$ik@}" {@if $smarty.get.year!=date('Y') && $smarty.get.year@}class="active"{@/if@}>{@$xs@}</a>
	{@/foreach@}
</div>
{@/block@}

{@block name=table_ths@}
<table width="800"  border="0" align="center" cellpadding="0" cellspacing="1" style="margin:0 auto;" class="smbox-list-table2">
<th width="80" align="left" bgcolor="#f7f7f7">销售状况总表</th>
<th width="100" align="left" bgcolor="#f7f7f7">销售金额</th>
<th width="80" align="left" bgcolor="#f7f7f7">退款金额</th>
<th width="80" align="left" bgcolor="#f7f7f7">未结算金额</th>
<th width="100" align="left" bgcolor="#f7f7f7">成单数量</th>
<th width="80" align="left" bgcolor="#f7f7f7">退单数量</th>
<th width="120" align="left" bgcolor="#f7f7f7">销售业绩</th>
{@/block@}

<!--总列数合并单元格时可用-->
{@block name=colspan@}9{@/block@}
<!--表行列-->
{@block name=table_tds@}
<td align="left" bgcolor="#FFFFFF">
	<span class="blu">{@$rs.month|case: [1,2,3,4,5,6,7,8,9,10,11,12]:['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月']@}</span>
</td>
<td align="left" bgcolor="#FFFFFF">
    <span class="blu">
    	{@if $rs.sales@}
    	{@$rs.sales@}&nbsp;元
    	{@else@}-{@/if@}
    </span>
</td>
<td align="left" bgcolor="#FFFFFF">
    <span class="blu">
    	{@if $rs.refund_fees@}
    	{@$rs.refund_fees@}&nbsp;元
    	{@else@}-{@/if@}
    </span>
</td>
<td align="left" bgcolor="#FFFFFF">
    <span class="blu">
    	{@if $rs.unscommision@}
    	{@$rs.unscommision@}&nbsp;元
    	{@else@}-{@/if@}
    </span>
</td>

<td align="left" bgcolor="#FFFFFF">
	<span class="blu">{@$rs.sales_count@}&nbsp;单</span>
</td>
<td align="left" bgcolor="#FFFFFF">
    <span class="blu">
    	{@if $rs.refund_fees_count >0@}
    	{@$rs.refund_fees_count@}&nbsp;单
    	{@else@}-{@/if@}
    </span>
</td>
<td align="left" bgcolor="#FFFFFF">
    <span class="blu">
    	{@if $rs.results@}
    	{@$rs.results@}&nbsp;元
    	{@else@}-{@/if@}
    </span>
</td>
{@/block@}
{@block name=allopts@}
<tr>
<td align="left" bgcolor="#FFFFFF"><span class="blu">总计</span></td>
<td align="left" bgcolor="#FFFFFF"><span class="blu">{@$count.count_sales@}&nbsp;元</span></td>
<td align="left" bgcolor="#FFFFFF"><span class="blu">{@$count.count_refund_fees@}&nbsp;元</span></td>
<td align="left" bgcolor="#FFFFFF"><span class="blu">{@$count.count_unscommision@}&nbsp;元</span></td>
<td align="left" bgcolor="#FFFFFF"><span class="blu">{@$count.sales_count@}&nbsp;单</span></td>
<td align="left" bgcolor="#FFFFFF"><span class="blu">{@$count.refund_fees_count@}&nbsp;单</span></td>
<td align="left" bgcolor="#FFFFFF"><span class="blu">{@$count.count_sales - $count.count_refund_fees@}&nbsp;元</span></td>
</tr>
</table>
<script>
/**
 * Grid theme for Highcharts JS
 * @author Torstein Honsi
 */

Highcharts.theme = {
    colors: ['#058DC7', '#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4'],
    chart: {
    
        borderWidth: 0,
        plotBackgroundColor: 'rgba(255, 255, 255, .9)',
        plotShadow: true,
        plotBorderWidth: 1
    },
    title: {
        style: {
            color: '#000',
            font: 'bold 16px "Trebuchet MS", Verdana, sans-serif'
        }
    },
    subtitle: {
        style: {
            color: '#666666',
            font: 'bold 12px "Trebuchet MS", Verdana, sans-serif'
        }
    },
    xAxis: {
        gridLineWidth: 1,
        lineColor: '#000',
        tickColor: '#000',
        labels: {
            style: {
                color: '#000',
                font: '11px Trebuchet MS, Verdana, sans-serif'
            }
        },
        title: {
            style: {
                color: '#333',
                fontWeight: 'bold',
                fontSize: '12px',
                fontFamily: 'Trebuchet MS, Verdana, sans-serif'

            }
        }
    },
    yAxis: {
        minorTickInterval: 'auto',
        lineColor: '#000',
        lineWidth: 1,
        tickWidth: 1,
        tickColor: '#000',
        labels: {
            style: {
                color: '#000',
                font: '11px Trebuchet MS, Verdana, sans-serif'
            }
        },
        title: {
            style: {
                color: '#333',
                fontWeight: 'bold',
                fontSize: '12px',
                fontFamily: 'Trebuchet MS, Verdana, sans-serif'
            }
        }
    },
    legend: {
        itemStyle: {
            font: '9pt Trebuchet MS, Verdana, sans-serif',
            color: 'black'

        },
        itemHoverStyle: {
            color: '#039'
        },
        itemHiddenStyle: {
            color: 'gray'
        }
    },
    labels: {
        style: {
            color: '#99b'
        }
    },

    navigation: {
        buttonOptions: {
            theme: {
                stroke: '#CCCCCC'
            }
        }
    }
};

// Apply the theme
var highchartsOptions = Highcharts.setOptions(Highcharts.theme);



    $(function () {
    $('#container').highcharts({
        title: {
            text: '营天下销售金额示意图',
            x: -20 //center
        },
        subtitle: {
            text: '(按月份统计)',
            x: -20
        },
        xAxis: {
            categories: [{@foreach from=$rows item=rs key=k@}{@$k@}+'月份',{@/foreach@}]
        },
        yAxis: {
            title: {
                text: '营天下销售金额示意图'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: '元'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: '销售金额',
            data: [{@foreach from=$rows item=rs@}{@$rs['sales']@},{@/foreach@}]
        }, {
            name: '退款金额',
            data: [{@foreach from=$rows item=rs@}{@$rs['refund_fees']@},{@/foreach@}]
        }, {
            name: '销售业绩',
            data: [{@foreach from=$rows item=rs@}{@$rs['results']@},{@/foreach@}]
        }, /*{
            name: 'London',
            data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
        }*/]
    });
});
</script>

<div id="container" style="min-width:400px;height:400px; margin:0 20px 20px 20px;"></div>

{@/block@}


