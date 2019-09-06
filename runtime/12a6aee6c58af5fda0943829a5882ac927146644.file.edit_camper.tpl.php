<?php /* Smarty version Smarty-3.1.19, created on 2019-05-08 15:03:30
         compiled from ".\Apps\Admin\views\edit_camper.tpl" */ ?>
<?php /*%%SmartyHeaderCode:238025cd27f42f2b757-75334174%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '12a6aee6c58af5fda0943829a5882ac927146644' => 
    array (
      0 => '.\\Apps\\Admin\\views\\edit_camper.tpl',
      1 => 1491472342,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '238025cd27f42f2b757-75334174',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'client' => 0,
    'students' => 0,
    'kid' => 0,
    'id' => 0,
    'member' => 0,
    'model' => 0,
    'rd' => 0,
    'client_record' => 0,
    'c' => 0,
    'children' => 0,
    'ch' => 0,
    'i' => 0,
    'kids' => 0,
    'client_id' => 0,
    'genearch' => 0,
    'gen' => 0,
    'm' => 0,
    'parents' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5cd27f432e08f9_40574547',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5cd27f432e08f9_40574547')) {function content_5cd27f432e08f9_40574547($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>会员详情</title>
<link rel="stylesheet" type="text/css" href="/public/samaores/css/form.plane.css"/>
<link href="/public/samaores/css/list.default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.validate.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.topdialog.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $(".form-group").each(function(){
      var fbox2=$(this).children(".form-box2").children();
      var fbox1=$(this).children(".form-box1").text();
      var fbox1_1=$(this).children(".form-box1");
      $(this).children(".addright").click(function(){
           fbox2.val(fbox1);   
           fbox2.find("option").each(function(index, el) {
             if(fbox1==$(this).text()){
              $(this).attr("selected","selected");  
              fbox2.change();
             }
           });
           $("#linkage_area select").eq(0).children().each(function(){
             var area_val=$(this).text();
             if(fbox1_1.children().eq(0).text()==area_val){
                   $(this).attr("selected","selected");  
                   $("#linkage_area select").eq(0).change();                
             }
           });          
           $("#linkage_area select").eq(1).children().each(function(){
             var area_val=$(this).text();
             if(fbox1_1.children().eq(1).text()==area_val){
                   $(this).attr("selected","selected");  
                   $("#linkage_area select").eq(1).change();                 
             }
           });
      });
    });
   $(".add_children_btn").click(function(){
        $("#box_add_child").toggle();
        $(document).scrollTop($("#box_add_child").offset().top);
        $(document).scrollLeft($("#box_add_child").offset().left);
        });
   $(".add_parents_btn").click(function(){
        $("#box_add_parent").toggle();
        $(document).scrollTop($("#box_add_parent").offset().top);
        $(document).scrollLeft($("#box_add_parent").offset().left);
        });
   $("#box_add_child h3 a").click(function() {
        $("#box_add_child").toggle();
       });
   $("#box_add_parent h3 a").click(function() {
        $("#box_add_parent").toggle();
       });
});
</script>
<style type="text/css">
body{ font-size: 14px; color: #333; }
h1,h2,h3,h4,h5{ font-weight: normal; margin: 0;}
ul{ padding: 0; margin: 0; }
li{ list-style: none; }
.client_show_head{float: left; background: #fff; border-radius: 5px; border:1px solid #D8D8D9; padding: 15px 10px 15px 40px; overflow: hidden; margin-bottom: 20px; }
.client_show_head .head_name{ float: left; padding-top: 5px; margin-right: 50px; }
.client_show_head .head_name img{ float: left; height: 60px; }
.client_show_head .head_name h2{ float: left; color: #333; font-size: 24px; margin: 0; padding-left: 20px;  }
.client_show_head .head_name h2 p{ margin: 0; min-height: 31px; }
.client_show_head .head_name h2 span{ display: block; font-size: 14px; color: #999; margin-top: 7px; max-width: 158px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
.client_show_head ul{ float: left; padding: 0 10px 0 40px; position: relative; }
.client_show_head ul:before{ position: absolute; display: block; content: ""; border-left: 2px solid #F1F0EE; height: 54px;left: 0; top: 50%; margin-top: -27px; }
.client_show_head ul li{ font-size: 14px; color: #333; list-style: none; position: relative; padding-left: 20px; line-height: 25px; height: 25px; width: 160px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;} 
.client_show_head ul li:before{ display: block; content: ""; width: 10px; height: 10px; border-radius: 5px; background: #93c5f0;position: absolute; left: 0; top: 50%; margin-top: -5px; }
.client_show_edit{ float: left; background: #fff; margin:10px 0 0 20px; }
.client_show_edit a{ width: 80px; height: 80px; border-radius: 5px; border:1px solid #288ce2; text-align: center; font-size: 14px; color: #288ce2; display: -webkit-box; -webkit-box-align:center; -webkit-box-pack: center; background: url(../../public/images/icon_back.png) no-repeat scroll center 15px; }
.client_show_edit a:hover{ color: #0066c9; border-color: #0066c9; background: url(../../public/images/icon_back_hover.png) no-repeat scroll center 15px;  }
.client_show_edit a img{ visibility: hidden; }
.client_btn{ float: left; width: 300px; margin-top: 10px; }
.client_btn a{ display:inline-block; width: 120px; height: 30px; line-height: 30px; border-radius: 5px; border:1px solid #288ce2; text-align: center; background: #fff; margin:0 0 18px 20px; color: #288ce2; }
.client_btn a:hover{ color: #0066c9; border-color: #0066c9; }
.cls{ clear: both; }
.fl{ float: left; }
.fr{ float: right; }
i{ font-style: normal; }
.client_left{ width: 500px; }
.client_center{ width: 300px; }
.client_right{width: 300px;}
.client_box{ margin:0 20px 20px 0; }
.client_box h3{ position: relative; height: 38px; line-height: 38px; background: #288ce2; text-align: center; color: #fff; font-size: 16px; }
.client_box h3 a{ position: absolute; right: 20px; display: block; background: #fff; border-radius: 3px; font-size: 14px; color: #ff8800; width: 80px; height: 30px; line-height: 30px; top: 50%; margin-top: -15px; cursor: pointer; }
.client_box .client_list{ background: #fff; padding: 15px 0px; overflow: hidden; border:1px solid #288ce2; }
.client_box .client_list ul li{ line-height: 25px; position: relative; padding:10px 20px;}
.client_box .client_list ul li:hover{ background: #fcfcf8; }
.client_box_follow .client_list ul li:hover{ background: none; }
.client_box .client_list ul li ul li.form-control{ padding: 0; width: 96px !important; margin-bottom: 3px; }
.client_box .client_list ul li span{ position: absolute; left: 20px; top: 10px; color: #666; }
.client_box .client_list ul li dl{ padding-left: 190px; margin:0; word-wrap: break-word; }
.client_box .client_list ul li dl i{ color: #999 }
.client_box .client_list ul h4{ background: #288ce2; width: 100px; text-align: center; line-height: 25px; color: #fff; position: relative;}
.client_box .client_list ul h4:after{ position: absolute; display: block; content: "";width: 540px; border-bottom: 1px dotted #ddd; right: -560px; top: 50%; }
.client_center .client_list ul li{ padding-left: 30px;padding-bottom: 20px; }
.client_box .client_list ul li dl .form-control{ width: 470px; }
.client_box .client_list ul li dl select.form-control{ width: 476px; }
.client_box .client_list ul .form-group{ border-bottom:0; padding: 5px 0; position: relative; }
.form-group .form-box2 textarea,.form-group .form-box2 input{ width: 250px !important; }
.form-group .form-box2 select{ width: 100px; float: left; margin-right: 10px; }
.form-group .form-box2 select#Nationality,.form-group .form-box2 select#school_type{ width: 256px; }
.form-group .form-box2 ul li{ width: 50%; float: left; padding: 0; }
.form-group .form-box2 ul li input{ width: auto !important; }
.form-group .form-box2 ul{ width: 250px; }
.form-group .form-box2{ padding-left: 32px; }
.client_list ul li h5{ color: #999; font-size: 14px; position: relative;}
.client_center .client_list ul{ position: relative; }
.client_center .client_list ul:before{ display: block; content: ""; position: absolute; left: 16px; top: 10px; border-left: 1px dashed #ddd; height: 100%; }
.client_list ul li h5:before{ display: block; content: ""; width: 11px; height: 11px; border-radius: 5px; background: #93c5f0;position: absolute; left: -19px; top: 50%; margin-top: -5px; }
.client_center .client_list ul li p{ margin: 0; }
.client_right ul dd{ color: #288ce2; padding:0 0 15px 30px; margin: 0;  }
.client_50{ width: 700px; }
.client_50 .client_list ul li dl{ padding-left: 160px;  }
.samao-body{ width: 1400px; }
.client_list .form-label{ width: 120px; padding-left: 20px; }
.client_list .form-box1{ width: 210px; }
.client_box_follow .client_list ul{ padding-left: 20px; }
.client_box_follow .client_list ul li{ position: relative;}
.client_box_follow .client_list ul li:before{ display: block; content: ""; position: absolute; left: 6px; top: 27px; border-left: 1px dashed #ddd; height: 100%; }
.client_box_follow .client_list ul li h5{ color: #333; width: 210px; float: left; }
.client_box_follow .client_list ul li.add_follow{ clear: both; }
.client_box_follow .client_list ul li h5 i{ color: #999; width: 50%; display: inline-block; }
.client_box_follow .client_list ul li h5:before{ top: 13px; }
.client_box_follow .client_list ul li p{ float: left; width: 400px; margin: 0; }
.client_box_follow .client_list ul li.add_follow h5 a{ display: block; width: 120px; height: 30px; text-align: center; line-height: 30px; color: #ff8800; border-radius: 3px; border:1px solid #ff8800; }
.client_box_follow .client_list ul li.add_follow h5 a:hover{ color: #ff5500; border-color: #ff5500; }
.client_box_follow .client_list ul li.add_follow:before{ display: none; }
.form-submit-one{ width: 110px; }
.form-submit-one input.submit{ background: #288ce2; }
.form-submit-one input.submit:hover{ background: #0066c9; }
#box_add_parent,#box_add_child{ display: none; }
.addright{ width: 24px; height: 24px; border-radius: 3px; border:1px solid #ddd; font-size: 0; display: block; position: absolute; cursor:pointer; top: 50%; margin-top: -12px; }
.addright:after{position: absolute;
    content: "";
    display: block;
    color: #ddd;
    border-top: 6px solid transparent;
    border-bottom: 6px solid transparent;
    border-left: 8px solid;
    top: 50%;
    margin-top: -6px;
    width: 0px;
    height: 0px;
    left: 50%;
    margin-left: -3px;}
ul.samao-box{ margin:0; }
.form-group .form-box2 input[type=radio]{ -webkit-appearance: none; border:1px solid #d9d9d9; border-radius: 50%; width: 16px !important; height: 16px; float: left; position: relative; top: 1px;}
.form-group .form-box2 input[type=radio]:checked{ border:3px solid #00a2ca; }
input[type=checkbox]{ border-radius: 2px; width: 16px; height: 16px; -webkit-appearance: none; border:1px solid #d9d9d9; margin: 0 3px 0 0; position: relative; top: 3px;  }
input[type=checkbox]:checked{ background: url(../../public/images/checkbox.png) no-repeat; border:0; background-size: 16px; border:0; }

</style>
</head>
<body>
<div class="samao-body">
  <div class="client_show_head">  
    <div class="head_name">
   <?php if ($_smarty_tpl->tpl_vars['client']->value['gender']==1) {?>
    <img src="../../public/images/icon_head2.png">
    <?php } else { ?>
     <img src="../../public/images/icon_head.png">
    <?php }?>
    <h2><p><?php echo $_smarty_tpl->tpl_vars['client']->value['name'];?>
</p> 
          <?php if ($_smarty_tpl->tpl_vars['client']->value['wname']) {?><span>微信昵称：<?php echo $_smarty_tpl->tpl_vars['client']->value['wname'];?>
</span><?php }?></h2>   
    </div>
    <?php  $_smarty_tpl->tpl_vars['kid'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['kid']->_loop = false;
 $_from = array_slice($_smarty_tpl->tpl_vars['students']->value,0,2); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['kid']->key => $_smarty_tpl->tpl_vars['kid']->value) {
$_smarty_tpl->tpl_vars['kid']->_loop = true;
?>
    <ul>
      <li>孩子: <?php echo $_smarty_tpl->tpl_vars['kid']->value['c_name'];?>
</li>
      <li><?php if ($_smarty_tpl->tpl_vars['kid']->value['age']) {?><?php echo $_smarty_tpl->tpl_vars['kid']->value['age'];?>
岁<?php }?> <?php echo ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['kid']->value['c_gender'],array('0','1'))) && array_key_exists($_tempkey,$_temparr=array('女孩','男孩'))?$_temparr[$_tempkey]:'');?>
</li>
      <li><?php echo $_smarty_tpl->tpl_vars['kid']->value['school'];?>
</li>
    </ul>
    <?php } ?>
  </div>
  <div class="client_show_edit"><a href="/admin/member/client_show?id=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
"><img src="../../public/images/icon_back.png"><br/>返回</a></div>
  <div class="client_btn">
    <a href="javascript:()" class="add_children_btn">新增学生营员</a>
     <a dialog="1"  href="/admin/member/addRord?client_id=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
&type=<?php if ($_smarty_tpl->tpl_vars['member']->value['type']==1) {?>1<?php } elseif ($_smarty_tpl->tpl_vars['member']->value['type']==3||$_smarty_tpl->tpl_vars['member']->value['type']==4) {?>3<?php }?>&flag=1">新增跟进记录</a>
      <a href="javascript:()" class="add_parents_btn">新增家长营员</a>
  </div>
  <div class="cls"></div>
  <div class="client_50 fl">
    <div class="client_box">
        <h3>会员资料</h3>
        <div class="client_list">
            <form action="/admin/member/saveMember" method="post">
          <ul>
          <div class="form-group">
            <label class="form-label">姓名</label>
            <div class="form-box form-box1"><?php echo $_smarty_tpl->tpl_vars['member']->value['name'];?>
</div>
            <a class="addright">添加</a>
            <div class="form-box form-box2"><?php echo FormBox::text(array('name'=>'name','class'=>'form-control text',),$_smarty_tpl->tpl_vars['model']->value);?></div>
          </div>  
          <div class="form-group">
            <label class="form-label">昵称</label>
            <div class="form-box form-box1"><?php echo $_smarty_tpl->tpl_vars['member']->value['nickname'];?>
</div>
            <a class="addright">添加</a>
            <div class="form-box form-box2"><?php echo FormBox::text(array('name'=>'nickname','class'=>'form-control text',),$_smarty_tpl->tpl_vars['model']->value);?></div>
          </div>  
          <div class="form-group">
            <label class="form-label">性别</label>
            <div class="form-box form-box1"><?php echo ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['member']->value['gender'],array('0','1'))) && array_key_exists($_tempkey,$_temparr=array('女','男'))?$_temparr[$_tempkey]:'');?>
</div>
            <a class=""></a>
            <div class="form-box form-box2"><?php echo FormBox::radiogroup(array('name'=>'gender','class'=>'form-control ',),$_smarty_tpl->tpl_vars['model']->value);?></div>
          </div>
          <div class="form-group">
            <label class="form-label">手机号码</label>
            <div class="form-box form-box1"><?php echo $_smarty_tpl->tpl_vars['member']->value['mobile'];?>
</div>
            <a class="addright">添加</a>
            <div class="form-box form-box2"><?php echo FormBox::text(array('name'=>'mobile','class'=>'form-control text',),$_smarty_tpl->tpl_vars['model']->value);?></div>
          </div>
          <div class="form-group">
            <label class="form-label">微信号（或关联手机号）</label>
            <div class="form-box form-box1"><?php echo $_smarty_tpl->tpl_vars['member']->value['webchat'];?>
</div>
            <a class="addright">添加</a>
            <div class="form-box form-box2"><?php echo FormBox::text(array('name'=>'webchat','class'=>'form-control text',),$_smarty_tpl->tpl_vars['model']->value);?></div>
          </div>
          <div class="form-group">
            <label class="form-label">微信昵称</label>
            <div class="form-box form-box1"><?php echo $_smarty_tpl->tpl_vars['member']->value['wname'];?>
</div>
            <a class="addright">添加</a>
            <div class="form-box form-box2"><?php echo FormBox::text(array('name'=>'wname','class'=>'form-control text',),$_smarty_tpl->tpl_vars['model']->value);?></div>
          </div>
          <div class="form-group">
            <label class="form-label">QQ</label>
            <div class="form-box form-box1"><?php echo $_smarty_tpl->tpl_vars['member']->value['QQ'];?>
</div>
            <a class="addright">添加</a>
            <div class="form-box form-box2"><?php echo FormBox::text(array('name'=>'QQ','class'=>'form-control text',),$_smarty_tpl->tpl_vars['model']->value);?></div>
          </div>
          <div class="form-group">
            <label class="form-label">邮箱</label>
            <div class="form-box form-box1"><?php echo $_smarty_tpl->tpl_vars['member']->value['email'];?>
</div>
            <a class="addright">添加</a>
            <div class="form-box form-box2"><?php echo FormBox::text(array('name'=>'email','class'=>'form-control text',),$_smarty_tpl->tpl_vars['model']->value);?></div>
          </div>
          <div class="form-group">
            <label class="form-label">联系电话</label>
            <div class="form-box form-box1"><?php echo $_smarty_tpl->tpl_vars['member']->value['telephone'];?>
</div>
            <a class="addright">添加</a>
            <div class="form-box form-box2"><?php echo FormBox::text(array('name'=>'telephone','class'=>'form-control text',),$_smarty_tpl->tpl_vars['model']->value);?></div>
          </div>
          <div class="form-group">
            <label class="form-label">会员生日</label>
            <div class="form-box form-box1"><?php echo $_smarty_tpl->tpl_vars['member']->value['birthday'];?>
</div>
            <a class="addright">添加</a>
            <div class="form-box form-box2"><?php echo FormBox::date(array('name'=>'birthday','class'=>'form-control text',),$_smarty_tpl->tpl_vars['model']->value);?></div>
          </div>
          <div class="form-group">
            <label class="form-label">所在城市</label>
            <div class="form-box form-box1"><?php  $_smarty_tpl->tpl_vars['rd'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rd']->_loop = false;
 $_from = json_decode($_smarty_tpl->tpl_vars['member']->value['area']); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rd']->key => $_smarty_tpl->tpl_vars['rd']->value) {
$_smarty_tpl->tpl_vars['rd']->_loop = true;
?><i><?php echo DB::getval('@pf_area','name',$_smarty_tpl->tpl_vars['rd']->value);?>
</i>　<?php } ?></div>
            <a class="addright">添加</a>
            <div class="form-box form-box2"><?php echo FormBox::linkage(array('name'=>"area",),$_smarty_tpl->tpl_vars['model']->value);?></div>
          </div>
          <div class="form-group">
            <label class="form-label">联系地址</label>
            <div class="form-box form-box1"><?php echo $_smarty_tpl->tpl_vars['member']->value['address'];?>
</div>
            <a class="addright">添加</a>
            <div class="form-box form-box2"><?php echo FormBox::textarea(array('name'=>"address",),$_smarty_tpl->tpl_vars['model']->value);?></div>
          </div>
          <div class="form-group">
            <label class="form-label">备用联系人</label>
            <div class="form-box form-box1"><?php echo $_smarty_tpl->tpl_vars['member']->value['alternate_contact'];?>
</div>
            <a class="addright">添加</a>
            <div class="form-box form-box2"><?php echo FormBox::text(array('name'=>'alternate_contact','class'=>'form-control text',),$_smarty_tpl->tpl_vars['model']->value);?></div>
          </div>
          <div class="form-group">
            <label class="form-label">备用联系人电话</label>
            <div class="form-box form-box1"><?php echo $_smarty_tpl->tpl_vars['member']->value['contact_phone'];?>
</div>
            <a class="addright">添加</a>
            <div class="form-box form-box2"><?php echo FormBox::text(array('name'=>'contact_phone','class'=>'form-control text',),$_smarty_tpl->tpl_vars['model']->value);?></div>
          </div>

          <h4>会员档案</h4>
          <li><span>上次登录时间</span><dl><?php if ($_smarty_tpl->tpl_vars['member']->value['last_login_time']) {?><?php echo $_smarty_tpl->tpl_vars['member']->value['last_login_time'];?>
<?php } else { ?>-<?php }?></dl></li>    
          <li><span>本次登录时间</span><dl><?php if ($_smarty_tpl->tpl_vars['member']->value['this_login_time']) {?><?php echo $_smarty_tpl->tpl_vars['member']->value['this_login_time'];?>
<?php } else { ?>-<?php }?></dl></li>    
          <li><span>错误次数</span><dl><?php if ($_smarty_tpl->tpl_vars['member']->value['errtice']) {?><?php echo $_smarty_tpl->tpl_vars['member']->value['errtice'];?>
<?php } else { ?>-<?php }?></dl></li>    
          <li><span>所属销售</span><dl><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['member']->value['parent_id'];?>
<?php $_tmp1=ob_get_clean();?><?php echo FormBox::select(array('name'=>"parent_id",'value'=>$_tmp1,),$_smarty_tpl->tpl_vars['model']->value);?></dl></li>
          <li><span>客户来源</span><dl><?php echo FormBox::select(array('header'=>"选择客户来源",'name'=>"client_source",),$_smarty_tpl->tpl_vars['model']->value);?></dl></li>
          <li><span>感兴趣的营</span><dl>
            <ul id="interest_camp" class="samao-box">
            <?php echo FormBox::checkgroup(array('name'=>"interest_camp",),$_smarty_tpl->tpl_vars['model']->value);?>
            </ul>
          </dl></li>  
          <li><span>成熟度</span><dl><?php echo FormBox::select(array('header'=>"选择成熟度",'name'=>"level",),$_smarty_tpl->tpl_vars['model']->value);?></dl></li>
          <li><span>备注</span><dl><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['member']->value['remark'];?>
<?php $_tmp2=ob_get_clean();?><?php echo FormBox::textarea(array('name'=>"remark",'value'=>$_tmp2,),$_smarty_tpl->tpl_vars['model']->value);?></dl></li>       
          <h4>支付信息</h4>   
          <li><span>银行账户户名</span><dl><?php echo FormBox::text(array('name'=>"bank_account_name",),$_smarty_tpl->tpl_vars['model']->value);?></dl></li>        
           <li><span>开户行</span><dl><?php echo FormBox::text(array('name'=>"bank",),$_smarty_tpl->tpl_vars['model']->value);?></dl></li>        
            <li><span>银行账号</span><dl><?php echo FormBox::text(array('name'=>"bank_account",),$_smarty_tpl->tpl_vars['model']->value);?></dl></li>        
             <li><span>支付宝账号</span><dl><?php echo FormBox::text(array('name'=>"alipay",),$_smarty_tpl->tpl_vars['model']->value);?></dl></li>        
          </ul>
          <div class="form-submit form-submit-one">
          <input type="hidden" id="user_id" name="user_id" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" />
          <input type="submit" class="submit" value="保存" id="">
        </div>
</form>
        </div>
    </div>
  </div>
  <div class="client_50 fl">
    <div class="client_box client_box_follow">
      <h3>跟进记录</h3>
      <div class="client_list">
       <ul>
            <?php if ($_smarty_tpl->tpl_vars['client_record']->value) {?>
        <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['client_record']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value) {
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
        <li><h5><dt><?php echo $_smarty_tpl->tpl_vars['c']->value['add_time'];?>
</dt> <i><?php echo DB::getval('@pf_manage','name',$_smarty_tpl->tpl_vars['c']->value['manage_id']);?>
</i><i><?php echo $_smarty_tpl->tpl_vars['c']->value['contact'];?>
</i></h5>
          <p><?php echo $_smarty_tpl->tpl_vars['c']->value['content'];?>
</p>
           <div class="cls"></div>
         </li>
         <?php } ?>
         <?php } else { ?>
         <li><h5>无跟进记录</h5></li>
         <?php }?>
         <li class="add_follow"><h5><a dialog="1"  href="/admin/member/addRord?client_id=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
&type=<?php if ($_smarty_tpl->tpl_vars['member']->value['type']==1) {?>1<?php } elseif ($_smarty_tpl->tpl_vars['member']->value['type']==3||$_smarty_tpl->tpl_vars['member']->value['type']==4) {?>3<?php }?>&flag=1">新增跟进记录</a></h5>
         </li>
       </ul>
     </div>
    </div> 
<?php  $_smarty_tpl->tpl_vars['ch'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ch']->_loop = false;
 $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['children']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ch']->key => $_smarty_tpl->tpl_vars['ch']->value) {
$_smarty_tpl->tpl_vars['ch']->_loop = true;
 $_smarty_tpl->tpl_vars['i']->value = $_smarty_tpl->tpl_vars['ch']->key;
?> 
<div class="client_box">
<form action="/admin/member/addKids" method="post">
    <h3><?php if ($_smarty_tpl->tpl_vars['ch']->value['id']) {?><a onclick="return confirm('确定要删除该内容吗？一旦删除将无法恢复，请谨慎操作！');" href="/admin/member/deleteCamper?id=<?php echo $_smarty_tpl->tpl_vars['ch']->value['id'];?>
"><?php if ($_smarty_tpl->tpl_vars['kids']->value[$_smarty_tpl->tpl_vars['i']->value]) {?><span>清空</span><?php } else { ?><span>删除</span><?php }?></a><?php }?>子女营员<?php echo $_smarty_tpl->tpl_vars['i']->value+1;?>
</h3>
        <div class="client_list">
          <ul>
          <div class="form-group">
            <label class="form-label">姓名</label>
            <div class="form-box form-box1"><?php echo $_smarty_tpl->tpl_vars['kids']->value[$_smarty_tpl->tpl_vars['i']->value]['c_name'];?>
</div>
            <a class="addright">添加</a>
            <div class="form-box form-box2"><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['ch']->value['c_name'];?>
<?php $_tmp3=ob_get_clean();?><?php echo FormBox::text(array('name'=>"c_name",'value'=>$_tmp3,),$_smarty_tpl->tpl_vars['model']->value);?></div>
          </div>  
          <div class="form-group">
            <label class="form-label">英文名</label>
            <div class="form-box form-box1"><?php echo $_smarty_tpl->tpl_vars['kids']->value[$_smarty_tpl->tpl_vars['i']->value]['englishname'];?>
</div>
            <a class="addright">添加</a>
            <div class="form-box form-box2"><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['ch']->value['englishname'];?>
<?php $_tmp4=ob_get_clean();?><?php echo FormBox::text(array('name'=>"englishname",'value'=>$_tmp4,),$_smarty_tpl->tpl_vars['model']->value);?></div>
          </div>  
          <div class="form-group">
            <label class="form-label">性别</label>
            <div class="form-box form-box1"><?php echo ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['kids']->value[$_smarty_tpl->tpl_vars['i']->value]['c_gender'],array('0','1'))) && array_key_exists($_tempkey,$_temparr=array('女','男'))?$_temparr[$_tempkey]:'');?>
</div>
            <a class=""></a>
            <div class="form-box form-box2"><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['ch']->value['c_gender'];?>
<?php $_tmp5=ob_get_clean();?><?php echo FormBox::radiogroup(array('name'=>'c_gender','id'=>"c_gender".((string)$_smarty_tpl->tpl_vars['i']->value),'class'=>'form-control ','value'=>$_tmp5,),$_smarty_tpl->tpl_vars['model']->value);?></div>
          </div> 
              <div class="form-group">
            <label class="form-label">生日</label>
            <div class="form-box form-box1"><?php echo $_smarty_tpl->tpl_vars['kids']->value[$_smarty_tpl->tpl_vars['i']->value]['c_birthday'];?>
</div>
            <a class="addright">添加</a>
            <div class="form-box form-box2"><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['ch']->value['c_birthday'];?>
<?php $_tmp6=ob_get_clean();?><?php echo FormBox::date(array('name'=>'c_birthday','id'=>"birthday_".((string)$_smarty_tpl->tpl_vars['i']->value),'class'=>'form-control text','value'=>$_tmp6,),$_smarty_tpl->tpl_vars['model']->value);?></div>
          </div> 
          <div class="form-group">
            <label class="form-label">就读学校</label>
            <div class="form-box form-box1"><?php echo $_smarty_tpl->tpl_vars['kids']->value[$_smarty_tpl->tpl_vars['i']->value]['school'];?>
</div>
            <a class="addright">添加</a>
            <div class="form-box form-box2"><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['ch']->value['school'];?>
<?php $_tmp7=ob_get_clean();?><?php echo FormBox::text(array('name'=>"school",'value'=>$_tmp7,),$_smarty_tpl->tpl_vars['model']->value);?></div>
          </div> 
          <div class="form-group">
            <label class="form-label">学校类别</label>
            <div class="form-box form-box1"></div>
            <a class=""></a>
            <div class="form-box form-box2"><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['ch']->value['school_type'];?>
<?php $_tmp8=ob_get_clean();?><?php echo FormBox::select(array('name'=>"school_type",'header'=>"选择学校类别",'value'=>$_tmp8,),$_smarty_tpl->tpl_vars['model']->value);?></div>
          </div> 
          <div class="form-group">
            <label class="form-label">子女备注</label>
            <div class="form-box form-box1"></div>
            <a class=""></a>
            <div class="form-box form-box2"><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['ch']->value['c_remark'];?>
<?php $_tmp9=ob_get_clean();?><?php echo FormBox::textarea(array('name'=>"c_remark",'value'=>$_tmp9,),$_smarty_tpl->tpl_vars['model']->value);?></div>
          </div> 
          
          <h4>健康信息</h4>
            <div class="form-group">
            <label class="form-label">身高(cm)</label>
            <div class="form-box form-box1"><?php echo $_smarty_tpl->tpl_vars['kids']->value[$_smarty_tpl->tpl_vars['i']->value]['height'];?>
</div>
            <a class="addright">添加</a>
            <div class="form-box form-box2"><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['ch']->value['height'];?>
<?php $_tmp10=ob_get_clean();?><?php echo FormBox::text(array('name'=>"height",'value'=>$_tmp10,),$_smarty_tpl->tpl_vars['model']->value);?></div>
          </div> 
          <div class="form-group">
            <label class="form-label">体重(kg)</label>
            <div class="form-box form-box1"><?php echo $_smarty_tpl->tpl_vars['kid']->value[$_smarty_tpl->tpl_vars['i']->value]['weight'];?>
</div>
            <a class="addright">添加</a>
            <div class="form-box form-box2"><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['ch']->value['weight'];?>
<?php $_tmp11=ob_get_clean();?><?php echo FormBox::text(array('name'=>"weight",'value'=>$_tmp11,),$_smarty_tpl->tpl_vars['model']->value);?> </div>
          </div>
          <div class="form-group">
            <label class="form-label">饮食禁忌及过敏情况</label>
            <div class="form-box form-box1"><?php echo $_smarty_tpl->tpl_vars['kid']->value[$_smarty_tpl->tpl_vars['i']->value]['taboo_allergy'];?>
</div>
            <a class="addright">添加</a>
            <div class="form-box form-box2"> <?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['ch']->value['taboo_allergy'];?>
<?php $_tmp12=ob_get_clean();?><?php echo FormBox::textarea(array('name'=>"taboo_allergy",'value'=>$_tmp12,),$_smarty_tpl->tpl_vars['model']->value);?></div>
          </div> 
          <div class="form-group">
            <label class="form-label">有无重大疾病</label>
            <div class="form-box form-box1"><?php echo $_smarty_tpl->tpl_vars['kid']->value[$_smarty_tpl->tpl_vars['i']->value]['sickness'];?>
</div>
            <a class="addright">添加</a>
            <div class="form-box form-box2"><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['ch']->value['sickness'];?>
<?php $_tmp13=ob_get_clean();?><?php echo FormBox::textarea(array('name'=>"sickness",'value'=>$_tmp13,),$_smarty_tpl->tpl_vars['model']->value);?> </div>
          </div> 
          <h4>证件信息</h4>
            <div class="form-group">
            <label class="form-label">身份证号</label>
            <div class="form-box form-box1"><?php echo $_smarty_tpl->tpl_vars['kids']->value[$_smarty_tpl->tpl_vars['i']->value]['IDcard'];?>
</div>
            <a class="addright">添加</a>
            <div class="form-box form-box2"><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['ch']->value['IDcard'];?>
<?php $_tmp14=ob_get_clean();?><?php echo FormBox::text(array('name'=>"IDcard",'value'=>$_tmp14,),$_smarty_tpl->tpl_vars['model']->value);?></div>
          </div>
          <div class="form-group">
            <label class="form-label">护照国籍</label>
            <div class="form-box form-box1"><?php echo DB::getval('@pf_nationality','name',$_smarty_tpl->tpl_vars['kids']->value[$_smarty_tpl->tpl_vars['i']->value]['Nationality']);?>
</div>
            <a class="addright">添加</a>
            <div class="form-box form-box2"><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['ch']->value['Nationality'];?>
<?php $_tmp15=ob_get_clean();?><?php echo FormBox::select(array('header'=>"选择护照国籍",'name'=>"Nationality",'value'=>$_tmp15,),$_smarty_tpl->tpl_vars['model']->value);?></div>
          </div>
          <div class="form-group">
            <label class="form-label">护照号</label>
            <div class="form-box form-box1"><?php echo $_smarty_tpl->tpl_vars['kids']->value[$_smarty_tpl->tpl_vars['i']->value]['passportNo'];?>
</div>
            <a class="addright">添加</a>
            <div class="form-box form-box2"><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['ch']->value['passportNo'];?>
<?php $_tmp16=ob_get_clean();?><?php echo FormBox::text(array('name'=>"passportNo",'value'=>$_tmp16,),$_smarty_tpl->tpl_vars['model']->value);?></div>
          </div>
          <div class="form-group">
            <label class="form-label">护照有效期</label>
            <div class="form-box form-box1"><?php echo $_smarty_tpl->tpl_vars['kids']->value[$_smarty_tpl->tpl_vars['i']->value]['valid_date'];?>
</div>
            <a class="addright">添加</a>
            <div class="form-box form-box2"><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['ch']->value['valid_date'];?>
<?php $_tmp17=ob_get_clean();?><?php echo FormBox::date(array('name'=>'valid_date','id'=>"valid_".((string)$_smarty_tpl->tpl_vars['i']->value),'class'=>'form-control text','value'=>$_tmp17,),$_smarty_tpl->tpl_vars['model']->value);?></div>
          </div>
          </ul>
          <div class="form-submit form-submit-one">
              <input type="hidden" id="user_id" name="user_id" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" />
            <input type="hidden" name="client_id" value="<?php if ($_smarty_tpl->tpl_vars['client']->value['id']) {?><?php echo $_smarty_tpl->tpl_vars['client']->value['id'];?>
<?php } else { ?><?php }?>" />
            <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['ch']->value['id'];?>
" />
            <input type="submit" class="submit" name="" value="保存">
          </div>
        </div>
    </form> </div> 
<?php } ?>
      
        <?php  $_smarty_tpl->tpl_vars['gen'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['gen']->_loop = false;
 $_smarty_tpl->tpl_vars['m'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['genearch']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['gen']->key => $_smarty_tpl->tpl_vars['gen']->value) {
$_smarty_tpl->tpl_vars['gen']->_loop = true;
 $_smarty_tpl->tpl_vars['m']->value = $_smarty_tpl->tpl_vars['gen']->key;
?>
        <div class="client_box">
          <form action="/admin/member/addParent" method="post">
    <h3><?php if ($_smarty_tpl->tpl_vars['gen']->value['id']) {?><a onclick="return confirm('确定要删除该内容吗？一旦删除将无法恢复，请谨慎操作！');" href="/admin/member/deleteCamper?id=<?php echo $_smarty_tpl->tpl_vars['gen']->value['id'];?>
"><?php if ($_smarty_tpl->tpl_vars['parents']->value[$_smarty_tpl->tpl_vars['m']->value]) {?><span>清空</span><?php } else { ?><span>删除</span><?php }?></a><?php }?>家长营员<?php echo $_smarty_tpl->tpl_vars['m']->value+1;?>
</h3>
        <div class="client_list">
          <ul>
          <div class="form-group">
            <label class="form-label">姓名</label>
            <div class="form-box form-box1"><?php echo $_smarty_tpl->tpl_vars['parents']->value[$_smarty_tpl->tpl_vars['m']->value]['c_name'];?>
</div>
            <a class="addright">添加</a>
            <div class="form-box form-box2"><?php echo FormBox::text(array('name'=>"c_name",'value'=>((string)$_smarty_tpl->tpl_vars['gen']->value['c_name']),),$_smarty_tpl->tpl_vars['model']->value);?></div>
          </div>  
          <div class="form-group">
            <label class="form-label">性别</label>
            <div class="form-box form-box1"><?php echo ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['parents']->value[$_smarty_tpl->tpl_vars['m']->value]['c_gender'],array('0','1'))) && array_key_exists($_tempkey,$_temparr=array('女','男'))?$_temparr[$_tempkey]:'');?>
</div>
            <a class=""></a>
            <div class="form-box form-box2"><?php echo FormBox::radiogroup(array('name'=>'c_gender','id'=>"c_gender_".((string)$_smarty_tpl->tpl_vars['m']->value),'class'=>'form-control ','value'=>((string)$_smarty_tpl->tpl_vars['gen']->value['c_gender']),),$_smarty_tpl->tpl_vars['model']->value);?></div>
          </div>  
          <div class="form-group">
            <label class="form-label">联系电话</label>
            <div class="form-box form-box1"><?php echo $_smarty_tpl->tpl_vars['parents']->value[$_smarty_tpl->tpl_vars['m']->value]['phone'];?>
</div>
            <a class="addright">添加</a>
            <div class="form-box form-box2"><?php echo FormBox::text(array('name'=>"phone",'value'=>((string)$_smarty_tpl->tpl_vars['gen']->value['phone']),),$_smarty_tpl->tpl_vars['model']->value);?></div>
          </div> 
           <div class="form-group">
            <label class="form-label">备注</label>
            <div class="form-box form-box1"><?php echo $_smarty_tpl->tpl_vars['parents']->value[$_smarty_tpl->tpl_vars['m']->value]['c_remark'];?>
</div>
            <a class="addright">添加</a>
            <div class="form-box form-box2"><?php echo FormBox::textarea(array('name'=>"c_remark",'value'=>((string)$_smarty_tpl->tpl_vars['gen']->value['c_remark']),),$_smarty_tpl->tpl_vars['model']->value);?></div>
          </div> 
          <h4>证件信息</h4>
          <div class="form-group">
            <label class="form-label">身份证号</label>
            <div class="form-box form-box1"><?php echo $_smarty_tpl->tpl_vars['parents']->value[$_smarty_tpl->tpl_vars['m']->value]['IDcard'];?>
</div>
            <a class="addright">添加</a>
            <div class="form-box form-box2"><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['gen']->value['IDcard'];?>
<?php $_tmp18=ob_get_clean();?><?php echo FormBox::text(array('name'=>"IDcard",'value'=>$_tmp18,),$_smarty_tpl->tpl_vars['model']->value);?></div>
          </div>
           <div class="form-group">
            <label class="form-label">护照国籍</label>
            <div class="form-box form-box1"><?php echo DB::getval('@pf_nationality','name',$_smarty_tpl->tpl_vars['parents']->value[$_smarty_tpl->tpl_vars['m']->value]['Nationality']);?>
</div>
            <a class="addright">添加</a>
            <div class="form-box form-box2"><?php echo FormBox::select(array('header'=>"选择护照国籍",'name'=>"Nationality",'value'=>((string)$_smarty_tpl->tpl_vars['gen']->value['Nationality']),),$_smarty_tpl->tpl_vars['model']->value);?></div>
          </div>
          <div class="form-group">
            <label class="form-label">护照号</label>
            <div class="form-box form-box1"><?php echo $_smarty_tpl->tpl_vars['parents']->value[$_smarty_tpl->tpl_vars['m']->value]['passportNo'];?>
</div>
            <a class="addright">添加</a>
            <div class="form-box form-box2"><?php echo FormBox::text(array('name'=>"passportNo",'value'=>((string)$_smarty_tpl->tpl_vars['gen']->value['passportNo']),),$_smarty_tpl->tpl_vars['model']->value);?></div>
          </div>
          <div class="form-group">
            <label class="form-label">护照有效期</label>
            <div class="form-box form-box1"><?php echo $_smarty_tpl->tpl_vars['parents']->value[$_smarty_tpl->tpl_vars['m']->value]['valid_date'];?>
</div>
            <a class="addright">添加</a>
            <div class="form-box form-box2"><?php echo FormBox::date(array('name'=>'valid_date','id'=>"date_".((string)$_smarty_tpl->tpl_vars['m']->value),'class'=>'form-control text','value'=>((string)$_smarty_tpl->tpl_vars['gen']->value['valid_date']),),$_smarty_tpl->tpl_vars['model']->value);?></div>
          </div>
          </ul>
          <div class="form-submit form-submit-one">
              <input type="hidden" id="user_id" name="user_id" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" />
            <input type="hidden" name="client_id" value="<?php if ($_smarty_tpl->tpl_vars['client']->value['id']) {?><?php echo $_smarty_tpl->tpl_vars['client']->value['id'];?>
<?php } else { ?><?php }?>" />
            <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['gen']->value['id'];?>
" />
            <input type="submit" class="submit" name="" value="保存">
          </div>
        </div>
        </form> </div>
    <?php } ?>
   
    <div class="client_box" id="box_add_child">
    <h3><a href="javascript:()">删除</a>新增学生营员</h3>
        <div class="client_list">
           <form action="/admin/member/addKids" method="post">
          <ul>         
          <li><span>姓名</span><dl><?php echo FormBox::text(array('name'=>"c_name",));?></dl></li>    
          <li><span>英文名</span><dl><?php echo FormBox::text(array('name'=>'englishname',));?></dl></li>    
          <li><span>性别</span><dl><?php echo FormBox::radiogroup(array('name'=>'c_gender','value'=>'','id'=>"c_gender_a",'class'=>'form-control ',),$_smarty_tpl->tpl_vars['model']->value);?></dl></li>
          <li><span>生日</span><dl><?php echo FormBox::date(array('name'=>'c_birthday','class'=>'form-control text',));?></dl></li>  
          <li><span>就读学校</span><dl><?php echo FormBox::text(array('name'=>"school",));?></dl></li>  
          <li><span>学校类别</span><dl><?php echo FormBox::select(array('header'=>"选择学校类别",'name'=>"school_type",'value'=>'',),$_smarty_tpl->tpl_vars['model']->value);?></dl></li>  
          <li><span>备注</span><dl><?php echo FormBox::textarea(array('name'=>"c_remark",));?></dl></li>          
          <h4>健康信息</h4>
          <li><span>身高(cm)</span><dl><?php echo FormBox::text(array('name'=>"height",));?></dl></li>                      
          <li><span>体重(kg)</span><dl><?php echo FormBox::text(array('name'=>"weight",));?></dl></li>
          <li><span>饮食禁忌及过敏情况</span><dl><?php echo FormBox::textarea(array('name'=>"taboo_allergy",));?></dl></li>                      
          <li><span>有无重大疾病</span><dl><?php echo FormBox::textarea(array('name'=>"sickness",));?></dl></li>
          <h4>证件信息</h4>
          <li><span>身份证号</span><dl><?php echo FormBox::text(array('name'=>"IDcard",));?></dl></li>                      
          <li><span>护照国籍</span><dl><?php echo FormBox::select(array('header'=>"选择护照国籍",'name'=>"Nationality",'value'=>'',),$_smarty_tpl->tpl_vars['model']->value);?></dl></li>
          <li><span>护照号</span><dl><?php echo FormBox::text(array('name'=>"passportNo",));?></dl></li>
          <li><span>护照有效期</span><dl><?php echo FormBox::date(array('name'=>'valid_date','id'=>"vd",'value'=>'','class'=>'form-control text',),$_smarty_tpl->tpl_vars['model']->value);?></dl></li>
          </ul>
          <div class="form-submit form-submit-one">
              <input type="hidden" id="user_id" name="user_id" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" />
            <input type="hidden" name="client_id" value="<?php if ($_smarty_tpl->tpl_vars['client']->value['id']) {?><?php echo $_smarty_tpl->tpl_vars['client']->value['id'];?>
<?php } else { ?><?php }?>" />          
          <input type="submit" class="submit" value="保存" id="">
        </div>
        </form>
        </div>
    </div>
    <div class="client_box" id="box_add_parent">
        <h3><a href="javascript:()">删除</a>新增家长营员</h3>
        <div class="client_list">
          <form action="/admin/member/addParent" method="post">
          <ul>         
          <li><span>姓名</span><dl><?php echo FormBox::text(array('name'=>"c_name",));?></dl></li>    
          <li><span>性别</span><dl><?php echo FormBox::radiogroup(array('name'=>'c_gender','value'=>'','id'=>"c_gender_b",'class'=>'form-control ',),$_smarty_tpl->tpl_vars['model']->value);?></dl></li>    
          <li><span>联系电话</span><dl><?php echo FormBox::text(array('name'=>"phone",));?></dl></li>
          <li><span>备注</span><dl><?php echo FormBox::textarea(array('name'=>"c_remark",));?></dl></li>       
          <h4>证件信息</h4>
          <li><span>身份证号</span><dl><?php echo FormBox::text(array('name'=>"IDcard",));?></dl></li>                      
           <li><span>护照国籍</span><dl><?php echo FormBox::select(array('header'=>"选择护照国籍",'name'=>"Nationality",'value'=>'',),$_smarty_tpl->tpl_vars['model']->value);?></dl></li>
          <li><span>护照号</span><dl><?php echo FormBox::text(array('name'=>"passportNo",));?></dl></li>
          <li><span>护照有效期</span><dl><?php echo FormBox::date(array('name'=>'valid_date','id'=>"valid_d",'class'=>'form-control text','value'=>'',),$_smarty_tpl->tpl_vars['model']->value);?></dl></li>
          </ul>
          <div class="form-submit form-submit-one">
              <input type="hidden" id="user_id" name="user_id" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" />
            <input type="hidden" name="client_id" value="<?php if ($_smarty_tpl->tpl_vars['client']->value['id']) {?><?php echo $_smarty_tpl->tpl_vars['client']->value['id'];?>
<?php } else { ?><?php }?>" />
          <input type="submit" class="submit" value="保存" id="">
        </div>
          </form>
        </div>
    </div>
  </div>
  <div class="cls"></div>
</div>
</body>
</html>
<?php }} ?>
