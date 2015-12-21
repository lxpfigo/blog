<?php
namespace App\Home\Model;
use Framework\Model;

/**
 * Created by PhpStorm.
 * User: lxpfigo
 * Date: 2015/11/10
 * Time: 16:39
 * 评论操作模型
 */
class CommentModel extends Model
{
    public function getCommentNumsById($id)
    {
        $sql = 'SELECT COUNT(*) as count FROM web_comment WHERE web_comment.article_id = '.$id;
        return $this->count($sql);
    }

    public function getCommentByIdAndPage($id, $p, $rowLists)
    {
        $sql = 'SELECT web_comment.comment_info,web_comment.comment_time,'.
            'web_commentuser.img,web_commentuser.nickname,web_commentuser.location '.
            'FROM web_comment,web_commentuser WHERE web_comment.comment_user_id = web_commentuser.comment_user_id'.
            ' AND web_comment.article_id = '.$id.' LIMIT '.($p-1)*$rowLists.','.$rowLists;
        return $this->findAll($sql);
    }
    //添加评论
    public function addComment($arr)
    {
        $keys = '';
        $vs = '';
        foreach ($arr as $key => $v) {
            $keys .= '`'.$key.'`,';
            $vs .= "'".$v."',";
        }
        $keys = rtrim($keys, ',');
        $vs = rtrim($vs, ',');
        $sql = 'insert into web_comment '.'('.$keys.') values ('.$vs.')';
        return $this->add($sql);
    }
}