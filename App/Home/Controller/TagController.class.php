<?php
namespace App\Home\Controller;
use Framework\Page;
use App\Home\Common\Controller\CommonController;
use App\Home\Model\ArticleModel;
use App\Home\Model\ArticletagModel;
use App\Home\Model\TagModel;

/**
 * Created by PhpStorm.
 * User: lxpfigo
 * Date: 2015/11/9
 * Time: 15:13
 */
class TagController extends CommonController
{
    public function index()
    {
        $id = $_GET['id'];
        $p = !empty($_GET['p']) ? (int) doSafe($_GET['p']) : 1;

        if($id === '') {
            //400页面
            $this->display("Error/index.tpl");
            exit();
        }
        //根据接受信息查询
        $tag = new TagModel();
        $tagInfo = $tag->getIdByInfo($id);
        if (empty($tagInfo)) {
            $this->display("Error/index.tpl");
            exit();
        }
        //通过tag_id找到article_id
        $article = new ArticleModel();
        $articletag = new ArticletagModel();
        $articleIds = $articletag->getArticleIdByTagId($id);
        //合计文章数目
        $total = count($articleIds);

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
        if (empty($articleIds)) {
            //该分类下无文章
            $articleList = array();
        }else {
            //根据ID去查找文章
            $articleList = $article->getArticleByIds($articleIds, $p, $this->pageNum);
        }

        $getPage = new Page();

        $this->assign(array(
                'total'=> $total,
                'id'=> $id,
                'page'=> $getPage->getPage(APP.'/tag/index/id/'.$id.'/p/', $total, $this->pageNum, $p),
                'articleList'=> $articleList,
            )
        );

//			获取分页条

        $this->display('Tag/index.tpl');
    }
}