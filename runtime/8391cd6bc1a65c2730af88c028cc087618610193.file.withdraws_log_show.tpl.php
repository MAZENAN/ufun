<?php /* Smarty version Smarty-3.1.19, created on 2019-07-05 10:20:07
         compiled from ".\Apps\Admin\views\withdraws_log_show.tpl" */ ?>
<?php /*%%SmartyHeaderCode:301955d1eb3d709c945-74611344%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8391cd6bc1a65c2730af88c028cc087618610193' => 
    array (
      0 => '.\\Apps\\Admin\\views\\withdraws_log_show.tpl',
      1 => 1562053560,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '301955d1eb3d709c945-74611344',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'order' => 0,
    'user' => 0,
    'log' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5d1eb3d70e28f3_68726416',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d1eb3d70e28f3_68726416')) {function content_5d1eb3d70e28f3_68726416($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_minimg')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\modifier.minimg.php';
?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>提现日志<?php echo $_smarty_tpl->tpl_vars['order']->value['order_id'];?>
</title>
<link rel="stylesheet" type="text/css" href="/public/samaores/css/form.default.css"/>
<link href="/public/samaores/css/list.default.css" rel="stylesheet" type="text/css" />
<style type="text/css">
html,body {
    background-color: #FFF;
}

.infotable{
border-collapse: collapse;
margin-top:5px;
}
.infotable td,.infotable th{
	line-height:24px;
	padding:5px;
	border:1px solid #ddd;
}
.infotable th{ background-color:#F2F1F0;}

.infotable td .storage{font-size:14px; color:  #09F;}
.infotable td .order{font-size:14px; color:#9B410E;}
</style>
<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.topdialog.js"></script>
</head>
<body>
<div class="samao-form">
    <h3>提现用户信息</h3>
<table class="infotable" width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
    <th width="15%">姓名</th>
    <td ><b class="storage"><?php echo $_smarty_tpl->tpl_vars['user']->value['real_name'];?>
</b></td>
    <th width="15%">头像</th>
        <td><img src="<?php echo smarty_modifier_minimg($_smarty_tpl->tpl_vars['user']->value['img_head'],50,50,1);?>
"></td>
    </tr>
  <tr>
    <th>手机号</th>
      <td><?php echo $_smarty_tpl->tpl_vars['user']->value['mobile'];?>
</td>
    <th>昵称</th>
    <td><?php echo $_smarty_tpl->tpl_vars['user']->value['nickname'];?>

    </td>
  </tr>

    <tr>
        <th>赏金余额</th>
        <td><span class="gre"><?php echo $_smarty_tpl->tpl_vars['user']->value['earn_money'];?>
</span>￥</td>
        <th>累计赚取赏金总额</th>
        <td><span class="org"><?php echo $_smarty_tpl->tpl_vars['user']->value['earn_total'];?>
</span>￥</td>
    </tr>
  <tr>
  </table>

    <h3>提现信息</h3>
    <div class="pay3-list">
        <table id="stulist" class="infotable"   width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <th width="15%">提现状态</th>
                <td ><b class="storage"><?php echo ((FALSE!==$_tempkey=array_search($_smarty_tpl->tpl_vars['log']->value['log'],array(0,1))) && array_key_exists($_tempkey,$_temparr=array('<span class="red">失败</span>','<span class="gre">成功</span>'))?$_temparr[$_tempkey]:'');?>
</b></td>
            </tr>
            <tr>
            <th width="15%">提现金额</th>
            <td ><b class="storage"><?php echo $_smarty_tpl->tpl_vars['log']->value['money'];?>
￥</b></td>
            </tr>
            <tr>
                <th width="15%">提现时间</th>
                <td ><b class="storage"><?php echo $_smarty_tpl->tpl_vars['log']->value['add_time'];?>
</b></td>
            </tr>
            <tr>
                <th width="15%">日志</th>
                <td><span style="display:inline-block;width:600px;word-wrap:break-word;white-space:normal;
"><?php echo $_smarty_tpl->tpl_vars['log']->value['log'];?>
</span></td>
            </tr>
        </table>
    </div>
</div>
</body>
</html>
<?php }} ?>
