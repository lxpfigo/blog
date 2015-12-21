<?php
namespace Framework\Wechat;
/**
 * Created by PhpStorm.
 * User: lxpfigo
 * Date: 2015/12/17
 * Time: 14:11
 * 图片上传类
 */
class Media
{
    /*获取media_id或url*/
    static public function uploadMedia($file, $type = NULL)
    {
        if (!file_exists($file)) {
            href('文件不存在');
            exit();
        }
        $data = array(
            'filename'=> $file,
//            'content-type'=> $imgInfo['mime'],
        );
        $data= array("media"=>"@".$file,'form-data'=> $data);
        if (empty($type)) {
            $url = 'https://api.weixin.qq.com/cgi-bin/media/uploadimg?access_token=';
            $res = Curl::httpGet($url.AccessToken::getAccessToken(), $data);
            $res = $res['url'];
        }else {
            $url = 'https://api.weixin.qq.com/cgi-bin/media/upload?access_token=';
            $res = Curl::httpGet($url.AccessToken::getAccessToken().'&type='.$type, $data);
            $res = $res['media_id'];
        }
        return Error::isError($res) ? false : $res;
    }

    /*上传图文消息*/
    public static function uploadNews($articles)
    {
        /* 传入data实例
        $articles[] = array(
            'thumb_media_id'=> $media_id,
            'author'=> '天王盖地虎',
            'title'=> '这个我的测试消息',
            'content_source_url'=> 'our-class.cn',
            'content'=> '这是一个图文摘要',
            'digest'=> '',
            'show_cover_pic'=> 1,
        );
        $articles[] = array(
            'thumb_media_id'=> $media_id,
            'author'=> '天王盖地虎',
            'title'=> '这个我的测试消息',
            'content_source_url'=> 'our-class.cn',
            'content'=> '这是一个图文摘要',
            'digest'=> '',
            'show_cover_pic'=> 1,
        );
        */
        $url = 'https://api.weixin.qq.com/cgi-bin/media/uploadnews?access_token='.AccessToken::getAccessToken();
        if (count($articles) > 10) {
            href('文章总数大于10');
            return false;
        }
        $data = array(
            'articles'=> $articles,
        );
        $res = Curl::httpGet($url, $data);
        return Error::isError($res) ? false : $res['media_id'];
    }
}