<?php

defined('SAMAO_LOG') or define('SAMAO_LOG', '');

class SamaoError extends ErrorException {

    protected $errorTrace;
    protected static $pfile = '';
    protected static $pline = 0;

    public function __construct($errorMessage = '', $errorCode = 0, $errorFile = '', $errorLine = 0, $errorTrace = array()) {
        $this->errorTrace = $errorTrace;
        parent::__construct($errorMessage, $errorCode, 0, $errorFile, $errorLine);
        $this->toprint();
    }

    public function toprint() {
        if (!DEV_DEBUG && SAMAO_LOG == '') {
            echo 'ERROR!';
            return;
        }
        $oldfile = $this->file;
        $oldline = $this->line;
        $linearr = array();
        $linearrt = array();
        $traces = $this->errorTrace;
        foreach ($traces as $trace) {
            if (isset($trace['line']) && isset($trace['file'])) {
                $this->file = $trace['file'];
                $this->line = $trace['line'];
                $this->function = '';
                $this->args = '';
                if (isset($trace['function'])) {
                    $this->function = $trace['function'];
                    if ($this->function == '__call') {
                        continue;
                    }
                    if (isset($trace['class']) && isset($trace['type'])) {
                        $this->function = $trace['class'] . $trace['type'] . $trace['function'] . '()';
                    }
                    if (isset($trace['args'])) {
                        @$this->args = print_r($trace['args'], TRUE);
                    }
                }
                break;
            }
        }

        if (!empty($this->file) && realpath($this->file)) {
            $lines = file($this->file);
            if ($this->line > 2 && isset($lines[$this->line - 3])) {
                $linearr[] = '<pre style="background-color:#FFD"> ' . htmlspecialchars(trim(($this->line - 2) . '.  ' . $lines[$this->line - 3])) . '</pre>';
                $linearrt[] = trim(($this->line - 2) . '.  ' . $lines[$this->line - 3]);
            }
            if ($this->line > 1 && isset($lines[$this->line - 2])) {
                $linearr[] = '<pre style="background-color:#FFD"> ' . htmlspecialchars(trim(($this->line - 1) . '.  ' . $lines[$this->line - 2])) . '</pre>';
                $linearrt[] = trim(($this->line - 1) . '.  ' . $lines[$this->line - 2]);
            }
            $linearr[] = '<pre style="color:#F00; background-color:#FCC"> ' . htmlspecialchars(trim(($this->line) . '.  ' . $lines[$this->line - 1])) . '</pre>';
            $linearrt[] = trim(($this->line) . '.  ' . $lines[$this->line - 1]);
            if (isset($lines[$this->line])) {
                $linearr[] = '<pre style="background-color:#FFD"> ' . htmlspecialchars(trim(($this->line + 1) . '.  ' . $lines[$this->line])) . '</pre>';
                $linearrt[] = trim(($this->line + 1) . '.  ' . $lines[$this->line]);
            }
            if (isset($lines[$this->line + 1])) {
                $linearr[] = '<pre style="background-color:#FFD"> ' . htmlspecialchars(trim(($this->line + 2) . '.  ' . $lines[$this->line + 1])) . '</pre>';
                $linearrt[] = trim(($this->line + 2) . '.  ' . $lines[$this->line + 1]);
            }
        }

        $errorCodeText = join("\n", $linearr);
        $htmlerr = '<table width="100%" style="background-color:#F90" border="0" cellspacing="1" cellpadding="5">
            <tr>
            <td width="100" height="30" bgcolor="#FF6600"><strong>Call Stack</strong></td>
            <td width="400" height="30" bgcolor="#FF6600"><strong>Function</strong></td>
            <td  bgcolor="#FF6600"><strong>Location</strong></td>
            <td width="50" bgcolor="#FF6600"><strong>Line</strong></td>
            </tr>';
        foreach ($traces as $key => $trace) {
            $trace['function'] = isset($trace['function']) ? $trace['function'] : '';
            //$trace['args'] = isset($trace['args']) ? htmlspecialchars(var_export($trace['args'], TRUE)) : '';
            if (isset($trace['class']) && isset($trace['type'])) {
                $trace['function'] = $trace['class'] . $trace['type'] . $trace['function'];
            }
            if (!empty($trace['function'])) {
                $trace['function'].='()';
            }
$temp = '<tr>
    <td bgcolor="#FFFFCC">' . $key . '</td>
    <td bgcolor="#FFFFCC">' . $trace['function'] . '</td>
    <td bgcolor="#FFFFCC">' . (empty($trace['file']) ? '' : $trace['file']) . '</td>
    <td bgcolor="#FFFFCC">' . (empty($trace['line']) ? '' : $trace['line']) . '</td>
</tr>';
            $htmlerr .= $temp;
        }
        $htmlerr .= '</table><br/>';
        $html = '<!--
以下是错误信息：
===================================================================
' . $this->message . '
-------------------------------------------------------------------
所在页面：' . $this->file . '  (' . $this->line . ')
-------------------------------------------------------------------
代码附近：
' . join("\n", $linearrt) . '
===================================================================

-->
<html>
<head>
<title>SamaoPHP 提示您，您的代码出错啦！</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">body,td,th,pre{font-family: "微软雅黑";font-size: 14px;word-break:break-all;word-wrap:break-word;line-height:24px;}pre{margin:1px;} pre{white-space: pre-wrap!important;word-wrap: break-word!important;} body {margin-left: 10px;margin-top: 10px;margin-right: 10px;margin-bottom: 10px;}</style>
</head>
<body>
<div style="font-size:26px;line-height:40px; height:40px; font-weight:bold">SamaoPHP 提示您，您的代码出错啦！</div>
<table width="100%" style="background-color:#F90" border="0" cellspacing="1" cellpadding="5"><tr>
<td height="30" bgcolor="#FF6600" colspan="2"><strong>（！）SamaoPHP错误提示：</strong></td></tr>
<tr>
<td  width="160" bgcolor="#FFFFCC">所在页面（行）：</td>
<td bgcolor="#FFFFCC">' . $this->file . '&nbsp;&nbsp;(' . $this->line . ')</td>
</tr>
<tr>
<td bgcolor="#FFFFCC">错误提示信息：</td>
<td bgcolor="#FFFFCC">
<pre>' . $this->message . '</pre>
</td></tr>';
        if (!empty($this->function) && $this->function != 'throw new SamaoException') {
            $html.='<tr><td bgcolor="#FFFFCC">执行函数：</td><td bgcolor="#FFFFCC"><pre>' . htmlspecialchars($this->function) . '</pre></td></tr>' . "\n";
            if (!empty($this->args)) {
                $html.='<tr><td bgcolor="#FFFFCC">函数参数：</td><td bgcolor="#FFFFCC"><pre>' . htmlspecialchars($this->args) . '</pre></td></tr>' . "\n";
            }
        }
        if ($_GET) {
            $html.='<tr><td bgcolor="#FFFFCC">GET 信息：</td><td bgcolor="#FFFFCC"><pre>' . htmlspecialchars(print_r($_GET, TRUE)) . '</pre></td></tr>' . "\n";
        }
        if ($_POST) {
            $html.='<tr><td bgcolor="#FFFFCC">POST 信息：</td><td bgcolor="#FFFFCC"><pre>' . htmlspecialchars(print_r($_POST, TRUE)) . '</pre></td></tr>' . "\n";
        }
        $html.='<tr><td bgcolor="#FFFFCC">错误代码附近：</td><td bgcolor="#FFFFCC">' . $errorCodeText . '</td></tr>' . "\n";
        $html.='<tr><td bgcolor="#FFFFCC">触发页面(行)：</td><td bgcolor="#FFFFCC">' . $oldfile . ' (' . $oldline . ')</td></tr>' . "\n";
        $html.='<tr><td bgcolor="#FFFFCC">所抛出信息页面(行)：</td><td bgcolor="#FFFFCC">' . self::$pfile . ' (' . self::$pline . ')</td></tr>' . "\n";
        $html .='</table><br/>';
        $html = $html . $htmlerr;
        $html .='</body>
</html>
<!--报错提示结束-->
';
        if (SAMAO_LOG != '') {
            $text = date('Y-m-d H:i:s') . '-----------' . "\r\n" . $html . "\r\n";
            file_put_contents(SAMAO_LOG . DIRECTORY_SEPARATOR . date('YmdHis') . '.log.html', $text . "\r\n", FILE_APPEND);
        }
        if (DEV_DEBUG) {
            echo $html;
        }
       return;
    }

}
