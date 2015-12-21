<?php
namespace Framework\Wechat;
/**
 * Created by PhpStorm.
 * User: lxpfigo
 * Date: 2015/12/16
 * Time: 12:47
 * 微信被动回复
 */
class RequestPassive
{
    /*文本*/
    public static function text($tousername, $fromusername, $context, $flag = 0)
    {
        $template = "<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[text]]></MsgType>
                        <Content><![CDATA[%s]]></Content>
                        <FuncFlag>%s</FuncFlag>
                    </xml>";
        echo sprintf($template, $fromusername, $tousername, time(), $context, $flag);
        exit();
    }
    /*图片*/
    public static function image($tousername, $fromusername, $mediaid, $flag = 0)
    {
        $template = "<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[image]]></MsgType>
                        <Image>
                        <MediaId><![CDATA[%s]]></MediaId>
                        </Image>
                        <FuncFlag>%s</FuncFlag>
                       </xml>";
        echo sprintf($template, $fromusername, $tousername, time(), $mediaid, $flag);
        exit();
    }
    /*语音消息*/
    public static function voice($tousername, $fromusername, $mediaid, $flag = 0)
    {
        $template = "<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[voice]]></MsgType>
                        <Voice>
                        <MediaId><![CDATA[%s]]></MediaId>
                        </Voice>
                        <FuncFlag>%s</FuncFlag>
                      </xml>";
        echo sprintf($template, $fromusername, $tousername, time(), $mediaid, $flag);
        exit();
    }

    /*视频*/
    public static function video($tousername, $fromusername, $mediaid, $title, $description, $flag = 0)
    {
        $template = "<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[video]]></MsgType>
                        <Video>
                        <MediaId><![CDATA[%s]]></MediaId>
                        <Title><![CDATA[%s]]></Title>
                        <Description><![CDATA[%s]]></Description>
                        </Video>
                        <FuncFlag>%s</FuncFlag>
                     </xml>";
        echo sprintf($template, $fromusername, $tousername, time(), $mediaid,$title, $description, $flag);

    }

    /*音乐
     $url:音乐路径
     $hdUrl:高品质音乐路径
    */
    public static function music($tousername, $fromusername, $mediaid, $url, $hdUrl, $title, $description, $flag = 0)
    {
        $template = "<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[music]]></MsgType>
                        <Music>
                        <Title><![CDATA[%s]]></Title>
                        <Description><![CDATA[%s]]></Description>
                        <MusicUrl><![CDATA[%s]]></MusicUrl>
                        <HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
                        <ThumbMediaId><![CDATA[%s]]></ThumbMediaId>
                        </Music>
                        <FuncFlag>%s</FuncFlag>
                      </xml>";
        echo sprintf($template, $fromusername, $tousername, time(), $title, $description, $url, $hdUrl, $mediaid, $flag);
    }

    /*回复图文消息
      组装图文消息，需要先调用该方法
    */
    public static function itemList($title, $description, $picUrl, $url)
    {
        $template = "<item>
                        <Title><![CDATA[%s]]></Title>
                        <Description><![CDATA[%s]]></Description>
                        <PicUrl><![CDATA[%s]]></PicUrl>
                        <Url><![CDATA[%s]]></Url>
                     </item>";
        return sprintf($template, $title, $description, $picUrl, $url);
    }

    public static function newList($tousername, $fromusername, $arr, $flag = 0)
    {
        if (count($arr) > 10) {
            die('数组超过最大限制');
        }
        $template = "<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[news]]></MsgType>
                        <ArticleCount>%s</ArticleCount>
                        <Articles>
                        %s
                        </Articles>
                        <FuncFlag>%s</FuncFlag>
                     </xml> ";
        $articleList = array();
        foreach ($arr as $key=> $v) {
            $articleList[] = self::itemList($arr[$key]['title'], $arr[$key]['description'], $arr[$key]['picUrl'], $arr[$key]['url']);
        }
        echo sprintf($template, $fromusername, $tousername, time(), count($arr), implode($articleList), $flag);
    }



}