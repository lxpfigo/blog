<?php
/**
 * Created by PhpStorm.
 * User: lxpfigo
 * Date: 2015/12/1
 * Time: 15:07
 * 配置文件
 */
return array(
    'ALLOW_CLASS'=> array(
        'Index'=> array('index', 'test'),
        'Article'=> array('index', 'getComment', 'shareComment',),
        'Search'=> array('index',),
        'Tag'=> array('index', ),
        'Weibo'=> array('shareWeibo', 'index', 'WeiboCallback', ),
        'Error'=> array('index',),
        'Demo'=> array('wx','fullpage', 'carousel', 'jssdk',),
    ),
    'PAGENUM'=> 10,
    'WEIBO'=> array(
        'HOSTURL' =>'http://'.$_SERVER["HTTP_HOST"].APP.'/article/index/id/',//微博分享URL
        'APPKEY'  =>'http://service.weibo.com/share/share.php?appkey=122761318&',
        'LOCALHOST' =>'http://'.$_SERVER["HTTP_HOST"],
        //微博授权信息
        'WB_AKEY' =>'122761318',
        'WB_SKEY' =>'8d072f97eaceb493c423bb33467b752e',
        'WB_CALLBACK_URL' =>'http://'.$_SERVER["HTTP_HOST"].APP.'/Weibo/WeiboCallback',

    ),
);
