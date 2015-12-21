<?php
namespace App\Admin\Controller;
use App\Admin\Common\Controller\AdminController;
use App\Admin\Model\TagModel;

class TagController extends AdminController
{
	private $id;
	private $tag;
	public function __construct()
 	{
	   parent::__construct();
	   $this->id = intval(doSafe($_GET['id']));
	   $this->tag = new TagModel();
 	}
	public function index()
	{
//		$tags = D('Tag')->relation(true)->select();
//		foreach($tags as $key=>$v){
//			$tags[$key]['totalArticle'] = count($tags[$key]['articleinfo']);
//		}
//		$this->assign('tags', $tags);
		$tags = $this->tag->getTagsAndCount();
		foreach ($tags as $key=> $v) {
			if ($tags[$key]['article_id'] === NULL) {
				$tags[$key]['count'] = $tags[$key]['count'] - 1;
			}
		}
		$this->tags = $tags;
		$this->display('Tag/index.tpl');
	}
	
	public function nav()
	{
		$tag = $this->tag->getTagsById($this->id);
		if($tag['nav'] == 1){
			$res = $this->tag->chageNav($this->id, 0);
		}else{
			$res = $this->tag->chageNav($this->id, 1);
		}
		if($res){
			href('修改成功');
		}else{
			href('修改失败');
		}
	}
	
	public function edit()
	{
		$this->taginfo = $this->tag->getTagsById($this->id);
		$this->display('Tag/edit.tpl');
	}
	
	public function doEdit()
	{
		$data['describe_info'] = doSafe($_POST['describe_info']);
		$data['nav'] = intval($_POST['nav']);
		if(empty($data['describe_info'])){
			href('请填写完整的信息');
		}
		if($this->id === 0){
			//新增标签
			$res = $this->tag->addTag($data);
			if($res){
				href('新增标签成功', 2);
			}else{
				href('新增标签失败');
			}
		}else{
			//修改标签
			$res = $this->tag->chengeTagByTagId($this->id, $data);
			if($res){
				href('修改标签成功', 2);
			}else{
				href('修改标签失败');
			}
		}
	}
}
