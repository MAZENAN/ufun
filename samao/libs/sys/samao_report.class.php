<?php

class SamaoReport {

    public static $Info = array();

    public static function getMicrotime() {
        list ($usec, $sec) = explode(" ", microtime());
        return floatval($usec) + floatval($sec);
    }

    public static function StartTime() {
        self::$Info['StartTime'] = self::getMicrotime();
    }

    public static function EndTime() {
        self::$Info['EndTime'] = self::getMicrotime();
        self::$Info['TotalTime'] = round(self::$Info['EndTime'] - self::$Info['StartTime'], 4);
    }

    private static function convert($size) {
		if($size<=0){
			return 0;
		}
        $unit = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
		$bit=pow(1024, ($i = floor(log($size, 1024))));
		if($bit>0){
        return round($size /$bit , 4) . ' ' . $unit[$i];
		}else{
			return 0;
		}
    }

    public static function addQueryTime($time) {
        if (!isset(self::$Info['QueryTime'])) {
            self::$Info['QueryTime'] = 0;
        }
        self::$Info['QueryTime']+=$time;
    }

    public static function addConfigName($name) {
        if (!isset(self::$Info['ConfigNames'])) {
            self::$Info['ConfigNames'] = array();
        }
        self::$Info['ConfigNames'][] = $name;
    }

    public static function setDBConnectionTime($time) {
        self::$Info['DBConnectionTime'] = $time;
    }

    public static function Log($msg) {
        if (!isset(self::$Info['LOG'])) {
            self::$Info['LOG'] = array();
        }
        if (gettype($msg) != 'string') {
            self::$Info['LOG'][] = print_r($msg, true);
        } else {
            self::$Info['LOG'][] = $msg;
        }
    }

    public static function EndReport() {
        if (defined('IS_AJAX') && IS_AJAX) {
            return;
        }
        if (defined('DEV_REPORT_CLOSE') && DEV_REPORT_CLOSE) {
            return;
        }
        self::EndTime();
        self::$Info['QuerySQL'] = DB::getqueryStrings();
        self::$Info['Memory'] = self::convert(memory_get_usage(true));
        $incfiles = get_included_files();
        foreach ($incfiles as $key => $file) {
		    if(DEV_DEBUG){
				$incfiles[$key] = $file . '  [' . self::convert(filesize($file)) . ']';
			}
			else{
				$incfiles[$key] = $file;
			}
        }
        self::$Info['IncludedFiles'] = $incfiles;
        $Qtime = date('Y-m-d H:i:s');
        $Info = self::$Info;
        $Info['ConfigNames'] = isset($Info['ConfigNames']) ? $Info['ConfigNames'] : array();
        $Info['LOG'] = isset($Info['LOG']) ? $Info['LOG'] : array();
        $Info['QueryTime'] = isset($Info['QueryTime']) ? sprintf('%f', $Info['QueryTime']) : 0;
        $Info['DBConnectionTime'] = isset($Info['DBConnectionTime']) ? sprintf('%f', $Info['DBConnectionTime']) : 0;
        $Info['TotalTimeMs'] = round($Info['TotalTime'] * 1000);
        $Info['TotalTime'] = sprintf('%f', $Info['TotalTime']);

        $SQLlen = count($Info['QuerySQL']);
        $Filelen = count($Info['IncludedFiles']);
        $CfgLen = count($Info['ConfigNames']);
        $PHP_VERSION = PHP_VERSION;
        $ctl = Route::get('ctl');
        $act = Route::get('act');
        $cookies = isset($_SERVER['HTTP_COOKIE']) ? $_SERVER['HTTP_COOKIE'] : '';
        $Files = '<li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">' .
                join('</li>' . "\n" . '<li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">', $Info['IncludedFiles'])
                . '</li>';
        $Logs = '<li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px"><pre style="padding:0;margin:0;font-family:\微软雅黑\';">' .
                join('</pre></li>' . "\n" . '<li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px"><pre style="padding:0;margin:0;font-family:\微软雅黑\';">', $Info['LOG'])
                . '</pre></li>';
        $Sqls = '<li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px"><pre style="padding:0;margin:0;font-family:\微软雅黑\';">' .
                join('</pre></li>' . "\n" . '<li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px"><pre style="padding:0;margin:0;font-family:\微软雅黑\';">', $Info['QuerySQL'])
                . '</pre></li>';
        $tipdev = DEV_DEBUG == true ? '关闭调试可以更快' : '已关闭调试';
        $html = <<< HTML
<div id="samao_page_trace" style="position: fixed;bottom:0;right:0;font-size:14px;width:100%;z-index: 999999;color: #000;text-align:left;font-family:'微软雅黑';">
<div id="samao_page_trace_tab" style="display: none;background:white;margin:0;height: 280px;">
<div id="samao_page_trace_tab_tit" style="height:30px;padding: 6px 12px 0;border-bottom:1px solid #ececec;border-top:1px solid #ececec;font-size:16px;background:#F7F7F7;">
	<span style="color:#000;padding-right:12px;height:30px;line-height: 30px;display:inline-block;margin-right:3px;cursor: pointer;font-weight:700">基本</span>
        <span style="color:#000;padding-right:12px;height:30px;line-height: 30px;display:inline-block;margin-right:3px;cursor: pointer;font-weight:700">文件</span>
        <span style="color:#000;padding-right:12px;height:30px;line-height: 30px;display:inline-block;margin-right:3px;cursor: pointer;font-weight:700">日志</span>
        <span style="color:#000;padding-right:12px;height:30px;line-height: 30px;display:inline-block;margin-right:3px;cursor: pointer;font-weight:700">SQL</span>
    </div>
<div id="samao_page_trace_tab_cont" style="overflow:auto;height:242px;padding: 0; line-height: 24px">
		    <div style="display:none;">
    <ol style="padding: 0; margin:0">
	<li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">请求信息 : {$Qtime} {$_SERVER['SERVER_PROTOCOL']} {$_SERVER['REQUEST_METHOD']} : {$_SERVER['REQUEST_URI']}</li>
        <li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">运行时间 : {$Info['TotalTime']}s , {$Info['TotalTimeMs']}ms &nbsp; ( 数据库连接:{$Info['DBConnectionTime']}s &nbsp; SQL执行总计时间:{$Info['QueryTime']}s ) {$tipdev}</li>
        <li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">内存开销 : {$Info['Memory']}</li>
        <li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">查询信息 : {$SQLlen} queries </li>
        <li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">文件加载 : {$Filelen}</li>
        <li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">执行控制器 : {$ctl} &nbsp;&nbsp;执行动作： {$act}  </li>
        <li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">配置加载 : {$CfgLen} </li>
        <li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">会话信息 : {$cookies}</li>
        <li style="border-bottom:1px solid #EEE;font-size:14px;padding:0 12px">PHP版本 : {$PHP_VERSION}</li>
        </ol>
    </div>
    <div style="display:none;">
    <ol style="padding: 0; margin:0">
        {$Files}
    </ol>
    </div>
        <div style="display:none;">
    <ol style="padding: 0; margin:0">
        {$Logs}
    </ol>
    </div>
        <div style="display:none;">
    <ol style="padding: 0; margin:0">
        {$Sqls}
    </ol>
    </div>
        
    </div>
</div>
<div id="samao_page_trace_close" style="display:none;text-align:right;height:15px;position:absolute;top:10px;right:12px;cursor: pointer;"><a href="#" style="margin-right:40px; color:#999;">隐藏</a><a href="#" style="color:#999;">取消监视</a></div>
</div>
<div id="samao_page_trace_open" style="height:30px;float:right;text-align: right;overflow:hidden;position:fixed;bottom:0;right:0;color:#000;line-height:30px;cursor:pointer;">
    <div style="background:#232323;color:#FFF;padding:0 6px;float:right;line-height:30px;font-size:14px">{$Info['TotalTimeMs']}ms </div><img width="30" style="" title="ShowPageTrace" src="data:image/png;base64,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"></div>
<script type="text/javascript">
(function(){
var tab_tit  = document.getElementById('samao_page_trace_tab_tit').getElementsByTagName('span');
var tab_cont = document.getElementById('samao_page_trace_tab_cont').getElementsByTagName('div');
var open     = document.getElementById('samao_page_trace_open');
var close    = document.getElementById('samao_page_trace_close').childNodes[0];
var closeall = document.getElementById('samao_page_trace_close').childNodes[1];
var trace    = document.getElementById('samao_page_trace_tab');
var cookie   = document.cookie.match(/samao_show_page_trace=(\d\|\d)/);
var history  = (cookie && typeof cookie[1] != 'undefined' && cookie[1].split('|')) || [0,0];
open.onclick = function(){
	trace.style.display = 'block';
	this.style.display = 'none';
	close.parentNode.style.display = 'block';
	history[0] = 1;
	document.cookie = 'samao_show_page_trace='+history.join('|')
}
close.onclick = function(){
	trace.style.display = 'none';
        this.parentNode.style.display = 'none';
	open.style.display = 'block';
	history[0] = 0;
	document.cookie = 'samao_show_page_trace='+history.join('|');
        return false;
}
closeall.onclick = function(){
	trace.style.display = 'none';
        this.parentNode.style.display = 'none';
        history[0] = 0;
	document.cookie = 'samao_show_page_trace='+history.join('|');
        return false;
}

for(var i = 0; i < tab_tit.length; i++){
	tab_tit[i].onclick = (function(i){
		return function(){
			for(var j = 0; j < tab_cont.length; j++){
				tab_cont[j].style.display = 'none';
				tab_tit[j].style.color = '#999';
			}
			tab_cont[i].style.display = 'block';
			tab_tit[i].style.color = '#000';
			history[1] = i;
			document.cookie = 'samao_show_page_trace='+history.join('|')
		}
	})(i)
}
parseInt(history[0]) && open.click();
tab_tit[history[1]].click();
})();
</script>
HTML;
        echo $html;
    }

}
