<?php
namespace Framework\Wechat;
/**
 * Created by PhpStorm.
 * User: lxpfigo
 * Date: 2015/12/16
 * Time: 16:40
 * 自定义菜单
 */
class Menu
{
    public static function delMenu()
    {
        $accessToken = AccessToken::getAccessToken();
        $url = 'https://api.weixin.qq.com/cgi-bin/menu/delete?access_token='.$accessToken;
        $res = Curl::httpGet($url);
        if ($res['errcode'] === 0) {
            href('删除菜单成功');
        }else {
            href('删除菜单失败');
        }
    }

    public static function addMenu($data)
    {
        /*
                  $data = array(
                    'button'=> array(
                        array(
                            'type'=> 'click',
                            'name'=> '测试一',
                            'key'=> 'test1',
                        ),
                        array(
                            'name'=> '测试二',
                            'sub_button'=> array(
                                array(
                                    'type'=> 'scancode_push',
                                    'name'=> '扫码推事件',
                                    'key'=> 'text2',
                                ),
                                array(
                                    'type'=> 'scancode_push',
                                    'name'=> '扫码推事件',
                                    'key'=> 'text2',
                                ),
                            ),
                        ),
                        array(
                            'type'=> 'click',
                            'name'=> '测试三',
                            'key'=> 'test1',
                        ),
                    ),
                );
         */
        if (count($data['button']) > 3 || count($data['button']) < 1) {
            href('主菜单不符合规定');
            exit();
        }


        foreach ($data['button'] as $key=> $v) {
            if (isset($data['button'][$key]['sub_button'])) {
                if (count($data['button'][$key]['sub_button']) > 3) {
                    href('第'.$key + 1 .'个主菜单不符合规定');
                    exit();
                }
            }
        }

        $accessToken = AccessToken::getAccessToken();
        $url = ' https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$accessToken;
        $res = Curl::httpGet($url, $data);
        if ($res['errcode'] === 0) {
            href('添加菜单成功');
        }else {
            href('错误代码：'.$res['errcode'].'点击http://mp.weixin.qq.com/wiki/10/6380dc743053a91c544ffd2b7c959166.html 查看错误信息');
        }
    }

    public static function selectMenu()
    {
        $accessToken = AccessToken::getAccessToken();
        $url = 'https://api.weixin.qq.com/cgi-bin/menu/get?access_token='.$accessToken;
        $res = Curl::httpGet($url);
        return json_encode($res, true);
    }

    /*获取自定义菜单的配置项*/
    public static function getConfig()
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/get_current_selfmenu_info?access_token='.AccessToken::getAccessToken();
        $res = Curl::httpGet($url);
        return Error::isError($res) ? false : $res;
    }





    public static function doMenu()
    {

    }
}