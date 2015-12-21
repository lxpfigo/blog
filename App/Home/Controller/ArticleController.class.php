<?php
namespace App\Home\Controller;
use App\Home\Common\Controller\CommonController;
use App\Home\Model\ArticleModel;
use App\Home\Model\CommentModel;
use App\Home\Model\CommentuserModel;
use App\Home\Model\TagModel;

/**
 * Created by PhpStorm.
 * User: lxpfigo
 * Date: 2015/11/10
 * Time: 16:03
 * 文章详情页
 */
class ArticleController extends CommonController
{
    public function index()
    {
        $id = empty($_GET['id']) ? 1 : (int) doSafe($_GET['id']);
        $article = new ArticleModel();
        $articleDetail = $article->getArticleById($id);
        if(empty($articleDetail)) {
            $this->display("Error/index.tpl");
            exit();
        }
        //每次点击阅读量+1
        $article->addClicked($id);

        $comment = new CommentModel();

        $commentNums = $comment->getCommentNumsById($id);

        //查询标签内容
        $tag = new TagModel();
        $tags = $tag->getTagsById($id);
        //上一页，下一页
        //根据ID查出文章发表时间
        $articleTime = $article->getArticleTimeById($id);
        //根据时间查询最接近文章时间的上或下一个文章
        $articlePre = $article->getArticleByTime($articleTime,'pre');
        $articleNext = $article->getArticleByTime($articleTime,'next');


        $this->assign(array(
            'detail'=> $articleDetail,
            'nums'=> $commentNums,
            'tags'=> $tags,
            'articleId'=> $id,
            'articlePre'=> $articlePre,
            'articleNext'=> $articleNext,
        ));

        $this->display('Article/index.tpl');
    }

    //得到评论
    public function getComment()
    {
        $returnDate = array();
        $id = (int) doSafe($_POST['articleId']);
        $p = (int) doSafe($_POST['p']);
        if (empty($id) || empty($p)) {
            $returnDate['status'] = 0;
        }
        //根据传入的页码和id进行查询
        $comment = new CommentModel();
        //得到评论总数
        $count = $comment->getCommentNumsById($id);
        //如果传入的页码大于或等于最大页码数
        if ($p >= ceil($count/$this->pageNum)) {
            $returnDate['status'] = 0;
        }else {
            $returnDate['status'] = 1;
        }

        //得到分页数据
        $data = $comment->getCommentByIdAndPage($id,$p,$this->pageNum);
        $returnDate['data'] = $data;
        echo json_encode($returnDate);
    }

    //发表评论
    public function shareComment()
    {
        $id = (int) doSafe($_POST['articleId']);
        $comment_info = doSafe($_POST['info']);
        if(empty($id) || empty($comment_info)) {
            echo json_encode(0);
            exit;
        }

        //根据微博id找到userID
        $commentUser = new CommentuserModel();
        $user = $commentUser->findUserByWeiboId($_SESSION['weibo']['weibo_id']);
        $userId = $user['comment_user_id'];
        $addArr = array(
            'comment_user_id'=> $userId,
            'article_id'=> $id,
            'comment_info'=> $comment_info,
            'comment_time'=> time()
        );
        $comment = new CommentModel();
        if($comment->addComment($addArr)) {
            echo json_encode(2);
            exit;
        }else {
            echo json_encode(1);
            exit;
        }
    }
}