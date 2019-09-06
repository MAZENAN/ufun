<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>提现日志{@$order.order_id@}</title>
<link rel="stylesheet" type="text/css" href="__RES__/css/form.default.css"/>
<link href="__RES__/css/list.default.css" rel="stylesheet" type="text/css" />
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
<script type="text/javascript" src="__RES__/js/jquery.js"></script>
<script type="text/javascript" src="__RES__/js/samao.topdialog.js"></script>
</head>
<body>
<div class="samao-form">
    <h3>提现用户信息</h3>
<table class="infotable" width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
    <th width="15%">姓名</th>
    <td ><b class="storage">{@$user.real_name@}</b></td>
    <th width="15%">头像</th>
        <td><img src="{@$user.img_head|minimg:50:50:1@}"></td>
    </tr>
  <tr>
    <th>手机号</th>
      <td>{@$user.mobile@}</td>
    <th>昵称</th>
    <td>{@$user.nickname@}
    </td>
  </tr>

    <tr>
        <th>赏金余额</th>
        <td><span class="gre">{@$user.earn_money@}</span>￥</td>
        <th>累计赚取赏金总额</th>
        <td><span class="org">{@$user.earn_total@}</span>￥</td>
    </tr>
  <tr>
  </table>

    <h3>提现信息</h3>
    <div class="pay3-list">
        <table id="stulist" class="infotable"   width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <th width="15%">提现状态</th>
                <td ><b class="storage">{@$log.log|case:[0,1]:['<span class="red">失败</span>','<span class="gre">成功</span>']@}</b></td>
            </tr>
            <tr>
            <th width="15%">提现金额</th>
            <td ><b class="storage">{@$log.money@}￥</b></td>
            </tr>
            <tr>
                <th width="15%">提现时间</th>
                <td ><b class="storage">{@$log.add_time@}</b></td>
            </tr>
            <tr>
                <th width="15%">日志</th>
                <td><span style="display:inline-block;width:600px;word-wrap:break-word;white-space:normal;
">{@$log.log@}</span></td>
            </tr>
        </table>
    </div>
</div>
</body>
</html>
