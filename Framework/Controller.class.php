<?php
namespace Framework;
/**
 * Created by PhpStorm.
 * User: lxpfigo
 * Date: 2015/12/2
 * Time: 9:33
 * 控制器基类
 */
class Controller
{
    protected $smarty;
    protected $mmc;
    public function __construct()
    {
        //初始化smatry
        $this->smartyInit();

        //初始化Memcache
        $this->memchaeInit();
     }

    //初始化Memcache
    private function memchaeInit()
    {
        $this->mmc = memcache_init();
    }

    //获取memcheae值
    protected function get($key)
    {
        return $this->mmc->get($key);
    }

    //设置memchea值
    protected function set($arr, $time)
    {
        foreach ($arr as $key=> $v) {
            $this->mmc->set($key, $v, 0, $time);
        }
    }

    //初始化smarty
    private function smartyInit()
    {
        //初始化smarty
        $smartCofig = getConfig("SMAREY");
        require_once dirname(__FILE__)."/../Framework/Smarty/libs/Smarty.class.php";
        $this->smarty = new \Smarty();
        $pathInfo = !empty($_SERVER['PATH_INFO']) ? explode('/', $_SERVER['PATH_INFO']) : array();
        $appName = !empty($pathInfo[1]) ? $pathInfo[1] : getConfig('APP_DEFAULT_NAME');
        $appName = !in_array($appName, getConfig('ALLOW_APPNAME')) ? getConfig('APP_DEFAULT_NAME') : $appName;
        foreach ($smartCofig as $key=> $val) {
            //加载smarty配置项
            //如果配置文件中含有“View”则默认在前面添加appName
            if (preg_match('/View/', $val)) {
                $this->smarty->$key = 'App/'.$appName.$val;
            }else {
                $this->smarty->$key = $val;
            }
        }
    }


    //以数组的方式向模板赋值
    protected function assign($dataArr)
    {
        foreach ($dataArr as $key=> $v) {
            $this->smarty->assign($key, $v);
        }
    }
    //渲染模板
    protected function display($template)
    {
        $this->smarty->display($template);
    }

    //以对象的方式向模板赋值
    public function __set($name, $value)
    {
        $this->smarty->assign($name, $value);
    }
}