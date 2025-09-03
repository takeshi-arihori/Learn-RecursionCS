<?php

declare(strict_types=1);

use App\Models\Animal\Chicken;
use PHPUnit\Framework\TestCase;

class ChickenTest extends TestCase
{
    /**
     * @test
     * Given: 有効なChickenパラメータ
     * When: Chickenインスタンスを作成する
     * Then: 正しく初期化される
     */
    public function testChickenCreation(): void
    {
        // Given: 鶏の基本パラメータ
        $species = 'Leghorn';
        $height = 0.5;
        $weight = 2.5;
        $lifeSpan = 2555;
        $biologicalSex = 'female';
        $age = 1.0;
        $wingSpan = 0.75;

        // When: Chickenインスタンスを作成
        $chicken = new Chicken($species, $height, $weight, $lifeSpan, $biologicalSex, $age, $wingSpan);

        // Then: 正しく初期化される
        $this->assertInstanceOf(Chicken::class, $chicken);
        $this->assertEquals($species, $chicken->getSpecies());
        $this->assertEquals($height, $chicken->getHeight());
        $this->assertEquals($weight, $chicken->getWeight());
        $this->assertEquals($lifeSpan, $chicken->getLifeSpan());
        $this->assertEquals($biologicalSex, $chicken->getBiologicalSex());
        $this->assertEquals($age, $chicken->getAge());
        $this->assertEquals($wingSpan, $chicken->getWingSpan());
    }

    /**
     * @test
     * Given: Chickenインスタンス
     * When: cluck()を呼び出す
     * Then: 鳴く
     */
    public function testCluck(): void
    {
        // Given: 鶏
        $chicken = new Chicken('Leghorn', 0.5, 2.5, 2555, 'female', 1.0, 0.75);

        // When & Then: 鳴くメッセージが出力される
        $this->expectOutputString("Clucking...\n");
        $chicken->cluck();
    }

    /**
     * @test
     * Given: Chickenインスタンス
     * When: peck()を呼び出す
     * Then: つつく
     */
    public function testPeck(): void
    {
        // Given: 鶏
        $chicken = new Chicken('Leghorn', 0.5, 2.5, 2555, 'female', 1.0, 0.75);

        // When & Then: つつくメッセージが出力される
        $this->expectOutputString("Pecking...\n");
        $chicken->peck();
    }

    /**
     * @test
     * Given: Chickenインスタンス
     * When: layEggs()を呼び出す
     * Then: 卵を産む
     */
    public function testLayEggs(): void
    {
        // Given: 鶏
        $chicken = new Chicken('Leghorn', 0.5, 2.5, 2555, 'female', 1.0, 0.75);

        // When & Then: 卵を産むメッセージが出力される
        $this->expectOutputString("Leghorn laid an egg\n");
        $chicken->layEggs();
    }

    /**
     * @test
     * Given: Chickenインスタンス
     * When: __toString()を呼び出す
     * Then: 正しい文字列表現が返される
     */
    public function testToString(): void
    {
        // Given: 鶏
        $chicken = new Chicken('Leghorn', 0.5, 2.5, 2555, 'female', 1.0, 0.75);

        // When: 文字列化
        $result = $chicken->__toString();

        // Then: 正しい文字列が返される
        $this->assertStringContainsString('Leghorn', $result);
        $this->assertStringContainsString('This is a bird', $result);
        $this->assertStringContainsString('Chicken', $result);
    }
}
