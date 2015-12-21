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
        'Index'=> array('index', 'logout'),
        'Login'=> array('index', 'code', 'doLogin', ),
        'Article'=> array('index', 'top', 'del', 'add', 'doAdd', ),
        'Upload'=> array('index',),
        'Tag'=> array('index', 'nav', 'edit', 'doEdit', ),
        'Comment'=> array('index', 'del', 'edit', 'doEdit', ),
        'User'=> array('index', 'isTrue', 'edit', 'doEdit', 'changeImg', 'doChangePsw', 'userComment', 'del', 'chagePsw', ),
        'Link'=> array('index', 'isTrue', 'del', 'add', 'doAdd', ),
        'Wechat'=> array('index', 'mange',),
        'Test'=> array('index', ),
    ),
    'PAGENUM'=> 10,
);
