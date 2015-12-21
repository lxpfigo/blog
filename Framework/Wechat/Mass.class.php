<?php
namespace Framework\Wechat;
/**
 * Created by PhpStorm.
 * User: lxpfigo
 * Date: 2015/12/17
 * Time: 16:21
 * 群发类(按照id分别进行群发没做)
 */
class Mass
{
    private static $url = 'https://api.weixin.qq.com/cgi-bin/message/mass/sendall?access_token=';
    /*文字信息*/
    public static function text($context)
    {
        $data = array(
            'filter'=> array(
                'is_to_all'=> true,
                'group_id'=> '',
            ),
            'text'=> array(
                'content'=> $context,
            ),
            'msgtype'=> 'text',
        );
        self::doSend($data);
    }

    /*图片消息*/
    public static function image($media_id)
    {
        $data = array(
            'filter'=> array(
                'is_to_all'=> true,
                'group_id'=> '',
            ),
            'image'=> array(
                'media_id'=> $media_id,
            ),
            'msgtype'=> 'image',
        );
        self::doSend($data);
    }

    /*图文消息
      测试号无此权限
    */
    public static function news($media_id)
    {
        $data = array(
            'filter'=> array(
                'is_to_all'=> true,
                'group_id'=> '',
            ),
            'mpnews'=> array(
                'media_id'=> $media_id,
            ),
            'msgtype'=> 'mpnews',
        );
        self::doSend($data);
    }
    /*视频消息*/
    public static function video($media_id)
    {
        $data = array(
            'filter'=> array(
                'is_to_all'=> true,
                'group_id'=> '',
            ),
            'mpvideo'=> array(
                'media_id'=> $media_id,
            ),
            'msgtype'=> 'mpvideo',
        );
        self::doSend($data);
    }
    /*卡券消息*/
    public static function wxcard($media_id)
    {
        $data = array(
            'filter'=> array(
                'is_to_all'=> true,
                'group_id'=> '',
            ),
            'wxcard'=> array(
                'media_id'=> $media_id,
            ),
            'msgtype'=> 'wxcard',
        );
        self::doSend($data);
    }


    /*删除群发，只能删除半小时之类的*/
    public static function del($msg_id)
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/message/mass/delete?access_token=';
        $data = array(
            'msg_id'=> $msg_id,
        );
        $res = Curl::httpGet($url.AccessToken::getAccessToken(), $data);
        return Error::isError($res) ? false : true;
    }


    private static function doSend($data)
    {
        $res = Curl::httpGet(self::$url.AccessToken::getAccessToken(), $data);
        return Error::isError($res) ? false : true;
    }


    /*预览*/
    public static function preview($type, $touser, $media_id, $content = NULL)
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/message/mass/preview?access_token='.AccessToken::getAccessToken();
        switch ($type) {
            case 'text' :
                $data = '{
                            "touser":"'.$touser.'",
                            "text":{
                                   "content":"'.$content.'"
                                   },
                            "msgtype":"text"
                        }';
                break;
            case 'mpnews' :
                $data = '{
                           "touser":"'.$touser.'",
                           "mpnews":{
                                    "media_id":"'.$media_id.'"
                                     },
                           "msgtype":"mpnews"
                        }';
                break;
            case 'voice' :
                $data = '{
                           "touser":"'.$touser.'",
                           "voice":{
                                    "media_id":"'.$media_id.'"
                                     },
                           "msgtype":"voice"
                        }';
                break;
            case 'image' :
                $data = '{
                           "touser":"'.$touser.'",
                           "image":{
                                    "media_id":"'.$media_id.'"
                                     },
                           "msgtype":"image"
                        }';
                break;
            case 'mpvideo' :
                $data = '{
                           "touser":"'.$touser.'",
                           "mpvideo":{
                                    "media_id":"'.$media_id.'"
                                     },
                           "msgtype":"mpvideo"
                        }';
                break;
            case 'wxcard' :
                $data = '{ "touser":"'.$touser.'",
                          "wxcard":{
                                   "card_id":"'.$media_id.'",
                                    "card_ext": "{"code":"","openid":"","timestamp":"1402057159","signature":"017bb17407c8e0058a66d72dcc61632b70f511ad"}"
                                    },
                          "msgtype":"wxcard"
                        }';
                break;
            default :
                href('迷茫了');
                exit();
        }
        $res = Curl::httpGet($url, $data);
        return Error::isError($res) ? false : $res['msg_id'];
    }
}