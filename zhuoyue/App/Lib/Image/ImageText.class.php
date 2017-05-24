<?php
/**
 * 图片处理驱动类，可配置图片处理库
 * 目前支持GD库和imagick
 */
class ImageText{
    /* 驱动相关常量定义 */
    const IMAGE_GD              =   1; //常量，标识GD库类型
    const IMAGE_IMAGICK         =   2; //常量，标识imagick库类型

    /* 缩略图相关常量定义 */
    const IMAGE_THUMB_SCALE     =   1 ; //常量，标识缩略图等比例缩放类型
    const IMAGE_THUMB_FILLED    =   2 ; //常量，标识缩略图缩放后填充类型
    const IMAGE_THUMB_CENTER    =   3 ; //常量，标识缩略图居中裁剪类型
    const IMAGE_THUMB_NORTHWEST =   4 ; //常量，标识缩略图左上角裁剪类型
    const IMAGE_THUMB_SOUTHEAST =   5 ; //常量，标识缩略图右下角裁剪类型
    const IMAGE_THUMB_FIXED     =   6 ; //常量，标识缩略图固定尺寸缩放类型

    /* 水印相关常量定义 */
    const IMAGE_WATER_NORTHWEST =   1 ; //常量，标识左上角水印
    const IMAGE_WATER_NORTH     =   2 ; //常量，标识上居中水印
    const IMAGE_WATER_NORTHEAST =   3 ; //常量，标识右上角水印
    const IMAGE_WATER_WEST      =   4 ; //常量，标识左居中水印
    const IMAGE_WATER_CENTER    =   5 ; //常量，标识居中水印
    const IMAGE_WATER_EAST      =   6 ; //常量，标识右居中水印
    const IMAGE_WATER_SOUTHWEST =   7 ; //常量，标识左下角水印
    const IMAGE_WATER_SOUTH     =   8 ; //常量，标识下居中水印
    const IMAGE_WATER_SOUTHEAST =   9 ; //常量，标识右下角水印

    /**
     * 图片资源
     * @var resource
     */
    private $img;

    /**
     * 打开一幅图像
     * @param  string $imgname 图片路径
     * @return Object          当前图片处理库对象
     */
    public function open($imgname){
        //检测图像文件
        if(!is_file($imgname)) die('不存在的图像文件');

        //获取图像信息
        $info = getimagesize($imgname);

        //检测图像合法性
        if(false === $info || (IMAGETYPE_GIF === $info[2] && empty($info['bits']))){
            die('非法图像文件');
        }

        //设置图像信息
        $this->info = array(
            'width'  => $info[0],
            'height' => $info[1],
            'type'   => image_type_to_extension($info[2], false),
            'mime'   => $info['mime'],
        );

        //销毁已存在的图像
        empty($this->img) || imagedestroy($this->img);

        //打开图像
            $fun = "imagecreatefrom{$this->info['type']}";
            $this->img = $fun($imgname);
    }
    /**
     * 保存图片
     * @param  string  $imgname   图片保存名称
     * @param  string  $type      图片类型
     * @param  integer $quality   图像质量
     * @param  boolean $interlace 是否对JPEG类型图片设置隔行扫描
     * @return Object             当前图片处理库对象
     */
    public function save($imgname, $type = null, $quality=80,$interlace = true){
        if(empty($this->img)) die('没有可以被保存的图像资源');

        //自动获取图像类型
        if(is_null($type)){
            $type = $this->info['type'];
        } else {
            $type = strtolower($type);
        }
        //保存图像
        if('jpeg' == $type || 'jpg' == $type){
            //JPEG图像设置隔行扫描
            imageinterlace($this->img, $interlace);
            imagejpeg($this->img, $imgname,$quality);
        }elseif('gif' == $type && !empty($this->gif)){
            $this->gif->save($imgname);
        }else{
            $fun  =   'image'.$type;
            $fun($this->img, $imgname);
        }
    }
    public function text($text, $font, $size, $color = '#00000000',
                         $locate = self::IMAGE_WATER_SOUTHEAST, $offset = 0, $angle = 0){
        //资源检测
        if(empty($this->img)) die('没有可以被写入文字的图像资源');
        if(!is_file($font)) die("不存在的字体文件：{$font}");

        //获取文字信息
        $info = imagettfbbox($size, $angle, $font, $text);
        $minx = min($info[0], $info[2], $info[4], $info[6]);
        $maxx = max($info[0], $info[2], $info[4], $info[6]);
        $miny = min($info[1], $info[3], $info[5], $info[7]);
        $maxy = max($info[1], $info[3], $info[5], $info[7]);

        /* 计算文字初始坐标和尺寸 */
        $x = $minx;
        $y = abs($miny);
        $w = $maxx - $minx;
        $h = $maxy - $miny;

        /* 设定文字位置 */
        switch ($locate) {
            /* 右下角文字 */
            case self::IMAGE_WATER_SOUTHEAST:
                $x += $this->info['width']  - $w;
                $y += $this->info['height'] - $h;
                break;

            /* 左下角文字 */
            case self::IMAGE_WATER_SOUTHWEST:
                $y += $this->info['height'] - $h;
                break;

            /* 左上角文字 */
            case self::IMAGE_WATER_NORTHWEST:
                // 起始坐标即为左上角坐标，无需调整
                break;

            /* 右上角文字 */
            case self::IMAGE_WATER_NORTHEAST:
                $x += $this->info['width'] - $w;
                break;

            /* 居中文字 */
            case self::IMAGE_WATER_CENTER:
                $x += ($this->info['width']  - $w)/2;
                $y += ($this->info['height'] - $h)/2;
                break;

            /* 下居中文字 */
            case self::IMAGE_WATER_SOUTH:
                $x += ($this->info['width'] - $w)/2;
                $y += $this->info['height'] - $h;
                break;

            /* 右居中文字 */
            case self::IMAGE_WATER_EAST:
                $x += $this->info['width'] - $w;
                $y += ($this->info['height'] - $h)/2;
                break;

            /* 上居中文字 */
            case self::IMAGE_WATER_NORTH:
                $x += ($this->info['width'] - $w)/2;
                break;

            /* 左居中文字 */
            case self::IMAGE_WATER_WEST:
                $y += ($this->info['height'] - $h)/2;
                break;

            default:
                /* 自定义文字坐标 */
                if(is_array($locate)){
                    list($posx, $posy) = $locate;
                    $x += $posx;
                    $y += $posy;
                } else {
                    die('不支持的文字位置类型');
                }
        }

        /* 设置偏移量 */
        if(is_array($offset)){
            $offset = array_map('intval', $offset);
            list($ox, $oy) = $offset;
        } else{
            $offset = intval($offset);
            $ox = $oy = $offset;
        }

        /* 设置颜色 */
        if(is_string($color) && 0 === strpos($color, '#')){
            $color = str_split(substr($color, 1), 2);
            $color = array_map('hexdec', $color);
            if(empty($color[3]) || $color[3] > 127){
                $color[3] = 0;
            }
        } elseif (!is_array($color)) {
            die('错误的颜色值');
        }
            /* 写入文字 */
            $col = imagecolorallocatealpha($this->img, $color[0], $color[1], $color[2], $color[3]);
            imagettftext($this->img, $size, $angle, $x + $ox, $y + $oy, $col, $font, $text);
    }
}