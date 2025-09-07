<?php

declare(strict_types=1);

use App\Models\Audible\Chicken;
use PHPUnit\Framework\TestCase;

class ChickenTest extends TestCase
{
    /**
     * 軽い鶏のインスタンス（子鶏相当）
     *
     * @var Chicken
     */
    private Chicken $lightChicken;

    /**
     * 重い鶏のインスタンス（成鶏相当）
     *
     * @var Chicken
     */
    private Chicken $heavyChicken;

    /**
     * 平均的な鶏のインスタンス
     *
     * @var Chicken
     */
    private Chicken $averageChicken;

    /**
     * テスト実行前の初期設定
     *
     * 各テストで使用するChickenオブジェクトを作成します。
     * 軽い鶏、重い鶏、平均的な鶏の3つのパターンを用意し、
     * 様々な重量での動作を確認できるようにしています。
     *
     * @return void
     */
    protected function setUp(): void
    {
        $this->lightChicken = new Chicken(1.5);    // 子鶏相当
        $this->heavyChicken = new Chicken(3.0);    // 成鶏相当
        $this->averageChicken = new Chicken(2.0);  // 平均的な鶏
    }

    /**
     * コンストラクタとプロパティの初期化をテスト
     *
     * Chickenオブジェクトが正しく作成され、適切なクラスのインスタンスであることを確認します。
     * 重量パラメータが適切に設定されることをテストします。
     *
     * @test
     * @return void
     */
    public function testConstructorAndPropertyInitialization(): void
    {
        // Given: 新しいChickenインスタンスを作成
        $chicken = new Chicken(2.5);

        // Then: 正しいクラスのインスタンスであることを確認
        $this->assertInstanceOf(Chicken::class, $chicken);

        // And: Chickenクラスが正しく作成されることを確認
        $this->assertIsObject($chicken);
    }

    /**
     * __toString()メソッドのテスト
     *
     * 鶏の情報が正しい形式で文字列として返されることを確認します。
     * 重量情報が適切にフォーマットされて表示されることをテストします。
     *
     * @test
     * @return void
     */
    public function testToString(): void
    {
        // Given & When & Then: 各鶏の文字列表現を確認
        $expectedLight = 'This is a chicken that weights: 1.5kg';
        $this->assertEquals($expectedLight, $this->lightChicken->__toString());

        $expectedHeavy = 'This is a chicken that weights: 3kg';
        $this->assertEquals($expectedHeavy, $this->heavyChicken->__toString());

        $expectedAverage = 'This is a chicken that weights: 2kg';
        $this->assertEquals($expectedAverage, $this->averageChicken->__toString());
    }

    /**
     * 小数点を含む重量の__toString()メソッドのテスト
     *
     * 浮動小数点数が正しく表示されることを確認します。
     * 小数点以下の精度が保たれることをテストします。
     *
     * @test
     * @return void
     */
    public function testToStringWithDecimalWeight(): void
    {
        // Given: 小数点を含む重量の鶏を作成
        $chicken = new Chicken(2.789);

        // When: 文字列表現を取得
        $result = $chicken->__toString();

        // Then: 小数点が正しく表示されることを確認
        $expected = 'This is a chicken that weights: 2.789kg';
        $this->assertEquals($expected, $result);
    }

    /**
     * howToPrepare()メソッドのテスト（EdibleInterface実装）
     *
     * 鶏肉の調理方法説明が正しく返されることを確認します。
     * EdibleInterfaceで定義された料理方法の取得機能をテストします。
     *
     * @test
     * @return void
     */
    public function testHowToPrepare(): void
    {
        // Given: 期待される調理方法
        $expectedPreparation = '焼くか揚げてください。';

        // When & Then: 全ての鶏で同じ調理方法が返されることを確認
        $this->assertEquals($expectedPreparation, $this->lightChicken->howToPrepare());
        $this->assertEquals($expectedPreparation, $this->heavyChicken->howToPrepare());
        $this->assertEquals($expectedPreparation, $this->averageChicken->howToPrepare());
    }

    /**
     * calories()メソッドのテスト（EdibleInterface実装）
     *
     * 重量に基づいたカロリー計算が正しく行われることを確認します。
     * 重量 × 239.0の計算式でカロリーが算出されることをテストします。
     *
     * @test
     * @return void
     */
    public function testCalories(): void
    {
        // Given & When & Then: 重量に基づく正しいカロリー計算を確認

        // 軽い鶏: 1.5kg × 239.0 = 358.5カロリー
        $this->assertEquals(358.5, $this->lightChicken->calories());

        // 重い鶏: 3.0kg × 239.0 = 717.0カロリー
        $this->assertEquals(717.0, $this->heavyChicken->calories());

        // 平均的な鶏: 2.0kg × 239.0 = 478.0カロリー
        $this->assertEquals(478.0, $this->averageChicken->calories());
    }

    /**
     * makeNoise()メソッドのテスト（AudibleInterface実装）
     *
     * "コケコッコー！"が標準出力に正しく出力されることを確認します。
     * AudibleInterfaceで定義された音を出す機能をテストします。
     * 鶏の特徴的な鳴き声をシミュレートします。
     *
     * @test
     * @return void
     */
    public function testMakeNoise(): void
    {
        // Given & When & Then: 鶏の鳴き声が正しく出力されることを確認
        $this->expectOutputString('コケコッコー！' . PHP_EOL);
        $this->lightChicken->makeNoise();
    }

    /**
     * makeNoise()メソッドの複数回実行テスト
     *
     * 複数のChickenオブジェクトが連続して音を出すことをテストします。
     * 出力のバッファリングが正しく動作することを確認します。
     * 複数の鶏が同時に鳴くシナリオをテストします。
     *
     * @test
     * @return void
     */
    public function testMakeNoiseMultipleTimes(): void
    {
        // Given: 期待される出力を定義
        $expectedOutput = 'コケコッコー！' . PHP_EOL . 'コケコッコー！' . PHP_EOL;

        // When & Then: 複数の鶏が連続して鳴くことを確認
        $this->expectOutputString($expectedOutput);
        $this->lightChicken->makeNoise();
        $this->heavyChicken->makeNoise();
    }

    /**
     * soundFrequency()メソッドのテスト（AudibleInterface実装）
     *
     * 全てのChickenインスタンスで一定の周波数500.0Hzが返されることを確認します。
     * 鶏の鳴き声の周波数特性が一定であることをテストします。
     * 家禽特有の中高音域をテストします。
     *
     * @test
     * @return void
     */
    public function testSoundFrequency(): void
    {
        // Given & When & Then: 全ての鶏で同じ周波数500.0Hzを返すことを確認
        $this->assertEquals(500.0, $this->lightChicken->soundFrequency());
        $this->assertEquals(500.0, $this->heavyChicken->soundFrequency());
        $this->assertEquals(500.0, $this->averageChicken->soundFrequency());
    }

    /**
     * soundLevel()メソッドのテスト（AudibleInterface実装）
     *
     * 全てのChickenインスタンスで一定の音量60.0dBが返されることを確認します。
     * 鶏の鳴き声の音量レベルが一定であることをテストします。
     * 家禽特有の中程度の音量レベルをテストします。
     *
     * @test
     * @return void
     */
    public function testSoundLevel(): void
    {
        // Given & When & Then: 全ての鶏で同じ音量60.0dBを返すことを確認
        $this->assertEquals(60.0, $this->lightChicken->soundLevel());
        $this->assertEquals(60.0, $this->heavyChicken->soundLevel());
        $this->assertEquals(60.0, $this->averageChicken->soundLevel());
    }

    /**
     * AudibleInterfaceとEdibleInterfaceの実装確認テスト
     *
     * Chickenクラスが食べ物としても音を出す動物としても必要な全てのメソッドを持っていることを確認します。
     * 両方のインターフェースで定義されたメソッドの存在をテストします。
     *
     * @test
     * @return void
     */
    public function testBothInterfacesImplementation(): void
    {
        // Given & When & Then: EdibleInterfaceで要求されるメソッドが存在することを確認
        $this->assertTrue(method_exists($this->lightChicken, 'howToPrepare'));
        $this->assertTrue(method_exists($this->lightChicken, 'calories'));

        // And: AudibleInterfaceで要求されるメソッドが存在することを確認
        $this->assertTrue(method_exists($this->lightChicken, 'makeNoise'));
        $this->assertTrue(method_exists($this->lightChicken, 'soundFrequency'));
        $this->assertTrue(method_exists($this->lightChicken, 'soundLevel'));

        // And: メソッドが callable であることを確認
        $this->assertIsCallable([$this->lightChicken, 'howToPrepare']);
        $this->assertIsCallable([$this->lightChicken, 'calories']);
        $this->assertIsCallable([$this->lightChicken, 'makeNoise']);
        $this->assertIsCallable([$this->lightChicken, 'soundFrequency']);
        $this->assertIsCallable([$this->lightChicken, 'soundLevel']);
    }

    /**
     * 鶏の音響特性比較テスト
     *
     * 他の動物と比較して鶏の音響特性が適切であることを確認します。
     * 鶏は中高音域で中程度の音量を持つべきです。
     *
     * @test
     * @return void
     */
    public function testSoundCharacteristics(): void
    {
        // Given: テスト用の鶏
        $chicken = new Chicken(2.0);

        // When: 音響特性を取得
        $frequency = $chicken->soundFrequency();
        $soundLevel = $chicken->soundLevel();

        // Then: 鶏らしい音響特性を確認

        // 周波数: 500Hz（家禽らしい中高音域）
        $this->assertEquals(500.0, $frequency);
        $this->assertGreaterThan(300.0, $frequency, '鶏の周波数は中音域にある');
        $this->assertLessThan(1000.0, $frequency, '鶏の周波数は極端に高くない');

        // 音量: 60dB（家禽らしい中程度の音量）
        $this->assertEquals(60.0, $soundLevel);
        $this->assertGreaterThan(40.0, $soundLevel, '鶏は適度な音量である');
        $this->assertLessThan(80.0, $soundLevel, '鶏の音量は過度に大きくない');
    }

    /**
     * 文字列表現に全データが含まれることのテスト
     *
     * __toString()メソッドが必要な情報を全て含んでいることを確認します。
     * 文字列に期待される要素が全て含まれていることをテストします。
     *
     * @test
     * @return void
     */
    public function testStringRepresentationIncludesAllData(): void
    {
        // Given: テスト用の鶏を作成
        $chicken = new Chicken(2.25);

        // When: 文字列表現を取得
        $stringRep = $chicken->__toString();

        // Then: 必要な要素が全て含まれていることを確認
        $this->assertStringContainsString('This is a chicken', $stringRep);
        $this->assertStringContainsString('2.25kg', $stringRep);
        $this->assertStringContainsString('weights:', $stringRep);
    }

    /**
     * エッジケース値のテスト
     *
     * 極端な値でのChickenクラスの動作を確認します。
     * 最小値、最大値、負の値などの境界値でのテストを実行します。
     *
     * @test
     * @return void
     */
    public function testEdgeCaseValues(): void
    {
        // Given: 極端な値のテストケース

        // When & Then: 最小値でのテスト（0kg）
        $minChicken = new Chicken(0.0);
        $this->assertEquals('This is a chicken that weights: 0kg', $minChicken->__toString());
        $this->assertEquals(0.0, $minChicken->calories()); // 0kg × 239.0 = 0カロリー

        // And: 大きな値でのテスト
        $maxChicken = new Chicken(10.5);
        $this->assertEquals('This is a chicken that weights: 10.5kg', $maxChicken->__toString());
        $this->assertEquals(2509.5, $maxChicken->calories()); // 10.5kg × 239.0
    }

    /**
     * 負の重量値のテスト
     *
     * 負の値でも動作することを確認します。
     * 実用性は低いですが、技術的な動作の堅牢性をテストします。
     *
     * @test
     * @return void
     */
    public function testNegativeWeight(): void
    {
        // Given: 負の重量の鶏を作成
        $negativeChicken = new Chicken(-1.0);

        // When & Then: 負の重量でも適切に動作することを確認
        $expected = 'This is a chicken that weights: -1kg';
        $this->assertEquals($expected, $negativeChicken->__toString());

        // And: カロリー計算も負の値になることを確認
        $this->assertEquals(-239.0, $negativeChicken->calories()); // -1kg × 239.0
    }

    /**
     * 非常に小さい小数点値のテスト
     *
     * 精度の高い浮動小数点数の処理を確認します。
     * 小数点以下の精度が保たれることをテストします。
     *
     * @test
     * @return void
     */
    public function testVerySmallDecimalWeight(): void
    {
        // Given: 非常に小さい重量の鶏を作成
        $preciseChicken = new Chicken(0.001);

        // When & Then: 小数点の精度が保たれることを確認
        $expected = 'This is a chicken that weights: 0.001kg';
        $this->assertEquals($expected, $preciseChicken->__toString());

        // And: カロリー計算も正確であることを確認（浮動小数点の精度を考慮）
        $this->assertEqualsWithDelta(0.239, $preciseChicken->calories(), 0.000001); // 0.001kg × 239.0
    }

    /**
     * カロリー計算の精度テスト
     *
     * 浮動小数点数の計算精度を確認します。
     * 重量とカロリーの関係が正確に計算されることをテストします。
     *
     * @test
     * @return void
     */
    public function testCaloriesCalculationPrecision(): void
    {
        // Given: 精密な重量値でテスト
        $preciseChicken = new Chicken(1.234);

        // When: カロリーを計算
        $actualCalories = $preciseChicken->calories();

        // Then: 正確な計算結果を確認（1.234 × 239.0 = 294.926）
        $expectedCalories = 1.234 * 239.0;
        $this->assertEquals($expectedCalories, $actualCalories);
        $this->assertEquals(294.926, $actualCalories);
    }

    /**
     * カロリー計算用のデータプロバイダー
     *
     * @return array<array<float>> テストデータの配列
     */
    public static function caloriesDataProvider(): array
    {
        return [
            'light_chicken' => [1.5, 358.5],
            'average_chicken' => [2.0, 478.0],
            'heavy_chicken' => [3.0, 717.0],
            'precise_chicken' => [1.234, 294.926],
        ];
    }
}
