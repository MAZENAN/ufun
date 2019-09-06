<?php
class CommentMarkController extends SmcmsController{

	public function listData($select){
            $select->find("@pf_comment_mark.*,member.mobile,orders.orderid,camp.id as cid,camp.title,camp.type,orders.departure_option");
            $select->join("@pf_member as member");
            $select->join("@pf_camp as camp");
            $select->join("@pf_order as orders");
            $select->where('and @pf_comment_mark.user_id = member.id and camp_id = camp.id ');
            $select->where('and @pf_comment_mark.order_id = orders.id');
            if(!empty($this->sch['content'])){
                  $val=trim($this->sch['content']);
                  switch ($this->sch['screen']) {
                        case '1':
                               $select->like_search("and camp.title like ?", $val);
                              break;
                        case '2':
                              $select->like_search("and orders.orderid like ?", $val);
                              break;
                        case '3';
                              $select->like_search("and member.mobile like ?", $val);
                              break;
                        default:
                              # code...
                              break;
                  }
            }
           return parent::listData($select);
	}
        /**
         * 评论回复
         */
        public function replayAction(){
            $id=IGet('id');
            $p_comment=DB::getOne('SELECT cm.id, cm.pid, cm.user_id, cm.camp_id, cm.info, cm.add_time, m.nickname FROM @pf_comment_mark cm LEFT JOIN @pf_member m ON cm.user_id = m.id ,@pf_camp cp WHERE cm.camp_id = cp.id AND cm.id =?',[$id]);
            $c_comment = DB::getone("select id,info from @pf_comment_mark where pid=?",[$id]);
            $model = Model($this->ModelName);
            $model->Fields['comment_info']->default = $p_comment['info'];

            $nickname=$p_comment['nickname']?$p_comment['nickname']:'游客';
            $model->Fields['user_info']->default = $nickname."&nbsp;&nbsp;".$p_comment['add_time'];

            $model->Fields['camp_id']->default = $p_comment['camp_id'];
            $model->Fields['pid']->default = $p_comment['pid']?$p_comment['pid']:$p_comment['id'];
            $model->Fields['p_userid']->default = $p_comment['user_id'];
            $model->Fields['info']->default = $c_comment['info']?$c_comment['info']:'';

            if (IS_POST) {
                    $model->autoComplete($xvals);
                if ($model->validation()) {
                    
                        if($c_comment['info']){
                            DB::update('@pf_comment_mark', $xvals, 'id=?', [$c_comment['id']]);
                        }else{
                            DB::insert('@pf_comment_mark', $xvals);
                        }
                    }
                    $this->success('回复成功!');
            }

            $this->setModel($model);
            $this->displayModel($model);
        }
        
}