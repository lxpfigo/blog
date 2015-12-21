<?php
namespace Framework\Wechat;
/**
 * Created by PhpStorm.
 * User: lxpfigo
 * Date: 2015/12/17
 * Time: 11:33
 */
class WechatIp
{
    static public function getIp()
    {
        $accessToken = AccessToken::getAccessToken();
        $url = 'https://api.weixin.qq.com/cgi-bin/getcallbackip?access_token='.$accessToken;
        $res =  Curl::httpGet($url);
        return Error::isError($res) ? false : $res['ip_list'];
    }
}