<?php
namespace Framework\Wechat;
//统计接口
class Statistics
{
    static function getuser($begin_date, $end_date, $summary = true)
    {
        if ($summary) {
            $url = 'https://api.weixin.qq.com/datacube/getusersummary?access_token='.AccessToken::getAccessToken();
        }else {
            $url = 'https://api.weixin.qq.com/datacube/getusercumulate?access_token='.AccessToken::getAccessToken();
        }
        $data = array(
            'begin_date'=> $begin_date,
            'end_date'=> $end_date,
        );
        $res = Curl::httpGet($url, $data);
        return Error::isError($res) ? false : $res;
    }
}