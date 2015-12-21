<?php
namespace Framework;
/**
 * Created by PhpStorm.
 * User: lxpfigo
 * Date: 2015/12/1
 * Time: 15:29
 * 自动载入
 */
class Autoload
{
    public function register()
    {
        spl_autoload_register(array($this, 'autoload'));
    }
    public function autoload($class)
    {
        //如果class中包含smarty，则终止系统内置自动加载，而调用smarty自己的自动加载类
        //所以自己的目录和类中不要包含smarty，不区分大小写
        if (preg_match('/smarty/i', $class)) {
            return;
        }
        $pathArr = explode('\\', $class);
        $filename = array_pop($pathArr);
        $dir = implode('/', $pathArr);
        $filename = $dir.'/'.$filename.'.class.php';
        try {
            if (file_exists($filename)) {
                require_once $filename;
            }else {
                throw new \Exception('Error:类'.$class.'加载失败');
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

    }
}