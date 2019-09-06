{@if $box->plug_table@}
<div class="form-group" {@$box->row_hide@} id="row_{@$box->boxname@}">
 <div class="form-box" style="display:table-row; width:100%;"><label class="form-label" style="float:left">{@$box->label@}{@$box->required@}</label> {@if !empty($box->tip_front)@}<span class=hui>{@$box->tip_front@}</span>{@/if@}{@$box->tip_back@}{@$box->data_val_info@}</div>
 <div class="form-box form-modelplug" style="display:table-row; width:100%;">{@form_default name=$key type=$box->type model=$model@}
 <div class="clear" style="height:10px;"></div>
 </div>
</div>
{@else@}
<div class="form-group" {@$box->row_hide@} id="row_{@$box->boxname@}">
<label class="form-label" {@$box->label_width@}>{@$box->label@}{@$box->required@}：{@if $box->tip_front@}<p>{@$box->tip_front@}</p>{@/if@}</label>
<div class="form-box" {@$box->box_width@}>{@$box->minititle@}{@form_default name=$key type=$box->type model=$model@}{@$box->tip_back@}{@$box->data_val_info@}</div>
</div>
{@/if@}