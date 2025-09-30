<?php

declare(strict_types=1);

use App\Models\Animal\Cow;
use PHPUnit\Framework\TestCase;

class CowTest extends TestCase
{
    /**
     * @test
     * Given: 有効なCowパラメータ
     * When: Cowインスタンスを作成する
     * Then: 正しく初期化される
     */
    public function testCowCreation(): void
    {
        // Given: 牛の基本パラメータ
        $species = 'Holstein';
        $height = 1.5;
        $weight = 700;
        $lifeSpan = 7300;
        $biologicalSex = 'female';
        $age = 3.0;
        $furType = 'short';
        $bodyTemperature = 38.5;

        // When: Cowインスタンスを作成
        $cow = new Cow($species, $height, $weight, $lifeSpan, $biologicalSex, $age, 2.5, $furType, $bodyTemperature);

        // Then: 正しく初期化される
        $this->assertInstanceOf(Cow::class, $cow);
        $this->assertEquals($species, $cow->getSpecies());
        $this->assertEquals($height, $cow->getHeight());
        $this->assertEquals($weight, $cow->getWeight());
        $this->assertEquals($lifeSpan, $cow->getLifeSpan());
        $this->assertEquals($biologicalSex, $cow->getBiologicalSex());
        $this->assertEquals($age, $cow->getAge());
        $this->assertEquals($furType, $cow->getFurType());
        $this->assertEquals($bodyTemperature, $cow->getBodyTemperatureC());
    }

    /**
     * @test
     * Given: Cowインスタンス
     * When: produceMilk()を呼び出す
     * Then: 牛乳を生産する
     */
    public function testProduceMilk(): void
    {
        // Given: メス牛
        $cow = new Cow('Holstein', 1.5, 700, 7300, 'female', 3.0, 2.5, 'short', 38.5);

        // When & Then: 牛乳生産メッセージが出力される
        $this->expectOutputString("Producing milk...\n");
        $cow->produceMilk();
    }

    /**
     * @test
     * Given: Cowインスタンス
     * When: graze()を呼び出す
     * Then: 草を食べる
     */
    public function testGraze(): void
    {
        // Given: 牛
        $cow = new Cow('Holstein', 1.5, 700, 7300, 'female', 3.0, 2.5, 'short', 38.5);

        // When & Then: 草を食べるメッセージが出力される
        $this->expectOutputString("Grazing...\n");
        $cow->graze();
    }

    /**
     * @test
     * Given: Cowインスタンス
     * When: __toString()を呼び出す
     * Then: 正しい文字列表現が返される
     */
    public function testToString(): void
    {
        // Given: 牛
        $cow = new Cow('Holstein', 1.5, 700, 7300, 'female', 3.0, 2.5, 'short', 38.5);

        // When: 文字列化
        $result = $cow->__toString();

        // Then: 正しい文字列が返される
        $this->assertStringContainsString('Holstein', $result);
        $this->assertStringContainsString('This is a mammal', $result);
        $this->assertStringContainsString('Cow', $result);
    }
}
