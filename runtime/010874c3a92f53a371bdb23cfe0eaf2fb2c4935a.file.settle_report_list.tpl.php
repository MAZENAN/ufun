<?php /* Smarty version Smarty-3.1.19, created on 2019-07-09 15:51:14
         compiled from ".\Apps\Admin\views\layout\settle_report_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:175295d24477272e9f0-50118444%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '010874c3a92f53a371bdb23cfe0eaf2fb2c4935a' => 
    array (
      0 => '.\\Apps\\Admin\\views\\layout\\settle_report_list.tpl',
      1 => 1562133668,
      2 => 'file',
    ),
    '4b0c8ba3e57f0c60af6144fd304396960b2ce574' => 
    array (
      0 => 'E:\\WWW\\waimai\\Web\\samao\\tpls\\model_list.tpl',
      1 => 1491473406,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '175295d24477272e9f0-50118444',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'rows' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5d244772c0d912_47722810',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d244772c0d912_47722810')) {function content_5d244772c0d912_47722810($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\libs\\plugins\\modifier.date_format.php';
?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>结算明细数据</title>
<link href="/public/samaores/css/form.plane.css" rel="stylesheet" type="text/css" />
<link href="/public/samaores/css/list.plane.css" rel="stylesheet" type="text/css" />


<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.topdialog.js"></script>
<script type="text/javascript" charset="utf-8" src="/public/samaores/js/jquery-ui.js"></script>
<script type="text/javascript" src="/public/samaores/js/jquery.ui.datepicker-zh-CN.js"></script>
<script type="text/javascript" src="/public/js/highcharts.js"></script>
<script type="text/javascript" src="/public/js/exporting.js"></script>
<script type="text/javascript" src="/public/js/highcharts-3d.js"></script>
<script type="text/javascript">
$(function() {$("#settle_time").datepicker({dateFormat:'yy-mm-dd',changeMonth: true,changeYear:true,yearRange:'1900:2050'});});
$(function() {$("#settle_time_to").datepicker({dateFormat:'yy-mm-dd',changeMonth: true,changeYear:true,yearRange:'1900:2050'});});</script>
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

<!--samao model script-->
</head>
<body>
<div class="tablebox listbox margintop">
<div class="smbox-list-title">结算明细数据 <span id="inputbox_loading" style="display:none">正在提交中...</span></div>
<div class="smbox-list-content">

<div class="smbox-toptags">
	<form method="get">
		<a class="samao-link-btn samao-link-btn-refresh" href="javascript:window.location.reload()">刷新</a>&nbsp;&nbsp;
       <div class="supplier"> 
       <?php echo FormBox::select(array('onchange'=>'this.form.submit();','header'=>"选择商户",'options'=>DB::getopts('@pf_merchant','id,name'),'name'=>"merchant_id",'value'=>((string)$_smarty_tpl->tpl_vars['sch']->value['merchant_id']),),$_smarty_tpl->tpl_vars['schmodel']->value);?>&nbsp;&nbsp;
		<div class="seller_cont">
        <?php $_smarty_tpl->tpl_vars['info'] = new Smarty_variable(DB::getrow('@pf_merchant',$_smarty_tpl->tpl_vars['sch']->value['merchant_id']), null, 0);?>
        <?php $_smarty_tpl->tpl_vars['seller'] = new Smarty_variable($_smarty_tpl->tpl_vars['info']->value['name'], null, 0);?>
		<input placeholder='选择商户' name="seller" value="<?php echo $_smarty_tpl->tpl_vars['seller']->value;?>
" class="form-control text" style="width:160px;"/>
		</div>
		<div class="seller_select">
			<ul></ul>
		</div>
		</div>

		<input name="settle_time" id="settle_time" class="form-control date" style="width:100px;" placeholder="请输入开始日期" type="text" <?php if ($_smarty_tpl->tpl_vars['sch']->value['settle_time']) {?>value="<?php echo $_smarty_tpl->tpl_vars['sch']->value['settle_time'];?>
" <?php }?>/>-
		<input name="settle_time_to" id="settle_time_to" class="form-control date" style="width:100px;" placeholder="请输入截至日期" type="text" <?php if ($_smarty_tpl->tpl_vars['sch']->value['settle_time_to']) {?>value="<?php echo $_smarty_tpl->tpl_vars['sch']->value['settle_time_to'];?>
" <?php }?>/>		
		<input type="submit" value="查找" class="samao-mini-btn samao-mini-btn-search"/>&nbsp;&nbsp;
	</form>


<div class="form-list"><h3>结算额</h3></div>
<table width="800" border="0" align="center" cellpadding="0" cellspacing="1" style="margin:0 auto;" class="smbox-list-table2" id="smbox-list-table2" >
	<tr>
		<th align="left" bgcolor="#f7f7f7">商户</th>
		<th align="left" bgcolor="#f7f7f7">结算金额</th>
		<th align="left" bgcolor="#f7f7f7">退款金额</th>
		<th align="left" bgcolor="#f7f7f7">成单数量</th>
		<th align="left" bgcolor="#f7f7f7">退单数量</th>
		<th align="left" bgcolor="#f7f7f7">总金额</th>
	</tr>
	<?php  $_smarty_tpl->tpl_vars['report'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['report']->_loop = false;
 $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['single']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['report']->key => $_smarty_tpl->tpl_vars['report']->value) {
$_smarty_tpl->tpl_vars['report']->_loop = true;
 $_smarty_tpl->tpl_vars['i']->value = $_smarty_tpl->tpl_vars['report']->key;
?>
	<tr>
		<td align="left" bgcolor="#FFFFFF">
		    <span class="blu"><?php echo DB::getval('@pf_merchant','name',$_smarty_tpl->tpl_vars['i']->value);?>
</span>
		</td>
		<td align="left" bgcolor="#FFFFFF">
			<span class="blu"><?php if ($_smarty_tpl->tpl_vars['report']->value['paid']>0) {?><?php echo $_smarty_tpl->tpl_vars['report']->value['paid'];?>
元<?php } else { ?>-<?php }?></span>
		</td>
		<td align="left" bgcolor="#FFFFFF">
			<span class="blu"><?php if ($_smarty_tpl->tpl_vars['report']->value['refund_fees']>0) {?><?php echo $_smarty_tpl->tpl_vars['report']->value['refund_fees'];?>
元<?php } else { ?>-<?php }?></span>
		</td>
		<td align="left" bgcolor="#FFFFFF">
			<span class="blu"><?php if ($_smarty_tpl->tpl_vars['report']->value['paid_num']>0) {?><?php echo $_smarty_tpl->tpl_vars['report']->value['paid_num'];?>
单<?php } else { ?>-<?php }?></span>
		</td>
		<td align="left" bgcolor="#FFFFFF">
                        <span class="blu"><?php if ($_smarty_tpl->tpl_vars['report']->value['refund_num']>0) {?><?php echo $_smarty_tpl->tpl_vars['report']->value['refund_num'];?>
单<?php } else { ?>-<?php }?></span>
		</td>
		<td align="left" bgcolor="#FFFFFF">
			<span class="blu"><?php echo $_smarty_tpl->tpl_vars['report']->value['paid']-(($tmp = @$_smarty_tpl->tpl_vars['report']->value['refund_fees'])===null||$tmp==='' ? 0 : $tmp);?>
元</span>
		</td>

	</tr>
	<?php } ?>
	<?php if (!$_smarty_tpl->tpl_vars['sch']->value['merchant_id']) {?>
		<tr>
		<td align="left" bgcolor="#FFFFFF">
		    <span class="blu">总计</span>
		</td>
		<td align="left" bgcolor="#FFFFFF">
			<span class="blu"><?php if ($_smarty_tpl->tpl_vars['total']->value['paid']>0) {?><?php echo $_smarty_tpl->tpl_vars['total']->value['paid'];?>
元<?php } else { ?>-<?php }?></span>
		</td>
		<td align="left" bgcolor="#FFFFFF">
			<span class="blu"><?php if ($_smarty_tpl->tpl_vars['total']->value['refund_fees']>0) {?><?php echo $_smarty_tpl->tpl_vars['total']->value['refund_fees'];?>
元<?php } else { ?>-<?php }?></span>
		</td>
		<td align="left" bgcolor="#FFFFFF">
			<span class="blu"><?php if ($_smarty_tpl->tpl_vars['total']->value['paid_num']>0) {?><?php echo $_smarty_tpl->tpl_vars['total']->value['paid_num'];?>
单<?php } else { ?>-<?php }?></span>
		</td>
		<td align="left" bgcolor="#FFFFFF">
			<span class="blu"><?php if ($_smarty_tpl->tpl_vars['total']->value['refund_num']>0) {?><?php echo $_smarty_tpl->tpl_vars['total']->value['refund_num'];?>
单<?php } else { ?>-<?php }?></span>
		</td>
		<td align="left" bgcolor="#FFFFFF">
			<span class="blu"><?php echo $_smarty_tpl->tpl_vars['total']->value['paid']-(($tmp = @$_smarty_tpl->tpl_vars['total']->value['refund_fees'])===null||$tmp==='' ? 0 : $tmp);?>
元</span>
		</td>
	</tr>
	<?php }?>
</table>
<div class="cls"></div>
<div id="container" style="min-width:700px;height:400px;"></div>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="smbox-list-table" id="smbox-list-table">
<tr>

<div class="form-list">
<h3>订单详情<a onclick="return confirm('确定要导出表格吗？');" class="samao-link-minibtn" href="/admin/settle_report/exportList?merchant_id=<?php echo $_smarty_tpl->tpl_vars['sch']->value['merchant_id'];?>
&settle_time=<?php echo $_smarty_tpl->tpl_vars['sch']->value['settle_time'];?>
&settle_time_to=<?php echo $_smarty_tpl->tpl_vars['sch']->value['settle_time_to'];?>
" style="float:right">导出表格</a></h3>
</div>
<th width="130">商户</th>
<th width="80">订单号</th>
<th width="400">产品标题</th>
<th width="100">结算金额</th>
<th width="120">状态</th>
<th width="120">结算时间</th>
<th width="100">退款金额</th>
<th width="120">结算退款时间</th>
<th width="360">结算备注</th>


</tr>
<?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_smarty_tpl->tpl_vars['ttl'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['rows']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
 $_smarty_tpl->tpl_vars['ttl']->value = $_smarty_tpl->tpl_vars['rs']->key;
?>
<tr  onmouseover="this.oldBgcolor=this.style.backgroundColor;this.style.backgroundColor='#FCFCF8';" onmouseout="this.style.backgroundColor=this.oldBgcolor">


<td align="center">
	<span class="blu"><?php echo DB::getval('@pf_merchant','name',$_smarty_tpl->tpl_vars['rs']->value['merchant_id']);?>
</span>
</td>
<td align="center">
	<span class="blu"><?php echo $_smarty_tpl->tpl_vars['rs']->value['order_id'];?>
</span>
</td>

<td align="left">

</td>
<td align="center">
	<span class="org"><?php if ($_smarty_tpl->tpl_vars['rs']->value['scommision']>0) {?><?php echo $_smarty_tpl->tpl_vars['rs']->value['scommision'];?>
</span>元<?php } else { ?>-<?php }?>
</td>
<td align="center">
	<?php echo ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['rs']->value['settle_state'],array(0,1,2,3,4,5,6,7))) && array_key_exists($_tempkey,$_temparr=array('待BD审核','待高级销售审核','待财务审核','结算完成','结算退款中待bd审核','结算退款中待高级销售审核','结算退款中待财务审核','结算退款完成'))?$_temparr[$_tempkey]:'');?>

	
</td>
<td align="center">
	<?php echo smarty_modifier_date_format(strtotime($_smarty_tpl->tpl_vars['rs']->value['settle_time']),'Y-m-d');?>

</td>
<td align="center">
	<?php if ($_smarty_tpl->tpl_vars['rs']->value['settle_refund_time']) {?><?php echo $_smarty_tpl->tpl_vars['rs']->value['scommision'];?>
元<?php } else { ?>-<?php }?>
</td>
<td align="center">
	<?php if ($_smarty_tpl->tpl_vars['rs']->value['settle_refund_time']) {?><?php echo smarty_modifier_date_format(strtotime($_smarty_tpl->tpl_vars['rs']->value['settle_refund_time']),'Y-m-d');?>
<?php } else { ?>-<?php }?>
</td>
<td align="center">
	<?php echo $_smarty_tpl->tpl_vars['rs']->value['settle_remark'];?>

</td>

</tr>
<?php } ?>


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
            data: <?php echo $_smarty_tpl->tpl_vars['single_pie']->value;?>

        }]
    });
});
</script>


</table>

</div>
<div class="smbox-info-tips">


</div>
</div>

</body>
</html><?php }} ?>
