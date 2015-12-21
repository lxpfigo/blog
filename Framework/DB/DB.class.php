<?php
namespace Framework\DB;
/**
 * Created by PhpStorm.
 * User: lxpfigo
 * Date: 2015/12/2
 * Time: 13:38
 * 数据库单例模式
 */
class DB
{
    protected static $link;
    private function __construct()
    {
        $DBconfig = getConfig('DB');
        switch ($DBconfig['type']) {
            case 'mysql' :
                self::mysqlConnect($DBconfig);
                break;
            default :
                die('请设置数据库类型');
                break;
        }
    }

    /*返回数据库连接资源句柄*/
    public static function getInstance()
    {
        if (!self::$link) {
            new self;
        }
        return self::$link;
    }


    /*mysql初始化连接方法*/
    private static function mysqlConnect($DBconfig)
    {
        self::$link = new \mysqli($DBconfig['host'], $DBconfig['user'], $DBconfig['password'], $DBconfig['db'], $DBconfig['port']);
        try {
            if (self::$link->connect_errno) {
                throw new \Exception('数据库连接失败'.self::$link->connect_error);
            }
            if (!self::$link->set_charset($DBconfig['chartset'])) {
                throw new \Exception('数据库设置字符集出错');
            }
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }
}