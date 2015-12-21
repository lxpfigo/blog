<?php
namespace Framework\Wechat;
/**
 * Created by PhpStorm.
 * User: lxpfigo
 * Date: 2015/12/21
 * Time: 13:13
 * 客服接口
 */
class CustomerServices
{
    /*添加、修改、删除客服*/
    static public function customer($kf_account, $nickname, $password, $type = 'add')
    {
        switch ($type) {
            case 'add' :
                $url = 'https://api.weixin.qq.com/customservice/kfaccount/add?access_token='.AccessToken::getAccessToken();
                break;
            case 'del' :
                $url = 'https://api.weixin.qq.com/customservice/kfaccount/del?access_token='.AccessToken::getAccessToken();
                break;
            case 'update' :
                $url = 'https://api.weixin.qq.com/customservice/kfaccount/update?access_token='.AccessToken::getAccessToken();
                break;
        }
        $data = array(
            'kf_account'=> $kf_account,
            'nickname'=> $nickname,
            'password'=> $password,
        );
        $res = Curl::httpGet($url, $data);
        return Error::isError($res) ? false : $res;
    }

    /*获取所有客服*/
    static public function getAllCustomer()
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/customservice/getkflist?access_token='.AccessToken::getAccessToken();
        $res = Curl::httpGet($url);
        return Error::isError($res) ? false : $res;
    }

    /*设置头像，图片大小推荐为640*640*/
    static public function setImage($file, $kf_account)
    {
        if (!file_exists($file)) {
            href('文件不存在');
            return false;
        }
        $url = 'http://api.weixin.qq.com/customservice/kfaccount/uploadheadimg?access_token='.AccessToken::getAccessToken().'&kf_account='.$kf_account;
        $data = array(
            'filename'=> $file,
        );
        $data= array("media"=>"@".$file,'form-data'=> $data);
        $res = Curl::httpGet($url, $data);
        return Error::isError($res) ? false : $res;
    }
}