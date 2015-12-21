<?php
namespace App\Home\Model;
use Framework\Model;

/**
 * Created by PhpStorm.
 * User: lxpfigo
 * Date: 2015/11/11
 * Time: 14:26
 * 评论用户操作表
 */
class CommentuserModel extends Model
{
    public function findUserByWeiboId($id)
    {
        $sql = 'SELECT * FROM web_commentuser WHERE weibo_id = '.$id.' limit 1';
        return $this->findOne($sql);
    }

    public function updateUserByWeiboId($id,$arr)
    {
        $sql = 'UPDATE web_commentuser SET ';
        foreach ($arr as $key=> $v) {
            $sql .= "`".$key."` = "."'".$v."',";
        }
        $sql = rtrim($sql, ',');
        $sql .= ' where weibo_id = '.$id;
        return $this->save($sql);
    }

    public function addUser($arr)
    {
        $keys = '';
        $vs = '';
        foreach ($arr as $key => $v) {
            $keys .= '`'.$key.'`,';
            $vs .= "'".$v."',";
        }
        $keys = rtrim($keys, ',');
        $vs = rtrim($vs, ',');
        $sql = 'insert into web_commentuser '.'('.$keys.') values ('.$vs.')';
        return $this->add($sql);
    }
}