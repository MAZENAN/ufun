<?php /* Smarty version Smarty-3.1.19, created on 2019-05-14 16:53:13
         compiled from ".\Apps\Home\views\cncamp_detail.tpl" */ ?>
<?php /*%%SmartyHeaderCode:216475cda81f9accd81-77381828%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f23bbedc5fe45f4298cc83f936ed1ae6709b9539' => 
    array (
      0 => '.\\Apps\\Home\\views\\cncamp_detail.tpl',
      1 => 1491472327,
      2 => 'file',
    ),
    '5b38e535b597905f89b97c3ca16adbb4cea8105d' => 
    array (
      0 => '.\\Apps\\Home\\views\\libs\\layout.tpl',
      1 => 1491472323,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '216475cda81f9accd81-77381828',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'config' => 0,
    'rs' => 0,
    'title' => 0,
    'Description' => 0,
    'Keywords' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5cda81f9c2ced4_22747922',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5cda81f9c2ced4_22747922')) {function content_5cda81f9c2ced4_22747922($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_minimg')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\modifier.minimg.php';
if (!is_callable('smarty_modifier_img_add_host')) include 'E:\\WWW\\waimai\\Web\\samao\\smarty\\ext\\plugins\\modifier.img_add_host.php';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php if (Route::get('ctl')=='index') {?> <?php echo $_smarty_tpl->tpl_vars['config']->value['website_name'];?>
丨找夏令营，上营天下！ <?php } else { ?> <?php if ($_smarty_tpl->tpl_vars['rs']->value['title']) {?><?php echo $_smarty_tpl->tpl_vars['rs']->value['title'];?>
丨<?php } elseif ($_smarty_tpl->tpl_vars['title']->value) {?><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
丨<?php }?><?php echo $_smarty_tpl->tpl_vars['config']->value['website_name'];?>
 <?php }?></title>
<meta name="description" content="<?php echo $_smarty_tpl->tpl_vars['Description']->value;?>
">
<meta name="keywords"  content="<?php echo $_smarty_tpl->tpl_vars['Keywords']->value;?>
">
<link href="/public/css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/public/js/jquery.min.js"></script>
<script type="text/javascript" src="/public/js/jquery.jslides.js"></script>
<script type="text/javascript" src="/public/js/simplefoucs.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.validate.js"></script>
<link rel="shortcut icon" href="/public/images/favicon.ico" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
<meta property="qc:admins" content="22423175776513150636" />
<meta property="wb:webmaster" content="f62972e62973a159" />
<meta property="qc:admins" content="36065775766513150636747716711154060454" />
<meta property="qc:admins" content="36065777121506367" />

<script type="text/javascript" src="/public/js/detail.js" charset="utf-8"></script>
<script type="text/javascript" src="/public/js/getcomments.js" charset="utf-8"></script>

</head>
<body>
<?php echo $_smarty_tpl->getSubTemplate ("libs/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div class="top">
  <div class="top-box">
    <div class="logo"><a href="index.html" title="营天下丨找夏令营，上营天下！"><img src="/public/images/logo.png" width="191" alt="营天下丨找夏令营，上营天下！" /></a></div>
    <?php echo $_smarty_tpl->getSubTemplate ("libs/inc_search.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    <div class="clear"></div>
  </div>
</div>

<div class="menu">
  <ul>
    <li><a href="/index.html"<?php if (Route::get('ctl')=='index') {?> class="on"<?php }?>>首页</a></li>
    <li><a href="/cncamp.html"<?php if (Route::get('ctl')=='cncamp') {?> class="on"<?php }?>>国内营</a></li>
    <li><a href="/glcamp.html"<?php if (Route::get('ctl')=='glcamp') {?> class="on"<?php }?>>国际营</a></li>
    <li><a href="/campedu.html"<?php if (Route::get('ctl')=='campedu') {?> class="on"<?php }?>>营地教育</a></li>
  </ul>
</div>


<div class="wrap">
  <div class="thecon-intro">
    <div class="thecon-intro-tit"><?php echo $_smarty_tpl->tpl_vars['rs']->value['title'];?>
<?php if ($_smarty_tpl->tpl_vars['rs']->value['ncost']==0) {?>(已截止)<?php }?>
        <div class="thecon-intro-share">
            <!-- JiaThis Button BEGIN -->
<div class="jiathis_style">
	<a class="jiathis_button_qzone"></a>
	<a class="jiathis_button_tsina"></a>
	<a class="jiathis_button_tqq"></a>
	<a class="jiathis_button_weixin"></a>
	<a class="jiathis_button_renren"></a>
	<a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jtico jtico_jiathis" target="_blank"></a>
	<a class="jiathis_counter_style"></a>
</div>
<script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
<!-- JiaThis Button END -->
        </div>
    </div>
    <div class="thecon-intro-main">
      <div class="thecon-intro-img"><img src="<?php echo smarty_modifier_minimg($_smarty_tpl->tpl_vars['rs']->value['cover'],360,270,1);?>
" /></div>
      <div class="thecon-intro-con">
        <div class="thecon-intro-list">
        <form id="orderform" method="get" action="/buy-<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
.html">
          <div class="thecon-inlis-left">
            <ul>
               <li>项目地点：<?php echo $_smarty_tpl->tpl_vars['rs']->value['camp_location'];?>
</li>
                 <li>适合年龄：<span class="orange"><?php if ($_smarty_tpl->tpl_vars['rs']->value['agefrom']==$_smarty_tpl->tpl_vars['rs']->value['ageto']) {?><?php echo $_smarty_tpl->tpl_vars['rs']->value['agefrom'];?>
<?php } else { ?><?php echo $_smarty_tpl->tpl_vars['rs']->value['agefrom'];?>
-<?php echo $_smarty_tpl->tpl_vars['rs']->value['ageto'];?>
<?php }?> </span> 岁</li>
                
                 

                  <li>是否亲子：<?php echo DB::getval('@pf_camp_type','name',$_smarty_tpl->tpl_vars['rs']->value['camp_type']);?>
</li>
            </ul>
          </div>
          <div class="thecon-inlis-right">
            <ul>
              <li><h1>报名截止日期：<?php echo $_smarty_tpl->tpl_vars['rs']->value['deadline'];?>
</h1></li>
              <li>
                <div class="thecon-inlis-tit">出发日期：</div>
                <div class="thecon-inlis-select">
                <?php $_smarty_tpl->tpl_vars['select'] = new Smarty_variable(true, null, 0);?>
                <select name="depid">
                  <?php if ($_smarty_tpl->tpl_vars['rs']->value['ncost']==0) {?><option value="">暂无可选行程时间</option><?php }?>
                 <?php  $_smarty_tpl->tpl_vars['drs'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['drs']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['times']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['drs']->key => $_smarty_tpl->tpl_vars['drs']->value) {
$_smarty_tpl->tpl_vars['drs']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['drs']->key;
?>
                  <option href="#" value="<?php echo $_smarty_tpl->tpl_vars['drs']->value['id'];?>
" data-id='<?php echo $_smarty_tpl->tpl_vars['drs']->value['id'];?>
' data-allow="<?php echo $_smarty_tpl->tpl_vars['drs']->value['allow'];?>
" data-cost='<?php echo $_smarty_tpl->tpl_vars['drs']->value['cost'];?>
'  data-deposit='<?php echo $_smarty_tpl->tpl_vars['drs']->value['deposit'];?>
' class="sel-item <?php if ($_smarty_tpl->tpl_vars['drs']->value['cost']==$_smarty_tpl->tpl_vars['rs']->value['ncost']&&$_smarty_tpl->tpl_vars['select']->value==true&&$_smarty_tpl->tpl_vars['drs']->value['allow']==2) {?>on<?php }?>"<?php if ($_smarty_tpl->tpl_vars['drs']->value['cost']==$_smarty_tpl->tpl_vars['rs']->value['ncost']&&$_smarty_tpl->tpl_vars['select']->value==true&&$_smarty_tpl->tpl_vars['drs']->value['allow']==2) {?><?php $_smarty_tpl->tpl_vars['select'] = new Smarty_variable(false, null, 0);?>selected<?php }?>>
                 <?php echo Comm::formatCampDate($_smarty_tpl->tpl_vars['drs']->value);?>
<?php if ($_smarty_tpl->tpl_vars['drs']->value['allow']==0) {?>(已截止)<?php }?><?php if ($_smarty_tpl->tpl_vars['drs']->value['allow']==1) {?>(未开始)<?php }?>
                  </option>
                  <?php }
if (!$_smarty_tpl->tpl_vars['drs']->_loop) {
?>
                  <a href="#">暂未安排行程时间</a>
                  <?php } ?>
                  </select>
                  <!-- <input type="hidden" id="depid" name="depid" value="<?php echo $_smarty_tpl->tpl_vars['times']->value[0]['id'];?>
"> -->
                  <input type="hidden" name="type" value="cncamp">
                </div>
                <div class="clear"></div>
              </li>
             
            </ul>
          </div>
         </form>
          <div class="clear"></div>
        </div>
        <div class="thecon-intro-note">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="410" align="left" valign="middle">
                  <h1>项目特色</h1>
                  <ul>
                   <?php  $_smarty_tpl->tpl_vars['pt'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['pt']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['rs']->value['features']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['pt']->key => $_smarty_tpl->tpl_vars['pt']->value) {
$_smarty_tpl->tpl_vars['pt']->_loop = true;
?>
                      <?php if (trim($_smarty_tpl->tpl_vars['pt']->value)!='') {?>
                       <li><?php echo $_smarty_tpl->tpl_vars['pt']->value;?>
</li>
                      <?php }?>
		<?php } ?>
                  
                  </ul>
                </td>
                <td width="150" align="left" valign="middle" id="price">
                    <?php if ($_smarty_tpl->tpl_vars['rs']->value['ncost']) {?>费　用 : <span>￥<?php echo $_smarty_tpl->tpl_vars['rs']->value['ncost'];?>
</span>元<br /><?php } else { ?><b>&nbsp;&nbsp;暂无报价&nbsp;&nbsp;</b><?php }?>
                    
                </td>
                <td align="center" valign="middle">
                 <li class="collection"><?php if ($_smarty_tpl->tpl_vars['rs']->value['favorites']>0) {?><a href="/favorites/delete.html?type=cncamp&camp=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
"><span>已收藏</span></a><?php } else { ?><a target="_blank" href="/favorites/add.html?camp=<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
"><span>加入收藏</span></a><?php }?></li>
                <?php if ($_smarty_tpl->tpl_vars['rs']->value['btntext']=='立即预定') {?>
                <a href="javascript:;" class="global_buy">立即预定</a>
                <?php } else { ?>
                <a href="javascript:;" class="global_buy2"><?php echo $_smarty_tpl->tpl_vars['rs']->value['btntext'];?>
</a>
                <?php }?>
                </td>
              </tr>
            </table>
        </div>
      </div>
      <div class="clear"></div>
    </div>
  </div>  
  <div class="thecon-main">
  <div style="height:44px;">
      <div class="thecon-tag fixedtop">
      <ul>
        <li><a data-name="xmjs" href="#" class="on">项目介绍</a></li>
        <li><a data-name="rcap" href="#">日程安排</a></li>
        <li><a data-name="bmxz"  href="#">报名须知</a></li>
        <li><a data-name="fysm"  href="#">费用说明</a></li>
        <li><a data-name="zysx" href="#">注意事项</a></li>
        <li><a data-name="pj" href="#">评价<?php if ($_smarty_tpl->tpl_vars['comment_mark_count']->value>0) {?>(<?php echo $_smarty_tpl->tpl_vars['comment_mark_count']->value;?>
)<?php }?></a></li>
        <li ><a data-name="pl" href="#">活动咨询<?php if ($_smarty_tpl->tpl_vars['comment_count']->value>0) {?>(<?php echo $_smarty_tpl->tpl_vars['comment_count']->value;?>
)<?php }?></a></li>
       
      </ul>
    </div>
    </div>
    
    
    <div class="themai xmjs">
      <div class="themai-tit"><span>项目介绍</span></div>
      <div class="themai-box">
        <div class="global-con">
        <?php echo smarty_modifier_img_add_host($_smarty_tpl->tpl_vars['rs']->value['content']);?>

        </div>
      </div>
    </div>
    
    
    
    
    
    <div class="themai rcap">
      <div class="themai-tit"><span>日程安排</span></div>
      <div class="themai-box">
        <div class="themai-schedule">
          <div style="width:150px;float:left;">
            <?php $_smarty_tpl->tpl_vars['select'] = new Smarty_variable(true, null, 0);?>
             <ul class="day-menu">
            <?php  $_smarty_tpl->tpl_vars['pt'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['pt']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['rs']->value['itinerary']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['pt']->key => $_smarty_tpl->tpl_vars['pt']->value) {
$_smarty_tpl->tpl_vars['pt']->_loop = true;
?>
                <li <?php if ($_smarty_tpl->tpl_vars['select']->value) {?> class="on" <?php $_smarty_tpl->tpl_vars['select'] = new Smarty_variable(false, null, 0);?><?php }?>>
                    <div class="themai-schedule-ico"><span></span></div>
                    <a href="#" class="themai-schedule-day"><?php echo $_smarty_tpl->tpl_vars['pt']->value['name'];?>
<br /><?php echo $_smarty_tpl->tpl_vars['pt']->value['tic'];?>
</a>
                </li>    
            <?php } ?>
             </ul>
             <div class="clear"></div>
            </div>
          <div class="day-info">
          <ul class="day-list">
          <?php  $_smarty_tpl->tpl_vars['pt'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['pt']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['rs']->value['itinerary']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['pt']->key => $_smarty_tpl->tpl_vars['pt']->value) {
$_smarty_tpl->tpl_vars['pt']->_loop = true;
?>
          <li class="day-item">
              <div class="global_d">
                  <div class="global_d-left" <?php if (!$_smarty_tpl->tpl_vars['pt']->value['img']) {?> style="width:auto;" <?php }?>>
                  <div class="div">
                    <h1><?php echo $_smarty_tpl->tpl_vars['pt']->value['name'];?>
</h1>
                    <h2><?php echo $_smarty_tpl->tpl_vars['pt']->value['tic'];?>
</h2>
                  </div>
                  <p><?php echo smarty_modifier_img_add_host($_smarty_tpl->tpl_vars['pt']->value['content']);?>
</p>
                 
                </div>
                <?php if ($_smarty_tpl->tpl_vars['pt']->value['img']) {?>
                <div class="global_d-right"><img src="<?php echo smarty_modifier_minimg($_smarty_tpl->tpl_vars['pt']->value['img'],200,200,1);?>
" /></div>
                <?php }?>
                <div class="clear"></div>
              </div>
            </li>
          <?php } ?>
           <div class="notes"><?php echo $_smarty_tpl->tpl_vars['rs']->value['stroke_note'];?>
</div>
          </ul>
          <div class="clear"></div>
          
          </div>
         
          <div class="clear"></div>
          
        </div>
      </div>
    </div>
    <div class="themai bmxz">
      <div class="themai-tit"><span>报名须知</span></div>
      <div class="themai-box">
        <div class="themai-notice"><?php echo smarty_modifier_img_add_host($_smarty_tpl->tpl_vars['rs']->value['application_notes']);?>
</div>
      </div>
    </div>
    
    
    <div class="themai fysm">
      <div class="themai-tit"><span>费用说明</span></div>
      <div class="themai-box">
        <div class="themai-notice"><?php echo smarty_modifier_img_add_host($_smarty_tpl->tpl_vars['rs']->value['cost_description']);?>
</div>
      </div>
    </div>
    
    
    <div class="themai zysx">
      <div class="themai-tit"><span>注意事项</span></div>
      <div class="themai-box">
        <div class="themai-notice"><?php echo smarty_modifier_img_add_host($_smarty_tpl->tpl_vars['rs']->value['notes']);?>
</div>
      </div>
    </div>
 <div class="themai pj">
      <div class="themai-tit"><span>评价</span></div>
      <div class="themai-box">
      <div class="themai-notice">
         <ol>
          
         </ol>
          <button type="button" class="btn_load_pj" onclick="get_commentmark(<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
,<?php echo $_smarty_tpl->tpl_vars['comment_mark_count']->value;?>
);">更多评价<img src="/public/images/icon_up.png" width="16"/></button>
         </div>
      </div>
 </div>
    <div class="themai pl">
      <div class="themai-tit"><span>活动咨询</span></div>
      <div class="themai-box">
        <div class="themai-notice">
        <div class="comment_li insert"></div>
         <div class="comment_li comment_li2"></div>

        <button type="button" class="btn_load"  onclick="get_comment(<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
,<?php echo $_smarty_tpl->tpl_vars['comment_count']->value;?>
);">更多评论<img src="/public/images/icon_up.png" width="16"/></button>
          <div id="comment_list">
            <form method="post" ajax="true">
              <?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
<?php $_tmp1=ob_get_clean();?><?php echo FormBox::hidden(array('name'=>'campid','value'=>$_tmp1,),$_smarty_tpl->tpl_vars['model']->value);?>
              <?php echo FormBox::textarea(array('name'=>'comment','class'=>'inp inp1',),$_smarty_tpl->tpl_vars['model']->value);?>
             <span id="err_info"></span>
              <button type="button" class="btn" onclick="publish();">发表</button>
            </form> 
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){ 
   
    
       $("#comment_list").offset().top==100;
    
   
   
    var pj_num=<?php echo $_smarty_tpl->tpl_vars['comment_mark_count']->value;?>
;
    var pl_num=<?php echo $_smarty_tpl->tpl_vars['comment_count']->value;?>
;
    
    if(pj_num==0){
     $(".btn_load_pj").html("还没有评价！");
     $(".btn_load_pj").attr("disabled","disabled");
     $(".btn_load_pj").css("cursor","default");
    }else{
      get_commentmark(<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
,<?php echo $_smarty_tpl->tpl_vars['comment_mark_count']->value;?>
);
    }

    if(pl_num==0){
     $(".btn_load").html("还没有咨询！");
     $(".btn_load").attr("disabled","disabled");
     $(".btn_load").css("cursor","default");
     return;
    }else{
      get_comment(<?php echo $_smarty_tpl->tpl_vars['rs']->value['id'];?>
,<?php echo $_smarty_tpl->tpl_vars['comment_count']->value;?>
);
    }
  });
</script>


<?php echo $_smarty_tpl->getSubTemplate ("libs/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<script src="/public/js/myweb.js" type="text/javascript"></script>
</body>
</html>
<?php }} ?>
