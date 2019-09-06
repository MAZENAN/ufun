<?php /* Smarty version Smarty-3.1.19, created on 2019-07-09 15:51:16
         compiled from ".\Apps\Admin\views\layout\settle_sale_report_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:177355d24477457f362-97368082%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ad0964b4ffef5dcbf6c5833d472184724b7cdd60' => 
    array (
      0 => '.\\Apps\\Admin\\views\\layout\\settle_sale_report_list.tpl',
      1 => 1562118180,
      2 => 'file',
    ),
    '4b0c8ba3e57f0c60af6144fd304396960b2ce574' => 
    array (
      0 => 'E:\\WWW\\waimai\\Web\\samao\\tpls\\model_list.tpl',
      1 => 1491473406,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '177355d24477457f362-97368082',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'rows' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5d2447747b8c15_00169237',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d2447747b8c15_00169237')) {function content_5d2447747b8c15_00169237($_smarty_tpl) {?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>结算销售数据</title>
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

<!--samao model script-->
</head>
<body>
<div class="tablebox listbox margintop">
<div class="smbox-list-title">结算销售数据 <span id="inputbox_loading" style="display:none">正在提交中...</span></div>
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
		

		<input name="add_time_from" id="add_time_from" class="form-control date" style="width:100px;" placeholder="请输入开始日期" type="text" <?php if ($_smarty_tpl->tpl_vars['sch']->value['add_time_from']) {?>value="<?php echo $_smarty_tpl->tpl_vars['sch']->value['add_time_from'];?>
" <?php }?>/>-
		<input name="add_time_to" id="add_time_to" class="form-control date" style="width:100px;" placeholder="请输入截至日期" type="text" <?php if ($_smarty_tpl->tpl_vars['sch']->value['add_time_to']) {?>value="<?php echo $_smarty_tpl->tpl_vars['sch']->value['add_time_to'];?>
" <?php }?>/>
		<input type="submit" value="查找" class="samao-mini-btn samao-mini-btn-search"/>&nbsp;&nbsp;
	</form>


<div class="form-list"><h3></h3></div>
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

</tr>
<?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_smarty_tpl->tpl_vars['ttl'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['rows']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
 $_smarty_tpl->tpl_vars['ttl']->value = $_smarty_tpl->tpl_vars['rs']->key;
?>
<tr  onmouseover="this.oldBgcolor=this.style.backgroundColor;this.style.backgroundColor='#FCFCF8';" onmouseout="this.style.backgroundColor=this.oldBgcolor">

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
