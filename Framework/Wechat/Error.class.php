<?php
namespace Framework\Wechat;
/**
 * Created by PhpStorm.
 * User: lxpfigo
 * Date: 2015/12/17
 * Time: 12:48
 */
class Error
{
    static public function isError($res)
    {
        if (!empty($res['errcode'])) {
            if ($res['errcode'] !== 0) {
                href('错误代码：'.$res['errcode'].' http://mp.weixin.qq.com/wiki/17/fa4e1434e57290788bde25603fa2fcbd.html点击查看错误');
                return true;
            }
        }
        return false;
    }
}