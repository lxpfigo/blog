<?php
namespace App\Home\Model;
use Framework\Model;

/**
 * Created by PhpStorm.
 * User: lxpfigo
 * Date: 2015/12/3
 * Time: 13:01
 */
class LinkModel extends Model
{
    public function getLink()
    {
        $sql = 'select * from web_link';
        return $this->findAll($sql);
    }
}