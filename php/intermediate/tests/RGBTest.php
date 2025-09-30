<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../RGB.php';

class RGBTest extends TestCase
{
    public function testGetHexCode()
    {
        $color1 = new RGB(0, 153, 255);
        $this->assertEquals('#0099ff', $color1->getHexCode());

        $color2 = new RGB(255, 255, 204);
        $this->assertEquals('#ffffcc', $color2->getHexCode());

        $color3 = new RGB(0, 87, 0);
        $this->assertEquals('#005700', $color3->getHexCode());

        $gray = new RGB(123, 123, 123);
        $this->assertEquals('#7b7b7b', $gray->getHexCode());
    }

    public function testGetBits()
    {
        $color1 = new RGB(0, 153, 255);
        $this->assertEquals('1001100111111111', $color1->getBits());

        $color2 = new RGB(255, 255, 204);
        $this->assertEquals('111111111111111111001100', $color2->getBits());

        $color3 = new RGB(0, 87, 0);
        $this->assertEquals('101011100000000', $color3->getBits());

        $gray = new RGB(123, 123, 123);
        $this->assertEquals('11110110111101101111011', $gray->getBits());
    }

    public function testGetBitsLogic()
    {
        $color1 = new RGB(0, 153, 255);
        $this->assertEquals('1001100111111111', $color1->getBitsLogic());

        $color2 = new RGB(255, 255, 204);
        $this->assertEquals('111111111111111111001100', $color2->getBitsLogic());

        $color3 = new RGB(0, 87, 0);
        $this->assertEquals('101011100000000', $color3->getBitsLogic());

        $gray = new RGB(123, 123, 123);
        $this->assertEquals('11110110111101101111011', $gray->getBitsLogic());
    }

    public function testGetColorShade()
    {
        $color1 = new RGB(0, 153, 255);
        $this->assertEquals('blue', $color1->getColorShade());

        $color2 = new RGB(255, 255, 204);
        $this->assertEquals('red', $color2->getColorShade());

        $color3 = new RGB(0, 87, 0);
        $this->assertEquals('green', $color3->getColorShade());

        $gray = new RGB(123, 123, 123);
        $this->assertEquals('grayscale', $gray->getColorShade());
    }
}

// 実行方法
// php vendor/bin/phpunit --testdox tests/RGBTest.php