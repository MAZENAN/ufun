<div class="tips-info">
<div class="tips-head">
<img src="{@User::head($userid)@}" width="40" height="40" />
</div>
<div class="tips-username">
{@User::getLink($userid)@}
</div>
<div style="clear:both"></div>
</div>


<div class="tips-info">
<div style="float:left; line-height:26px; height:26px; width:240px">
<div style="float:left; line-height:26px; height:26px;width:60px; font-weight:bold">平均得分</div>
<div style="float:right;line-height:16px; margin-top:5px; height:16px;width:130px">{@User::getStarImgs($emp_avgfen)@} <b style="margin-left:10px">{@$emp_avgfen|money:''@}</b></div>
</div>

<div style="float:left; line-height:26px; height:26px; width:240px">
<span>总项目：{@$allcount@} </span> <span style=" margin-left:20px">总评价：{@$appraisecount@} </span>
</div>

<div style="clear:both"></div>
</div>

<div style="padding:10px;">
<div style="float:left;width:240px;height:130px; border-right:1px dotted #CCCCCC;">

<div style="float:left; line-height:26px; height:26px; width:240px">
<div style="float:left; line-height:26px; height:26px;width:60px;">配合态度</div>
<div style="float:right;line-height:16px; margin-top:5px; height:16px;width:130px">{@User::getStarImgs($avgfen1)@} <b style="margin-left:10px">{@$avgfen1|money:''@}</b></div>
</div>

<div style="float:left; line-height:26px; height:26px; width:240px">
<div style="float:left; line-height:26px; height:26px;width:60px;">沟通深度</div>
<div style="float:right;line-height:16px; margin-top:5px; height:16px;width:130px">{@User::getStarImgs($avgfen2)@} <b style="margin-left:10px">{@$avgfen2|money:''@}</b></div>
</div>

<div style="float:left; line-height:26px; height:26px; width:240px">
<div style="float:left; line-height:26px; height:26px;width:60px;">信誉指数</div>
<div style="float:right;line-height:16px; margin-top:5px; height:16px;width:130px">{@User::getStarImgs($avgfen3)@} <b style="margin-left:10px">{@$avgfen3|money:''@}</b></div>
</div>

<div style="float:left; line-height:26px; height:26px; width:240px">
<div style="float:left; line-height:26px; height:26px;width:60px;">专业指数</div>
<div style="float:right;line-height:16px; margin-top:5px; height:16px;width:130px">{@User::getStarImgs($avgfen4)@} <b style="margin-left:10px">{@$avgfen4|money:''@}</b></div>
</div>

<div style="float:left; line-height:26px; height:26px; width:240px">
<div style="float:left; line-height:26px; height:26px;width:60px;">合作指数</div>
<div style="float:right;line-height:16px; margin-top:5px; height:16px;width:130px">{@User::getStarImgs($avgfen5)@} <b style="margin-left:10px">{@$avgfen5|money:''@}</b></div>
</div>

</div>
<div style="float:left; line-height:26px;height:130px; width:200px; margin-left:20px">

<div style="float:left; line-height:26px; height:26px; width:200px">
<div style="float:left; line-height:26px; height:26px;width:120px;">正在进行中的项目</div>
<div style="float:right;line-height:16px; margin-top:5px; text-align:right; height:16px;width:60px">{@$runcount@}</div>
</div>

<div style="float:left; line-height:26px; height:26px; width:200px">
<div style="float:left; line-height:26px; height:26px;width:120px;">活跃中的项目</div>
<div style="float:right;line-height:16px; margin-top:5px; text-align:right; height:16px;width:60px">{@$atvcount@}</div>
</div>

<div style="float:left; line-height:26px; height:26px; width:200px">
<div style="float:left; line-height:26px; height:26px;width:120px;">已经完成的项目</div>
<div style="float:right;line-height:16px; margin-top:5px;text-align:right; height:16px;width:60px">{@$cplcount@}</div>
</div>

</div>


</div>
