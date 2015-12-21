<?php
namespace App\Home\Model;
use Framework\Model;

/**
 * Created by PhpStorm.
 * User: lxpfigo
 * Date: 2015/11/10
 * Time: 16:47
 * 标签操作模型
 */
class TagModel extends Model
{
    public function getTagsById($id)
    {
        $sql = 'SELECT web_tag.describe_info FROM web_article_tag, web_tag WHERE web_article_tag.tag_id = web_tag.tag_id AND web_article_tag.article_id = '.$id;
        return $this->findAll($sql);
    }

    public function getIdByInfo($str)
    {
        $sql = 'SELECT tag_id FROM web_tag WHERE tag_id = "'.$str.'"';
        return $this->findOne($sql);
    }

    public function getNav()
    {
        $sql = 'select * from web_tag where nav=1';
        return $this->findAll($sql);
    }

    public function getTag()
    {
        $sql = 'select * from web_tag';
        return $this->findAll($sql);
    }

}