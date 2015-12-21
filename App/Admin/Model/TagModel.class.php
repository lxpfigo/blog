<?php
namespace App\Admin\Model;
use Framework\Model;
class TagModel extends Model
{
    //根据文章id查询tag信息
    public function getTagsByArticleId($id)
    {
        $sql = 'SELECT web_tag.tag_id,web_tag.describe_info FROM web_article_tag,web_tag WHERE web_article_tag.tag_id = web_tag.tag_id AND web_article_tag.article_id = '.$id;
        return $this->findAll($sql);
    }

    public function getAllTags()
    {
        $sql = 'select * from web_tag';
        return $this->findAll($sql);
    }
    public function getTagsAndCount()
    {
        $sql = 'select web_tag.*,count(web_tag.tag_id) as count,web_article_tag.article_id from web_tag left join web_article_tag ON web_tag.tag_id=web_article_tag.tag_id'.
            ' group by web_tag.tag_id';
        return $this->findAll($sql);
    }
    public function getTagsById($id)
    {
        $sql = 'select * from web_tag where tag_id = '.$id;
        return $this->findOne($sql);
    }
    public function chageNav($id, $num) {
        $sql = 'update web_tag set nav='.$num.' where tag_id = '.$id;
        return $this->save($sql);
    }

    public function addTag($data)
    {
        //insert into web_tag (`sss`) values ()
        $sql = 'insert into web_tag ';
        $keys = '';
        $vs = '';
        foreach ($data as $key=> $v) {
            $keys .= "`".$key."`,";
            $vs .= "'".$v."',";
        }
        $keys = rtrim($keys, ',');
        $vs = rtrim($vs, ',');
        $sql .= '('.$keys.') values ('.$vs.')';
        return $this->add($sql);
    }

    public function chengeTagByTagId($id, $data)
    {
        $sql = 'update web_tag set ';
        foreach ($data as $key=> $v) {
            $sql .= "`".$key."`="."'".$v."',";
        }
        $sql = rtrim($sql, ',');
        $sql .= 'where tag_id='.$id;
        return $this->save($sql);
    }
}