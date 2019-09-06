<div class="form-group" {@$box->row_hide@} id="row_{@$box->boxname@}">
<table class="smbox-row">
<tr><th {@$box->label_width@}><label class="form-label">{@$box->label@}{@$box->required@}：</label></th><td><div id="tips_{@$box->boxname@}">{@form_upgroup name=$key type=$box->type model=$model@}{@$box->tip_back@}{@$box->data_val_info@}</div></td></tr>
<tr><th {@$box->label_width@} height="30">{@if !empty($box->tip_front)@}<span class=hui>{@$box->tip_front@}</span>{@/if@}</th><td><div class="smbox-upgroup-show" id="up_shower_{@$box->boxname@}"><div class="smbox-splito"></div></div></td></tr>
</table>
</div>