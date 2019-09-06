<?php /* Smarty version Smarty-3.1.19, created on 2019-09-05 11:33:55
         compiled from "modelskin:default" */ ?>
<?php /*%%SmartyHeaderCode:139945d708223310296-91988525%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '063cff865ed4e9bc766de2fe119e527a39628bb2' => 
    array (
      0 => 'modelskin:default',
      1 => 1491473409,
      2 => 'modelskin',
    ),
  ),
  'nocache_hash' => '139945d708223310296-91988525',
  'function' => 
  array (
    'model_title' => 
    array (
      'parameter' => 
      array (
        'model' => NULL,
      ),
      'compiled' => '',
    ),
    'model_tabs' => 
    array (
      'parameter' => 
      array (
        'model' => NULL,
      ),
      'compiled' => '',
    ),
    'model_toptip' => 
    array (
      'parameter' => 
      array (
        'model' => NULL,
        'tab' => 0,
      ),
      'compiled' => '',
    ),
    'model_header' => 
    array (
      'parameter' => 
      array (
        'model' => NULL,
        'tab' => 0,
      ),
      'compiled' => '',
    ),
    'model_footer' => 
    array (
      'parameter' => 
      array (
      ),
      'compiled' => '',
    ),
    'model_submit' => 
    array (
      'parameter' => 
      array (
        'model' => NULL,
      ),
      'compiled' => '',
    ),
    'model_form_default' => 
    array (
      'parameter' => 
      array (
        'model' => NULL,
        'box' => NULL,
        'key' => NULL,
      ),
      'compiled' => '',
    ),
    'model_form_kindeditor' => 
    array (
      'parameter' => 
      array (
        'model' => NULL,
        'box' => NULL,
        'key' => NULL,
      ),
      'compiled' => '',
    ),
    'model_form_line' => 
    array (
      'parameter' => 
      array (
        'model' => NULL,
        'box' => NULL,
        'key' => NULL,
      ),
      'compiled' => '',
    ),
    'model_form_modelplug' => 
    array (
      'parameter' => 
      array (
        'model' => NULL,
        'box' => NULL,
        'key' => NULL,
      ),
      'compiled' => '',
    ),
    'model_form_tinymce' => 
    array (
      'parameter' => 
      array (
        'model' => NULL,
        'box' => NULL,
        'key' => NULL,
      ),
      'compiled' => '',
    ),
    'model_form_ueditor' => 
    array (
      'parameter' => 
      array (
        'model' => NULL,
        'box' => NULL,
        'key' => NULL,
      ),
      'compiled' => '',
    ),
    'model_form_upgroup' => 
    array (
      'parameter' => 
      array (
        'model' => NULL,
        'box' => NULL,
        'key' => NULL,
      ),
      'compiled' => '',
    ),
    'model_form_upimggroup' => 
    array (
      'parameter' => 
      array (
        'model' => NULL,
        'box' => NULL,
        'key' => NULL,
      ),
      'compiled' => '',
    ),
    'model_form_xheditor' => 
    array (
      'parameter' => 
      array (
        'model' => NULL,
        'box' => NULL,
        'key' => NULL,
      ),
      'compiled' => '',
    ),
  ),
  'variables' => 
  array (
    'model' => 0,
    'idx' => 0,
    'tab' => 0,
    'box' => 0,
    'key' => 0,
  ),
  'has_nocache_code' => 0,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5d7082234c5ed5_88539851',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d7082234c5ed5_88539851')) {function content_5d7082234c5ed5_88539851($_smarty_tpl) {?><?php if (!function_exists('smarty_template_function_model_title')) {
    function smarty_template_function_model_title($_smarty_tpl,$params) {
    $saved_tpl_vars = $_smarty_tpl->tpl_vars;
    foreach ($_smarty_tpl->smarty->template_functions['model_title']['parameter'] as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);};
    foreach ($params as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);}?>
<div class="form-title"><?php echo $_smarty_tpl->tpl_vars['model']->value->attrs['title'];?>
</div>
<?php $_smarty_tpl->tpl_vars = $saved_tpl_vars;
foreach (Smarty::$global_tpl_vars as $key => $value) if(!isset($_smarty_tpl->tpl_vars[$key])) $_smarty_tpl->tpl_vars[$key] = $value;}}?>
<?php if (!function_exists('smarty_template_function_model_tabs')) {
    function smarty_template_function_model_tabs($_smarty_tpl,$params) {
    $saved_tpl_vars = $_smarty_tpl->tpl_vars;
    foreach ($_smarty_tpl->smarty->template_functions['model_tabs']['parameter'] as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);};
    foreach ($params as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);}?>
<?php if ($_smarty_tpl->tpl_vars['model']->value->attrs['istab']) {?>
<div class="form-tabs" id="form-tabs">
<?php if ($_smarty_tpl->tpl_vars['model']->value->attrs['tabsplit']) {?>
<?php  $_smarty_tpl->tpl_vars['tab'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['tab']->_loop = false;
 $_smarty_tpl->tpl_vars['idx'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['model']->value->attrs['tabs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['tab']->key => $_smarty_tpl->tpl_vars['tab']->value) {
$_smarty_tpl->tpl_vars['tab']->_loop = true;
 $_smarty_tpl->tpl_vars['idx']->value = $_smarty_tpl->tpl_vars['tab']->key;
?>
<?php if (strval($_smarty_tpl->tpl_vars['model']->value->attrs['model_tag'])==strval($_smarty_tpl->tpl_vars['idx']->value)) {?>
<b class="active"<?php if ($_smarty_tpl->tpl_vars['tab']->value==null) {?> style="display:none"<?php }?>><?php echo $_smarty_tpl->tpl_vars['tab']->value['name'];?>
</b>
<?php } else { ?>
<a href="<?php echo $_smarty_tpl->tpl_vars['tab']->value['url'];?>
" <?php if ($_smarty_tpl->tpl_vars['tab']->value==null) {?> style="display:none"<?php }?>><?php echo $_smarty_tpl->tpl_vars['tab']->value['name'];?>
</a>
<?php }?>
<?php } ?>
<?php } else { ?>
<?php  $_smarty_tpl->tpl_vars['tab'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['tab']->_loop = false;
 $_smarty_tpl->tpl_vars['idx'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['model']->value->attrs['tabs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['tab']->key => $_smarty_tpl->tpl_vars['tab']->value) {
$_smarty_tpl->tpl_vars['tab']->_loop = true;
 $_smarty_tpl->tpl_vars['idx']->value = $_smarty_tpl->tpl_vars['tab']->key;
?>
<?php if (strval($_smarty_tpl->tpl_vars['idx']->value)==strval($_smarty_tpl->tpl_vars['model']->value->attrs['tab_keys'][0])) {?>
<b idx="<?php echo $_smarty_tpl->tpl_vars['idx']->value;?>
" class="active"<?php if ($_smarty_tpl->tpl_vars['tab']->value==null) {?> style="display:none"<?php }?>><?php echo $_smarty_tpl->tpl_vars['tab']->value['name'];?>
</b>
<?php } else { ?>
<b idx="<?php echo $_smarty_tpl->tpl_vars['idx']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['tab']->value==null) {?> style="display:none"<?php }?>><?php echo $_smarty_tpl->tpl_vars['tab']->value['name'];?>
</b>
<?php }?>
<?php } ?>
<?php }?>
</div>
<?php }?>
<?php $_smarty_tpl->tpl_vars = $saved_tpl_vars;
foreach (Smarty::$global_tpl_vars as $key => $value) if(!isset($_smarty_tpl->tpl_vars[$key])) $_smarty_tpl->tpl_vars[$key] = $value;}}?>
<?php if (!function_exists('smarty_template_function_model_toptip')) {
    function smarty_template_function_model_toptip($_smarty_tpl,$params) {
    $saved_tpl_vars = $_smarty_tpl->tpl_vars;
    foreach ($_smarty_tpl->smarty->template_functions['model_toptip']['parameter'] as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);};
    foreach ($params as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);}?>
<?php if ($_smarty_tpl->tpl_vars['model']->value->attrs['toptip']) {?>
<div class="form-tips"><?php echo $_smarty_tpl->tpl_vars['model']->value->attrs['toptip'];?>
</div>
<?php }?><?php if ($_smarty_tpl->tpl_vars['model']->value->attrs['istab']) {?>
<?php if ($_smarty_tpl->tpl_vars['model']->value->attrs['tabsplit']) {?><?php  $_smarty_tpl->tpl_vars['tab'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['tab']->_loop = false;
 $_smarty_tpl->tpl_vars['idx'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['model']->value->attrs['tabs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['tab']->key => $_smarty_tpl->tpl_vars['tab']->value) {
$_smarty_tpl->tpl_vars['tab']->_loop = true;
 $_smarty_tpl->tpl_vars['idx']->value = $_smarty_tpl->tpl_vars['tab']->key;
?><?php if ($_smarty_tpl->tpl_vars['model']->value->attrs['model_tag']==$_smarty_tpl->tpl_vars['idx']->value&&$_smarty_tpl->tpl_vars['tab']->value['tips']) {?>
<div  id="form_tips_tabs_<?php echo $_smarty_tpl->tpl_vars['idx']->value;?>
" class="form-tips"><?php echo $_smarty_tpl->tpl_vars['tab']->value['tips'];?>
</div>
<?php }?><?php } ?><?php } else { ?><?php  $_smarty_tpl->tpl_vars['tab'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['tab']->_loop = false;
 $_smarty_tpl->tpl_vars['idx'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['model']->value->attrs['tabs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['tab']->key => $_smarty_tpl->tpl_vars['tab']->value) {
$_smarty_tpl->tpl_vars['tab']->_loop = true;
 $_smarty_tpl->tpl_vars['idx']->value = $_smarty_tpl->tpl_vars['tab']->key;
?><?php if ($_smarty_tpl->tpl_vars['tab']->value['tips']) {?>
<div id="form_tips_tabs_<?php echo $_smarty_tpl->tpl_vars['idx']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['idx']->value!=$_smarty_tpl->tpl_vars['model']->value->attrs['tab_keys'][0]) {?> style="display:none"<?php }?> class="form-tips"><?php echo $_smarty_tpl->tpl_vars['tab']->value['tips'];?>
</div>
<?php }?><?php } ?><?php }?><?php }?>
<?php $_smarty_tpl->tpl_vars = $saved_tpl_vars;
foreach (Smarty::$global_tpl_vars as $key => $value) if(!isset($_smarty_tpl->tpl_vars[$key])) $_smarty_tpl->tpl_vars[$key] = $value;}}?>
<?php if (!function_exists('smarty_template_function_model_header')) {
    function smarty_template_function_model_header($_smarty_tpl,$params) {
    $saved_tpl_vars = $_smarty_tpl->tpl_vars;
    foreach ($_smarty_tpl->smarty->template_functions['model_header']['parameter'] as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);};
    foreach ($params as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);}?>
<div class="form-panel" <?php if ($_smarty_tpl->tpl_vars['model']->value->attrs['istab']) {?> id="form_tabs_<?php echo $_smarty_tpl->tpl_vars['tab']->value;?>
" <?php }?> <?php if ($_smarty_tpl->tpl_vars['model']->value->attrs['tabsplit']==false&&$_smarty_tpl->tpl_vars['tab']->value!=$_smarty_tpl->tpl_vars['model']->value->attrs['tab_keys'][0]) {?> style="display:none"<?php }?>>
<?php $_smarty_tpl->tpl_vars = $saved_tpl_vars;
foreach (Smarty::$global_tpl_vars as $key => $value) if(!isset($_smarty_tpl->tpl_vars[$key])) $_smarty_tpl->tpl_vars[$key] = $value;}}?>
<?php if (!function_exists('smarty_template_function_model_footer')) {
    function smarty_template_function_model_footer($_smarty_tpl,$params) {
    $saved_tpl_vars = $_smarty_tpl->tpl_vars;
    foreach ($_smarty_tpl->smarty->template_functions['model_footer']['parameter'] as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);};
    foreach ($params as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);}?>
<div style="clear:both"></div>
</div>
<?php $_smarty_tpl->tpl_vars = $saved_tpl_vars;
foreach (Smarty::$global_tpl_vars as $key => $value) if(!isset($_smarty_tpl->tpl_vars[$key])) $_smarty_tpl->tpl_vars[$key] = $value;}}?>
<?php if (!function_exists('smarty_template_function_model_submit')) {
    function smarty_template_function_model_submit($_smarty_tpl,$params) {
    $saved_tpl_vars = $_smarty_tpl->tpl_vars;
    foreach ($_smarty_tpl->smarty->template_functions['model_submit']['parameter'] as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);};
    foreach ($params as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);}?>
<div class="form-submit" <?php if (!empty($_smarty_tpl->tpl_vars['model']->value->attrs['btns_left'])) {?> style="padding-left:<?php echo $_smarty_tpl->tpl_vars['model']->value->attrs['btns_left'];?>
px;" <?php }?>>
<input type="submit" class="submit" value="<?php echo $_smarty_tpl->tpl_vars['model']->value->attrs['acttext'];?>
" />
<?php if (!empty($_smarty_tpl->tpl_vars['model']->value->attrs['back'])) {?>
<input type="button" class="back" value="<?php echo $_smarty_tpl->tpl_vars['model']->value->attrs['back'];?>
" <?php if (!empty($_smarty_tpl->tpl_vars['model']->value->attrs['backscript'])) {?>onclick="<?php echo $_smarty_tpl->tpl_vars['model']->value->attrs['backscript'];?>
"<?php } else { ?>onclick="window.location.href='<?php echo (($tmp = @(($tmp = @$_POST['_BACKURL_'])===null||$tmp==='' ? $_SERVER['HTTP_REFERER'] : $tmp))===null||$tmp==='' ? '#' : $tmp);?>
';"<?php }?> />
<?php }?>
<?php if (!empty($_smarty_tpl->tpl_vars['model']->value->attrs['action'])) {?>
<input value="<?php echo $_smarty_tpl->tpl_vars['model']->value->attrs['action'];?>
" name="action" type="hidden" />
<?php }?>
<input value="<?php echo (($tmp = @(($tmp = @$_POST['_BACKURL_'])===null||$tmp==='' ? $_SERVER['HTTP_REFERER'] : $tmp))===null||$tmp==='' ? '' : $tmp);?>
" name="_BACKURL_" type="hidden" />
<div style="clear:both"></div>
</div>
<?php $_smarty_tpl->tpl_vars = $saved_tpl_vars;
foreach (Smarty::$global_tpl_vars as $key => $value) if(!isset($_smarty_tpl->tpl_vars[$key])) $_smarty_tpl->tpl_vars[$key] = $value;}}?>
<?php if (!function_exists('smarty_template_function_model_form_default')) {
    function smarty_template_function_model_form_default($_smarty_tpl,$params) {
    $saved_tpl_vars = $_smarty_tpl->tpl_vars;
    foreach ($_smarty_tpl->smarty->template_functions['model_form_default']['parameter'] as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);};
    foreach ($params as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);}?><?php if ($_smarty_tpl->tpl_vars['box']->value->merge==false) {?>
<div class="form-group" <?php echo $_smarty_tpl->tpl_vars['box']->value->row_hide;?>
 id="row_<?php echo $_smarty_tpl->tpl_vars['box']->value->boxname;?>
">
    <label class="form-label" <?php echo $_smarty_tpl->tpl_vars['box']->value->label_width;?>
><?php echo $_smarty_tpl->tpl_vars['box']->value->label;?>
<?php echo $_smarty_tpl->tpl_vars['box']->value->required;?>
：<?php if ($_smarty_tpl->tpl_vars['box']->value->tip_front) {?><p><?php echo $_smarty_tpl->tpl_vars['box']->value->tip_front;?>
</p><?php }?></label>
 <div class="form-box" <?php echo $_smarty_tpl->tpl_vars['box']->value->box_width;?>
><?php echo $_smarty_tpl->tpl_vars['box']->value->minititle;?>
<?php echo FormBox::Fdefault(array('name'=>$_smarty_tpl->tpl_vars['key']->value,'type'=>$_smarty_tpl->tpl_vars['box']->value->type,),$_smarty_tpl->tpl_vars['model']->value);?><?php echo $_smarty_tpl->tpl_vars['box']->value->tip_back;?>
<?php if ($_smarty_tpl->tpl_vars['box']->value->for_bymerge&&$_smarty_tpl->tpl_vars['box']->value->bymerge_type) {?><?php smarty_template_function_model_form_base($_smarty_tpl,array('model'=>$_smarty_tpl->tpl_vars['model']->value,'key'=>$_smarty_tpl->tpl_vars['box']->value->nextkey));?>
<?php }?><?php echo $_smarty_tpl->tpl_vars['box']->value->data_val_info;?>
</div>
<?php if ($_smarty_tpl->tpl_vars['box']->value->for_bymerge&&$_smarty_tpl->tpl_vars['box']->value->bymerge_type==false) {?><?php smarty_template_function_model_form_base($_smarty_tpl,array('model'=>$_smarty_tpl->tpl_vars['model']->value,'key'=>$_smarty_tpl->tpl_vars['box']->value->nextkey));?>
<?php }?>
</div>

<?php } else { ?>
<?php if (empty($_smarty_tpl->tpl_vars['box']->value->merge_type)) {?>
 <label class="form-label" <?php echo $_smarty_tpl->tpl_vars['box']->value->label_width;?>
><?php echo $_smarty_tpl->tpl_vars['box']->value->label;?>
<?php echo $_smarty_tpl->tpl_vars['box']->value->required;?>
：</label>
 <div class="form-box" <?php echo $_smarty_tpl->tpl_vars['box']->value->box_width;?>
><?php echo $_smarty_tpl->tpl_vars['box']->value->minititle;?>
<?php echo FormBox::Fdefault(array('name'=>$_smarty_tpl->tpl_vars['key']->value,'type'=>$_smarty_tpl->tpl_vars['box']->value->type,),$_smarty_tpl->tpl_vars['model']->value);?><?php echo $_smarty_tpl->tpl_vars['box']->value->tip_back;?>
<?php echo $_smarty_tpl->tpl_vars['box']->value->data_val_info;?>
</div>
<?php } else { ?>
<span  id="row_<?php echo $_smarty_tpl->tpl_vars['box']->value->boxname;?>
">
&nbsp;&nbsp;<?php if (!empty($_smarty_tpl->tpl_vars['box']->value->label)&&$_smarty_tpl->tpl_vars['box']->value->label[0]!='#') {?><?php echo $_smarty_tpl->tpl_vars['box']->value->label;?>
：<?php }?><?php echo FormBox::Fdefault(array('name'=>$_smarty_tpl->tpl_vars['key']->value,'type'=>$_smarty_tpl->tpl_vars['box']->value->type,),$_smarty_tpl->tpl_vars['model']->value);?><?php echo $_smarty_tpl->tpl_vars['box']->value->tip_back;?>

</span>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['box']->value->for_bymerge) {?><?php smarty_template_function_model_form_base($_smarty_tpl,array('model'=>$_smarty_tpl->tpl_vars['model']->value,'key'=>$_smarty_tpl->tpl_vars['box']->value->nextkey));?>
<?php }?>
<?php }?><?php $_smarty_tpl->tpl_vars = $saved_tpl_vars;
foreach (Smarty::$global_tpl_vars as $key => $value) if(!isset($_smarty_tpl->tpl_vars[$key])) $_smarty_tpl->tpl_vars[$key] = $value;}}?>
<?php if (!function_exists('smarty_template_function_model_form_kindeditor')) {
    function smarty_template_function_model_form_kindeditor($_smarty_tpl,$params) {
    $saved_tpl_vars = $_smarty_tpl->tpl_vars;
    foreach ($_smarty_tpl->smarty->template_functions['model_form_kindeditor']['parameter'] as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);};
    foreach ($params as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);}?><div class="form-group" <?php echo $_smarty_tpl->tpl_vars['box']->value->row_hide;?>
 id="row_<?php echo $_smarty_tpl->tpl_vars['box']->value->boxname;?>
">
 <div class="form-box" style="display:table-row; width:100%;"><label class="form-label"><?php echo $_smarty_tpl->tpl_vars['box']->value->label;?>
<?php echo $_smarty_tpl->tpl_vars['box']->value->required;?>
</label> <?php if (!empty($_smarty_tpl->tpl_vars['box']->value->tip_front)) {?><span class=hui><?php echo $_smarty_tpl->tpl_vars['box']->value->tip_front;?>
</span><?php }?><?php echo $_smarty_tpl->tpl_vars['box']->value->tip_back;?>
<?php echo $_smarty_tpl->tpl_vars['box']->value->data_val_info;?>
</div>
 <div class="form-box form-xheditor" style="display:table-row; width:100%;"><?php echo FormBox::kindeditor(array('name'=>$_smarty_tpl->tpl_vars['key']->value,'type'=>$_smarty_tpl->tpl_vars['box']->value->type,),$_smarty_tpl->tpl_vars['model']->value);?></div>
</div><?php $_smarty_tpl->tpl_vars = $saved_tpl_vars;
foreach (Smarty::$global_tpl_vars as $key => $value) if(!isset($_smarty_tpl->tpl_vars[$key])) $_smarty_tpl->tpl_vars[$key] = $value;}}?>
<?php if (!function_exists('smarty_template_function_model_form_line')) {
    function smarty_template_function_model_form_line($_smarty_tpl,$params) {
    $saved_tpl_vars = $_smarty_tpl->tpl_vars;
    foreach ($_smarty_tpl->smarty->template_functions['model_form_line']['parameter'] as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);};
    foreach ($params as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);}?><div class="form-group" <?php echo $_smarty_tpl->tpl_vars['box']->value->row_hide;?>
 id="row_<?php echo $_smarty_tpl->tpl_vars['box']->value->boxname;?>
">
<div class="form-line">
<strong><label class="form-label"><?php echo $_smarty_tpl->tpl_vars['box']->value->label;?>
</label></strong><?php echo $_smarty_tpl->tpl_vars['box']->value->tip_back;?>

</div>
</div><?php $_smarty_tpl->tpl_vars = $saved_tpl_vars;
foreach (Smarty::$global_tpl_vars as $key => $value) if(!isset($_smarty_tpl->tpl_vars[$key])) $_smarty_tpl->tpl_vars[$key] = $value;}}?>
<?php if (!function_exists('smarty_template_function_model_form_modelplug')) {
    function smarty_template_function_model_form_modelplug($_smarty_tpl,$params) {
    $saved_tpl_vars = $_smarty_tpl->tpl_vars;
    foreach ($_smarty_tpl->smarty->template_functions['model_form_modelplug']['parameter'] as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);};
    foreach ($params as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);}?><?php if ($_smarty_tpl->tpl_vars['box']->value->plug_table) {?>
<div class="form-group" <?php echo $_smarty_tpl->tpl_vars['box']->value->row_hide;?>
 id="row_<?php echo $_smarty_tpl->tpl_vars['box']->value->boxname;?>
">
 <div class="form-box" style="display:table-row; width:100%;"><label class="form-label" style="float:left"><?php echo $_smarty_tpl->tpl_vars['box']->value->label;?>
<?php echo $_smarty_tpl->tpl_vars['box']->value->required;?>
</label> <?php if (!empty($_smarty_tpl->tpl_vars['box']->value->tip_front)) {?><span class=hui><?php echo $_smarty_tpl->tpl_vars['box']->value->tip_front;?>
</span><?php }?><?php echo $_smarty_tpl->tpl_vars['box']->value->tip_back;?>
<?php echo $_smarty_tpl->tpl_vars['box']->value->data_val_info;?>
</div>
 <div class="form-box form-modelplug" style="display:table-row; width:100%;"><?php echo FormBox::Fdefault(array('name'=>$_smarty_tpl->tpl_vars['key']->value,'type'=>$_smarty_tpl->tpl_vars['box']->value->type,),$_smarty_tpl->tpl_vars['model']->value);?>
 <div class="clear" style="height:10px;"></div>
 </div>
</div>
<?php } else { ?>
<div class="form-group" <?php echo $_smarty_tpl->tpl_vars['box']->value->row_hide;?>
 id="row_<?php echo $_smarty_tpl->tpl_vars['box']->value->boxname;?>
">
<label class="form-label" <?php echo $_smarty_tpl->tpl_vars['box']->value->label_width;?>
><?php echo $_smarty_tpl->tpl_vars['box']->value->label;?>
<?php echo $_smarty_tpl->tpl_vars['box']->value->required;?>
：<?php if ($_smarty_tpl->tpl_vars['box']->value->tip_front) {?><p><?php echo $_smarty_tpl->tpl_vars['box']->value->tip_front;?>
</p><?php }?></label>
<div class="form-box" <?php echo $_smarty_tpl->tpl_vars['box']->value->box_width;?>
><?php echo $_smarty_tpl->tpl_vars['box']->value->minititle;?>
<?php echo FormBox::Fdefault(array('name'=>$_smarty_tpl->tpl_vars['key']->value,'type'=>$_smarty_tpl->tpl_vars['box']->value->type,),$_smarty_tpl->tpl_vars['model']->value);?><?php echo $_smarty_tpl->tpl_vars['box']->value->tip_back;?>
<?php echo $_smarty_tpl->tpl_vars['box']->value->data_val_info;?>
</div>
</div>
<?php }?><?php $_smarty_tpl->tpl_vars = $saved_tpl_vars;
foreach (Smarty::$global_tpl_vars as $key => $value) if(!isset($_smarty_tpl->tpl_vars[$key])) $_smarty_tpl->tpl_vars[$key] = $value;}}?>
<?php if (!function_exists('smarty_template_function_model_form_tinymce')) {
    function smarty_template_function_model_form_tinymce($_smarty_tpl,$params) {
    $saved_tpl_vars = $_smarty_tpl->tpl_vars;
    foreach ($_smarty_tpl->smarty->template_functions['model_form_tinymce']['parameter'] as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);};
    foreach ($params as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);}?><div class="form-group" <?php echo $_smarty_tpl->tpl_vars['box']->value->row_hide;?>
 id="row_<?php echo $_smarty_tpl->tpl_vars['box']->value->boxname;?>
">
 <div class="form-box" style="display:table-row; width:100%;"><label class="form-label"><?php echo $_smarty_tpl->tpl_vars['box']->value->label;?>
<?php echo $_smarty_tpl->tpl_vars['box']->value->required;?>
</label> <?php if (!empty($_smarty_tpl->tpl_vars['box']->value->tip_front)) {?><span class=hui><?php echo $_smarty_tpl->tpl_vars['box']->value->tip_front;?>
</span><?php }?><?php echo $_smarty_tpl->tpl_vars['box']->value->tip_back;?>
<?php echo $_smarty_tpl->tpl_vars['box']->value->data_val_info;?>
</div>
 <div class="form-box form-xheditor" style="display:table-row; width:100%;"><?php echo FormBox::tinymce(array('name'=>$_smarty_tpl->tpl_vars['key']->value,'type'=>$_smarty_tpl->tpl_vars['box']->value->type,),$_smarty_tpl->tpl_vars['model']->value);?></div>
</div><?php $_smarty_tpl->tpl_vars = $saved_tpl_vars;
foreach (Smarty::$global_tpl_vars as $key => $value) if(!isset($_smarty_tpl->tpl_vars[$key])) $_smarty_tpl->tpl_vars[$key] = $value;}}?>
<?php if (!function_exists('smarty_template_function_model_form_ueditor')) {
    function smarty_template_function_model_form_ueditor($_smarty_tpl,$params) {
    $saved_tpl_vars = $_smarty_tpl->tpl_vars;
    foreach ($_smarty_tpl->smarty->template_functions['model_form_ueditor']['parameter'] as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);};
    foreach ($params as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);}?><div class="form-group" <?php echo $_smarty_tpl->tpl_vars['box']->value->row_hide;?>
 id="row_<?php echo $_smarty_tpl->tpl_vars['box']->value->boxname;?>
">
 <div class="form-box" style="display:table-row; width:100%;"><label class="form-label" style="float:left"><?php echo $_smarty_tpl->tpl_vars['box']->value->label;?>
<?php echo $_smarty_tpl->tpl_vars['box']->value->required;?>
</label> <?php if (!empty($_smarty_tpl->tpl_vars['box']->value->tip_front)) {?><span class=hui><?php echo $_smarty_tpl->tpl_vars['box']->value->tip_front;?>
</span><?php }?><?php echo $_smarty_tpl->tpl_vars['box']->value->tip_back;?>
<?php echo $_smarty_tpl->tpl_vars['box']->value->data_val_info;?>
</div>
 <div class="form-box form-ueditor" style="display:table-row;width:calc(100%-20px);"><?php echo FormBox::ueditor(array('name'=>$_smarty_tpl->tpl_vars['key']->value,'type'=>$_smarty_tpl->tpl_vars['box']->value->type,),$_smarty_tpl->tpl_vars['model']->value);?></div>
</div><?php $_smarty_tpl->tpl_vars = $saved_tpl_vars;
foreach (Smarty::$global_tpl_vars as $key => $value) if(!isset($_smarty_tpl->tpl_vars[$key])) $_smarty_tpl->tpl_vars[$key] = $value;}}?>
<?php if (!function_exists('smarty_template_function_model_form_upgroup')) {
    function smarty_template_function_model_form_upgroup($_smarty_tpl,$params) {
    $saved_tpl_vars = $_smarty_tpl->tpl_vars;
    foreach ($_smarty_tpl->smarty->template_functions['model_form_upgroup']['parameter'] as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);};
    foreach ($params as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);}?><div class="form-group" <?php echo $_smarty_tpl->tpl_vars['box']->value->row_hide;?>
 id="row_<?php echo $_smarty_tpl->tpl_vars['box']->value->boxname;?>
">
<table class="smbox-row">
<tr><th <?php echo $_smarty_tpl->tpl_vars['box']->value->label_width;?>
><label class="form-label"><?php echo $_smarty_tpl->tpl_vars['box']->value->label;?>
<?php echo $_smarty_tpl->tpl_vars['box']->value->required;?>
：</label></th><td><div id="tips_<?php echo $_smarty_tpl->tpl_vars['box']->value->boxname;?>
"><?php echo FormBox::upgroup(array('name'=>$_smarty_tpl->tpl_vars['key']->value,'type'=>$_smarty_tpl->tpl_vars['box']->value->type,),$_smarty_tpl->tpl_vars['model']->value);?><?php echo $_smarty_tpl->tpl_vars['box']->value->tip_back;?>
<?php echo $_smarty_tpl->tpl_vars['box']->value->data_val_info;?>
</div></td></tr>
<tr><th <?php echo $_smarty_tpl->tpl_vars['box']->value->label_width;?>
 height="30"><?php if (!empty($_smarty_tpl->tpl_vars['box']->value->tip_front)) {?><span class=hui><?php echo $_smarty_tpl->tpl_vars['box']->value->tip_front;?>
</span><?php }?></th><td><div class="smbox-upgroup-show" id="up_shower_<?php echo $_smarty_tpl->tpl_vars['box']->value->boxname;?>
"><div class="smbox-splito"></div></div></td></tr>
</table>
</div><?php $_smarty_tpl->tpl_vars = $saved_tpl_vars;
foreach (Smarty::$global_tpl_vars as $key => $value) if(!isset($_smarty_tpl->tpl_vars[$key])) $_smarty_tpl->tpl_vars[$key] = $value;}}?>
<?php if (!function_exists('smarty_template_function_model_form_upimggroup')) {
    function smarty_template_function_model_form_upimggroup($_smarty_tpl,$params) {
    $saved_tpl_vars = $_smarty_tpl->tpl_vars;
    foreach ($_smarty_tpl->smarty->template_functions['model_form_upimggroup']['parameter'] as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);};
    foreach ($params as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);}?><div class="form-group" <?php echo $_smarty_tpl->tpl_vars['box']->value->row_hide;?>
 id="row_<?php echo $_smarty_tpl->tpl_vars['box']->value->boxname;?>
">
<table class="smbox-row">   
<tr><th <?php echo $_smarty_tpl->tpl_vars['box']->value->label_width;?>
><label class="form-label"><?php echo $_smarty_tpl->tpl_vars['box']->value->label;?>
<?php echo $_smarty_tpl->tpl_vars['box']->value->required;?>
：</label><?php if (!empty($_smarty_tpl->tpl_vars['box']->value->tip_front)) {?><br><span class=hui><?php echo $_smarty_tpl->tpl_vars['box']->value->tip_front;?>
</span><?php }?></th>
<td><div id="tips_<?php echo $_smarty_tpl->tpl_vars['box']->value->boxname;?>
"><?php echo FormBox::upimggroup(array('name'=>$_smarty_tpl->tpl_vars['key']->value,'type'=>$_smarty_tpl->tpl_vars['box']->value->type,),$_smarty_tpl->tpl_vars['model']->value);?><?php echo $_smarty_tpl->tpl_vars['box']->value->tip_back;?>
<?php echo $_smarty_tpl->tpl_vars['box']->value->data_val_info;?>
</div></td>
</tr>  
</table>
</div><?php $_smarty_tpl->tpl_vars = $saved_tpl_vars;
foreach (Smarty::$global_tpl_vars as $key => $value) if(!isset($_smarty_tpl->tpl_vars[$key])) $_smarty_tpl->tpl_vars[$key] = $value;}}?>
<?php if (!function_exists('smarty_template_function_model_form_xheditor')) {
    function smarty_template_function_model_form_xheditor($_smarty_tpl,$params) {
    $saved_tpl_vars = $_smarty_tpl->tpl_vars;
    foreach ($_smarty_tpl->smarty->template_functions['model_form_xheditor']['parameter'] as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);};
    foreach ($params as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);}?><div class="form-group" <?php echo $_smarty_tpl->tpl_vars['box']->value->row_hide;?>
 id="row_<?php echo $_smarty_tpl->tpl_vars['box']->value->boxname;?>
">
 <div class="form-box" style="display:table-row; width:100%;"><label class="form-label" style="float:left"><?php echo $_smarty_tpl->tpl_vars['box']->value->label;?>
<?php echo $_smarty_tpl->tpl_vars['box']->value->required;?>
</label> <?php if (!empty($_smarty_tpl->tpl_vars['box']->value->tip_front)) {?><span class=hui><?php echo $_smarty_tpl->tpl_vars['box']->value->tip_front;?>
</span><?php }?><?php echo $_smarty_tpl->tpl_vars['box']->value->tip_back;?>
<?php echo $_smarty_tpl->tpl_vars['box']->value->data_val_info;?>
</div>
 <div class="form-box form-xheditor" style="display:table-row; width:100%;"><?php echo FormBox::xheditor(array('name'=>$_smarty_tpl->tpl_vars['key']->value,'type'=>$_smarty_tpl->tpl_vars['box']->value->type,),$_smarty_tpl->tpl_vars['model']->value);?></div>
</div><?php $_smarty_tpl->tpl_vars = $saved_tpl_vars;
foreach (Smarty::$global_tpl_vars as $key => $value) if(!isset($_smarty_tpl->tpl_vars[$key])) $_smarty_tpl->tpl_vars[$key] = $value;}}?>
<?php }} ?>
