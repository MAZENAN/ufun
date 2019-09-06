<?php /* Smarty version Smarty-3.1.19, created on 2019-05-08 15:09:19
         compiled from ".\Apps\Admin\views\layout\report_supplier_camp_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:139855cd2809f0359a8-25859808%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '52b94db92017c9823518a0d90e8cd99d676f4e0a' => 
    array (
      0 => '.\\Apps\\Admin\\views\\layout\\report_supplier_camp_list.tpl',
      1 => 1491472341,
      2 => 'file',
    ),
    '4b0c8ba3e57f0c60af6144fd304396960b2ce574' => 
    array (
      0 => 'E:\\WWW\\waimai\\Web\\samao\\tpls\\model_list.tpl',
      1 => 1491473406,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '139855cd2809f0359a8-25859808',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'rows' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5cd2809f13e470_92134044',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5cd2809f13e470_92134044')) {function content_5cd2809f13e470_92134044($_smarty_tpl) {?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>产品资源统计</title>
<link href="/public/samaores/css/form.plane.css" rel="stylesheet" type="text/css" />
<link href="/public/samaores/css/list.plane.css" rel="stylesheet" type="text/css" />


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


<!--samao model script-->
</head>
<body>
<div class="tablebox listbox margintop">
<div class="smbox-list-title">产品资源统计 <span id="inputbox_loading" style="display:none">正在提交中...</span></div>
<div class="smbox-list-content">

<div class="smbox-toptags">
	<form method="get">
		<a class="samao-link-btn samao-link-btn-refresh" href="javascript:window.location.reload()">刷新</a>&nbsp;&nbsp;
		<?php echo FormBox::select(array('onchange'=>'this.form.submit();','options'=>array(array('',"全部"),array(2,"预上架"),array(1,"上架"),array(0,"下架")),'name'=>"allow",'value'=>((string)$_smarty_tpl->tpl_vars['sch']->value['allow']),),$_smarty_tpl->tpl_vars['schmodel']->value);?>&nbsp;&nbsp;
	</form>
</div>

<div class="form-list"><h3>产品信息数量</h3></div>
<table width="800" style="margin:0 auto" border="0" align="center" cellpadding="0" cellspacing="1" class="smbox-list-table2" id="smbox-list-table2" >
	<tr>
		<th align="left" bgcolor="#f7f7f7">负责人</th>
		<th align="left" bgcolor="#f7f7f7">国内营</th>
		<th align="left" bgcolor="#f7f7f7">国际营</th>
		<th align="left" bgcolor="#f7f7f7">总计</th>
	</tr>
	<?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['bd_sum']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
 $_smarty_tpl->tpl_vars['i']->value = $_smarty_tpl->tpl_vars['rs']->key;
?>
	<tr>
		<td align="left" bgcolor="#FFFFFF">
		    <span class="blu"><?php echo DB::getval('@pf_manage','name',$_smarty_tpl->tpl_vars['i']->value);?>
</span>
		</td>
		<td align="left" bgcolor="#FFFFFF">
			<span class="blu"><?php if ($_smarty_tpl->tpl_vars['rs']->value[0]>0) {?><?php echo $_smarty_tpl->tpl_vars['rs']->value[0];?>
<?php } else { ?>-<?php }?></span>
		</td>
		<td align="left" bgcolor="#FFFFFF">
			<span class="blu"><?php if ($_smarty_tpl->tpl_vars['rs']->value[1]>0) {?><?php echo $_smarty_tpl->tpl_vars['rs']->value[1];?>
<?php } else { ?>-<?php }?></span>
		</td>
		<td align="left" bgcolor="#FFFFFF">
			<span class="blu"><?php if ($_smarty_tpl->tpl_vars['rs']->value[0]+$_smarty_tpl->tpl_vars['rs']->value[1]>0) {?><?php echo $_smarty_tpl->tpl_vars['rs']->value[0]+$_smarty_tpl->tpl_vars['rs']->value[1];?>
<?php } else { ?>-<?php }?></span>
		</td>
	</tr>
	<?php } ?>
	<tr>
		<td align="left" bgcolor="#FFFFFF">
		    <span class="blu">总计</span>
		</td>
		<td align="left" bgcolor="#FFFFFF">
			<span class="blu"><?php if ($_smarty_tpl->tpl_vars['sum']->value[0]>0) {?><?php echo $_smarty_tpl->tpl_vars['sum']->value[0];?>
<?php } else { ?>-<?php }?></span>
		</td>
		<td align="left" bgcolor="#FFFFFF">
			<span class="blu"><?php if ($_smarty_tpl->tpl_vars['sum']->value[1]>0) {?><?php echo $_smarty_tpl->tpl_vars['sum']->value[1];?>
<?php } else { ?>-<?php }?></span>
		</td>
		<td align="left" bgcolor="#FFFFFF">
			<span class="blu"><?php if ($_smarty_tpl->tpl_vars['sum']->value[0]+$_smarty_tpl->tpl_vars['sum']->value[1]>0) {?><?php echo $_smarty_tpl->tpl_vars['sum']->value[0]+$_smarty_tpl->tpl_vars['sum']->value[1];?>
<?php } else { ?>-<?php }?></span>
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
	<?php  $_smarty_tpl->tpl_vars['mrs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['mrs']->_loop = false;
 $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['c_theme']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['mrs']->key => $_smarty_tpl->tpl_vars['mrs']->value) {
$_smarty_tpl->tpl_vars['mrs']->_loop = true;
 $_smarty_tpl->tpl_vars['i']->value = $_smarty_tpl->tpl_vars['mrs']->key;
?>
	<tr>
		<td align="center" bgcolor="#ffffff">
		    <span class="blu"><?php echo $_smarty_tpl->tpl_vars['mrs']->value;?>
</span>
		</td>
		<td align="center" bgcolor="#ffffff">
			<span class="blu"><?php if ($_smarty_tpl->tpl_vars['c_sum']->value[$_smarty_tpl->tpl_vars['i']->value]) {?><?php echo $_smarty_tpl->tpl_vars['c_sum']->value[$_smarty_tpl->tpl_vars['i']->value];?>
<?php } else { ?>-<?php }?></span>
		</td>
	</tr>
	<?php } ?>
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
	<?php  $_smarty_tpl->tpl_vars['mrs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['mrs']->_loop = false;
 $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['g_theme']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['mrs']->key => $_smarty_tpl->tpl_vars['mrs']->value) {
$_smarty_tpl->tpl_vars['mrs']->_loop = true;
 $_smarty_tpl->tpl_vars['i']->value = $_smarty_tpl->tpl_vars['mrs']->key;
?>
	<tr>
		<td align="center" bgcolor="#ffffff">
		    <span class="blu"><?php echo $_smarty_tpl->tpl_vars['mrs']->value;?>
</span>
		</td>
		<td align="center" bgcolor="#ffffff">
			<span class="blu"><?php if ($_smarty_tpl->tpl_vars['g_sum']->value[$_smarty_tpl->tpl_vars['i']->value]) {?><?php echo $_smarty_tpl->tpl_vars['g_sum']->value[$_smarty_tpl->tpl_vars['i']->value];?>
<?php } else { ?>-<?php }?></span>
		</td>
	</tr>
	<?php } ?>	
</table>
<div id="container2" style="min-width:900px;height:400px;"></div>
<div class="cls"></div>
	</div>

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

<table id="datatable" style="display: none;">
    <thead>
        <tr>
            <th></th>        
            <th>国内营项目主题数量及比例</th>
        </tr>
    </thead>
    <tbody>
<?php  $_smarty_tpl->tpl_vars['mrs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['mrs']->_loop = false;
 $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['c_theme']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['mrs']->key => $_smarty_tpl->tpl_vars['mrs']->value) {
$_smarty_tpl->tpl_vars['mrs']->_loop = true;
 $_smarty_tpl->tpl_vars['i']->value = $_smarty_tpl->tpl_vars['mrs']->key;
?>
        <tr>
            <th><?php echo $_smarty_tpl->tpl_vars['mrs']->value;?>
</th>        
            <td><?php echo $_smarty_tpl->tpl_vars['c_sum']->value[$_smarty_tpl->tpl_vars['i']->value];?>
</td>
        </tr>
        <?php } ?>
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
<?php  $_smarty_tpl->tpl_vars['mrs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['mrs']->_loop = false;
 $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['g_theme']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['mrs']->key => $_smarty_tpl->tpl_vars['mrs']->value) {
$_smarty_tpl->tpl_vars['mrs']->_loop = true;
 $_smarty_tpl->tpl_vars['i']->value = $_smarty_tpl->tpl_vars['mrs']->key;
?>
        <tr>
            <th><?php echo $_smarty_tpl->tpl_vars['mrs']->value;?>
</th>        
            <td><?php echo $_smarty_tpl->tpl_vars['g_sum']->value[$_smarty_tpl->tpl_vars['i']->value];?>
</td>
        </tr>
        <?php } ?>
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


</table>

</div>
<div class="smbox-info-tips">


</div>
</div>

</body>
</html><?php }} ?>
