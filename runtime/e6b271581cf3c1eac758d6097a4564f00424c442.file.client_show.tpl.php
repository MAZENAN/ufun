<?php /* Smarty version Smarty-3.1.19, created on 2019-05-08 15:03:56
         compiled from ".\Apps\Admin\views\client_show.tpl" */ ?>
<?php /*%%SmartyHeaderCode:121035cd27f5cb345e6-01980819%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e6b271581cf3c1eac758d6097a4564f00424c442' => 
    array (
      0 => '.\\Apps\\Admin\\views\\client_show.tpl',
      1 => 1491472342,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '121035cd27f5cb345e6-01980819',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'client' => 0,
    'kids' => 0,
    'kid' => 0,
    'member' => 0,
    'ad' => 0,
    'rd' => 0,
    'ic' => 0,
    'i' => 0,
    'k' => 0,
    'parents' => 0,
    'm' => 0,
    'p' => 0,
    'client_record' => 0,
    'c' => 0,
    'order' => 0,
    'buy' => 0,
    'xrs' => 0,
    'b' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5cd27f5cc12362_38313175',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5cd27f5cc12362_38313175')) {function content_5cd27f5cc12362_38313175($_smarty_tpl) {?><!DOCTYPE html>
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
//隐藏无数据项
       $(".client_left .client_list ul li").each(function(){
        if($(this).find("i").text()=="()"){
          $(this).find("i").hide();
        }
        if($(this).find("p").text()==""){
          $(this).find("p").hide();
        }
        if($(this).find("p").text()=="" && $(this).find("i").text()=="()" || $(this).find("dl").text()=="" ){
          $(this).hide();
          $(this).prev("h4").hide();
        }
       });
});
</script>
<style type="text/css">
body{ font-size: 14px; color: #333; }
h1,h2,h3,h4,h5{ font-weight: normal; margin: 0;}
ul{ padding: 0; margin: 0; }
li{ list-style: none; }
.client_show_head{float: left;  background: #fff; border-radius: 5px; border:1px solid #D8D8D9; padding: 15px 10px 15px 40px; overflow: hidden; margin-bottom: 20px; }
.client_show_head .head_name{ float: left; padding-top: 5px; margin-right: 50px; }
.client_show_head .head_name img{ float: left; height: 60px; }
.client_show_head .head_name h2{ float: left; color: #333; font-size: 24px; margin: 0; padding-left: 20px;  }
.client_show_head .head_name h2 p{ margin: 0; min-height: 31px; }
.client_show_head .head_name h2 span{ display: block; font-size: 14px; color: #999; margin-top: 7px;max-width: 158px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;  }
.client_show_head ul{ float: left; padding: 0 10px 0 40px; position: relative; }
.client_show_head ul:before{ position: absolute; display: block; content: ""; border-left: 2px solid #F1F0EE; height: 54px;left: 0; top: 50%; margin-top: -27px; }
.client_show_head ul li{ font-size: 14px; color: #333; list-style: none; position: relative; padding-left: 20px; line-height: 25px; height: 25px; width: 160px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;}
.client_show_head ul li:before{ display: block; content: ""; width: 10px; height: 10px; border-radius: 5px; background: #93c5f0;position: absolute; left: 0; top: 50%; margin-top: -5px; }
.client_show_edit{ float: left; background: #fff; margin:10px 0 0 20px; }
.client_show_edit a{ width: 80px; height: 80px; border-radius: 5px; border:1px solid #288ce2; text-align: center; font-size: 14px; color: #288ce2; display: -webkit-box; -webkit-box-align:center; -webkit-box-pack: center; background: url(../../public/mb/images/edit.png) no-repeat scroll center 15px; }
.client_show_edit a:hover{ color: #0066c9; border-color: #0066c9; background: url(../../public/images/edit_hover.png) no-repeat scroll center 15px;  }
.client_show_edit a img{ visibility: hidden; }
.cls{ clear: both; }
.fl{ float: left; }
.fr{ float: right; }
.client_left{ width: 500px; }
.client_center{ width: 300px; }
.client_right{width: 300px; }
.client_box{ margin:0 20px 20px 0; }
.client_box h3{ height: 38px; line-height: 38px; background: #288ce2; text-align: center; color: #fff; font-size: 16px; }
.client_box .client_list{ background: #fff; padding: 15px 0px; overflow: hidden; border:1px solid #288ce2; }
.client_box .client_list ul li{ line-height: 25px; min-height: 25px; position: relative; padding: 0 20px; }
.client_box .client_list ul li span{ position: absolute; left: 20px; top: 0; }
.client_box .client_list ul li dl{ padding-left: 150px; margin:0 0 20px 0; word-wrap: break-word; }
.client_box .client_list ul li dl p{ display: inline; margin: 0; }
.client_box .client_list ul li dl i{ color: #999 }
.client_box .client_list ul h4{ background: #288ce2; width: 100px; text-align: center; line-height: 25px; color: #fff; position: relative;}
.client_box .client_list ul h4:after{ position: absolute; display: block; content: "";width: 340px; border-bottom: 1px dotted #ddd; right: -360px; top: 50%; }
.client_center .client_list ul li{ padding-left: 30px;padding-bottom: 20px; }
.client_center .client_list ul li h5{ color: #999; font-size: 14px; position: relative;}
.client_center .client_list ul{ position: relative; }
.client_center .client_list ul:before{ display: block; content: ""; position: absolute; left: 16px; top: 10px; border-left: 1px dashed #ddd; height: 100%; }
.client_center .client_list ul li h5:before{ display: block; content: ""; width: 11px; height: 11px; border-radius: 5px; background: #93c5f0;position: absolute; left: -19px; top: 50%; margin-top: -5px; }
.client_center .client_list ul li p{ margin: 0; }
.client_right ul dd{ color: #288ce2; padding:0 0 15px 30px; margin: 0;  }
i{ font-style: normal; }
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
</p> <?php if ($_smarty_tpl->tpl_vars['client']->value['wname']) {?><span>微信昵称：<?php echo $_smarty_tpl->tpl_vars['client']->value['wname'];?>
</span><?php }?></h2>   
    </div>
    <?php  $_smarty_tpl->tpl_vars['kid'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['kid']->_loop = false;
 $_from = array_slice($_smarty_tpl->tpl_vars['kids']->value,0,2); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
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
  <div class="client_show_edit"><a href="/admin/member/edit_camper?id=<?php echo $_smarty_tpl->tpl_vars['member']->value['id'];?>
"><img src="../../public/mb/images/edit.png"><br/>编辑会员</a></div>
  <div class="cls"></div>
  <div class="client_left fl">
    <div class="client_box">
        <h3>会员资料</h3>
        <div class="client_list">
          <ul>
            <li><span>昵称</span><dl><p><?php echo $_smarty_tpl->tpl_vars['member']->value['nickname'];?>
</p>&nbsp;&nbsp;&nbsp;<i>(<?php echo $_smarty_tpl->tpl_vars['client']->value['nickname'];?>
)</i></dl></li>
            <li><span>手机号</span><dl><p><?php echo $_smarty_tpl->tpl_vars['member']->value['mobile'];?>
</p>&nbsp;&nbsp;&nbsp;<i>(<?php echo $_smarty_tpl->tpl_vars['client']->value['mobile'];?>
)</i></dl></li>
            <li><span>会员生日</span><dl><p><?php echo $_smarty_tpl->tpl_vars['member']->value['birthday'];?>
</p>&nbsp;&nbsp;&nbsp;<i>(<?php echo $_smarty_tpl->tpl_vars['client']->value['birthday'];?>
)</i></dl></li>
            <li><span>微信号（或关联手机号）</span><dl><p><?php echo $_smarty_tpl->tpl_vars['member']->value['webchat'];?>
</p>&nbsp;&nbsp;&nbsp;<i>(<?php echo $_smarty_tpl->tpl_vars['client']->value['webchat'];?>
)</i></dl></li>            
            <li><span>微信昵称</span><dl><p><?php echo $_smarty_tpl->tpl_vars['member']->value['wname'];?>
</p>&nbsp;&nbsp;&nbsp;<i>(<?php echo $_smarty_tpl->tpl_vars['client']->value['wname'];?>
)</i></dl></li>
            <li><span>QQ</span><dl><p><?php echo $_smarty_tpl->tpl_vars['member']->value['QQ'];?>
</p>&nbsp;&nbsp;&nbsp;<i>(<?php echo $_smarty_tpl->tpl_vars['client']->value['QQ'];?>
)</i></dl></li>
            <li><span>邮箱</span><dl><p><?php echo $_smarty_tpl->tpl_vars['member']->value['email'];?>
</p>&nbsp;&nbsp;&nbsp;<i>(<?php echo $_smarty_tpl->tpl_vars['client']->value['email'];?>
)</i></dl></li>
            <li><span>所在城市</span><dl><p><?php  $_smarty_tpl->tpl_vars['ad'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ad']->_loop = false;
 $_from = json_decode($_smarty_tpl->tpl_vars['member']->value['area']); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ad']->key => $_smarty_tpl->tpl_vars['ad']->value) {
$_smarty_tpl->tpl_vars['ad']->_loop = true;
?><?php echo DB::getval('@pf_area','name',$_smarty_tpl->tpl_vars['ad']->value);?>
<?php } ?></p>&nbsp;&nbsp;&nbsp;<i>(<?php  $_smarty_tpl->tpl_vars['rd'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rd']->_loop = false;
 $_from = json_decode($_smarty_tpl->tpl_vars['client']->value['area']); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rd']->key => $_smarty_tpl->tpl_vars['rd']->value) {
$_smarty_tpl->tpl_vars['rd']->_loop = true;
?><?php echo DB::getval('@pf_area','name',$_smarty_tpl->tpl_vars['rd']->value);?>
<?php } ?>)</i></dl></li>
            <li><span>联系地址</span><dl><p><?php echo $_smarty_tpl->tpl_vars['member']->value['address'];?>
</p><i>(<?php echo $_smarty_tpl->tpl_vars['client']->value['address'];?>
)</i></dl></li>
            <li><span>备用联系人</span><dl><p><?php echo $_smarty_tpl->tpl_vars['member']->value['alternate_contact'];?>
</p><i>(<?php echo $_smarty_tpl->tpl_vars['client']->value['alternate_contact'];?>
)</i></dl></li>
            <li><span>备用联系人电话</span><dl><p><?php echo $_smarty_tpl->tpl_vars['member']->value['contact_phone'];?>
</p><i>(<?php echo $_smarty_tpl->tpl_vars['client']->value['contact_phone'];?>
)</i></dl></li>
            <li><span>所属销售</span><dl><?php echo DB::getval('@pf_manage','name',$_smarty_tpl->tpl_vars['member']->value['parent_id']);?>
</dl></li>
            <li><span>客户来源</span><dl><?php echo DB::getval('@pf_client_from','name',$_smarty_tpl->tpl_vars['client']->value['client_source']);?>
</dl></li>
            <li><span>感兴趣的营期</span><dl><?php  $_smarty_tpl->tpl_vars['ic'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ic']->_loop = false;
 $_from = json_decode($_smarty_tpl->tpl_vars['client']->value['interest_camp']); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ic']->key => $_smarty_tpl->tpl_vars['ic']->value) {
$_smarty_tpl->tpl_vars['ic']->_loop = true;
?><?php echo DB::getval('@pf_camp_holiday','name',$_smarty_tpl->tpl_vars['ic']->value);?>
&nbsp;&nbsp;&nbsp;<?php } ?></dl></li>
            <li><span>成熟度</span><dl><?php echo DB::getval('@pf_client_intention','name',$_smarty_tpl->tpl_vars['client']->value['level']);?>
</dl></li>
            <li><span>开户行(具体分理处）</span><dl><?php echo $_smarty_tpl->tpl_vars['client']->value['bank'];?>
</dl></li>
            <li><span>开户账户</span><dl><p><?php echo $_smarty_tpl->tpl_vars['client']->value['bank_account'];?>
</p></dl></li>
            <li><span>账户户名</span><dl><p><?php echo $_smarty_tpl->tpl_vars['client']->value['bank_account_name'];?>
</p></dl></li>
            <li><span>支付宝</span><dl><p><?php echo $_smarty_tpl->tpl_vars['client']->value['alipay'];?>
</p></dl></li>

          </ul>
        </div>
    </div>
<?php  $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['k']->_loop = false;
 $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['kids']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['k']->key => $_smarty_tpl->tpl_vars['k']->value) {
$_smarty_tpl->tpl_vars['k']->_loop = true;
 $_smarty_tpl->tpl_vars['i']->value = $_smarty_tpl->tpl_vars['k']->key;
?>
    <div class="client_box">
        <h3>子女营员<?php echo $_smarty_tpl->tpl_vars['i']->value+1;?>
</h3>
        <div class="client_list">
          <ul>
            <li><span>姓名</span><dl><?php echo $_smarty_tpl->tpl_vars['k']->value['c_name'];?>
</dl></li>
            <li><span>英文名</span><dl><?php echo $_smarty_tpl->tpl_vars['k']->value['englishname'];?>
</dl></li>
            <li><span>性别</span><dl><?php echo ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['k']->value['c_gender'],array('0','1'))) && array_key_exists($_tempkey,$_temparr=array('女孩','男孩'))?$_temparr[$_tempkey]:'');?>
</dl></li>
            <li><span>生日</span><dl><?php echo $_smarty_tpl->tpl_vars['k']->value['c_birthday'];?>
</dl></li>
            <li><span>学校名称</span><dl><?php echo $_smarty_tpl->tpl_vars['k']->value['school'];?>
</dl></li>
            <li><span>学校类别</span><dl><?php echo DB::getval('@pf_school_type','name',$_smarty_tpl->tpl_vars['k']->value['school_type']);?>
</dl></li>
            <li><span>备注</span><dl><?php echo $_smarty_tpl->tpl_vars['k']->value['c_remark'];?>
</dl></li>
            <h4>健康信息</h4>
            <li><span>身高（cm）</span><dl><?php echo $_smarty_tpl->tpl_vars['k']->value['height'];?>
</dl></li>
            <li><span>体重（kg）</span><dl><?php echo $_smarty_tpl->tpl_vars['k']->value['weight'];?>
</dl></li>
            <li><span>饮食禁忌及过敏情况</span><dl><?php echo $_smarty_tpl->tpl_vars['k']->value['taboo_allergy'];?>
</dl></li>
            <li><span>有无重大疾病</span><dl><?php echo $_smarty_tpl->tpl_vars['k']->value['sickness'];?>
</dl></li>
            <h4>证件信息</h4>
            <li><span>身份证号</span><dl><?php echo $_smarty_tpl->tpl_vars['k']->value['IDcard'];?>
</dl></li>
            <li><span>护照号</span><dl><?php echo $_smarty_tpl->tpl_vars['k']->value['passportNo'];?>
</dl></li>
            <li><span>护照国籍</span><dl><?php echo DB::getval('@pf_nationality','name',$_smarty_tpl->tpl_vars['k']->value['Nationality']);?>
</dl></li>
            <li><span>护照有效期</span><dl><?php echo $_smarty_tpl->tpl_vars['k']->value['valid_date'];?>
</dl></li>
          </ul>
        </div>
    </div>
<?php } ?>
<?php  $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['p']->_loop = false;
 $_smarty_tpl->tpl_vars['m'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['parents']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['p']->key => $_smarty_tpl->tpl_vars['p']->value) {
$_smarty_tpl->tpl_vars['p']->_loop = true;
 $_smarty_tpl->tpl_vars['m']->value = $_smarty_tpl->tpl_vars['p']->key;
?>
    <div class="client_box">
        <h3>家长营员<?php echo $_smarty_tpl->tpl_vars['m']->value+1;?>
</h3>
        <div class="client_list">
          <ul>
            <li><span>姓名</span><dl><?php echo $_smarty_tpl->tpl_vars['p']->value['c_name'];?>
</dl></li>
            <li><span>性别</span><dl><?php echo ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['p']->value['c_gender'],array('0','1'))) && array_key_exists($_tempkey,$_temparr=array('女士','先生'))?$_temparr[$_tempkey]:'');?>
</dl></li>
            <li><span>联系电话</span><dl><?php echo $_smarty_tpl->tpl_vars['p']->value['phone'];?>
</dl></li>
            <li><span>备注</span><dl><?php echo $_smarty_tpl->tpl_vars['p']->value['c_remark'];?>
</dl></li>
            <h4>证件信息</h4>
            <li><span>身份证号</span><dl><?php echo $_smarty_tpl->tpl_vars['p']->value['IDcard'];?>
</dl></li>
            <li><span>护照号</span><dl><?php echo $_smarty_tpl->tpl_vars['p']->value['passportNo'];?>
</dl></li>
            <li><span>护照国籍</span><dl><?php echo DB::getval('@pf_nationality','name',$_smarty_tpl->tpl_vars['p']->value['Nationality']);?>
</dl></li>
            <li><span>护照有效期</span><dl><?php echo $_smarty_tpl->tpl_vars['p']->value['valid_date'];?>
</dl></li>
          </ul>
        </div>
    </div>
<?php } ?>
  </div>
  <div class="client_center fl">
    <div class="client_box">
      <h3>跟进记录</h3>
      <div class="client_list">
       <ul>
        <?php if ($_smarty_tpl->tpl_vars['client_record']->value) {?>
        <?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['client_record']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value) {
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
         <li><h5><?php echo $_smarty_tpl->tpl_vars['c']->value['add_time'];?>
 <?php echo DB::getval('@pf_manage','name',$_smarty_tpl->tpl_vars['c']->value['manage_id']);?>
</h5>
          <p><?php echo $_smarty_tpl->tpl_vars['c']->value['content'];?>
</p>
         </li>
         <?php } ?>
         <?php } else { ?>
         <li><h5>无跟进记录</h5></li>
         <?php }?>
       </ul>
     </div>
    </div>
  </div>
  <div class="client_center client_right fl">
    <div class="client_box">
      <h3>参营记录</h3>
      <div class="client_list">
       <ul>
           <?php if (empty($_smarty_tpl->tpl_vars['order']->value)&&empty($_smarty_tpl->tpl_vars['buy']->value)) {?>
           <li><h5>无参营记录</h5></li>
           <?php } else { ?>
         <?php  $_smarty_tpl->tpl_vars['xrs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['xrs']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['order']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['xrs']->key => $_smarty_tpl->tpl_vars['xrs']->value) {
$_smarty_tpl->tpl_vars['xrs']->_loop = true;
?>  
           <li><h5><?php echo $_smarty_tpl->tpl_vars['xrs']->value['addtime'];?>
， <?php echo ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['xrs']->value['state'],array(0,1,2,3,4,5,6,7,8,9,10,-1))) && array_key_exists($_tempkey,$_temparr=array('待付订金','待填资料','待付尾款','已付款','申请退款中','已退款','已取消','准备出发','已参加','退款审批成功','退款审批失败','已作废'))?$_temparr[$_tempkey]:'');?>
</br><?php if ($_smarty_tpl->tpl_vars['xrs']->value['manage_id']) {?><?php echo DB::getval('@pf_manage','name',$_smarty_tpl->tpl_vars['xrs']->value['manage_id']);?>
&nbsp;&nbsp;&nbsp;<?php }?><?php echo $_smarty_tpl->tpl_vars['xrs']->value['orderid'];?>
</h5>
          <p><?php echo $_smarty_tpl->tpl_vars['xrs']->value['title'];?>
</br><?php echo $_smarty_tpl->tpl_vars['xrs']->value['departure_option'];?>
</p>
         </li>
         <?php } ?>
         <?php if ($_smarty_tpl->tpl_vars['buy']->value) {?>
         <dd> 购买记录</dd>
         <?php }?>
         <?php  $_smarty_tpl->tpl_vars['b'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['b']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['buy']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['b']->key => $_smarty_tpl->tpl_vars['b']->value) {
$_smarty_tpl->tpl_vars['b']->_loop = true;
?>
          <li><h5><?php echo $_smarty_tpl->tpl_vars['b']->value['time'];?>
，已参加</h5>
              <p><?php echo $_smarty_tpl->tpl_vars['b']->value['title'];?>
</p>
         </li>
         <?php } ?>
         <?php }?>
       </ul>
     </div>
    </div>
  </div>
  <div class="cls"></div>
</div>
</body>
</html>
<?php }} ?>
