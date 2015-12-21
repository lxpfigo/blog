<?php
namespace App\Admin\Model;
use Framework\Model;

/**
 * Created by PhpStorm.
 * User: lxpfigo
 * Date: 2015/12/15
 * Time: 11:28
 */
class LinkModel extends Model
{
    public function getAllLink()
    {
        $sql = 'select * from web_link ORDER BY time desc';
        return $this->findAll($sql);
    }

    /*通过id查找链接信息*/
    public function getLinkById($id)
    {
        $sql = 'select * from web_link where `link_id`='.$id;
        return $this->findOne($sql);
    }

    /*通过id修改istrue字段*/
    public function changeIstrueById($id, $num)
    {
        $sql = 'update web_link set `istrue`='.$num.' where link_id='.$id;
        return $this->save($sql);

    }

    /*通过id删除链接*/
    public function delLinkById($id)
    {
        $sql = 'delete from web_link where `link_id`='.$id;
        return $this->del($sql);
    }

    /*新增链接*/
    public function addLink($data)
    {
        $sql = 'insert into web_link (';
        $keys = '';
        $vs = '';
        foreach($data as $key=> $v) {
            $keys .= "`".$key."`,";
            $vs .= "'".$v."',";
        }
        $keys = rtrim($keys, ',');
        $vs = rtrim($vs, ',');
        $sql .= $keys.' ) values ('.$vs.')';
        return $this->add($sql);
    }
    /*更新*/
    public function updateInfobyId($id, $data)
    {
        $sql = '';
        foreach ($data as $key=> $v) {
            $sql .= "`".$key."`="."'".$v."',";
        }
        $sql .= rtrim($sql, ',');
        $sql = 'update web_link set '.$sql.' where `link_id`='.$id;
        return $this->save($sql);
    }
}