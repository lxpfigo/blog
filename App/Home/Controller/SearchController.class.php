<?php
namespace App\Home\Controller;
use Framework\Page;
use App\Home\Common\Controller\CommonController;
use App\Home\Model\ArticleModel;

/**
 * Created by PhpStorm.
 * User: lxpfigo
 * Date: 2015/11/11
 * Time: 15:51
 * 文章搜索
 *
 */
class SearchController extends CommonController
{
    public function index()
    {
        $s = doSafe($_GET['s']);
        $p = !empty($_GET['p']) ? (int) doSafe($_GET['p']) : 1;
        $article = new ArticleModel();
        //合计文章数目
        $total = $article->getTotal($s);

        //输出首页数据
        if ($total == 0) {
            if ($p < 1) {
                $this->display("Error/index.tpl");
                exit();
            }
        }else {
            if ($p < 1|| $p > ceil($total/$this->pageNum)) {
                $this->display("Error/index.tpl");
                exit();
            }
        }




        $articleList = $article->getArticle($p, $this->pageNum, $s);

//			获取分页条
        $getPage = new Page();


        $this->assign(array(
            'total'=> $total,
            'page'=> $getPage->getPage(APP.'/search/?s='.$s.'&p=', $total, $this->pageNum, $p),
            'articleList'=> $articleList,
        ));
        $this->display('Search/index.tpl');
    }
}