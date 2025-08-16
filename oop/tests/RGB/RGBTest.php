<?php

namespace Tests\RGB;

use PHPUnit\Framework\TestCase;
use App\Models\Rgb\RGB;

class RGBTest extends TestCase
{
    /**
     * @test
     * Given: RGB色成分値が指定される
     * When: RGBオブジェクトを作成する
     * Then: 正しい色成分値が設定される
     */
    public function testRGBConstruction()
    {
        $rgb = new RGB(255, 128, 0);

        $this->assertEquals(255, $rgb->getRed());
        $this->assertEquals(128, $rgb->getGreen());
        $this->assertEquals(0, $rgb->getBlue());
    }

    /**
     * @test
     * Given: RGBオブジェクトが存在する
     * When: 16進数文字列を取得する
     * Then: 正しい16進数表現が返される
     */
    public function testToHex()
    {
        $rgb = new RGB(255, 128, 0);
        $this->assertEquals('#FF8000', $rgb->toHex());

        $rgb2 = new RGB(0, 0, 0);
        $this->assertEquals('#000000', $rgb2->toHex());

        $rgb3 = new RGB(255, 255, 255);
        $this->assertEquals('#FFFFFF', $rgb3->toHex());
    }

    /**
     * @test
     * Given: RGBオブジェクトが存在する
     * When: 文字列表現を取得する
     * Then: "rgb(r, g, b)"形式の文字列が返される
     */
    public function testToString()
    {
        $rgb = new RGB(255, 128, 0);
        $this->assertEquals('rgb(255, 128, 0)', (string)$rgb);
    }

    /**
     * @test
     * Given: 2つのRGBオブジェクトが存在する
     * When: 色成分を加算する
     * Then: 新しいRGBオブジェクトが返され、元のオブジェクトは変更されない
     */
    public function testAdd()
    {
        $rgb1 = new RGB(100, 50, 25);
        $rgb2 = new RGB(50, 100, 150);

        $result = $rgb1->add($rgb2);

        $this->assertEquals(150, $result->getRed());
        $this->assertEquals(150, $result->getGreen());
        $this->assertEquals(175, $result->getBlue());

        // 元のオブジェクトは変更されない
        $this->assertEquals(100, $rgb1->getRed());
        $this->assertEquals(50, $rgb1->getGreen());
        $this->assertEquals(25, $rgb1->getBlue());
    }

    /**
     * @test
     * Given: 加算結果が255を超える場合
     * When: 色成分を加算する
     * Then: 値は255に制限される
     */
    public function testAddWithOverflow()
    {
        $rgb1 = new RGB(200, 200, 200);
        $rgb2 = new RGB(100, 100, 100);

        $result = $rgb1->add($rgb2);

        $this->assertEquals(255, $result->getRed());
        $this->assertEquals(255, $result->getGreen());
        $this->assertEquals(255, $result->getBlue());
    }

    /**
     * @test
     * Given: 2つのRGBオブジェクトが存在する
     * When: 色成分を減算する
     * Then: 新しいRGBオブジェクトが返され、負の値は0に制限される
     */
    public function testSubtract()
    {
        $rgb1 = new RGB(150, 100, 75);
        $rgb2 = new RGB(50, 50, 50);

        $result = $rgb1->subtract($rgb2);

        $this->assertEquals(100, $result->getRed());
        $this->assertEquals(50, $result->getGreen());
        $this->assertEquals(25, $result->getBlue());
    }

    /**
     * @test
     * Given: 減算結果が負になる場合
     * When: 色成分を減算する
     * Then: 値は0に制限される
     */
    public function testSubtractWithUnderflow()
    {
        $rgb1 = new RGB(50, 30, 10);
        $rgb2 = new RGB(100, 50, 20);

        $result = $rgb1->subtract($rgb2);

        $this->assertEquals(0, $result->getRed());
        $this->assertEquals(0, $result->getGreen());
        $this->assertEquals(0, $result->getBlue());
    }

    /**
     * @test
     * Given: 2つのRGBオブジェクトが存在する
     * When: オブジェクトを比較する
     * Then: 同じ色成分値の場合trueが返される
     */
    public function testEquals()
    {
        $rgb1 = new RGB(255, 128, 0);
        $rgb2 = new RGB(255, 128, 0);
        $rgb3 = new RGB(255, 128, 1);

        $this->assertTrue($rgb1->equals($rgb2));
        $this->assertFalse($rgb1->equals($rgb3));
    }
}
