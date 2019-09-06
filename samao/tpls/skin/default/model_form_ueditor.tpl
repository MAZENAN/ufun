<div class="form-group" {@$box->row_hide@} id="row_{@$box->boxname@}">
 <div class="form-box" style="display:table-row; width:100%;"><label class="form-label" style="float:left">{@$box->label@}{@$box->required@}</label> {@if !empty($box->tip_front)@}<span class=hui>{@$box->tip_front@}</span>{@/if@}{@$box->tip_back@}{@$box->data_val_info@}</div>
 <div class="form-box form-ueditor" style="display:table-row;width:calc(100%-20px);">{@form_ueditor name=$key type=$box->type model=$model@}</div>
</div>