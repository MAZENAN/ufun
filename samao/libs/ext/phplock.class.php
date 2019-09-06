<?php

/**
 * PHPLock进程锁
 */
class PHPLock {

    /**
     * 锁文件路径
     *
     * @var String
     */
    public $path = null;

    /**
     * 文件句柄
     *
     * @var resource 
     */
    private $fp = null;

    /**
     * 锁的粒度控制，设置的越大粒度越小
     *
     * @var int
     */
    private $hashNum = 100;
    private $name;
    private $eAccelerator = false;
    private $wincache = false;

    /**
     * 构造函数
     *
     * @param string $path 锁的存放目录，以"/"结尾
     * @param string $name 锁名称，一般在对资源加锁的时候，会命名一个名字，这样不同的资源可以并发的进行。
     */
    public function __construct($path, $name) {
        $this->name = $name;
        $this->wincache = function_exists("wincache_lock");
        if ($this->wincache) {
            return;
        }
        $this->eAccelerator = function_exists("eaccelerator_lock");
        if ($this->wincache) {
            return;
        }
        $this->path = $path . ($this->mycrc32($name) % $this->hashNum) . '.txt';
    }

    /**
     * crc32的封装
     *
     * @param string $string
     * @return int
     */
    private function mycrc32($string) {
        $crc = abs(crc32($string));
        if ($crc & 0x80000000) {
            $crc ^= 0xffffffff;
            $crc += 1;
        }
        return $crc;
    }

    /**
     * 初始化锁，是加锁前的必须步骤
     * 打开一个文件
     *
     */
    public function startLock() {
        if ($this->wincache || $this->eAccelerator) {
            return;
        }
        $this->fp = fopen($this->path, "w+");
    }

    /**
     * 开始加锁
     *
     * @return bool 加锁成功返回true,失败返回false
     */
    public function lock() {
        if ($this->wincache) {
            return wincache_lock($this->name);
        }
        if ($this->eAccelerator) {
            return eaccelerator_lock($this->name);
        }
        if ($this->fp === false) {
            return false;
        }
        return flock($this->fp, LOCK_EX);
    }

    /**
     * 释放锁
     *
     */
    public function unlock() {
        if ($this->wincache) {
            return wincache_unlock($this->name);
        }
        if ($this->eAccelerator) {
            return eaccelerator_unlock($this->name);
        }
        if ($this->fp !== false) {
            flock($this->fp, LOCK_UN);
            clearstatcache();
            return true;
        }
        return false;
    }

    /**
     * 结束锁控制
     *
     */
    public function endLock() {
        if ($this->wincache || $this->eAccelerator) {
            return;
        }
        fclose($this->fp);
    }

}
