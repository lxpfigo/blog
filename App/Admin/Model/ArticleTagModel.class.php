<?php
namespace App\Admin\Model;
use Framework\Model;
/**
 * Created by PhpStorm.
 * User: lxpfigo
 * Date: 2015/12/9
 * Time: 15:11
 * 文章和标签关系模型
 */
class ArticleTagModel extends Model
{
    public function addTags($tags, $articleId)
    {
        $mysql = "INSERT INTO web_article_tag (article_id, tag_id) VALUES ";
        foreach($tags as $v){
            $mysql .= "('".$articleId."'".", '".$v."')".",";
        }

        $mysql = rtrim($mysql, ',');
        return $this->save($mysql);
    }

    //根据文章id删除分类
    public function delTag($id)
    {
        $sql = 'delete from web_article_tag where article_id = '.$id;
        return $this->del($sql);
    }
}