<?php
namespace APP\Admin\Controller;
use App\Admin\Common\Controller\AdminController;

/**
 * Created by PhpStorm.
 * User: lxpfigo
 * Date: 2015/12/8
 * Time: 15:40
 */
class UploadController extends AdminController
{
    public function index()
    {
        $data = array(
            "state"=> 1,
            "url" => 'www.baidu.com',
            "title"=> '这是测试',
            "original"=>'blob.png',
            "type"=> '.png',
            'size'=> '7110',
        );
        echo json_encode($data);
//        {"state":"\u76ee\u5f55\u521b\u5efa\u5931\u8d25",
//"url":"\/ueditor\/php\/upload\/image\/20151208\/1449563903258298.png",
//"title":"1449563903258298.png",
//"original":"blob.png",
//"type":".png",
//"size":7110}
    }




}