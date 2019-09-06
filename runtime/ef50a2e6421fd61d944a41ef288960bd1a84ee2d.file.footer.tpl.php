<?php /* Smarty version Smarty-3.1.19, created on 2019-07-08 09:08:09
         compiled from ".\Apps\Home\views\libs\footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:149755d229779261ad4-80337229%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ef50a2e6421fd61d944a41ef288960bd1a84ee2d' => 
    array (
      0 => '.\\Apps\\Home\\views\\libs\\footer.tpl',
      1 => 1491472324,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '149755d229779261ad4-80337229',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'config' => 0,
    'ls' => 0,
    'i' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5d22977927eca6_47168636',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d22977927eca6_47168636')) {function content_5d22977927eca6_47168636($_smarty_tpl) {?><div class="connect">
  <div class="head-customer-t conn_weixin">
    <div class="weixin_detail subnav-flow">
    <h2>官方微信</h2>
    <dl><img src="../public/images/connect/gongzhonghao@2x.png"></dl>
    <p>扫描关注微信公众号</p>
    </div>
  </div>
  <div class="head-customer-t conn_online">
    <div class="weixin_detail subnav-flow online_detail">
    <h2>客服咨询</h2>
    <dl><img src="../public/images/connect/xiaoshou-@2x.png"></dl>
    <ul>
      <li class="tel">400-878-3633</li>
      <li class="phone">13810022045</li>
      <li class="email">help@51camp.cn</li>
      <li class="webchat">yingtianxia007</li>
    </ul>
    <p>小橙老师</p>
    <dd>资深课程顾问</dd>
    </div>
  </div>
</div>
<div class="footer">
  <!--<div class="advantage">
    <ul>
      <li>
        <span><img src="/public/images/advantage-ico1.png" /></span>
        <div>
          <h1>甄选目的地</h1>
          <p>定期收集用户最真实需求，产品覆盖全球最优质游学目的地，让出国变得简单轻松。</p>
        </div>
      </li>
      <li>
        <span><img src="/public/images/advantage-ico2.png" /></span>
        <div>
          <h1>精选行程</h1>
          <p>80%产品以服务打包形式推出，在保证价格合理的同时，大大增加了产品的附加值。</p>
        </div>
      </li>
      <li style="margin-right:0;">
        <span><img src="/public/images/advantage-ico3.png" /></span>
        <div>
          <h1>放心选择</h1>
          <p><?php echo $_smarty_tpl->tpl_vars['config']->value['website_name'];?>
靠谱吗？针对产品购买体系，<?php echo $_smarty_tpl->tpl_vars['config']->value['website_name'];?>
提供了全套的售前、售中、售后服务，让您的游学变得放心、省心、安心。</p>
        </div>
      </li>
      <div class="clear"></div>
    </ul>
  </div>-->
  
  <div class="links">
    <ul>
      <li><span>合作支持</span>
      <?php  $_smarty_tpl->tpl_vars['ls'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ls']->_loop = false;
 $_from = DB::getlist('select * from @pf_partner where type =2 order by sort asc'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ls']->key => $_smarty_tpl->tpl_vars['ls']->value) {
$_smarty_tpl->tpl_vars['ls']->_loop = true;
?>
<a href="<?php echo $_smarty_tpl->tpl_vars['ls']->value['url'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['ls']->value['name'];?>
</a>
<?php } ?>
     
      </li>
      <li><span>友情链接</span><?php  $_smarty_tpl->tpl_vars['ls'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ls']->_loop = false;
 $_from = DB::getlist('select * from @pf_partner where type =1 order by sort asc'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ls']->key => $_smarty_tpl->tpl_vars['ls']->value) {
$_smarty_tpl->tpl_vars['ls']->_loop = true;
?>
<a href="<?php echo $_smarty_tpl->tpl_vars['ls']->value['url'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['ls']->value['name'];?>
</a>
<?php } ?></li>
    </ul>
  </div>
  
  <div class="copy">
    <div class="copy-box">
    <?php  $_smarty_tpl->tpl_vars['ls'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ls']->_loop = false;
 $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = DB::getlist('select * from @pf_singlepage where `group`=1 order by sort asc'); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ls']->key => $_smarty_tpl->tpl_vars['ls']->value) {
$_smarty_tpl->tpl_vars['ls']->_loop = true;
 $_smarty_tpl->tpl_vars['i']->value = $_smarty_tpl->tpl_vars['ls']->key;
?>
    <?php if ($_smarty_tpl->tpl_vars['i']->value!=0) {?><span>|</span><?php }?>
    <a href="/single-<?php echo $_smarty_tpl->tpl_vars['ls']->value['key'];?>
.html"><?php echo $_smarty_tpl->tpl_vars['ls']->value['title'];?>
</a>
    <?php } ?>
    <br /><?php echo $_smarty_tpl->tpl_vars['config']->value['copyright'];?>
&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['config']->value['keep'];?>

    </div>
    <!--<div class="copy-weition"><a href="#"></a></div>-->
  </div>
</div><?php }} ?>
