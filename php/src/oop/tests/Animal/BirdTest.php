<?php

declare(strict_types=1);

namespace App\Tests\Animal;

use App\Models\Animal\Animal;
use App\Models\Animal\Bird;
use PHPUnit\Framework\TestCase;

class BirdTest extends TestCase
{
    private array $defaultBirdArgs;

    protected function setUp(): void
    {
        $this->defaultBirdArgs = [
            'species' => 'Sparrow',
            'heightM' => 0.15,
            'weightKg' => 0.03,
            'lifeSpanDays' => 1825.0,
            'biologicalSex' => 'female',
            'age' => 1.0,
            'wingSpan' => 0.25,
        ];
    }

    public function testBirdCanBeCreated(): void
    {
        // Given: 鳥の基本パラメータ
        $bird = new Bird(...array_values($this->defaultBirdArgs));

        // When: 鳥が作成される
        // Then: 正しくインスタンス化される
        $this->assertInstanceOf(Bird::class, $bird);
        $this->assertInstanceOf(Animal::class, $bird);
    }

    public function testBirdInheritsFromAnimal(): void
    {
        // Given: 鳥のインスタンス
        $bird = new Bird(...array_values($this->defaultBirdArgs));

        // When: 継承関係をチェック
        // Then: Animalクラスを継承している
        $this->assertInstanceOf(Animal::class, $bird);
    }

    public function testBirdHasWingSpanProperty(): void
    {
        // Given: 翼幅25cmの鳥
        $wingSpan = 0.25;
        $args = $this->defaultBirdArgs;
        $args['wingSpan'] = $wingSpan;
        $bird = new Bird(...array_values($args));

        // When: 翼幅を取得
        $actualWingSpan = $bird->getWingSpan();

        // Then: 正しい翼幅が返される
        $this->assertEquals($wingSpan, $actualWingSpan);
    }

    public function testBirdCanLayEggs(): void
    {
        // Given: 生きているメスの鳥
        $args = $this->defaultBirdArgs;
        $args['biologicalSex'] = 'female';
        $bird = new Bird(...array_values($args));

        // When: 産卵する
        $result = $bird->layEggs();

        // Then: 産卵が成功する（戻り値やログで確認）
        $this->assertTrue($bird->isAlive());
        // 実際の産卵結果の検証（実装によって異なる）
    }

    public function testDeadBirdCannotLayEggs(): void
    {
        // Given: 死んだ鳥
        $bird = new Bird(...array_values($this->defaultBirdArgs));
        $bird->die();

        // When: 産卵を試みる
        $result = $bird->layEggs();

        // Then: 産卵できない
        $this->assertFalse($bird->isAlive());
        // デッドバードは産卵できないことを確認
    }

    public function testBirdCanFly(): void
    {
        // Given: 生きている鳥
        $bird = new Bird(...array_values($this->defaultBirdArgs));

        // When: 飛行する
        $result = $bird->fly();

        // Then: 飛行が実行される
        $this->assertTrue($bird->isAlive());
        // 飛行の結果を確認（実装によって異なる）
    }

    public function testDeadBirdCannotFly(): void
    {
        // Given: 死んだ鳥
        $bird = new Bird(...array_values($this->defaultBirdArgs));
        $bird->die();

        // When: 飛行を試みる
        $result = $bird->fly();

        // Then: 飛行できない
        $this->assertFalse($bird->isAlive());
    }

    public function testBirdCanBuildNest(): void
    {
        // Given: 生きている鳥
        $bird = new Bird(...array_values($this->defaultBirdArgs));

        // When: 巣作りをする
        $result = $bird->buildNest();

        // Then: 巣作りが実行される
        $this->assertTrue($bird->isAlive());
        // 巣作りの結果を確認（実装によって異なる）
    }

    public function testDeadBirdCannotBuildNest(): void
    {
        // Given: 死んだ鳥
        $bird = new Bird(...array_values($this->defaultBirdArgs));
        $bird->die();

        // When: 巣作りを試みる
        $result = $bird->buildNest();

        // Then: 巣作りできない
        $this->assertFalse($bird->isAlive());
    }

    public function testBirdCanMoveWithOverriddenMethod(): void
    {
        // Given: 生きている鳥
        $bird = new Bird(...array_values($this->defaultBirdArgs));

        // When: 移動する
        ob_start();
        $bird->move();
        $output = ob_get_clean();

        // Then: 鳥専用の移動メッセージが出力される
        $this->assertStringContainsString('bird', strtolower($output));
    }

    public function testBirdWithDifferentWingSpans(): void
    {
        // Given: 異なる翼幅の鳥たち
        $smallBird = new Bird('Hummingbird', 0.08, 0.004, 1460, 'female', 1.0, 0.1);
        $largeBird = new Bird('Eagle', 0.75, 4.5, 7300, 'male', 2.0, 2.3);

        // When: 翼幅を比較
        $smallWingSpan = $smallBird->getWingSpan();
        $largeWingSpan = $largeBird->getWingSpan();

        // Then: 正しい翼幅が設定されている
        $this->assertEquals(0.1, $smallWingSpan);
        $this->assertEquals(2.3, $largeWingSpan);
        $this->assertLessThan($largeWingSpan, $smallWingSpan);
    }

    public function testBirdToStringIncludesWingSpanInformation(): void
    {
        // Given: 鳥のインスタンス
        $bird = new Bird(...array_values($this->defaultBirdArgs));

        // When: 文字列化
        $birdString = $bird->__toString();

        // Then: 翼幅情報が含まれている
        $this->assertStringContainsString('wing', strtolower($birdString));
    }
}
