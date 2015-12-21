<?php
namespace Framework\Wechat;
/**
 * Created by PhpStorm.
 * User: lxpfigo
 * Date: 2015/12/17
 * Time: 15:32
 * 素材上传下载类
 */
class Material
{
    /*新增永久图文素材media_id*/
    static public function addNews($article)
    {
        /*传入实例
        $article[] = array(
            'title'=> '这个我的测试消息',
            'thumb_media_id'=> media_id,
            'author'=> '天王盖地虎',
            'digest'=> '',
            'show_cover_pic'=> 1,
            'content'=> '这是一个图文摘要',
            'content_source_url'=> 'our-class.cn',
        );
        */

        if (count($article) > 10) {
            href('文章总数大于10');
            return false;
        }
        $data = array(
            'articles'=> $article,
        );
        $url = 'https://api.weixin.qq.com/cgi-bin/material/add_news?access_token=';
        $res = Curl::httpGet($url.AccessToken::getAccessToken(), $data);
        return Error::isError($res) ? false : $res['media_id'];
    }

    /*新增永久素材，图片，语音，缩微图*/
    public static function addMedia($file, $type = 'image', $info = array())
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/material/add_material?access_token='.AccessToken::getAccessToken();
        if (!file_exists($file)) {
            href('文件不存在');
            exit();
        }
        $data = array(
            'filename'=> $file,
        );
        if ($type == 'video') {
            $description = array(
                'title'=> $info['title'],
                'introduction' => $info['introduction'],
            );
            $data= array("media"=>"@".$file,'form-data'=> $data, 'type'=> $type, 'description'=> $description);
        }else {
            $data= array("media"=>"@".$file,'form-data'=> $data, 'type'=> $type);
        }
        $res = Curl::httpGet($url, $data);
        return Error::isError($res) ? false : $res;
    }
}