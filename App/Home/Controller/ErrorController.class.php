<?php
namespace App\Home\Controller;
use App\Home\Common\Controller\CommonController;

/**
 * Created by PhpStorm.
 * User: lxpfigo
 * Date: 2015/12/3
 * Time: 15:31
 * 404
 */
class ErrorController extends CommonController
{
    public function index()
    {
        $this->display("Error/index.tpl");
    }
}
