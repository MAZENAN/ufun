<?php /* Smarty version Smarty-3.1.19, created on 2019-06-19 11:12:30
         compiled from ".\Apps\Home\views\vote.tpl" */ ?>
<?php /*%%SmartyHeaderCode:203545d09a81ec72ef2-67825280%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '89c6a1044690c66649ad1abd387f84e2ef85c761' => 
    array (
      0 => '.\\Apps\\Home\\views\\vote.tpl',
      1 => 1491472323,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '203545d09a81ec72ef2-67825280',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5d09a81ec9c597_35294482',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5d09a81ec9c597_35294482')) {function content_5d09a81ec9c597_35294482($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>营天下 - 超级小营员成长变形记</title>
    <link rel="shortcut icon" href="/public/images/favicon.ico" />
	<style type="text/css">
	*{ padding: 0; margin: 0; }
	body{ font-family: "微软雅黑"; font-size: 14px; }
	a{ text-decoration: none; }
	li{ list-style: none; }
	.fl{ float: left; }
	.fr{ float: right; }
	.cls{ clear: both; }
    img{ vertical-align: middle; }
	.banner{ background: url(../../../public/special/vote_01.jpg) center no-repeat; height: 605px; background-size: cover; }
    .slogen{ background: url(../../../public/special/vote_03.jpg) center no-repeat; height: 210px; }
	.container{ width: 1000px; margin: 0 auto; }
	.container .nav{  position: relative;
    height: 77px; 
    background:#8ec31f;}
    .container .nav ul{ overflow: hidden; }
    .container .nav ul li a{ color: #fff; line-height: 77px; font-size: 16px; }
    .container .nav ul li{ float: left; margin: 0 15px;}
    .container .nav:before{border-top: 77px solid #8ec31f;
    border-left: 170px solid transparent; position: absolute; content: ""; display: block; height: 77px; left: -170px; top: 0; }
    .container .nav:after{border-top: 77px solid #8ec31f;
    border-right: 170px solid transparent;
     position: absolute; content: ""; display: block; height: 77px; right: -170px; top:0; }
    ::-webkit-scrollbar{width:5px;}
	::-webkit-scrollbar-track{background-color:#2b2b2b;}
	::-webkit-scrollbar-thumb{background-color:#999;}
	::-webkit-scrollbar-thumb:hover {background-color:#9c3}
	::-webkit-scrollbar-thumb:active {background-color:#00aff0}
	.container .logo{ text-align: center; margin: 35px 0; }
	.container h2{ margin-bottom: 110px; }
	
    .code .code_img{ padding: 38px 0; background: #fff; margin: 0 10px 0 94px; }
	.code .code_detail{ width:606px; text-align: center; }
	.code .code_detail p{ font-size:28px; color: rgb(81,81,84); text-align: center; line-height: 45px; }
	.code .code_detail span{ border-bottom: 1px dashed #8ec31f; padding: 27px 0 20px 0; margin-bottom: 20px; display: inline-block; }
	.toupiao_box{ position: relative; box-shadow: 3px 3px 3px rgb(227,227,227); padding:40px 0 45px 0; background: #fff; margin-bottom: 62px; }
    .toupiao_box dd{ text-align: center; }
    .toupiao_box dl{ position: absolute; bottom: -80px; z-index: 999; height: 113px; display: table; }
    .toupiao_box dl img{ vertical-align: middle; display: table-cell; }  
    .toupiao_box dl.pos_r{ right: 0; }
    .toupiao_box .botlink{ width: 27px; height: 136px; position: absolute; z-index: 999; left: 50%;    margin-left: -13px;bottom: -102px; background: url(../../../public/special/vote_icon5.png) no-repeat; }
    .toupiao_box h4{ font-size: 28px; color:#8ec31f; font-weight: normal; text-align: center; }
    .toupiao_box .box_detail{ width: 440px; padding-left: 28px; }
    .toupiao_box .box_detail p{ font-size: 18px; color:#6e6e72; line-height: 32px;  }
    .toupiao_box .box_detail p b{ color: #9dd540; }
    .toupiao_box .box_img{ padding: 24px 20px; background: #f0f0f0; margin-top: 50px; }
    .toupiao_box .box_img img{ width: 490px; }
    .toupiao_box:after{ position: absolute; display: block; content: ""; width: 980px; height: 55px;  background: #f0f0f0; bottom: -58px; left: 10px; z-index: 98;}
    .toupiao_box:before{ position: absolute; display: block; content: ""; width: 980px; height: 55px;  background: #ffffff; bottom: -59px; left: 10px; border-radius: 140px 140px 0 0/35px 35px 0 0; z-index: 99; }
    .toupiao_box:nth-child(1){ padding-top: 0px; }
    .toupiao_box:nth-last-child(1){ }
    .explain{ background: #8fc449; color: #fff; padding: 35px 0; }
    .explain h4{ font-size: 22px; font-weight: normal; text-align: center; margin-bottom: 10px;}
    .explain p{ font-size: 18px; line-height: 30px; position: relative; padding-left: 30px;  text-align: justify;}
    .explain p span{ position: absolute; left: 0px; }
    .explain dd{ font-size: 14px; padding:20px 0 0 30px; }
    .copyright{ color: #afafaf; text-align: center; line-height: 25px; padding:5px 0; }
    .botbanner{ text-align: center; height: 127px; position: relative; top: -58px; z-index: 999;}
	</style> 
</head>
<body>
	<div class="banner"></div>
	<div class="container">
		<div class="nav">
			<ul><li><a href="http://www.51camp.cn">返回首页</a></li>
			</ul>
		</div>
        <div class="logo"><img src="../../public/special/toupiao_logo.png"/></div>
    </div>
    <div class="slogen"></div>
    <div class="container">
        <div class="code">
        	<div class="code_img"><img src="../../public/special/vote_07.jpg" /></div>  	
        </div>
        <img src="../../public/special/vote_10.jpg" width="100%" />
        <div class="toupiao_box">
            <dd><img src="../../public/special/vote_13.jpg" /></dd>
        	<div class="box_detail fl">    
        		<h4><img src="../../public/special/vote_15.jpg" /></h4>
        		<p><b>挑战营地：</b>启行专属定制Pre-住宿营</p>
<p><b>直播时间：</b>10月1日-10月6日</p>
<p><b>我是姐姐Tracy：</b><br/>
我最喜欢花样滑冰、芭蕾和跑步，我希望长大后能成为著名的运动员！</p>
<p><b>我是弟弟Eugene：</b><br/>
我最喜欢游泳、跑步、足球和滑雪，我和姐姐一样，希望成为出色的运动员！</p>
<p><b>我们是爸爸和妈妈：</b><br/>
希望孩子能够开心，保持好奇心，去探索世界，探索不同的人，有思想，更多的发现自己，活出内在的热情。</p>
        	</div>
        	<div class="box_img fr"><img src="../../public/special/vote_18.jpg" /></div>      	
        	<div class="cls"></div>
        	<dl><img src="../../public/special/vote_icon1.png"></dl>
            <div class="botlink"></div>
        </div>
        <div class="toupiao_box">
        	<dd><img src="../../public/special/vote_22.jpg" /></dd>
        	<div class="box_img fl"><img src="../../public/special/vote_28.jpg" /></div>
        	<div class="box_detail fr">
        		<h4><img src="../../public/special/vote_25.jpg" /></h4>
        		<p><b>挑战营地：</b>坚果派西双版纳雨林探险营</p>
                <p><b>直播时间：</b>10月1日-10月7日</p>
                <p><b>我是李和邹：</b><br/>
我喜欢游泳，阅读，唱歌，与全家人一起旅行，我希望可以努力做好我喜欢的事。</p>
    <p><b>我们是爸爸和妈妈：</b><br/>
教育好自己比教育好孩子更重要，养成比教导更重要。我们希望她健康快乐的成长，有完善的人格，正确的世界观和价值观，成为她想要的自己。</p>

        	</div>
        	<div class="cls"></div>
        	<dl class="pos_r"><img src="../../public/special/vote_icon2.png"></dl>
             <div class="botlink"></div>
        </div>
        <div class="toupiao_box">
            <dd><img src="../../public/special/vote_36.jpg" /></dd>
            <div class="box_detail fl">    
                <h4><img src="../../public/special/vote_39.jpg" /></h4>
                <p><b>挑战营地：</b>游美千岛湖国际营</p>
                <p><b>直播时间：</b>10月1日-10月7日</p>
                <p><b>我是李浩榕：</b><br/>
我喜欢足球、跆拳道、滑雪、攀岩等户外运动，我长大后想成为一名体育运动员！</p>
    <p><b>我们是爸爸和妈妈：</b><br/>
他是一个乐观外向、活泼率真的阳光男孩，比较独立，希望他通过营地教育，可以学会把控自己的情绪，提高团队协作和领导能力。</p>

            </div>
            <div class="box_img fr"><img src="../../public/special/vote_43.jpg" /></div>          
            <div class="cls"></div>
            <dl><img src="../../public/special/vote_icon3.png"></dl>
             <div class="botlink"></div>
        </div>
        <div class="toupiao_box">
            <dd><img src="../../public/special/vote_48.jpg" /></dd>
            <div class="box_img fl"><img src="../../public/special/vote_55.jpg" /></div>
            <div class="box_detail fr">
                <h4><img src="../../public/special/vote_51.jpg" /></h4>
                <p><b>挑战营地：</b>DE雅鲁藏布江100KM朝圣远征</p>
                <p><b>直播时间：</b>10月1日-10月7日</p>
                <p><b>我是毕竞文：</b><br/>
    无经历不成长！爱家人、爱伙伴、爱生活、爱挑战！通过努力，成为自己最欣赏的样子！</p>
    <p><b>我们是爸爸和妈妈：</b><br/>
    孩子是独立的个体，有自己的思考和判断，引导、商讨但不代替。希望孩子在自食其力的基础上，能够做自己喜欢的事。</p>
            </div>
            <div class="cls"></div>
            <dl class="pos_r"><img src="../../public/special/vote_icon4.png"></dl>
             <div class="botlink"></div>
        </div>
        <div class="toupiao_box">
            <dd><img src="../../public/special/vote_60.jpg" /></dd>
            <div class="box_detail fl">    
                <h4><img src="../../public/special/vote_63.jpg" /></h4>
                <p><b>挑战营地：</b>风骨滇西-腾冲瑞丽非遗之旅</p>
                <p><b>直播时间：</b>10月1日-10月7日</p>
                <p><b>我是覃尹人：</b><br/>
    我喜欢跑步，喜欢读书，还喜欢和妈妈一起去旅行，那是最快乐的时光。</p>
    <p><b>我们是爸爸和妈妈：</b><br/>
    能力固然重要，更希望女儿成为善良和真诚的孩子。希望她此次能探寻专属于滇西的伟岸风骨与曼妙风情，在旅途中培养锻练她自立的能力和助人的品行。</p>
            </div>
            <div class="box_img fr"><img src="../../public/special/vote_66.jpg" /></div>          
            <div class="cls"></div>
        </div>
	</div>
    <div class="botbanner">
        <img src="../../public/special/vote_70.jpg" />
    </div>
	<div class="explain">
		<div class="container">
			 <h4>活动说明：</h4>
           <p><span>1、</span>投票时间：2016年10月1日—2016年10月7日；</p>
           <p><span>2、</span>投票规则：打开活动页，为你喜欢的超级小营员投票助威，每人每天可投3票，可同时投给1位或多位小营员，每天只能投1次，次日可继续投票；</p>
           <p><span>3、</span>有奖转发：投票后，转发活动并喊出#我为XX加油#，至朋友圈，截图发至营天下服务号（yingtianxia-2015），留下本人姓名、手机号，每天将从中抽取3名，获得帆船营地免费体验1次；</p>
           <p><span>4、</span>大奖设置：得票最高者将获得“超级小营员”称号，获得3000元国际营地基金；</p>
           <p><span>5、</span>公布时间：每日有奖转发获奖名单及最终超级小营员评选结果，将于2016年10月8日统一公布。</p><dd>活动最终解释权归营天下所有。</dd>
		</div>     
	</div>
	<div class="copyright">
		<div class="container">
			Copyright © 2016 营天下 All Rights Reserved    京ICP备15030160号<br/>
			北京市朝阳区阜通东大街一号院望京SOHO T1 C座2705 电话：400-8783633 <script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1255744006'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s4.cnzz.com/z_stat.php%3Fid%3D1255744006%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));</script>
		</div>
	</div>
    
</body>
</html><?php }} ?>
