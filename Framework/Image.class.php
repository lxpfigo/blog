<?php
namespace Framework;
/**
 * Created by PhpStorm.
 * User: lxpfigo
 * Date: 2015/12/10
 * Time: 11:22
 * 图片类
 */
class Image
{
    private $oldFile;
    private $imageInfo;//图片信息
    private $imageW;//图片宽度
    private $imageH;//图片高度
    private $imageType;//图片类型
    private $imageInMemory;//内存中的图片
    private $status;
    private $url = '';
    private $error = array(
        'SUCCESS',
        '保存图片失败',
        '字体文件不存在',
        '创建目录失败',
        '水印图片不存在',
        '上传sae失败',
    );
    private $config = array(
        'w'=> '800',//压缩图片的默认最大宽
        'h'=> '120',//压缩图片的默认最大高.
        'fontSize'=> 10,
        'context'=> '© 2015 our-class.cn',//水印内容
        'color'=> array(225, 225, 225),//水印图片的颜色
        'pacity'=> 50,//透明度
        'font'=> __DIR__.'/./Sources/SourceCodePro-Medium.ttf',
        'x'=> '10',
        'y'=> '200',
        'angle'=> 0,
        'imageWater'=>__DIR__.'/./Sources/my.png',
        'path'=>'',//图片保存路径
    );
    public function __construct($file, $config = array())
    {
        $this->oldFile = $file;
        //判断传入的数组是否为空，如果不为空合并数组
        if (!empty($config) && is_array($config)) {
            $this->config = array_merge($this->config, $config);
        }
        /*是否传入了path key 如果有则组装路径，在阿帕奇所在目录下创建目录*/
        if (isset($config['path']) && !class_exists('SaeMysql')) {
            if (substr($config['path'], 0, 1) != '/') {
                $this->config['path'] = $_SERVER['DOCUMENT_ROOT'] . '/' . $this->config['path'];
            } else {
                $this->config['path'] = $_SERVER['DOCUMENT_ROOT'] . $this->config['path'];
            }
            $this->config['path'] = rtrim($this->config['path'], '/');
            //判断文件是否存在，不存在则创建，无法创建报错
            if (!is_dir($this->config['path'])) {
                if (!mkdir($this->config['path'], 077, true)) {
                    $this->status = $this->error[4];
                    return;
                }
            }
        }
        /*传入的字体文件是否存在，不存在返回错误*/
        if (!file_exists($this->config['font'])) {
            $this->status = $this->config[2];
            return;
        }


        $this->imageInfo = getimagesize($file);//得到图片信息
        $this->imageW = $this->imageInfo[0];//得到图片的宽度
        $this->imageH = $this->imageInfo[1];//得到图片的高度
        $this->imageType = image_type_to_extension($this->imageInfo[2], false);//得到图片的内容
        $fun = 'imagecreatefrom' . $this->imageType;
        $this->imageInMemory = $fun($file);
    }


        //压缩图片方法
        public function thumb()
        {
            /*如果要压缩的图片宽或高分别小于传入的宽高*/
            $thumbWidth = $this->imageW <= $this->config['w'] ? $this->imageW : $this->config['w'];
            $thumbHeight = $this->imageH <= $this->config['h'] ? $this->imageH : $this->config['h'];

            $scale = min($thumbWidth / $this->imageW, $thumbHeight / $this->imageH);
            /*等比例压缩
            *计算出需要压缩的宽高与原图片宽高比较，取小的比例制。
             *
            */
            $thumbWidth = $this->imageW * $scale;
            $thumbHeight = $this->imageH * $scale;

            $thumbImage = imagecreatetruecolor($thumbWidth, $thumbHeight);//生成空白的压缩图片
            $bgColor = imagecolorallocatealpha($thumbImage, 255, 255, 255, 0);//设置背景为全白，且不透明
            imagefill($thumbImage, 0, 0, $bgColor);//填充到画布中
            imagecopyresampled(
                $thumbImage,
                $this->imageInMemory,
                0, 0, 0, 0, $thumbWidth, $thumbHeight, $this->imageW, $this->imageH
            );

            $func = 'image' . $this->imageType;
            //判断是否传入路径，如果无路径为输出到浏览器，有路径表示保存
            if (empty($this->config['path'])) {
                header('Content-Type:' . $this->imageInfo['mime']);
                $status = $func($thumbImage);
            } else {
                if (class_exists('SaeMysql')) {
                        //在新浪sae下
                    $status = $this->UploadToSae($func, $thumbImage);
                }else {
                    $status = $func($thumbImage, $this->config['path'] . '/' . time() . '.' . $this->imageType);
                    $this->url = $this->config['path'] . '/'.date(Ymd). time() . '.' . $this->imageType;
                }

            }

            if ($status) {
                $this->status = $this->error[0];
            } else {
                $this->status = $this->error[1];
            }
            imagedestroy($thumbImage);
            imagedestroy($this->imageInMemory);
            return array(
                'status'=> $this->status,
                'url'=> $this->url,
            );
        }

    //添加文字水印
    public function textWater()
    {
        $color = imagecolorallocatealpha(
            $this->imageInMemory,
            $this->config['color'][0],
            $this->config['color'][1],
            $this->config['color'][2],
            $this->config['pacity']
        );
        imagettftext(
            $this->imageInMemory,
            $this->config['fontSize'],
            $this->config['angle'],
            $this->imageW - 160,
            $this->imageH - 10,//文字水印在图片的右下角
            $color,
            $this->config['font'],
            $this->config['context']
        );

        $func = 'image'.$this->imageType;
        if (empty($this->config['path'])) {
            header('Content-Type:'.$this->imageInfo['mime']);
            $status = $func($this->imageInMemory);
        } else {
            if (class_exists('SaeMysql')) {
                //在新浪sae下
                $status = $this->UploadToSae($func, $this->imageInMemory);
            }else {
            $status = $func($this->imageInMemory, $this->config['path'] . '/' . time() . '.' . $this->imageType);
            $this->url = $this->config['path'] . '/'.date(Ymd) . time() . '.' . $this->imageType;
            }

        }
        if ($status) {
            $this->status = $this->error[0];
        } else {
            $this->status = $this->error[1];
        }
        imagedestroy($this->imageInMemory);
        return array(
            'status'=> $this->status,
            'url'=> $this->url,
        );
    }
    //添加图片水印
    public function imgWater()
    {
        if (!file_exists($this->config['imageWater'])) {
            $this->status = $this->error[4];
            return;
        }
        $waterInfo = getimagesize($this->config['imageWater']);
        $waterType = image_type_to_extension($waterInfo[2], false);
        /*将水印图片写入内存*/
        $func = 'imagecreatefrom'.$waterType;
        $water = $func($this->config['imageWater']);
        //合并图片
        imagecopymerge(
            $this->imageInMemory,
            $water, 0, 0, 0, 0, $waterInfo[0], $waterInfo[1],
            $this->config['pacity']
        );
        imagedestroy($water);
        $func = 'image'.$this->imageType;
        if (empty($this->config['path'])) {
            header('Content-Type:'.$this->imageInfo['mime']);
            $status = $func($this->imageInMemory);
        } else {
            if (class_exists('SaeMysql')) {
                //在新浪sae下
                $status = $this->UploadToSae($func, $this->imageInMemory);
            }else {
                $status = $func($this->imageInMemory, $this->config['path'] . '/' . time() . '.' . $this->imageType);
                $this->url = $this->config['path'] . '/' .date(Ymd). time() . '.' . $this->imageType;
            }
        }
        if ($status) {
            $this->status = $this->error[0];
        } else {
            $this->status = $this->error[1];
        }
        imagedestroy($this->imageInMemory);
        return array(
            'status'=> $this->status,
            'url'=> $this->url,
        );
    }

    //新浪sae处理
    private function UploadToSae($func, $thumbImage)
    {
        //在新浪sae下
        $S = new \SaeStorage();
        $S->delete('lxpfigo', str_replace('http://atrs-lxpfigo.stor.sinaapp.com', '', $this->oldFile));
        ob_start();
        $func($thumbImage);
        $imageStr = ob_get_contents();
        $url = $S->write(
            'lxpfigo',
//            str_replace('http://atrs-lxpfigo.stor.sinaapp.com/', '', $this->oldFile),
            '/operate/'.date(Ymd).'/'.time().'.'.$this->imageType,
            $imageStr
        );
        ob_end_clean();
        if ($url) {
            $this->url = $url;
            return true;
        }else {
            $this->status = $this->error[5];
            return false;
        }
    }


}


