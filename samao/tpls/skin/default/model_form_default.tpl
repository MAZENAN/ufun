{@if $box->merge == false @}
<div class="form-group" {@$box->row_hide@} id="row_{@$box->boxname@}">
    <label class="form-label" {@$box->label_width@}>{@$box->label@}{@$box->required@}：{@if $box->tip_front@}<p>{@$box->tip_front@}</p>{@/if@}</label>
 <div class="form-box" {@$box->box_width@}>{@$box->minititle@}{@form_default name=$key type=$box->type model=$model@}{@$box->tip_back@}{@if $box->for_bymerge && $box->bymerge_type@}{@call name="model_form_base" model=$model key=$box->nextkey@}{@/if@}{@$box->data_val_info@}</div>
{@if $box->for_bymerge && $box->bymerge_type==false@}{@call name="model_form_base" model=$model key=$box->nextkey@}{@/if@}
</div>

{@else@}
{@if empty($box->merge_type)@}
 <label class="form-label" {@$box->label_width@}>{@$box->label@}{@$box->required@}：</label>
 <div class="form-box" {@$box->box_width@}>{@$box->minititle@}{@form_default name=$key type=$box->type model=$model@}{@$box->tip_back@}{@$box->data_val_info@}</div>
{@else@}
<span  id="row_{@$box->boxname@}">
&nbsp;&nbsp;{@if !empty($box->label) &&  $box->label[0]!='#'@}{@$box->label@}：{@/if@}{@form_default name=$key type=$box->type model=$model@}{@$box->tip_back@}
</span>
{@/if@}
{@if $box->for_bymerge@}{@call name="model_form_base" model=$model key=$box->nextkey@}{@/if@}
{@/if@}