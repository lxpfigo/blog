<?php
/**
 * Created by PhpStorm.
 * User: lxpfigo
 * Date: 2015/12/1
 * Time: 15:08
 */
function getConfig($key)
{
    return $GLOBALS['config'][$key];
}
function dump($data)
{
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
}
//获取客户端IP地址
function get_client_ip($type = 0,$adv=false) {
    $type       =  $type ? 1 : 0;
    static $ip  =   NULL;
    if ($ip !== NULL) return $ip[$type];
    if($adv){
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $arr    =   explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $pos    =   array_search('unknown',$arr);
            if(false !== $pos) unset($arr[$pos]);
            $ip     =   trim($arr[0]);
        }elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip     =   $_SERVER['HTTP_CLIENT_IP'];
        }elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ip     =   $_SERVER['REMOTE_ADDR'];
        }
    }elseif (isset($_SERVER['REMOTE_ADDR'])) {
        $ip     =   $_SERVER['REMOTE_ADDR'];
    }
    // IP地址合法验证
    $long = sprintf("%u",ip2long($ip));
    $ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
    return $ip[$type];
}

//对非法方法进行转义
function doSafe($str)
{
    return (!get_magic_quotes_gpc()) ? addslashes($str) : $str;
}

//跳转方法
function href($str, $num = 1)
{
    echo '<script>alert("'.$str.'")</script>';
    if ($num == 1) {
        echo "<script>window.history.go(-1)</script>";
    }else {
        echo "<script>window.history.go(-2)</script>";
    }

}

//弹屏提示
function alert($str)
{
    echo '<script>alert("'.$str.'")</script>';
}


    /*
     * 得到一个随机数
     */
function random()
{
    $code = '';
    $str = '23456789abcdefghjkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ';
    $code .= $str[mt_rand(0, strlen($str) - 1)];
    return $code;
}


