<?php

declare(strict_types=1);

namespace Tests\RGB;

use PHPUnit\Framework\TestCase;
use App\Models\Rgb\RGB24;

class RGB24Test extends TestCase
{
    /**
     * RGB値を直接指定するコンストラクタのテスト
     */
    public function testConstructorWithRgbValues(): void
    {
        $color = new RGB24(0, 153, 255);

        $this->assertEquals(0, $color->getRed());
        $this->assertEquals(153, $color->getGreen());
        $this->assertEquals(255, $color->getBlue());
    }

    /**
     * 16進数文字列コンストラクタのテスト
     */
    public function testConstructorWithHexString(): void
    {
        $color = new RGB24("ff99cc");

        $this->assertEquals(255, $color->getRed());
        $this->assertEquals(153, $color->getGreen());
        $this->assertEquals(204, $color->getBlue());
    }

    /**
     * 2進数文字列コンストラクタのテスト
     */
    public function testConstructorWithBinaryString(): void
    {
        $color = new RGB24("100110011111111100110011");

        $this->assertEquals(153, $color->getRed());
        $this->assertEquals(255, $color->getGreen());
        $this->assertEquals(51, $color->getBlue());
    }

    /**
     * 無効な文字列長の場合は黒に設定されることのテスト
     */
    public function testConstructorWithInvalidString(): void
    {
        $color = new RGB24("invalid");

        $this->assertEquals(0, $color->getRed());
        $this->assertEquals(0, $color->getGreen());
        $this->assertEquals(0, $color->getBlue());
    }

    /**
     * setColorsByHex()メソッドのテスト
     */
    public function testSetColorsByHex(): void
    {
        $color = new RGB24(0, 0, 0);
        $color->setColorsByHex("7b7b7b");

        $this->assertEquals(123, $color->getRed());
        $this->assertEquals(123, $color->getGreen());
        $this->assertEquals(123, $color->getBlue());
    }

    /**
     * setColorsByHex()で無効な長さの場合のテスト
     */
    public function testSetColorsByHexInvalidLength(): void
    {
        $color = new RGB24(255, 255, 255);
        $color->setColorsByHex("fff");

        $this->assertEquals(0, $color->getRed());
        $this->assertEquals(0, $color->getGreen());
        $this->assertEquals(0, $color->getBlue());
    }

    /**
     * setColorsByBin()メソッドのテスト
     */
    public function testSetColorsByBin(): void
    {
        $color = new RGB24(0, 0, 0);
        $color->setColorsByBin("111111110000000011111111");

        $this->assertEquals(255, $color->getRed());
        $this->assertEquals(0, $color->getGreen());
        $this->assertEquals(255, $color->getBlue());
    }

    /**
     * setColorsByBin()で無効な長さの場合のテスト
     */
    public function testSetColorsByBinInvalidLength(): void
    {
        $color = new RGB24(255, 255, 255);
        $color->setColorsByBin("11111111");

        $this->assertEquals(0, $color->getRed());
        $this->assertEquals(0, $color->getGreen());
        $this->assertEquals(0, $color->getBlue());
    }

    /**
     * setAsBlack()メソッドのテスト
     */
    public function testSetAsBlack(): void
    {
        $color = new RGB24(255, 255, 255);
        $color->setAsBlack();

        $this->assertEquals(0, $color->getRed());
        $this->assertEquals(0, $color->getGreen());
        $this->assertEquals(0, $color->getBlue());
    }

    public function testGetHex(): void
    {
        $color = new RGB24(255, 153, 204);
        $this->assertEquals("ff99cc", $color->getHex());
        
        $color2 = new RGB24(0, 0, 0);
        $this->assertEquals("000", $color2->getHex());
        
        $color3 = new RGB24(123, 123, 123);
        $this->assertEquals("7b7b7b", $color3->getHex());
        
        // Java版と同じく、0埋めなしの16進数表現
        $color4 = new RGB24(0, 153, 255);
        $this->assertEquals("099ff", $color4->getHex());
    }

    public function testGetBits(): void
    {
        // Java版のInteger.toBinaryString()は先頭の0を削除する
        $color = new RGB24(255, 0, 255);
        $this->assertEquals("11111111000011111111", $color->getBits());
        
        $color2 = new RGB24(0, 0, 0);
        $this->assertEquals("0", $color2->getBits());
        
        $color3 = new RGB24(153, 255, 51);
        $this->assertEquals("100110011111111100110011", $color3->getBits());
        
        // より小さい値のテスト
        $color4 = new RGB24(0, 153, 255);
        $this->assertEquals("1001100111111111", $color4->getBits());
    }

    /**
     * getColorShade()メソッドのテスト - 赤が最大の場合
     */
    public function testGetColorShadeRed(): void
    {
        $color = new RGB24(255, 100, 50);
        $this->assertEquals("red", $color->getColorShade());
    }

    /**
     * getColorShade()メソッドのテスト - 緑が最大の場合
     */
    public function testGetColorShadeGreen(): void
    {
        $color = new RGB24(50, 255, 100);
        $this->assertEquals("green", $color->getColorShade());
    }

    /**
     * getColorShade()メソッドのテスト - 青が最大の場合
     */
    public function testGetColorShadeBlue(): void
    {
        $color = new RGB24(50, 100, 255);
        $this->assertEquals("blue", $color->getColorShade());
    }

    /**
     * getColorShade()メソッドのテスト - グレースケールの場合
     */
    public function testGetColorShadeGreyscale(): void
    {
        $color = new RGB24(123, 123, 123);
        $this->assertEquals("greyscale", $color->getColorShade());

        $black = new RGB24(0, 0, 0);
        $this->assertEquals("greyscale", $black->getColorShade());

        $white = new RGB24(255, 255, 255);
        $this->assertEquals("greyscale", $white->getColorShade());
    }

    public function testToString(): void
    {
        $color = new RGB24(0, 153, 255);
        $expected = "The color is rgb(0,153,255). Hex: 099ff, binary: 1001100111111111";
        $this->assertEquals($expected, (string)$color);
        
        $color2 = new RGB24("ff99cc");
        $expected2 = "The color is rgb(255,153,204). Hex: ff99cc, binary: 111111111001100111001100";
        $this->assertEquals($expected2, (string)$color2);
        
        $color3 = new RGB24(0, 0, 0);
        $expected3 = "The color is rgb(0,0,0). Hex: 000, binary: 0";
        $this->assertEquals($expected3, (string)$color3);
    }

    public function testJavaExamples(): void
    {
        // RGB値で色を作成
        $color1 = new RGB24(0, 153, 255);
        $this->assertEquals("099ff", $color1->getHex());
        
        // 16進数で色を作成 rgb(255, 153, 204)
        $color2 = new RGB24("ff99cc");
        $this->assertEquals(255, $color2->getRed());
        $this->assertEquals(153, $color2->getGreen());
        $this->assertEquals(204, $color2->getBlue());
        
        // 2進数で色を作成 rgb(153, 255, 51)
        $color3 = new RGB24("100110011111111100110011");
        $this->assertEquals(153, $color3->getRed());
        $this->assertEquals(255, $color3->getGreen());
        $this->assertEquals(51, $color3->getBlue());
        
        // 16進数で色を作成 rgb(123, 123, 123)
        $grey = new RGB24("7b7b7b");
        $this->assertEquals(123, $grey->getRed());
        $this->assertEquals(123, $grey->getGreen());
        $this->assertEquals(123, $grey->getBlue());
        $this->assertEquals("greyscale", $grey->getColorShade());
        
        // Javaのコメント例と同じ動作確認
        echo "Color1: " . $color1 . "\n";
        echo "Color2: " . $color2 . "\n";
        echo "Color3: " . $color3 . "\n";
        echo "Grey: " . $grey . "\n";
    }
}
