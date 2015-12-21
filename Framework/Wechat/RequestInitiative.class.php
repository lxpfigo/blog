<?php
namespace Framework\Wechat;
/**
 * Created by PhpStorm.
 * User: lxpfigo
 * Date: 2015/12/17
 * Time: 12:29
 * 客服接口，主动发送消息
 */
class RequestInitiative
{
    static private $url;
    static private function init()
    {
        $accessToken = AccessToken::getAccessToken();
        self::$url = 'https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token='.$accessToken;
    }
    /*主动发送文本*/
    static public function text($toUser, $context)
    {
        $data = array(
            'touser'=> $toUser,
            'msgtype'=> 'text',
            'text'=> array(
                'content'=> $context
            ),
        );
        self::doCurl($data);
    }
    /*主动发送图片*/
    static public function image($toUser, $media_id)
    {
        $data = array(
            'touser'=> $toUser,
            'msgtype'=> 'image',
            'image'=> array(
                'media_id'=> $media_id
            ),
        );
        self::doCurl($data);
    }

    /*主动发送语音*/

    public static function voice($toUser, $media_id)
    {
        $data = array(
            'touser'=> $toUser,
            'msgtype'=> 'voice',
            'voice'=> array(
                'media_id'=> $media_id
            ),
        );
        self::doCurl($data);
    }

    /*主动发送视频*/
    public static function video($toUser, $media_id, $title, $description)
    {
        $data = array(
            'touser'=> $toUser,
            'msgtype'=> 'video',
            'video'=> array(
                'media_id'=> $media_id,
                'thumb_media_id'=> $media_id,
                'title'=> $title,
                'description'=> $description,
            ),
        );
        self::doCurl($data);
    }

    /*主动发送音乐*/
    public static function music($toUser, $title, $description, $musicurl, $hqmusicurl, $thumb_media_id)
    {
        $data = array(
            'touser'=> $toUser,
            'msgtype'=> 'music',
            'music'=> array(
                'title'=> $title,
                'description'=> $description,
                'musicurl'=> $musicurl,
                'hqmusicurl'=> $hqmusicurl,
                'thumb_media_id'=> $thumb_media_id,
            ),
        );
        self::doCurl($data);
    }

    /*发送图文消息*/
    public static function news($toUser, $newList)
    {
        /*
        $newList = array(
            array(
                'title'=> '"Happy Day',
                'description'=> 'Is Really A Happy Day',
                'url'=> 'URL',
                'picurl'=> 'PIC_URL',
            ),
            array(
                'title'=> 'Happy Day',
                'description'=> 'Is Really A Happy Day',
                'url'=> 'URL',
                'picurl'=> 'PIC_URL',
            ),
        );
        */
        if (count($newList) > 10) {
            href('图文数量超过10条');
            exit();
        }
        $data = array(
            'touser'=> $toUser,
            'msgtype'=> 'news',
            'news'=> array(
                'articles'=> $newList,
            ),
        );
        self::doCurl($data);
    }
    private static function doCurl($data)
    {
        self::init();
        $res = Curl::httpGet(self::$url, $data);
        return Error::isError($res) ? false : true;
    }
}