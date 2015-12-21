<?php
namespace Framework\Wechat;
/**
 * Created by PhpStorm.
 * User: lxpfigo
 * Date: 2015/12/16
 * Time: 16:11
 * curl工具
 */
class Curl
{
    private static $ch;
    static private function init()
    {
        self::$ch = curl_init();
        curl_setopt(self::$ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(self::$ch, CURLOPT_TIMEOUT, 500);
        curl_setopt(self::$ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt(self::$ch, CURLOPT_SSL_VERIFYHOST, true);
    }

    static public function httpGet($url, $data = NULL)
    {
        self::init();
        curl_setopt(self::$ch, CURLOPT_URL, $url);
        if (!empty($data)) {
            $data = json_encode($data, JSON_UNESCAPED_UNICODE);
            curl_setopt(self::$ch, CURLOPT_POST, 1);
            curl_setopt(self::$ch, CURLOPT_POSTFIELDS, $data);
        }
        $res = curl_exec(self::$ch);
        curl_close(self::$ch);
        return json_decode($res, true);
    }
}