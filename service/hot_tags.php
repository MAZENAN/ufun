<?php

include 'include.inc.php';
import('libs.*');

class HotTagsController {
      
    function indexAction() {
        $sql = "UPDATE sl_tag set count=(SELECT count(*) from sl_article_tag  where  sl_article_tag.tag_id=sl_tag.id)";//group by mobile
        DB::exec($sql);
        echo "成功";
    }
}   

APP::SimpleRun();