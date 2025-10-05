<?php

declare(strict_types=1);

use App\Models\Animal\Egg;
use PHPUnit\Framework\TestCase;

class EggTest extends TestCase
{
    /**
     * @test
     * Given: 有効なEggパラメータ
     * When: Eggインスタンスを作成する
     * Then: 正しく初期化される
     */
    public function testEggCreation(): void
    {
        // Given: 卵の基本パラメータ
        $size = 'large';
        $color = 'white';
        $weight = 60.0;

        // When: Eggインスタンスを作成
        $egg = new Egg($size, $color, $weight);

        // Then: 正しく初期化される
        $this->assertInstanceOf(Egg::class, $egg);
        $this->assertEquals($size, $egg->getSize());
        $this->assertEquals($color, $egg->getColor());
        $this->assertEquals($weight, $egg->getWeight());
        $this->assertTrue($egg->isFresh());
    }

    /**
     * @test
     * Given: Eggインスタンス
     * When: crack()を呼び出す
     * Then: 卵が割れる
     */
    public function testCrack(): void
    {
        // Given: 卵
        $egg = new Egg('medium', 'brown', 55.0);

        // When: 卵を割る
        $egg->crack();

        // Then: 卵が割れている
        $this->assertTrue($egg->isCracked());
        $this->assertFalse($egg->isFresh());
    }

    /**
     * @test
     * Given: Eggインスタンス
     * When: age()を呼び出す
     * Then: 卵が古くなる
     */
    public function testAge(): void
    {
        // Given: 新鮮な卵
        $egg = new Egg('small', 'white', 50.0);
        $this->assertTrue($egg->isFresh());

        // When: 卵を古くする
        $egg->age();

        // Then: 卵が古くなっている
        $this->assertFalse($egg->isFresh());
    }

    /**
     * @test
     * Given: Eggインスタンス
     * When: __toString()を呼び出す
     * Then: 正しい文字列表現が返される
     */
    public function testToString(): void
    {
        // Given: 卵
        $egg = new Egg('large', 'brown', 65.0);

        // When: 文字列化
        $result = $egg->__toString();

        // Then: 正しい文字列が返される
        $expected = 'Egg - Size:large/Color:brown/Weight:65g/Fresh:true/Cracked:false';
        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     * Given: 割れた卵
     * When: __toString()を呼び出す
     * Then: 割れた状態が表示される
     */
    public function testToStringCracked(): void
    {
        // Given: 割れた卵
        $egg = new Egg('medium', 'white', 58.0);
        $egg->crack();

        // When: 文字列化
        $result = $egg->__toString();

        // Then: 割れた状態が表示される
        $expected = 'Egg - Size:medium/Color:white/Weight:58g/Fresh:false/Cracked:true';
        $this->assertEquals($expected, $result);
    }
}
