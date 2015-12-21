<?php
namespace Framework\Wechat;
/*
    微信模板消息类
*/
class Template
{
    /*发送模板消息*/
    static public function send($touser, $templateId = NULL)
    {
        $templateIds = getConfig('WX');
        $templateId = $templateIds['Template']['success'];

        $url = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.AccessToken::getAccessToken();
        $template = array(
            'touser'=> $touser,
            'template_id'=> $templateId,
            'url'=> 'our-class.cn',
            'topcolor'=> '#CC0033',
            'data'=> array(
                'first'=> array(
                    'value'=> '关于来到our-class',
                    'color'=> '#66CC66',
                ),
                'product'=> array(
                    'value'=> '这是我的个人博客',
                    'color'=> '#CCCC66',
                )
            ),
        );
        $res = Curl::httpGet($url, $template);
        return Error::isError($res) ? false : true;
    }

    static public function setIndustry($industry_id1, $industry_id2)
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/template/api_set_industry?access_token='.AccessToken::getAccessToken();
        $data = array(
            'industry_id1'=> $industry_id1,
            'industry_id2'=> $industry_id2,
        );
        $res = Curl::httpGet($url, $data);
        return Error::isError($res) ? false : true;
    }

    /*获取模板id*/
    static public function getTemplateId($template_id_short)
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/template/api_add_template?access_token='.AccessToken::getAccessToken();
        $data = array(
            'template_id_short'=> $template_id_short,
        );
        $res = Curl::httpGet($url, $data);
        return Error::isError($res) ? false : $res['template_id'];
    }

}