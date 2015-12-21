<?php
namespace Framework\Wechat;
/**
 * Created by PhpStorm.
 * User: lxpfigo
 * Date: 2015/12/16
 * Time: 10:01
 * 微信回复类
 */
class WechatRequest
{
    public static function switchType(&$request)
    {
        switch ($request['msgtype']) {
            case 'text' :
//                self::text($request);
                break;
            case 'image' :
                self::image($request);
                break;
            case 'voice' :
                self::voice($request);
                break;
            case 'shortvideo' :
                self::shortvideo($request);
                break;
            case 'location':
                self::location($request);
                break;
            case 'link':
                self::link($request);
                break;
            case 'event' :
                $request['event'] = strtolower($request['event']);
                switch ($request['event']) {
                    case 'click' :
                        self::eventClick($request);
                        break;
                    case 'view' :
                        self::view($request);
                        break;
                    case 'unsubscribe' :
                        //取消关注
                        self::unsubscribe($request);
                        break;
                    case 'subscribe' :
                        //关注
                        self::subscribe($request);
                        break;
                    default :
                        RequestPassive::text($request['tousername'], $request['fromusername'], '来自未知星球的消息，我真不知道该如何办了。help');
                        break;
                }
                break;
            default :
                RequestPassive::text($request['tousername'], $request['fromusername'], '来自未知星球的消息，我真不知道该如何办了。help');
                break;
        }
    }


    static private function text(&$request)
    {
        $context = '收到文本消息';
        RequestPassive::text($request['tousername'], $request['fromusername'], $context);
    }

    static private function image(&$request)
    {
        $mediaid = $request['mediaid'];
        RequestPassive::image($request['tousername'], $request['fromusername'], $mediaid);
    }
    static private function voice(&$request)
    {
        if ($request['recognition'] === NULL) {
            $context = '收到语音消息';
            RequestPassive::text($request['tousername'], $request['fromusername'], $context);
        }else {
            $context = '语音识别为：';
            RequestPassive::text($request['tousername'], $request['fromusername'], $context.$request['recognition']);
        }
    }

    static private function shortvideo(&$request)
    {
        $context = '收到小视屏';
        RequestPassive::text($request['tousername'], $request['fromusername'], $context);
    }

    /*位置*/
    static private function location(&$request)
    {
        $context = "你上传了一个位置，标签为：\n".$request['label'];
        RequestPassive::text($request['tousername'], $request['fromusername'], $context);
    }

    /*链接*/
    static private function link(&$request)
    {
        $context = "收到链接";
        RequestPassive::text($request['tousername'], $request['fromusername'], $context);
    }

    /*点击事件*/
    static private function eventClick(&$request)
    {
        $context = "收到点击事件，eventkey为：\n".$request['eventkey'];
        RequestPassive::text($request['tousername'], $request['fromusername'], $context);
    }

    /*网页调转事件*/
    static private function view(&$request)
    {
        $context = "收到调转事件，eventkey为：\n".$request['eventkey'];
        RequestPassive::text($request['tousername'], $request['fromusername'], $context);
    }

    /*取消关注*/
    static private function unsubscribe(&$request)
    {
        $context = "真的不再给我一次机会吗？";
        RequestPassive::text($request['tousername'], $request['fromusername'], $context);
    }
    /*关注*/
    static private function subscribe(&$request)
    {
        $context = "很高兴您的到来";
        RequestPassive::text($request['tousername'], $request['fromusername'], $context);
    }
}