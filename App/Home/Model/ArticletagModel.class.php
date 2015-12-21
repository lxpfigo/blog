<?php
namespace App\Home\Model;
use Framework\Model;

/**
 * Created by PhpStorm.
 * User: lxpfigo
 * Date: 2015/11/13
 * Time: 10:17
 */
class ArticletagModel extends Model
{
    public function getArticleIdByTagId($id)
    {
        $sql = 'SELECT article_id FROM web_article_tag WHERE tag_id = '.$id;
        return $this->findAll($sql);
    }
}