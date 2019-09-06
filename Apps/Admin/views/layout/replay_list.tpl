{@extends file='@model_list.tpl'@}
<!--标题-->
{@block name=title@}回复列表{@/block@}
{@block name=head@}
<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>

<link rel="stylesheet" type="text/css" href="/public/samaores/css/form.plane.css"/>
<script type="text/javascript" src="/public/samaores/js/samao.validate.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
      //var text = $('.name_'+{@$id@}).text();
      $(".smbox-h3").children().text($('.name_'+{@$id@}).text());
      $('input[name="centent"]').val($('.centent_'+{@$id@}).text());//默认获取第一个提问内容
      $('input[name="user_id"]').val($('.centent_'+{@$id@}).attr('userid'));//默认获取第一个
      $(".replay a").click(function(){
          var id = $(this).attr('id');
          var pid = $(this).attr('pid');
          var user_id = $(this).attr('userid');
          var name = $('.name_'+id).text();
          var centent = $(".centent_"+id).text();
          $(".smbox-h3").children().text(name);
          $("input[name='id']").val(pid);
          //$("input[name='pid']").val(pid);
          $("input[name='user_id']").val(user_id);
          $("input[name='centent']").val(centent);
    });
      $("#comment").keydown(function(event){
        if(event.keyCode==13){          
          $(".submit").click();
        }
      });
  });
</script>
<style type="text/css">
  .smbox-h3{ padding:5px 0 5px 40px; color: #4cb335; width: 120px;float:right; }
  .smbox-list-content{ margin-bottom: 180px; }
  .smbox-info-tips{ position: fixed; bottom: 0; width: 100%; box-shadow: 0 0 8px #ddd; }
  .form-submit{ margin-bottom: 10px; padding-top: 10px; }
</style>
{@/block@}
<!--表格顶部区域-->
{@block name=table_topbar@}
<div class="smbox-list-toptab">
<a class="samao-link-btn samao-link-btn-refresh" href="javascript:window.location.reload()">刷新</a>&nbsp;&nbsp;&nbsp;&nbsp;
</div>
{@/block@}

<!--表头列-->

{@block name=table_ths@}

<th width="30">添加时间</th>
<th width="40">提问人</th>
<th width="150">提问内容</th>
<th width="60">操作</th>
{@/block@}

<!--总列数合并单元格时可用-->
{@block name=colspan@}6{@/block@}

<!--表行列-->
{@block name=table_tds@}
<!--<input name="id" type="hidden" value="{@$rs.id@}" />
<input name="action" type="hidden" value="editsort" />-->
<td align="center">{@$rs.add_time@}</td>
<td align="center" class="name_{@$rs.id@}">
    {@if $rs.user_id ==-1@}
        营天下官方 回复
        {@if $rs.p_userid@}
            {@if $rs.nickname@}
               {@$rs.nickname@}
            {@elseif $rs.mobile@}
                {@$rs.mobile@}
            {@/if@}
            提问
        {@else@}
            游客提问
        {@/if@}
    {@elseif $rs.user_id@}
        {@if $rs.nickname@}
            {@$rs.nickname@}提问
        {@elseif $rs.mobile@}
            {@$rs.mobile@}提问
        {@/if@}
    {@else@}
        游客提问
    {@/if@}
</td>
<td align="center" class="centent_{@$rs.id@}" userid="{@$rs.user_id@}">{@$rs.comment@}</td>
<td align="center" class="replay" >
{@if $rs.user_id neq -1@}
<a class="samao-link-minibtn"   pid="{@$id@}" userid="{@$rs.user_id@}" id="{@$rs.id@}">回复</a>
{@/if@}
{@if $rs.id != $id@}
<a onclick="return confirm('确定要删除该内容吗？一旦删除将无法恢复，请谨慎操作！');" class="samao-link-minibtn" href="__SELF__/delete?id={@$rs.id@}&replay=1">删除</a>
{@/if@}
</td>
{@/block@}
{@block name=information@}
<form  method="post">
    
<div class="form-group" id="row_comment">
  <label class="form-label"><div class="smbox-h3">回复<label></label></div></label>
  <div class="form-box">{@form_textarea name=comment placeholder='请输入回复内容' model=$model@}<span id="comment_info" class="field-info"></span></div>
</div>
<div class="form-submit" >
<input type="submit" class="submit" value="提交" />
<input type="button" class="back" value="返回" onclick="javascript:history.back(window.close());"/>
<div style="clear:both"></div>
</div>
<input type="hidden" name="id" value="{@$id@}"/>
<input type="hidden" name="pid" />
<input type="hidden" name="user_id" />
<input type="hidden" name="camp_id" value="{@$rs.camp_id@}"/>
<input type="hidden" name="title" value="{@$rs.title@}"/>
<input type="hidden" name="centent" />
 </form>
{@/block@}