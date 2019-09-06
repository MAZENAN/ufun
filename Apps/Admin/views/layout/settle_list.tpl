{@extends file='@model_list.tpl'@}
<!--标题-->
{@block name=title@}{@if $key==''@}BD结算审核列表{@else@}高级销售审核列表{@/if@}{@/block@}
<!--头部脚本区-->
{@block name=head@}
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
{@/block@}
<!--表格顶部区域-->
{@block name=table_topbar@}
<div class="smbox-list-toptab">
	<form method="get" action="settle">
		<a class="samao-link-btn samao-link-btn-refresh" href="javascript:window.location.reload()">刷新</a>&nbsp;&nbsp;&nbsp;&nbsp;
		<div class="supplier"> {@form_select onchange='this.form.submit();' name="seller_id" value="{@$seller_id@}" model=$model@}&nbsp;&nbsp; 
		<div class="seller_cont">
		{@$info=DB::getrow('@pf_member',$seller_id)@}
		{@$seller=$info['nickname']@}
		<input placeholder='选择供应商' name="seller" value="{@$seller@}" class="form-control text" style="width:160px;"/>
		</div>
		<div class="seller_select">
			<ul></ul>
		</div>
		</div>
		{@form_text style="width:120px" value="{@$title@}" name="title" placeholder= '请输入产品名称' model=$schmodel@}
		<input type="submit" value="查找" class="samao-mini-btn samao-mini-btn-search"/>
		&nbsp;&nbsp;
		<input type="hidden" name="key" value="{@$key@}">
		</form>
</div>
{@/block@}
<!--表头列-->
{@block name=table_ths@}
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
{@/block@}
<!--总列数合并单元格时可用-->
{@block name=colspan@}

{@/block@}
<!--表行列-->

{@block name=table_tds@}
<tr {@if $rs.refund==2@}class="tr_red"{@/if@}>
<td align="center">{@$ttl+1@}</td>
<td align="center">
	<input type="checkbox" name="id[]" class="checkbox" value="{@$rs.id@}"/>
</td>

<td align="center">
	<span class="blu">{@$rs.seller_id|smval:'@pf_member':'nickname'@}</span>
</td>
<td align="center">

	<a  href="/{@if $rs.type == 0@}cncamp{@else@}glcamp{@/if@}-{@$rs.campid@}.html" target="_blank"> {@$rs.title@} ({@$rs.departure_option@})</a>
</td>
<td align="center">
	<span >{@$rs.orderid@}</span>
</td>
<td align="center">
	{@$rs.paid@}&nbsp;元
</td>
<td align="center">
	{@if $rs.scommision !=''@}{@$rs.scommision@}&nbsp;元{@/if@}
</td>
<td align="center">
	{@if $rs.scommision!=0 @}{@(($rs.paid-$rs.scommision)/$rs.scommision*100)|sprint@}&nbsp;%({@$rs.paid-$rs.scommision@}元){@else@}-{@/if@}
</td>
<td align="center">
	{@$rs.manage_id|smval:'@pf_manage':'name'@}
</td>
<td align="center">
	{@$rs.settle_state|case:['0','1','2','3','4','5','6','7']:['BD待审核','高级销售待审核','财务待审核','结算完成','结算退款待BD审核','结算退款待高级销售审核','结算退款待财务审核','结算退款完成']@}
</td>
<td align="center">
	{@if $rs.payremark1 != ''@}{@$rs.payremark1@}{@else@}{@$rs.payremark2@}{@/if@}
</td>
<td align="center">
	{@$rs.settle_remark@}
</td>
<td align="center">
	<a dialog="1" class="samao-link-minibtn" href="__SELF__/detail?id={@$rs.id@}">订单详情</a>
	<a class="samao-link-minibtn" href="__SELF__/updatePrice?id={@$rs.id@}{@if $key@}&key={@$key@}{@/if@}">修改结算价格</a>
</td>
</tr>
{@/block@}
{@block name=allopts@}
<input type="hidden" name="key" value="{@$key@}">
</form>{@/block@}
{@block name=information@}
<div class="form-submit" >
<input type="button" class="back" value="全选"  id="btnCheckAll"/>
<input type="submit" class="submit" value="提交" id="submit"/>
<div style="clear:both"></div>
</div>

{@/block@}
