<?php
namespace App\Home\Model;
use Framework\Model;

/**
 * Created by PhpStorm.
 * User: lxpfigo
 * Date: 2015/11/10
 * Time: 9:02
 * article文章操作表
 */
class ArticleModel extends Model
{
    public function getArticle($p, $pageNum, $where = false)
    {
        if ($where == false) {
            $sql = 'SELECT web_article.article_id,web_article.title,web_article.clicked,web_article.description,'.
                'web_article.title_img,web_article.createtime,web_article.is_top,COUNT(web_comment.article_id) as '.
                'totalcomment FROM web_article LEFT JOIN web_comment ON '.
                'web_article.article_id = web_comment.article_id GROUP BY web_article.article_id order by web_article.createtime desc'.
                ' limit '.($p-1)*$pageNum.','.$pageNum;
        }else {
            $sql = 'SELECT web_article.article_id,web_article.title,web_article.clicked,web_article.description,'.
                'web_article.title_img,web_article.createtime,web_article.is_top,COUNT(web_comment.article_id) as '.
                'totalcomment FROM web_article LEFT JOIN web_comment ON '.
                'web_article.article_id = web_comment.article_id WHERE web_article.title LIKE "%'.$where.'%" OR web_article.description LIKE "%'.$where.'%" GROUP BY web_article.article_id order by web_article.createtime desc'.
                ' limit '.($p-1)*$pageNum.','.$pageNum;
        }

        $data = $this->findAll($sql);
        if (!empty($data)) {
            foreach ($data as $key=> $v) {
                $query = 'SELECT web_tag.describe_info from web_article_tag, web_tag '.
                    'WHERE web_article_tag.tag_id = web_tag.tag_id AND web_article_tag.article_id = '.$v['article_id'];
                $data[$key]['tags'] = $this->findAll($query);
            }
            }else {

                $data = array();
        }

        return $data;
    }

    public function getTotal($where = false)
    {
        if($where) {
            $sql = "SELECT COUNT(*) AS count FROM web_article WHERE title LIKE '%".$where."%' OR description LIKE '%".$where."%'";
        }else {
            $sql = 'select count(*) as count from web_article';
        }

        return $this->count($sql);
    }

    //根据id查找文章
    public function getArticleById($id)
    {
        $sql = 'SELECT web_article.article_id,web_article.title,web_article.clicked,web_article.title_img,web_article.description,'.
            'web_article.detailed,web_article.createtime FROM web_article WHERE article_id = '.$id;
        return $this->findOne($sql);
    }

    //根据id查找文章发表时间
    public function getArticleTimeById($id)
    {
        $sql = 'SELECT createtime FROM web_article WHERE article_id = '.$id;
        $res = $this->findOne($sql);
        return $res['createtime'];
    }

//根据时间查询最接近文章时间的上或下一个文章.小于最大的，大于最小的
    public function getArticleByTime($time, $type)
    {
        $data = array();
        switch ($type) {
            case 'next':
                $sql = 'SELECT article_id, title FROM web_article WHERE createtime < '.$time.' ORDER BY createtime DESC limit 1';
                $data = $this->findOne($sql);
                //下一页，小于最大的
                break;
            case 'pre':
                //上一页，大于最小的
                $sql = 'SELECT article_id, title FROM web_article WHERE createtime > '.$time.' ORDER BY createtime ASC limit 1';
                $data = $this->findOne($sql);
                break;
            default :
                break;
        }
        return $data;
    }

    //根据传入的id数组查找文章
    public function getArticleByIds($arr, $p, $pageNum)
    {
        $str = '';
        foreach ($arr as $v) {
            $str .= '"'.$v['article_id'].'" ,';
        }
        $ids = rtrim($str, ',');
        $sql = 'SELECT web_article.article_id,web_article.title,web_article.clicked,web_article.description,'.
            'web_article.title_img,web_article.createtime,web_article.is_top,COUNT(web_comment.article_id) as '.
            'totalcomment FROM web_article LEFT JOIN web_comment ON '.
            'web_article.article_id = web_comment.article_id where web_article.article_id IN ('.$ids.') GROUP BY web_article.article_id order by web_article.createtime desc'.
            ' limit '.($p-1)*$pageNum.','.$pageNum;
        $data = $this->findAll($sql);
        if (!empty($data)) {
            foreach ($data as $key=> $v) {
                $query = 'SELECT web_tag.describe_info from web_article_tag, web_tag '.
                    'WHERE web_article_tag.tag_id = web_tag.tag_id AND web_article_tag.article_id = '.$v['article_id'];
                $data[$key]['tags'] = $this->findAll($query);
            }
        }else {

            $data = array();
        }

        return $data;
    }

    //阅读量+1
    public function addClicked($id)
    {
        $sql = 'UPDATE web_article SET clicked = clicked + 1 WHERE article_id = '.$id;
        return $this->save($sql);
    }

    //获取热点文章
    public function getHotArticle()
    {
        $sql = 'select * from web_article order by clicked desc limit 5';
        return $this->findAll($sql);
    }
}