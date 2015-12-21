<?php
namespace App\Admin\Controller;
use App\Admin\Common\Controller\AdminController;
use App\Admin\Model\ArticleModel;
use App\Admin\Model\ArticleTagModel;
use App\Admin\Model\CommentModel;
use App\Admin\Model\TagModel;
use Framework\Image;
use Framework\Page;
use Framework\Upload;
class ArticleController extends AdminController
{
	private $id;
	private $article;
	private $articleTag;
	private $file;
	public function __construct()
	{
		parent::__construct();
		$this->id = intval(doSafe($_GET['id']));
		$this->article = new ArticleModel();
		$this->articleTag = new ArticleTagModel();
		$this->file = new Upload('title-img', 'title');
	}
	public function index()
	{
		$count = $this->article->getCount();
		$p = !empty($_GET['p']) ? $_GET['p'] : 1;
		if ($p < 1 || $p > ceil($count/$this->pageNum)) {
			$this->display("Error/index.tpl");
			exit();
		}

		$data = $this->article->getArticle('web_article.createtime', array(($p - 1) * $this->pageNum, $this->pageNum));
		$page = new Page();
		$pageStr = $page->getPage(APP.'/Admin/Article/index/p/', $count, $this->pageNum, $p);
		$this->assign(array(
			'data'=> $data,
			'page'=> $pageStr,
			'ps'=>  ($p - 1) * $this->pageNum + 1,
		));
		$this->display('Article/index.tpl');
	}

	//修改是否置顶
	public function top()
	{
		$id = $this->id;
		$res = $this->article->getArticleById($id);
		$isTop = (int)$res['is_top'];
		if($isTop == 1){
			$data['is_top'] = 0;
		}else{
			$data['is_top'] = 1;
		}

		//修改文章是否置顶
		$result = $this->article->saveTop($data, $id);

		 if($result){
			 href('修改成功', 2);
		 }else{
			 href('修改失败');
		 }
	}

	//删除文章
	public function del()
	{
		$id = $this->id;
		$article = $this->article->delArticleById($id);
		$articleTag = $this->articleTag->delTag($id);
		$comment = new CommentModel();
		$comment = $comment->delCommentByArticleId($id);
		if($article && $articleTag){
			href('删除成功');
		}else{
			href('删除失败');
		}
	}
	//显示新增文章页面，如果带入了参数则为修改，否则为新增
	public function add()
	{
		$id = $this->id;
		$tag = new TagModel();
		if (!empty($id)) {
			//修改文章
			$data = $this->article->getArticleById($id);
			//根据article_id查询到分类
			$articleTags = $tag->getTagsByArticleId($id);
			foreach ($articleTags as $v) {
				$articleTag[] = $v['tag_id'];
			}
			$this->assign(array('articleTag'=> $articleTag));
			$this->data = $data;
		}
		else
		{
			//添加文章

		}
		//查询出所有的标签
		$this->tags = $tag->getAllTags();
		$this->display('Article/add.tpl');
	}

	public function doAdd()
	{
		$title = ($_POST['title']);
		$description = $_POST['description'];
		$tags = $_POST['tag'];
		$isTop = intval(($_POST['is-top']));
		$detail = htmlspecialchars($_POST['detail']);
		$clicked = intval($_POST['clicked']);

		if(empty($title) || empty($description) || empty($tags)  || empty($detail)){
			href('请填写完整信息!');
		}

		$data = array(
			'title'=> $title,
			'clicked'=> $clicked,
			'description'=> $description,
//					'title_img' => $imgPath,
			'detailed'=> $detail,
//					'createtime'=> time(),
			'user_id'=> 33,
			'is_top'=> $isTop
		);



		if($this->id === 0){
			//新增文章
			if(empty($_FILES['title-img']['tmp_name'])){
				href('请选择封面图片');
			}
			$fileInfo = $this->file->getFileInfo();
			if ($fileInfo['status'] == 'SUCCESS') {
				$titleImg = $fileInfo['url'];
			}else {
				href($fileInfo['status']);
				exit();
			}

			//生成缩微图
			$img = new Image($titleImg, array('path'=> 'img'));
			$imgInfo = $img->thumb();
			//添加水印
			$imageWater = new Image($imgInfo['url'], array('path'=> 'img'));
			$imgWaterInfo = $imageWater->textWater();
			if ($imgWaterInfo['status'] != 'SUCCESS') {
				href($imgWaterInfo['status']);
				exit();
			}

			//将数据写入数据库
			$data['title_img'] = $imgWaterInfo['url'];
			$data['createtime'] = time();
			$articleId = $this->article->addArticle($data);
			$addtag = $this->articleTag->addTags($tags, $articleId);
			if ($articleId && $addtag) {
				href('添加成功', 2);
			} else {
				href('添加失败');
			}
		}else{
			//修改文章
			//选择封面
			if(!empty($_FILES['title-img']['tmp_name'])){
				$fileInfo = $this->file->getFileInfo();
				if ($fileInfo['status'] == 'SUCCESS') {
					$titleImg = $fileInfo['url'];
					//生成缩微图
					$img = new Image($titleImg, array('path'=> 'img'));
					$imgInfo = $img->thumb();
					//添加水印
					$imageWater = new Image($imgInfo['url'], array('path'=> 'img'));
					$imgWaterInfo = $imageWater->textWater();
					if ($imgWaterInfo['status'] != 'SUCCESS') {
						href($imgWaterInfo['status']);
						exit();
					}
				}else {
					href($fileInfo['status']);
					exit();
				}
				//将数据写入数据库
				$data['title_img'] = $imgWaterInfo['url'];
			}
			//更新数据
			$res = $this->article->updateArticle($data, $this->id);

			//删除分类
			$delTag = $this->articleTag->delTag($this->id);


			//增加分类
			$addtag = $this->articleTag->addTags($tags, $this->id);
			if ($res && $delTag && $addtag) {
				href('修改成功', 2);
			}else {
				href('修改失败');
			}
		}
	}
}
