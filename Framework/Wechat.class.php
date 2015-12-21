<?php
namespace Framework;
use Framework\Wechat\WechatRequest;
/**
 * Created by PhpStorm.
 * User: lxpfigo
 * Date: 2015/12/16
 * Time: 9:23
 * 微信入口文件
 */
class Wechat
{
    private  $request;//保存微信post过来的数组
    public function __construct()
    {
        if (isset($_GET["echostr"])) {
            $this->valid();
        }
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        $post = (array) simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
        $this->request = array_change_key_case($post, CASE_LOWER);//将key变为小写
    }

    /*通过key值获取值*/
    protected function getRequest($key = FALSE)
    {
        if ($key === FALSE) {
            return $this->request;
        }
        $key = strtolower($key);
        if (isset($this->request[$key])) {
            return $this->request[$key];
        }
        return NULL;
    }

    /*验证合法性*/
    private function valid()
    {
        $echoStr = $_GET["echostr"];
        if($this->checkSignature()){
            echo $echoStr;
            exit;
        }
    }

    /*检查签名*/
    private function checkSignature()
    {
        $token = getConfig('WX');
        if (!$token['Token']) {
            throw new \Exception('TOKEN is not defined!');
        }

        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        $token = $token['Token'];
        $tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }

    public function run()
    {
        $mmc = memcache_init();
        $mmc->set('request', $this->request);
        WechatRequest::switchType($this->request);
    }

}