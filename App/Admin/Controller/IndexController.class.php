<?php
namespace App\Admin\Controller;
use App\Admin\Common\Controller\AdminController;
use App\Admin\Model\ArticleModel;
use App\Admin\Model\CommentModel;
use App\Admin\Model\CommentuserModel;

class IndexController extends AdminController
{
    public function index(){
    	$article = new ArticleModel();
		$comment = new CommentModel();
		$commentuser = new CommentuserModel();

		//合计评论用户数
		$this->totalUser = $commentuser->getCount();
		//文章合计
		$this->totalArticle = $article->getCount();
		//评论合计
		$this->totalComment = $comment->getCount();

		
		
		//今日新增
		$this->todayArticle = $article->getCount(' `createtime` > '.$this->formatTime(time(), '1'));

		$this->todayComment = $comment->getCount(' `comment_time` > '.$this->formatTime(time(), '1'));


		
		//昨日新增
		$this->yesArticle = $article->getCount(' `createtime` > '.$this->formatTime(time()-24*60*60, '1').' AND createtime < '.$this->formatTime(time()-24*60*60, '2'));
		$this->yesComment = $comment->getCount(' `comment_time` > '.$this->formatTime(time()-24*60*60, '1').' AND comment_time < '.$this->formatTime(time()-24*60*60, '2'));

		
		//热门文章输出
		$data = $article->getArticle('web_article.clicked', array(0,10));
//		foreach($data as $key=>$v){
//			$data[$key]['commentinfo'] = count($data[$key]['commentinfo']);
//		}
		$this->data = $data;
		
					
	//活跃用户
		$userList = $comment->getHotUser();
		$this->userList = $userList;
	
		$this->display("Index/index.tpl");
    }
	
	//注销登陆
	public function logout()
	{
		unset($_SESSION['user']);
		session_destroy();
		header('Location:'.APP.'/Admin/Login');
	}
	
	
	
	
	
	
	
	
	private function formatTime($time, $start)
	{
		$y = date('Y', $time);
		$m = date('m', $time);
		$d = date('d', $time);
		switch($start){
			case 1 :
				return mktime(0, 0, 0, $m, $d, $y);
				break;
			case 2 :	
				return mktime(24, 59, 59, $m, $d, $y);
				break;
			default:	
				break;
		}
	}
	
	
}