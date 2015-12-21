<?php
namespace App\Admin\Controller;
use App\Admin\Common\Controller\AdminController;

/**
 * Created by PhpStorm.
 * User: lxpfigo
 * Date: 2015/12/16
 * Time: 10:14
 */
class TestController extends AdminController
{
    public function index()
    {
//        echo 'file:'.__FILE__.'<br />';
//        echo 'dir:'.__DIR__.'<br />';
//        echo 'class:'.__CLASS__.'<br />';
//        echo 'line:'.__LINE__.'<br />';
//        echo 'method:'.__METHOD__;
//        dump($_SERVER);
//        dump($this->get('request'));
        try {
            dump(self::inverse(0));
            dump(self::inverse(5));
            dump(self::inverse(0));
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    private static function inverse($i)
    {
        if (!$i) {
            throw new \Exception('除数不能为0');
        }
        return 1/$i;
    }
}