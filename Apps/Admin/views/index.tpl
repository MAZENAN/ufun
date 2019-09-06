<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit" />
<title>后台管理</title>
<link rel="stylesheet" type="text/css" href="__RES__/css/jqueryui/custom.css">
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/admin/main.css">
<script src="__RES__/js/jquery.js"></script>
<script>var OnePage='{@#AdminNoPage#@}';</script>
<script src="__PUBLIC__/js/admin/main.js"></script>
<script src="__RES__/js/jquery-ui.js"></script>
<script src="__RES__/js/samao.topdialog.js"></script>
<script>
$(document).ready(function(){
     $(".quick-menu li").hover(function(){
       $(".quick-menu-list").show();
    },function(){
       $(".quick-menu-list").hide();
    });
});
   
</script>
</head>
<body>

<div id="header">
<div class="topline"></div>
<div>
    <div class="logo"><img src="__PUBLIC__/css/admin/imgs/logo.png" width="" height="45"></div>
    
<ul id="mainmune" class="mainmune">
{@foreach from=$rows item=rs key=i@}
{@if $i==0@}<li class="idx"><span class="lfirst"></span><a href="__APPROOT__/index/left?mid={@$rs.id@}" target="left" >{@$rs.title@}</a><span class="{@if count($rows)==1@}rlast{@else@}rfirst{@/if@}"></span></li>
{@elseif $i==count($rows)-1@}<li><span class="llast"></span><a href="__APPROOT__/index/left?mid={@$rs.id@}" target="left" >{@$rs.title@}</a><span class="rlast"></span></li>
{@else@}<li><span class="l"></span><a href="__APPROOT__/index/left?mid={@$rs.id@}" target="left" >{@$rs.title@}</a><span class="r"></span></li>
{@/if@}   
{@/foreach@}
</ul>

    <div id="logininfo">您好！<span class="name">{@$adm.name@}</span>&nbsp;&nbsp;[{@if $adm.id == 1@}超级管理员{@else@}{@$adm.type|case:[1,2,3]:['高级管理员','一般管理员','仓库管理员']@}{@/if@}]<span>&nbsp;&nbsp;&nbsp;</span>
                    <a href="__APPROOT__/index/logout">[退出]</a><span>&nbsp;|&nbsp;</span>
					<a href="http://{@#basehost#@}" target="_blank" id="site_homepage">站点首页</a>
    </div>
    <!--<div class="quick-menu">
        <li><dt><a>快捷菜单</a></dt>
        <div class="quick-menu-list">
            <ul>
            <a href="/admin/camp?type=0" target="Main">国内营</a>
            <a href="/admin/camp?type=1" target="Main">国际营</a>
            <a href="/admin/coupon_packs" target="Main">优惠券</a>
            </ul>
        </div></li>
    </div>-->
</div>
</div>

<div id="content">
<!--右侧内容区域-->
<div id="right">
<div class="sbar"><a href="#" id="bardiv"></a></div>

<div id="pagebar" {@if $smarty.config.AdminNoPage@} style="display:none"{@/if@}>
    <div id="pbar"><div id="movebar"></div></div>
    <div id="pbtns">
    <a id="moveleft" class="btnleft" href="#"></a>
    <a id="moveright" class="btnright" href="#"></a>
    <a id="closeall" class="btnclose" href="#"></a>
    </div>
</div>

<div id="rcontent"><iframe scrolling="auto" name="Main" id="Main" src="__APPROOT__/index/welcome" frameborder="0" width="100%" height="100%"></iframe></div>
</div>
<!--左侧菜单区域-->
<div id="left">

</div>
</div>
</body>
</html>