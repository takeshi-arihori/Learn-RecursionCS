<?php

declare(strict_types=1);

use App\Models\Audible\Truck;
use PHPUnit\Framework\TestCase;

/**
 * Truckクラスのユニットテスト
 *
 * TruckクラスはAudibleInterfaceを実装しており、
 * 音を出す車両としての機能をテストします。
 * トラックは工業車両として高い音量と特定の周波数を持ちます。
 *
 * @package App\Tests\Models\Audible
 * @author Claude Code
 * @version 1.0.0
 */
class TruckTest extends TestCase
{
    /**
     * 軽いトラックのインスタンス（小型トラック相当）
     *
     * @var Truck
     */
    private Truck $lightTruck;

    /**
     * 重いトラックのインスタンス（大型トラック相当）
     *
     * @var Truck
     */
    private Truck $heavyTruck;

    /**
     * 平均的なトラックのインスタンス（中型トラック相当）
     *
     * @var Truck
     */
    private Truck $averageTruck;

    /**
     * テスト実行前の初期設定
     *
     * 各テストで使用するTruckオブジェクトを作成します。
     * 軽いトラック、重いトラック、平均的なトラックの3つのパターンを用意し、
     * 様々な重量での動作を確認できるようにしています。
     *
     * @return void
     */
    protected function setUp(): void
    {
        $this->lightTruck = new Truck(2500.0);    // 小型トラック相当（2.5トン）
        $this->heavyTruck = new Truck(25000.0);   // 大型トラック相当（25トン）
        $this->averageTruck = new Truck(8000.0);  // 中型トラック相当（8トン）
    }

    /**
     * コンストラクタとプロパティの初期化をテスト
     *
     * Truckオブジェクトが正しく作成され、適切なクラスのインスタンスであることを確認します。
     * 重量パラメータが適切に設定されることをテストします。
     *
     * @test
     * @return void
     */
    public function testConstructorAndPropertyInitialization(): void
    {
        // Given: 新しいTruckインスタンスを作成
        $truck = new Truck(12000.0);

        // Then: 正しいクラスのインスタンスであることを確認
        $this->assertInstanceOf(Truck::class, $truck);

        // And: Truckクラスが正しく作成されることを確認
        $this->assertIsObject($truck);
    }

    /**
     * __toString()メソッドのテスト
     *
     * トラックの情報が正しい形式で文字列として返されることを確認します。
     * 重量情報が適切にフォーマットされて表示されることをテストします。
     *
     * @test
     * @return void
     */
    public function testToString(): void
    {
        // Given & When & Then: 各トラックの文字列表現を確認
        $expectedLight = 'This is a truck that weights: 2500kg';
        $this->assertEquals($expectedLight, $this->lightTruck->__toString());

        $expectedHeavy = 'This is a truck that weights: 25000kg';
        $this->assertEquals($expectedHeavy, $this->heavyTruck->__toString());

        $expectedAverage = 'This is a truck that weights: 8000kg';
        $this->assertEquals($expectedAverage, $this->averageTruck->__toString());
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
        // Given: 小数点を含む重量のトラックを作成
        $truck = new Truck(3456.789);

        // When: 文字列表現を取得
        $result = $truck->__toString();

        // Then: 小数点が正しく表示されることを確認
        $expected = 'This is a truck that weights: 3456.789kg';
        $this->assertEquals($expected, $result);
    }

    /**
     * makeNoise()メソッドのテスト（AudibleInterface実装）
     *
     * "Beep Beep!!"が標準出力に正しく出力されることを確認します。
     * AudibleInterfaceで定義された音を出す機能をテストします。
     * トラックの警笛音をシミュレートします。
     *
     * @test
     * @return void
     */
    public function testMakeNoise(): void
    {
        // Given & When & Then: トラックの警笛音が正しく出力されることを確認
        $this->expectOutputString('Beep Beep!!' . PHP_EOL);
        $this->lightTruck->makeNoise();
    }

    /**
     * makeNoise()メソッドの複数回実行テスト
     *
     * 複数のTruckオブジェクトが連続して音を出すことをテストします。
     * 出力のバッファリングが正しく動作することを確認します。
     * 複数のトラックが同時に警笛を鳴らすシナリオをテストします。
     *
     * @test
     * @return void
     */
    public function testMakeNoiseMultipleTimes(): void
    {
        // Given: 期待される出力を定義
        $expectedOutput = 'Beep Beep!!' . PHP_EOL . 'Beep Beep!!' . PHP_EOL;

        // When & Then: 複数のトラックが連続して警笛を鳴らすことを確認
        $this->expectOutputString($expectedOutput);
        $this->lightTruck->makeNoise();
        $this->heavyTruck->makeNoise();
    }

    /**
     * soundFrequency()メソッドのテスト（AudibleInterface実装）
     *
     * 全てのTruckインスタンスで一定の周波数165.0Hzが返されることを確認します。
     * トラックの警笛音の周波数特性が一定であることをテストします。
     * 工業車両特有の低めの周波数をテストします。
     *
     * @test
     * @return void
     */
    public function testSoundFrequency(): void
    {
        // Given & When & Then: 全てのトラックで同じ周波数165.0Hzを返すことを確認
        $this->assertEquals(165.0, $this->lightTruck->soundFrequency());
        $this->assertEquals(165.0, $this->heavyTruck->soundFrequency());
        $this->assertEquals(165.0, $this->averageTruck->soundFrequency());
    }

    /**
     * soundLevel()メソッドのテスト（AudibleInterface実装）
     *
     * 全てのTruckインスタンスで一定の音量120.0dBが返されることを確認します。
     * トラックの警笛音の音量レベルが一定であることをテストします。
     * 工業車両特有の高い音量レベルをテストします。
     *
     * @test
     * @return void
     */
    public function testSoundLevel(): void
    {
        // Given & When & Then: 全てのトラックで同じ音量120.0dBを返すことを確認
        $this->assertEquals(120.0, $this->lightTruck->soundLevel());
        $this->assertEquals(120.0, $this->heavyTruck->soundLevel());
        $this->assertEquals(120.0, $this->averageTruck->soundLevel());
    }

    /**
     * AudibleInterfaceの実装確認テスト
     *
     * Truckクラスが音を出すために必要な全てのメソッドを持っていることを確認します。
     * インターフェースで定義されたメソッドの存在をテストします。
     *
     * @test
     * @return void
     */
    public function testAudibleInterfaceImplementation(): void
    {
        // Given & When & Then: AudibleInterfaceで要求されるメソッドが存在することを確認
        $this->assertTrue(method_exists($this->lightTruck, 'makeNoise'));
        $this->assertTrue(method_exists($this->lightTruck, 'soundFrequency'));
        $this->assertTrue(method_exists($this->lightTruck, 'soundLevel'));
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
        // Given: テスト用のトラックを作成
        $truck = new Truck(15750.5);

        // When: 文字列表現を取得
        $stringRep = $truck->__toString();

        // Then: 必要な要素が全て含まれていることを確認
        $this->assertStringContainsString('This is a truck', $stringRep);
        $this->assertStringContainsString('15750.5kg', $stringRep);
        $this->assertStringContainsString('weights:', $stringRep);
    }

    /**
     * エッジケース値のテスト
     *
     * 極端な値でのTruckクラスの動作を確認します。
     * 最小値、最大値などの境界値でのテストを実行します。
     *
     * @test
     * @return void
     */
    public function testEdgeCaseValues(): void
    {
        // Given: 極端な値のテストケース

        // When & Then: 最小値でのテスト（0kg - 理論上の無重量トラック）
        $minTruck = new Truck(0.0);
        $this->assertEquals('This is a truck that weights: 0kg', $minTruck->__toString());
        $this->assertEquals(165.0, $minTruck->soundFrequency());
        $this->assertEquals(120.0, $minTruck->soundLevel());

        // And: 非常に大きな値でのテスト（超重量級トラック）
        $maxTruck = new Truck(99999.99);
        $this->assertEquals('This is a truck that weights: 99999.99kg', $maxTruck->__toString());
        $this->assertEquals(165.0, $maxTruck->soundFrequency());
        $this->assertEquals(120.0, $maxTruck->soundLevel());
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
        // Given: 負の重量のトラックを作成
        $negativeTruck = new Truck(-5000.0);

        // When & Then: 負の重量でも適切に動作することを確認
        $expected = 'This is a truck that weights: -5000kg';
        $this->assertEquals($expected, $negativeTruck->__toString());

        // And: 音響特性は変わらないことを確認
        $this->assertEquals(165.0, $negativeTruck->soundFrequency());
        $this->assertEquals(120.0, $negativeTruck->soundLevel());
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
        // Given: 非常に小さい重量のトラックを作成
        $preciseTruck = new Truck(0.001);

        // When & Then: 小数点の精度が保たれることを確認
        $expected = 'This is a truck that weights: 0.001kg';
        $this->assertEquals($expected, $preciseTruck->__toString());
    }

    /**
     * 実用的な重量範囲のテスト
     *
     * 実際のトラックで使用される重量範囲での動作を確認します。
     * 軽トラックから大型トラックまでの実用的な重量でのテストです。
     *
     * @test
     * @return void
     */
    public function testRealWorldWeights(): void
    {
        // Given: 実用的な重量範囲のテストケース

        // When & Then: 軽トラック（0.5-1.5トン）
        $keiTruck = new Truck(750.0);
        $this->assertEquals('This is a truck that weights: 750kg', $keiTruck->__toString());

        // And: 小型トラック（2-4トン）
        $smallTruck = new Truck(3000.0);
        $this->assertEquals('This is a truck that weights: 3000kg', $smallTruck->__toString());

        // And: 中型トラック（4-8トン）
        $mediumTruck = new Truck(6000.0);
        $this->assertEquals('This is a truck that weights: 6000kg', $mediumTruck->__toString());

        // And: 大型トラック（8-25トン）
        $largeTruck = new Truck(20000.0);
        $this->assertEquals('This is a truck that weights: 20000kg', $largeTruck->__toString());
    }

    /**
     * トラックの音響特性比較テスト
     *
     * 他の乗り物と比較してトラックの音響特性が適切であることを確認します。
     * トラックは高い音量と中程度の周波数を持つべきです。
     *
     * @test
     * @return void
     */
    public function testSoundCharacteristics(): void
    {
        // Given: テスト用のトラック
        $truck = new Truck(10000.0);

        // When: 音響特性を取得
        $frequency = $truck->soundFrequency();
        $soundLevel = $truck->soundLevel();

        // Then: トラックらしい音響特性を確認

        // 周波数: 165Hz（工業車両らしい中低音域）
        $this->assertEquals(165.0, $frequency);
        $this->assertGreaterThan(100.0, $frequency, 'トラックの周波数は低音域にある');
        $this->assertLessThan(200.0, $frequency, 'トラックの周波数は極端に低くない');

        // 音量: 120dB（工業車両らしい高音量）
        $this->assertEquals(120.0, $soundLevel);
        $this->assertGreaterThan(100.0, $soundLevel, 'トラックは高音量である');
        $this->assertLessThan(140.0, $soundLevel, 'トラックの音量は聴覚損傷レベルではない');
    }

    /**
     * 連続運転シミュレーションテスト
     *
     * トラックが連続して動作する場面をシミュレートします。
     * 複数回の操作でも一貫した結果を返すことを確認します。
     *
     * @test
     * @return void
     */
    public function testContinuousOperation(): void
    {
        // Given: テスト用のトラック
        $truck = new Truck(5000.0);

        // When & Then: 複数回の操作で一貫した結果を確認
        for ($i = 0; $i < 10; $i++) {
            $this->assertEquals('This is a truck that weights: 5000kg', $truck->__toString());
            $this->assertEquals(165.0, $truck->soundFrequency());
            $this->assertEquals(120.0, $truck->soundLevel());
        }
    }

    /**
     * 実世界の重量データプロバイダー
     *
     * @return array<string, array<int, float|string>> テストデータの配列
     */
    public static function realWorldWeightProvider(): array
    {
        return [
            'kei_truck' => [750.0, '軽トラック'],
            'small_truck' => [3000.0, '小型トラック'],
            'medium_truck' => [6000.0, '中型トラック'],
            'large_truck' => [20000.0, '大型トラック'],
        ];
    }
}
