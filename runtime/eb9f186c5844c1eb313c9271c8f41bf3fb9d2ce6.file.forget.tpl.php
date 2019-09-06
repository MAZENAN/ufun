<?php /* Smarty version Smarty-3.1.19, created on 2019-05-09 19:56:18
         compiled from ".\Apps\Home\views\forget.tpl" */ ?>
<?php /*%%SmartyHeaderCode:225005cd41562a4dc97-00188159%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'eb9f186c5844c1eb313c9271c8f41bf3fb9d2ce6' => 
    array (
      0 => '.\\Apps\\Home\\views\\forget.tpl',
      1 => 1491472322,
      2 => 'file',
    ),
    '0ecb5cefb4d6238e16b5afa4adbfa2eb789de519' => 
    array (
      0 => '.\\Apps\\Home\\views\\libs\\layout3.tpl',
      1 => 1491472323,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '225005cd41562a4dc97-00188159',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'config' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5cd41562bcfb35_76555500',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5cd41562bcfb35_76555500')) {function content_5cd41562bcfb35_76555500($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_smarty_tpl->tpl_vars['config']->value['website_name'];?>
</title>

<link href="/public/css/style.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="/public/js/jquery.min.js"></script>
<script type="text/javascript" src="/public/js/jquery.jslides.js"></script>
<script type="text/javascript" src="/public/js/simplefoucs.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.validate.js"></script>
<link rel="shortcut icon" href="/public/images/favicon.ico" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

<script type="text/javascript" charset="utf-8" src="/public/samaores/js/samao.timebtn.js"></script>
<script type="text/javascript" src="/public/layer/layer.js"></script>
<script type="text/javascript">
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
	var retfun=function(rt){if(!rt.error){if(rt.success){layer.alert(rt.success);}}else{
               rechange();
                layer.alert(rt.error);
            }};
        
	$('#timebtn').timebtn({
		intext:'{time}秒后重试',
                outtext:'再次重试',
		click:function(){
			var mval=$('#mobile').val();
			if(!/^1\d{10}$/.test(mval)){
                            layer.alert('手机号码格式不正确！');
                            return false;
			}
                        if(rzcode==''){
                             rechange();
                            return false;
			}
			$.post('/forget/chkmobile.html',{mobile:mval},function(dat){
                        if(dat.status){
                                    $.post('/forget/sendmbcode.html',{mobile:mval,rzcode:rzcode},retfun,'json');
                                    $('#timebtn').timebtn('start');
				}
			},'json');
			return false;
		},
                ontimeout:function(){
                      $('#timebtn').data('state','redo');
                }
	});
        
        $('#timebtn').on('click',function(){
            var state=$(this).data('state');
            if(state=='redo'){
                 rechange();
                 $(this).text('获取验证码').data('state','null');
            }
        });
        
	$('#authemail').on('click',function(){
		$('#authtype').val('email');
		$('#typeul li').removeClass('on');
		$(this).addClass('on');
		$('.item-email').show();
		$('.item-mobile').hide();
		$('#email').removeAttr('data_val_off');
		$('#mbcode').attr('data_val_off',true);
                $('#mvcode').attr('data_val_off',true);
                
		$('#mobile').attr('data_val_off',true);
		$('#pass').attr('data_val_off',true);
		$('#cfmpass').attr('data_val_off',true);
	});
	$('#authmobile').on('click',function(){
		$('#authtype').val('mobile');
		$('#typeul li').removeClass('on');
		$(this).addClass('on');
		$('.item-email').hide();
		$('.item-mobile').show();
		$('#mbcode').removeAttr('data_val_off');
                $('#mvcode').removeAttr('data_val_off');
		$('#mobile').removeAttr('data_val_off');
		$('#pass').removeAttr('data_val_off');
		$('#cfmpass').removeAttr('data_val_off');
		$('#email').attr('data_val_off',true);
	});
	$('#typeul li').first().trigger('click');
        $('form').on('success',function(){
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
                     $('#mbcode').focus().mousedown();
                }else{
                    rechange(data);
                }
               $('#mvcode').data('hit',false);
            },'json');
        });
	
});</script>


</head>

<body>

<?php echo $_smarty_tpl->getSubTemplate ("libs/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>



<div class="top">
  <div class="top-box">
    <div class="logo"><a href="index.html"><img src="/public/images/logo.png" /></a></div>
    <?php echo $_smarty_tpl->getSubTemplate ("libs/inc_search.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    <div class="clear"></div>
  </div>
</div>

<div class="menu">
  <ul>
    <li><a href="/index.html" class="on">首页</a></li>
    <li><a href="/cncamp.html">国内营</a></li>
    <li><a href="/glcamp.html">国际营</a></li>
    <!-- <li><a href="/ovcamp.html">境外游学</a></li> -->
    <li><a href="/campedu.html">营地教育</a></li>
  </ul>
</div>
  
<div class="wrap">
<div class="user">
<div class="user-main">
        <div class="user-title"><span>重置账号密码</span></div>
        <div class="user-passedit">
            <form method="post" action="/forget/rsetpwd.html" ajax="true">
            <input type="hidden" id="authtype" name="mobile">
            <div class="auth-box">
                <div class="tips-info">密码忘记了？ 您可以通过 手机认证 重置密码。</div>
               
              </div>
            <table class="item-mobile" width="100%" border="0" cellspacing="0" cellpadding="0" style="width:360px; margin:30px auto;">
             <tr>
                <td width="270" align="right" valign="top"><div class="tit">手机号码：</div></td>
                <td align="left" valign="middle"><?php echo FormBox::text(array('name'=>'mobile','class'=>'inp inp2',),$_smarty_tpl->tpl_vars['model']->value);?></td>
              </tr>
               <tr  id="mvcodetr">
                    <td width="110" align="left" valign="middle"><div class="tit">验证码：</div></td>
                    <td align="left" valign="middle"><?php echo FormBox::validcode(array('notimg'=>true,'name'=>'mvcode','class'=>'inp inp2',),$_smarty_tpl->tpl_vars['model']->value);?>
                        <img id="codeimg" src="<?php echo $_smarty_tpl->getConfigVariable('SERVICE_VALIDCODE_URL');?>
" style="vertical-align: middle; height: 30px; width: 80px; margin:0 10px;" alt="看不清楚点击刷新！" onclick="this.src='<?php echo $_smarty_tpl->getConfigVariable('SERVICE_VALIDCODE_URL');?>
?r='+Math.random();" />
                        <a href="#" onclick="document.getElementById('codeimg').src='<?php echo $_smarty_tpl->getConfigVariable('SERVICE_VALIDCODE_URL');?>
?r='+Math.random();return false;">看不清?</a> <span id="mvcode_info"></span>
                    </td>
                </tr>
                <tr id="codetr" style="display: none;">
                <td width="270" align="right" valign="top"><div id="codetic" class="tit">手机认证码：</div></td>
                <td align="left" valign="top"><?php echo FormBox::text(array('name'=>'mbcode','class'=>'inp inp2',),$_smarty_tpl->tpl_vars['model']->value);?><a href="#" id="timebtn" class="smsbtn">获取验证码</a></td>
                </tr>
               <tr>
                <td width="270" align="right" valign="top"><div class="tit">新密码：</div></td>
                <td align="left" valign="top"><?php echo FormBox::password(array('name'=>'pass','class'=>'inp inp2',),$_smarty_tpl->tpl_vars['model']->value);?></td>
              </tr>
              
              <tr >
                <td width="270" align="right" valign="top"><div class="tit">确认密码：</div></td>
                <td align="left" valign="top"><?php echo FormBox::password(array('name'=>'cfmpass','class'=>'inp inp2',),$_smarty_tpl->tpl_vars['model']->value);?></td>
              </tr>
              
              <tr>
                <td align="right" valign="top">&nbsp;</td>
                <td align="left" valign="top"><input type="submit" value="保存修改" class="btn" /></td>
              </tr>
                </table>
              
              
          
            </form>
        </div>
      
      </div>
        
      </div>
        
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

<?php echo $_smarty_tpl->getSubTemplate ("libs/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>



<script src="/public/js/myweb.js" type="text/javascript"></script>
</body>
</html>
<?php }} ?>
