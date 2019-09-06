<?php if(!defined('SAMAO_VERSION')) exit('no direct access allowed');

class SystemModel extends SmcmsModel {
    public function __construct($modeltype = self::MODEL_ADD) {
        
        $this->tbname = '--';
        $this->type = 1;
        $this->title = '营天下后台';
        $this->toptip = '整个系统后台模型！';
        $this->istab = false;
        $this->tabsplit = false;
        $this->btns_left = 0;
        parent::__construct($modeltype);
    }
    public function fields() {
        return array(
        
        );
    }
}
