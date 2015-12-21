<?php
namespace App\Home\Controller;
use Framework\Controller;
use Framework\Wechat\JSSDK;

/**
 * Created by PhpStorm.
 * User: lxpfigo
 * Date: 2015/12/8
 * Time: 12:23
 */
class DemoController extends Controller
{
	public function jssdk()
	{
        $wx = JSSDK::getSignPackage();
        $this->assign(array('wx'=> $wx));
        $this->display("Demo/jssdk.html");		
	}
    public function wx()
    {
        $wx = JSSDK::getSignPackage();
        $this->assign(array('wx'=> $wx));
        $this->display("Demo/index.html");
    }
	
	public function fullpage()
	{
		$this->display('Demo/fullpage.html');
	}

    public function carousel()
    {
        $this->display('Demo/carousel.html');
    }
}