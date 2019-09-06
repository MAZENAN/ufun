<?php /* Smarty version Smarty-3.1.19, created on 2019-05-22 16:13:16
         compiled from ".\Apps\Admin\views\layout\camp_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:310835ce5049cd41c50-33300690%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0ce67610fbdd4672851f31a33bdb3faf6f6aa83c' => 
    array (
      0 => '.\\Apps\\Admin\\views\\layout\\camp_list.tpl',
      1 => 1491472337,
      2 => 'file',
    ),
    '4b0c8ba3e57f0c60af6144fd304396960b2ce574' => 
    array (
      0 => 'E:\\WWW\\waimai\\Web\\samao\\tpls\\model_list.tpl',
      1 => 1491473406,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '310835ce5049cd41c50-33300690',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'rows' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5ce5049d1f35f1_56431214',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5ce5049d1f35f1_56431214')) {function content_5ce5049d1f35f1_56431214($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_minimg')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\modifier.minimg.php';
if (!is_callable('smarty_modifier_sortopt')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\modifier.sortopt.php';
if (!is_callable('smarty_function_pagebar')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\function.pagebar.php';
?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
<link href="/public/samaores/css/form.plane.css" rel="stylesheet" type="text/css" />
<link href="/public/samaores/css/list.plane.css" rel="stylesheet" type="text/css" />


<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.topdialog.js"></script>
<script type="text/javascript">
function inputChange(inputid){
  $(inputid).change(function(){
    $(inputid).children("option").each(function(){
       if($(this).attr("selected")=="selected"){
        $(inputid).next().children("input").val($(this).text());
       }
    });
  });
}
/*模糊查询函数，inputid为select标签的id*/
function vagueSearch(inputid){
      $(inputid).click(function(){
        $(this).next().css("zIndex","999");
      });
      $(inputid).next().children("input").bind("input propertychange",function(){
        $(inputid).next().next().show();
        $(document).one("click",function(e){                         
            $(inputid).next().next().hide();   
            e.stopPropagation();           
        });
        $(inputid).next().next().click(function(e){
            e.stopPropagation();
        });
        $(inputid).next().next().children('ul').empty();
        $(inputid).children("option").each(function(){
            if($(this).text().indexOf($(inputid).next().children("input").val())>=0){
                var otext=$(this).text();
                $(inputid).next().next().children('ul').append("<li data-id="+$(this).val()+">"+otext+"</li>");
            }
        });
        $(inputid).next().next().children('ul').children('li').each(function() {
            $(this).click(function(){
                var thisid=$(this).data("id");
                $(inputid).next().children("input").val($(this).text());
                $(inputid).next().next().hide();
                $(inputid).children("option").each(function(){
                    if($(this).val()==thisid){
                        $(this).attr("selected","selected");
                        $(inputid).change();
                    }
                });
            });
        });
      });
}
$(document).ready(function(){	     
    inputChange(seller_id);
    if($("#camp_country").length>0){
        inputChange(camp_country);
        vagueSearch(camp_country);
    }
    if($("#destination").length>0){
        inputChange(destination);
        vagueSearch(destination);
    }  
    $("#title").keyup(function(){      	
    	 if (event.keyCode == "13") {
   　　　　　$("#camp-form").submit();
            return false;
        }
    });
    $(".samao-mini-btn-search").click(function(){
    	$("#camp-form").submit();
    });	
    /*供应商模糊查询*/
     vagueSearch(seller_id);
});   
</script>
<style>
.smbox-list-content{<?php if (!$_smarty_tpl->tpl_vars['sch']->value['key']) {?>width:1740px;<?php }?> }
#seller option{ font-size: 16px; color: #000; }
#seller{ height: 150px; overflow: auto; }
</style>


<!--samao model script-->
</head>
<body>
<div class="tablebox listbox margintop">
<div class="smbox-list-title"><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
 <span id="inputbox_loading" style="display:none">正在提交中...</span></div>
<div class="smbox-list-content">



<?php if ($_smarty_tpl->tpl_vars['sch']->value['istop']!='1') {?>
<div class="smbox-list-toptab">
<form method="get" id="camp-form">
<a class="samao-link-btn samao-link-btn-refresh" href="javascript:window.location.reload()">刷新</a>&nbsp;&nbsp;&nbsp;&nbsp;
<?php echo FormBox::text(array('name'=>"title",'placeholder'=>'请输入查找标题','style'=>"width:100px;",),$_smarty_tpl->tpl_vars['schmodel']->value);?>&nbsp;&nbsp;
<?php if (!$_smarty_tpl->tpl_vars['sch']->value['key']) {?>
<?php echo FormBox::date(array('name'=>"start",'placeholder'=>'请输入出发日期','style'=>"width:100px;",),$_smarty_tpl->tpl_vars['schmodel']->value);?>-
<?php echo FormBox::date(array('name'=>"start_to",'placeholder'=>'请输入出发日期','style'=>"width:100px;",),$_smarty_tpl->tpl_vars['schmodel']->value);?>&nbsp;&nbsp;
<?php echo FormBox::select(array('header'=>"是否截止报名",'options'=>array(array(1,'已截止'),array(2,'未截止')),'onchange'=>'this.form.submit();','name'=>"deadline",),$_smarty_tpl->tpl_vars['schmodel']->value);?>&nbsp;&nbsp;
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['sch']->value['type']=='1') {?>
    <?php if ($_smarty_tpl->tpl_vars['sch']->value['camp_countr']) {?>
    <?php $_smarty_tpl->tpl_vars['info'] = new Smarty_variable(DB::getrow('@pf_camp_country',$_smarty_tpl->tpl_vars['sch']->value['camp_country']), null, 0);?>
    <?php $_smarty_tpl->tpl_vars['country'] = new Smarty_variable($_smarty_tpl->tpl_vars['info']->value['name'], null, 0);?><?php }?>
<?php } elseif ($_smarty_tpl->tpl_vars['sch']->value['type']=='0') {?>
<?php if ($_smarty_tpl->tpl_vars['sch']->value['destination']) {?><?php $_smarty_tpl->tpl_vars['info'] = new Smarty_variable(DB::getrow('@pf_destination',$_smarty_tpl->tpl_vars['sch']->value['destination']), null, 0);?>
    <?php $_smarty_tpl->tpl_vars['cndestination'] = new Smarty_variable($_smarty_tpl->tpl_vars['info']->value['name'], null, 0);?><?php }?>
<?php }?>
<div class="address_s">
<?php if ($_smarty_tpl->tpl_vars['sch']->value['type']=='0') {?><?php echo FormBox::select(array('onchange'=>'this.form.submit();','name'=>"destination",),$_smarty_tpl->tpl_vars['schmodel']->value);?><?php } elseif ($_smarty_tpl->tpl_vars['sch']->value['type']=='1') {?><?php echo FormBox::select(array('header'=>"选择目的地",'onchange'=>'this.form.submit();','name'=>"camp_country",),$_smarty_tpl->tpl_vars['schmodel']->value);?><?php }?>&nbsp;&nbsp;
<div class="address_cont">
    <?php if ($_smarty_tpl->tpl_vars['sch']->value['type']=='0') {?>
    <input placeholder='选择目的地' autocomplete="off" name="cndestination" value="<?php echo $_smarty_tpl->tpl_vars['cndestination']->value;?>
" class="form-control text" style="width:92px;"/><?php } elseif ($_smarty_tpl->tpl_vars['sch']->value['type']=='1') {?>
    <input placeholder='选择目的地' autocomplete="off" name="country" value="<?php echo $_smarty_tpl->tpl_vars['country']->value;?>
" class="form-control text" style="width:92px;"/><?php }?>
</div>
<div class="address_select">
    <ul></ul>
</div>
</div>
<?php if ($_smarty_tpl->tpl_vars['sch']->value['key']==2) {?><?php echo FormBox::select(array('onchange'=>'this.form.submit();','name'=>"destination",),$_smarty_tpl->tpl_vars['schmodel']->value);?><?php } elseif ($_smarty_tpl->tpl_vars['sch']->value['key']=='1') {?><?php echo FormBox::select(array('onchange'=>'this.form.submit();','name'=>"camp_country",),$_smarty_tpl->tpl_vars['schmodel']->value);?><?php }?>&nbsp;&nbsp;
<?php if (!$_smarty_tpl->tpl_vars['sch']->value['key']) {?>
<?php echo FormBox::select(array('options'=>array(array(0,'选择时间长短'),array(1,'1天'),array(2,'2天'),array(3,'3-5天'),array(4,'6-8天'),array(5,'9-14天'),array(6,'15天及以上')),'onchange'=>'this.form.submit();','name'=>"camp_days",),$_smarty_tpl->tpl_vars['schmodel']->value);?>&nbsp;&nbsp;

<br/><div class="martop_10"></div>
<a class="samao-link-btn samao-link-btn-add" href="<?php if (!$_smarty_tpl->tpl_vars['sch']->value['key']) {?>/admin/camp<?php } else { ?>/admin/supplier_camp<?php }?>/add?type=<?php echo $_smarty_tpl->tpl_vars['sch']->value['type'];?>
">新增</a>&nbsp;&nbsp;&nbsp;&nbsp;
<?php echo FormBox::select(array('header'=>"选择是否上架",'options'=>array(array(1,'上架'),array(3,'下架')),'onchange'=>'this.form.submit();','name'=>"allow",),$_smarty_tpl->tpl_vars['schmodel']->value);?>&nbsp;&nbsp;
<?php echo FormBox::select(array('options'=>array(array(1,'正常排序'),array(2,'点击量升序'),array(3,'点击量降序'),array(4,'费用升序'),array(5,'费用降序'),array(6,'订金升序'),array(7,'订金降序'),array(8,'截止日期升序'),array(9,'截止日期降序'),array(10,'修改时间升序'),array(11,'修改时间降序')),'onchange'=>'this.form.submit();','name'=>"order",),$_smarty_tpl->tpl_vars['schmodel']->value);?>&nbsp;&nbsp;

<?php }?>
<?php echo FormBox::select(array('header'=>"活动时间",'options'=>DB::getopts('@pf_camp_holiday'),'onchange'=>'this.form.submit();','name'=>"camp_holiday",),$_smarty_tpl->tpl_vars['schmodel']->value);?>&nbsp;&nbsp;
<?php echo FormBox::select(array('onchange'=>'this.form.submit();','name'=>"camp_type",),$_smarty_tpl->tpl_vars['schmodel']->value);?>&nbsp;&nbsp;
<?php if ($_smarty_tpl->tpl_vars['sch']->value['key']==2||$_smarty_tpl->tpl_vars['sch']->value['type']=='0') {?>
<?php echo FormBox::select(array('header'=>"活动主题",'options'=>DB::getopts('@pf_theme','id,name',0),'onchange'=>'this.form.submit();','name'=>"theme",'value'=>((string)$_smarty_tpl->tpl_vars['sch']->value['theme']),),$_smarty_tpl->tpl_vars['model']->value);?>&nbsp;&nbsp;
<?php } else { ?>
<?php echo FormBox::select(array('header'=>"活动主题",'options'=>DB::getopts('@pf_camp_category','id,name',0),'onchange'=>'this.form.submit();','name'=>"camp_category",'value'=>((string)$_smarty_tpl->tpl_vars['sch']->value['camp_category']),),$_smarty_tpl->tpl_vars['model']->value);?>&nbsp;&nbsp; 
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['seller_id']->value) {?><?php $_smarty_tpl->tpl_vars['info'] = new Smarty_variable(DB::getrow('@pf_member',$_smarty_tpl->tpl_vars['seller_id']->value), null, 0);?>
<?php $_smarty_tpl->tpl_vars['seller'] = new Smarty_variable($_smarty_tpl->tpl_vars['info']->value['nickname'], null, 0);?><?php }?>
<div class="supplier"> <?php echo FormBox::select(array('onchange'=>'this.form.submit();','name'=>"seller_id",),$_smarty_tpl->tpl_vars['schmodel']->value);?>&nbsp;&nbsp; 
<div class="seller_cont">
<input placeholder='选择供应商' autocomplete="off" name="seller" value="<?php echo $_smarty_tpl->tpl_vars['seller']->value;?>
" class="form-control text" style="width:160px;"/>
</div>
<div class="seller_select">
	<ul></ul>
</div>
</div>
<?php if ($_smarty_tpl->tpl_vars['sch']->value['key']) {?>
<br/><div class="martop_10"></div>
<a class="samao-link-btn samao-link-btn-add" href="/admin/supplier_camp/add?type=<?php if ($_smarty_tpl->tpl_vars['sch']->value['key']==2) {?>0<?php } else { ?>1<?php }?>">新增</a>&nbsp;&nbsp;&nbsp;&nbsp;
年龄：&nbsp<?php ob_start();?><?php if ($_smarty_tpl->tpl_vars['sch']->value['agefrom']!='') {?><?php echo (string)$_smarty_tpl->tpl_vars['sch']->value['agefrom'];?><?php }?><?php $_tmp1=ob_get_clean();?><?php echo FormBox::amountdigits(array('placeholder'=>"开始年龄",'value'=>$_tmp1,'name'=>"agefrom",),$_smarty_tpl->tpl_vars['model']->value);?>&nbsp;
至&nbsp;<?php ob_start();?><?php if ($_smarty_tpl->tpl_vars['sch']->value['ageto']!='') {?><?php echo (string)$_smarty_tpl->tpl_vars['sch']->value['ageto'];?><?php }?><?php $_tmp2=ob_get_clean();?><?php echo FormBox::amountdigits(array('placeholder'=>"结束年龄",'value'=>$_tmp2,'name'=>"ageto",),$_smarty_tpl->tpl_vars['model']->value);?>&nbsp;&nbsp;&nbsp;
<?php echo FormBox::select(array('header'=>"所属人员",'options'=>DB::getopts('@pf_manage','id,name',0,"type in(8) and islock = 0"),'onchange'=>'this.form.submit();','name'=>"parent_id",'value'=>((string)$_smarty_tpl->tpl_vars['sch']->value['parent_id']),),$_smarty_tpl->tpl_vars['model']->value);?>&nbsp;&nbsp;&nbsp;
<?php echo FormBox::select(array('header'=>"产品状态",'options'=>array(array(3,'下架'),array(1,'上架'),array(2,'预上架')),'onchange'=>'this.form.submit();','name'=>"allow",'value'=>((string)$_smarty_tpl->tpl_vars['sch']->value['allow']),),$_smarty_tpl->tpl_vars['model']->value);?>&nbsp;&nbsp;&nbsp;
<?php echo FormBox::select(array('options'=>array(array(0,'有效'),array(1,'无效')),'onchange'=>'this.form.submit();','name'=>"disabled",'value'=>((string)$_smarty_tpl->tpl_vars['sch']->value['disabled']),),$_smarty_tpl->tpl_vars['model']->value);?>&nbsp;&nbsp;

<?php }?>
<input type="button" value="查找" class="samao-mini-btn samao-mini-btn-search"/>&nbsp;&nbsp;
<input type="hidden" name="type" value="<?php echo $_smarty_tpl->tpl_vars['sch']->value['type'];?>
" />
<input type="hidden" name="istop" value="<?php echo $_smarty_tpl->tpl_vars['sch']->value['istop'];?>
" />
<input type="hidden" name="state" value="<?php echo $_smarty_tpl->tpl_vars['sch']->value['state'];?>
" />
<input type="hidden" name="key" value="<?php echo $_smarty_tpl->tpl_vars['sch']->value['key'];?>
" />
</form>
</div>
<?php }?>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="smbox-list-table" id="smbox-list-table">
<tr>

<th width="60">ID</th>
<?php if (!$_smarty_tpl->tpl_vars['sch']->value['key']) {?>
<th width="80">封面图片</th>
<?php }?>
<th width="240">标题</th>
<!-- <th width="80">项目主题</th> -->
<th width="70">目的地</th>
<?php if (!$_smarty_tpl->tpl_vars['sch']->value['key']) {?>
<th width="70">费用</th>
<th width="80">起始日期</th>
<th width="60">适合年龄</th>
<?php } else { ?>
<th width="80">状态</th>
<?php }?>
<th width="180">修改时间</th>
<?php if (!$_smarty_tpl->tpl_vars['sch']->value['key']) {?>
<th width="80">BD</th>
<?php } else { ?>
<th width="80">所属人员</th>
<?php }?>
<th width="120">供应商</th>
<?php if (!$_smarty_tpl->tpl_vars['sch']->value['key']) {?>
<th width="70">产品等级</th>
<th width="130">权重值</th>
<th width="70">是否上架</th>
<?php }?>
<!--<th width="70">点击量</th>-->
<th <?php if (!$_smarty_tpl->tpl_vars['sch']->value['key']) {?>width="240"<?php } else { ?>width="130"<?php }?>}>操作</th>

</tr>
<?php  $_smarty_tpl->tpl_vars['rs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rs']->_loop = false;
 $_smarty_tpl->tpl_vars['ttl'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['rows']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rs']->key => $_smarty_tpl->tpl_vars['rs']->value) {
$_smarty_tpl->tpl_vars['rs']->_loop = true;
 $_smarty_tpl->tpl_vars['ttl']->value = $_smarty_tpl->tpl_vars['rs']->key;
?>
<tr  onmouseover="this.oldBgcolor=this.style.backgroundColor;this.style.backgroundColor='#FCFCF8';" onmouseout="this.style.backgroundColor=this.oldBgcolor">

<form method="post">
<input name="id" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
" />
<input name="action" type="hidden" value="editsort" />
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
</td>
<?php if (!$_smarty_tpl->tpl_vars['sch']->value['key']) {?>
<td align="center"><img src="<?php echo smarty_modifier_minimg($_smarty_tpl->tpl_vars['rs']->value['cover'],79,50,1);?>
" height="50" width="79"/></td>
<?php }?>
<td><a href="/<?php if ($_smarty_tpl->tpl_vars['rs']->value['type']=='0') {?>cncamp<?php } elseif ($_smarty_tpl->tpl_vars['rs']->value['type']=='1') {?>glcamp<?php }?>-<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
.html" target="_blank"><?php echo $_smarty_tpl->tpl_vars['rs']->value['title'];?>
</a></td>
<!-- <td align="center"><?php echo DB::getval('@pf_theme','name',$_smarty_tpl->tpl_vars['rs']->value['theme']);?>
</td> -->
<?php if ($_smarty_tpl->tpl_vars['rs']->value['type']=='0') {?><td align="center"><?php echo DB::getval('@pf_destination','name',$_smarty_tpl->tpl_vars['rs']->value['destination']);?>
</td><?php } elseif ($_smarty_tpl->tpl_vars['rs']->value['type']=='1') {?><td align="center"><?php echo DB::getval('@pf_camp_country','name',$_smarty_tpl->tpl_vars['rs']->value['camp_country']);?>
</td><?php }?>
<?php if (!$_smarty_tpl->tpl_vars['sch']->value['key']) {?>
<td align="center">￥<?php echo $_smarty_tpl->tpl_vars['rs']->value['ncost'];?>
</td>
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['start'];?>
</td>
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['agefrom'];?>
-<?php echo $_smarty_tpl->tpl_vars['rs']->value['ageto'];?>
岁</td>
<?php } else { ?>
<td align="center"><?php echo ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['rs']->value['allow'],array(0,1,2))) && array_key_exists($_tempkey,$_temparr=array('下架','上架','预上架'))?$_temparr[$_tempkey]:'');?>
</td>
<?php }?>
<td align="center"><?php if ($_smarty_tpl->tpl_vars['rs']->value['modifytime']) {?><?php echo $_smarty_tpl->tpl_vars['rs']->value['modifytime'];?>
<?php } else { ?><?php echo $_smarty_tpl->tpl_vars['rs']->value['addtime'];?>
<?php }?></td>
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['bd'];?>
</td>
<td align="center"><a href="/admin/member/edit?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['seller_id'];?>
" ><?php echo $_smarty_tpl->tpl_vars['rs']->value['seller'];?>
</a></td>
<?php if (!$_smarty_tpl->tpl_vars['sch']->value['key']) {?>
<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['level'];?>
</td>
<td align="center"><?php echo smarty_modifier_sortopt($_smarty_tpl->tpl_vars['rs']->value['sort'],$_smarty_tpl->tpl_vars['rs']->value['id'],1);?>
</td>
<td align="center"><?php echo ($_smarty_tpl->tpl_vars['rs']->value['allow']==1?'<img src="/public/samaores/images/yes.gif" />':'<img src="/public/samaores/images/no.gif" />');?>
</td>
<!--<td align="center"><?php echo $_smarty_tpl->tpl_vars['rs']->value['click'];?>
</td>-->
<?php }?>
<td align="center">
<?php if (!$_smarty_tpl->tpl_vars['sch']->value['key']) {?>
<a dialog="1" class="samao-link-minibtn" href="/admin/cdep_date?campid=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">出发日期</a>
<a dialog="1" class="samao-link-minibtn" href="/admin/schedule?campid=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">日程安排</a>
<a class="samao-link-minibtn" href="/admin/camp/set<?php if ($_smarty_tpl->tpl_vars['rs']->value['allow']==1) {?>off<?php } else { ?>on<?php }?>_allow?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
"><?php if ($_smarty_tpl->tpl_vars['rs']->value['allow']==0) {?>上架<?php } else { ?>下架<?php }?></a>
<a class="samao-link-minibtn" href="/admin/camp/edit?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">编辑</a>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['sch']->value['key']) {?>
<a class="samao-link-minibtn" href="/admin/supplier_camp/edit?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">编辑</a>
<?php if ($_smarty_tpl->tpl_vars['rs']->value['allow']!=2) {?>
<a class="samao-link-minibtn" href="/admin/camp/edit?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">产品详情</a>
<?php } elseif ($_smarty_tpl->tpl_vars['rs']->value['allow']==2) {?>
<a class="samao-link-minibtn" href="/admin/camp/edit?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">发布上架</a>
<a onclick="return confirm('确定要删除了吗？');" class="samao-link-minibtn" href="/admin/supplier_camp/delete?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">删除</a>
<?php }?>
<?php } else { ?>
<a onclick="return confirm('确定要删除了吗？');" class="samao-link-minibtn" href="/admin/camp/delete?id=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">删除</a>
<?php }?>
<a dialog="1" class="samao-link-minibtn" href="/admin/camp_diary?campid=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
">营地相册</a>
</td>
</form>


</tr>
<?php } ?>

</table>

<div class="samao-pagebar"><?php echo smarty_function_pagebar(array('pdata'=>$_smarty_tpl->tpl_vars['bar']->value),$_smarty_tpl);?>
</div>

</div>
<div class="smbox-info-tips">


</div>
</div>

</body>
</html><?php }} ?>
