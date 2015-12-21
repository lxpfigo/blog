<?php
namespace App\Admin\Controller;
use App\Admin\Common\Controller\AdminController;
use Framework\Wechat;
/**
 * Created by PhpStorm.
 * User: lxpfigo
 * Date: 2015/12/16
 * Time: 9:19
 */
class WechatController extends AdminController
{
    public function index()
    {
//        $wechat = new Wechat();
//        $wechat->run();

        /*o3qQ1s2wuqTTeu9X9enV6NpBAEW4*/
//        Wechat\CustomerServices::text('o3qQ1s2wuqTTeu9X9enV6NpBAEW4', '您好，欢迎光临');
       // Wechat\CustomerServices::image('o3qQ1s2wuqTTeu9X9enV6NpBAEW4', 'ltyJ6pIeRLUke_5ahAE5O7qnj6wgZy005oAZIgFr7RC_-MsV0FdRObLnVsU8gwQE');
//        $media_id = Wechat\Media::uploadImg($_SERVER[DOCUMENT_ROOT].'/Public/UserIcon/0.png', 'image');
//        $res = Wechat\Media::uploadNews($media_id);
//         Wechat\Media::uploadNews('111');
//
//       $res = Wechat\Material::addMedia($_SERVER[DOCUMENT_ROOT].'/Public/UserIcon/0.png');
//        dump($res);
//
//       $res =  Wechat\Template::send('o3qQ1s2wuqTTeu9X9enV6NpBAEW4');
//        $res = Wechat\UserMange::setGroup('lxpfigo');
//        $res = Wechat\UserMange::updateGroup('101', '你被修改了');
//        $res = Wechat\UserMange::getAllGroup();
//        $res = Wechat\UserMange::updateUserGroup(array('o3qQ1s2wuqTTeu9X9enV6NpBAEW4'), '100');
//        $res = Wechat\UserMange::selectGroupByUserId('o3qQ1s2wuqTTeu9X9enV6NpBAEW4');
//        $res = Wechat\UserMange::setNickName('o3qQ1s_WHJ5ZcKs-Qulz693tSFqg', '这是我老婆');
//        $res = Wechat\UserMange::getUserInfo('o3qQ1s2wuqTTeu9X9enV6NpBAEW4');
//        $res = Wechat\UserMange::getUserInfo(array('o3qQ1s2wuqTTeu9X9enV6NpBAEW4', 'o3qQ1s_WHJ5ZcKs-Qulz693tSFqg'));
//        $res = Wechat\UserMange::getUserList();
//        $res = Wechat\Menu::getConfig();
//        $res = Wechat\Popularize::ticket('123');
//        $res = Wechat\Popularize::qrcode($res['ticket']);
//        $res = Wechat\Popularize::long2short($res);
//        $res = Wechat\Statistics::getuser('2015-12-18', '2015-12-18');
//        dump($res);
//        $res = Wechat\JSSDK::getSignPackage();
//        $res = Wechat\CustomerServices::updateCustomer('lxpfigo@gmail.com', 'figo', '123456');
        $res = Wechat\CustomerServices::addCustomer();
        dump($res);

    }
    public function mange()
    {
        $this->display('Wechat/mange.tpl');
    }
}