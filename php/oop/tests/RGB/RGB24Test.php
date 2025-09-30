<?php

declare(strict_types=1);

namespace Tests\RGB;

use App\Models\RGB\RGB24;
use PHPUnit\Framework\TestCase;

class RGB24Test extends TestCase
{
    public function testConstructorWithRgbValues(): void
    {
        $color = new RGB24(0, 153, 255);
        $expected = 'The color is rgb(0,153,255). Hex: 099ff, binary: 1001100111111111';
        $this->assertEquals($expected, (string)$color);
    }

    public function testConstructorWithHexString(): void
    {
        $color = new RGB24('ff99cc');
        $expected = 'The color is rgb(255,153,204). Hex: ff99cc, binary: 111111111001100111001100';
        $this->assertEquals($expected, (string)$color);
    }

    public function testConstructorWithBinaryString(): void
    {
        $color = new RGB24('100110011111111100110011');
        $expected = 'The color is rgb(153,255,51). Hex: 99ff33, binary: 100110011111111100110011';
        $this->assertEquals($expected, (string)$color);
    }

    public function testConstructorWithInvalidString(): void
    {
        $color = new RGB24('invalid');
        $expected = 'The color is rgb(0,0,0). Hex: 000, binary: 0';
        $this->assertEquals($expected, (string)$color);
    }

    public function testSetColorsByHex(): void
    {
        $color = new RGB24(0, 0, 0);
        $color->setColorsByHex('7b7b7b');

        $expected = 'The color is rgb(123,123,123). Hex: 7b7b7b, binary: 11110110111101101111011';
        $this->assertEquals($expected, (string)$color);
    }

    public function testSetColorsByHexInvalidLength(): void
    {
        $color = new RGB24(255, 255, 255);
        $color->setColorsByHex('fff');

        $expected = 'The color is rgb(0,0,0). Hex: 000, binary: 0';
        $this->assertEquals($expected, (string)$color);
    }

    public function testSetColorsByBin(): void
    {
        $color = new RGB24(0, 0, 0);
        $color->setColorsByBin('111111110000000011111111');

        $expected = 'The color is rgb(255,0,255). Hex: ff0ff, binary: 11111111000011111111';
        $this->assertEquals($expected, (string)$color);
    }

    public function testSetColorsByBinInvalidLength(): void
    {
        $color = new RGB24(255, 255, 255);
        $color->setColorsByBin('11111111');

        $expected = 'The color is rgb(0,0,0). Hex: 000, binary: 0';
        $this->assertEquals($expected, (string)$color);
    }

    public function testSetAsBlack(): void
    {
        $color = new RGB24(255, 255, 255);
        $color->setAsBlack();

        $expected = 'The color is rgb(0,0,0). Hex: 000, binary: 0';
        $this->assertEquals($expected, (string)$color);
    }

    public function testGetHex(): void
    {
        $color = new RGB24(255, 153, 204);
        $this->assertEquals('ff99cc', $color->getHex());

        $color2 = new RGB24(0, 0, 0);
        $this->assertEquals('000', $color2->getHex());

        $color3 = new RGB24(123, 123, 123);
        $this->assertEquals('7b7b7b', $color3->getHex());

        // Java版と同じく、0埋めなしの16進数表現
        $color4 = new RGB24(0, 153, 255);
        $this->assertEquals('099ff', $color4->getHex());
    }

    public function testGetBits(): void
    {
        // Java版のInteger.toBinaryString()は先頭の0を削除する
        $color = new RGB24(255, 0, 255);
        $this->assertEquals('11111111000011111111', $color->getBits());

        $color2 = new RGB24(0, 0, 0);
        $this->assertEquals('0', $color2->getBits());

        $color3 = new RGB24(153, 255, 51);
        $this->assertEquals('100110011111111100110011', $color3->getBits());

        // より小さい値のテスト
        $color4 = new RGB24(0, 153, 255);
        $this->assertEquals('1001100111111111', $color4->getBits());
    }

    /**
     * getColorShade()メソッドのテスト - 赤が最大の場合
     */
    public function testGetColorShadeRed(): void
    {
        $color = new RGB24(255, 100, 50);
        $this->assertEquals('red', $color->getColorShade());
    }

    /**
     * getColorShade()メソッドのテスト - 緑が最大の場合
     */
    public function testGetColorShadeGreen(): void
    {
        $color = new RGB24(50, 255, 100);
        $this->assertEquals('green', $color->getColorShade());
    }

    /**
     * getColorShade()メソッドのテスト - 青が最大の場合
     */
    public function testGetColorShadeBlue(): void
    {
        $color = new RGB24(50, 100, 255);
        $this->assertEquals('blue', $color->getColorShade());
    }

    /**
     * getColorShade()メソッドのテスト - グレースケールの場合
     */
    public function testGetColorShadeGreyscale(): void
    {
        $color = new RGB24(123, 123, 123);
        $this->assertEquals('greyscale', $color->getColorShade());

        $black = new RGB24(0, 0, 0);
        $this->assertEquals('greyscale', $black->getColorShade());

        $white = new RGB24(255, 255, 255);
        $this->assertEquals('greyscale', $white->getColorShade());
    }

    public function testToString(): void
    {
        $color = new RGB24(0, 153, 255);
        $expected = 'The color is rgb(0,153,255). Hex: 099ff, binary: 1001100111111111';
        $this->assertEquals($expected, (string)$color);

        $color2 = new RGB24('ff99cc');
        $expected2 = 'The color is rgb(255,153,204). Hex: ff99cc, binary: 111111111001100111001100';
        $this->assertEquals($expected2, (string)$color2);

        $color3 = new RGB24(0, 0, 0);
        $expected3 = 'The color is rgb(0,0,0). Hex: 000, binary: 0';
        $this->assertEquals($expected3, (string)$color3);
    }
}
