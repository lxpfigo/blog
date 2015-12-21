<?php
namespace Framework\Wechat;
/*微信js类*/
class JSSDK
{
    static public function getSignPackage()
    {
        $jsapiTicket = self::getJsApiTicket();
        // 注意 URL 一定要动态获取，不能 hardcode.
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $url = $protocol.$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI];
        $timestamp = time();
        $nonceStr = self::createNonceStr();

        // 这里参数的顺序要按照 key 值 ASCII 码升序排序 这里用"&amp;"代替& 否则&times会给转义城X
        $string = "jsapi_ticket={$jsapiTicket}&noncestr={$nonceStr}&timestamp={$timestamp}&url={$url}";
        $signature = sha1($string);

        $signPackage = array(
            "appId" => getConfig('WX')['appID'],
            "nonceStr" => $nonceStr,
            "timestamp" => $timestamp,
            "url" => $url,
            "signature" => $signature,
            "rawString" => $string
        );
        return $signPackage;
    }

    static private function createNonceStr($length = 16)
    {
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= random();
        }
        return $str;
    }

    static private function getJsApiTicket()
    {
        $mmc = memcache_init();
		$ticketInfo = @$mmc->get('ticket');
		if (isset($ticketInfo['ticket']) && (time() - $ticketInfo['expires']) < 7000) {
			return $ticketInfo['ticket'];
		}
        $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=".AccessToken::getAccessToken();
        $res = Curl::httpGet($url);
        if (Error::isError($res)) {
            exit();
        }
        $data['ticket'] = $res['ticket'];
        $data['expires'] = time();
        //存入Memcache
        $mmc->set('ticket', $data, 7200);
        return $res['ticket'];
    }


}