<?php
namespace Framework\Wechat;
/*
    推广类，二维码，长短链接
*/

class Popularize
{
    /*获取临时ticket*/
    static public function Tempticket($id, $time = 604800)
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.AccessToken::getAccessToken();
        $data = array(
            'expire_seconds'=> $time,
            'action_name'=> 'QR_SCENE',
            'action_info'=> array(
                'scene'=> array(
                  'scene_id'=> $id,
                ),
            ),
        );
        $res = Curl::httpGet($url, $data);
        return Error::isError($res) ? false : $res;
    }

    /*获取永久ticket*/
    static public function ticket($str)
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.AccessToken::getAccessToken();
        $data = array(
            'action_name'=> 'QR_LIMIT_SCENE',
            'action_info'=> array(
                'scene'=> array(
                    'scene_str'=> $str,
                )
            )
        );
        $res = Curl::httpGet($url, $data);
        return Error::isError($res) ? false : $res;
    }

    /*获取二维码*/
    public static function qrcode($ticket)
    {
        $url = 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$ticket;
        return $url;
    }

    /*长链接转短链接*/
    public static function long2short($url)
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/shorturl?access_token='.AccessToken::getAccessToken();
        $data = array(
            'action'=> 'long2short',
            'long_url'=> $url,
        );
        $res = Curl::httpGet($url, $data);
        return Error::isError($res) ? false : $res['short_url'];
    }
}