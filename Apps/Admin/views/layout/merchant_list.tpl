{@extends file='@model_list.tpl'@}
<!--标题-->
{@block name=title@}商户列表{@/block@}
{@block name=head@}
<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.topdialog.js"></script>
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
                alert('请选择商户！');
                return;
            }
            $("#form").submit();
        });
        $("#off_submit").live('click',function(){
            if(count==0){
                alert('请选择商户！');
                return;
            }
            $("#form").attr('action','/admin/merchant/setoff_allows');
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
</style>
{@/block@}

<!--表格顶部区域-->
{@block name=table_topbar@}
<div class="smbox-list-toptab">
    <form method="get">
        <a class="samao-link-btn samao-link-btn-refresh" href="javascript:window.location.reload()">刷新</a>&nbsp;
        <a class="samao-link-btn samao-link-btn-add" href="__SELF__/add">新增商户</a>&nbsp;&nbsp;&nbsp;&nbsp;
        {@form_text name="name" style="width:120px" placeholder="商户名" value="{@$sch.name@}" model=$schmodel@}
        {@form_text name="phone" style="width:120px" placeholder="联系电话" value="{@$sch.phone@}" model=$schmodel@}
        {@form_select header="营业状态" options=[[0,'关闭'],[1,'营业']] onchange='this.form.submit();' name="allow" model=$schmodel@}
        {@form_select header="入驻状态" options=[[0,'待审核'],[1,'入驻成功'],[2,'入驻失败'],[3,'停止入驻']] onchange='this.form.submit();' name="status" model=$schmodel@}
        {@form_select header="店铺类型" options=[[0,'普通类型'],[1,'自营类型']] onchange='this.form.submit();' name="type" model=$schmodel@}
        <input type="submit" value="查找" class="samao-mini-btn samao-mini-btn-search"/>
    </form>
</div>
{@/block@}

<!--表头列-->
{@block name=table_ths@}
<form method="post" action="__SELF__/seton_allows" id="form">
<th width="30">ID</th>
<th width="30">选择</th>
<th width="10">商户名</th>
<th width="10">logo</th>
<!--<th width="10%">所属人用户名</th>-->
<!--<th width="10%">所属人电话</th>-->
<th width="10">入驻状态</th>
<th width="30">营业状态</th>
<th width="10">联系人</th>
<th width="10">联系手机</th>
<th width="10">店铺类型</th>
<th width="80">操作</th>
{@/block@}

<!--总列数合并单元格时可用-->
{@block name=colspan@}10{@/block@}

<!--表行列-->
{@block name=table_tds@}
<td align="center">{@$rs.id@}</td>
<td align="center" ><label for="merch_id{@$rs.id@}">
    <span class="blu"><input type="checkbox" name="merch_id[]" class="checkbox" id="merch_id{@$rs.id@}" value="{@$rs.id@}"/></span></label>
</td>
<td align="center">{@$rs.name@}</td>
<td align="center"><img src="{@$rs.logo|minimg:50:50:1@}" alt="logo"></td>
<!--<td align="center">{ @$rs.user_id|smval:'@pf_member':'username'@}</td>-->
<!--<td align="center">{ @$rs.user_id|smval:'@pf_member':'mobile'@}</td>-->
<td align="center">{@$rs.status|case:['0','1','2','3']:['未入驻','入驻成功','入驻失败','暂停中']@}</td>
<td align="center">{@$rs.allow|way@}</td>
<td align="center">{@$rs.contact_name@}</td>
<td align="center">{@$rs.phone@}</td>
<td align="center">{@$rs.type|case:[0,1]:['普通类型','自营类型']@}</td>
<td align="center">
    <a dialog="1" class="samao-link-minibtn" href="/admin/seller_menu/index?mid={@$rs.id@}">商品分类管理</a>
    <a dialog="1" class="samao-link-minibtn" href="/admin/goods/index?from=m&merchant_id={@$rs.id@}">商品管理</a>
   <!-- <a dialog="1" class="samao-link-minibtn" href="/admin/order_stop/index?merchant_id={ @$rs.id@}">截单设置</a>-->
    <a dialog="1" class="samao-link-minibtn" href="/admin/delivery/index?merchant_id={@$rs.id@}">配送时间</a>
    <a dialog="1" class="samao-link-minibtn" href="/admin/notice/index?type=1&merchant_id={@$rs.id@}">店内公告</a>
    <!--<a dialog="1" class="samao-link-minibtn" href="__SELF__/show?id={@$rs.id@}">详情</a>-->
    {@if $rs.allow == 0@}<a class="samao-link-minibtn" href="__SELF__/seton_allow?id={@$rs.id@}">开启营业</a>
    {@else@}<a class="samao-link-minibtn" onclick="return confirm('确定要暂停营业吗？');" href="__SELF__/setoff_allow?id={@$rs.id@}">暂停营业</a>
    {@/if@}
    <a class="samao-link-minibtn" href="__SELF__/edit?id={@$rs.id@}">编辑</a>
    <a onclick="return confirm('确定要删除吗？一旦删除将无法恢复，请谨慎操作！');" class="samao-link-minibtn" href="__SELF__/delete?id={@$rs.id@}">删除</a>
</td>
{@/block@}
{@block name=information@}
</form>
<div class="form-submit" >
    <dt>已选择<span class="check_count">0</span>个</dt>
    <input type="button" class="back" value="全选"  id="btnCheckAll"/>
    <input type="submit" class="submit" value="上线营业" id="submit"/>
    <input type="submit" class="submit" value="暂停营业" id="off_submit"/>
    <div style="clear:both"></div>
</div>

{@/block@}
<!--分页控件区-->
<!--分页控件区-->
{@block name=pagebar@}
	<div class="samao-pagebar">{@pagebar pdata=$bar@}</div>
{@/block@}
