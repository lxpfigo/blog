<?php
namespace Framework;
/**
 * Created by PhpStorm.
 * User: lxpfigo
 * Date: 2015/12/9
 * Time: 12:24
 * 上传类
 */
class Upload
{
    static private $path;
    static private $file;//上传的文件
    static private $oldName;//客户端机器原文件名
    static private $type;//文件类型
    static private $size;//文件大小
    static private $tmpName;//临时文件名
    static private $error;//错误代码
    static private $status;//文件上传状态
    private static $ERROR = array(
        //文件状态说明
        'SUCCESS',//文件上传成功
        '文件不存在',
        '文件大小超过限制',
        '文件不是通过post传送的',
        '不允许上传的文件类型',
        '目录创建失败',
        '目录不可写',
        '移动文件失败',
    );
    //配置文件
    static private $config = array(
        'maxSize'=> '2048000',
        'allowType'=>array('jpg', 'gif', 'png','jpeg'),
    );
    public function __construct($file, $path, $config = array())
    {
        self::$config = array_merge(self::$config, $config);
        self::$file = $_FILES[$file];
        self::$path = $path;
    }

    private static function upFile()
    {
        if (!self::$file) {
            //不存在上传的文件
            self::$status = self::$ERROR[1];
            return;
        }

        self::$error = self::$file['error'];
        if (self::$error) {
            //上传有错误id返回
            self::error(self::$error);
            return;
        }

        //上传文件是否小于配置文件大小
        self::$size = self::$file['size'];
        if (self::$size > self::$config['maxSize']) {
            self::$status = self::$ERROR[2];
            return;
        }

        //是否为上传文件
        self::$tmpName = self::$file['tmp_name'];
        if (!is_uploaded_file(self::$tmpName)) {
            self::$status = self::$ERROR[3];
            return;
        }
        self::$type = self::$file['type'];
        $type = explode('/', self::$type);
        $suffix = $type[count($type) - 1];
        if (!in_array($suffix, self::$config['allowType'])) {
            self::$status = self::$ERROR[4];
            return;
        }
        self::$oldName = self::$file['name'];
        //得到随机文件名
        $fileName = explode('.', self::$oldName);
        $fileName = time()  . '.' . $suffix;
        if (substr(self::$path, 0, 1) != '/') {
            self::$path = '/' . self::$path;
        }
        $data = date('Ymd');

        //sae下
        if (class_exists('SaeMysql')) {
            $fullName = self::$path . '/' . $data . '/' . $fileName;
            $s = new \SaeStorage();
            $dir=$s->upload('lxpfigo', $fullName, self::$tmpName);
            if ($dir) {
                self::$path = $dir;
                self::$status = self::$ERROR[0];
            }else {
                self::$status = self::$ERROR[7];
                return;
            }
        }else {
            $fullName = $_SERVER['DOCUMENT_ROOT'] . self::$path . '/' . $data . '/' . $fileName;
            if (!file_exists(dirname($fullName)) && !mkdir(dirname($fullName), 0777, true)) {
                self::$status = self::$ERROR[5];
                return;
            } else if (!is_writeable(dirname($fullName))) {
                self::$status = self::$ERROR[6];
                return;
            }
            //移动文件
            if (!(move_uploaded_file(self::$tmpName, $fullName) && file_exists($fullName))) { //移动失败
                self::$status = self::$ERROR[7];
                return;
            } else { //移动成功
                self::$path = $fullName;
                self::$status = self::$ERROR[0];
                return;
            }
        }

    }



    static private function error($num)
    {
        switch ( $num ) {
            case 1 :
                self::$status = '上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值';
                break;
            case 2 :
                self::$status = '上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值';
                break;
            case 3 :
                self::$status = '文件只有部分被上传';
                break;
            case 4 :
                self::$status = '没有文件被上传';
                break;
            case 7 :
                self::$status = '文件写入失败';
                break;
            case 6 :
                self::$status = '找不到临时文件夹';
                break;
        }
    }


    public function getFileInfo()
    {
        self::upFile();
        return array(
            'status'=> self::$status,
            'url' => self::$path,
        );
    }
}