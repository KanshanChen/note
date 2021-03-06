<?php
/**
 * 日志输出类
 * User: Jaleel
 * Date: 2015/1/22
 * Time: 0:13
 */

class Logger {
    public static function writeTestLog($msg) {
        self::printLog('test', $msg);
    }


    public static function writeOnlineLog() {

    }

    public static function printLog($path, $msg) {
        $dir = '/var/www/html/tip/disk/' . $path;

        //判断目录是否存在  不存在则创建之
        if (file_exists($dir) === false) {
            mkdir($dir, 0777);
        }

        //Time:xxxIp:xxxMSG:xxx
        //得到客户端的IP地址
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } else if (!empty($_SERVER['HTTP_X_FORWARD_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARD_FOR'];
        } else if (!empty($_SERVER['REMOTE_ADDR'])) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        $filename = $dir . "/" . date('Ymd') . ".log";
        $f = fopen($filename, 'ab');
        $content = 'Time:' . date('Y-m-d H:i:s') . " IP:" . $ip . " MSG:" . $msg;
        fwrite($f, $content);
        fclose($f);
    }
}