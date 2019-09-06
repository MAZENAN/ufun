<!DOCTYPE html>
<html>
	<head> 
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
		<title>权限节点</title> 
		<link rel="stylesheet" type="text/css" href="/public/samaores/css/form.plane.css" />
	</head>
	<body>
		<script type="text/javascript" src="/public/samaores/js/jquery.js"></script> 
		<script type="text/javascript" src="/public/samaores/js/samao.validate.js"></script> 
		<div class="samao-body"> 
		<div class="form-title">
			权限节点
		</div> 
		<form method="post"> 
			<div class="samao-form"> 
                            {@foreach from=$rows item=rs@}
                                <div class="form-box">
                                    <h2>{@$rs.title@}</h2>
                                    <ul class="samao-box">
                                        {@foreach from=$rs.child item=rss@}
                                            <li class="form-control">
                                                <label><input type="checkbox" name="node[]" value="{@$rss.id@}" {@if $rss.checked==1@}checked{@/if@} />{@$rss.title@}</label>
                                            </li> 
                                        {@/foreach@}
                                    </ul>
                                </div>
                                <div style="clear:both"></div> 
                            {@/foreach@}
				
			</div> 
			<div class="form-submit"> 
				<input type="submit" class="submit" value="提交" /> 
				<input type="button" class="back" value="返回" onclick="location.href = '/admin/group';" /> 
				<input value="{@$smarty.get.group@}" name="group" type="hidden" /> 
				<input value="node" name="action" type="hidden" /> 
			</div> 
		</form> 
	</body>
</html>