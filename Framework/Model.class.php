<?php
namespace Framework;
use Framework\DB\DBFactory;
/**
 * Created by PhpStorm.
 * User: lxpfigo
 * Date: 2015/12/2
 * Time: 13:36
 * 模型基类
 */
class Model
{
    protected $link;

    public function __construct()
    {
        $this->link = new DBFactory();
    }

    public function findAll($sql)
    {
        return $this->link->findAll($sql);
    }

    public function findOne($sql)
    {
        return $this->link->findOne($sql);
    }

    public function count($sql)
    {
        return $this->link->count($sql);
    }

    public function add($sql)
    {
        return $this->link->add($sql);
    }

    public function del($sql)
    {
        return $this->link->del($sql);
    }

    public function save($sql)
    {
        return $this->link->save($sql);
    }


}