<?php
namespace App\Admin\Controller;
use App\Admin\Common\Controller\AdminController;
use App\Admin\Model\LinkModel;

class LinkController extends AdminController
	{
		private $link;
		private $id;
		public function __construct()
		{
			parent::__construct();
			$this->id = intval($_GET['id']);
			$this->link = new LinkModel();
		}

		public function index()
		{
			$data = $this->link->getAllLink();
			$this->assign(array('data'=> $data));
			$this->display("Link/index.tpl");
		}
		
		public function isTrue()
		{
			$id = $this->id;
			$oldIsTrue = $this->link->getLinkById($id);
			if($oldIsTrue['istrue'] == 1){
				$res = $this->link->changeIstrueById($id, 0);
			}else{
				$res = $this->link->changeIstrueById($id,1);
			}
			if($res){
				href('修改成功');
			}else{
				href('修改失败');
			}
		}
		
		public function del()
		{
			$id = $this->id;
			if($this->link->delLinkById($id)){
				href('删除成功');
			}else{
				href('删除失败');
			}
		}
		public function add()
		{
			$id = $this->id;
			$this->data = $this->link->getLinkById($id);
			$this->display('Link/add.tpl');
		}
		
		public function doAdd()
		{
			$data['title'] = $_POST['title'];
			$data['url'] = $_POST['url'];
			$data['istrue'] = intval($_POST['istrue']);
			if(empty($data['title']) || empty($data['url'])){
				href('请填写完整信息');
			}
			$id = $this->id;
			if(empty($id)){
				//新增
				$data['time'] = time();
				$res = $this->link->addLink($data);
			}else{
				//修改
				$res = $this->link->updateInfobyId($id, $data);
			}
			if($res){
				href('操作成功', 2);
			}else{
				href('操作失败');
			}
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	}
