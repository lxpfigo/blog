<?php
namespace App\Admin\Model;
use Framework\Model;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/6
 * Time: 21:55
 * 用户模型
 */
class UserModel extends Model
{
    public function getUserByUsernameAndPassword($arr)
    {
        $str = '';
        foreach ($arr as $key=> $v) {
            $str .= '`'.$key.'` = '."'$v'".' AND ';
        }
        $str = rtrim($str, ' AND');
        $sql = 'select * from web_user where '.$str;
        return $userInfo = $this->findOne($sql);
    }

    public function getAllUser()
    {
        $sql = 'select * from web_user';
        return $this->findAll($sql);
    }

    /*根据id查找用户信息*/
    public function getUserById($id)
    {
        $sql = 'select * from web_user where `user_id`='.$id;
        return $this->findOne($sql);
    }

    /*根据id修改is_admin状态*/
    public function changeIsAdminByid($id, $num)
    {
        $sql = 'update web_user set `is_admin`='.$num.' where `user_id`='.$id;
        return $this->save($sql);
    }

    /*修改信息*/
    public function chageUserInfo($id, $data)
    {
        $sql = 'update web_user set ';
        foreach ($data as $key=> $v) {
            $sql .= "`".$key."`="."'".$v."',";
        }
        $sql = rtrim($sql, ',');
        return $this->save($sql);
    }

    /*修改密码*/
    public function savePsw($id, $psw)
    {
        $sql = "update web_user set `password`="."'".$psw."' where user_id=".$id;
        return $this->save($sql);
    }
}