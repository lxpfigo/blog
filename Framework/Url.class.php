<?php
namespace Framework;
/**
 * Created by PhpStorm.
 * User: lxpfigo
 * Date: 2015/12/1
 * Time: 15:56
 * url路由类
 */
class Url
{
    static public function getUrl()
    {
        /*
         * index.php/appname/controller/method,通过配置.htaccess隐藏index.php
         * array(
         *  0=>'',
         * 1=> appname,
         * 2=> controller,
         * 3=> method
         * )
        */
        $getData = array();//通过url获得的get数组
        $allowApp = getConfig('ALLOW_APPNAME');
        $pathInfo = !empty($_SERVER['PATH_INFO']) ? explode('/', $_SERVER['PATH_INFO']) : array();
        //如果appName为空，读取配置文件中的appname
        $appName = !empty($pathInfo[1]) ? $pathInfo[1] : getConfig('APP_DEFAULT_NAME');
        //如果$appName不在$allowApp里面则$appName为默认Home下的控制器
        if (!in_array($appName, $allowApp)) {
            $appName = getConfig('APP_DEFAULT_NAME');
            $className = !empty($pathInfo[1]) ? ucfirst(strtolower($pathInfo[1])) : getConfig('DEFAULT_CLASS');
            $method = !empty($pathInfo[2]) ? $pathInfo[2] : getConfig('DEFAULT_METHOD');
            foreach ($pathInfo as $key=> $v) {
                if ($key > 2) {
                    $getData[] = $v;
                }
            }
        }else {
            $className = !empty($pathInfo[2]) ? ucfirst(strtolower($pathInfo[2])) : getConfig('DEFAULT_CLASS');
            $method = !empty($pathInfo[3]) ? $pathInfo[3] : getConfig('DEFAULT_METHOD');
            foreach ($pathInfo as $key=> $v) {
                if ($key > 3) {
                    $getData[] = $v;
                }
            }
        }
        $getData = array_chunk($getData, 2);
        foreach ($getData as $v) {
            if (isset($v[1])) {
                $_GET[$v[0]] = $v[1];
            }
        }
        $c = 'App\\'.$appName.'\Controller\\'.$className.'Controller';
        //判断在appName中是否存在类文件，如果不存在跳到错误模板
        //判断当前class下是否存在method方法
        $allowClass = getConfig('ALLOW_CLASS');
        if (!file_exists(str_replace('\\', '/', $c).'.class.php') || @!in_array($method, $allowClass[$className]))
        {
            $className = "Error";
            $method = "index";
            $c = 'App\\'.$appName.'\Controller\\'.$className.'Controller';
        }
        //实例化类，执行方法
        $obj = new $c();
        $obj->$method();
    }

}