<?php
/**
 * Created by PhpStorm.
 * User: lxpfigo
 * Date: 2015/12/1
 * Time: 15:07
 * 配置文件
 */
return array(
    'APP_DEFAULT_NAME'=> 'Home',
    'DEFAULT_CLASS'=> 'Index',
    'DEFAULT_METHOD'=> 'index',
    'ALLOW_APPNAME'=> array('Home', 'Admin'),
    'DB'=> array(
        'type'=> 'mysql',
        'host'=> SAE_MYSQL_HOST_M,
        'user'=> SAE_MYSQL_USER,
        'password'=> '',
        'db'=> '',
        'chartset'=> 'utf8',
        'port'=> SAE_MYSQL_PORT,
    ),
    'SMAREY' => array(
        'debugging'=> false,
        'caching' => false,
        'template_dir'=> '/View',
        'compile_dir'=> 'saemc://smartytpl/',
        'cache_dir'=> 'saemc://smartytpl/',
        'compile_locking' => false,
    ),
    'WX'=> array(
        'appID'=> 'wx08a3586f8a13fbae',
        'appsecret'=> '10b57c5073371f02511e7eb1929412af',
        'Token'=> 'lxpfigo',
        'Template'=> array(
            'success'=> 'uegq1rM4maCpXnY6USiSAbHNaO3WWfIv_lt7LoTkIoY',
        ),
    ),
);
