<?php

class CommentController extends SmcmsController{
    public function listData($select) {
     	$select->find('@pf_comment.id,@pf_comment.camp_id,@pf_comment.add_time,@pf_comment.comment,@pf_comment.user_id,@pf_camp.title,@pf_camp.type,@pf_comment.pid, '
                . '(select nickname from @pf_member as m where m.id=@pf_comment.user_id ) as nickname,'
                . '(select mobile from @pf_member as m where m.id=@pf_comment.user_id ) as mobile ,'
                . '(select count(1) from @pf_comment as c  where c.pid = @pf_comment.id ) as sun');
     	$select->join('@pf_camp');
     	$select->where('and @pf_comment.camp_id=@pf_camp.id');
        //是否回复筛选
        $replay = SGet('replay');
        if(!empty($replay)){
            $sql = "and @pf_comment.id in(select cs.pid from sl_comment as cs where cs.user_id = -1 group by cs.pid)";
            if($replay == 2){
              $sql = "and @pf_comment.id not in(select cs.pid from sl_comment as cs where cs.user_id = -1 group by cs.pid) and pid =0";
            }
            $select->where($sql);
        }else{
            //所有一级列表
            $select->where('and @pf_comment.pid = ? ',[0]);
        }
        $select->orderby('add_time desc');

        
       return parent::listData($select);
    }
    public function replayAction(){
        $model = Model($this->ModelName);
    	$comment_id=IGet('id');
    	$comment_date = DB::getlist('select '
                . 'comment.id,pid,p_userid,user_id,comment,comment.add_time,member.mobile,camp_id,camp.title, '
                . '(select nickname from @pf_member as m  where case when comment.user_id > 0 then m.id = comment.user_id else m.id = comment.p_userid end) as nickname,'
                . '(select mobile from @pf_member as mm where case when comment.user_id > 0 then mm.id = comment.user_id else mm.id = comment.p_userid end) as mobile '
                . 'from @pf_comment as comment '
                . 'left join @pf_member as member on comment.user_id=member.id '
                . 'left join @pf_camp as camp on comment.camp_id = camp.id '
                . 'where comment.pid=? or comment.id = ? order by comment.add_time asc',[$comment_id,$comment_id]);
    	
   	if (IS_POST) {
            $model->autoComplete($vals);
            if ($model->validation()) {
                $insert_info['comment'] = $vals['comment'];
                $insert_info['pid'] = SPost('id');//父ID
                $insert_info['camp_id'] = SPost('camp_id');//产品ID
                $insert_info['user_id'] ='-1';
                $insert_info['p_userid'] =SPost('user_id');
                $insert_info['add_time'] = date('Y-m-d H:i:s');
                //var_dump( $insert_info);die();
                $title = SPost('title');
                $user_id = SPost('user_id');
                $comment_centent = SPost('centent');
                DB::insert('@pf_comment', $insert_info);
                if($user_id > 0){
                     msg::sendMsg($user_id, '咨询被回复', '您在'.$title .  '中的留言'.$comment_centent . '已经被营天下的课程顾问解答：' .$insert_info['comment'] , '咨询');
                }
                }
                $this->success('回复成功!');
    	}
        //var_dump( $comment_date);die();
        $this->assign('id',$comment_id);
        $this->assign('rows',$comment_date);
        $this->displayModel($model,'layout/replay_list.tpl');
    }
    
    public function deleteAction() {
        $comment_id = SGet('id');
        $replay = SGet('replay');//回复列表中的删除，主要是删除后跳转不同
        DB::delete("@pf_comment","id = ? or pid =? ",[$comment_id,$comment_id]);
        if(!empty($replay)){
           $this->success('删除成功',__SELF__,1,0,'
               window.parent.$("iframe").each(function(){
                       var url=$(this).attr("src");
                       var patt=new RegExp("/admin/comment");
                       if(patt.test(url)){
                           $(this)[0].contentWindow.location.reload();
                           window.close(); 
                       }
                   });  ');
           return;
        }
        $this->success('删除成功');
        
    }
}
