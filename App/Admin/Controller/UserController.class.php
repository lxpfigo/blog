<?php
namespace App\Admin\Controller;
use App\Admin\Common\Controller\AdminController;
use App\Admin\Model\CommentModel;
use App\Admin\Model\CommentuserModel;
use App\Admin\Model\UserModel;
use Framework\Page;

class UserController extends AdminController
{
	private $user;
	private $id;
	public function __construct()
	{
		parent::__construct();
		$this->user = new UserModel();
		$this->id = intval($_GET['id']);
	}

	public function index()
	{
		$this->userList = $this->user->getAllUser();
		$this->display('User/index.tpl');

	}

	public function isTrue()
	{
		$id = $this->id;
		$isTrue = $this->user->getUserById($id);
		if($isTrue['is_admin'] == 1){
			if($this->user->changeIsAdminByid($id, 0)){
				href('修改成功');
			}else{
				href('修改失败');
			}
		}else{
			if($this->user->changeIsAdminByid($id, 1)){
				href('修改成功');
			}else{
				href('修改失败');
			}
		}
	}

	public function edit()
	{
		$id = $this->id;
		$this->data = $this->user->getUserById($id);
		$this->display('User/edit.tpl');
	}

	public function doEdit()
	{
		$id = $this->id;
		$data['nickname'] = $_POST['nickname'];
		$data['img'] = $_POST['img'];
		if(empty($id) || empty($data['nickname'])){
			$res = array('status'=>0);
			echo json_encode($res);
		}
		if($this->user->chageUserInfo($id, $data)){
			$res = array('status'=>1,'info'=> APP.'/Admin/User/index');
			echo json_encode($res);
		}else{
			$res = array('status'=>0);
			echo json_encode($res);
		}
	}

	public function changeImg()
	{
		$img = $this->getTitleImg();
		echo json_encode(array($img));
	}

	private function getTitleImg()
	{
		return APP.'/Public/UserIcon/'.mt_rand(0, 33).'.png';
	}

	public function chagePsw()
	{
		$this->assign(array('id'=> $this->id));
		$this->display('User/chagepsw.tpl');
	}
	public function doChangePsw()
	{
		$password1 = $_POST['password1'];
		$password2 = $_POST['password2'];
		$id = intval($_GET['id']);
		if(empty($password1) || empty($password2) || empty($id)){
			href('密码不能为空');
		}
		if($password1 !== $password2){
			href('两次密码输入不一致');
		}


		if($this->user->savePsw($id, md5($password1)))
		{
			href('修改密码成功', 2);
		}else{
			href('修改失败');
		}

	}


	public function userComment()
	{
		$commentUser = new CommentuserModel();
		$count = $commentUser->getCount();

		$p = !empty($_GET['p']) ? $_GET['p'] : 1;
		if ($p < 1 || $p > ceil($count/$this->pageNum)) {
			$this->display("Error/index.tpl");
			exit();
		}
		$this->commentUser = $commentUser->getUser(array((($p - 1) * $this->pageNum), $this->pageNum));
		$page = new Page();

		$this->show = $page->getPage(APP.'/Admin/User/usercomment/p/', $count, $this->pageNum, $p);
		$this->ps = ($p - 1) * $this->pageNum + 1;

		$this->display('User/usercomment.tpl');
	}

	public function del()
	{
		$id = $this->id;
		$commentUser = new CommentuserModel();
		$comment = new CommentModel();

		if($commentUser->delete($id) && $comment->delCommentByCommentUserId($id)){
			href('删除成功');
		}else{
			href('删除失败');
		}
	}

}
