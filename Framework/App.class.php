<?php
namespace Framework;
/**
 * Created by PhpStorm.
 * User: lxpfigo
 * Date: 2015/12/1
 * Time: 15:09
 * 框架入口文件
 */
class App
{
    static public function init()
    {
        //定义网站的根目录
        self::rootPath();

        //设置字符集、时区。开启session
        self::setHeader();

        //加载配置、通用函数
        self::loadConfigAndFunctions();

        //自动载入
        self::autoload();

        //解析URL
        self::getUrl();
    }

    static private function rootPath()
    {
        //APP网站的根目录 任何使用该常量后面必须接"/",前面一定不能带"/"
        $root = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
        //如果直接是网站的跟目录，去掉“/”
        $root = $root == '/' ? '' : $root;
        define('APP', $root);
    }

    static private function getUrl()
    {
        require_once dirname(__FILE__).'/./Url.class.php';
        Url::getUrl();
    }

    static private function autoload()
    {
        require_once dirname(__FILE__).'/./Autoload.class.php';
        $obj = new Autoload();
        $obj->register();
    }

    static private function loadConfigAndFunctions()
    {
        //载入通用方法
        require_once dirname(__FILE__).'/../Common/functions.php';
        //获取通用配置参数，存入全局变量中
        $GLOBALS['config'] = require_once dirname(__FILE__).'/../Common/config.php';
        //获取pathinfo信息如果不存在设为空数组
        $pathInfo = !empty($_SERVER['PATH_INFO']) ? explode('/', $_SERVER['PATH_INFO']) : array();
        //获取appName，如果不存在则取配置文件中的默认
        $appName = !empty($pathInfo[1]) ? $pathInfo[1] : getConfig('APP_DEFAULT_NAME');
        //判断获取到的appName是否在允许范围，不在则设为默认
        $appName = !in_array($appName, getConfig("ALLOW_APPNAME")) ? getConfig('APP_DEFAULT_NAME') : $appName;
        //加载Appname下的配置文件，并与通用配置合并
        $GLOBALS['appConfig'] = require_once dirname(__FILE__).'/../App/'.$appName.'/Common/config.php';
        $GLOBALS['config'] = array_merge($GLOBALS['config'], $GLOBALS['appConfig']);
        //载入appName下的自己通用方法
        require_once dirname(__FILE__).'/../App/'.$appName.'/Common/functions.php';
    }

    static private function setHeader()
    {
        date_default_timezone_set("Asia/Chongqing");
        header('Content-type: text/html; charset=UTF-8');
        session_start();
    }
}