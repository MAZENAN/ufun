<?php /* Smarty version Smarty-3.1.19, created on 2019-05-27 17:04:02
         compiled from ".\Apps\Admin\views\layout\settle_bd_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:124905ceba802b4e989-54718738%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd0c7ffb7cc1fe3b709d8e5df7c67f45a83b592ad' => 
    array (
      0 => '.\\Apps\\Admin\\views\\layout\\settle_bd_list.tpl',
      1 => 1491472336,
      2 => 'file',
    ),
    '4b0c8ba3e57f0c60af6144fd304396960b2ce574' => 
    array (
      0 => 'E:\\WWW\\waimai\\Web\\samao\\tpls\\model_list.tpl',
      1 => 1491473406,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '124905ceba802b4e989-54718738',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'rows' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5ceba802c80f19_30326498',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ceba802c80f19_30326498')) {function content_5ceba802c80f19_30326498($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_sprint')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\modifier.sprint.php';
?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php if ($_smarty_tpl->tpl_vars['key']->value=='') {?>BD结算审核列表<?php } else { ?>高级销售审核列表<?php }?></title>
<link href="/public/samaores/css/form.plane.css" rel="stylesheet" type="text/css" />
<link href="/public/samaores/css/list.plane.css" rel="stylesheet" type="text/css" />


<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.topdialog.js"></script>
<style>.smbox-list-content{ width:1700px;}</style>
<script type="text/javascript">

	 $("#btnCheckAll").live("click", function () {
                $(".checkbox").attr("checked", true);
                $("#btnCheckAll").val("取消全选");
                $("input[type='button']").attr("id",'clearCheckAll');
            });

	 $("#clearCheckAll").live("click", function () {
                $(".checkbox").attr("checked", false);
                $("#clearCheckAll").val("全选");
                $("input[type='button']").attr("id",'btnCheckAll');
           });
	 $("#submit").live('click',function(){
	 	var leng=($("#form").serialize());
	 	if(leng.length<=10){
	 		alert('请选择！！');return;
	 	}
	 	 $("#form").submit();
	 });
	
</script>
<script type="text/javascript">
	$(document).ready(function(){	       	
        $("#seller_id").change(function(){
        	$("#seller_id option").each(function(){
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
		$("#seller_id").click(function(){
			$(".supplier .seller_cont").css("zIndex","999");
			$(".supplier .seller_cont").focus();
		});
        $(".seller_cont input").bind("input propertychange",function(){
        	$(".seller_select").show();
        	$(".seller_select ul").empty();
    	$("#seller_id option").each(function(){   		
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
        		$("#seller_id option").each(function(index, el) {
        			if($(this).val()==thisid){
        				$(this).attr("selected","selected");
        				$("#seller_id").change();
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
<div class="smbox-list-title"><?php if ($_smarty_tpl->tpl_vars['key']->value=='') {?>BD结算审核列表<?php } else { ?>高级销售审核列表<?php }?> <span id="inputbox_loading" style="display:none">正在提交中...</span></div>
<div class="smbox-list-content">


<div class="smbox-list-toptab">
	<form method="get" action="settle">
		<a class="samao-link-btn samao-link-btn-refresh" href="javascript:window.location.reload()">刷新</a>&nbsp;&nbsp;&nbsp;&nbsp;
		<div class="supplier"> <?php echo FormBox::select(array('onchange'=>'this.form.submit();','name'=>"seller_id",'value'=>((string)$_smarty_tpl->tpl_vars['seller_id']->value),),$_smarty_tpl->tpl_vars['model']->value);?>&nbsp;&nbsp; 
		<div class="seller_cont">
		<?php $_smarty_tpl->tpl_vars['info'] = new Smarty_variable(DB::getrow('@pf_member',$_smarty_tpl->tpl_vars['seller_id']->value), null, 0);?>
		<?php $_smarty_tpl->tpl_vars['seller'] = new Smarty_variable($_smarty_tpl->tpl_vars['info']->value['nickname'], null, 0);?>
		<input placeholder='选择供应商' name="seller" value="<?php echo $_smarty_tpl->tpl_vars['seller']->value;?>
" class="form-control text" style="width:160px;"/>
		</div>
		<div class="seller_select">
			<ul></ul>
		</div>
		</div>
		<?php echo FormBox::text(array('style'=>"width:120px",'value'=>((string)$_smarty_tpl->tpl_vars['title']->value),'name'=>"title",'placeholder'=>'请输入产品名称',),$_smarty_tpl->tpl_vars['schmodel']->value);?>
		<input type="submit" value="查找" class="samao-mini-btn samao-mini-btn-search"/>
		&nbsp;&nbsp;
		<input type="hidden" name="key" value="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
">
		</form>
</div>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="smbox-list-table" id="smbox-list-table">
<tr>

<th width="40">序号</th>
<th width="50">选择</th>
<th width="100">供应商</th>
<th width="460">产品名称</th>
<th width="100">订单号</th>
<th width="100">总费用</th>
<th width="80">结算价</th>
<th width="120">佣金</th>
<th width="80">负责人</th>
<th width="120">结算状态</th>
<th width="120">备注</th>
<th width="120">结算备注</th>
<th width="180">操作</th>
<form action="settleConfirm" method="post" id="form">

</tr>
<?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_smarty_tpl->tpl_vars['ttl'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['rows']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
 $_smarty_tpl->tpl_vars['ttl']->value = $_smarty_tpl->tpl_vars['rs']->key;
?>
<tr  onmouseover="this.oldBgcolor=this.style.backgroundColor;this.style.backgroundColor='#FCFCF8';" onmouseout="this.style.backgroundColor=this.oldBgcolor">

<?php  $_smarty_tpl->tpl_vars['srs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['srs']->_loop = false;
 $_smarty_tpl->tpl_vars['tt'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['rs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['srs']->key => $_smarty_tpl->tpl_vars['srs']->value) {
$_smarty_tpl->tpl_vars['srs']->_loop = true;
 $_smarty_tpl->tpl_vars['tt']->value = $_smarty_tpl->tpl_vars['srs']->key;
?>
<tr <?php if ($_smarty_tpl->tpl_vars['srs']->value['refund']==2) {?>class="tr_red"<?php }?>>
<td align="center"><?php echo $_smarty_tpl->tpl_vars['tt']->value+1;?>
</td>
<td align="center">
	<input type="checkbox" name="id[]" class="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['srs']->value['id'];?>
"/>
</td>

<td align="center">
	<span class="blu"><?php echo DB::getval('@pf_member','nickname',$_smarty_tpl->tpl_vars['srs']->value['seller_id']);?>
</span>
</td>
<td align="center">

	<a  href="/<?php if ($_smarty_tpl->tpl_vars['srs']->value['type']==0) {?>cncamp<?php } else { ?>glcamp<?php }?>-<?php echo $_smarty_tpl->tpl_vars['srs']->value['campid'];?>
.html" target="_blank"> <?php echo $_smarty_tpl->tpl_vars['srs']->value['title'];?>
 (<?php echo $_smarty_tpl->tpl_vars['srs']->value['departure_option'];?>
)</a>
</td>
<td align="center">
	<span ><?php echo $_smarty_tpl->tpl_vars['srs']->value['orderid'];?>
</span>
</td>
<td align="center">
	<?php echo $_smarty_tpl->tpl_vars['srs']->value['paid'];?>
&nbsp;元
</td>
<td align="center">
	<?php if ($_smarty_tpl->tpl_vars['srs']->value['scommision']!='') {?><?php echo $_smarty_tpl->tpl_vars['srs']->value['scommision'];?>
&nbsp;元<?php }?>
</td>
<td align="center">
	<?php if ($_smarty_tpl->tpl_vars['srs']->value['scommision']!=0) {?><?php echo smarty_modifier_sprint((($_smarty_tpl->tpl_vars['srs']->value['paid']-$_smarty_tpl->tpl_vars['srs']->value['scommision'])/$_smarty_tpl->tpl_vars['srs']->value['scommision']*100));?>
&nbsp;%(<?php echo $_smarty_tpl->tpl_vars['srs']->value['paid']-$_smarty_tpl->tpl_vars['srs']->value['scommision'];?>
元)<?php } else { ?>-<?php }?>
</td>
<td align="center">
	<?php echo DB::getval('@pf_manage','name',$_smarty_tpl->tpl_vars['srs']->value['manage_id']);?>

</td>
<td align="center">
	<?php echo ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['srs']->value['settle_state'],array('0','1','2','3','4','5','6','7'))) && array_key_exists($_tempkey,$_temparr=array('BD待审核','高级销售待审核','财务待审核','结算完成','结算退款待BD审核','结算退款待高级销售审核','结算退款待财务审核','结算退款完成'))?$_temparr[$_tempkey]:'');?>

</td>
<td align="center">
	<?php if ($_smarty_tpl->tpl_vars['srs']->value['payremark1']!='') {?><?php echo $_smarty_tpl->tpl_vars['srs']->value['payremark1'];?>
<?php } else { ?><?php echo $_smarty_tpl->tpl_vars['srs']->value['payremark2'];?>
<?php }?>
</td>
<td align="center">
	<?php echo $_smarty_tpl->tpl_vars['srs']->value['settle_remark'];?>

</td>
<td align="center">
	<a dialog="1" class="samao-link-minibtn" href="/admin/order/detail?id=<?php echo $_smarty_tpl->tpl_vars['srs']->value['id'];?>
">订单详情</a>
	<a class="samao-link-minibtn" href="/admin/order/updatePrice?id=<?php echo $_smarty_tpl->tpl_vars['srs']->value['id'];?>
<?php if ($_smarty_tpl->tpl_vars['key']->value) {?>&key=<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
<?php }?>">修改结算价格</a>
</td>
</tr>
<?php } ?>
<tr>
    <?php if ($_smarty_tpl->tpl_vars['key']->value=='') {?>
	<?php $_smarty_tpl->tpl_vars['price'] = new Smarty_variable(DB::getone("select SUM(scommision) from @pf_order as o join @pf_camp join @pf_member as mb on o.campid=@pf_camp.id and  @pf_camp.seller_id = mb.id where state in(?,?) and refund = ? and crm_state in(?,?) and settle_state = ? and @pf_camp.seller_id=?",array(3,8,0,2,10,0,$_smarty_tpl->tpl_vars['srs']->value['seller_id'])), null, 0);?>
	<?php $_smarty_tpl->tpl_vars['refund'] = new Smarty_variable(DB::getone("select SUM(scommision) from @pf_order as o join @pf_camp join @pf_member as mb on o.campid=@pf_camp.id and  @pf_camp.seller_id = mb.id where state =? and refund = ? and crm_state =? and settle_state = ? and @pf_camp.seller_id=?",array(5,2,2,4,$_smarty_tpl->tpl_vars['srs']->value['seller_id'])), null, 0);?>
    <?php } elseif ($_smarty_tpl->tpl_vars['key']->value==4) {?>
        <?php $_smarty_tpl->tpl_vars['price'] = new Smarty_variable(DB::getone("select SUM(scommision) from @pf_order as o join @pf_camp join @pf_member as mb on o.campid=@pf_camp.id and  @pf_camp.seller_id = mb.id where state in(?,?) and refund = ? and crm_state in(?,?) and settle_state = ? and @pf_camp.seller_id=?",array(3,8,0,2,10,1,$_smarty_tpl->tpl_vars['srs']->value['seller_id'])), null, 0);?>
	<?php $_smarty_tpl->tpl_vars['refund'] = new Smarty_variable(DB::getone("select SUM(scommision) from @pf_order as o join @pf_camp join @pf_member as mb on o.campid=@pf_camp.id and  @pf_camp.seller_id = mb.id where state =? and refund = ? and crm_state =? and settle_state = ? and @pf_camp.seller_id=?",array(5,2,2,5,$_smarty_tpl->tpl_vars['srs']->value['seller_id'])), null, 0);?>
    <?php }?>
        <td colspan="4" align="center" style="font-weight: bold;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;供应商名称：<span><?php echo $_smarty_tpl->tpl_vars['ttl']->value;?>
</span>
            
	<dd style="padding-left: 40px; display: inline-block;">结算价格合计：<span><?php echo $_smarty_tpl->tpl_vars['price']->value['SUM(scommision)']-$_smarty_tpl->tpl_vars['refund']->value['SUM(scommision)'];?>
&nbsp;元</span></dd>
	</td>  <td colspan="12"></td>
</tr>     

</tr>
<?php } ?>

<input type="hidden" name="key" value="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
">
</form>
</table>

</div>
<div class="smbox-info-tips">

<div class="form-submit" >
<input type="button" class="back" value="全选"  id="btnCheckAll"/>
<input type="submit" class="submit" value="提交" id="submit"/>
<div style="clear:both"></div>
</div>



</div>
</div>

</body>
</html><?php }} ?>
