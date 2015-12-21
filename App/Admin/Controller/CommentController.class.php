<?php
namespace App\Admin\Controller;
use App\Admin\Common\Controller\AdminController;
use App\Admin\Model\CommentModel;
use Framework\Page;

class CommentController extends AdminController
{
	private $comment;
	public function __construct()
	{
		parent::__construct();
		$this->comment = new CommentModel();

	}

	public function index()
	{
		$count = $this->comment->getCount();
		$p = !empty($_GET['p']) ? $_GET['p'] : 1;
		if ($p < 1 || $p > ceil($count / $this->pageNum)) {
			$this->display("Error/index.tpl");
			exit();
		}
		$data = $this->comment->getAllComment(array(($p - 1) * $this->pageNum,  $this->pageNum ));
		$page = new Page();
		$page = $page->getPage(APP.'/Admin/Comment/index/p/', $count, $this->pageNum, $p);

		$this->assign(array(
			'data'=> $data,
			'show'=> $page,
			'ps' => ($p - 1) * $this->pageNum + 1,
		));
		$this->display('Comment/index.tpl');





//			$Page = new \Think\Page($count, $this->pageNums);
//			$Page->setConfig('prev', '&laquo;');
//			$Page->setConfig('next', '&raquo;');
//			$show = $Page->show();
//			$data = D('Comment')->relation(true)->order('comment_time desc')->page($_GET['p'].','.$this->pageNums)->select();
//			$this->assign('data', $data);
//			$this->assign('show', $show);
//			$this->page = $this->pageNums;
//			$this->display();
	}

	public function del()
	{
		$id = intval($_GET['id']);
		if($this->comment->delete($id)){
			href('删除成功');
		}else{
			href('删除失败');
		}
	}

	public function edit()
	{
		$id = intval($_GET['id']);
		$this->data = $this->comment->getCommentById($id);
		$this->display("Comment/edit.tpl");
	}

	public function doEdit()
	{
		$id = intval($_GET['id']);
		$comment = trim($_POST['comment']);
		if(empty($id) || empty($comment)){
			href('请填写完整信息');
		}

		if($this->comment->updateComment($id, $comment))
		{
			href('修改成功', 2);
		}else{
			href('修改失败');
		}
	}
		
		
}
