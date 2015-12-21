<?php
namespace App\Home\Common\Controller;
use Framework\Controller;
use App\Home\Model\ArticleModel;
use App\Home\Model\LinkModel;
use App\Home\Model\TagModel;

/**
 * Created by PhpStorm.
 * User: lxpfigo
 * Date: 2015/12/3
 * Time: 10:45
 */
class CommonController extends Controller
{
    protected $pageNum;
    public function __construct()
    {
        parent::__construct();
        //获取配置文件中的分页数
        @$pageNums = getConfig('PAGENUM');
        $this->pageNum = !empty($pageNums) ? $pageNums : 11;
        //输出导航信息
        $this->getNav();
        $this->getTag();
        $this->getHotArticle();
        $this->getLink();

    }
    //输出导航信息
    private function getNav()
    {
        $obj = new TagModel();
        $nav = $obj->getNav();
        $this->assign(array(
            'nav'=> $nav,
            'APP'=> APP,
            'id'=> 0,
        ));
    }

    //热门标签输出
    private function getTag()
    {
        $obj = new TagModel();
        $tag = $obj->getTag();
        $this->assign(array('tag'=> $tag));
    }

    //热门文章输出
    private function getHotArticle()
    {
        $obj = new ArticleModel();
        $hot = $obj->getHotArticle();
        $this->assign(array('hot'=> $hot));
    }

    //收藏输出
    private function getLink()
    {
        $obj = new LinkModel();
        $linkInfo = $obj->getLink();
        $this->assign(array('linkInfo'=> $linkInfo));
    }

    //404
    public function error()
    {
        $this->display('Error/index.tpl');
    }
}