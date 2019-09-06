<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{@$model->attrs.title@}</title>
<link rel="stylesheet" type="text/css" href="__RES__/css/form.plane.css"/>
<style type="text/css">
body {
	background-color: #FFF;
}
</style>
{@model_css@}
<script type="text/javascript" src="__RES__/js/jquery.js"></script>
<script type="text/javascript" src="__RES__/js/samao.validate.js"></script>
<script type="text/javascript" src="__RES__/js/samao.topdialog.js"></script>
{@if $model->attrs.istab && !$model->attrs.tabsplit@}
<script type="text/javascript" src="__RES__/js/samao.model.tabs.js"></script>
{@/if@}
{@model_script @}
</head>
<body>
{@if $model->usehtml@}
{@include file="modeltpl:`$model->name`"@}
{@/if@}

{@include file="modelskin:default"@}
<div class="samao-form">
<form action="" method="post">
{@call model_tabs model=$model@}
{@call model_toptip model=$model@}
{@call model_form model=$model@}
{@call model_submit model=$model@}
</form>
</div>

</body>
</html>
