{@* 模型标题 *@}

{@function name='model_title' model=NULL@}
<div class="form-title">{@$model->attrs.title@}</div>
{@/function@}

{@* 标签 *@}

{@function name='model_tabs' model=NULL@}
{@if $model->attrs.istab@}
<div class="form-tabs" id="form-tabs">
{@if $model->attrs.tabsplit@}
{@foreach from=$model->attrs.tabs item=tab key=idx@}
{@if strval($model->attrs.model_tag) == strval($idx)@}
<b class="active"{@if $tab==NULL@} style="display:none"{@/if@}>{@$tab.name@}</b>
{@else@}
<a href="{@$tab.url@}" {@if $tab==NULL@} style="display:none"{@/if@}>{@$tab.name@}</a>
{@/if@}
{@/foreach@}
{@else@}
{@foreach from=$model->attrs.tabs item=tab key=idx@}
{@if strval($idx) == strval($model->attrs.tab_keys[0])@}
<b idx="{@$idx@}" class="active"{@if $tab==NULL@} style="display:none"{@/if@}>{@$tab.name@}</b>
{@else@}
<b idx="{@$idx@}" {@if $tab==NULL@} style="display:none"{@/if@}>{@$tab.name@}</b>
{@/if@}
{@/foreach@}
{@/if@}
</div>
{@/if@}
{@/function@}

{@* 顶部提示区 *@}

{@function name='model_toptip' model=NULL tab=0@}
{@if $model->attrs.toptip@}
<div class="form-tips">{@$model->attrs.toptip@}</div>
{@/if@}{@if $model->attrs.istab@}
{@if $model->attrs.tabsplit@}{@foreach from=$model->attrs.tabs item=tab key=idx@}{@if $model->attrs.model_tag == $idx && $tab.tips@}
<div  id="form_tips_tabs_{@$idx@}" class="form-tips">{@$tab.tips@}</div>
{@/if@}{@/foreach@}{@else@}{@foreach from=$model->attrs.tabs item=tab key=idx@}{@if $tab.tips@}
<div id="form_tips_tabs_{@$idx@}" {@if $idx!=$model->attrs.tab_keys[0]@} style="display:none"{@/if@} class="form-tips">{@$tab.tips@}</div>
{@/if@}{@/foreach@}{@/if@}{@/if@}
{@/function@}

{@* 表格头部 *@}
{@function name='model_header' model=NULL tab=0@}
<div class="form-panel" {@if $model->attrs.istab@} id="form_tabs_{@$tab@}" {@/if@} {@if $model->attrs.tabsplit==false && $tab!=$model->attrs.tab_keys[0]@} style="display:none"{@/if@}>
{@/function@}

{@* 表格底 *@}
{@function name='model_footer'@}
<div style="clear:both"></div>
</div>
{@/function@}


{@* 提交区域 *@}
{@function name='model_submit' model=NULL@}
<div class="form-submit" {@if !empty($model->attrs.btns_left)@} style="padding-left:{@$model->attrs.btns_left@}px;" {@/if@}>
<input type="submit" class="submit" value="{@$model->attrs.acttext@}" />
{@if !empty($model->attrs.back)@}
<input type="button" class="back" value="{@$model->attrs.back@}" {@if !empty($model->attrs.backscript)@}onclick="{@$model->attrs.backscript@}"{@else@}onclick="window.location.href='{@$smarty.post['_BACKURL_']|default:$smarty.server['HTTP_REFERER']|default:'#'@}';"{@/if@} />
{@/if@}
{@if !empty($model->attrs.action)@}
<input value="{@$model->attrs.action@}" name="action" type="hidden" />
{@/if@}
<input value="{@$smarty.post['_BACKURL_']|default:$smarty.server['HTTP_REFERER']|default:''@}" name="_BACKURL_" type="hidden" />
<div style="clear:both"></div>
</div>
{@/function@}

