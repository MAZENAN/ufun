<?php /* Smarty version Smarty-3.1.19, created on 2019-07-08 09:08:09
         compiled from ".\Apps\Home\views\libs\kefu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:271575d2297791ec800-72536199%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ca47dd6f1a09cb4a9393dd28d39a951bb0f2334b' => 
    array (
      0 => '.\\Apps\\Home\\views\\libs\\kefu.tpl',
      1 => 1491472325,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '271575d2297791ec800-72536199',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'drs' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5d2297791fd1d3_64715843',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d2297791fd1d3_64715843')) {function content_5d2297791fd1d3_64715843($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_minimg')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\modifier.minimg.php';
?><div class="head-customer-t">
        <h1><a href="#">客服中心</a></h1>

        
        <?php  $_smarty_tpl->tpl_vars['drs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['drs']->_loop = false;
 $_from = DB::getlist('select * from @pf_customer limit 1',array()); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['drs']->key => $_smarty_tpl->tpl_vars['drs']->value) {
$_smarty_tpl->tpl_vars['drs']->_loop = true;
?>
                  
                
                  

          <div class="subnav-flow">
            <div class="subnav-flow-head"><img src="/public/images/subnav-flow.png" /></div>
            <div class="subnav-flow-box">
              <div class="subnav-flow-name">官<br />方<br />微<br />信</div>
              <div class="subnav-flow-code"><img src="<?php echo smarty_modifier_minimg($_smarty_tpl->tpl_vars['drs']->value['weixin'],0,0,1);?>
" style="width: 84px; height: 82px;" /></div>
              <div class="subnav-flow-list">
                <ul>
                    <li><a href="<?php echo $_smarty_tpl->tpl_vars['drs']->value['sina_weibo'];?>
" target="_blank" class="ico1">新浪微博</a></li>
                  <li><a href="<?php echo $_smarty_tpl->tpl_vars['drs']->value['tencent_weibo'];?>
" target="_blank" class="ico2">腾讯微博</a></li>
                  <li><a href="/single-contact.html" class="ico3">客服邮箱</a></li>
                </ul>
              </div>
              <div class="subnav-flow-tact">
                <div class="subnav-flow-tel"><?php echo $_smarty_tpl->tpl_vars['drs']->value['tel'];?>
</div>
                <div class="subnav-flow-note"><?php echo $_smarty_tpl->tpl_vars['drs']->value['work'];?>
</div>
                <div class="subnav-flow-btn"><a href="/single-contact.html">联系我们</a></div>
              </div>
              <div class="clear"></div>
            </div>
          </div>

                  <?php } ?>


      </div><?php }} ?>
