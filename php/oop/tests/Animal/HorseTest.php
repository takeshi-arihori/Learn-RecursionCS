<?php

declare(strict_types=1);

use App\Models\Animal\Horse;
use PHPUnit\Framework\TestCase;

class HorseTest extends TestCase
{
    /**
     * @test
     * Given: 有効なHorseパラメータ
     * When: Horseインスタンスを作成する
     * Then: 正しく初期化される
     */
    public function testHorseCreation(): void
    {
        // Given: 馬の基本パラメータ
        $species = 'Arabian';
        $height = 1.6;
        $weight = 450;
        $lifeSpan = 9125;
        $biologicalSex = 'male';
        $age = 5.0;
        $furType = 'smooth';
        $bodyTemperature = 37.8;

        // When: Horseインスタンスを作成
        $horse = new Horse($species, $height, $weight, $lifeSpan, $biologicalSex, $age, 1.8, $furType, $bodyTemperature);

        // Then: 正しく初期化される
        $this->assertInstanceOf(Horse::class, $horse);
        $this->assertEquals($species, $horse->getSpecies());
        $this->assertEquals($height, $horse->getHeight());
        $this->assertEquals($weight, $horse->getWeight());
        $this->assertEquals($lifeSpan, $horse->getLifeSpan());
        $this->assertEquals($biologicalSex, $horse->getBiologicalSex());
        $this->assertEquals($age, $horse->getAge());
        $this->assertEquals($furType, $horse->getFurType());
        $this->assertEquals($bodyTemperature, $horse->getBodyTemperatureC());
    }

    /**
     * @test
     * Given: Horseインスタンス
     * When: gallop()を呼び出す
     * Then: 駆ける
     */
    public function testGallop(): void
    {
        // Given: 馬
        $horse = new Horse('Arabian', 1.6, 450, 9125, 'male', 5.0, 1.8, 'smooth', 37.8);

        // When & Then: 駆けるメッセージが出力される
        $this->expectOutputString("Galloping...\n");
        $horse->gallop();
    }

    /**
     * @test
     * Given: Horseインスタンス
     * When: neigh()を呼び出す
     * Then: いななく
     */
    public function testNeigh(): void
    {
        // Given: 馬
        $horse = new Horse('Arabian', 1.6, 450, 9125, 'male', 5.0, 1.8, 'smooth', 37.8);

        // When & Then: いななくメッセージが出力される
        $this->expectOutputString("Neighing...\n");
        $horse->neigh();
    }

    /**
     * @test
     * Given: Horseインスタンス
     * When: __toString()を呼び出す
     * Then: 正しい文字列表現が返される
     */
    public function testToString(): void
    {
        // Given: 馬
        $horse = new Horse('Arabian', 1.6, 450, 9125, 'male', 5.0, 1.8, 'smooth', 37.8);

        // When: 文字列化
        $result = $horse->__toString();

        // Then: 正しい文字列が返される
        $this->assertStringContainsString('Arabian', $result);
        $this->assertStringContainsString('This is a mammal', $result);
        $this->assertStringContainsString('Horse', $result);
    }
}
