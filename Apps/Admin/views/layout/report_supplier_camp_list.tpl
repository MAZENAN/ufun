{@extends file='@model_list.tpl'@}
<!--标题-->
{@block name=title@}产品资源统计{@/block@}
<!--头部脚本区-->
{@block name=head@}
<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.topdialog.js"></script>
<script type="text/javascript" charset="utf-8" src="/public/samaores/js/jquery-ui.js"></script>
<script type="text/javascript" src="/public/js/highcharts.js"></script>
  <script type="text/javascript" src="/public/js/exporting.js"></script>
   <script type="text/javascript" src="/public/js/data.js"></script>

<style>.smbox-list-table{ width:1760px;} .smbox-list-table100{ width: 100%;} .form-list h3{ padding-left: 20px;}
#container2,#container{ float: left; margin-left: 10px; }
.tab_menu{ overflow: hidden; margin: 10px 20px;  }
.tab_menu ul{ padding: 0 }
.tab_menu li{ padding: 0 20px; line-height: 30px; height: 30px; float: left; list-style: none; transition:.5s all ease; box-sizing: border-box; border:1px solid #00A2CA; color: #00A2CA; border-radius: 3px; margin-right: 10px; cursor: pointer; }
.tab_menu li:hover{ background: #00A2CA; color: #fff; }
.tab_menu li.active{ position: relative; background: #0095bb; color: #fff;}
.tab_menu h3{  }
.tab{transition:1s all cubic-bezier(0.07, 0.65, 0.38, 1); transform:perspective(800px);}
.act{transform:perspective(800px) rotateX(90deg); height: 0; overflow: hidden; transform-origin:center bottom;}
.tab table{ margin-top: 45px;}
.highcharts-legend-item{ display: none;}
.tablebox{overflow: hidden;}
</style>
<link href="/public/samaores/css/jqueryui/custom.css" rel="stylesheet" type="text/css" />
<link href="/public/samaores/css/list.plane.css" rel="stylesheet" type="text/css" />
<link href="/public/samaores/css/form.plane.css" rel="stylesheet" type="text/css" />

{@/block@}
<!--头部标签区-->
{@block name=toptags@}
<div class="smbox-toptags">
	<form method="get">
		<a class="samao-link-btn samao-link-btn-refresh" href="javascript:window.location.reload()">刷新</a>&nbsp;&nbsp;
		{@form_select onchange='this.form.submit();'  options=[["","全部"],[2,"预上架"],[1,"上架"],[0,"下架"]] name="allow" value="{@$sch.allow@}" model=$schmodel@}&nbsp;&nbsp;
	</form>
</div>
{@/block@}
<br/>
{@block name=table_topbar@}<div class="form-list"><h3>产品信息数量</h3></div>
<table width="800" style="margin:0 auto" border="0" align="center" cellpadding="0" cellspacing="1" class="smbox-list-table2" id="smbox-list-table2" >
	<tr>
		<th align="left" bgcolor="#f7f7f7">负责人</th>
		<th align="left" bgcolor="#f7f7f7">国内营</th>
		<th align="left" bgcolor="#f7f7f7">国际营</th>
		<th align="left" bgcolor="#f7f7f7">总计</th>
	</tr>
	{@foreach from=$bd_sum item=rs key=i@}
	<tr>
		<td align="left" bgcolor="#FFFFFF">
		    <span class="blu">{@$i|smval:'@pf_manage'@}</span>
		</td>
		<td align="left" bgcolor="#FFFFFF">
			<span class="blu">{@if $rs.0>0@}{@$rs.0@}{@else@}-{@/if@}</span>
		</td>
		<td align="left" bgcolor="#FFFFFF">
			<span class="blu">{@if $rs.1>0@}{@$rs.1@}{@else@}-{@/if@}</span>
		</td>
		<td align="left" bgcolor="#FFFFFF">
			<span class="blu">{@if $rs.0+$rs.1>0@}{@$rs.0+$rs.1@}{@else@}-{@/if@}</span>
		</td>
	</tr>
	{@/foreach@}
	<tr>
		<td align="left" bgcolor="#FFFFFF">
		    <span class="blu">总计</span>
		</td>
		<td align="left" bgcolor="#FFFFFF">
			<span class="blu">{@if $sum.0>0@}{@$sum.0@}{@else@}-{@/if@}</span>
		</td>
		<td align="left" bgcolor="#FFFFFF">
			<span class="blu">{@if $sum.1>0@}{@$sum.1@}{@else@}-{@/if@}</span>
		</td>
		<td align="left" bgcolor="#FFFFFF">
			<span class="blu">{@if $sum.0+$sum.1>0@}{@$sum.0+$sum.1@}{@else@}-{@/if@}</span>
		</td>
	</tr>
</table>
<div class="cls"></div>
<div class="tab_menu">
<h3>项目主题数量及比例</h3>
<ul>
	<li class="active">国内营</li>
	<li>国际营</li>
</ul>
</div>
<div class="tab">
<table width="200"  border="0" align="left" cellpadding="0" cellspacing="1" class="smbox-list-table2">
	<tr>
		<th height="19" bgcolor="#f7f7f7">项目主题</th>
		<th bgcolor="#f7f7f7">数量</th>
	</tr>
	{@foreach from=$c_theme item=mrs key=i@}
	<tr>
		<td align="center" bgcolor="#ffffff">
		    <span class="blu">{@$mrs@}</span>
		</td>
		<td align="center" bgcolor="#ffffff">
			<span class="blu">{@if $c_sum.$i@}{@$c_sum.$i@}{@else@}-{@/if@}</span>
		</td>
	</tr>
	{@/foreach@}
</table>
<div id="container" style="min-width:900px;height:400px;"></div>
<div class="cls"></div>
	</div>
	<div class="tab act">
<table width="200"  border="0" align="left" cellpadding="0" cellspacing="1" class="smbox-list-table2">
	<tr>
		<th height="19" bgcolor="#f7f7f7">项目主题</th>
		<th bgcolor="#f7f7f7">数量</th>
	</tr>
	{@foreach from=$g_theme item=mrs key=i@}
	<tr>
		<td align="center" bgcolor="#ffffff">
		    <span class="blu">{@$mrs@}</span>
		</td>
		<td align="center" bgcolor="#ffffff">
			<span class="blu">{@if $g_sum.$i@}{@$g_sum.$i@}{@else@}-{@/if@}</span>
		</td>
	</tr>
	{@/foreach@}	
</table>
<div id="container2" style="min-width:900px;height:400px;"></div>
<div class="cls"></div>
	</div>
{@/block@}

{@block name=allopts@}
<table id="datatable" style="display: none;">
    <thead>
        <tr>
            <th></th>        
            <th>国内营项目主题数量及比例</th>
        </tr>
    </thead>
    <tbody>
{@foreach from=$c_theme item=mrs key=i@}
        <tr>
            <th>{@$mrs@}</th>        
            <td>{@$c_sum.$i@}</td>
        </tr>
        {@/foreach@}
    </tbody>
</table>
<table id="datatable2" style="display: none;">
    <thead>
        <tr>       
            <th></th> 
            <th>国际营项目主题数量及比例</th>
        </tr>
    </thead>
    <tbody>
{@foreach from=$g_theme item=mrs key=i@}
        <tr>
            <th>{@$mrs@}</th>        
            <td>{@$g_sum.$i@}</td>
        </tr>
        {@/foreach@}
    </tbody>
</table>
<div class="cls"></div>
<script type="text/javascript">
       $(function () {
       	$(".tab_menu ul li").click(function(){
             $(".tab_menu ul li").eq($(this).index()).addClass("active").siblings().removeClass("active");
             $(".tab").addClass('act').eq($(this).index()).removeClass('act');
			
       	});
    $('#container').highcharts({
        data: {
            table: 'datatable'
        },
        chart: {
            type: 'column'
        },
        title: {
            text: '国内营项目主题数量及比例'
        },
        yAxis: {
            allowDecimals: false,
            title: {
                text: ''
            }
        },
        tooltip: {
            formatter: function () {
                return '<b>' + this.series.name + '</b><br/>' +
                    this.point.y + ' ' + this.point.name.toLowerCase();
            }
        }, 
    });

    $('#container2').highcharts({
        data: {
            table: 'datatable2'
        },
        chart: {
            type: 'column'
        },
        title: {
            text: '国际营项目主题数量及比例'
        },
        yAxis: {
            allowDecimals: false,
            title: {
                text: ''
            }
        },
        tooltip: {
            formatter: function () {
                return '<b>' + this.series.name + '</b><br/>' +
                    this.point.y + ' ' + this.point.name.toLowerCase();
            }
        }, 
        colors:[
                        '#434348'                   
                      ],
    });
});


    </script>

{@/block@}

