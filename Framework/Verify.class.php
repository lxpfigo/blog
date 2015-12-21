<?php
namespace Framework;
/**
 * Created by PhpStorm.
 * User: lxpfigo
 * Date: 2015/12/4
 * Time: 15:08
 * 验证码
 */
class Verify
{
    /*默认验证码4位，画布宽120高40，字体大小16，点400个，线5条*/
    private $config = array(
        'lenght'=> '4',
        'width'=> '120',
        'height'=> '40',
        'fontsize'=> '16',
        'fontfile'=> __DIR__.'/./Sources/SourceCodePro-Medium.ttf',
        'point'=> '400',
        'line'=> '5',
    );
    public function __construct($dataArr = array())
    {
        if (!empty($dataArr)) {
            $this->config = array_merge($this->config, $dataArr);
        }
    }

    public function getVerify()
    {
        //创建画布
        $img = imagecreatetruecolor($this->config['width'], $this->config['height']);
        //设置背景颜色
        $bgColor = imagecolorallocate($img, 255, 255, 255);
        imagefill($img, 0, 0, $bgColor);
        $_x = ceil(($this->config['width'] - 20) / $this->config['lenght']);
        $code = '';
        //写入验证码
        for ($i = 0; $i < $this->config['lenght']; $i++) {
            $str = random();
            $code .= $str;
            $x = 10 + $i * $_x;
            $fontSize = mt_rand($this->config['fontsize'] - 10 , $this->config['fontsize']);
            $fontH = imagefontheight($this->config['fontsize']);
            $y = mt_rand($fontH + 10, $this->config['height'] - 5);
            $fontColor = imagecolorallocate($img, mt_rand(0,200), mt_rand(0,200), mt_rand(0,200));
            imagettftext($img, $fontSize, 0, $x, $y, $fontColor, $this->config['fontfile'], $str);
        }
        //增加干扰点
        for ($i = 0; $i < $this->config['point']; $i++){
            $pointColor = imagecolorallocate($img, rand(150, 200), rand(150, 200), rand(100, 200));
            imagesetpixel($img,mt_rand(1, $this->config['width']), mt_rand(1, $this->config['height']), $pointColor);
        }

        //增加线干扰
        for ($i = 0; $i < $this->config['line']; $i++) {
            $linColor = imagecolorallocate($img, rand(0, 200), rand(0, 200), rand(0, 200));
            imageline($img, rand(0, $this->config['width']), rand(0, $this->config['height']), rand(0, $this->config['width']), rand(0, $this->config['height']), $linColor);
        }
        $_SESSION['Verify'] = md5(strtoupper($code));
        header('Content-type: image/png');
        imagepng($img);
        imagedestroy($img);
    }
}