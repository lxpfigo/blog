<?php
namespace App\Admin\Common\Controller;
use Framework\Controller;

/**
 * Created by PhpStorm.
 * User: lxpfigo
 * Date: 2015/12/4
 * Time: 14:48
 */
class AdminController extends Controller
{
    protected $pageNum;
    public function __construct()
    {
        parent::__construct();
        self::isLogin();
        @$pageNums = getConfig('PAGENUM');
        $this->pageNum = !empty($pageNums) ? $pageNums : 11;
        $this->assign(array(
           'APP'=> APP,
            'user'=> $_SESSION['user'],
        ));


    }

    //判断是否登录
    private static function isLogin()
    {
        if (empty($_SESSION['user'])) {
            header("location:".APP."/Admin/Login/index");
        }
    }

}