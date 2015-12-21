<?php
namespace App\Admin\Model;
use Framework\Model;
class ArticleModel extends Model
{
    /*
     * $arr = array(gt, $key, $v)
     * */
    public function getCount($where = NULL)
    {
        if ($where === NULL) {
            $sql = 'select count(*) as count from web_article';
        }else {
            $sql = 'select count(*) as count from web_article where'.$where;
        }
        return $this->count($sql);
    }

    public function getArticle($where, $limit)
    {
        $sql = 'SELECT web_article.article_id,web_article.title,web_article.clicked, web_article.createtime, web_article.is_top,'.
            'COUNT(web_comment.article_id) as '.
            'totalcomment FROM web_article LEFT JOIN web_comment ON '.
            'web_article.article_id = web_comment.article_id GROUP BY web_article.article_id order by '.$where.' desc'.
            ' limit '.$limit[0].' ,'.$limit[1];
        $data = $this->findAll($sql);
        if (!empty($data)) {
            foreach ($data as $key=> $v) {
                $query = 'SELECT web_tag.describe_info, web_tag.tag_id from web_article_tag, web_tag '.
                    'WHERE web_article_tag.tag_id = web_tag.tag_id AND web_article_tag.article_id = '.$v['article_id'];
                $data[$key]['tags'] = $this->findAll($query);
            }
        }else {

            $data = array();
        }
        return $data;
    }

    public function getArticleById($id)
    {
        $sql = 'select * from web_article where `article_id` = '.$id;
        return $this->findOne($sql);
    }

    //修改是否置顶
    public function saveTop($arr, $id)
    {
        $sql = 'update web_article set ';
        foreach ($arr as $key=> $v) {
            $sql .= '`'.$key.'` = '."'$v'";
        }
        $sql .= ' where article_id = '.$id;
        return $this->save($sql);
    }

    //通过id删除文章并且要删除评论和分类
    public function delArticleById($id)
    {
        $sql = 'delete from web_article where `article_id` = '.$id;
        return $this->del($sql);
    }

    //新增文章
    public function addArticle($data)
    {
//        $sql = 'insert into web_article (`title`) VALUES ('')'
        $keys = '';
        $vs = '';
        foreach ($data as $key=> $v) {
            $keys .= "`".$key."`,";
            $vs .= "'".$v."',";
        }
        $keys = rtrim($keys, ',');
        $vs = rtrim($vs, ',');
        $sql = 'insert into web_article ('.$keys.') VALUES ('.$vs.')';
        return $this->add($sql);
    }

    //修改文章
    public function updateArticle($date, $id)
    {
        //update web_article set `title`='111',
        $sql = 'update web_article set ';
        foreach ($date as $k=> $v) {
            $sql .= "`".$k."`="."'".$v."',";
        }
        $sql = rtrim($sql, ',');
        $sql .= ' where article_id = '.$id;
        return $this->save($sql);
    }

}