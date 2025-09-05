<?php

declare(strict_types=1);

use App\Models\Audible\Horse;
use PHPUnit\Framework\TestCase;

/**
 * Horseクラスのユニットテスト
 * AudibleInterfaceの実装とHorseクラスの全メソッドをテストします
 */
class HorseTest extends TestCase
{
    private Horse $lightHorse;      // 軽い馬
    private Horse $heavyHorse;      // 重い馬
    private Horse $averageHorse;    // 平均的な馬

    /**
     * テスト実行前の初期設定
     * 各テストで使用するHorseオブジェクトを作成します
     */
    protected function setUp(): void
    {
        $this->lightHorse = new Horse(350.5);
        $this->heavyHorse = new Horse(800.0);
        $this->averageHorse = new Horse(500.0);
    }

    /**
     * コンストラクタとプロパティの初期化をテスト
     * Horseオブジェクトが正しく作成されることを確認
     */
    public function testConstructorAndPropertyInitialization(): void
    {
        $horse = new Horse(450.0);
        $this->assertInstanceOf(Horse::class, $horse);
        // Horseクラスが正しく作成されることを確認
    }

    /**
     * __toString()メソッドのテスト
     * 馬の情報が正しい形式で文字列として返されることを確認
     */
    public function testToString(): void
    {
        $expectedLight = 'This is a horse that weighs: 350.5kg';
        $this->assertEquals($expectedLight, $this->lightHorse->__toString());

        $expectedHeavy = 'This is a horse that weighs: 800kg';
        $this->assertEquals($expectedHeavy, $this->heavyHorse->__toString());

        $expectedAverage = 'This is a horse that weighs: 500kg';
        $this->assertEquals($expectedAverage, $this->averageHorse->__toString());
    }

    /**
     * 小数点を含む重量の__toString()メソッドのテスト
     * 浮動小数点数が正しく表示されることを確認
     */
    public function testToStringWithDecimalWeight(): void
    {
        $horse = new Horse(456.789);
        $expected = 'This is a horse that weighs: 456.789kg';
        $this->assertEquals($expected, $horse->__toString());
    }

    /**
     * makeNoise()メソッドのテスト
     * "Neeighh!!"が標準出力に正しく出力されることを確認
     */
    public function testMakeNoise(): void
    {
        $this->expectOutputString('Neeighh!!' . PHP_EOL);
        $this->lightHorse->makeNoise();
    }

    /**
     * makeNoise()メソッドの複数回実行テスト
     * 複数のHorseオブジェクトが連続して音を出すことをテスト
     */
    public function testMakeNoiseMultipleTimes(): void
    {
        $expectedOutput = 'Neeighh!!' . PHP_EOL . 'Neeighh!!' . PHP_EOL;
        $this->expectOutputString($expectedOutput);
        $this->lightHorse->makeNoise();
        $this->heavyHorse->makeNoise();
    }

    /**
     * soundFrequency()メソッドのテスト
     * 全てのHorseインスタンスで一定の周波数120.0が返されることを確認
     */
    public function testSoundFrequency(): void
    {
        // 全ての馬で同じ周波数120.0を返すべき
        $this->assertEquals(120.0, $this->lightHorse->soundFrequency());
        $this->assertEquals(120.0, $this->heavyHorse->soundFrequency());
        $this->assertEquals(120.0, $this->averageHorse->soundFrequency());
    }

    /**
     * soundLevel()メソッドのテスト
     * 全てのHorseインスタンスで一定の音量75.0が返されることを確認
     */
    public function testSoundLevel(): void
    {
        // 全ての馬で同じ音量75.0を返すべき
        $this->assertEquals(75.0, $this->lightHorse->soundLevel());
        $this->assertEquals(75.0, $this->heavyHorse->soundLevel());
        $this->assertEquals(75.0, $this->averageHorse->soundLevel());
    }

    /**
     * AudibleInterfaceの実装確認テスト
     * Horseクラスが必要なメソッドを持っていることを確認
     */
    public function testAudibleInterfaceImplementation(): void
    {
        // インターフェースで要求されるメソッドが存在することを確認
        $this->assertTrue(method_exists($this->lightHorse, 'makeNoise'));
        $this->assertTrue(method_exists($this->lightHorse, 'soundFrequency'));
        $this->assertTrue(method_exists($this->lightHorse, 'soundLevel'));
    }

    /**
     * 文字列表現に全データが含まれることのテスト
     * __toString()メソッドが必要な情報を全て含んでいることを確認
     */
    public function testStringRepresentationIncludesAllData(): void
    {
        $horse = new Horse(725.5);
        $stringRep = $horse->__toString();

        $this->assertStringContainsString('This is a horse', $stringRep);
        $this->assertStringContainsString('725.5kg', $stringRep);
        $this->assertStringContainsString('weighs:', $stringRep);
    }

    /**
     * エッジケース値のテスト
     * 極端な値でのHorseクラスの動作を確認
     */
    public function testEdgeCaseValues(): void
    {
        // 最小値でのテスト（0kg）
        $minHorse = new Horse(0.0);
        $this->assertEquals('This is a horse that weighs: 0kg', $minHorse->__toString());
        $this->assertEquals(120.0, $minHorse->soundFrequency());
        $this->assertEquals(75.0, $minHorse->soundLevel());

        // 大きな値でのテスト
        $maxHorse = new Horse(9999.99);
        $this->assertEquals('This is a horse that weighs: 9999.99kg', $maxHorse->__toString());
        $this->assertEquals(120.0, $maxHorse->soundFrequency());
        $this->assertEquals(75.0, $maxHorse->soundLevel());
    }

    /**
     * 負の重量値のテスト
     * 負の値でも動作することを確認（実用性は低いが技術的な動作確認）
     */
    public function testNegativeWeight(): void
    {
        $negativeHorse = new Horse(-100.0);
        $expected = 'This is a horse that weighs: -100kg';
        $this->assertEquals($expected, $negativeHorse->__toString());
    }

    /**
     * 非常に小さい小数点値のテスト
     * 精度の高い浮動小数点数の処理を確認
     */
    public function testVerySmallDecimalWeight(): void
    {
        $preciseHorse = new Horse(0.001);
        $expected = 'This is a horse that weighs: 0.001kg';
        $this->assertEquals($expected, $preciseHorse->__toString());
    }
}
