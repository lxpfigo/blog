<?php
namespace App\Admin\Model;
use Framework\Model;
class CommentModel extends Model
{
    public function getCount($where = NULL)
    {
        if ($where === NULL) {
            $sql = 'select count(*) as count from web_comment';
        }else {
            $sql = 'select count(*) as count from web_comment where'.$where;
        }
        return $this->count($sql);
    }

    public function getHotUser()
    {
        /*
         * select web_commentuser.*, count(web_comment.comment_user_id) as nums from web_commentuser JOIN           web_comment ON web_commentuser.comment_user_id = web_comment.comment_user_id group by web_comment.comment_user_id	 order BY nums desc limit 10
         * */
        $sql = 'select web_commentuser.*, count(web_comment.comment_user_id) as nums from web_commentuser JOIN '.
               'web_comment ON web_commentuser.comment_user_id = web_comment.comment_user_id group by web_comment.comment_user_id'.
               ' order by nums desc limit 10';
        return $this->findAll($sql);
    }

    public function delCommentByArticleId($id)
    {
        $sql = 'delete from web_comment where `article_id` = '.$id;
        return $this->del($sql);
    }

    public function getAllComment($limit)
    {
        $sql = 'select web_comment.*, web_article.title, web_commentuser.nickname from web_comment, '.
            'web_commentuser, web_article where web_comment.article_id=web_article.article_id and '.
            'web_comment.comment_user_id=web_commentuser.comment_user_id order by web_comment.comment_time desc limit '.$limit[0].','.$limit[1];
        return $this->findAll($sql);
    }

    /*删除评论*/
    public function delete($id)
    {
        $sql = 'delete from web_comment where comment_id = '.$id;
        return $this->del($sql);
    }

    /*根据id获得评论*/
    public function getCommentById($id)
    {
        $sql = 'select * from web_comment where comment_id = '.$id;
        return $this->findOne($sql);
    }
    /*根据id修改评论内容*/
    public function updateComment($id, $info)
    {
        $sql = "update web_comment set `comment_info` = '".$info."' where comment_id = ".$id;
        return $this->save($sql);
    }

    public function delCommentByCommentUserId($id)
    {
        $sql = 'delete from web_comment where `comment_user_id` = '.$id;
        return $this->del($sql);
    }
}