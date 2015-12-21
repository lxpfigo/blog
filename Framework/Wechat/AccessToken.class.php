<?php
namespace Framework\Wechat;
/**
 * Created by PhpStorm.
 * User: lxpfigo
 * Date: 2015/12/16
 * Time: 16:08
 * 获取accesstoken
 */
class AccessToken
{
    static public function getAccessToken()
    {
        $mmc = memcache_init();
        $accessTokenArr = @$mmc->get('accessToken');
        $accessToken = $accessTokenArr['access_token'];
        if (!isset($accessTokenArr['access_token']) || time() - $accessTokenArr['expires'] > 7200 - 100)
        {
            $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&'.
                'appid='.getConfig('WX')['appID'].'&secret='.getConfig('WX')['appsecret'];
            $res = Curl::httpGet($url);
            if (Error::isError($res)) {
                return false;
            }
            $res['expires'] = time();
            //存入Memcache
            $mmc->set('accessToken', $res, 7200);
            $accessToken = $res['access_token'];
        }
        return $accessToken;
    }
}