<?php
namespace Framework\Wechat;
/*用户管理类*/
class UserMange
{
    /*设置分组，返回设置组id*/
    static public function setGroup($name)
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/groups/create?access_token='.AccessToken::getAccessToken();
        $data = array(
            'group'=> array(
                'name'=> $name,
            )
        );
        $res = Curl::httpGet($url, $data);
        return Error::isError($res) ? false : $res['group']['id'];
    }

    /*获取所有分组
            array(5) {
          [0]=>
          array(3) {
            ["id"]=>
            int(0)
            ["name"]=>
            string(9) "未分组"
            ["count"]=>
            int(2)
          }
          [1]=>
          array(3) {
            ["id"]=>
            int(1)
            ["name"]=>
            string(9) "黑名单"
            ["count"]=>
            int(0)
          }
          [2]=>
          array(3) {
            ["id"]=>
            int(2)
            ["name"]=>
            string(9) "星标组"
            ["count"]=>
            int(0)
          }
          [3]=>
          array(3) {
            ["id"]=>
            int(100)
            ["name"]=>
            string(7) "lxpfigo"
            ["count"]=>
            int(0)
          }
          [4]=>
          array(3) {
            ["id"]=>
            int(101)
            ["name"]=>
            string(7) "lxpfigo"
            ["count"]=>
            int(0)
          }
        }
    */
    static public function getAllGroup()
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/groups/get?access_token='.AccessToken::getAccessToken();
        $res = Curl::httpGet($url);
        return Error::isError($res) ? false : $res['groups'];
    }

    /*查询用户所在的分组*/
    static public function selectGroupByUserId($toUser)
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/groups/getid?access_token='.AccessToken::getAccessToken();
        $data = array(
            'openid'=> $toUser,
        );
        $res = Curl::httpGet($url, $data);
        return Error::isError($res) ? false : $res['groupid'];
    }

    /*修改分组*/
    static public function updateGroup($groupId, $name)
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/groups/update?access_token='.AccessToken::getAccessToken();
        $data = array(
            'group'=> array(
                'id'=> $groupId,
                'name'=> $name,
            )
        );
        $res = Curl::httpGet($url, $data);
        return Error::isError($res) ? false : true;
    }

    /*修改用户所属分组*/
    static public function updateUserGroup($toUserArr, $groupId)
    {
//        $toUserArr = array('user1', 'user2') 最多不能超过50
        if (count($toUserArr) > 50) {
            href('用户数大于50');
            exit();
        }
        $url = 'https://api.weixin.qq.com/cgi-bin/groups/members/batchupdate?access_token='.AccessToken::getAccessToken();
        $data = array(
            'openid_list'=> $toUserArr,
            'to_groupid'=> $groupId,
        );
        return Error::isError(Curl::httpGet($url, $data)) ? false : true;
    }

    /*删除分组*/
    static public function delGroup($groupId)
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/groups/delete?access_token='.AccessToken::getAccessToken();
        $data = array(
            'group'=> array(
                'id'=> $groupId,
            ),
        );
        return Error::isError(Curl::httpGet($url, $data)) ? false : true;
    }

    /*用户设置备注名*/
    static public function setNickName($toUser, $name)
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/user/info/updateremark?access_token='.AccessToken::getAccessToken();
        $data = array(
            'openid'=> $toUser,
            'remark'=> $name,
        );
        $res = Curl::httpGet($url, $data);
        return Error::isError($res) ? false : true;
    }
    /*得到用户信息*/
    static public function getUserInfo($toUserArr)
    {
/*
       $toUserArr = array('o3qQ1s2wuqTTeu9X9enV6NpBAEW4', );*/
        $user = array();
        foreach ($toUserArr as $v) {
            $user[] = array(
                'openid'=> $v,
                'lang'=> 'zh-CN',
            );
        }

        $url = 'https://api.weixin.qq.com/cgi-bin/user/info/batchget?access_token='.AccessToken::getAccessToken();
        $data = array(
            'user_list'=> $user,
        );
        $res = Curl::httpGet($url, $data);
        return Error::isError($res) ? false : $res['user_info_list'];
    }


    /*获取用户列表*/
    public static function getUserList($next_openid = NULL)
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/user/get?access_token='.AccessToken::getAccessToken().'&next_openid='.$next_openid;
        $res = Curl::httpGet($url);
        return Error::isError($res) ? false : $res;
    }

    /*获取用户地理位置*/
    public static function location($toUser)
    {

    }



}