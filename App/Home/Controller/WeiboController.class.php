<?php
namespace App\Home\Controller;
use App\Home\Model\ArticleModel;
use App\Home\Model\CommentuserModel;
use App\Home\Model\WeiboClientModel;
use App\Home\Model\WeiboModel;

/**
 * Created by PhpStorm.
 * User: lxpfigo
 * Date: 2015/11/11
 * Time: 12:55
 * 微博操作类
 */
class WeiboController
{
    private $_WBconfig; //微博配置参数
    public function __construct()
    {
        $this->_WBconfig = getConfig('WEIBO');
    }

    //微博分享
    public function shareWeibo()
    {
        $weiboConfig = $this->_WBconfig;
        $id = (int) doSafe($_POST['id']);
        $article = new ArticleModel();
        $res = $article->getArticleById($id);
        $url = array();
        $url['url'] = $weiboConfig['HOSTURL'].$id;
        $url['content'] = 'utf-8';
        $url['pic'] = $weiboConfig['LOCALHOST'].rtrim($res['title_img'], '.');
        $url['title'] = $res['description'];
        $url['searchPic'] = 'false';
        $ajaxReturn = $weiboConfig['APPKEY'].http_build_query($url);
        echo json_encode(array($ajaxReturn));
    }


    public function index()
    {
        $url = $_GET['url'];
        $_SESSION['url'] = $url;
        //微博登陆
        $_config = $this->_WBconfig;
        $weibo = new WeiboModel($_config['WB_AKEY'], $_config['WB_SKEY']);
        $code_url = $weibo->getAuthorizeURL( $_config['WB_CALLBACK_URL'] );
        if($code_url){
            header("location:".$code_url);
        }else {
            echo '登录失败';
        }

    }
    //回调函数
    public function WeiboCallback()
    {
        session_start();
        $_config = $this->_WBconfig;
        $weibo = new WeiboModel($_config['WB_AKEY'], $_config['WB_SKEY']);
        if (isset($_GET['code'])) {
            $keys = array();
            $keys['code'] = $_GET['code'];
            $keys['redirect_uri'] = $_config['WB_CALLBACK_URL'];
            $token = $weibo->getAccessToken( 'code', $keys ) ;
        }
        if ($token) {
            $accessToken = $token['access_token'];
            $list = new WeiboClientModel($_config['WB_AKEY'], $_config['WB_SKEY'], $accessToken);
            $uid_get = $list->get_uid();
            $uid = $uid_get['uid'];
            $user_message = $list->show_user_by_id($uid);//根据ID获取用户等基本信息

            $res = array();
            $res['nickname'] = $user_message['name'];
            $res['img'] = $user_message['avatar_large'];
            $res['location'] = $user_message['location'];
            $res['IP'] = get_client_ip();
            $res['weibo_id'] =  (int) $user_message['id'];
            $_SESSION['weibo'] = $res;
            //将用户信息存入数据库
            $obj = new CommentuserModel();
            //查找该用户是否绑定过
            $one = $obj->findUserByWeiboId($res['weibo_id']);
            if ($one) {
                //如果已经登陆,判断用户信息是否有变更，如果有就更新数据库
                if ($one['img'] != $res['img'] || $one['nickname'] != $res['nickname'] || $one['location'] != $res['location']) {
                    $obj->updateUserByWeiboId($user_message['id'], $res);
                }
            }else {
                //没有绑定过进行绑定
                $res['join_time'] = time();
                $obj->addUser($res);
            }
            //如果传入的url为空，值跳转到前两页
            if (empty($_SESSION['url'])) {
                echo '<script>window.history.go(-2);</script>';
            } else {
                header("location:".$_SESSION['url']);
            }

//            echo '<script>window.opener.location.href = window.opener.location.href;window.close();</script>';

        }else {
            echo '登录失败,请重试';
        }
    }
}