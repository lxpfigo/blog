<?php
namespace Framework\DB;
/**
 * Created by PhpStorm.
 * User: lxpfigo
 * Date: 2015/12/2
 * Time: 13:52
 * 数据库工厂类
 */
class DBFactory
{
    protected $link;

    public function __construct()
    {
        $this->link = DB::getInstance();
    }

    public function findAll($sql)
    {
        $returnArr = array();
        $res = $this->link->query($sql);
        if($res) {
            while ($row = $res->fetch_assoc()) {
                $returnArr[] = $row;
            }
            $res->free();
        }
        return $returnArr;
    }
    public function findOne($sql)
    {
        $row = array();
        $res = $this->link->query($sql);
        if($res) {
            $row = $res->fetch_assoc();
            $res->free();
        }
        return $row;
    }

    public function count($sql)
    {
        $res = $this->link->query($sql);
        if ($res) {
            $nums =$res->fetch_assoc();
            $res->free();
        }

        $num = $nums['count'];

        return $num;
    }

    public function add($sql)
    {
        $res = $this->link->query($sql);
        if (!$res) {
            return false;
        }
        $id = $this->link->insert_id;
        if($id) {
            return $id;
        }else {
            return false;
        }
    }

    public function del($sql)
    {
        if($this->link->query($sql)) {
            $res = $this->link->affected_rows;
        }else {
            $res = false;
        }
        return $res;
    }

    public function save($sql)
    {
        if($this->link->query($sql)) {
            $res = $this->link->affected_rows;
        }else {
            $res = false;
        }
        return $res;
    }

}