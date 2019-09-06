<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>营地相册</title>
<!--<link rel="stylesheet" type="text/css" href="http://test.51camp.cn/public/samaores/css/form.plane.css"/>-->
<link rel="stylesheet" type="text/css" href="/public/samaores/css/form.plane.css"/>
<link href="/public/samaores/css/jqueryui/custom.css" rel="stylesheet" type="text/css" />
<!--samao model css-->
<script type="text/javascript" src="/public/samaores/js/jquery.js"></script>
<script type="text/javascript" src="/public/samaores/js/samao.validate.js"></script>
<script type="text/javascript" charset="utf-8" src="/public/samaores/js/samao.select.js"></script>
<script type="text/javascript" charset="utf-8" src="/public/samaores/js/jquery-ui.js"></script>
<script type="text/javascript" charset="utf-8" src="/public/samaores/js/samao.topdialog.js"></script>
<script type="text/javascript" charset="utf-8" src="/public/js/admin/ajaxupload.js"></script>
<script type="text/javascript" charset="utf-8" src="/public/js/admin/upload.js"></script>

<style type="text/css">
.img-div { border: 1px solid #ddd; float: left; line-height: 1;margin-left: 5px;overflow: hidden;}
#imgboxid {overflow: hidden; padding: 0 15px;}
#imgboxid dl{ margin-right: 10px; border-radius: 4px; overflow: hidden; float: left; position: relative; height: 100px; width: 100px; border:1px solid #d5d7dc; }
#imgboxid dl .close{ cursor: pointer; position: absolute; right: 5px; top: 5px; width: 20px; height: 20px; line-height: 20px; background: rgba(255,255,255,.6); border-radius: 50%; text-align: center; }
.form-label{ position: relative; }
.form-label .filebox{  position: absolute; z-index: 9; top: 0; left: 170px; opacity: 0;filter:alpha(opacity=0);cursor: pointer; height: 30px; width: 150px;}
.form-label span{ display: block; width: 150px; height: 30px; border-radius: 5px; color: #fff; position: absolute; left: 170px; top: 0;background: #00A2CA; text-align: center; z-index: 1;}
i#file_info{ position: relative; left: 250px; font-style: normal; }
i.smbox-help{ position: relative; left: 250px; font-style: normal; }
</style>
<script type="text/javascript"> 
$(function(){
    $("#imgboxid dl .close").live("click",function(){
        $(this).parent("dl").remove();
    });
   
    $(".submit").on("click",function(){     
        $(".form-control").each(function(){
            if($(this).hasClass("textarea")){
                return;
            }
            if($(".form-control").val()==""){
                var tit=$(this).parent().prev().html();
               $(this).next(".field-info").addClass("field-val-error");
               $(this).next(".field-info").html(tit+"不能为空");      
            }      
        });  
        if($("#imgboxid dl").length==0){
           $("#file_info").addClass("field-val-error");
           $("#file_info").html("请选择图片");
           return;
        }
        if($(".field-info").hasClass("field-val-error")){
         return;    
        }else{
          $("#form1").submit(); 
        }
    });
    $("#periods").on("change",function(){
        $(".form-control").next(".field-info").html("");
        $(".form-control").next(".field-info").removeClass("field-val-error");
    });
    $(".form-control").on("focus",function(){
        $(this).next(".field-info").html("");
        $(this).next(".field-info").removeClass("field-val-error");
    });
    $(".filebox").on("change",function(){
         $("#file_info").removeClass("field-val-error");
         $("#file_info").html("");
    });
});  
</script>
</head>
<body>
<div class="samao-body">
  <div class="form-title">营地相册</div>
  <div class="samao-form">
 {@if $action=='edit'@}
      <form method="post" action="__SELF__/editSave" id="form1" enctype="multipart/form-data">
          <input type="hidden" name="id" value="{@$row.id@}">
      {@else@}
    <form method="post" action="__SELF__/saveDiary" id="form1" enctype="multipart/form-data">
      {@/if@}      <div class="form-panel"  >
      <div class="form-group"  id="row_title">
        <label class="form-label"  style="width:150px">选择营期</label>
        <div class="form-box">
          <select name="periods" id="periods" class="form-control select" style="width:150px" header="未选择" >
            <option value="" >未选择</option>
             {@foreach from=$periods item=period@}
                {@if $row.periods==$period.periods@}    
                <option value="{@$period.periods@}" data-date="{@$period.start@}" data-days="{@$period.days@}" selected="selected">第{@$period.periods@}期</option>
                {@else@}
                <option value="{@$period.periods@}" data-date="{@$period.start@}" data-days="{@$period.days@}">第{@$period.periods@}期</option>
                {@/if@}        
                {@/foreach@}
          </select>
          <span id="title_info" class="field-info"></span></div>
      </div>
      <div class="form-group">
        <label class="form-label"  style="width:150px">起始时间</label>
        <div class="form-box">
          <input name="start" id="start" class="form-control text" value="{@$row.start@}" style="" type="text">
          <span id="title_info" class="field-info"></span></div>
       </div>
       <div class="form-group">
        <label class="form-label"  style="width:150px">出发天数</label>
        <div class="form-box">
          <input name="days" id="days" value="{@$row.days@}"  class="form-control text" style="" type="text">
          <span id="title_info" class="field-info"></span></div> 
      </div>
      <div class="form-group"  id="row_content">
        <label class="form-label"  style="width:150px">相册描述</label>
        <div class="form-box" >
          <textarea name="content" id="content" class="form-control textarea" style="width:500px; height:120px;"  >{@$row.content@}</textarea>
          <span id="content_info" class="field-info"></span></div> 
      </div>
      <div class="form-group" >
        <div id="wrapper">
          <div id="container">
          <div class="form-box">
            <label class="form-label haha" >
            上传图片:
            <input type="file" class="filebox" name="file[]" onclick="upd_file(this,'file');" id="file" multiple />
            <span>选择文件</span><i class="smbox-help">单次选择不能超过10张</i>
            <i id="file_info" class="field-info"></i>
            </label>
            
          </div>
              <div class="img-box" id="imgboxid">
                  {@foreach from=$imgs item=pic@}
                  <dl><img src="{@$pic|minimg:100:100:1@}">
                      <div class="close">X</div>
                      <input type="hidden" value="{@$pic@}" name="img[]">
                  </dl>
                  {@/foreach@}
              </div>
            <div id="xmTanDiv"></div>
           
            <br/>
            <div id="errordiv" style="margin-top:15px;width:100%;text-align:center;"></div>
          </div>
        </div>
        <div style="clear:both"></div>
      </div>
      <div class="form-submit" >
        <input type="hidden" name="campid" value="{@$campid@}">
        <input type="button" class="submit" value="提交" />
        <div style="clear:both"></div>
      </div>
    </form>
  </div>
</div>
<script type="text/javascript">
   $("#periods").change(function(){
       var date = $("#periods").find("option:selected").attr('data-date');
       var days = $("#periods").find("option:selected").attr('data-days'); 
       $("#start").val(date);
       $("#days").val(days);
    });
</script>
</body>
</html>
