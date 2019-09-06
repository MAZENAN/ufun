<?php /* Smarty version Smarty-3.1.19, created on 2019-05-09 19:55:22
         compiled from ".\Apps\Home\views\reg.tpl" */ ?>
<?php /*%%SmartyHeaderCode:221805cd4152aacade8-81356175%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1d17c70aaa70944165dc75412df845338b969588' => 
    array (
      0 => '.\\Apps\\Home\\views\\reg.tpl',
      1 => 1491472323,
      2 => 'file',
    ),
    '2abc61f1111f3a0ff4eea5bb855993c68187476c' => 
    array (
      0 => '.\\Apps\\Home\\views\\libs\\layout2.tpl',
      1 => 1491472325,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '221805cd4152aacade8-81356175',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'config' => 0,
    'i' => 0,
    'ls' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5cd4152abe4f56_93104014',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5cd4152abe4f56_93104014')) {function content_5cd4152abe4f56_93104014($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_smarty_tpl->tpl_vars['config']->value['website_name'];?>
</title>

<link href="/public/css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/public/js/jquery.min.js"></script>
<script type="text/javascript" src="/public/js/jQuery.blockUI.js"></script>
<script type="text/javascript" src="/public/js/jquery.SuperSlide.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.validate.js"></script>
<link rel="shortcut icon" href="/public/images/favicon.ico" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
</head>

<body>


<div class="top">
  <div class="top-box">
    <div class="logo"><a href="/index.html"><img src="/public/images/logo.png" /></a></div>
    <div class="top-name">注册</div>
    <div class="top-tel"><img src="/public/images/top-tel.png" /></div>
    <div class="clear"></div>
  </div>
</div>


<script type="text/javascript" src="/public/layer/layer.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.timebtn.js"></script>
<script>
$(function(){
    
        var rzcode='';
        var rechange = function (data) {
            $('#timebtn').timebtn("disabled");
            $('#mvcodetr').show();
            $('#codetr').hide();
            if(data){
                $('#mvcode_info').addClass('field-val-error').text(data.error).show();
            }
            $('#mvcode').val('');
            document.getElementById('codeimg').src = '<?php echo $_smarty_tpl->getConfigVariable('SERVICE_VALIDCODE_URL');?>
?r=' + Math.random();
        };
        
	$('#timebtn').timebtn({
		intext:'{time}秒后重试',
                outtext:'再次重试',
		click:function(){
			var mval=$('#mobile').val();
			if(!/^1[34578]\d{9}$/.test(mval)||rzcode==''){
                            rechange();
			    return false;
			}
			$.post('/reg/sendmbcode.html',{mobile:mval,rzcode:rzcode},function(data){
                            if (data=='false'){
                                return false;
                            }else{
                                $('#timebtn').timebtn("start");
                            }
                        });
                        return false;
		},
                ontimeout:function(){
                    $('#timebtn').data('state','redo');
                }
	});
        
        $('#timebtn').on('click',function(){
            if($(this).data('state')=='redo'){
                 rechange();
                 $(this).text('获取验证码').data('state','null');
            }
        });
        
        $('#mobileform').on('success',function(){
              document.getElementById('codeimg').src='<?php echo $_smarty_tpl->getConfigVariable('SERVICE_VALIDCODE_URL');?>
?r='+Math.random();
        });
        
        $('#timebtn').timebtn("disabled");
        $('#mvcode').on('keyup',function(){
            var hit=$(this).data('hit') || false;
            if(hit){return;}
            var code=$('#mvcode').val();
            if(code.length!==4){
                rzcode='';
                $(this).data('hit',false);
                return;
            }
            rzcode='';
            $(this).data('hit',true);
            $('#mvcode_info').removeClass('field-val-error').text('').hide();
            $.post('/reg/chkmvcode.html',{code:code},function(data){
                if(data.success){
                     $('#timebtn').timebtn("ready");
                     $('#mvcodetr').hide();
                     $('#codetr').show();
                     rzcode=data.code;
                     $('#code').focus().mousedown();
                }else{
                  rechange(data);
                }
               $('#mvcode').data('hit',false);
            },'json');
        });
        
});
</script>
<div class="reg-wrap">

  <div class="reg-main">
    <div class="reg-tit"><span>注册营天下会员</span></div>
    <div class="reg-box">
    
        <div id="demoContent">
          <div class="effect">
            <div class="regbox">
             <!--  <div class="hd">
                <ul>
                  <!-- <li><a><span><b class="ico1">邮箱注册</b></span></a></li> -->
                  <!--<li><a><span><b class="ico2">手机号注册</b></span></a></li>
                </ul>
              </div> -->
              <div class="bd">
<!--                 <div class="infoList">
                  <div class="reg-form">
                  <form method="post" action="/reg/reg_email.html" ajax="true">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="110" align="left" valign="middle"><div class="tit">邮箱：</div></td>
                        <td align="left" valign="middle"><?php echo FormBox::text(array('name'=>'email','class'=>'inp inp1',),$_smarty_tpl->tpl_vars['model']->value);?></td>
                      </tr>
                      <tr>
                        <td width="110" align="left" valign="middle"><div class="tit">密码：</div></td>
                        <td align="left" valign="middle"><?php echo FormBox::password(array('name'=>'pass','class'=>'inp inp1',),$_smarty_tpl->tpl_vars['model']->value);?></td>
                      </tr>
                      <tr>
                        <td width="110" align="left" valign="middle"><div class="tit">确认密码：</div></td>
                        <td align="left" valign="middle"><?php echo FormBox::password(array('name'=>'cfgpass','class'=>'inp inp1',),$_smarty_tpl->tpl_vars['model']->value);?></td>
                      </tr>
                      <tr>
                        <td width="110" align="left" valign="middle">&nbsp;</td>
                        <td align="left" valign="middle"><label><?php echo FormBox::bool(array('name'=>'agree',),$_smarty_tpl->tpl_vars['model']->value);?>我已阅读并同意</label><a target="_blank" href="/single-agreement.html" class="txt">《营天下用户服务协议》</a><span id="agreeinfo"></span></td>
                      </tr>
                      <tr>
                        <td width="110" align="left" valign="middle">&nbsp;</td>
                        <td align="left" valign="middle"><input type="submit" value="立即注册" class="btn" /></td>
                      </tr>
                       <tr>
                        <td width="110" align="left" valign="middle">&nbsp;</td>
                        <td align="left" valign="middle">已注册账号？<a class="txt" style="display: inline; float: none;" href="/login.html">点击这里登录 </a>。</td>
                      </tr>
                    </table>
                    </form>
                  </div>
                </div> -->
                <div class="infoList">
                  <div class="reg-form">
                   <form id="mobileform" method="post" action="/reg/reg_mobile.html" ajax="true">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="110" align="left" valign="middle"><div class="tit">手机号：</div></td>
                        <td align="left" valign="middle"><?php echo FormBox::text(array('name'=>'mobile','class'=>'inp inp1',),$_smarty_tpl->tpl_vars['model']->value);?></td>
                      </tr>
                      
                      <tr id="mvcodetr">
                        <td width="110" align="left" valign="middle"><div class="tit">验证码：</div></td>
                        <td align="left" valign="middle"><?php echo FormBox::validcode(array('notimg'=>true,'name'=>'mvcode','class'=>'inp inp2',),$_smarty_tpl->tpl_vars['model']->value);?>
                            <img id="codeimg" src="<?php echo $_smarty_tpl->getConfigVariable('SERVICE_VALIDCODE_URL');?>
" style="vertical-align: middle; height: 36px; width: 80px;" alt="看不清楚点击刷新！" onclick="this.src='<?php echo $_smarty_tpl->getConfigVariable('SERVICE_VALIDCODE_URL');?>
?r='+Math.random();" />
                            <a href="#" onclick="document.getElementById('codeimg').src='<?php echo $_smarty_tpl->getConfigVariable('SERVICE_VALIDCODE_URL');?>
?r='+Math.random();return false;">看不清?</a> <span id="mvcode_info"></span>
                        </td>
                      </tr>
                      
                      <tr id="codetr" style="display: none;">
                        <td width="110" align="left" valign="middle"><div class="tit">短信验证码：</div></td>
                        <td align="left" valign="middle"><?php echo FormBox::text(array('name'=>'code','class'=>'inp inp2',),$_smarty_tpl->tpl_vars['model']->value);?><a href="#" id="timebtn" class="btn">获取验证码</a></td>
                      </tr>
                      
                      <tr>
                        <td width="110" align="left" valign="middle"><div class="tit">密码：</div></td>
                        <td align="left" valign="middle"><?php echo FormBox::password(array('name'=>'mpass','class'=>'inp inp1',),$_smarty_tpl->tpl_vars['model']->value);?></td>
                      </tr>
                      <tr>
                        <td width="110" align="left" valign="middle"><div class="tit">确认密码：</div></td>
                        <td align="left" valign="middle"><?php echo FormBox::password(array('name'=>'mcfgpass','class'=>'inp inp1',),$_smarty_tpl->tpl_vars['model']->value);?></td>
                      </tr>
                       
                      <tr>
                        <td width="110" align="left" valign="middle">&nbsp;</td>
                        <td align="left" valign="middle"><label><?php echo FormBox::bool(array('name'=>'magree',),$_smarty_tpl->tpl_vars['model']->value);?>我已阅读并同意</label><a target="_blank" href="/single-agreement.html" class="txt">《营天下用户服务协议》</a><span id="magreeinfo"></span></td>
                      </tr>
                      <tr>
                        <td width="110" align="left" valign="middle">&nbsp;</td>
                        <td align="left" valign="middle"><input type="submit" value="立即注册" class="btn" /></td>
                      </tr>
                       <tr>
                        <td width="110" align="left" valign="middle">&nbsp;</td>
                        <td align="left" valign="middle">已注册账号？<a class="txt" style="display: inline; float: none;" href="/login.html">点击这里登录 </a>。</td>
                      </tr>
                    </table>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          <script type="text/javascript">jQuery(".regbox").slide({trigger:"click"});</script>
          </div>
        </div>
    
    </div>
  </div>

</div>



<div class="other-foot">
    <?php echo $_smarty_tpl->tpl_vars['config']->value['copyright'];?>
&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['config']->value['keep'];?>
<br />

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

</div>
<script type='text/javascript'>
    (function(m, ei, q, i, a, j, s) {
        m[a] = m[a] || function() {
            (m[a].a = m[a].a || []).push(arguments)
        };
        j = ei.createElement(q),
            s = ei.getElementsByTagName(q)[0];
        j.async = true;
        j.charset = 'UTF-8';
        j.src = i + '?v=' + new Date().getUTCDate();
        s.parentNode.insertBefore(j, s);
    })(window, document, 'script', '//eco-api.meiqia.com/dist/meiqia.js', '_MEIQIA');
    _MEIQIA('entId', 11478);

</script>

<script src="/public/js/myweb.js" type="text/javascript"></script>
</body>
</html>
<?php }} ?>
