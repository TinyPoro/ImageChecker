<?php
/**
 * Created by PhpStorm.
 * User: tun
 * Date: 6/11/18
 * Time: 9:12 AM
 */

use PHPUnit\Framework\TestCase;

class ImageCheckerTest extends TestCase
{
    public function testDetectFormat(){
        $image_check  = new \Poro\Image_Checker\ImageChecker('http://www.codediesel.com/wp-content/uploads/2010/09/winhex.gif');
        $this->assertSame('GIF', $image_check->detectFormat());

        $image_check  = new \Poro\Image_Checker\ImageChecker('https://secure.gravatar.com/avatar/fa9df688ce1e6ff39052faa763e839ff?s=60&d=mm&r=g');
        $this->assertSame('PNG', $image_check->detectFormat());
    }

    public function testCheckFormat(){
        $image_check  = new \Poro\Image_Checker\ImageChecker('http://www.codediesel.com/wp-content/uploads/2010/09/winhex.gif');
        $this->assertSame(true, $image_check->isGIF());
        $this->assertSame(false, $image_check->isTIFF());
        $this->assertSame(false, $image_check->isBMP());
        $this->assertSame(false, $image_check->isJPG());
        $this->assertSame(false, $image_check->isPNG());

        $image_check  = new \Poro\Image_Checker\ImageChecker('https://secure.gravatar.com/avatar/fa9df688ce1e6ff39052faa763e839ff?s=60&d=mm&r=g');
        $this->assertSame(false, $image_check->isGIF());
        $this->assertSame(false, $image_check->isTIFF());
        $this->assertSame(false, $image_check->isBMP());
        $this->assertSame(false, $image_check->isJPG());
        $this->assertSame(true, $image_check->isPNG());

    }
}