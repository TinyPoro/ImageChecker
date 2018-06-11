<?php
/**
 * Created by PhpStorm.
 * User: tun
 * Date: 6/9/18
 * Time: 9:50 AM
 */

namespace Poro\Image_Checker;



class ImageChecker
{
    public $ver;
    public $path;

    public function __construct($path , $src = null){
        if($src){
            $this->path = $this->download($src);
        }else $this->path = $path;

        $this->getVer();
    }

    public function download($url){
        $input_dir = env('IMAGE_STORAGE', '/home/'.get_current_user().'/Pictures');
        $ext = pathinfo($url, PATHINFO_EXTENSION);

        $path = $input_dir."/".str_random(10).".$ext";

        try{
            file_put_contents($path, file_get_contents($url));
        }catch (\Exception $e){
            return '';
        }

        chmod($path, 0777);

        return $path;
    }

    public function getVer(){
        /* Open the image file in binary mode */
        if(!$fp = fopen ($this->path, 'rb')) return 0;

        /* Read 20 bytes from the top of the file */
        if(!$data = fread ($fp, 20)) return 0;

        /* Create a format specifier */
        $header_format = 'A6version';  # Get the first 6 bytes

        /* Unpack the header data */
        $header = unpack ($header_format, $data);

        $this->ver = bin2hex($header['version']);
    }

    public function detectFormat(){
        if($this->isGIF()) return 'GIF';
        if($this->isJPG()) return 'JPG';
        if($this->isPNG()) return 'PNG';
        if($this->isBMP()) return 'BMP';
        if($this->isTIFF()) return 'TIFF';

        return 'not support';
    }

    public function isGIF(){
        return !(mb_strpos($this->ver, '474946') === false);
    }

    public function isBMP(){
        return !(mb_strpos($this->ver, '424d') === false);
    }

    public function isPNG(){
        return !(mb_strpos($this->ver, '504e47') === false);
    }

    public function isJPG(){
        return !(mb_strpos($this->ver, 'ffd8') === false);
    }

    public function isTIFF(){
        return !(mb_strpos($this->ver, '492049') === false && mb_strpos($this->ver, '49492A00') === false && mb_strpos($this->ver, '4d4d00') === false);
    }
}