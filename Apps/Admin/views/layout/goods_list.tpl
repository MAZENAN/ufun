{@extends file='@model_list.tpl'@}
<!--标题-->
{@block name=title@}商品列表{@/block@}
{@block name=head@}
<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.topdialog.js"></script>
<script type="text/javascript" src="/public/js/admin/main.js"></script>
<script type="text/javascript" src="/public/js/admin/allow_check.js"></script>

<script type="text/javascript">
 $(function () {

     var count=0;
     $("#btnCheckAll").live("click", function () {
         $(".checkbox").attr("checked", true);
         $("#btnCheckAll").val("取消全选");
         $("input[type='button']").attr("id",'clearCheckAll');
         count=0;
         $(".checkbox").each(function() {
             count += 1;
         });
         $(".check_count").html(count);
     });

     $("#clearCheckAll").live("click", function () {
         $(".checkbox").attr("checked", false);
         $("#clearCheckAll").val("全选");
         $("input[type='button']").attr("id",'btnCheckAll');
         count=0;
         $(".check_count").html(count);
     });
     $(".checkbox").live("click", function () {
         if ($(this).attr("checked")) {
             count += 1;
         }  else{
             count -= 1;
         }
         $(".check_count").html(count);
     });
     $("#submit").live('click',function(){
         if(count==0){
             alert('请选择商品！');
             return;
         }
         $("#form").submit();
     });
     $("#off_submit").live('click',function(){
         if(count==0){
             alert('请选择商品！');
             return;
         }
         $("#form").attr('action','/admin/goods/setoff_allows');
         $("#form").submit();
     });
 })
</script>
<style type="text/css">
    .form-submit{ width: 500px; }
    .form-submit dt{ float: left; line-height: 30px; padding-right: 20px; }
    .form-submit input{ float: left; }
    .form-submit input{ width: 102px; }
    .form-submit dt span.check_count{ min-width:20px; text-align: center; display: inline-block; }
    span.blu{ width: 100%; height: 100%; display: block; cursor: pointer;}

    ul.allow_status{ height:33px;}
    ul.allow_status li{ padding:0; width:60px; height:35px; }
    ul.allow_status li label{ font-size:14px; color:#fff; line-height:32px; width:60px; height:32px; border:1px solid #ccc; display:block; text-align:center; }
    ul.allow_status li label input{ display:none;}
    ul.allow_status li.audit-cur label{ background:#00A2CA; transition:.4s all ease;}
</style>
{@/block@}
<!--头部标签区-->
{@block name=toptagss@}
{@if !$key@}
<div class="smbox-toptags">
    <a href="?deleted=" {@if $sch.deleted eq ''@}class="active"{@/if@}>全部商品</a>
    <a href="?deleted=0" {@if $sch.deleted eq '0'@}class="active"{@/if@}>仓库中</a>
    <a href="?deleted=1" {@if $sch.deleted eq '1'@}class="active"{@/if@}>已回收</a>
</div>
{@/if@}
{@/block@}
<!--表格顶部区域-->
{@block name=table_topbar@}
<div class="smbox-list-toptab">
    <form method="get">
        <a class="samao-link-btn samao-link-btn-refresh" href="javascript:window.location.reload()">刷新</a>
        <a class="samao-link-btn samao-link-btn-add" href="__SELF__/add?from={@$from@}{@if $from eq 'm'@}&merchant_id={@$sch.merchant_id@}{@/if@}">添加商品</a>&nbsp;&nbsp;&nbsp;&nbsp;
        {@form_text name="title" style="width:120px" model=$schmodel value="{@$sch.title@}" placeholder="商品名"@}
        {@form_select header="上下架" options=[[0,'已下架'],[1,'上架中']] onchange='this.form.submit();' style="width:80px" name="allow" model=$schmodel@}
        {@form_select header="所有商品" options=[[0,'仓库中'],[1,'回收站']] onchange='this.form.submit();' style="width:80px" name="deleted" model=$schmodel@}
        {@form_select header="商品类型" options=[[0,'普通'],[1,'多规格']] onchange='this.form.submit();' style="width:80px" name="is_option" model=$schmodel@}
        {@if $from neq 'm'@}
        {@form_select header="所属商家"  onchange='this.form.submit();' style="width:80px" name="merchant_id" model=$schmodel@}
        {@elseif $from eq 'm'@}
        <input type="hidden" name="merchant_id" value="{@$sch.merchant_id@}">
        {@/if@}
        {@form_select header="按销量" options=[[1,'从高到底'],[2,'从低到高']] onchange='this.form.submit();' style="width:80px" name="sale_nums" model=$schmodel@}
        <input type="submit" value="查找" class="samao-mini-btn samao-mini-btn-search"/>
       <!-- <input type="hidden" name="deleted" value="{@$deleted@}">-->
        <input type="hidden" name="from" value="{@$from@}">
    </form>
</div>
{@/block@}
<!--表头列-->
{@block name=table_ths@}
<form method="post" action="__SELF__/seton_allows" id="form">
<th width="5%">商品ID</th>
<th width="30">选择</th>
<th width="10%">商品标题</th>
<th width="10%">商户名</th>
<th width="10%">商品图</th>
<th width="5%">价格</th>
<th width="5%">库存</th>
<th width="5%">销量</th>
<th width="5%">上架状态</th>
<th width="10%">属性</th>
<th width="10%">排序</th>
<th width="20%">操作</th>
{@/block@}

<!--总列数合并单元格时可用-->
{@block name=colspan@}12{@/block@}

<!--表行列-->
{@block name=table_tds@}
<td align="center">{@$rs.id@}</td>
<td align="center" ><label for="goods_id{@$rs.id@}">
        <span class="blu"><input type="checkbox" name="goods_id[]" class="checkbox" id="goods_id{@$rs.id@}" value="{@$rs.id@}"/></span></label>
</td>
<td align="center">{@$rs.title@}</td>
<td align="center"><a data-href="/admin/merchant" href="javascript:void(0)" onclick="jump_aa()" target="Main" id="merchant">{@$rs.merchant_id|smval:'@pf_merchant':'name':'--'@}</a></td>
<td align="center"><img src="{@$rs.img|minimg:50:50:1@}" width="50"> </td>
<td align="center"><span class="org">{@$rs.market_price@}</span>￥</td>
<td align="center">{@$rs.total@}</td>
<td align="center">{@$rs.sales_real@}</td>
<td align="center">

<div class="form-box">
    <ul id="allow_status" class="allow_status samao-box samao-box-show">
        <input disabled="disabled" type="hidden" name="allow" id="allow_{@$rs.id@}" value="{@$rs.allow@}"/>
        <li id="li_0_{@$rs.id@}" class="form-control radiogroup {@if $rs.allow eq 1@}audit-cur{@/if@}" onclick="allow_on({@$rs.id@})">
            <label for="check_status_0_{@$rs.id@}" style="border-right: none; border-radius: 5px 0px 0px 5px;">
                <input disabled="disabled" type="radio" id="check_status_0_{@$rs.id@}" name="check_status_{@$rs.id@}" value="1" {@if $rs.allow eq 1@}checked="checked"{@/if@} >上架</label>
        </li>
        <li id="li_1_{@$rs.id@}" class="form-control radiogroup {@if $rs.allow eq 0@}audit-cur{@/if@}"  onclick="allow_off({@$rs.id@})">
            <label id="lab_l_{@$rs.id@}" for="check_status_1_{@$rs.id@}" style="border-left: none; border-radius: 0px 5px 5px 0px; background: {@if $rs.allow==0@}rgb(128, 128, 128){@else@}rgb(255, 255, 255){@/if@};">
                <input disabled="disabled" type="radio" id="check_status_1_{@$rs.id@}" name="check_status_{@$rs.id@}" value="0" {@if $rs.allow eq 0@}checked="checked"{@/if@}>下架</label>
        </li>
    </ul>
</div>

</td>
<!--<td align="center">{ @ $rs.allow|way @}</td>-->

<td align="center"><span class="org">{@$rs.is_new|case:['0','1']:['','新品 ']@}{@$rs.is_recommand|case:['0','1']:['','推荐 ']@}{@$rs.is_hot|case:['0','1']:['','热卖 ']@}{@$rs.is_discount|case:['0','1']:['','促销 ']@}</span></td>
<td align="center">{@$rs.sort|sortopt:$rs.id:5@}</td>
<td align="center">
    <a class="samao-link-minibtn" href="__SELF__/edit?id={@$rs.id@}">编辑</a>
    {@if $rs.is_option@}
    <a dialog="1" class="samao-link-minibtn" class="samao-link-minibtn" href="__APPROOT__/goods_spec?gid={@$rs.id@}">规格管理</a>
    <a dialog="1" class="samao-link-minibtn" class="samao-link-minibtn" href="__APPROOT__/goods_options?goods_id={@$rs.id@}&mid={@$rs.merchant_id@}">新规格管理</a>
    {@/if@}
    {@if $rs.deleted eq 0@}
    <a onclick="return confirm('确定要置入回收站吗？');" class="samao-link-minibtn" href="__SELF__/do_recycle?id={@$rs.id@}">回收</a>
    {@elseif $rs.deleted eq 1@}
    <a onclick="return confirm('确定要恢复该商品吗？');" class="samao-link-minibtn" href="__SELF__/ret_recycle?id={@$rs.id@}">恢复</a>
    {@/if@}
    <a onclick="return confirm('确定要删除吗？一旦删除将无法恢复，请谨慎操作！');" class="samao-link-minibtn" href="__SELF__/delete?id={@$rs.id@}">彻底删除</a>
</td>

{@/block@}
{@block name=information@}
</form>
<div class="form-submit" >
    <dt>已选择<span class="check_count">0</span>个</dt>
    <input type="button" class="back" value="全选"  id="btnCheckAll"/>
    <input type="submit" class="submit" value="上架" id="submit"/>
    <input type="submit" class="submit" value="下架" id="off_submit"/>
    <div style="clear:both"></div>
</div>

{@/block@}
<!--分页控件区-->
<!--分页控件区-->
{@block name=pagebar@}
<div class="samao-pagebar">{@pagebar pdata=$bar@}</div>
{@/block@}
