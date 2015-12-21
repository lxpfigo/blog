<?php
namespace App\Admin\Controller;
use App\Admin\Model\UserModel;
use Framework\Controller;
use Framework\Verify;

class LoginController extends Controller
{
    public function index()
	{
    	$this->display("Login/index.tpl");
    }
	public function code()
	{
		$data['fontsize'] = 24;
		$data['point'] = '800';
		$data['height'] = '34';
		$data['width'] = 110;
		$obj = new Verify($data);
		$obj->getVerify();
	}
	
	public function doLogin()
	{
		$res = array();
		$username = trim(doSafe($_POST['username']));
		$password = trim(doSafe($_POST['password']));
		$code = trim(doSafe($_POST['code']));
		//验证是否有空值提交
		if(empty($username) || empty($password) || empty($code)){
			$res['status'] = 1;
			echo json_encode($res);
			exit();
		}		
		//验证验证码是否正确		
		if(!self::checkVerify($code)){
			$res['status'] = 0;
			echo json_encode($res);
			exit();
		}
		
		//验证密码和用户是否匹配
		$where = array(
			'username'=> $username,
			'password'=> md5($password),
			'is_admin'=> 1
		);
		$user = new UserModel();
		$userInfo = $user->getUserByUsernameAndPassword($where);
		if(!empty($userInfo))
		{
			$res['status'] = 10;
			$res['url'] = APP.'/Admin/Index/index';
			$_SESSION['user'] = $userInfo;
		}else{
			$res['status'] = 2;
		}
		echo json_encode($res);
		exit();
	}

	private static function checkVerify($code)
	{
		$res = false;
		if (md5(strtoupper($code)) === $_SESSION['Verify']) {
			$res = true;
		}
		return $res;
	}
}