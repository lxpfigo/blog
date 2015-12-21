<?php
namespace App\Home\Controller;
/*
* 首页显示
* */
use Framework\Page;
use App\Home\Common\Controller\CommonController;
use App\Home\Model\ArticleModel;

class IndexController extends CommonController
{
	public function index()
	{
		$article = new ArticleModel();
		//合计文章数目
		$total = $article->getTotal();
		//输出首页数据
		$p = !empty($_GET['p']) ? (int) doSafe($_GET['p']) : 1;
//			$p = $p < 1 ? 1 : $p;
//			$p = $p > ceil($total/$this->pageNum) ? ceil($total/$this->pageNum) : $p;
		if ($p < 1 || $p > ceil($total/$this->pageNum)) {
			$this->display("Error/index.tpl");
			exit();
		}
		$articleList = $article->getArticle($p, $this->pageNum);
//			获取分页条
		$getPage = new Page();

		$this->assign(array(
				'page'=> $getPage->getPage(APP.'/index/index/p/', $total, $this->pageNum, $p),
				'articleList'=> $articleList,
				'APP'=> APP,
		));
		$this->display('Index/index.tpl');
	}


}
